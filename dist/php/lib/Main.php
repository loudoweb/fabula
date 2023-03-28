<?php
/**
 */

use \php\Boot;
use \fabula\Fabula;

class Main {
	/**
	 * @var Fabula
	 */
	static public $story;

	/**
	 * @return void
	 */
	public static function main () {
		#Main.hx:6: characters 9-748
		$xml = "<?xml version=\"1.0\" encoding=\"utf-8\" ?><data><sequence id=\"Talk_to_kid\"><event speaker=\"kid_sad\" if=\"kid_angry\" text=\"I won`'t talk to you anymore...\" exit=\"true\"/><event speaker=\"kid\" if=\"!kid_happy\" text=\"Hi, have you seen my new toy ? I love it!\"/><event speaker=\"kid\" text=\"Do you want to play with me?\"><choice id=\"kid_angry\" text=\"Your toy looks like crap!\"/><choice id=\"kid_happy\" text=\"Yes, I love it!\" target=\"kid_happy\"/><choice id=\"goto_elsewhere\" text=\"Leave him alone\" exit=\"true\"/></event><event if=\"kid_angry\" speaker=\"kid_angry\" text=\"You're so mean!\" exit=\"true\"/><event id=\"kid_happy\" speaker=\"kid_happy\" ><text><![CDATA[Thanks! <font color=\"#2281AB\">Let's play!</font>]]></text></event></sequence></data>";
		#Main.hx:8: characters 9-34
		Main::$story = new Fabula(\Array_hx::wrap([$xml]));
		#Main.hx:9: characters 9-29
		Main::$story->getNextEvent();
	}

	/**
	 * @return void
	 */
	public function __construct () {
	}
}

Boot::registerClass(Main::class, 'Main');
