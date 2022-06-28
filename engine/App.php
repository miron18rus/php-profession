<?php

namespace app\engine;

use app\models\repositories\BasketRepository;
use app\models\repositories\ProductRepository;
use app\models\repositories\UserRepository;
use app\traits\TSingletone;

/**
 * Class App
 * @property Request $request
 * @property BasketRepository $basketRepository
 * @property UserRepository $userRepository
 * @property ProductRepository $productRepository
 * @property Db $db
 */

class App
{
    use TSingletone;

    public $config;
    private $components;

    private $controller;
    private $action;

    public static function call()
    {
        return static::getInstance();
    }

    public function runController()
    {
        $this->controller = $this->request->getControllerName() ?: 'product';
        $actionName = $this->request->getActionName();

        $controllerClass = $this->config['controller_namespaces'] . ucfirst($this->controller) . 'Controller';

        if (class_exists($controllerClass)) {
            $controller = new $controllerClass(new Render());
            $controller->runAction($this->action);
        } else {
            die('404');
        }
    }

    public function run($config)
    {
        $this->config = $config;
        $this->components = new Storage();
        $this->runController();
    }

    public function createComponents($name)
    {
        if (isset($this->config['components'][$name]))
        {
            $params = $this->config['components'][$name];
            $class = $params['class'];
            if (class_exists($class))
            {
                unset($params['class']);
                $reflaction = new \ReflectionClass($class);
                return $reflaction->newInstanceArgs($params);
            }
        }
        die("Компонента {$name} не существуетв конфигурации системы!");
    }

    public function __get($name)
    {
        return $this->components->get($name);
    }
}