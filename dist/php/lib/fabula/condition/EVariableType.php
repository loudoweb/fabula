<?php
/**
 */

namespace fabula\condition;

use \php\Boot;
use \php\_Boot\HxEnum;

class EVariableType extends HxEnum {
	/**
	 * @return EVariableType
	 */
	static public function FLOAT () {
		static $inst = null;
		if (!$inst) $inst = new EVariableType('FLOAT', 2, []);
		return $inst;
	}

	/**
	 * @return EVariableType
	 */
	static public function INT () {
		static $inst = null;
		if (!$inst) $inst = new EVariableType('INT', 1, []);
		return $inst;
	}

	/**
	 * @return EVariableType
	 */
	static public function STRING () {
		static $inst = null;
		if (!$inst) $inst = new EVariableType('STRING', 0, []);
		return $inst;
	}

	/**
	 * Returns array of (constructorIndex => constructorName)
	 *
	 * @return string[]
	 */
	static public function __hx__list () {
		return [
			2 => 'FLOAT',
			1 => 'INT',
			0 => 'STRING',
		];
	}

	/**
	 * Returns array of (constructorName => parametersCount)
	 *
	 * @return int[]
	 */
	static public function __hx__paramsCount () {
		return [
			'FLOAT' => 0,
			'INT' => 0,
			'STRING' => 0,
		];
	}
}

Boot::registerClass(EVariableType::class, 'fabula.condition.EVariableType');
