package fabula.condition;

/**
 * Array of variables.
 * @author Loudo
 */
@:forward(push, pop, length, indexOf)
abstract VariableCollection(Array<Variable<Dynamic>>)
{
	public inline function new()
	{
		this = [];
	}

	@:arrayAccess
	inline function getUserByIndex(id:Int)
	{
		return this[id];
	}

	public function get(id:String)
	{
		for (vari in this)
		{
			if (vari.id == id)
				return vari;
		}
		return null;
	}
}
