package fabula.condition;

/**
 * Helper to check a data to make appear an story event or not
 * @author Loudo
 */
enum EConditionType
{
	INVENTORY;
	EVENT;
	HAS_CHARACTER;
	IS_CHARACTER;
	TRAIT;
	ATTRIBUTS;
	SKILLS;
	VARIABLE;
	CUSTOM(type:String);
}
