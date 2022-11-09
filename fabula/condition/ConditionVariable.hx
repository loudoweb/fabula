package fabula.condition;

/**
 * Test if a value of a variable
 * @author Loudo
 */
class ConditionVariable extends Condition<String>
{
	var _getVar:String->Variable<Dynamic>;
	var _affirmation:Bool;

	public function new(condition:String, getVar:String->Variable<Dynamic>, affirmation:Bool = true)
	{
		_affirmation = affirmation;
		_getVar = getVar;
		super(condition, VARIABLE);
	}

	override public function test():Bool
	{
		var vari = _getVar(condition);
		return true;
	}
}
