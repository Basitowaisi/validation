
<?php 

require_once 'App.php';
use eboybasit\validation\managers\ErrorManager;
use eboybasit\validation\support\{Str, Arr};

function errors() {

	$e = new ErrorManager($_SESSION);
	return $e;

}

function validate(array $data, array $rules) {

	return App::validate($data, $rules);

}


function config($configname) 
{
	if( is_null($configname) )
		return;
	if( Str::contains($configname, '.') ) {
		
		$splitted = explode('.', $configname);

		if( Arr::length($splitted) == 3 ) {
			return evaluate(...$splitted);			
		}
		else return;
	}
}

function evaluate($filename, $arrayname, $keyname) 
{
	$array = require "{$filename}.php";
	try {
		if( $arrayname != 'default' )
			throw new \Exception("Please check your dot notation again, Key {{$arrayname}} does not exist in {$filename}.php");
	}catch(\Exception $e) {
		exit($e);
	}
	//if the custom key has error messages set for different rules then return them or else return default messages.
	return  $array['custom'][$keyname] ?? $array[$arrayname][$keyname];
}