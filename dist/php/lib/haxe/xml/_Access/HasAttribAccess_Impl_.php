<?php
/**
 */

namespace haxe\xml\_Access;

use \php\Boot;
use \haxe\Exception;

final class HasAttribAccess_Impl_ {
	/**
	 * @param \Xml $this
	 * @param string $name
	 * 
	 * @return bool
	 */
	public static function resolve ($this1, $name) {
		#C:\HaxeToolkit\haxe\std/haxe/xml/Access.hx:60: lines 60-61
		if ($this1->nodeType === \Xml::$Document) {
			#C:\HaxeToolkit\haxe\std/haxe/xml/Access.hx:61: characters 4-9
			throw Exception::thrown("Cannot access document attribute " . ($name??'null'));
		}
		#C:\HaxeToolkit\haxe\std/haxe/xml/Access.hx:62: characters 3-27
		return $this1->exists($name);
	}
}

Boot::registerClass(HasAttribAccess_Impl_::class, 'haxe.xml._Access.HasAttribAccess_Impl_');
