<?php

set_include_path(get_include_path().PATH_SEPARATOR.__DIR__.'/php/lib');
spl_autoload_register(
	function($class){
		$file = stream_resolve_include_path(str_replace('\\', '/', $class) .'.php');
		if ($file) {
			include_once $file;
		}
	}
);
\php\Boot::__hx__init();
use \fabula\Fabula;

ob_start(); // only php Echo
session_start(); // start php session

/*
* we load the Fabula library and defines an XML string containing.
* When we define $story, $event, $choice.
*/
$xml = '<?xml version="1.0" encoding="utf-8" ?><data><sequence id="Talk_to_kid"><event speaker="kid_sad" if="kid_angry" text="I won`\'t talk to you anymore..." exit="true"/><event speaker="kid" if="!kid_happy" text="Hi, have you seen my new toy ? I love it!"/><event speaker="kid" text="Do you want to play with me?"><choice id="kid_angry" text="Your toy looks like crap!"/><choice id="kid_happy" text="Yes, I love it!" target="kid_happy"/><choice id="goto_elsewhere" text="Leave him alone" exit="true"/></event><event if="kid_angry" speaker="kid_angry" text="You\'re so mean!" exit="true"/><event id="kid_happy" speaker="kid_happy" ><text><![CDATA[Thanks! <font color="#2281AB">Let\'s play!</font>]]></text></event></sequence></data>';
$story = new Fabula(\Array_hx::wrap([$xml]));
$story->selectSequence("Talk_to_kid");
$event = $story->getNextEvent();
$choice = $event->getChoices();

if (isset($_POST["id"])) {
	$story->completedID = $_SESSION['ArrayCompleteId'];
	$story->currentSequence->currentId = $_SESSION['EventId'];

	//Select the choice with choice id
    $story->selectChoice($id = $_POST["id"], $index = null);
	$event = $story->getNextEvent();

	if($event != null){

		//send speaker, label and choice to HTML
		$response = [
			'speaker' => json_encode($event->speaker),
			'label'  => json_encode($event->text),
			'choice' => json_encode($choice),
			'logs' => ob_get_contents()
		];

		//stock event id in complete id array
		$_SESSION['EventId'] = $story->currentSequence->currentId;
		$story->completedID[] = $_SESSION['EventId'];

		//stock the complete id array
		$_SESSION['ArrayCompleteId'] = $story->completedID;
	} else {
		$response = null;
	}

	ob_clean();
	header('Content-Type: application/json');
	echo json_encode($response);
} else {
	$event = $story->getNextEvent();
	$choice = $event->getChoices();

	$story->completedID = $_SESSION['ArrayCompleteId'];
	$response = [
		'speaker' => json_encode($event->speaker),
		'label'  => json_encode($event->text),
		'choice' => json_encode($choice),
        'logs' => ob_get_contents()
	];

	//stock event id in complete id array
	$_SESSION['EventId'] = $story->currentSequence->currentId;
	$story->completedID[] = $_SESSION['EventId'];
	
	//stock the complete id array
	$_SESSION['ArrayCompleteId'] = $story->completedID;

	ob_clean();
	header('Content-Type: application/json');
	echo json_encode($response);
}
?>
