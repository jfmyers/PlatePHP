<?php
class PlateCollection implements PlateCollectionInterface
{
	private $_models = array();
	private $_originalModels = array();	
	private $model;
	private $instantiatedModel;
	
	/*
		Collection Data Methods
	*/
	public function filter($filter)
	{	
		$this->modelInstantiated();
		$collectionData = new CollectionData($this);
		$collectionData->filter($filter);
		return $this;
	}
	public function orderBy($orderBy)
	{
		$this->modelInstantiated();
		$collectionData = new CollectionData($this);
		$collectionData->orderBy($orderBy);
		return $this;
	}
	public function fetch()
	{
		$this->modelInstantiated();
		$collectionData = new CollectionData($this);
		$collectionData->fetch();
		$result = $collectionData->getResult();
		if(count($result) > 1 && !PlateUtilities::is_multi_array($result)) {
			$newResult = array();
			$newResult[0] = $result;
			$result = $newResult;
		}
		$this->setModels($result);
		$this->setOriginalModels($result);
		return $this->getModels();
		
	}
	
	/* 
		Collection Utility Methods
	*/
	public function where($key, $operator, $value)
	{
		if( preg_match("/^>$|^<$|^>=$|^<=$|^=$|^!=$|^==$/",$operator) ){
			$utility = new UtilityDelegate($this);
			$utility->where($key, $operator, $value);
			$result = $utility->getResult();
			$this->setModels($result);
			return $this;
		} else {
			throw new Exception("Operator not recognized. Invalid.");
		}
	}
	public function sort($sortValue)
	{
		$utility = new UtilityDelegate($this);
		$utility->sort($sortValue);
		$result = $utility->getResult();
		$this->setModels($result);
		return $this;
	}
	
	
	/*
		Public Accessors
	*/
	public function setOriginalModels($result)
	{
		$this->_originalModels = array();
		foreach($result as $key => $array) {
			$this->_originalModels[] = $array;
		}
	}
	public function setModels($result)
	{
		$this->_models = array();
		foreach($result as $key=>$array) {
			$this->_models[] = $array;
		}
	}
	public function getModels()
	{
		return $this->_models;
	}
	
	public function setModel($model)
	{
		$this->model = $model;
	}
	public function getModel()
	{
		return $this->model;
	}
	
	public function getInstantiatedModel()
	{
		return $this->instantiatedModel;
	}
	

	/* 
		Make Sure Data Model is Instantiated
	*/
	private function modelInstantiated()
	{
		if( isset($this->model) ){
			if( !isset($this->instantiatedModel) ){
				$model = $this->model;
				$this->instantiatedModel = new $model();
			} 
		} else {
			throw new Exception("No model specified for this collection.");
		}
	}
	
	/*
		Reset Collection Models to Original Models
	*/
	public function reset()
	{
		$this->_models = $this->_originalModels;
		return $this;
	}
	
}