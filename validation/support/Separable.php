<?php 

namespace eboybasit\validation\support;

class Separable {
	
	public static function initialize(array $data , array $rules) 
	{
		
		$rulesData = [];
		$extra = [];
		$new = [];
		foreach ($rules as $rule) 
		{
			$rulesData[] = gettype($rule) == 'string' ? self::separate($rule) : $rule;  		
		} 

		foreach ($rulesData as $index => $ruleArray) 
		{
			foreach ($ruleArray as $rule) {
			
				if ( Str::contains($rule, ':') ){
					$explode = explode(':',$rule);
					$extra[$explode[0]]["{$index}"] = $explode[1];

					if(gettype($explode) == 'array' && Str::contains( $explode[1], '-' ) ) {
						$exploded = explode('-', $explode[1]);
						$extra[$explode[0]]["{$index}"] = $exploded;

					}
				}

				if( Str::contains($rule, ':') )
					$new[$index][] = preg_replace('#\:(.)*#', '', $rule);
				else
					$new[$index][] = $rule;
			}
		}

		if(array_key_exists('matches', $extra)) {
			foreach ($extra['matches'] as $key => $value) {
				$extra['matches'][$key] = $data[$value];
			}
		}
		
		return [ 
			array_keys($data),
		 	array_values($data),
		 	$new,
		 	$extra 
		];

	}

	public static function separate(string $data) 
  {
  	return explode('|', 
  		trim($data, '|')
  	);
  }

}