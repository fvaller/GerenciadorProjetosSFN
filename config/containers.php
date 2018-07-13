<?php

use Pimple\Container;

$container = new Container();

//registrando um container

//Container de eventos
$container['events'] = function(){
	return new Zend\EventManager\EventManager;

};

//Container da conexao 
$container['db'] = function(){

	$dsn = 'mysql:host=localhost;dbname=gprojetos';
	$username = 'root';
	$password = 'root2017';
	$options = [
		\PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
	];

	$pdo = new \PDO($dsn, $username, $password, $options);

	$pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

	return $pdo;
};
