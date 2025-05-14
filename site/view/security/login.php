<h2 class="text-2xl font-bold mb-4 text-center">Connexion</h2>

<form action="index.php?ctrl=security&action=login" method="post" class="max-w-md mx-auto bg-white p-6 rounded shadow space-y-4">
    <div>
        <label for="pseudo" class="block font-semibold mb-1">Pseudonyme</label>
        <input type="text" id="pseudo" name="pseudo" required class="w-full px-4 py-2 border rounded">
    </div>

    <div>
        <label for="password" class="block font-semibold mb-1">Mot de passe</label>
        <input type="password" id="password" name="password" required class="w-full px-4 py-2 border rounded">
    </div>

    <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition">
        Se connecter
    </button>
</form>
