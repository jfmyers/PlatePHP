<?php
	
interface CollectionDataInterface
{
	public function filter($filter);
	public function orderBy($orderBy);
	public function fetch();
	public function getResult();
	
}