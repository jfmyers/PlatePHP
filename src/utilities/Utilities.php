<?php

class PlateUtilities
{
	public static function sanitizeData($data)
	{
		if(isset($data) && count($data) > 0){
			foreach($data as $key=>$value){
				if(!is_array($value) && !is_object($value)){
					$dataClean[$key]=mysql_real_escape_string($value);
				}else{
					$dataClean[$key]=$value;
				}
			}
		}else{
			//throw new Error;
		}
		return $dataClean;
	}
	public static function is_multi_array($a) {
	    foreach ($a as $v) {
	        if (is_array($v)) return true;
	    }
	    return false;
	}
	public static function multiExplode($delimiters, $string)
	{
	    $return_array = Array($string); // The array to return
	    $d_count = 0;
	    while (isset($delimiters[$d_count])) // Loop to loop through all delimiters
	    {
	        $new_return_array = Array(); 
	        foreach($return_array as $el_to_split) // Explode all returned elements by the next delimiter
	        {
	            $put_in_new_return_array = explode($delimiters[$d_count],$el_to_split);
	            foreach($put_in_new_return_array as $substr) // Put all the exploded elements in array to return
	            {
	                $new_return_array[] = $substr;
	            }
	        }
	        $return_array = $new_return_array; // Replace the previous return array by the next version
	        $d_count++;
	    }
	    return $return_array; // Return the exploded elements
	}
	
	public static function isMizedString($str)
	{
		if(preg_match('/[A-Za-z]/', $text) && preg_match('/[0-9]/', $text)){
			return true;
		}else{
			return false;
		}
	}
	
	public static function isEmail($email)
	{
		return preg_match('/^\S+@[\w\d.-]{2,}\.[\w]{2,6}$/iU', $email) ? TRUE : FALSE;
	}
	
	public static function pwdHash($pwd, $salt = null)
	{
		//Password and salt generation
	    if ($salt === null){
	        $salt = substr(md5(uniqid(rand(), true)), 0, 9);
	    }else{
	        $salt = substr($salt, 0, 9);
	    }
	    return $salt.sha1($pwd.$salt);
	}
	
	public static function randLetter()
	{
		return chr(97 + mt_rand(0, 25));
	}
	
	public static function isURL($url)
	{
		if(preg_match('/^(http|https|ftp):\/\/([A-Z0-9][A-Z0-9_-]*(?:\.[A-Z0-9][A-Z0-9_-]*)+):?(\d+)?\/?/i', $url)) {
			return true;
		}else{
			return false;
		}
	} 
	
	public static function endsWith($Haystack, $Needle)
	{
	    return strrpos($Haystack, $Needle) === strlen($Haystack)-strlen($Needle);
	}
	
	public static function getFirstLetter($text)
	{
		$fistLetter = strtolower(substr($text,0,1));
		return $fistLetter;
	} 
	
	public static function abbreviate($cutOff,$text)
	{
		//abbreviate to 3 lines of text by the cut off
		if(strlen($text)>$cutOff){
			$abbrev = str_split($text,$cutOff);
			$abbrev = trim($abbrev[0])."...";
			return $abbrev;
		}else{
			return $text;
		}
	}
	
	public static function month_to_text($month)
	{
		if($month == 1){
			return "January";
		}elseif($month == 2){
			return "February";
		}elseif($month == 3){
			return "March";
		}elseif($month == 4){
			return "April";
		}elseif($month == 5){
			return "May";
		}elseif($month == 6){
			return "June";
		}elseif($month == 7){
			return "July";
		}elseif($month == 8){
			return "August";
		}elseif($month == 9){
			return "September";
		}elseif($month == 10){
			return "October";
		}elseif($month == 11){
			return "November";
		}elseif($month == 12){
			return "December";
		}
	}
	
	public static function calculateTimePosted($time,$timezone)
	{
		$timezone = "UTC";
		date_default_timezone_set($timezone);
		
		$now =time();
		if((($now-$time)/60)<(24*60)){
			if(($now-$time)<60){
				$seconds = round(($now-$time));
				if($seconds != 1){
					return $seconds." seconds ago";
				}else{
					return $seconds." second ago";
				}
			}elseif((($now-$time)/60)<60){
				$minutes = round((($now-$time)/60));
				if($minutes != 1){
					return $minutes." minutes ago";
				}else{
					return $minutes." minute ago";
				}
			}elseif((($now-$time)/60)>60){
				$hours = round(((($now-$time)/60)/60));
				if($hours != 1){
					return $hours." hours ago";
				}else{
					return $hours." hour ago";
				}
			}
		}else{
			if(date('Y',$time) != date('Y',$now)){
				return date('F j, Y',$time);
			}else{
				return date('F j',$time);
			}
		}
	}

}