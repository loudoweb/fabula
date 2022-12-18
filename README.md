# fabula
Engine for stories, events and dialogs parsed from xml.

WIP: RC planned for spring 2023

## sample xml
```xml
<?xml version="1.0" encoding="utf-8" ?>
<data>
    <sequence id="Talk_to_kid">
        <event speaker="kid_sad" if="kid_angry" text="I won't talk to you anymore..." exit="true"/>
        <event speaker="kid" text="Hi, have you seen my new toy? I love it!"/>
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

The **exit** attribute, tells Fabula that your sequence is finished. But by default, your sequence ends when the player reached the last event of the sequence.

To create branching narrative, you can use conditions to an event using the **if** attribute. Or your can use the **target** attribute to jump into a specific event.

If you don't set any **choice** for your event. Fabula will create a default "continue" or "quit" choice for your depending if it's right in the middle of the sequence or if it's an exit event.





