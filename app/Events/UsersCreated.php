<?php

namespace App\Events;

//Reponsavel pelo ouvinte 
class UsersCreated 
{
	public function __invoke($e)
	{
		//nome do evento
		$event = $e->getName();

		//paramatros do evento
		$params = $e->getParams();

		//imprime na tela 
		echo sprintf('Disparando event "%s", com parametros: %s', $event, json_encode($params));
	}
}
