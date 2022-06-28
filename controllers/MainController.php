<?php

namespace app\controllers;

use app\engine\App;
use app\interfaces\IRenderer;
use app\models\repositories\UserRepository;
use app\models\repositories\BasketRepository;

abstract class MainController
{

    private $action;
    private $defaultAction = 'index';
    private $layout = 'main';
    private $useLayout = true;

    protected $render;

    public function __construct(IRenderer $render)
    {
        $this->render = $render;
        
    }

    public function runAction($action) 
    {
        $this->action = $action ?? $this->defaultAction;
        $method = 'action' . ucfirst($this->action);
        if (method_exists($this, $method)) {
            $this->$method();
        }      
    }

    public function render($template, $params = []) 
    {
        if ($this->useLayout) {
            return $this->renderTemplate('layouts/' . $this->layout, [
                'menu' => $this->renderTemplate('menu', [
                    'isAuth' => App::call()->userRepository->isAuth(),
                    'username' => App::call()->userRepository->getName(),
                    'count' => App::call()->basketRepository->getCountWhere('session_id', session_id()),
                ]),
                'content' => $this->renderTemplate($template, $params),
            ]);
        } else {
            return $this->render->renderTemplate($template, $params);
        }
    }

    public function renderTemplate($template, $params = []) 
    {
        return $this->render->renderTemplate($template, $params);
    }
}