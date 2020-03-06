<?php 

namespace eboybasit\validation\validators;

class LesserThan extends ValidationRule {

	public function check($params, $index) 
	{
		if( $this->validate(
			function() use($params, $index) {
				return [
					'value' =>	 $params['data'][$index], 
					'lt'		=>	 $params['args']['lt'][$index]
				];
			}) 
		)
			return $this->next();
		else
			$message = config('messages.default.lt');
			$params["errors"][ $params['attributes'][$index] ] = 
				static::contains($message) ? sprintf( $message , $params['attributes'][$index], $params['args']['lt'][$index] ) : $message;  
			return ! $this->next();	
	}

	public function validate(callable $callback) 
	{
		extract( $callback() );
		$lt = (int) $lt;
		$value = (int) $value;
		return ($value < $lt ? true : false);	
	}

}