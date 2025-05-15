<?php
namespace Controller;

use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\UserManager;
use Model\Managers\TopicManager;

class HomeController extends AbstractController implements ControllerInterface {

    public function index() {
        $topicManager = new TopicManager();
        $topTopics = $topicManager->findTopTopics();
        /* var_dump(value: iterator_to_array($topTopics));die(); */
        return [
            "view" => VIEW_DIR . "home.php",
            "meta_description" => "Accueil du forum",
            "data" => [
                "topTopics" => $topTopics
            ]
        ];
    }
        
    public function listUsers(){
        $this->restrictTo("admin");

        $manager = new UserManager();
        $users = $manager->findAll(['registrationDate', 'DESC']);

        return [
            "view" => VIEW_DIR."security/users.php",
            "meta_description" => "Liste des utilisateurs du forum",
            "data" => [ 
                "users" => $users 
            ]
        ];
    }

}
