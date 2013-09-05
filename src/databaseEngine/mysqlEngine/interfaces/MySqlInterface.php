<?php

interface MySqlInterface
{
	public function getType();
	public function getTable();
	public function getData();
	public function getOrderBy();
	public function getUpdateField();
	public function getFilter();
	public function getResult();
	
	
}