<?php

namespace app\models;
use app\engine\Db;

abstract class DBModel extends Model
{

    abstract protected static function getTableName();

    public function insert()
    {
        $params = [];
        $tableName = static::getTableName();
        foreach ($this as $key => $value) {
            if ($key != 'id') {
                $params += [$key => $value];
            }
        }
        $request = implode(',', array_keys($params));
        $request2 = implode(',:', array_keys($params));
        $sql = "INSERT INTO {$tableName} ({$request}) VALUES (:{$request2})";
        Db::getInstance()->queryInsert($sql, $params);
        $this->id = Db::getInstance()->getlastInsertId();

        return $this;
    }

    public function delete()
    {
        $tableName = static::getTableName();
        var_dump($tableName);
        $sql = "DELETE FROM {$tableName} WHERE id = :id";
        return Db::getInstance()->queryInsert($sql, ['id' => $this->id]);
    }

    public static function getOne($id)
    {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id = :id";
        return  Db::getInstance()->queryOne($sql, ['id' => $id]);
    }

    public static function getAll()
    {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName}";
        return  Db::getInstance()->queryAll($sql);
    }
}