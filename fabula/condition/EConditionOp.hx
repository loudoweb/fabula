package fabula.condition;

/**
 * @author Loudo
 */
@:enum abstract EConditionOp(String) from String to String
{
	public var GREATER = ">";
	public var LOWER = "<";
	public var GREATER_EQUAL = ">=";
	public var LOWER_EQUAL = "<=";
	public var EQUAL = "=";
	public var DIFFERENT = "!";
	public var NOT_IN = "!in";
	public var IN = "in";
}
