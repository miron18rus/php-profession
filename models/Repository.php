<?php

namespace app\models;
use app\engine\App;

abstract class Repository
{

    abstract protected function getTableName();
    abstract protected function getEntityClass();

    public function insert(Entity $entity)
    {

        $params = [];
        $columns = [];

        $tableName = $this->getTableName();

        foreach ($entity->props as $key => $value) {
                $params += [$key => $entity->$key];
                $columns[] = $key;
        }

        $columns = implode(',', $columns);
        $value = implode(',:', array_keys($params));
        $sql = "INSERT INTO {$tableName} ({$columns}) VALUES (:{$value})";

        App::call()->db->queryInsert($sql, $params);
        $entity->id = App::call()->db->getlastInsertId();

        return $this;
    }

    public function delete(Entity $entity)
    {
        $tableName = $this->getTableName();
        $sql = "DELETE FROM {$tableName} WHERE `id` = :id";
        return App::call()->db->queryInsert($sql, ['id' => $entity->id]);
    }

    public function update(Entity $entity) 
    {
        $params = [];
        $columns = [];

        foreach ($entity->props as $key => $value) {
                if(!$value) continue;
                $params += [$key => $entity->$key];
                $columns[] .= "`{$key}` = :{$key}";
                $entity->props[$key] = false;
        }
        $columns = implode(",", $columns);
        $params['id'] = $entity->id;
        $tableName = $this->getTableName();

        $sql = "UPDATE {$tableName} SET {$columns} WHERE `id` = :id";
        App::call()->db->queryInsert($sql, $params);
        return $this;
    }

    public function save(Entity $entity) 
    {

        if (is_null($entity->id)) {
            return $this->insert($entity);
        } else {
            return $this->update($entity);
        }
    }

    public function getOneWhere($name, $value)
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE `{$name}` = :value";
        return  App::call()->db->queryOneObject($sql, ['value' => $value], $this->getEntityClass());
    }

    public function getCountWhere($name, $value)
    {
        $tableName = $this->getTableName();
        $sql = "SELECT count(id) as count FROM {$tableName} WHERE `{$name}` = :value";
        return  App::call()->db->queryOne($sql, ['value' => $value])['count'];
    }

    public function getOne($id)
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE `id` = :id";
        return  App::call()->db->queryOneObject($sql, ['id' => $id], $this->getEntityClass());
    }

    public function getAll()
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName}";
        return  App::call()->db->queryAll($sql);
    }
}