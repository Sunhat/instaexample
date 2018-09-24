<?php
namespace Insta\Validators;
// Slim
use Slim\Http\Request;
// Third-party
use Respect\Validation\Validator as v;

/**
 * I built this to pull some validation logic away from the Controller.
 * It uses the rules array keys to find the user input (POST/GET)
 * Then validates the fields.
 * Inspired by Laravel
 * ------
 * Extend this class to build a Validator. See RegisterUserValidator.
 * ReigsterUserValidator::validate($request)
 */
abstract class Validator
{

	protected $validator;
	protected $input;

	public function __construct(Request $request)
	{
		$this->validator = new v;
		foreach($this->rules($request) as $key => $rules) {
			// Extract the Request POST/GET data based on rules() keys 
			$this->input[$key] = $request->getParam($key);
			// Add each rule found to Validator object.
			$this->validator->attribute($key, $rules);
		}
	}

	/**
	 * Make the validators methods available through this object
	 */
	public function __call($name, $arguments)
	{
		return call_user_func([$this->validator, $name], $arguments);
	}


	final public function validate(): bool
	{
		return $this->validator->assert((object) $this->input);
	}

	final public function input(): array
	{
		return $this->input;
	}

	abstract public function rules(Request $request): array;
}