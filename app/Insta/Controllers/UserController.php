<?php
namespace Insta\Controllers;
// App
use Insta\Controllers\Controller;
use Insta\Models\User;
use Insta\Validators\RegisterUserValidator;
use Respect\Validation\Exceptions\NestedValidationException;
// Slim
use Slim\Http\Request;
use Slim\Http\Response; 

class UserController extends Controller
{
	public function create(Request $request, Response $response, array $segments)
	{
		return $this->response($request, $response, 'create');
	}

	/**
	 * I would work to make this method much more concise, although the validation
	 */
	public function store(Request $request, Response $response, array $segments)
	{
		try {
			$validator = (new RegisterUserValidator($request))->validate();
			$input = $validator->input();
			// Unset password confirmation, otherwise Model will try and insert that as a column
			unset($input['password_confirmation']);
			User::create($input);
			$this->success = "Thanks for registering!";
		} catch (\Exception $e) {
			if ($e instanceof NestedValidationException) {
				$this->errors = $e->getMessages();
			} else {
				$this->errors[] =  'Failed to create your account. Please contact an admin';
			}
		}
		return $this->response($request, $response, 'create');
	}
}