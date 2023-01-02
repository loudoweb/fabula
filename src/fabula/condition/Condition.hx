package fabula.condition;

/**
 * Base class to test a condition
 * @author Loudo
 */
class Condition<T>
{
	public var condition:T;
	public var type:EConditionType;

	public function new(condition:T, type:EConditionType)
	{
		this.condition = condition;
		this.type = type;
	}

	public function test():Bool
	{
		throw "[Condition] Override test function";
	}
}
