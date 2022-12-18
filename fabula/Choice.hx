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
	 * If you have different kind of choices, and you need to display an information or a particular icon to help the player (choice leading to an attack or a purchase in a shop). Could be also used for feedback
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

	/**
	 * A choice is a clickable element in your game that the player has to click to continue the sequence.
	 * @param id event id
	 * @param text content
	 * @param type information or icon to help the player makes his choice, could be also used for feedback
	 * @param condition condition to display this choice. You can by default use event or choice id.
	 * @param target A target to jump to another event instead of using next event in the sequence.
	 * @param exit Boolean. True to exit the sequence.
	 */
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
