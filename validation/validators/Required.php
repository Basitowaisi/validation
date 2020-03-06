<?php 

namespace eboybasit\validation\validators;

class Required extends ValidationRule {

	public function check($params, $index) 
	{
		if( $this->validate(
			function() use($params, $index) {
				return [
					'value'  =>	 $params['data'][$index]
				];
			}) 
		)
			return $this->next();
		else
			$message = config('messages.default.required');
			$params["errors"][ $params['attributes'][$index] ] = static::contains($message) ? sprintf( $message, $params['attributes'][$index] ) : $message;  
			return ! $this->next();
	}

	public function validate(callable $callback) 
	{
		extract( $callback() );
		return ( isset($value) && !empty($value) ? true : false );
	}

}