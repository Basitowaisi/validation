<?php 

namespace eboybasit\validation\validators;

class Matches extends ValidationRule {

	public function check($params, $index) 
	{
		if( $this->validate(
			function() use($params, $index) {
				return [
					'value' =>	 $params['data'][$index], 
					'match'	=>	 $params['args']['matches'][$index]
				];
			}) 
		)
			return $this->next();
		else
			$message = config('messages.default.matches');
			$params["errors"][ $params['attributes'][$index] ] = 
				static::contains($message) ? sprintf( $message, $params['attributes'][$index], $params['args']['matches'][$index] ) : $message;
			return ! $this->next();
	}

	public function validate(callable $callback) 
	{
		extract( $callback() );
		return ($value == $match ? true : false);
	}

}