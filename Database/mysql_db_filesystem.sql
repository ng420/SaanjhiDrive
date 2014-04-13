CREATE DATABASE  IF NOT EXISTS `mysql_db` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `mysql_db`;
-- MySQL dump 10.13  Distrib 5.6.13, for Win32 (x86)
--
-- Host: localhost    Database: mysql_db
-- ------------------------------------------------------
-- Server version	5.6.16

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
-- Table structure for table `filesystem`
--

DROP TABLE IF EXISTS `filesystem`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `filesystem` (
  `file_id` int(10) NOT NULL,
  `file_name` varchar(50) NOT NULL,
  `owner` varchar(50) NOT NULL,
  `shared_with` text,
  `file_hash` varchar(50) DEFAULT NULL,
  `directory_path` text NOT NULL,
  `isFolder` varchar(45) NOT NULL,
  PRIMARY KEY (`file_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `filesystem`
--

LOCK TABLES `filesystem` WRITE;
/*!40000 ALTER TABLE `filesystem` DISABLE KEYS */;
INSERT INTO `filesystem` VALUES (1,'1.jpg','abhishek',NULL,'sadfasdfasdfasdfasd','!','0'),(2,'Chrysanthemum.jpg','abhishek',NULL,'076e3caed758a1c18c91a0e9cae3368f','!a!','0'),(3,'Desert.jpg','abhishek',NULL,'ba45c8f60456a672e003a875e469d0eb','!a!b!','0'),(8,'dwalina','abhishek',NULL,NULL,'!','1'),(9,'dwalinb','abhishek',NULL,NULL,'!a!','1'),(10,'dwalinc','abhishek',NULL,NULL,'!a!','1'),(11,'dwaline','abhishek',NULL,NULL,'!a!c!','1'),(4,'Hydrangeas.jpg','abhishek',NULL,'bdf3bf1da3405725be763540d6601144','!a!c!','0'),(5,'Jellyfish.jpg','abhishek',NULL,'5a44c7ba5bbe4ec867233d67e4806848','!a!c!e!','0'),(6,'Lighthouse.jpg','abhishek',NULL,'8969288f4245120e7c3870287cce0ff3','!','0'),(7,'Penguins.jpg','abhishek',NULL,'9d377b10ce778c4938b3c7e2c63a229a','sdasd','0');
/*!40000 ALTER TABLE `filesystem` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-04-14  3:00:32
