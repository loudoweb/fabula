package fabula.condition;

/**
 * Test a value of a variable
 * @author Loudo
 */
class ConditionVariable extends Condition<String>
{
	var _operation:EConditionOp;
	var _targetValue:String;
	var _getVar:String->Variable<Dynamic>;

	public function new(name:String, match:String, getVar:String->Variable<Dynamic>, affirmation:Bool = true)
	{
		super(name, VARIABLE, affirmation);

		_getVar = getVar;
		_operation = match.charAt(0);

		if (_operation != null)
		{
			_targetValue = match.substr(1);
		} else if (!_affirmation)
		{
			_operation = DIFFERENT;
			_targetValue = match;
		} else
		{
			_operation = EQUAL;
			_targetValue = match;
		}
	}

	override public function test():Bool
	{
		var vari = _getVar(condition);
		return vari.compare(_operation, _targetValue);
	}
}
