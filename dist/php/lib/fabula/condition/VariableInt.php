<?php
/**
 */

namespace fabula\condition;

use \php\Boot;

class VariableInt extends Variable {
	/**
	 * @param string $id
	 * @param string $startingValue
	 * 
	 * @return void
	 */
	public function __construct ($id, $startingValue) {
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/VariableInt.hx:9: characters 3-32
		parent::__construct($id, EVariableType::INT(), $startingValue);
	}

	/**
	 * @param string $value
	 * 
	 * @return int
	 */
	public function convert ($value) {
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/VariableInt.hx:23: characters 3-29
		return \Std::parseInt($value);
	}

	/**
	 * @param string $value
	 * 
	 * @return bool
	 */
	public function set ($value) {
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/VariableInt.hx:14: characters 3-29
		$temp = $this->value;
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/VariableInt.hx:15: characters 3-35
		$this->value = \Std::parseInt($value);
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/VariableInt.hx:16: lines 16-17
		if ($temp !== $this->value) {
			#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/VariableInt.hx:17: characters 4-15
			return true;
		}
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/VariableInt.hx:18: characters 3-15
		return false;
	}
}

Boot::registerClass(VariableInt::class, 'fabula.condition.VariableInt');
