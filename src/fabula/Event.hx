package fabula;

import fabula.Choice;
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
	 * Can be played only 'limit' time. E.g: to play only once, limit should equals 1.
	 */
	public var limit:Int;

	/**
	 * To avoid picking up too many time this event, or for statistical purpose
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

	/**
	 * Conditioned choices (temp)
	 */
	var _cacheChoices:Array<Choice>;

	/**
	 * 
	 * @param id id of the event. Should be unique. You can use this id in conditions and in your localization system to retrieve the text.
	 * @param text text of the event
	 * @param conditions 
	 * @param isExit Last event of the sequence.
	 * @param weight TODO
	 * @param limit Default 0 means that you can play infinitely. Set to 1 to play once, 2 to play twice, etc.
	 * @param speaker Help you determine who speaks to display an image.
	 * @param listeners Help you determine who is also present in the dialog scene.
	 * @param environment Help you determine the place where the dialog takes place
	 * @param target Next event id. By Default the next event is the next event in the xml.
	 */
	public function new(id:String, text:String, conditions:ConditionCollection = null, isExit:Bool = false,
			weight:Int = 1, limit:Int = 0, ?speaker:String, ?listeners:String, ?environment:String, ?target:String)
	{
		this.id = id;
		this.text = text;
		this.conditions = conditions;

		this.isExit = isExit;
		this.limit = limit;
		this.count = 0;

		this.speaker = speaker;
		this.listeners = listeners;
		this.environment = environment;

		this.target = target;

		ConditionFactory.helperList.set(this.id, EVENT);
	}

	/**
	 * Get all choices that meet the condition in the current thread.
	 * It is recommended to use Fabula.getChoices() instead of directly this method because the former can add default choices
	 * @return Array<Choice>
	 */
	public function getChoices():Array<Choice>
	{
		_cacheChoices = []; // TODO empty
		if (choices != null)
		{
			for (i in 0...choices.length)
			{
				var hasOnceLimit = choices[i].limit > 0 && choices[i].count >= choices[i].limit;

				if (!hasOnceLimit)
				{
					if (choices[i].condition == null || choices[i].condition.test())
						_cacheChoices.push(choices[i]);
				}
			}
		}
		return _cacheChoices;
	}

	/**
	 * Get a choice from id or index
	 * It is recommended to use Fabula.selectChoice() instead of directly this method because this one doesn't apply variables, etc.
	 * @param id id of the choice
	 * @param index index of the choice (use it alternatively to id)
	 * @param selectFromAll default to false, set to true if you want to get a choice from the whole list of choices (i.e., a choice that doesn't necessarily met its condition)
	 * @return Choice null if not found
	 */
	public function selectChoice(?id:String, ?index:Int, selectFromAll:Bool = false):Choice
	{
		#if php
		// as php forget the thread, you need to be sure to have generated the choices
		if (_cacheChoices == null || _cacheChoices.length == 0)
		{
			getChoices();
		}
		#end
		var _choiceArray = selectFromAll ? choices : _cacheChoices;
		var selected:Choice = null;
		if (_choiceArray != null)
		{
			if (id != null)
			{
				for (i in 0..._choiceArray.length)
				{
					if (_choiceArray[i].id == id)
					{
						selected = _choiceArray[i];
						break;
					}
				}
			} else if (index != null && index < _choiceArray.length)
				selected = _choiceArray[index];
		}
		if (selected != null)
			selected.count++;
		return selected;
	}

	public function testConditions():Bool
	{
		var hasOnceLimit = limit > 0 && count >= limit;
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
