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
  `file_hash` varchar(50) NOT NULL,
  PRIMARY KEY (`file_id`,`owner`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `filesystem`
--

LOCK TABLES `filesystem` WRITE;
/*!40000 ALTER TABLE `filesystem` DISABLE KEYS */;
INSERT INTO `filesystem` VALUES (1,'Screenshot (1).png','abhishek',NULL,'81e48e671a747ad8411b12db95e599e5'),(2,'Screenshot (2).png','abhishek',NULL,'eba4456863cc453cec9722bcd1cc8533'),(3,'Screenshot (4).png','abhishek',NULL,'eeb31f9092a326ebb5b864fb2e08a2de'),(4,'Screenshot (5).png','abhishek',NULL,'8d6b006dba2ce2c4b51c52528c57544b'),(5,'Screenshot (6).png','abhishek',NULL,'eb9ed40c053ca0852fd7e660429e4f1f'),(6,'Screenshot (7).png','abhishek',NULL,'ddd3ea1e3a999095cb4b71f506b7be37'),(7,'1512821_10152140963247488_309194119_n.jpg','abhishek',NULL,'d22d8bf17fb3287d93f25019bf8d4e49'),(8,'aeNVKWb_700b.jpg','abhishek',NULL,'3f28869f318db01be9788f8a7b179486'),(9,'movie_name.txt','abhishek',NULL,'e37659078b803a2b8920d9b817b4354a'),(10,'USER MANUAL.docx','abhishek',NULL,'6173bb1d82c159483619a4c0a237232b'),(11,'tumblr_mwf75jVbzN1qmdseuo3_500.png','abhishek',NULL,'d45460d025ebf482b654d185c14fc5e6'),(12,'tumblr_mwf75jVbzN1qmdseuo4_500.jpg','abhishek',NULL,'383bddc21134ea5a02160e2dd2ef8f81'),(13,'tumblr_mwf75jVbzN1qmdseuo1_500.jpg','abhishek',NULL,'c0de248691f85f56bb43370badee3658'),(14,'tumblr_mwf75jVbzN1qmdseuo2_500.jpg','abhishek',NULL,'28f4eced7462076606f17aa5fc1ff00b'),(15,'movie_name_simple.txt','abhishek',NULL,'41723927a5ec498a59fcbc8c9fe65249'),(16,'python.pdf','abhishek',NULL,'6207682fecddfc61853e09974f758edd'),(16,'python.pdf','sdafas',NULL,'6207682fecddfc61853e09974f758edd'),(17,'letsMake_participants.pdf','abhishek',NULL,'82247627d6ef2089b52717ebdaab47e4'),(17,'letsMake_participants.pdf','sdafas',NULL,'82247627d6ef2089b52717ebdaab47e4'),(18,'devenv.exe.config','abhishek',NULL,'4fec52a7cc92554b0588144a36a97aff');
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

-- Dump completed on 2014-04-13 14:45:26
