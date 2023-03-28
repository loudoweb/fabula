<?php
/**
 */

namespace fabula;

use \php\_Boot\HxAnon;
use \haxe\xml\_Access\HasAttribAccess_Impl_;
use \php\Boot;
use \haxe\Exception;
use \haxe\Log;
use \haxe\xml\_Access\NodeListAccess_Impl_;
use \fabula\condition\EVariableType;
use \haxe\xml\_Access\AttribAccess_Impl_;
use \haxe\xml\_Access\HasNodeAccess_Impl_;
use \_Xml\XmlType_Impl_;
use \fabula\condition\ConditionFactory;
use \haxe\xml\_Access\NodeAccess_Impl_;
use \haxe\xml\_Access\Access_Impl_;

class FabulaXmlParser {
	/**
	 * @var int
	 */
	static public $ID_GEN_COUNT;
	/**
	 * @var string
	 */
	static public $ID_GEN_HELPER;
	/**
	 * @var ConditionFactory
	 */
	static public $_conditionFactory;
	/**
	 * @var \Xml
	 */
	static public $_xml;

	/**
	 * @param \Xml $element
	 * 
	 * @return string
	 */
	public static function getText ($element) {
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/FabulaXmlParser.hx:111: characters 3-40
		$text = (HasAttribAccess_Impl_::resolve($element, "text") ? AttribAccess_Impl_::resolve($element, "text") : "");
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/FabulaXmlParser.hx:112: lines 112-115
		if (($text === "") && HasNodeAccess_Impl_::resolve($element, "text")) {
			#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/FabulaXmlParser.hx:114: characters 4-38
			$text = Access_Impl_::get_innerData(NodeAccess_Impl_::resolve($element, "text"));
		}
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/FabulaXmlParser.hx:116: characters 3-14
		return $text;
	}

	/**
	 * @param string $raw
	 * @param ConditionFactory $conditionFactory
	 * @param string[]|\Array_hx $achievedListID
	 * 
	 * @return object
	 */
	public static function parse ($raw, $conditionFactory, $achievedListID) {
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/FabulaXmlParser.hx:22: characters 3-39
		FabulaXmlParser::$_conditionFactory = $conditionFactory;
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/FabulaXmlParser.hx:24: characters 10-51
		$x = \Xml::parse($raw)->firstElement();
		if (($x->nodeType !== \Xml::$Document) && ($x->nodeType !== \Xml::$Element)) {
			throw Exception::thrown("Invalid nodeType " . ((($x->nodeType === null ? "null" : XmlType_Impl_::toString($x->nodeType)))??'null'));
		}
		$this1 = $x;
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/FabulaXmlParser.hx:24: characters 3-51
		FabulaXmlParser::$_xml = $this1;
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/FabulaXmlParser.hx:26: characters 3-38
		$sequences = new \Array_hx();
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/FabulaXmlParser.hx:28: lines 28-99
		$_g = 0;
		$_g1 = NodeListAccess_Impl_::resolve(FabulaXmlParser::$_xml, "sequence");
		while ($_g < $_g1->length) {
			#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/FabulaXmlParser.hx:28: characters 8-16
			$sequence = ($_g1->arr[$_g] ?? null);
			#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/FabulaXmlParser.hx:28: lines 28-99
			++$_g;
			#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/FabulaXmlParser.hx:30: lines 30-34
			if (!HasAttribAccess_Impl_::resolve($sequence, "id")) {
				#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/FabulaXmlParser.hx:32: characters 5-10
				(Log::$trace)("id attribute is mandatory in the sequence tag", new _HxAnon_FabulaXmlParser0("fabula/FabulaXmlParser.hx", 32, "fabula.FabulaXmlParser", "parse"));
				#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/FabulaXmlParser.hx:33: characters 5-13
				continue;
			}
			#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/FabulaXmlParser.hx:35: characters 4-34
			$seqName = AttribAccess_Impl_::resolve($sequence, "id");
			#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/FabulaXmlParser.hx:36: characters 4-27
			FabulaXmlParser::$ID_GEN_HELPER = $seqName;
			#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/FabulaXmlParser.hx:37: characters 4-20
			FabulaXmlParser::$ID_GEN_COUNT = 0;
			#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/FabulaXmlParser.hx:39: characters 4-33
			$events = new \Array_hx();
			#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/FabulaXmlParser.hx:40: characters 4-27
			$event = null;
			#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/FabulaXmlParser.hx:41: characters 4-36
			$seq = new Sequence($seqName);
			#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/FabulaXmlParser.hx:42: characters 4-73
			$seq->addConditions(FabulaXmlParser::$_conditionFactory->create((HasAttribAccess_Impl_::resolve($sequence, "if") ? AttribAccess_Impl_::resolve($sequence, "if") : "")));
			#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/FabulaXmlParser.hx:44: characters 16-33
			$key = $sequence->elements();
			while ($key->hasNext()) {
				#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/FabulaXmlParser.hx:44: lines 44-82
				$key1 = $key->next();
				#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/FabulaXmlParser.hx:46: characters 13-21
				$_g2 = null;
				if ($key1->nodeType === \Xml::$Document) {
					$_g2 = "Document";
				} else {
					if ($key1->nodeType !== \Xml::$Element) {
						throw Exception::thrown("Bad node type, expected Element but found " . ((($key1->nodeType === null ? "null" : XmlType_Impl_::toString($key1->nodeType)))??'null'));
					}
					$_g2 = $key1->nodeName;
				}
				if ($_g2 === "choice") {
					#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/FabulaXmlParser.hx:73: lines 73-77
					if ($event === null) {
						#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/FabulaXmlParser.hx:75: characters 8-13
						(Log::$trace)("impossible to add a choice without a parent event", new _HxAnon_FabulaXmlParser0("fabula/FabulaXmlParser.hx", 75, "fabula.FabulaXmlParser", "parse"));
						#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/FabulaXmlParser.hx:76: characters 8-13
						break;
					}
					#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/FabulaXmlParser.hx:78: characters 34-92
					$defaultValue = (FabulaXmlParser::$ID_GEN_HELPER??'null') . "_C" . (++FabulaXmlParser::$ID_GEN_COUNT);
					#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/FabulaXmlParser.hx:78: characters 54-91
					if ($defaultValue === null) {
						$defaultValue = "";
					}
					#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/FabulaXmlParser.hx:78: characters 34-92
					$tmp = (HasAttribAccess_Impl_::resolve($key1, "id") ? AttribAccess_Impl_::resolve($key1, "id") : $defaultValue);
					#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/FabulaXmlParser.hx:79: characters 8-20
					$tmp1 = FabulaXmlParser::getText($key1);
					#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/FabulaXmlParser.hx:79: characters 22-43
					$tmp2 = (HasAttribAccess_Impl_::resolve($key1, "type") ? AttribAccess_Impl_::resolve($key1, "type") : "");
					#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/FabulaXmlParser.hx:79: characters 45-90
					$tmp3 = FabulaXmlParser::$_conditionFactory->create((HasAttribAccess_Impl_::resolve($key1, "if") ? AttribAccess_Impl_::resolve($key1, "if") : ""));
					#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/FabulaXmlParser.hx:80: characters 8-31
					$tmp4 = (HasAttribAccess_Impl_::resolve($key1, "target") ? AttribAccess_Impl_::resolve($key1, "target") : "");
					#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/FabulaXmlParser.hx:80: characters 33-66
					$defaultValue1 = $event->isExit;
					#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/FabulaXmlParser.hx:80: characters 53-65
					if ($defaultValue1 === null) {
						$defaultValue1 = true;
					}
					#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/FabulaXmlParser.hx:78: lines 78-80
					$event->addChoice(new Choice($tmp, $tmp1, $tmp2, $tmp3, $tmp4, (HasAttribAccess_Impl_::resolve($key1, "exit") ? AttribAccess_Impl_::resolve($key1, "exit") === "true" : $defaultValue1)));
				} else if ($_g2 === "event") {
					#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/FabulaXmlParser.hx:52: characters 25-83
					$defaultValue2 = (FabulaXmlParser::$ID_GEN_HELPER??'null') . "_E" . (++FabulaXmlParser::$ID_GEN_COUNT);
					#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/FabulaXmlParser.hx:52: characters 45-82
					if ($defaultValue2 === null) {
						$defaultValue2 = "";
					}
					#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/FabulaXmlParser.hx:52: characters 25-83
					$event1 = (HasAttribAccess_Impl_::resolve($key1, "id") ? AttribAccess_Impl_::resolve($key1, "id") : $defaultValue2);
					#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/FabulaXmlParser.hx:52: characters 85-97
					$event2 = FabulaXmlParser::getText($key1);
					#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/FabulaXmlParser.hx:53: characters 8-53
					$event3 = FabulaXmlParser::$_conditionFactory->create((HasAttribAccess_Impl_::resolve($key1, "if") ? AttribAccess_Impl_::resolve($key1, "if") : ""));
					#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/FabulaXmlParser.hx:53: characters 55-81
					$defaultValue3 = false;
					#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/FabulaXmlParser.hx:53: characters 75-80
					if ($defaultValue3 === null) {
						$defaultValue3 = true;
					}
					#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/FabulaXmlParser.hx:53: characters 55-81
					$event4 = (HasAttribAccess_Impl_::resolve($key1, "exit") ? AttribAccess_Impl_::resolve($key1, "exit") === "true" : $defaultValue3);
					#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/FabulaXmlParser.hx:54: characters 8-31
					$defaultValue4 = 1;
					#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/FabulaXmlParser.hx:54: characters 29-30
					if ($defaultValue4 === null) {
						$defaultValue4 = 0;
					}
					#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/FabulaXmlParser.hx:54: characters 8-31
					$event5 = (HasAttribAccess_Impl_::resolve($key1, "weight") ? \Std::parseInt(AttribAccess_Impl_::resolve($key1, "weight")) : $defaultValue4);
					#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/FabulaXmlParser.hx:54: characters 33-59
					$defaultValue5 = false;
					#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/FabulaXmlParser.hx:54: characters 53-58
					if ($defaultValue5 === null) {
						$defaultValue5 = true;
					}
					#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/FabulaXmlParser.hx:54: characters 33-59
					$event6 = (HasAttribAccess_Impl_::resolve($key1, "once") ? AttribAccess_Impl_::resolve($key1, "once") === "true" : $defaultValue5);
					#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/FabulaXmlParser.hx:54: characters 61-85
					$event7 = (HasAttribAccess_Impl_::resolve($key1, "speaker") ? AttribAccess_Impl_::resolve($key1, "speaker") : "");
					#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/FabulaXmlParser.hx:55: characters 8-34
					$event8 = (HasAttribAccess_Impl_::resolve($key1, "listeners") ? AttribAccess_Impl_::resolve($key1, "listeners") : "");
					#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/FabulaXmlParser.hx:55: characters 36-64
					$event9 = (HasAttribAccess_Impl_::resolve($key1, "environment") ? AttribAccess_Impl_::resolve($key1, "environment") : "");
					#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/FabulaXmlParser.hx:52: lines 52-55
					$event = new Event($event1, $event2, $event3, $event4, $event5, $event6, $event7, $event8, $event9, (HasAttribAccess_Impl_::resolve($key1, "target") ? AttribAccess_Impl_::resolve($key1, "target") : ""));
					#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/FabulaXmlParser.hx:57: lines 57-70
					if (HasNodeAccess_Impl_::resolve($key1, "choice")) {
						#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/FabulaXmlParser.hx:60: lines 60-69
						$_g3 = 0;
						$_g4 = NodeListAccess_Impl_::resolve($key1, "choice");
						while ($_g3 < $_g4->length) {
							#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/FabulaXmlParser.hx:60: characters 13-19
							$choice = ($_g4->arr[$_g3] ?? null);
							#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/FabulaXmlParser.hx:60: lines 60-69
							++$_g3;
							#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/FabulaXmlParser.hx:62: lines 62-63
							$defaultValue6 = (FabulaXmlParser::$ID_GEN_HELPER??'null') . "_C" . (++FabulaXmlParser::$ID_GEN_COUNT);
							#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/FabulaXmlParser.hx:63: characters 10-47
							if ($defaultValue6 === null) {
								$defaultValue6 = "";
							}
							#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/FabulaXmlParser.hx:62: lines 62-63
							$tmp5 = (HasAttribAccess_Impl_::resolve($choice, "id") ? AttribAccess_Impl_::resolve($choice, "id") : $defaultValue6);
							#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/FabulaXmlParser.hx:63: characters 50-65
							$tmp6 = FabulaXmlParser::getText($choice);
							#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/FabulaXmlParser.hx:64: characters 10-34
							$tmp7 = (HasAttribAccess_Impl_::resolve($choice, "type") ? AttribAccess_Impl_::resolve($choice, "type") : "");
							#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/FabulaXmlParser.hx:64: characters 36-84
							$tmp8 = FabulaXmlParser::$_conditionFactory->create((HasAttribAccess_Impl_::resolve($choice, "if") ? AttribAccess_Impl_::resolve($choice, "if") : ""));
							#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/FabulaXmlParser.hx:65: characters 10-36
							$tmp9 = (HasAttribAccess_Impl_::resolve($choice, "target") ? AttribAccess_Impl_::resolve($choice, "target") : "");
							#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/FabulaXmlParser.hx:65: characters 38-74
							$defaultValue7 = $event->isExit;
							#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/FabulaXmlParser.hx:65: characters 61-73
							if ($defaultValue7 === null) {
								$defaultValue7 = true;
							}
							#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/FabulaXmlParser.hx:62: lines 62-65
							$event->addChoice(new Choice($tmp5, $tmp6, $tmp7, $tmp8, $tmp9, (HasAttribAccess_Impl_::resolve($choice, "exit") ? AttribAccess_Impl_::resolve($choice, "exit") === "true" : $defaultValue7)));
						}
					}
					#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/FabulaXmlParser.hx:71: characters 7-25
					$events->arr[$events->length++] = $event;
				} else if ($_g2 === "variable") {
					#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/FabulaXmlParser.hx:49: lines 49-50
					$seq->addVariable(AttribAccess_Impl_::resolve($key1, "id"), \Type::createEnum(Boot::getClass(EVariableType::class), \mb_strtoupper(AttribAccess_Impl_::resolve($key1, "type"))), AttribAccess_Impl_::resolve($key1, "value"));
				}
			};
			#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/FabulaXmlParser.hx:84: lines 84-94
			if ($event !== null) {
				#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/FabulaXmlParser.hx:86: characters 5-24
				$event->isExit = true;
				#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/FabulaXmlParser.hx:87: lines 87-93
				if ($event->choices !== null) {
					#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/FabulaXmlParser.hx:89: lines 89-92
					$_g5 = 0;
					$_g6 = $event->choices;
					while ($_g5 < $_g6->length) {
						#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/FabulaXmlParser.hx:89: characters 11-17
						$choice1 = ($_g6->arr[$_g5] ?? null);
						#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/FabulaXmlParser.hx:89: lines 89-92
						++$_g5;
						#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/FabulaXmlParser.hx:91: characters 7-27
						$choice1->isExit = true;
					}
				}
			}
			#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/FabulaXmlParser.hx:97: characters 4-27
			$seq->addSequence($events);
			#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/FabulaXmlParser.hx:98: characters 4-23
			$sequences->arr[$sequences->length++] = $seq;
		}
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/FabulaXmlParser.hx:102: lines 102-105
		$_g = 0;
		$_g1 = NodeListAccess_Impl_::resolve(FabulaXmlParser::$_xml, "list");
		while ($_g < $_g1->length) {
			#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/FabulaXmlParser.hx:102: characters 8-12
			$list = ($_g1->arr[$_g] ?? null);
			#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/FabulaXmlParser.hx:102: lines 102-105
			++$_g;
			#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/FabulaXmlParser.hx:104: characters 4-9
			(Log::$trace)("coucou list", new _HxAnon_FabulaXmlParser0("fabula/FabulaXmlParser.hx", 104, "fabula.FabulaXmlParser", "parse"));
		}
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/FabulaXmlParser.hx:106: characters 3-32
		return new _HxAnon_FabulaXmlParser1($sequences);
	}
}

class _HxAnon_FabulaXmlParser0 extends HxAnon {
	function __construct($fileName, $lineNumber, $className, $methodName) {
		$this->fileName = $fileName;
		$this->lineNumber = $lineNumber;
		$this->className = $className;
		$this->methodName = $methodName;
	}
}

class _HxAnon_FabulaXmlParser1 extends HxAnon {
	function __construct($sequences) {
		$this->sequences = $sequences;
	}
}

Boot::registerClass(FabulaXmlParser::class, 'fabula.FabulaXmlParser');
