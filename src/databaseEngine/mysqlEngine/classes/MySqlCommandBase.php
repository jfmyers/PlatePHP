<?php

abstract class MySqlCommandBase
{
	protected $queryResult;
	protected $result;
	
	protected function start()
	{
		$this->buildQuery();
		$this->executeQuery();
	}
	
	protected function executeQuery()
	{
		$qExecute = new QueryExecutor($this->queryString);
		$this->queryResult = $qExecute->getResult();
		
	}
	
	protected function parseQueryResult()
	{
		$model = $this->model;
		$data = $model->getData();
		
		$qParse = new QueryResultParser($this->queryResult);
		if( $qParse->mysqlSuccess() ){
			$this->result = 200;
			
		} else {
			throw new Exception('Invalid Query:' . mysql_error() );
			
		}
		
	}
	
	public function getResult()
	{
		return $this->result;
	}
	
}