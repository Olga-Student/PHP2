<?php


namespace app\controllers;


class Controller
{
    protected $action = null;  //текущий конроллер ссылок
    protected $defaultAction = 'index';
    protected $useLayout = true;
    protected $defaultLayout = 'main';
    protected $renderer = null;

    public function run($action = null)
    {
        $this->action = $action ?: $this->defaultAction;
        $method = 'action' . ucfirst($this->action);
        if(method_exists($this, $method)){   //проверяет есть ли такой метод
            $this->$method();
        }else{
            echo "404";
        }
    }
    function renderTemplate($templateName, array $params = [])
    {
        extract($params);
        ob_start();
        include VIEWS_DIR . $templateName . ".php";
        return ob_get_clean();
    }

    function render ($template, array $params = []) {
        $content = $this->renderTemplate($template, $params);
        if($this->useLayout) {
            return $this->renderTemplate('layouts/' . $this->defaultLayout, ['content' => $content]);
        }
        return $content;
    }

   public function redirect($url){
       header('Location: {$url}');
       exit();
   }


    public function redirectToReferer(){
        $this->redirect($_SERVER['HTTP_REFERER']);
    }
}