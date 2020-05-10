-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : Dim 10 mai 2020 à 14:32
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
  `categorie` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id`, `categorie`) VALUES
(1, 'Cuisines Française'),
(3, 'Cuisines Italiennes');

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
(23, 5.68, '2020-05-10 12:33:32', 'En cours', 7);

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
(28, 23, 16, 1, 5.68);

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
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `membre`
--

INSERT INTO `membre` (`id`, `email`, `roles`, `password`, `pseudo`, `nom`, `prenom`, `adresse`) VALUES
(1, 'admin1@balu.fr', '[\"ROLE_ADMIN\"]', '$argon2id$v=19$m=65536,t=4,p=1$bDRwN1J2WjFYZ0VBZ2lucQ$l64/GNR9ijXJ8pYFR98mgUe6bSsjEBvS4aMpecuHl98', 'admin1', 'Admin', 'Admin', '6 rue du fake adresse 92100'),
(3, 'admin3@balu.fr', '[\"ROLE_ADMIN\"]', '$argon2id$v=19$m=65536,t=4,p=1$ZlczZnQ5MWlkRlppS3hDWA$Qy9Vkg7MGHqgLU8TmF75k9qQk6QgowsRLQSuA5uoty8', 'balu', 'balu', 'balu', 'balu'),
(5, 'manu.macron@balu.fr', '[]', '$argon2id$v=19$m=65536,t=4,p=1$dFp0cXMyMUM0RDdVMnc1VA$XFX/XONBYDLb3v/aU05Y6e6TaoxTjWLXcGiUjeB8YWw', 'balu', 'MACRON', 'Emmanuel', 'Elisé'),
(6, 'edouard.phillipe@balu.fr', '{\"1\":\"ROLE_USER\"}', '$argon2id$v=19$m=65536,t=4,p=1$Yk1HN3JJS25nbnkvYk53VA$A7ObXQeLnlbqJraA2ZBwW8Uhb2Ii4XcyceMBT9WNyao', 'Edouard.P', 'PHILLIPE', 'Edouard', 'Matignon'),
(7, 'Jeanbalu@balu.fr', '[]', '$argon2id$v=19$m=65536,t=4,p=1$eHdWUGliM213UEJMY01aYQ$PA2dIkUxmdyN5wYGe2wLWn3vDLhHQ6h+1vsvJHRrEsY', 'Jeanbalu', 'BERTRAND', 'Jean', '361 Av Charles de Gaulle, Paris'),
(8, 'admin10@balu.fr', '[\"ROLE_ADMIN\"]', '$argon2id$v=19$m=65536,t=4,p=1$T25LelRJaUxzZHZIZU5yMA$eLxoi70ZOb10NKBSqmRUTRmvG06e0TD4Z+HjfDOV/Vg', 'admin10', 'MoiAdmin', 'MonPrenom Admin', '20 impasse du fake adresse, Brest');

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
('20200508184759', '2020-05-08 18:51:37'),
('20200508190455', '2020-05-08 19:05:05'),
('20200508190640', '2020-05-08 19:06:48'),
('20200508210747', '2020-05-08 21:08:07'),
('20200509195246', '2020-05-09 19:53:01'),
('20200509212739', '2020-05-09 21:27:47');

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
(8, 'Pattes', 1.68, 15, 500, 'g'),
(9, 'Sel', 0.5, 15, 20, 'g'),
(10, 'farine (type pâte à pain) + 100 g pour travailler la pâte', 2, 16, 350, 'g'),
(11, 'sel', 1.68, 16, 2, 'cas'),
(12, 'cuillères à soupe d\'huile d\'olive', 2, 16, 3, 'g'),
(13, 'chair à saucisse', 3.5, 17, 500, 'g'),
(14, 'tomates (ou 8 petites)', 2.33, 17, 4, 'g'),
(15, 'oignons', 1, 17, 3, 'g'),
(16, 'gousses d\'ail', 1, 17, 2, 'g');

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
  `prix` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `recette`
--

INSERT INTO `recette` (`id`, `categorie_id`, `titre`, `description`, `image`, `preparation`, `membre_id`, `vente`, `prix`) VALUES
(15, 1, 'Pattes', 'S\'il ne devait en rester qu\'un, ce serait sûrement celui-là... Les pâtes sont l\'un de nos produits alimentaires préférés et on ne va pas s\'en cacher : on adore les pâtes ! \r\nPour les sublimer, on a de délicieuses recettes de pâtes', 'recette2_5eb7bc1f41142.png', 'Que vous aimiez les recettes de pâtes classiques et incontournables ou que vous soyez à la recherche de recettes de pâtes originales et nouvelles, vous trouverez votre bonheur ici !\r\n \r\nRéconfortantes et faciles à faire, les pâtes nous accompagnent au quotidien et ce qu\'il y a de bien avec elles, c\'est qu\'il y en a pour tous les goûts...\r\n \r\nA la viande, aux légumes, au poisson, aux herbes, au fromage... Même quand on est un peu difficile, c\'est facile de trouver une recette de pâtes qui va enchanter nos papilles ! \r\n \r\nLes possibilités et les accords sont infinis avec les recettes de pâtes, vous allez pouvoir vous en rendre compte dans ce diaporama avec nos 40 meilleures recettes de pâtes !\r\n \r\nOn commence avec la véritable recette de la carbonara...', 1, 0, 2.18),
(16, 3, 'Pâte à pizza épaisse et moelleuse', 'Cette recette a fait sensation auprès de tout mes amis et toute ma famille. Je vous garantie que vous n\'acheterez plus de pizza surgelée, même à votre pizzaiolo préféré !', 'recette6_5eb7c82719216.png', 'Mettre 350 g de farine dans un grand saladier puis ajouter successivement le sel, la levure boulangère et l\'huile d\'olive.\r\nVerser petit à petit l\'eau tiède tout en mélangeant avec une cuillère en bois.\r\nRemuer longuement jusqu\'à obtention d\'une pâte qui se détache du saladier.\r\nLaisser reposer la pâte pendant 1h en couvrant le saladier avec un torchon dans un endroit chaud.\r\nAprès le temps de repos, déposer de la farine sur votre plan de travail y déposer la pâte à pizza.\r\nLa travailler comme on travaillerait une pâte à pain.\r\nFaçonner votre pizza aux dimensions de votre plaque à four où l\'idéal, c\'est de déposer la pâte sur du papier cuisson.\r\nAgrémenter votre pizza au grès de vos envies ou de vos restes dans le frigo.', 1, 0, 5.68),
(17, 1, 'Tomates farcies facile', 'Eplucher et hacher les oignons. Eplucher et hacher les gousses d\'ail.\r\nMettre la moitié des oignons dans la chair à saucisse. Ajouter l\'ail, le sel, le poivre et un peu de persil.', '73069_w600cxt0cyt0cxb3888cyb2585_5eb7d8df30620.jpeg', 'Eplucher et hacher les oignons. Eplucher et hacher les gousses d\'ail.\r\nMettre la moitié des oignons dans la chair à saucisse. Ajouter l\'ail, le sel, le poivre et un peu de persil.\r\nCouper le haut des tomates et les évider. Poivrer et saler l\'intérieur. Mettre la farce à l\'intérieur et remettre les chapeaux.\r\nMettre le reste des oignons dans un plat avec la chair des tomates.\r\nMettre les tomates farcies dans le plat. Parsemez d\'un peu de thym et mette une noisette de beurre sur chaque tomates. Faire cuire au four chaud à 180°C (thermostat 6) pendant 1 heure environ.\r\nServir avec du riz.', 7, 0, 7.83);

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
  ADD KEY `IDX_49BB63906A99F74A` (`membre_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT pour la table `commentaire`
--
ALTER TABLE `commentaire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `detailcommande`
--
ALTER TABLE `detailcommande`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT pour la table `membre`
--
ALTER TABLE `membre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `pack_ingredient`
--
ALTER TABLE `pack_ingredient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `recette`
--
ALTER TABLE `recette`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

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
  ADD CONSTRAINT `FK_67F068BC6A99F74A` FOREIGN KEY (`membre_id`) REFERENCES `membre` (`id`),
  ADD CONSTRAINT `FK_67F068BC89312FE9` FOREIGN KEY (`recette_id`) REFERENCES `recette` (`id`);

--
-- Contraintes pour la table `detailcommande`
--
ALTER TABLE `detailcommande`
  ADD CONSTRAINT `FK_7D6DC7D582EA2E54` FOREIGN KEY (`commande_id`) REFERENCES `commande` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_7D6DC7D589312FE9` FOREIGN KEY (`recette_id`) REFERENCES `recette` (`id`);

--
-- Contraintes pour la table `pack_ingredient`
--
ALTER TABLE `pack_ingredient`
  ADD CONSTRAINT `FK_49C7F06689312FE9` FOREIGN KEY (`recette_id`) REFERENCES `recette` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `recette`
--
ALTER TABLE `recette`
  ADD CONSTRAINT `FK_49BB63906A99F74A` FOREIGN KEY (`membre_id`) REFERENCES `membre` (`id`),
  ADD CONSTRAINT `FK_49BB6390BCF5E72D` FOREIGN KEY (`categorie_id`) REFERENCES `categorie` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
