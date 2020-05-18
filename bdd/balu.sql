-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 18 mai 2020 à 21:37
-- Version du serveur :  10.4.11-MariaDB
-- Version de PHP : 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `balu`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `id` int(11) NOT NULL,
  `categorie` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id`, `categorie`, `image`) VALUES
(1, 'France', 'recette2_5ebd625f0ad34.png'),
(3, 'Italie', 'recette4_5ebd62b35e425.png'),
(4, 'Mexique', 'recette1_5ebd645c828ec.png'),
(6, 'Spécialités d\'Asie', 'plat3_5ebd637f929c6.png'),
(7, 'Saveurs d\'Afrique', 'recette3_5ebd647e3356f.png'),
(8, 'Délices du Maghreb', 'recette5_5ebd6491847db.png');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `id` int(11) NOT NULL,
  `montant` double NOT NULL,
  `date` datetime NOT NULL,
  `etat` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `membre_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`id`, `montant`, `date`, `etat`, `membre_id`) VALUES
(22, 6.54, '2020-05-10 12:26:11', 'En cours', 1),
(23, 5.68, '2020-05-10 12:33:32', 'Livrée', 7),
(24, 7.36, '2020-05-10 18:41:23', 'Livrée', 1),
(25, 9.69, '2020-05-12 02:39:53', 'En cours', 6),
(26, 4.01, '2020-05-15 16:23:38', 'En cours', 8);

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

CREATE TABLE `commentaire` (
  `id` int(11) NOT NULL,
  `recette_id` int(11) DEFAULT NULL,
  `commentaire` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` int(11) DEFAULT NULL,
  `membre_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `commentaire`
--

INSERT INTO `commentaire` (`id`, `recette_id`, `commentaire`, `note`, `membre_id`) VALUES
(1, 21, 'On a adorés ! ! ! On testera avec du riz blanc la prochaine fois aussi pour voir ce que ça donne', 10, 1),
(2, 21, '\'ai mis un poivron rouge entier, 3 tomates et rajouté quelques épices piquantes.', 3, 5),
(4, 15, 'dlqmsdkj qmsldkfjqs dfmqskldf qmsdfs dfqsdf', 8, 1),
(5, 18, 'Ceci est un commentaire', 7, 1),
(6, 18, 'Ceci est un nouveau commentaire', 10, 8),
(7, 18, 'Ceci est un commentaire', 5, 1),
(8, 21, 'Difficile à réaliser', 3, 6),
(9, 22, 'Très facile à faire ! Pas compliqué et en plus c\'est léger. Recette équilibrée', 9, 8),
(10, 15, 'xsxsxsxsxs', 1, 8),
(11, 24, 'Très bon, facile à reproduire, j\'ai rajouter un peu de citron', 9, 9);

-- --------------------------------------------------------

--
-- Structure de la table `detailcommande`
--

CREATE TABLE `detailcommande` (
  `id` int(11) NOT NULL,
  `commande_id` int(11) DEFAULT NULL,
  `recette_id` int(11) DEFAULT NULL,
  `quantite` int(11) NOT NULL,
  `prix` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `detailcommande`
--

INSERT INTO `detailcommande` (`id`, `commande_id`, `recette_id`, `quantite`, `prix`) VALUES
(27, 22, 15, 3, 6.54),
(28, 23, 16, 1, 5.68),
(29, 24, 16, 1, 7.36),
(30, 25, 16, 1, 9.69),
(31, 26, 15, 1, 4.01);

-- --------------------------------------------------------

--
-- Structure de la table `membre`
--

CREATE TABLE `membre` (
  `id` int(11) NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`roles`)),
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pseudo` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cp` int(11) NOT NULL,
  `ville` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `membre`
--

INSERT INTO `membre` (`id`, `email`, `roles`, `password`, `pseudo`, `nom`, `prenom`, `adresse`, `cp`, `ville`) VALUES
(1, 'admin1@balu.fr', '[\"ROLE_ADMIN\"]', '$argon2id$v=19$m=65536,t=4,p=1$UjVDQzhUQjRUMnc5NjZnNg$tpyXiAJa4kcRjXEIaAVrtGUHobL4fjhrVd1ZmD0QaOk', 'admin1s', 'Admin', 'Admin', '6 rue du fake adresse s', 75018, 'Paris'),
(3, 'admin3@balu.fr', '[\"ROLE_ADMIN\"]', '$argon2id$v=19$m=65536,t=4,p=1$ZlczZnQ5MWlkRlppS3hDWA$Qy9Vkg7MGHqgLU8TmF75k9qQk6QgowsRLQSuA5uoty8', 'balu', 'DEFRANCE', 'Angeline', '25 Rue du centre', 29200, 'Brest'),
(5, 'manu.macron@balu.fr', '[\"ROLE_ADMIN\"]', '$argon2id$v=19$m=65536,t=4,p=1$d212ekNEdjgzb0xpbW5tcQ$OwhANyN1ssziES8zaVnV4zN4S+NlM/PdPfhGSkR3eDE', 'balu', 'MACRON', 'Emmanuel', 'Elisé', 0, ''),
(6, 'edouard.phillipe@balu.fr', '{\"1\":\"ROLE_USER\"}', '$argon2id$v=19$m=65536,t=4,p=1$UW9JeFd2UDZ4by5Ecno1Tw$ylxo+HEXMgULc++9l39Sn0EcUF8TNmF93Q+nL0D5gs8', 'Edouard.P', 'PHILLIPE', 'Edouard', 'Matignon', 75008, 'Paris'),
(7, 'Jeanbalu@balu.fr', '[]', '$argon2id$v=19$m=65536,t=4,p=1$eHdWUGliM213UEJMY01aYQ$PA2dIkUxmdyN5wYGe2wLWn3vDLhHQ6h+1vsvJHRrEsY', 'Jeanbalu', 'BERTRAND', 'Jean', '361 Av Charles de Gaulle', 93130, 'Bobigny'),
(8, 'admin10@balu.fr', '[\"ROLE_ADMIN\"]', '$argon2id$v=19$m=65536,t=4,p=1$eUFqVUVpVnlFamF6NTA5dA$QtasUTK8DeiOj6IjhVgccwkxRnImPGr490TwdkWX5Js', 'Percy', 'Roux', 'Percy', '59, place Maurice-Charretier', 94500, 'HAMPIGNY-SUR-MARNE'),
(9, 'user1@balu.fr', '[]', '$argon2id$v=19$m=65536,t=4,p=1$eEpzUS5FeTcuOGxabDVRLg$yxL/Tvtb7+mC9I0UaGOSekEvetLB2sz0MLk5zpYOkzg', 'Eugène', 'Eugène', 'Beauchamps', '94, Chemin Du Lavarin Sud', 94230, 'CACHAN'),
(10, 'user2@balu.fr', '[]', '$argon2id$v=19$m=65536,t=4,p=1$VjF1aU5oYlcuazQ4ODBwNQ$djExqNG92r2R6Lwy4aM2xqZxtYVobIWzFTKUNjcnJ7o', 'Alacoque', 'Senneville', 'Alacoque', '55, rue du Président Roosevelt', 77176, 'SAVIGNY-LE-TEMPLE'),
(11, 'user3@balu.fr', '[]', '$argon2id$v=19$m=65536,t=4,p=1$Ui9ISzZUc3hvRlhyclhwMQ$vVF+TeFTMo5XQbh6Poc2SZWguE3isNklmgB2gi+Bk+4', 'Jolie', 'Charest', 'Jolie', '7, cours Jean Jaures', 33100, 'BORDEAUX'),
(12, 'user4@balu.fr', '[]', '$argon2id$v=19$m=65536,t=4,p=1$UWpNd2sxNGlDSUMvVDdMNg$49rj82lMJMDph2Dueaq5E8vRLwgb8kGkmg3IHMcovLg', 'Harriette', 'Bussière', 'Harriette', '10, avenue Voltaire', 78600, 'MAISONS-LAFFITTE'),
(13, 'user5@balu.fr', '[]', '$argon2id$v=19$m=65536,t=4,p=1$NGdJZjNrek1qL1g4V2xieA$ufqMZS3eZMD3bVecoTwSO1ezjaPC3rFtJSOGFpAr0fg', 'Jeoffroi', 'Tardif', 'Jeoffroi', '25, rue Victor Hugo', 60200, 'COMPIÈGNE');

-- --------------------------------------------------------

--
-- Structure de la table `migration_versions`
--

CREATE TABLE `migration_versions` (
  `version` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migration_versions`
--

INSERT INTO `migration_versions` (`version`, `executed_at`) VALUES
('20200511092500', '2020-05-11 09:27:02'),
('20200511132226', '2020-05-11 13:22:33'),
('20200512083727', '2020-05-12 08:37:37'),
('20200512144900', '2020-05-12 14:49:10'),
('20200513122127', '2020-05-13 12:21:35');

-- --------------------------------------------------------

--
-- Structure de la table `pack_ingredient`
--

CREATE TABLE `pack_ingredient` (
  `id` int(11) NOT NULL,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prix` double NOT NULL,
  `recette_id` int(11) NOT NULL,
  `quantite` double NOT NULL,
  `unite` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `pack_ingredient`
--

INSERT INTO `pack_ingredient` (`id`, `libelle`, `prix`, `recette_id`, `quantite`, `unite`) VALUES
(10, 'farine (type pâte à pain) + 100 g pour travailler la pâte', 2, 16, 350, 'g'),
(11, 'sel', 1.68, 16, 2, 'cas'),
(12, 'cuillères à soupe d\'huile d\'olive', 2, 16, 3, 'g'),
(17, 'spaghetti', 2, 18, 500, 'g'),
(18, 'oignon', 0.5, 18, 2, 'g'),
(19, 'gousses d\'ail', 0.5, 18, 2, 'g'),
(20, 'carotte', 0.5, 18, 1, 'g'),
(21, 'branche de céleri', 0, 18, 1, 'g'),
(23, 'gousses d\'ail', 2.33, 15, 500, 'g'),
(24, 'gousses d\'ail', 1.68, 15, 2, 'pcs'),
(26, 'gousses d\'ail', 1.68, 16, 2, 'g'),
(29, 'Colza', 2.33, 16, 2, 'g'),
(30, 'tasse de lardons', 0.5, 19, 1, 'pcs'),
(31, 'feuilles de brick', 1.68, 19, 4, 'pcs'),
(32, 'de crème fraîche', 1, 19, 8, 'cl'),
(33, 'pommes de terre', 0.5, 19, 2, 'pcs'),
(34, 'pâte feuilletée', 0.5, 20, 1, 'pcs'),
(35, 'tranches de jambon blanc découenné', 2, 20, 2, 'pcs'),
(36, 'emmental râpé', 0.8, 20, 40, 'g'),
(37, 'lentilles sèches', 0.5, 21, 1, 'verre'),
(38, 'verres d\'eau', 0, 21, 1, 'g'),
(39, 'cube de bouillon de légumes', 0.6, 21, 1, 'pcs'),
(40, 'carottes pelées et émincées', 1, 21, 2, 'pcs'),
(41, 'gousses d\'ail', 1.5, 20, 50, 'g'),
(42, 'Poudre F1 Pomme Épicée', 28, 22, 4, 'cas'),
(43, 'Pommes', 0.99, 22, 4, 'pcs'),
(44, 'Lait d\'amande non sucré', 2.5, 22, 25, 'cl'),
(45, 'Farine d\'épeautre complète', 3, 22, 250, 'g'),
(46, 'Oeufs', 0.99, 22, 3, 'pcs'),
(47, 'Cannelle', 2, 22, 2, 'cas'),
(48, 'Salade (mâche)', 1.6, 23, 125, 'g'),
(49, 'Lardons', 1.68, 23, 50, 'g'),
(50, 'Champignons', 0.99, 23, 10, 'pcs'),
(51, 'Olives', 2, 23, 10, 'pcs'),
(52, 'Oeuf', 0.99, 23, 1, 'pcs'),
(53, 'Tomates', 2, 23, 3, 'pcs'),
(54, 'Huile d\'olive', 2.5, 23, 10, 'cl'),
(55, 'Broccolis', 3, 24, 500, 'g'),
(56, 'Carotte, poirea', 3, 24, 100, 'g'),
(57, 'Beurre', 1.68, 24, 20, 'g'),
(58, 'Echalotes émincées', 0.99, 24, 3, 'g'),
(59, 'Poivre', 2.5, 24, 3, 'cas'),
(60, 'Sel', 0.99, 24, 2, 'cas'),
(61, 'Poulet pané', 3, 24, 10, 'pcs'),
(62, 'Courgettes', 2.5, 24, 3, 'pcs'),
(63, 'Pomme de terre', 2.5, 25, 1, 'kg'),
(64, 'Lardons fumés', 1.6, 25, 200, 'g'),
(65, 'Oignons émincés', 2.5, 25, 300, 'g'),
(66, 'Reblochon', 2.5, 25, 1, 'pcs'),
(67, 'Crème fraîche', 2, 25, 2, 'cas'),
(68, 'Vin blanc (facultatif)', 4, 25, 15, 'cl'),
(69, 'Beurre', 2.5, 25, 15, 'g'),
(70, 'gousse d’ail', 1.68, 25, 1, 'pcs'),
(71, 'Sel', 0.99, 25, 2, 'cas'),
(72, 'Poivre', 0.99, 25, 2, 'cas'),
(74, 'oignon blanc', 0.99, 26, 1, 'pcs'),
(75, 'tomates', 0.99, 26, 1, 'pcs'),
(76, '1 verre de coulis de tomate', 2.5, 26, 10, 'cl'),
(77, 'boeuf haché', 3.5, 26, 250, 'g'),
(78, 'petite boîte de haricots rouges', 2.5, 26, 1, 'pcs'),
(79, 'poivron vert', 1.6, 26, 1, 'pcs'),
(80, 'feuilles de laitue', 2.5, 26, 8, 'pcs'),
(81, 'cumin en poudre', 1.6, 26, 2, 'cas'),
(82, 'sel', 0.99, 26, 2, 'cas'),
(83, 'poivre', 0.99, 26, 2, 'cas'),
(84, 'biscuits (petits bruns émiettés)', 1.6, 27, 250, 'g'),
(85, 'beurre doux fondu', 2.5, 27, 125, 'g'),
(86, 'muscade râpée', 0.99, 27, 1, 'cas'),
(87, 'fromage blanc', 2.5, 27, 500, 'g'),
(88, 'sucre semoule', 1.6, 27, 150, 'g'),
(89, 'farine', 2.5, 27, 2, 'cas'),
(90, 'oeufs', 0.99, 27, 3, 'pcs'),
(91, 'homard', 5, 28, 1, 'pcs'),
(92, 'avocats', 2.5, 28, 4, 'pcs'),
(93, 'tomates', 0.99, 28, 2, 'pcs'),
(94, 'vermicelles', 2.5, 29, 250, 'g'),
(95, 'Oignons émincés', 1.6, 29, 3, 'pcs'),
(96, 'Oignons émincés', 1.6, 29, 3, 'pcs'),
(97, 'viande (gîte de bœuf, agneau, poulet)et 2 merguez', 6, 30, 800, 'g'),
(98, 'carottes', 2, 30, 8, 'pcs'),
(99, 'oignons', 0.99, 30, 8, 'pcs'),
(100, 'navets', 0.99, 30, 8, 'pcs'),
(101, 'poivrons verts', 1.6, 30, 2, 'pcs'),
(102, 'poivrons rouges', 0.99, 30, 2, 'pcs'),
(103, 'courgettes', 2, 30, 8, 'pcs'),
(104, 'boîte de tomates pelées (on garde le jus aussi)', 1.6, 30, 25, 'cl'),
(105, 'amandes moulus', 1.6, 31, 300, 'g'),
(106, 'sucre fin (ou sucre semoule tamisée)', 2.5, 31, 150, 'g'),
(107, 'extrait de vanille', 0.99, 31, 150, 'g'),
(108, 'amandes effilées', 1.6, 31, 80, 'g'),
(109, 'eau de fleur d\'oranger', 1.6, 31, 1, 'cas'),
(110, 'blanc d\'oeuf', 0.99, 31, 1, 'pcs'),
(111, 'cerises confites', 0.99, 31, 10, 'pcs'),
(112, 'tortillas pour tacos', 6, 26, 8, 'pcs'),
(113, 'Mascarpone Galbani', 3, 32, 500, 'g'),
(114, 'biscuits à la cuillère', 3, 32, 40, 'pcs'),
(115, 'cacao amer en poudre', 0.99, 32, 3, 'cas'),
(116, 'oeufs', 1.6, 32, 5, 'pcs'),
(117, 'café', 1.6, 32, 2, 'verre'),
(118, 'sucre', 0.99, 32, 5, 'cas'),
(119, 'Marsala', 1.6, 32, 2, 'cas'),
(120, 'bananes plantain', 2.5, 33, 6, 'pcs'),
(121, 'manioc', 1.6, 33, 1, 'pcs'),
(122, 'paquet de farine de manioc', 2.5, 33, 1, 'pcs'),
(123, 'farine', 2.6, 34, 460, 'g'),
(124, 'eau', 0.99, 34, 40, 'cl'),
(125, 'levure fraîche de boulanger', 0.99, 34, 15, 'g'),
(126, 'sel fin', 2, 34, 1, 'cas'),
(127, 'sucre en poudre', 2, 34, 100, 'g'),
(128, 'Huile de friture', 3, 34, 25, 'cl'),
(129, 'mangue fraîche coupée en dés', 2.5, 35, 4, 'pcs'),
(130, '4 boîte de mandarines en conserve', 3, 35, 28, 'cl'),
(131, '4 boîte de litchis en conserve', 2.5, 35, 58.6, 'cl'),
(132, '4 boîte de fruit du palmier en conserve', 2.5, 35, 565, 'g'),
(133, '4 boîtes de Jack fruits en conserve', 3, 35, 565, 'g'),
(134, '4 pot de Nata de coco', 2.5, 35, 450, 'g'),
(135, 'bananes', 1.6, 35, 2, 'pcs');

-- --------------------------------------------------------

--
-- Structure de la table `recette`
--

CREATE TABLE `recette` (
  `id` int(11) NOT NULL,
  `categorie_id` int(11) DEFAULT NULL,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `preparation` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `membre_id` int(11) DEFAULT NULL,
  `vente` tinyint(1) NOT NULL,
  `prix` double DEFAULT NULL,
  `cuisson` time DEFAULT NULL,
  `tpspreparation` time DEFAULT NULL,
  `nbrepersonne` int(11) DEFAULT NULL,
  `difficulte` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `souscategorie_id` int(11) DEFAULT NULL,
  `note` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `recette`
--

INSERT INTO `recette` (`id`, `categorie_id`, `titre`, `description`, `image`, `preparation`, `membre_id`, `vente`, `prix`, `cuisson`, `tpspreparation`, `nbrepersonne`, `difficulte`, `souscategorie_id`, `note`) VALUES
(15, 3, 'Pattes Carbo', 'S\'il ne devait en rester qu\'un, ce serait sûrement celui-là... Les pâtes sont l\'un de nos produits alimentaires préférés et on ne va pas s\'en cacher : on adore les pâtes ! \r\nPour les sublimer, on a de délicieuses recettes de pâtes', '66388_w600_5eb81bb3eb458.jpeg', 'Que vous aimiez les recettes de pâtes classiques et incontournables ou que vous soyez à la recherche de recettes de pâtes originales et nouvelles, vous trouverez votre bonheur ici !\r\n \r\nRéconfortantes et faciles à faire, les pâtes nous accompagnent au quotidien et ce qu\'il y a de bien avec elles, c\'est qu\'il y en a pour tous les goûts...\r\n \r\nA la viande, aux légumes, au poisson, aux herbes, au fromage... Même quand on est un peu difficile, c\'est facile de trouver une recette de pâtes qui va enchanter nos papilles ! \r\n \r\nLes possibilités et les accords sont infinis avec les recettes de pâtes, vous allez pouvoir vous en rendre compte dans ce diaporama avec nos 40 meilleures recettes de pâtes !\r\n \r\nOn commence avec la véritable recette de la carbonara...', 1, 1, 4.01, '12:10:00', '00:40:00', 4, 'Intermediaire', 2, 4.5),
(16, 3, 'Pâte à pizza épaisse et moelleuse', 'Cette recette a fait sensation auprès de tout mes amis et toute ma famille. Je vous garantie que vous n\'acheterez plus de pizza surgelée, même à votre pizzaiolo préféré !', 'recette6_5eb7c82719216.png', 'Mettre 350 g de farine dans un grand saladier puis ajouter successivement le sel, la levure boulangère et l\'huile d\'olive.\r\nVerser petit à petit l\'eau tiède tout en mélangeant avec une cuillère en bois.\r\nRemuer longuement jusqu\'à obtention d\'une pâte qui se détache du saladier.\r\nLaisser reposer la pâte pendant 1h en couvrant le saladier avec un torchon dans un endroit chaud.\r\nAprès le temps de repos, déposer de la farine sur votre plan de travail y déposer la pâte à pizza.\r\nLa travailler comme on travaillerait une pâte à pain.\r\nFaçonner votre pizza aux dimensions de votre plaque à four où l\'idéal, c\'est de déposer la pâte sur du papier cuisson.\r\nAgrémenter votre pizza au grès de vos envies ou de vos restes dans le frigo.', 1, 1, 9.69, '00:30:00', '01:08:00', 5, 'Facile', 1, NULL),
(18, 3, 'Spaghetti bolognaise', 'Hachez l\'ail, l\'oignon, puis coupez la carotte et le céleri en petits dés (enlevez les principales nervures du céleri).', '66388_w600_5eb7fe176bb74.jpeg', 'Hachez l\'ail, l\'oignon, puis coupez la carotte et le céleri en petits dés (enlevez les principales nervures du céleri).\r\nFaites chauffer l\'huile dans une casserole assez grande. Faites revenir l\'ail, l\'oignon, la carotte et le céleri à feu doux pendant 5 min en remuant.\r\nAugmenter la flamme, puis ajoutez le boeuf. Faites brunir et remuez de façon à ce que la viande ne fasse pas de gros paquets.\r\nAjoutez le bouillon, le vin rouge, les tomates préalablement coupées assez grossièrement, le sucre et le persil haché. Portez à ébullition.\r\nBaisser ensuite le feu et laissez mijoter à couvert 1h à 1h30, de façon à ce que le vin s\'évapore.\r\nFaites cuire les spaghetti, puis mettez-les dans un plat.', 5, 1, 3.5, '00:18:06', NULL, NULL, NULL, NULL, 7.3333333333333),
(19, 4, 'Nemiflette', 'Je ressemble à un petit nem, tout en ayant le goût savoureux de la tartiflette… je suis ? Une nemiflette, bien sûr ! Si vous connaissez ces gourmandises salées enveloppées dans des feuilles de bricks, vous allez adorer cette version aux pommes de terre qui troque les lardons contre du bacon… Elle cartonne ;)', 'i151341-nemiflettes-par-fast-oche_5eb8e9c7dbec7_5ec2d727e9e9f.jpeg', 'ÉTAPE 1\r\nCiseler les oignons.\r\n\r\nÉTAPE 2\r\nDans un peu d’huile, faire revenir les oignons et les lardons en mélangeant jusqu’à ce que les oignons soient bien dorés.\r\n\r\nÉTAPE 3\r\nAjouter la crème fraîche dans la poêle. Saler et poivrer puis retirer du feu.\r\n\r\nÉTAPE 4\r\nCouper les pommes de terre en dés et les faire bouillir pendant 10 minutes dans de l’eau bouillante.\r\n\r\nÉTAPE 5\r\nPrendre une feuille de brick et superposer au milieu des pommes de terres, des tranches de Reblochon et la préparation aux lardons.\r\n\r\nÉTAPE 6\r\nRouler la feuille de manière à faire un nem.\r\n\r\nÉTAPE 7\r\nRépéter l’opération avec les feuilles de bricks restantes.\r\n\r\nÉTAPE 8\r\nPréchauffer le four à 200°C et enfourner les nemiflettes pendant 10 minutes.', 3, 1, 3.68, '00:25:00', '00:16:00', 5, 'Facile', 1, NULL),
(20, 1, 'Mini croissant au jambon', 'Mini croissant au jambon Je ressemble à un petit nem, tout en ayant le goût savoureux de la tar.', 'i48471-minis-croissants-au-jambon_5eb8ec0dbb85c.jpeg', 'ÉTAPE 1\r\nPréchauffez le four à 200 °C.\r\n\r\nÉTAPE 2\r\nCouvrez de papier sulfurisé une plaque de cuisson.\r\n\r\nÉTAPE 3\r\nÉtalez la pâte feuilletée sur un plan de travail fariné. Découpez-la en 16 parts égales.\r\n\r\nÉTAPE 4\r\nEnsuite, tranchez aussi les tranches de jambon découenné en 16 petites lamelles.\r\n\r\nÉTAPE 5\r\nDéposez une lamelle de jambon sur chaque triangle de pâte feuilletée. Parsemez chaque triangle de pâte au jambon d\'emmental râpé.\r\n\r\nÉTAPE 6\r\nRoulez les triangles de pâte sur eux-même, de la partie la plus étroite vers la partie la plus large, pour former les minis croissants.\r\n\r\nÉTAPE 7\r\nPlacez les mini croissants sur la plaque de four recouverte de papier cuisson. Enfournez pendant 20 minutes jusqu\'à ce que les mini croissants soient bien dorés.\r\n\r\nÉTAPE 8\r\nA la sortie du four, laissez tiédir les mini croissants au jambon sur une grille.\r\n\r\nÉTAPE 9\r\nEnsuite, décollez-les de la plaque et placez-les sur un plat de service.\r\n\r\nÉTAPE 10\r\nDégustez tiède ou froid à l\'apéritif.', 6, 1, 4.8, '00:15:00', '01:00:00', 4, 'Facile', NULL, NULL),
(21, 8, 'Boulettes végétariennes', 'À la recherche d\'une recette pour diminuer la quantité de viande tout en gardant le plaisir de manger? Votre enfant n\'aime manger qu\'avec les mains ? Des boulettes végétariennes passeront dans des plats traditionnels comme des spaghettis ou pourront se déguster dans des fajitas ou simplement à la main lors d\'un pique-nique! Venez découvrir mes autres recettes', 'recette6_5ec2d5733fbb3.png', 'PRÉPARATION\r\nÉTAPE 1\r\nPréparez les lentilles : mettez les lentilles, le millet, les carottes, l\'eau et le bouillon dans une casserole. Ajoutez la feuille de laurier et chauffez à feu moyen jusqu\'à évaporation. Remuez de temps en temps durant la cuisson. Retirez la feuille de laurier et ajoutez l\'ail en poudre.\r\n\r\nÉTAPE 2\r\nDans un saladier, émiettez le pain et le faites-le ramollir avec le lait. Ajoutez les lentilles, le basilic et le parmesan. Mixez avec un mixeur plongeant.\r\n\r\nÉTAPE 3\r\nFormez des boulettes dans vos mains (si la pâte est trop collante, rajoutez du parmesan râpé ou un tout petit peu de farine). Déposez les boulettes végétariennes sur une plaque de four recouverte de papier sulfurisé.\r\n\r\nÉTAPE 4\r\nEnfournez 30 minutes à 180°C. Retournez une ou deux fois durant la cuisson vos boulettes végétariennes.', 6, 1, 2.1, '01:01:00', '02:00:00', 5, 'Intermediaire', 1, 5.3333333333333),
(22, 1, 'Tarte aux pommes Herbalife', 'Quoi de mieux que l\'odeur d\'une tarte aux pommes chaude ? Une tarte aux pommes chaude avec une recette équilibrée et préparée avec la nouvelle F1 Pomme épicée ! Cette délicieuse pâtisserie est à déguster le dimanche après une belle promenade en forêt, tout simplement pendant le goûter.', 'Canva_-_Mexican_Tartelette_on_Wooden_Background_5ec2d73f46340.jpeg', 'Préchauffer le four à 200 degrés. Eplucher deux pommes et découper les en morceaux. Mettre les pommes dans un bol avec les raisins secs, la cannelle et le miel, puis bien mélanger. Mettre ensuite la F1, la farine, la levure, les œufs, les dattes, le lait d\'amande, le miel et l\'huile d\'olive dans un robot de cuisine. Transformez-le tout en une pâte lisse. Ensuite, joindre les deux mélanges ensemble et bien mélanger. Recouvrir un moule à tarte de de papier sulfurisé, n’oubliez pas de bien couvrir le fond et les côtés du moule. Versez la pâte dans le moule et pressez-la légèrement dans le fond. Couper la troisième pomme en tranches et la déposez-les sur la tarte. Faire cuire la tarte pendant 35 minutes et vérifier à l\'aide d\'une brochette si elle est bien cuite. La brochette reste sèche ? Votre tarte est alors prête à être servie !', 8, 1, 37.48, '00:30:00', '00:25:00', 8, 'Facile', 1, 9),
(23, 1, 'Salade aux lardons avec oeuf', 'Une petite spécialité brétignolaise avec la touche Titou', 'salade_lardon_5ec2d7c8d76a8.png', 'Verser la salade (mâche) dans un récipient. Ajouter champignons, lardons, tomates et oignons en poudre. Versez en dernier un oeuf. Et le tour est joué !', 12, 1, 11.76, '00:00:00', '00:30:00', 2, 'Facile', 1, NULL),
(24, 1, 'Purée de brocolis pommes de terre, poulet pâné et courgettes', 'Découvrez ce plat venu de la Méditerrannée, l\'oeuvre de Gaby Jessica Jade Grège hihi !!!!!', 'puree_brocoli_5ec2d80d342fb.png', 'Pour la purée de brocolis : \r\n\r\n1) Préparez les brocolis, lavez-les et détachez-les en bouquets.\r\nEpluchez les tiges de brocolis et coupez-les en petits dés.\r\n2) Lavez les légumes, coupez-les en dés.\r\n3) Dans un faitout, faites revenir les dés de légumes et les échalotes émincées dans le beurre. Ajoutez les brocolis, on peut rajouter si on le souhaite des fines herbes.\r\nCouvrez de bouillon et portez à ébullition.\r\n4) Lorsqu\'ils sont cuits, écrasez les légumes sans le bouillon en les passant au presse-légumes, et incorporez la crème.\r\nFaites réchauffer 5 mn sur feu doux, salez, poivrez et dégustez !\r\n\r\nPour les courgettes, découpez-les et mettez dans une poêle huilée. Remuez pendant 15min et c\'est bon !\r\n\r\nPour les nuggets, voir au dos de l\'emballage lol', 13, 1, 17.66, '00:00:00', '00:59:00', 3, 'Intermediaire', 2, 9),
(25, 4, 'Mexican Tartelette', 'Une bonne tarte à déguster venant tout droit du pays des Aztèques', 'tartelette_5ec2d8b576641.png', 'ACTUALITÉ\r\nAccueil  Magazine  Recettes  Tartiflette maison, une recette réconfortante et savoureuse\r\nTartiflette maison, une recette réconfortante et savoureuse\r\nPARTAGER SUR    \r\n\r\nfrench tartiflette, potato, bacon and reblochon - Peugeot Saveurs\r\nIngrédients\r\n\r\n1 kg de pomme de terre\r\n200g de lardons fumés\r\n300g d’oignons émincés\r\n1 reblochon\r\n2 cuillères à soupe de crème fraîche\r\n15 cl de vin blanc (facultatif)\r\n15g de beurre\r\n1 gousse d’ail\r\nSel\r\nPoivre\r\nMuscade\r\nInstruments du goût\r\n\r\nMoulin à poivre Madras\r\nMoulin à sel Madras\r\nMoulin à muscade Madras\r\nPlat Peugeot\r\nPréparation\r\n\r\nPréchauffer le four à 200°C (th.6-7)\r\nÉplucher les pommes de terre et les couper en gros dés. Les plonger dans une casserole d’eau salée. Porter à ébullition et laisser cuire jusqu’à ce qu’elles soient tendres.\r\nÉmincer les oignons et les faire fondre 5 min dans le beurre à feu vif, ajouter les lardons et faire revenir 5 min.\r\nAjouter les pommes de terre et faire rissoler 5 à 10 min. Ajouter le vin blanc en laissant évaporer quelques secondes, saler et poivrer.\r\nPréparer un plat à gratin en frottant le fond et les bords avec la gousse d’ail épluchée. Verser le tout dans le plat, ajouter un peu de muscade.\r\nÉtaler la crème fraîche sur le dessus\r\nCouper le reblochon en deux ou en quatre. Disposer les morceaux sur le dessus.\r\nEnfourner pour environ 20 min de cuisson', 8, 1, 21.26, '00:36:00', '01:05:00', 4, 'Intermediaire', 1, NULL),
(26, 4, 'Tacos', 'Un taco est un antojito de la cuisine mexicaine qui se compose d\'une tortilla de maïs repliée ou enroulée sur elle-même contenant presque toujours une garniture le plus souvent à base de viande, de sauce, d\'oignon et de coriandre fraîche hachée. Les tacos se mangent généralement sans couverts, avec les doigts.', 'tacos_5ec2d8c7cb440.png', 'A la poêle, faire dorer l\'oignon émincé dans un peu d\'huile d\'olive.  Rajouter la viande, assaisonner et laisser cuire 5 min.  Laver les feuilles de laitue.  Couper les tomates et le poivron en petits dés. Incorporer le tout à la poêlée avec le coulis de tomate, et poursuivre la cuisson pendant 5 min.  Egoutter les haricots rouges et les ajouter 2 min avant la fin de cuisson.  Hors du feu, ajuster l\'assaisonnement et saupoudrer généreusement de cumin; on peut aussi rajouter quelques gouttes de Tabasco.  Garnir les tortillas de préparation et les refermer en les roulant comme des crêpes. Disposer 1 feuille de laitue sur chaque tacos avant de servir.', 9, 1, 24.16, '00:55:00', '00:30:00', 4, 'Facile', 2, NULL),
(27, 4, 'Dessert in White bowl', 'Fromage blanc, coulis de fraise, miam miam', 'whitebowl_5ec2d8d740529.png', 'Préchauffez le four à 180°C (thermostat 6).\r\nTapissez de papier sulfurisé et préalablement beurré un moule de 23 cm de diamètre. Idéalement, le fond du moule doit être amovible, sinon, laissez bien dépasser le papier pour démouler facilement le gâteau en tirant dessus.\r\nMélangez les biscuits, la muscade et le beurre fondu.\r\nTapissez le fond du moule de ce mélange en tassant bien avec le dos d\'une cuillère. Placez au réfrigérateur.\r\nBattez la faisselle au fouet jusqu\'à ce qu\'elle soit lisse, puis ajoutez le sucre et la farine et les oeufs un par un.\r\nAjoutez ensuite la crème et le parfum de votre choix.\r\nVersez cette préparation sur la croûte biscuitée (si la croûte \"dépasse\" de la crème, enlevez le surplus à la cuillère, cela risque de brûler).\r\nEnfournez pour 50-55 minutes de cuisson jusqu\'à ce que la préparation au fromage soit ferme au toucher.\r\nLaissez refroidir, démoulez et servez frais.', 11, 1, 12.68, '01:15:00', '00:30:00', 8, 'Facile', 3, NULL),
(28, 6, 'Homards et avocats', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'homardavocat_5ec2dbfbda718.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 8, 0, 8.49, '00:08:00', '01:06:00', 6, 'Difficile', 1, NULL),
(29, 6, 'Asian Dish', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'asiandishe_5ec2dc0cd19e6.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 8, 1, 5.7, '00:55:00', '01:07:00', 6, 'Difficile', 2, NULL),
(30, 8, 'Coucous marocain', 'La viande et les légumes sont très fondantes, bien cuites. La semoule est meilleure préparée ainsi, elle est plus digeste et légère sans oublier qu\'elle dévoile de bonnes saveurs apportées par le bouillon.', 'couscous_5ec2dc2d63333.png', 'Faire revenir les oignons et les retirer quand ils sont dorés\r\n- Faire revenir toutes les viandes, sauf les merguez, que l\'on cuira au dernier moment. Réserver.\r\n- Dans le faitout, ajouter un peu d\'huile d\'olive et faire revenir tous les légumes sauf les courgettes et les pois chiches s\'ils sont cuits/en conserve. Ajouter les tomates coupées, puis leur jus.\r\n- A ce stade, on ajoute les épices, dont la quantité est à ajuster au goût de chacun... Mais on trouve des épices à couscous tout prêts', 11, 1, 16.17, '01:15:00', '01:16:00', 3, 'Intermediaire', 2, NULL),
(31, 8, 'Mchewek', 'Le mchewek, ou m\'chewek, est une pâtisserie traditionnelle raffinée, sans farine, typique de la ville d\'Alger qui signifie, en argot algérois, « épineux1 ».  Gâteau phare de la capitale algérienne avec le tcharak, le mchewek est une sorte de petit four en forme de petit rocher, à base de poudre d\'amandes mélangée à des œufs et du sucre, parfumée au zeste de citron ou à la vanille.', 'mchewek_5ec2dc3ddb9ce.png', 'La préparation est enrobée dans des amandes émondées, concassées ou effilées, plaquées comme des écailles, donnant ainsi un aspect épineux à ce gâteau, d\'où son nom en arabe algérien, mchewek.\r\n\r\nPour le décor, une cerise rouge confite ou une amande surmonte le gâteau, rappelant ainsi le passé ottoman de la ville et le raffinement typique de ses douceurs.', 8, 0, 10.27, '01:06:00', '00:40:00', 8, 'Intermediaire', 3, NULL),
(32, 3, 'Tiramisu à l\'italienne', 'Réalisé à partir de mascarpone et sublimé par un délicieux goût de café et de cacao de qualité, le tiramisu se pose aujourd’hui comme l’un des desserts incontournable de la gastronomie italienne. Connu dans le monde entier et pouvant être servi en verrine ou dans un plat à partager, ce dessert fait aujourd’hui le bonheur des petits et des grands gourmands de tous les pays du monde.', 'tiramisu_5ec2dc543a6c4.png', 'Commencez par séparer les blancs d’œufs des jaunes.\r\nDans un saladier, fouetter les jaunes d’œufs avec le sucre jusqu’à ce que le mélange blanchisse.\r\nIncorporez le mascarpone dans le mélange de jaunes d’œufs et de sucre et mélangez.\r\nMontez à présent les blancs d’œufs en neige.\r\nIncorporez délicatement les blancs d’œufs dans la préparation au mascarpone Galbani.\r\nDans une assiette creuse, mélangez le café refroidi et le marsala*.\r\nTrempez-y rapidement les biscuits à la cuillère.\r\nDans le fond d’un plat, disposez la moitié des biscuits imbibés.\r\nRecouvrez ensuite avec la moitié de la préparation aux œufs et au mascarpone.\r\nPlacez ensuite le reste des biscuits puis terminez par le reste de la préparation.\r\nPlacez votre plat au réfrigérateur et laissez reposer pendant 3 à 12 heures.\r\nJuste avant de servir, saupoudrez votre tiramisu avec le cacao en poudre à l’aide d’un tamis.', 6, 1, 12.78, '00:00:00', '00:20:00', NULL, 'Facile', 3, NULL),
(33, 7, 'Foufou de banane', 'Le foufou ou fufu est une pâte comestible, solide ou molle selon le goût du consommateur, réalisée à partir de farines ou tubercules bouillies et pilées. C’est un aliment de base pour de nombreuses populations d’Afrique équatoriale. Il est fabriqué à partir de manioc, de maïs, de banane plantain ou d\'igname et se mange avec une sauce en accompagnement. C\'est un plat très apprécié dans toute l’Afrique surtout en Afrique de l\'Ouest.', 'foufou_5ec2dc6795dd5.png', 'Faire cuire les bananes et le manioc épluchés à la vapeur, les piler au mortier (ou au robot).\r\nRajouter de la farine de manioc pour obtenir la consistance désirée.\r\nEn général, on forme des grosses boules type pâton avec le foutou, qu\'on sert ensuite en accompagnement d\'une sauce. On peut le préparer d\'avance et le réchauffer à la vapeur.', 11, 0, 6.6, '00:20:00', '01:00:00', 6, 'Intermediaire', 2, NULL),
(34, 7, 'Beignets', 'Selon les pays, ces beignets prennent des appellations variées : botokoin au Togo, puff puff au Nigeria, mikate au Congo démocratique, Gbofloto en Côte d’Ivoire, bofrot au Ghana ou encore BHB au Cameroun. Faciles et rapides à confectionner, ils sont traditionnellement consommés avec des mets de salés ou tout simplement saupoudrés de sucre.', 'botokoin_5ec2dce5050c8.png', 'Émiettez la levure de boulanger dans un bol. Ajoutez l\'eau et 1 c. à café de sucre en poudre. Mélangez et réservez.\r\nVersez la farine, le sel et le reste de sucre dans un saladier. Mélangez le tout avec une cuillère en bois. Creusez un puits au centre. Versez-y la préparation à la levure. Pétrissez la pâte à la main jusqu\'à obtention d\'une boule homogène et légèrement élastique. Couvrez le saladier d\'un linge propre et laissez reposer la pâte à température ambiante jusqu\'à ce qu\'elle double de volume.\r\nFaites chauffer l\'huile dans votre friteuse ou dans une grande poêle. Prélevez un peu de pâte à l\'aide d\'une cuillère. Formez une petite boulette et plongez-la dans l\'huile chaude avec précaution. Renouvelez l\'opération. Faites cuire les beignets quelques minutes jusqu\'à ce qu\'ils soient bien dorés. Égouttez les beignets et disposez-les sur du papier absorbant. Servez ces beignets africains tièdes ou froids.', 5, 1, 11.58, '00:05:00', '01:00:00', 8, 'Facile', 3, NULL),
(35, 6, 'Salade de fruits exotiques (asiatique)', 'Une délicieuse salade de fruits bien exotiques avec des fruits abondamment utilisé au Viêtnam.', 'salade_de_fruit_5ec2d9faaaaaa.png', 'Peler et couper la mangue en petits dés. Mettre dans un grand bol.\r\nPeler et couper la moitié d\'un ananas en petits morceaux.\r\nAjouter la boîte de mandarines sans son liquide.\r\nCouper les litchis en deux et verser dans le bol avec son liquide. Ajouter les fruits du palmier et son liquide.\r\nAjouter le Jack fruit en le défaisant en fines lanières avec son jus.\r\nAjouter enfin les petits cubes de coco et son liquide.', 9, 1, 17.6, '00:00:00', '00:20:00', 10, 'Facile', 1, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `souscategorie`
--

CREATE TABLE `souscategorie` (
  `id` int(11) NOT NULL,
  `souscategorie` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `souscategorie`
--

INSERT INTO `souscategorie` (`id`, `souscategorie`) VALUES
(1, 'Entrée'),
(2, 'Plat'),
(3, 'Dessert');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_6EEAA67D6A99F74A` (`membre_id`);

--
-- Index pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_67F068BC89312FE9` (`recette_id`),
  ADD KEY `IDX_67F068BC6A99F74A` (`membre_id`);

--
-- Index pour la table `detailcommande`
--
ALTER TABLE `detailcommande`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_7D6DC7D582EA2E54` (`commande_id`),
  ADD KEY `IDX_7D6DC7D589312FE9` (`recette_id`);

--
-- Index pour la table `membre`
--
ALTER TABLE `membre`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_F6B4FB29E7927C74` (`email`);

--
-- Index pour la table `migration_versions`
--
ALTER TABLE `migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `pack_ingredient`
--
ALTER TABLE `pack_ingredient`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_49C7F06689312FE9` (`recette_id`);

--
-- Index pour la table `recette`
--
ALTER TABLE `recette`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_49BB6390BCF5E72D` (`categorie_id`),
  ADD KEY `IDX_49BB63906A99F74A` (`membre_id`),
  ADD KEY `IDX_49BB6390A27126E0` (`souscategorie_id`);

--
-- Index pour la table `souscategorie`
--
ALTER TABLE `souscategorie`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT pour la table `commentaire`
--
ALTER TABLE `commentaire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `detailcommande`
--
ALTER TABLE `detailcommande`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT pour la table `membre`
--
ALTER TABLE `membre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `pack_ingredient`
--
ALTER TABLE `pack_ingredient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;

--
-- AUTO_INCREMENT pour la table `recette`
--
ALTER TABLE `recette`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT pour la table `souscategorie`
--
ALTER TABLE `souscategorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `FK_6EEAA67D6A99F74A` FOREIGN KEY (`membre_id`) REFERENCES `membre` (`id`);

--
-- Contraintes pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD CONSTRAINT `FK_67F068BC6A99F74A` FOREIGN KEY (`membre_id`) REFERENCES `membre` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_67F068BC89312FE9` FOREIGN KEY (`recette_id`) REFERENCES `recette` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `detailcommande`
--
ALTER TABLE `detailcommande`
  ADD CONSTRAINT `FK_7D6DC7D582EA2E54` FOREIGN KEY (`commande_id`) REFERENCES `commande` (`id`),
  ADD CONSTRAINT `FK_7D6DC7D589312FE9` FOREIGN KEY (`recette_id`) REFERENCES `recette` (`id`);

--
-- Contraintes pour la table `pack_ingredient`
--
ALTER TABLE `pack_ingredient`
  ADD CONSTRAINT `FK_49C7F06689312FE9` FOREIGN KEY (`recette_id`) REFERENCES `recette` (`id`);

--
-- Contraintes pour la table `recette`
--
ALTER TABLE `recette`
  ADD CONSTRAINT `FK_49BB63906A99F74A` FOREIGN KEY (`membre_id`) REFERENCES `membre` (`id`),
  ADD CONSTRAINT `FK_49BB6390A27126E0` FOREIGN KEY (`souscategorie_id`) REFERENCES `souscategorie` (`id`),
  ADD CONSTRAINT `FK_49BB6390BCF5E72D` FOREIGN KEY (`categorie_id`) REFERENCES `categorie` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
