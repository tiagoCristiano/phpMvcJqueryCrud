<?php
/**
 * Created by PhpStorm.
 * User: tiago
 * Date: 10/08/16
 * Time: 18:06
 */

namespace App\Controllers;


use Tiago\Init\Bootstrap;

class Route extends Bootstrap
{

    protected function initRoutes()
    {

        $routes['home'] = array(
            'route' => '/',
            'controller' => 'indexController',
            'action' => 'index'
        );

        $routes['contact'] = array(
            'route'      => '/contact',
            'controller' => 'indexController',
            'action'     => 'contac'
        );

        $routes['sobre'] = array(
            'route'      => '/sobre',
            'controller' => 'indexController',
            'action'     => 'sobre'
        );

        $routes['delete'] = array(
            'route'      => '/contact/delete',
            'controller' => 'indexController',
            'action'     => 'delete'
        );

        $routes['createContact'] = array(
            'route'      => '/contact/create',
            'controller' => 'indexController',
            'action'     => 'create'
        );

        $routes['getContact'] = array(
            'route'      => '/contact/get',
            'controller' => 'indexController',
            'action'     => 'get'
        );

        $routes['update'] = array(
            'route'      => '/contact/update',
            'controller' => 'indexController',
            'action'     => 'update'
        );
        $this->setRoutes($routes);

    }

}