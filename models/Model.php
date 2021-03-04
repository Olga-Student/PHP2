<?php


namespace app\models;

use app\services\Db;

abstract class Model implements \ModelInterface
{
    protected $db;
    protected $tablename;

    public function __construct()
    {
        $this->db = new Db();
        $this->tablename = $this->getTableName();
    }

    public function getAll()
    {
        $sql ="SELECT * FROM {$this->tableName}";
        return $this->db->queryAll($sql);
    }


    public function getById($id)
    {
        $sql = "SELECT * FROM {$this->tableName} WHERE id = {$id}";
        return $this->db->queryOne($sql);
    }

    public function delete($id){
        $sql = "DELETE * FROM {$this->tableName} WHERE id = {$id}";
        return $this->db-execute($sql);
    }


}