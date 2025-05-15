<?php
    $categories = $result["data"]['categories']; 
?>

<h1 class="text-2xl font-bold mb-4 text-center text-gray-800">Liste des catégories</h1>

<div class="max-w-md mx-auto space-y-3">
<?php foreach($categories as $category): ?>
    <a 
        href="index.php?ctrl=forum&action=listTopicsByCategory&id=<?= $category->getId() ?>" 
        class="block bg-white shadow-md rounded-xl px-4 py-3 text-blue-600 hover:bg-blue-50 transition"
    >
        <?= $category->getName() ?>
    </a>
<?php endforeach; ?>
</div>
