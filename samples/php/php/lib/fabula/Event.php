<?php
/**
 */

namespace fabula;

use \php\Boot;
use \fabula\condition\ConditionCollection;
use \fabula\condition\EConditionType;
use \fabula\condition\ConditionFactory;

class Event {
	/**
	 * @var Choice[]|\Array_hx
	 */
	public $_cacheChoices;
	/**
	 * @var Choice[]|\Array_hx
	 * Choices are contained inside events.
	 */
	public $choices;
	/**
	 * @var ConditionCollection
	 */
	public $conditions;
	/**
	 * @var int
	 * For statistic purpose or to avoid picking up too many time this event
	 */
	public $count;
	/**
	 * @var string
	 * Could be use to set position of the camera, the weather, etc.
	 */
	public $environment;
	/**
	 * @var string
	 * Automatically generated if empty
	 * It can be used to display a specific event, redirect from a choice...
	 * It should match the name of your audio file if any.
	 */
	public $id;
	/**
	 * @var bool
	 * Determine if this event should end a sequence
	 */
	public $isExit;
	/**
	 * @var string
	 * Could be use to set the listeners and their poses if needed
	 */
	public $listeners;
	/**
	 * @var bool
	 * Can be played only once
	 */
	public $once;
	/**
	 * @var string
	 * Could be use to set the speaker and his pose if needed
	 */
	public $speaker;
	/**
	 * @var string
	 * Optionnal target
	 */
	public $target;
	/**
	 * @var string
	 * This is optional since we could get a localized text using the id
	 */
	public $text;
	/**
	 * @var int
	 * Weight for randomness
	 */
	public $weight;

	/**
	 *
	 * @param id id of the event
	 * @param text text of the event
	 * @param once Can be played only once
	 * 
	 * @param string $id
	 * @param string $text
	 * @param ConditionCollection $conditions
	 * @param bool $isExit
	 * @param int $weight
	 * @param bool $once
	 * @param string $speaker
	 * @param string $listeners
	 * @param string $environment
	 * @param string $target
	 * 
	 * @return void
	 */
	public function __construct ($id, $text, $conditions = null, $isExit = false, $weight = 1, $once = false, $speaker = null, $listeners = null, $environment = null, $target = null) {
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Event.hx:77: lines 77-93
		if ($isExit === null) {
			$isExit = false;
		}
		if ($weight === null) {
			$weight = 1;
		}
		if ($once === null) {
			$once = false;
		}
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Event.hx:78: characters 3-15
		$this->id = $id;
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Event.hx:79: characters 3-19
		$this->text = $text;
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Event.hx:80: characters 3-31
		$this->conditions = $conditions;
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Event.hx:82: characters 3-23
		$this->isExit = $isExit;
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Event.hx:83: characters 3-19
		$this->once = $once;
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Event.hx:84: characters 3-17
		$this->count = 0;
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Event.hx:86: characters 3-25
		$this->speaker = $speaker;
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Event.hx:87: characters 3-29
		$this->listeners = $listeners;
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Event.hx:88: characters 3-33
		$this->environment = $environment;
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Event.hx:90: characters 3-23
		$this->target = $target;
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Event.hx:92: characters 3-50
		ConditionFactory::$helperList->data[$this->id] = EConditionType::EVENT();
	}

	/**
	 * @param Choice $choice
	 * 
	 * @return void
	 */
	public function addChoice ($choice) {
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Event.hx:147: lines 147-151
		if ($this->choices === null) {
			#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Event.hx:149: characters 4-16
			$this->choices = new \Array_hx();
			#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Event.hx:150: characters 4-22
			$this->_cacheChoices = new \Array_hx();
		}
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Event.hx:152: characters 3-23
		$_this = $this->choices;
		$_this->arr[$_this->length++] = $choice;
	}

	/**
	 * @return Choice[]|\Array_hx
	 */
	public function getChoices () {
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Event.hx:97: characters 3-21
		$this->_cacheChoices = new \Array_hx();
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Event.hx:98: lines 98-105
		if ($this->choices !== null) {
			#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Event.hx:100: characters 14-18
			$_g = 0;
			#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Event.hx:100: characters 18-32
			$_g1 = $this->choices->length;
			#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Event.hx:100: lines 100-104
			while ($_g < $_g1) {
				#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Event.hx:100: characters 14-32
				$i = $_g++;
				#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Event.hx:102: lines 102-103
				if ((($this->choices->arr[$i] ?? null)->condition === null) || ($this->choices->arr[$i] ?? null)->condition->test()) {
					#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Event.hx:103: characters 6-36
					$_this = $this->_cacheChoices;
					$x = ($this->choices->arr[$i] ?? null);
					$_this->arr[$_this->length++] = $x;
				}
			}
		}
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Event.hx:107: lines 107-116
		if ($this->_cacheChoices->length === 0) {
			#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Event.hx:109: lines 109-115
			if ($this->isExit) {
				#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Event.hx:111: characters 5-76
				$_this = $this->_cacheChoices;
				$x = new Choice("EXIT", "Quitter", "quit", null, $this->target, true);
				$_this->arr[$_this->length++] = $x;
			} else {
				#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Event.hx:114: characters 5-80
				$_this = $this->_cacheChoices;
				$x = new Choice("CONTINUE", "Continuer", "continue", null, $this->target);
				$_this->arr[$_this->length++] = $x;
			}
		}
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Event.hx:117: characters 3-23
		return $this->_cacheChoices;
	}

	/**
	 * @param string $id
	 * @param int $index
	 * @param bool $selectFromAll
	 * 
	 * @return Choice
	 */
	public function selectChoice ($id = null, $index = null, $selectFromAll = false) {
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Event.hx:121: lines 121-136
		if ($selectFromAll === null) {
			$selectFromAll = false;
		}
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Event.hx:122: characters 3-62
		$_choiceArray = ($selectFromAll ? $this->choices : $this->_cacheChoices);
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Event.hx:123: lines 123-134
		if ($_choiceArray !== null) {
			#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Event.hx:125: lines 125-133
			if ($id !== null) {
				#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Event.hx:127: characters 15-19
				$_g = 0;
				#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Event.hx:127: characters 19-38
				$_g1 = $_choiceArray->length;
				#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Event.hx:127: lines 127-131
				while ($_g < $_g1) {
					#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Event.hx:127: characters 15-38
					$i = $_g++;
					#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Event.hx:129: lines 129-130
					if (($_choiceArray->arr[$i] ?? null)->id === $id) {
						#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Event.hx:130: characters 7-29
						return ($_choiceArray->arr[$i] ?? null);
					}
				}
			} else if ($index !== null) {
				#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Event.hx:133: characters 5-31
				return ($_choiceArray->arr[$index] ?? null);
			}
		}
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Event.hx:135: characters 3-14
		return null;
	}

	/**
	 * @return bool
	 */
	public function testConditions () {
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Event.hx:140: lines 140-141
		if ($this->conditions === null) {
			#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Event.hx:141: characters 4-15
			return true;
		}
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Event.hx:142: characters 3-27
		return $this->conditions->test();
	}
}

Boot::registerClass(Event::class, 'fabula.Event');
