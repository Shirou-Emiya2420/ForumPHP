DROP DATABASE forum;
CREATE DATABASE forum;
USE forum;

CREATE TABLE utilisateur(
    id_utilisateur INT AUTO_INCREMENT PRIMARY KEY,
    role JSON,
    nickName VARCHAR(50) NOT NULL,
    password VARCHAR(127) NOT NULL,
    date_inscription DATETIME NOT NULL
);

CREATE TABLE sujet(
    id_sujet INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(255) NOT NULL,
    date_creation DATETIME NOT NULL,
    id_utilisateur INT NOT NULL,
    FOREIGN KEY (id_utilisateur) REFERENCES utilisateur(id_utilisateur)
);

CREATE TABLE message (
    id_message INT AUTO_INCREMENT PRIMARY KEY,
    contenu TEXT NOT NULL,
    date_creation DATETIME NOT NULL,
    id_sujet INT,
    id_utilisateur INT,
    FOREIGN KEY (id_utilisateur) REFERENCES utilisateur(id_utilisateur),
    FOREIGN KEY (id_sujet) REFERENCES sujet(id_sujet)
);
CREATE TABLE categorie(
    id_categorie INT AUTO_INCREMENT PRIMARY KEY,
    nom_categorie VARCHAR(50) NOT NULL
);
CREATE TABLE sujet_catégorie(
    id_categorie INT,
    id_sujet INT,
    FOREIGN KEY (id_categorie) REFERENCES categorie(id_categorie),
    FOREIGN KEY (id_sujet) REFERENCES sujet(id_sujet)
);

