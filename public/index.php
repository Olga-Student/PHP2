
<?php

require "../config/main.php";
require "../services/Autoloader.php";

spl_autoload_register([new \app\services\Autoloader(), 'autoload']);



$product = new \app\models\Product();
//var_dump($product->getById(16));
$product->title = 'Кухонка Маша';
$product->description = 'Мебель детская игровая';
$product->price = '10000';
$product->insert();