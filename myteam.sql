-- phpMyAdmin SQL Dump
-- version OVH
-- https://www.phpmyadmin.net/
--
-- Hôte : ipssisqmyteam.mysql.db
-- Généré le : jeu. 31 mars 2022 à 12:31
-- Version du serveur : 5.6.51-log
-- Version de PHP : 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `ipssisqmyteam`
--

-- --------------------------------------------------------

--
-- Structure de la table `affectations`
--

CREATE TABLE `affectations` (
  `idProjet` int(11) NOT NULL,
  `idUtilisateur` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `affectations`
--

INSERT INTO `affectations` (`idProjet`, `idUtilisateur`) VALUES
(1, 4),
(2, 7);

-- --------------------------------------------------------

--
-- Structure de la table `allowed_ips`
--

CREATE TABLE `allowed_ips` (
  `ip` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `allowed_ips`
--

INSERT INTO `allowed_ips` (`ip`) VALUES
('::1'),
('37.70.218.118'),
('89.90.33.11');

-- --------------------------------------------------------

--
-- Structure de la table `avertissement`
--

CREATE TABLE `avertissement` (
  `idAvertissement` int(11) NOT NULL,
  `idUtilisateur` int(11) NOT NULL,
  `nombre` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `avertissement`
--

INSERT INTO `avertissement` (`idAvertissement`, `idUtilisateur`, `nombre`) VALUES
(1, 4, 2);

-- --------------------------------------------------------

--
-- Structure de la table `banned_ips`
--

CREATE TABLE `banned_ips` (
  `ip` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `chatprojet`
--

CREATE TABLE `chatprojet` (
  `idMessage` int(11) NOT NULL,
  `idUtilisateur` int(11) NOT NULL,
  `dateMessage` datetime NOT NULL,
  `message` text NOT NULL,
  `idProjet` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `chatprojet`
--

INSERT INTO `chatprojet` (`idMessage`, `idUtilisateur`, `dateMessage`, `message`, `idProjet`) VALUES
(1, 9, '2022-03-29 16:26:42', 'Le développement des pages peut commencer', 1);

-- --------------------------------------------------------

--
-- Structure de la table `conges`
--

CREATE TABLE `conges` (
  `idConge` int(11) NOT NULL,
  `idUtilisateur` int(11) NOT NULL,
  `dateDebut` date NOT NULL,
  `dateFin` date NOT NULL,
  `commentaire` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `raison` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `evenements`
--

CREATE TABLE `evenements` (
  `idEvenement` int(11) NOT NULL,
  `designation` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `heureDebut` time NOT NULL,
  `heureFin` time NOT NULL,
  `idUtilisateur` int(11) NOT NULL,
  `couleur` varchar(100) NOT NULL DEFAULT '#97c7eeb3',
  `admin` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `jaime`
--

CREATE TABLE `jaime` (
  `idUtilisateur` int(11) NOT NULL,
  `idPublication` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `logs_connexion`
--

CREATE TABLE `logs_connexion` (
  `idLog` int(11) NOT NULL,
  `idUtilisateur` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `ip` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `logs_connexion`
--

INSERT INTO `logs_connexion` (`idLog`, `idUtilisateur`, `date`, `ip`) VALUES
(1, 2, '2022-03-29 10:51:58', '37.70.218.118'),
(2, 3, '2022-03-29 10:54:09', '37.70.218.118'),
(3, 4, '2022-03-29 10:57:20', '37.70.218.118'),
(4, 4, '2022-03-29 12:01:30', '37.70.218.118'),
(5, 9, '2022-03-29 16:05:59', '37.70.218.118');

-- --------------------------------------------------------

--
-- Structure de la table `maintenance`
--

CREATE TABLE `maintenance` (
  `maintenance` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `maintenance`
--

INSERT INTO `maintenance` (`maintenance`) VALUES
(0);

-- --------------------------------------------------------

--
-- Structure de la table `messagerie`
--

CREATE TABLE `messagerie` (
  `idMessage` int(11) NOT NULL,
  `idUtilisateur` varchar(50) NOT NULL,
  `idReceveur` varchar(50) NOT NULL,
  `contenu` text NOT NULL,
  `heure` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `messagerie`
--

INSERT INTO `messagerie` (`idMessage`, `idUtilisateur`, `idReceveur`, `contenu`, `heure`) VALUES
(8, '9', '10', 'Salut :)', '2022-03-29 16:28:08'),
(9, '9', '5', 'Bonjour Corentin, bienvenue :) !', '2022-03-29 16:28:25');

-- --------------------------------------------------------

--
-- Structure de la table `messages_signales`
--

CREATE TABLE `messages_signales` (
  `idMessageSignaler` int(11) NOT NULL,
  `idMessage` int(11) NOT NULL,
  `message` varchar(255) NOT NULL,
  `traite` tinyint(1) NOT NULL DEFAULT '0',
  `idUtilisateur` int(11) NOT NULL,
  `idSignale` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `messages_signales`
--

INSERT INTO `messages_signales` (`idMessageSignaler`, `idMessage`, `message`, `traite`, `idUtilisateur`, `idSignale`) VALUES
(8, 8, 'Bonjour :)', 0, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `participationprojet`
--

CREATE TABLE `participationprojet` (
  `idProjet` int(11) NOT NULL,
  `idUtilisateur` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `participationprojet`
--

INSERT INTO `participationprojet` (`idProjet`, `idUtilisateur`) VALUES
(1, 5),
(1, 6);

-- --------------------------------------------------------

--
-- Structure de la table `plannifications`
--

CREATE TABLE `plannifications` (
  `idPlannification` int(11) NOT NULL,
  `idUtilisateur` int(11) NOT NULL,
  `idProjet` int(11) NOT NULL,
  `date` date NOT NULL,
  `ratio` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `postes`
--

CREATE TABLE `postes` (
  `idposte` int(11) NOT NULL,
  `poste` text NOT NULL,
  `grade` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `postes`
--

INSERT INTO `postes` (`idposte`, `poste`, `grade`) VALUES
(1, 'Employé(e)', 5),
(2, 'Administrateur', 10),
(3, 'Visiteur', 0),
(4, 'RH', 6),
(5, 'PDG', 10),
(6, 'DG', 10),
(7, 'Commercial(e)', 5),
(8, 'Développeur(euse)', 5),
(9, 'clow', 0);

-- --------------------------------------------------------

--
-- Structure de la table `projets`
--

CREATE TABLE `projets` (
  `idProjet` int(11) NOT NULL,
  `nomProjet` varchar(100) NOT NULL,
  `descriptionProjet` text NOT NULL,
  `dateDebut` date NOT NULL,
  `dateFin` date NOT NULL,
  `image` varchar(250) NOT NULL,
  `archive` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `projets`
--

INSERT INTO `projets` (`idProjet`, `nomProjet`, `descriptionProjet`, `dateDebut`, `dateFin`, `image`, `archive`) VALUES
(1, 'Maison Z - Développement site web', 'Maison Z est un site web de vente de meubles en bois.', '2022-03-01', '2022-08-01', 'images/projets/projet1.jpg', 0),
(2, 'MYTeam - Améliorations', 'Amélioration de l\'interface de connexion.', '2023-01-19', '2023-03-15', 'images/projets/projet2.jpg', 0);

-- --------------------------------------------------------

--
-- Structure de la table `publications`
--

CREATE TABLE `publications` (
  `idPublication` int(11) NOT NULL,
  `contenuPublication` text NOT NULL,
  `datePublication` datetime NOT NULL,
  `idUtilisateur` int(11) NOT NULL,
  `typePublication` varchar(50) NOT NULL,
  `jaime` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `publications`
--

INSERT INTO `publications` (`idPublication`, `contenuPublication`, `datePublication`, `idUtilisateur`, `typePublication`, `jaime`) VALUES
(1, 'Une maintenance du serveur aura lieu de 17h à 18h. Il est donc fortement recommandé de ne pas travaillé sur ce dernier sous peine de perdre tout votre travail. #maintenance', '2022-03-29 16:03:56', 9, 'annonce', 7),
(2, 'Bienvenue à Corentin MAILLE qui rejoint notre équipe de développeurs !!', '2022-03-29 16:06:12', 7, 'post', 3),
(3, 'Le 04 Juillet 2022, l\'entreprise sera fermée. Un RTT vous sera donc décompté. Bonne soirée à vous !', '2022-03-29 16:10:17', 7, 'annonce', 7),
(4, 'Déjeuné d\'entreprise à 13h. Merci d\'indiquer vos menus dans les commentaires. #dejeuner', '2022-03-31 12:24:49', 9, 'post', 4);

-- --------------------------------------------------------

--
-- Structure de la table `reponses`
--

CREATE TABLE `reponses` (
  `idReponse` int(11) NOT NULL,
  `idPublication` int(11) NOT NULL,
  `reponse` varchar(250) NOT NULL,
  `idUtilisateur` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `reponses`
--

INSERT INTO `reponses` (`idReponse`, `idPublication`, `reponse`, `idUtilisateur`) VALUES
(32, 2, 'Merci !!', 5),
(33, 2, 'Bienvenue à toi !', 10),
(34, 1, 'Maintenance terminée.', 9),
(35, 4, 'Pâtes', 5),
(36, 4, 'Riz', 7);

-- --------------------------------------------------------

--
-- Structure de la table `tachesprojet`
--

CREATE TABLE `tachesprojet` (
  `idTache` int(11) NOT NULL,
  `libelle` varchar(255) NOT NULL,
  `idProjet` int(11) NOT NULL,
  `idUtilisateur` int(11) NOT NULL,
  `idTacheParent` int(11) DEFAULT NULL,
  `terminee` int(11) NOT NULL,
  `dateFin` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `tachesprojet`
--

INSERT INTO `tachesprojet` (`idTache`, `libelle`, `idProjet`, `idUtilisateur`, `idTacheParent`, `terminee`, `dateFin`) VALUES
(1, 'Développement pages', 1, 6, NULL, 0, '2022-04-30'),
(2, 'Ajout contenu', 1, 5, 1, 0, '2022-08-30');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `idUtilisateur` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `dateNaiss` date NOT NULL,
  `email` varchar(100) NOT NULL,
  `mdp` text NOT NULL,
  `idposte` int(11) NOT NULL,
  `photoProfil` varchar(250) NOT NULL DEFAULT 'https://st3.depositphotos.com/4111759/13425/v/600/depositphotos_134255634-stock-illustration-avatar-icon-male-profile-gray.jpg',
  `token` varchar(255) DEFAULT NULL,
  `first_connexion` tinyint(1) DEFAULT '1',
  `avertissements` int(11) NOT NULL DEFAULT '0',
  `actif` tinyint(1) DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`idUtilisateur`, `nom`, `prenom`, `dateNaiss`, `email`, `mdp`, `idposte`, `photoProfil`, `token`, `first_connexion`, `avertissements`, `actif`) VALUES
(1, 'Visiteur', 'Visiteur', '2002-02-10', 'visiteur@myteam.fr', '$2y$10$goRKDrsCl7AWR4IcWEab/O.StZQogh2qz.c1YpMRUiuL/E/SPX87a', 3, '../pages/images/avatar/photoProfil.jpg', NULL, 0, 0, 1),
(2, 'Utilisateur', 'Utilisateur', '2002-02-10', 'utilisateur@myteam.fr', '$2y$10$.H9xcXjN/zJnY/NXjebEjuwY0caI6gu8exjxrB2nkyetaVpvrC0LW', 1, '../pages/images/avatar/photoProfil.jpg', NULL, 0, 0, 1),
(3, 'RH', 'RH', '2002-02-10', 'rh@myteam.fr', '$2y$10$NFGgDnO52yVjjrAYKzwP5O2CMZDlzCP5K1dVkNSrE6je6ISVVGHaK', 4, '../pages/images/avatar/photoProfil.jpg', NULL, 0, 0, 1),
(4, 'Admin', 'Admin', '2002-02-10', 'admin@myteam.fr', '$2y$10$tNoSJjaDbSt8yKK3vQF4cuNtu0/5uGtSF.08FnBhPxipsg5e.g54O', 2, '../pages/images/avatar/photoProfil.jpg', NULL, 0, 0, 1),
(5, 'MAILLE', 'Corentin', '1999-05-18', 'corentin.maille@gmail.com', '$2y$10$UR3y718ynTFARWz9ePBOBOIT0aDPKSC7UXsq6mw5BXuZ6TMzO44V2', 8, '../pages/images/avatar/photoProfil.jpg', NULL, 0, 0, 1),
(6, 'BARBIER', 'Nathan', '1997-03-17', 'nathan.barbier@gmail.com', '$2y$10$3tjnzmTEA3RKj0mBDueSvuVesnumqjYQKlXo54/CtSXkqatiwM98e', 8, '../pages/images/avatar/photoProfil.jpg', NULL, 0, 0, 1),
(7, 'DUPONT', 'Jean', '1985-02-10', 'jean.dupont@gmail.com', '$2y$10$6yuqFlp94HqSgOGa537AsOi1zhpLW6r5F6bvzB1PX48inYz/0iGay', 4, '../pages/images/avatar/photoProfil.jpg', NULL, 0, 0, 1),
(8, 'POIRET', 'Vanessa', '1972-02-10', 'poiret.vanessa@gmail.com', '$2y$10$TxYT633OgoJf4kpTZ1f4jucq8r4t/r.LRyjluc/8oq6MNLzbIGMQW', 6, '../pages/images/avatar/photoProfil.jpg', NULL, 0, 0, 1),
(9, 'CHAUMONT', 'Romain', '2002-02-10', 'rchaumont10@gmail.com', '$2y$10$j4VbEQrKlAkG/vNhJj.wA.oPYC/ViNVfhFxLuF55g49sl/7I8v6bm', 5, '../pages/images/avatar/photoProfil.jpg', NULL, 0, 0, 1),
(10, 'CHAUVEAU', 'Damien', '2000-03-15', 'damien@myteam.com', '$2y$10$nA/ez2Q2Dq1Px2o5avN4Hu2mfycdiABSzP1ufMwWvg3Fgprdp9iyy', 5, '../pages/images/avatar/photoProfil.jpg', NULL, 0, 0, 1),
(11, 'MADANI', 'Yanis', '1980-07-16', 'madani.yanis@myteam.fr', '$2y$10$rJPl5gUF.XIpYTSGRHl89.HNtbJTlRz548nwuUMrT.oJg61lkoWdu', 7, '../pages/images/avatar/photoProfil.jpg', NULL, 0, 0, 1),
(12, 'TREFLEST', 'Remy', '1990-02-10', 'treflest.remy@gmail.com', '$2y$10$MV8gtExcm887dN4vLRjHVeHDQLUipZJxaBWWB8dYJU8FTXfH.qIX6', 7, '../pages/images/avatar/photoProfil.jpg', NULL, 0, 0, 1);

--
-- Déclencheurs `utilisateurs`
--
DELIMITER $$
CREATE TRIGGER `after_update_utilisateurs` BEFORE UPDATE ON `utilisateurs` FOR EACH ROW BEGIN
	IF NEW.avertissements > 2 THEN
    	SET NEW.actif = 0;
	END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `before_delete_utilisateurs` BEFORE DELETE ON `utilisateurs` FOR EACH ROW BEGIN
	DELETE FROM affectations WHERE idUtilisateur = OLD.idUtilisateur;
    DELETE FROM avertissement WHERE idUtilisateur = OLD.idUtilisateur;
    DELETE FROM evenements WHERE idUtilisateur = OLD.idUtilisateur;
    DELETE FROM jaime WHERE idUtilisateur = OLD.idUtilisateur;
    DELETE FROM participationprojet WHERE idUtilisateur = OLD.idUtilisateur;
    DELETE FROM plannifications WHERE idUtilisateur = OLD.idUtilisateur;
    DELETE FROM publications WHERE idUtilisateur = OLD.idUtilisateur;
    DELETE FROM reponses WHERE idUtilisateur = OLD.idUtilisateur;
    DELETE FROM chatprojet WHERE idUtilisateur = OLD.idUtilisateur;
    DELETE FROM messagerie WHERE idUtilisateur = OLD.idUtilisateur;
    DELETE FROM messages_signales WHERE idUtilisateur = OLD.idUtilisateur;
END
$$
DELIMITER ;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `affectations`
--
ALTER TABLE `affectations`
  ADD PRIMARY KEY (`idProjet`,`idUtilisateur`);

--
-- Index pour la table `avertissement`
--
ALTER TABLE `avertissement`
  ADD PRIMARY KEY (`idAvertissement`);

--
-- Index pour la table `chatprojet`
--
ALTER TABLE `chatprojet`
  ADD PRIMARY KEY (`idMessage`);

--
-- Index pour la table `conges`
--
ALTER TABLE `conges`
  ADD PRIMARY KEY (`idConge`);

--
-- Index pour la table `evenements`
--
ALTER TABLE `evenements`
  ADD PRIMARY KEY (`idEvenement`);

--
-- Index pour la table `logs_connexion`
--
ALTER TABLE `logs_connexion`
  ADD PRIMARY KEY (`idLog`);

--
-- Index pour la table `messagerie`
--
ALTER TABLE `messagerie`
  ADD PRIMARY KEY (`idMessage`);

--
-- Index pour la table `messages_signales`
--
ALTER TABLE `messages_signales`
  ADD PRIMARY KEY (`idMessageSignaler`);

--
-- Index pour la table `plannifications`
--
ALTER TABLE `plannifications`
  ADD PRIMARY KEY (`idPlannification`),
  ADD UNIQUE KEY `UQ_user_project_date` (`idUtilisateur`,`idProjet`,`date`),
  ADD KEY `IDX_user` (`idUtilisateur`),
  ADD KEY `IDX_project` (`idProjet`);

--
-- Index pour la table `postes`
--
ALTER TABLE `postes`
  ADD PRIMARY KEY (`idposte`);

--
-- Index pour la table `projets`
--
ALTER TABLE `projets`
  ADD PRIMARY KEY (`idProjet`);

--
-- Index pour la table `publications`
--
ALTER TABLE `publications`
  ADD PRIMARY KEY (`idPublication`);

--
-- Index pour la table `reponses`
--
ALTER TABLE `reponses`
  ADD PRIMARY KEY (`idReponse`);

--
-- Index pour la table `tachesprojet`
--
ALTER TABLE `tachesprojet`
  ADD PRIMARY KEY (`idTache`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`idUtilisateur`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `avertissement`
--
ALTER TABLE `avertissement`
  MODIFY `idAvertissement` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `chatprojet`
--
ALTER TABLE `chatprojet`
  MODIFY `idMessage` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `conges`
--
ALTER TABLE `conges`
  MODIFY `idConge` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `evenements`
--
ALTER TABLE `evenements`
  MODIFY `idEvenement` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `logs_connexion`
--
ALTER TABLE `logs_connexion`
  MODIFY `idLog` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `messagerie`
--
ALTER TABLE `messagerie`
  MODIFY `idMessage` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `messages_signales`
--
ALTER TABLE `messages_signales`
  MODIFY `idMessageSignaler` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `plannifications`
--
ALTER TABLE `plannifications`
  MODIFY `idPlannification` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `postes`
--
ALTER TABLE `postes`
  MODIFY `idposte` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `projets`
--
ALTER TABLE `projets`
  MODIFY `idProjet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `publications`
--
ALTER TABLE `publications`
  MODIFY `idPublication` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `reponses`
--
ALTER TABLE `reponses`
  MODIFY `idReponse` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT pour la table `tachesprojet`
--
ALTER TABLE `tachesprojet`
  MODIFY `idTache` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `idUtilisateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
