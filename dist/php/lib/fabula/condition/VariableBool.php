<?php
/**
 * Generated by Haxe 4.1.5
 */

namespace fabula\condition;

use \php\Boot;

class VariableBool extends Variable {
	/**
	 * @param string $id
	 * @param string $startingValue
	 * 
	 * @return void
	 */
	public function __construct ($id, $startingValue) {
		#C:\HaxeLib\fabula/git/src/fabula/condition/VariableBool.hx:9: characters 3-33
		parent::__construct($id, EVariableType::BOOL(), $startingValue);
	}

	/**
	 * @param string $value
	 * 
	 * @return bool
	 */
	public function convert ($value) {
		#C:\HaxeLib\fabula/git/src/fabula/condition/VariableBool.hx:23: characters 10-41
		if ($value !== "true") {
			#C:\HaxeLib\fabula/git/src/fabula/condition/VariableBool.hx:23: characters 29-41
			return $value === "1";
		} else {
			#C:\HaxeLib\fabula/git/src/fabula/condition/VariableBool.hx:23: characters 10-41
			return true;
		}
	}

	/**
	 * @param string $value
	 * 
	 * @return bool
	 */
	public function set ($value) {
		#C:\HaxeLib\fabula/git/src/fabula/condition/VariableBool.hx:14: characters 3-25
		$temp = $this->value;
		#C:\HaxeLib\fabula/git/src/fabula/condition/VariableBool.hx:15: characters 3-47
		$this->value = ($value === "true") || ($value === "1");
		#C:\HaxeLib\fabula/git/src/fabula/condition/VariableBool.hx:16: lines 16-17
		if ($temp !== $this->value) {
			#C:\HaxeLib\fabula/git/src/fabula/condition/VariableBool.hx:17: characters 4-15
			return true;
		}
		#C:\HaxeLib\fabula/git/src/fabula/condition/VariableBool.hx:18: characters 3-15
		return false;
	}
}

Boot::registerClass(VariableBool::class, 'fabula.condition.VariableBool');
