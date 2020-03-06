<?php 

namespace eboybasit\validation\validators;

class Min extends ValidationRule {

	public function check($params, $index) 
	{
		if( $this->validate(
			function() use($params, $index) {
				return [
					'value' =>	 $params['data'][$index], 
					'min'		=>	 $params['args']['min'][$index]
				];
			}) 
		)
			return $this->next();
		else
			$message = config('messages.default.min');
			$params["errors"][ $params['attributes'][$index] ] = 
				static::contains($message) ? sprintf( $message, $params['attributes'][$index], $params['args']['min'][$index] ) : $message;  
			return ! $this->next();	
	}

	public function validate(callable $callback) 
	{
		extract( $callback() );
		$min = (int) $min;
		return (strlen($value) >= $min ? true : false);		
	}

}