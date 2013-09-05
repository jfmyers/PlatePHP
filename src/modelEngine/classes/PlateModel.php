<?php
class PlateModel implements PlateModelInterface
{
	private $_meta = array();
	private $_data = array();
	
	private $dbAction;
	private $_dbFilter = array();
	private $_dbOrderBy = array();
	private $dbAll = False;
	private $updateField;
	
	/*
	Action Methods
		Before calling an action method the client can specify options.
	*/
	public function save()
	{
		$this->dbAction = "save";
		$db = new DatabaseDelegate($this);
		$this->result = $db->getResult();
		$this->_data["id"] = $this->result();
		return $this->result;
	}
	public function fetch()
	{
		$this->dbAction = "fetch";
		$db = new DatabaseDelegate($this);
		$this->result = $db->getResult();
		return $this->result;
		
	}
	public function delete()
	{
		$this->dbAction = "delete";
		$db = new DatabaseDelegate($this);
		$this->result = $db->getResult();
		return $this->result;
		
	}
	public function result()
	{
		return $this->result;
	}
	
	/*
	    Option Methods
		All options must be specified before action methods(save, fetch or delete) are called
	*/
	public function filter($filter)
	{	
		$this->_dbFilter[] = $filter;
		return $this;
	}
	public function all()
	{
		$this->dbAll = True; 
		return $this;
		
	}
	public function orderBy($orderBy)
	{		
		$this->_dbOrderBy[] = $orderBy;
		return $this;
		
	}
	public function update($updateField)
	{		
		$this->updateField = $updateField;
		return $this;
		
	}
	public function resetOptions(){
		$this->updateField = "";
		$this->dbAction = "";
		$this->_dbFilter = array();
		$this->_dbOrderBy = array();
	}
	
	/*
		Public Accessors
	*/
	public function getData()
	{
		return $this->_data; 
	}
	public function setData($data)
	{
		$this->_data = DataClean::cleanData($data);
		return $this;
	}
	
	public function getUpdateField()
	{
		return $this->updateField; 
	}
	
	public function getMetaData()
	{
		return $this->_meta; 
	}
	public function setMetaData($metaData)
	{
		$this->_meta = $metaData; 
	}
	
	public function getDbAction()
	{
		return $this->dbAction; 
	}
	
	public function getDbFilter()
	{
		return $this->_dbFilter; 
	}
	
	public function getDbOrderBy()
	{
		return $this->_dbOrderBy; 
	}
	
	public function getDbAll()
	{
		return $this->dbAll; 
	}

}