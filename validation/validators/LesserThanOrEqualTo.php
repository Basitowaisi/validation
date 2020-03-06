<?php 

namespace eboybasit\validation\validators;

class LesserThanOrEqualTo extends ValidationRule {

	public function check($params, $index) 
	{
		if( $this->validate(
			function() use($params, $index) {
				return [
					'value' => $params['data'][$index], 
					'lte'   => $params['args']['lte'][$index]
				];
			}) 
		)
			return $this->next();
		else
			$message = config('messages.default.lte');
			$params["errors"][ $params['attributes'][$index] ] = 
				static::contains($message) ? sprintf( $message , $params['attributes'][$index], $params['args']['lte'][$index] ) : $message;  
			return ! $this->next();	
	}

	public function validate(callable $callback) 
	{
		extract( $callback() );
		$lte = (int) $lte;
		$value = (int) $value;
		return ($value <= $lte ? true : false);	
	}

}