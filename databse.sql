-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: localhost    Database: shop_db
-- ------------------------------------------------------
-- Server version	8.0.34

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
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES (1,'Rushi','rushikeshsurve193@gmail.com','12345');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cart` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int NOT NULL,
  `quantity` int NOT NULL,
  `image` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cart`
--

LOCK TABLES `cart` WRITE;
/*!40000 ALTER TABLE `cart` DISABLE KEYS */;
/*!40000 ALTER TABLE `cart` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `message`
--

DROP TABLE IF EXISTS `message`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `message` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `message` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `message`
--

LOCK TABLES `message` WRITE;
/*!40000 ALTER TABLE `message` DISABLE KEYS */;
INSERT INTO `message` VALUES (1,1,'ff','ff@gg','55','holla'),(2,0,'hhjb','rushikeshsurve193@gmail.com','07499450771','Hello');
/*!40000 ALTER TABLE `message` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `email` varchar(100) NOT NULL,
  `method` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `total_products` varchar(1000) NOT NULL,
  `total_price` int NOT NULL,
  `placed_on` varchar(50) NOT NULL,
  `payment_status` varchar(20) NOT NULL DEFAULT 'pending',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (6,1,'Hardik Pandya','7499450771','pandyahardik@gmail.com','Cash on delivery','flat no. Gujrat Titans, IPL, Surat, India - 412416',', The happy lemon (1) , Nightshade (2) ',1701,'21-Oct-2023','pending'),(7,3,'Rushikesh Shekhar Surve','7499450771','rushikeshsurve193@gmail.com','Cash on delivery','flat no. Ratnagiri, , Ratnagiri, India - 415615',', Lloyd (1) ',149,'03-Nov-2023','pending');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `price` int NOT NULL,
  `image` varchar(100) NOT NULL,
  `author` varchar(255) NOT NULL DEFAULT 'Unknown',
  `description` varchar(500) DEFAULT NULL,
  `rating` decimal(3,2) NOT NULL DEFAULT '1.00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (10,'Bash and Lucy',158,'bash_and_lucy-2.jpg','Lisa and Michael Cohn','\"Bash and Lucy\" is a heartwarming children\'s book that tells the story of a special friendship between a dog named Bash and a young girl named Lucy. It explores themes of companionship, resilience, and the power of friendship. The story highlights the adventures and bond between the two, teaching valuable lessons about love and loyalty.',1.00),(11,'Be Well Bee',900,'be_well_bee.jpg','Dr. Alison Friesen','\"Be Well Bee\" is a comprehensive guide to the health and well-being of honey bees. It provides practical advice on how to keep your bees healthy and productive, and it covers a wide range of topics, including the biology of honey bees, beekeeping basics, bee nutrition and health, bee diseases and pests, and honey bee conservation.',1.00),(12,'Boring Girls',300,'boring_girls_a_novel.jpg','Sara Taylor',' Book name: Boring Girls Author: Sara Taylor Price (INR): 599 Brief description:  Boring Girls is a dark and disturbing novel about two teenage girls who form a heavy metal band and embark on a bloody journey of revenge. Rachel and Fern are both outcasts who have been mistreated by the people around them. They find solace in each other and in their music, but their anger and frustration soon boil over into violence.',1.00),(13,'Red Qeen',195,'red_queen.jpg','Victoria Aveyard','\"Red Queen\" is a captivating fantasy novel set in a world divided by blood — the elite with silver blood possessing superhuman abilities, and the oppressed red-blooded commoners. The story follows Mare Barrow, a Red girl who discovers she has Silver-like abilities, and she becomes embroiled in the dangerous world of the Silvers, where betrayal and power play a significant role. It\'s a tale of rebellion, power struggles, and the fight against societal injustice.',1.00),(14,'Harry Potter and the Sorcerer\'s Stone',150,'harry_potter_ss.jpg','J.K. Rowling','Harry Potter is an orphan boy who lives with his cruel aunt, uncle, and cousin. On his eleventh birthday, he learns that he is a wizard and is invited to attend Hogwarts School of Witchcraft and Wizardry. At Hogwarts, Harry makes new friends, learns about magic, and faces off against the evil Lord Voldemort.',1.00),(15,'The Lord of the Rings: The Fellowship of the Ring',300,'fellowship_of_rings.jpg','J.R.R. Tolkien','Frodo Baggins inherits the One Ring, an evil artifact created by the Dark Lord Sauron. Frodo must set out on a perilous journey to destroy the One Ring in the fires of Mount Doom, the only place where it can be destroyed. Along the way, he is joined by a fellowship of companions who help him on his quest.',1.00),(16,'Algorithms to Live By: The Computer Science of Human Decisions',650,'algorithms_to_live_by.jpg','Brian Christian and Tom Griffiths','In Algorithms to Live By, Brian Christian and Tom Griffiths discuss how computer science can be used to make better decisions in everyday life. They cover topics such as algorithms for finding the best mate, the best job, and the best way to invest your money.',1.00),(17,'Python Crash Course: A Hands-On, Project-Based Introduction to Programming',500,'python_crashcourse.jpg','Eric Matthes','Python Crash Course is a fast-paced introduction to the Python programming language. It covers the basics of Python, such as variables, functions, loops, and data structures, as well as more advanced topics such as object-oriented programming and web development.',1.00),(18,'Algorithms Unlocked',525,'algorithms_unlocked.jpg','Thomas Cormen','Algorithms Unlocked is a gentle introduction to the world of algorithms. It covers the basics of algorithm design and analysis, as well as more advanced topics such as graph algorithms and dynamic programming.',1.00),(19,'The God of Small Things',200,'the_god_of_small_things.jpg','Arundhati Roy',' The God of Small Things is a Booker Prize-winning novel about the lives of two fraternal twins, Rahel and Estha, in Kerala, India. The novel is a lyrical and moving exploration of love, loss, and the power of memory.',1.00);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'123','123@123','202cb962ac59075b964b07152d234b70'),(2,'New','new@new','827ccb0eea8a706c4c34a16891f84e7b'),(3,'Rushikesh','rushikeshsurve193@gmail.com','827ccb0eea8a706c4c34a16891f84e7b');
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

-- Dump completed on 2023-11-04  1:17:28
