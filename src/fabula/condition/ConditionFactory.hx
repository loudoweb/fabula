package fabula.condition;

import haxe.ds.StringMap;

/**
 * Default factory to build condition. Include event & variable event conditions.
 */
class ConditionFactory
{
	/**
	 * 
	 * Map all data to a type of Condition (character, item, skill...)
	 */
	static public var helperList = new StringMap<EConditionType>();

	static public var regexp:EReg = ~/([a-zA-Z0-9_-]+)(=|!=|>=|<=|<|>|\(in:)?([a-zA-Z0-9_-]*)/g;

	public var fabula:Fabula;

	public function new(fabula:Fabula)
	{
		this.fabula = fabula;
	}

	/**
	 * Creates a collection of conditions for an event or a choice. That could be also use outside the event/dialogue system.
	 * @param raw String from xml that describes the condition
	 * @return ConditionCollection
	 */
	public function create(raw:String):ConditionCollection
	{
		var values:Array<String>;
		var subValues:Array<String>;

		if (raw != "")
		{
			var collection = new ConditionCollection();

			// allow alternative for AND operation because & character is invalid in xml attribute
			if (raw.indexOf(",") != -1)
				values = raw.split(",");
			else
				values = raw.split("&");

			for (value in values)
			{
				if (value.indexOf("|") != -1)
				{
					// handle OR condition
					var or:ConditionOr = new ConditionOr();
					subValues = value.split("|");
					for (subValue in subValues)
					{
						addToCollection(or, subValue);
					}
					collection.add(or);
				} else
				{
					// handle AND condition
					addToCollection(collection, value);
				}
			}

			return collection;
		}
		return null;
	}

	function addToCollection(collection:ConditionCollection, value:String):Void
	{
		// handle negative
		var negation = value.indexOf('!') == 0;
		if (negation)
			value = value.substr(1);

		var hasMatch = regexp.match(value);
		var match:Null<Dynamic> = null;
		var operation:Null<String> = null;
		if (hasMatch)
		{
			value = regexp.matched(1);
			operation = regexp.matched(2);
			match = regexp.matched(3);
		}

		if (match == "" || match == null)
		{
			operation = "=";
			match = true;
		} else if (operation == "(in:")
		{
			operation = "in";
			var temp = value;
			value = match;
			match = temp;
		}

		if (helperList.exists(value))
		{
			switch (helperList.get(value))
			{
				case EVENT:
					collection.add(new ConditionEvent(value, fabula.achievedListID, !negation));
				case VARIABLE:
					collection.add(new ConditionVariable(value, operation, match, fabula.getVar, !negation));
				default:
					throw "[Fabula > Condition] To use other condition type, please override ConditionFactory class and create a Condition class for this type";
			}
		} else
		{
			// if condition doesn't exist, we use ConditionEvent by default
			collection.add(new ConditionEvent(value, fabula.achievedListID, !negation));
		}
	}
}
