<h1 class="text-3xl font-bold text-center text-blue-700 mb-6">BIENVENUE SUR LE FORUM</h1>

<p class="text-gray-700 text-lg mb-6 text-justify">
    Bienvenue sur notre forum dédié à la culture geek ! <br> Ici, on débat du meilleur boss de Dark Souls, on analyse l’univers de The Witcher, on partage nos théories sur Bloodborne et bien plus. Que vous soyez fan de RPG, de comics ou de science-fiction, vous trouverez votre place parmi nous.
</p>

<p class="flex gap-4 justify-center">
<?php if(App\Session::getUser()): ?>

<h2 class="text-xl font-semibold text-center mt-10 mb-4 text-gray-700">Top 5 des topics ouverts les plus actifs</h2>

<div class="max-w-2xl mx-auto space-y-3">
    <?php foreach ($result["data"]["topTopics"] as $topic): ?>
        <div class="bg-white shadow p-4 rounded hover:shadow-md transition">
            <a href="index.php?ctrl=forum&action=getTopicsById&id=<?= $topic->getId() ?>" 
               class="text-lg font-bold text-blue-700 hover:underline">
                <?= $topic->getTitle() ?>
            </a>
            <p class="text-sm text-gray-500">
                Créé le <?= $topic->getCreationDate() instanceof \DateTime 
                            ? $topic->getCreationDate()->format("d/m/Y") 
                            : $topic->getCreationDate() ?>
            </p>
        </div>
    <?php endforeach; ?>

</div>

<?php else: ?>
    <a href="index.php?ctrl=security&action=login" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">Se connecter</a>
    <a href="index.php?ctrl=security&action=register" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">S'inscrire</a>
<?php endif; ?>

