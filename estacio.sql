-- MySQL dump 10.13  Distrib 8.0.40, for Linux (x86_64)
--
-- Host: localhost    Database: estacio
-- ------------------------------------------------------
-- Server version	8.0.40-0ubuntu0.24.04.1

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
-- Table structure for table `curso`
--

DROP TABLE IF EXISTS `curso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `curso` (
  `id_curso` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  PRIMARY KEY (`id_curso`),
  UNIQUE KEY `nome` (`nome`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `curso`
--

LOCK TABLES `curso` WRITE;
/*!40000 ALTER TABLE `curso` DISABLE KEYS */;
INSERT INTO `curso` VALUES (3,'Análise e Desenvolvimento de Sistemas');
/*!40000 ALTER TABLE `curso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `horario`
--

DROP TABLE IF EXISTS `horario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `horario` (
  `id_horario` int NOT NULL AUTO_INCREMENT,
  `ara` varchar(10) NOT NULL,
  `sala` varchar(10) NOT NULL,
  `turno` enum('manha','tarde','noite') NOT NULL,
  `dia_semana` enum('segunda','terca','quarta','quinta','sexta') NOT NULL,
  `id_curso` int NOT NULL,
  `id_materia` int NOT NULL,
  `id_usuario` int NOT NULL,
  PRIMARY KEY (`id_horario`),
  KEY `id_curso` (`id_curso`),
  KEY `id_materia` (`id_materia`),
  KEY `id_usuario` (`id_usuario`),
  CONSTRAINT `horario_ibfk_1` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id_curso`),
  CONSTRAINT `horario_ibfk_2` FOREIGN KEY (`id_materia`) REFERENCES `materia` (`id_materia`),
  CONSTRAINT `horario_ibfk_3` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `horario`
--

LOCK TABLES `horario` WRITE;
/*!40000 ALTER TABLE `horario` DISABLE KEYS */;
INSERT INTO `horario` VALUES (12,'0097','Lab 7','noite','terca',3,4,20),(13,'A1','101','manha','segunda',3,4,20),(14,'A2','102','tarde','terca',3,4,20),(15,'B1','103','noite','quarta',3,4,20),(16,'B2','104','manha','quinta',3,4,20),(17,'C1','105','tarde','sexta',3,4,20),(18,'C2','106','noite','segunda',3,4,20),(19,'D1','107','manha','terca',3,4,20),(20,'D2','108','tarde','quarta',3,4,20),(21,'E1','109','noite','quinta',3,4,20),(22,'E2','110','manha','sexta',3,4,20),(23,'F1','111','tarde','segunda',3,4,20),(24,'F2','112','noite','terca',3,4,20),(25,'G1','113','manha','quarta',3,4,20),(26,'G2','114','tarde','quinta',3,4,20),(27,'H1','115','noite','sexta',3,4,20),(28,'H2','116','manha','segunda',3,4,20),(29,'I1','117','tarde','terca',3,4,20),(30,'I2','118','noite','quarta',3,4,20),(31,'J1','119','manha','quinta',3,4,20),(32,'J2','120','tarde','sexta',3,4,20),(33,'K1','121','noite','segunda',3,4,20),(34,'K2','122','manha','terca',3,4,20),(35,'L1','123','tarde','quarta',3,4,20),(36,'L2','124','noite','quinta',3,4,20),(37,'M1','125','manha','sexta',3,4,20),(38,'M2','126','tarde','segunda',3,4,20),(39,'N1','127','noite','terca',3,4,20),(40,'N2','128','manha','quarta',3,4,20),(41,'O1','129','tarde','quinta',3,4,20),(42,'O2','130','noite','sexta',3,4,20);
/*!40000 ALTER TABLE `horario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `materia`
--

DROP TABLE IF EXISTS `materia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `materia` (
  `id_materia` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `id_curso` int NOT NULL,
  PRIMARY KEY (`id_materia`),
  KEY `id_curso` (`id_curso`),
  CONSTRAINT `materia_ibfk_1` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id_curso`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `materia`
--

LOCK TABLES `materia` WRITE;
/*!40000 ALTER TABLE `materia` DISABLE KEYS */;
INSERT INTO `materia` VALUES (4,'Engenharia de Software',3);
/*!40000 ALTER TABLE `materia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pedido_alteracao`
--

DROP TABLE IF EXISTS `pedido_alteracao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pedido_alteracao` (
  `id_pedido_alteracao` int NOT NULL AUTO_INCREMENT,
  `ara` varchar(10) NOT NULL,
  `sala` varchar(10) NOT NULL,
  `turno` enum('manha','tarde','noite') NOT NULL,
  `dia_semana` enum('segunda','terca','quarta','quinta','sexta') NOT NULL,
  `id_curso` int NOT NULL,
  `id_materia` int NOT NULL,
  `id_usuario` int NOT NULL,
  PRIMARY KEY (`id_pedido_alteracao`),
  KEY `id_curso` (`id_curso`),
  KEY `id_materia` (`id_materia`),
  KEY `id_usuario` (`id_usuario`),
  CONSTRAINT `pedido_alteracao_ibfk_1` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id_curso`),
  CONSTRAINT `pedido_alteracao_ibfk_2` FOREIGN KEY (`id_materia`) REFERENCES `materia` (`id_materia`),
  CONSTRAINT `pedido_alteracao_ibfk_3` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pedido_alteracao`
--

LOCK TABLES `pedido_alteracao` WRITE;
/*!40000 ALTER TABLE `pedido_alteracao` DISABLE KEYS */;
INSERT INTO `pedido_alteracao` VALUES (9,'A1','101','manha','segunda',3,4,20),(12,'B2','104','manha','quinta',3,4,20),(14,'C2','106','noite','segunda',3,4,20),(15,'D1','107','manha','terca',3,4,20),(18,'E2','110','manha','sexta',3,4,20),(19,'F1','111','tarde','segunda',3,4,20),(21,'G1','113','manha','quarta',3,4,20),(24,'H2','116','manha','segunda',3,4,20),(27,'J1','119','manha','quinta',3,4,20),(29,'K1','121','noite','segunda',3,4,20),(30,'K2','122','manha','terca',3,4,20),(33,'M1','125','manha','sexta',3,4,20),(34,'M2','126','tarde','segunda',3,4,20),(36,'N2','128','manha','quarta',3,4,20);
/*!40000 ALTER TABLE `pedido_alteracao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuario` (
  `id_usuario` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `tipo_usuario` enum('admin','professor','telao') NOT NULL,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `usuario` (`usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (18,'Admin DEV','admin-dev','$2y$10$/Iymg3uvzX0UAPjHzYyncuab1BqCAVakkb12ikoY8xs32Diq1kwAm','admin'),(20,'Enilda Caceres','enilda','$2y$10$ILfyJkvT1raiuLc6OUFhUuXEXu4HCFxBwWrhYOX.D5iAGomTbYrpy','professor'),(21,'João Silva','joao.silva','senha123','admin'),(22,'Maria Oliveira','maria.oliveira','senha123','professor'),(23,'Pedro Santos','pedro.santos','senha123','telao'),(24,'Ana Costa','ana.costa','senha123','admin'),(25,'Lucas Pereira','lucas.pereira','senha123','professor'),(26,'Rita Souza','rita.souza','senha123','telao'),(27,'Carlos Lima','carlos.lima','senha123','admin'),(28,'Patricia Almeida','patricia.almeida','senha123','professor'),(29,'Felipe Martins','felipe.martins','senha123','telao'),(30,'Juliana Rocha','juliana.rocha','senha123','admin'),(31,'Bruna Oliveira','bruna.oliveira','senha123','professor'),(32,'Marcos Ferreira','marcos.ferreira','senha123','telao'),(33,'Thiago Santos','thiago.santos','senha123','admin'),(34,'Camila Pereira','camila.pereira','senha123','professor'),(35,'Eduardo Ribeiro','eduardo.ribeiro','senha123','telao'),(36,'Vanessa Martins','vanessa.martins','senha123','admin'),(37,'Felipe Costa','felipe.costa','senha123','professor'),(38,'Luana Souza','luana.souza','senha123','telao'),(39,'Gabriel Lima','gabriel.lima','senha123','admin'),(40,'Amanda Almeida','amanda.almeida','senha123','professor'),(41,'Ricardo Rocha','ricardo.rocha','senha123','telao'),(42,'Beatriz Santos','beatriz.santos','senha123','admin'),(43,'Vinicius Pereira','vinicius.pereira','senha123','professor'),(44,'Jéssica Martins','jessica.martins','senha123','telao'),(45,'Samuel Costa','samuel.costa','senha123','admin'),(46,'Renata Souza','renata.souza','senha123','professor'),(47,'Carlos Rocha','carlos.rocha','senha123','telao'),(48,'Fernanda Lima','fernanda.lima','senha123','admin'),(49,'Monique Oliveira','monique.oliveira','senha123','professor'),(50,'André Santos','andre.santos','senha123','telao'),(51,'Professor DEV','professor-dev','$2y$10$I.kgY77ci6hsoQzouTtHEeykKDlyT7n5XEqQ4jS7hJ5dt5xkJLo6C','professor');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-11-21 19:27:56
