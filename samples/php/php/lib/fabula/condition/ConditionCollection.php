<?php
/**
 */

namespace fabula\condition;

use \php\Boot;

/**
 * Test a collection of conditions.
 * @author Loudo
 */
class ConditionCollection extends Condition {
	/**
	 * @return void
	 */
	public function __construct () {
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/ConditionCollection.hx:11: characters 3-17
		$this->condition = new \Array_hx();
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/ConditionCollection.hx:12: characters 3-25
		parent::__construct($this->condition, null);
	}

	/**
	 * @param Condition $element
	 * 
	 * @return void
	 */
	public function add ($element) {
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/ConditionCollection.hx:17: characters 3-26
		$_this = $this->condition;
		$_this->arr[$_this->length++] = $element;
	}

	/**
	 * @param EConditionType[]|\Array_hx $types
	 * 
	 * @return bool
	 */
	public function hasOnlyTypes ($types) {
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/ConditionCollection.hx:42: lines 42-54
		$_g = 0;
		$_g1 = $this->condition;
		while ($_g < $_g1->length) {
			#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/ConditionCollection.hx:42: characters 8-12
			$cond = ($_g1->arr[$_g] ?? null);
			#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/ConditionCollection.hx:42: lines 42-54
			++$_g;
			#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/ConditionCollection.hx:44: lines 44-53
			if ($cond->type === null) {
				#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/ConditionCollection.hx:46: characters 5-44
				$cc = $cond;
				#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/ConditionCollection.hx:47: lines 47-48
				if (!$cc->hasOnlyTypes($types)) {
					#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/ConditionCollection.hx:48: characters 6-18
					return false;
				}
			} else if ($types->indexOf($cond->type) === -1) {
				#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/ConditionCollection.hx:52: characters 6-18
				return false;
			}
		}
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/ConditionCollection.hx:55: characters 3-14
		return true;
	}

	/**
	 * @param EConditionType $type
	 * 
	 * @return bool
	 */
	public function hasType ($type) {
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/ConditionCollection.hx:32: lines 32-36
		$_g = 0;
		$_g1 = $this->condition;
		while ($_g < $_g1->length) {
			#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/ConditionCollection.hx:32: characters 8-12
			$cond = ($_g1->arr[$_g] ?? null);
			#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/ConditionCollection.hx:32: lines 32-36
			++$_g;
			#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/ConditionCollection.hx:34: lines 34-35
			if ($cond->type === $type) {
				#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/ConditionCollection.hx:35: characters 5-16
				return true;
			}
		}
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/ConditionCollection.hx:37: characters 3-15
		return false;
	}

	/**
	 * @return bool
	 */
	public function test () {
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/ConditionCollection.hx:22: lines 22-26
		$_g = 0;
		$_g1 = $this->condition;
		while ($_g < $_g1->length) {
			#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/ConditionCollection.hx:22: characters 8-12
			$cond = ($_g1->arr[$_g] ?? null);
			#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/ConditionCollection.hx:22: lines 22-26
			++$_g;
			#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/ConditionCollection.hx:24: lines 24-25
			if (!$cond->test()) {
				#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/ConditionCollection.hx:25: characters 5-17
				return false;
			}
		}
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/ConditionCollection.hx:27: characters 3-14
		return true;
	}
}

Boot::registerClass(ConditionCollection::class, 'fabula.condition.ConditionCollection');
