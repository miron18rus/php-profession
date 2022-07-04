<?php

namespace app\engine;


class Db
{

    protected $config;


    private $connection = null; //PDO


    public function __construct($driver = null, $host = null, $login = null, $password = null, $database = null, $charset = "utf8")
    {
        $this->config['driver'] = $driver;
        $this->config['host'] = $host;
        $this->config['login'] = $login;
        $this->config['password'] = $password;
        $this->config['database'] = $database;
        $this->config['charset'] = $charset;
    }


    private function getConnection()
    {
        if (is_null($this->connection)) {
            $this->connection = new \PDO($this->prepareDsnString(),
                $this->config['login'],
                $this->config['password']);
            $this->connection->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
        }
        return $this->connection;
    }

    public function lastInsertId()
    {
        return $this->getConnection()->lastInsertId();
    }

    private function prepareDsnString()
    {
        return sprintf("%s:host=%s;dbname=%s;charset=%s",
            $this->config['driver'],
            $this->config['host'],
            $this->config['database'],
            $this->config['charset']
        );
    }


    //SELECT * FROM products WHERE id = :id'
    //params = ['id' => 1, 'login'=>'admin']
    private function query($sql, $params)
    {
        $STH = $this->getConnection()->prepare($sql);
        //происходит bind по массиву $params
        //он все данные обрамляет '2' кавычками, а для LIMIT запросов они не нужны, поэтому надо bind вручную.
        $STH->execute($params);
        return $STH;
    }

    public function queryLimit($sql, $limit)
    {
        $STH = $this->getConnection()->prepare($sql);
        $STH->bindValue(1, $limit, \PDO::PARAM_INT);
        $STH->execute();
        return $STH; //TODO сделайте вывод не с 0 до 4, а с 2-4
    }

    //WHERE id = 1
    public function queryOne($sql, $params = [])
    {
        return $this->query($sql, $params)->fetch();

    }

    public function queryOneObject($sql, $params, $class)
    {

            $STH = $this->query($sql, $params);

            $STH->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, $class); //$classs = app\models\Product

            $obj = $STH->fetch();

            if (!$obj) {
                throw new \Exception("Объект не найден", 404);
            }


        return $obj;

    }

    //SELECT all
    public function queryAll($sql, $params = [])
    {
        return $this->query($sql, $params)->fetchAll();
    }

    public function execute($sql, $params = [])
    {
        return $this->query($sql, $params)->rowCount();
    }

}