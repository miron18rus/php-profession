<?php

namespace app\controllers;
use app\models\repositories\UserRepository;
use app\engine\Request;

class AuthController extends MainController 
{
    public function actionLogin() 
    {
        $login = (new Request())->getParams()['login'];
        $pass = (new Request())->getParams()['pass'];


        if((new UserRepository())->auth($login, $pass)) {
            header('Location:' . $_SERVER['HTTP_REFERER']);
            die();
        } else {
            die('Не верный логин пароль');
        }
    }


    public function actionLogout()
    {
        session_regenerate_id();
        session_destroy();
        header('Location:' . $_SERVER['HTTP_REFERER']);
        die();
    }

}