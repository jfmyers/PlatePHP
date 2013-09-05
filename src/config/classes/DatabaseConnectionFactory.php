<?php
	
class DatabaseConnectionFactory
{	
	public static function create($plate)
	{
		$config = $plate->getConfig();
		
		if( (!isset($config)) ){
			
			throw new Exception("Your Have Not Configured Your Database Options");
			
		} else {
			$dbConfig = $config["db"];
			
			foreach($dbConfig as $key=>$array){		
				if($key == "mysql" && $array["on"] == true){
					$src = new MySqlConnection();
				} elseif($key == "redis" && $array["on"] == true){
					$src = new RedisConnection();
				}
				$src->connect($array);
			}
			
		}
	}
}
		
