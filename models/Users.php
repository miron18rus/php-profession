<?php

namespace app\models;
class Users extends DBModel
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

    public static function getTableName()
    {
        return 'users';
    }
} 
