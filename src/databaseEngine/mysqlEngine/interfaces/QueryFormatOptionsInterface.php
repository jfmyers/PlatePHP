<?php

interface QueryFormatOptionsInterface
{
	public static function formatOrderBy($orderBy);
	public static function formatFilter($filter);
	public static function formatFields($data);
	public static function formatValues($data);
	
}