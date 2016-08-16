<?php

/**
 * Created by PhpStorm.
 * User: tiago
 * Date: 11/08/16
 * Time: 11:19
 */

namespace Tiago\Init;

abstract class Bootstrap
{
    private $routes;

    public function __construct()
    {
        $this->initRoutes();
        $this->run($this->getUrl());

    }

    abstract protected function initRoutes();

    public function getUrl()
    {
        return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    }

    protected function run($url)
    {

        array_walk($this->routes, function ($route) use ($url){

            if($url == $route['route']) {

                $class = "App\\Controllers\\".ucfirst($route['controller']);

                $controller = new $class;
                $action  = $route["action"];
                $controller->$action();
            }

        });
    }

    protected function setRoutes(array $rotas)
    {
        $this->routes = $rotas;
    }


}