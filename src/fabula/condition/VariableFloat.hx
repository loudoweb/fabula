package fabula.condition;

import fabula.condition.ConditionFactory;

class VariableFloat extends Variable<Float>
{
	public function new(id:String, startingValue:String)
	{
		super(id, FLOAT, startingValue);
	}

	override public function set(value:String):Bool
	{
		var temp = this.value;
		this.value = Std.parseFloat(value);
		if (temp != this.value)
			return true;
		return false;
	}

	override function convert(value:String):Float
	{
		return Std.parseFloat(value);
	}

	override function compare(operation:EConditionOp, targetValue:Float):Bool
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
