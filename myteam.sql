-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mar 19 Octobre 2021 à 09:43
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `myteam`
--

-- --------------------------------------------------------

--
-- Structure de la table `affectations`
--

CREATE TABLE IF NOT EXISTS `affectations` (
  `idProjet` int(11) NOT NULL,
  `idUtilisateur` int(11) NOT NULL,
  PRIMARY KEY (`idProjet`,`idUtilisateur`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `affectations`
--

INSERT INTO `affectations` (`idProjet`, `idUtilisateur`) VALUES
(1, 1),
(1, 3),
(2, 1),
(2, 3),
(3, 2),
(3, 4);

-- --------------------------------------------------------

--
-- Structure de la table `evenements`
--

CREATE TABLE IF NOT EXISTS `evenements` (
  `idEvenement` int(11) NOT NULL AUTO_INCREMENT,
  `designation` varchar(100) NOT NULL,
  `contenu` varchar(100) DEFAULT NULL,
  `date` date NOT NULL,
  `heureDebut` time NOT NULL,
  `heureFin` time NOT NULL,
  `idUtilisateur` int(11) NOT NULL,
  `couleur` varchar(100) NOT NULL,
  PRIMARY KEY (`idEvenement`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=55 ;

--
-- Contenu de la table `evenements`
--

INSERT INTO `evenements` (`idEvenement`, `designation`, `contenu`, `date`, `heureDebut`, `heureFin`, `idUtilisateur`, `couleur`) VALUES
(35, 'TEST', NULL, '2021-09-23', '10:00:00', '11:00:00', 1, ''),
(36, 'test', NULL, '2021-10-07', '10:00:00', '10:00:00', 24, '#9346d3b3'),
(37, 'TEST', NULL, '2021-10-07', '10:00:00', '17:00:00', 24, '#4a2fc7b3'),
(38, 'CTFVYGBHJ', NULL, '2021-10-07', '08:00:00', '08:00:00', 24, '#c6cd25b3'),
(39, 'edrtfyghuio', NULL, '2021-10-07', '12:00:00', '12:00:00', 24, '#d954b3b3'),
(40, 'rftgyhui', NULL, '2021-10-07', '11:00:00', '11:00:00', 24, '#ed5454b3'),
(42, 'tst', NULL, '2021-10-11', '18:00:00', '19:00:00', 24, '#97c7eeb3'),
(44, 'yhgtrfe', NULL, '2021-10-11', '17:00:00', '19:10:00', 24, '#97c7eeb3'),
(45, 'test', NULL, '2021-10-11', '11:00:00', '15:00:00', 24, '#7b60f5b3'),
(46, 'testtest', NULL, '2021-10-11', '08:00:00', '08:00:00', 24, '#4a2fc7b3'),
(51, 'gvh', NULL, '2021-10-11', '08:00:00', '10:00:00', 24, '#398d21b3');

-- --------------------------------------------------------

--
-- Structure de la table `jaime`
--

CREATE TABLE IF NOT EXISTS `jaime` (
  `idUtilisateur` int(11) NOT NULL,
  `idPublication` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `jaime`
--

INSERT INTO `jaime` (`idUtilisateur`, `idPublication`) VALUES
(1, 5),
(24, 8),
(24, 10);

-- --------------------------------------------------------

--
-- Structure de la table `les_services`
--

CREATE TABLE IF NOT EXISTS `les_services` (
  `idService` int(11) NOT NULL AUTO_INCREMENT,
  `nomService` varchar(100) NOT NULL,
  `idUtilisateur` int(11) NOT NULL,
  PRIMARY KEY (`idService`),
  UNIQUE KEY `UQ_service_user` (`nomService`,`idUtilisateur`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `les_services`
--

INSERT INTO `les_services` (`idService`, `nomService`, `idUtilisateur`) VALUES
(1, 'Service N°1', 1),
(2, 'Service N°2', 2),
(3, 'Service N°3', 3),
(4, 'Service N°4', 4);

-- --------------------------------------------------------

--
-- Structure de la table `messagerie`
--

CREATE TABLE IF NOT EXISTS `messagerie` (
  `idMessage` int(11) NOT NULL AUTO_INCREMENT,
  `idEnvoyeur` int(11) NOT NULL,
  `idReceveur` int(11) NOT NULL,
  `contenu` text NOT NULL,
  `heure` datetime DEFAULT NULL,
  PRIMARY KEY (`idMessage`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=43 ;

--
-- Contenu de la table `messagerie`
--

INSERT INTO `messagerie` (`idMessage`, `idEnvoyeur`, `idReceveur`, `contenu`, `heure`) VALUES
(29, 24, 8, 'TEST', '2021-10-07 10:56:58'),
(28, 8, 24, 'sdfgh', '2021-09-25 19:06:56'),
(26, 8, 24, 'sdf', '2021-05-04 17:02:01'),
(27, 24, 8, 'er', '2021-05-04 17:02:05'),
(30, 8, 24, 'coucou', '2021-10-07 23:06:32'),
(31, 24, 8, 'test', '2021-10-13 00:17:57'),
(32, 24, 8, 'test', '2021-10-13 00:18:35'),
(33, 24, 8, 'test', '2021-10-13 00:49:14'),
(34, 24, 8, 'coucou', '2021-10-13 12:26:16'),
(35, 24, 8, '.', '2021-10-13 12:36:35'),
(36, 8, 24, 'un test tres longun test tres longun test tres longun test tres longun test tres longun test tres longun test tres longun test tres long', '2021-10-13 12:48:43'),
(37, 24, 8, 'rer', '2021-10-13 18:18:48'),
(38, 25, 24, 'test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test ', '2021-10-13 21:27:25'),
(39, 24, 8, 'test', '2021-10-14 13:10:18'),
(40, 24, 8, 'test', '2021-10-15 14:10:01'),
(41, 24, 8, 'fd', '2021-10-15 14:10:25'),
(42, 24, 8, 'eeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee', '2021-10-19 09:34:01');

-- --------------------------------------------------------

--
-- Structure de la table `organisations`
--

CREATE TABLE IF NOT EXISTS `organisations` (
  `idEvenement` int(11) NOT NULL AUTO_INCREMENT,
  `designation` varchar(100) NOT NULL,
  `contenu` varchar(100) DEFAULT NULL,
  `dateDebut` time NOT NULL,
  `dateFin` time NOT NULL,
  PRIMARY KEY (`idEvenement`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `participationprojet`
--

CREATE TABLE IF NOT EXISTS `participationprojet` (
  `idProjet` int(11) NOT NULL,
  `idUtilisateur` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `participationprojet`
--

INSERT INTO `participationprojet` (`idProjet`, `idUtilisateur`) VALUES
(1, 8);

-- --------------------------------------------------------

--
-- Structure de la table `plannifications`
--

CREATE TABLE IF NOT EXISTS `plannifications` (
  `idPlannification` int(11) NOT NULL AUTO_INCREMENT,
  `idUtilisateur` int(11) NOT NULL,
  `idProjet` int(11) NOT NULL,
  `date` date NOT NULL,
  `ratio` float NOT NULL,
  PRIMARY KEY (`idPlannification`),
  UNIQUE KEY `UQ_user_project_date` (`idUtilisateur`,`idProjet`,`date`),
  KEY `IDX_user` (`idUtilisateur`),
  KEY `IDX_project` (`idProjet`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `postes`
--

CREATE TABLE IF NOT EXISTS `postes` (
  `idposte` int(11) NOT NULL,
  `poste` text NOT NULL,
  `grade` int(11) NOT NULL,
  PRIMARY KEY (`idposte`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `postes`
--

INSERT INTO `postes` (`idposte`, `poste`, `grade`) VALUES
(1, 'Employé(e)', 5),
(2, 'Administrateur', 10);

-- --------------------------------------------------------

--
-- Structure de la table `projets`
--

CREATE TABLE IF NOT EXISTS `projets` (
  `idProjet` int(11) NOT NULL AUTO_INCREMENT,
  `nomProjet` varchar(100) NOT NULL,
  `descriptionProjet` text NOT NULL,
  `dateDebut` date NOT NULL,
  `dateFin` date NOT NULL,
  `image` varchar(250) NOT NULL,
  PRIMARY KEY (`idProjet`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `projets`
--

INSERT INTO `projets` (`idProjet`, `nomProjet`, `descriptionProjet`, `dateDebut`, `dateFin`, `image`) VALUES
(1, 'Projet n°1 de test', 'Description de test du projet n°1 de test.', '2021-01-01', '2022-05-20', '../pages/images/projets/projet1.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `publications`
--

CREATE TABLE IF NOT EXISTS `publications` (
  `idPublication` int(11) NOT NULL AUTO_INCREMENT,
  `contenuPublication` text NOT NULL,
  `datePublication` datetime NOT NULL,
  `idUtilisateur` int(11) NOT NULL,
  `typePublication` varchar(50) NOT NULL,
  `jaime` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idPublication`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Contenu de la table `publications`
--

INSERT INTO `publications` (`idPublication`, `contenuPublication`, `datePublication`, `idUtilisateur`, `typePublication`, `jaime`) VALUES
(9, 'test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test test ', '2021-10-13 21:26:58', 25, 'post', 0),
(8, 'test test ', '2021-10-13 21:26:42', 25, 'post', 1),
(6, 'vcsf', '2021-10-12 19:20:11', 24, 'annonce', 0),
(7, 'cxdsq', '2021-10-12 19:20:17', 24, 'post', 0),
(10, 'test\r\n', '2021-10-14 13:05:17', 24, 'post', 1);

-- --------------------------------------------------------

--
-- Structure de la table `reponses`
--

CREATE TABLE IF NOT EXISTS `reponses` (
  `idReponse` int(11) NOT NULL AUTO_INCREMENT,
  `idPublication` int(11) NOT NULL,
  `reponse` varchar(250) NOT NULL,
  `idUtilisateur` int(11) NOT NULL,
  PRIMARY KEY (`idReponse`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `reponses`
--

INSERT INTO `reponses` (`idReponse`, `idPublication`, `reponse`, `idUtilisateur`) VALUES
(1, 7, 'salut\r\n', 24),
(2, 8, 'test\r\n', 24),
(3, 6, 'test\r\n', 24),
(4, 6, 'test\r\n', 24),
(5, 6, 'test', 24),
(6, 7, 'res\r\n', 24);

-- --------------------------------------------------------

--
-- Structure de la table `services`
--

CREATE TABLE IF NOT EXISTS `services` (
  `idAffectationService` int(11) NOT NULL AUTO_INCREMENT,
  `idService` int(11) NOT NULL,
  `idUtilisateur` int(11) NOT NULL,
  PRIMARY KEY (`idAffectationService`),
  UNIQUE KEY `IDX_service` (`idService`,`idUtilisateur`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `services`
--

INSERT INTO `services` (`idAffectationService`, `idService`, `idUtilisateur`) VALUES
(1, 1, 1),
(2, 3, 2),
(3, 2, 3),
(4, 1, 4),
(5, 1, 5);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `idUtilisateur` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `dateNaiss` date NOT NULL,
  `email` varchar(100) NOT NULL,
  `mdp` text NOT NULL,
  `idposte` int(11) NOT NULL,
  `photoProfil` varchar(250) NOT NULL DEFAULT 'https://st3.depositphotos.com/4111759/13425/v/600/depositphotos_134255634-stock-illustration-avatar-icon-male-profile-gray.jpg',
  PRIMARY KEY (`idUtilisateur`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

--
-- Contenu de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`idUtilisateur`, `nom`, `prenom`, `dateNaiss`, `email`, `mdp`, `idposte`, `photoProfil`) VALUES
(24, 'admin', 'admin', '2021-10-13', 'admin@mail.fr', '$2y$10$nw57NO493wpLj1EGgLr98eT251pc0Fsr2bDcUN.uCjZYytbb2hs6m', 2, '../pages/images/avatar/9922.jpg'),
(8, 'visiteur', 'visiteur', '2021-03-18', 'visiteur@mail.fr', '$2y$10$crcFhESJFIM8sS4fU2J4yOYgkbazFXWC9rC96FQ82Toqgmg2igax.', 1, 'images/avatar/photoProfil.jpg'),
(27, 'CHAUVEAU', 'DAMIEN', '2021-10-07', 'Damien.chv78@gmail.com', '$2y$10$ocg1MlfMuyzKWAwecyTC5.1pxVdmzy0RiO4XLxcK0mlNQ2trROI/O', 1, '../pages/images/avatar/photoProfil.jpg'),
(26, 'damien', 'chauveau', '2021-10-06', 'damienchauveau@mail.fr', '$2y$10$xCu5ESeJQtxcE.Ho9kIoqOJob2f.ojZv7AhZzQGun3klyrMT9fIGO', 1, '../pages/images/avatar/photoProfil.jpg'),
(25, 'test', 'test', '2021-10-13', 'test@mail.fr', '$2y$10$fnoJoCqZDFIZp70oPm6MY.PphlAdRINMg2rtHKaNCiiPKR.JDskPy', 1, '../pages/images/avatar/Gull_portrait_ca_usa.jpg');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
