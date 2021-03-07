<?php

namespace app\traits;

trait SingletonTrait
{
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

}