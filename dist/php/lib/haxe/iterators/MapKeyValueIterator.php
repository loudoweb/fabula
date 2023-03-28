<?php
/**
 */

namespace haxe\iterators;

use \php\_Boot\HxAnon;
use \php\Boot;
use \haxe\IMap;

/**
 * This Key/Value iterator can be used to iterate across maps.
 */
class MapKeyValueIterator {
	/**
	 * @var object
	 */
	public $keys;
	/**
	 * @var IMap
	 */
	public $map;

	/**
	 * @param IMap $map
	 * 
	 * @return void
	 */
	public function __construct ($map) {
		#C:\HaxeToolkit\haxe\std/haxe/iterators/MapKeyValueIterator.hx:36: characters 3-17
		$this->map = $map;
		#C:\HaxeToolkit\haxe\std/haxe/iterators/MapKeyValueIterator.hx:37: characters 3-25
		$this->keys = $map->keys();
	}

	/**
	 * See `Iterator.hasNext`
	 * 
	 * @return bool
	 */
	public function hasNext () {
		#C:\HaxeToolkit\haxe\std/haxe/iterators/MapKeyValueIterator.hx:44: characters 3-24
		return $this->keys->hasNext();
	}

	/**
	 * See `Iterator.next`
	 * 
	 * @return object
	 */
	public function next () {
		#C:\HaxeToolkit\haxe\std/haxe/iterators/MapKeyValueIterator.hx:51: characters 3-25
		$key = $this->keys->next();
		#C:\HaxeToolkit\haxe\std/haxe/iterators/MapKeyValueIterator.hx:52: characters 3-65
		return new _HxAnon_MapKeyValueIterator0($this->map->get($key), $key);
	}
}

class _HxAnon_MapKeyValueIterator0 extends HxAnon {
	function __construct($value, $key) {
		$this->value = $value;
		$this->key = $key;
	}
}

Boot::registerClass(MapKeyValueIterator::class, 'haxe.iterators.MapKeyValueIterator');
