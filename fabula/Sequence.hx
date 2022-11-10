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
	public var sequence:Array<Event>;

	public var current:Int;
	public var numCompleted:Int;

	public function new(id:String)
	{
		this.id = id;
		current = 0;
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

	public function addSequence(sequence:Array<Event>)
	{
		if (this.sequence != null)
			trace("WARNING a new sequence will replace an old sequence");
		this.sequence = sequence;
	}

	public function start():Event
	{
		current = 0;

		for (i in 0...variables.length)
		{
			variables[i].reset();
		}

		return sequence[0];
	}

	/**
	 * Call this method to get the next method (apply conditions and exit)
	 * @param ignoreExit use internally, don't use
	 * @return Event
	 */
	public function getNextEvent(ignoreExit:Bool = false):Event
	{
		if (!ignoreExit)
		{
			if (sequence[current].isExit)
			{
				numCompleted++;
				trace("sequence completed");
				return null;
			}
		}
		if (current + 1 <= sequence.length)
		{
			current++;
			if (current < sequence.length)
			{
				var nextSeq = sequence[current];
				if (nextSeq.testConditions())
					return nextSeq;
				else
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
			return sequence[current];
		else
		{
			for (i in 0...sequence.length)
			{
				if (sequence[i].id == id)
				{
					current = i;
					return sequence[i];
				}
			}
		}
		return null;
	}
}
