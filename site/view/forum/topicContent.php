<?php
$topic = $result["data"]["topic"];
$messages = $result["data"]["messages"];
$topicUser = $topic->getUser();
$currentUser = App\Session::getUser();
$isTopicOwner = $topicUser && $currentUser && 
    ($currentUser->getNickName() === $topicUser->getNickName() || $currentUser->getRole() === "admin");
?>

<h1 class="text-2xl font-bold mb-4 text-center text-gray-800">
    <?= $topic->getTitle() ?>
</h1>

<?php if($isTopicOwner): ?>
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
<?php endif; ?>

<div class="max-w-2xl mx-auto space-y-4">
<?php if (empty($messages)): ?>
    <p class="text-center text-gray-500">Aucun message pour ce topic.</p>
<?php else: ?>
    <div class="text-center mb-4">
        <a href="index.php?ctrl=forum&action=getTopicsById&id=<?= $topic->getId() ?>&order=asc" class="mx-2 text-blue-600 hover:underline">
            🔼 Chronologique
        </a>
        <a href="index.php?ctrl=forum&action=getTopicsById&id=<?= $topic->getId() ?>&order=desc" class="mx-2 text-blue-600 hover:underline">
            🔽 Anti-chronologique
        </a>
    </div>

    <?php foreach($messages as $message): ?>
        <?php 
            $author = $message->getUser();
            $pseudo = $author ? $author->getNickName() : "Utilisateur supprimé";
        ?>
        <div class="bg-white shadow-md rounded-lg p-4">
            <div class="flex gap-4 items-start">
                <img src="uploads/<?= $author ? $author->getPathImg() : 'default.png' ?>" 
                    alt="Avatar" class="w-12 h-12 rounded-full border shadow">
                <div>
                    <p><?= $message->getContent() ?></p>
                    <p class="text-sm text-gray-500 mt-2">
                        Posté par <?= $pseudo ?> le <?= $message->getCreationDate()->format('d/m/Y H:i') ?>
                    </p>
                </div>
            </div>
            <?php if ($currentUser): ?>
            <?php
                $messageId = $message->getId();
                $userId = $currentUser->getId();
                $hasLiked = $message->isLikedBy($userId);
                $likeCount = $message->getLikeCount();

                /* var_dump($messageId, $userId, $hasLiked, $likeCount); die(); */
            ?>
            <form method="post" action="index.php?ctrl=forum&action=toggleLike&id=<?= $messageId ?>" class="mt-2">
                <button type="submit" class="group flex items-center gap-1 text-sm focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" 
                        fill="<?= $hasLiked ? '#dc2626' : 'none' ?>" 
                        stroke-width="1.8" stroke="currentColor"
                        class="w-5 h-5 transition-all duration-150 ease-out group-hover:scale-110 <?= $hasLiked ? 'text-red-600' : 'text-gray-400 group-hover:text-red-500' ?>">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 
                                2 6.5 3.5 5 5.5 5c1.54 0 3.04.99 3.57 2.36h1.87C13.46 5.99 14.96 5 16.5 5
                                18.5 5 20 6.5 20 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                    </svg>
                    <span class="text-gray-500 text-xs"><?= $likeCount ?></span>
                </button>
            </form>
        <?php endif; ?>
            <?php
                $isAuthor = $currentUser && $author && $currentUser->getId() === $author->getId();
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
    <form action="index.php?ctrl=forum&action=addPost&id=<?= $topic->getId() ?>" method="post" class="max-w-2xl mx-auto mt-6 space-y-4">
        <textarea name="content" rows="4" required
            class="w-full p-3 border rounded-lg focus:outline-none focus:ring focus:border-blue-300"
            placeholder="Votre message..."></textarea>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Envoyer
        </button>
    </form>
<?php elseif($topic->getIsClosed()): ?>
    <div class="max-w-2xl mx-auto mt-6 mb-6 p-4 border border-red-300 bg-red-100 text-red-700 rounded text-center">
        Ce topic est <strong>fermé</strong>. Il n’est plus possible d’ajouter de messages.
    </div>
<?php else: ?>
    <div class="text-center mt-6">
        <a href="index.php?ctrl=security&action=login" 
           class="inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            Connectez-vous pour répondre
        </a>
    </div>
<?php endif; ?>
</div>
