-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : dim. 13 nov. 2022 à 16:28
-- Version du serveur : 5.7.31
-- Version de PHP : 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `adrien_bdd`
--

-- --------------------------------------------------------

--
-- Structure de la table `badge`
--

DROP TABLE IF EXISTS `badge`;
CREATE TABLE IF NOT EXISTS `badge` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `trame` varchar(200) NOT NULL,
  `etat` enum('OK','HS') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `badge`
--

INSERT INTO `badge` (`id`, `trame`, `etat`) VALUES
(1, 'ade96392', 'OK'),
(2, 'e8t5u356', 'OK'),
(3, '78jj1kl0', 'OK'),
(4, '78yu1qsd', 'OK'),
(5, 'kl63et85', 'HS');

-- --------------------------------------------------------

--
-- Structure de la table `borne`
--

DROP TABLE IF EXISTS `borne`;
CREATE TABLE IF NOT EXISTS `borne` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `position` varchar(200) NOT NULL,
  `numPlace` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `eleve`
--

DROP TABLE IF EXISTS `eleve`;
CREATE TABLE IF NOT EXISTS `eleve` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(200) NOT NULL,
  `prenom` varchar(200) NOT NULL,
  `login` varchar(200) NOT NULL,
  `mail` varchar(200) NOT NULL,
  `mdp` varchar(200) NOT NULL,
  `classe` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `eleve`
--

INSERT INTO `eleve` (`id`, `nom`, `prenom`, `login`, `mail`, `mdp`, `classe`) VALUES
(1, 'escoubeyrou', 'adrien', 'aze', 'adrien.escoubeyrou@gmail.com', 'azerty', 'BTSSN2'),
(2, 'laudy', 'sarah', 'qsd', 'laudysarah@gmail.com', 'qsdfgh', 'BTSSN2'),
(3, 'brachet', 'julien', 'sanju', 'jujubrachet@gmail.com', 'juju87', 'DESCO'),
(4, 'vautrin', 'emilien', 'mimil', 'emilienvautrin@gmail.com', 'emiliano87', 'MMI4'),
(5, 'escoubeyrou', 'thibaut', 'titi', 'titiescou@gmail.com', 'titi', 'TermG1'),
(6, '---', '---', '---', '---', '---', '');

-- --------------------------------------------------------

--
-- Structure de la table `organisateur`
--

DROP TABLE IF EXISTS `organisateur`;
CREATE TABLE IF NOT EXISTS `organisateur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(200) NOT NULL,
  `prenom` varchar(200) NOT NULL,
  `login` varchar(200) NOT NULL,
  `mail` varchar(200) NOT NULL,
  `mdp` varchar(200) NOT NULL,
  `qualite` enum('ADMIN','PROF') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `organisateur`
--

INSERT INTO `organisateur` (`id`, `nom`, `prenom`, `login`, `mail`, `mdp`, `qualite`) VALUES
(1, 'menigaud', 'oceane', 'oce', 'oceanemenigaud8@gmail.com', 'mdp', 'ADMIN');

-- --------------------------------------------------------

--
-- Structure de la table `participant`
--

DROP TABLE IF EXISTS `participant`;
CREATE TABLE IF NOT EXISTS `participant` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_eleve` int(11) NOT NULL,
  `num_badge` varchar(200) NOT NULL,
  `id_organisateur` int(11) NOT NULL,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `participant`
--

INSERT INTO `participant` (`id`, `id_eleve`, `num_badge`, `id_organisateur`, `date`) VALUES
(1, 2, 'ade96392', 1, '2021-04-03 20:28:26'),
(2, 1, 'e8t5u356', 1, '2021-04-04 16:26:24'),
(3, 3, '78jj1kl0', 1, '2021-04-04 16:26:10'),
(4, 4, '78yu1qsd', 1, '2021-04-04 16:26:54'),
(5, 5, 'kl63et85', 1, '2021-04-04 16:26:54');

-- --------------------------------------------------------

--
-- Structure de la table `passageborne`
--

DROP TABLE IF EXISTS `passageborne`;
CREATE TABLE IF NOT EXISTS `passageborne` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `num_badge` varchar(200) NOT NULL,
  `dateHeure` datetime NOT NULL,
  `position_Long` varchar(200) NOT NULL,
  `position_Lat` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=791 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `passageborne`
--

INSERT INTO `passageborne` (`id`, `num_badge`, `dateHeure`, `position_Long`, `position_Lat`) VALUES
(752, 'e8t5u356', '2021-03-29 14:42:30', '1.174620', '45.825149'),
(753, 'e8t5u356', '2021-03-29 14:42:38', '1.179146', '45.831022'),
(754, 'ade96392', '2021-03-29 14:00:42', '1.172933', '45.829907'),
(755, 'e8t5u356', '2021-03-29 14:05:40', '1.170957', '45.832286'),
(756, 'ade96392', '2021-03-29 14:15:03', '1.172846', '45.830850'),
(757, 'e8t5u356', '2021-03-29 14:22:14', '1.172076', '45.829891'),
(758, 'ade96392', '2021-03-29 14:29:18', '1.171307', '45.828493'),
(759, 'ade96392', '2021-03-29 14:32:19', '1.168559', '45.828443'),
(760, 'ade96392', '2021-03-29 14:35:12', '1.167462', '45.831030'),
(761, 'ade96392', '2021-03-29 14:46:44', '1.172902', '45.832627'),
(762, 'ade96392', '2021-03-29 14:50:11', '1.174995', '45.832641'),
(763, 'ade96392', '2021-03-29 14:55:07', '1.176544', '45.831408'),
(764, 'ade96392', '2021-03-29 14:59:02', '1.177525', '45.829953'),
(765, 'ade96392', '2021-03-29 15:00:06', '1.181671', '45.825968'),
(766, 'ade96392', '2021-03-29 15:04:08', '1.178304', '45.828315'),
(767, 'ade96392', '2021-03-29 15:16:41', '1.174724', '45.829481'),
(768, 'ade96392', '2021-03-29 15:23:40', '1.172134', '45.828981'),
(775, 'ade96392', '2021-03-29 15:30:40', '1.171815', '45.826027'),
(776, 'ade96392', '2021-03-29 15:50:40', '1.175043', '45.825514'),
(777, 'ade96392', '2021-03-29 16:00:00', '1.177023', '45.827408'),
(778, 'ade96392', '2021-03-29 16:04:00', '1.179634', '45.826517'),
(779, 'ade96392', '2021-03-29 16:04:05', '1.178786', '45.824693'),
(780, 'ade96392', '2021-03-29 16:05:05', '1.180384', '45.823075'),
(781, 'ade96392', '2021-03-29 16:10:05', '1.179815', '45.821737'),
(783, 'ade96392', '2021-03-29 16:11:05', '1.183506', '45.824332'),
(786, 'ade96392', '2021-03-29 16:20:00', '1.183128', '45.839393'),
(787, 'ade96392', '2021-03-29 16:20:00', '1.179886', '45.839813'),
(788, 'ade96392', '2021-03-29 16:25:00', '1.179097', '45.836764'),
(789, 'ade96392', '2021-03-29 16:29:00', '1.176811', '45.835448'),
(790, 'ade96392', '2021-03-29 16:29:59', '1.176923', '45.832270');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
