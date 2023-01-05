# fabula
Cross-platform Engine for stories, events and dialogs parsed from xml for video games.

### Genesis

This engine has been originally coded for my own tactical rpg procgen narrative game Graal Seeker at [Lugludum](https://www.lugludum.com) back in 2014. I've only decided to extract the code and make it an open source library in...2022. Since then I've successfuly used it in a recent point&click serious game.

### Status

Currently in development. Most of my original code still isn't there. Then I'll add new features :)
**WIP: RC planned for 2023**

## writing your story on xml

> Why xml? 

I personnaly prefer xml over json, especially for large content, I find it more readable, and it needs less scrolling:)
Also, I've a test a json and the file was heavier...
But we can imagine to create a json parser in the future if we find a correct json format.

> Yeah, but isn't it better to use a visual graph node tool to make your story?

Well, despite the fact it's harder to visualise the story with xml than with a graph node tool. It's faster to create the xml file, especially for small projects, than opening a graph node tool, creating all the boxes, copy pasting the texts, clicking here and there, etc. And for big projects, lot of people seems to use Excel. But firstly, we can still create such a tool in the future (or creating converters for existing tools). And lastly, we can imagine using an Excel to xml converter to save some time on big projects, so narrative designer can write on Excel and developers just have to convert.


```xml
<?xml version="1.0" encoding="utf-8" ?>
<data>
    <sequence id="Talk_to_kid">
        <event speaker="kid_sad" if="kid_angry" text="I won't talk to you anymore..." exit="true"/>
        <event speaker="kid" if="!kid_happy" text="Hi, have you seen my new toy? I love it!"/>
        <event speaker="kid" text="Do you want to play with me?">
            <choice id="kid_angry" text="Your toy looks like crap!"/>
            <choice id="kid_happy" text="Yes, I love it!" target="kid_happy"/>
            <choice id="goto_elsewhere" text="Leave him alone" exit="true"/>
        </event>
        <event if="kid_angry" speaker="kid_angry" text="You're so mean!" exit="true"/>
        <event id="kid_happy" speaker="kid_happy" >
            <text><![CDATA[Thanks! <font color="#2281AB">Let's play!</font>]]></text>
        </event>
    </sequence>
</data>
```

For each event, you can set a **speaker**, **listeners** and an **environment**. It's up to you to display anything. Fabula just helps you describe your story! So you could combine a character name and its pose the way you want.

You can set a text directly using the **text** attribute. But if needed, you can use a text child node to use xml/markup to spice up your text.

All events or choices **id** can be used in condition using the **if** attribute. Ids are optional and Fabula will create ids for you to help you debugging using the following nomenclature $SEQUENCEID + "_E" for event or "_C" for choice + ordered number. External conditions could be used soon in the system. You can also monitor the id of the choice chosen in real time to do whatever you want. In my sample, I've set the **goto** prefix to tell my own Fabula wrapper to change the scene of the game. Fabula here, just tells you the id, it's up to you to do whatever you want in your game engine.

The **exit** attribute, tells Fabula that your sequence is finished. But by default, your sequence ends when the player reached the last event of the sequence, Fabula always move forward by default.

To create branching narrative, you can use conditions to an event using the **if** attribute. Or your can use the **target** attribute to jump into a specific event.

If you don't set any **choice** for your event. Fabula will create an optional default "continue" or "quit" choice for your depending if it's right in the middle of the sequence or if it's an exit event. The default continue or exit choices are optionnal, because some games just invite players to click on the dialog box instead of the choice, so it's up to you!

This is the transcript of the dialog:

| **Variant 1:**   | **Variant 2:**  |
| --------  | ------------------- |
| ==> *click on kid:* <== | ==> *click on kid:* <==  |
| Hi, have you seen my new toy? I love it!    | Hi, have you seen my new toy? I love it!    |
| => Continue    |  =>  Continue    |
| Do you want to play with me?   | Do you want to play with me?    |
|  =>  Your toy looks like crap!    |  =>  Yes, I love it!   |
| You're so mean!   |  Thanks! **Let's play!**    |
|   |   |
| ==> *click on kid again:* <==    |  ==> *click on kid again:* <==   |
| I won't talk to you anymore...  |  Do you want to play with me?   |
|   |   =>   etc.    |

### autocompletion with xsd

On VSCode and some other softwares you can have autocompletion + validation on your xml using the xsd schema. Just write your root xml tag like that:

```xml
<data xmlns="http://www.loudoweb.fr/app/fabula/0.8.1"
xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
xsi:schemaLocation="http://www.loudoweb.fr/app/fabula/0.8.1 http://www.loudoweb.fr/app/fabula/fabula-0.8.1.xsd">
</data>
```

## Getting started

### Using Haxe Language

This library is written in Haxe which is a cross-platform language. With Haxe you can target javascript, c++, etc.

Install the library

`haxelib install fabula`

```haxe
//parse all your xml files
var story = new fabula.Fabula([xml]);
//select a sequence
var seq = story.selectSequence("Talk_to_kid");
//find the first event
var event = seq.getNextEvent();
//end reached if event null
//display the text
trace(event.text);
```

### Using Javascript

This js library is automatically generated from the original Haxe code.

Download the js minified code in [the dist commonjs folder](https://github.com/loudoweb/fabula/blob/master/dist/commonjs/fabula.min.js) and add it to your html page.

```javascript
var story = new fabula.Fabula([xml]);
var seq = story.selectSequence("Talk_to_kid");
var event = seq.getNextEvent();
console.log(event.text);
```

## Contribute

You can contribute by testing the project, giving feedback (consider opening a thread in [Discussions](https://github.com/loudoweb/fabula/discussions) or an [issue](https://github.com/loudoweb/fabula/issues) if it's a bug) or by making Pull Request.

This library uses the [Haxe language](https://haxe.org) (version >= 4.1.5), which is a high-level strictly-typed language that can transpile to many other languages. To build the generated ports to other languages you can compile the **hxml** files.

### Transpile to other languages

If you don't code with Haxe. You can still generate a port in the language you want as soon it is supported by Haxe (JavaScript, C++, C#, Python, Lua, PHP, Flash).
It would be better to make proper ports to have cleaner files but using those generated ports guarantees you are using the last version of the fabula api.

To get the last api port, you have to execute the hxml file that compiles to the language you want to use.  

e.g: `haxe compile/js.hxml`

In order to do that, first you need to [download and install haxe](https://haxe.org/download/).

You will need some libraries depending on your target.

- **common js**

    - file : js.hxml
    - dependency: `npm install uglify-js -g` and `haxelib install uglifyjs`
    - status : test in progress

- **js modules**

    - file : js_modules.hxml
    - dependency: `haxelib install genes`
    - status : not tested

- **csharp**

    - file : csharp.hxml
    - dependency: `haxelib install hxcs`
    - status : not tested