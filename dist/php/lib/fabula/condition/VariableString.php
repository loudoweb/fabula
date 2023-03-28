<?php
/**
 */

namespace fabula\condition;

use \php\Boot;

class VariableString extends Variable {
	/**
	 * @param string $id
	 * @param string $startingValue
	 * 
	 * @return void
	 */
	public function __construct ($id, $startingValue) {
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/VariableString.hx:9: characters 3-35
		parent::__construct($id, EVariableType::STRING(), $startingValue);
	}

	/**
	 * @param string $value
	 * 
	 * @return string
	 */
	public function convert ($value) {
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/VariableString.hx:23: characters 3-15
		return $value;
	}

	/**
	 * @param string $value
	 * 
	 * @return bool
	 */
	public function set ($value) {
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/VariableString.hx:14: characters 3-32
		$temp = $this->value;
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/VariableString.hx:15: characters 3-21
		$this->value = $value;
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/VariableString.hx:16: lines 16-17
		if ($temp !== $this->value) {
			#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/VariableString.hx:17: characters 4-15
			return true;
		}
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/VariableString.hx:18: characters 3-15
		return false;
	}
}

Boot::registerClass(VariableString::class, 'fabula.condition.VariableString');
