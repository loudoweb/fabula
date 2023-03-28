<?php
/**
 */

namespace haxe\xml;

use \php\Boot;
use \haxe\Exception;
use \_Xml\XmlType_Impl_;
use \haxe\ds\StringMap;

class Parser {
	/**
	 * @var StringMap
	 */
	static public $escapes;

	/**
	 * @param mixed $str
	 * @param bool $strict
	 * @param int $p
	 * @param \Xml $parent
	 * 
	 * @return int
	 */
	public static function doParse ($str, $strict, $p = 0, $parent = null) {
		#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:105: lines 105-380
		if ($p === null) {
			$p = 0;
		}
		#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:106: characters 3-22
		$xml = null;
		#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:107: characters 3-23
		$state = 1;
		#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:108: characters 3-22
		$next = 1;
		#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:109: characters 3-20
		$aname = null;
		#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:110: characters 3-17
		$start = 0;
		#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:111: characters 3-17
		$nsubs = 0;
		#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:112: characters 3-21
		$nbrackets = 0;
		#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:113: characters 3-29
		$c = ($p >= \strlen($str) ? 0 : \ord($str[$p]));
		#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:114: characters 3-29
		$buf = "";
		#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:116: characters 3-28
		$escapeNext = 1;
		#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:117: characters 3-25
		$attrValQuote = -1;
		#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:122: lines 122-354
		while ($c !== 0) {
			#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:123: lines 123-352
			$__hx__switch = ($state);
			if ($__hx__switch === 0) {
				#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:125: lines 125-130
				if ($c === 9 || $c === 10 || $c === 13 || $c === 32) {
				} else {
					#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:128: characters 8-20
					$state = $next;
					#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:129: characters 8-16
					continue;
				}
			} else if ($__hx__switch === 1) {
				#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:132: lines 132-140
				if ($c === 60) {
					#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:134: characters 8-31
					$state = 0;
					#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:135: characters 8-27
					$next = 2;
				} else {
					#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:137: characters 8-17
					$start = $p;
					#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:138: characters 8-24
					$state = 13;
					#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:139: characters 8-16
					continue;
				}
			} else if ($__hx__switch === 2) {
				#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:163: lines 163-198
				if ($c === 33) {
					#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:165: characters 12-33
					$pos = $p + 1;
					#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:165: lines 165-184
					if ((($pos >= \strlen($str) ? 0 : \ord($str[$pos]))) === 91) {
						#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:166: characters 9-15
						$p += 2;
						#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:167: lines 167-168
						if (\strtoupper(\substr($str, $p, 6)) !== "CDATA[") {
							#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:168: characters 10-15
							throw Exception::thrown(new XmlParserException("Expected <![CDATA[", $str, $p));
						}
						#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:169: characters 9-15
						$p += 5;
						#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:170: characters 9-24
						$state = 17;
						#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:171: characters 9-22
						$start = $p + 1;
					} else {
						#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:172: characters 19-89
						$tmp = null;
						#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:172: characters 19-40
						$pos1 = $p + 1;
						#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:172: characters 19-89
						if ((($pos1 >= \strlen($str) ? 0 : \ord($str[$pos1]))) !== 68) {
							#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:172: characters 56-77
							$pos2 = $p + 1;
							#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:172: characters 19-89
							$tmp = (($pos2 >= \strlen($str) ? 0 : \ord($str[$pos2]))) === 100;
						} else {
							$tmp = true;
						}
						#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:172: lines 172-184
						if ($tmp) {
							#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:173: lines 173-174
							if (\strtoupper(\substr($str, $p + 2, 6)) !== "OCTYPE") {
								#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:174: characters 10-15
								throw Exception::thrown(new XmlParserException("Expected <!DOCTYPE", $str, $p));
							}
							#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:175: characters 9-15
							$p += 8;
							#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:176: characters 9-26
							$state = 16;
							#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:177: characters 9-22
							$start = $p + 1;
						} else {
							#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:178: characters 19-89
							$tmp1 = null;
							#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:178: characters 19-40
							$pos3 = $p + 1;
							#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:178: characters 19-89
							if ((($pos3 >= \strlen($str) ? 0 : \ord($str[$pos3]))) === 45) {
								#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:178: characters 56-77
								$pos4 = $p + 2;
								#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:178: characters 19-89
								$tmp1 = (($pos4 >= \strlen($str) ? 0 : \ord($str[$pos4]))) !== 45;
							} else {
								$tmp1 = true;
							}
							#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:178: lines 178-184
							if ($tmp1) {
								#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:179: characters 9-14
								throw Exception::thrown(new XmlParserException("Expected <!--", $str, $p));
							} else {
								#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:181: characters 9-15
								$p += 2;
								#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:182: characters 9-26
								$state = 15;
								#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:183: characters 9-22
								$start = $p + 1;
							}
						}
					}
				} else if ($c === 47) {
					#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:189: lines 189-190
					if ($parent === null) {
						#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:190: characters 9-14
						throw Exception::thrown(new XmlParserException("Expected node name", $str, $p));
					}
					#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:191: characters 8-21
					$start = $p + 1;
					#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:192: characters 8-31
					$state = 0;
					#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:193: characters 8-22
					$next = 10;
				} else if ($c === 63) {
					#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:186: characters 8-24
					$state = 14;
					#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:187: characters 8-17
					$start = $p;
				} else {
					#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:195: characters 8-26
					$state = 3;
					#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:196: characters 8-17
					$start = $p;
					#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:197: characters 8-16
					continue;
				}
			} else if ($__hx__switch === 3) {
				#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:200: lines 200-208
				if (!((($c >= 97) && ($c <= 122)) || (($c >= 65) && ($c <= 90)) || (($c >= 48) && ($c <= 57)) || ($c === 58) || ($c === 46) || ($c === 95) || ($c === 45))) {
					#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:201: lines 201-202
					if ($p === $start) {
						#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:202: characters 8-13
						throw Exception::thrown(new XmlParserException("Expected node name", $str, $p));
					}
					#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:203: characters 7-60
					$xml = \Xml::createElement(\substr($str, $start, $p - $start));
					#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:204: characters 7-20
					$parent->addChild($xml);
					++$nsubs;
					#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:205: characters 7-30
					$state = 0;
					#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:206: characters 7-20
					$next = 4;
					#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:207: characters 7-15
					continue;
				}
			} else if ($__hx__switch === 4) {
				#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:210: lines 210-219
				if ($c === 47) {
					#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:212: characters 8-26
					$state = 11;
				} else if ($c === 62) {
					#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:214: characters 8-24
					$state = 9;
				} else {
					#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:216: characters 8-29
					$state = 5;
					#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:217: characters 8-17
					$start = $p;
					#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:218: characters 8-16
					continue;
				}
			} else if ($__hx__switch === 5) {
				#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:221: lines 221-232
				if (!((($c >= 97) && ($c <= 122)) || (($c >= 65) && ($c <= 90)) || (($c >= 48) && ($c <= 57)) || ($c === 58) || ($c === 46) || ($c === 95) || ($c === 45))) {
					#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:223: lines 223-224
					if ($start === $p) {
						#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:224: characters 8-13
						throw Exception::thrown(new XmlParserException("Expected attribute name", $str, $p));
					}
					#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:222: characters 7-15
					$tmp2 = \substr($str, $start, $p - $start);
					#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:226: characters 7-18
					$aname = $tmp2;
					#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:227: lines 227-228
					if ($xml->exists($aname)) {
						#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:228: characters 8-13
						throw Exception::thrown(new XmlParserException("Duplicate attribute [" . ($aname??'null') . "]", $str, $p));
					}
					#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:229: characters 7-30
					$state = 0;
					#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:230: characters 7-22
					$next = 6;
					#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:231: characters 7-15
					continue;
				}
			} else if ($__hx__switch === 6) {
				#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:234: lines 234-240
				if ($c === 61) {
					#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:236: characters 8-31
					$state = 0;
					#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:237: characters 8-29
					$next = 7;
				} else {
					#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:239: characters 8-13
					throw Exception::thrown(new XmlParserException("Expected =", $str, $p));
				}
			} else if ($__hx__switch === 7) {
				#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:242: lines 242-250
				if ($c === 34 || $c === 39) {
					#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:244: characters 8-16
					$buf = "";
					#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:245: characters 8-28
					$state = 8;
					#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:246: characters 8-21
					$start = $p + 1;
					#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:247: characters 8-24
					$attrValQuote = $c;
				} else {
					#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:249: characters 8-13
					throw Exception::thrown(new XmlParserException("Expected \"", $str, $p));
				}
			} else if ($__hx__switch === 8) {
				#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:252: lines 252-268
				if ($c === 38) {
					#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:254: characters 8-47
					$buf = ($buf . \substr($str, $start, $p - $start));
					#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:255: characters 8-24
					$state = 18;
					#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:256: characters 8-33
					$escapeNext = 8;
					#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:257: characters 8-21
					$start = $p + 1;
				} else if ($c === 60 || $c === 62) {
					#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:258: lines 258-267
					if ($strict) {
						#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:260: characters 8-13
						throw Exception::thrown(new XmlParserException("Invalid unescaped " . (\mb_chr($c)??'null') . " in attribute value", $str, $p));
					} else if ($c === $attrValQuote) {
						#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:262: characters 8-47
						$buf = ($buf . \substr($str, $start, $p - $start));
						#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:263: characters 8-22
						$val = $buf;
						#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:264: characters 8-16
						$buf = "";
						#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:265: characters 8-27
						$xml->set($aname, $val);
						#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:266: characters 8-31
						$state = 0;
						#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:267: characters 8-21
						$next = 4;
					}
				} else {
					#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:261: lines 261-267
					if ($c === $attrValQuote) {
						#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:262: characters 8-47
						$buf = ($buf . \substr($str, $start, $p - $start));
						#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:263: characters 8-22
						$val1 = $buf;
						#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:264: characters 8-16
						$buf = "";
						#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:265: characters 8-27
						$xml->set($aname, $val1);
						#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:266: characters 8-31
						$state = 0;
						#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:267: characters 8-21
						$next = 4;
					}
				}
			} else if ($__hx__switch === 9) {
				#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:270: characters 6-38
				$p = Parser::doParse($str, $strict, $p, $xml);
				#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:271: characters 6-15
				$start = $p;
				#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:272: characters 6-21
				$state = 1;
			} else if ($__hx__switch === 10) {
				#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:290: lines 290-304
				if (!((($c >= 97) && ($c <= 122)) || (($c >= 65) && ($c <= 90)) || (($c >= 48) && ($c <= 57)) || ($c === 58) || ($c === 46) || ($c === 95) || ($c === 45))) {
					#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:291: lines 291-292
					if ($start === $p) {
						#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:292: characters 8-13
						throw Exception::thrown(new XmlParserException("Expected node name", $str, $p));
					}
					#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:294: characters 7-44
					$v = \substr($str, $start, $p - $start);
					#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:295: lines 295-297
					if (($parent === null) || ($parent->nodeType !== 0)) {
						#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:296: characters 8-13
						throw Exception::thrown(new XmlParserException("Unexpected </" . ($v??'null') . ">, tag is not open", $str, $p));
					}
					#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:298: characters 16-31
					if ($parent->nodeType !== \Xml::$Element) {
						throw Exception::thrown("Bad node type, expected Element but found " . ((($parent->nodeType === null ? "null" : XmlType_Impl_::toString($parent->nodeType)))??'null'));
					}
					#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:298: lines 298-299
					if ($v !== $parent->nodeName) {
						#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:299: characters 53-68
						if ($parent->nodeType !== \Xml::$Element) {
							throw Exception::thrown("Bad node type, expected Element but found " . ((($parent->nodeType === null ? "null" : XmlType_Impl_::toString($parent->nodeType)))??'null'));
						}
						#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:299: characters 8-13
						throw Exception::thrown(new XmlParserException("Expected </" . ($parent->nodeName??'null') . ">", $str, $p));
					}
					#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:301: characters 7-30
					$state = 0;
					#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:302: characters 7-28
					$next = 12;
					#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:303: characters 7-15
					continue;
				}
			} else if ($__hx__switch === 11) {
				#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:274: lines 274-279
				if ($c === 62) {
					#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:276: characters 8-23
					$state = 1;
				} else {
					#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:278: characters 8-13
					throw Exception::thrown(new XmlParserException("Expected >", $str, $p));
				}
			} else if ($__hx__switch === 12) {
				#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:281: lines 281-288
				if ($c === 62) {
					#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:283: lines 283-284
					if ($nsubs === 0) {
						#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:284: characters 9-46
						$parent->addChild(\Xml::createPCData(""));
					}
					#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:285: characters 8-16
					return $p;
				} else {
					#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:287: characters 8-13
					throw Exception::thrown(new XmlParserException("Expected >", $str, $p));
				}
			} else if ($__hx__switch === 13) {
				#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:142: lines 142-154
				if ($c === 60) {
					#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:143: characters 7-46
					$buf = ($buf . \substr($str, $start, $p - $start));
					#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:144: characters 7-41
					$child = \Xml::createPCData($buf);
					#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:145: characters 7-15
					$buf = "";
					#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:146: characters 7-22
					$parent->addChild($child);
					++$nsubs;
					#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:147: characters 7-30
					$state = 0;
					#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:148: characters 7-26
					$next = 2;
				} else if ($c === 38) {
					#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:150: characters 7-46
					$buf = ($buf . \substr($str, $start, $p - $start));
					#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:151: characters 7-23
					$state = 18;
					#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:152: characters 7-28
					$escapeNext = 13;
					#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:153: characters 7-20
					$start = $p + 1;
				}
			} else if ($__hx__switch === 14) {
				#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:321: characters 10-60
				$tmp3 = null;
				if ($c === 63) {
					#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:321: characters 27-48
					$pos5 = $p + 1;
					#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:321: characters 10-60
					$tmp3 = (($pos5 >= \strlen($str) ? 0 : \ord($str[$pos5]))) === 62;
				} else {
					$tmp3 = false;
				}
				#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:321: lines 321-326
				if ($tmp3) {
					#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:322: characters 7-10
					++$p;
					#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:323: characters 7-54
					$str1 = \substr($str, $start + 1, $p - $start - 2);
					#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:324: characters 7-53
					$parent->addChild(\Xml::createProcessingInstruction($str1));
					++$nsubs;
					#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:325: characters 7-22
					$state = 1;
				}
			} else if ($__hx__switch === 15) {
				#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:306: characters 10-97
				$tmp4 = null;
				#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:306: characters 10-60
				$tmp5 = null;
				if ($c === 45) {
					#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:306: characters 27-48
					$pos6 = $p + 1;
					#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:306: characters 10-60
					$tmp5 = (($pos6 >= \strlen($str) ? 0 : \ord($str[$pos6]))) === 45;
				} else {
					$tmp5 = false;
				}
				#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:306: characters 10-97
				if ($tmp5) {
					#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:306: characters 64-85
					$pos7 = $p + 2;
					#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:306: characters 10-97
					$tmp4 = (($pos7 >= \strlen($str) ? 0 : \ord($str[$pos7]))) === 62;
				} else {
					$tmp4 = false;
				}
				#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:306: lines 306-310
				if ($tmp4) {
					#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:307: characters 7-64
					$parent->addChild(\Xml::createComment(\substr($str, $start, $p - $start)));
					++$nsubs;
					#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:308: characters 7-13
					$p += 2;
					#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:309: characters 7-22
					$state = 1;
				}
			} else if ($__hx__switch === 16) {
				#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:312: lines 312-319
				if ($c === 91) {
					#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:313: characters 7-18
					++$nbrackets;
				} else if ($c === 93) {
					#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:315: characters 7-18
					--$nbrackets;
				} else if (($c === 62) && ($nbrackets === 0)) {
					#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:317: characters 7-64
					$parent->addChild(\Xml::createDocType(\substr($str, $start, $p - $start)));
					++$nsubs;
					#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:318: characters 7-22
					$state = 1;
				}
			} else if ($__hx__switch === 17) {
				#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:156: characters 10-97
				$tmp6 = null;
				#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:156: characters 10-60
				$tmp7 = null;
				if ($c === 93) {
					#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:156: characters 27-48
					$pos8 = $p + 1;
					#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:156: characters 10-60
					$tmp7 = (($pos8 >= \strlen($str) ? 0 : \ord($str[$pos8]))) === 93;
				} else {
					$tmp7 = false;
				}
				#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:156: characters 10-97
				if ($tmp7) {
					#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:156: characters 64-85
					$pos9 = $p + 2;
					#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:156: characters 10-97
					$tmp6 = (($pos9 >= \strlen($str) ? 0 : \ord($str[$pos9]))) === 62;
				} else {
					$tmp6 = false;
				}
				#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:156: lines 156-161
				if ($tmp6) {
					#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:157: characters 7-65
					$child1 = \Xml::createCData(\substr($str, $start, $p - $start));
					#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:158: characters 7-22
					$parent->addChild($child1);
					++$nsubs;
					#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:159: characters 7-13
					$p += 2;
					#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:160: characters 7-22
					$state = 1;
				}
			} else if ($__hx__switch === 18) {
				#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:328: lines 328-351
				if ($c === 59) {
					#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:329: characters 7-44
					$s = \substr($str, $start, $p - $start);
					#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:330: lines 330-340
					if (((0 >= \strlen($s) ? 0 : \ord($s[0]))) === 35) {
						#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:331: lines 331-332
						$c1 = (((1 >= \strlen($s) ? 0 : \ord($s[1]))) === 120 ? \Std::parseInt("0" . (\substr($s, 1, \strlen($s) - 1)??'null')) : \Std::parseInt(\substr($s, 1, \strlen($s) - 1)));
						#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:333: characters 14-50
						$buf = ($buf . \mb_chr($c1));
					} else if (!\array_key_exists($s, Parser::$escapes->data)) {
						#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:335: lines 335-336
						if ($strict) {
							#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:336: characters 9-14
							throw Exception::thrown(new XmlParserException("Undefined entity: " . ($s??'null'), $str, $p));
						}
						#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:337: characters 8-40
						$buf = ($buf . ("&" . ($s??'null') . ";"));
					} else {
						#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:339: characters 14-48
						$buf = ($buf . (Parser::$escapes->data[$s] ?? null));
					}
					#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:341: characters 7-20
					$start = $p + 1;
					#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:342: characters 7-25
					$state = $escapeNext;
				} else if (!((($c >= 97) && ($c <= 122)) || (($c >= 65) && ($c <= 90)) || (($c >= 48) && ($c <= 57)) || ($c === 58) || ($c === 46) || ($c === 95) || ($c === 45)) && ($c !== 35)) {
					#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:344: lines 344-345
					if ($strict) {
						#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:345: characters 8-13
						throw Exception::thrown(new XmlParserException("Invalid character in entity: " . (\mb_chr($c)??'null'), $str, $p));
					}
					#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:346: characters 7-36
					$buf = ($buf . "&");
					#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:347: characters 7-46
					$buf = ($buf . \substr($str, $start, $p - $start));
					#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:348: characters 7-10
					--$p;
					#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:349: characters 7-20
					$start = $p + 1;
					#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:350: characters 7-25
					$state = $escapeNext;
				}
			}
			#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:353: characters 25-26
			$pos10 = ++$p;
			#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:353: characters 8-27
			$c = ($pos10 >= \strlen($str) ? 0 : \ord($str[$pos10]));
		}
		#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:356: lines 356-359
		if ($state === 1) {
			#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:357: characters 4-13
			$start = $p;
			#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:358: characters 4-20
			$state = 13;
		}
		#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:361: lines 361-370
		if ($state === 13) {
			#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:362: lines 362-364
			if ($parent->nodeType === 0) {
				#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:363: characters 54-69
				if ($parent->nodeType !== \Xml::$Element) {
					throw Exception::thrown("Bad node type, expected Element but found " . ((($parent->nodeType === null ? "null" : XmlType_Impl_::toString($parent->nodeType)))??'null'));
				}
				#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:363: characters 5-10
				throw Exception::thrown(new XmlParserException("Unclosed node <" . ($parent->nodeName??'null') . ">", $str, $p));
			}
			#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:365: lines 365-368
			if (($p !== $start) || ($nsubs === 0)) {
				#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:366: characters 5-44
				$buf = ($buf . \substr($str, $start, $p - $start));
				#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:367: characters 5-36
				$parent->addChild(\Xml::createPCData($buf));
				++$nsubs;
			}
			#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:369: characters 4-12
			return $p;
		}
		#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:372: lines 372-377
		if (!$strict && ($state === 18) && ($escapeNext === 13)) {
			#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:373: characters 4-33
			$buf = ($buf . "&");
			#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:374: characters 4-43
			$buf = ($buf . \substr($str, $start, $p - $start));
			#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:375: characters 4-35
			$parent->addChild(\Xml::createPCData($buf));
			++$nsubs;
			#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:376: characters 4-12
			return $p;
		}
		#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:379: characters 3-8
		throw Exception::thrown(new XmlParserException("Unexpected end", $str, $p));
	}

	/**
	 * @param string $str
	 * @param bool $strict
	 * 
	 * @return \Xml
	 */
	public static function parse ($str, $strict = false) {
		#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:99: lines 99-103
		if ($strict === null) {
			$strict = false;
		}
		#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:100: characters 3-34
		$doc = \Xml::createDocument();
		#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:101: characters 3-31
		Parser::doParse($str, $strict, 0, $doc);
		#C:\HaxeToolkit\haxe\std/php/_std/haxe/xml/Parser.hx:102: characters 3-13
		return $doc;
	}

	/**
	 * @internal
	 * @access private
	 */
	static public function __hx__init ()
	{
		static $called = false;
		if ($called) return;
		$called = true;


		$h = new StringMap();
		$h->data["lt"] = "<";
		$h->data["gt"] = ">";
		$h->data["amp"] = "&";
		$h->data["quot"] = "\"";
		$h->data["apos"] = "'";
		self::$escapes = $h;
	}
}

Boot::registerClass(Parser::class, 'haxe.xml.Parser');
Parser::__hx__init();
