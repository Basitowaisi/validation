<?php 

namespace eboybasit\validation\validators;

class Minmax extends ValidationRule {
	
	public function check($params, $index) 
	{
		if( $this->validate(
			function() use($params, $index) {
				return [
					'value'  =>	 $params['data'][$index], 
					'minmax' =>  $params['args']['minmax'][$index]
				];
			}) 
		)
			return $this->next();
		else
			$message = config('messages.default.minmax');
			$params["errors"][ $params['attributes'][$index] ] = static::contains($message) ? sprintf( $message, $params['attributes'][$index] , $params['args']['minmax'][$index][0] , $params['args']['minmax'][$index][1] ) : $message;  
			return ! $this->next();	
	}

	public function validate(callable $callback) 
	{
		extract( $callback() );
		$min = (int) $minmax[0];
		$max = (int) $minmax[1];
		return (strlen($value) > $max || strlen($value) < $min  ? false : true)  ;
	}

}