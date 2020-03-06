<?php 

namespace eboybasit\validation\traits;
use eboybasit\validation\support\Arr;

trait ShareErrorsWithSessionTrait {

	public function shareErrors() 
	{
		if ( Arr::length($this->errors) > 0 ) 
			$_SESSION['errors'] = $this->errors;
		else 
			$_SESSION['errors'] = [];
	}

}