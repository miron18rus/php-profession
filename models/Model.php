<?php

namespace app\models;

use app\interfaces\IModel;

use app\engine\Db;

abstract class Model
{
    public function __set($name, $value)
    {
        $this->$name = $value;
    }

    public function __get($name)
    {
        return $this->$name;
    }

    abstract public function getTableName();


    public function insert()
    {
        $params = [];
        $tableName = $this->getTableName();
        foreach ($this as $key => $value) {
            if ($key != 'id') {
                $params += [$key => $value];
            }
        }
        $request = implode(',', array_keys($params));
        $request2 = implode(',:', array_keys($params));
        $sql = "INSERT INTO $tableName ({$request}) VALUES (:{$request2})";
        Db::getInstance()->queryInsert($sql, $params);
        $this->id = Db::getInstance()->getlastInsertId();
    }

    public function delete()
    {
        foreach ($this as $key => $value) {
            if ($key == 'id') {
                $tableName = $this->getTableName();
                $sql = "DELETE FROM $tableName WHERE $key = :$key";
                return Db::getInstance()->queryInsert($sql, [$key => $value]);
            }
        }
    }

    public function getOne($id)
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id = :id";
        return  Db::getInstance()->queryOne($sql, ['id' => $id]);
    }

    public function getAll()
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName}";
        return  Db::getInstance()->queryAll($sql);
    }
}
