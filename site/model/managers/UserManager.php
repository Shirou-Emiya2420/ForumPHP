<?php
namespace Model\Managers;

use App\Manager;
use App\DAO;

class UserManager extends Manager{

    // on indique la classe POO et la table correspondante en BDD pour le manager concerné
    protected $className = "Model\Entities\User";
    protected $tableName = "utilisateur";

    public function __construct(){
        parent::connect();
    }

    public function findUserByPseudo($pseudo) {
        $sql = "SELECT u.id_utilisateur, u.nickName, u.password, u.date_inscription, r.nom_role FROM " . $this->tableName . " u 
        INNER JOIN utilisateur_role ur ON ur.id_utilisateur = u.id_utilisateur
        INNER JOIN role r ON r.id_role = ur.id_role
        WHERE nickName = :pseudo";

        // Retourne uniquement le mot de passe
        $result = DAO::select($sql, ['pseudo' => $pseudo], false);
        
        return $result ? $result : null; // Retourne null si rien trouvé
    }

}