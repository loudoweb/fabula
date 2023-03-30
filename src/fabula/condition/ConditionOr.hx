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

	#if tools
	override public function toString()
	{
		var str = condition[0].toString();
		for (i in 1...condition.length)
		{
			str += "|" + condition[i].toString();
		}
		return str;
	}
	#end
}
