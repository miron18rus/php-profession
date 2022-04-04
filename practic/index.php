<?php

class Db 
{
    protected $tableName;
    protected $wheres = [];

    public function table($tableName) {
        $this->tableName = $tableName;
        return $this;
    }

    public function getAll() {
       $sql = "SELECT * FROM {$this->tableName}";
        return $sql;
    }

    public function getOne($id) {
        return "SELECT * FROM {$this->tableName} WHERE id = {$id} <br>";
        
    }

    public function where($filed, $value) {
        $this->wheres = [
            'field' => $filed,
            'value' => $value,
        ];
        return $this;
    }
}


$db = new Db();

$db->table('goods')->getAll();
$db->table('goods')->getOne('id');
$db->table('goods')->where('login', 'admin')->getAll();
$db->table('goods')->where('login', 'admin')->where('pass', 123)->getAll();