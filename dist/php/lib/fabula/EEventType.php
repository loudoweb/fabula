<?php
/**
 */

namespace fabula;

use \php\Boot;
use \php\_Boot\HxEnum;

class EEventType extends HxEnum {
	/**
	 * @return EEventType
	 */
	static public function QUEST () {
		static $inst = null;
		if (!$inst) $inst = new EEventType('QUEST', 0, []);
		return $inst;
	}

	/**
	 * @return EEventType
	 */
	static public function RANDOM_ENCOUNTER () {
		static $inst = null;
		if (!$inst) $inst = new EEventType('RANDOM_ENCOUNTER', 1, []);
		return $inst;
	}

	/**
	 * @return EEventType
	 */
	static public function SCENE () {
		static $inst = null;
		if (!$inst) $inst = new EEventType('SCENE', 2, []);
		return $inst;
	}

	/**
	 * Returns array of (constructorIndex => constructorName)
	 *
	 * @return string[]
	 */
	static public function __hx__list () {
		return [
			0 => 'QUEST',
			1 => 'RANDOM_ENCOUNTER',
			2 => 'SCENE',
		];
	}

	/**
	 * Returns array of (constructorName => parametersCount)
	 *
	 * @return int[]
	 */
	static public function __hx__paramsCount () {
		return [
			'QUEST' => 0,
			'RANDOM_ENCOUNTER' => 0,
			'SCENE' => 0,
		];
	}
}

Boot::registerClass(EEventType::class, 'fabula.EEventType');
