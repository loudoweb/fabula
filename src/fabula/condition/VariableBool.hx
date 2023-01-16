package fabula.condition;

import fabula.condition.ConditionFactory;

class VariableBool extends Variable<Bool>
{
	public function new(id:String, startingValue:String)
	{
		super(id, BOOL, startingValue);
	}

	override public function set(value:String):Bool
	{
		var temp = this.value;
		this.value = value == "true" || value == "1";
		if (temp != this.value)
			return true;
		return false;
	}

	override function convert(value:String):Bool
	{
		return value == "true" || value == "1";
	}
}
