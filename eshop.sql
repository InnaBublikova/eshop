/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50550
Source Host           : localhost:3306
Source Database       : eshop

Target Server Type    : MYSQL
Target Server Version : 50550
File Encoding         : 65001

Date: 2017-11-19 18:17:03
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for catalog
-- ----------------------------
DROP TABLE IF EXISTS `catalog`;
CREATE TABLE `catalog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT 'Без названия',
  `author` varchar(255) DEFAULT NULL,
  `pubyear` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of catalog
-- ----------------------------

-- ----------------------------
-- Table structure for orders
-- ----------------------------
DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '',
  `author` varchar(255) NOT NULL DEFAULT '',
  `pubyear` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL DEFAULT '1',
  `orderid` varchar(50) NOT NULL DEFAULT '',
  `datetime` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of orders
-- ----------------------------
