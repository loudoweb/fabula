package fabula;

import haxe.ds.StringMap;
import haxe.xml.Access;

using kadabra.utils.XMLUtils;

class FabulaXmlParser
{
	static var _xml:Access;

	public static var ID_GEN_HELPER:String;
	public static var ID_GEN_COUNT:Int;

	public static function parse(raw:String):{sequences:Array<Sequence>}
	{
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

			for (key in sequence.elements)
			{
				switch (key.name)
				{
					case "variable":
						seq.addVariable(key.att.id, key.att.type, key.att.value);
					case "event":
						event = new Event(key.getString("id", ID_GEN_HELPER + "_" + ++ID_GEN_COUNT),
							key.getString("text"), key.getInt("weight", 1), key.getBool("once", false),
							key.getString("speaker"), key.getString("listeners"), key.getString("environment"));

						if (key.hasNode.choice)
						{
							// id:String, text:String, type:String, target:String, exit:Bool
							for (choice in key.nodes.choice)
							{
								event.addChoice(new Choice(choice.getString("id", ID_GEN_HELPER + "_" + ++ID_GEN_COUNT),
									choice.getString("text"), choice.getString("type"), choice.getString("condition"),
									choice.getString("target"),
									choice.has.target ? false : !(choice.hasNode.event || choice.hasNode.fight)));
							}
						}
						events.push(event);
					case "choice":
						if (event == null)
						{
							trace("impossible to add a choice without a parent event");
							break;
						}
						event.addChoice(new Choice(key.getString("id", ID_GEN_HELPER + "_" + ++ID_GEN_COUNT),
							key.getString("text"), key.getString("type"), key.getString("condition"),
							key.getString("target"),
							key.has.target ? false : !(key.hasNode.event || key.hasNode.fight)));
				}
			}

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

	public static function parseEvent(xml:Access):Event
	{
		return new Event(xml.getString("id", ID_GEN_HELPER + ID_GEN_COUNT++), xml.getString("text"),
			xml.getBool("once", false));

		// add sub events by browsing choices
		/*if (event.hasNode.choice)
			{
				for (choice in event.nodes.choice)
				{
					if (choice.hasNode.event && !isEventListExist(choice.node.event.att.id)) {
						initEvent(choice.node.event);
					}
				}
		}*/
	}
}
