<?php
namespace Model\Managers;

use App\Manager;
use App\DAO;

class UserManager extends Manager{

    // on indique la classe POO et la table correspondante en BDD pour le manager concerné
    protected $className = "Model\Entities\User";
    protected $tableName = "user";

    public function __construct(){
        parent::connect();
    }

    public function findUserByPseudo($pseudo) {
        $sql = "SELECT u.id_user, u.nickName, u.password, u.registrationDate, u.role FROM " . $this->tableName . " u 
        WHERE nickName = :pseudo";
        // Retourne uniquement le mot de passe
        $result = DAO::select($sql, ['pseudo' => $pseudo], false);
        
        return $result ? $result : null; // Retourne null si rien trouvé
    }

    public function updateAvatar($id, $pathImg) {
        $sql = "UPDATE user SET pathImg = :img WHERE id_user = :id";
        return \App\DAO::update($sql, ['img' => $pathImg, 'id' => $id]);
    }

    
}