<?php
/**
 */

namespace fabula;

use \php\Boot;
use \fabula\condition\ConditionCollection;
use \fabula\condition\EConditionType;
use \fabula\condition\ConditionFactory;

/**
 * ...
 * @author Loudo
 */
class Choice {
	/**
	 * @var ConditionCollection
	 * If a condition is set, the choice will appear only if criteria is met
	 */
	public $condition;
	/**
	 * @var string
	 */
	public $id;
	/**
	 * @var bool
	 * A choice can exit the sequence
	 */
	public $isExit;
	/**
	 * @var string
	 * Resulting event when the player chooses this choice
	 */
	public $target;
	/**
	 * @var string
	 */
	public $text;
	/**
	 * @var string
	 * If you have different kind of choices, and you need to display an information or a particular icon to help the player (choice leading to an attack or a purchase in a shop). Could be also used for feedback
	 */
	public $type;

	/**
	 * A choice is a clickable element in your game that the player has to click to continue the sequence.
	 * @param id event id
	 * @param text content
	 * @param type information or icon to help the player makes his choice, could be also used for feedback
	 * @param condition condition to display this choice. You can by default use event or choice id.
	 * @param target A target to jump to another event instead of using next event in the sequence.
	 * @param exit Boolean. True to exit the sequence.
	 * 
	 * @param string $id
	 * @param string $text
	 * @param string $type
	 * @param ConditionCollection $condition
	 * @param string $target
	 * @param bool $exit
	 * 
	 * @return void
	 */
	public function __construct ($id, $text, $type, $condition = null, $target = null, $exit = false) {
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Choice.hx:47: lines 47-56
		if ($exit === null) {
			$exit = false;
		}
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Choice.hx:48: characters 3-15
		$this->id = $id;
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Choice.hx:49: characters 3-53
		$this->text = (($text !== "") && ($text !== null) ? $text : $id);
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Choice.hx:50: characters 3-19
		$this->type = $type;
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Choice.hx:51: characters 3-23
		$this->target = $target;
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Choice.hx:52: characters 3-29
		$this->condition = $condition;
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Choice.hx:53: characters 3-21
		$this->isExit = $exit;
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Choice.hx:54: characters 3-50
		ConditionFactory::$helperList->data[$this->id] = EConditionType::EVENT();
	}
}

Boot::registerClass(Choice::class, 'fabula.Choice');
