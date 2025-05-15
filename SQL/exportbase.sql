-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           8.0.30 - MySQL Community Server - GPL
-- SE du serveur:                Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour forumclindecke
CREATE DATABASE IF NOT EXISTS `forumclindecke` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `forumclindecke`;

-- Listage de la structure de table forumclindecke. category
CREATE TABLE IF NOT EXISTS `category` (
  `id_category` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id_category`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table forumclindecke.category : ~6 rows (environ)
INSERT INTO `category` (`id_category`, `name`) VALUES
	(1, 'Jeux Vidéo'),
	(2, 'Séries / Films'),
	(3, 'Univers Fantastiques'),
	(4, 'Super-héros'),
	(5, 'Adaptations'),
	(6, 'Comparatifs');

-- Listage de la structure de table forumclindecke. post
CREATE TABLE IF NOT EXISTS `post` (
  `id_post` int NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  `creationDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `topic_id` int DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  PRIMARY KEY (`id_post`),
  KEY `post_ibfk_1` (`user_id`),
  KEY `post_ibfk_2` (`topic_id`),
  CONSTRAINT `post_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`) ON DELETE CASCADE,
  CONSTRAINT `post_ibfk_2` FOREIGN KEY (`topic_id`) REFERENCES `topic` (`id_topic`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=184 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table forumclindecke.post : ~182 rows (environ)
INSERT INTO `post` (`id_post`, `content`, `creationDate`, `topic_id`, `user_id`) VALUES
	(1, 'Artorias reste le plus stylé, son lore est incroyable.', '2025-04-01 11:00:00', 1, 1),
	(2, 'Franchement, j’ai galéré contre Manus, mais quelle ambiance !', '2025-04-01 11:10:00', 1, 2),
	(3, 'Personne parle de Sif ? Le combat le plus triste du jeu.', '2025-04-01 11:20:00', 1, 3),
	(4, 'Nameless King de DS3 est mon top, épique du début à la fin.', '2025-04-01 11:30:00', 1, 4),
	(5, 'Gwyn m’a déçu, mais la musique est parfaite pour conclure.', '2025-04-01 11:40:00', 1, 5),
	(6, 'J’adore Pontiff Sulyvahn, surtout en NG+.', '2025-04-01 11:50:00', 1, 1),
	(7, 'Les Rois Squelettes sont sous-côtés je trouve.', '2025-04-01 12:00:00', 1, 2),
	(8, 'Fume Knight de DS2 est une torture mais quel boss !', '2025-04-01 12:10:00', 1, 3),
	(9, 'Et personne ne mentionne Ornstein & Smough ?', '2025-04-01 12:20:00', 1, 4),
	(10, 'Ce duo m’a fait balancer ma manette à l’époque.', '2025-04-01 12:30:00', 1, 5),
	(11, 'J’ai refait le combat contre Gael récemment, toujours aussi fou.', '2025-04-01 12:40:00', 1, 1),
	(12, 'Le level design qui amène à Four Kings est trop immersif.', '2025-04-01 12:50:00', 1, 2),
	(13, 'Mon vote va à Sister Friede, niveau esthétique et difficulté.', '2025-04-01 13:00:00', 1, 3),
	(14, 'Darkeater Midir, ce dragon est un mur.', '2025-04-01 13:10:00', 1, 4),
	(15, 'Le plus marquant reste pour moi Aldrich et ses cris chelous.', '2025-04-01 13:20:00', 1, 5),
	(16, 'La série Netflix est pas fidèle mais bien fichue.', '2025-04-02 10:00:00', 2, 2),
	(17, 'J’ai commencé par les jeux, puis les livres. Le lore est dense !', '2025-04-02 10:10:00', 2, 3),
	(18, 'Geralt a trop la classe, surtout doublé par Cavill.', '2025-04-02 10:20:00', 2, 4),
	(19, 'Yennefer est bien plus badass dans les romans.', '2025-04-02 10:30:00', 2, 5),
	(20, 'La politique dans The Witcher est plus complexe qu’on croit.', '2025-04-02 10:40:00', 2, 1),
	(21, 'Je trouve que Ciri est sous-exploitée dans les jeux.', '2025-04-02 10:50:00', 2, 2),
	(22, 'Le baron sanglant est la meilleure quête de TW3.', '2025-04-02 11:00:00', 2, 3),
	(23, 'Les monstres sont bien écrits, chacun a une histoire.', '2025-04-02 11:10:00', 2, 4),
	(24, 'Le passage avec Gaunter O’Dimm est magistral.', '2025-04-02 11:20:00', 2, 5),
	(25, 'La BO du jeu est sous-estimée, surtout Skellige.', '2025-04-02 11:30:00', 2, 1),
	(26, 'Je veux une série centrée sur Vesemir.', '2025-04-02 11:40:00', 2, 2),
	(27, 'Nilfgaard = fascistes version fantasy.', '2025-04-02 11:50:00', 2, 3),
	(28, 'La Conjonction des sphères est trop peu explorée.', '2025-04-02 12:00:00', 2, 4),
	(29, 'TW2 est sous-estimé, surtout la quête de Roche.', '2025-04-02 12:10:00', 2, 5),
	(30, 'Le jeu Gwent méritait mieux.', '2025-04-02 12:20:00', 2, 1),
	(31, 'Le xénomorphe dans Covenant m’a pas convaincu.', '2025-04-03 10:00:00', 3, 3),
	(32, 'David est flippant, mais fascinant.', '2025-04-03 10:10:00', 3, 4),
	(33, 'Y a trop de trucs incohérents dans le scénario.', '2025-04-03 10:20:00', 3, 5),
	(34, 'Pourquoi les persos retirent toujours leur casque ?!', '2025-04-03 10:30:00', 3, 1),
	(35, 'La scène de la flûte est ultra malaisante.', '2025-04-03 10:40:00', 3, 2),
	(36, 'J’aime bien l’idée des ingénieurs.', '2025-04-03 10:50:00', 3, 3),
	(37, 'Mais pourquoi avoir ruiné Shaw ?!', '2025-04-03 11:00:00', 3, 4),
	(38, 'La photographie du film est magnifique.', '2025-04-03 11:10:00', 3, 5),
	(39, 'Je veux un vrai Alien 5, pas des préquelles foireuses.', '2025-04-03 11:20:00', 3, 1),
	(40, 'Covenant manque de tension, contrairement à Alien 1.', '2025-04-03 11:30:00', 3, 2),
	(41, 'Walter est plus humain que les humains.', '2025-04-03 11:40:00', 3, 3),
	(42, 'Le thème de la création est mal exploité.', '2025-04-03 11:50:00', 3, 4),
	(43, 'Ils auraient dû garder Blomkamp pour Alien.', '2025-04-03 12:00:00', 3, 5),
	(44, 'David est le vrai monstre, pas les Aliens.', '2025-04-03 12:10:00', 3, 1),
	(45, 'On veut Ripley, pas des clones de Ripley.', '2025-04-03 12:20:00', 3, 2),
	(46, 'La timeline de Zelda est un casse-tête.', '2025-04-04 10:00:00', 4, 4),
	(47, 'Nintendo l’a officialisée dans Hyrule Historia.', '2025-04-04 10:10:00', 4, 5),
	(48, 'Mais elle reste bancale avec Breath of the Wild.', '2025-04-04 10:20:00', 4, 1),
	(49, 'Je préfère voir les jeux comme des légendes transmises.', '2025-04-04 10:30:00', 4, 2),
	(50, 'Majora’s Mask est clairement à part.', '2025-04-04 10:40:00', 4, 3),
	(51, 'Skyward Sword comme origine, ça tient la route.', '2025-04-04 10:50:00', 4, 4),
	(52, 'Twilight Princess a une ambiance incroyable.', '2025-04-04 11:00:00', 4, 5),
	(53, 'Les trois timelines sont trop confuses.', '2025-04-04 11:10:00', 4, 1),
	(54, 'BOTW casse tout avec ses références multiples.', '2025-04-04 11:20:00', 4, 2),
	(55, 'Wind Waker et l’océan, un tournant osé.', '2025-04-04 11:30:00', 4, 3),
	(56, 'J’aimerais un Zelda qui relie toutes les timelines.', '2025-04-04 11:40:00', 4, 4),
	(57, 'Link est-il toujours le même héros ? Pas sûr.', '2025-04-04 11:50:00', 4, 5),
	(58, 'La malédiction de Demise est la vraie clé.', '2025-04-04 12:00:00', 4, 1),
	(59, 'La musique dans Zelda transcende les époques.', '2025-04-04 12:10:00', 4, 2),
	(60, 'Hyrule change mais reste toujours magique.', '2025-04-04 12:20:00', 4, 3),
	(61, 'Thor gagne en force, mais Iron Man en stratégie.', '2025-04-05 10:00:00', 5, 5),
	(62, 'Avec Stormbreaker, Thor est quasi invincible.', '2025-04-05 10:10:00', 5, 1),
	(63, 'Tony a battu Thanos avec un seul snap.', '2025-04-05 10:20:00', 5, 2),
	(64, 'Mais sans les pierres, il aurait perdu direct.', '2025-04-05 10:30:00', 5, 3),
	(65, 'Thor a l’avantage physique évident.', '2025-04-05 10:40:00', 5, 4),
	(66, 'Iron Man peut créer une armée de drones.', '2025-04-05 10:50:00', 5, 5),
	(67, 'Leur combat dans Civil War aurait été épique.', '2025-04-05 11:00:00', 5, 1),
	(68, 'Thor peut voler, ça change tout.', '2025-04-05 11:10:00', 5, 2),
	(69, 'Tony peut s’adapter à n’importe quelle menace.', '2025-04-05 11:20:00', 5, 3),
	(70, 'Sans son marteau, Thor perd beaucoup.', '2025-04-05 11:30:00', 5, 4),
	(71, 'Leur amitié vaut mieux que ce débat.', '2025-04-05 11:40:00', 5, 5),
	(72, 'Mais si faut trancher : Thor full power gagne.', '2025-04-05 11:50:00', 5, 1),
	(73, 'Le Hulkbuster a montré ce que Tony sait faire.', '2025-04-05 12:00:00', 5, 2),
	(74, 'Ils sont complémentaires plus qu’adversaires.', '2025-04-05 12:10:00', 5, 3),
	(75, 'Je prends Cap America en vrai 😅', '2025-04-05 12:20:00', 5, 4),
	(76, 'La quête du samouraï fantôme est incroyable.', '2025-04-06 10:00:00', 6, 1),
	(77, 'Cyberpunk est bourré de références pop culture.', '2025-04-06 10:10:00', 6, 2),
	(78, 'L’easter egg de Hideo Kojima m’a tué.', '2025-04-06 10:20:00', 6, 3),
	(79, 'On peut visiter le studio de Witcher dans le jeu.', '2025-04-06 10:30:00', 6, 4),
	(80, 'Y a un sabre laser caché dans un coffre !', '2025-04-06 10:40:00', 6, 5),
	(81, 'Le taxi fou est inspiré de Knight Rider.', '2025-04-06 10:50:00', 6, 1),
	(82, 'Les affiches sont truffées de clins d’œil.', '2025-04-06 11:00:00', 6, 2),
	(83, 'Johnny Silverhand = Keanu Reeves 100%', '2025-04-06 11:10:00', 6, 3),
	(84, 'Y a même des blagues sur Witcher 4.', '2025-04-06 11:20:00', 6, 4),
	(85, 'Le bras de gorille, c’est un clin d’œil à Deus Ex.', '2025-04-06 11:30:00', 6, 5),
	(86, 'La mission sur le braindance est digne de Black Mirror.', '2025-04-06 11:40:00', 6, 1),
	(87, 'Les pubs sont à double sens, hyper bien pensées.', '2025-04-06 11:50:00', 6, 2),
	(88, 'La radio a des messages cryptés.', '2025-04-06 12:00:00', 6, 3),
	(89, 'Les noms de gangs sont inspirés d’animes.', '2025-04-06 12:10:00', 6, 4),
	(90, 'L’arme Skippy est une dinguerie.', '2025-04-06 12:20:00', 6, 5),
	(91, 'L’univers de Bloodborne est fascinant.', '2025-04-07 10:00:00', 7, 2),
	(92, 'C’est Lovecraft + FromSoftware : combo parfait.', '2025-04-07 10:10:00', 7, 3),
	(93, 'La transformation des chasseurs est flippante.', '2025-04-07 10:20:00', 7, 4),
	(94, 'L’église soigneuse est ultra glauque.', '2025-04-07 10:30:00', 7, 5),
	(95, 'Yharnam est vivante, même dans la mort.', '2025-04-07 10:40:00', 7, 1),
	(96, 'La Poupée, je la trouve touchante.', '2025-04-07 10:50:00', 7, 2),
	(97, 'Gehrman m’a brisé le cœur.', '2025-04-07 11:00:00', 7, 3),
	(98, 'Le cauchemar de Mensis est trop perturbant.', '2025-04-07 11:10:00', 7, 4),
	(99, 'Rom est l’un des boss les plus tristes.', '2025-04-07 11:20:00', 7, 5),
	(100, 'Le DLC est une claque absolue.', '2025-04-07 11:30:00', 7, 1),
	(101, 'Le design des armes est juste parfait.', '2025-04-07 11:40:00', 7, 2),
	(102, 'Les mères du village de Cainhurst me hantent.', '2025-04-07 11:50:00', 7, 3),
	(103, 'L’Orphelin de Kos est une purge…', '2025-04-07 12:00:00', 7, 4),
	(104, 'On a besoin d’un Bloodborne 2 !', '2025-04-07 12:10:00', 7, 5),
	(105, 'Le style victorien est un vrai plus.', '2025-04-07 12:20:00', 7, 1),
	(106, 'Le cast de l’adaptation One Piece est pas mal.', '2025-04-08 10:00:00', 8, 3),
	(107, 'Luffy est crédible, j’étais surpris.', '2025-04-08 10:10:00', 8, 4),
	(108, 'Zoro vole la vedette à chaque scène.', '2025-04-08 10:20:00', 8, 5),
	(109, 'Les décors sont bien foutus, rien à dire.', '2025-04-08 10:30:00', 8, 1),
	(110, 'Usopp manque un peu de folie.', '2025-04-08 10:40:00', 8, 2),
	(111, 'La musique aurait pu être plus originale.', '2025-04-08 10:50:00', 8, 3),
	(112, 'Je veux la saison 2 maintenant !', '2025-04-08 11:00:00', 8, 4),
	(113, 'Arlong est super bien joué.', '2025-04-08 11:10:00', 8, 5),
	(114, 'Sanji est très fidèle au perso.', '2025-04-08 11:20:00', 8, 1),
	(115, 'Il manque juste un peu d’énergie parfois.', '2025-04-08 11:30:00', 8, 2),
	(116, 'Les combats sont bien chorégraphiés.', '2025-04-08 11:40:00', 8, 3),
	(117, 'Nami a plus de profondeur que dans l’anime.', '2025-04-08 11:50:00', 8, 4),
	(118, 'Respecter l’univers, c’est déjà un exploit.', '2025-04-08 12:00:00', 8, 5),
	(119, 'On sent que les créateurs aiment One Piece.', '2025-04-08 12:10:00', 8, 1),
	(120, 'Meilleur live action manga pour l’instant.', '2025-04-08 12:20:00', 8, 2),
	(121, 'Skyrim a vieilli mais reste culte.', '2025-04-09 10:00:00', 9, 4),
	(122, 'Elden Ring offre plus de challenge.', '2025-04-09 10:10:00', 9, 5),
	(123, 'Mais Skyrim est plus immersif côté RPG.', '2025-04-09 10:20:00', 9, 1),
	(124, 'Les quêtes secondaires de Skyrim sont inégalées.', '2025-04-09 10:30:00', 9, 2),
	(125, 'Le monde ouvert d’ER est plus dynamique.', '2025-04-09 10:40:00', 9, 3),
	(126, 'Les mods Skyrim changent tout.', '2025-04-09 10:50:00', 9, 4),
	(127, 'Elden Ring manque de dialogues roleplay.', '2025-04-09 11:00:00', 9, 5),
	(128, 'Skyrim est un bac à sable infini.', '2025-04-09 11:10:00', 9, 1),
	(129, 'L’univers de FromSoft est plus sombre.', '2025-04-09 11:20:00', 9, 2),
	(130, 'Je joue toujours à Skyrim 10 ans après.', '2025-04-09 11:30:00', 9, 3),
	(131, 'Skyrim vanilla est trop mou.', '2025-04-09 11:40:00', 9, 4),
	(132, 'Elden Ring me fait rager mais j’adore.', '2025-04-09 11:50:00', 9, 5),
	(133, 'Difficile de comparer, trop différents.', '2025-04-09 12:00:00', 9, 1),
	(134, 'ER m’a fait redécouvrir les jeux FromSoft.', '2025-04-09 12:10:00', 9, 2),
	(135, 'Skyrim = nostalgie pure.', '2025-04-09 12:20:00', 9, 3),
	(136, 'Saga indé : Invincible est trop bien.', '2025-04-10 10:00:00', 10, 5),
	(137, 'J’ai adoré Umbrella Academy.', '2025-04-10 10:10:00', 10, 1),
	(138, 'The Boys est une critique géniale.', '2025-04-10 10:20:00', 10, 2),
	(139, 'Black Hammer est trop sous-estimé.', '2025-04-10 10:30:00', 10, 3),
	(140, 'Moon Knight en comics est plus profond.', '2025-04-10 10:40:00', 10, 4),
	(141, 'J’ai découvert Saga récemment, une perle.', '2025-04-10 10:50:00', 10, 5),
	(142, 'Hellboy mérite plus de reconnaissance.', '2025-04-10 11:00:00', 10, 1),
	(143, 'Deadly Class est ouf.', '2025-04-10 11:10:00', 10, 2),
	(144, 'Mon préféré reste Locke & Key.', '2025-04-10 11:20:00', 10, 3),
	(145, 'Sandman version papier est un chef-d’œuvre.', '2025-04-10 11:30:00', 10, 4),
	(146, 'Spawn a un lore de dingue.', '2025-04-10 11:40:00', 10, 5),
	(147, 'V pour Vendetta reste d’actualité.', '2025-04-10 11:50:00', 10, 1),
	(148, 'East of West est très original.', '2025-04-10 12:00:00', 10, 2),
	(149, 'J’aimerais une série sur Black Science.', '2025-04-10 12:10:00', 10, 3),
	(150, 'Fables est un bijou.', '2025-04-10 12:20:00', 10, 4),
	(151, 'Artorias est incroyable, mais Gael reste mon préféré.', '2025-04-13 10:00:00', 1, 6),
	(152, 'La politique dans The Witcher est mieux développée que dans beaucoup de RPG.', '2025-04-13 10:05:00', 2, 7),
	(153, 'Alien : Covenant aurait dû s’assumer comme un film d’androïdes, pas d’Alien.', '2025-04-13 10:10:00', 3, 8),
	(154, 'La timeline Zelda est du pur mythe, c’est ça qui la rend belle.', '2025-04-13 10:15:00', 4, 6),
	(155, 'Thor écrase Iron Man, sauf si c’est écrit par Marvel Studios.', '2025-04-13 10:20:00', 5, 7),
	(156, 'J’ai vu une affiche de The Witcher dans une ruelle, clin d’œil sympa !', '2025-04-13 10:25:00', 6, 8),
	(157, 'L’univers de Bloodborne est le plus abouti de FromSoftware.', '2025-04-13 10:30:00', 7, 9),
	(158, 'J’ai été surpris par la qualité de l’adaptation live de One Piece !', '2025-04-13 10:35:00', 8, 10),
	(159, 'Skyrim offre plus de liberté, mais Elden Ring est plus immersif.', '2025-04-13 10:40:00', 9, 11),
	(160, 'Locke & Key mériterait une meilleure adaptation animée.', '2025-04-13 10:45:00', 10, 9),
	(161, 'Je préfère Immersive Citizens, ça change tout.', '2025-04-14 10:00:00', 11, 1),
	(162, 'Orphan Rock et la quête de la sorcière, un bijou oublié.', '2025-04-14 10:01:00', 12, 2),
	(163, 'J’ai toujours été team Sombrages, même si c’est pas populaire.', '2025-04-14 10:02:00', 13, 3),
	(164, 'Un archer furtif avec le masque de Krosis, rien de mieux.', '2025-04-14 10:03:00', 14, 4),
	(165, 'Karstaag m’a détruit 3 fois avant que je le passe.', '2025-04-14 10:04:00', 15, 5),
	(166, 'SkyUI + ENB = combo parfait pour Skyrim moderne.', '2025-04-14 10:05:00', 11, 6),
	(167, 'La quête de la Mère Noire est la plus marquante.', '2025-04-14 10:06:00', 12, 7),
	(168, 'Sombrages ou Empire ? Aucun n’a raison au fond.', '2025-04-14 10:07:00', 13, 8),
	(169, 'Mon build préféré : archer vampire, furtif, rapide, létal.', '2025-04-14 10:08:00', 14, 9),
	(170, 'Karstaag est un boss optionnel mais brutal.', '2025-04-14 10:09:00', 15, 10),
	(171, 'J’ai battu Karstaag… grâce au cri ralentisseur.', '2025-04-14 10:10:00', 15, 11),
	(172, 'J’ai fini le jeu avec la Lame d’ossement, trop stylée.', '2025-04-14 10:11:00', 16, 1),
	(173, 'La fin avec la Présence Lunaire est la plus cryptique.', '2025-04-14 10:12:00', 17, 2),
	(174, 'Le cauchemar de Mensis m’a donné la gerbe.', '2025-04-14 10:13:00', 18, 3),
	(175, 'Les boss comme Micolash sont trop sous-estimés.', '2025-04-14 10:14:00', 19, 4),
	(176, 'Le DLC est l’apogée de FromSoftware.', '2025-04-14 10:15:00', 20, 5),
	(177, 'Je ne me lasse jamais de la scie-lance.', '2025-04-14 10:16:00', 16, 6),
	(178, 'Fin astrale : je l’ai eue sans le vouloir !', '2025-04-14 10:17:00', 17, 7),
	(179, 'Le cauchemar m’a marqué à vie.', '2025-04-14 10:18:00', 18, 8),
	(180, 'Micolash est plus complexe qu’on le pense.', '2025-04-14 10:19:00', 19, 9),
	(181, 'The Old Hunters mérite un jeu à lui seul.', '2025-04-14 10:20:00', 20, 10),
	(182, 'Le DLC m’a détruit… mais c’était parfait.', '2025-04-14 10:21:00', 20, 11);

-- Listage de la structure de table forumclindecke. topic
CREATE TABLE IF NOT EXISTS `topic` (
  `id_topic` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `creationDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int NOT NULL,
  `category_id` int NOT NULL,
  `isClose` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_topic`),
  KEY `topic_ibfk_1` (`category_id`),
  KEY `topic_ibfk_2` (`user_id`),
  CONSTRAINT `topic_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id_category`) ON DELETE CASCADE,
  CONSTRAINT `topic_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table forumclindecke.topic : ~20 rows (environ)
INSERT INTO `topic` (`id_topic`, `title`, `creationDate`, `user_id`, `category_id`, `isClose`) VALUES
	(1, 'Meilleur boss de Dark Souls ?', '2025-04-01 10:00:00', 1, 1, 0),
	(2, 'Analyse de la saga The Witcher', '2025-04-02 11:00:00', 2, 1, 0),
	(3, 'Théories sur Alien : Covenant', '2025-04-03 12:00:00', 3, 2, 0),
	(4, 'Timeline de Zelda : mythe ou réalité ?', '2025-04-04 13:00:00', 4, 1, 0),
	(5, 'Qui est le plus fort : Thor ou Iron Man ?', '2025-04-05 14:00:00', 5, 4, 0),
	(6, 'Références cachées dans Cyberpunk 2077', '2025-04-06 15:00:00', 1, 1, 0),
	(7, 'Le lore de Bloodborne expliqué', '2025-04-07 16:00:00', 2, 1, 0),
	(8, 'Adaptation live de One Piece : avis ?', '2025-04-08 17:00:00', 3, 5, 0),
	(9, 'Comparaison Elden Ring vs Skyrim', '2025-04-09 18:00:00', 4, 6, 0),
	(10, 'Les comics les plus sous-côtés', '2025-04-10 19:00:00', 5, 4, 0),
	(11, 'Quel est le meilleur mod de gameplay ?', '2025-04-11 10:00:00', 6, 1, 0),
	(12, 'Quêtes secondaires les plus marquantes ?', '2025-04-11 11:00:00', 7, 1, 0),
	(13, 'Faut-il rejoindre les Sombrages ?', '2025-04-11 12:00:00', 8, 1, 0),
	(14, 'Votre build préféré pour un archer ?', '2025-04-11 13:00:00', 6, 1, 0),
	(15, 'Avez-vous déjà battu Karstaag ?', '2025-04-11 14:00:00', 7, 1, 0),
	(16, 'Quelle arme avez-vous utilisée le plus ?', '2025-04-12 10:00:00', 9, 1, 0),
	(17, 'Quelle est la meilleure fin selon vous ?', '2025-04-12 11:00:00', 10, 1, 0),
	(18, 'Les Cauchemars vous ont-ils traumatisé ?', '2025-04-12 12:00:00', 11, 1, 0),
	(19, 'Les boss les plus sous-estimés ?', '2025-04-12 13:00:00', 9, 1, 0),
	(20, 'Que pensez-vous du DLC The Old Hunters ?', '2025-04-12 14:00:00', 10, 1, 0);

-- Listage de la structure de table forumclindecke. user
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `role` varchar(50) NOT NULL,
  `nickName` varchar(50) NOT NULL,
  `password` varchar(127) NOT NULL,
  `registrationDate` datetime NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table forumclindecke.user : ~11 rows (environ)
INSERT INTO `user` (`id_user`, `role`, `nickName`, `password`, `registrationDate`) VALUES
	(1, 'admin', 'NeoMatrix', '$2y$10$NDhq5n.av2oM9xzhvAC7HOKnNdEP.hnTB2eP3qJXssgtuRupnwCoy', '2025-03-01 10:00:00'),
	(2, 'membre', 'GeraltRivia', '$2y$10$BsKCa3LRUby97HY8uESETeO7TNMEjfCwcLnl2ldf/2LK/Jv.Uo/N2', '2025-03-02 11:00:00'),
	(3, 'membre', 'RipleyS', '$2y$10$ggQAi5P2ytStcsXPLOlCOumMs1MNs1XRsNeRVqAggT.CEYlLu4l0y', '2025-03-03 12:00:00'),
	(4, 'membre', 'ZeldaFan', '$2y$10$FCeHBqKw0oDcr1AWDbECJudP.vSxXCqrzvV9lhId0XEHfsuG/QPgG', '2025-03-04 13:00:00'),
	(5, 'membre', 'TonyStark', '$2y$10$fRwauO2rSfs7HaXk9pOo0u6Zn74K7F2byasIrsIsKEi9B48oqATn.', '2025-03-05 14:00:00'),
	(6, 'membre', 'Dovahkiin', '$2y$10$G21WKiUSD/BTb9LErg0aBOnp9FUG.CIumufNmJ.vJztqyhb5X.uEu', '2025-03-06 10:00:00'),
	(7, 'membre', 'Serana', '$2y$10$I7rHFKP6za8e7jgJUE0fFuR7fWvXVmU2cbtlwK4ATL/DlEu/SrYS2', '2025-03-06 11:00:00'),
	(8, 'membre', 'Miraak', '$2y$10$JnAi5GbC9SDSckNrZdq05evU67tqH7KLzvjrRivAE4DyqUfHhQhwm', '2025-03-06 12:00:00'),
	(9, 'membre', 'Gehrman', '$2y$10$93f7kFCcbpWrrmI/yV80O.RDZzEVB1sVlcLZCVNwY51O/HPh3O7a6', '2025-03-07 10:00:00'),
	(10, 'membre', 'LadyMaria', '$2y$10$UpN3Hpyue4LKGJiiG95ZnuXLMHosMOb2jnkK2hhU3SkRI9t0dX1XC', '2025-03-07 11:00:00'),
	(11, 'membre', 'EileenCrow', '$2y$10$YbRDVBvgJLALjYSSsMkHWOArstu4z02yK/RZ5KXMq0ljf7si6ZQhe', '2025-03-07 12:00:00');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
