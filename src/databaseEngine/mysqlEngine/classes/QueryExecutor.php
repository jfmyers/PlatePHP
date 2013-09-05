<?php

class QueryExecutor implements QueryExecutorInterface
{
	private $result;
	private $queryString;
	
	public function __construct($queryString)
	{
		$this->queryString = $queryString;
		$this->mysqlExecute();
	}
	
	private function mysqlExecute()
	{
		$queryString = $this->queryString;
		$result = mysql_query($queryString);
		$this->result = $result;
	}
	
	public function  getResult()
	{
		return $this->result;
		
	}
	
	
}