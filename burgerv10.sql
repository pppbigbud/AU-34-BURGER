-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 21 oct. 2022 à 07:13
-- Version du serveur : 8.0.30
-- Version de PHP : 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `burgerv10`
--

-- --------------------------------------------------------

--
-- Structure de la table `burger`
--

DROP TABLE IF EXISTS `burger`;
CREATE TABLE IF NOT EXISTS `burger` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` int DEFAULT NULL,
  `img` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `burger`
--

INSERT INTO `burger` (`id`, `name`, `description`, `price`, `img`) VALUES
(1, 'CheesBurger', 'Salade, Tomate, Oignon et d\'autres choses mais c\'est histoire d\'écrire un truc', 7, 'cheesburger.png'),
(2, 'CheesBurger', 'Salade, Tomate, Oignon et d\'autres choses mais c\'est histoire d\'écrire un truc', 9, 'cheesburger.png'),
(3, 'Le pollo', 'Salade, Tomate, Oignon et d\'autres choses mais c\'est histoire d\'écrire un truc', 11, 'lePolo.png'),
(4, 'TagadaBurger', 'Salade, Tomate, Oignon et d\'autres choses mais c\'est histoire d\'écrire un truc', 9, 'lePolo.png');

-- --------------------------------------------------------

--
-- Structure de la table `cheese`
--

DROP TABLE IF EXISTS `cheese`;
CREATE TABLE IF NOT EXISTS `cheese` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `cheese`
--

INSERT INTO `cheese` (`id`, `name`) VALUES
(1, 'bleu'),
(2, 'cheddar'),
(3, 'Fourme');

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20221018053711', '2022-10-18 05:37:33', 46),
('DoctrineMigrations\\Version20221018053941', '2022-10-18 05:39:47', 68),
('DoctrineMigrations\\Version20221018054410', '2022-10-18 05:44:18', 205),
('DoctrineMigrations\\Version20221020071420', '2022-10-20 07:14:58', 84);

-- --------------------------------------------------------

--
-- Structure de la table `meat`
--

DROP TABLE IF EXISTS `meat`;
CREATE TABLE IF NOT EXISTS `meat` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `meat`
--

INSERT INTO `meat` (`id`, `name`, `price`) VALUES
(1, 'Boeuf', 5),
(2, 'Poulet', 5),
(3, 'Végétarien', 3);

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

DROP TABLE IF EXISTS `messenger_messages`;
CREATE TABLE IF NOT EXISTS `messenger_messages` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  KEY `IDX_75EA56E016BA31DB` (`delivered_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `sauce`
--

DROP TABLE IF EXISTS `sauce`;
CREATE TABLE IF NOT EXISTS `sauce` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `sauce`
--

INSERT INTO `sauce` (`id`, `name`) VALUES
(1, 'Mayo'),
(2, 'Ketchup'),
(3, 'Moutarde');

-- --------------------------------------------------------

--
-- Structure de la table `size`
--

DROP TABLE IF EXISTS `size`;
CREATE TABLE IF NOT EXISTS `size` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `size`
--

INSERT INTO `size` (`id`, `name`, `price`) VALUES
(1, 'L', 3),
(2, 'XL', 4),
(3, 'XXL', 5);

-- --------------------------------------------------------

--
-- Structure de la table `tacos`
--

DROP TABLE IF EXISTS `tacos`;
CREATE TABLE IF NOT EXISTS `tacos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `size_id` int DEFAULT NULL,
  `meat_id` int DEFAULT NULL,
  `sauce_id` int DEFAULT NULL,
  `cheese_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_281203E3498DA827` (`size_id`),
  KEY `IDX_281203E3F63B19A6` (`meat_id`),
  KEY `IDX_281203E37AB984B7` (`sauce_id`),
  KEY `IDX_281203E32AD46E66` (`cheese_id`)
) ENGINE=InnoDB AUTO_INCREMENT=97 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `tacos`
--

INSERT INTO `tacos` (`id`, `size_id`, `meat_id`, `sauce_id`, `cheese_id`) VALUES
(1, 2, 2, 1, 2),
(2, 1, 1, 2, 1),
(3, 1, 1, 2, 1),
(4, 1, 1, 2, 1),
(5, 1, 1, 2, 1),
(6, 1, 1, 1, 1),
(7, 3, 1, 2, 1),
(8, 3, 1, 2, 1),
(9, 3, 1, 2, 1),
(10, 3, 1, 2, 1),
(11, 3, 1, 3, 3),
(12, 3, 1, 3, 3),
(13, 2, 3, 3, 2),
(14, 2, 3, 3, 2),
(15, 3, 1, 1, 2),
(16, 3, 1, 1, 2),
(17, 1, 1, 2, 1),
(18, 1, 1, 2, 1),
(19, 1, 1, 1, 1),
(20, 1, 1, 2, 1),
(21, 3, 1, 2, 1),
(22, 1, 1, 2, 1),
(23, 1, 1, 2, 1),
(24, 1, 1, 1, 2),
(25, 3, 2, 1, 2),
(26, 2, 3, 3, 2),
(27, 1, 1, 2, 1),
(28, 1, 1, 2, 1),
(29, 1, 1, 2, 1),
(30, 1, 1, 1, 1),
(31, 1, 1, 1, 2),
(32, 3, 1, 3, 1),
(33, 2, 1, 3, 1),
(34, 1, 1, 2, 1),
(35, 1, 1, 2, 1),
(36, 1, 1, 2, 1),
(37, 1, 1, 1, 1),
(38, 3, 1, 2, 1),
(39, 3, 1, 2, 1),
(40, 1, 1, 2, 1),
(41, 1, 1, 2, 1),
(42, 1, 1, 2, 1),
(43, 1, 1, 2, 1),
(44, 3, 2, 2, 2),
(45, 3, 2, 2, 2),
(46, 1, 1, 1, 1),
(47, 1, 1, 1, 1),
(48, 3, 1, 2, 1),
(49, 3, 1, 2, 1),
(50, 2, 1, 2, 1),
(51, 3, 1, 3, 1),
(52, 1, 1, 2, 1),
(53, 1, 1, 2, 1),
(54, 1, 1, 2, 1),
(55, 3, 1, 3, 1),
(56, 3, 1, 1, 2),
(57, 3, 1, 1, 2),
(58, 1, 1, 2, 1),
(59, 1, 1, 2, 1),
(60, 1, 1, 2, 1),
(61, 1, 1, 2, 1),
(62, 1, 1, 2, 1),
(63, 1, 1, 2, 1),
(64, 1, 2, 1, 2),
(65, 3, 3, 1, 2),
(66, 3, 3, 1, 2),
(67, 3, 3, 1, 2),
(68, 3, 3, 1, 2),
(69, 3, 3, 1, 2),
(70, 3, 3, 1, 2),
(71, 3, 3, 1, 2),
(72, 1, 1, 2, 1),
(73, 1, 1, 2, 1),
(74, 1, 1, 2, 1),
(75, 1, 1, 2, 1),
(76, 1, 1, 2, 1),
(77, 3, 1, 2, 1),
(78, 3, 1, 1, 1),
(79, 3, 2, 1, 1),
(80, 1, 1, 2, 1),
(81, 1, 1, 2, 1),
(82, 1, 1, 2, 1),
(83, 1, 1, 2, 1),
(84, 1, 1, 2, 1),
(85, 1, 1, 2, 1),
(86, 3, 1, 1, 1),
(87, 3, 1, 1, 1),
(88, 3, 3, 3, 2),
(89, 3, 3, 1, 3),
(90, 3, 3, 1, 3),
(91, 3, 1, 1, 2),
(92, 2, 1, 2, 1),
(93, 2, 1, 2, 1),
(94, 1, 1, 2, 1),
(95, 1, 1, 2, 1),
(96, 1, 1, 2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`) VALUES
(1, 'rfriviere@yahoo.fr', '[]', '$2y$13$5Ug4uHWiIoboDipy8U4Kx.1ffTqRwZzSEPDhbweAdFPr473DZwXpK');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `tacos`
--
ALTER TABLE `tacos`
  ADD CONSTRAINT `FK_281203E32AD46E66` FOREIGN KEY (`cheese_id`) REFERENCES `cheese` (`id`),
  ADD CONSTRAINT `FK_281203E3498DA827` FOREIGN KEY (`size_id`) REFERENCES `size` (`id`),
  ADD CONSTRAINT `FK_281203E37AB984B7` FOREIGN KEY (`sauce_id`) REFERENCES `sauce` (`id`),
  ADD CONSTRAINT `FK_281203E3F63B19A6` FOREIGN KEY (`meat_id`) REFERENCES `meat` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
