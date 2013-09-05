<?php
class Plate
{
	public static function start()
	{
		return self::loadFiles();
	}
	private function loadFiles()
	{
		$dir =  dirname(__FILE__);
		/*Plugins*/
		include("$dir/plugins/Rediska/library/Rediska.php");
		
		/*Utilities*/
		include("$dir/src/utilities/Utilities.php");
		
		/*Config Files*/
		include("$dir/src/config/interfaces/DatabaseConnectionInterface.php");
		
		include("$dir/src/config/classes/DatabaseConnectionFactory.php");
		include("$dir/src/config/classes/MySqlConnection.php");
		include("$dir/src/config/classes/RedisConnection.php");
		
		include("$dir/config.php");
		
		/*Model Engine Files*/
		include("$dir/src/modelEngine/interfaces/PlateModelInterface.php");
		include("$dir/src/modelEngine/interfaces/DatabaseDelegateInterface.php");
		include("$dir/src/modelEngine/interfaces/DataCleanInterface.php");
		
		include("$dir/src/modelEngine/classes/DatabaseDelegate.php");
		include("$dir/src/modelEngine/classes/DataClean.php");
		include("$dir/src/modelEngine/classes/PlateModel.php");
		
		/*Collection Engine Files*/
		include("$dir/src/collectionEngine/interfaces/PlateCollectionInterface.php");
		include("$dir/src/collectionEngine/interfaces/CollectionDataInterface.php");
		include("$dir/src/collectionEngine/interfaces/UtilityDelegateInterface.php");
		include("$dir/src/collectionEngine/interfaces/UtilityOptionInterface.php");
		
		include("$dir/src/collectionEngine/classes/UtilityDelegate.php");
		include("$dir/src/collectionEngine/classes/PlateCollection.php");
		include("$dir/src/collectionEngine/classes/CollectionData.php");
		include("$dir/src/collectionEngine/classes/Where.php");
		include("$dir/src/collectionEngine/classes/Sort.php");
		
		
		/*Database Engine Files */
		
		/*MySql Engine*/
		include("$dir/src/databaseEngine/mysqlEngine/interfaces/MySqlInterface.php");	
		include("$dir/src/databaseEngine/mysqlEngine/interfaces/QueryBuilderInterface.php");	
		include("$dir/src/databaseEngine/mysqlEngine/interfaces/QueryExecutorInterface.php");
		include("$dir/src/databaseEngine/mysqlEngine/interfaces/QueryResultParserInterface.php");
		include("$dir/src/databaseEngine/mysqlEngine/interfaces/QueryTypeInterface.php");	
		include("$dir/src/databaseEngine/mysqlEngine/interfaces/MySqlCommandInterface.php");		
		include("$dir/src/databaseEngine/mysqlEngine/interfaces/QueryDelegateInterface.php");
		include("$dir/src/databaseEngine/mysqlEngine/interfaces/QueryFormatOptionsInterface.php");		
					
		include("$dir/src/databaseEngine/mysqlEngine/classes/MySql.php");
		include("$dir/src/databaseEngine/mysqlEngine/classes/MySqlCommandBase.php");
		include("$dir/src/databaseEngine/mysqlEngine/classes/MySqlSelect.php");
		include("$dir/src/databaseEngine/mysqlEngine/classes/MySqlInsert.php");
		include("$dir/src/databaseEngine/mysqlEngine/classes/MySqlDelete.php");
		include("$dir/src/databaseEngine/mysqlEngine/classes/MySqlUpdate.php");
		include("$dir/src/databaseEngine/mysqlEngine/classes/QueryBuilder.php");
		include("$dir/src/databaseEngine/mysqlEngine/classes/QueryExecutor.php");
		include("$dir/src/databaseEngine/mysqlEngine/classes/QueryResultParser.php");
		include("$dir/src/databaseEngine/mysqlEngine/classes/QueryType.php");
		include("$dir/src/databaseEngine/mysqlEngine/classes/QueryDelegate.php");
		include("$dir/src/databaseEngine/mysqlEngine/classes/QueryFormatOptions.php");
		
		/*Redis Engine*/
		include("$dir/src/databaseEngine/redisEngine/interfaces/RedisInterface.php");
		
		include("$dir/src/databaseEngine/redisEngine/classes/Redis.php");
		
		PlateConfig::start();
	}
}