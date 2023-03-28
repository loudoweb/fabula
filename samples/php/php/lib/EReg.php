<?php
/**
 */

use \php\Boot;
use \haxe\Exception as HaxeException;

/**
 * The EReg class represents regular expressions.
 * While basic usage and patterns consistently work across platforms, some more
 * complex operations may yield different results. This is a necessary trade-
 * off to retain a certain level of performance.
 * EReg instances can be created by calling the constructor, or with the
 * special syntax `~/pattern/modifier`
 * EReg instances maintain an internal state, which is affected by several of
 * its methods.
 * A detailed explanation of the supported operations is available at
 * <https://haxe.org/manual/std-regex.html>
 */
final class EReg {
	/**
	 * @var bool
	 */
	public $global;
	/**
	 * @var string
	 */
	public $options;
	/**
	 * @var string
	 */
	public $pattern;
	/**
	 * @var string
	 */
	public $re;

	/**
	 * Creates a new regular expression with pattern `r` and modifiers `opt`.
	 * This is equivalent to the shorthand syntax `~/r/opt`
	 * If `r` or `opt` are null, the result is unspecified.
	 * 
	 * @param string $r
	 * @param string $opt
	 * 
	 * @return void
	 */
	public function __construct ($r, $opt) {
		#C:\HaxeToolkit\haxe\std/php/_std/EReg.hx:37: characters 3-19
		$this->pattern = $r;
		#C:\HaxeToolkit\haxe\std/php/_std/EReg.hx:38: characters 3-45
		$this->options = str_replace("g", "", $opt);
		#C:\HaxeToolkit\haxe\std/php/_std/EReg.hx:39: characters 3-26
		$this->global = $this->options !== $opt;
		#C:\HaxeToolkit\haxe\std/php/_std/EReg.hx:40: characters 3-49
		$this->options = str_replace("u", "", $this->options);
		#C:\HaxeToolkit\haxe\std/php/_std/EReg.hx:41: characters 3-68
		$this->re = "\"" . (str_replace("\"", "\\\"", $r)??'null') . "\"" . ($this->options??'null');
	}

	/**
	 * @return void
	 */
	public function handlePregError () {
		#C:\HaxeToolkit\haxe\std/php/_std/EReg.hx:63: characters 3-36
		$e = preg_last_error();
		#C:\HaxeToolkit\haxe\std/php/_std/EReg.hx:64: lines 64-72
		if ($e === PREG_INTERNAL_ERROR) {
			#C:\HaxeToolkit\haxe\std/php/_std/EReg.hx:65: characters 4-9
			throw HaxeException::thrown("EReg: internal PCRE error");
		} else if ($e === PREG_BACKTRACK_LIMIT_ERROR) {
			#C:\HaxeToolkit\haxe\std/php/_std/EReg.hx:67: characters 4-9
			throw HaxeException::thrown("EReg: backtrack limit");
		} else if ($e === PREG_RECURSION_LIMIT_ERROR) {
			#C:\HaxeToolkit\haxe\std/php/_std/EReg.hx:69: characters 4-9
			throw HaxeException::thrown("EReg: recursion limit");
		} else if ($e === PREG_JIT_STACKLIMIT_ERROR) {
			#C:\HaxeToolkit\haxe\std/php/_std/EReg.hx:71: characters 4-9
			throw HaxeException::thrown("failed due to limited JIT stack space");
		}
	}

	/**
	 * Replaces the first substring of `s` which `this` EReg matches with `by`.
	 * If `this` EReg does not match any substring, the result is `s`.
	 * By default, this method replaces only the first matched substring. If
	 * the global g modifier is in place, all matched substrings are replaced.
	 * If `by` contains `$1` to `$9`, the digit corresponds to number of a
	 * matched sub-group and its value is used instead. If no such sub-group
	 * exists, the replacement is unspecified. The string `$$` becomes `$`.
	 * If `s` or `by` are null, the result is unspecified.
	 * 
	 * @param string $s
	 * @param string $by
	 * 
	 * @return string
	 */
	public function replace ($s, $by) {
		#C:\HaxeToolkit\haxe\std/php/_std/EReg.hx:137: characters 3-46
		$by = str_replace("\\\$", "\\\\\$", $by);
		#C:\HaxeToolkit\haxe\std/php/_std/EReg.hx:138: characters 3-43
		$by = str_replace("\$\$", "\\\$", $by);
		#C:\HaxeToolkit\haxe\std/php/_std/EReg.hx:139: lines 139-141
		if (!preg_match("/\\\\([^?].*?\\\\)/", $this->re)) {
			#C:\HaxeToolkit\haxe\std/php/_std/EReg.hx:140: characters 4-57
			$by = preg_replace("/\\\$(\\d+)/", "\\\$\\1", $by);
		}
		#C:\HaxeToolkit\haxe\std/php/_std/EReg.hx:142: characters 3-71
		$result = preg_replace(($this->re . "u"), $by, $s, ($this->global ? -1 : 1));
		#C:\HaxeToolkit\haxe\std/php/_std/EReg.hx:143: lines 143-146
		if ($result === null) {
			#C:\HaxeToolkit\haxe\std/php/_std/EReg.hx:144: characters 4-21
			$this->handlePregError();
			#C:\HaxeToolkit\haxe\std/php/_std/EReg.hx:145: characters 4-60
			$result = preg_replace($this->re, $by, $s, ($this->global ? -1 : 1));
		}
		#C:\HaxeToolkit\haxe\std/php/_std/EReg.hx:147: characters 3-16
		return $result;
	}
}

Boot::registerClass(EReg::class, 'EReg');
