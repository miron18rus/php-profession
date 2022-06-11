<?php

namespace app\controllers;
use app\models\Users;

class AuthController extends MainController 
{
    public function actionLogin() 
    {
        $login = $_POST['login'];
        $pass = $_POST['pass'];


        if(Users::auth($login, $pass)) {
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