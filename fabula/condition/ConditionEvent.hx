package fabula.condition;

/**
 * Test if an event has been achieved
 * @author Loudo
 */
class ConditionEvent extends Condition<String>
{
	var _manager:Fabula;
	var _affirmation:Bool;

	public function new(manager:Fabula, condition:String, affirmation:Bool = true)
	{
		_affirmation = affirmation;
		_manager = manager;
		super(condition, EVENT);
	}

	override public function test():Bool
	{
		for (id in _manager.achievedListID)
		{
			if (id == condition)
				return _affirmation;
		}
		return !_affirmation;
	}
}
