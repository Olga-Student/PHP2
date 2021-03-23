<?php

namespace app\models\records;

use app\interfaces\RecordInterface;
use app\services\Db;

abstract class Records implements RecordInterface
{
    protected $db;
    protected $tableName;
    protected $excludedProperties = ['db', 'tableName'];
    public function __construct()
    {
        $this->db = Db::getInstance();
        $this->tableName = $this->getTableName();
    }

    public static function getAll(array $ids = [])
    {
        $tableName = static::getTableName();
        $where = '';

        if(!empty($ids)) {
            $placeholders = str_repeat('?,', count($ids) - 1) . '?';
            $where = " WHERE id IN ({$placeholders})";
        }

        $sql = "SELECT * FROM {$tableName}" . $where;
        return static::getQuery($sql, $ids);
    }



    public static function getById($id)
    {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id = :id";
        return static::getQuery($sql, [':id' => $id])[0];
    }

    public function delete(){
        $sql = "DELETE FROM {$this->tableName} WHERE id = :id";
        return $this->db->execute($sql, [':id' => $this->id]);
    }
    public function insert(){
        $tableName = static::getTableName();
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
        $sql = "INSERT INTO {$tableName} ({$columns}) VALUES ({$placeholders})";
        $this->db->execute($sql, $params);
        $this->id = $this->db->getLastInsertId();

    }

    public function apDate()
    {
        $tableName = static::getTableName();
        $params = [];
        $setSection = [];

        foreach ($this as $key => $value) {
            if(in_array($key, $this->excludedProperties)) {
                continue;
            }

            $params[":{$key}"] = $value;
            $setSection[] = "`{$key}` = :{$key}";
        }

        $setSection = implode(", ", $setSection);

        $sql = "UPDATE {$tableName} SET {$setSection}";
        $this->db->execute($sql, $params);
    }
    public function save()
    {
        if(is_null($this->id)){
            $this->insert();
        }else{
            $this->apDate();
        }
    }

    protected static function getQuery($sql, $params =[]){
        return Db::getInstance()->queryAll($sql, $params, get_called_class());
    }


}