<?php

namespace SON\Framework;

use SON\Framework\Response;
use SON\Framework\Exceptions\HttpExceptions;

class App {
	private $container;
	private $router;
	private $middlewares = [
		'before' => [],
		'after' => [],
	];

	public function __construct($router, $container) {
		$this->container = $container;
		$this->router = $router;
	}


	public function middlewares($on, $callback){
		$this->middlewares[$on][] = $callback;
	}

	public function run() {
		try {

			//imprime a resposta da rota	
			$result = $this->router->run();

			$response = new Response;
			$params = [
				'container' => $this->container,
				'params' => $result['params']
			];

			//middlewares antes 
			foreach ($this->middlewares['before'] as $middleware) {
				$middleware($this->container);
			}

			$response($result['action'], $params);

			//middlewares antes 
			foreach ($this->middlewares['after'] as $middleware) {
				$middleware($this->container);
			}	

		} catch (HttpExceptions $e) {
			echo json_encode(["error" => $e->getMessage()]);
		}    	

	}
}