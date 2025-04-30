-- MySQL dump 10.13  Distrib 8.4.3, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: auditoria
-- ------------------------------------------------------
-- Server version	8.4.3

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
-- Table structure for table `action_types`
--

DROP TABLE IF EXISTS `action_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `action_types` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `action_types_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `action_types`
--

LOCK TABLES `action_types` WRITE;
/*!40000 ALTER TABLE `action_types` DISABLE KEYS */;
INSERT INTO `action_types` VALUES (1,'Sem Ação','2025-04-28 22:51:47','2025-04-28 22:51:47'),(2,'Abertura','2025-04-28 22:51:47','2025-04-28 22:51:47'),(3,'Informação','2025-04-28 22:51:47','2025-04-28 22:51:47'),(4,'Encaminhamento','2025-04-28 22:51:47','2025-04-28 22:51:47'),(5,'Corretiva','2025-04-28 22:51:47','2025-04-28 22:51:47'),(6,'Incompleta','2025-04-28 22:53:11','2025-04-28 22:53:11'),(7,'Cancelamento','2025-04-28 22:53:12','2025-04-28 22:53:12');
/*!40000 ALTER TABLE `action_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `agents`
--

DROP TABLE IF EXISTS `agents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `agents` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `agents_code_unique` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `agents`
--

LOCK TABLES `agents` WRITE;
/*!40000 ALTER TABLE `agents` DISABLE KEYS */;
INSERT INTO `agents` VALUES (1,'400501','Jhuanmontalvão',1,'2025-04-28 20:58:00','2025-04-28 20:58:00'),(2,'400426','Alyane Silva',1,'2025-04-28 20:58:00','2025-04-28 20:58:00'),(3,'400403','Paulo Henrique Ribeiro Da Silva',1,'2025-04-28 20:58:00','2025-04-28 20:58:00'),(4,'400402','Nycollas Martins',1,'2025-04-28 20:58:00','2025-04-28 20:58:00'),(5,'400423','Hugo Rocha',1,'2025-04-28 20:58:00','2025-04-28 20:58:00'),(6,'400425','Debora Oliveira',1,'2025-04-28 20:58:00','2025-04-28 20:58:00'),(7,'400405','Samara Rodrigues',1,'2025-04-28 20:58:00','2025-04-28 20:58:00'),(8,'400422','Denys Oliveira',1,'2025-04-28 20:58:00','2025-04-28 20:58:00'),(9,'400424','Raissa Sousa',1,'2025-04-28 20:58:00','2025-04-28 20:58:00'),(10,'400427','Vicente Neto',1,'2025-04-28 20:58:00','2025-04-28 20:58:00'),(11,'400401','Teddy Rodrigues',1,'2025-04-28 20:58:00','2025-04-28 20:58:00'),(12,'400502','Matheus Vieira',1,'2025-04-28 20:58:00','2025-04-28 20:58:00'),(13,'400503','Eduardo Rodrigues',1,'2025-04-28 20:58:00','2025-04-28 20:58:00'),(14,'400504','Adeilson Alves',1,'2025-04-28 20:58:00','2025-04-28 20:58:00'),(15,'400421','Matheus Accioly',1,'2025-04-28 20:58:00','2025-04-28 20:58:00'),(16,'400413','Matheus Henrique',1,'2025-04-28 20:58:00','2025-04-28 20:58:00'),(17,'400418','Leandro Souza',1,'2025-04-28 20:58:00','2025-04-28 20:58:00'),(18,'400417','Breno Marques',1,'2025-04-28 20:58:00','2025-04-28 20:58:00'),(19,'400416','Adalberto Filho',1,'2025-04-28 20:58:00','2025-04-28 20:58:00');
/*!40000 ALTER TABLE `agents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `call_results`
--

DROP TABLE IF EXISTS `call_results`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `call_results` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `call_results_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `call_results`
--

LOCK TABLES `call_results` WRITE;
/*!40000 ALTER TABLE `call_results` DISABLE KEYS */;
INSERT INTO `call_results` VALUES (1,'Engano','2025-04-28 22:51:47','2025-04-28 22:51:47'),(2,'Atendida','2025-04-28 22:51:47','2025-04-28 22:51:47'),(3,'Não atendida','2025-04-28 22:51:47','2025-04-28 22:51:47'),(4,'Interrompida','2025-04-28 22:51:47','2025-04-28 22:51:47'),(5,'Teste','2025-04-28 22:51:47','2025-04-28 22:51:47'),(6,'Abandono','2025-04-28 22:51:47','2025-04-28 22:51:47');
/*!40000 ALTER TABLE `call_results` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `calls`
--

DROP TABLE IF EXISTS `calls`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `calls` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `agent_id` bigint unsigned NOT NULL,
  `client_id` bigint unsigned NOT NULL,
  `server_id` bigint unsigned DEFAULT NULL,
  `action_type_id` bigint unsigned NOT NULL,
  `final_status_id` bigint unsigned NOT NULL,
  `call_result_id` bigint unsigned NOT NULL,
  `problem_description_id` bigint unsigned DEFAULT NULL,
  `ticket_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `call_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `observation` text COLLATE utf8mb4_unicode_ci,
  `wait_time` int NOT NULL DEFAULT '0',
  `remote_access` tinyint(1) NOT NULL DEFAULT '0',
  `call_date` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `calls_agent_id_foreign` (`agent_id`),
  KEY `calls_client_id_foreign` (`client_id`),
  KEY `calls_server_id_foreign` (`server_id`),
  KEY `calls_action_type_id_foreign` (`action_type_id`),
  KEY `calls_final_status_id_foreign` (`final_status_id`),
  KEY `calls_call_result_id_foreign` (`call_result_id`),
  KEY `calls_problem_description_id_foreign` (`problem_description_id`),
  CONSTRAINT `calls_action_type_id_foreign` FOREIGN KEY (`action_type_id`) REFERENCES `action_types` (`id`) ON DELETE RESTRICT,
  CONSTRAINT `calls_agent_id_foreign` FOREIGN KEY (`agent_id`) REFERENCES `agents` (`id`) ON DELETE CASCADE,
  CONSTRAINT `calls_call_result_id_foreign` FOREIGN KEY (`call_result_id`) REFERENCES `call_results` (`id`) ON DELETE RESTRICT,
  CONSTRAINT `calls_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE,
  CONSTRAINT `calls_final_status_id_foreign` FOREIGN KEY (`final_status_id`) REFERENCES `final_statuses` (`id`) ON DELETE RESTRICT,
  CONSTRAINT `calls_problem_description_id_foreign` FOREIGN KEY (`problem_description_id`) REFERENCES `problem_descriptions` (`id`) ON DELETE SET NULL,
  CONSTRAINT `calls_server_id_foreign` FOREIGN KEY (`server_id`) REFERENCES `servers` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=200 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `calls`
--

LOCK TABLES `calls` WRITE;
/*!40000 ALTER TABLE `calls` DISABLE KEYS */;
INSERT INTO `calls` VALUES (1,1,1,10,1,1,1,21,'1','',NULL,NULL,0,0,'2025-03-05 14:17:34','2025-04-28 22:51:47','2025-04-30 19:04:08'),(2,2,1,NULL,2,2,2,1,'15','',NULL,'',0,0,'2025-03-06 14:52:04','2025-04-28 22:51:47','2025-04-28 22:51:47'),(3,1,1,NULL,1,3,3,NULL,'16','',NULL,'',0,0,'2025-03-06 15:47:27','2025-04-28 22:51:47','2025-04-28 22:51:47'),(4,1,1,NULL,1,3,4,NULL,'17','',NULL,'',23,0,'2025-03-06 15:48:15','2025-04-28 22:51:47','2025-04-28 22:51:47'),(5,1,1,NULL,1,3,3,NULL,'18','',NULL,'',33,0,'2025-03-06 15:49:20','2025-04-28 22:51:47','2025-04-28 22:51:47'),(6,1,1,NULL,1,3,4,NULL,'19','',NULL,'Samara comenta que Matheus bloqueou a propria maquina e as ligações estão caindo',26,0,'2025-03-06 15:49:50','2025-04-28 22:51:47','2025-04-28 22:51:47'),(7,6,3,NULL,1,4,5,2,'23','',NULL,'Inicio de Sequência de testes da URA (62)3269-4102\nPreposto do contrato Antonio e José Inácio',0,0,'2025-03-07 09:55:28','2025-04-28 22:51:47','2025-04-28 22:51:47'),(8,3,1,NULL,1,3,4,NULL,'29','',NULL,'',0,0,'2025-03-07 12:24:46','2025-04-28 22:51:47','2025-04-28 22:51:47'),(9,3,1,NULL,1,3,4,NULL,'30','',NULL,'',0,0,'2025-03-07 11:18:42','2025-04-28 22:51:47','2025-04-28 22:51:47'),(10,3,1,NULL,1,4,5,NULL,'31','',NULL,'',0,0,'2025-03-07 11:30:18','2025-04-28 22:51:47','2025-04-28 22:51:47'),(11,3,1,NULL,1,4,5,NULL,'32','',NULL,'',0,0,'2025-03-07 11:31:57','2025-04-28 22:51:47','2025-04-28 22:51:47'),(12,6,3,NULL,1,4,5,NULL,'33','',NULL,'',0,0,'2025-03-07 12:24:46','2025-04-28 22:51:47','2025-04-28 22:51:47'),(13,6,3,NULL,1,4,5,NULL,'34','',NULL,'',0,0,'2025-03-07 12:31:45','2025-04-28 22:51:47','2025-04-28 22:51:47'),(14,6,3,NULL,1,3,4,NULL,'36','',NULL,'',0,0,'2025-03-07 13:38:35','2025-04-28 22:51:47','2025-04-28 22:51:47'),(15,8,2,NULL,3,2,2,3,'37','',NULL,'Informação de categoria para abertura de chamados no SEI para banco de dados',0,0,'2025-03-07 13:49:27','2025-04-28 22:51:47','2025-04-28 22:51:47'),(16,6,3,NULL,3,2,2,2,'39','',NULL,'Repasse para Vanessa G4F',0,0,'2025-03-07 14:23:17','2025-04-28 22:51:47','2025-04-28 22:51:47'),(17,8,2,NULL,1,3,3,NULL,'40','',NULL,'',0,0,'2025-03-07 15:27:26','2025-04-28 22:51:47','2025-04-28 22:51:47'),(18,5,2,NULL,4,2,2,4,'43','INC0027638',NULL,'',0,1,'2025-03-10 08:19:46','2025-04-28 22:51:47','2025-04-28 22:51:47'),(19,3,1,NULL,5,2,2,5,'50','',NULL,'',0,0,'2025-03-10 10:06:21','2025-04-28 22:51:47','2025-04-28 22:51:47'),(20,2,1,NULL,1,4,5,NULL,'54','',NULL,'',0,0,'2025-03-10 15:22:24','2025-04-28 22:51:47','2025-04-28 22:51:47'),(21,9,1,NULL,1,3,3,NULL,'55','',NULL,'',0,0,'2025-03-10 15:23:23','2025-04-28 22:51:47','2025-04-28 22:51:47'),(22,1,1,NULL,1,4,5,NULL,'56','',NULL,'',0,0,'2025-03-10 15:33:11','2025-04-28 22:51:47','2025-04-28 22:51:47'),(23,2,1,NULL,3,2,2,6,'57','',NULL,'Localização de local de reuniao com funcionario Mozart Super intendente de tecnologia',0,0,'2025-03-10 15:52:10','2025-04-28 22:51:47','2025-04-28 22:51:47'),(24,9,1,NULL,1,3,3,NULL,'59','',NULL,'',0,0,'2025-03-10 16:35:35','2025-04-28 22:51:47','2025-04-28 22:51:47'),(25,9,1,NULL,1,3,3,NULL,'61','',NULL,'',0,0,'2025-03-10 17:05:24','2025-04-28 22:51:47','2025-04-28 22:51:47'),(26,3,1,NULL,5,2,2,7,'64','',NULL,'Não consegue escrever no Teams',66,0,'2025-03-11 08:55:54','2025-04-28 22:51:47','2025-04-28 22:51:47'),(27,5,2,NULL,3,2,2,8,'65','',NULL,'Nesse caso o agente poderia ter aberto o chamado para o n2?',0,0,'2025-03-11 09:08:48','2025-04-28 22:51:47','2025-04-28 22:51:47'),(28,3,1,NULL,3,2,2,9,'68','',NULL,'Instalar o plugin de segurança do banco do brasil',0,0,'2025-03-11 10:34:39','2025-04-28 22:51:47','2025-04-28 22:51:47'),(29,5,2,NULL,3,2,2,10,'69','',NULL,'',0,0,'2025-03-11 10:36:05','2025-04-28 22:51:47','2025-04-28 22:51:47'),(30,9,1,NULL,1,3,3,NULL,'71','',NULL,'',0,0,'2025-03-11 11:01:17','2025-04-28 22:51:47','2025-04-28 22:51:47'),(31,9,1,NULL,1,3,3,NULL,'87','',NULL,'',0,0,'2025-03-12 15:54:10','2025-04-28 22:51:47','2025-04-28 22:51:47'),(32,9,1,NULL,1,3,3,NULL,'90','',NULL,'',0,0,'2025-03-13 10:12:25','2025-04-28 22:51:47','2025-04-28 22:51:47'),(33,10,1,NULL,1,3,6,NULL,'93','',NULL,'',0,0,'2025-03-13 10:36:29','2025-04-28 22:51:47','2025-04-28 22:51:47'),(34,9,1,NULL,1,3,3,NULL,'95','',NULL,'',0,0,'2025-03-13 10:45:17','2025-04-28 22:51:47','2025-04-28 22:51:47'),(35,3,1,NULL,1,3,3,NULL,'113','',NULL,'',0,0,'2025-03-17 07:11:21','2025-04-28 22:51:48','2025-04-28 22:51:48'),(36,3,1,NULL,5,2,2,9,'114','',NULL,'Instalação do IR',0,1,'2025-03-17 08:02:33','2025-04-28 22:51:48','2025-04-28 22:51:48'),(37,10,1,NULL,1,3,4,11,'117','',NULL,'',0,0,'2025-03-17 09:43:27','2025-04-28 22:51:48','2025-04-28 22:51:48'),(38,5,1,NULL,5,2,2,12,'118','',NULL,'',0,0,'2025-03-17 09:48:12','2025-04-28 22:51:48','2025-04-28 22:51:48'),(39,3,1,NULL,1,3,4,NULL,'123','',NULL,'',39,0,'2025-03-17 10:07:35','2025-04-28 22:51:48','2025-04-28 22:51:48'),(40,3,1,NULL,1,3,4,NULL,'124','',NULL,'',0,0,'2025-03-17 10:08:24','2025-04-28 22:51:48','2025-04-28 22:51:48'),(41,1,1,NULL,3,2,2,NULL,'138','',NULL,'',0,0,'2025-03-17 13:33:43','2025-04-28 22:51:48','2025-04-28 22:51:48'),(42,5,2,NULL,3,2,2,13,'145','RID001389',NULL,'',0,0,'2025-03-18 07:14:52','2025-04-28 22:51:48','2025-04-28 22:51:48'),(43,10,1,NULL,1,3,4,NULL,'146','',NULL,'',0,0,'2025-03-18 09:08:01','2025-04-28 22:51:48','2025-04-28 22:51:48'),(44,10,1,NULL,1,3,4,NULL,'152','',NULL,'',0,0,'2025-03-18 09:53:32','2025-04-28 22:51:48','2025-04-28 22:51:48'),(45,4,2,NULL,1,3,4,NULL,'153','',NULL,'',0,0,'2025-03-18 09:55:57','2025-04-28 22:51:48','2025-04-28 22:51:48'),(46,5,2,NULL,2,2,2,14,'155','',NULL,'',0,0,'2025-03-18 09:57:30','2025-04-28 22:51:48','2025-04-28 22:51:48'),(47,10,1,NULL,1,1,1,NULL,'156','',NULL,'',0,0,'2025-03-18 10:05:59','2025-04-28 22:51:48','2025-04-28 22:51:48'),(48,10,1,NULL,1,3,4,NULL,'157','',NULL,'',0,0,'2025-03-18 10:08:19','2025-04-28 22:51:48','2025-04-28 22:51:48'),(49,10,1,NULL,2,2,2,9,'158','',NULL,'instalação do IR',34,0,'2025-03-18 10:10:32','2025-04-28 22:51:48','2025-04-28 22:51:48'),(50,5,2,NULL,2,2,2,15,'159','',NULL,'',0,0,'2025-03-18 10:16:11','2025-04-28 22:51:48','2025-04-28 22:51:48'),(51,11,1,NULL,1,3,4,NULL,'162','',NULL,'',0,0,'2025-03-18 14:36:45','2025-04-28 22:51:48','2025-04-28 22:51:48'),(52,9,1,NULL,1,1,1,NULL,'164','',NULL,'',0,0,'2025-03-18 16:20:17','2025-04-28 22:51:48','2025-04-28 22:51:48'),(53,3,1,NULL,5,2,2,16,'167','',NULL,'',0,1,'2025-03-19 08:46:29','2025-04-28 22:51:48','2025-04-28 22:51:48'),(54,4,2,NULL,1,3,4,NULL,'169','',NULL,'',0,0,'2025-03-19 09:10:13','2025-04-28 22:51:48','2025-04-28 22:51:48'),(55,4,2,NULL,1,3,4,NULL,'170','',NULL,'',0,0,'2025-03-19 09:28:33','2025-04-28 22:51:48','2025-04-28 22:51:48'),(56,4,2,NULL,1,3,4,NULL,'171','',NULL,'',0,0,'2025-03-20 09:28:33','2025-04-28 22:51:48','2025-04-28 22:51:48'),(57,4,2,NULL,1,3,4,NULL,'172','',NULL,'',0,0,'2025-03-21 09:28:33','2025-04-28 22:51:48','2025-04-28 22:51:48'),(58,4,2,NULL,1,3,4,NULL,'173','',NULL,'',0,0,'2025-03-22 09:28:33','2025-04-28 22:51:48','2025-04-28 22:51:48'),(59,10,1,NULL,2,2,2,17,'180','',NULL,'',0,0,'2025-03-19 10:28:28','2025-04-28 22:51:48','2025-04-28 22:51:48'),(60,3,1,NULL,2,2,2,18,'182','',NULL,'',0,0,'2025-03-19 10:43:51','2025-04-28 22:51:48','2025-04-28 22:51:48'),(61,10,1,NULL,2,2,2,19,'183','',NULL,'',0,0,'2025-03-19 10:51:27','2025-04-28 22:51:48','2025-04-28 22:51:48'),(62,10,1,NULL,1,3,3,NULL,'185','',NULL,'',0,0,'2025-03-19 11:03:53','2025-04-28 22:51:48','2025-04-28 22:51:48'),(63,10,1,NULL,1,3,3,NULL,'187','',NULL,'',0,0,'2025-03-19 11:14:22','2025-04-28 22:51:48','2025-04-28 22:51:48'),(64,10,1,NULL,1,3,3,NULL,'191','',NULL,'',0,0,'2025-03-19 11:22:39','2025-04-28 22:51:48','2025-04-28 22:51:48'),(65,3,1,NULL,1,3,6,18,'197','',NULL,'',0,0,'2025-03-20 09:16:37','2025-04-28 22:51:48','2025-04-28 22:51:48'),(66,9,1,NULL,5,2,2,7,'198','',NULL,'',0,1,'2025-03-20 09:31:02','2025-04-28 22:51:48','2025-04-28 22:51:48'),(67,3,1,NULL,4,2,2,20,'199','',NULL,'',0,0,'2025-03-20 10:40:16','2025-04-28 22:51:48','2025-04-28 22:51:48'),(68,13,1,NULL,1,3,3,21,'200','',NULL,'Cliente reclama do Barulho',0,0,'2025-03-20 10:40:16','2025-04-28 22:51:48','2025-04-28 22:51:48'),(69,2,1,1,5,2,2,22,'2','',NULL,'',0,0,'2025-03-05 14:20:18','2025-04-28 22:53:11','2025-04-28 22:53:11'),(70,1,1,2,5,2,2,22,'3','',NULL,'',0,1,'2025-03-05 14:54:53','2025-04-28 22:53:11','2025-04-28 22:53:11'),(71,2,1,3,5,3,4,22,'4','',NULL,'cliente Renata Alves, problema no globalprotect não reconhece senha, 1ª ligação cai, a conta do próton + rede',0,1,'2025-03-05 16:07:51','2025-04-28 22:53:11','2025-04-28 22:53:11'),(72,1,1,3,5,3,4,22,'5','',NULL,'Esse é o procedimento padrão? Houve retorno para responder a cliente?\n2ª ligação,  continua o atendimento 004, usuário questiona o porque do procedimento de remoção nas credenciais do Windows, logo a ligação cai.',0,1,'2025-03-05 16:16:43','2025-04-28 22:53:11','2025-04-28 22:53:11'),(73,1,1,3,5,2,2,23,'6','',NULL,'Tempo superior a 15 segundos para inicio do atendimento',0,0,'2025-03-05 17:51:16','2025-04-28 22:53:11','2025-04-28 22:53:11'),(74,3,1,4,5,2,4,21,'7','',NULL,'Apesar de resolver o chamado ao final  o atendente não escuta mais o cliente',0,0,'2025-03-06 08:48:20','2025-04-28 22:53:11','2025-04-28 22:53:11'),(75,4,2,5,2,2,2,21,'8','',NULL,'Problema no email, login bloqueado, abertura de chamado para redes',0,0,'2025-03-06 09:10:35','2025-04-28 22:53:11','2025-04-28 22:53:11'),(76,4,2,6,3,2,2,24,'9','RITN0011246',NULL,'chamado RITN0011246(em andamento), andamento do chamado esta travado, email não cadastrado, cliente quer status de atendimento. O atendente desconhece a equipe e sistema responsável, procedimento descrito na nota técnica contida no chamado, o cadastro do email deve ser efetuado no sistema SGRH. Averiguar se possui SLA, ao tomar conhecimento de um novo procedimento, deve adotar a pratica de disseminar o conhecimento para equipe',0,0,'2025-03-06 09:24:15','2025-04-28 22:53:11','2025-04-28 22:53:11'),(77,4,2,7,4,5,2,25,'10','',NULL,'',0,0,'2025-03-06 09:42:28','2025-04-28 22:53:11','2025-04-28 22:53:11'),(78,5,2,8,4,6,2,26,'11','INC0027452',NULL,'chamado INC0027452, aberto 04/02 para reparo da impressora de crachá, após testes o tecnico informou que não havia problema fisico, cliente se queixa que o chamado foi fechado sem permissão e resolução. Cliente abriu novo chamado UR0010908',0,0,'2025-03-06 10:04:44','2025-04-28 22:53:11','2025-04-28 22:53:11'),(79,4,2,9,2,3,4,16,'12','',NULL,'Atendimento audio de outro atendimento vazando',0,0,'2025-03-06 10:09:17','2025-04-28 22:53:11','2025-04-28 22:53:11'),(80,4,2,9,2,2,2,16,'13','',NULL,'Abertura de chamado para instalaçao de perifiericos',0,0,'2025-03-06 10:12:33','2025-04-28 22:53:11','2025-04-28 22:53:11'),(81,5,2,10,4,2,2,15,'14','INC0031559',NULL,'',0,0,'2025-03-06 11:38:22','2025-04-28 22:53:11','2025-04-28 22:53:11'),(82,1,1,11,1,1,6,9,'20','',NULL,'O chamado é para instalar o sistema Hidro, serve para consultar as estações da ANA, cliente confundiu. O atendente deve ter relação de quais os sistemas pode dar manutenção no cliente',0,0,'2025-03-06 15:51:04','2025-04-28 22:53:11','2025-04-28 22:53:11'),(83,2,1,3,6,7,4,27,'21','',NULL,'Atendente disse ao cliente que retornaria, Aplicativo não abre as minutas, problema possivel,  troca de senha',0,0,'2025-03-06 16:11:22','2025-04-28 22:53:11','2025-04-28 22:53:11'),(84,4,2,8,3,7,2,26,'22','RIPN0011269',NULL,'RIPN0011269 Reparo da impressora de crachá',0,0,'2025-03-07 08:56:10','2025-04-28 22:53:11','2025-04-28 22:53:11'),(85,5,2,12,4,7,2,28,'24','',NULL,'Jhuan informa que não existia um procedimento para chamado dessa natureza, ate teve iniciativa de pesquisar em chamados semelhantes, porem cliente questiona encaminhamento para Redes, sendo que é uma questão de firewall, deveria ser encaminhado para Cyber',0,0,'2025-03-07 10:15:50','2025-04-28 22:53:11','2025-04-28 22:53:11'),(86,4,2,12,4,7,2,29,'25','INC0030830',NULL,'Matheus se desculpa, informa que pensou que chamados de senha seria encaminhado para redes, porem cliente questiona encaminhamento para redes sendo que quando é uma questão de senhas deveria ser encaminhado para Cyber, apenas problemas de email devem ser encaminhados para Redes',0,0,'2025-03-08 10:15:50','2025-04-28 22:53:11','2025-04-28 22:53:11'),(87,5,2,13,4,2,2,30,'26','INC0031637',NULL,'Ativação do ODIN',0,0,'2025-03-07 10:19:24','2025-04-28 22:53:11','2025-04-28 22:53:11'),(88,3,1,14,2,2,2,22,'27','',NULL,'',0,1,'2025-03-07 10:20:37','2025-04-28 22:53:11','2025-04-28 22:53:11'),(89,4,2,12,4,2,2,29,'28','INC0031548',NULL,'Encaminhamento de chamado de senha para cyber',0,0,'2025-03-07 10:22:24','2025-04-28 22:53:11','2025-04-28 22:53:11'),(90,7,2,15,3,2,2,3,'35','',NULL,'',0,0,'2025-03-07 13:05:48','2025-04-28 22:53:11','2025-04-28 22:53:11'),(91,6,3,16,5,4,5,2,'38','',NULL,'Gestor do contrato, configuração da URA',0,0,'2025-03-07 14:12:32','2025-04-28 22:53:11','2025-04-28 22:53:11'),(92,4,2,17,4,2,2,31,'41','',NULL,'',0,0,'2025-03-10 07:25:07','2025-04-28 22:53:11','2025-04-28 22:53:11'),(93,3,1,18,2,2,2,32,'42','',NULL,'',0,0,'2025-03-10 08:05:33','2025-04-28 22:53:11','2025-04-28 22:53:11'),(94,3,1,19,5,2,2,21,'44','',NULL,'Email bloqueado',0,0,'2025-03-10 08:22:24','2025-04-28 22:53:11','2025-04-28 22:53:11'),(95,3,1,20,5,2,2,33,'45','',NULL,'',0,1,'2025-03-10 09:17:02','2025-04-28 22:53:11','2025-04-28 22:53:11'),(96,3,1,21,5,2,2,34,'46','',NULL,'',25,1,'2025-03-10 09:25:29','2025-04-28 22:53:11','2025-04-28 22:53:11'),(97,4,2,22,4,2,2,9,'47','UR0010919',NULL,'',0,0,'2025-03-10 09:40:28','2025-04-28 22:53:11','2025-04-28 22:53:11'),(98,3,1,23,5,2,2,21,'48','',NULL,'',0,1,'2025-03-10 09:48:20','2025-04-28 22:53:11','2025-04-28 22:53:11'),(99,9,1,24,5,2,2,17,'49','',NULL,'Audio do atendente muito baixo',0,0,'2025-03-10 10:00:00','2025-04-28 22:53:11','2025-04-28 22:53:11'),(100,8,2,25,2,2,2,21,'51','',NULL,'Conceder acesso a VPN',0,0,'2025-03-10 13:33:40','2025-04-28 22:53:11','2025-04-28 22:53:11'),(101,7,2,12,1,1,1,35,'52','',NULL,'',0,0,'2025-03-10 14:15:51','2025-04-28 22:53:11','2025-04-28 22:53:11'),(102,8,2,12,4,2,2,29,'53','',NULL,'Encaminhar chamado a Cyber para conceder acesso a VPN',0,0,'2025-03-10 14:16:33','2025-04-28 22:53:11','2025-04-28 22:53:11'),(103,8,2,26,2,2,2,21,'58','',NULL,'',0,0,'2025-03-10 15:53:11','2025-04-28 22:53:12','2025-04-28 22:53:12'),(104,1,1,27,4,2,2,19,'60','',NULL,'',0,0,'2025-03-10 16:56:26','2025-04-28 22:53:12','2025-04-28 22:53:12'),(105,3,1,19,1,3,4,NULL,'62','',NULL,'Ligação caiu',0,0,'2025-03-11 08:25:30','2025-04-28 22:53:12','2025-04-28 22:53:12'),(106,3,1,19,4,2,2,36,'63','',NULL,'',0,1,'2025-03-11 08:27:28','2025-04-28 22:53:12','2025-04-28 22:53:12'),(107,4,2,28,4,2,2,37,'66','',NULL,'',0,0,'2025-03-11 09:42:06','2025-04-28 22:53:12','2025-04-28 22:53:12'),(108,3,1,29,2,2,2,9,'67','',NULL,'',0,1,'2025-03-11 10:02:41','2025-04-28 22:53:12','2025-04-28 22:53:12'),(109,4,2,30,2,2,2,27,'70','',NULL,'',0,0,'2025-03-11 10:50:07','2025-04-28 22:53:12','2025-04-28 22:53:12'),(110,3,1,31,2,2,2,38,'72','',NULL,'',0,0,'2025-03-11 11:02:31','2025-04-28 22:53:12','2025-04-28 22:53:12'),(111,5,2,32,1,3,4,NULL,'73','',NULL,'',0,0,'2025-03-11 12:50:38','2025-04-28 22:53:12','2025-04-28 22:53:12'),(112,2,1,33,2,2,2,21,'74','6955',NULL,'',0,0,'2025-03-11 15:36:45','2025-04-28 22:53:12','2025-04-28 22:53:12'),(113,4,2,34,2,2,2,39,'75','INC0032175',NULL,'',0,0,'2025-03-12 08:36:51','2025-04-28 22:53:12','2025-04-28 22:53:12'),(114,3,1,35,2,2,2,9,'76','6989',NULL,'Audio de outro atendente vazando',0,0,'2025-03-12 08:52:04','2025-04-28 22:53:12','2025-04-28 22:53:12'),(115,4,2,36,3,2,2,40,'77','UR0010564',NULL,'',0,0,'2025-03-12 09:18:52','2025-04-28 22:53:12','2025-04-28 22:53:12'),(116,5,2,37,6,7,2,41,'78','',NULL,'',0,1,'2025-03-12 09:29:35','2025-04-28 22:53:12','2025-04-28 22:53:12'),(117,3,1,38,5,2,2,22,'79','',NULL,'',0,0,'2025-03-12 10:07:52','2025-04-28 22:53:12','2025-04-28 22:53:12'),(118,4,2,11,3,2,2,42,'80','',NULL,'',0,0,'2025-03-12 10:07:52','2025-04-28 22:53:12','2025-04-28 22:53:12'),(119,3,1,33,4,2,2,21,'81','6955',NULL,'Bloqueio de senha, Formatação de notebook',0,0,'2025-03-12 10:21:54','2025-04-28 22:53:12','2025-04-28 22:53:12'),(120,9,1,39,6,7,2,22,'82','',NULL,'',0,0,'2025-03-12 11:12:34','2025-04-28 22:53:12','2025-04-28 22:53:12'),(121,7,2,13,3,2,2,29,'83','',NULL,'',0,1,'2025-03-12 13:54:08','2025-04-28 22:53:12','2025-04-28 22:53:12'),(122,1,1,40,5,2,2,19,'84','',NULL,'',0,0,'2025-03-12 14:16:33','2025-04-28 22:53:12','2025-04-28 22:53:12'),(123,2,1,41,2,2,2,43,'85','',NULL,'Configuração de primeiro acesso no notebook, fora do dominio',0,0,'2025-03-12 14:44:04','2025-04-28 22:53:12','2025-04-28 22:53:12'),(124,1,1,42,2,2,2,44,'86','',NULL,'',0,1,'2025-03-12 14:53:42','2025-04-28 22:53:12','2025-04-28 22:53:12'),(125,3,1,21,5,2,2,7,'88','',NULL,'',0,1,'2025-03-13 08:25:36','2025-04-28 22:53:12','2025-04-28 22:53:12'),(126,5,2,43,3,2,2,4,'89','',NULL,'',0,0,'2025-03-13 08:55:14','2025-04-28 22:53:12','2025-04-28 22:53:12'),(127,3,1,11,5,2,2,45,'91','',NULL,'',0,1,'2025-03-13 10:13:32','2025-04-28 22:53:12','2025-04-28 22:53:12'),(128,9,1,10,3,4,5,46,'92','',NULL,'',0,0,'2025-03-13 10:35:14','2025-04-28 22:53:12','2025-04-28 22:53:12'),(129,3,1,44,5,3,4,22,'94','',NULL,'',0,1,'2025-03-13 10:43:10','2025-04-28 22:53:12','2025-04-28 22:53:12'),(130,3,1,44,5,7,2,1,'96','',NULL,'',0,1,'2025-03-13 10:45:48','2025-04-28 22:53:12','2025-04-28 22:53:12'),(131,10,1,45,5,7,2,47,'97','',NULL,'',0,1,'2025-03-13 10:48:11','2025-04-28 22:53:12','2025-04-28 22:53:12'),(132,4,2,46,3,2,2,16,'98','',NULL,'Abertura de chamado para manutenção, kit biometrico dando choque',0,0,'2025-03-13 10:56:39','2025-04-28 22:53:12','2025-04-28 22:53:12'),(133,5,2,47,2,2,2,27,'99','RIPM0011356',NULL,'',0,0,'2025-03-13 11:36:43','2025-04-28 22:53:12','2025-04-28 22:53:12'),(134,2,1,48,5,7,2,21,'100','',NULL,'',0,1,'2025-03-13 14:53:06','2025-04-28 22:53:12','2025-04-28 22:53:12'),(135,1,1,23,4,2,2,9,'101','',NULL,'',52,0,'2025-03-13 15:05:08','2025-04-28 22:53:12','2025-04-28 22:53:12'),(136,1,1,49,2,2,2,48,'102','',NULL,'',0,0,'2025-03-13 15:47:25','2025-04-28 22:53:12','2025-04-28 22:53:12'),(137,2,1,23,5,7,4,21,'103','',NULL,'',0,0,'2025-03-13 16:19:18','2025-04-28 22:53:12','2025-04-28 22:53:12'),(138,1,1,50,2,2,2,49,'104','',NULL,'',0,0,'2025-03-13 16:27:24','2025-04-28 22:53:12','2025-04-28 22:53:12'),(139,3,1,51,5,7,4,21,'105','',NULL,'',0,0,'2025-03-14 08:45:46','2025-04-28 22:53:12','2025-04-28 22:53:12'),(140,4,2,52,2,2,2,7,'106','RICN0011303',NULL,'',0,0,'2025-03-14 09:00:38','2025-04-28 22:53:12','2025-04-28 22:53:12'),(141,10,1,53,2,2,2,11,'107','',NULL,'',0,0,'2025-03-14 09:19:49','2025-04-28 22:53:12','2025-04-28 22:53:12'),(142,5,1,5,3,2,2,7,'108','',NULL,'Erro de codigo acesso do Teams',0,0,'2025-03-14 09:28:29','2025-04-28 22:53:12','2025-04-28 22:53:12'),(143,3,1,54,5,2,2,50,'109','',NULL,'',0,0,'2025-03-14 10:05:38','2025-04-28 22:53:12','2025-04-28 22:53:12'),(144,2,1,55,2,2,2,7,'110','',NULL,'',0,0,'2025-03-14 14:31:42','2025-04-28 22:53:12','2025-04-28 22:53:12'),(145,1,1,56,2,2,2,21,'111','',NULL,'',0,0,'2025-03-14 14:39:57','2025-04-28 22:53:12','2025-04-28 22:53:12'),(146,2,1,57,3,2,2,7,'112','',NULL,'',0,1,'2025-03-14 15:43:25','2025-04-28 22:53:12','2025-04-28 22:53:12'),(147,4,2,58,2,2,2,51,'115','INC0032522',NULL,'',0,0,'2025-03-17 08:13:29','2025-04-28 22:53:12','2025-04-28 22:53:12'),(148,4,1,59,5,2,2,44,'116','',NULL,'',0,1,'2025-03-17 09:12:04','2025-04-28 22:53:12','2025-04-28 22:53:12'),(149,3,1,60,1,3,4,52,'119','',NULL,'Instalação do autenticator',0,0,'2025-03-17 09:54:23','2025-04-28 22:53:12','2025-04-28 22:53:12'),(150,10,1,60,5,2,2,52,'120','',NULL,'Instalação do autenticator',0,1,'2025-03-17 09:57:03','2025-04-28 22:53:12','2025-04-28 22:53:12'),(151,10,1,61,2,2,2,52,'122','',NULL,'',0,0,'2025-03-17 10:00:09','2025-04-28 22:53:12','2025-04-28 22:53:12'),(152,3,1,62,6,7,2,27,'125','',NULL,'',0,0,'2025-03-18 10:08:24','2025-04-28 22:53:12','2025-04-28 22:53:12'),(153,10,1,63,5,2,2,9,'126','',NULL,'Instalação do IR',20,1,'2025-03-17 10:10:39','2025-04-28 22:53:12','2025-04-28 22:53:12'),(154,3,1,62,5,2,2,27,'127','',NULL,'',0,0,'2025-03-17 10:12:10','2025-04-28 22:53:12','2025-04-28 22:53:12'),(155,4,2,64,1,3,4,NULL,'128','',NULL,'',0,0,'2025-03-17 10:27:29','2025-04-28 22:53:12','2025-04-28 22:53:12'),(156,10,1,65,2,2,2,53,'129','',NULL,'',0,0,'2025-03-17 10:28:39','2025-04-28 22:53:12','2025-04-28 22:53:12'),(157,4,1,64,2,2,2,54,'130','',NULL,'',0,0,'2025-03-17 10:29:07','2025-04-28 22:53:12','2025-04-28 22:53:12'),(158,10,1,66,2,2,2,55,'131','',NULL,'',0,0,'2025-03-17 10:48:45','2025-04-28 22:53:12','2025-04-28 22:53:12'),(159,5,1,67,1,3,4,NULL,'132','',NULL,'',0,0,'2025-03-17 11:25:48','2025-04-28 22:53:12','2025-04-28 22:53:12'),(160,4,2,67,2,2,2,41,'133','',NULL,'',0,0,'2025-03-17 11:26:37','2025-04-28 22:53:12','2025-04-28 22:53:12'),(161,5,2,64,3,2,2,54,'134','',NULL,'',0,0,'2025-03-17 11:33:50','2025-04-28 22:53:12','2025-04-28 22:53:12'),(162,10,1,68,2,2,2,9,'135','',NULL,'instalação do acrobat reader',0,0,'2025-03-17 12:11:46','2025-04-28 22:53:12','2025-04-28 22:53:12'),(163,3,1,69,5,2,2,9,'136','',NULL,'Instalação do IR',0,1,'2025-03-17 12:32:24','2025-04-28 22:53:12','2025-04-28 22:53:12'),(164,8,2,70,3,2,2,13,'137','RID0011292',NULL,'',0,0,'2025-03-17 13:25:46','2025-04-28 22:53:12','2025-04-28 22:53:12'),(165,2,1,71,5,2,2,56,'139','',NULL,'',0,0,'2025-03-17 15:52:23','2025-04-28 22:53:12','2025-04-28 22:53:12'),(166,1,1,71,7,2,2,57,'140','',NULL,'',0,0,'2025-03-17 16:00:55','2025-04-28 22:53:12','2025-04-28 22:53:12'),(167,1,1,18,2,2,2,11,'141','',NULL,'',0,0,'2025-03-17 16:07:06','2025-04-28 22:53:12','2025-04-28 22:53:12'),(168,2,1,72,2,2,2,58,'142','',NULL,'',0,0,'2025-03-17 16:40:57','2025-04-28 22:53:12','2025-04-28 22:53:12'),(169,1,1,73,3,2,2,21,'143','',NULL,'',0,0,'2025-03-17 16:59:32','2025-04-28 22:53:12','2025-04-28 22:53:12'),(170,2,1,74,2,2,2,44,'144','',NULL,'',0,0,'2025-03-17 17:58:59','2025-04-28 22:53:12','2025-04-28 22:53:12'),(171,3,1,63,2,2,2,7,'147','',NULL,'',0,1,'2025-03-18 09:14:27','2025-04-28 22:53:12','2025-04-28 22:53:12'),(172,3,1,75,1,3,4,NULL,'148','',NULL,'',0,0,'2025-03-18 09:29:32','2025-04-28 22:53:12','2025-04-28 22:53:12'),(173,3,1,75,5,2,2,48,'149','',NULL,'',0,1,'2025-03-18 09:32:02','2025-04-28 22:53:12','2025-04-28 22:53:12'),(174,10,1,76,2,2,2,39,'150','',NULL,'',0,0,'2025-03-18 09:35:02','2025-04-28 22:53:12','2025-04-28 22:53:12'),(175,3,1,77,3,2,2,59,'151','7199',NULL,'chamado 7200 em duplicidade sendo fechados',0,0,'2025-03-18 09:46:34','2025-04-28 22:53:12','2025-04-28 22:53:12'),(176,3,1,78,5,2,2,52,'154','',NULL,'',0,1,'2025-03-18 09:56:04','2025-04-28 22:53:12','2025-04-28 22:53:12'),(177,4,2,34,3,2,2,39,'160','INC0032175',NULL,'',0,0,'2025-03-18 10:38:02','2025-04-28 22:53:12','2025-04-28 22:53:12'),(178,5,2,34,3,2,2,39,'161','INC0032175',NULL,'',0,0,'2025-03-18 11:54:56','2025-04-28 22:53:12','2025-04-28 22:53:12'),(179,9,1,79,2,2,4,21,'163','',NULL,'',0,0,'2025-03-18 15:37:29','2025-04-28 22:53:12','2025-04-28 22:53:12'),(180,2,1,80,2,2,2,17,'165','',NULL,'',0,0,'2025-03-18 16:23:02','2025-04-28 22:53:12','2025-04-28 22:53:12'),(181,2,1,81,2,2,2,25,'166','',NULL,'',0,0,'2025-03-18 18:11:11','2025-04-28 22:53:13','2025-04-28 22:53:13'),(182,10,1,79,2,2,2,18,'168','',NULL,'',0,0,'2025-03-19 09:00:54','2025-04-28 22:53:13','2025-04-28 22:53:13'),(183,3,1,82,2,2,2,18,'174','',NULL,'',0,0,'2025-03-19 09:42:39','2025-04-28 22:53:13','2025-04-28 22:53:13'),(184,10,1,83,2,2,2,18,'175','',NULL,'',0,0,'2025-03-19 09:52:09','2025-04-28 22:53:13','2025-04-28 22:53:13'),(185,3,1,84,2,2,2,41,'176','',NULL,'',0,1,'2025-03-19 10:05:14','2025-04-28 22:53:13','2025-04-28 22:53:13'),(186,10,1,85,5,2,2,9,'177','',NULL,'Instalação do DEC',0,0,'2025-03-19 10:11:52','2025-04-28 22:53:13','2025-04-28 22:53:13'),(187,3,1,86,2,2,2,18,'178','',NULL,'',0,0,'2025-03-19 10:22:34','2025-04-28 22:53:13','2025-04-28 22:53:13'),(188,3,1,87,2,2,2,9,'179','',NULL,'Sistema duplicando chamados',0,0,'2025-03-19 10:27:37','2025-04-28 22:53:13','2025-04-28 22:53:13'),(189,10,1,88,2,2,2,18,'181','',NULL,'',0,0,'2025-03-19 10:32:18','2025-04-28 22:53:13','2025-04-28 22:53:13'),(190,3,1,89,2,2,2,17,'184','',NULL,'',0,0,'2025-03-19 10:51:34','2025-04-28 22:53:13','2025-04-28 22:53:13'),(191,10,1,89,1,3,3,52,'186','',NULL,'',0,0,'2025-03-19 11:12:56','2025-04-28 22:53:13','2025-04-28 22:53:13'),(192,10,1,90,5,3,4,7,'188','',NULL,'',0,1,'2025-03-19 11:17:22','2025-04-28 22:53:13','2025-04-28 22:53:13'),(193,10,1,89,1,3,2,NULL,'189','',NULL,'',0,0,'2025-03-19 11:17:34','2025-04-28 22:53:13','2025-04-28 22:53:13'),(194,10,1,89,1,3,6,NULL,'190','',NULL,'Cliente dispensou o atendente',0,0,'2025-03-19 11:22:02','2025-04-28 22:53:13','2025-04-28 22:53:13'),(195,3,1,89,5,2,2,52,'192','',NULL,'',0,1,'2025-03-19 11:48:59','2025-04-28 22:53:13','2025-04-28 22:53:13'),(196,10,1,69,5,2,2,19,'193','',NULL,'',0,0,'2025-03-19 12:13:42','2025-04-28 22:53:13','2025-04-28 22:53:13'),(197,1,1,91,5,2,2,21,'194','',NULL,'',0,0,'2025-03-19 15:33:44','2025-04-28 22:53:13','2025-04-28 22:53:13'),(198,2,1,92,4,2,2,20,'195','',NULL,'Instalação mal sucessedida do IR',0,1,'2025-03-19 16:06:30','2025-04-28 22:53:13','2025-04-28 22:53:13'),(199,12,1,93,4,2,2,20,'196','',NULL,'',0,0,'2025-03-20 08:56:08','2025-04-28 22:53:13','2025-04-28 22:53:13');
/*!40000 ALTER TABLE `calls` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clients`
--

DROP TABLE IF EXISTS `clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `clients` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clients`
--

LOCK TABLES `clients` WRITE;
/*!40000 ALTER TABLE `clients` DISABLE KEYS */;
INSERT INTO `clients` VALUES (1,'ANA','2025-04-28 22:51:47','2025-04-28 22:51:47'),(2,'TRE-CE','2025-04-28 22:51:47','2025-04-28 22:51:47'),(3,'SGG','2025-04-28 22:51:47','2025-04-28 22:51:47');
/*!40000 ALTER TABLE `clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `final_statuses`
--

DROP TABLE IF EXISTS `final_statuses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `final_statuses` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `final_statuses_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `final_statuses`
--

LOCK TABLES `final_statuses` WRITE;
/*!40000 ALTER TABLE `final_statuses` DISABLE KEYS */;
INSERT INTO `final_statuses` VALUES (1,'Sem Chamado','2025-04-28 22:51:47','2025-04-28 22:51:47'),(2,'Fechado OK','2025-04-28 22:51:47','2025-04-28 22:51:47'),(3,'Sem comunicação','2025-04-28 22:51:47','2025-04-28 22:51:47'),(4,'Teste','2025-04-28 22:51:47','2025-04-28 22:51:47'),(5,'Fechado OK, Sem Chamado','2025-04-28 22:53:11','2025-04-28 22:53:11'),(6,'Fechado NOK','2025-04-28 22:53:11','2025-04-28 22:53:11'),(7,'Pendente','2025-04-28 22:53:11','2025-04-28 22:53:11');
/*!40000 ALTER TABLE `final_statuses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2024_03_19_000001_create_clients_table',1),(5,'2024_03_19_000002_create_agents_table',1),(6,'2024_03_19_000003_create_servers_table',1),(7,'2024_03_19_000003_create_users_table',1),(8,'2024_03_19_000008_create_action_types_table',1),(9,'2024_03_19_000009_create_final_statuses_table',1),(10,'2024_03_19_000010_create_call_results_table',1),(11,'2024_03_19_000011_create_action_types_table',1),(12,'2025_04_25_230409_create_problem_descriptions_table',1),(13,'2025_04_25_230519_create_calls_table',1),(14,'2025_04_28_160856_add_call_number_to_calls_table',1),(15,'2024_03_19_000009_create_problem_descriptions_table',2),(16,'2024_03_19_000001_create_agents_table',3);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `problem_descriptions`
--

DROP TABLE IF EXISTS `problem_descriptions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `problem_descriptions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `problem_descriptions`
--

LOCK TABLES `problem_descriptions` WRITE;
/*!40000 ALTER TABLE `problem_descriptions` DISABLE KEYS */;
INSERT INTO `problem_descriptions` VALUES (1,'Maquina da agência desligada','2025-04-28 22:51:47','2025-04-28 22:51:47'),(2,'Testes da URA','2025-04-28 22:51:47','2025-04-28 22:51:47'),(3,'Abertura de chamados no SEI para Terceiros','2025-04-28 22:51:47','2025-04-28 22:51:47'),(4,'Cliente deseja dar feedback para o cliente porem esta impedido','2025-04-28 22:51:47','2025-04-28 22:51:47'),(5,'Configuração de wifi na maquina','2025-04-28 22:51:47','2025-04-28 22:51:47'),(6,'Consulta de localização','2025-04-28 22:51:47','2025-04-28 22:51:47'),(7,'Configuração de aplicativo','2025-04-28 22:51:47','2025-04-28 22:51:47'),(8,'Problema no Bioponto','2025-04-28 22:51:47','2025-04-28 22:51:47'),(9,'Instalação de Software','2025-04-28 22:51:47','2025-04-28 22:51:47'),(10,'Senha invalida do ponto restrito','2025-04-28 22:51:47','2025-04-28 22:51:47'),(11,'Solicitação de papel para impressora','2025-04-28 22:51:48','2025-04-28 22:51:48'),(12,'Configuração da rede na maquina do cliente','2025-04-28 22:51:48','2025-04-28 22:51:48'),(13,'Consulta de chamados','2025-04-28 22:51:48','2025-04-28 22:51:48'),(14,'Falha de comunição de aplicativo','2025-04-28 22:51:48','2025-04-28 22:51:48'),(15,'Atualização de aplicativo','2025-04-28 22:51:48','2025-04-28 22:51:48'),(16,'Instalação de periféricos','2025-04-28 22:51:48','2025-04-28 22:51:48'),(17,'Senha do SEI nao funciona','2025-04-28 22:51:48','2025-04-28 22:51:48'),(18,'Sem acesso à internet','2025-04-28 22:51:48','2025-04-28 22:51:48'),(19,'Configuração de WiFi no celular','2025-04-28 22:51:48','2025-04-28 22:51:48'),(20,'Encaminhado para N2','2025-04-28 22:51:48','2025-04-28 22:51:48'),(21,'Conta bloqueada','2025-04-28 22:51:48','2025-04-28 22:51:48'),(22,'Problema no globalprotect','2025-04-28 22:53:11','2025-04-28 22:53:11'),(23,'Problema no adobe creative cloud','2025-04-28 22:53:11','2025-04-28 22:53:11'),(24,'Email não cadastrado','2025-04-28 22:53:11','2025-04-28 22:53:11'),(25,'Atualização de email institucional','2025-04-28 22:53:11','2025-04-28 22:53:11'),(26,'Manutenção da impressora de crachá','2025-04-28 22:53:11','2025-04-28 22:53:11'),(27,'Redefinição de senha','2025-04-28 22:53:11','2025-04-28 22:53:11'),(28,'Problema no firewall encaminhar chamado para Cyber','2025-04-28 22:53:11','2025-04-28 22:53:11'),(29,'Problema de senha encaminhar  chamado para Cyber','2025-04-28 22:53:11','2025-04-28 22:53:11'),(30,'Ativação de aplicativo','2025-04-28 22:53:11','2025-04-28 22:53:11'),(31,'Solicitação de dados para abertura de chamado','2025-04-28 22:53:11','2025-04-28 22:53:11'),(32,'Saida de fone de ouvido não funciona','2025-04-28 22:53:11','2025-04-28 22:53:11'),(33,'One drive não conecta, Configuração de wifi na maquina','2025-04-28 22:53:11','2025-04-28 22:53:11'),(34,'Problema no calendário do CECAD','2025-04-28 22:53:11','2025-04-28 22:53:11'),(35,'Engano','2025-04-28 22:53:11','2025-04-28 22:53:11'),(36,'Problema na senha do office','2025-04-28 22:53:12','2025-04-28 22:53:12'),(37,'Cadastro no DOC','2025-04-28 22:53:12','2025-04-28 22:53:12'),(38,'Papel atolado','2025-04-28 22:53:12','2025-04-28 22:53:12'),(39,'Problema com token','2025-04-28 22:53:12','2025-04-28 22:53:12'),(40,'Suporte de biometria','2025-04-28 22:53:12','2025-04-28 22:53:12'),(41,'Configuração de impressora','2025-04-28 22:53:12','2025-04-28 22:53:12'),(42,'Problema no Whatsapp businnes da sessão','2025-04-28 22:53:12','2025-04-28 22:53:12'),(43,'Micro fora do dominio','2025-04-28 22:53:12','2025-04-28 22:53:12'),(44,'Sem permissão de acesso a pastas na rede','2025-04-28 22:53:12','2025-04-28 22:53:12'),(45,'Erro de atualização de script','2025-04-28 22:53:12','2025-04-28 22:53:12'),(46,'Verificação de teste','2025-04-28 22:53:12','2025-04-28 22:53:12'),(47,'Falha de inicalização de software','2025-04-28 22:53:12','2025-04-28 22:53:12'),(48,'Lentidão na Maquina','2025-04-28 22:53:12','2025-04-28 22:53:12'),(49,'Sem acesso a aplicativo','2025-04-28 22:53:12','2025-04-28 22:53:12'),(50,'Sincronização de senha na rede cabeada','2025-04-28 22:53:12','2025-04-28 22:53:12'),(51,'Erro de envio de notificação de aplicativo','2025-04-28 22:53:12','2025-04-28 22:53:12'),(52,'Erro no autenticator','2025-04-28 22:53:12','2025-04-28 22:53:12'),(53,'Maquina não liga','2025-04-28 22:53:12','2025-04-28 22:53:12'),(54,'Troca de equipamento','2025-04-28 22:53:12','2025-04-28 22:53:12'),(55,'Manutenção impressora','2025-04-28 22:53:12','2025-04-28 22:53:12'),(56,'Configuração de fone de ouvido na maquina do cliente','2025-04-28 22:53:12','2025-04-28 22:53:12'),(57,'Cancelamento de chamado','2025-04-28 22:53:12','2025-04-28 22:53:12'),(58,'Remanejamento temporario de equipamento','2025-04-28 22:53:12','2025-04-28 22:53:12'),(59,'Formatação da maquina do cliente','2025-04-28 22:53:12','2025-04-28 22:53:12');
/*!40000 ALTER TABLE `problem_descriptions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `servers`
--

DROP TABLE IF EXISTS `servers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `servers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `department` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `client_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `servers_client_id_foreign` (`client_id`),
  CONSTRAINT `servers_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=94 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `servers`
--

LOCK TABLES `servers` WRITE;
/*!40000 ALTER TABLE `servers` DISABLE KEYS */;
INSERT INTO `servers` VALUES (1,'Mariana Azevedo',NULL,1,'2025-04-28 22:53:11','2025-04-28 22:53:11'),(2,'Myke',NULL,1,'2025-04-28 22:53:11','2025-04-28 22:53:11'),(3,'Renata',NULL,1,'2025-04-28 22:53:11','2025-04-28 22:53:11'),(4,'Elton',NULL,1,'2025-04-28 22:53:11','2025-04-28 22:53:11'),(5,'Paulo',NULL,2,'2025-04-28 22:53:11','2025-04-28 22:53:11'),(6,'Gisele',NULL,2,'2025-04-28 22:53:11','2025-04-28 22:53:11'),(7,'Lidia',NULL,2,'2025-04-28 22:53:11','2025-04-28 22:53:11'),(8,'Evilson',NULL,2,'2025-04-28 22:53:11','2025-04-28 22:53:11'),(9,'Ivna',NULL,2,'2025-04-28 22:53:11','2025-04-28 22:53:11'),(10,'Pedro',NULL,2,'2025-04-28 22:53:11','2025-04-28 22:53:11'),(11,'Eduardo',NULL,1,'2025-04-28 22:53:11','2025-04-28 22:53:11'),(12,'Robson',NULL,2,'2025-04-28 22:53:11','2025-04-28 22:53:11'),(13,'Flavia',NULL,2,'2025-04-28 22:53:11','2025-04-28 22:53:11'),(14,'Pedro Cunha',NULL,1,'2025-04-28 22:53:11','2025-04-28 22:53:11'),(15,'Aureni',NULL,2,'2025-04-28 22:53:11','2025-04-28 22:53:11'),(16,'Antonio',NULL,3,'2025-04-28 22:53:11','2025-04-28 22:53:11'),(17,'Jose Humberto',NULL,2,'2025-04-28 22:53:11','2025-04-28 22:53:11'),(18,'Alex Soares',NULL,1,'2025-04-28 22:53:11','2025-04-28 22:53:11'),(19,'Deusdei',NULL,1,'2025-04-28 22:53:11','2025-04-28 22:53:11'),(20,'Fernando',NULL,1,'2025-04-28 22:53:11','2025-04-28 22:53:11'),(21,'Lucimar',NULL,1,'2025-04-28 22:53:11','2025-04-28 22:53:11'),(22,'Jardel',NULL,2,'2025-04-28 22:53:11','2025-04-28 22:53:11'),(23,'Ana Catarina',NULL,1,'2025-04-28 22:53:11','2025-04-28 22:53:11'),(24,'Igor',NULL,1,'2025-04-28 22:53:11','2025-04-28 22:53:11'),(25,'Flavia Helena',NULL,2,'2025-04-28 22:53:11','2025-04-28 22:53:11'),(26,'Yasmin',NULL,2,'2025-04-28 22:53:11','2025-04-28 22:53:11'),(27,'Gean Carvalho',NULL,1,'2025-04-28 22:53:12','2025-04-28 22:53:12'),(28,'Francélio',NULL,2,'2025-04-28 22:53:12','2025-04-28 22:53:12'),(29,'Wander Barbosa',NULL,1,'2025-04-28 22:53:12','2025-04-28 22:53:12'),(30,'Lucio',NULL,2,'2025-04-28 22:53:12','2025-04-28 22:53:12'),(31,'Alessandra',NULL,1,'2025-04-28 22:53:12','2025-04-28 22:53:12'),(32,'Agenildo',NULL,2,'2025-04-28 22:53:12','2025-04-28 22:53:12'),(33,'Paulo Ungaretti',NULL,1,'2025-04-28 22:53:12','2025-04-28 22:53:12'),(34,'Lorena',NULL,2,'2025-04-28 22:53:12','2025-04-28 22:53:12'),(35,'Flavio',NULL,1,'2025-04-28 22:53:12','2025-04-28 22:53:12'),(36,'Regis',NULL,2,'2025-04-28 22:53:12','2025-04-28 22:53:12'),(37,'Nayane',NULL,2,'2025-04-28 22:53:12','2025-04-28 22:53:12'),(38,'Camila Pereira',NULL,1,'2025-04-28 22:53:12','2025-04-28 22:53:12'),(39,'Diego Alves',NULL,1,'2025-04-28 22:53:12','2025-04-28 22:53:12'),(40,'Carlos Souto',NULL,1,'2025-04-28 22:53:12','2025-04-28 22:53:12'),(41,'Juliana',NULL,1,'2025-04-28 22:53:12','2025-04-28 22:53:12'),(42,'Luis Melo',NULL,1,'2025-04-28 22:53:12','2025-04-28 22:53:12'),(43,'Charles',NULL,2,'2025-04-28 22:53:12','2025-04-28 22:53:12'),(44,'Maristela Barbosa',NULL,1,'2025-04-28 22:53:12','2025-04-28 22:53:12'),(45,'Ezilda',NULL,1,'2025-04-28 22:53:12','2025-04-28 22:53:12'),(46,'Marcia',NULL,2,'2025-04-28 22:53:12','2025-04-28 22:53:12'),(47,'Jeovane',NULL,2,'2025-04-28 22:53:12','2025-04-28 22:53:12'),(48,'Meireles',NULL,1,'2025-04-28 22:53:12','2025-04-28 22:53:12'),(49,'Kassia Trindade',NULL,1,'2025-04-28 22:53:12','2025-04-28 22:53:12'),(50,'Andersson',NULL,1,'2025-04-28 22:53:12','2025-04-28 22:53:12'),(51,'Helton Carneiro',NULL,1,'2025-04-28 22:53:12','2025-04-28 22:53:12'),(52,'Marcio Taboril',NULL,2,'2025-04-28 22:53:12','2025-04-28 22:53:12'),(53,'Marlene',NULL,1,'2025-04-28 22:53:12','2025-04-28 22:53:12'),(54,'Brantina Amorim',NULL,1,'2025-04-28 22:53:12','2025-04-28 22:53:12'),(55,'Alexandre Batista',NULL,1,'2025-04-28 22:53:12','2025-04-28 22:53:12'),(56,'Thierry',NULL,1,'2025-04-28 22:53:12','2025-04-28 22:53:12'),(57,'Vera',NULL,1,'2025-04-28 22:53:12','2025-04-28 22:53:12'),(58,'Paulo Roberto',NULL,2,'2025-04-28 22:53:12','2025-04-28 22:53:12'),(59,'Jaqueline',NULL,1,'2025-04-28 22:53:12','2025-04-28 22:53:12'),(60,'Ana Cristina',NULL,1,'2025-04-28 22:53:12','2025-04-28 22:53:12'),(61,'Tome',NULL,1,'2025-04-28 22:53:12','2025-04-28 22:53:12'),(62,'Claudia Silva',NULL,1,'2025-04-28 22:53:12','2025-04-28 22:53:12'),(63,'Joao Benicio',NULL,1,'2025-04-28 22:53:12','2025-04-28 22:53:12'),(64,'Diana Bastos',NULL,2,'2025-04-28 22:53:12','2025-04-28 22:53:12'),(65,'Eloy Silva',NULL,1,'2025-04-28 22:53:12','2025-04-28 22:53:12'),(66,'Ednan',NULL,1,'2025-04-28 22:53:12','2025-04-28 22:53:12'),(67,'Marciel',NULL,1,'2025-04-28 22:53:12','2025-04-28 22:53:12'),(68,'Mara Moura',NULL,1,'2025-04-28 22:53:12','2025-04-28 22:53:12'),(69,'Demetria Mendes',NULL,1,'2025-04-28 22:53:12','2025-04-28 22:53:12'),(70,'Erica Welian',NULL,2,'2025-04-28 22:53:12','2025-04-28 22:53:12'),(71,'Flavia Barros',NULL,1,'2025-04-28 22:53:12','2025-04-28 22:53:12'),(72,'Antoniela Rodrigues',NULL,1,'2025-04-28 22:53:12','2025-04-28 22:53:12'),(73,'Raquel Vieira',NULL,1,'2025-04-28 22:53:12','2025-04-28 22:53:12'),(74,'Ana Rosa',NULL,1,'2025-04-28 22:53:12','2025-04-28 22:53:12'),(75,'Mauricio Pontes',NULL,1,'2025-04-28 22:53:12','2025-04-28 22:53:12'),(76,'Marcos Mollo',NULL,1,'2025-04-28 22:53:12','2025-04-28 22:53:12'),(77,'Zezé',NULL,1,'2025-04-28 22:53:12','2025-04-28 22:53:12'),(78,'Fabiana Teixeira',NULL,1,'2025-04-28 22:53:12','2025-04-28 22:53:12'),(79,'Amélia',NULL,1,'2025-04-28 22:53:12','2025-04-28 22:53:12'),(80,'Maristela',NULL,1,'2025-04-28 22:53:12','2025-04-28 22:53:12'),(81,'Fabiana',NULL,1,'2025-04-28 22:53:12','2025-04-28 22:53:12'),(82,'Debora Vieira',NULL,1,'2025-04-28 22:53:13','2025-04-28 22:53:13'),(83,'Maira Regina',NULL,1,'2025-04-28 22:53:13','2025-04-28 22:53:13'),(84,'Claudia',NULL,1,'2025-04-28 22:53:13','2025-04-28 22:53:13'),(85,'Mario',NULL,1,'2025-04-28 22:53:13','2025-04-28 22:53:13'),(86,'jlgzoby',NULL,1,'2025-04-28 22:53:13','2025-04-28 22:53:13'),(87,'Gabriel Lemos',NULL,1,'2025-04-28 22:53:13','2025-04-28 22:53:13'),(88,'Viviane Graça',NULL,1,'2025-04-28 22:53:13','2025-04-28 22:53:13'),(89,'Luciana Sarmento',NULL,1,'2025-04-28 22:53:13','2025-04-28 22:53:13'),(90,'Desdei',NULL,1,'2025-04-28 22:53:13','2025-04-28 22:53:13'),(91,'Jaqueline Abreu',NULL,1,'2025-04-28 22:53:13','2025-04-28 22:53:13'),(92,'Alberto Nunes',NULL,1,'2025-04-28 22:53:13','2025-04-28 22:53:13'),(93,'Naira',NULL,1,'2025-04-28 22:53:13','2025-04-28 22:53:13');
/*!40000 ALTER TABLE `servers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('hBkwU4Bz7p4xmnfSzaSPUPKdmmxMn0UYYQCHA1GB',1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36','YTo1OntzOjY6Il90b2tlbiI7czo0MDoiMEx2M3c4TVhvdG55VGRSbUhaZVRucmRLa1RkVkVzQTM5Y0tMcnlFUyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jYWxscy8xL2VkaXQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjM6InVybCI7YToxOntzOjg6ImludGVuZGVkIjtzOjIxOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=',1746044514);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'auditoria','fabricio.4135@gmail.com',NULL,'$2y$12$KCCm0/dlNG2xNWh5.ZpTyePzQ5OvxhDPeYXTt2KpLMbBJ11aiu5ai',NULL,'2025-04-30 22:38:47','2025-04-30 22:38:47');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usr`
--

DROP TABLE IF EXISTS `usr`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usr` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `department` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `client_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `usr_client_id_foreign` (`client_id`),
  CONSTRAINT `usr_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usr`
--

LOCK TABLES `usr` WRITE;
/*!40000 ALTER TABLE `usr` DISABLE KEYS */;
/*!40000 ALTER TABLE `usr` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-04-30 17:31:36
