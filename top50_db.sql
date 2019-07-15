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

 Date: 07/13/2019 19:29:42 PM
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
INSERT INTO `ci_sessions` VALUES ('358d48917dad0f31bbbbe33029a2f4f4ecdb87f3', '::1', '1563013760', 0x5f5f63695f6c6173745f726567656e65726174657c693a313536333031333736303b6964656e746974797c733a31313a22636c69656e743140612e63223b656d61696c7c733a31313a22636c69656e743140612e63223b757365725f69647c733a333a22333936223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231353633303031323333223b6c6173745f636865636b7c693a313536333030383536393b), ('439b58d76309dc6ea1f5378f286baa7eface4d38', '::1', '1563017915', 0x5f5f63695f6c6173745f726567656e65726174657c693a313536333031373931353b6964656e746974797c733a31313a22636c69656e743140612e63223b656d61696c7c733a31313a22636c69656e743140612e63223b757365725f69647c733a333a22333936223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231353633303031323333223b6c6173745f636865636b7c693a313536333030383536393b), ('43f225902a1bda8e41a89fe2e47752b219c1a31e', '::1', '1563018764', 0x5f5f63695f6c6173745f726567656e65726174657c693a313536333031383736343b6964656e746974797c733a31313a22636c69656e743140612e63223b656d61696c7c733a31313a22636c69656e743140612e63223b757365725f69647c733a333a22333936223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231353633303031323333223b6c6173745f636865636b7c693a313536333030383536393b), ('4511825859fd64b4cdb9181827e6aab7e729de93', '::1', '1563014868', 0x5f5f63695f6c6173745f726567656e65726174657c693a313536333031343836383b6964656e746974797c733a31313a22636c69656e743140612e63223b656d61696c7c733a31313a22636c69656e743140612e63223b757365725f69647c733a333a22333936223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231353633303031323333223b6c6173745f636865636b7c693a313536333030383536393b), ('4b90491bbc9eee567d1009b118807bb18498b15d', '::1', '1563020958', 0x5f5f63695f6c6173745f726567656e65726174657c693a313536333032303933383b6964656e746974797c733a31313a22636c69656e743140612e63223b656d61696c7c733a31313a22636c69656e743140612e63223b757365725f69647c733a333a22333936223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231353633303031323333223b6c6173745f636865636b7c693a313536333030383536393b), ('58e6547e349201f367105497d77464e0d00dece8', '::1', '1563020938', 0x5f5f63695f6c6173745f726567656e65726174657c693a313536333032303933383b6964656e746974797c733a31313a22636c69656e743140612e63223b656d61696c7c733a31313a22636c69656e743140612e63223b757365725f69647c733a333a22333936223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231353633303031323333223b6c6173745f636865636b7c693a313536333030383536393b), ('5cfeeda73e1e91f18e066f5524113b1bfcd18d09', '::1', '1563014110', 0x5f5f63695f6c6173745f726567656e65726174657c693a313536333031343131303b6964656e746974797c733a31313a22636c69656e743140612e63223b656d61696c7c733a31313a22636c69656e743140612e63223b757365725f69647c733a333a22333936223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231353633303031323333223b6c6173745f636865636b7c693a313536333030383536393b6d6573736167657c733a32333a224974656d206164646564207375636365737366756c6c79223b5f5f63695f766172737c613a313a7b733a373a226d657373616765223b733a333a226f6c64223b7d), ('5d2fab97cbb49766ab43fe60d782661fe4692b68', '::1', '1563019129', 0x5f5f63695f6c6173745f726567656e65726174657c693a313536333031393132393b6964656e746974797c733a31313a22636c69656e743140612e63223b656d61696c7c733a31313a22636c69656e743140612e63223b757365725f69647c733a333a22333936223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231353633303031323333223b6c6173745f636865636b7c693a313536333030383536393b), ('669c734bc12e2827396423b6719692ecaed844d2', '::1', '1563020129', 0x5f5f63695f6c6173745f726567656e65726174657c693a313536333032303132393b6964656e746974797c733a31313a22636c69656e743140612e63223b656d61696c7c733a31313a22636c69656e743140612e63223b757365725f69647c733a333a22333936223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231353633303031323333223b6c6173745f636865636b7c693a313536333030383536393b), ('71f44611a287d42e35d0ef420c9ef8d9573b1c76', '::1', '1563017596', 0x5f5f63695f6c6173745f726567656e65726174657c693a313536333031373539363b6964656e746974797c733a31313a22636c69656e743140612e63223b656d61696c7c733a31313a22636c69656e743140612e63223b757365725f69647c733a333a22333936223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231353633303031323333223b6c6173745f636865636b7c693a313536333030383536393b), ('973a766ffb79ed02825cae0557df5c4bd2d40953', '::1', '1563019758', 0x5f5f63695f6c6173745f726567656e65726174657c693a313536333031393735383b6964656e746974797c733a31313a22636c69656e743140612e63223b656d61696c7c733a31313a22636c69656e743140612e63223b757365725f69647c733a333a22333936223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231353633303031323333223b6c6173745f636865636b7c693a313536333030383536393b), ('a247ca4b277317295618b8b017fd91cc3f617cd9', '::1', '1563018404', 0x5f5f63695f6c6173745f726567656e65726174657c693a313536333031383430343b6964656e746974797c733a31313a22636c69656e743140612e63223b656d61696c7c733a31313a22636c69656e743140612e63223b757365725f69647c733a333a22333936223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231353633303031323333223b6c6173745f636865636b7c693a313536333030383536393b), ('afc5d174206a35b127adb200d1b660667df78011', '::1', '1563016423', 0x5f5f63695f6c6173745f726567656e65726174657c693a313536333031363432333b6964656e746974797c733a31313a22636c69656e743140612e63223b656d61696c7c733a31313a22636c69656e743140612e63223b757365725f69647c733a333a22333936223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231353633303031323333223b6c6173745f636865636b7c693a313536333030383536393b6d6573736167657c733a32333a224974656d206164646564207375636365737366756c6c79223b5f5f63695f766172737c613a313a7b733a373a226d657373616765223b733a333a226f6c64223b7d), ('c247fc185f8779bd14fe0d47a337546d394d6317', '::1', '1563013420', 0x5f5f63695f6c6173745f726567656e65726174657c693a313536333031333432303b6964656e746974797c733a31313a22636c69656e743140612e63223b656d61696c7c733a31313a22636c69656e743140612e63223b757365725f69647c733a333a22333936223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231353633303031323333223b6c6173745f636865636b7c693a313536333030383536393b), ('d0c5c3f916d65ff3786aee00289aa7455c20f554', '::1', '1563014470', 0x5f5f63695f6c6173745f726567656e65726174657c693a313536333031343437303b6964656e746974797c733a31313a22636c69656e743140612e63223b656d61696c7c733a31313a22636c69656e743140612e63223b757365725f69647c733a333a22333936223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231353633303031323333223b6c6173745f636865636b7c693a313536333030383536393b), ('d317d2676e689ab9dcc826d7ac76c8f3db98d2e1', '::1', '1563019439', 0x5f5f63695f6c6173745f726567656e65726174657c693a313536333031393433393b6964656e746974797c733a31313a22636c69656e743140612e63223b656d61696c7c733a31313a22636c69656e743140612e63223b757365725f69647c733a333a22333936223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231353633303031323333223b6c6173745f636865636b7c693a313536333030383536393b);
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
  `total_assets_1` varchar(100) DEFAULT NULL,
  `total_assets_2` varchar(100) DEFAULT NULL,
  `total_assets_percent_1` varchar(10) DEFAULT NULL,
  `total_assets_percent_2` varchar(10) DEFAULT NULL,
  `total_income_percent_1` varchar(10) DEFAULT NULL,
  `total_income_percent_2` varchar(10) DEFAULT NULL,
  `total_income_6_months` varchar(100) DEFAULT NULL,
  `per_capita_income_1` varchar(100) DEFAULT NULL,
  `per_capita_income_2` varchar(100) DEFAULT NULL,
  `per_capita_income_percent_1` varchar(10) DEFAULT NULL,
  `per_capita_income_percent_2` varchar(10) DEFAULT NULL,
  `per_capita_income_6_months` varchar(100) DEFAULT NULL,
  `software_income_percent_1` varchar(10) DEFAULT NULL,
  `software_income_percent_2` varchar(10) DEFAULT NULL,
  `software_income_6_months` varchar(100) DEFAULT NULL,
  `it_income_percent_1` varchar(10) DEFAULT NULL,
  `it_income_percent_2` varchar(10) DEFAULT NULL,
  `it_income_6_months` varchar(100) DEFAULT NULL,
  `export_income_percent_1` varchar(10) DEFAULT NULL,
  `export_income_percent_2` varchar(10) DEFAULT NULL,
  `export_income_6_months` varchar(100) DEFAULT NULL,
  `international_income_1` varchar(100) DEFAULT NULL,
  `international_income_2` varchar(100) DEFAULT NULL,
  `international_income_percent_1` varchar(10) DEFAULT NULL,
  `international_income_percent_2` varchar(10) DEFAULT NULL,
  `international_income_6_months` varchar(100) DEFAULT NULL,
  `domestic_income_1` varchar(100) DEFAULT NULL,
  `domestic_income_2` varchar(100) DEFAULT NULL,
  `domestic_income_percent_1` varchar(10) DEFAULT NULL,
  `domestic_income_percent_2` varchar(10) DEFAULT NULL,
  `domestic_income_6_months` varchar(100) DEFAULT NULL,
  `before_tax_profit_1` varchar(100) DEFAULT NULL,
  `before_tax_profit_2` varchar(100) DEFAULT NULL,
  `before_tax_profit_percent_1` varchar(10) DEFAULT NULL,
  `before_tax_profit_percent_2` varchar(10) DEFAULT NULL,
  `before_tax_profit_6_months` varchar(100) DEFAULT NULL,
  `full_time_employee` varchar(20) DEFAULT NULL,
  `average_age` varchar(10) DEFAULT NULL,
  `employee_change_percent_1` varchar(10) DEFAULT NULL,
  `employee_change_percent_2` varchar(10) DEFAULT NULL,
  `english_employee` varchar(10) DEFAULT NULL,
  `english_employee_percent` varchar(10) DEFAULT NULL,
  `japanese_employee` varchar(10) DEFAULT NULL,
  `japanese_employee_percent` varchar(10) DEFAULT NULL,
  `other_language_employee` varchar(10) DEFAULT NULL,
  `other_language_employee_percent` varchar(10) DEFAULT NULL,
  `qualification` text,
  `average_salary` varchar(100) DEFAULT NULL,
  `customer_supporter` varchar(10) DEFAULT NULL,
  `training_process` text,
  `recruitment_staff` varchar(10) DEFAULT NULL,
  `recruitment_budget` varchar(100) DEFAULT NULL,
  `investment_fund_r_and_d` varchar(100) DEFAULT NULL,
  `investment_fund_r_and_d_percent` varchar(10) DEFAULT NULL,
  `staff_r_and_d` varchar(10) DEFAULT NULL,
  `result_r_and_d` text,
  `security_certificate` text,
  `security_process` text,
  `technique_certificate` text,
  `reward` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `company`
-- ----------------------------
BEGIN;
INSERT INTO `company` VALUES ('3', '396', null, '2', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', null, null, null, null, null, '[\"Giao th\\u00f4ng\",\"X\\u00e2y d\\u1ef1ng\"]', '[\"Th\\u1ecb tr\\u01b0\\u1eddng ng\\u01b0\\u1eddi ti\\u00eau d\\u00f9ng\",\"Gia c\\u00f4ng xu\\u1ea5t kh\\u1ea9u\",\"M\\u1ef9 v\\u00e0 c\\u00e1c n\\u01b0\\u1edbc B\\u1eafc M\\u1ef9\"]', '0', '2019-07-13 18:35:05', 'client1@a.c', '2019-07-13 19:17:35', 'client1@a.c', '0', '2019', '1111111111', 'asd1', '&amp;amp;amp;aacute;d1', 'asd1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '123asd', '1', '1', '1', '1', '1', '123asdasd', 'asd123', 'asd123', '32asd123', null);
COMMIT;

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
  `founding_date` datetime(6) DEFAULT NULL,
  `certificate` varchar(100) DEFAULT NULL,
  `certificate_date` datetime(6) DEFAULT NULL,
  `headquarters` text,
  `h_phone` varchar(20) DEFAULT NULL,
  `h_fax` varchar(30) DEFAULT NULL,
  `h_email` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=208 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `information`
-- ----------------------------
BEGIN;
INSERT INTO `information` VALUES ('207', '396', 'maillink.live', 'client1 1', 'no no', 'b@a.c', '123123123132', 'client1 2', '123', 'c@a.c', '123123123112', null, '0', '2019-07-13 17:48:47', 'client1@a.c', '2019-07-13 17:48:47', 'client1@a.c', '1111111111', 'd22bc4e9c75184d17f41ca9699ab1d3b.jpg', '2019-06-30 00:00:00.000000', '123123213213', '2019-07-08 00:00:00.000000', 'asd asd', '12321323123', '123123123', 'a@a.c');
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `status`
-- ----------------------------
BEGIN;
INSERT INTO `status` VALUES ('1', '396', '1', '1', '0', '1', null);
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
INSERT INTO `users` VALUES ('1', '127.0.0.1', 'administrator', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', 'admin@admin.com', '', null, null, null, '1268889823', '1555509570', '1', 'Admin', 'istrator', null, 'ADMIN', '0', null, '', null, null), ('396', '::1', '1111111111', '$2y$08$UsdeExhtWPkILcAwGmS9A.pbHFsGe9g0RQ4uaIv0N15og/BMtDp6e', null, 'client1@a.c', '09ffe3c8a16d56e09b7f150de443b25500a088f0', null, null, null, '1562510021', '1563008569', '1', null, null, null, 'client1', '1231231231', null, '', '207', null);
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
