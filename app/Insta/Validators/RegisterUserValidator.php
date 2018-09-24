<?php
namespace Insta\Validators;
// App
use Insta\Models\User;
// Slim
use Slim\Http\Request;
// Third-party
use Respect\Validation\Validator as v;

class RegisterUserValidator extends Validator
{

	private $password_blacklist = [
		'pass',
		'word',
		'password',
		'abc123',
		'1234',
		'12345',
		'123456',
		'12345678',
		'123456789',
		'1234567890',
		'0987654321',
		'987654321',
		'87654321',
		'7654321',
		'654321',
		'54321',
		'4321',
		'qwerty',
		'instasupply',
		'passw0rd',
	]; 

	public function rules($request): array
	{
		return [
			'email' => v::email()->callback(function($email) {
				return !(bool) User::find($email, 'email');
			}),
			'password' => v::noneOf( v::in($this->password_blacklist, true) ),
			'password_confirmation' => v::equals($request->getParam('password')),
			'name' => v::length(1),
			'dob' => v::date('Y-m-d'),
		];
	}
}