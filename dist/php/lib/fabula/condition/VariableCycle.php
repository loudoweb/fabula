<?php
/**
 * Generated by Haxe 4.1.5
 */

namespace fabula\condition;

use \php\_Boot\HxAnon;
use \php\Boot;
use \haxe\Log;

class VariableCycle extends VariableEnum {
	/**
	 * @param string $id
	 * @param string $startingValue
	 * 
	 * @return void
	 */
	public function __construct ($id, $startingValue) {
		#C:\HaxeLib\fabula/git/src/fabula/condition/VariableCycle.hx:9: characters 3-27
		parent::__construct($id, $startingValue);
		#C:\HaxeLib\fabula/git/src/fabula/condition/VariableCycle.hx:11: characters 3-15
		$this->type = EVariableType::CYCLE();
	}

	/**
	 * @param string $value
	 * 
	 * @return bool
	 */
	public function set ($value) {
		#C:\HaxeLib\fabula/git/src/fabula/condition/VariableCycle.hx:16: characters 3-32
		$temp = $this->value;
		#C:\HaxeLib\fabula/git/src/fabula/condition/VariableCycle.hx:17: characters 3-35
		$index = \Std::parseInt($value);
		#C:\HaxeLib\fabula/git/src/fabula/condition/VariableCycle.hx:18: lines 18-59
		if ($index === null) {
			#C:\HaxeLib\fabula/git/src/fabula/condition/VariableCycle.hx:20: lines 20-47
			if ($value === $this->options->join(",")) {
				#C:\HaxeLib\fabula/git/src/fabula/condition/VariableCycle.hx:23: characters 5-23
				$value = ($this->options->arr[0] ?? null);
			} else if ($value === "+") {
				#C:\HaxeLib\fabula/git/src/fabula/condition/VariableCycle.hx:26: characters 5-49
				$index1 = $this->options->indexOf($this->value) + 1;
				#C:\HaxeLib\fabula/git/src/fabula/condition/VariableCycle.hx:27: lines 27-30
				if ($index1 >= $this->options->length) {
					#C:\HaxeLib\fabula/git/src/fabula/condition/VariableCycle.hx:29: characters 6-15
					$index1 = 0;
				}
				#C:\HaxeLib\fabula/git/src/fabula/condition/VariableCycle.hx:31: characters 5-27
				$value = ($this->options->arr[$index1] ?? null);
			} else if ($value === "-") {
				#C:\HaxeLib\fabula/git/src/fabula/condition/VariableCycle.hx:34: characters 5-49
				$index1 = $this->options->indexOf($this->value) - 1;
				#C:\HaxeLib\fabula/git/src/fabula/condition/VariableCycle.hx:35: lines 35-38
				if ($index1 < 0) {
					#C:\HaxeLib\fabula/git/src/fabula/condition/VariableCycle.hx:37: characters 6-32
					$index1 = $this->options->length - 1;
				}
				#C:\HaxeLib\fabula/git/src/fabula/condition/VariableCycle.hx:39: characters 5-27
				$value = ($this->options->arr[$index1] ?? null);
			} else if ($this->options->indexOf($value) === -1) {
				#C:\HaxeLib\fabula/git/src/fabula/condition/VariableCycle.hx:44: characters 6-11
				(Log::$trace)("[Fabula > Variable] " . ($value??'null') . " not in options of " . ($this->id??'null'), new HxAnon([
					"fileName" => "fabula/condition/VariableCycle.hx",
					"lineNumber" => 44,
					"className" => "fabula.condition.VariableCycle",
					"methodName" => "set",
				]));
				#C:\HaxeLib\fabula/git/src/fabula/condition/VariableCycle.hx:45: characters 6-18
				return false;
			}
			#C:\HaxeLib\fabula/git/src/fabula/condition/VariableCycle.hx:48: characters 4-22
			$this->value = $value;
		} else {
			#C:\HaxeLib\fabula/git/src/fabula/condition/VariableCycle.hx:51: lines 51-57
			if ($index >= $this->options->length) {
				#C:\HaxeLib\fabula/git/src/fabula/condition/VariableCycle.hx:53: characters 5-31
				$index = $this->options->length - 1;
			} else if ($index < 0) {
				#C:\HaxeLib\fabula/git/src/fabula/condition/VariableCycle.hx:56: characters 5-14
				$index = 0;
			}
			#C:\HaxeLib\fabula/git/src/fabula/condition/VariableCycle.hx:58: characters 4-31
			$this->value = ($this->options->arr[$index] ?? null);
		}
		#C:\HaxeLib\fabula/git/src/fabula/condition/VariableCycle.hx:61: lines 61-62
		if ($temp !== $this->value) {
			#C:\HaxeLib\fabula/git/src/fabula/condition/VariableCycle.hx:62: characters 4-15
			return true;
		}
		#C:\HaxeLib\fabula/git/src/fabula/condition/VariableCycle.hx:63: characters 3-15
		return false;
	}
}

Boot::registerClass(VariableCycle::class, 'fabula.condition.VariableCycle');
