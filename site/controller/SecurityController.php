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
    
            if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== \App\Session::getCsrfToken()) {
                http_response_code(403);
                \App\Session::addFlash("error", "Requête invalide (protection CSRF).");
                return $this->redirectTo("security", "register");
            }


            if ($nickName && $password && $passwordConfirm) {
                $regex = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{12,}$/';
                if (!preg_match($regex, $password)) {
                    \App\Session::addFlash("error", "Mot de passe trop faible !");
                    return $this->redirectTo("security", "register");
                }

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
                $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
                $allowedExt = ['png', 'jpg', 'jpeg'];
                $allowedMime = ['image/png', 'image/jpeg'];

                // 🔒 Vérification extension + type MIME réel
                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                $mime = finfo_file($finfo, $file['tmp_name']);
                finfo_close($finfo);

                if (in_array($ext, $allowedExt) && in_array($mime, $allowedMime)) {
                    $filename = "avatar_" . $user->getId();
                    $newPath = "uploads/$filename.$ext";

                    move_uploaded_file($file['tmp_name'], $newPath);

                    $manager = new \Model\Managers\UserManager();
                    $manager->updateAvatar($user->getId(), "$filename.$ext");

                    $user->setPathImg($filename . "." . $ext);
                    \App\Session::addFlash("success", "Image mise à jour !");
                } else {
                    \App\Session::addFlash("error", "Format d'image non autorisé.");
                }
            } else {
                \App\Session::addFlash("error", "Image trop lourde (max 5 Mo).");
            }
        } else {
            \App\Session::addFlash("error", "Erreur lors de l'envoi.");
        }

        return $this->redirectTo("security", "profile");
    }
  




    public function deleteAccount() {
    $user = Session::getUser();
    if (!$user) {
        $this->redirectTo("security", "login");
    }

    $id = $user->getId();
    $manager = new \Model\Managers\UserManager();
    $manager->delete($id);

    Session::unSetUser();
    $this->redirectTo("home", "index");
}


}