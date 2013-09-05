<?php

class QueryBuilder implements QueryBuilderInterface
{
	private $model;
	private $table;
	private $data;
	private $filter;
	private $orderBy;
	private $values;
	private $fields;
	private $query;
	
	public function __construct($model)
	{
		$this->model = $model;
		$this->table = $model->getTable();
		$this->data = $model->getData();
		$this->filter = $model->getFilter();
		$this->orderBy = $model->getOrderBy();
		$this->updateField = $model->getUpdateField();
	}
	
	public function getQueryString()
	{
		return $this->query;
		
	}
	
	public function formatFields()
	{
		$this->fields = QueryFormatOptions::formatFields($this->data);
		
	} 
	
	public function formatFilter()
	{
		$this->filter = QueryFormatOptions::formatFilter($this->filter);
		
	}
	
	public function formatValues()
	{
		$this->values = QueryFormatOptions::formatValues($this->data);
		
	}
	
	public function formatOrderBy()
	{
		$this->orderBy = QueryFormatOptions::formatOrderBy($this->orderBy);
		
	}
	
	public function assembleInsert()
	{
		$this->query = 'INSERT INTO ' . $this->table . ' (' .$this->fields. ') VALUES (' . $this->values . ')';
		
	}
	
	public function assembleUpdate()
	{
		$data = $this->data;
		$updateField = $this->updateField;
		$value = is_numeric($data["$updateField"]) ? $data["$updateField"] : "'" . $data["$updateField"] . "'";	
		
		$query = 'UPDATE ' . $this->table . ' SET ' . $updateField . ' = ' . $value;
		
		if($this->filter != null){
			$query = $query . ' WHERE ' . $this->filter;
		}
		
		$this->query = $query;
		
	}
	
	public function assembleDelete()
	{
		$this->query = 'DELETE FROM ' . $this->table . ' WHERE ' . $this->filter;

	}
	
	public function assembleSelect()
	{
		$query = 'SELECT ' . $this->fields . ' FROM ' . $this->table;
		
		if($this->filter != null) {
			$query = $query . ' WHERE ' . $this->filter;
		}
		if($this->orderBy != null) {
			$query = $query . ' ORDER BY ' . $this->orderBy;
		}
		$this->query =  $query;
	}
	
}