-- MySQL dump 10.13  Distrib 8.0.33, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: ecommerce
-- ------------------------------------------------------
-- Server version	8.0.33

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `cart_details`
--

DROP TABLE IF EXISTS `cart_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cart_details` (
  `cart_id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `product_id` int DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  PRIMARY KEY (`cart_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `cart_details_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_pswd` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cart_details`
--

LOCK TABLES `cart_details` WRITE;
/*!40000 ALTER TABLE `cart_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `cart_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_details`
--

DROP TABLE IF EXISTS `product_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_details` (
  `id` int NOT NULL,
  `stock` int DEFAULT '0',
  `saller_name` varchar(40) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `p_name` varchar(100) DEFAULT NULL,
  `price` int DEFAULT NULL,
  `color` varchar(25) DEFAULT NULL,
  `shipping_charges` int DEFAULT NULL,
  `p_details` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_details`
--

LOCK TABLES `product_details` WRITE;
/*!40000 ALTER TABLE `product_details` DISABLE KEYS */;
INSERT INTO `product_details` VALUES (1,50,'CLIENTEROecom','poco_c51.jpeg','POCO C51',9999,'Royal Blue',0,'RAM:4 GB,ROM:64 GB,Expandable:Upto 1 TB,Display:6.52 inch HD+ ,Camera:8MP Dual Rear Camera | 5MP Front Camera,Battery:5000mAh,Processor:Helio G36,Warranty:1 Year Manufacturer Warranty for Phone and 6 Months Warranty for in the Box Accessories'),(2,200,'ECOMTAMSINRetail','realme.jpeg','realme C55',13999,'Rainforest',0,'RAM:8 GB,ROM:128 GB,Expandable:Upto 1 TB,Display:6.72 inch Full HD+ ,Camera:64MP+2MP | 8MP Front Camera,Battery:5000mAh,Processor:Helio G88,Warranty:1 Year Manufacturer Warranty for Phone and 6 Months Warranty for in the Box Accessories'),(3,30,'MPDSLERetail','infinix.jpeg','Infinix Smart 7 HD',7999,'Silk Blue',0,'RAM:2 GB,ROM:64 GB,Expandable:Upto 1 TB,Display:6.6 inch HD+ ,Camera:8MP + AI Lens | 5MP Front Camera,Battery:5000mAh,Processor:Spreadtrum SC9863A1,Warranty:1 Year Manufacturer Warranty for Phone and 6 Months Warranty for in the Box Accessories'),(4,50,'Nameipic','vivo.jpeg','vivo X90',59999,'Breeze Blue',0,'RAM:8 GB,ROM:256 GB,Expandable:Upto 1 TB,Display:6.78 inch Full HD+ ,Camera:50MP + 12MP + 12MP | 32MP Front Camera,Battery:4810mAh,Processor:Dimensity 9200,Warranty:1 Year on Handset and 6 Months on Accessories'),(5,30,'TreasureEVERretailer','redmi.jpeg','REDMI Note 12',18999,'Ice Blue',0,'RAM:6 GB,ROM:64 GB,Expandable:Upto 1 TB,Display:6.67 inch Full HD+ Super AMOLED,Camera:50MP + 8MP + 2MP | 13MP Front Camera,Battery:5000mAh,Processor:Snapdragon 685,Warranty:1 Year Warranty '),(6,80,'MTAILMODEECOM','motorola.jpeg','MOTOROLA g13',13999,'Matte Charcoa',0,'RAM:4 GB,ROM:128 GB,Expandable:Upto 1 TB,Display:6.5 inch HD+ ,Camera:50MP + 2MP + 2MP | 8MP Front Camera,Battery:5000mAh,Processor:Helio G85,Warranty:1 Year on Handset and 6 Months on Accessories'),(7,10,'BUZZINDIA','oppo.jpeg','OPPO Find N2 Flip',89999,'Astral Black',0,'RAM:8 GB,ROM:256 GB,Expandable:Upto 1 TB,Display:6.8 inch Full HD+ ,Camera:50MP + 8MP | 32MP Front Camera,Battery:4300mAh,Processor:Mediatek Dimensity 9000+,Warranty:1 Year Manufacturer Warranty for Phone and 6 Months Warranty for in the Box Accessories'),(8,10,'ECOMTAMSINRetail','realme.jpeg','realme C55',13999,'Rainforest',0,'RAM:8 GB,ROM:128 GB,Expandable:Upto 1 TB,Display:6.72 inch Full HD+ ,Camera:64MP+2MP | 8MP Front Camera,Battery:5000mAh,Processor:Helio G88,Warranty:1 Year Manufacturer Warranty for Phone and 6 Months Warranty for in the Box Accessories'),(9,15,'MPDSLERetail','infinix.jpeg','Infinix Smart 7 HD',7999,'Silk Blue',0,'RAM:2 GB,ROM:64 GB,Expandable:Upto 1 TB,Display:6.6 inch HD+ ,Camera:8MP + AI Lens | 5MP Front Camera,Battery:5000mAh,Processor:Spreadtrum SC9863A1,Warranty:1 Year Manufacturer Warranty for Phone and 6 Months Warranty for in the Box Accessories'),(10,100,'Nameipic','vivo.jpeg','vivo X90',59999,'Breeze Blue',0,'RAM:8 GB,ROM:256 GB,Expandable:Upto 1 TB,Display:6.78 inch Full HD+ ,Camera:50MP + 12MP + 12MP | 32MP Front Camera,Battery:4810mAh,Processor:Dimensity 9200,Warranty:1 Year on Handset and 6 Months on Accessories'),(11,70,'CLIENTEROecom','poco_c51.jpeg','POCO C51',9999,'Royal Blue',0,'RAM:4 GB,ROM:64 GB,Expandable:Upto 1 TB,Display:6.52 inch HD+ ,Camera:8MP Dual Rear Camera | 5MP Front Camera,Battery:5000mAh,Processor:Helio G36,Warranty:1 Year Manufacturer Warranty for Phone and 6 Months Warranty for in the Box Accessories'),(12,44,'ECOMTAMSINRetail','realme.jpeg','realme C55',13999,'Rainforest',0,'RAM:8 GB,ROM:128 GB,Expandable:Upto 1 TB,Display:6.72 inch Full HD+ ,Camera:64MP+2MP | 8MP Front Camera,Battery:5000mAh,Processor:Helio G88,Warranty:1 Year Manufacturer Warranty for Phone and 6 Months Warranty for in the Box Accessories'),(13,760,'MPDSLERetail','infinix.jpeg','Infinix Smart 7 HD',7999,'Silk Blue',0,'RAM:2 GB,ROM:64 GB,Expandable:Upto 1 TB,Display:6.6 inch HD+ ,Camera:8MP + AI Lens | 5MP Front Camera,Battery:5000mAh,Processor:Spreadtrum SC9863A1,Warranty:1 Year Manufacturer Warranty for Phone and 6 Months Warranty for in the Box Accessories'),(14,120,'Nameipic','vivo.jpeg','vivo X90',59999,'Breeze Blue',0,'RAM:8 GB,ROM:256 GB,Expandable:Upto 1 TB,Display:6.78 inch Full HD+ ,Camera:50MP + 12MP + 12MP | 32MP Front Camera,Battery:4810mAh,Processor:Dimensity 9200,Warranty:1 Year on Handset and 6 Months on Accessories'),(15,170,'TreasureEVERretailer','redmi.jpeg','REDMI Note 12',18999,'Ice Blue',0,'RAM:6 GB,ROM:64 GB,Expandable:Upto 1 TB,Display:6.67 inch Full HD+ Super AMOLED,Camera:50MP + 8MP + 2MP | 13MP Front Camera,Battery:5000mAh,Processor:Snapdragon 685,Warranty:1 Year Manufacturer Warranty'),(16,150,'MTAILMODEECOM','motorola.jpeg','MOTOROLA g13',13999,'Matte Charcoa',0,'RAM:4 GB,ROM:128 GB,Expandable:Upto 1 TB,Display:6.5 inch HD+ ,Camera:50MP + 2MP + 2MP | 8MP Front Camera,Battery:5000mAh,Processor:Helio G85,Warranty:1 Year on Handset and 6 Months on Accessories'),(17,20,'BUZZINDIA','oppo.jpeg','OPPO Find N2 Flip',89999,'Astral Black',0,'RAM:8 GB,ROM:256 GB,Expandable:Upto 1 TB,Display:6.8 inch Full HD+ ,Camera:50MP + 8MP | 32MP Front Camera,Battery:4300mAh,Processor:Mediatek Dimensity 9000+,Warranty:1 Year Manufacturer Warranty for Phone and 6 Months Warranty for in the Box Accessories'),(18,190,'ECOMTAMSINRetail','realme.jpeg','realme C55',13999,'Rainforest',0,'RAM:8 GB,ROM:128 GB,Expandable:Upto 1 TB,Display:6.72 inch Full HD+ ,Camera:64MP+2MP | 8MP Front Camera,Battery:5000mAh,Processor:Helio G88,Warranty:1 Year Manufacturer Warranty for Phone and 6 Months Warranty for in the Box Accessories'),(19,175,'MPDSLERetail','infinix.jpeg','Infinix Smart 7 HD',7999,'Silk Blue',0,'RAM:2 GB,ROM:64 GB,Expandable:Upto 1 TB,Display:6.6 inch HD+ ,Camera:8MP + AI Lens | 5MP Front Camera,Battery:5000mAh,Processor:Spreadtrum SC9863A1,Warranty:1 Year Manufacturer Warranty for Phone and 6 Months Warranty for in the Box Accessories'),(20,220,'Nameipic','vivo.jpeg','vivo X90',59999,'Breeze Blue',0,'RAM:8 GB,ROM:256 GB,Expandable:Upto 1 TB,Display:6.78 inch Full HD+ ,Camera:50MP + 12MP + 12MP | 32MP Front Camera,Battery:4810mAh,Processor:Dimensity 9200,Warranty:1 Year on Handset and 6 Months on Accessories');
/*!40000 ALTER TABLE `product_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_pswd`
--

DROP TABLE IF EXISTS `user_pswd`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_pswd` (
  `user_id` int NOT NULL,
  `user` varchar(40) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `pwd` varchar(20) DEFAULT NULL,
  `verified` char(1) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_pswd`
--

LOCK TABLES `user_pswd` WRITE;
/*!40000 ALTER TABLE `user_pswd` DISABLE KEYS */;
INSERT INTO `user_pswd` VALUES (1,'sapna','sapnadevi.1610a@gmail.com','Sapna@123','1'),(2,'sapna','sapna@gmail.com','123456','0'),(3,'sapna','sapnadevi@gmail.com','123456','0'),(4,'sapna','hello@gmail.com','123456','0'),(5,'sapna','s@gmail.com','Sapna@123','0'),(6,'sapna','sap@gmail.com','Sapna@123','0'),(9,'sapna','sna@gmail.com','Sapna@123','0');
/*!40000 ALTER TABLE `user_pswd` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-07-10 22:39:39
