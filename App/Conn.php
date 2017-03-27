<?php

namespace App;


class Conn
{

    public static function getDb()
    {

        try{
            return new \PDO("mysql:host=localhost;dbname=madeira_madeira", "root", "");

        }catch (\PDOException $e){
            die($e->getMessage());
        }
    }


}