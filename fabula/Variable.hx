package fabula;

class Variable
{
	public var id:String;
	public var type:String;
	public var startingValue:String;
	public var value:String;

	public function new(id:String, type:String, startingValue:String)
	{
		this.id = id;
		this.type = type;
		this.startingValue = startingValue;
		this.value = this.startingValue;
	}

	public function reset()
	{
		this.value = this.startingValue;
	}
}
