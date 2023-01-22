package fabula.condition;

/**
 * Test if an event has been achieved
 * @author Loudo
 */
class ConditionEvent extends Condition<String>
{
	var _isCompleted:String->Bool;

	public function new(condition:String, isCompleted:String->Bool, affirmation:Bool = true)
	{
		_isCompleted = isCompleted;
		super(condition, EVENT, affirmation);
	}

	override public function test():Bool
	{
		if (_isCompleted(condition))
		{
			return _affirmation;
		}
		return !_affirmation;
	}
}
