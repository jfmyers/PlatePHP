<?php

class CollectionData implements CollectionDataInterface
{
	private $collection;
	private $model;
	private $result;
	
	public function __construct($collection)
	{
		$this->collection = $collection;
		$this->model = $collection->getInstantiatedModel();
	}
	
	public function filter($filter)
	{
		$model = $this->model;
		$model->filter($filter);
	}
	
	public function orderBy($orderBy)
	{
		$model = $this->model;
		$model->orderBy($orderBy);
	}
	
	public function fetch()
	{
		$model = $this->model;
		$result = $model->fetch();
		$this->result = $result;
	}
	
	public function getResult()
	{
		return $this->result;
	}
}