package fabula;

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

class Fabula
{
	// list of achieved event/dialog
	public var achievedListID(default, null):Array<String>;
	public var conditionFactory(default, null):ConditionFactory;

	// Different lists are stored so you can pick up an event/dial on a particular list or from all:
	// quest list is a special list for main events
	var _questsID:Array<String>;
	// random encounters
	var _encountersID:Array<String>;
	// small part of texts that you can merge in a event/dialog randomly
	var _textsID:Array<String>;

	var _sequences:Array<Sequence>;
	var _randomEncounters:Array<Event>;

	/**
	 * Fabula is a sequencial or branch event/dialog system.
	 * Different systems can be used to run through a storyline.
	 * Some story are sequencial, other are branch based, xml are formed differently to optimize manual integration.
	 * A tool could help homogenize xml but not planned yet.
	 * @param files You can use more than one file.
	 */
	public function new(files:Array<String>)
	{
		_questsID = [];
		_encountersID = [];
		_textsID = [];
		achievedListID = [];
		conditionFactory = new ConditionFactory();

		_sequences = [];

		for (file in files)
		{
			init(file);
		}
	}

	function init(raw:String):Void
	{
		// TODO JSON parser?
		var elements = FabulaXmlParser.parse(raw, conditionFactory);
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

	public function getSequence(id:String):Sequence
	{
		for (i in 0..._sequences.length)
		{
			if (_sequences[i].id == id)
				return _sequences[i];
		}
		return null;
	}
}
