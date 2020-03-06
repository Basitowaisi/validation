<?php 

namespace eboybasit\validation\validators;

class GreaterThan extends ValidationRule {

	public function check($params, $index) 
	{
		if( $this->validate(
			function() use($params, $index) {
				return [
					'value' => 	$params['data'][$index], 
					'gt'    =>	$params['args']['gt'][$index]
				];
			})
		)
			return $this->next();
		else
			$message = config('messages.default.gt');
			$params["errors"][ $params['attributes'][$index] ] = 
				static::contains($message) ? sprintf($message , $params['attributes'][$index] , $params['args']['gt'][$index] ) : $message ;  
			return ! $this->next();	
	}

	public function validate(callable $callback) 
	{
		extract( $callback() );
		$gt = (int) $gt;
		$value = (int) $value;
		return ($value > $gt ? true : false);	
	}

}