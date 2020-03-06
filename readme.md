# FORM DATA VALIDATION PACKAGE

This is a validation package which makes the process of validating your form data easy and seemless. This isn't much but can be beneficial at times.

## Installation:

> To use this package you must have php version 7 or more installed in your machine

- Start by installing this package to your machine
- Open up your command prompt or Terminal and type the following command in the shell

```sh
composer require eboybasit/validator
```

## Usage:

### Step 1.

> Import following file into your project where you want to use the package functionality

```php
require_once 'vendor/autoload.php';
```

### Step 2.


> Next, Assuming the data variable contains the data from your server in associative array form, then you can validate your data in either of the following ways:

Please note that the size of the two arrays i.e., the data array and validation rules array should be same.


```php
$data = [
	'email' => 'example@gmail.com',
	'email_confirm' => 'example@gmail.com',
	'phone' => '9622428688',
	'num' => 12,
	'color' => '#ff98ff'
];
$rules = [
	'required|email',
	'required|matches:email' ,
	'required|phone',
	'gte:13',
	'hex|minmax:3-6'
];
```

Data validation can be done in either of the two ways.

```php
 $validation = App::validate($data, $rules);
 if( $validation->passes() ){
	// write here logic if the validation test passed.
} else {
	// write here the logic for validation test failure.
}
```

<h3 align="center">OR</h3>


```php
if( validate($data, $rules)->passes() ){
	// write here logic if the validation test passed.
} else {
	// write here the logic for validation test failure.
}
```

### Step 3.

> You can also set custom error messages or rely on default error messages.

Open messages.php
Under custom key create your own error messages for different types of rules.

Please note that rule name in custom messages array should match the rule name of default array, so that it will override the default message properly

For example:

```php
	'custom' => [
		'hex' 	 	 => 'Please enter a 3 digit or 6 digit valid hex code',
		'minmax' 	 => //your message here,
		//rulename => custom error message

	];
```

### Step 4.

> You can fetch errors using this function.This function call returns all the validation errors.


```php
$errors = errors()->all();
```

## The Various Validation Rules Offered by the Spec are:
- ###  required
```
	It ensures that the field passed contains some data or is set or is not null.
```
- ### email
```
	It ensures that the field passed is of the type email and does not start with a number
```
- ### matches
```
	It ensures that this attributes value should match the other attributes values which is specified after colon
```
- ### lt
```
	It ensures that the value passed is less than a certain number which is specified after colon
```
- ### lte
```
	It ensures that the value passed is less than or equal to a certain number which is specified after colon
```
- ### gt
```
	It ensures that the value passed is greater than a certain number which is specified after colon
```
- ### gte
```
	It ensures that the value passed is greater than or equal to a certain number which is specified after colon
```
- ### min
```
	It ensures that the field data length should be aleast a number which is specified after colon
```
- ### max
```
	It ensures that the field data length should be atmost a number which is specified after colon
```
- ### minmax
```
	It ensures that the field data length should be aleast a number and should not be more than a number which is specified after colon separated by a hyphen
```
- ### phone
```
	It ensures that the field data should be a valid phone number
```
- ### hex
```
	It ensures that the field data should be a valid hex color. Either 3 digits or 6 digits hex values are allowed.
```
