<?php
/**
 */

namespace fabula\condition;

use \php\Boot;
use \fabula\condition\_EConditionOp\EConditionOp_Impl_;

/**
 * Test if a value of a variable
 * @author Loudo
 */
class ConditionVariable extends Condition {
	/**
	 * @var bool
	 */
	public $_affirmation;
	/**
	 * @var \Closure
	 */
	public $_getVar;
	/**
	 * @var string
	 */
	public $_operation;
	/**
	 * @var string
	 */
	public $_targetValue;

	/**
	 * @param string $name
	 * @param string $match
	 * @param \Closure $getVar
	 * @param bool $affirmation
	 * 
	 * @return void
	 */
	public function __construct ($name, $match, $getVar, $affirmation = true) {
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/ConditionVariable.hx:15: lines 15-34
		if ($affirmation === null) {
			$affirmation = true;
		}
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/ConditionVariable.hx:16: characters 3-29
		$this->_affirmation = $affirmation;
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/ConditionVariable.hx:17: characters 3-19
		$this->_getVar = $getVar;
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/ConditionVariable.hx:19: characters 3-31
		$this->_operation = EConditionOp_Impl_::fromString(\mb_substr($match, 0, 1));
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/ConditionVariable.hx:20: lines 20-31
		if ($this->_operation !== null) {
			#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/ConditionVariable.hx:22: characters 4-34
			$this->_targetValue = \mb_substr($match, 1, null);
		} else if (!$this->_affirmation) {
			#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/ConditionVariable.hx:25: characters 4-26
			$this->_operation = "!";
			#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/ConditionVariable.hx:26: characters 4-24
			$this->_targetValue = $match;
		} else {
			#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/ConditionVariable.hx:29: characters 4-22
			$this->_operation = "=";
			#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/ConditionVariable.hx:30: characters 4-24
			$this->_targetValue = $match;
		}
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/ConditionVariable.hx:33: characters 3-24
		parent::__construct($name, EConditionType::VARIABLE());
	}

	/**
	 * @return bool
	 */
	public function test () {
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/ConditionVariable.hx:38: characters 3-33
		$vari = ($this->_getVar)($this->condition);
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/ConditionVariable.hx:39: characters 3-48
		$targetValue = $vari->convert($this->_targetValue);
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/ConditionVariable.hx:40: characters 11-21
		$__hx__switch = ($this->_operation);
		if ($__hx__switch === "!") {
			#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/ConditionVariable.hx:45: characters 5-37
			return $vari->value !== $targetValue;
		} else if ($__hx__switch === "=") {
			#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/ConditionVariable.hx:43: characters 5-37
			return $vari->value === $targetValue;
		} else {
			#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/ConditionVariable.hx:47: characters 5-17
			return false;
		}
	}
}

Boot::registerClass(ConditionVariable::class, 'fabula.condition.ConditionVariable');
