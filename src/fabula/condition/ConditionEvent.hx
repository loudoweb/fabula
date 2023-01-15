package fabula.condition;

/**
 * Test if an event has been achieved
 * @author Loudo
 */
class ConditionEvent extends Condition<String>
{
	var _achievedListID:Array<String>;

	public function new(condition:String, achievedListID:Array<String>, affirmation:Bool = true)
	{
		_achievedListID = achievedListID;
		super(condition, EVENT, affirmation);
	}

	override public function test():Bool
	{
		for (id in _achievedListID)
		{
			if (id == condition)
				return _affirmation;
		}
		return !_affirmation;
	}
}
