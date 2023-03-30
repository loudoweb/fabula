<?php
/**
 * Generated by Haxe 4.1.5
 */

namespace fabula\condition;

use \php\_Boot\HxAnon;
use \php\Boot;
use \php\_Boot\HxString;

class VariableFloat extends Variable {
	/**
	 * @param string $id
	 * @param string $startingValue
	 * 
	 * @return void
	 */
	public function __construct ($id, $startingValue) {
		#C:\HaxeLib\fabula/git/src/fabula/condition/VariableFloat.hx:9: characters 3-34
		parent::__construct($id, EVariableType::FLOAT(), $startingValue);
	}

	/**
	 * @param string $operation
	 * @param float $targetValue
	 * 
	 * @return bool
	 */
	public function compare ($operation, $targetValue) {
		#C:\HaxeLib\fabula/git/src/fabula/condition/VariableFloat.hx:59: lines 59-75
		if ($operation === "!=") {
			#C:\HaxeLib\fabula/git/src/fabula/condition/VariableFloat.hx:64: characters 5-32
			return !Boot::equal($this->value, $targetValue);
		} else if ($operation === "<") {
			#C:\HaxeLib\fabula/git/src/fabula/condition/VariableFloat.hx:70: characters 5-31
			return $this->value < $targetValue;
		} else if ($operation === "<=") {
			#C:\HaxeLib\fabula/git/src/fabula/condition/VariableFloat.hx:72: characters 5-32
			return $this->value <= $targetValue;
		} else if ($operation === "=") {
			#C:\HaxeLib\fabula/git/src/fabula/condition/VariableFloat.hx:62: characters 5-32
			return Boot::equal($this->value, $targetValue);
		} else if ($operation === ">") {
			#C:\HaxeLib\fabula/git/src/fabula/condition/VariableFloat.hx:66: characters 5-31
			return $this->value > $targetValue;
		} else if ($operation === ">=") {
			#C:\HaxeLib\fabula/git/src/fabula/condition/VariableFloat.hx:68: characters 5-32
			return $this->value >= $targetValue;
		} else {
			#C:\HaxeLib\fabula/git/src/fabula/condition/VariableFloat.hx:74: characters 5-17
			return false;
		}
	}

	/**
	 * @param string $value
	 * 
	 * @return float
	 */
	public function convert ($value) {
		#C:\HaxeLib\fabula/git/src/fabula/condition/VariableFloat.hx:54: characters 3-31
		return \Std::parseFloat($value);
	}

	/**
	 * @param string $str
	 * 
	 * @return object
	 */
	public function extract ($str) {
		#C:\HaxeLib\fabula/git/src/fabula/condition/VariableFloat.hx:40: characters 3-33
		$operation = \mb_substr($str, 0, 1);
		#C:\HaxeLib\fabula/git/src/fabula/condition/VariableFloat.hx:41: characters 3-22
		$subValue = 0.0;
		#C:\HaxeLib\fabula/git/src/fabula/condition/VariableFloat.hx:42: lines 42-48
		if (($operation === "+") || ($operation === "-")) {
			#C:\HaxeLib\fabula/git/src/fabula/condition/VariableFloat.hx:44: characters 4-47
			$subValue = \Std::parseFloat(HxString::substring($str, 1));
		} else {
			#C:\HaxeLib\fabula/git/src/fabula/condition/VariableFloat.hx:47: characters 4-34
			$subValue = \Std::parseFloat($str);
		}
		#C:\HaxeLib\fabula/git/src/fabula/condition/VariableFloat.hx:49: characters 3-52
		return new HxAnon([
			"operation" => $operation,
			"subValue" => $subValue,
		]);
	}

	/**
	 * @param string $value
	 * 
	 * @return bool
	 */
	public function set ($value) {
		#C:\HaxeLib\fabula/git/src/fabula/condition/VariableFloat.hx:14: characters 3-31
		$temp = $this->value;
		#C:\HaxeLib\fabula/git/src/fabula/condition/VariableFloat.hx:22: characters 9-19
		$_hx_tmp = null;
		#C:\HaxeLib\fabula/git/src/fabula/condition/VariableFloat.hx:16: characters 11-16
		if ($value === "+" || $value === "++") {
			#C:\HaxeLib\fabula/git/src/fabula/condition/VariableFloat.hx:19: characters 5-17
			$this->value++;
		} else if ($value === "-" || $value === "--") {
			#C:\HaxeLib\fabula/git/src/fabula/condition/VariableFloat.hx:21: characters 5-17
			$this->value--;
		} else {
			#C:\HaxeLib\fabula/git/src/fabula/condition/VariableFloat.hx:22: characters 9-19
			$_hx_tmp = $this->extract($value);
			#C:\HaxeLib\fabula/git/src/fabula/condition/VariableFloat.hx:22: characters 23-29
			$result = $_hx_tmp;
			#C:\HaxeLib\fabula/git/src/fabula/condition/VariableFloat.hx:23: characters 13-29
			$__hx__switch = ($result->operation);
			if ($__hx__switch === "+") {
				#C:\HaxeLib\fabula/git/src/fabula/condition/VariableFloat.hx:26: characters 7-36
				$this->value += $result->subValue;
			} else if ($__hx__switch === "-") {
				#C:\HaxeLib\fabula/git/src/fabula/condition/VariableFloat.hx:28: characters 7-36
				$this->value -= $result->subValue;
			} else {
				#C:\HaxeLib\fabula/git/src/fabula/condition/VariableFloat.hx:30: characters 7-35
				$this->value = $result->subValue;
			}
		}
		#C:\HaxeLib\fabula/git/src/fabula/condition/VariableFloat.hx:33: lines 33-34
		if (!Boot::equal($temp, $this->value)) {
			#C:\HaxeLib\fabula/git/src/fabula/condition/VariableFloat.hx:34: characters 4-15
			return true;
		}
		#C:\HaxeLib\fabula/git/src/fabula/condition/VariableFloat.hx:35: characters 3-15
		return false;
	}
}

Boot::registerClass(VariableFloat::class, 'fabula.condition.VariableFloat');
