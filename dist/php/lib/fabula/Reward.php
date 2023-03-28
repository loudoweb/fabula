<?php
/**
 */

namespace fabula;

use \php\Boot;

/**
 * ...
 * @author Loudo
 */
class Reward {
	/**
	 * @var string
	 */
	public $target;
	/**
	 * @var string
	 */
	public $type;
	/**
	 * @var string
	 */
	public $value;

	/**
	 * @param string $type
	 * @param string $value
	 * @param string $target
	 * 
	 * @return void
	 */
	public function __construct ($type, $value, $target) {
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Reward.hx:17: characters 3-19
		$this->type = $type;
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Reward.hx:18: characters 3-21
		$this->value = $value;
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/Reward.hx:19: characters 3-23
		$this->target = $target;
	}
}

Boot::registerClass(Reward::class, 'fabula.Reward');
