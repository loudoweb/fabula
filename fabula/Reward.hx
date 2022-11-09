package fabula;

import haxe.xml.Access;

/**
 * ...
 * @author Loudo
 */
class Reward
{
	public var type:String;
	public var value:String;
	public var target:String;

	public function new(type:String, value:String, target:String)
	{
		this.type = type;
		this.value = value;
		this.target = target;
	}
}
