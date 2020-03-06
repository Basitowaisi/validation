<?php 

session_start();

use eboybasit\validation\support\{Separable, Arr};
use eboybasit\validation\exceptions\{InsufficientDataException, InExactLengthException};
use eboybasit\validation\traits\ValidationRulesApplierTrait as ValidationTrait;
use eboybasit\validation\traits\ShareErrorsWithSessionTrait as PassErrorsToSession;

class App {

	use ValidationTrait, PassErrorsToSession;

	protected $rules = [];
	protected $attributes = [];
	protected $data = [];
  protected $rawData = [];
  protected $args = [];
  protected $limit;
  protected $errors = [];

  protected $compact = [];

  private function __construct(array $data, array $rules)
  {
		
		$this->rawData = $data;
		list($this->attributes, $this->data, $this->rules, $this->args) = Separable::initialize($data, $rules);
		$this->limit = Arr::length($rules);

		$this->compact = [
			'rules'      =>   $this->rules,
			'attributes' =>   $this->attributes,
			'data'       =>   $this->data, 
			'errors'     =>   &$this->errors,
      'args'       =>   $this->args
		];

		$this->start();	
  
  }

  public static function validate(array $data, array $rules) 
  {

  	$dataLength = Arr::length($data);
  	$rulesLength = Arr::length($rules);

  	try {

  		if( $dataLength == 0 || $rulesLength == 0 )
  			throw new InsufficientDataException("Size of data array and rules array must be greater than 0.");
  		elseif( $dataLength != $rulesLength )
  			throw new InExactLengthException("Size of data array and rules array must be equal");

  	} catch(Exception $e) {
  		
  			exit($e);
  	
  	}

  	return new static($data, $rules);

  }


  public function start() 
  {

  	for( $i = 0; $i < $this->limit ; $i++ )
	  	$this->applyValidationConstraintsToEach($i);
    $this->shareErrors();
  }

  public function applyValidationConstraintsToEach(int $index) 
  {
  	
  	foreach( $this->rules[$index] as $rule ) {
  		$init = $this->getInitiliazer($rule);
  		if( $init->check($this->compact, $index) === true )
  			continue;
  		else break;
  	}

  }

  public function passes() 
  {
    return (bool) Arr::length($this->errors) == 0; 
  }

  public function fails() 
  {
    return ! $this->passes();
  }

}
