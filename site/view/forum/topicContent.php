<?php
$topic = $result["data"]["topic"];
$messages = $result["data"]["messages"];
?>

<h1 class="text-2xl font-bold mb-4 text-center text-gray-800">
    <?= $topic->getTitle() ?>
</h1>
<?php /* var_dump($topic->getUser(), App\Session::getUser()); die(); */ if(App\Session::getUser() && (App\Session::getUser()->getNickName() === $topic->getUser()->getNickName() || "admin" == App\Session::getUser()->getRole())): ?>
    <div class="flex justify-center mb-6 gap-4">
        <form method="post" action="index.php?ctrl=forum&action=toggleTopic1&id=<?= $topic->getId() ?>">
            <button type="submit" class="px-4 py-2 text-sm font-semibold rounded 
                <?= $topic->getIsClosed() ? 'bg-green-600' : 'bg-red-600' ?> text-white hover:opacity-90">
                <?= $topic->getIsClosed() ? 'Ouvrir' : 'Fermer' ?>
            </button>
        </form>
        <form method="post" action="index.php?ctrl=forum&action=supprTopic&id=<?= $topic->getId() ?>">
            <button type="submit" class="px-4 py-2 text-sm font-semibold rounded 
                bg-red-600 text-white hover:opacity-90">
                Supprimer
            </button>
        </form>
    </div>
<?php endif;?>

<div class="max-w-2xl mx-auto space-y-4">
<?php if (empty($messages)): ?>
    <p class="text-center text-gray-500">Aucun message pour ce topic.</p>
<?php else: ?>
    <?php foreach($messages as $message): ?>
        <div class="bg-white shadow-md rounded-lg p-4">
            <p><?= $message->getContent() ?></p>
            <p class="text-sm text-gray-500 mt-2">
                Posté par <?= $message->getUser() ?> le <?= $message->getCreationDate()->format('d/m/Y H:i') ?>
            </p>

            <?php
                $currentUser = App\Session::getUser();
                $isAuthor = $currentUser && $currentUser->getId() === $message->getUser()->getId();
                $isAdmin = $currentUser && $currentUser->getRole() === "admin";

                if ($isAuthor || $isAdmin):
            ?>
                <div class="flex justify-end mt-4">
                    <form method="post" action="index.php?ctrl=forum&action=supprPost&id=<?= $message->getId() ?>">
                        <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 text-sm">
                            Supprimer
                        </button>
                    </form>
                </div>
            <?php endif; ?>
</div>

    <?php endforeach; ?>
<?php endif; ?>
<?php if(App\Session::getUser() && !$topic->getIsClosed()): ?>
    <!-- Formulaire d'envoi de message -->
    <form action="index.php?ctrl=forum&action=addPost&id=<?= $topic->getId() ?>" method="post" class="max-w-2xl mx-auto mt-6 space-y-4">
        <textarea name="content" rows="4" required
            class="w-full p-3 border rounded-lg focus:outline-none focus:ring focus:border-blue-300"
            placeholder="Votre message..."></textarea>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Envoyer
        </button>
    </form>
<?php /* var_dump($topic->getIsClosed()); die(); */ elseif($topic->getIsClosed()): ?>
    <div class="max-w-2xl mx-auto mt-6 mb-6 p-4 border border-red-300 bg-red-100 text-red-700 rounded text-center">
        Ce topic est <strong>fermé</strong>. Il n’est plus possible d’ajouter de messages.
    </div>
<?php else: ?>
    <!-- Bouton de redirection vers la connexion -->
    <div class="text-center mt-6">
        <a href="index.php?ctrl=security&action=login" 
           class="inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            Connectez-vous pour répondre
        </a>
    </div>
<?php endif; ?>

</div>
