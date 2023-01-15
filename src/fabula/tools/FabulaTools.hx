package fabula.tools;

#if sys
import fabula.Sequence;
import fabula.Sequence;
import fabula.Fabula;
import haxe.io.Bytes;
import haxe.io.Output;
import haxe.macro.Expr;
import haxe.Serializer;
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

	static function createLocFiles(inputXml:String, outputXml:String, outputCSV:String):Void
	{
		var file = sys.io.File.getContent(inputXml);
		var fabula = new Fabula([file]);
		var xml_s:String = '<?xml version="1.0" encoding="UTF-8"?>\n' + '<data>\n' + '</data>';

		var xml:Xml = Xml.parse(xml_s).firstElement();

		var csv = 'ID;TEXT\n';

		var sequences:Array<Sequence> = fabula._sequences;
		var seq_str = "";

		var temp:Xml;
		for (i in 0...sequences.length)
		{
			seq_str = '<sequence id="${sequences[i].id}">\n';

			for (j in 0...sequences[i].events.length)
			{
				var event = sequences[i].events[j];
				seq_str += '<event id="${event.id}"';
				if (event.conditions != null)
					seq_str += ' if="${event.conditions.toString()}"';
				seq_str += ">\n";

				csv += '"${event.id}";"${event.text}"\n';

				if (event.choices != null)
				{
					for (k in 0...event.choices.length)
					{
						var choice = event.choices[k];
						seq_str += '<choice id="${choice.id}"';
						if (choice.condition != null)
							seq_str += ' if="${choice.condition.toString()}"';
						seq_str += "/>\n";

						csv += '"${choice.id}";"${choice.text}"\n';
					}
				}
				seq_str += '</event>\n';
			}
			var branches = sequences[i].branches;
			if (branches != null)
			{
				for (k in 0...branches.length)
				{
					var event = branches[k];
					seq_str += '<event id="${event.id}"/>\n';
					csv += '"${event.id}";"${event.text}"\n';
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
