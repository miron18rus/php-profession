<?php

namespace app\models\repositories;

use app\models\entities\Users;
use app\models\Repository;

class UserRepository extends Repository
{
    public function auth($login, $pass) {


        $user = $this->getOneWhere('login', $login); //что написать здесь?? вопрос  в чат

        if ($user != false && password_verify($pass, $user->pass)) {
            $_SESSION['login'] = $login;
            return true;
        }
        return false;

    }

    public function isAuth() {
        return isset($_SESSION['login']);
    }

    public function isAdmin() {
        return $_SESSION['login'] == 'admin';
    }

    public function getName() {
        return $_SESSION['login'];
    }

    protected function getEntityClass() {
        return Users::class;
    }

    public function getTableName() {
        return 'users';
    }
}