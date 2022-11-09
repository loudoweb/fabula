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
}
