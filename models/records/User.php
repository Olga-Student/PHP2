<?php


namespace app\models\records;


class User extends Records
{
  public $id;
  public $login;
  public $email;
  public $password;

    public function getByLogin($login)
  {
      $sql = "SELECT * FROM {$this->tableName} WHERE login = {$login}";
      return $this->db->queryOne($sql);
  }
  public static function getTableName()
  {
      return 'users';
  }
}
