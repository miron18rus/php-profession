<?php 

namespace app\engine;

use app\interfaces\iRenderer;

class TwigRender implements iRenderer
{

    protected $twig;

    public function __construct()
    {
        $loader = new \Twig\Loader\FilesystemLoader('../templates');
        $this->twig = new \Twig\Environment($loader);
 
    }


    public function renderTemplate($template, $params = [])
    {
        return $this->twig->render($template . '.twig', $params);
    }
}