package fabula;

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
	public var condition:String;

	/**
	 * If there is no outcome set, it should exit the event, or select the next event in the sequence
	 */
	public var isExit:Bool;

	public function new(id:String, text:String, type:String, ?condition:String, ?target:String, ?exit:Bool = false)
	{
		this.id = id;
		this.text = text != "" && text != null ? text : id;
		this.type = type;
		this.target = target;
		this.condition = condition;
		this.isExit = exit;
	}
}
