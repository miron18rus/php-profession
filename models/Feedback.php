<?php

namespace app\models;

class Feedback extends Model
{

    public $id;
    public $user;
    public $feedback;

    public function getTableName()
    {
        return 'feedback';
    }
}