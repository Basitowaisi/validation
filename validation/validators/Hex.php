<?php 

namespace eboybasit\validation\validators;

class Hex extends ValidationRule {

	public function check($params, $index) 
	{
		if( $this->validate(
			function() use($params, $index) {
				return [
					'value' =>	$params['data'][$index]
				];
			}) 
		)
			return $this->next();
		else
			$message = config('messages.default.hex');
			$params["errors"][ $params['attributes'][$index] ] = static::contains($message) ? sprintf( $message, $params['attributes'][$index] ) : $message;  
			return ! $this->next();	
	}

	public function validate(callable $callback) 
	{
		extract( $callback() );
		$hex = preg_match('/^\#[a-fA-F0-9]{3}$/', $value) || preg_match('/^\#[0-9a-fA-F]{6}$/', $value);
		return (bool) $hex;
	}

}