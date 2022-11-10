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
}
