import js.html.DivElement;
import js.html.ButtonElement;
import js.Browser;
import fabula.*;
class Main {
    static var xml:String;
    static var story:Fabula;
    static var seq:Sequence;
    static var event:Event;
    static var divEvent:DivElement;
    static var divLabel:DivElement;
    static var divSpeaker:DivElement;
    static var divChoice:DivElement;
    static var btnReset:ButtonElement;
    static var btnPlay:ButtonElement;

    static public function main():Void {
        xml = '<?xml version="1.0" encoding="utf-8" ?><data><sequence id="Talk_to_kid"><event speaker="kid_sad" if="kid_angry" text="I won`\'t talk to you anymore..." exit="true"/><event speaker="kid" if="!kid_happy" text="Hi, have you seen my new toy ? I love it!"/><event speaker="kid" text="Do you want to play with me?"><choice id="kid_angry" text="Your toy looks like crap!"/><choice id="kid_happy" text="Yes, I love it!" target="kid_happy"/><choice id="goto_elsewhere" text="Leave him alone" exit="true"/></event><event if="kid_angry" speaker="kid_angry" text="You\'re so mean!" exit="true"/><event id="kid_happy" speaker="kid_happy" ><text><![CDATA[Thanks! <font color="#2281AB">Let\'s play!</font>]]></text></event></sequence></data>';
        story = new Fabula([xml]);
        seq = story.selectSequence("Talk_to_kid");
        event = story.getNextEvent();

        Browser.window.onload = function()
        {
            play();
        }
    }

    static function next(){
        event = story.getNextEvent();
        if(event != null){
            divLabel = Browser.document.createDivElement();
            divLabel.setAttribute('id', 'label');
            divSpeaker = Browser.document.createDivElement();
            divSpeaker.setAttribute('id', 'speaker');
            divLabel.innerText = "";
            divSpeaker.innerText = "";

            divEvent.append(divSpeaker, divLabel);

            divSpeaker.append(event.speaker);
            divLabel.insertAdjacentHTML('afterbegin', event.text);

            var choices = event.getChoices();
            for(choice in choices)
            {
                var btnChoice = Browser.document.createButtonElement();
                btnChoice.setAttribute('id', choice.id);
                btnChoice.classList.add('choice');
                btnChoice.append(choice.text);
                divEvent.append(btnChoice);
                btnChoice.addEventListener('click', onChoice);
            }
        } else {
            var divEnd = Browser.document.createDivElement();
            divEnd.setAttribute('id', 'end');

            divEvent.append(divEnd);

            var list;
            list = cast Browser.document.querySelectorAll(".choice");
            for (i in 0...list.length) {
                list[i].classList.add('noEvent');
            }
            
            play();
        }
    }

    static function onChoice(e){
        var btnChoice = e.currentTarget;
        story.selectChoice(btnChoice.id);
        next();
    }

    static function reset(){
        btnReset= Browser.document.createButtonElement();
        btnReset.setAttribute('id', 'reset');
        btnReset.innerText = "Reset";

        divEvent.append(btnReset);

        btnReset.addEventListener('click', funcReset);
    }

    static function funcReset(){
        story.reset();
        var seq = story.selectSequence("Talk_to_kid");
        divEvent.innerText = "";
        play();
    }

    static function play(){
        divEvent = cast Browser.document.getElementById("event");
        btnPlay = Browser.document.createButtonElement();
        btnPlay.setAttribute('id', 'play');
        btnPlay.innerText = "Play";

        divEvent.append(btnPlay);
        btnPlay.addEventListener('click', funcPlay);
    }

    static function funcPlay(){
        var seq = story.selectSequence("Talk_to_kid");
        btnPlay.style.display = "none";
        next();
        reset();
    }
}
