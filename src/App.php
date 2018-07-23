<?php

namespace SON\Framework;

use Pimple\Container;
use SON\Framework\Response;
use SON\Framework\Router;
use SON\Framework\Exceptions\HttpExceptions;

class App {

	private $container;	
	private $middlewares = [
		'before' => [],
		'after' => [],
	];

	public function __construct(Container $container = null) {
		$this->container = $container;		

		//caso nao seja passado o container ja insejcao da depencia ele faz a instancia
		if( $this->container === null){
			$this->container = new Pimple;			
		}
	}


	public function middlewares($on, $callback){
		$this->middlewares[$on][] = $callback;
	}

	//cria na aplicação, dentro do container o router
	//onde forem chamados, teremos sempre a mesma instancia
	public function getRouter() {
		if(!$this->container->offsetExists('router')){
			$this->container['router'] = function () {
				return new Router;				
			};
		}
		return $this->container['router'];		
	}	

	//cria na aplicação, dentro do container o reponse
	//onde forem chamados, teremos sempre a mesma instancia
	public function getResponse() {
		if(!$this->container->offsetExists('response')){
			$this->container['response'] = function () {
				return new Response;				
			};
		}
		return $this->container['response'];		
	}	

	public function getHttpErrorHandler() {
		if(!$this->container->offsetExists('httpErrorHandler')){
			$this->container['httpErrorHandler'] = function ($c) {
				//logica de retorno de erro
				//vai retornar um erro como json
				header("Content-type: application/json");

				$response = json_encode([
					'code' => $c['exception']->getCode(), 
					"error" => $c['exception']->getMessage()
				]);

				return $response;
			};
		}
		return $this->container['httpErrorHandler'];		
	}

	public function run() {
		try {

			//imprime a resposta da rota	
			$result = $this->getRouter()->run();

			$response = $this->getResponse();
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
			$this->container['exception'] = $e;
			echo $this->getHttpErrorHandler();			
		}    	

	}
}