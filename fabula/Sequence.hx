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

	public function getNextEvent():Event
	{
		if (current + 1 <= sequence.length)
		{
			current++;
			if (current < sequence.length)
			{
				return sequence[current];
			} else
			{
				numCompleted++;
				trace("sequence completed");
			}
		}
		return null;
	}

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
