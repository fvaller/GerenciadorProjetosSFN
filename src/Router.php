<?php

namespace SON\Framework;

use SON\Framework\Exceptions\HttpExceptions;

class Router {

	private $routes = [];

	public function add(string $method, string $pattern, $callback)
	{
		$method = strtolower($method);
		$pattern = '/^' . str_replace('/', '\/', $pattern) . '$/';
		$this->routes[$method][$pattern] = $callback;		
	}

	public function getCurrentUrl()
	{
		$url = $_SERVER['PATH_INFO'] ?? '/';

		if(strlen($url) > 1)
			$url = rtrim($url, '/');

		return $url;
	}

	public function run()
	{		
		$url = $this->getCurrentUrl();
		$method = strtolower($_SERVER['REQUEST_METHOD']);	

		if(empty($this->routes[$method])){
			throw new HttpExceptions('Page not found', 404);
		}

		foreach ($this->routes[$method] as $route => $action) {
			if(preg_match($route, $url, $params)){
				//return $action($params);
				return compact('action', 'params');
			}
			
		}
		throw new HttpExceptions('Page not found', 404);

		// if (array_key_exists($route, $this->routes)){
		// 	return $this->routes[$route]();			
		// }
	}
        
}