-- MySQL dump 10.13  Distrib 5.5.32, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: hmp
-- ------------------------------------------------------
-- Server version	5.5.32-0ubuntu0.13.04.1

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
-- Table structure for table `refDistricts`
--

DROP TABLE IF EXISTS `refDistricts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `refDistricts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=186 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `refDistricts`
--

LOCK TABLES `refDistricts` WRITE;
/*!40000 ALTER TABLE `refDistricts` DISABLE KEYS */;
INSERT INTO `refDistricts` VALUES (1,'Appling County'),(2,'Atkinson County'),(3,'Atlanta Public Schools'),(4,'Bacon County'),(5,'Baker County'),(6,'Baldwin County'),(7,'Banks County'),(8,'Barrow County'),(9,'Bartow County'),(10,'Ben Hill County'),(11,'Berrien County'),(12,'Bibb County'),(13,'Bleckley County'),(14,'Brantley County'),(15,'Bremen City'),(16,'Brooks County'),(17,'Bryan County'),(18,'Buford City'),(19,'Bulloch County'),(20,'Burke County'),(21,'Butts County'),(22,'Calhoun City'),(23,'Calhoun County'),(24,'Camden County'),(25,'Candler County'),(26,'Carroll County'),(27,'Carrollton City'),(28,'Cartersville City'),(29,'Catoosa County'),(30,'CCAT School'),(31,'Charlton County'),(32,'Chatham County'),(33,'Chattahoochee County'),(34,'Chattooga County'),(35,'Cherokee County'),(36,'Chickamauga City'),(37,'Clarke County'),(38,'Clay County'),(39,'Clayton County'),(40,'Clinch County'),(41,'Cobb County'),(42,'Coffee County'),(43,'Colquitt County'),(44,'Columbia County'),(45,'Commerce City'),(46,'Cook County'),(47,'Coweta County'),(48,'Crawford County'),(49,'Crisp County'),(50,'Dade County'),(51,'Dalton City'),(52,'Dawson County'),(53,'Decatur City'),(54,'Decatur County'),(55,'DeKalb  County'),(56,'Dodge County'),(57,'Dooly County'),(58,'Dougherty County'),(59,'Douglas County'),(60,'Dublin City'),(61,'Early County'),(62,'Echols County'),(63,'Effingham County'),(64,'Elbert County'),(65,'Emanuel County'),(66,'Evans County'),(67,'Fannin County'),(68,'Fayette County'),(69,'Floyd County'),(70,'Forsyth County'),(71,'Franklin County'),(72,'Fulton County'),(73,'Gainesville City'),(74,'Gilmer County'),(75,'Glascock County'),(76,'Glynn County'),(77,'Gordon County'),(78,'Grady County'),(79,'Greene County'),(80,'Gwinnett County'),(81,'Habersham County'),(82,'Hall County'),(83,'Hancock County'),(84,'Haralson County'),(85,'Harris County'),(86,'Hart County'),(87,'Heard County'),(88,'Henry County'),(89,'Houston County'),(90,'Irwin County'),(91,'Ivy Preparatory Academy School'),(92,'Jackson County'),(93,'Jasper County'),(94,'Jeff Davis County'),(95,'Jefferson City'),(96,'Jefferson County'),(97,'Jenkins County'),(98,'Johnson County'),(99,'Jones County'),(100,'Lamar County'),(101,'Lanier County'),(102,'Laurens County'),(103,'Lee County'),(104,'Liberty County'),(105,'Lincoln County'),(106,'Long County'),(107,'Lowndes County'),(108,'Lumpkin County'),(109,'Macon County'),(110,'Madison County'),(111,'Marietta City'),(112,'Marion County'),(113,'McDuffie County'),(114,'McIntosh County'),(115,'Meriwether County'),(116,'Miller County'),(117,'Mitchell County'),(118,'Monroe County'),(119,'Montgomery County'),(120,'Morgan County'),(121,'Mountain Education Center School'),(122,'Murray County'),(123,'Muscogee County'),(124,'Newton County'),(125,'Oconee County'),(126,'Odyssey School'),(127,'Oglethorpe County'),(128,'Paulding County'),(129,'Peach County'),(130,'Pelham City'),(131,'Pickens County'),(132,'Pierce County'),(133,'Pike County'),(134,'Polk County'),(135,'Pulaski County'),(136,'Putnam County'),(137,'Quitman County'),(138,'Rabun County'),(139,'Randolph County'),(140,'Richmond County'),(141,'Rockdale County'),(142,'Rome City'),(143,'Schley County'),(144,'Screven County'),(145,'Seminole County'),(146,'Social Circle City'),(147,'Spalding County'),(148,'State Schools'),(149,'Stephens County'),(150,'Stewart County'),(151,'Sumter County'),(152,'Talbot County'),(153,'Taliaferro County'),(154,'Tattnall County'),(155,'Taylor County'),(156,'Telfair County'),(157,'Terrell County'),(158,'Thomas County'),(159,'Thomaston-Upson'),(160,'Thomasville City'),(161,'Tift County'),(162,'Toombs County'),(163,'Towns County'),(164,'Treutlen County'),(165,'Trion City'),(166,'Troup County'),(167,'Turner County'),(168,'Twiggs County'),(169,'Union County'),(170,'Valdosta City'),(171,'Vidalia City'),(172,'Walker County'),(173,'Walton County'),(174,'Ware County'),(175,'Warren County'),(176,'Washington County'),(177,'Wayne County'),(178,'Webster County'),(179,'Wheeler County'),(180,'White County'),(181,'Whitfield County'),(182,'Wilcox County'),(183,'Wilkes County'),(184,'Wilkinson County'),(185,'Worth County');
/*!40000 ALTER TABLE `refDistricts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `refResourceCategories`
--

DROP TABLE IF EXISTS `refResourceCategories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `refResourceCategories` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `minCohort` int(11) DEFAULT NULL,
  `maxCohort` int(11) DEFAULT NULL,
  `weight` int(11) NOT NULL DEFAULT '0' COMMENT 'for ordering in lists',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `refResourceCategories`
--

LOCK TABLES `refResourceCategories` WRITE;
/*!40000 ALTER TABLE `refResourceCategories` DISABLE KEYS */;
INSERT INTO `refResourceCategories` VALUES (1,'Heart to Start Blue Kit',1,5,0),(2,'Heart to Start Red Kit',1,5,0),(3,'Hardy Heart Kit',1,5,0),(4,'Calci M. Bone Kit',1,5,0),(5,'Windy, The Lungs Kit',1,5,0),(6,'Sir Rebrum Kit',1,5,0),(7,'Madame Muscle Kit',1,5,0),(8,'The Kidney Brothers/Peri Stolic Kit',1,5,0),(9,'Hardback Books',1,5,0),(10,'Organwise Guys CD & DVDs',1,5,0),(11,'Classroom Exercises for the Body and Brain',1,5,0),(12,'Mind In Motion DVDs',2,5,0),(13,'Mind In Motion 2 DVDs',3,5,0),(14,'HealthMPowers Integrated Lessons',1,5,0),(15,'Taste Testing Newsletters',1,5,0),(16,'Body Walk Booklets',2,3,0),(17,'Health Empowers YOU!! Booklet ',1,5,0),(18,'Review Questions',1,5,0),(19,'Family Fun Pack',3,5,0),(20,'Nutrition Travels Booklets',2,5,0),(21,'Pedometers & Math',2,5,0),(22,'My Health Empowering Portfolio',2,5,0),(23,'Take Charge of Your Health (Speakers Kit)',1,5,0),(24,'Catch Your Teacher/Student Being Healthy',1,2,0),(25,'Family Times Newsletters',1,5,0),(26,'10 Tips Newsletters',1,5,0),(27,'Kid2Kid Newsletters',1,5,0),(28,'Morning Announcements',1,5,0),(29,'Wisercise Booklets',1,5,0),(30,'Writing Prompts',1,5,0),(31,'Web-based Resources',1,5,0);
/*!40000 ALTER TABLE `refResourceCategories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `refResources`
--

DROP TABLE IF EXISTS `refResources`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `refResources` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `categoryId` int(11) unsigned DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `minutesPerUse` int(11) DEFAULT NULL COMMENT 'number of minutes a "use" takes',
  `maximumUsesPerMonth` int(11) DEFAULT NULL COMMENT 'maximum (total) uses allowed for a month',
  `nutrition` tinyint(1) DEFAULT NULL COMMENT '0 = Physical Activity, 1 = Nutrition.  Display in exports as PA or N',
  `minGrade` int(11) DEFAULT NULL,
  `maxGrade` int(11) DEFAULT NULL,
  `enabled` tinyint(1) DEFAULT NULL,
  `weight` int(11) NOT NULL DEFAULT '0' COMMENT 'for ordering',
  PRIMARY KEY (`id`),
  KEY `fk_refResources_refResourceCategory` (`categoryId`),
  CONSTRAINT `fk_refResources_refResourceCategory` FOREIGN KEY (`categoryId`) REFERENCES `refResourceCategories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=515 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `refResources`
--

LOCK TABLES `refResources` WRITE;
/*!40000 ALTER TABLE `refResources` DISABLE KEYS */;
INSERT INTO `refResources` VALUES (1,1,'It\'s a Teethday Party! (book/oral lesson) ',30,5,1,0,0,1,0),(2,1,'An OrganWise Fieldtrip (book/oral lesson) ',30,5,1,0,0,1,0),(3,1,'Counting on You to Play (book/oral lesson) ',30,5,1,0,0,1,0),(4,1,'Keeping your ',30,5,1,0,0,1,0),(5,1,'Feed Your OrganWise \"Pets\" (game) ',30,5,1,0,0,1,0),(6,2,'Cheering for Healthy Choices (book/oral lesson) ',30,5,1,0,0,1,0),(7,2,'Click on your Sir Rebrum (book/oral lesson) ',30,5,1,0,0,1,0),(8,2,'FIBER-ific Fashion (book/oral lesson) ',30,5,1,0,0,1,0),(9,2,'What\'s on your Plate? (book/oral lesson) ',30,5,1,0,0,1,0),(10,2,'FIBER-ific Fashions (game) ',30,5,1,0,0,1,0),(11,3,'School Days Here We Come (book/oral lesson) ',30,5,1,1,1,1,0),(12,3,'I Think I Forgot Something (book/oral lesson) ',30,5,1,1,1,1,0),(13,3,'All Hearts Need Love (book/oral lesson) ',30,5,1,1,1,1,0),(14,3,'Taking a Healthy Break (book/oral lesson) ',30,5,1,1,1,1,0),(15,3,'Here We Are! (puzzle) ',15,5,1,1,1,1,0),(16,4,'My Favorite Drink in the World (book/oral lesson) ',30,5,1,1,1,1,0),(17,4,'Bone Bank Savings (book/oral lesson) ',30,5,1,1,1,1,0),(18,4,'A Teeth Changing Experience (book/oral lesson) ',30,5,1,1,1,1,0),(19,4,'An Active Bone Life ',30,5,1,1,1,1,0),(20,4,'Calci\'s Bone Bank (game) ',30,5,1,1,1,1,0),(21,5,'Clean Air March (book/oral lesson) ',30,5,1,1,1,1,0),(22,5,'A Healthy Victory (book/oral lesson) ',30,5,1,1,1,1,0),(23,5,'Five a Day Reporter (book/oral lesson) ',30,5,1,1,1,1,0),(24,5,'A No Smoking Policy (book/oral lesson) ',30,5,1,1,1,1,0),(25,5,'Windy\'s No Smoking (card game) ',30,5,1,1,1,1,0),(26,6,'Are you GermWise? (book/oral lesson) ',30,5,1,2,2,1,0),(27,6,'Food Safety 101 (book/oral lesson) ',30,5,1,2,2,1,0),(28,6,'Making OrganWise Choices (book/oral lesson) ',30,5,1,2,2,1,0),(29,6,'Concentration on Fruits & Veggies (book/oral lesson) ',30,5,1,2,2,1,0),(30,6,'Concentrating on Smart Choice (game) ',30,5,1,2,2,1,0),(31,7,'Poetry in Motion (book/oral lesson) ',30,5,1,2,2,1,0),(32,7,'A Family Meal Plan (book/oral lesson) ',30,5,1,2,2,1,0),(33,7,'An Active Role Model (book/oral lesson) ',30,5,1,2,2,1,0),(34,7,'MyPyramid Activities (book/oral lesson) ',30,5,1,2,2,1,0),(35,7,'MyPyramid (activity/puzzle) ',15,5,1,2,2,1,0),(36,8,'Ideas for a Healthier World (book/oral lesson) ',30,5,1,2,2,1,0),(37,8,'MyPyramid Project (book/oral lesson) ',30,5,1,2,2,1,0),(38,8,'A High-Fiber Movement (book/oral lesson) ',30,5,1,2,2,1,0),(39,8,'Water Lessons from a Kid (book/oral lesson) ',30,5,1,2,2,1,0),(40,8,'Concentrating on MyPyramid (game) ',30,5,1,2,2,1,0),(41,9,'The Healthy Heart Challenge (book/oral lesson) ',30,2,1,3,3,1,0),(42,9,'How to be Smart From The Inside Out (book/oral lesson) ',30,2,1,3,3,1,0),(43,9,'Basic Training for Better Health (book/oral lesson) ',30,2,1,3,3,1,0),(44,9,'Train Your Brain (book/oral lesson) ',30,2,1,3,3,1,0),(45,9,'Balancing The Energy Equation (book/oral lesson) ',30,2,1,3,3,1,0),(46,9,'Pepto\'s Place (book/oral lesson) ',30,2,1,4,4,1,0),(47,9,'How to be Smart From The Inside Out (book/oral lesson) ',30,2,1,4,4,1,0),(48,9,'Basic Training for Better Health (book/oral lesson) ',30,2,1,4,4,1,0),(49,9,'Train Your Brain (book/oral lesson) ',30,2,1,4,4,1,0),(50,9,'Balancing The Energy Equation (book/oral lesson) ',30,2,1,4,4,1,0),(51,9,'Undercover Diabetes Health Agents (book/oral lesson) ',30,2,1,5,5,1,0),(52,9,'How to be Smart From The Inside Out (book/oral lesson) ',30,2,1,5,5,1,0),(53,9,'Basic Training for Better Health (book/oral lesson) ',30,2,1,5,5,1,0),(54,9,'Train Your Brain (book/oral lesson) ',30,2,1,5,5,1,0),(55,9,'Balancing The Energy Equation (book/oral lesson) ',30,2,1,5,5,1,0),(56,10,'Gimme Five DVD',15,1,1,0,0,1,0),(57,10,'Gimme Five Activity Sheet ',15,1,1,0,0,1,0),(58,10,'Breakfast Skippin\' Blues DVD',15,1,1,0,0,1,0),(59,10,'Breakfast Skippin\' Blues Activity Sheet ',15,1,1,0,0,1,0),(60,10,'Keepin\' the Beat Music CD (# of songs played) ',2,16,1,0,0,1,0),(61,10,'The OrganWise Guys Shorts DVD (# of shorts played) ',1,72,1,0,0,1,0),(62,10,'Calci\'s Big Race DVD',15,1,1,1,1,1,0),(63,10,'Calci\'s Big Race Activity Sheet ',15,1,1,1,1,1,0),(64,10,'Extreme Couch Potato DVD',15,1,1,1,1,1,0),(65,10,'Extreme Couch Potato Activity Sheet ',15,1,1,1,1,1,0),(66,10,'Keepin\' the Beat Music CD (# of songs played) ',2,16,1,1,1,1,0),(67,10,'The OrganWise Guys Shorts DVD (# of shorts played) ',1,72,1,1,1,1,0),(68,10,'Fiber Fandango DVD',15,1,1,2,2,1,0),(69,10,'Fiber Fandango Activity Sheet ',15,1,1,2,2,1,0),(70,10,'H2Ohhhhh! DVD',15,1,1,2,2,1,0),(71,10,'H2Ohhhhh! Activity Sheet ',15,1,1,2,2,1,0),(72,10,'Keepin\' the Beat Music CD (# of songs played) ',2,16,1,2,2,1,0),(73,10,'The OrganWise Guys Shorts DVD (# of shorts played) ',1,72,1,2,2,1,0),(74,10,'Farmer’s Market Fresh DVD',15,1,1,3,3,1,0),(75,10,'Farmer\'s Market Fresh Activity Sheet ',15,1,1,3,3,1,0),(76,10,'Pepto’s Party Portions DVD',15,1,1,3,3,1,0),(77,10,'Pepto\'s Party Portions Activity Sheet ',15,1,1,3,3,1,0),(78,10,'Keepin\' the Beat Music CD (# of songs played) ',2,16,1,3,3,1,0),(79,10,'The OrganWise Guys Shorts DVD (# of shorts played) ',1,72,1,3,3,1,0),(80,10,'Keepin\' the Beat Music CD (# of songs played) ',2,16,1,4,4,1,0),(81,10,'The OrganWise Guys Shorts DVD (# of shorts played) ',1,72,1,4,4,1,0),(82,10,'Keepin\' the Beat Music CD (# of songs played) ',2,16,1,5,5,1,0),(83,10,'The OrganWise Guys Shorts DVD (# of shorts played) ',1,72,1,5,5,1,0),(84,11,'Desktop Stretching  ',5,10,0,0,5,1,0),(85,11,'Air Step Aerobics ',5,10,0,0,5,1,0),(86,11,'Pretend Rope Jumping ',5,10,0,0,5,1,0),(87,11,'Chair Aerobics ',5,10,0,0,5,1,0),(88,11,'Canned Food ',5,10,0,0,5,1,0),(89,11,'Mind in Motion ',5,10,0,0,5,1,0),(90,11,'DVD Worksheet - Desktop Stretching',30,1,0,3,5,1,0),(91,11,'DVD Worksheet - Air Step Aerobics',30,1,0,3,5,1,0),(92,11,'DVD Worksheet - Pretend Rope Jumping',30,1,0,3,5,1,0),(93,11,'DVD Worksheet - Chair Aerobics ',30,1,0,3,5,1,0),(94,11,'DVD Worksheet - Canned Food',30,1,1,3,5,1,0),(95,12,'Level 1.1 ',5,10,0,0,5,1,0),(96,12,'Level 1.2 ',5,10,0,0,5,1,0),(97,12,'Level 2.1 ',5,10,0,0,5,1,0),(98,12,'Level 2.2 ',5,10,0,0,5,1,0),(99,12,'Level 3.1 ',5,10,0,0,5,1,0),(100,12,'Level 3.2 ',5,10,0,0,5,1,0),(101,12,'Level 4.1 ',5,10,0,0,5,1,0),(102,12,'Level 4.2',5,10,0,0,5,1,0),(103,12,'My Mind in Motion Sequence Handout',30,10,1,3,5,1,0),(104,13,'Level 1.1 ',5,10,0,3,5,1,0),(105,13,'Level 1.2 ',5,10,0,3,5,1,0),(106,13,'Level 2.1 ',5,10,0,3,5,1,0),(107,13,'Level 2.2 ',5,10,0,3,5,1,0),(108,13,'Level 3.1 ',5,10,0,3,5,1,0),(109,13,'Level 3.2 ',5,10,0,3,5,1,0),(110,13,'Level 4.1 ',5,10,0,3,5,1,0),(111,13,'Level 4.2 ',5,10,0,3,5,1,0),(112,13,'Create Your Own Routine Handout',30,10,0,3,5,1,0),(113,13,'My Routine Handout',30,10,1,3,5,1,0),(114,14,'Cheering for Healthy Choices-Capitalization & Punctuation ',45,1,1,0,0,1,0),(115,14,'What\'s on your Plate-Alphabetizing ',45,1,1,0,0,1,0),(116,14,'What\'s on your Plate-Writing ',45,1,1,0,0,1,0),(117,14,'FIBER-ific Fashion!-Graphing ',45,1,1,0,0,1,0),(118,14,'Gimme Five-Patterns ',45,1,1,0,0,1,0),(119,14,'It\'s a Teethday Party-Sequencing ',45,1,1,0,0,1,0),(120,14,'Vegetable Stand-Money ',45,1,1,0,0,1,0),(121,14,'What\'s on your Plate?-Adding and Subtracting ',45,1,1,0,0,1,0),(122,14,'Hardy Heart, I Think I Forgot Something-Writing ',45,1,1,1,1,1,0),(123,14,'Hardy Heart, School Days Here We Come!-Cause and Effect ',45,1,1,1,1,1,0),(124,14,'Hardy Heart, School Days Here We Come!-Comprehension ',45,1,1,1,1,1,0),(125,14,'Hardy Heart, School Days Here We Come!-3 Part Comprehension ',45,1,1,1,1,1,0),(126,14,'Windy The Lungs, Clean Air March-Writing ',45,1,1,1,1,1,0),(127,14,'Calci M. Bone, An Active Life-Positional Words ',45,1,1,1,1,1,0),(128,14,'Physical Figures  - Math',45,1,1,1,1,1,0),(129,14,'Active Sight Words ',45,1,1,1,1,1,0),(130,14,'Daily Oral Language with Physical Activity Theme Daily ',45,1,1,1,1,1,0),(131,14,'Patterns With Physical Activity ',45,1,1,1,1,1,0),(132,14,'Basic Training-Dictionary Skills ',45,1,1,2,3,1,0),(133,14,'Ideas for a Healthier World-Letter Writing ',45,1,1,2,2,1,0),(134,14,'A Family Meal Plan-Sequencing ',45,1,1,2,2,1,0),(135,14,'Food Stafety-Interpreting Illustrations ',45,1,1,2,2,1,0),(136,14,'Poetry in Motion-Poetry ',45,1,1,2,2,1,0),(137,14,'How to be Smart from the Inside Out-Writing ',45,1,1,2,2,1,0),(138,14,'Water lessons from a Kid-Graphing ',45,1,1,2,2,1,0),(139,14,'Healthy Food Items-Money ',45,1,1,2,2,1,0),(140,14,'Making Predictions ',45,1,1,2,2,1,0),(141,14,'Graphing Go and Slow Activities ',45,1,1,2,2,1,0),(142,14,'Fact & Opinion: Physical Activity Theme ',45,1,1,3,3,1,0),(143,14,'Persuasive Writing & Idioms ',45,1,1,3,3,1,0),(144,14,'Healthy Heart Challenge-Research Paper ',45,1,1,3,3,1,0),(145,14,'How to be Smart from the Inside Out-Writing ',45,1,1,3,3,1,0),(146,14,'Train Your Brain-Story Pyramid ',45,1,1,3,3,1,0),(147,14,'Multiplication Story Problems ',45,1,1,3,3,1,0),(148,14,'Healthy Heart Challenge-Graphing ',45,1,1,3,3,1,0),(149,14,'Types of Sentences ',45,1,1,4,4,1,0),(150,14,'Organ Annie/Andy-Persuasive Writing ',45,1,1,4,4,1,0),(151,14,'Pepto\'s Place-Cause and Effect ',45,1,1,4,4,1,0),(152,14,'Pepto\'s Place-Sentence Writing ',45,1,1,4,4,1,0),(153,14,'Smart from the Inside Out-Finding the Facts ',45,1,1,4,4,1,0),(154,14,'An Active Role Model-Math ',45,1,1,4,4,1,0),(155,14,'Fun With Food Labels ',45,1,1,4,4,1,0),(156,14,'Pepto\'s Place-Graphing ',45,1,1,4,4,1,0),(157,14,'Basic Training-Cause and Effect ',45,1,1,5,5,1,0),(158,14,'Basic Training-Poetry ',45,1,1,5,5,1,0),(159,14,'Undercover Diabetes Informational Writing ',45,1,1,5,5,1,0),(160,14,'Undercover Diabetes Main Idea Writing ',45,1,1,5,5,1,0),(161,14,'Basic Training Fractions ',45,1,1,5,5,1,0),(162,14,'Basic Training Graphing ',45,1,1,5,5,1,0),(163,14,'Uncovering Diabetes-Line Graph ',45,1,1,5,5,1,0),(164,15,'Apples ',30,1,1,0,5,1,0),(165,15,'Bell Peppers',30,1,1,0,5,1,0),(166,15,'Blueberries ',30,1,1,0,5,1,0),(167,15,'Broccoli',30,1,1,0,5,1,0),(168,15,'Carrots ',30,1,1,0,5,1,0),(169,15,'Cauliflower ',30,1,1,0,5,1,0),(170,15,'Cherry Tomatoes',30,1,1,0,5,1,0),(171,15,'Cucumbers',30,1,1,0,5,1,0),(172,15,'Grapes ',30,1,1,0,5,1,0),(173,15,'Kale',30,1,1,0,5,1,0),(174,15,'Parsnips ',30,1,1,0,5,1,0),(175,15,'Peaches ',30,1,1,0,5,1,0),(176,15,'Snap Peas ',30,1,1,0,5,1,0),(177,15,'Spinach',30,1,1,0,5,1,0),(178,15,'Strawberries ',30,1,1,0,5,1,0),(179,15,'Sweet Potatoes ',30,1,1,0,5,1,0),(180,15,'Turnips ',30,1,1,0,5,1,0),(181,15,'Winter Squash ',30,1,1,0,5,1,0),(182,15,'Zucchini ',30,1,1,0,5,1,0),(183,16,'Companion Activity page #1 ',15,1,0,0,2,1,0),(184,16,'Companion Activity page #2 ',15,1,0,0,2,1,0),(185,16,'Companion Activity page #3 ',15,1,0,0,2,1,0),(186,16,'Companion Activity page #4 ',15,1,0,0,2,1,0),(187,16,'Companion Activity page #5 ',15,1,0,0,2,1,0),(188,16,'Companion Activity page #6 ',15,1,0,0,2,1,0),(189,16,'Companion Activity page #7 ',15,1,0,0,2,1,0),(190,16,'Companion Activity page #8 ',15,1,0,0,2,1,0),(191,16,'Companion Activity page #9 ',15,1,0,0,2,1,0),(192,16,'Companion Activity page #10 ',15,1,0,0,2,1,0),(193,16,'Companion Activity page #11 ',15,1,0,0,2,1,0),(194,16,'Companion Activity page #12 ',15,1,0,0,2,1,0),(195,16,'Companion Activity page #13 ',15,1,0,0,2,1,0),(196,16,'Companion Activity page #14 ',15,1,0,0,2,1,0),(197,16,'Companion Activity page #15 ',15,1,0,0,2,1,0),(198,16,'Companion Activity page #1 ',15,1,0,3,5,1,0),(199,16,'Companion Activity page #2 ',15,1,0,3,5,1,0),(200,16,'Companion Activity page #3 ',15,1,0,3,5,1,0),(201,16,'Companion Activity page #4 ',15,1,0,3,5,1,0),(202,16,'Companion Activity page #5 ',15,1,0,3,5,1,0),(203,16,'Companion Activity page #6 ',15,1,0,3,5,1,0),(204,16,'Companion Activity page #7 ',15,1,0,3,5,1,0),(205,16,'Companion Activity page #8 ',15,1,0,3,5,1,0),(206,16,'Companion Activity page #9 ',15,1,0,3,5,1,0),(207,16,'Companion Activity page #10 ',15,1,0,3,5,1,0),(208,16,'Companion Activity page #11 ',15,1,0,3,5,1,0),(209,16,'Companion Activity page #12 ',15,1,0,3,5,1,0),(210,16,'Companion Activity page #13 ',15,1,0,3,5,1,0),(211,16,'Companion Activity page #14 ',15,1,0,3,5,1,0),(212,16,'Companion Activity page #15 ',15,1,1,3,5,1,0),(213,17,'Companion Activity page # 1 ',30,1,0,0,0,1,0),(214,17,'Companion Activity page # 2 ',30,1,0,0,0,1,0),(215,17,'Companion Activity page # 3 & 4 ',30,1,0,0,0,1,0),(216,17,'Companion Activity page # 5 ',30,1,0,0,0,1,0),(217,17,'Companion Activity page # 6 ',30,1,0,0,0,1,0),(218,17,'Companion Activity page # 7 ',30,1,0,0,0,1,0),(219,17,'Companion Activity page # 8 ',30,1,0,0,0,1,0),(220,17,'Companion Activity page # 9 ',30,1,0,0,0,1,0),(221,17,'Companion Activity page # 10 ',30,1,0,0,0,1,0),(222,17,'Companion Activity page # 11 ',30,1,0,0,0,1,0),(223,17,'Companion Activity page # 1 ',30,1,0,1,1,1,0),(224,17,'Companion Activity page # 2 ',30,1,0,1,1,1,0),(225,17,'Companion Activity page # 3',30,1,0,1,1,1,0),(226,17,'Companion Activity page # 4',30,1,0,1,1,1,0),(227,17,'Companion Activity page # 5 & 6 ',30,1,0,1,1,1,0),(228,17,'Companion Activity page # 7 ',30,1,0,1,1,1,0),(229,17,'Companion Activity page # 8 ',30,1,0,1,1,1,0),(230,17,'Companion Activity page # 9 ',30,1,0,1,1,1,0),(231,17,'Companion Activity page # 10 ',30,1,0,1,1,1,0),(232,17,'Companion Activity page # 11 ',30,1,0,1,1,1,0),(233,17,'Companion Activity page # 1 ',30,1,0,2,2,1,0),(234,17,'Companion Activity page # 2 ',30,1,0,2,2,1,0),(235,17,'Companion Activity page # 3 & 4 ',30,1,0,2,2,1,0),(236,17,'Companion Activity page # 5 & 6 ',30,1,0,2,2,1,0),(237,17,'Companion Activity page # 7 ',30,1,0,2,2,1,0),(238,17,'Companion Activity page # 8 ',30,1,0,2,2,1,0),(239,17,'Companion Activity page # 9 ',30,1,0,2,2,1,0),(240,17,'Companion Activity page # 10 ',30,1,0,2,2,1,0),(241,17,'Companion Activity page # 11 ',30,1,0,2,2,1,0),(242,17,'Companion Activity page # 1 ',30,1,0,3,3,1,0),(243,17,'Companion Activity page # 2 ',30,1,0,3,3,1,0),(244,17,'Companion Activity page # 3',30,1,0,3,3,1,0),(245,17,'Companion Activity page # 4',30,1,0,3,3,1,0),(246,17,'Companion Activity page # 5 & 6 ',30,1,0,3,3,1,0),(247,17,'Companion Activity page # 7 ',30,1,0,3,3,1,0),(248,17,'Companion Activity page # 8 ',30,1,0,3,3,1,0),(249,17,'Companion Activity page # 9 ',30,1,0,3,3,1,0),(250,17,'Companion Activity page # 10 ',30,1,0,3,3,1,0),(251,17,'Companion Activity page # 11 ',30,1,0,3,3,1,0),(252,17,'Companion Activity page # 1 ',30,1,0,4,4,1,0),(253,17,'Companion Activity page # 2 ',30,1,0,4,4,1,0),(254,17,'Companion Activity page # 3 & 4 ',30,1,0,4,4,1,0),(255,17,'Companion Activity page # 5 & 6 ',30,1,0,4,4,1,0),(256,17,'Companion Activity page # 7 ',30,1,0,4,4,1,0),(257,17,'Companion Activity page # 8 ',30,1,0,4,4,1,0),(258,17,'Companion Activity page # 9 ',30,1,0,4,4,1,0),(259,17,'Companion Activity page # 10 ',30,1,0,4,4,1,0),(260,17,'Companion Activity page # 11 ',30,1,0,4,4,1,0),(261,17,'Companion Activity page # 1 ',30,1,0,5,5,1,0),(262,17,'Companion Activity page # 2 ',30,1,0,5,5,1,0),(263,17,'Companion Activity page # 3 & 4 ',30,1,0,5,5,1,0),(264,17,'Companion Activity page # 5 ',30,1,0,5,5,1,0),(265,17,'Companion Activity page # 6 ',30,1,0,5,5,1,0),(266,17,'Companion Activity page # 7 ',30,1,0,5,5,1,0),(267,17,'Companion Activity page # 8 ',30,1,0,5,5,1,0),(268,17,'Companion Activity page # 9 ',30,1,0,5,5,1,0),(269,17,'Companion Activity page # 10 ',30,1,0,5,5,1,0),(270,17,'Companion Activity page # 11 ',30,1,1,5,5,1,0),(271,18,'Assembly Review Questions',10,1,1,0,0,1,0),(272,18,'Assembly Review Questions',10,1,1,1,1,1,0),(273,18,'Assembly Review Questions',10,1,1,2,2,1,0),(274,18,'Assembly Review Questions',10,1,1,3,3,1,0),(275,18,'Assembly Review Questions',10,1,1,4,4,1,0),(276,18,'Assembly Review Questions',10,1,1,5,5,1,0),(277,18,'Body Walk Review Questions',10,1,1,0,2,1,0),(278,18,'Body Walk Review Questions',10,1,1,3,5,1,0),(279,19,'Family Food Fun Pack Demonstration ',60,1,0,3,4,1,0),(280,19,'Family Fitness Fun Pack Demonstration ',60,1,1,3,4,1,0),(281,20,'Survival Guide ',25,1,1,4,4,1,0),(282,20,'Arizona ',25,1,1,4,4,1,0),(283,20,'California ',25,1,1,4,4,1,0),(284,20,'Hawaii ',25,1,1,4,4,1,0),(285,20,'Washington ',25,1,1,4,4,1,0),(286,20,'Wisconsin ',25,1,1,4,4,1,0),(287,20,'Michigan ',25,1,1,4,4,1,0),(288,20,'North Carolina ',25,1,1,4,4,1,0),(289,20,'Georgia ',25,1,1,4,4,1,0),(290,20,'Pennsylvania ',25,1,1,4,4,1,0),(291,20,'Florida ',25,1,1,4,4,1,0),(292,20,'Your Turn Activity ',25,1,1,4,4,1,0),(293,20,'Check Your Learning ',25,1,1,4,4,1,0),(294,20,'Reflection ',25,1,1,4,4,1,0),(295,21,'Tracking & Graphing Math Problems 1 & 2 ',15,1,0,3,3,1,0),(296,21,'Tracking & Graphing Math Problems 3 & 4 ',15,1,0,3,3,1,0),(297,21,'Tracking & Graphing Math Problems 5 & 6 ',15,1,0,3,3,1,0),(298,21,'Tracking & Graphing Math Problems 7 & 8 ',15,1,0,3,3,1,0),(299,21,'Tracking & Graphing Math Problems 9 & 10 ',15,1,0,3,3,1,0),(300,21,'Tracking & Graphing Math Problems 11 & 12 ',15,1,0,3,3,1,0),(301,21,'Tracking & Graphing Math Problems 13 & 14 ',15,1,0,3,3,1,0),(302,21,'Tracking & Graphing Math Problems 15 & 16 ',15,1,0,3,3,1,0),(303,21,'Tracking & Graphing Math Problems 17 & 18 ',15,1,0,3,3,1,0),(304,21,'Tracking & Graphing Math Problems 19 & 20 ',15,1,0,3,3,1,0),(305,21,'Reflections ',20,1,0,3,3,1,0),(306,21,'Tracking & Graphing Math Problems 1 & 2 ',15,1,0,4,4,1,0),(307,21,'Tracking & Graphing Math Problems 3 & 4 ',15,1,0,4,4,1,0),(308,21,'Tracking & Graphing Math Problems 5 & 6 ',15,1,0,4,4,1,0),(309,21,'Tracking & Graphing Math Problems 7 & 8 ',15,1,0,4,4,1,0),(310,21,'Tracking & Graphing Math Problems 9 & 10 ',15,1,0,4,4,1,0),(311,21,'Tracking & Graphing Math Problems 11 & 12 ',15,1,0,4,4,1,0),(312,21,'Tracking & Graphing Math Problems 13 & 14 ',15,1,0,4,4,1,0),(313,21,'Tracking & Graphing Math Problems 15 & 16 ',15,1,0,4,4,1,0),(314,21,'Tracking & Graphing Math Problems 17 & 18 ',15,1,0,4,4,1,0),(315,21,'Tracking & Graphing Math Problems 19 & 20 ',15,1,0,4,4,1,0),(316,21,'Reflections ',20,1,0,4,4,1,0),(317,21,'Tracking & Graphing Math Problems 1 & 2 ',15,1,0,5,5,1,0),(318,21,'Tracking & Graphing Math Problems 3 & 4 ',15,1,0,5,5,1,0),(319,21,'Tracking & Graphing Math Problems 5 & 6 ',15,1,0,5,5,1,0),(320,21,'Tracking & Graphing Math Problems 7 & 8 ',15,1,0,5,5,1,0),(321,21,'Tracking & Graphing Math Problems 9 & 10 ',15,1,0,5,5,1,0),(322,21,'Tracking & Graphing Math Problems 11 & 12 ',15,1,0,5,5,1,0),(323,21,'Tracking & Graphing Math Problems 13 & 14 ',15,1,0,5,5,1,0),(324,21,'Tracking & Graphing Math Problems 15 & 16 ',15,1,0,5,5,1,0),(325,21,'Tracking & Graphing Math Problems 17 & 18 ',15,1,0,5,5,1,0),(326,21,'Tracking & Graphing Math Problems 19 - 22 ',15,1,0,5,5,1,0),(327,21,'Reflections ',20,1,1,5,5,1,0),(328,22,'Steps 1 & 2',30,1,0,4,5,1,0),(329,22,'Step 3',30,1,0,4,5,1,0),(330,22,'Step 4',30,1,0,4,5,1,0),(331,22,'Step 5',30,1,0,4,5,1,0),(332,22,'Step 6',30,1,0,4,5,1,0),(333,22,'Step 7',30,1,0,4,5,1,0),(334,22,'Step 8',30,1,0,4,5,1,0),(335,22,'Step 9',30,1,0,4,5,1,0),(336,22,'Step 10',30,1,1,4,5,1,0),(337,23,'Take Charge of Your Health ',60,1,1,5,5,1,0),(338,24,'Nutrition/ Physical Activity Behavior Education Review ',15,1,1,0,5,1,0),(339,25,'Healthy Eating Requires 5 Fruits and Vegetables Daily',25,1,1,0,1,1,0),(340,25,'Family Fun Physical Activity',25,1,1,0,1,1,0),(341,25,'Dairy Calcium Rich Foods and Why',25,1,1,0,1,1,0),(342,25,'Choose Low-Fat Options',25,1,1,0,1,1,0),(343,25,'Fruits and Vegetables-Good for You!',25,1,1,2,3,1,0),(344,25,'Get Moving as a Family',25,1,1,2,3,1,0),(345,25,'Having a Calcium Rich Diet',25,1,1,2,3,1,0),(346,25,'Less Fat + A Healthier You!',25,1,1,2,3,1,0),(347,25,'A Colorful Plate',25,1,1,4,5,1,0),(348,25,'Physical Activity for Families',25,1,1,4,5,1,0),(349,25,'Increasing Calcium Intake',25,1,1,4,5,1,0),(350,25,'Limiting Fat In Your Diet',25,1,1,4,5,1,0),(351,25,'High Fiber Foods',25,1,1,0,1,0,0),(352,25,'Eat More Fiber',25,1,1,2,3,0,0),(353,25,'Yay for High Fiber',25,1,1,4,5,0,0),(354,25,'Reducing Screen Time',25,1,1,0,1,0,0),(355,25,'Screen Time\'s Toll on Children',25,1,1,2,3,0,0),(356,25,'Weighing In On Screen Time',25,1,1,4,5,0,0),(357,26,'Focus on Fruits',10,1,1,0,5,1,0),(358,26,'Be a Healthy Role Model for Children',10,1,1,0,5,1,0),(359,26,'Choose My Plate',10,1,1,0,5,1,0),(360,26,'Add More Vegetables To Your Day',10,1,1,0,5,1,0),(361,26,'Eating Better On a Budget',10,1,1,0,5,1,0),(362,26,'Build a Healthy Meal',10,1,1,0,5,1,0),(363,26,'Make Half of Your Grains Whole',10,1,1,0,5,0,0),(364,26,'Salt and Sodium',10,1,1,0,5,0,0),(365,26,'Cut Back On Your Kids\' Sweet Treats',10,1,1,0,5,0,0),(366,26,'Smart Shopping For Veggies and Fruits',10,1,1,0,5,0,0),(367,27,'Kid2Kid Newsletter Vol. 5 No. 1',45,1,1,3,5,1,0),(368,27,'Kid2Kid Newsletter Vol. 5 No. 2',45,1,1,3,5,1,0),(369,27,'Kid2Kid Newsletter Vol. 5 No. 3',45,1,1,3,5,1,0),(370,27,'Kid2Kid Newsletter Vol. 5 No. 4',45,1,1,3,5,1,0),(371,28,'August',0,20,1,0,5,1,0),(372,28,'September',0,20,1,0,5,1,0),(373,28,'October',0,20,1,0,5,1,0),(374,28,'November',0,20,1,0,5,1,0),(375,28,'December',0,20,1,0,5,1,0),(376,28,'January',0,20,1,0,5,1,0),(377,28,'February',0,20,1,0,5,1,0),(378,28,'March',0,20,1,0,5,1,0),(379,28,'April',0,20,1,0,5,1,0),(380,28,'May',0,20,1,0,5,1,0),(381,28,'June',0,20,1,0,5,1,0),(382,29,'Warm up:  Cadence March',10,2,0,0,2,1,0),(383,29,'Math:  Karate Kid Math',10,2,0,0,2,1,0),(384,29,'Math:  Imaginary Jump Rope',10,2,0,0,2,1,0),(385,29,'Math:  OrganWise Story Problems',10,2,0,0,2,1,0),(386,29,'Math:  Math in a Flash',10,2,0,0,2,1,0),(387,29,'Math:  Math Jeopardy',10,2,0,0,2,1,0),(388,29,'Math:  Sky Writing Math',10,2,0,0,2,1,0),(389,29,'Math:  Money Bags',10,2,0,0,2,1,0),(390,29,'Math:  Madame Muscle\'s Math Boot Camp',10,2,0,0,2,1,0),(391,29,'Language Arts:  Spelling OrganWise Style',10,2,0,0,2,1,0),(392,29,'Language Arts:  Jumping for Joy over Healthy Sentences',10,2,0,0,2,1,0),(393,29,'Language Arts:  Reading Cheerleading',10,2,0,0,2,1,0),(394,29,'Language Arts:  OrganWise Story Telling',10,2,0,0,2,1,0),(395,29,'Language Arts:  Air Brush Writing',10,2,0,0,2,1,0),(396,29,'Language Arts:  Reading on the Move',10,2,0,0,2,1,0),(397,29,'Language Arts:  Taking a Phonics \"Brake\"',10,2,0,0,2,1,0),(398,29,'Language Arts:  \"I Spy\" Phonics',10,2,0,0,2,1,0),(399,29,'Nutrition/Health:  A Shopping We Will Go',10,2,0,0,2,1,0),(400,29,'Nutrition/Health:  Windy\'s Magical Garden',10,2,0,0,2,1,0),(401,29,'Nutrition/Health:  Nutrition Through the Grapevine',10,2,0,0,2,1,0),(402,29,'Nutrition/Health:  OrganWise Snack Packing',10,2,0,0,2,1,0),(403,29,'Nutrition/Health:  Hoe, Hoe, Hoe Your Garden',10,2,0,0,2,1,0),(404,29,'Nutrition/Health:  Moving to MyPyramid',10,2,0,0,2,1,0),(405,29,'Nutrition/Health:  Healthy and Proud',10,2,0,0,2,1,0),(406,29,'Nutrition/Health:  Are You OrganWise?',10,2,0,0,2,1,0),(407,29,'Cool Down:  Stretching/Breathing',10,2,0,0,2,1,0),(408,29,'Cool Down:  Train Your Brain for Success',10,2,0,0,2,1,0),(409,29,'Warm up:  Cadence March',10,2,0,3,5,1,0),(410,29,'Math:  Karate Kid Math',10,2,0,3,5,1,0),(411,29,'Math:  Imaginary Jump Rope',10,2,0,3,5,1,0),(412,29,'Math:  OrganWise Story Problems',10,2,0,3,5,1,0),(413,29,'Math:  Math in a Flash',10,2,0,3,5,1,0),(414,29,'Math:  Math Jeopardy',10,2,0,3,5,1,0),(415,29,'Math:  Real World Math',10,2,0,3,5,1,0),(416,29,'Math:  Money Bags',10,2,0,3,5,1,0),(417,29,'Math:  Madame Muscle\'s Math Boot Camp',10,2,0,3,5,1,0),(418,29,'Language Arts:  Spelling OrganWise Style',10,2,0,3,5,1,0),(419,29,'Language Arts:  Pumped Up over Healthy Sentences',10,2,0,3,5,1,0),(420,29,'Language Arts:  Grammar Cheerleading',10,2,0,3,5,1,0),(421,29,'Language Arts:  Vocabulary….Football-Style',10,2,0,3,5,1,0),(422,29,'Language Arts:  Healthy Sentence Structure',10,2,0,3,5,1,0),(423,29,'Language Arts:  Reading Comprehension on the Move',10,2,0,3,5,1,0),(424,29,'Language Arts:  Taking a Grammar \"Brake\"',10,2,0,3,5,1,0),(425,29,'Language Arts:  A Class in Training',10,2,0,3,5,1,0),(426,29,'Nutrition/Health:  Zero in on Nutrition Facts',10,2,0,3,5,1,0),(427,29,'Nutrition/Health:  Windy\'s Magical Garden',10,2,0,3,5,1,0),(428,29,'Nutrition/Health:  Nutrition Through the Grapevine',10,2,0,3,5,1,0),(429,29,'Nutrition/Health:  OrganWise Snack Packing',10,2,0,3,5,1,0),(430,29,'Nutrition/Health:  20 Questions for Health',10,2,0,3,5,1,0),(431,29,'Nutrition/Health:  Moving to MyPyramid',10,2,0,3,5,1,0),(432,29,'Nutrition/Health:  Healthy and Proud',10,2,0,3,5,1,0),(433,29,'Nutrition/Health:  Are You OrganWise?',10,2,0,3,5,1,0),(434,29,'Cool Down:  Stretching/Breathing',10,2,0,3,5,1,0),(435,29,'Cool Down:  Train Your Brain for Success',10,2,1,3,5,1,0),(436,30,'K.1',20,2,1,0,0,1,0),(437,30,'K.2',20,2,1,0,0,1,0),(438,30,'K.3',20,2,1,0,0,1,0),(439,30,'K.4',20,2,1,0,0,1,0),(440,30,'K.5',20,2,1,0,0,1,0),(441,30,'K.6',20,2,1,0,0,1,0),(442,30,'K.7',20,2,1,0,0,1,0),(443,30,'1-2.1',20,2,1,1,2,1,0),(444,30,'1-2.2',20,2,1,1,2,1,0),(445,30,'1-2.3',20,2,1,1,2,1,0),(446,30,'1-2.4',20,2,1,1,2,1,0),(447,30,'1-2.5',20,2,1,1,2,1,0),(448,30,'1-2.6',20,2,1,1,2,1,0),(449,30,'1-2.7',20,2,1,1,2,1,0),(450,30,'1-2.8',20,2,1,1,2,1,0),(451,30,'1-2.9',20,2,1,1,2,1,0),(452,30,'1-2.10',20,2,1,1,2,1,0),(453,30,'1-2.11',20,2,1,1,2,1,0),(454,30,'1-2.12',20,2,1,1,2,1,0),(455,30,'3-5 Persuasive 1',45,2,1,3,5,1,0),(456,30,'3-5 Persuasive 2',45,2,1,3,5,1,0),(457,30,'3-5 Persuasive 3',45,2,1,3,5,1,0),(458,30,'3-5 Persuasive 4',45,2,1,3,5,1,0),(459,30,'3-5 Persuasive 5',45,2,1,3,5,1,0),(460,30,'3-5 Persuasive 6',45,2,1,3,5,1,0),(461,30,'3-5 Persuasive 7',45,2,1,3,5,1,0),(462,30,'3-5 Persuasive 8',45,2,1,3,5,1,0),(463,30,'3-5 Persuasive 9',45,2,1,3,5,1,0),(464,30,'3-5 Persuasive 10',45,2,1,3,5,1,0),(465,30,'3-5 Informational 1',45,2,1,3,5,1,0),(466,30,'3-5 Informational 2',45,2,1,3,5,1,0),(467,30,'3-5 Informational 3',45,2,1,3,5,1,0),(468,30,'3-5 Informational 4',45,2,1,3,5,1,0),(469,30,'3-5 Informational 5',45,2,1,3,5,1,0),(470,30,'3-5 Informational 6',45,2,1,3,5,1,0),(471,30,'3-5 Informational 7',45,2,1,3,5,1,0),(472,30,'3-5 Narrative 1',45,2,1,3,5,1,0),(473,30,'3-5 Narrative 2',45,2,1,3,5,1,0),(474,30,'3-5 Narrative 3',45,2,1,3,5,1,0),(475,30,'3-5 Narrative 4',45,2,1,3,5,1,0),(476,30,'3-5 Narrative 5',45,2,1,3,5,1,0),(477,30,'3-5 Narrative 6',45,2,1,3,5,1,0),(478,30,'3-5 Response 1',45,2,1,3,5,1,0),(479,30,'3-5 Response 2',45,2,1,3,5,1,0),(480,30,'3-5 Response 3',45,2,1,3,5,1,0),(481,31,'Kid2Kid Newsletter Vol. 1 No. 1',45,1,1,3,5,1,0),(482,31,'Kid2Kid Newsletter Vol. 1 No. 2',45,1,1,3,5,1,0),(483,31,'Kid2Kid Newsletter Vol. 1 No. 3',45,1,1,3,5,1,0),(484,31,'Kid2Kid Newsletter Vol. 2 No. 1',45,1,1,3,5,1,0),(485,31,'Kid2Kid Newsletter Vol. 2 No. 2',45,1,1,3,5,1,0),(486,31,'Kid2Kid Newsletter Vol. 2 No. 3',45,1,1,3,5,1,0),(487,31,'Kid2Kid Newsletter Vol. 2 No. 4',45,1,1,3,5,1,0),(488,31,'Kid2Kid Newsletter Vol. 2 No. 5',45,1,1,3,5,1,0),(489,31,'Kid2Kid Newsletter Vol. 2 No. 6',45,1,1,3,5,1,0),(490,31,'Kid2Kid Newsletter Vol. 3 No. 1',45,1,1,3,5,1,0),(491,31,'Kid2Kid Newsletter Vol. 3 No. 2',45,1,1,3,5,1,0),(492,31,'Kid2Kid Newsletter Vol. 3 No. 3',45,1,1,3,5,1,0),(493,31,'Kid2Kid Newsletter Vol. 3 No. 4',45,1,1,3,5,1,0),(494,31,'Kid2Kid Newsletter Vol. 3 No. 5',45,1,1,3,5,1,0),(495,31,'Kid2Kid Newsletter Vol. 4 No. 1',45,1,1,3,5,1,0),(496,31,'Kid2Kid Newsletter Vol. 4 No. 2',45,1,1,3,5,1,0),(497,31,'Kid2Kid Newsletter Vol. 4 No. 3',45,1,0,3,5,1,0),(498,31,'HMP Supplemental Lesson:  Basic Training for Better Health',45,1,1,0,1,1,0),(499,31,'HMP Supplemental Lesson:  Colorful Plates',45,1,1,0,1,1,0),(500,31,'HMP Supplemental Lesson:  Are You Fruit and Veggie Wise?',45,1,0,0,1,1,0),(501,31,'HMP Supplemental Lesson:  A Fun Filled OrganWise Day',45,1,1,0,1,1,0),(502,31,'HMP Supplemental Lesson:  Jump Start',45,1,0,0,1,1,0),(503,31,'HMP Supplemental Lesson:  Look at Me Being Active',45,1,0,0,1,1,0),(504,31,'HMP Supplemental Lesson:  OrganWise Guys - Happy Hardy',45,1,1,0,1,1,0),(505,31,'HMP Supplemental Lesson:  Are You Bone Wise?',45,1,1,2,3,1,0),(506,31,'HMP Supplemental Lesson:  Are you \"My Plate\" Wise?',45,1,1,2,3,1,0),(507,31,'HMP Supplemental Lesson:  My Plate Possibilities',45,1,0,2,3,1,0),(508,31,'HMP Supplemental Lesson:  Muscle, Heart and Brain Gyms',45,1,1,2,3,1,0),(509,31,'HMP Supplemental Lesson:  Sensible Snacking',45,1,1,2,3,1,0),(510,31,'HMP Supplemental Lesson:  How to be Smart From the Inside Out',45,1,0,2,3,1,0),(511,31,'HMP Supplemental Lesson:  The Healthy Heart Challenge',45,1,0,2,3,1,0),(512,31,'HMP Supplemental Lesson:  Being Physically Active',45,1,1,4,5,1,0),(513,31,'HMP Supplemental Lesson:  Find the Fat',45,1,0,4,5,1,0),(514,31,'HMP Supplemental Lesson:  Reducing Screen Time',45,1,1,4,5,1,0);
/*!40000 ALTER TABLE `refResources` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `schools`
--

DROP TABLE IF EXISTS `schools`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `schools` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `districtId` int(11) unsigned DEFAULT NULL,
  `administratorUserId` int(11) unsigned DEFAULT NULL,
  `verifierUserId` int(11) unsigned DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `approved` tinyint(1) NOT NULL DEFAULT '0',
  `startingSchoolYear` int(11) DEFAULT NULL,
  `classesStartDate` date DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fax` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `startTimeOfClasses` time DEFAULT NULL,
  `endTimeOfClasses` time DEFAULT NULL,
  `fallBreakDates` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `winterBreakDates` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `springBreakDates` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `itbsTestingDates` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `writingAssessmentDates` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `crctTestingDates` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shippingContactInfo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `principal` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `principalCarbonCopied` tinyint(1) DEFAULT NULL COMMENT 'Principal E-mailed on all Communication',
  `approveNewsletterCommunication` tinyint(1) DEFAULT NULL,
  `approveReminderPrompts` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_schools_refDistricts` (`districtId`),
  KEY `fk_schools_users` (`verifierUserId`),
  KEY `fk_schools_users_verifier` (`verifierUserId`),
  KEY `fk_schools_users_admin` (`administratorUserId`),
  CONSTRAINT `fk_schools_refDistricts` FOREIGN KEY (`districtId`) REFERENCES `refDistricts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_schools_users_admin` FOREIGN KEY (`administratorUserId`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_schools_users_verifier` FOREIGN KEY (`verifierUserId`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `schools`
--

LOCK TABLES `schools` WRITE;
/*!40000 ALTER TABLE `schools` DISABLE KEYS */;
INSERT INTO `schools` VALUES (1,1,1,5,'asd',1,2013,'2013-10-10','','','','asd@asd.asd','00:00:00','00:00:00','','','','','','','','dsas',0,0,0),(2,1,1,5,'asd@asd.asd',1,2013,'2013-10-10','','','','asd@asd.asd','00:00:00','00:00:00','','','','','','','','asd@asd.asd',0,0,0),(3,1,12,5,'asd@asd.asd',1,2013,'2013-10-10','','','','asd@asd.asd','00:00:00','00:00:00','','','','','','','','',0,0,0),(4,18,37,39,'asd@asd.asd',1,2013,'2013-01-01','','','','asd@asd.asd','00:00:00','00:00:00','','','','','','','','',0,0,0),(5,1,16,5,'asd@asd.asd',1,2013,'2013-08-25','','','','asd@asd.asd','00:00:00','00:00:00','','','','','','','','asd@asd.asd',0,0,0);
/*!40000 ALTER TABLE `schools` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `teachers`
--

DROP TABLE IF EXISTS `teachers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `teachers` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `userId` int(11) unsigned DEFAULT NULL,
  `schoolId` int(11) unsigned DEFAULT NULL,
  `schoolYear` int(11) DEFAULT NULL COMMENT 'assuming fall-spring so just include the fall year number (eg. for 2011-2012, store 2011)',
  `enabled` tinyint(1) DEFAULT NULL COMMENT 'if disabled, not looked for when attempting login',
  `gradeLevel` int(5) DEFAULT NULL COMMENT '0 (pre-k) - 6',
  `numStudents` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_teacher_users` (`userId`),
  KEY `fk_teacher_schools` (`schoolId`),
  KEY `fk_teachers_schools` (`schoolId`),
  CONSTRAINT `fk_teachers_schools` FOREIGN KEY (`schoolId`) REFERENCES `schools` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_teacher_users` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `teachers`
--

LOCK TABLES `teachers` WRITE;
/*!40000 ALTER TABLE `teachers` DISABLE KEYS */;
INSERT INTO `teachers` VALUES (4,5,2,2013,0,1,5),(5,6,2,2013,0,2,3),(6,7,2,2013,0,-1,0),(7,8,1,2013,0,1,5),(8,9,1,2013,0,2,3),(9,10,1,2013,0,-1,0);
/*!40000 ALTER TABLE `teachers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trackingEntry`
--

DROP TABLE IF EXISTS `trackingEntry`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trackingEntry` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `teacherId` int(11) unsigned NOT NULL,
  `schoolId` int(11) unsigned NOT NULL,
  `entered` datetime NOT NULL,
  `verified` datetime DEFAULT NULL,
  `reportingMonth` tinyint(2) NOT NULL DEFAULT '0',
  `reportingWeek` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `fk_trackingEntry_teacher` (`teacherId`),
  KEY `fk_trackingEntry_school` (`schoolId`),
  CONSTRAINT `fk_trackingEntry_school` FOREIGN KEY (`schoolId`) REFERENCES `schools` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_trackingEntry_teacher` FOREIGN KEY (`teacherId`) REFERENCES `teachers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trackingEntry`
--

LOCK TABLES `trackingEntry` WRITE;
/*!40000 ALTER TABLE `trackingEntry` DISABLE KEYS */;
INSERT INTO `trackingEntry` VALUES (1,4,2,'2013-06-26 00:00:00',NULL,8,1),(2,5,2,'2013-08-26 00:00:00',NULL,7,2),(3,6,3,'2013-07-27 00:00:00',NULL,7,1),(4,6,3,'2013-06-26 00:00:00',NULL,6,4),(5,7,1,'2013-09-06 09:50:42',NULL,9,1);
/*!40000 ALTER TABLE `trackingEntry` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trackingResources`
--

DROP TABLE IF EXISTS `trackingResources`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trackingResources` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `trackingEntryId` int(11) unsigned NOT NULL,
  `resourceId` int(11) unsigned NOT NULL,
  `timesUsed` int(11) DEFAULT NULL COMMENT '"Contacts"',
  PRIMARY KEY (`id`),
  KEY `fk_trackingResources_trackingEntry` (`trackingEntryId`),
  KEY `fk_trackingResources_refResources` (`resourceId`),
  CONSTRAINT `fk_trackingResources_refResources` FOREIGN KEY (`resourceId`) REFERENCES `refResources` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_trackingResources_trackingEntry` FOREIGN KEY (`trackingEntryId`) REFERENCES `trackingEntry` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trackingResources`
--

LOCK TABLES `trackingResources` WRITE;
/*!40000 ALTER TABLE `trackingResources` DISABLE KEYS */;
INSERT INTO `trackingResources` VALUES (1,1,1,1),(2,1,2,3),(3,1,3,2),(4,2,4,1),(5,2,5,5),(6,5,3,1);
/*!40000 ALTER TABLE `trackingResources` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(50) NOT NULL COMMENT 'login, May not be unique since teachers will be re-registered each year',
  `password` varchar(128) DEFAULT NULL COMMENT 'defaults to name grade name concatenated without spaces',
  `role` varchar(255) NOT NULL DEFAULT 'Teacher',
  `salt` varchar(128) NOT NULL,
  `securityCode` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'asd','admin','943fdf93f34f99d535fe4a0897ab8c4a329de877dcebee2c7432a0a0b245edec956526b6d0bdf84ad825940c1a2bcdb34362b0d2a5960ad2dfea3ccb09a3bbe7','HMP Admin','c9270c5ac08f0a31a2198684244ec159f7b24c40ed600b9ef777528b7d13f620c2862e99df1501ef97114ea7569c10d2397a5442c495a7818a203053a3829f55','5effb71c471bfdf109550f5286587419'),(5,' juan ramon','juan@ramon','943fdf93f34f99d535fe4a0897ab8c4a329de877dcebee2c7432a0a0b245edec956526b6d0bdf84ad825940c1a2bcdb34362b0d2a5960ad2dfea3ccb09a3bbe7','Teacher','c9270c5ac08f0a31a2198684244ec159f7b24c40ed600b9ef777528b7d13f620c2862e99df1501ef97114ea7569c10d2397a5442c495a7818a203053a3829f55',NULL),(6,' Whiterun Jarl','jarl@whiterun','2226455d590f8ed66bb7095cbf4fad6bc12121f2fa04d06775b250b199b3b1e36151bf3d959325be92eb288e6f0369a868607816967bfe10dd08530a6ce5a71f','Teacher','957f6fac9cfa78ce875bd97faf8e5635d60bd866f967754fac40a63c3edc37da1d53b52f6ff1acda1d8858f5c20160e199a8c66040d12cbe7f77c007ffec8964',NULL),(7,' James Cameron','james@cameron','fa6ad62ededb297aaaaec9f80b770aeea4665308c8d22f2ad3d860eb89906e701b2e601ce184aeb33a860b77777dc68c14c3fdc1e2106cec876c395cab8cda46','Teacher','ae2d77a2fd03bf0a9b5464e6f4362f0464df2a31bfbe38a0938036f3a3e0766bf7532ee00a14164be2b3d60e82b7141fb8fe1b2a92a3087bb859163607cac98c',NULL),(8,'8','juan@ramon','99865473f920b301aa294bec2e0f6ab6dcd1c6981238b97136df06fe687c0a04dfeda63841dddeee2dad6da3c626e0358c7f6ec6cdfaeb954c9c60f0a2317fa3','Support Staff','abec3e7825affbef712322578f2834fc86507ce17905485fa33c039031f2a679541ddff364dae3c5fdc2150b5f2c56654030915ebca13808e20e325943f28051',NULL),(9,'9','jarl@whiterun','80aa247098672580f4daa60a897a0fc193dfd7a30839b693159b8270de514494b495b4fe6b96c1f8c70bcf33b3ad327bdbe80a43794b43de5df10b36b30b5131','Support Staff','9ab23bf7b3b104dcfa1d0f78154b471c957ad0901587a3e7ce7cd64700789e531586f0c13b320470ced8433cf563fea584c6a27a93b64ce9f06533ee186d41c9',NULL),(10,'10','james@cameron','6664a3a9c7ce37d16b6d1b498bc2ed8b1f64e2d46ff436cf709cb5887731474b5d0e9fb72385268ca7383e0c17a5c7d01bd9315cc83730eec488c3c1cbd386c8','Teacher','f629ca2d2312ed3439659fd2e61749947b578387fcb655b57be029fd0ba9c68e10e8a72697252335ef5fbf2dda61287b7d5c3a36af05afc660e40d769d295e8e',NULL),(11,'asd@asd.asd','asd@asd.asd','2e44cc845e638ad626aa5409afdbc2e1c6969f2006bbe592e89429d4683ad4b66aeaf8c8e2d2275c18567395099c26ee9c3ddc6c25e7544619f90932861d57aa','Support Staff','f796885c571a05c66f5aabc4d6b12abcf441656ee9d7b1a2a109fbc033ace3d7d7a263cb77f100393c042f9a927eeeb2254b2400df5f028f2321661f46ca450d',NULL),(12,'asd@asd.asd','asd@asd.asd','8677c14eef3bb1fccccefca5d1458f9a5e0158b242221d748edddfda555a5b4c82edcc023d4516bb496f0b6083168086be3b495b8528e7579a8434866c2502e5','Support Staff','a01ce6ea18c6b0fb8d010383ab559c6e942730025d64aba81c23e95b2b3050b7aa5ccbff9edff81db7c986772fb1058d45dcf435fd524ab451a7ef913ea96ed4',NULL),(13,'asd@asd.asd','asd@asd.asd','debb3a0885554c0623fe6f4ba9915272eca370518391a3ec9b5fd889f3f5fbaeeb114367613d96f4d4f0c125fbf576bd7d3843c97ad5ad09b2aaab7b9e41dcb4','Support Staff','b32873cde3a66104ef5f2b837b34bf333d00a9a9c333d3cc83fd88fc4bfd2b0fb7be960306ea9fba8dd78a8e8eeb366c0f274951ae5c622c91f469f2109edbb2',NULL),(14,'asd@asd.asd','asd@asd.asd','e5e839d4e3e62d65fae588ebef84482c725b9cf79040aba444ff63ef7cf7263b65809460858c2b1b90c058c813f173a9afaea11fad0a189c418aae8beb5f8269','Support Staff','1e92d30705e6073823e48cfb3b823d0a46d86fab75b0dd4741cbc64945e10f577578e4b1ecccb14747c7f5d3388a4d9f222bcc935f1c533285b012a41a59c818',NULL),(16,'asd@asd.asd','asd@asd.asd','2eb21f39b9f82ca127f29af221f8349d9d20f5f260bbceeb77099da15788775dd3b86521d2c50deeff567ecb645e2d752566a21a6d90dc9ffaf31f5ae93015d8','Support Staff','05f10c91c02ebfa02331812e27a937a936cfd3df05ffa179b94cbd38a74ef4ba9ff81e89ced0bc91bbd3b1a909bd5bd3272cabd781eefe182038ee0be46e7830',NULL),(17,'asd@asd.asd','asd@asd.asd','3d37252e033537aec084c8ccb9b7d82ae85d308d468f9b2110d25b8fbdecdbed9158790b227b80dd15c60f057095bbc0305386c28395a8829e8c1f9b8f75e151','Support Staff','3210ba440c08f314f200429d384d6fd62b4ecdacacddb28653c4324b8da55f11ab154b168313a1677a2407b3055b348caacf9501e6100c6282ab18147703d7b9',NULL),(18,' juan ramon','juan@ramon','c7dc7e00b8e4a3256f08d09aa3d4d7409315db067f824d528de8e00f2aaf053e6061a2858f2a4f8c84e62654663a712334710f966977155e7c45678504073f12','Support Staff','504d8993c1fda9ccead86e891b9e86275fddc785d2e9a50863df9a0479a7bdc9e77d82cc25759748d9d2795437ad2ddc3db358f2e0c3adbf47eeac33b8b7c037',NULL),(19,'asd@asd.asd','asd@asd.asd','903d07a0c2a81ac7604d353516e4b67852ad6b77493f957572626426cfc5eeeeca5ab8b7815e3abe8259d0e7ed9e0cbfb821c584a2e2d4e14d664fa5129a0fd1','Support Staff','539d5eb5d6d6f2f94dc62b55153fc26ee9492fbde56a2dd82379deb4e006b36a43d820c6ba1d9e45f293499dd2b71aaa3f6443a694573a4d00a37b5c84c599c6',NULL),(21,'asd@asd.asd','asd@asd.asd','92731bf86b96dca4861781da5190a3249891e69df96f5c8eabcba5118ba4451d34ad6f490f2725022eb8a2c115cc69ba986c15ee3063e4a5f3507f63b6f68571','Support Staff','36a950d95fe9d5bd3c2023ef3421b35c61edaa104d9913a5090e391db4725efdbb1732f1cc7dab1ec9a33d8eb2bbb9367ec5f86df24fba8d2fa0782e7bc162c7',NULL),(22,'asd@asd.asd','asd@asd.asd','98fb002397578b97f6a26ddfe07c1c9f05b4b97a4652ab4db484b73d7bd029db10f1d886a5df61213353d7cc8d643f091593820c388a85b553bdb1c475374f14','Support Staff','103bac434902581adea67dbe09ae253085c6e8b7d7ad3527181f61e52c03d8c8eb6ea0913dd9541775c895ce392aee71b3d0953f48b09120e6be5485af1e9b98',NULL),(23,'asd@asd.asd','asd@asd.asd','c3d85777823a1d1c6a5775104035e4dc39f1800c01fc07864af74851630bcc72760f45351c68288e9c58ec2a872b2d720b8e50ae52320d7ab3b3f1288388b4c7','Support Staff','5b461044960b5dcc9f54c8dd26f6161078f6a32b3ca5776bda17856fc1fc3d6b2d7d332341ca10063b219a3576c9c0e0868970ad836e795d604d389ceddd85bc',NULL),(24,'asd@asd.asd','asd@asd.asd','395f257e93bad71720d30b89ff6bc1d5650941234577aba0345faa28c93cc3ad6b204163774dfe07b8792fe0df382fea5eb6d3b1a2af344436e6ec8609fd1a3f','Support Staff','abac761f496f4a3b5e41a98f67ba465b1b5a8e7dc010071205931e3f2fce93967bd687147f60e910e267fbff1aeec7fcef3d25479b6ef8f76880b1bf30ad527f',NULL),(25,'asd@asd.asd','asd@asd.asd','fcf6829bd31cc3647491811205ab164670a74492c2f8fe2cff14e959ad1fcc9d10e6d252d1cbf460d13e504f658f3b50ba07ff0e7a3a555c3715bcb11270d577','Support Staff','66d207be93c320a7ef1a827715ba28de27ae283a8abda748bff04c283e3cc7d84c73ed3418bae55e962ff68e35cf06acdb6dfd08b62ed73d860793d32e13a22b',NULL),(26,'asd@asd.asd','asd@asd.asd','c1bd108fe8c4e28edf39d06019ee5864edc138bec30685a5673efffdc8fe050ea48fc05784b7cd08e2f84cdfea6362aa9654cbbb35a17f1e656d5d53bdde5335','Support Staff','9fa49e2e7c57b6311c79c1e7b242bad166e9d613fbc1900a31f24071fafdd7aa24bc238ab31357dcd2b150ab6126cb5b50c1822652726b8170e3c563c59e6e5c',NULL),(27,'asd@asd.asd','asd@asd.asd','e87d4378db03e660ac7f0dc1c9ce038c2ded4f4194506b2d8953c4288e0d9fd09ffdaedc8b36986e6282544d7737bf886d6f83772b55593d24b9e02fad889eae','Support Staff','e9a189eb0c71b07e397149babfc033c078d7a0c0d0b2b674625cb769520303c5e5da0416e4cc6dd87b9e86e9fdc573bf7b5a8dd5d805ea35a47868ade2dc7899',NULL),(28,'asd@asd.asd','asd@asd.asd','220e8576e821f38d3c02b960744a66062e967dd113e4db5ad4a7974799143290dd863083084b38f2e6f4da0a9ed9a0aa47e32d598900cfc5fa50bf4fa7236eb2','Support Staff','f7db4e6b56d556b5fd3237f56cd22c882bccf4e574b5801a74f2e3c99aca49c682728535c04d4fd7c12f94fb7476d1d606921b949aed0493a2e0febe6aa8f3ad',NULL),(29,'asd@asd.asd','asd@asd.asd','a9db9abc1dbc43e725b240cca8b1984942798448f007935936dec394d8474a1399c3d3e911fcba3740f8fe876a57e3a5f2d6c20f1c2b561c814ff857a2cea3f0','Support Staff','716d7db11a4a3169fce8d36889b11d3676a33842f4885515de49b09dbd4802c07c5400e0006eb94601ed2e5c24c13939080ed78267c0bc6b4b6ae8a7d4392201',NULL),(30,'asd@asd.asd','asd@asd.asd','b71f7a04b5ce747e69f6f8bedf89cf1f3d0f28541929b8e086d481e6923f53ab5ca95045b247cd14f127e2ad3cfa50cce38d87e23fa92aea149541468ea3cee7','Support Staff','8b2394df9f3908d17fdbd05ef8b9a00d79c6b524eee88a0e407ed8a860f796edeaa8c34c8afc5b2c518e159fb52cea058205954dae1e73c0b2c8854659910cf9',NULL),(31,'asd@asd.asd','asd@asd.asd','e21d33bac965e06972a42ee5c77d372595349b5692230bb4f0f4a137d0db9aceb9d31977b1742c1a1ab219844355adf77880d50d6bb5abe7139ea0149b606c19','Support Staff','4a60ffa4fdd734dd212d7d20085c9c55c9e2cab25893f4e7722d181f82c20d40538347aef4f5be5063650fb2e864767657bf7961e0d1d9c4651ee9daec927c9d',NULL),(32,'asd@asd.asd','asd@asd.asd','66a826b69e7fbcd1e1903ca8872abc3b2af637004b9a8b7cdb99e30a3ee14627882d9ad600ca68785a95195b5bac9f761cc34512caa40d93661d0620ca049bc4','Support Staff','111a2da746e65b29c7868400374924dcf5dbbf591a739ceae3ba78ce7d90478d5094af40b79863b9d178212682442ebc35182e19bc07f9336f0d28334be2f4fb',NULL),(33,'asd@asd.asd','asd@asd.asd','a876a74cfbdef2715b69795530acd6b225bfbea7e48116b8e60ec1ccc3359768c8f5bebeb298eaeed275667b5665ece2430db7b5d20ded8e93d69b8c7c876c00','Support Staff','1cd4251175b5ec840346da11455096878c8a97132377bdc3d21c8b7d231f9d5bce555b6d3991ba8a48ee03ba6d450794c2b424c2e4bd0a755834ed6fa5c9329d',NULL),(34,'asd@asd.asd','asd@asd.asd','68ee5edc255a6935d08fe861185ce45ab7bf9b621d43e26f14a334fd00deb40557913fb3855eeff377bed0c309d5c7434b21f45c9a473f2982fe521ff62e0d8c','Support Staff','0b13ef2b269e8e166ca6b75fcf0aaf208a0fdf8da637209a1648a9a87ae6ff0657a9746f865593558ed2dd3c63d12a112a8950f1aa63ada9796e450cb08950bf',NULL),(35,'asd@asd.asd','asd@asd.asd','b5162340a730fef18cc7ce2b5d5a020d66d78090090356e8851ae39293a1c025f376f5362c463278d1fe6f27823d42f10f63948972faba4e99aadf1a899d9a08','Support Staff','8e4d5b6943a35cfbd1194b1d4adf8e57234ae5b0b056c98361f04cba6ecb431ef9f6067e46d8e20913ed640910f19879412daa8ac7d023d83c11bfc81a124d16',NULL),(36,'asd@asd.asd','asd@asd.asd','5d8a97f4dbb105bd82f4ca92c8b7149b0629633ac7d3ce7bb224531585918f63fc9e4d235ee0d692d202ed49bdcc05bb144a770e2e4559a3edafe7b3dfbef68b','Support Staff','3482d280d07e8e24c5d1ccd0535852cb5216198ca9b3f9fa36e4bd727a5c98f0f8125848b2061d09b77cc20e10a92c9ec4ad3797e249f8daef3f1feaab616a3c',NULL),(37,'asd@asd.asd','asd@asd.asd','e9b02729d405cc0ba7ced980da0fb197bfed72361600ceec3f2aa3a79de8e91e8da04475c947765a7f237cb072ea66f6ba67ebe5083235002d8c32bf1a8b119d','Support Staff','4fb9e6ae1991360852799c611ea0e3d9d6119de4a08dae98ca76aa28697c352805a0dd9ac48df086062ac4f71de8268c567934b4d882427d3eeef3d4195b5d82',NULL),(38,'asd@asd.asd','sdasd','28755a06abb599286c15b19164f96284d6cec72fe95e6f63bdee18d2524f428107ccfc81ab8b8265d5b9e89a3e61474efd5b5356ce0396e37a4c0d343a07562c','Support Staff','0188ddaec8933dd31d5e519767f826a5761fbdf6bc744f4a8a93694ea74c2861c14a47ed77b57b9e2d4ba873454ed4ebf1dfe8695b282e32e2cfc0fa92c909a8',NULL),(39,'asd@asd.asd','sdasd@asd.asd','a0fa45802f7d2eafcfcdab65d972ff62364d8784a26b487c0d5efb33514820e4f7ed8e7864a79406aa3d9d7d5adcdec556f9b4f014e55f32ed3db06f62c1698c','Support Staff','592d250db4ebbc9b68969b46264d7aff18e137ed7e58e80089af0a649f26e539b62f8aaad8d28d216542a92040a63202514270c3f8b40b2a168d6888a784d75b',NULL);
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

-- Dump completed on 2013-09-06  9:59:10
