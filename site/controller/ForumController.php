<?php
namespace Controller;


use App\Session;
use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\CategoryManager;
use Model\Managers\TopicManager;
use Model\Managers\PostManager;

class ForumController extends AbstractController implements ControllerInterface{

    public function index() {
        
        // créer une nouvelle instance de CategoryManager
        $categoryManager = new CategoryManager();
        // récupérer la liste de toutes les catégories grâce à la méthode findAll de Manager.php (triés par nom)
        $categories = $categoryManager->findAll(["name", "DESC"]);

        // le controller communique avec la vue "listCategories" (view) pour lui envoyer la liste des catégories (data)
        return [
            "view" => VIEW_DIR."forum/listCategories.php",
            "meta_description" => "Liste des catégories du forum",
            "data" => [
                "categories" => $categories
            ]
        ];
    }
 
    public function listTopicsByCategory($id) {

        $topicManager = new TopicManager();
        $categoryManager = new CategoryManager();
        /* var_dump($id); die(); */
        $category = $categoryManager->findOneById($id);
        $topics = $topicManager->findTopicsByCategory($id);

        return [
            "view" => VIEW_DIR."forum/listTopics.php",
            "meta_description" => "Liste des topics par catégorie : ".$category,
            "data" => [
                "category" => $category,
                "topics" => $topics
            ]
        ];
    }

public function getTopicsById($id) {
    $topicManager = new TopicManager();
    $postManager = new PostManager();
    $topic = $topicManager->findOneById($id);

    if (!$topic) {
        Session::addFlash("error", "Ce topic n'existe pas.");
        return $this->redirectTo("forum", "index");
    }

    $order = isset($_GET["order"]) && $_GET["order"] === "desc" ? "DESC" : "ASC";
    $_SESSION["order"] = $order; // stocke la préférence

    $messages = $postManager->findMessagesByTopic($id, $order);

    return [
        "view" => VIEW_DIR."forum/topicContent.php",
        "meta_description" => "Messages du topic : ".$topic,
        "data" => [
            "topic" => $topic,
            "messages" => $messages
        ]
    ];
}

    public function addPost($id) {
        if (!(Session::getUser())) {
            return $this->redirectTo("security", "login");
        }
    
        $postManager = new PostManager();
        $content = filter_input(INPUT_POST, "content", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

/*         var_dump($content, $id, Session::getUser()->getId(), $postManager);
        die(); */
    
        if ($content) {
            var_dump($postManager->add([
                "content" => $content,
                "topic_id" => $id,
                "user_id" => Session::getUser()->getId()
            ]));
        }
    
        return $this->redirectTo("forum", "getTopicsById", $id);
    }
    
    public function toggleTopic($id) {
        $topicManager = new TopicManager();
        $topic = $topicManager->findOneById($id);
    
        if ($topic) {
            $newState = $topic->getIsClosed() ? 0 : 1;
            $topicManager->setClosed($id, $newState);
            /* var_dump($newState, $id); die(); */
            Session::addFlash("success", "Le topic a été " . ($newState ? "fermé" : "ouvert") . ".");
        }
    
        /* var_dump("OK"); die(); */
        return $this->redirectTo("security", "profile");
    }

    public function toggleTopic1($id) {
        $topicManager = new TopicManager();
        $topic = $topicManager->findOneById($id);
    
        if ($topic) {
            $newState = $topic->getIsClosed() ? 0 : 1;
            $topicManager->setClosed($id, $newState);
            /* var_dump($newState, $id); die(); */
            Session::addFlash("success", "Le topic a été " . ($newState ? "fermé" : "ouvert") . ".");
        }
    
        /* var_dump("OK"); die(); */
        return $this->redirectTo("forum", "getTopicsById", $id);
    }
    
    public function supprPost($id) {
        $postManager = new PostManager();
        $post = $postManager->findOneById($id);
    
        if (!$post) {
            Session::addFlash("error", "Ce message n'existe pas.");
            return $this->redirectTo("forum", "index");
        }
    
        $user = Session::getUser();
        $isOwner = $user && $user->getId() === $post->getUser()->getId();
        $isAdmin = $user && $user->getRole() === "admin";
    
        if ($isOwner || $isAdmin) {
            $topicId = $post->getTopic()->getId();
            $postManager->delete($id);
            Session::addFlash("success", "Message supprimé avec succès.");
            return $this->redirectTo("forum", "getTopicsById", $topicId);
        }
    
        Session::addFlash("error", "Action non autorisée.");
        return $this->redirectTo("forum", "index");
    }

    public function supprTopic($id) {
        $topicManager = new TopicManager();
        $topic = $topicManager->findOneById($id);

        if (!$topic) {
            Session::addFlash("error", "Ce message n'existe pas.");
            return $this->redirectTo("forum", "index");
        }
    
        $user = Session::getUser();
        $isOwner = $user && $user->getId() === $topic->getUser()->getId();
        $isAdmin = $user && $user->getRole() === "admin";
    
        if ($isOwner || $isAdmin) {
            $topicManager->delete($id);
            Session::addFlash("success", "Topic supprimé avec succès.");
            return $this->redirectTo("security", "profile");
        }
    
        Session::addFlash("error", "Action non autorisée.");
        return $this->redirectTo("forum", "getTopicsById", $id);
    }
    
    public function addNewTopic() {
        if (!Session::getUser()) {
            return $this->redirectTo("security", "login");
        }

        $title = filter_input(INPUT_POST, "title", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $categoryId = filter_input(INPUT_POST, "category", FILTER_VALIDATE_INT);
        $content = filter_input(INPUT_POST, "content", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $topicManager = new TopicManager();
        $postManager = new PostManager();

        if ($title && $categoryId && $content) {
            var_dump($topicId = $topicManager->add([
                "title" => $title,
                "creationDate" => date("Y-m-d H:i:s"),
                "user_id" => Session::getUser()->getId(),
                "category_id" => $categoryId,
                "isClose" => 0
            ])); /* die(); */

        var_dump($postManager->add([
            "content" => $content,
            "creationDate" => date("Y-m-d H:i:s"),
            "topic_id" => $topicId,
            "user_id" => Session::getUser()->getId()
        ])); /* die(); */

        Session::addFlash("success", "Topic créé avec succès.");
        return $this->redirectTo("forum", "getTopicsById", $topicId);
        }

        $catManager = new CategoryManager();
        $categories = $catManager->findAll(["name", "ASC"]);

        return [
            "view" => VIEW_DIR."forum/newTopic.php",
            "meta_description" => "Créer un nouveau topic",
            "data" => [
                "categories" => $categories
            ]
        ];
    }

    public function toggleLike() {
        $postId = intval($_GET['id']);
        $user = Session::getUser();

        /* var_dump($postId); die(); */
        if (!$user) {
            $this->redirectTo("security", "login");
        }

        $userId = $user->getId();
        $manager = new PostManager();
        /* var_dump($postId, $userId); die(); */
        $manager->toggleLike($postId, $userId);

        $post = $manager->findOneById($postId);
        $topicId = $post->getTopic()->getId();

        $this->redirectTo("forum", "getTopicsById", $topicId);
    }

    
}