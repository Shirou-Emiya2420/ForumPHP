<?php
namespace Controller;

use App\AbstractController;
use App\ControllerInterface;

use Model\Entities\User; 

class SecurityController extends AbstractController{
    // contiendra les méthodes liées à l'authentification : register, login et logout

    public function register () {

    }
    public function logout () {

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
            if ($dbUser["password"] && $password === $dbUser["password"]) {
                \App\Session::setUser(new User($dbUser));  // Ou garde juste l'ID ou le pseudo si tu préfères
                \App\Session::addFlash("success", "Connexion réussie !");
                $this->redirectTo("home");
            } else {
                \App\Session::addFlash("error", "Identifiants incorrects.");
                $this->redirectTo("security", "login");
            }
        }

        return [
            "view" => VIEW_DIR."security/login.php",
            "meta_description" => "Connexion au forum"
        ];
    }


}