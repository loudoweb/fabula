package fabula;

import fabula.condition.ConditionFactory;
import fabula.condition.Variable.EVariableType;
import haxe.ds.StringMap;
import haxe.xml.Access;

using kadabra.utils.XMLUtils;

class FabulaXmlParser
{
	static var _xml:Access;

	public static var ID_GEN_HELPER:String;
	public static var ID_GEN_COUNT:Int;

	static var _conditionFactory:ConditionFactory;

	public static function parse(raw:String, conditionFactory:ConditionFactory,
			achievedListID:Array<String>):{sequences:Array<Sequence>}
	{
		_conditionFactory = conditionFactory;

		_xml = new Access(Xml.parse(raw).firstElement());

		var sequences:Array<Sequence> = [];
		// sequencial
		for (sequence in _xml.nodes.sequence)
		{
			if (!sequence.has.id)
			{
				trace("id attribute is mandatory in the sequence tag");
				continue;
			}
			var seqName = sequence.att.id;
			ID_GEN_HELPER = seqName;
			ID_GEN_COUNT = 0;

			var events:Array<Event> = [];
			var branches:Array<Event> = [];
			var seq = new Sequence(seqName);
			seq.addConditions(_conditionFactory.create(sequence.getString("if")));

			var event = parseEvents(sequence, seq, events, branches);
			
			// add isExit to last event or its choices
			if (event != null)
			{
				trace(event.id);
				
				if (event.choices != null)
				{
					for (choice in event.choices)
					{
						if(choice.target == null)
							choice.isExit = true;
					}
				}else{
					event.isExit = true;
				}
			}

			// add the events and the sequence
			seq.addSequence(events, branches);
			sequences.push(seq);
		}

		// random
		for (list in _xml.nodes.list)
		{
			trace("coucou list");
		}
		return {sequences: sequences};
	}

	static function parseEvents(sequence:Access, seq:Sequence, events:Array<Event>, branches:Array<Event>, ?parent:Choice):Event
		{
			var event:Event = null;

			for (key in sequence.elements)
			{
				switch (key.name)
				{
					case "variable":
						seq.addVariable(key.att.id, Type.createEnum(EVariableType, key.att.type.toUpperCase()),
							key.att.value);
					case "event":
						var _id:String = key.getString("id", ID_GEN_HELPER + "_E" + ++ID_GEN_COUNT);
						var _if:String;
						if(parent == null)
						{
							//normal case
							_if = key.getString("if");
						}else{
							//if event has choice has parent, we set choice target and event condition here
							_if = parent.id;
							parent.target = _id;
						}

						event = new Event(_id, getText(key),
							_conditionFactory.create(_if), key.getBool("exit", false),
							key.getInt("weight", 1), key.getBool("once", false), key.getString("speaker"),
							key.getString("listeners"), key.getString("environment"), key.getString("target"));

						if (key.hasNode.choice)
						{
							for (choice in key.nodes.choice)
							{

								var _choice = new Choice(choice.getString("id",
								ID_GEN_HELPER + "_C" + ++ID_GEN_COUNT), getText(choice),
								choice.getString("type"), _conditionFactory.create(choice.getString("if")),
								choice.getString("target"), choice.getBool("exit", event.isExit));

								event.addChoice(_choice);

								// nested event
								if(choice.hasNode.event)
								{
									parseEvents(choice, seq, events, branches, _choice);
								}
								
								// TODO type should be autocompleted when child is fight or exit or event or when condition attached
							}
						}
						if(parent == null)
							events.push(event);
						else
							branches.push(event);
					case "choice":
						if (event == null)
						{
							trace("impossible to add a choice without a parent event");
							break;
						}
						event.addChoice(new Choice(key.getString("id", ID_GEN_HELPER + "_C" + ++ID_GEN_COUNT),
							getText(key), key.getString("type"), _conditionFactory.create(key.getString("if")),
							key.getString("target"), key.getBool("exit", event.isExit)));
				}
			}
			return event;
		}

	static function getText(element:Access):String
	{
		var text = element.getString("text");
		if (text == "" && element.hasNode.text)
		{
			text = element.node.text.innerData;
		}
		return text;
	}
}
