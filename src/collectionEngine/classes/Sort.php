<?php
	
class Sort implements UtilityOptionInterface
{
	private $sortValue;
	private $sortField;
	private $sortDirection;
	private $models;
	
	public function __construct($sortValue, $models)
	{
		$this->sortValue = $sortValue;
		$this->models = $models;
		$this->setValues();
		$this->run();
		
	}
	
	private function run()
	{
		$sortValue = $this->sortValue;
		$models = $this->models;
		
		$field = $this->sortField;
		$direction = $this->sortDirection;
		
		$sortArray = array();
		foreach($models as $modelKey=>$array) {
			$value = trim(strtolower($array[$field]));
			$sortArray[$modelKey] = $value;
		}
		$this->result = $this->sort($sortArray);
	}
	
	private function sort($sortArray)
	{
		$models = $this->models;
		$direction = $this->sortDirection;
		$sorted = array();
		if( is_array($sortArray) ) {
			if($direction == "ASC") {
				asort($sortArray);
			} else {
				arsort($sortArray);
			}
			foreach($sortArray as $key=>$value){
				$sorted[] = $models[$key];
			}
		}
		
		return $sorted;
	}
	
	private function setValues()
	{
		$sortValue = $this->sortValue;
		if(strpos($sortValue,'-') !== false){
			$data["field"] = str_replace("-","",$sortValue);
			$data["direction"] = "DESC";
			
		} elseif(strpos($sortValue,'+') !== false) {
			$data["field"] = str_replace("+","",$sortValue);
			$data["direction"] = "ASC";
		} else {
			$data["field"] = $sortValue;
			$data["direction"] = "ASC";
		}
		
		$this->sortField = $data["field"];
		$this->sortDirection = $data["direction"];
	}
	
	public function getResult()
	{
		return $this->result;
	}
}