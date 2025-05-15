<?php
$user = App\Session::getUser();

if (!$user) {
    echo "<p class='text-center text-red-500'>Vous devez être connecté pour voir votre profil.</p>";
    return;
}

$topicManager = new \Model\Managers\TopicManager();
$topics = $topicManager->findTopicsByUser($user->getId());
?>

<h1 class="text-2xl font-bold text-center text-gray-800 my-6">Mon profil</h1>

<div class="max-w-md mx-auto bg-white rounded-lg shadow-md p-6 space-y-4 text-gray-800">
    <p><strong>Pseudo :</strong> <?= $user->getNickName() ?></p>
    <p><strong>Rôle :</strong> <?= $user->getRole() ?></p>
    <p><strong>Inscription :</strong> 
        <?= $user->getRegistrationDate() instanceof \DateTime 
            ? $user->getRegistrationDate()->format('d/m/Y H:i') 
            : $user->getRegistrationDate() ?>
    </p>
</div>

<h2 class="text-xl font-semibold text-center mt-10 mb-4 text-gray-700">Mes topics</h2>

<div class="max-w-2xl mx-auto space-y-4">
    <?php if (empty($topics)): ?>
        <p class="text-center text-gray-500">Aucun topic créé.</p>
    <?php else: ?>
        <?php foreach ($topics as $topic): ?>
            <div class="bg-white shadow rounded p-4 flex justify-between items-center">
                <div>
                    <p class="font-semibold"><?= $topic->getTitle() ?></p>
                    <p class="text-sm text-gray-500">
                        Créé le <?= $topic->getCreationDate() instanceof \DateTime 
                                    ? $topic->getCreationDate()->format('d/m/Y H:i') 
                                    : $topic->getCreationDate() ?>
                        | Statut : <?= $topic->getIsClosed() ? "Fermé" : "Ouvert" ?>
                    </p>
                </div>
                <form method="post" action="index.php?ctrl=forum&action=toggleTopic&id=<?= $topic->getId() ?>">
                    <button type="submit" class="px-3 py-1 text-sm rounded 
                        <?= $topic->getIsClosed() ? 'bg-green-600' : 'bg-red-600' ?> text-white">
                        <?= $topic->getIsClosed() ? 'Ouvrir' : 'Fermer' ?>
                    </button>
                </form>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
