<?php

interface QueryBuilderInterface
{
	public function getQueryString();
	public function formatFields();
	public function formatFilter();
	public function formatValues();
	public function formatOrderBy();
	public function assembleInsert();
	public function assembleUpdate();
	public function assembleDelete();
	public function assembleSelect();
	
}