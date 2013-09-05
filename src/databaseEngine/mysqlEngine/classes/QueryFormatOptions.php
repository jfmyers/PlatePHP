<?php
class QueryFormatOptions implements QueryFormatOptionsInterface
{

	public static function formatOrderBy($orderBy)
	{
		if( self::ArrayPass($orderBy) ){
			$formatted = array();
			foreach($orderBy as $key=>$value){
				if(strpos($value,'-') !== false){
					$field = str_replace("-","",$value);
					$direction = "DESC";
						
				}else{
					$field = $value;
					$direction = "ASC";
						
				}
				$formatted[] = $field . " " . $direction;
			}
			return implode(", ", $formatted);
				
		} else {
			return null;
		}
		
	}
	
	public static function formatFilter($filter)
	{
		if( self::ArrayPass($filter) ){
			$reformattedFilters = array();
			foreach($filter as $key=>$value){
				$reformattedFilters[] = "(" . $value . ")";
			}
			return implode(" && ",$reformattedFilters);
			
		} else {
			return null;
		}
		/*$statementArray = Utilities::multiExplode(array("AND","OR","&&","||","&"),$filter);
		foreach($statementArray as $key=>$statement){
			$keyValueArray = Utilities::multiExplode(array("=",">=","<=","!="),$statement);
			$filterValue = array_pop($keyValueArray);
			$filterValue = "'" . $filterValue . "'";
			$operator = "&&";
			$newStatements[] = $keyValueArray[0] . $operator . $filterValue;
		}
		
		$newFilter = implode()
		
		$filterArray = Utilities::multiExplode(array("=",">=","<=","!="),$filter);
		$brokenDown = implode(" ",$filterArray);
		*/
	}
	
	public static function formatFields($data)
	{
		if( self::ArrayPass($data) ){
			$fieldsArray = array();
			foreach($data as $key=>$value){
				$fieldsArray[]=$key;
			}
			return implode(",",$fieldsArray);
			
		} else {
			return null;
		}

	}
	
	public static function formatValues($data)
	{
		if( self::ArrayPass($data) ){
			$valuesArray = array();
			foreach($data as $key=>$value){
				$valuesArray[]="'".$value."'";
			}
			return implode(",",$valuesArray);
		} else {
			return null;
		}
	}
	
	private static function ArrayPass($array){
		if( is_array($array) ){
			if( count($array) > 0 ) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
	
}