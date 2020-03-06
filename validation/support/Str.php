<?php 

namespace eboybasit\validation\support;

class Str {

	public static function contains(string $haystack,string $needle) 
	{
		return (strpos($haystack, $needle) != false ? true : false);
	}
}