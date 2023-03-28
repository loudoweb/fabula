<?php
/**
 */

namespace fabula\condition;

use \php\Boot;
use \haxe\Exception;

class Variable {
	/**
	 * @var string
	 */
	public $id;
	/**
	 * @var mixed
	 */
	public $startingValue;
	/**
	 * @var EVariableType
	 */
	public $type;
	/**
	 * @var mixed
	 */
	public $value;

	/**
	 * @param string $id
	 * @param EVariableType $type
	 * @param string $startingValue
	 * 
	 * @return void
	 */
	public function __construct ($id, $type, $startingValue) {
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/Variable.hx:21: characters 3-15
		$this->id = $id;
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/Variable.hx:22: characters 3-19
		$this->type = $type;
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/Variable.hx:23: characters 3-21
		$this->set($startingValue);
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/Variable.hx:24: characters 3-29
		$this->startingValue = $this->value;
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/Variable.hx:25: characters 3-53
		ConditionFactory::$helperList->data[$this->id] = EConditionType::VARIABLE();
	}

	/**
	 * @param string $value
	 * 
	 * @return mixed
	 */
	public function convert ($value) {
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/Variable.hx:36: characters 3-8
		throw Exception::thrown("[Fabula > variable] This method needs to be overriden");
	}

	/**
	 * @return void
	 */
	public function reset () {
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/Variable.hx:42: characters 3-34
		$this->value = $this->startingValue;
	}

	/**
	 * @param string $value
	 * 
	 * @return bool
	 */
	public function set ($value) {
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/Variable.hx:30: characters 3-8
		throw Exception::thrown("[Fabula > variable] This method needs to be overriden");
	}

	/**
	 * @return string
	 */
	public function toString () {
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/Variable.hx:47: characters 3-50
		return "[var " . ($this->id??'null') . " : v:" . \Std::string($this->value) . ", d:" . \Std::string($this->startingValue) . "]";
	}

	public function __toString() {
		return $this->toString();
	}
}

Boot::registerClass(Variable::class, 'fabula.condition.Variable');
