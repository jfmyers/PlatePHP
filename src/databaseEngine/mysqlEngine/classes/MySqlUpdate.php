<?php

class MySqlUpdate extends MySqlCommandBase implements MySqlCommandInterface
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
		$qBuilder->assembleUpdate();
		$this->queryString = $qBuilder->getQueryString();
		
	}
	
}