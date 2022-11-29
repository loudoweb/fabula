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
			var event:Event = null;
			var seq = new Sequence(seqName);
			seq.addConditions(_conditionFactory.create(sequence.getString("if")));

			for (key in sequence.elements)
			{
				switch (key.name)
				{
					case "variable":
						seq.addVariable(key.att.id, Type.createEnum(EVariableType, key.att.type.toUpperCase()),
							key.att.value);
					case "event":
						event = new Event(key.getString("id", ID_GEN_HELPER + "_E" + ++ID_GEN_COUNT), getText(key),
							_conditionFactory.create(key.getString("if")), key.getBool("exit", false),
							key.getInt("weight", 1), key.getBool("once", false), key.getString("speaker"),
							key.getString("listeners"), key.getString("environment"));

						if (key.hasNode.choice)
						{
							// id:String, text:String, type:String, target:String, exit:Bool
							for (choice in key.nodes.choice)
							{
								event.addChoice(new Choice(choice.getString("id",
									ID_GEN_HELPER + "_C" + ++ID_GEN_COUNT), getText(choice),
									choice.getString("type"), _conditionFactory.create(choice.getString("if")),
									choice.getString("target"), choice.getBool("exit", false)));

								// TODO child event using recursivity method (then replace parent target with child id + add parent id in child if)
								// TODO type should be autocompleted when child is fight or exit or event or when condition attached
							}
						}
						events.push(event);
					case "choice":
						if (event == null)
						{
							trace("impossible to add a choice without a parent event");
							break;
						}
						event.addChoice(new Choice(key.getString("id", ID_GEN_HELPER + "_C" + ++ID_GEN_COUNT),
							getText(key), key.getString("type"), _conditionFactory.create(key.getString("if")),
							key.getString("target"), key.getBool("exit", false)));
				}
			}
			// add isExit to last event and its choices
			if (event != null)
			{
				event.isExit = true;
				if (event.choices != null)
				{
					for (choice in event.choices)
					{
						choice.isExit = true;
					}
				}
			}

			// add the events and the sequence
			seq.addSequence(events);
			sequences.push(seq);
		}

		// random
		for (list in _xml.nodes.list)
		{
			trace("coucou list");
		}
		return {sequences: sequences};
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
