-- MySQL dump 10.13  Distrib 5.6.51, for Linux (x86_64)
--
-- Host: ipssisqmyteam.mysql.db    Database: ipssisqmyteam
-- ------------------------------------------------------
-- Server version	5.6.51-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `affectations`
--

DROP TABLE IF EXISTS `affectations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `affectations` (
  `idProjet` int(11) NOT NULL,
  `idUtilisateur` int(11) NOT NULL,
  PRIMARY KEY (`idProjet`,`idUtilisateur`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `affectations`
--

LOCK TABLES `affectations` WRITE;
/*!40000 ALTER TABLE `affectations` DISABLE KEYS */;
INSERT INTO `affectations` VALUES (1,3),(1,6),(2,3),(3,2),(3,4);
/*!40000 ALTER TABLE `affectations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `avertissement`
--

DROP TABLE IF EXISTS `avertissement`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `avertissement` (
  `idAvertissement` int(11) NOT NULL AUTO_INCREMENT,
  `idUtilisateur` int(11) NOT NULL,
  `nombre` int(11) NOT NULL,
  PRIMARY KEY (`idAvertissement`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `avertissement`
--

LOCK TABLES `avertissement` WRITE;
/*!40000 ALTER TABLE `avertissement` DISABLE KEYS */;
INSERT INTO `avertissement` VALUES (2,3,2),(3,5,3);
/*!40000 ALTER TABLE `avertissement` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chatprojet`
--

DROP TABLE IF EXISTS `chatprojet`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `chatprojet` (
  `idMessage` int(11) NOT NULL AUTO_INCREMENT,
  `idUtilisateur` int(11) NOT NULL,
  `dateMessage` datetime NOT NULL,
  `message` text NOT NULL,
  `idProjet` int(11) NOT NULL,
  PRIMARY KEY (`idMessage`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chatprojet`
--

LOCK TABLES `chatprojet` WRITE;
/*!40000 ALTER TABLE `chatprojet` DISABLE KEYS */;
INSERT INTO `chatprojet` VALUES (9,2,'2021-11-18 17:09:34','Bonjour',1),(15,1,'2022-01-22 22:49:58','Message de test.',2),(16,1,'2022-02-01 11:24:17','sssss',1),(17,1,'2022-02-01 15:06:39','oui',1);
/*!40000 ALTER TABLE `chatprojet` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `evenements`
--

DROP TABLE IF EXISTS `evenements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `evenements` (
  `idEvenement` int(11) NOT NULL AUTO_INCREMENT,
  `designation` varchar(100) NOT NULL,
  `contenu` varchar(100) DEFAULT NULL,
  `date` date NOT NULL,
  `heureDebut` time NOT NULL,
  `heureFin` time NOT NULL,
  `idUtilisateur` int(11) NOT NULL,
  `couleur` varchar(100) NOT NULL,
  PRIMARY KEY (`idEvenement`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `evenements`
--

LOCK TABLES `evenements` WRITE;
/*!40000 ALTER TABLE `evenements` DISABLE KEYS */;
INSERT INTO `evenements` VALUES (1,'Pro',NULL,'2021-10-19','08:00:00','16:00:00',23,'#c6cd25b3'),(2,'d',NULL,'2021-10-19','08:00:00','09:00:00',23,'#4acd25b3'),(3,'ss',NULL,'2021-10-19','14:00:00','16:00:00',23,'#e30e0eb3');
/*!40000 ALTER TABLE `evenements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jaime`
--

DROP TABLE IF EXISTS `jaime`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jaime` (
  `idUtilisateur` int(11) NOT NULL,
  `idPublication` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jaime`
--

LOCK TABLES `jaime` WRITE;
/*!40000 ALTER TABLE `jaime` DISABLE KEYS */;
/*!40000 ALTER TABLE `jaime` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messagerie`
--

DROP TABLE IF EXISTS `messagerie`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `messagerie` (
  `idMessage` int(11) NOT NULL AUTO_INCREMENT,
  `idUtilisateur` varchar(50) NOT NULL,
  `idReceveur` varchar(50) NOT NULL,
  `contenu` text NOT NULL,
  `heure` datetime DEFAULT NULL,
  PRIMARY KEY (`idMessage`)
) ENGINE=MyISAM AUTO_INCREMENT=53 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messagerie`
--

LOCK TABLES `messagerie` WRITE;
/*!40000 ALTER TABLE `messagerie` DISABLE KEYS */;
INSERT INTO `messagerie` VALUES (40,'5','1','bonjour','2022-01-20 15:42:59'),(41,'5','1','ddddd','2022-01-20 15:43:02'),(38,'5','2','ggg','2022-01-20 13:59:24'),(42,'5','1','rtz','2022-01-20 15:43:04'),(52,'1','5','test','2022-02-01 12:30:24');
/*!40000 ALTER TABLE `messagerie` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messages_signales`
--

DROP TABLE IF EXISTS `messages_signales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `messages_signales` (
  `idMessageSignaler` int(11) NOT NULL AUTO_INCREMENT,
  `idMessage` int(11) NOT NULL,
  `message` varchar(255) NOT NULL,
  `traite` tinyint(1) NOT NULL DEFAULT '0',
  `idUtilisateur` int(11) NOT NULL,
  PRIMARY KEY (`idMessageSignaler`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messages_signales`
--

LOCK TABLES `messages_signales` WRITE;
/*!40000 ALTER TABLE `messages_signales` DISABLE KEYS */;
INSERT INTO `messages_signales` VALUES (1,40,'bonjour',0,1),(2,41,'ddddd',0,1),(3,41,'ddddd',0,1),(4,40,'bonjour',0,1),(5,40,'bonjour',0,1);
/*!40000 ALTER TABLE `messages_signales` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `objectifsprojets`
--

DROP TABLE IF EXISTS `objectifsprojets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `objectifsprojets` (
  `idObjectif` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(255) NOT NULL,
  `termine` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idObjectif`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `objectifsprojets`
--

LOCK TABLES `objectifsprojets` WRITE;
/*!40000 ALTER TABLE `objectifsprojets` DISABLE KEYS */;
/*!40000 ALTER TABLE `objectifsprojets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `organisations`
--

DROP TABLE IF EXISTS `organisations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `organisations` (
  `idEvenement` int(11) NOT NULL AUTO_INCREMENT,
  `designation` varchar(100) NOT NULL,
  `contenu` varchar(100) DEFAULT NULL,
  `dateDebut` time NOT NULL,
  `dateFin` time NOT NULL,
  PRIMARY KEY (`idEvenement`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `organisations`
--

LOCK TABLES `organisations` WRITE;
/*!40000 ALTER TABLE `organisations` DISABLE KEYS */;
/*!40000 ALTER TABLE `organisations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `participationprojet`
--

DROP TABLE IF EXISTS `participationprojet`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `participationprojet` (
  `idProjet` int(11) NOT NULL,
  `idUtilisateur` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `participationprojet`
--

LOCK TABLES `participationprojet` WRITE;
/*!40000 ALTER TABLE `participationprojet` DISABLE KEYS */;
INSERT INTO `participationprojet` VALUES (2,1),(1,2),(1,3),(1,4),(1,1);
/*!40000 ALTER TABLE `participationprojet` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `plannifications`
--

DROP TABLE IF EXISTS `plannifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `plannifications` (
  `idPlannification` int(11) NOT NULL AUTO_INCREMENT,
  `idUtilisateur` int(11) NOT NULL,
  `idProjet` int(11) NOT NULL,
  `date` date NOT NULL,
  `ratio` float NOT NULL,
  PRIMARY KEY (`idPlannification`),
  UNIQUE KEY `UQ_user_project_date` (`idUtilisateur`,`idProjet`,`date`),
  KEY `IDX_user` (`idUtilisateur`),
  KEY `IDX_project` (`idProjet`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `plannifications`
--

LOCK TABLES `plannifications` WRITE;
/*!40000 ALTER TABLE `plannifications` DISABLE KEYS */;
/*!40000 ALTER TABLE `plannifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `postes`
--

DROP TABLE IF EXISTS `postes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `postes` (
  `idposte` int(11) NOT NULL,
  `poste` text NOT NULL,
  `grade` int(11) NOT NULL,
  PRIMARY KEY (`idposte`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `postes`
--

LOCK TABLES `postes` WRITE;
/*!40000 ALTER TABLE `postes` DISABLE KEYS */;
INSERT INTO `postes` VALUES (1,'Employé(e)',5),(2,'Administrateur',10),(3,'Visiteur',0);
/*!40000 ALTER TABLE `postes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `projets`
--

DROP TABLE IF EXISTS `projets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `projets` (
  `idProjet` int(11) NOT NULL AUTO_INCREMENT,
  `nomProjet` varchar(100) NOT NULL,
  `descriptionProjet` text NOT NULL,
  `dateDebut` date NOT NULL,
  `dateFin` date NOT NULL,
  `image` varchar(250) NOT NULL,
  `archive` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idProjet`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projets`
--

LOCK TABLES `projets` WRITE;
/*!40000 ALTER TABLE `projets` DISABLE KEYS */;
INSERT INTO `projets` VALUES (1,'Projet n°1 de test','Description de test du projet n°1 de test.','2022-01-01','2022-05-20','../pages/images/projets/projet1.jpg',0),(2,'Projet n°2','Description de test','2021-11-14','2021-11-16','../pages/images/projets/projet2.jpg',0),(3,'Projet MYTeam','Description du projet MYTeam','2021-11-30','2021-12-05','../pages/images/projets/projet3.jpg',0);
/*!40000 ALTER TABLE `projets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `publications`
--

DROP TABLE IF EXISTS `publications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `publications` (
  `idPublication` int(11) NOT NULL AUTO_INCREMENT,
  `contenuPublication` text NOT NULL,
  `datePublication` datetime NOT NULL,
  `idUtilisateur` int(11) NOT NULL,
  `typePublication` varchar(50) NOT NULL,
  `jaime` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idPublication`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `publications`
--

LOCK TABLES `publications` WRITE;
/*!40000 ALTER TABLE `publications` DISABLE KEYS */;
INSERT INTO `publications` VALUES (4,'Message de test','2022-01-16 18:20:23',5,'post',0),(5,'sdzrteny','2022-02-01 11:23:03',1,'post',0),(6,'ccdcddc','2022-02-01 11:23:17',1,'annonce',0);
/*!40000 ALTER TABLE `publications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reponses`
--

DROP TABLE IF EXISTS `reponses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reponses` (
  `idReponse` int(11) NOT NULL AUTO_INCREMENT,
  `idPublication` int(11) NOT NULL,
  `reponse` varchar(250) NOT NULL,
  `idUtilisateur` int(11) NOT NULL,
  PRIMARY KEY (`idReponse`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reponses`
--

LOCK TABLES `reponses` WRITE;
/*!40000 ALTER TABLE `reponses` DISABLE KEYS */;
INSERT INTO `reponses` VALUES (2,5,'cccc',1);
/*!40000 ALTER TABLE `reponses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tachesprojet`
--

DROP TABLE IF EXISTS `tachesprojet`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tachesprojet` (
  `idTache` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) NOT NULL,
  `terminee` tinyint(1) NOT NULL,
  `idProjet` int(11) NOT NULL,
  PRIMARY KEY (`idTache`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tachesprojet`
--

LOCK TABLES `tachesprojet` WRITE;
/*!40000 ALTER TABLE `tachesprojet` DISABLE KEYS */;
INSERT INTO `tachesprojet` VALUES (1,'Tâche numéro 1',1,1),(2,'Tâche numéro 2',1,1),(3,'Tache Numéro 3',1,1);
/*!40000 ALTER TABLE `tachesprojet` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `utilisateurs` (
  `idUtilisateur` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `dateNaiss` date NOT NULL,
  `email` varchar(100) NOT NULL,
  `mdp` text NOT NULL,
  `idposte` int(11) NOT NULL,
  `photoProfil` varchar(250) NOT NULL DEFAULT 'https://st3.depositphotos.com/4111759/13425/v/600/depositphotos_134255634-stock-illustration-avatar-icon-male-profile-gray.jpg',
  `token` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idUtilisateur`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `utilisateurs`
--

LOCK TABLES `utilisateurs` WRITE;
/*!40000 ALTER TABLE `utilisateurs` DISABLE KEYS */;
INSERT INTO `utilisateurs` VALUES (1,'admin','admin','0010-10-10','admin@myteam.fr','$2y$10$8PUe6VH7pjMmdA8RgdEBZ.yZqUYcLLvOtl3F8qVNGUQjTUp4jKBse',1,'../pages/images/avatar/photoProfil.jpg','7efd8725fccb488ada31a529d2fe6e'),(2,'Accès','Utilisateur','2002-01-10','utilisateur@myteam.fr','$2y$10$sdMmx1kqSZvuYL.q38Igcew1tfStr9nR2ya.v056XuDr.BkPMPzKu',1,'../pages/images/avatar/photoProfil.jpg',NULL),(3,'Utilisateur','Numero1','2002-10-10','numero1@myteam.fr','$2y$10$MbTxzxavXzLdKU3N/fLEpeMb0i5Cr7QLVFInO.5.ala716MBGrRUe',1,'../pages/images/avatar/photoProfil.jpg',NULL),(4,'Utilisateur','Numero2','2002-01-01','numero2@myteam.fr','$2y$10$Q.mBzNdb9oHr.HOPwBn4X.r.kx8ABwxiVDm6tPWqtgAEyjLOotl1q',1,'../pages/images/avatar/photoProfil.jpg',NULL),(5,'Chaumont','Romain','2002-01-20','romain.chaumont@hotmail.fr','$2y$10$8Queu44GNgfMdN14xLNpdeRmbKK12vKQPr1UqILWpsNIp85jEUTnu',1,'../pages/images/avatar/photoProfil.jpg','3a466a5899faa582a805164ff9ffcf'),(11,'Chaumont','Romain','1010-10-10','romain.chaumont@hotmail.com','$2y$10$Z9VovUf0OsvlDoU0jL6Usu9eErn2Ga/P3TuxXByi3sFAZilFxYoUC',1,'../pages/images/avatar/photoProfil.jpg',NULL),(12,'Visiteur','Utilisateur','2002-02-10','utilisateur.visiteur@myteam.fr','$2y$10$2yr5q2nHMiVupWrMLeE7NuLQWNcquYsXee31lkFBXHo1mzbSL2JhO',3,'../pages/images/avatar/photoProfil.jpg',NULL);
/*!40000 ALTER TABLE `utilisateurs` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`ipssisqmyteam`@`%`*/ /*!50003 TRIGGER before_delete_utilisateurs BEFORE DELETE ON utilisateurs
 FOR EACH ROW BEGIN
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
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-02-02 12:14:21
