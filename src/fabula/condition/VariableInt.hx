package fabula.condition;

import fabula.condition.ConditionFactory;

class VariableInt extends Variable<Int>
{
	public function new(id:String, startingValue:String)
	{
		super(id, INT, startingValue);
	}

	override public function set(value:String):Bool
	{
		var temp:Int = this.value;
		this.value = Std.parseInt(value);
		if (temp != this.value)
			return true;
		return false;
	}

	override function convert(value:String):Int
	{
		return Std.parseInt(value);
	}

	override function compare(operation:EConditionOp, targetValue:Int):Bool
	{
		switch (operation)
		{
			case EQUAL:
				return value == targetValue;
			case DIFFERENT:
				return value != targetValue;
			case GREATER:
				return value > targetValue;
			case GREATER_EQUAL:
				return value >= targetValue;
			case LOWER:
				return value < targetValue;
			case LOWER_EQUAL:
				return value <= targetValue;
			default:
				return false;
		}
	}
}
