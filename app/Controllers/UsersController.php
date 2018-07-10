<?php
namespace App\Controllers;

use App\Models\Users;

class UsersController
{
	//metodos dentro do controller são chamados de actions   
    public function show($container, $params)
    {
    	$user = new Users($container);
    	$dados = $user->get($params[1]);
    	return 'Meu nome é: '.$dados['name'];
    }
}
