package fabula;

import fabula.condition.Variable;
import fabula.condition.ConditionFactory;
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

	// list of achieved event/dialog
	public var achievedListID(default, null):Array<String>;
	public var conditionFactory(default, null):ConditionFactory;

	public var currentSequence(default, null):Sequence;

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

	var _achievedCallback:String->Void;

	/**
	 * Fabula is a sequencial or branch event/dialog system.
	 * Different systems can be used to run through a storyline.
	 * Some story are sequencial, other are branch based, xml are formed differently to optimize manual integration.
	 * A tool could help homogenize xml but not planned yet.
	 * @param files You can use more than one file.
	 */
	public function new(files:Array<String>, ?achievedCallback:String->Void)
	{
		_questsID = [];
		_encountersID = [];
		_textsID = [];
		achievedListID = [];
		_achievedCallback = achievedCallback;
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
		var elements = FabulaXmlParser.parse(raw, conditionFactory, achievedListID);
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
		achievedListID.splice(0, achievedListID.length);
		for (seq in _sequences)
		{
			if (seq.variables != null)
			{
				for (i in 0...seq.variables.length)
				{
					seq.variables[i].reset();
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
	 * 
	 * @return Event. Null if current event is the last one.
	 */
	public function getNextEvent():Event
	{
		var nextEvent = currentSequence.getNextEvent();
		if (nextEvent != null)
		{
			achievedListID.push(nextEvent.id);
			if (_achievedCallback != null)
				_achievedCallback(nextEvent.id);
		}
		return nextEvent;
	}

	public function getCurrentEvent():Event
	{
		return currentSequence.getEvent();
	}

	/**
	 * Apply an user choice to the sequence, add it to the achieved list and set variables
	 * @param choice 
	 * @param id 
	 * @return Choice
	 */
	public function selectChoice(?id:String, ?index:Int):Choice
	{
		var choice:Choice = null;
		// update guard to check if sequence completed
		if (currentSequence != null && currentSequence.current < currentSequence.events.length)
		{
			choice = currentSequence.getEvent().selectChoice(id, index);
			currentSequence.nextTarget = choice.isExit ? Sequence.EXIT : choice.target;
		}
		if (choice != null)
		{
			achievedListID.push(id);
			if (_achievedCallback != null)
				_achievedCallback(id);
			// TODO variables
		}
		return choice;
	}

	public function getVar(name:String):Variable<Dynamic>
	{
		if (currentSequence != null)
		{
			var vari = currentSequence.variables.get(name);
			if (vari != null)
				return vari;
			// TODO global vars
		}
		return null;
	}

	public function updateVar() {}

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
