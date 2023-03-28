<?php
/**
 */

namespace fabula\condition;

use \php\Boot;

/**
 * Test if an event has been achieved
 * @author Loudo
 */
class ConditionEvent extends Condition {
	/**
	 * @var string[]|\Array_hx
	 */
	public $_achievedListID;
	/**
	 * @var bool
	 */
	public $_affirmation;

	/**
	 * @param string $condition
	 * @param string[]|\Array_hx $achievedListID
	 * @param bool $affirmation
	 * 
	 * @return void
	 */
	public function __construct ($condition, $achievedListID, $affirmation = true) {
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/ConditionEvent.hx:13: lines 13-17
		if ($affirmation === null) {
			$affirmation = true;
		}
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/ConditionEvent.hx:14: characters 3-29
		$this->_affirmation = $affirmation;
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/ConditionEvent.hx:15: characters 3-35
		$this->_achievedListID = $achievedListID;
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/ConditionEvent.hx:16: characters 3-26
		parent::__construct($condition, EConditionType::EVENT());
	}

	/**
	 * @return bool
	 */
	public function test () {
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/ConditionEvent.hx:21: lines 21-25
		$_g = 0;
		$_g1 = $this->_achievedListID;
		while ($_g < $_g1->length) {
			#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/ConditionEvent.hx:21: characters 8-10
			$id = ($_g1->arr[$_g] ?? null);
			#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/ConditionEvent.hx:21: lines 21-25
			++$_g;
			#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/ConditionEvent.hx:23: lines 23-24
			if ($id === $this->condition) {
				#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/ConditionEvent.hx:24: characters 5-24
				return $this->_affirmation;
			}
		}
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/ConditionEvent.hx:26: characters 3-23
		return !$this->_affirmation;
	}
}

Boot::registerClass(ConditionEvent::class, 'fabula.condition.ConditionEvent');
