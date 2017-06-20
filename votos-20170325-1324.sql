-- MySQL Administrator dump 1.4
--
-- ------------------------------------------------------
-- Server version	5.6.25


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


--
-- Create schema votos
--

CREATE DATABASE IF NOT EXISTS gagicrcc_awards;
USE gagicrcc_awards;

--
-- Definition of table `candidates`
--

DROP TABLE IF EXISTS `candidates`;
CREATE TABLE `candidates` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `id_category` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `candidates`
--

/*!40000 ALTER TABLE `candidates` DISABLE KEYS */;
INSERT INTO `candidates` (`id`,`name`,`id_category`) VALUES 
 (1,'mario soares',1),
 (2,'cavaco silva',1),
 (3,'socrates',1),
 (4,'alvaro cunhal',1),
 (5,'super mario',2),
 (6,'sonic',2),
 (7,'power ranger amarelo',2),
 (8,'bibi',3),
 (9,'pai natal',3),
 (10,'fernando mendes',3),
 (11,'trumpdonaldpikachu',4),
 (12,'blue',5),
 (13,'red',5),
 (14,'yellow',5),
 (15,'sda',6),
 (16,'baa',6),
 (17,'fs',6),
 (18,'a',7),
 (19,'b',7),
 (20,'c',7),
 (21,'a',8),
 (22,'b',8),
 (23,'c',8),
 (24,'1',9),
 (25,'2',9),
 (26,'3',9),
 (27,'3',10),
 (28,'3',10),
 (29,'4',10),
 (30,'4',11),
 (31,'a',11),
 (32,'b',11);
/*!40000 ALTER TABLE `candidates` ENABLE KEYS */;


--
-- Definition of table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `description` varchar(45) NOT NULL,
  `prize` varchar(200) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `id_winner` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` (`id`,`description`,`prize`,`start_date`,`end_date`,`id_winner`) VALUES 
 (1,'oscares','5 euros','2017-03-23 21:50:19','2017-03-23 21:50:19',4),
 (2,'batatoon','1 milhao de euros','2017-03-23 21:50:19','2017-03-23 21:50:19',6),
 (3,'festival da canção','10 euros','2017-03-23 21:50:19','2017-03-23 21:50:19',8),
 (11,'test','5435','2017-03-25 03:03:14','2017-03-29 03:03:14',0);
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;


--
-- Definition of table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `name` varchar(45) NOT NULL,
  `phone` varchar(45) NOT NULL,
  `admin` int(10) unsigned NOT NULL DEFAULT '0',
  `signup_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`,`email`,`password`,`name`,`phone`,`admin`,`signup_date`) VALUES 
 (1,'admin@gmail.com','test','admin','1234543',1,'0000-00-00 00:00:00');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;


--
-- Definition of table `votes`
--

DROP TABLE IF EXISTS `gagicrcc_awards`;
CREATE TABLE `votes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_voter` int(10) unsigned NOT NULL,
  `id_candidate` int(10) unsigned NOT NULL,
  `id_category` int(10) unsigned NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `votes`
--

/*!40000 ALTER TABLE `gagicrcc_awards` DISABLE KEYS */;
INSERT INTO `votes` (`id`,`id_voter`,`id_candidate`,`id_category`,`date`) VALUES 
 (1,1,4,1,'2017-03-23 23:22:11'),
 (2,2,3,1,'2017-03-23 23:22:11'),
 (3,2,6,2,'2017-03-23 23:22:11'),
 (4,1,11,4,'2017-03-24 20:53:19');
/*!40000 ALTER TABLE `votes` ENABLE KEYS */;




/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
