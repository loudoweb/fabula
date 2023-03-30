package fabula.condition;

/**
 * @author Loudo
 */
@:enum abstract EConditionOp(String)
{
	public var GREATER = ">";
	public var LOWER = "<";
	public var GREATER_EQUAL = ">=";
	public var LOWER_EQUAL = "<=";
	public var EQUAL = "=";
	public var DIFFERENT = "!=";
	public var IN = "in";

	@:from
	static public function fromString(s:String)
	{
		switch (s)
		{
			case ">":
				return GREATER;
			case "<":
				return LOWER;
			case ">=":
				return GREATER_EQUAL;
			case "<=":
				return LOWER_EQUAL;
			case "=":
				return EQUAL;
			case "!=":
				return DIFFERENT;
			case "in":
				return IN;
			default:
				return null;
		}
	}
}
