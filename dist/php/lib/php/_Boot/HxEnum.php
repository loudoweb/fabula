<?php
/**
 * Generated by Haxe 4.1.5
 */

namespace php\_Boot;

use \php\Boot;

/**
 * Base class for enum types
 */
class HxEnum {
	/**
	 * @var int
	 */
	public $index;
	/**
	 * @var mixed
	 */
	public $params;
	/**
	 * @var string
	 */
	public $tag;

	/**
	 * @param string $tag
	 * @param int $index
	 * @param mixed $arguments
	 * 
	 * @return void
	 */
	public function __construct ($tag, $index, $arguments = null) {
		#C:\haxeToolkit_415\haxe\std/php/Boot.hx:719: characters 3-17
		$this->tag = $tag;
		#C:\haxeToolkit_415\haxe\std/php/Boot.hx:720: characters 3-21
		$this->index = $index;
		#C:\haxeToolkit_415\haxe\std/php/Boot.hx:721: characters 12-63
		$tmp = null;
		if ($arguments === null) {
			#C:\haxeToolkit_415\haxe\std/php/Boot.hx:721: characters 33-50
			$this1 = [];
			#C:\haxeToolkit_415\haxe\std/php/Boot.hx:721: characters 12-63
			$tmp = $this1;
		} else {
			$tmp = $arguments;
		}
		#C:\haxeToolkit_415\haxe\std/php/Boot.hx:721: characters 3-63
		$this->params = $tmp;
	}

	/**
	 * PHP magic method to get string representation of this `Class`
	 * 
	 * @return string
	 */
	public function __toString () {
		#C:\haxeToolkit_415\haxe\std/php/Boot.hx:736: characters 3-30
		return Boot::stringify($this);
	}

	/**
	 * Get string representation of this `Class`
	 * 
	 * @return string
	 */
	public function toString () {
		#C:\haxeToolkit_415\haxe\std/php/Boot.hx:728: characters 3-22
		return $this->__toString();
	}
}

Boot::registerClass(HxEnum::class, 'php._Boot.HxEnum');
