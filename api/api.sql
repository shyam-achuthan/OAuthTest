# Host: 192.168.33.20  (Version: 5.5.38-0ubuntu0.12.04.1)
# Date: 2014-10-24 14:19:24
# Generator: MySQL-Front 5.3  (Build 4.156)

/*!40101 SET NAMES utf8 */;

#
# Structure for table "api_detail"
#

DROP TABLE IF EXISTS `api_detail`;
CREATE TABLE `api_detail` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `api_key` varchar(255) NOT NULL DEFAULT '',
  `api_secret` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

#
# Data for table "api_detail"
#

INSERT INTO `api_detail` VALUES (1,'apikey1','apisecret1','shyam.webdev@gmail.com');
