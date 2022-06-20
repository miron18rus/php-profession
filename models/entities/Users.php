<?php

namespace app\models\entities;
use app\models\Entity;
class Users extends Entity
{

    protected $id;
    protected $login;
    protected $password;


    protected $props = [
        'name' => false,
        'password' => false,
    ];

    public function __construct($login = null, $password = null) 
    {
        $this->login = $login;
        $this->password = $password;
    }

} 
