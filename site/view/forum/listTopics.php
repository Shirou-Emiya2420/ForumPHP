<?php
$category = $result["data"]['category']; 
$topics = $result["data"]['topics']; 
?>

<h1 class="text-2xl font-bold mb-4 text-center text-gray-800">
    Topics dans la catégorie "<?= $category->getName() ?>"
</h1>

<div class="max-w-2xl mx-auto space-y-4">
<?php if (empty($topics)): ?>
    <p class="text-center text-gray-500">Aucun topic pour cette catégorie.</p>
<?php else: ?>
    <?php foreach($topics as $topic): ?>
        <div class="bg-white shadow-md rounded-lg p-4 hover:bg-gray-50 transition">
        <a href="index.php?ctrl=forum&action=getTopicsById&id=<?= $topic->getId() ?>" 
   class="text-blue-600 font-semibold text-lg hover:underline">
        <?= $topic ?>
        </a>
            <p class="text-sm text-gray-500">Posté par <span class="font-medium"><?= $topic->getUser() ?></span></p>
        </div>
    <?php endforeach; ?>
<?php endif; ?>
</div>
