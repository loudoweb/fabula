# fabula
Cross-platform Engine for stories, events and dialogs parsed from xml for video games.

### Genesis

This engine has been originally coded for my own tactical rpg procgen narrative game Graal Seeker at [Lugludum](https://www.lugludum.com) back in 2014. I've only decided to extract the code and make it an open source library in...2022. Since then I've successfuly used it in a recent point&click serious game.

### Status

Currently in development. Most of my original code still isn't there. Then I'll add new features :)
**WIP: RC planned for 2023**

## writing your story with xml

> Why xml? 

I personnaly prefer xml over json, especially for large content, I find it more readable, and it needs less scrolling:)
Also, I've a test a json and the file was heavier...
Finally we can imagine to create a json parser in the future if we find a correct json format, but only when after reaching v1.0.0. Also, yaml may be a good fit. But for now I'm heavily focused on xml.

> Yeah, but isn't it better to use a visual graph node tool to make your story?

Well, despite the fact it's harder to visualise the story with xml than with a graph node tool. It's faster to create the xml file, especially for small projects, than opening a graph node tool, creating all the boxes, copy pasting the texts, clicking here and there, etc. Anyway, we can still create such a tool in the future (or creating converters for existing tools). 

> I'm afraid that xml is too verbose

If programmers are used to xml, xml may seem heavy and wordy for writers. So we can imagine in the future, an Excel to xml converter to save some time, so narrative designer can write on Excel and developers just have to convert.

> What about Ink?

Ink is very powerful and packed up with different features. It's moreover far more complete than the current version of Fabula. That being said, you need to learn its scripting language and if you don't use it often, it can take some time to jump in. On the other and, using xml is closer to a natural language since you use keyword such as **event**, **choice** and **if** instead of special characters like *, - or +, and you are easily lost when using multiple conditionals in the same line. So I think Fabula is more straigh forward. Finally, to compete with Ink and its tools Inkly, Fabula needs a set of tools to write easily without a hitch.

Here is a taste of the xml, remember that you can [unlock autocompletion](#autocompletion-with-xsd) on your IDE.

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

** New in 0.10.0 **
You can now use nested event which can sometimes make story more readable.
```xml
<?xml version="1.0" encoding="utf-8" ?>
<data>
    <sequence id="Talk_to_kid">
        <event speaker="kid_sad" if="kid_angry" text="I won't talk to you anymore..." exit="true"/>
        <event speaker="kid" if="!kid_happy" text="Hi, have you seen my new toy? I love it!"/>
        <event speaker="kid" text="Do you want to play with me?">
            <choice id="kid_angry" text="Your toy looks like crap!">
                <event speaker="kid_angry" text="You're so mean!" exit="true"/>
            </choice>
            <choice id="kid_happy" text="Yes, I love it!">
                <event speaker="kid_happy" exit="true">
                    <text><![CDATA[Thanks! <font color="#2281AB">Let's play!</font>]]></text>
                </event>
            </choice>
            <choice id="goto_elsewhere" text="Leave him alone" exit="true"/>
        </event>
    </sequence>
</data>
```

You can test this story [here](https://loudoweb.github.io/fabula/samples/commonjs/index.html).

### autocompletion with xsd

On VSCode and some other softwares you can have autocompletion + validation on your xml using the xsd schema. Just write your root xml tag like that:

```xml
<data xmlns="http://www.loudoweb.fr/app/fabula/0.15.0" xsi:schemaLocation="http://www.loudoweb.fr/app/fabula/0.15.0 http://www.loudoweb.fr/app/fabula/fabula-0.15.0.xsd" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
</data>
```
### how it's work

For each event, you can set a **speaker**, **listeners** and an **environment**. It's up to you to display anything. Fabula just helps you describe your story and gives you an api to navigate through it! So you could combine a character name and its pose the way you want.

You can set a text directly using the **text** attribute. But if needed, you can use a text child node to use xml/markup to spice up your text.

All events or choices **id** can be used in condition using the **if** attribute. Ids are optional but global and Fabula will create ids for you to help you debugging using the following nomenclature $SEQUENCEID + "_E" for event or "_C" for choice + ordered number. You can also uses [variables](#variables) in your condition. External conditions could be used soon in the system. You can also monitor the id of the choice chosen in real time to do whatever you want. In my sample, I've set the **goto** prefix to tell my own Fabula wrapper to change the scene of the game after the sequence ends. Fabula here, just tells you the id, it's up to you to do whatever you want in your game engine.

The **exit** attribute, tells Fabula that your sequence is finished. But by default, your sequence ends when the player reached the last event of the sequence, Fabula always move forward by default.

To create branching narrative, you can use conditions to an event using the **if** attribute. Or your can use the **target** attribute to jump into a specific event. When using these attributes, you need to set an **id** of an event or a choice. You can also add an event in the choice tag (nested event) but beware of duplicate content.

If you don't set any **choice** for your event, Fabula will create an optional default "continue" or "quit" choice for your depending if it's right in the middle of the sequence or if it's an exit event. The default continue or exit choices are optionnal, because some games just invite players to click on the dialog box instead of the choice, so it's up to you!

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

## Conditions

You can add a condition in an event or a choice adding the **if** attribute. All event and choices ids are available as a condition. Fabula handles a global historic of completed events and choices that you can use globally. In case you want to test only from the current context of a sequence, you can prefix it with a dot. This distinction allows to reuse sequences because their own historic is always resetted when it starts.

e.g:
```js
//testing if a choice has been made globally. That could be in another sequence or the current sequence, but the id should be unique
if="myChoice"
//testing if a choice has been made in the current sequence.
if=".myChoice"
```

If you have more than one condition you can use AND or OR conditions.
AND conditions can be used by separating values with a comma (or with **&** but it makes the xml invalid).
OR conditions can be used by separating values with **|** but please note that the parser is limited right now so you can't handle priority between conditions with brackets. When mixing AND and OR conditions, OR are executed as a part of a AND block, the opposite isn't possible yet and will be introduced when bracket parser will be done.

e.g:
```js
//testing one condition that must be true
if="myCondition"
//Using logical AND: all conditions must be true
if="myCondition,myInt>=1"
//using logical OR: only one condition must be true
if="myCondition|myInt>=1"
//mixing AND and OR: myCondition and myCondition3 must be true, and myCondition2 or myInt>=1 must be true
if="myCondition,myCondition2|myInt>=1,myCondition3"
//if you want the condition be false, prefix it with !. Here only one condition must be false
if="!myCondition|!myCondition2"
```

## Variables

You can declare a variable in a sequence like that:
```xml
<variable id="myInt" type="int" value="0"/>
<variable id="myStr" type="string" value="John Doe"/>
<variable id="myBoolean" type="bool" value="true"/>
<variable id="myFloat" type="float" value="1.0"/>
<variable id="myEnum" type="enum" value="start,middle,end"/>
<variable id="myCycle" type="cycle" value="spring,summer,autumn,winter"/>
```

Then you can update it in a choice:
```xml
<variable id="myBoolean" value="false"/>
```

Enum and Cycles always take the first value before the comma. Here the default value is **start** and **spring**. The difference is that Cycle variables start again from first value when it reaches the end. You can set it using three method.
Using the string:
```xml
<variable id="myEnum" value="middle"/>
```
Using the index:
```xml
<variable id="myEnum" value="1"/>
```

Using increment or decrement:
```xml
<variable id="myEnum" value="+"/>
<variable id="myEnum" value="-"/>
```

Finally you use it in a condition, the engine determines itself if it's a event/choice condition or a variable condition:
```xml
<event if="myBoolean,myInt>=1"/>
```

You can use equal, numeric or string comparison operators.
|   Operator            |  Operation     |  Operand Left |  Operand Right  |
|--------------------|-------------------|---------------|-----------------|
|=                  |   Equal   |   variable name  |   string, int, float, enum or cycle  |
|!=                  |   Not Equal   |   variable name   |   string, int, float, enum or cycle    |
|<                  |   Less than   |   variable name    |   int or float    |
|>                  |   Greater than   |    variable name    |   int or float    |
|<=                  |   Less than or Equal   |  variable name   |   int or float    |
|>=                  |   Greater than or Equal   |  variable name    |   int or float    |
|(in:)                  |   is string included in variable. E.g: `John(in:myStr)` tests if *John* is in the string *John Doe*   |  string    |   variable name    |
|!                 |   NOT   |  nothing    |   Logical NOT for all operations. E.g: `!myBool` tests if myBool equals false, `!myInt>=0` tests if myInt is less than 0, `!John(in:myStr)` tests if *John* is **not** in the string *John Doe*  |


## Localization

The localization tool is currently in development. It will generate a csv file and a lighter xml file shared by all languages without any text. Here is a sample of the csv.

|ID            |TEXT                                    |
|--------------|----------------------------------------|
|Talk_to_kid_E1|I won't talk to you anymore...          |
|Talk_to_kid_E2|Hi, have you seen my new toy? I love it!|
|Talk_to_kid_E3|Do you want to play with me?            |
|kid_angry     |Your toy looks like crap!               |
|kid_happy     |Yes, I love it!                         |
|goto_elsewhere|Leave him alone                         |
|Talk_to_kid_E5|You're so mean!                         |
|Talk_to_kid_E7|Thanks!\n <font color="#2281AB">Let's play!</font>  |

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
var event = story.getNextEvent();
//end reached if event null
//display the text
trace(event.text);
//loop through all available choices (fabula test all conditions for you)
for (choice in event.getChoices())
{
   trace(choice.text)
}
//handle click on choice
function onChoiceClick(id:String){
    //inform fabula on the choice so it can validate the choice in the history tree
    story.selectChoice(id);
    //then you can move on to the next event
    story.getNextEvent();
    //etc.
}
```

You can see the full [Haxe Sample](https://github.com/loudoweb/fabula/tree/master/samples/haxe)

### Using Javascript

This js library is automatically generated from the original Haxe code.

Download the js minified code in [the dist commonjs folder](https://github.com/loudoweb/fabula/blob/master/dist/commonjs/fabula.min.js) and add it to your html page.

```javascript
var story = new fabula.Fabula([xml]);
var seq = story.selectSequence("Talk_to_kid");
var event = story.getNextEvent();
console.log(event.text);
//as you can see it's very close to the haxe version...
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
    - status : OK
    - [Sample](https://github.com/loudoweb/fabula/tree/master/samples/commonjs)

- **js modules**

    - This version allows you to have all classes in separated files for better debugging. You can use something like webpack to compile everything in one file. There is no release in npm registry yet so you have to copy paste the files in your projects.
    - file : js_modules.hxml
    - dependency: `haxelib install genes`
    - status : OK
    - [Sample](https://github.com/loudoweb/fabula/tree/master/samples/npm)
