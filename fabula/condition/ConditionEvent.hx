package fabula.condition;

/**
 * Test if an event has been achieved
 * @author Loudo
 */
class ConditionEvent extends Condition<String>
{
	var _achievedListID:Array<String>;
	var _affirmation:Bool;

	public function new(condition:String, achievedListID:Array<String>, affirmation:Bool = true)
	{
		_affirmation = affirmation;
		_achievedListID = achievedListID;
		super(condition, EVENT);
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
