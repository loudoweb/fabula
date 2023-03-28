<?php
/**
 */

namespace fabula\condition\_VariableCollection;

use \php\Boot;
use \fabula\condition\Variable;

final class VariableCollection_Impl_ {
	/**
	 * @return Variable[]|\Array_hx
	 */
	public static function _new () {
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/VariableCollection.hx:10: character 2
		$this1 = new \Array_hx();
		return $this1;
	}

	/**
	 * @param Variable[]|\Array_hx $this
	 * @param string $id
	 * 
	 * @return Variable
	 */
	public static function get ($this1, $id) {
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/VariableCollection.hx:23: lines 23-27
		$_g = 0;
		while ($_g < $this1->length) {
			#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/VariableCollection.hx:23: characters 8-12
			$vari = ($this1->arr[$_g] ?? null);
			#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/VariableCollection.hx:23: lines 23-27
			++$_g;
			#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/VariableCollection.hx:25: lines 25-26
			if ($vari->id === $id) {
				#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/VariableCollection.hx:26: characters 5-16
				return $vari;
			}
		}
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/VariableCollection.hx:28: characters 3-14
		return null;
	}

	/**
	 * @param Variable[]|\Array_hx $this
	 * @param int $id
	 * 
	 * @return Variable
	 */
	public static function getUserByIndex ($this1, $id) {
		#C:\HaxeToolkit\haxe\lib\fabula/git/src/fabula/condition/VariableCollection.hx:18: characters 3-18
		return ($this1->arr[$id] ?? null);
	}
}

Boot::registerClass(VariableCollection_Impl_::class, 'fabula.condition._VariableCollection.VariableCollection_Impl_');
