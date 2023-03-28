<?php
/**
 */

namespace fabula\condition\_EConditionOp;

use \php\Boot;

final class EConditionOp_Impl_ {

	/**
	 * @param string $s
	 * 
	 * @return string
	 */
	public static function fromString ($s) {
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/EConditionOp.hx:20: lines 20-40
		if ($s === "!") {
			#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/EConditionOp.hx:33: characters 5-21
			return "!";
		} else if ($s === "!in") {
			#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/EConditionOp.hx:35: characters 5-18
			return "!in";
		} else if ($s === "<") {
			#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/EConditionOp.hx:25: characters 5-17
			return "<";
		} else if ($s === "<=") {
			#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/EConditionOp.hx:29: characters 5-23
			return "<=";
		} else if ($s === "=") {
			#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/EConditionOp.hx:31: characters 5-17
			return "=";
		} else if ($s === ">") {
			#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/EConditionOp.hx:23: characters 5-19
			return ">";
		} else if ($s === ">=") {
			#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/EConditionOp.hx:27: characters 5-25
			return ">=";
		} else if ($s === "in") {
			#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/EConditionOp.hx:37: characters 5-14
			return "in";
		} else {
			#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/EConditionOp.hx:39: characters 5-16
			return null;
		}
	}
}

Boot::registerClass(EConditionOp_Impl_::class, 'fabula.condition._EConditionOp.EConditionOp_Impl_');
