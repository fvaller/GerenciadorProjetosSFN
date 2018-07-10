<?php
namespace App\Controllers;

use App\Models\Users;

class UsersController
{
	//metodos dentro do controller são chamados de actions   
    public function show($container, $request)
    {    	
    	$user = new Users($container);
    	return $user->get($request->attributes->get(1));
    	//return 'Meu nome é: '.$dados['name'];
    }
}
