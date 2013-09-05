<?php

class MySqlDelete extends MySqlCommandBase implements MySqlCommandInterface
{
	protected $model;
	protected $queryString;
	
	public function __construct($model)
	{
		$this->model = $model;
		$this->start();
		$this->parseQueryResult();
	}
	
	protected function buildQuery()
	{
		$qBuilder = new QueryBuilder($this->model);
		$qBuilder->formatFilter();
		$qBuilder->assembleDelete();
		$this->queryString = $qBuilder->getQueryString();
		
	}
	
	
}