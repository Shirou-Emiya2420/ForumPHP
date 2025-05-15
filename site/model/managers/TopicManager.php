<?php
namespace Model\Managers;

use App\Manager;
use App\DAO;

class TopicManager extends Manager{

    // on indique la classe POO et la table correspondante en BDD pour le manager concerné
    protected $className = "Model\Entities\Topic";
    protected $tableName = "topic";

    public function __construct(){
        parent::connect();
    }

    // récupérer tous les topics d'une catégorie spécifique (par son id)
    public function findTopicsByCategory($id) {

        $sql = "SELECT * 
                FROM ".$this->tableName." t 
                WHERE t.category_id = :id";
       
        // la requête renvoie plusieurs enregistrements --> getMultipleResults
        return  $this->getMultipleResults(
            DAO::select($sql, ['id' => $id]), 
            $this->className
        );
    }

    public function toggleClosed($id, $closed) {
        $sql = "UPDATE topic SET is_closed = :closed WHERE id_topic = :id";
        return DAO::update($sql, ["closed" => $closed, "id" => $id]);
    }
    
    public function findTopicsByUser($userId) {
        $sql = "SELECT * FROM topic WHERE user_id = :id ORDER BY creationDate DESC";
        return $this->getMultipleResults(DAO::select($sql, ["id" => $userId]), $this->className);
    }

    public function findTopTopics($limit = 5) {
        $limit = (int) $limit;
    
        $sql = "SELECT t.*, COUNT(p.id_post) AS postCount
                FROM topic t
                LEFT JOIN post p ON t.id_topic = p.topic_id
                WHERE t.isClose = 0
                GROUP BY t.id_topic
                ORDER BY postCount DESC
                LIMIT $limit";
    
        return $this->getMultipleResults(
            DAO::select($sql),
            $this->className
        );
    }
    
    public function setClosed($id, $value) {
        $sql = "UPDATE topic SET isClose = :val WHERE id_topic = :id";
        return DAO::update($sql, ["val" => $value, "id" => $id]);
    }
    
}