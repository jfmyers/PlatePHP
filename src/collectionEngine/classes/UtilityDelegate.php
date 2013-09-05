<?php

class UtilityDelegate implements UtilityDelegateInterface
{
	private $collection;
	private $models;
	private $result;
	
	public function __construct($collection)
	{
		$this->collection = $collection;
		$this->models = $collection->getModels();
	}
	
	public function where($key, $operator, $value)
	{
		$where = new Where($key, $operator, $value, $this->models);
		$this->result = $where->getResult();
	}
	public function sort($sortValue)
	{
		$sort = new Sort($sortValue, $this->models);
		$this->result = $sort->getResult();

	}
	public function getResult()
	{
		return $this->result;
	}
}