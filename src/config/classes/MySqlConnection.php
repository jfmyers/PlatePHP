<?php
	
class MySqlConnection implements DatabaseConnectionInterface
{	
	private $credentials;
	
	public function connect($credentials)
	{
		$host = $credentials["host"];
		$user = $credentials["user"];
		$pass = $credentials["pass"];
		$name = $credentials["name"];
		
		$link = mysql_connect($host, $user, $pass) or die("Couldn't make connection.");
		$db = mysql_select_db($name, $link) or die("Couldn't select database");
	}
	
}
		
