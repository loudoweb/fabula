<?php
/**
 */

namespace fabula\condition;

use \php\Boot;

/**
 * OR test. Return true if at least one condition return true
 * @author Loudo
 */
class ConditionOr extends ConditionCollection {
	/**
	 * @return void
	 */
	public function __construct () {
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/ConditionOr.hx:11: characters 3-10
		parent::__construct();
	}

	/**
	 * @return bool
	 */
	public function test () {
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/ConditionOr.hx:16: lines 16-20
		$_g = 0;
		$_g1 = $this->condition;
		while ($_g < $_g1->length) {
			#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/ConditionOr.hx:16: characters 8-12
			$cond = ($_g1->arr[$_g] ?? null);
			#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/ConditionOr.hx:16: lines 16-20
			++$_g;
			#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/ConditionOr.hx:18: lines 18-19
			if ($cond->test()) {
				#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/ConditionOr.hx:19: characters 5-16
				return true;
			}
		}
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/ConditionOr.hx:21: characters 3-15
		return false;
	}
}

Boot::registerClass(ConditionOr::class, 'fabula.condition.ConditionOr');
