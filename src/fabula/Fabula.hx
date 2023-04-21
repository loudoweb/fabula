package fabula;

import fabula.condition.*;
import fabula.condition.Variable.EVariableType;
import haxe.ds.StringMap;

enum EEventType
{
	QUEST;
	RANDOM_ENCOUNTER;
	SCENE;
}

enum EPlayingType
{
	SEQUENCE;
	DRAW;
}

#if commonjs @:expose #end
class Fabula
{
	public static var CONTINUE:String = "Continue";
	public static var QUIT:String = "Quit";

	// list of completed event/dialog
	public var completedID(default, null):Array<String>;
	public var conditionFactory(default, null):ConditionFactory;

	public var currentSequence(default, null):Sequence;

	public var variables:VariableCollection;

	// Different lists are stored so you can pick up an event/dial on a particular list or from all:
	// quest list is a special list for main events
	var _questsID:Array<String>;
	// random encounters
	var _encountersID:Array<String>;
	// small part of texts that you can merge in a event/dialog randomly
	var _textsID:Array<String>;

	#if tools public #end
	var _sequences:Array<Sequence>;
	var _randomEncounters:Array<Event>;

	var _completedCallback:String->Void;

	/**
	 * Fabula is a sequencial or branch event/dialog system.
	 * Different systems can be used to run through a storyline.
	 * Some story are sequencial, other are branch based, xml are formed differently to optimize manual integration.
	 * A tool could help homogenize xml but not planned yet.
	 * @param files You can use more than one file.
	 */
	public function new(files:Array<String>, ?completedCallback:String->Void)
	{
		_questsID = [];
		_encountersID = [];
		_textsID = [];
		completedID = [];
		_completedCallback = completedCallback;
		conditionFactory = new ConditionFactory(this);

		_sequences = [];

		for (file in files)
		{
			init(file);
		}
	}

	function init(raw:String):Void
	{
		// TODO JSON parser?
		var elements = FabulaXmlParser.parse(raw, this);
		arrayMerge(_sequences, elements.sequences);
	}

	/*
	 * Merge 2 arrays. All duplicates are kept. TODO?
	 */
	function arrayMerge<T>(source:Array<T>, adding:Array<T>)
	{
		for (i in 0...adding.length)
		{
			source.push(adding[i]);
		}
	}

	/*
	 * Merge a map to a an other one. Duplicate in the second array replaces the ones in the source map
	 */
	function mapMerge<K, V>(source:Map<K, V>, adding:Map<K, V>)
	{
		for (key => value in adding)
		{
			source[key] = value;
		}
	}

	/**
	 * Reset all data.
	 */
	public function reset()
	{
		completedID.splice(0, completedID.length);
		for (seq in _sequences)
		{
			if (seq.variables != null)
			{
				for (i in 0...seq.variables.length)
				{
					seq.variables[i].reset();
				}
			}

			seq.completedID.splice(0, seq.completedID.length);

			for (event in seq.events)
			{
				event.count = 0;

				if (event.choices != null)
				{
					for (choice in event.choices)
					{
						choice.count = 0;
					}
				}
			}
		}
	}

	/**
	 * 
	 * Get a particular sequence.
	 * @param id 
	 * @param start true if you want to check conditions, start from beginning and reset variables. false to get a sequence bypassing conditions and without activating it (to check stuff manually, debug purpose etc.)
	 * @return Sequence return sequence if found and conditions met
	 */
	public function selectSequence(id:String, start:Bool = true):Sequence
	{
		for (i in 0..._sequences.length)
		{
			if (_sequences[i].id == id)
			{
				var seq = _sequences[i];
				if (start)
				{
					if (seq.conditions == null || seq.conditions.test())
					{
						currentSequence = seq;
						currentSequence.start();
					} else
					{
						return null;
					}
				}
				return seq;
			}
		}
		return null;
	}

	/**
	 * Get the next event.
	 * @return Event. Null if current event is the last one.
	 */
	public function getNextEvent():Event
	{
		var nextEvent = currentSequence.getNextEvent();
		if (nextEvent != null)
		{
			nextEvent.count++;
			completedID.push(nextEvent.id);
			currentSequence.completedID.push(nextEvent.id);
			if (_completedCallback != null)
				_completedCallback(nextEvent.id);
		}
		return nextEvent;
	}

	public function getCurrentEvent():Event
	{
		return currentSequence.getEvent();
	}

	/**
	 * Apply an user choice to the current event of the sequence, add it to the completed list and set variables.
	 * @param id id of the choice
	 * @param index index of the choice (use it alternatively to id)
	 * @return Choice null if not found
	 */
	public function selectChoice(?id:String, ?index:Int):Choice
	{
		var choice:Choice = null;
		// update guard to check if sequence completed
		if (currentSequence != null && currentSequence.current < currentSequence.events.length)
		{
			choice = currentSequence.getEvent().selectChoice(id, index);

			if (choice != null)
			{
				if (choice.variables != null)
				{
					for (key in choice.variables.keys())
					{
						var _vari = getVar(key);
						if (_vari != null)
						{
							_vari.set(choice.variables.get(key));
						}
					}
				}
				// configure next target
				currentSequence.nextTarget = choice.isExit ? Sequence.EXIT : choice.target;

				completedID.push(choice.id);
				currentSequence.completedID.push(choice.id);
				if (_completedCallback != null)
					_completedCallback(choice.id);
			}
		}

		return choice;
	}

	public function addVariable(id:String, type:EVariableType, startingValue:String)
	{
		if (variables == null)
			variables = new VariableCollection();
		switch (type)
		{
			case STRING:
				variables.push(new VariableString(id, startingValue));
			case INT:
				variables.push(new VariableInt(id, startingValue));
			case FLOAT:
				variables.push(new VariableFloat(id, startingValue));
			case BOOL:
				variables.push(new VariableBool(id, startingValue));
			case ENUM:
				variables.push(new VariableEnum(id, startingValue));
			case CYCLE:
				variables.push(new VariableCycle(id, startingValue));
		}
	}

	public function getVar(name:String):Variable<Dynamic>
	{
		var out:Variable<Dynamic> = null;
		if (currentSequence != null)
		{
			if (currentSequence.variables != null)
			{
				out = currentSequence.variables.get(name);
				if (out != null)
					return out;
			}
		}
		if (out == null && variables != null)
		{
			out = variables.get(name);
		}
		return out;
	}

	/**
	 * Check if ID of event or choice is completed
	 * @param id 
	 * @return Bool
	 */
	public function isIDCompleted(id:String):Bool
	{
		if (id.charAt(0) == ".")
		{
			// check if completed in current sequence context
			return currentSequence.completedID.indexOf(id.substring(1)) != -1;
		} else
		{
			// check if completed globally
			return completedID.indexOf(id) != -1;
		}
		return false;
	}

	/**
	 * 
	 * WIP: count words
	 * TODO don't count variable and html tag
	 * TODO take into account nbsp
	 */
	public function countWords():Int
	{
		var count = 0;
		for (seq in _sequences)
		{
			if (seq.events != null)
			{
				for (event in seq.events)
				{
					count += event.text.split(" ").length;
					if (event.choices != null)
					{
						for (choice in event.choices)
						{
							count += choice.text.split(" ").length;
						}
					}
				}
			}
		}
		return count;
	}
}
