<?php


namespace app\controllers;

use app\exceptions\ActionNotFoundException;
use app\interfaces\RendererInterface;
use app\models\records\Menu;
use app\models\Auth;



/**
 * Class Controller
 * @package app\controllers
 * @property string $action название текущего исполняемого экшена
 * @property string $defaultAction название экшена, который будет исполнятся по дефолту
 * @property bool $useLayout флаг, будет ли испольховаться лэйаут при рендеоинге
 * @property string $defaultLayout название шаблона лэйаута, используемого по умолчанию
 * @property RendererInterface|null $renderer объект, занимающийся натягиванием данных на шаблон
 * @property Auth $auth объект, содержащий логику авторизации пользователя
 */

abstract class Controller
{
    protected $action = null;
    protected $defaultAction = 'index';
    protected $useLayout = true;
    protected $defaultLayout = 'main';
    protected $renderer = null;

    /** @var Auth  */
    protected $auth;

    /**
     * Controller constructor.
     * @param RendererInterface $renderer
     */
    public function __construct(RendererInterface $renderer)
    {
        $this->renderer = $renderer;
        $this->auth = new Auth();
    }
    /** Запуск экшена контроллера
     * @param null|string $action название экшена
     */
    public function run($action = null)
    {
        $this->action = $action ?: $this->defaultAction;
        $method = 'action' . ucfirst($this->action);
        if (method_exists($this, $method)) {
            $this->$method();
        } else {
           // echo 404;
            //throw new Exception();
            throw new ActionNotFoundException("Указанный action не найден!");
        }
    }

    function render($template, array $params = [])
    {
        $content = $this->renderer->render($template, $params);
        if ($this->useLayout) {
            return $this->renderer->render('layouts/' . $this->defaultLayout, ['content' => $content]);
        }
        return $content;
    }

    public function redirect($url)
    {
        header("Location: {$url}");
        exit();
    }

    public function redirectToReferer()
    {
        $this->redirect($_SERVER['HTTP_REFERER']);
    }

}