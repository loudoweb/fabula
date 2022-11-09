package fabula.condition;

/**
 * Helper to check a data to make appear an story event or not
 * @author Loudo
 */
enum EConditionType
{
	EVENT;
	VARIABLE;
	INVENTORY;
	HAS_CHARACTER;
	IS_CHARACTER;
	TRAIT;
	ATTRIBUTS;
	SKILLS;
	CUSTOM(type:String);
}
