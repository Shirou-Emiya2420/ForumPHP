<?php
namespace App;

class Session{

    private static $categories = ['error', 'success'];

    /**
    *   ajoute un message en session, dans la catégorie $categ
    */
    public static function addFlash($categ, $msg){
        $_SESSION[$categ] = $msg;
    }

    /**
    *   renvoie un message de la catégorie $categ, s'il y en a !
    */
    public static function getFlash($categ){
        
        if(isset($_SESSION[$categ])){
            $msg = $_SESSION[$categ];  
            unset($_SESSION[$categ]);
        }
        else $msg = "";
        
        return $msg;
    }

    /**
    *   met un user dans la session (pour le maintenir connecté)
    */
    public static function unSetUser(){
        if(isset($_SESSION["user"])){
            unset($_SESSION["user"]);
        }
    }

    public static function setUser($user){
        $_SESSION["user"] = $user;
    }

    public static function getUser(){
        return (isset($_SESSION['user'])) ? $_SESSION['user'] : false;
    }

    public static function isAdmin(){
        // attention de bien définir la méthode "hasRole" dans l'entité User en fonction de la façon dont sont gérés les rôles en base de données
/*         var_dump(self::getUser()); var_dump(self::getUser()->hasRole("admin")); die(); */
        if(self::getUser() && self::getUser()->hasRole("admin")){
            return true;
        }
        return false;
    }

    public static function getCsrfToken() {
        if (!isset($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }

}