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

		var vdec = value.split("=");
		var match = value;
		if (vdec.length > 1)
		{
			value = vdec[0];
			match = vdec[1];
		}

		if (helperList.exists(value))
		{
			switch (helperList.get(value))
			{
				case EVENT:
					collection.add(new ConditionEvent(value, fabula.achievedListID, !negation));
				case VARIABLE:
					collection.add(new ConditionVariable(value, match, fabula.getVar, !negation));
				default:
					throw "[Fabula > Condition] To use other condition type, please override ConditionFactory class and create a Condition class for this type";
			}
		}
	}
}
