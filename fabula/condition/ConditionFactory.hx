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

	static public var fabula:Fabula;

	public function new() {}

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
		var affirmation = value.indexOf('!') == 0;
		if (!affirmation)
			value = value.substr(1);
		// TODO find among all existing elements of the game built by xml what kind of condition is it using a helper list?
		if (helperList.exists(value))
		{
			switch (helperList.get(value))
			{
				case EVENT:
					collection.add(new ConditionEvent(value, fabula.achievedListID, affirmation));
				case VARIABLE:
					collection.add(new ConditionVariable(value, null, affirmation)); // TODO
				default:
					throw "[Fabula > Condition] To use other condition type, please override ConditionFactory class and create a Condition class for this type";
			}
		}
	}
}
