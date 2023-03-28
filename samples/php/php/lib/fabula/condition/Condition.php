<?php
/**
 */

namespace fabula\condition;

use \php\Boot;
use \haxe\Exception;

/**
 * Base class to test a condition
 * @author Loudo
 */
class Condition {
	/**
	 * @var mixed
	 */
	public $condition;
	/**
	 * @var EConditionType
	 */
	public $type;

	/**
	 * @param mixed $condition
	 * @param EConditionType $type
	 * 
	 * @return void
	 */
	public function __construct ($condition, $type) {
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/Condition.hx:14: characters 3-29
		$this->condition = $condition;
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/Condition.hx:15: characters 3-19
		$this->type = $type;
	}

	/**
	 * @return bool
	 */
	public function test () {
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/Condition.hx:20: characters 3-8
		throw Exception::thrown("[Condition] Override test function");
	}
}

Boot::registerClass(Condition::class, 'fabula.condition.Condition');
