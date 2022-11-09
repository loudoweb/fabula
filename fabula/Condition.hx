package fabula;

class Condition
{
	public var id:String;
	public var type:String;
	public var value:String;

	public function new(id:String, type:String, value:String)
	{
		this.id = id;
		this.type = type;
		this.value = value;
	}

	public function test(variable:Variable):Bool
	{
		// TODO
		return variable.value == value;
	}
}
