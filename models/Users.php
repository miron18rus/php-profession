<?php

namespace app\models;


class Users extends Model
{

    public $id;
    public $login;
    public $password;

    public function getTableName()
    {
        return 'users';
    }
} 
