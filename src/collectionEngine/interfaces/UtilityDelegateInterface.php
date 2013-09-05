<?php

interface UtilityDelegateInterface
{
	public function where($key, $operator, $value);
	public function sort($sortValue);
	public function getResult();
}
