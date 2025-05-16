<?php
namespace Controller;

use App\AbstractController;
use App\ControllerInterface;
use App\Session;
use Model\Entities\User; 

class SecurityController extends AbstractController{
    // contiendra les méthodes liées à l'authentification : register, login et logout



    public function register() {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
            $nickName = filter_input(INPUT_POST, "nickName", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $password = filter_input(INPUT_POST, "password", FILTER_DEFAULT);
            $passwordConfirm = filter_input(INPUT_POST, "passwordConfirm", FILTER_DEFAULT);
    
            if ($nickName && $password && $passwordConfirm) {
                $userManager = new \Model\Managers\UserManager();
    
                // Vérifie si le pseudo existe déjà
                if ($userManager->findUserByPseudo($nickName)) {
                    \App\Session::addFlash("error", "Pseudo \"$nickName\" déjà existant.");
                } else {
                    $userManager->add([
                        "nickName" => $nickName,
                        "password" => password_hash($password, PASSWORD_DEFAULT),
                        "role" => "membre",
                        "registrationDate" => date("Y-m-d H:i:s")
                    ]);
    
                    \App\Session::addFlash("success", "Compte créé avec succès !");
                    return $this->redirectTo("security", "login");
                }
            }
        }
    
        return [
            "view" => VIEW_DIR."security/register.php",
            "meta_description" => "Formulaire d'inscription au Forum"
        ];
    }
    
    public function logout () {
        \App\Session::unSetUser();
        return [
            "view" => VIEW_DIR."security/login.php",
            "meta_description" => "Déconnexion au forum"
        ];
    }

    public function login() {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // Récupère le pseudo et le mot de passe du formulaire
            $pseudo = filter_input(INPUT_POST, "pseudo", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $password = $_POST["password"];


            $userManager = new \Model\Managers\UserManager();
            
            // Récupère uniquement le mot de passe stocké dans la BDD
            $dbUser = $userManager->findUserByPseudo($pseudo);



            var_dump($pseudo);
            var_dump($password); 
            var_dump($dbUser["password"]); 
            var_dump($password === $dbUser["password"]); 
            /* die(); */ /* trinity42 */

            // Vérifie si le mot de passe est correct
            if ($dbUser["password"] && password_verify($password, $dbUser["password"])) {
                Session::setUser(new User($dbUser));  // Ou garde juste l'ID ou le pseudo si tu préfères
                Session::addFlash("success", "Connexion réussie !");
                $this->redirectTo("home");
            } else {
                Session::addFlash("error", "Identifiants incorrects.");
                $this->redirectTo("security", "login");
            }
        }

        return [
            "view" => VIEW_DIR."security/login.php",
            "meta_description" => "Connexion au forum"
        ];
    }

    public function deleteUser($id) {
        $userManager = new \Model\Managers\UserManager();
        $user = $userManager->findOneById($id);

        /* var_dump($user); die(); */
        if (!$user) {
            \App\Session::addFlash("error", "Utilisateur introuvable.");
            return $this->redirectTo("security", "listUsers");
        }

        if (!\App\Session::isAdmin()) {
            \App\Session::addFlash("error", "Accès refusé.");
            return $this->redirectTo("forum", "index");
        }

        if ($user->getId() == \App\Session::getUser()->getId()) {
            \App\Session::addFlash("error", "Vous ne pouvez pas vous supprimer vous-même.");
            return $this->redirectTo("home", "listUsers");
        }
        
        var_dump($userManager->delete($id));/* die("ok"); */
        \App\Session::addFlash("success", "Utilisateur supprimé.");
        /* die("ok"); */
        return $this->redirectTo("home", "listUsers");
    }

    public function profile(){
        
        if (Session::getUser()){
            return [
                "view" => VIEW_DIR."security/profile.php",
                "meta_description" => "Déconnexion au forum"
            ];
        }else{
            return [
                "view" => VIEW_DIR."security/login.php",
                "meta_description" => "Déconnexion au forum"
            ];
        }
    }

    public function uploadAvatar() {
    $user = \App\Session::getUser();
    if (!$user) return $this->redirectTo("security", "login");

    if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
        $file = $_FILES['avatar'];
        $maxSize = 5 * 1024 * 1024; // 5 Mo

        if ($file['size'] <= $maxSize) {
            $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
            $allowed = ['png', 'jpg', 'jpeg'];

            if (in_array(strtolower($ext), $allowed)) {
                $filename = "avatar_" . $user->getId();
                $newPath = "uploads/$filename.$ext";

                move_uploaded_file($file['tmp_name'], $newPath);

                // mettre à jour la BDD
                $manager = new \Model\Managers\UserManager();
                $manager->updateAvatar($user->getId(), "$filename.$ext");

                // mettre à jour l'objet en session
                $user->setPathImg($filename . "." . $ext);
                \App\Session::addFlash("success", "Image mise à jour !");
            } else {
                \App\Session::addFlash("error", "Format non autorisé.");
            }
        } else {
            \App\Session::addFlash("error", "Image trop lourde (max 2 Mo).");
        }
    } else {
        \App\Session::addFlash("error", "Erreur lors de l'envoi.");
    }

    return $this->redirectTo("security", "profile");
    }   

}