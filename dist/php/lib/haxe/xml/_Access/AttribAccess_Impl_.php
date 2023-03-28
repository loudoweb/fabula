<?php
/**
 */

namespace haxe\xml\_Access;

use \php\Boot;
use \haxe\Exception;
use \_Xml\XmlType_Impl_;

final class AttribAccess_Impl_ {
	/**
	 * @param \Xml $this
	 * @param string $name
	 * 
	 * @return string
	 */
	public static function resolve ($this1, $name) {
		#C:\HaxeToolkit\haxe\std/haxe/xml/Access.hx:40: lines 40-41
		if ($this1->nodeType === \Xml::$Document) {
			#C:\HaxeToolkit\haxe\std/haxe/xml/Access.hx:41: characters 4-9
			throw Exception::thrown("Cannot access document attribute " . ($name??'null'));
		}
		#C:\HaxeToolkit\haxe\std/haxe/xml/Access.hx:42: characters 3-26
		$v = $this1->get($name);
		#C:\HaxeToolkit\haxe\std/haxe/xml/Access.hx:43: lines 43-44
		if ($v === null) {
			#C:\HaxeToolkit\haxe\std/haxe/xml/Access.hx:44: characters 10-23
			if ($this1->nodeType !== \Xml::$Element) {
				throw Exception::thrown("Bad node type, expected Element but found " . ((($this1->nodeType === null ? "null" : XmlType_Impl_::toString($this1->nodeType)))??'null'));
			}
			#C:\HaxeToolkit\haxe\std/haxe/xml/Access.hx:44: characters 4-9
			throw Exception::thrown(($this1->nodeName??'null') . " is missing attribute " . ($name??'null'));
		}
		#C:\HaxeToolkit\haxe\std/haxe/xml/Access.hx:45: characters 3-11
		return $v;
	}
}

Boot::registerClass(AttribAccess_Impl_::class, 'haxe.xml._Access.AttribAccess_Impl_');
