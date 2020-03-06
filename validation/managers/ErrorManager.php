<?php 

namespace eboybasit\validation\managers;
use eboybasit\validation\support\Arr;
use eboybasit\validation\exceptions\NotFoundException;

class ErrorManager {

	protected $messages = [];

	public function __construct(array &$messages)
	{
		$this->messages = $messages['errors'];	
	}

	public function has(string $key) 
	{
	
		return (bool) array_key_exists($key, $this->messages);
	
	}

	public function get(string $key) 
	{		
		try{
			if( $this->has($key) ) 
				return $this->messages[$key];
		
			else 
				throw new NotFoundException("errors for the key `$key` does not exist");
		
		}catch(\Exception $e) {
			exit($e);
		}

	}

	public function all() 
	{
		if ( Arr::length($this->messages) >= 0 )
			return $this->messages;	
	}

	public function any() 
	{
		if(Arr::length($this->messages) > 0)
			return true;
		return false;
	}

}