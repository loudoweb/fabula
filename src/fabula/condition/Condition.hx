package fabula.condition;

/**
 * Base class to test a condition
 * @author Loudo
 */
class Condition<T>
{
	public var condition:T;
	public var type:EConditionType;

	var _affirmation:Bool;

	public function new(condition:T, type:EConditionType, affirmation:Bool = true)
	{
		this.condition = condition;
		this.type = type;
		_affirmation = affirmation;
	}

	public function test():Bool
	{
		throw "[Condition] Override test function";
	}

	#if tools
	public function toString():String
	{
		return _affirmation ? Std.string(condition) : "!" + Std.string(condition);
	}
	#end
}
