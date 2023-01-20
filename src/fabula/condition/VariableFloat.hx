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
		var temp:Float = this.value;

		switch (value)
		{
			case "+" | "++":
				this.value++;
			case "-" | "--":
				this.value--;
			case extract(_) => result:
				switch (result.operation)
				{
					case "+":
						this.value += result.subValue;
					case "-":
						this.value -= result.subValue;
					default:
						this.value = result.subValue;
				}
		}
		if (temp != this.value)
			return true;
		return false;
	}

	function extract(str:String):{operation:String, subValue:Float}
	{
		var operation = str.charAt(0);
		var subValue = 0.0;
		if (operation == "+" || operation == "-")
		{
			subValue = Std.parseFloat(str.substring(1));
		} else
		{
			subValue = Std.parseFloat(str);
		}
		return {operation: operation, subValue: subValue};
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
