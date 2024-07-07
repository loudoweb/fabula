const { Fabula } = require("../../dist/npm/fabula/Fabula");

//var xml = '<?xml version="1.0" encoding="utf-8" ?><data><sequence id="Talk_to_kid"><event speaker="kid_sad" if="kid_angry" text="I won`\'t talk to you anymore..." exit="true"/><event speaker="kid" if="!kid_happy" text="Hi, have you seen my new toy ? I love it!"/><event speaker="kid" text="Do you want to play with me?"><choice id="kid_angry" text="Your toy looks like crap!"/><choice id="kid_happy" text="Yes, I love it!" target="kid_happy"/><choice id="goto_elsewhere" text="Leave him alone" exit="true"/></event><event if="kid_angry" speaker="kid_angry" text="You\'re so mean!" exit="true"/><event id="kid_happy" speaker="kid_happy" ><text><![CDATA[Thanks! <font color="#2281AB">Let\'s play!</font>]]></text></event></sequence></data>';
//added nested events v0.10.0
var xml = '<?xml version="1.0" encoding="utf-8" ?><data><sequence id="Talk_to_kid">'+
'<event speaker="kid_sad" if="kid_angry" text="I won\'t talk to you anymore..." exit="true"/>'+
'<event speaker="kid" if="!kid_happy" text="Hi, have you seen my new toy? I love it!"/>'+
'<event speaker="kid" text="Do you want to play with me?">'+
    '<choice id="kid_angry" text="Your toy looks like crap!">'+
        '<event speaker="kid_angry" text="You\'re so mean!" exit="true"/>'+
    '</choice>'+
    '<choice id="kid_happy" text="Yes, I love it!" target="kid_happy">'+
        '<event speaker="kid_happy" exit="true"><text><![CDATA[Thanks! <font color="#2281AB">Let\'s play!</font>]]></text></event>'+
    '</choice>'+
    '<choice id="goto_elsewhere" text="Leave him alone" exit="true"/></event>'+
'</sequence></data>'; 
var story = new Fabula([xml]);
var seq;
var event;
let divEvent;
var divLabel;
var divSpeaker;
var divChoice;
var btnReset;
var btnPlay;

window.onload = function()
{
    play();
}

function next(){
    event = story.getNextEvent();
    if(event != null){
        divLabel = document.createElement("div");
        divLabel.setAttribute('id', 'label');
        divSpeaker = document.createElement("div");
        divSpeaker.setAttribute('id', 'speaker');
        divLabel.innerText = "";
        divSpeaker.innerText = "";

        divEvent.append(divSpeaker, divLabel);

        divSpeaker.append(event.speaker);
        divLabel.insertAdjacentHTML('afterbegin', event.text);

        let choices = story.getChoices();
        for(i in choices)
        {
            var btnChoice = document.createElement('button');
            btnChoice.setAttribute('id', choices[i].id);
            btnChoice.classList.add('choice');
            btnChoice.append(choices[i].text)
            divEvent.append(btnChoice);
            btnChoice.addEventListener('click', choice);
        }
    } else {
        var divEnd = document.createElement('div');
        divEnd.setAttribute('id', 'end');

        divEvent.append(divEnd);

        var list;
        list = document.querySelectorAll(".choice");
        for (var i = 0; i < list.length; ++i) {
            list[i].classList.add('noEvent');
        }
        
        play();
    }
}

function choice(e){
    var btnChoice = e.currentTarget;
    story.selectChoice(btnChoice.id);
    next();
}

function reset(){
    btnReset= document.createElement('button');
    btnReset.setAttribute('id', 'reset');
    btnReset.innerText = "Reset";

    divEvent.append(btnReset);

    btnReset.addEventListener('click', funcReset);
}

function funcReset(){
    story.reset();
    var seq = story.selectSequence("Talk_to_kid");
    divEvent.innerText = "";
    play();
}

function play(){
    divEvent = document.getElementById("event");
    btnPlay = document.createElement('button');
    btnPlay.setAttribute('id', 'play');
    btnPlay.innerText = "Play";

    divEvent.append(btnPlay);
    btnPlay.addEventListener('click', funcPlay);
}

function funcPlay(){
    var seq = story.selectSequence("Talk_to_kid");
    btnPlay.style.display = "none";
    next();
    reset();
}