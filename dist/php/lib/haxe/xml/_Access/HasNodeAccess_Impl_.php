<?php
/**
 * Generated by Haxe 4.1.5
 */

namespace haxe\xml\_Access;

use \php\Boot;

final class HasNodeAccess_Impl_ {
	/**
	 * @param \Xml $this
	 * @param string $name
	 * 
	 * @return bool
	 */
	public static function resolve ($this1, $name) {
		#C:\haxeToolkit_415\haxe\std/haxe/xml/Access.hx:69: characters 3-44
		return $this1->elementsNamed($name)->hasNext();
	}
}

Boot::registerClass(HasNodeAccess_Impl_::class, 'haxe.xml._Access.HasNodeAccess_Impl_');
