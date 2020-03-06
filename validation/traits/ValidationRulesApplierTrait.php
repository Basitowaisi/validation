<?php 

namespace eboybasit\validation\traits;

trait ValidationRulesApplierTrait {

	protected $classAliases = [
  	'email' 		=> 	\eboybasit\validation\validators\Email::class,
  	'phone' 		=> 	\eboybasit\validation\validators\Phone::class,
  	'required' 	=> 	\eboybasit\validation\validators\Required::class,
  	'matches' 	=> 	\eboybasit\validation\validators\Matches::class,
  	'min' 			=> 	\eboybasit\validation\validators\Min::class,
  	'max' 			=> 	\eboybasit\validation\validators\Max::class,
  	'minmax' 		=> 	\eboybasit\validation\validators\Minmax::class,
  	'lt' 				=> 	\eboybasit\validation\validators\LesserThan::class,
  	'gt' 				=> 	\eboybasit\validation\validators\GreaterThan::class,
  	'lte' 			=> 	\eboybasit\validation\validators\LesserThanOrEqualTo::class,
  	'gte' 			=> 	\eboybasit\validation\validators\GreaterThanOrEqualTo::class,
  	'hex' 			=> 	\eboybasit\validation\validators\Hex::class,
  ];

  public function getInitiliazer(string $rule) 
  {
  	
  	if( ! array_key_exists($rule, $this->classAliases) )   
	  	throw new \Exception("{$rule} Rule not defined.");

	  return (new $this->classAliases[$rule]);

  }

}