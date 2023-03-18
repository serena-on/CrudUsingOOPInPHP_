-- MySQL dump 10.13  Distrib 8.0.32, for Linux (x86_64)
--
-- Host: localhost    Database: AGRI_DIGITAL
-- ------------------------------------------------------
-- Server version	8.0.32-0ubuntu0.20.04.2

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `AGENT`
--

DROP TABLE IF EXISTS `AGENT`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `AGENT` (
  `NumMatr` int NOT NULL AUTO_INCREMENT,
  `NomAgent` varchar(20) NOT NULL,
  `PrenomAgent` varchar(20) NOT NULL,
  `DateNais` date NOT NULL,
  `DatePSce` date NOT NULL,
  `Password` varchar(100) NOT NULL,
  `Username` varchar(20) NOT NULL,
  `Profile` varchar(70) DEFAULT NULL,
  `Email` varchar(70) NOT NULL,
  PRIMARY KEY (`NumMatr`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `AGENT`
--

LOCK TABLES `AGENT` WRITE;
/*!40000 ALTER TABLE `AGENT` DISABLE KEYS */;
INSERT INTO `AGENT` VALUES (1,'Jojo','Crypto','2023-03-28','2023-03-08','jojo','','',''),(2,'ONIROKOU','Séréna','2023-03-09','2023-03-03','$argon2id$v=19$m=65536,t=4,p=1$NlF4d29qckcvdXNucFZTRw$qoO431+h2JXoU4mmgc5lUEQ0Q8JPGDls6SvrA+fUlw8','','',''),(3,'Nom','John','2023-03-03','2023-03-04','$argon2id$v=19$m=65536,t=4,p=1$d3F0MGNFUTgwaVUveVF5Zg$aMfg1NrzCAWIIra4S/ZAWqnhT3qVKyPixxkfnXLpL5I','0000',NULL,'berylhoe@gmail.com');
/*!40000 ALTER TABLE `AGENT` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `entrepot`
--

DROP TABLE IF EXISTS `entrepot`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `entrepot` (
  `CodEntrep` varchar(10) NOT NULL,
  `LibEntrep` varchar(40) NOT NULL,
  `AdrEntrep` varchar(40) NOT NULL,
  `CodLoca` varchar(5) NOT NULL,
  PRIMARY KEY (`CodEntrep`),
  KEY `fk_CodLoca` (`CodLoca`),
  CONSTRAINT `fk_CodLoca` FOREIGN KEY (`CodLoca`) REFERENCES `localite` (`CodLoca`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `entrepot`
--

LOCK TABLES `entrepot` WRITE;
/*!40000 ALTER TABLE `entrepot` DISABLE KEYS */;
INSERT INTO `entrepot` VALUES ('codEntrep1','LibEntrep','AdrEntrep','Ctn');
/*!40000 ALTER TABLE `entrepot` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `localite`
--

DROP TABLE IF EXISTS `localite`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `localite` (
  `CodLoca` varchar(5) NOT NULL,
  `LibLoca` varchar(40) NOT NULL,
  PRIMARY KEY (`CodLoca`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `localite`
--

LOCK TABLES `localite` WRITE;
/*!40000 ALTER TABLE `localite` DISABLE KEYS */;
INSERT INTO `localite` VALUES ('Ab','Abomey-Calavi'),('Ctn','Cotonou'),('Tcha','Tchaorou');
/*!40000 ALTER TABLE `localite` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produit`
--

DROP TABLE IF EXISTS `produit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `produit` (
  `CodProd` varchar(5) NOT NULL,
  `LibProd` varchar(40) NOT NULL,
  `PrixProd` int NOT NULL,
  PRIMARY KEY (`CodProd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produit`
--

LOCK TABLES `produit` WRITE;
/*!40000 ALTER TABLE `produit` DISABLE KEYS */;
/*!40000 ALTER TABLE `produit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stocker`
--

DROP TABLE IF EXISTS `stocker`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `stocker` (
  `QteStock` int NOT NULL,
  `QteAvarie` int NOT NULL,
  `CodEntrep` varchar(10) NOT NULL,
  `CodProd` varchar(5) NOT NULL,
  PRIMARY KEY (`CodEntrep`,`CodProd`),
  KEY `CodEntrep` (`CodEntrep`),
  KEY `fk_CodProd` (`CodProd`),
  CONSTRAINT `CodEntrep` FOREIGN KEY (`CodEntrep`) REFERENCES `entrepot` (`CodEntrep`),
  CONSTRAINT `fk_CodProd` FOREIGN KEY (`CodProd`) REFERENCES `produit` (`CodProd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stocker`
--

LOCK TABLES `stocker` WRITE;
/*!40000 ALTER TABLE `stocker` DISABLE KEYS */;
/*!40000 ALTER TABLE `stocker` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-03-18  9:17:24
