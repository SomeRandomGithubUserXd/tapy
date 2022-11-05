-- MySQL dump 10.13  Distrib 8.0.31, for macos13.0 (arm64)
--
-- Host: localhost    Database: tapy
-- ------------------------------------------------------
-- Server version	8.0.31

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
-- Table structure for table `currencies`
--

DROP TABLE IF EXISTS `currencies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `currencies` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `short_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `currencies_short_name_unique` (`short_name`)
) ENGINE=InnoDB AUTO_INCREMENT=164 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `currencies`
--

LOCK TABLES `currencies` WRITE;
/*!40000 ALTER TABLE `currencies` DISABLE KEYS */;
INSERT INTO `currencies` VALUES (6,'AED'),(7,'AFN'),(8,'ALL'),(9,'AMD'),(10,'ANG'),(11,'AOA'),(12,'ARS'),(13,'AUD'),(14,'AWG'),(15,'AZN'),(16,'BAM'),(17,'BBD'),(18,'BDT'),(19,'BGN'),(20,'BHD'),(21,'BIF'),(22,'BMD'),(23,'BND'),(24,'BOB'),(25,'BOV'),(26,'BRL'),(27,'BSD'),(28,'BTC'),(29,'BTN'),(30,'BWP'),(3,'BYN'),(31,'BZD'),(32,'CAD'),(33,'CDF'),(34,'CHE'),(35,'CHF'),(36,'CHW'),(37,'CLF'),(38,'CLP'),(39,'CNH'),(40,'CNY'),(41,'COP'),(42,'COU'),(43,'CRC'),(44,'CUC'),(45,'CUP'),(46,'CVE'),(47,'CZK'),(48,'DJF'),(49,'DKK'),(50,'DOP'),(51,'DZD'),(52,'EGP'),(53,'ERN'),(54,'ETB'),(4,'EUR'),(55,'FJD'),(56,'FKP'),(57,'GBP'),(58,'GEL'),(59,'GHS'),(60,'GIP'),(61,'GMD'),(62,'GNF'),(63,'GTQ'),(64,'GYD'),(65,'HKD'),(66,'HNL'),(67,'HRK'),(68,'HTG'),(69,'HUF'),(70,'IDR'),(71,'ILS'),(72,'INR'),(73,'IQD'),(74,'IRR'),(75,'ISK'),(76,'JMD'),(77,'JOD'),(78,'JPY'),(79,'KES'),(80,'KGS'),(81,'KHR'),(82,'KMF'),(83,'KPW'),(84,'KRW'),(85,'KWD'),(86,'KYD'),(87,'KZT'),(88,'LAK'),(89,'LBP'),(90,'LKR'),(91,'LRD'),(92,'LSL'),(93,'LYD'),(94,'MAD'),(95,'MDL'),(96,'MGA'),(97,'MKD'),(98,'MMK'),(99,'MNT'),(100,'MOP'),(101,'MRO'),(102,'MUR'),(103,'MWK'),(104,'MXN'),(105,'MXV'),(106,'MYR'),(107,'MZN'),(108,'NAD'),(109,'NGN'),(110,'NIO'),(111,'NOK'),(112,'NPR'),(113,'NZD'),(114,'OMR'),(115,'PAB'),(116,'PEN'),(117,'PGK'),(118,'PHP'),(119,'PKR'),(120,'PLN'),(121,'PYG'),(122,'QAR'),(123,'RON'),(124,'RSD'),(2,'RUB'),(125,'RWF'),(126,'SAR'),(127,'SBD'),(128,'SCR'),(129,'SDG'),(130,'SEK'),(131,'SGD'),(132,'SHP'),(133,'SLL'),(134,'SOS'),(135,'SRD'),(136,'SSP'),(137,'STN'),(138,'SYP'),(139,'SZL'),(140,'THB'),(141,'TJS'),(142,'TND'),(143,'TOP'),(144,'TRY'),(145,'TTD'),(146,'TWD'),(147,'TZS'),(5,'UAH'),(148,'UGX'),(1,'USD'),(149,'USN'),(150,'UYI'),(151,'UYU'),(152,'UZS'),(153,'VEF'),(154,'VND'),(155,'VUV'),(156,'WST'),(157,'XAF'),(158,'XCD'),(159,'XOF'),(160,'XPF'),(161,'YER'),(162,'ZAR'),(163,'ZMW');
/*!40000 ALTER TABLE `currencies` ENABLE KEYS */;
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
-- Table structure for table `media`
--

DROP TABLE IF EXISTS `media`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `media` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `collection_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mime_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `disk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `conversions_disk` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size` bigint unsigned NOT NULL,
  `manipulations` json NOT NULL,
  `custom_properties` json NOT NULL,
  `generated_conversions` json NOT NULL,
  `responsive_images` json NOT NULL,
  `order_column` int unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `media_uuid_unique` (`uuid`),
  KEY `media_model_type_model_id_index` (`model_type`,`model_id`),
  KEY `media_order_column_index` (`order_column`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `media`
--

LOCK TABLES `media` WRITE;
/*!40000 ALTER TABLE `media` DISABLE KEYS */;
/*!40000 ALTER TABLE `media` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2019_12_14_000001_create_personal_access_tokens_table',1),(5,'2022_07_29_181051_create_pages_table',1),(6,'2022_07_31_132829_create_products_table',1),(7,'2022_08_01_181508_create_currencies_table',1),(8,'2022_08_03_120819_create_media_table',1),(9,'2022_08_04_173202_create_page_trackings_table',1),(10,'2022_08_04_173449_create_page_seos_table',1),(11,'2022_08_04_224457_create_themes_table',1),(12,'2022_08_05_104317_create_page_theme_table',1),(13,'2022_08_05_141701_create_page_elements_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `page_elements`
--

DROP TABLE IF EXISTS `page_elements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `page_elements` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `page_id` bigint unsigned NOT NULL,
  `component_alias` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `props` json NOT NULL,
  `order_column` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `page_elements`
--

LOCK TABLES `page_elements` WRITE;
/*!40000 ALTER TABLE `page_elements` DISABLE KEYS */;
INSERT INTO `page_elements` VALUES (1,1,'profile','{\"caption\": \"\", \"picture\": \"http://127.0.0.1:8000/placeholders/logo.svg\", \"position\": \"center\", \"username\": \"@username\"}',0,'2022-11-02 07:06:00','2022-11-02 07:06:00');
/*!40000 ALTER TABLE `page_elements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `page_seos`
--

DROP TABLE IF EXISTS `page_seos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `page_seos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `page_id` bigint unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `page_seos_page_id_unique` (`page_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `page_seos`
--

LOCK TABLES `page_seos` WRITE;
/*!40000 ALTER TABLE `page_seos` DISABLE KEYS */;
INSERT INTO `page_seos` VALUES (1,1,NULL,NULL,'2022-11-02 07:06:00','2022-11-02 07:06:00');
/*!40000 ALTER TABLE `page_seos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `page_theme`
--

DROP TABLE IF EXISTS `page_theme`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `page_theme` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `page_id` bigint unsigned NOT NULL,
  `theme_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `page_theme_page_id_unique` (`page_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `page_theme`
--

LOCK TABLES `page_theme` WRITE;
/*!40000 ALTER TABLE `page_theme` DISABLE KEYS */;
INSERT INTO `page_theme` VALUES (1,1,1,NULL,NULL);
/*!40000 ALTER TABLE `page_theme` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `page_trackings`
--

DROP TABLE IF EXISTS `page_trackings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `page_trackings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `page_id` bigint unsigned NOT NULL,
  `facebook_pixel_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `google_analytics_tracking_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `yandex_metrika_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tik_tok_pixel_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `page_trackings_page_id_unique` (`page_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `page_trackings`
--

LOCK TABLES `page_trackings` WRITE;
/*!40000 ALTER TABLE `page_trackings` DISABLE KEYS */;
INSERT INTO `page_trackings` VALUES (1,1,NULL,NULL,NULL,NULL,'2022-11-02 07:06:00','2022-11-02 07:06:00');
/*!40000 ALTER TABLE `page_trackings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'New page',
  `link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pages_link_unique` (`link`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pages`
--

LOCK TABLES `pages` WRITE;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
INSERT INTO `pages` VALUES (1,'5db64ff1-58dd-4e6c-8e5b-6186e3f74131',2,'New page','H2dWyd','2022-11-02 07:06:00','2022-11-02 07:06:00');
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` int DEFAULT NULL,
  `old_price` int DEFAULT NULL,
  `currency` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `action_btn` tinyint(1) NOT NULL DEFAULT '0',
  `btn_label` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `btn_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `themes`
--

DROP TABLE IF EXISTS `themes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `themes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `containerStyle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `blockStyle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `elementStyle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `key` smallint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `themes`
--

LOCK TABLES `themes` WRITE;
/*!40000 ALTER TABLE `themes` DISABLE KEYS */;
INSERT INTO `themes` VALUES (1,'background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; background-color: rgb(240, 242, 245);','background: rgb(255, 255, 255);border-radius: 16px;color: black;','background: rgb(24, 26, 34); opacity: 0.9; border: 2px none; border-radius: 10px;color: white !important',0,'2022-11-02 07:03:16','2022-11-02 07:03:16'),(2,'background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; background-color: rgba(195, 30, 57, 0.08);','background: rgb(255, 255, 255);border-radius: 16px;color: black;','background: rgb(195, 30, 57); opacity: 0.7; border: 2px none; border-radius: 28px;color: white !important',1,'2022-11-02 07:03:16','2022-11-02 07:03:16'),(3,'background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; background-color: rgb(1, 1, 1);','background: rgb(32, 32, 32);border-radius: 16px;color: white;','background: rgb(53, 62, 62); opacity: 0.9; border: 2px none; border-radius: 10px;color: rgb(221, 221, 221) !important;',2,'2022-11-02 07:03:16','2022-11-02 07:03:16'),(4,'background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; background-color: rgb(192, 185, 182);','background: rgb(226, 218, 215);border-radius: 16px;color: black;','background: rgb(251, 248, 247); opacity: 0.9; border: 2px none; border-radius: 28px;color: black !important',3,'2022-11-02 07:03:16','2022-11-02 07:03:16'),(5,'background: linear-gradient(rgba(255, 0, 0, 0.125), transparent), linear-gradient(to left top, rgba(0, 255, 0, 0.125), transparent), linear-gradient(to right top, rgba(0, 0, 255, 0.125), transparent) rgba(255, 255, 255, 0);','background: rgb(255, 255, 255);border-radius: 16px;color: black;','background: rgb(39, 50, 62); opacity: 0.8; border: 2px none; border-radius: 28px;color: white !important',4,'2022-11-02 07:03:16','2022-11-02 07:03:16'),(6,'background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; background-color: rgb(249, 203, 76);','background: rgba(255, 255, 255, 0);border-radius: 16px;color: black;','background: rgb(255, 255, 255); opacity: 1; border: 2px solid rgb(0, 0, 0); border-radius: 0px;color: black !important;box-shadow: rgba(0, 0, 0, 0.1) 4px 4px;',5,'2022-11-02 07:03:16','2022-11-02 07:03:16'),(7,'background: url(\'/backgrounds/dots.png\') rgba(239, 235, 231, 0.9);','background: rgb(255, 255, 255);border-radius: 16px;color: black;','background: rgb(51, 51, 51); opacity: 0.7; border-radius: 0px; border-width: 2px;color: white !important;box-shadow: rgba(0, 0, 0, 0.1) 4px 4px 0px 0px;',6,'2022-11-02 07:03:16','2022-11-02 07:03:16'),(8,'background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; background-color: rgb(236, 242, 247);','background: rgba(255, 255, 255, 0);border-radius: 16px;color: rgb(27, 61, 112);','background: rgb(255, 255, 255); opacity: 1; border-radius: 28px; border-width: 2px;color: rgb(27, 61, 112) !important;box-shadow: rgba(0, 0, 0, 0.03) 0px 4px 0px 0px; border-radius: 28px;',7,'2022-11-02 07:03:16','2022-11-02 07:03:16'),(9,'background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; background-color: rgb(255, 255, 255);','background: rgb(255, 255, 255);border-radius: 16px;color: black;','background: rgb(255, 255, 255); opacity: 1; border: 2px solid rgb(51, 51, 51);color: black !important;box-shadow: rgb(51, 51, 51) 5px 5px;',8,'2022-11-02 07:03:16','2022-11-02 07:03:16'),(10,'background-image: linear-gradient(45deg, rgb(20, 21, 49) 0%, rgb(32, 18, 45) 100%);','background: rgb(42, 32, 69);border-radius: 16px;color: white;','background: rgb(74, 73, 189); opacity: 1; border-radius: 10px; border-width: 2px;color: white !important',9,'2022-11-02 07:03:16','2022-11-02 07:03:16');
/*!40000 ALTER TABLE `themes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` smallint NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'email@mail.com',NULL,'123456',0,NULL,'2022-11-02 07:05:13','2022-11-02 07:05:13'),(2,'email@mail.ru',NULL,'$2y$10$.YGQeRTtrDe.tRM7TI3XXe8E4WtPSkt6w0cXjH8FZ6nPGnLDX2vHi',0,NULL,'2022-11-02 07:05:53','2022-11-02 07:05:53');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-11-02 13:08:06
