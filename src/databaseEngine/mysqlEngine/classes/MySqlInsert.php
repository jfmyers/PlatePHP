<?php

class MySqlInsert extends MySqlCommandBase implements MySqlCommandInterface
{
	protected $model;
	protected $result;
	
	public function __construct($model)
	{
		$this->model = $model;
		$this->start();
		$this->parseInsertQueryResult();
	}
	
	protected function buildQuery()
	{
		$qBuilder = new QueryBuilder($this->model);
		$qBuilder->formatFields();
		$qBuilder->formatValues();
		$qBuilder->assembleInsert();
		$this->queryString = $qBuilder->getQueryString();
		
	}
	
	protected function parseInsertQueryResult()
	{	
		$qParse = new QueryResultParser($this->queryResult);
		if( $qParse->mysqlSuccess() ){
			$qParse->parseInsert();
			$this->result = $qParse->getResult();
		} else {
			throw new Exception('INSERTION FAILED:' . mysql_error() );
			
		}
		
	}
}