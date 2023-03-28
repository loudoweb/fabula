<?php
/**
 */

namespace kadabra\utils;

use \haxe\xml\_Access\HasAttribAccess_Impl_;
use \php\Boot;
use \haxe\xml\_Access\AttribAccess_Impl_;

/**
 * Utils for xml/access
 * @author Ludovic Bas - www.lugludum.com
 */
class XMLUtils {
	/**
	 * Find xml attribute or use default value
	 * @param	xml
	 * @param	name
	 * @param	defaultValue true
	 * @return
	 * 
	 * @param \Xml $xml
	 * @param string $name
	 * @param bool $defaultValue
	 * 
	 * @return bool
	 */
	public static function getBool ($xml, $name, $defaultValue = true) {
		#C:\HaxeToolkit\haxe\lib\kadabra-utils/git/kadabra/utils/XMLUtils.hx:42: characters 10-80
		if ($defaultValue === null) {
			$defaultValue = true;
		}
		if (HasAttribAccess_Impl_::resolve($xml, $name)) {
			#C:\HaxeToolkit\haxe\lib\kadabra-utils/git/kadabra/utils/XMLUtils.hx:42: characters 34-65
			return AttribAccess_Impl_::resolve($xml, $name) === "true";
		} else {
			#C:\HaxeToolkit\haxe\lib\kadabra-utils/git/kadabra/utils/XMLUtils.hx:42: characters 68-80
			return $defaultValue;
		}
	}

	/**
	 *
	 * Get first child
	 *
	 * 
	 * @param \Xml $xml
	 * 
	 * @return \Xml
	 */
	public static function getFirstChild ($xml) {
		#C:\HaxeToolkit\haxe\lib\kadabra-utils/git/kadabra/utils/XMLUtils.hx:63: characters 3-20
		$child = null;
		#C:\HaxeToolkit\haxe\lib\kadabra-utils/git/kadabra/utils/XMLUtils.hx:64: characters 14-26
		$el = $xml->elements();
		while ($el->hasNext()) {
			#C:\HaxeToolkit\haxe\lib\kadabra-utils/git/kadabra/utils/XMLUtils.hx:64: lines 64-68
			$el1 = $el->next();
			#C:\HaxeToolkit\haxe\lib\kadabra-utils/git/kadabra/utils/XMLUtils.hx:66: characters 4-14
			$child = $el1;
			#C:\HaxeToolkit\haxe\lib\kadabra-utils/git/kadabra/utils/XMLUtils.hx:67: characters 4-9
			break;
		}
		#C:\HaxeToolkit\haxe\lib\kadabra-utils/git/kadabra/utils/XMLUtils.hx:69: characters 3-15
		return $child;
	}

	/**
	 * Find xml attribute or use default value
	 * @param	xml
	 * @param	name
	 * @param	defaultValue 0.0
	 * @return
	 * 
	 * @param \Xml $xml
	 * @param string $name
	 * @param float $defaultValue
	 * 
	 * @return float
	 */
	public static function getFloat ($xml, $name, $defaultValue = 0.0) {
		#C:\HaxeToolkit\haxe\lib\kadabra-utils/git/kadabra/utils/XMLUtils.hx:20: characters 10-86
		if ($defaultValue === null) {
			$defaultValue = 0.0;
		}
		if (HasAttribAccess_Impl_::resolve($xml, $name)) {
			#C:\HaxeToolkit\haxe\lib\kadabra-utils/git/kadabra/utils/XMLUtils.hx:20: characters 34-71
			return \Std::parseFloat(AttribAccess_Impl_::resolve($xml, $name));
		} else {
			#C:\HaxeToolkit\haxe\lib\kadabra-utils/git/kadabra/utils/XMLUtils.hx:20: characters 74-86
			return $defaultValue;
		}
	}

	/**
	 * Find xml attribute or use default value
	 * @param	xml
	 * @param	name
	 * @param	defaultValue 0
	 * @return
	 * 
	 * @param \Xml $xml
	 * @param string $name
	 * @param int $defaultValue
	 * 
	 * @return int
	 */
	public static function getInt ($xml, $name, $defaultValue = 0) {
		#C:\HaxeToolkit\haxe\lib\kadabra-utils/git/kadabra/utils/XMLUtils.hx:31: characters 10-84
		if ($defaultValue === null) {
			$defaultValue = 0;
		}
		if (HasAttribAccess_Impl_::resolve($xml, $name)) {
			#C:\HaxeToolkit\haxe\lib\kadabra-utils/git/kadabra/utils/XMLUtils.hx:31: characters 34-69
			return \Std::parseInt(AttribAccess_Impl_::resolve($xml, $name));
		} else {
			#C:\HaxeToolkit\haxe\lib\kadabra-utils/git/kadabra/utils/XMLUtils.hx:31: characters 72-84
			return $defaultValue;
		}
	}

	/**
	 * Find xml attribute or use default value
	 * @param	xml
	 * @param	name
	 * @param	defaultValue empty string
	 * @return
	 * 
	 * @param \Xml $xml
	 * @param string $name
	 * @param string $defaultValue
	 * 
	 * @return string
	 */
	public static function getString ($xml, $name, $defaultValue = "") {
		#C:\HaxeToolkit\haxe\lib\kadabra-utils/git/kadabra/utils/XMLUtils.hx:53: characters 10-70
		if ($defaultValue === null) {
			$defaultValue = "";
		}
		if (HasAttribAccess_Impl_::resolve($xml, $name)) {
			#C:\HaxeToolkit\haxe\lib\kadabra-utils/git/kadabra/utils/XMLUtils.hx:53: characters 34-55
			return AttribAccess_Impl_::resolve($xml, $name);
		} else {
			#C:\HaxeToolkit\haxe\lib\kadabra-utils/git/kadabra/utils/XMLUtils.hx:53: characters 58-70
			return $defaultValue;
		}
	}
}

Boot::registerClass(XMLUtils::class, 'kadabra.utils.XMLUtils');
