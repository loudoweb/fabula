package fabula.condition;

/**
 * Test a collection of conditions.
 * @author Loudo
 */
class ConditionCollection extends Condition<Array<Condition<Dynamic>>>
{
	public function new()
	{
		condition = [];
		super(condition, null);
	}

	public function add(element:Condition<Dynamic>):Void
	{
		condition.push(element);
	}

	override public function test():Bool
	{
		for (cond in condition)
		{
			if (!cond.test())
				return false;
		}
		return true;
	}

	public function hasType(type:EConditionType)
	{
		for (cond in condition)
		{
			if (cond.type == type)
				return true;
		}
		return false;
	}

	public function hasOnlyTypes(types:Array<EConditionType>)
	{
		for (cond in condition)
		{
			if (cond.type == null)
			{
				var cc:ConditionCollection = cast cond;
				if (!cc.hasOnlyTypes(types))
					return false;
			} else
			{
				if (types.indexOf(cond.type) == -1)
					return false;
			}
		}
		return true;
	}

	#if tools
	override public function toString()
	{
		var str = condition[0].toString();
		for (i in 1...condition.length)
		{
			str += "," + condition[i].toString();
		}
		return str;
	}
	#end
}
