<?php 

require_once 'vendor/autoload.php';

/**
*
*
*		required, email, phone, min, max, minmax, lt, gt, lte, gte, matches, hex
*
*
**/

$data = [
	'email' => 'e!boybasit@gmail.com', 
	'email_confirm' => '\eboybasit@gmail.com', 
	// 'phone' => '+91-9622-428-688', 
	'phone' => '9622428688$', 
	'num' => 12, 
	'color' => '1#ff98ff'
];
$rules = [
	'required|email', 
	'required|matches:email' , 
	'required|phone', 
	'minmax:13-14', 
	'hex'
];

// $validation = App::validate($data, $rules);
// $validation->passes();
if( validate($data, $rules)->passes() ){
	echo "Passed\n";
} else {
	foreach (errors()->all() as $key => $value) {
		echo "$key: $value\n";
	}
}
