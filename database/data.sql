USE `vite_gourmand`;

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

LOCK TABLES `allergen` WRITE;
/*!40000 ALTER TABLE `allergen` DISABLE KEYS */;
INSERT INTO `allergen` VALUES (1,'Gluten'),(2,'Lait'),(3,'Œufs');
/*!40000 ALTER TABLE `allergen` ENABLE KEYS */;
UNLOCK TABLES;

LOCK TABLES `allergen_dish` WRITE;
/*!40000 ALTER TABLE `allergen_dish` DISABLE KEYS */;
INSERT INTO `allergen_dish` VALUES (1,6),(2,4),(2,6),(3,6);
/*!40000 ALTER TABLE `allergen_dish` ENABLE KEYS */;
UNLOCK TABLES;

LOCK TABLES `customer_order` WRITE;
/*!40000 ALTER TABLE `customer_order` DISABLE KEYS */;
INSERT INTO `customer_order` VALUES (1,4,'2026-09-22','08:32:00','1 rue de la rue','01234','Inventée',0,120,0,5,125,'en attente','2026-09-22 04:32:18',1,3),(2,9,'2026-09-25','11:45:00','1 rue de la rue','01234','Inventée',0,270,27,5,248,'en attente','2026-09-22 04:41:32',1,3),(3,4,'2026-09-24','07:43:00','1 rue de la rue','01234','Inventée',10,120,0,10.9,130.9,'en attente','2026-09-22 04:43:11',1,3),(4,4,'2026-09-25','11:07:00','1 rue de la rue','01234','Inventée',0,120,0,5,125,'en attente','2026-09-22 05:08:05',1,3),(5,4,'2026-09-25','11:30:00','1 rue de la rue','01234','Inventée',0,120,0,5,125,'en attente','2026-09-22 05:18:30',1,3);
/*!40000 ALTER TABLE `customer_order` ENABLE KEYS */;
UNLOCK TABLES;

LOCK TABLES `dish` WRITE;
/*!40000 ALTER TABLE `dish` DISABLE KEYS */;
INSERT INTO `dish` VALUES (4,'Velouté de saison','Entrée','Velouté préparé avec des légumes de saison.'),(5,'Suprême de volaille','Plat','Suprême de volaille accompagné de légumes.'),(6,'Fondant au chocolat','Dessert','Fondant au chocolat servi en dessert.');
/*!40000 ALTER TABLE `dish` ENABLE KEYS */;
UNLOCK TABLES;

LOCK TABLES `dish_menu` WRITE;
/*!40000 ALTER TABLE `dish_menu` DISABLE KEYS */;
INSERT INTO `dish_menu` VALUES (4,3),(5,3),(6,3);
/*!40000 ALTER TABLE `dish_menu` ENABLE KEYS */;
UNLOCK TABLES;

LOCK TABLES `menu` WRITE;
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` VALUES (3,'Menu Élégance','Un menu complet pour vos événements et réceptions.','Classique','Classique',4,120.00,3,'Commande à réserver au minimum 48 heures avant la prestation.');
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;
UNLOCK TABLES;

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'berk@mail.com','[]','$2y$13$zfv7yNqfc/3/6uwPEow/COWLNpy/x6LRgHBQlsshUnBXSqZh1ZVUq','Prai','Nomp','0102304050','1 rue de la rue','01234','Inventée',0);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

