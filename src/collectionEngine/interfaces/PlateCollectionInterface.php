<?php

interface PlateCollectionInterface
{
	public function filter($filter);
	public function orderBy($orderBy);
	public function fetch();
	public function setModels($result);
	public function getModels();
	public function setModel($model);
	public function getModel();
	public function getInstantiatedModel();
	public function reset();
	
	public function where($key, $operator, $value);
	
	/*public function fetch();
	public function pluck();
	public function pop();
	public function remove();
	public function reset();
	public function where();*/
	
}