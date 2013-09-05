<?php

class MySqlSelect extends MySqlCommandBase implements MySqlCommandInterface
{
	protected $model;
	protected $queryString;
	protected $result;
	
	public function __construct($model)
	{
		$this->model = $model;
		$this->start();
		$this->parseSelectQueryResult();
	}
	
	protected function buildQuery()
	{
		$qBuilder = new QueryBuilder($this->model);
		$qBuilder->formatFields();
		$qBuilder->formatFilter();
		$qBuilder->formatOrderBy();
		$qBuilder->assembleSelect();
		$this->queryString = $qBuilder->getQueryString();
		
	}
	
	protected function parseSelectQueryResult()
	{
		$model = $this->model;
		$data = $model->getData();
		
		$qParse = new QueryResultParser($this->queryResult);
		if( $qParse->mysqlSuccess() ){
			$qParse->parseSelect($data);
			$this->result = $qParse->getResult();
		} else {
			throw new Exception('Invalid Query:' . mysql_error() );
			
		}
		
	}

}