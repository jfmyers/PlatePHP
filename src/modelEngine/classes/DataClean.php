<?php

class DataClean implements DataCleanInterface
{
	public static function cleanData($data)
	{
		if( is_array($data) ){
			return self::reformatData($data);
			
		} else {
			throw new Exception("Invalid data format. Data must be an array.");
		}
		
	}
	
	private static function reformatData($data)
	{
		$reformatted = array();
		
		foreach($data as $key=>$value){
			if(is_numeric($key)){
				$reformatted[$value] = NULL;
			} else {
				$reformatted[$key] = $value;
			}
			
		}
		return $reformatted;
	}

}