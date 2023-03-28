<?php
/**
 */

namespace fabula;

use \php\Boot;
use \php\_Boot\HxEnum;

class EPlayingType extends HxEnum {
	/**
	 * @return EPlayingType
	 */
	static public function DRAW () {
		static $inst = null;
		if (!$inst) $inst = new EPlayingType('DRAW', 1, []);
		return $inst;
	}

	/**
	 * @return EPlayingType
	 */
	static public function SEQUENCE () {
		static $inst = null;
		if (!$inst) $inst = new EPlayingType('SEQUENCE', 0, []);
		return $inst;
	}

	/**
	 * Returns array of (constructorIndex => constructorName)
	 *
	 * @return string[]
	 */
	static public function __hx__list () {
		return [
			1 => 'DRAW',
			0 => 'SEQUENCE',
		];
	}

	/**
	 * Returns array of (constructorName => parametersCount)
	 *
	 * @return int[]
	 */
	static public function __hx__paramsCount () {
		return [
			'DRAW' => 0,
			'SEQUENCE' => 0,
		];
	}
}

Boot::registerClass(EPlayingType::class, 'fabula.EPlayingType');
