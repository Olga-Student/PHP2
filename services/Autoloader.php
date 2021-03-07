<?php

namespace app\services;

class Autoloader
{
    private $fileExtension = ".php";
    public function autoload($className)
    {
        //echo $className."<br>";
        $className = str_replace(ROOT_NAMESPACE, ROOT_DIR, $className);
        //var_dump($className);exit();
        $fileName = realpath($className . $this->fileExtension);
        //var_dump($fileName);exit();
        //далее проверяем наличие файла
        if (file_exists($fileName)) {
            include $fileName;
            return true;
        }
        return false;
    }
}


