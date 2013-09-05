<?php
	
class Where implements UtilityOptionInterface
{
	private $key;
	private $operator;
	private $value;
	private $models;
	
	public function __construct($key, $operator, $value, $models)
	{
		$this->key = $key;
		$this->operator = $operator;
		$this->value = $value;
		$this->models = $models;
		
		$this->run();
		
	}
	
	private function run()
	{
		$key = $this->key;
		$operator = $this->operator;
		$value = $this->value;
		$models = $this->models;
				
		$newModels = array();
		if( isset($models) && is_array($models) ) {
			foreach($models as $modelKey => $array) {
				if($operator == "=" || $operator == "==") {
					if($array[$key] == $value){
						$newModels[] = $array;
					}
				} elseif($operator == "!=") {
					if($array[$key] != $value){
						$newModels[] = $array;
					}
				} elseif($operator == ">") {
					if($array[$key] > $value){
						$newModels[] = $array;
					}
				} elseif($operator == ">=") {
					if($array[$key] >= $value){
						$newModels[] = $array;
					}
				} elseif($operator == "<") {
					if($array[$key] < $value){
						$newModels[] = $array;
					}
				} elseif($operator == "<=") {
					if($array[$key] <= $value){
						$newModels[] = $array;
					}
				} else {
					$newModels = null;
				}
				
			}
		}
		$this->result = $newModels;
	}
	
	public function getResult()
	{
		return $this->result;
	}
}