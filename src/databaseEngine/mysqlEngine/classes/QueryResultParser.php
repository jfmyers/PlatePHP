<?php

class QueryResultParser implements QueryResultParserInterface
{
	private $queryResult;
	private $insertId;
	private $result;
	
	public function __construct($queryResult)
	{
		$this->queryResult = $queryResult;
	}
	
	public function parseInsert()
	{
		$queryResult = $this->queryResult;
		$this->result = $this->insertId = mysql_insert_id();
		
	}
	
	public function parseSelect($data)
	{
		if( is_array($data) ){
			$queryResult = $this->queryResult;
			$numRows = mysql_num_rows($queryResult);
			
			if($numRows > 1){
				for($i=0;$i<$numRows;$i++){
					foreach($data as $key=>$value){
						$formattedResult[$i][$key] = mysql_result($queryResult, $i, $key);
					}
				}
			} elseif($numRows == 1){
				$row = mysql_fetch_array($queryResult);
				foreach($data as $key=>$value){
					$formattedResult[$key] = $row["$key"];
				}
			} else {
				$formattedResult = array();
			}
			
			$this->result = $formattedResult;
			
		} else {
			throw new Exception("Unable to return results. Data fields have not be set.");
			
		}

	}
	
	public function mysqlSuccess()
	{
		$queryResult = $this->queryResult;
		if(!$queryResult){
			return false;
			
		} else {
			return true;
		}
		
	}
	
	public function getResult()
	{
		return $this->result;
	}
	
}