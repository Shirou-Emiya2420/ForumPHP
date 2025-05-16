# Forum PHP MVC

Ce projet est un **forum web complet** en PHP, organisé autour d’une architecture **MVC maison**, avec gestion :
- des utilisateurs,
- des topics,
- des messages,
- des likes,
- des rôles,
- et des images de profil.

---

## 🚀 Fonctionnalités

- ✅ Inscription / Connexion avec mot de passe hashé
- 🧑‍💼 Rôles utilisateurs : `admin`, `membre`
- 💬 Création et affichage de topics dans des catégories
- 📝 Ajout de messages avec tri (ASC/DESC)
- 🖼️ Avatar personnalisable (image dans `/uploads`)
- ❤️ Système de likes avec icône dynamique
- 🔒 Fermeture de topics par créateur ou admin
- 🗑️ Suppression de messages (admin/auteur uniquement)

---

## 📂 Arborescence

```
site/
├── app/              # cœur du système (DAO, contrôleurs abstraits)
├── controller/       # contrôleurs (Forum, Home, Security)
├── model/            # entités et managers (Post, User, etc.)
├── public/           # fichiers CSS, JS, images
├── uploads/          # avatars utilisateurs
├── view/             # vues organisées par dossier logique
└── index.php         # routeur principal
```

---

## 🧠 Schéma BDD

```sql
CREATE TABLE user (
  id_user INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  role VARCHAR(50) NOT NULL,
  nickName VARCHAR(50) NOT NULL,
  password VARCHAR(127) NOT NULL,
  pathImg VARCHAR(127) NOT NULL DEFAULT 'default.png',
  registrationDate DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE category (
  id_category INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(50) NOT NULL
);

CREATE TABLE topic (
  id_topic INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255) NOT NULL,
  creationDate DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  user_id INT UNSIGNED,
  category_id INT,
  isClose BOOLEAN NOT NULL,
  FOREIGN KEY (category_id) REFERENCES category(id_category) ON DELETE SET NULL,
  FOREIGN KEY (user_id) REFERENCES user(id_user) ON DELETE SET NULL
);

CREATE TABLE post (
  id_post INT AUTO_INCREMENT PRIMARY KEY,
  content TEXT NOT NULL,
  creationDate DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  topic_id INT,
  user_id INT UNSIGNED,
  FOREIGN KEY (user_id) REFERENCES user(id_user) ON DELETE SET NULL,
  FOREIGN KEY (topic_id) REFERENCES topic(id_topic) ON DELETE CASCADE
);

CREATE TABLE likes (
  post_id INT NOT NULL,
  user_id INT UNSIGNED,
  PRIMARY KEY (post_id, user_id),
  FOREIGN KEY (user_id) REFERENCES user(id_user) ON DELETE CASCADE,
  FOREIGN KEY (post_id) REFERENCES post(id_post) ON DELETE CASCADE
);
```

---

## ⚙️ Lancement local (XAMPP)

1. Place le projet dans `htdocs/`
2. Crée une base `forumclindecke` et importe `/SQL/base.sql`
3. Adapte les accès BDD dans `site/app/DAO.php`
4. Lance Apache + MySQL
5. Va sur [http://localhost/site/index.php](http://localhost/site/index.php)

---

## 📌 Technologies utilisées

- PHP orienté objet (sans framework)
- HTML5, CSS3 (Tailwind-like styling)
- MariaDB/MySQL
- MVC fait maison
- Upload sécurisé d’avatars

---

## 👤 Auteur

Développé par **Charles Lindecker**  
Dans le cadre sa formation chez Elan Formation.

---

## 🧪 Améliorations possibles

- [ ] Système de réponse aux messages (threading)
- [ ] Pagination des posts et topics
- [ ] Upload d’image sécurisé avec vérification MIME
- [ ] Protection CSRF / faille XSS
