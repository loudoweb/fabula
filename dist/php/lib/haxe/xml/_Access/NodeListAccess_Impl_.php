<?php
/**
 */

namespace haxe\xml\_Access;

use \php\Boot;
use \haxe\Exception;
use \_Xml\XmlType_Impl_;

final class NodeListAccess_Impl_ {
	/**
	 * @param \Xml $this
	 * @param string $name
	 * 
	 * @return \Xml[]|\Array_hx
	 */
	public static function resolve ($this1, $name) {
		#C:\HaxeToolkit\haxe\std/haxe/xml/Access.hx:76: characters 3-14
		$l = new \Array_hx();
		#C:\HaxeToolkit\haxe\std/haxe/xml/Access.hx:77: characters 13-37
		$x = $this1->elementsNamed($name);
		while ($x->hasNext()) {
			#C:\HaxeToolkit\haxe\std/haxe/xml/Access.hx:77: lines 77-78
			$x1 = $x->next();
			#C:\HaxeToolkit\haxe\std/haxe/xml/Access.hx:78: characters 11-24
			if (($x1->nodeType !== \Xml::$Document) && ($x1->nodeType !== \Xml::$Element)) {
				throw Exception::thrown("Invalid nodeType " . ((($x1->nodeType === null ? "null" : XmlType_Impl_::toString($x1->nodeType)))??'null'));
			}
			$this1 = $x1;
			#C:\HaxeToolkit\haxe\std/haxe/xml/Access.hx:78: characters 4-25
			$l->arr[$l->length++] = $this1;
		}
		#C:\HaxeToolkit\haxe\std/haxe/xml/Access.hx:79: characters 3-11
		return $l;
	}
}

Boot::registerClass(NodeListAccess_Impl_::class, 'haxe.xml._Access.NodeListAccess_Impl_');
