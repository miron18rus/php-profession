<?php

namespace app\models;
class Users extends Model
{

    public $id;
    public $login;
    public $password;


    public function __construct($login = null, $password = null) 
    {
        $this->login = $login;
        $this->password = $password;
    }

    public function getTableName()
    {
        return 'users';
    }
} 
