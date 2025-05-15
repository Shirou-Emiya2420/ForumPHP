<?php

$flagFile = __DIR__ . '/.hash_done';

if (file_exists($flagFile)) {
    exit("⛔ Ce script a déjà été exécuté. Supprimez .hash_done pour le relancer.");
}

// Connexion à la BDD
$pdo = new PDO("mysql:host=localhost;dbname=forumclindecke;charset=utf8", "root", "", [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
]);

// Récupération des utilisateurs
$sql = "SELECT id_user, password, nickName FROM user";
$stmt = $pdo->query($sql);
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Hashage
foreach ($users as $user) {
    $id = $user['id_user'];
    $nick = $user['nickName'];
    $pwd = $user['password'];

    if (strlen($pwd) < 60) {
        $hash = password_hash($pwd, PASSWORD_DEFAULT);
        $update = $pdo->prepare("UPDATE user SET password = :hash WHERE id_user = :id");
        $update->execute(["hash" => $hash, "id" => $id]);

        echo "✔️ $nick : mot de passe hashé<br>";
    } else {
        echo "⏩ $nick : déjà hashé<br>";
    }
}

// Création du fichier de verrouillage
file_put_contents($flagFile, "done");

echo "<br>✅ Script exécuté une seule fois avec succès.";
