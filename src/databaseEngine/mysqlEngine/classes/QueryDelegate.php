<?php

class QueryDelegate
{
	private $result;
	private $model;
	
	public function __construct($model)
	{
		$this->model = $model;
		$type = $model->getType();
		
		/*
			After determining which MySql query is going to be performed we
			delegate the task of building the query, executing the query and 
			parsing/returning the results to a specific MySql Command Object.
			
			(The MySqlSelect, MySqlInsert, MySqlUpdate & MySqlDelete class's
			 all extend the MySqlCommand Base class)
		*/
		
		if($type == "INSERT"){
			$this->useInsert();
			
		} elseif($type == "SELECT") {
			$this->useSelect();
			
		} elseif($type == "DELETE") {
			$this->useDelete();
			
		} elseif($type == "UPDATE") {
			$this->useUpdate();
			
		}
		
	}
	
	private function useInsert()
	{
		$qInsert = new MySqlInsert($this->model);
		$this->result = $qInsert->getResult();
	}
	
	private function useSelect()
	{
		$qSelect = new MySqlSelect($this->model);
		$this->result = $qSelect->getResult();
	}
	
	private function useDelete()
	{
		$qDelete = new MySqlDelete($this->model);
		$this->result = $qDelete->getResult();
	}
	
	private function useUpdate()
	{
		$qUpdate = new MySqlUpdate($this->model);
		$this->result = $qUpdate->getResult();
	}
	
	public function getResult()
	{
		return $this->result;
	}
	
}