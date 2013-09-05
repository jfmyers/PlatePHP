<?php
	
class PlateConfig
{	
	private $config;
	
	private function __construct()
	{
		$config = array();
		$config["db"]["mysql"]["on"] = True;//if using mysql;
		$config["db"]["redis"]["on"] = True;//if using redis;
		
		if($config["db"]["mysql"] == True)
		{
			$config["db"]["mysql"]["host"] = "YOUR DATABASE HOST";
			$config["db"]["mysql"]["user"] = "DB USER NAME";
			$config["db"]["mysql"]["pass"] = "DB PASSWORD";
			$config["db"]["mysql"]["name"] = "DATABASE NAME";
		}
		if($config["db"]["redis"] == True)
		{
			$config["db"]["redis"]["host"] = "HOST ADDRESS";
			$config["db"]["redis"]["port"] = "PORT NUMBER";
			
		}
		
		$this->config = $config;
	}
	public function getConfig(){
		return $this->config;
	}
	
	public static function start()
	{
		$plate = new PlateConfig();
		return DatabaseConnectionFactory::create($plate);
	}
}
		
