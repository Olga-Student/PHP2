<?php

namespace app\services;


use app\traits\SingletonTrait;

class Db
{
    use SingletonTrait;

    private $config = [
        'driver' => 'mysql',
        'host' => '127.0.0.1',
        'login' => 'root',
        'password' => 'root',
        'dbName' => 'main_db',
        'charset' => 'utf8',
    ];

    protected $connection = null;

    private static $instance = null;//создали статическую сво-во - единственный экземпляр класса;
    //получаем это свойство где static(self) (внутри функции) == Db
    public static function getInstance(){
        if(is_null(static::$instance)){
            static::$instance = new static();
        }
        return static::$instance;
    }

    private function __construct() {}
    private function __clone() {}
    private function __wakeup() {}

    public function getConnection(){
        if(is_null($this->connection)) {
            $this->connection = new \PDO(
                $this->buildDsnString(),
                $this->config['login'],
                $this->config['password']
            );

            $this->connection->setAttribute(
                \PDO::ATTR_DEFAULT_FETCH_MODE,
                \PDO::FETCH_ASSOC
            );
        }
        //var_dump($this->connection);
        return $this->connection;
    }
    public function buildDsnString(){
        return sprintf(
            '%s:dbname=%s;host=%s;charset=%s',
            $this->config['driver'],
            $this->config['dbName'],
            $this->config['host'],
            $this->config['charset']
        );
    }
    /**
     * @param string $sql SELECT * FROM products WHERE id = :id//плейсхолдер(шаблон)
     * @param array $params [':id' => 2]
     */

    private function query( $sql, array $params = [])
    {
        $pdoStatement = $this->getConnection()->prepare($sql);
        $pdoStatement->execute($params);
        return $pdoStatement;
    }

    public function queryOne( $sql, array $params = [])
    {
        return $this->queryAll($sql, $params)[0];
    }

    public function queryAll( $sql, array $params = [], $className = null)
    {
        $pdoStatement = $this->query($sql, $params);
        if (isset($className)){
            $pdoStatement->setFetchMode(\PDO::FETCH_CLASS, $className);
        }
           return $pdoStatement->fetchAll();
    }

    public function execute( $sql, array $params = [])
    {
        return $this->query($sql, $params)->rowCount();
    }
    public function getLastInsertId()
    {
        return $this->getConnection()->LastInsertId();
    }

}