<?php
/**
 */

namespace fabula;

use \fabula\condition\VariableInt;
use \php\_Boot\HxAnon;
use \fabula\condition\VariableString;
use \php\Boot;
use \haxe\Log;
use \fabula\condition\ConditionCollection;
use \fabula\condition\EVariableType;
use \fabula\condition\Variable;
use \fabula\condition\VariableFloat;

class Sequence {
	/**
	 * @var ConditionCollection
	 */
	public $conditions;
	/**
	 * @var int
	 */
	public $current;
	/**
	 * @var Event[]|\Array_hx
	 */
	public $events;
	/**
	 * @var string
	 */
	public $id;
	/**
	 * @var string
	 */
	public $nextTarget;
	/**
	 * @var int
	 */
	public $numCompleted;
	/**
	 * @var Variable[]|\Array_hx
	 */
	public $variables;

	/**
	 * @param string $id
	 * 
	 * @return void
	 */
	public function __construct ($id) {
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Sequence.hx:25: characters 3-15
		$this->id = $id;
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Sequence.hx:26: characters 3-15
		$this->current = -1;
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Sequence.hx:27: characters 3-19
		$this->numCompleted = 0;
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Sequence.hx:28: characters 3-20
		$this->nextTarget = null;
	}

	/**
	 * @param ConditionCollection $conditions
	 * 
	 * @return void
	 */
	public function addConditions ($conditions) {
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Sequence.hx:33: characters 3-31
		$this->conditions = $conditions;
	}

	/**
	 * @param Event[]|\Array_hx $events
	 * 
	 * @return void
	 */
	public function addSequence ($events) {
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Sequence.hx:53: lines 53-54
		if ($this->events !== null) {
			#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Sequence.hx:54: characters 4-9
			(Log::$trace)("WARNING a new sequence will replace an old sequence", new _HxAnon_Sequence0("fabula/Sequence.hx", 54, "fabula.Sequence", "addSequence"));
		}
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Sequence.hx:55: characters 3-23
		$this->events = $events;
	}

	/**
	 * @param string $id
	 * @param EVariableType $type
	 * @param string $startingValue
	 * 
	 * @return void
	 */
	public function addVariable ($id, $type, $startingValue) {
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Sequence.hx:38: lines 38-39
		if ($this->variables === null) {
			#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Sequence.hx:39: characters 16-40
			$this1 = new \Array_hx();
			#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Sequence.hx:39: characters 4-40
			$this->variables = $this1;
		}
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Sequence.hx:40: lines 40-48
		$__hx__switch = ($type->index);
		if ($__hx__switch === 0) {
			#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Sequence.hx:43: characters 5-58
			$_this = $this->variables;
			$x = new VariableString($id, $startingValue);
			$_this->arr[$_this->length++] = $x;
		} else if ($__hx__switch === 1) {
			#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Sequence.hx:45: characters 5-55
			$_this = $this->variables;
			$x = new VariableInt($id, $startingValue);
			$_this->arr[$_this->length++] = $x;
		} else if ($__hx__switch === 2) {
			#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Sequence.hx:47: characters 5-57
			$_this = $this->variables;
			$x = new VariableFloat($id, $startingValue);
			$_this->arr[$_this->length++] = $x;
		}
	}

	/**
	 * Jump to a specific event (usually because a choice has a specific target event set)
	 * @param index index of the event in the sequence (from save? debug?)
	 * @param id id of the event (choice target)
	 * @return Event
	 * 
	 * @param int $index
	 * @param string $id
	 * 
	 * @return Event
	 */
	public function getEvent ($index = null, $id = null) {
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Sequence.hx:131: lines 131-132
		if ($index === null) {
			#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Sequence.hx:132: characters 4-19
			$index = $this->current;
		}
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Sequence.hx:133: lines 133-145
		if ($id === null) {
			#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Sequence.hx:134: characters 4-26
			return ($this->events->arr[$this->current] ?? null);
		} else {
			#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Sequence.hx:137: characters 14-18
			$_g = 0;
			#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Sequence.hx:137: characters 18-31
			$_g1 = $this->events->length;
			#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Sequence.hx:137: lines 137-144
			while ($_g < $_g1) {
				#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Sequence.hx:137: characters 14-31
				$i = $_g++;
				#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Sequence.hx:139: lines 139-143
				if (($this->events->arr[$i] ?? null)->id === $id) {
					#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Sequence.hx:141: characters 6-17
					$this->current = $i;
					#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Sequence.hx:142: characters 6-22
					return ($this->events->arr[$i] ?? null);
				}
			}
		}
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Sequence.hx:146: characters 3-14
		return null;
	}

	/**
	 * Call this method to get the next method (apply conditions and exit)
	 * @param ignoreExit use internally, don't use
	 * @return Event
	 * 
	 * @param bool $ignoreExit
	 * 
	 * @return Event
	 */
	public function getNextEvent ($ignoreExit = false) {
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Sequence.hx:78: lines 78-121
		if ($ignoreExit === null) {
			$ignoreExit = false;
		}
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Sequence.hx:79: lines 79-87
		if (!$ignoreExit && ($this->current > -1) && ($this->current < $this->events->length)) {
			#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Sequence.hx:81: lines 81-86
			if (($this->events->arr[$this->current] ?? null)->isExit) {
				#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Sequence.hx:83: characters 5-19
				$this->numCompleted++;
				#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Sequence.hx:84: characters 5-10
				(Log::$trace)("sequence completed", new _HxAnon_Sequence0("fabula/Sequence.hx", 84, "fabula.Sequence", "getNextEvent"));
				#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Sequence.hx:85: characters 5-16
				return null;
			}
		}
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Sequence.hx:89: lines 89-119
		if (($this->current + 1) <= $this->events->length) {
			#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Sequence.hx:92: lines 92-103
			if ($this->current >= 0) {
				#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Sequence.hx:94: lines 94-102
				if (($this->nextTarget !== null) && ($this->nextTarget !== "")) {
					#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Sequence.hx:96: characters 6-30
					$target = $this->nextTarget;
					#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Sequence.hx:97: characters 6-23
					$this->nextTarget = null;
					#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Sequence.hx:98: characters 6-29
					return $this->getEvent(null, $target);
				} else if ((($this->events->arr[$this->current] ?? null)->target !== null) && (($this->events->arr[$this->current] ?? null)->target !== "")) {
					#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Sequence.hx:101: characters 6-45
					return $this->getEvent(null, ($this->events->arr[$this->current] ?? null)->target);
				}
			}
			#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Sequence.hx:105: characters 4-13
			$this->current++;
			#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Sequence.hx:106: lines 106-118
			if ($this->current < $this->events->length) {
				#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Sequence.hx:108: characters 5-37
				$nextEvent = ($this->events->arr[$this->current] ?? null);
				#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Sequence.hx:109: lines 109-113
				if ($nextEvent->testConditions()) {
					#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Sequence.hx:111: characters 6-22
					return $nextEvent;
				} else {
					#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Sequence.hx:113: characters 6-31
					return $this->getNextEvent(true);
				}
			} else {
				#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Sequence.hx:116: characters 5-19
				$this->numCompleted++;
				#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Sequence.hx:117: characters 5-10
				(Log::$trace)("sequence completed", new _HxAnon_Sequence0("fabula/Sequence.hx", 117, "fabula.Sequence", "getNextEvent"));
			}
		}
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Sequence.hx:120: characters 3-14
		return null;
	}

	/**
	 * @return void
	 */
	public function start () {
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Sequence.hx:60: characters 3-15
		$this->current = -1;
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Sequence.hx:61: characters 3-20
		$this->nextTarget = null;
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Sequence.hx:63: lines 63-69
		if ($this->variables !== null) {
			#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Sequence.hx:65: characters 14-18
			$_g = 0;
			#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Sequence.hx:65: characters 18-34
			$_g1 = $this->variables->length;
			#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Sequence.hx:65: lines 65-68
			while ($_g < $_g1) {
				#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Sequence.hx:65: characters 14-34
				$i = $_g++;
				#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Sequence.hx:67: characters 5-25
				($this->variables->arr[$i] ?? null)->reset();
			}
		}
	}
}

class _HxAnon_Sequence0 extends HxAnon {
	function __construct($fileName, $lineNumber, $className, $methodName) {
		$this->fileName = $fileName;
		$this->lineNumber = $lineNumber;
		$this->className = $className;
		$this->methodName = $methodName;
	}
}

Boot::registerClass(Sequence::class, 'fabula.Sequence');
