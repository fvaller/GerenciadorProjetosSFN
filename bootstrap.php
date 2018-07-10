<?php 
//echo '<pre>';
require __DIR__ .'/vendor/autoload.php';

$router = new SON\Framework\Router;

require __DIR__ . '/config/containers.php';
require __DIR__ . '/config/routes.php';

try {
	//imprime a resposta da rota	
	$result = $router->run();

	$response = new SON\Framework\Response;
	$params = [
		'container' => $container,
		'params' => $result['params']
	];
	$response($result['action'], $params);

} catch (SON\Framework\Exceptions\HttpExceptions $e) {
	echo json_encode(["error" => $e->getMessage()]);
}