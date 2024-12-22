-- MySQL dump 10.13  Distrib 8.0.23, for Win64 (x86_64)
--
-- Host: localhost    Database: company_db
-- ------------------------------------------------------
-- Server version	8.0.23

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
     `id` int NOT NULL AUTO_INCREMENT,
     `name` varchar(255) NOT NULL,
     `email` varchar(255) NOT NULL UNIQUE,
     `employee_code` varchar(50) NOT NULL UNIQUE,
     `password` varchar(255) NOT NULL,
     `role` enum('manager','employee') NOT NULL,
     `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                         PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'John Doe','john.doe@example.com','EMP001','$2y$10$examplehash','employee','2023-01-01 00:00:00');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vacation_requests`
--

DROP TABLE IF EXISTS `vacation_requests`;
CREATE TABLE `vacation_requests` (
     `id` int NOT NULL AUTO_INCREMENT,
     `employee_id` int NOT NULL,
     `date_from` date NOT NULL,
     `date_to` date NOT NULL,
     `reason` text NOT NULL,
     `status` enum('pending','approved','rejected') DEFAULT 'pending',
     `date_submitted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
     PRIMARY KEY (`id`),
     KEY `employee_id` (`employee_id`),
     CONSTRAINT `vacation_requests_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vacation_requests`
--

LOCK TABLES `vacation_requests` WRITE;
/*!40000 ALTER TABLE `vacation_requests` DISABLE KEYS */;
INSERT INTO `vacation_requests` VALUES (1,1,'2023-12-01','2023-12-10','Vacation','pending','2023-01-01 00:00:00');
/*!40000 ALTER TABLE `vacation_requests` ENABLE KEYS */;
UNLOCK TABLES;