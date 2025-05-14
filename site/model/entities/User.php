<?php
namespace Model\Entities;

use App\Entity;

final class User extends Entity {

    private $id_utilisateur;
    private $nickName;
    private $password;
    private $date_inscription;
    private $roles = [];

    public function __construct($data) {
        $this->hydrate($data);
    }

    public function getId_utilisateur() {
        return $this->id_utilisateur;
    }

    public function setId_utilisateur($id) {
        $this->id_utilisateur = $id;
        return $this;
    }

    public function getNickName() {
        return $this->nickName;
    }

    public function setNickName($nickName) {
        $this->nickName = $nickName;
        return $this;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
        return $this;
    }

    public function getDate_inscription() {
        return $this->date_inscription;
    }

    public function setDate_inscription($date) {
        $this->date_inscription = $date;
        return $this;
    }

    public function __toString() {
        return $this->nickName;
    }
    
    public function hasRole($role) {
        /* var_dump($role); die(); */
        return in_array($role, $this->roles);
    }

}
