<?php
/**
 */

use \php\_Boot\HxAnon;
use \php\Boot;
use \php\_Boot\HxClass;
use \haxe\Exception as HaxeException;
use \php\_Boot\HxEnum;

/**
 * The Haxe Reflection API allows retrieval of type information at runtime.
 * This class complements the more lightweight Reflect class, with a focus on
 * class and enum instances.
 * @see https://haxe.org/manual/types.html
 * @see https://haxe.org/manual/std-reflection.html
 */
class Type {
	/**
	 * Creates an instance of enum `e` by calling its constructor `constr` with
	 * arguments `params`.
	 * If `e` or `constr` is null, or if enum `e` has no constructor named
	 * `constr`, or if the number of elements in `params` does not match the
	 * expected number of constructor arguments, or if any argument has an
	 * invalid type, the result is unspecified.
	 * 
	 * @param Enum $e
	 * @param string $constr
	 * @param mixed[]|\Array_hx $params
	 * 
	 * @return mixed
	 */
	public static function createEnum ($e, $constr, $params = null) {
		#C:\HaxeToolkit\haxe\std/php/_std/Type.hx:145: lines 145-146
		if (($e === null) || ($constr === null)) {
			#C:\HaxeToolkit\haxe\std/php/_std/Type.hx:146: characters 4-15
			return null;
		}
		#C:\HaxeToolkit\haxe\std/php/_std/Type.hx:148: characters 3-43
		$phpName = $e->phpClassName;
		#C:\HaxeToolkit\haxe\std/php/_std/Type.hx:150: lines 150-152
		if (!in_array($constr, $phpName::__hx__list())) {
			#C:\HaxeToolkit\haxe\std/php/_std/Type.hx:151: characters 4-9
			throw HaxeException::thrown("No such constructor " . ($constr??'null'));
		}
		#C:\HaxeToolkit\haxe\std/php/_std/Type.hx:154: characters 3-92
		$paramsCounts = $phpName::__hx__paramsCount();
		#C:\HaxeToolkit\haxe\std/php/_std/Type.hx:155: lines 155-157
		if ((($params === null) && ($paramsCounts[$constr] !== 0)) || (($params !== null) && ($params->length !== $paramsCounts[$constr]))) {
			#C:\HaxeToolkit\haxe\std/php/_std/Type.hx:156: characters 4-9
			throw HaxeException::thrown("Provided parameters count does not match expected parameters count");
		}
		#C:\HaxeToolkit\haxe\std/php/_std/Type.hx:159: lines 159-164
		if ($params === null) {
			#C:\HaxeToolkit\haxe\std/php/_std/Type.hx:160: characters 4-45
			return $phpName::{$constr}();
		} else {
			#C:\HaxeToolkit\haxe\std/php/_std/Type.hx:162: characters 4-60
			$nativeArgs = $params->arr;
			#C:\HaxeToolkit\haxe\std/php/_std/Type.hx:163: characters 4-71
			return $phpName::{$constr}(...$nativeArgs);
		}
	}

	/**
	 * Returns the class of `o`, if `o` is a class instance.
	 * If `o` is null or of a different type, null is returned.
	 * In general, type parameter information cannot be obtained at runtime.
	 * 
	 * @param mixed $o
	 * 
	 * @return Class
	 */
	public static function getClass ($o) {
		#C:\HaxeToolkit\haxe\std/php/_std/Type.hx:43: lines 43-50
		if (is_object($o) && !($o instanceof HxClass) && !($o instanceof HxEnum)) {
			#C:\HaxeToolkit\haxe\std/php/_std/Type.hx:44: characters 4-54
			$cls = Boot::getClass(get_class($o));
			#C:\HaxeToolkit\haxe\std/php/_std/Type.hx:45: characters 11-45
			if (($o instanceof HxAnon)) {
				#C:\HaxeToolkit\haxe\std/php/_std/Type.hx:45: characters 29-33
				return null;
			} else {
				#C:\HaxeToolkit\haxe\std/php/_std/Type.hx:45: characters 36-44
				return $cls;
			}
		} else if (is_string($o)) {
			#C:\HaxeToolkit\haxe\std/php/_std/Type.hx:47: characters 4-22
			return Boot::getClass('String');
		} else {
			#C:\HaxeToolkit\haxe\std/php/_std/Type.hx:49: characters 4-15
			return null;
		}
	}

	/**
	 * Returns the name of class `c`, including its path.
	 * If `c` is inside a package, the package structure is returned dot-
	 * separated, with another dot separating the class name:
	 * `pack1.pack2.(...).packN.ClassName`
	 * If `c` is a sub-type of a Haxe module, that module is not part of the
	 * package structure.
	 * If `c` has no package, the class name is returned.
	 * If `c` is null, the result is unspecified.
	 * The class name does not include any type parameters.
	 * 
	 * @param Class $c
	 * 
	 * @return string
	 */
	public static function getClassName ($c) {
		#C:\HaxeToolkit\haxe\std/php/_std/Type.hx:73: lines 73-74
		if ($c === null) {
			#C:\HaxeToolkit\haxe\std/php/_std/Type.hx:74: characters 4-15
			return null;
		}
		#C:\HaxeToolkit\haxe\std/php/_std/Type.hx:75: characters 3-34
		return Boot::getHaxeName($c);
	}
}

Boot::registerClass(Type::class, 'Type');
