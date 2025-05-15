<?php
namespace Model\Managers;

use App\Manager;
use App\DAO;

class PostManager extends Manager {

    protected $className = "Model\Entities\Post";
    protected $tableName = "post";

    public function __construct(){
        parent::connect();
    }

    // Récupérer tous les messages liés à un topic donné
    public function findMessagesByTopic($id) {
        $sql = "SELECT * 
                FROM ".$this->tableName." m
                WHERE m.topic_id = :id
                ORDER BY m.creationDate ASC";
    
        return $this->getMultipleResults(
            DAO::select($sql, ['id' => $id]),
            $this->className
        );
    }

    public function findPostsByUser($userId) {
        $sql = "SELECT * 
                FROM " . $this->tableName . " p 
                WHERE p.user_id = :id 
                ORDER BY p.creationDate DESC";
    
        return $this->getMultipleResults(
            \App\DAO::select($sql, ["id" => $userId]),
            $this->className
        );
    }
    
    
}
