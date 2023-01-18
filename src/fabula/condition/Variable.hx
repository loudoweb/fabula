package fabula.condition;

import fabula.condition.EConditionOp;
import fabula.condition.ConditionFactory;

enum EVariableType
{
	STRING;
	INT;
	ENUM;
	BOOL;
	FLOAT;
}

class Variable<T>
{
	public var id:String;
	public var type:EVariableType;
	public var startingValue:T;
	public var value:T;

	public function new(id:String, type:EVariableType, startingValue:String)
	{
		this.id = id;
		this.type = type;
		set(startingValue);
		this.startingValue = value;
		ConditionFactory.helperList.set(this.id, VARIABLE);
	}

	public function set(value:String):Bool
	{
		throw "[Fabula > variable] This method needs to be overriden";
		return false;
	}

	public function convert(value:String):T
	{
		throw "[Fabula > variable] This method needs to be overriden";
		return null;
	}

	public function compare(operation:EConditionOp, targetValue:T):Bool
	{
		switch (operation)
		{
			case EQUAL:
				return value == targetValue;
			case DIFFERENT:
				return value != targetValue;
			default:
				return false;
		}
	}

	public function reset()
	{
		this.value = this.startingValue;
	}

	public function toString():String
	{
		return '[var $id : v:$value, d:$startingValue]';
	}
}
