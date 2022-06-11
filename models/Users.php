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

    public static function auth($login, $pass) 
    {
        $user = static::getOneWhere('login', $login);


        //password_hash('123', PASSWORD_DEFAULT);
        //password_verify('123', $hash);
        if ($pass == $user->pass) {
            $_SESSION['login'] = $login;
            return true;
        }
        return false;
    }

    public static function isAuth() 
    {
        return isset($_SESSION['login']);
    }

    public static function isAdmin() 
    {
        return $_SESSION['login'] == 'admin';
    }


    public static function getName() 
    {
        return $_SESSION['login'];
    }

    public static function getTableName()
    {
        return 'users';
    }
} 
