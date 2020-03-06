<?php 

namespace eboybasit\validation\validators;

class GreaterThanOrEqualTo extends ValidationRule {

	public function check($params, $index) 
	{
		if( $this->validate(
				function() use($params, $index) {
					return [
						'value' =>	$params['data'][$index], 
						'gte'   =>	$params['args']['gte'][$index]
					];
				}) 
		)
			return $this->next();
		else
			$message = config('messages.default.gte');
			$params["errors"][ $params['attributes'][$index] ] = 
				static::contains($message) ? sprintf(  $message, $params['attributes'][$index], $params['args']['gte'][$index] ) : $message;  
			return ! $this->next();	
	}

	public function validate(callable $callback) 
	{
		extract( $callback() );
		$gte = (int) $gte;
		$value = (int) $value;
		return ($value >= $gte ? true : false);	
	}

}