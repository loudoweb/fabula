package fabula.condition;

/**
 * OR test. Return true if at least one condition return true
 * @author Loudo
 */
class ConditionOr extends ConditionCollection
{
	public function new()
	{
		super();
	}

	override public function test():Bool
	{
		for (cond in condition)
		{
			if (cond.test())
				return true;
		}
		return false;
	}
}
