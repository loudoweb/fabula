<?php
/**
 */

namespace haxe\xml\_Access;

use \php\Boot;
use \haxe\Exception;
use \_Xml\XmlType_Impl_;

final class Access_Impl_ {

	/**
	 * @param \Xml $this
	 * 
	 * @return string
	 */
	public static function get_innerData ($this1) {
		#C:\HaxeToolkit\haxe\std/haxe/xml/Access.hx:216: characters 12-27
		if (($this1->nodeType !== \Xml::$Document) && ($this1->nodeType !== \Xml::$Element)) {
			throw Exception::thrown("Bad node type, expected Element or Document but found " . ((($this1->nodeType === null ? "null" : XmlType_Impl_::toString($this1->nodeType)))??'null'));
		}
		$it_current = 0;
		$it_array = $this1->children;
		#C:\HaxeToolkit\haxe\std/haxe/xml/Access.hx:217: lines 217-218
		if ($it_current >= $it_array->length) {
			#C:\HaxeToolkit\haxe\std/haxe/xml/Access.hx:218: characters 10-14
			$tmp = null;
			if ($this1->nodeType === \Xml::$Document) {
				$tmp = "Document";
			} else {
				if ($this1->nodeType !== \Xml::$Element) {
					throw Exception::thrown("Bad node type, expected Element but found " . ((($this1->nodeType === null ? "null" : XmlType_Impl_::toString($this1->nodeType)))??'null'));
				}
				$tmp = $this1->nodeName;
			}
			#C:\HaxeToolkit\haxe\std/haxe/xml/Access.hx:218: characters 4-9
			throw Exception::thrown(($tmp??'null') . " does not have data");
		}
		#C:\HaxeToolkit\haxe\std/haxe/xml/Access.hx:219: characters 3-21
		$v = ($it_array->arr[$it_current++] ?? null);
		#C:\HaxeToolkit\haxe\std/haxe/xml/Access.hx:220: lines 220-231
		if ($it_current < $it_array->length) {
			#C:\HaxeToolkit\haxe\std/haxe/xml/Access.hx:221: characters 4-22
			$n = ($it_array->arr[$it_current++] ?? null);
			#C:\HaxeToolkit\haxe\std/haxe/xml/Access.hx:223: characters 8-98
			$tmp = null;
			if (($v->nodeType === \Xml::$PCData) && ($n->nodeType === \Xml::$CData)) {
				#C:\HaxeToolkit\haxe\std/haxe/xml/Access.hx:223: characters 80-91
				if (($v->nodeType === \Xml::$Document) || ($v->nodeType === \Xml::$Element)) {
					throw Exception::thrown("Bad node type, unexpected " . ((($v->nodeType === null ? "null" : XmlType_Impl_::toString($v->nodeType)))??'null'));
				}
				#C:\HaxeToolkit\haxe\std/haxe/xml/Access.hx:223: characters 8-98
				$tmp = \trim($v->nodeValue) === "";
			} else {
				$tmp = false;
			}
			#C:\HaxeToolkit\haxe\std/haxe/xml/Access.hx:223: lines 223-229
			if ($tmp) {
				#C:\HaxeToolkit\haxe\std/haxe/xml/Access.hx:224: lines 224-225
				if ($it_current >= $it_array->length) {
					#C:\HaxeToolkit\haxe\std/haxe/xml/Access.hx:225: characters 13-24
					if (($n->nodeType === \Xml::$Document) || ($n->nodeType === \Xml::$Element)) {
						throw Exception::thrown("Bad node type, unexpected " . ((($n->nodeType === null ? "null" : XmlType_Impl_::toString($n->nodeType)))??'null'));
					}
					return $n->nodeValue;
				}
				#C:\HaxeToolkit\haxe\std/haxe/xml/Access.hx:226: characters 5-24
				$n2 = ($it_array->arr[$it_current++] ?? null);
				#C:\HaxeToolkit\haxe\std/haxe/xml/Access.hx:227: characters 9-74
				$tmp = null;
				if ($n2->nodeType === \Xml::$PCData) {
					#C:\HaxeToolkit\haxe\std/haxe/xml/Access.hx:227: characters 55-67
					if (($n2->nodeType === \Xml::$Document) || ($n2->nodeType === \Xml::$Element)) {
						throw Exception::thrown("Bad node type, unexpected " . ((($n2->nodeType === null ? "null" : XmlType_Impl_::toString($n2->nodeType)))??'null'));
					}
					#C:\HaxeToolkit\haxe\std/haxe/xml/Access.hx:227: characters 9-74
					$tmp = \trim($n2->nodeValue) === "";
				} else {
					$tmp = false;
				}
				#C:\HaxeToolkit\haxe\std/haxe/xml/Access.hx:227: lines 227-228
				if ($tmp && ($it_current >= $it_array->length)) {
					#C:\HaxeToolkit\haxe\std/haxe/xml/Access.hx:228: characters 13-24
					if (($n->nodeType === \Xml::$Document) || ($n->nodeType === \Xml::$Element)) {
						throw Exception::thrown("Bad node type, unexpected " . ((($n->nodeType === null ? "null" : XmlType_Impl_::toString($n->nodeType)))??'null'));
					}
					return $n->nodeValue;
				}
			}
			#C:\HaxeToolkit\haxe\std/haxe/xml/Access.hx:230: characters 10-14
			$tmp = null;
			if ($this1->nodeType === \Xml::$Document) {
				$tmp = "Document";
			} else {
				if ($this1->nodeType !== \Xml::$Element) {
					throw Exception::thrown("Bad node type, expected Element but found " . ((($this1->nodeType === null ? "null" : XmlType_Impl_::toString($this1->nodeType)))??'null'));
				}
				$tmp = $this1->nodeName;
			}
			#C:\HaxeToolkit\haxe\std/haxe/xml/Access.hx:230: characters 4-9
			throw Exception::thrown(($tmp??'null') . " does not only have data");
		}
		#C:\HaxeToolkit\haxe\std/haxe/xml/Access.hx:232: lines 232-233
		if (($v->nodeType !== \Xml::$PCData) && ($v->nodeType !== \Xml::$CData)) {
			#C:\HaxeToolkit\haxe\std/haxe/xml/Access.hx:233: characters 10-14
			$tmp = null;
			if ($this1->nodeType === \Xml::$Document) {
				$tmp = "Document";
			} else {
				if ($this1->nodeType !== \Xml::$Element) {
					throw Exception::thrown("Bad node type, expected Element but found " . ((($this1->nodeType === null ? "null" : XmlType_Impl_::toString($this1->nodeType)))??'null'));
				}
				$tmp = $this1->nodeName;
			}
			#C:\HaxeToolkit\haxe\std/haxe/xml/Access.hx:233: characters 4-9
			throw Exception::thrown(($tmp??'null') . " does not have data");
		}
		#C:\HaxeToolkit\haxe\std/haxe/xml/Access.hx:234: characters 10-21
		if (($v->nodeType === \Xml::$Document) || ($v->nodeType === \Xml::$Element)) {
			throw Exception::thrown("Bad node type, unexpected " . ((($v->nodeType === null ? "null" : XmlType_Impl_::toString($v->nodeType)))??'null'));
		}
		return $v->nodeValue;
	}
}

Boot::registerClass(Access_Impl_::class, 'haxe.xml._Access.Access_Impl_');
Boot::registerGetters('haxe\\xml\\_Access\\Access_Impl_', [
	'innerData' => true
]);
