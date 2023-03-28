<?php
/**
 */

namespace _Xml;

use \php\Boot;

final class XmlType_Impl_ {
	/**
	 * @param int $this
	 * 
	 * @return string
	 */
	public static function toString ($this1) {
		#C:\HaxeToolkit\haxe\std/Xml.hx:65: characters 17-38
		$__hx__switch = ($this1);
		if ($__hx__switch === 0) {
			#C:\HaxeToolkit\haxe\std/Xml.hx:66: characters 18-27
			return "Element";
		} else if ($__hx__switch === 1) {
			#C:\HaxeToolkit\haxe\std/Xml.hx:67: characters 17-25
			return "PCData";
		} else if ($__hx__switch === 2) {
			#C:\HaxeToolkit\haxe\std/Xml.hx:68: characters 16-23
			return "CData";
		} else if ($__hx__switch === 3) {
			#C:\HaxeToolkit\haxe\std/Xml.hx:69: characters 18-27
			return "Comment";
		} else if ($__hx__switch === 4) {
			#C:\HaxeToolkit\haxe\std/Xml.hx:70: characters 18-27
			return "DocType";
		} else if ($__hx__switch === 5) {
			#C:\HaxeToolkit\haxe\std/Xml.hx:71: characters 32-55
			return "ProcessingInstruction";
		} else if ($__hx__switch === 6) {
			#C:\HaxeToolkit\haxe\std/Xml.hx:72: characters 19-29
			return "Document";
		}
	}
}

Boot::registerClass(XmlType_Impl_::class, '_Xml.XmlType_Impl_');
