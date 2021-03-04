<?php
namespace app\services;
class Autoloader
{
    function autoload($className)
    {
        $className = str_replace('app\\', __DIR__."/../", $className);
        //var_dump($className);exit();
       include realpath($className . ".php");


    }
}


