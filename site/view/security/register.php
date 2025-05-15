<h1 class="text-2xl font-bold text-center text-gray-800 mb-6">Créer un compte</h1>

<form action="index.php?ctrl=security&action=register" method="post" class="max-w-md mx-auto space-y-4 bg-white p-6 rounded-lg shadow">

    <div>
        <label for="nickName" class="block text-gray-700 font-semibold">Pseudo</label>
        <input type="text" name="nickName" id="nickName" required
               class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300">
    </div>

    <div>
        <label for="password" class="block text-gray-700 font-semibold">Mot de passe</label>
        <input type="password" name="password" id="password" required
               class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300">
    </div>

    <div>
        <label for="passwordConfirm" class="block text-gray-700 font-semibold">Confirmer le mot de passe</label>
        <input type="password" name="passwordConfirm" id="passwordConfirm" required
               class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300">
    </div>

    <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition">
        S'inscrire
    </button>
</form>
