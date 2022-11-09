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
}
