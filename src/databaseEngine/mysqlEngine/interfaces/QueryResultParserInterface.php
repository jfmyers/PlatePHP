<?php
	
interface QueryResultParserInterface
{
	public function parseInsert();
	public function parseSelect($data);
	public function mysqlSuccess();
	public function getResult();
	
}