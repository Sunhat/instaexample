<?php
namespace Insta\Controllers;

class ExampleController extends Controller
{
	public function index($request, $response)
	{
		return $this->response($request, $response, 'example');
	}
}