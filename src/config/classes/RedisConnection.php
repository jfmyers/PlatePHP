<?php
	
class RedisConnection implements DatabaseConnectionInterface
{	
	private $credentials;
	public $rediska;
	
	public function connect($credentials)
	{
		$host = $credentials["host"];
		$port = $credentials["port"];
		
		//depends on Rediska Library to establish connection
		$redisOptions = array(
		    'namespace' => 'Application_',
		    'servers'   => array(
		       array('host' => $host, 'port' => $port)
		    )
		);
		$rediska = new Rediska($redisOptions);
		
		$this->rediska = $rediska;
		
	}
}
