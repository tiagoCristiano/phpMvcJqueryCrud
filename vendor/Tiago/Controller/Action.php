<?php

namespace Tiago\Controller;
/**
 * Created by PhpStorm.
 * User: tiago
 * Date: 11/08/16
 * Time: 14:58
 */
abstract class Action
{
    protected $view;

    private $action;

    public function __construct()
    {
        $this->view = new \stdClass;
    }

    public function render($action, $layouyt = true)
    {
        $this->action = $action;

        if($layouyt && file_exists("../App/Views/layout.phtml")){
            include_once ("../App/Views/layout.phtml");
            return;
        }

        $this->content();

    }

    protected function content()
    {
        $current     = get_class($this);
        $singleClass = strtolower((str_replace("Controller","",str_replace("App\\Controllers\\", "", $current))));
        include_once "../App/Views/".$singleClass."/".$this->action.".phtml";
    }




}