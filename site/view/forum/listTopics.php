<?php
$category = $result["data"]['category']; 
$topics = $result["data"]['topics']; 
?>

<div class="text-center mb-6">
    <a href="index.php?ctrl=forum&action=addNewTopic&id=<?= $category->getId() ?>" 
       class="inline-block bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">
        + Nouveau Topic
    </a>
</div>

<h1 class="text-2xl font-bold mb-4 text-center text-gray-800">
    Topics dans la catégorie "<?= $category->getName() ?>"
</h1>

<div class="max-w-2xl mx-auto space-y-4">
<?php if (empty($topics)): ?>
    <p class="text-center text-gray-500">Aucun topic pour cette catégorie.</p>
<?php else: ?>
<?php foreach($topics as $topic): ?>
    <?php $author = $topic->getUser(); ?>
    <div class="bg-white shadow-md rounded-lg p-4 hover:bg-gray-50 transition flex gap-4 items-center">
        <img src="uploads/<?= $author ? $author->getPathImg() : 'default.png' ?>" 
             alt="Avatar" class="w-12 h-12 rounded-full border shadow">
        <div>
            <a href="index.php?ctrl=forum&action=getTopicsById&id=<?= $topic->getId() ?>" 
               class="text-blue-600 font-semibold text-lg hover:underline">
                <?= $topic ?>
            </a>
            <p class="text-sm text-gray-500">
                Posté par 
                <span class="font-medium">
                    <?= $author ? $author->getNickName() : "Utilisateur supprimé" ?>
                </span>
            </p>
        </div>
    </div>
<?php endforeach; ?>
<?php endif; ?>
</div>
