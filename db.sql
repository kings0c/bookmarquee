/*
SQLyog Community v12.12 (64 bit)
MySQL - 5.6.19-0ubuntu0.14.04.1 : Database - bookmarquee
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`bookmarquee` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `bookmarquee`;

/*Table structure for table `bookmark_folders` */

DROP TABLE IF EXISTS `bookmark_folders`;

CREATE TABLE `bookmark_folders` (
  `bookmark_id` int(10) unsigned NOT NULL,
  `folder_id` int(10) unsigned NOT NULL,
  KEY `FK_bookmark_id_folders` (`bookmark_id`),
  KEY `FK_folder_id` (`folder_id`),
  CONSTRAINT `FK_folder_id` FOREIGN KEY (`folder_id`) REFERENCES `folders` (`folder_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_bookmark_id_folders` FOREIGN KEY (`bookmark_id`) REFERENCES `bookmarks` (`bookmark_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `bookmark_folders` */

/*Table structure for table `bookmark_tags` */

DROP TABLE IF EXISTS `bookmark_tags`;

CREATE TABLE `bookmark_tags` (
  `bookmark_id` int(10) unsigned NOT NULL,
  `tag_id` int(10) unsigned NOT NULL,
  KEY `FK_bookmark_id` (`bookmark_id`),
  KEY `FK_tag_id` (`tag_id`),
  CONSTRAINT `FK_tag_id` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`tag_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_bookmark_id` FOREIGN KEY (`bookmark_id`) REFERENCES `bookmarks` (`bookmark_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `bookmark_tags` */

/*Table structure for table `bookmarks` */

DROP TABLE IF EXISTS `bookmarks`;

CREATE TABLE `bookmarks` (
  `bookmark_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `owner_id` int(10) unsigned NOT NULL,
  `url` text,
  `content` longtext,
  `colour` tinytext,
  PRIMARY KEY (`bookmark_id`),
  KEY `FK_owner_id` (`owner_id`),
  CONSTRAINT `FK_owner_id` FOREIGN KEY (`owner_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `bookmarks` */

/*Table structure for table `folders` */

DROP TABLE IF EXISTS `folders`;

CREATE TABLE `folders` (
  `folder_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `folder_name` text NOT NULL,
  `parent_folder` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`folder_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `folders` */

/*Table structure for table `tags` */

DROP TABLE IF EXISTS `tags`;

CREATE TABLE `tags` (
  `tag_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tag_name` text NOT NULL,
  PRIMARY KEY (`tag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tags` */

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` text,
  `password` text,
  `first_name` text,
  `last_name` text,
  `reset_token` text,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `users` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
