package fabula.condition;

import fabula.condition.ConditionFactory;

class VariableCycle extends VariableEnum
{
	public function new(id:String, startingValue:String)
	{
		super(id, startingValue);

		type = CYCLE;
	}

	override public function set(value:String):Bool
	{
		var temp:String = this.value;
		var index = Std.parseInt(value);
		if (index == null)
		{
			if (value == options.join(","))
			{
				// force to first option if all options set
				value = options[0];
			} else if (value == "+")
			{
				var index = options.indexOf(this.value) + 1;
				if (index >= options.length)
				{
					index = 0;
				}
				value = options[index];
			} else if (value == "-")
			{
				var index = options.indexOf(this.value) - 1;
				if (index < 0)
				{
					index = options.length - 1;
				}
				value = options[index];
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
			if (index >= options.length)
			{
				index = options.length - 1;
			} else if (index < 0)
			{
				index = 0;
			}
			this.value = options[index];
		}

		if (temp != this.value)
			return true;
		return false;
	}
}
