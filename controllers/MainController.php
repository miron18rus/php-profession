<?php

namespace app\controllers;

use app\interfaces\IRenderer;
use app\models\Users;
use app\models\Basket;

class MainController
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
                    'isAuth' => Users::isAuth(),
                    'username' => Users::getName(),
                    'count' => Basket::getCountWhere('session_id', session_id()),
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