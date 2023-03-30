<?php
/**
 * Generated by Haxe 4.1.5
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
		#C:\HaxeLib\fabula/git/src/fabula/condition/Variable.hx:25: characters 3-15
		$this->id = $id;
		#C:\HaxeLib\fabula/git/src/fabula/condition/Variable.hx:26: characters 3-19
		$this->type = $type;
		#C:\HaxeLib\fabula/git/src/fabula/condition/Variable.hx:27: characters 3-21
		$this->set($startingValue);
		#C:\HaxeLib\fabula/git/src/fabula/condition/Variable.hx:28: characters 3-29
		$this->startingValue = $this->value;
		#C:\HaxeLib\fabula/git/src/fabula/condition/Variable.hx:29: characters 3-53
		ConditionFactory::$helperList->data[$this->id] = EConditionType::VARIABLE();
	}

	/**
	 * @param string $operation
	 * @param mixed $targetValue
	 * 
	 * @return bool
	 */
	public function compare ($operation, $targetValue) {
		#C:\HaxeLib\fabula/git/src/fabula/condition/Variable.hx:46: lines 46-54
		if ($operation === "!=") {
			#C:\HaxeLib\fabula/git/src/fabula/condition/Variable.hx:51: characters 5-32
			return !Boot::equal($this->value, $targetValue);
		} else if ($operation === "=") {
			#C:\HaxeLib\fabula/git/src/fabula/condition/Variable.hx:49: characters 5-32
			return Boot::equal($this->value, $targetValue);
		} else {
			#C:\HaxeLib\fabula/git/src/fabula/condition/Variable.hx:53: characters 5-17
			return false;
		}
	}

	/**
	 * @param string $value
	 * 
	 * @return mixed
	 */
	public function convert ($value) {
		#C:\HaxeLib\fabula/git/src/fabula/condition/Variable.hx:40: characters 3-8
		throw Exception::thrown("[Fabula > variable] This method needs to be overriden");
	}

	/**
	 * @return void
	 */
	public function reset () {
		#C:\HaxeLib\fabula/git/src/fabula/condition/Variable.hx:59: characters 3-34
		$this->value = $this->startingValue;
	}

	/**
	 * @param string $value
	 * 
	 * @return bool
	 */
	public function set ($value) {
		#C:\HaxeLib\fabula/git/src/fabula/condition/Variable.hx:34: characters 3-8
		throw Exception::thrown("[Fabula > variable] This method needs to be overriden");
	}

	/**
	 * @return string
	 */
	public function toString () {
		#C:\HaxeLib\fabula/git/src/fabula/condition/Variable.hx:64: characters 3-50
		return "[var " . ($this->id??'null') . " : v:" . (\Std::string($this->value)??'null') . ", d:" . (\Std::string($this->startingValue)??'null') . "]";
	}

	/**
	 * @return string
	 */
	public function toXMLString () {
		#C:\HaxeLib\fabula/git/src/fabula/condition/Variable.hx:69: characters 3-68
		return "<variable id=\"" . ($this->id??'null') . "\" type=\"" . (\Std::string($this->type)??'null') . "\" value=\"" . (\Std::string($this->startingValue)??'null') . "\"/>";
	}

	public function __toString() {
		return $this->toString();
	}
}

Boot::registerClass(Variable::class, 'fabula.condition.Variable');
