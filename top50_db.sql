/*
 Navicat Premium Data Transfer

 Source Server         : Localhost
 Source Server Type    : MySQL
 Source Server Version : 100132
 Source Host           : localhost
 Source Database       : top50_db

 Target Server Type    : MySQL
 Target Server Version : 100132
 File Encoding         : utf-8

 Date: 07/09/2019 23:31:48 PM
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `ci_sessions`
-- ----------------------------
DROP TABLE IF EXISTS `ci_sessions`;
CREATE TABLE `ci_sessions` (
  `id` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `ip_address` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `data` blob NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Records of `ci_sessions`
-- ----------------------------
BEGIN;
INSERT INTO `ci_sessions` VALUES ('046756e48acfd945163630af66f09869a4275776', '::1', '1562527675', 0x5f5f63695f6c6173745f726567656e65726174657c693a313536323532373637353b6964656e746974797c733a31313a22636c69656e743140612e63223b656d61696c7c733a31313a22636c69656e743140612e63223b757365725f69647c733a333a22333936223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231353632353130303432223b6c6173745f636865636b7c693a313536323532323432303b), ('0502d49893201bddf67ec29f81dd571bb970c49f', '::1', '1562535694', 0x5f5f63695f6c6173745f726567656e65726174657c693a313536323533353639343b6964656e746974797c733a31313a22636c69656e743140612e63223b656d61696c7c733a31313a22636c69656e743140612e63223b757365725f69647c733a333a22333936223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231353632353130303432223b6c6173745f636865636b7c693a313536323532323432303b), ('06610a613560543e8416f3d3c8f223ecc5d61a78', '::1', '1562526679', 0x5f5f63695f6c6173745f726567656e65726174657c693a313536323532363637393b6964656e746974797c733a31313a22636c69656e743140612e63223b656d61696c7c733a31313a22636c69656e743140612e63223b757365725f69647c733a333a22333936223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231353632353130303432223b6c6173745f636865636b7c693a313536323532323432303b), ('09df711097d22c6e6ce8332cd4893205d1c8b72a', '::1', '1562535321', 0x5f5f63695f6c6173745f726567656e65726174657c693a313536323533353332313b6964656e746974797c733a31313a22636c69656e743140612e63223b656d61696c7c733a31313a22636c69656e743140612e63223b757365725f69647c733a333a22333936223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231353632353130303432223b6c6173745f636865636b7c693a313536323532323432303b), ('12fc78e49e15a3a6ef9e5c6a2164ec84dfe13b65', '::1', '1562511083', 0x5f5f63695f6c6173745f726567656e65726174657c693a313536323531303738353b6964656e746974797c733a31313a22636c69656e743140612e63223b656d61696c7c733a31313a22636c69656e743140612e63223b757365725f69647c733a333a22333936223b6f6c645f6c6173745f6c6f67696e7c4e3b6c6173745f636865636b7c693a313536323531303034323b), ('253c0985bebfe12ef33b6a1ce8ae4cbfd4aafa02', '::1', '1562528784', 0x5f5f63695f6c6173745f726567656e65726174657c693a313536323532383738343b6964656e746974797c733a31313a22636c69656e743140612e63223b656d61696c7c733a31313a22636c69656e743140612e63223b757365725f69647c733a333a22333936223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231353632353130303432223b6c6173745f636865636b7c693a313536323532323432303b), ('2a27216c4883ee1b80de5e74b152b40818f15368', '::1', '1562523208', 0x5f5f63695f6c6173745f726567656e65726174657c693a313536323532333230383b6964656e746974797c733a31313a22636c69656e743140612e63223b656d61696c7c733a31313a22636c69656e743140612e63223b757365725f69647c733a333a22333936223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231353632353130303432223b6c6173745f636865636b7c693a313536323532323432303b), ('3647f9f2e136a20eac260e405ce56c5a5cd6897c', '::1', '1562524284', 0x5f5f63695f6c6173745f726567656e65726174657c693a313536323532343238343b6964656e746974797c733a31313a22636c69656e743140612e63223b656d61696c7c733a31313a22636c69656e743140612e63223b757365725f69647c733a333a22333936223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231353632353130303432223b6c6173745f636865636b7c693a313536323532323432303b), ('3b9b17cb160a4bc35ad73b283c458019414ad68e', '::1', '1562527010', 0x5f5f63695f6c6173745f726567656e65726174657c693a313536323532373031303b6964656e746974797c733a31313a22636c69656e743140612e63223b656d61696c7c733a31313a22636c69656e743140612e63223b757365725f69647c733a333a22333936223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231353632353130303432223b6c6173745f636865636b7c693a313536323532323432303b), ('3dc3cbb63fdbebdb05cd2dcd05608d48ef5a6707', '::1', '1562526321', 0x5f5f63695f6c6173745f726567656e65726174657c693a313536323532363332313b6964656e746974797c733a31313a22636c69656e743140612e63223b656d61696c7c733a31313a22636c69656e743140612e63223b757365725f69647c733a333a22333936223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231353632353130303432223b6c6173745f636865636b7c693a313536323532323432303b), ('4a1ece748c068916d7173827819c94062cbc9168', '::1', '1562510414', 0x5f5f63695f6c6173745f726567656e65726174657c693a313536323531303431343b6964656e746974797c733a31313a22636c69656e743140612e63223b656d61696c7c733a31313a22636c69656e743140612e63223b757365725f69647c733a333a22333936223b6f6c645f6c6173745f6c6f67696e7c4e3b6c6173745f636865636b7c693a313536323531303034323b), ('5694da80d0f2ed3d3f7bf1d21d5789ef7803fe1e', '::1', '1562606448', 0x5f5f63695f6c6173745f726567656e65726174657c693a313536323630363434383b6964656e746974797c733a31313a22636c69656e743140612e63223b656d61696c7c733a31313a22636c69656e743140612e63223b757365725f69647c733a333a22333936223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231353632353232343230223b6c6173745f636865636b7c693a313536323630353432373b), ('766f8b3fdf7dcb281a2ebe1b05991ab1aad2c508', '::1', '1562535905', 0x5f5f63695f6c6173745f726567656e65726174657c693a313536323533353639343b6964656e746974797c733a31313a22636c69656e743140612e63223b656d61696c7c733a31313a22636c69656e743140612e63223b757365725f69647c733a333a22333936223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231353632353130303432223b6c6173745f636865636b7c693a313536323532323432303b), ('7967b12e8e0566943b45491772cd946f2aa77cb0', '::1', '1562605427', 0x5f5f63695f6c6173745f726567656e65726174657c693a313536323630353432373b6964656e746974797c733a31313a22636c69656e743140612e63223b656d61696c7c733a31313a22636c69656e743140612e63223b757365725f69647c733a333a22333936223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231353632353232343230223b6c6173745f636865636b7c693a313536323630353432373b), ('7ba3dad1b48e91ab0f11ee8d5b745abf1491dce6', '::1', '1562523982', 0x5f5f63695f6c6173745f726567656e65726174657c693a313536323532333938323b6964656e746974797c733a31313a22636c69656e743140612e63223b656d61696c7c733a31313a22636c69656e743140612e63223b757365725f69647c733a333a22333936223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231353632353130303432223b6c6173745f636865636b7c693a313536323532323432303b), ('819ed1d8b94cc82b71e1dba3897547e4c3ca5cca', '::1', '1562607638', 0x5f5f63695f6c6173745f726567656e65726174657c693a313536323630373631383b6964656e746974797c733a31313a22636c69656e743140612e63223b656d61696c7c733a31313a22636c69656e743140612e63223b757365725f69647c733a333a22333936223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231353632353232343230223b6c6173745f636865636b7c693a313536323630353432373b), ('822add84197132fb981f6959b86fce516ccfc8b6', '::1', '1562606873', 0x5f5f63695f6c6173745f726567656e65726174657c693a313536323630363837333b6964656e746974797c733a31313a22636c69656e743140612e63223b656d61696c7c733a31313a22636c69656e743140612e63223b757365725f69647c733a333a22333936223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231353632353232343230223b6c6173745f636865636b7c693a313536323630353432373b), ('82798fd5134b09d6e325913fbcf04a3ea4522439', '::1', '1562510042', 0x5f5f63695f6c6173745f726567656e65726174657c693a313536323531303034323b6964656e746974797c733a31313a22636c69656e743140612e63223b656d61696c7c733a31313a22636c69656e743140612e63223b757365725f69647c733a333a22333936223b6f6c645f6c6173745f6c6f67696e7c4e3b6c6173745f636865636b7c693a313536323531303034323b), ('8eacd42959a626084cdb3452fc1fc5881f2dd5bc', '::1', '1562605923', 0x5f5f63695f6c6173745f726567656e65726174657c693a313536323630353932333b6964656e746974797c733a31313a22636c69656e743140612e63223b656d61696c7c733a31313a22636c69656e743140612e63223b757365725f69647c733a333a22333936223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231353632353232343230223b6c6173745f636865636b7c693a313536323630353432373b), ('a063d59a4600a4a4fff59de12fa3d5d397ea322c', '::1', '1562522420', 0x5f5f63695f6c6173745f726567656e65726174657c693a313536323532323432303b6964656e746974797c733a31313a22636c69656e743140612e63223b656d61696c7c733a31313a22636c69656e743140612e63223b757365725f69647c733a333a22333936223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231353632353130303432223b6c6173745f636865636b7c693a313536323532323432303b), ('b212b6256a3f2c3b5ea72d8259ddda6e9f67fa99', '::1', '1562353587', 0x5f5f63695f6c6173745f726567656e65726174657c693a313536323335333538363b6c6f67696e5f6d6573736167655f6572726f727c733a35333a223c703e54c3a069206b686fe1baa36e20686fe1bab763206de1baad74206b68e1baa975206b68c3b46e6720c491c3ba6e673c2f703e223b5f5f63695f766172737c613a313a7b733a31393a226c6f67696e5f6d6573736167655f6572726f72223b733a333a226f6c64223b7d), ('b291c655a2aa483427d43e9550d1189bbcd0b164', '::1', '1562510785', 0x5f5f63695f6c6173745f726567656e65726174657c693a313536323531303738353b6964656e746974797c733a31313a22636c69656e743140612e63223b656d61696c7c733a31313a22636c69656e743140612e63223b757365725f69647c733a333a22333936223b6f6c645f6c6173745f6c6f67696e7c4e3b6c6173745f636865636b7c693a313536323531303034323b), ('b6e6d612c967a825f594c8489f18034cb224a128', '::1', '1562523562', 0x5f5f63695f6c6173745f726567656e65726174657c693a313536323532333536323b6964656e746974797c733a31313a22636c69656e743140612e63223b656d61696c7c733a31313a22636c69656e743140612e63223b757365725f69647c733a333a22333936223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231353632353130303432223b6c6173745f636865636b7c693a313536323532323432303b), ('c0206b7de1ca6b8c781a670138389dce3662c389', '::1', '1562525071', 0x5f5f63695f6c6173745f726567656e65726174657c693a313536323532353037313b6964656e746974797c733a31313a22636c69656e743140612e63223b656d61696c7c733a31313a22636c69656e743140612e63223b757365725f69647c733a333a22333936223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231353632353130303432223b6c6173745f636865636b7c693a313536323532323432303b), ('d8010963e719f4be85e818fa41737560f6795861', '::1', '1562524734', 0x5f5f63695f6c6173745f726567656e65726174657c693a313536323532343733343b6964656e746974797c733a31313a22636c69656e743140612e63223b656d61696c7c733a31313a22636c69656e743140612e63223b757365725f69647c733a333a22333936223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231353632353130303432223b6c6173745f636865636b7c693a313536323532323432303b), ('eba8bc9511fced5385de15babc939b483ffb2a9c', '::1', '1562529102', 0x5f5f63695f6c6173745f726567656e65726174657c693a313536323532393130323b6964656e746974797c733a31313a22636c69656e743140612e63223b656d61696c7c733a31313a22636c69656e743140612e63223b757365725f69647c733a333a22333936223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231353632353130303432223b6c6173745f636865636b7c693a313536323532323432303b), ('eba8ef6069d6751df2777942a9bcc6d9a0bf6a84', '::1', '1562528391', 0x5f5f63695f6c6173745f726567656e65726174657c693a313536323532383339313b6964656e746974797c733a31313a22636c69656e743140612e63223b656d61696c7c733a31313a22636c69656e743140612e63223b757365725f69647c733a333a22333936223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231353632353130303432223b6c6173745f636865636b7c693a313536323532323432303b), ('f4289ce4d46f9e822b0a1d3beb50b08b8ac8bede', '::1', '1562525841', 0x5f5f63695f6c6173745f726567656e65726174657c693a313536323532353834313b6964656e746974797c733a31313a22636c69656e743140612e63223b656d61696c7c733a31313a22636c69656e743140612e63223b757365725f69647c733a333a22333936223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231353632353130303432223b6c6173745f636865636b7c693a313536323532323432303b), ('fa0726157715b84565da73a573254c621f6930c3', '::1', '1562607618', 0x5f5f63695f6c6173745f726567656e65726174657c693a313536323630373631383b6964656e746974797c733a31313a22636c69656e743140612e63223b656d61696c7c733a31313a22636c69656e743140612e63223b757365725f69647c733a333a22333936223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231353632353232343230223b6c6173745f636865636b7c693a313536323630353432373b), ('fd0f4db1a7d2a15a37a324452cfbc49a46e75257', '::1', '1562528065', 0x5f5f63695f6c6173745f726567656e65726174657c693a313536323532383036353b6964656e746974797c733a31313a22636c69656e743140612e63223b656d61696c7c733a31313a22636c69656e743140612e63223b757365725f69647c733a333a22333936223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231353632353130303432223b6c6173745f636865636b7c693a313536323532323432303b), ('fd472b7367143a60e78d474c3f5c24d05671e7b2', '::1', '1562527320', 0x5f5f63695f6c6173745f726567656e65726174657c693a313536323532373332303b6964656e746974797c733a31313a22636c69656e743140612e63223b656d61696c7c733a31313a22636c69656e743140612e63223b757365725f69647c733a333a22333936223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231353632353130303432223b6c6173745f636865636b7c693a313536323532323432303b), ('fee6df45e2dcf3c191f987f2df613157966aa246', '::1', '1562525473', 0x5f5f63695f6c6173745f726567656e65726174657c693a313536323532353437333b6964656e746974797c733a31313a22636c69656e743140612e63223b656d61696c7c733a31313a22636c69656e743140612e63223b757365725f69647c733a333a22333936223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231353632353130303432223b6c6173745f636865636b7c693a313536323532323432303b);
COMMIT;

-- ----------------------------
--  Table structure for `company`
-- ----------------------------
DROP TABLE IF EXISTS `company`;
CREATE TABLE `company` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL,
  `member_id` varchar(255) DEFAULT NULL,
  `group` int(11) DEFAULT NULL,
  `group10` int(11) DEFAULT NULL,
  `equity_1` varchar(50) DEFAULT NULL,
  `equity_2` varchar(50) DEFAULT NULL,
  `owner_equity_1` varchar(50) DEFAULT NULL,
  `owner_equity_2` varchar(50) DEFAULT NULL,
  `total_income_1` varchar(50) DEFAULT NULL,
  `total_income_2` varchar(50) DEFAULT NULL,
  `software_income_1` varchar(50) DEFAULT NULL,
  `software_income_2` varchar(50) DEFAULT NULL,
  `it_income_1` varchar(50) DEFAULT NULL,
  `it_income_2` varchar(50) DEFAULT NULL,
  `export_income_1` varchar(50) DEFAULT NULL,
  `export_income_2` varchar(50) DEFAULT NULL,
  `total_labor_1` varchar(50) DEFAULT NULL,
  `total_labor_2` varchar(50) DEFAULT NULL,
  `total_ltv_1` varchar(50) DEFAULT NULL,
  `total_ltv_2` varchar(50) DEFAULT NULL,
  `description` text,
  `main_service` text,
  `main_market` text,
  `is_submit` tinyint(1) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `modified_at` datetime DEFAULT NULL,
  `modified_by` varchar(100) DEFAULT NULL,
  `information_id` int(11) NOT NULL,
  `year` int(10) NOT NULL,
  `identity` varchar(100) NOT NULL,
  `overview` text,
  `active_area` text,
  `product` text,
  `equity_percent_1` varchar(10) DEFAULT NULL,
  `equity_percent_2` varchar(10) DEFAULT NULL,
  `owner_equity_percent_1` varchar(10) DEFAULT NULL,
  `owner_equity_percent_2` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=186 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `groups`
-- ----------------------------
DROP TABLE IF EXISTS `groups`;
CREATE TABLE `groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `groups`
-- ----------------------------
BEGIN;
INSERT INTO `groups` VALUES ('1', 'admin', 'Administrator'), ('2', 'members', 'General User'), ('3', 'clients', 'Guest User');
COMMIT;

-- ----------------------------
--  Table structure for `information`
-- ----------------------------
DROP TABLE IF EXISTS `information`;
CREATE TABLE `information` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL,
  `website` varchar(100) DEFAULT NULL,
  `legal_representative` varchar(100) DEFAULT NULL,
  `lp_position` varchar(100) DEFAULT NULL,
  `lp_email` varchar(100) DEFAULT NULL,
  `lp_phone` varchar(20) DEFAULT NULL,
  `connector` varchar(100) DEFAULT NULL,
  `c_position` varchar(100) DEFAULT NULL,
  `c_email` varchar(100) DEFAULT NULL,
  `c_phone` varchar(20) DEFAULT NULL,
  `link` varchar(200) DEFAULT NULL,
  `is_submit` tinyint(1) DEFAULT '0' COMMENT '0: haven''t save; 1: saved',
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `modified_at` datetime DEFAULT NULL,
  `modified_by` varchar(100) DEFAULT NULL,
  `identity` varchar(100) NOT NULL,
  `avatar` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=204 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `information`
-- ----------------------------
BEGIN;
INSERT INTO `information` VALUES ('203', '396', 'maillink.live', 'client1', 'client1', 'client1@a.c', '1231231231', 'client1', 'client1', 'client1@a.c', '3213123213', null, '0', '2019-07-08 02:06:55', 'client1@a.c', '2019-07-08 02:06:55', 'client1@a.c', '1111111111', '831c7f06e2a21e5fb3fe21dfdefb055f.jpg');
COMMIT;

-- ----------------------------
--  Table structure for `login_attempts`
-- ----------------------------
DROP TABLE IF EXISTS `login_attempts`;
CREATE TABLE `login_attempts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `new_rating`
-- ----------------------------
DROP TABLE IF EXISTS `new_rating`;
CREATE TABLE `new_rating` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `rating` text,
  `is_submit` int(1) DEFAULT '1',
  `total` double(50,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=446 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `product`
-- ----------------------------
DROP TABLE IF EXISTS `product`;
CREATE TABLE `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` int(11) DEFAULT NULL,
  `name` text,
  `service` text,
  `sub_service` text,
  `functional` text,
  `process` text,
  `security` text,
  `positive` text,
  `compare` text,
  `income_2016` varchar(50) DEFAULT NULL,
  `income_2017` varchar(50) DEFAULT NULL,
  `area` text,
  `open_date` varchar(255) DEFAULT NULL,
  `price` varchar(50) DEFAULT NULL,
  `customer` text,
  `after_sale` text,
  `team` text,
  `award` text,
  `certificate` varchar(100) DEFAULT NULL,
  `is_submit` tinyint(1) DEFAULT '0',
  `rating` tinyint(1) DEFAULT '0' COMMENT '0: chua rating; 1: dong y; 2: xem xet; 3: khong dong y',
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `modified_at` datetime DEFAULT NULL,
  `modified_by` varchar(100) DEFAULT NULL,
  `information_id` int(11) DEFAULT NULL,
  `identity` varchar(100) DEFAULT NULL,
  `file` text NOT NULL,
  `copyright_certificate` varchar(100) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `main_service` varchar(255) NOT NULL,
  `bak_main_service` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=212 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
--  Records of `product`
-- ----------------------------
BEGIN;
INSERT INTO `product` VALUES ('211', '396', '123', '[\"C\\u00f4ng nghi\\u1ec7p v\\u00e0 s\\u1ea3n xu\\u1ea5t\"]', null, 'asd', 'asd', 'asd', 'asd', 'asd', '123', '123', 'asd', '10/20/2019', '123', 'd', 'asd', 'asd', 'asd', null, '0', '0', '2019-07-08 02:42:04', 'client1@a.c', '2019-07-08 02:42:04', 'client1@a.c', '203', '1111111111', '', '123', '0', '', '');
COMMIT;

-- ----------------------------
--  Table structure for `rating`
-- ----------------------------
DROP TABLE IF EXISTS `rating`;
CREATE TABLE `rating` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) DEFAULT NULL,
  `product_id` varchar(100) DEFAULT NULL,
  `client_id` text,
  `precision` text,
  `strong` text,
  `weak` text,
  `rating` text,
  `result` varchar(50) DEFAULT NULL COMMENT '1: dong y; 2: xem xet; 3: khong dong y',
  `is_submit` tinyint(1) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `modified_at` datetime DEFAULT NULL,
  `modified_by` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `status`
-- ----------------------------
DROP TABLE IF EXISTS `status`;
CREATE TABLE `status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL,
  `is_information` tinyint(1) DEFAULT '0',
  `is_company` tinyint(1) DEFAULT '0',
  `is_product` tinyint(1) DEFAULT '0',
  `is_final` tinyint(1) DEFAULT '0',
  `year` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=256 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `status`
-- ----------------------------
BEGIN;
INSERT INTO `status` VALUES ('1', '396', '1', '0', '0', '0', null);
COMMIT;

-- ----------------------------
--  Table structure for `team`
-- ----------------------------
DROP TABLE IF EXISTS `team`;
CREATE TABLE `team` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `product_id` text,
  `member_id` text,
  `leader_id` int(11) DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `position` varchar(100) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `company_id` text NOT NULL,
  `information_id` int(11) DEFAULT NULL,
  `member_role` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=397 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `users`
-- ----------------------------
BEGIN;
INSERT INTO `users` VALUES ('1', '127.0.0.1', 'administrator', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', 'admin@admin.com', '', null, null, null, '1268889823', '1555509570', '1', 'Admin', 'istrator', null, 'ADMIN', '0', null, '', null, null), ('396', '::1', '1111111111', '$2y$08$UsdeExhtWPkILcAwGmS9A.pbHFsGe9g0RQ4uaIv0N15og/BMtDp6e', null, 'client1@a.c', '09ffe3c8a16d56e09b7f150de443b25500a088f0', null, null, null, '1562510021', '1562605427', '1', null, null, null, 'client1', '1231231231', null, '', '203', null);
COMMIT;

-- ----------------------------
--  Table structure for `users_groups`
-- ----------------------------
DROP TABLE IF EXISTS `users_groups`;
CREATE TABLE `users_groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  KEY `fk_users_groups_users1_idx` (`user_id`),
  KEY `fk_users_groups_groups1_idx` (`group_id`),
  CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=380 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `users_groups`
-- ----------------------------
BEGIN;
INSERT INTO `users_groups` VALUES ('203', '1', '1'), ('379', '396', '3');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
