package fabula.condition;

import fabula.condition.ConditionFactory;

class VariableString extends Variable<String>
{
	public function new(id:String, startingValue:String)
	{
		super(id, STRING, startingValue);
	}

	override public function set(value:String):Bool
	{
		var temp:String = this.value;
		this.value = value;
		if (temp != this.value)
			return true;
		return false;
	}

	override function convert(value:String):String
	{
		return value;
	}

	override function compare(operation:EConditionOp, targetValue:String):Bool
	{
		switch (operation)
		{
			case EQUAL:
				return value == targetValue;
			case DIFFERENT:
				return value != targetValue;
			case IN:
				return value.indexOf(targetValue) != -1;
			case NOT_IN:
				return value.indexOf(targetValue) == -1;
			default:
				return false;
		}
	}
}
