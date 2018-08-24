<?php
namespace App\Controllers;

use App\Models\Users;

class UsersController
{
	//metodos dentro do controller são chamados de actions   
    public function show($container, $request)
    {    	
    	$user = new Users($container);

    	//chamando o metodo create para simular o evento
    	$user->create(['name' => 'Fulano de Tal']); 

    	return $user->get($request->attributes->get(1));
    	//return 'Meu nome é: '.$dados['name'];
    }
}
