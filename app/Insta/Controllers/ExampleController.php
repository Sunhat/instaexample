<?php
namespace Insta\Controllers;

class ExampleController extends Controller {
	
	public function index($request, $response)
	{
		return $this->render($request, $response, 'example');
	}

}