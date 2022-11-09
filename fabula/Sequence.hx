package fabula;

class Sequence
{
	public var id:String;
	public var variables:Array<Variable>;
	public var sequence:Array<Event>;

	public var current:Int;
	public var numCompleted:Int;

	public function new(id:String)
	{
		this.id = id;
		current = 0;
		numCompleted = 0;
	}

	public function addVariable(id:String, type:String, startingValue:String)
	{
		if (variables == null)
			variables = [];
		variables.push(new Variable(id, type, startingValue));
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
