<?php
/**
 * Created by PhpStorm.
 * User: tiago
 * Date: 10/08/16
 * Time: 19:29
 */

namespace App\Controllers;

use Tiago\Controller\Action;
use Tiago\DI\Container;

class IndexController extends Action
{

    protected $view;
    private $contatoDao;

    public function __construct()
    {
        $this->contatoDao = Container::getModel("Contato");
    }


    public function index()
    {
        $this->render("index");
    }

    public function get()
    {
        $dados = $this->contatoDao->fetchAll();
        echo json_encode($dados);
    }

    public function create()
    {
        return ($this->contatoDao->create((object)$_POST));
    }

    public function update()
    {
        return ($this->contatoDao->update((object)$_POST));
    }

    public function delete(){

        $deleteId = $_POST["delete_id"];

        if($deleteId){
            return $this->contatoDao->delete($deleteId);
        }else{
            die( json_encode(array("msg" => "Informe o id para delete")) );
        }

    }

    public function sobre()
    {
        $this->render("sobre");
    }


}