<?php
/**
 */

namespace fabula\condition;

use \php\Boot;

class VariableFloat extends Variable {
	/**
	 * @param string $id
	 * @param string $startingValue
	 * 
	 * @return void
	 */
	public function __construct ($id, $startingValue) {
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/VariableFloat.hx:9: characters 3-34
		parent::__construct($id, EVariableType::FLOAT(), $startingValue);
	}

	/**
	 * @param string $value
	 * 
	 * @return float
	 */
	public function convert ($value) {
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/VariableFloat.hx:23: characters 3-31
		return \Std::parseFloat($value);
	}

	/**
	 * @param string $value
	 * 
	 * @return bool
	 */
	public function set ($value) {
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/VariableFloat.hx:14: characters 3-25
		$temp = $this->value;
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/VariableFloat.hx:15: characters 3-37
		$this->value = \Std::parseFloat($value);
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/VariableFloat.hx:16: lines 16-17
		if (!Boot::equal($temp, $this->value)) {
			#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/VariableFloat.hx:17: characters 4-15
			return true;
		}
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/VariableFloat.hx:18: characters 3-15
		return false;
	}
}

Boot::registerClass(VariableFloat::class, 'fabula.condition.VariableFloat');
