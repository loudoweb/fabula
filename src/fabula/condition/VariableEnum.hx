package fabula.condition;

import fabula.condition.ConditionFactory;

class VariableEnum extends Variable<String>
{
	public var options:Array<String>;

	public function new(id:String, startingValue:String)
	{
		options = startingValue.split(",");

		super(id, ENUM, startingValue);
	}

	override public function set(value:String):Bool
	{
		var temp:String = this.value;
		var index = Std.parseInt(value);
		if (index == null)
		{
			if (value == options.toString())
			{
				// force to first option if all options set
				value = options[0];
			}
			if (value == "+")
			{
				var index = options.indexOf(this.value) + 1;
				if (index < options.length)
				{
					value = options[index];
				} else
				{
					return false;
				}
			} else if (value == "-")
			{
				var index = options.indexOf(this.value) - 1;
				if (index >= 0)
				{
					value = options[index];
				} else
				{
					return false;
				}
			} else
			{
				if (options.indexOf(value) == -1)
				{
					trace('[Fabula > Variable] $value not in options of $id');
					return false;
				}
			}
			this.value = value;
		} else
		{
			if (index >= options.length || index < 0)
			{
				trace('[Fabula > Variable] $index not in length of $id');
				return false;
			}
			this.value = options[index];
		}

		if (temp != this.value)
			return true;
		return false;
	}

	override function convert(value:String):String
	{
		return value;
	}
}
