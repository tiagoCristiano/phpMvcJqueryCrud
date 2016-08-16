<?php

/**
 * Created by PhpStorm.
 * User: tiago
 * Date: 11/08/16
 * Time: 15:22
 */
namespace App\Models;
use App\Models\Table;
use PDO;

class Contato extends Table
{
    protected $table = "contatos";

    public function update($data){


        $query  = " UPDATE `contatos`  SET `nome`  = '{$data->nome}', `sobre_nome` = '{$data->sobre_nome}', `endereco` = '{$data->endereco}' WHERE `id` = {$data->id};";
        $stmt = $this->db->prepare($query);
        $ret = $stmt->execute();
        if($ret){
            echo json_encode("Contato {$data->id} atualizado com sucesso.");
        }else{
            die(json_encode(array("msg"=>"erros")));
        }
    }

    public function create($data){

        $query = "INSERT INTO `contatos`
                    (`nome`,
                    `sobre_nome`,
                    `endereco`)
                    VALUES(
                    :nome,
                    :sobre_nome,
                    :endereco);";

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':nome', $data->nome, PDO::PARAM_STR);
        $stmt->bindParam(':sobre_nome',  $data->sobre_nome, PDO::PARAM_STR);
        $stmt->bindParam(':endereco', $data->endereco, PDO::PARAM_STR);

        try{
            $stmt->execute();
            echo( json_encode($data));
         }catch (\PDOException $e) {
            header("HTTP/1.0 500 Erro ao inserir");
            exit;
        }
    }




}