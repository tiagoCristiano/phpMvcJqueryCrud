<?php
/**
 * Created by PhpStorm.
 * User: tiago
 * Date: 11/08/16
 * Time: 17:25
 */

namespace App\Models;
use PDO;


abstract class Table
{
    protected $db;
    protected $table;

    public function __construct(\PDO $db)
    {
        $this->db = $db;
    }

    public function fetchAll()
    {
        $query = "SELECT * FROM {$this->table}";
        $stmt =   $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findById($id)
    {
        $query = "SELECT * FROM {$this->table} WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function delete($id)
    {
        $query = "DELETE FROM {$this->table} WHERE id =:idDelete";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':idDelete', $id, PDO::PARAM_INT);
        try{
            $stmt->execute();
            return true;
        }catch (\PDOException $e) {
            die($e->getMessage());
        }
    }
}