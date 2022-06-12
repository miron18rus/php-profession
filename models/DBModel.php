<?php

namespace app\models;
use app\engine\Db;

abstract class DBModel extends Model
{

    abstract protected static function getTableName();

    public function insert()
    {

        $params = [];
        $columns = [];

        $tableName = static::getTableName();

        foreach ($this->props as $key => $value) {
                $params += [$key => $this->$key];
                $columns[] = $key;
        }

        $columns = implode(',', $columns);
        $value = implode(',:', array_keys($params));
        $sql = "INSERT INTO {$tableName} ({$columns}) VALUES (:{$value})";

        Db::getInstance()->queryInsert($sql, $params);
        $this->id = Db::getInstance()->getlastInsertId();

        return $this;
    }

    public function delete()
    {
        $tableName = static::getTableName();
        $sql = "DELETE FROM {$tableName} WHERE id = :id";
        return Db::getInstance()->queryInsert($sql, ['id' => $this->id]);
    }

    public function update() 
    {
        $params = [];
        $columns = [];
        $tableName = static::getTableName();

        foreach ($this->props as $key => $value) {
                if(!$value) continue;
                $params += [$key => $this->$key];
                $columns[] .= "`{$key}` = :{$key}";
                $this->props[$key] = false;
        }
        $columns = implode(",", $columns);
        $params['id'] = $this->id;

        $sql = "UPDATE {$tableName} SET {$columns} WHERE `id` = :id";
        Db::getInstance()->queryInsert($sql, $params);
        return $this;
    }

    public function save() 
    {

        if (is_null($this->id)) {
            return $this->insert();
        } else {
            return $this->update();
        }
    }

    public static function getOneWhere($name, $value)
    {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE `{$name}` = :value";
        return  Db::getInstance()->queryOneObject($sql, ['value' => $value], static::class);
    }

    public static function getCountWhere($name, $value)
    {
        $tableName = static::getTableName();
        $sql = "SELECT count(id) as count FROM {$tableName} WHERE `{$name}` = :value";
        return  Db::getInstance()->queryOne($sql, ['value' => $value])['count'];
    }

    public static function getOne($id)
    {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id = :id";
        return  Db::getInstance()->queryOneObject($sql, ['id' => $id], get_called_class());
    }

    public static function getAll()
    {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName}";
        return  Db::getInstance()->queryAll($sql);
    }
}