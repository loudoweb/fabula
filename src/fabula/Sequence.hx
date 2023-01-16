package fabula;

import fabula.condition.VariableEnum;
import fabula.condition.ConditionCollection;
import haxe.macro.Expr.Case;
import fabula.condition.Variable.EVariableType;
import fabula.condition.VariableCollection;
import fabula.condition.VariableString;
import fabula.condition.VariableInt;
import fabula.condition.VariableFloat;
import fabula.condition.VariableBool;

class Sequence
{
	/**
	 * Internal tag to make a choice exit a sequence
	 */
	@:final inline public static var EXIT = "$$EXIT$$";

	public var id:String;
	public var variables:VariableCollection;
	public var events:Array<Event>;
	public var branches:Array<Event>;
	public var conditions:ConditionCollection;

	public var nextTarget:Null<String>;

	public var current:Int;
	public var currentId:Null<String>;
	public var numCompleted:Int;

	public function new(id:String)
	{
		this.id = id;
		current = -1;
		currentId = null;
		numCompleted = 0;
		nextTarget = null;
	}

	public function addConditions(conditions:ConditionCollection)
	{
		this.conditions = conditions;
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
		}
	}

	public function addSequence(events:Array<Event>, branches:Array<Event>)
	{
		if (this.events != null || this.branches != null)
			trace("WARNING a new sequence will replace an old sequence");
		this.events = events;
		this.branches = branches;
	}

	public function start():Void
	{
		current = -1;
		nextTarget = null;
		currentId = null;

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
			if (events[current].isExit || (nextTarget == EXIT))
			{
				numCompleted++;
				trace('[Fabula] sequence $id completed');
				return null;
			}
		}

		if (current + 1 <= events.length)
		{
			// target overwrites next event in the queue
			if (current >= 0)
			{
				if (nextTarget != null && nextTarget != "")
				{
					var target = nextTarget;
					nextTarget = null;
					return getEvent(target);
				} else if (events[current].target != null && events[current].target != "")
				{
					return getEvent(events[current].target);
				}
			}
			// if no target, we find the next event in queue
			current++;
			if (current < events.length)
			{
				var nextEvent = events[current];
				if (nextEvent.testConditions())
				{
					currentId = nextEvent.id;
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
	 * @param id id of the event. If null returns current event
	 * @return Event.
	 */
	public function getEvent(?id:String):Event
	{
		if (id == null)
		{
			id = currentId;
		}

		// main events flow
		for (i in 0...events.length)
		{
			if (events[i].id == id)
			{
				current = i;
				currentId = id;
				return events[i];
			}
		}
		// branches events flow
		for (i in 0...branches.length)
		{
			if (branches[i].id == id)
			{
				currentId = id;
				return branches[i];
			}
		}

		return null;
	}
}
