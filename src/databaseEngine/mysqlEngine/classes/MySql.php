<?php

class MySql implements MySqlInterface
{
	private $type;
	private $table;
	private $data;
	private $filter;
	private $orderBy;
	private $updateField;
	private $result;
	
	public function __construct($model)
	{
		/*
			Files in the databaseEngine directory shouldn't rely directly on
			Plate object methods, instead these files should access data via
			this class. If any changes to the Plate/Base class are made then the
			only changes that must be made in the MySql engine will be here. 
		*/
		$this->type = QueryType::getType($model);
		$this->filter = $model->getDbFilter();
		$this->table = get_class($model);
		$this->data = $model->getData();
		$this->orderBy = $model->getDbOrderBy();
		$this->updateField = $model->getUpdateField();
		
		/* 
			What actions need to be performed for this query to successfully execute?
			The QueryDelegate will instantiate the appropriate MySql Command class,
			run through the proper steps and then parse/return the results.
		*/
		$queryDelegate = new QueryDelegate($this);
		$this->result = $queryDelegate->getResult();
		/*
			After a query has run, it's options must be deleted to prevent subsequent
			query's from accidentally using this query's options.
		*/
		$model->resetOptions();
	}
	
	public function getType()
	{
		return $this->type;
	}
	
	public function getTable()
	{
		return $this->table;
	}
	
	public function getData()
	{
		return $this->data;
	}
	
	public function getOrderBy()
	{
		return $this->orderBy;
	}
	
	public function getUpdateField()
	{
		return $this->updateField;
	}
	
	public function getFilter()
	{
		return $this->filter;
	}
	
	public function getResult()
	{
		return $this->result;
	}

}