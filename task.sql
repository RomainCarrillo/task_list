-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 21 juin 2021 à 19:36
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `task_list`
--

-- --------------------------------------------------------

--
-- Structure de la table `task`
--

DROP TABLE IF EXISTS `task`;
CREATE TABLE IF NOT EXISTS `task` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) DEFAULT NULL,
  `title` varchar(250) NOT NULL,
  `deadline_date` date DEFAULT NULL,
  `detail` varchar(250) DEFAULT NULL,
  `done` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`),
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `task`
--

INSERT INTO `task` (`id`, `project_id`, `title`, `deadline`, `deadline_date`, `essential`, `detail`, `category_id`, `done`) VALUES
(1, NULL, 'PremiÃ¨re tÃ¢che', NULL, '2021-09-01', NULL, 'Ceci est ma premiÃ¨re tÃ¢che Ã  accomplir.', NULL, 1),
(2, NULL, 'Une nouvelle tÃ¢che Ã  rÃ©aliser', NULL, '2021-12-06', NULL, 'Voici une deuxiÃ¨me tÃ¢che pour ma to do liste.', NULL, 0),
(3, NULL, 'Cette tÃ¢che n\'a pas de descriptif', NULL, '2021-07-11', NULL, '', NULL, 0),
(4, NULL, 'TÃ¢che sans date', NULL, NULL, NULL, 'Cette tÃ¢che n\'a pas de date d\'Ã©chÃ©ance.', NULL, 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
