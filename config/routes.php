<?php
//registra as rotas 

//use faz com que a variavel fique acessivel dentro do função
$router->add('GET', '/', function() {
	//$pdo = $container['db'];
	//var_dump($pdo);
	return 'estamos na homepage';
});

//(\d+) um ou mais digitos
//([a-z\-]+) caracteres entre a e z ou hifem
$router->add('GET', '/users/(\d+)', '\App\Controllers\UsersController::show');