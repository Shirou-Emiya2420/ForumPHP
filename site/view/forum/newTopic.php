<h1 class="text-2xl font-bold text-center mb-6 text-gray-800">Créer un nouveau Topic</h1>

<form method="post" action="index.php?ctrl=forum&action=addNewTopic" class="max-w-xl mx-auto space-y-4">
    <input type="text" name="title" required placeholder="Titre du topic"
        class="w-full p-3 border rounded-lg focus:outline-none focus:ring focus:border-blue-300">

    <select name="category" required class="w-full p-3 border rounded-lg focus:outline-none focus:ring focus:border-blue-300">
        <option value="">-- Choisir une catégorie --</option>
        <?php foreach($result["data"]["categories"] as $cat): ?>
            <option value="<?= $cat->getId() ?>"><?= $cat->getName() ?></option>
        <?php endforeach; ?>
    </select>

    <textarea name="content" rows="5" required placeholder="Contenu du premier message..."
        class="w-full p-3 border rounded-lg focus:outline-none focus:ring focus:border-blue-300"></textarea>

    <div class="text-center">
        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Créer le topic</button>
    </div>
</form>
