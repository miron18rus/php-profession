<?php

namespace app\controllers;
use app\engine\App;

class AuthController extends MainController 
{
    public function actionLogin() 
    {
        $login = App::call()->request->getParams()['login'];
        $pass = App::call()->request->getParams()['pass'];


        if(App::call()->userRepository->auth($login, $pass)) {
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