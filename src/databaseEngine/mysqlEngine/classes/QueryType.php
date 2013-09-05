<?php
	
class QueryType implements QueryTypeInterface
{
	public static function getType($model)
	{
		$dbAction = $model->getDbAction();
		$data = $model->getData();
		
		if($dbAction == "save"){
			if($data["id"] == NULL && $model->getUpdateField() == "") {
				return "INSERT";
			} else {
				return "UPDATE";
			}
			
		} elseif($dbAction == "fetch") {
			return "SELECT";
			
		} elseif($dbAction == "delete") {
			return "DELETE";
			
		}
		
	}
	
}