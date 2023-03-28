<?php
/**
 */

namespace haxe;

use \php\Boot;

interface IMap {
	/**
	 * @param mixed $k
	 * 
	 * @return mixed
	 */
	public function get ($k) ;

	/**
	 * @return object
	 */
	public function keyValueIterator () ;

	/**
	 * @return object
	 */
	public function keys () ;

	/**
	 * @param mixed $k
	 * @param mixed $v
	 * 
	 * @return void
	 */
	public function set ($k, $v) ;
}

Boot::registerClass(IMap::class, 'haxe.IMap');
