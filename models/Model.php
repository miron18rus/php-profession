<?php

namespace app\models;

use app\engine\Db;

abstract class Model
{
    protected $db;

    protected $tableName = '';

    public function __construct(Db $db)
    {
        $this->db = $db;
    }



    abstract public function getTableName();

    public function getOne($id)
    {
        $this->tableName = $this->getTableName();
        $sql = "SELECT * FROM {$this->tableName}.'<br>' WHERE id = {$id}";
        return  $this->db->queryOne($sql);
    }

    public function getAll()
    {
        $this->tableName = $this->getTableName();
        $sql = "SELECT * FROM {$this->tableName}.'<br>'";
        return  $this->db->queryAll($sql);
    }
}
