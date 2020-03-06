<?php 

namespace eboybasit\validation\support;

class Arr {

	public static function length(array $data) 
	{
		return count(
			array_keys($data)
		);
	}


}