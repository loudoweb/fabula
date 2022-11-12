package fabula;

import haxe.macro.Expr.Case;
import fabula.condition.Variable.EVariableType;
import fabula.condition.VariableCollection;
import fabula.condition.VariableString;
import fabula.condition.VariableInt;
import fabula.condition.VariableFloat;

class Sequence
{
	public var id:String;
	public var variables:VariableCollection;
	public var events:Array<Event>;

	public var current:Int;
	public var numCompleted:Int;

	var _achievedListID:Array<String>;

	public function new(id:String, achievedListID:Array<String>)
	{
		this.id = id;
		this._achievedListID = achievedListID;
		current = -1;
		numCompleted = 0;
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
		}
	}

	public function addSequence(events:Array<Event>)
	{
		if (this.events != null)
			trace("WARNING a new sequence will replace an old sequence");
		this.events = events;
	}

	public function start():Void
	{
		current = -1;

		if (variables != null)
		{
			for (i in 0...variables.length)
			{
				variables[i].reset();
			}
		}
	}

	/**
	 * Call this method to get the next method (apply conditions and exit)
	 * @param ignoreExit use internally, don't use
	 * @return Event
	 */
	public function getNextEvent(ignoreExit:Bool = false):Event
	{
		if (!ignoreExit && current > -1 && current < events.length)
		{
			if (events[current].isExit)
			{
				numCompleted++;
				trace("sequence completed");
				return null;
			}
		}
		if (current + 1 <= events.length)
		{
			current++;
			if (current < events.length)
			{
				var nextEvent = events[current];
				if (nextEvent.testConditions())
				{
					_achievedListID.push(nextEvent.id);
					return nextEvent;
				} else
					return getNextEvent(true);
			} else
			{
				numCompleted++;
				trace("sequence completed");
			}
		}
		return null;
	}

	/**
	 * Jump to a specific event (usually because a choice has a specific target event set)
	 * @param index index of the event in the sequence (from save? debug?)
	 * @param id id of the event (choice target)
	 * @return Event
	 */
	public function getEvent(?index:Int, ?id:String):Event
	{
		if (index == null)
			index = current;
		if (id == null)
			return events[current];
		else
		{
			for (i in 0...events.length)
			{
				if (events[i].id == id)
				{
					current = i;
					return events[i];
				}
			}
		}
		return null;
	}
}
