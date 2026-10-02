/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19-11.7.2-MariaDB, for osx10.20 (arm64)
--
-- Host: localhost    Database: revenda
-- ------------------------------------------------------
-- Server version	11.7.2-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*M!100616 SET @OLD_NOTE_VERBOSITY=@@NOTE_VERBOSITY, NOTE_VERBOSITY=0 */;

--
-- Table structure for table `administradores`
--

DROP TABLE IF EXISTS `administradores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `administradores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(50) NOT NULL,
  `senha` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `usuario` (`usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `administradores`
--

LOCK TABLES `administradores` WRITE;
/*!40000 ALTER TABLE `administradores` DISABLE KEYS */;
INSERT INTO `administradores` VALUES
(1,'admin','21232f297a57a5a743894a0e4a801fc3');
/*!40000 ALTER TABLE `administradores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `veiculos`
--

DROP TABLE IF EXISTS `veiculos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `veiculos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `marca` varchar(255) NOT NULL,
  `modelo` varchar(255) NOT NULL,
  `year` int(11) NOT NULL,
  `kilometragem` int(11) NOT NULL,
  `cor` varchar(255) DEFAULT NULL,
  `motor` decimal(2,1) NOT NULL,
  `cambio` varchar(255) DEFAULT NULL,
  `ar_condicionado` tinyint(1) DEFAULT NULL,
  `imagem` varchar(255) DEFAULT 'sem-foto.png',
  `valor` decimal(10,2) NOT NULL,
  `status` enum('Disponível','Vendido') DEFAULT 'Disponível',
  `visivel` tinyint(1) DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=94 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `veiculos`
--

LOCK TABLES `veiculos` WRITE;
/*!40000 ALTER TABLE `veiculos` DISABLE KEYS */;
INSERT INTO `veiculos` VALUES
(1,'Hyundai','HB20 Comfort Plus',2025,68783,'Prata',1.0,'Manual',1,'1783013638_6a46a106542c4.jpg',64990.00,'Disponível',1),
(2,'Chevrolet','Onix HATCH LT',2025,40420,'Branca',1.0,'Manual',0,'1783013826_6a46a1c2c8647.jpg',63990.00,'Disponível',1),
(3,'Renault','Captur Intense',2020,86466,'Vermelha',1.6,'Automático',1,'1783014112_6a46a2e0c8e85.jpg',74990.00,'Disponível',1),
(4,'Chevrolet','Tracker 1.0 Turbo',2021,35000,'Branco',1.0,'Automático',1,'1783018768_6a46b51079f70.webp',105000.00,'Disponível',1),
(5,'Chevrolet','Tracker 1.2 Premier',2022,20000,'Azul',1.2,'Automático',1,'1783018803_6a46b53376b34.webp',125000.00,'Disponível',1),
(6,'Chevrolet','Tracker 1.0 Turbo',2023,10000,'Prata',1.0,'Automático',1,'1783018842_6a46b55a92402.avif',115000.00,'Disponível',1),
(7,'Chevrolet','Cruze 1.4 LT',2018,70000,'Preto',1.4,'Automático',1,'1783014752_6a46a560d337a.webp',80000.00,'Disponível',1),
(8,'Chevrolet','Cruze 1.4 Premier',2020,45000,'Branco',1.4,'Automático',1,'1783018896_6a46b590e04d8.webp',105000.00,'Disponível',1),
(9,'Chevrolet','Cruze 1.4 LTZ',2019,55000,'Cinza',1.4,'Automático',1,'1783019025_6a46b611171e6.webp',95000.00,'Disponível',1),
(10,'Chevrolet','S10 2.8 LTZ',2017,120000,'Prata',2.8,'Automático',1,'1783019057_6a46b631a9945.webp',140000.00,'Disponível',1),
(11,'Chevrolet','S10 2.8 High Country',2021,60000,'Azul',2.8,'Automático',1,'1783019102_6a46b65eec1bd.jpg',210000.00,'Disponível',1),
(12,'Chevrolet','S10 2.5 Flex LT',2019,80000,'Vermelho',2.5,'Manual',1,'1783019138_6a46b6823252d.jpg',120000.00,'Disponível',1),
(13,'Hyundai','Creta 1.6 Pulse',2018,65000,'Branco',1.6,'Automático',1,'1783019169_6a46b6a12036a.webp',82000.00,'Disponível',1),
(14,'Hyundai','Creta 2.0 Prestige',2020,40000,'Preto',2.0,'Automático',1,'1783019213_6a46b6cd703cd.jfif',105000.00,'Disponível',1),
(15,'Hyundai','Creta 1.0 TGDI Platinum',2022,15000,'Prata',1.0,'Automático',1,'1783019253_6a46b6f55701b.jfif',135000.00,'Disponível',1),
(16,'Hyundai','Tucson 1.6 Turbo GLS',2017,85000,'Cinza',1.6,'Automático',1,'1783019288_6a46b718c0f2a.webp',95000.00,'Disponível',1),
(17,'Hyundai','Tucson 1.6 Turbo Limited',2019,50000,'Branco',1.6,'Automático',1,'1783019322_6a46b73a950cd.webp',120000.00,'Disponível',1),
(18,'Hyundai','Tucson 1.6 Turbo GLS',2018,70000,'Preto',1.6,'Automático',1,'1783019368_6a46b76825e53.webp',105000.00,'Disponível',1),
(19,'Hyundai','ix35 2.0 GL',2015,110000,'Prata',2.0,'Automático',1,'1783019423_6a46b79fb6708.webp',65000.00,'Disponível',1),
(20,'Hyundai','ix35 2.0 GLS',2017,80000,'Branco',2.0,'Automático',1,'1783019501_6a46b7edacf8e.webp',78000.00,'Disponível',1),
(22,'Fiat','Argo 1.0 Drive',2019,60000,'Branco',1.0,'Manual',0,'1783019460_6a46b7c406e94.jpg',48000.00,'Disponível',1),
(23,'Fiat','Argo 1.3 Trekking',2021,30000,'Vermelho',1.3,'Automático',1,'1783019537_6a46b811722d9.webp',72000.00,'Disponível',1),
(24,'Fiat','Argo 1.0',2022,20000,'Preto',1.0,'Manual',0,'1783019580_6a46b83c4ea00.webp',55000.00,'Disponível',1),
(25,'Fiat','Toro 1.8 Freedom',2018,85000,'Prata',1.8,'Automático',1,'1783019619_6a46b8630b75d.webp',92000.00,'Disponível',1),
(26,'Fiat','Toro 2.0 Diesel Volcano',2021,50000,'Branco',2.0,'Automático',1,'1783019659_6a46b88bc7319.jfif',155000.00,'Disponível',1),
(27,'Fiat','Toro 1.3 Turbo Volcano',2023,10000,'Azul',1.3,'Automático',1,'1783019699_6a46b8b3b42ea.jfif',148000.00,'Disponível',1),
(28,'Fiat','Pulse 1.3 Drive',2022,25000,'Cinza',1.3,'Manual',1,'1783019741_6a46b8dd1fd98.jpg',85000.00,'Disponível',1),
(29,'Fiat','Pulse 1.0 Turbo Audace',2023,15000,'Prata',1.0,'Automático',1,'sem-foto.png',105000.00,'Disponível',1),
(30,'Fiat','Pulse 1.0 Turbo Impetus',2024,5000,'Branco',1.0,'Automático',1,'1783018986_6a46b5ea5ec01.webp',118000.00,'Disponível',1),
(31,'Volkswagen','Polo 1.0 MPI',2019,65000,'Branco',1.0,'Manual',0,'1783018733_6a46b4ed450f9.webp',55000.00,'Disponível',1),
(32,'Volkswagen','Polo 1.0 TSI Highline',2021,35000,'Preto',1.0,'Automático',1,'1783018653_6a46b49d90643.webp',88000.00,'Disponível',1),
(33,'Volkswagen','Polo 1.4 GTS',2023,15000,'Vermelho',1.4,'Automático',1,'1783018612_6a46b47485236.jfif',130000.00,'Disponível',1),
(34,'Volkswagen','T-Cross 1.0 TSI',2020,55000,'Azul',1.0,'Automático',1,'1783018549_6a46b435636c0.jpeg',95000.00,'Disponível',1),
(35,'Volkswagen','T-Cross 1.4 Highline',2022,20000,'Marrom',1.4,'Automático',1,'1783018503_6a46b40702368.webp',135000.00,'Disponível',1),
(36,'Volkswagen','T-Cross 1.0 Comfortline',2021,40000,'Prata',1.0,'Automático',1,'1783018454_6a46b3d63ba80.jpeg',110000.00,'Disponível',1),
(37,'Volkswagen','Nivus 1.0 Comfortline',2021,45000,'Cinza',1.0,'Automático',1,'1783018406_6a46b3a62c5f5.jfif',105000.00,'Disponível',1),
(38,'Volkswagen','Nivus 1.0 Highline',2022,25000,'Azul',1.0,'Automático',1,'1783018368_6a46b38072953.avif',120000.00,'Disponível',1),
(39,'Volkswagen','Nivus 1.0 Highline',2023,10000,'Vermelho',1.0,'Automático',1,'1783018243_6a46b3037497f.jpg',130000.00,'Disponível',1),
(40,'Jeep','Renegade 1.8 Sport',2017,85000,'Prata',1.8,'Automático',1,'1783018200_6a46b2d898711.jpg',70000.00,'Disponível',1),
(41,'Jeep','Renegade 1.8 Longitude',2020,50000,'Vermelho',1.8,'Automático',1,'1783018147_6a46b2a34c4e7.webp',90000.00,'Disponível',1),
(42,'Jeep','Renegade 1.3 T270 Sport',2023,15000,'Preto',1.3,'Automático',1,'1783018099_6a46b2730569e.JPG',125000.00,'Disponível',1),
(43,'Jeep','Compass 2.0 Sport',2018,75000,'Branco',2.0,'Automático',1,'1783017947_6a46b1dbecc3d.webp',98000.00,'Disponível',1),
(44,'Jeep','Compass 2.0 Diesel Longitude',2021,45000,'Cinza',2.0,'Automático',1,'1783017831_6a46b16710fd1.webp',150000.00,'Disponível',1),
(45,'Jeep','Compass 1.3 T270 Limited',2024,8000,'Azul',1.3,'Automático',1,'1783017733_6a46b105ed613.webp',180000.00,'Disponível',1),
(46,'Jeep','Commander 1.3 T270 Limited',2022,30000,'Preto',1.3,'Automático',1,'1783017700_6a46b0e49ae98.jfif',200000.00,'Disponível',1),
(47,'Jeep','Commander 2.0 Diesel Overland',2023,20000,'Branco',2.0,'Automático',1,'1783017557_6a46b0559f86e.jpg',280000.00,'Disponível',1),
(48,'Jeep','Commander 1.3 T270 Overland',2024,5000,'Cinza',1.3,'Automático',1,'1783017518_6a46b02e108e3.webp',230000.00,'Disponível',1),
(49,'Renault','Kwid 1.0 Zen',2018,65000,'Branco',1.0,'Manual',0,'1783017473_6a46b0010ae0a.jpeg',38000.00,'Disponível',1),
(50,'Renault','Kwid 1.0 Intense',2021,35000,'Laranja',1.0,'Manual',1,'1783017438_6a46afdeddd89.jpg',48000.00,'Disponível',1),
(51,'Renault','Kwid 1.0 Outsider',2023,15000,'Prata',1.0,'Manual',0,'1783017403_6a46afbb73efc.avif',55000.00,'Disponível',1),
(52,'Renault','Duster 1.6 Expression',2016,95000,'Preto',1.6,'Manual',1,'1783017373_6a46af9dd588a.webp',55000.00,'Disponível',1),
(53,'Renault','Duster 1.6 Iconic',2021,45000,'Marrom',1.6,'Automático',1,'1783017329_6a46af71f37be.webp',90000.00,'Disponível',1),
(54,'Renault','Duster 1.3 Turbo Iconic',2023,20000,'Branco',1.3,'Automático',1,'1783017282_6a46af42a3079.webp',125000.00,'Disponível',1),
(55,'Renault','Captur 1.6 Zen',2018,70000,'Dourada',1.6,'Automático',1,'1783017231_6a46af0f422f9.jpg',72000.00,'Disponível',1),
(56,'Renault','Captur 2.0 Intense',2019,55000,'Vermelho',2.0,'Automático',1,'1783017176_6a46aed872ab6.jfif',80000.00,'Disponível',1),
(57,'Renault','Captur 1.3 Turbo Iconic',2022,25000,'Branco',1.3,'Automático',1,'1783017078_6a46ae7628c78.webp',115000.00,'Disponível',1),
(58,'Toyota','Corolla 2.0 XEi',2016,95000,'Prata',2.0,'Automático',1,'1783017038_6a46ae4e058cf.webp',82000.00,'Disponível',1),
(59,'Toyota','Corolla 2.0 Altis',2020,50000,'Branco',2.0,'Automático',1,'1783016972_6a46ae0c1633b.jpg',130000.00,'Disponível',1),
(60,'Toyota','Corolla 1.8 Hybrid Altis',2023,15000,'Preto',1.8,'Automático',1,'1783016936_6a46ade84ccba.webp',165000.00,'Disponível',1),
(61,'Toyota','Yaris 1.5 XL',2019,60000,'Cinza',1.5,'Automático',1,'sem-foto.png',75000.00,'Disponível',1),
(62,'Toyota','Yaris 1.5 XLS',2021,35000,'Branco',1.5,'Automático',1,'1783016882_6a46adb26c2cf.webp',92000.00,'Disponível',1),
(63,'Toyota','Yaris 1.5 XS',2023,15000,'Prata',1.5,'Automático',1,'1783016834_6a46ad8233695.jpg',105000.00,'Disponível',1),
(64,'Toyota','Hilux 2.8 SRV',2017,130000,'Preto',2.8,'Automático',1,'1783016739_6a46ad2300e98.webp',165000.00,'Disponível',1),
(65,'Toyota','Hilux 2.8 SRX',2021,65000,'Vermelho',2.8,'Automático',1,'1783016793_6a46ad5900baa.webp',260000.00,'Disponível',1),
(66,'Toyota','Hilux 2.8 SRX',2024,10000,'Prata',2.8,'Automático',1,'1783016696_6a46acf89b8f3.jfif',310000.00,'Disponível',1),
(67,'Honda','Civic 2.0 EXR',2015,110000,'Preto',2.0,'Automático',1,'1783016570_6a46ac7a93f12.webp',75000.00,'Disponível',1),
(68,'Honda','Civic 2.0 EXL',2019,65000,'Branco',2.0,'Automático',1,'1783016539_6a46ac5b4a02b.jfif',110000.00,'Disponível',1),
(69,'Honda','Civic 1.5 Touring',2021,40000,'Cinza',1.5,'Automático',1,'1783016503_6a46ac373fd35.jpg',145000.00,'Disponível',1),
(70,'Honda','HR-V 1.8 EX',2016,90000,'Prata',1.8,'Automático',1,'1783016438_6a46abf695255.webp',80000.00,'Disponível',1),
(71,'Honda','HR-V 1.8 EXL',2020,55000,'Vermelho',1.8,'Automático',1,'1783016382_6a46abbe99ce5.webp',105000.00,'Disponível',1),
(72,'Honda','HR-V 1.5 Touring',2024,8000,'Branco',1.5,'Automático',1,'1783016325_6a46ab8504d30.avif',185000.00,'Disponível',1),
(73,'Honda','Fit 1.5 LX',2015,105000,'Cinza',1.5,'Manual',1,'1783016258_6a46ab42239ec.webp',52000.00,'Disponível',1),
(74,'Honda','Fit 1.5 EX',2018,70000,'Preto',1.5,'Automático',1,'1783016217_6a46ab19537bd.jpeg',72000.00,'Disponível',1),
(75,'Honda','Fit 1.5 EXL',2021,35000,'Branco',1.5,'Automático',1,'1783016150_6a46aad661666.jpg',90000.00,'Disponível',1),
(76,'Nissan','Kicks 1.6 SV',2018,75000,'Vermelho',1.6,'Automático',1,'1783016114_6a46aab2c01dc.webp',78000.00,'Disponível',1),
(77,'Nissan','Kicks 1.6 Advance',2021,40000,'Azul',1.6,'Automático',1,'1783016076_6a46aa8c52b74.jpg',102000.00,'Disponível',1),
(78,'Nissan','Kicks 1.6 Exclusive',2023,15000,'Preto',1.6,'Automático',1,'1783016019_6a46aa5380db8.webp',125000.00,'Disponível',1),
(79,'Nissan','Versa 1.6 SV',2017,85000,'Prata',1.6,'Manual',1,'1783015975_6a46aa274f5d4.webp',48000.00,'Vendido',1),
(80,'Nissan','Versa 1.6 Advance',2021,45000,'Branco',1.6,'Automático',1,'1783015931_6a46a9fb19142.webp',85000.00,'Disponível',1),
(81,'Nissan','Versa 1.6 Exclusive',2024,10000,'Cinza',1.6,'Automático',1,'1783015867_6a46a9bb7ac3f.webp',115000.00,'Disponível',1),
(82,'Nissan','Frontier 2.3 Attack',2019,85000,'Vermelho',2.3,'Automático',1,'1783015822_6a46a98e182d9.webp',150000.00,'Disponível',1),
(83,'Nissan','Frontier 2.3 XE',2022,35000,'Branco',2.3,'Automático',1,'1783015739_6a46a93bab0dd.webp',210000.00,'Disponível',1),
(84,'Nissan','Frontier 2.3 Pro-4X',2024,5000,'Cinza',2.3,'Automático',1,'1783015709_6a46a91d9ba9e.webp',280000.00,'Disponível',1),
(85,'Ford','Ka 1.0 SE',2018,80000,'Branco',1.0,'Manual',0,'1783015666_6a46a8f2227bb.webp',42000.00,'Disponível',1),
(86,'Ford','Ka 1.5 Titanium',2020,50000,'Prata',1.5,'Automático',1,'1783015550_6a46a87eef42f.webp',62000.00,'Disponível',1),
(87,'Ford','Ka 1.0 SE Plus',2021,35000,'Preto',1.0,'Manual',0,'1783015161_6a46a6f9a5c28.webp',52000.00,'Disponível',1),
(88,'Ford','Ecosport 1.6 Freestyle',2016,95000,'Branco',1.6,'Manual',1,'1783015106_6a46a6c282cfe.webp',58000.00,'Disponível',1),
(89,'Ford','Ecosport 1.5 Titanium',2019,65000,'Azul',1.5,'Automático',1,'1783015062_6a46a69656d32.jpg',75000.00,'Disponível',1),
(90,'Ford','Ecosport 2.0 Storm',2021,40000,'Bronze',2.0,'Automático',1,'1783015021_6a46a66d58eec.jpg',90000.00,'Disponível',1),
(91,'Ford','Ranger 2.2 XLS',2018,110000,'Prata',2.2,'Automático',1,'1783014914_6a46a602b67a8.jpg',135000.00,'Disponível',1),
(92,'Ford','Ranger 3.2 XLT',2021,60000,'Preto',3.2,'Automático',1,'1783014872_6a46a5d834556.webp',200000.00,'Disponível',1),
(93,'Ford','Ranger 3.0 V6 Limited',2024,10000,'Branco',3.0,'Automático',1,'1783014818_6a46a5a2c07a0.webp',320000.00,'Disponível',1);
/*!40000 ALTER TABLE `veiculos` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*M!100616 SET NOTE_VERBOSITY=@OLD_NOTE_VERBOSITY */;

-- Dump completed on 2026-10-02 17:34:30
