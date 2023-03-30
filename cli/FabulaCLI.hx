package;

import mcli.Dispatch;
import fabula.tools.FabulaTools;

class FabulaCLI extends mcli.CommandLine
{
	public var exportLoc:String;

	/**
		Show this message.
	**/
	public function help()
	{
		Sys.println("
|  ___|  | |         | |      
| |_ __ _| |__  _   _| | __ _ 
|  _/ _` | '_ \\| | | | |/ _` |
| || (_| | |_) | |_| | | (_| |
\\_| \\__,_|_.__/ \\__,_|_|\\__,_|");
		Sys.println(this.showUsage());
	}

	public function runDefault(?name:String)
	{
		Sys.println("
|  ___|  | |         | |      
| |_ __ _| |__  _   _| | __ _ 
|  _/ _` | '_ \\| | | | |/ _` |
| || (_| | |_) | |_| | | (_| |
\\_| \\__,_|_.__/ \\__,_|_|\\__,_|");
		Sys.println("exporting localization " + exportLoc);
		if (exportLoc != null && exportLoc != "")
		{
			FabulaTools.createLocFiles(exportLoc, exportLoc + "-output.xml", exportLoc + ".csv");
		}
	}

	public static function main()
	{
		new Dispatch(Sys.args()).dispatch(new FabulaCLI());
	}
}
