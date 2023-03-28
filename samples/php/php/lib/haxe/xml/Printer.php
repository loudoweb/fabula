<?php
/**
 */

namespace haxe\xml;

use \php\Boot;
use \haxe\Exception;
use \_Xml\XmlType_Impl_;

/**
 * This class provides utility methods to convert Xml instances to
 * String representation.
 */
class Printer {
	/**
	 * @var \StringBuf
	 */
	public $output;
	/**
	 * @var bool
	 */
	public $pretty;

	/**
	 * Convert `Xml` to string representation.
	 * Set `pretty` to `true` to prettify the result.
	 * 
	 * @param \Xml $xml
	 * @param bool $pretty
	 * 
	 * @return string
	 */
	public static function print ($xml, $pretty = false) {
		#C:\HaxeToolkit\haxe\std/haxe/xml/Printer.hx:35: lines 35-39
		if ($pretty === null) {
			$pretty = false;
		}
		#C:\HaxeToolkit\haxe\std/haxe/xml/Printer.hx:36: characters 3-37
		$printer = new Printer($pretty);
		#C:\HaxeToolkit\haxe\std/haxe/xml/Printer.hx:37: characters 3-29
		$printer->writeNode($xml, "");
		#C:\HaxeToolkit\haxe\std/haxe/xml/Printer.hx:38: characters 3-35
		return $printer->output->b;
	}

	/**
	 * @param bool $pretty
	 * 
	 * @return void
	 */
	public function __construct ($pretty) {
		#C:\HaxeToolkit\haxe\std/haxe/xml/Printer.hx:45: characters 3-27
		$this->output = new \StringBuf();
		#C:\HaxeToolkit\haxe\std/haxe/xml/Printer.hx:46: characters 3-23
		$this->pretty = $pretty;
	}

	/**
	 * @param \Xml $value
	 * 
	 * @return bool
	 */
	public function hasChildren ($value) {
		#C:\HaxeToolkit\haxe\std/haxe/xml/Printer.hx:115: characters 17-22
		if (($value->nodeType !== \Xml::$Document) && ($value->nodeType !== \Xml::$Element)) {
			throw Exception::thrown("Bad node type, expected Element or Document but found " . ((($value->nodeType === null ? "null" : XmlType_Impl_::toString($value->nodeType)))??'null'));
		}
		$_g_current = 0;
		$_g_array = $value->children;
		#C:\HaxeToolkit\haxe\std/haxe/xml/Printer.hx:115: lines 115-125
		while ($_g_current < $_g_array->length) {
			$child = ($_g_array->arr[$_g_current++] ?? null);
			#C:\HaxeToolkit\haxe\std/haxe/xml/Printer.hx:116: characters 12-26
			$__hx__switch = ($child->nodeType);
			if ($__hx__switch === 0 || $__hx__switch === 1) {
				#C:\HaxeToolkit\haxe\std/haxe/xml/Printer.hx:118: characters 6-17
				return true;
			} else if ($__hx__switch === 2 || $__hx__switch === 3) {
				#C:\HaxeToolkit\haxe\std/haxe/xml/Printer.hx:120: characters 28-43
				if (($child->nodeType === \Xml::$Document) || ($child->nodeType === \Xml::$Element)) {
					throw Exception::thrown("Bad node type, unexpected " . ((($child->nodeType === null ? "null" : XmlType_Impl_::toString($child->nodeType)))??'null'));
				}
				#C:\HaxeToolkit\haxe\std/haxe/xml/Printer.hx:120: lines 120-122
				if (mb_strlen(\ltrim($child->nodeValue)) !== 0) {
					#C:\HaxeToolkit\haxe\std/haxe/xml/Printer.hx:121: characters 7-18
					return true;
				}
			} else {
			}
		}
		#C:\HaxeToolkit\haxe\std/haxe/xml/Printer.hx:126: characters 3-15
		return false;
	}

	/**
	 * @param \Xml $value
	 * @param string $tabs
	 * 
	 * @return void
	 */
	public function writeNode ($value, $tabs) {
		#C:\HaxeToolkit\haxe\std/haxe/xml/Printer.hx:50: characters 11-25
		$__hx__switch = ($value->nodeType);
		if ($__hx__switch === 0) {
			#C:\HaxeToolkit\haxe\std/haxe/xml/Printer.hx:68: characters 5-22
			$this->output->add(($tabs??'null') . "<");
			#C:\HaxeToolkit\haxe\std/haxe/xml/Printer.hx:69: characters 11-25
			if ($value->nodeType !== \Xml::$Element) {
				throw Exception::thrown("Bad node type, expected Element but found " . ((($value->nodeType === null ? "null" : XmlType_Impl_::toString($value->nodeType)))??'null'));
			}
			#C:\HaxeToolkit\haxe\std/haxe/xml/Printer.hx:69: characters 5-26
			$this->output->add($value->nodeName);
			#C:\HaxeToolkit\haxe\std/haxe/xml/Printer.hx:70: characters 23-41
			$attribute = $value->attributes();
			while ($attribute->hasNext()) {
				#C:\HaxeToolkit\haxe\std/haxe/xml/Printer.hx:70: lines 70-74
				$attribute1 = $attribute->next();
				#C:\HaxeToolkit\haxe\std/haxe/xml/Printer.hx:71: characters 6-36
				$this->output->add(" " . ($attribute1??'null') . "=\"");
				#C:\HaxeToolkit\haxe\std/haxe/xml/Printer.hx:72: characters 6-63
				$input = \htmlspecialchars($value->get($attribute1), \ENT_QUOTES | \ENT_HTML401);
				$this->output->add($input);
				#C:\HaxeToolkit\haxe\std/haxe/xml/Printer.hx:73: characters 6-17
				$this->output->add("\"");
			}
			#C:\HaxeToolkit\haxe\std/haxe/xml/Printer.hx:75: lines 75-88
			if ($this->hasChildren($value)) {
				#C:\HaxeToolkit\haxe\std/haxe/xml/Printer.hx:76: characters 6-16
				$this->output->add(">");
				#C:\HaxeToolkit\haxe\std/haxe/xml/Printer.hx:77: characters 6-15
				if ($this->pretty) {
					$this->output->add("\x0A");
				}
				#C:\HaxeToolkit\haxe\std/haxe/xml/Printer.hx:78: characters 20-25
				if (($value->nodeType !== \Xml::$Document) && ($value->nodeType !== \Xml::$Element)) {
					throw Exception::thrown("Bad node type, expected Element or Document but found " . ((($value->nodeType === null ? "null" : XmlType_Impl_::toString($value->nodeType)))??'null'));
				}
				$_g_current = 0;
				$_g_array = $value->children;
				#C:\HaxeToolkit\haxe\std/haxe/xml/Printer.hx:78: lines 78-80
				while ($_g_current < $_g_array->length) {
					$child = ($_g_array->arr[$_g_current++] ?? null);
					#C:\HaxeToolkit\haxe\std/haxe/xml/Printer.hx:79: characters 7-52
					$this->writeNode($child, ($this->pretty ? ($tabs??'null') . "\x09" : $tabs));
				}
				#C:\HaxeToolkit\haxe\std/haxe/xml/Printer.hx:81: characters 6-24
				$this->output->add(($tabs??'null') . "</");
				#C:\HaxeToolkit\haxe\std/haxe/xml/Printer.hx:82: characters 12-26
				if ($value->nodeType !== \Xml::$Element) {
					throw Exception::thrown("Bad node type, expected Element but found " . ((($value->nodeType === null ? "null" : XmlType_Impl_::toString($value->nodeType)))??'null'));
				}
				#C:\HaxeToolkit\haxe\std/haxe/xml/Printer.hx:82: characters 6-27
				$this->output->add($value->nodeName);
				#C:\HaxeToolkit\haxe\std/haxe/xml/Printer.hx:83: characters 6-16
				$this->output->add(">");
				#C:\HaxeToolkit\haxe\std/haxe/xml/Printer.hx:84: characters 6-15
				if ($this->pretty) {
					$this->output->add("\x0A");
				}
			} else {
				#C:\HaxeToolkit\haxe\std/haxe/xml/Printer.hx:86: characters 6-17
				$this->output->add("/>");
				#C:\HaxeToolkit\haxe\std/haxe/xml/Printer.hx:87: characters 6-15
				if ($this->pretty) {
					$this->output->add("\x0A");
				}
			}
		} else if ($__hx__switch === 1) {
			#C:\HaxeToolkit\haxe\std/haxe/xml/Printer.hx:90: characters 28-43
			if (($value->nodeType === \Xml::$Document) || ($value->nodeType === \Xml::$Element)) {
				throw Exception::thrown("Bad node type, unexpected " . ((($value->nodeType === null ? "null" : XmlType_Impl_::toString($value->nodeType)))??'null'));
			}
			#C:\HaxeToolkit\haxe\std/haxe/xml/Printer.hx:90: characters 5-44
			$nodeValue = $value->nodeValue;
			#C:\HaxeToolkit\haxe\std/haxe/xml/Printer.hx:91: lines 91-94
			if (mb_strlen($nodeValue) !== 0) {
				#C:\HaxeToolkit\haxe\std/haxe/xml/Printer.hx:92: characters 6-53
				$input = ($tabs??'null') . (\htmlspecialchars($nodeValue, (null ? \ENT_QUOTES | \ENT_HTML401 : \ENT_NOQUOTES))??'null');
				$this->output->add($input);
				#C:\HaxeToolkit\haxe\std/haxe/xml/Printer.hx:93: characters 6-15
				if ($this->pretty) {
					$this->output->add("\x0A");
				}
			}
		} else if ($__hx__switch === 2) {
			#C:\HaxeToolkit\haxe\std/haxe/xml/Printer.hx:52: characters 5-30
			$this->output->add(($tabs??'null') . "<![CDATA[");
			#C:\HaxeToolkit\haxe\std/haxe/xml/Printer.hx:53: characters 11-26
			if (($value->nodeType === \Xml::$Document) || ($value->nodeType === \Xml::$Element)) {
				throw Exception::thrown("Bad node type, unexpected " . ((($value->nodeType === null ? "null" : XmlType_Impl_::toString($value->nodeType)))??'null'));
			}
			#C:\HaxeToolkit\haxe\std/haxe/xml/Printer.hx:53: characters 5-27
			$this->output->add($value->nodeValue);
			#C:\HaxeToolkit\haxe\std/haxe/xml/Printer.hx:54: characters 5-17
			$this->output->add("]]>");
			#C:\HaxeToolkit\haxe\std/haxe/xml/Printer.hx:55: characters 5-14
			if ($this->pretty) {
				$this->output->add("\x0A");
			}
		} else if ($__hx__switch === 3) {
			#C:\HaxeToolkit\haxe\std/haxe/xml/Printer.hx:57: characters 33-48
			if (($value->nodeType === \Xml::$Document) || ($value->nodeType === \Xml::$Element)) {
				throw Exception::thrown("Bad node type, unexpected " . ((($value->nodeType === null ? "null" : XmlType_Impl_::toString($value->nodeType)))??'null'));
			}
			#C:\HaxeToolkit\haxe\std/haxe/xml/Printer.hx:57: characters 5-49
			$commentContent = $value->nodeValue;
			#C:\HaxeToolkit\haxe\std/haxe/xml/Printer.hx:58: characters 5-19
			$commentContent = (new \EReg("[\x0A\x0D\x09]+", "g"))->replace($commentContent, "");
			#C:\HaxeToolkit\haxe\std/haxe/xml/Printer.hx:59: characters 5-19
			$commentContent = "<!--" . ($commentContent??'null') . "-->";
			#C:\HaxeToolkit\haxe\std/haxe/xml/Printer.hx:60: characters 5-16
			$this->output->add($tabs);
			#C:\HaxeToolkit\haxe\std/haxe/xml/Printer.hx:61: characters 5-44
			$input = \trim($commentContent);
			$this->output->add($input);
			#C:\HaxeToolkit\haxe\std/haxe/xml/Printer.hx:62: characters 5-14
			if ($this->pretty) {
				$this->output->add("\x0A");
			}
		} else if ($__hx__switch === 4) {
			#C:\HaxeToolkit\haxe\std/haxe/xml/Printer.hx:99: characters 26-41
			if (($value->nodeType === \Xml::$Document) || ($value->nodeType === \Xml::$Element)) {
				throw Exception::thrown("Bad node type, unexpected " . ((($value->nodeType === null ? "null" : XmlType_Impl_::toString($value->nodeType)))??'null'));
			}
			#C:\HaxeToolkit\haxe\std/haxe/xml/Printer.hx:99: characters 5-48
			$this->output->add("<!DOCTYPE " . ($value->nodeValue??'null') . ">");
			#C:\HaxeToolkit\haxe\std/haxe/xml/Printer.hx:100: characters 5-14
			if ($this->pretty) {
				$this->output->add("\x0A");
			}
		} else if ($__hx__switch === 5) {
			#C:\HaxeToolkit\haxe\std/haxe/xml/Printer.hx:96: characters 18-33
			if (($value->nodeType === \Xml::$Document) || ($value->nodeType === \Xml::$Element)) {
				throw Exception::thrown("Bad node type, unexpected " . ((($value->nodeType === null ? "null" : XmlType_Impl_::toString($value->nodeType)))??'null'));
			}
			#C:\HaxeToolkit\haxe\std/haxe/xml/Printer.hx:96: characters 5-41
			$this->output->add("<?" . ($value->nodeValue??'null') . "?>");
			#C:\HaxeToolkit\haxe\std/haxe/xml/Printer.hx:97: characters 5-14
			if ($this->pretty) {
				$this->output->add("\x0A");
			}
		} else if ($__hx__switch === 6) {
			#C:\HaxeToolkit\haxe\std/haxe/xml/Printer.hx:64: characters 19-24
			if (($value->nodeType !== \Xml::$Document) && ($value->nodeType !== \Xml::$Element)) {
				throw Exception::thrown("Bad node type, expected Element or Document but found " . ((($value->nodeType === null ? "null" : XmlType_Impl_::toString($value->nodeType)))??'null'));
			}
			$_g_current = 0;
			$_g_array = $value->children;
			#C:\HaxeToolkit\haxe\std/haxe/xml/Printer.hx:64: lines 64-66
			while ($_g_current < $_g_array->length) {
				$child = ($_g_array->arr[$_g_current++] ?? null);
				#C:\HaxeToolkit\haxe\std/haxe/xml/Printer.hx:65: characters 6-28
				$this->writeNode($child, $tabs);
			}
		}
	}
}

Boot::registerClass(Printer::class, 'haxe.xml.Printer');
