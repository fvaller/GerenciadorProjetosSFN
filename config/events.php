<?php
//Registro das class de ouvintes
$container['events']->attach('created.users', new App\Events\UsersCreated);
//$container['events']->attach('creating.users', new App\Events\UsersCreated);