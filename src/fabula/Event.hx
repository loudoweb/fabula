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
	 * Determine if this event should end a sequence
	 */
	public var isExit:Bool;

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

	/**
	 * Optionnal target
	 */
	public var target:Null<String>;

	var _cacheChoices:Array<Choice>;

	/**
	 * 
	 * @param id id of the event
	 * @param text text of the event
	 * @param once Can be played only once
	 */
	public function new(id:String, text:String, conditions:ConditionCollection = null, isExit:Bool = false,
			weight:Int = 1, once:Bool = false, ?speaker:String, ?listeners:String, ?environment:String, ?target:String)
	{
		this.id = id;
		this.text = text;
		this.conditions = conditions;

		this.isExit = isExit;
		this.once = once;
		this.count = 0;

		this.speaker = speaker;
		this.listeners = listeners;
		this.environment = environment;

		this.target = target;

		ConditionFactory.helperList.set(this.id, EVENT);
	}

	public function getChoices():Array<Choice>
	{
		_cacheChoices = []; // TODO empty
		if (choices != null)
		{
			for (i in 0...choices.length)
			{
				if (choices[i].condition == null || choices[i].condition.test())
					_cacheChoices.push(choices[i]);
			}
		}
		// TODO use general Fabula parameter AND use random text list for the following text's choices
		if (_cacheChoices.length == 0)
		{
			if (isExit)
			{
				_cacheChoices.push(new Choice("EXIT", Fabula.QUIT, "quit", target, true));
			} else
			{
				_cacheChoices.push(new Choice("CONTINUE", Fabula.CONTINUE, "continue", target));
			}
		}
		return _cacheChoices;
	}

	public function selectChoice(?id:String, ?index:Int, selectFromAll:Bool = false):Choice
	{
		var _choiceArray = selectFromAll ? choices : _cacheChoices;
		if (_choiceArray != null)
		{
			if (id != null)
			{
				for (i in 0..._choiceArray.length)
				{
					if (_choiceArray[i].id == id)
						return _choiceArray[i];
				}
			} else if (index != null)
				return _choiceArray[index];
		}
		return null;
	}

	public function testConditions():Bool
	{
		var hasOnceLimit = once && count >= 1;
		if (conditions == null)
			return !hasOnceLimit;

		return !hasOnceLimit && conditions.test();
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
