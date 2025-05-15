<?php
namespace Model\Entities;

use App\Entity;

final class User extends Entity {

    private $id;
    private $nickName;
    private $password;
    private $registrationDate;
    private $role;

    public function __construct($data) {
        $this->hydrate($data);
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
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

    public function getRegistrationDate() {
        return $this->registrationDate;
    }
    
    public function setRegistrationDate($date) {
        $this->registrationDate = $date;
        return $this;
    }

    public function setRole($role) {
        $this->role = $role;
        return $this;
    }
    public function getRole() {
        return $this->role;
    }
    
    

    public function __toString() {
        return $this->nickName;
    }
    
    public function hasRole($role) {
/*     var_dump("admin"); var_dump($role == "admin"); var_dump($role); die(); */
        return $role === $this->role;
    }

}
