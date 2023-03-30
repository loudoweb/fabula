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

	function extract(str:String):{operation:String, subValue:Int}
	{
		var operation = str.charAt(0);
		var subValue = 0;
		if (operation == "+" || operation == "-")
		{
			subValue = Std.parseInt(str.substring(1));
		} else
		{
			subValue = Std.parseInt(str);
		}
		return {operation: operation, subValue: subValue};
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
