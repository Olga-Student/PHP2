<?php

namespace app\models;

use app\interfaces\ModelInterface;
use app\services\Db;

abstract class Model implements ModelInterface
{
    protected $db;
    protected $tablename;

    public function __construct()
    {
        $this->db = Db::getInstance();
        $this->tablename = $this->getTableName();
    }

    public function getAll()
    {
        $sql ="SELECT * FROM {$this->tablename}";
        return $this->getQuery($sql);
    }


    public function getById($id)
    {
        $sql = "SELECT * FROM {$this->tablename} WHERE id = :id";
        return $this->getQuery($sql, [':id' => $id])[0];
    }

    public function delete(){
        $sql = "DELETE FROM {$this->tablename} WHERE id = :id";
        return $this->db->execute($sql, [':id' => $this->id]);
    }
    public function insert(){
        $tableName = $this->getTableName();
        $params = [];
        $columns = [];

        foreach ($this as $key => $value) {
            if (in_array($key, ['db', 'tableName'])) {
                continue;
            }
            $params[":{$key}"] = $value;
            $columns[] = "`{$key}`";
        }
        $columns = implode(", ", $columns);
        $placeholders = implode(", ", array_keys($params));
        //$sql = "INSERT INTO {$this->tablename} ( title, link, views, description, price)
        //               VALUES (:title, '', '', :description, :price)";
        //return  $this->db->execute($sql, ['title' => $this->title, 'link' => '', 'views' => '',
            //'description' => $this->description, 'price' => $this->price]);

        $sql = "INSERT INTO {$tableName} ({$columns}) VALUES ({$placeholders})";
        $this->db->execute($sql, $params);
        $this->id = $this->db->getLastInsertId();

    }

    public function apDate()
    {
        $tableName = $this->getTableName();
        $params = [];
        $id;
        $title = null;
        $description = null;
        $price = null;

            if (!is_null($title)) {
                $params[] = "title = :$title";
            }

            if (!is_null($description)) {
                $params[] = "description = :$description";
            }

            if (!is_null($price)) {
                $params[] = "price = :$price";
            }

            if (!empty($params)) {
                $params = implode(", ", $params);
                $sql = "UPDATE {$tableName} SET title = :$title, price = :$price,
                description = :$description WHERE id = :$id";
                return $this->db->execute($sql, [':id' => $this->id]);

            }
    }

    protected function getQuery($sql, $params =[]){
        return $this->db->queryAll($sql, $params, get_called_class());
    }

}