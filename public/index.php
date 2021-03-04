
<?php

require "../services/Autoloader.php";

spl_autoload_register([new \app\services\Autoloader(), 'autoload']);



$product = new \app\models\Product();
var_dump($product);