package fabula.tools;

#if tools
import fabula.Fabula;
import fabula.Sequence;
import fabula.Sequence;
import haxe.Serializer;
import haxe.io.Bytes;
import haxe.io.Output;
import haxe.macro.Expr;
import sys.FileSystem;
import sys.io.FileOutput;

class FabulaTools
{
	macro public static function createLoc(pathToXml:Expr, outPathXml:Expr, outPathCsv:Expr):Expr
	{
		var _xml_path:String = '';
		var _outxml_path:String = '';
		var _outcsv_path:String = '';

		switch (pathToXml.expr)
		{
			case EConst(c):
				switch (c)
				{
					case CString(s): _xml_path = s;
					default: {}
				}
			default:
				{}
		}
		switch (outPathXml.expr)
		{
			case EConst(c):
				switch (c)
				{
					case CString(s): _outxml_path = s;
					default: {}
				}
			default:
				{}
		}
		switch (outPathCsv.expr)
		{
			case EConst(c):
				switch (c)
				{
					case CString(s): _outcsv_path = s;
					default: {}
				}
			default:
				{}
		}

		trace('[Macro] creating timeline file : ' + _xml_path, _outxml_path, _outcsv_path);
		createLocFiles(_xml_path, _outxml_path, _outcsv_path);

		return pathToXml;
	}

	public static function createLocFiles(inputXml:String, outputXml:String, outputCSV:String):Void
	{
		var file = sys.io.File.getContent(inputXml);
		var fabula = new Fabula([file]);
		var xml_s:String = '<?xml version="1.0" encoding="UTF-8"?>\n' + '<data>\n' + '</data>';

		var xml:Xml = Xml.parse(xml_s).firstElement();

		var csv = 'ID;TEXT\n';

		var sequences:Array<Sequence> = fabula._sequences;
		var seq_str = "";

		if (fabula.variables != null)
		{
			for (v in 0...fabula.variables.length)
			{
				seq_str += "\t" + fabula.variables[v].toXMLString() + "\n";
			}
		}

		var temp:Xml;
		for (i in 0...sequences.length)
		{
			seq_str += '<sequence id="${sequences[i].id}">\n';

			if (sequences[i].variables != null)
			{
				for (v in 0...sequences[i].variables.length)
				{
					seq_str += "\t" + sequences[i].variables[v].toXMLString() + "\n";
				}
			}

			for (j in 0...sequences[i].events.length)
			{
				var event = sequences[i].events[j];
				seq_str += '\t<event id="${event.id}"';
				if (event.conditions != null)
					seq_str += ' if="${event.conditions.toString()}"';
				if (event.speaker != null && event.speaker != "")
					seq_str += ' speaker="${event.speaker}"';
				if (event.listeners != null && event.listeners != "")
					seq_str += ' listeners="${event.listeners}"';
				if (event.environment != null && event.environment != "")
					seq_str += ' environment="${event.environment}"';
				if (event.limit > 0)
					seq_str += ' limit="${event.limit}"';
				if (event.target != null && event.target != "")
					seq_str += ' target="${event.target}"';
				if (event.isExit)
					seq_str += ' exit="true"';
				seq_str += ">\n";

				csv += '"${event.id}";"${event.text}"\n';

				if (event.choices != null)
				{
					for (k in 0...event.choices.length)
					{
						var choice = event.choices[k];
						seq_str += '\t\t<choice id="${choice.id}"';
						if (choice.condition != null)
							seq_str += ' if="${choice.condition.toString()}"';
						if (choice.isExit)
							seq_str += ' exit="true"';
						seq_str += "/>\n";

						csv += '"${choice.id}";"${choice.text}"\n';
					}
				}
				seq_str += '\t</event>\n';
			}
			var branches = sequences[i].branches;
			if (branches != null)
			{
				for (k in 0...branches.length)
				{
					var event = branches[k];
					seq_str += '\t<event id="${event.id}"';
					if (event.conditions != null)
						seq_str += ' if="${event.conditions.toString()}"';
					if (event.speaker != null && event.speaker != "")
						seq_str += ' speaker="${event.speaker}"';
					if (event.listeners != null && event.listeners != "")
						seq_str += ' listeners="${event.listeners}"';
					if (event.environment != null && event.environment != "")
						seq_str += ' environment="${event.environment}"';
					if (event.limit > 0)
						seq_str += ' limit="${event.limit}"';
					if (event.target != null && event.target != "")
						seq_str += ' target="${event.target}"';
					if (event.isExit)
						seq_str += ' exit="true"';
					seq_str += ">\n";
					csv += '"${event.id}";"${event.text}"\n';

					if (event.choices != null)
					{
						for (k in 0...event.choices.length)
						{
							var choice = event.choices[k];
							seq_str += '\t\t<choice id="${choice.id}"';
							if (choice.condition != null)
								seq_str += ' if="${choice.condition.toString()}"';
							if (choice.isExit)
								seq_str += ' exit="true"';
							seq_str += "/>\n";

							csv += '"${choice.id}";"${choice.text}"\n';
						}
					}
					seq_str += '\t</event>\n';
				}
			}
			seq_str += '</sequence>\n';
		}
		xml.addChild(Xml.parse(seq_str));

		sys.io.File.saveContent(outputXml, xml.toString());
		sys.io.File.saveContent(outputCSV, csv.toString());
	}
}
#end
