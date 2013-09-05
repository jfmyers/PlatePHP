<?php
/*
Database Delegation
	Based on this model's Meta Data[database type], we need to determine which database engine to use
*/
class DatabaseDelegate implements DatabaseDelegateInterface
{
	private $result;
	
	public function __construct($model)
	{		
		$meta = $model->getMetaData();

		if(! (isset($meta["dbType"])) ){
			//throw new error must set a database type
		} else{
			if($meta["dbType"] == "mysql"){
				//use mysql engine
				$this->useMySql($model);
				
			} elseif ($meta["dbType"] == "redis"){
				//use redis engine
				$this->useRedis($model);
				
			} else {
				//throw new error no other database engine library has been built at this time
				throw new Exception("dbType Error: Must specify 'mysql' or 'redis' as your 'dbType'.");
			}
		}
	}
	private function useMySql($model)
	{
		$mysql = new MySql($model);
		$result = $mysql->getResult();
		$this->setResult($result);
		
	}
	private function useRedis($model)
	{
		$redis = new Redis($model);
		$result = $redis->getResult();
		$this->setResult($result);
	}
	
	public function getResult()
	{
		return $this->result;
	}
	private function setResult($result)
	{
		$this->result = $result;
	}
	
}

	
	
	
