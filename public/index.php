
<?php

require "../config/main.php";
require "../services/Autoloader.php";


spl_autoload_register([new \app\services\Autoloader(), 'autoload']);

session_start();


//$product = new \app\models\Product();
//var_dump($product->getById(12));
//$product->title = 'Кухонка Маша';
//$product->description = 'Мебель детская игровая';
//$product->price = '10000';
//$product->insert();

//$product = \app\records\models\Product::getById(1);
//var_dump($product);
if(!$requestUri = preg_replace(['#^/#','#[?].*#','#/$#'],"",  $_SERVER['REQUEST_URI'])){
    $requestUri = DEFAULT_CONTROLLER;
}

$parts = explode("/", $requestUri);
$controllerName = $parts[0];
$action = $parts[1];

$controllerClass = "app\controllers\\" . ucfirst($controllerName) . "Controller";

if(class_exists($controllerClass)){
    $controller = new $controllerClass();
    $controller->run($action);
}

