<?php
/**
 */

namespace fabula\condition;

use \php\Boot;
use \php\_Boot\HxEnum;

/**
 * Helper to check a data to make appear an story event or not
 * @author Loudo
 */
class EConditionType extends HxEnum {
	/**
	 * @return EConditionType
	 */
	static public function ATTRIBUTS () {
		static $inst = null;
		if (!$inst) $inst = new EConditionType('ATTRIBUTS', 6, []);
		return $inst;
	}

	/**
	 * @param string $type
	 * 
	 * @return EConditionType
	 */
	static public function CUSTOM ($type) {
		return new EConditionType('CUSTOM', 8, [$type]);
	}

	/**
	 * @return EConditionType
	 */
	static public function EVENT () {
		static $inst = null;
		if (!$inst) $inst = new EConditionType('EVENT', 0, []);
		return $inst;
	}

	/**
	 * @return EConditionType
	 */
	static public function HAS_CHARACTER () {
		static $inst = null;
		if (!$inst) $inst = new EConditionType('HAS_CHARACTER', 3, []);
		return $inst;
	}

	/**
	 * @return EConditionType
	 */
	static public function INVENTORY () {
		static $inst = null;
		if (!$inst) $inst = new EConditionType('INVENTORY', 2, []);
		return $inst;
	}

	/**
	 * @return EConditionType
	 */
	static public function IS_CHARACTER () {
		static $inst = null;
		if (!$inst) $inst = new EConditionType('IS_CHARACTER', 4, []);
		return $inst;
	}

	/**
	 * @return EConditionType
	 */
	static public function SKILLS () {
		static $inst = null;
		if (!$inst) $inst = new EConditionType('SKILLS', 7, []);
		return $inst;
	}

	/**
	 * @return EConditionType
	 */
	static public function TRAIT () {
		static $inst = null;
		if (!$inst) $inst = new EConditionType('TRAIT', 5, []);
		return $inst;
	}

	/**
	 * @return EConditionType
	 */
	static public function VARIABLE () {
		static $inst = null;
		if (!$inst) $inst = new EConditionType('VARIABLE', 1, []);
		return $inst;
	}

	/**
	 * Returns array of (constructorIndex => constructorName)
	 *
	 * @return string[]
	 */
	static public function __hx__list () {
		return [
			6 => 'ATTRIBUTS',
			8 => 'CUSTOM',
			0 => 'EVENT',
			3 => 'HAS_CHARACTER',
			2 => 'INVENTORY',
			4 => 'IS_CHARACTER',
			7 => 'SKILLS',
			5 => 'TRAIT',
			1 => 'VARIABLE',
		];
	}

	/**
	 * Returns array of (constructorName => parametersCount)
	 *
	 * @return int[]
	 */
	static public function __hx__paramsCount () {
		return [
			'ATTRIBUTS' => 0,
			'CUSTOM' => 1,
			'EVENT' => 0,
			'HAS_CHARACTER' => 0,
			'INVENTORY' => 0,
			'IS_CHARACTER' => 0,
			'SKILLS' => 0,
			'TRAIT' => 0,
			'VARIABLE' => 0,
		];
	}
}

Boot::registerClass(EConditionType::class, 'fabula.condition.EConditionType');
