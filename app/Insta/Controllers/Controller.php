<?php
namespace Insta\Controllers;

use Slim\Http\Request;
use Slim\Views\Blade;
use Slim\Http\Response; 
use Psr\Log\LoggerInterface;

class Controller {

	protected $container;
	protected $view;
	protected $logger;
	protected $route;
	protected $errors = [];

	public function __construct($container)
	{
		$this->view = $container->get('view');
		$this->logger = $container->get('logger');
		$this->container = $container;
	}

	/**
	 * This method gets used in Blade templates.
	 * It checks if the current route name is matches one of strings provided
	 * e.g. $controller->isRoute('')
	 */
	public function isRoute() {
		$args = func_get_args();
		foreach($args as $arg) {
			if($arg === $this->container->get('currentRoute'))
				return 'active';
		}
		return null;
	}


	/**
	 * This method can be used for the child Controllers.
	 * to make responses easier
	 */
	protected final function response(Request $request, Response $response, string $view = '', array $data = [])
	{
		$data = $this->buildResponse($data);
		if (count($request->getHeader('X-Requested-With')) > 0 && $request->getHeader('X-Requested-With')[0] === 'XMLHttpRequest') {
			return $this->json($request, $data);
		}
		return $this->view->render($response, $view, $data);
	}

	/**
	 * Build the data for the response
	 * Hide errors if there are none
	 */
	private final function buildResponse(array $data, $json = false)
	{
		if(count($this->errors) > 0) {
			http_response_code(418);
		}
		$data['errors'] = $this->errors;
		$data['routeName'] = $this->container->get('currentRoute');
		$data['controller'] = $this;
		return $data;
	}

	/**
	 * Build a JSON response
	 */
	private final function json(Request $request, array $data = [])
	{
		$data = $this->buildResponse($data);
		if(count($this->errors) === 0) {
			unset($data['errors']);
		}
		header("Content-Type: application/json");
		echo json_encode($data);
		exit;
	}
}