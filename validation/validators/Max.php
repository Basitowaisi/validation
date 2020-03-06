<?php 

namespace eboybasit\validation\validators;

class Max extends ValidationRule {

	public function check($params, $index) 
	{
		if( $this->validate(
			function() use($params, $index) {
				return	[ 
					'value' =>	$params['data'][$index], 
					'max'  =>	$params['args']['max'][$index] 
				]; 
			})
		)
			return $this->next();
		else
			$message = config('messages.default.max');
			$params["errors"][ $params['attributes'][$index] ] = static::contains($message) ? sprintf( $message, $params['attributes'][$index], $params['args']['max'][$index] ) : $message; 
			return ! $this->next();	
	}

	public function validate(callable $callback) 
	{
		extract( $callback() );
		$max = (int) $max;
		return (strlen($value) > $max ? false : true);	
	}

}