package fabula;

import fabula.condition.ConditionCollection;
import fabula.condition.ConditionFactory;

/**
 * ...
 * @author Loudo
 */
class Choice
{
	public var id:String;

	public var text:String;

	/**
	 * If you have different kind of choices, and you need to display an information or a particular icon to help the player (choice leading to an attack or a purchase in a shop)
	 */
	public var type:String;

	/**
	 * Resulting event when the player chooses this choice
	 */
	public var target:String;

	/**
	 * If a condition is set, the choice will appear only if criteria is met
	 */
	public var condition:ConditionCollection;

	/**
	 * A choice can exit the sequence
	 */
	public var isExit:Bool;

	public function new(id:String, text:String, type:String, ?condition:ConditionCollection, ?target:String,
			?exit:Bool = false)
	{
		this.id = id;
		this.text = text != "" && text != null ? text : id;
		this.type = type;
		this.target = target;
		this.condition = condition;
		this.isExit = exit;
		ConditionFactory.helperList.set(this.id, EVENT);
		// TODO variables
	}
}
