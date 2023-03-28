<?php
/**
 */

namespace fabula;

use \php\Boot;
use \fabula\condition\_VariableCollection\VariableCollection_Impl_;
use \fabula\condition\Variable;
use \php\_Boot\HxString;
use \haxe\IMap;
use \fabula\condition\ConditionFactory;

class Fabula {
	/**
	 * @var \Closure
	 */
	public $_achievedCallback;
	/**
	 * @var string[]|\Array_hx
	 */
	public $_encountersID;
	/**
	 * @var string[]|\Array_hx
	 */
	public $_questsID;
	/**
	 * @var Event[]|\Array_hx
	 */
	public $_randomEncounters;
	/**
	 * @var Sequence[]|\Array_hx
	 */
	public $_sequences;
	/**
	 * @var string[]|\Array_hx
	 */
	public $_textsID;
	/**
	 * @var string[]|\Array_hx
	 */
	public $achievedListID;
	/**
	 * @var ConditionFactory
	 */
	public $conditionFactory;
	/**
	 * @var Sequence
	 */
	public $currentSequence;

	/**
	 * Fabula is a sequencial or branch event/dialog system.
	 * Different systems can be used to run through a storyline.
	 * Some story are sequencial, other are branch based, xml are formed differently to optimize manual integration.
	 * A tool could help homogenize xml but not planned yet.
	 * @param files You can use more than one file.
	 * 
	 * @param string[]|\Array_hx $files
	 * @param \Closure $achievedCallback
	 * 
	 * @return void
	 */
	public function __construct ($files, $achievedCallback = null) {
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Fabula.hx:51: characters 3-17
		$this->_questsID = new \Array_hx();
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Fabula.hx:52: characters 3-21
		$this->_encountersID = new \Array_hx();
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Fabula.hx:53: characters 3-16
		$this->_textsID = new \Array_hx();
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Fabula.hx:54: characters 3-22
		$this->achievedListID = new \Array_hx();
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Fabula.hx:55: characters 3-39
		$this->_achievedCallback = $achievedCallback;
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Fabula.hx:56: characters 3-48
		$this->conditionFactory = new ConditionFactory($this);
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Fabula.hx:58: characters 3-18
		$this->_sequences = new \Array_hx();
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Fabula.hx:60: lines 60-63
		$_g = 0;
		while ($_g < $files->length) {
			#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Fabula.hx:60: characters 8-12
			$file = ($files->arr[$_g] ?? null);
			#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Fabula.hx:60: lines 60-63
			++$_g;
			#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Fabula.hx:62: characters 4-14
			$this->init($file);
		}
	}

	/**
	 * @param mixed[]|\Array_hx $source
	 * @param mixed[]|\Array_hx $adding
	 * 
	 * @return void
	 */
	public function arrayMerge ($source, $adding) {
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Fabula.hx:78: characters 13-17
		$_g = 0;
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Fabula.hx:78: characters 17-30
		$_g1 = $adding->length;
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Fabula.hx:78: lines 78-81
		while ($_g < $_g1) {
			#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Fabula.hx:78: characters 13-30
			$i = $_g++;
			#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Fabula.hx:80: characters 16-25
			$adding1 = ($adding->arr[$i] ?? null);
			#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Fabula.hx:80: characters 4-26
			$source->arr[$source->length++] = $adding1;
		}
	}

	/**
	 *
	 * WIP: count words
	 * TODO don't count variable and html tag
	 * TODO take into account nbsp
	 * 
	 * @return int
	 */
	public function countWords () {
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Fabula.hx:212: characters 3-17
		$count = 0;
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Fabula.hx:213: lines 213-229
		$_g = 0;
		$_g1 = $this->_sequences;
		while ($_g < $_g1->length) {
			#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Fabula.hx:213: characters 8-11
			$seq = ($_g1->arr[$_g] ?? null);
			#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Fabula.hx:213: lines 213-229
			++$_g;
			#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Fabula.hx:215: lines 215-228
			if ($seq->events !== null) {
				#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Fabula.hx:217: lines 217-227
				$_g2 = 0;
				$_g3 = $seq->events;
				while ($_g2 < $_g3->length) {
					#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Fabula.hx:217: characters 10-15
					$event = ($_g3->arr[$_g2] ?? null);
					#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Fabula.hx:217: lines 217-227
					++$_g2;
					#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Fabula.hx:219: characters 6-43
					$count += HxString::split($event->text, " ")->length;
					#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Fabula.hx:220: lines 220-226
					if ($event->choices !== null) {
						#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Fabula.hx:222: lines 222-225
						$_g4 = 0;
						$_g5 = $event->choices;
						while ($_g4 < $_g5->length) {
							#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Fabula.hx:222: characters 12-18
							$choice = ($_g5->arr[$_g4] ?? null);
							#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Fabula.hx:222: lines 222-225
							++$_g4;
							#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Fabula.hx:224: characters 8-46
							$count += HxString::split($choice->text, " ")->length;
						}
					}
				}
			}
		}
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Fabula.hx:230: characters 3-15
		return $count;
	}

	/**
	 * @return Event
	 */
	public function getCurrentEvent () {
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Fabula.hx:162: characters 3-57
		return ($this->currentSequence->events->arr[$this->currentSequence->current] ?? null);
	}

	/**
	 *
	 * @return Event. Null if current event is the last one.
	 * 
	 * @return Event
	 */
	public function getNextEvent () {
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Fabula.hx:150: characters 3-50
		$nextEvent = $this->currentSequence->getNextEvent();
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Fabula.hx:151: lines 151-156
		if ($nextEvent !== null) {
			#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Fabula.hx:153: characters 4-37
			$_this = $this->achievedListID;
			$_this->arr[$_this->length++] = $nextEvent->id;
			#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Fabula.hx:154: lines 154-155
			if ($this->_achievedCallback !== null) {
				#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Fabula.hx:155: characters 5-36
				($this->_achievedCallback)($nextEvent->id);
			}
		}
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Fabula.hx:157: characters 3-19
		return $nextEvent;
	}

	/**
	 * @param string $name
	 * 
	 * @return Variable
	 */
	public function getVar ($name) {
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Fabula.hx:192: lines 192-198
		if ($this->currentSequence !== null) {
			#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Fabula.hx:194: characters 4-51
			$vari = VariableCollection_Impl_::get($this->currentSequence->variables, $name);
			#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Fabula.hx:195: lines 195-196
			if ($vari !== null) {
				#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Fabula.hx:196: characters 5-16
				return $vari;
			}
		}
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Fabula.hx:199: characters 3-14
		return null;
	}

	/**
	 * @param string $raw
	 * 
	 * @return void
	 */
	public function init ($raw) {
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Fabula.hx:69: characters 3-79
		$elements = FabulaXmlParser::parse($raw, $this->conditionFactory, $this->achievedListID);
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Fabula.hx:70: characters 3-45
		$this->arrayMerge($this->_sequences, $elements->sequences);
	}

	/**
	 * @param IMap $source
	 * @param IMap $adding
	 * 
	 * @return void
	 */
	public function mapMerge ($source, $adding) {
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Fabula.hx:89: characters 24-30
		$_g = $adding->keyValueIterator();
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Fabula.hx:89: lines 89-92
		while ($_g->hasNext()) {
			#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Fabula.hx:89: characters 24-30
			$_g1 = $_g->next();
			$key = $_g1->key;
			$value = $_g1->value;
			#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Fabula.hx:91: characters 4-23
			$source->set($key, $value);
		}
	}

	/**
	 * Reset all data.
	 * 
	 * @return void
	 */
	public function reset () {
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Fabula.hx:100: characters 3-50
		$this->achievedListID->splice(0, $this->achievedListID->length);
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Fabula.hx:101: lines 101-110
		$_g = 0;
		$_g1 = $this->_sequences;
		while ($_g < $_g1->length) {
			#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Fabula.hx:101: characters 8-11
			$seq = ($_g1->arr[$_g] ?? null);
			#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Fabula.hx:101: lines 101-110
			++$_g;
			#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Fabula.hx:103: lines 103-109
			if ($seq->variables !== null) {
				#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Fabula.hx:105: characters 15-19
				$_g2 = 0;
				#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Fabula.hx:105: characters 19-39
				$_g3 = $seq->variables->length;
				#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Fabula.hx:105: lines 105-108
				while ($_g2 < $_g3) {
					#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Fabula.hx:105: characters 15-39
					$i = $_g2++;
					#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Fabula.hx:107: characters 6-30
					($seq->variables->arr[$i] ?? null)->reset();
				}
			}
		}
	}

	/**
	 * Apply an user choice to the sequence, add it to the achieved list and set variables
	 * @param choice
	 * @param id
	 * @return Choice
	 * 
	 * @param string $id
	 * @param int $index
	 * 
	 * @return Choice
	 */
	public function selectChoice ($id = null, $index = null) {
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Fabula.hx:173: characters 3-28
		$choice = null;
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Fabula.hx:175: lines 175-179
		if (($this->currentSequence !== null) && ($this->currentSequence->current < $this->currentSequence->events->length)) {
			#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Fabula.hx:177: characters 4-84
			$choice = ($this->currentSequence->events->arr[$this->currentSequence->current] ?? null)->selectChoice($id, $index);
			#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Fabula.hx:178: characters 4-46
			$this->currentSequence->nextTarget = $choice->target;
		}
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Fabula.hx:180: lines 180-186
		if ($choice !== null) {
			#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Fabula.hx:182: characters 4-27
			$_this = $this->achievedListID;
			$_this->arr[$_this->length++] = $id;
			#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Fabula.hx:183: lines 183-184
			if ($this->_achievedCallback !== null) {
				#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Fabula.hx:184: characters 5-26
				($this->_achievedCallback)($id);
			}
		}
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Fabula.hx:187: characters 3-16
		return $choice;
	}

	/**
	 *
	 * Get a particular sequence.
	 * @param id
	 * @param start true if you want to check conditions, start from beginning and reset variables. false to get a sequence bypassing conditions and without activating it (to check stuff manually, debug purpose etc.)
	 * @return Sequence return sequence if found and conditions met
	 * 
	 * @param string $id
	 * @param bool $start
	 * 
	 * @return Sequence
	 */
	public function selectSequence ($id, $start = true) {
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Fabula.hx:121: lines 121-142
		if ($start === null) {
			$start = true;
		}
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Fabula.hx:122: characters 13-17
		$_g = 0;
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Fabula.hx:122: characters 17-34
		$_g1 = $this->_sequences->length;
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Fabula.hx:122: lines 122-140
		while ($_g < $_g1) {
			#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Fabula.hx:122: characters 13-34
			$i = $_g++;
			#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Fabula.hx:124: lines 124-139
			if (($this->_sequences->arr[$i] ?? null)->id === $id) {
				#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Fabula.hx:126: characters 5-29
				$seq = ($this->_sequences->arr[$i] ?? null);
				#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Fabula.hx:127: lines 127-137
				if ($start) {
					#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Fabula.hx:129: lines 129-136
					if (($seq->conditions === null) || $seq->conditions->test()) {
						#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Fabula.hx:131: characters 7-28
						$this->currentSequence = $seq;
						#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Fabula.hx:132: characters 7-30
						$this->currentSequence->start();
					} else {
						#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Fabula.hx:135: characters 7-18
						return null;
					}
				}
				#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Fabula.hx:138: characters 5-15
				return $seq;
			}
		}
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Fabula.hx:141: characters 3-14
		return null;
	}

	/**
	 * @return void
	 */
	public function updateVar () {
	}
}

Boot::registerClass(Fabula::class, 'fabula.Fabula');
