<?php

interface PlateModelInterface
{
	/*Action Methods*/
	public function save();
	public function fetch();
	public function delete();
	public function result();
	
	/*Option Methods*/
	public function filter($filter);
	public function all();
	public function orderBy($orderBy);
	public function update($updateField);
	public function resetOptions();
	
	/*Public Accessors*/
	public function getData();
	public function getMetaData();
	public function getUpdateField();
	public function getDbAction();	
	public function getDbFilter();	
	public function getDbOrderBy();	
	public function getDbAll();
	
}