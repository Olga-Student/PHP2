<?php


namespace app\models;


class User extends Model
{
  public $full_name;
  public $email;

    public function getByLogin($login)
  {
      $sql = "SELECT * FROM {$this->tablename} WHERE login = {$login}";
      return $this->db->queryOne($sql);
  }
  public function getTableName()
  {
      return 'users';
  }
}
