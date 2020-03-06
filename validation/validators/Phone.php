<?php 

namespace eboybasit\validation\validators;
use eboybasit\validation\support\Str;

class Phone extends ValidationRule {

	public function check($params, $index) 
	{
		if( $this->validate(
			function() use($params, $index) {
				return [
					'phone'  =>	 $params['data'][$index]
				];
			}) 
		)
			return $this->next();
		else
			$message = config('messages.default.phone');
			$params["errors"][ $params['attributes'][$index] ] =  static::contains($message) ? sprintf( $message, $params['attributes'][$index]) : $message;  
			return ! $this->next();	
	}

	public function validate(callable $callback) 
	{
		extract( $callback() );
		//for stripping off the two or three digit country code and special chars like + and - (dashes) from the actual number;
		$phone = Str::contains($phone, '-') ? preg_replace('/\-*/' , '' , preg_replace('/^\+[\d]{2,3}/', '', $phone) ) : $phone;
		return (bool) preg_match('/^[0-9]{10}$/', $phone);
	}

}