<?php 

namespace eboybasit\validation\validators;

class Email extends ValidationRule {

	public function check($params, $index) 
	{		
		if( 
			$this->validate(
				function() use($params, $index) {
					return [ 
						'email' => $params['data'][$index] 
					];
			})	 
		)
			return $this->next();
		else
			// exit($params['attributes'][$index]);
			$message = config('messages.default.email');
			$params["errors"][ $params['attributes'][$index] ] = static::contains($message) ? sprintf( $message, $params['data'][$index] ) : $message;  
			return ! $this->next();
	}

	public function validate(callable $callback) 
	{
		extract( $callback() );
		return (filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match('/^[0-9]/', $email));

	}

}