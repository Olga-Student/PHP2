<?php


namespace app\base;


class Session
{
    //статуем сессию
   public function start(){
    session_start();
   }

   // получем сессию с именем и значениями
    public function set($name, $value){
      $_SESSION[$name]=$value;

    }
    // получаем значения массивом
   // public function setArr($arr){
     //  foreach ($arr as $name => $value){
       //    $this->set($name, $value);
      // }
 //   }
    public function get($key, $default){
       return isset($_SESSION[$key])? $_SESSION[$key]: $default;
    }
    //возвращаеем значение ключей
    public function setkey($key)
    {
       return isset($_SESSION[$key]);
    }
    //удаление из сесси значения
    public function remove($key)
    {
        unset($_SESSION[$key]);
    }
    //уничтожаем сессию
    public function destroy()
    {
        session_destroy();
    }


}