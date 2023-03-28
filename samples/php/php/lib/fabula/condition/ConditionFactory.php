<?php
/**
 */

namespace fabula\condition;

use \php\Boot;
use \haxe\Exception;
use \fabula\Fabula;
use \php\_Boot\HxString;
use \haxe\ds\StringMap;

/**
 * Default factory to build condition. Include event & variable event conditions.
 */
class ConditionFactory {
	/**
	 * @var StringMap
	 *
	 * Map all data to a type of Condition (character, item, skill...)
	 */
	static public $helperList;

	/**
	 * @var Fabula
	 */
	public $fabula;

	/**
	 * @param Fabula $fabula
	 * 
	 * @return void
	 */
	public function __construct ($fabula) {
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/ConditionFactory.hx:20: characters 3-23
		$this->fabula = $fabula;
	}

	/**
	 * @param ConditionCollection $collection
	 * @param string $value
	 * 
	 * @return void
	 */
	public function addToCollection ($collection, $value) {
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/ConditionFactory.hx:70: characters 3-42
		$negation = HxString::indexOf($value, "!") === 0;
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/ConditionFactory.hx:71: lines 71-72
		if ($negation) {
			#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/ConditionFactory.hx:72: characters 12-27
			$value = \mb_substr($value, 1, null);
		}
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/ConditionFactory.hx:74: characters 3-31
		$vdec = HxString::split($value, "=");
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/ConditionFactory.hx:75: characters 3-21
		$match = $value;
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/ConditionFactory.hx:76: lines 76-80
		if ($vdec->length > 1) {
			#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/ConditionFactory.hx:78: characters 4-19
			$value = ($vdec->arr[0] ?? null);
			#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/ConditionFactory.hx:79: characters 4-19
			$match = ($vdec->arr[1] ?? null);
		}
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/ConditionFactory.hx:82: lines 82-97
		if (\array_key_exists($value, ConditionFactory::$helperList->data)) {
			#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/ConditionFactory.hx:84: characters 12-33
			$_g = (ConditionFactory::$helperList->data[$value] ?? null);
			#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/ConditionFactory.hx:84: lines 84-91
			if ($_g === null) {
				#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/ConditionFactory.hx:91: characters 6-11
				throw Exception::thrown("[Fabula > Condition] To use other condition type, please override ConditionFactory class and create a Condition class for this type");
			} else {
				#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/ConditionFactory.hx:84: characters 12-33
				$__hx__switch = ($_g->index);
				if ($__hx__switch === 0) {
					#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/ConditionFactory.hx:87: characters 6-81
					$collection->add(new ConditionEvent($value, $this->fabula->achievedListID, !$negation));
				} else if ($__hx__switch === 1) {
					#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/ConditionFactory.hx:89: characters 6-83
					$collection->add(new ConditionVariable($value, $match, Boot::getInstanceClosure($this->fabula, 'getVar'), !$negation));
				} else {
					#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/ConditionFactory.hx:91: characters 6-11
					throw Exception::thrown("[Fabula > Condition] To use other condition type, please override ConditionFactory class and create a Condition class for this type");
				}
			}
		} else {
			#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/ConditionFactory.hx:96: characters 4-79
			$collection->add(new ConditionEvent($value, $this->fabula->achievedListID, !$negation));
		}
	}

	/**
	 * Creates a collection of conditions for an event or a choice. That could be also use outside the event/dialogue system.
	 * @param raw String from xml that describes the condition
	 * @return ConditionCollection
	 * 
	 * @param string $raw
	 * 
	 * @return ConditionCollection
	 */
	public function create ($raw) {
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/ConditionFactory.hx:30: characters 3-28
		$values = null;
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/ConditionFactory.hx:31: characters 3-31
		$subValues = null;
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/ConditionFactory.hx:33: lines 33-63
		if ($raw !== "") {
			#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/ConditionFactory.hx:35: characters 4-47
			$collection = new ConditionCollection();
			#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/ConditionFactory.hx:38: lines 38-41
			if (HxString::indexOf($raw, ",") !== -1) {
				#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/ConditionFactory.hx:39: characters 5-28
				$values = HxString::split($raw, ",");
			} else {
				#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/ConditionFactory.hx:41: characters 5-28
				$values = HxString::split($raw, "&");
			}
			#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/ConditionFactory.hx:43: lines 43-60
			$_g = 0;
			while ($_g < $values->length) {
				#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/ConditionFactory.hx:43: characters 9-14
				$value = ($values->arr[$_g] ?? null);
				#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/ConditionFactory.hx:43: lines 43-60
				++$_g;
				#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/ConditionFactory.hx:45: lines 45-59
				if (HxString::indexOf($value, "|") !== -1) {
					#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/ConditionFactory.hx:48: characters 6-45
					$or = new ConditionOr();
					#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/ConditionFactory.hx:49: characters 6-34
					$subValues = HxString::split($value, "|");
					#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/ConditionFactory.hx:50: lines 50-53
					$_g1 = 0;
					while ($_g1 < $subValues->length) {
						#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/ConditionFactory.hx:50: characters 11-19
						$subValue = ($subValues->arr[$_g1] ?? null);
						#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/ConditionFactory.hx:50: lines 50-53
						++$_g1;
						#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/ConditionFactory.hx:52: characters 7-36
						$this->addToCollection($or, $subValue);
					}
					#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/ConditionFactory.hx:54: characters 6-24
					$collection->add($or);
				} else {
					#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/ConditionFactory.hx:58: characters 6-40
					$this->addToCollection($collection, $value);
				}
			}
			#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/ConditionFactory.hx:62: characters 4-21
			return $collection;
		}
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/ConditionFactory.hx:64: characters 3-14
		return null;
	}

	/**
	 * @internal
	 * @access private
	 */
	static public function __hx__init ()
	{
		static $called = false;
		if ($called) return;
		$called = true;


		self::$helperList = new StringMap();
	}
}

Boot::registerClass(ConditionFactory::class, 'fabula.condition.ConditionFactory');
ConditionFactory::__hx__init();
