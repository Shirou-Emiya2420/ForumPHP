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
    public function findMessagesByTopic($id, $order = "ASC") {
        $sql = "SELECT * 
                FROM ".$this->tableName." m
                WHERE m.topic_id = :id
                ORDER BY m.creationDate $order";

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
    
    public function hasUserLiked(int $postId, int $userId): bool {
        $sql = "SELECT 1 FROM likes WHERE post_id = :post AND user_id = :user";
        $result = DAO::select($sql, ['post' => $postId, 'user' => $userId], false);
        return !empty($result);
    }

    public function getLikeCount(int $postId): int {
        $sql = "SELECT COUNT(*) as count FROM likes WHERE post_id = :post";
        $result = DAO::select($sql, ['post' => $postId], true); /* die(); */
        /* var_dump($result); *//* die(); */
        return isset($result[0]['count']) ? intval($result[0]['count']) : 0;
    }

    public function toggleLike(int $postId, int $userId): void {
        if ($this->hasUserLiked($postId, $userId)) {
            $sql = "DELETE FROM likes WHERE post_id = :post AND user_id = :user";
            DAO::delete($sql, ['post' => $postId, 'user' => $userId]);
        } else {
            $sql = "INSERT INTO likes (post_id, user_id) VALUES (:post, :user)";
            var_dump(DAO::update($sql, ['post' => $postId, 'user' => $userId])); /* die(); */
        }
    }



}
