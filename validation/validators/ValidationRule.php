<?php


namespace eboybasit\validation\validators;
use eboybasit\validation\support\Str;

abstract class ValidationRule {

	abstract public function check($params, $index); 
	abstract public function validate(callable $callback);
	
	public function next()
	{
		return true;
	} 

	public static function contains($message)
	{		
		return !! preg_match('/%s/', $message);
	}

}