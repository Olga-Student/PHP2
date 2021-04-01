<?php

namespace app\base;

use app\exceptions\ActionNotFoundException;
/**
 * Класс, хранящий данные о запроск
 * Class Request
 * @package app\base
 *
 * @property $requestString исходная строка запроса из УРЛ
 * @property $controllerName имя контроллера, полученное из запроса
 * @property $actionName имя экшена, полученное из запроса
 * @property $isPost флаг, отправлен ли запрос методом POST
 * @property $isGet флаг, отправлен ли запрос методом GET
 * @property $isAjax флаг, отправлен ли запрос по технологии AJAX
 * @property $pattern регулярное выражение, обеспечивающее поиск по requestString
 */
class Request
{
    protected $requestString = '';
    protected $controllerName = null;
    protected $actionName = null;
    protected $isPost = false;
    protected $isGet = true;
    protected $isAjax = false;


    //controller/action?id=1&test=5(6 и т.д.)
    protected $pattern = "#(?P<controller>\w+)[/]?(?P<action>\w+)?[/]?[?]?(?P<get>.*)#ui";

    /**
     * Request constructor.
     */
    public function __construct()
    {
        $this->requestString = $_SERVER['REQUEST_URI'];
        $this->parseRequestString();
    }

    /**
     * Парсинг данных из строки запроса
     */
    protected function parseRequestString()
    {
        if (preg_match_all($this->pattern, $this->requestString, $matches)) {
            $this->controllerName = $matches['controller'][0];
            $this->actionName = $matches['action'][0];
        } throw new ActionNotFoundException("Обнаружена ошибка для компонента {$matches} !");
    }

    public function getControllerName()
    {
        return $this->controllerName;
    }

    public function getActionName()
    {
        return$this->actionName;
    }

    public function get($name)
    {
        return $_GET[$name];
    }

    public function post( $name)
    {
        return $_POST[$name];
    }

    public function param($name)
    {
        return $_REQUEST[$name];
    }
    public function requestmetod($name){
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == 'POST'){
        return $this->post($name);
        } elseif ($method == 'GET') {return $this->get($name);
        } elseif ($method == 'REQUEST') { return $this->param($name);
        }
    }


}