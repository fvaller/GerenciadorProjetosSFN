<?php

namespace App\Models;
use Pimple\Container;

class Users
{
    private $db;
	private $events;

	public function __construct(Container $container){
        $this->db = $container['db'];       
		$this->events = $container['events'];		
	}
    
    public function get($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id=?");
        $stmt->execute([$id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function create(array $data)
    {
        //1.criando e disparando os eventos
        //2.criar o ouvintes desses eventos
        $this->events->trigger('creating.users', null, $data); //antes da criação
        // inserir no banco aqui
        $this->events->trigger('created.users', null, $data); //após a criação
    }


}
