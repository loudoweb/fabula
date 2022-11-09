package fabula;

import fabula.condition.ConditionCollection;
import fabula.condition.ConditionFactory;

class Event
{
	/**
	 * Automatically generated if empty
	 * It can be used to display a specific event, redirect from a choice...
	 * It should match the name of your audio file if any.
	 */
	public var id:String;

	/**
	 * This is optional since we could get a localized text using the id
	 */
	public var text:String;

	/**
	 * Can be played only once
	 */
	public var once:Bool;

	/**
	 * For statistic purpose or to avoid picking up too many time this event
	 */
	public var count:Int;

	/**
	 * Weight for randomness
	 */
	public var weight:Int;

	/**
	 * Could be use to set the speaker and his pose if needed
	 */
	public var speaker:Null<String>;

	/**
	 * Could be use to set the listeners and their poses if needed
	 */
	public var listeners:Null<String>;

	/**
	 * Could be use to set position of the camera, the weather, etc.
	 */
	public var environment:Null<String>;

	/**
	 * Choices are contained inside events.
	 */
	public var choices:Array<Choice>;

	public var conditions:ConditionCollection;

	var _cacheChoices:Array<Choice>;

	/**
	 * 
	 * @param id id of the event
	 * @param text text of the event
	 * @param once Can be played only once
	 */
	public function new(id:String, text:String, ?conditions:ConditionCollection, weight:Int = 1, once:Bool = false,
			?speaker:String, ?listeners:String, ?environment:String)
	{
		this.id = id;
		this.text = text;
		this.conditions = conditions;

		this.once = once;
		this.count = 0;

		this.speaker = speaker;
		this.listeners = listeners;
		this.environment;

		ConditionFactory.helperList.set(this.id, EVENT);
	}

	public function getChoices():Array<Choice>
	{
		_cacheChoices = []; // TODO empty
		for (i in 0...choices.length)
		{
			if (choices[i].condition.test())
				_cacheChoices.push(choices[i]);
		}
		// TODO default continue choice
		return _cacheChoices;
	}

	public function addChoice(choice:Choice)
	{
		if (choices == null)
		{
			choices = [];
			_cacheChoices = [];
		}
		choices.push(choice);
	}
}
