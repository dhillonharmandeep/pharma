-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 28, 2011 at 10:56 AM
-- Server version: 5.0.91
-- PHP Version: 5.2.6

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `phph4151_pharma`
--

-- --------------------------------------------------------

--
-- Table structure for table `chainbgs`
--

DROP TABLE IF EXISTS `chainbgs`;
CREATE TABLE IF NOT EXISTS `chainbgs` (
  `id` int(10) NOT NULL auto_increment COMMENT 'Primary Key',
  `name` varchar(256) NOT NULL COMMENT 'Name of chain/banner group',
  `type` enum('Chain','BG') NOT NULL default 'Chain' COMMENT 'If its a chain or a Banner Group',
  `street` varchar(512) default NULL COMMENT 'first line of address',
  `street2` varchar(512) default NULL COMMENT 'Optional second line of address',
  `suburb` varchar(100) default NULL COMMENT 'Suburb name',
  `city` varchar(100) default NULL COMMENT 'City',
  `postcode` int(4) default NULL COMMENT 'Postcode',
  `state` varchar(3) default NULL COMMENT 'Iso for state like WA, QLD, NSW etc',
  `lat` float(10,6) default '0.000000' COMMENT 'The latitude derived from google maps API',
  `lng` float(10,6) default '0.000000' COMMENT 'The longitude derived from google maps API',
  `website` varchar(512) default NULL COMMENT 'Website for the chain/bg',
  `email1` varchar(100) default NULL COMMENT 'email1 for the chain/bg',
  `email2` varchar(100) default NULL COMMENT 'email2 for the chain/bg',
  `email3` varchar(100) default NULL COMMENT 'email3 for the chain/bg',
  `tel1` varchar(100) default NULL COMMENT 'tel1 for the chain/bg',
  `tel2` varchar(100) default NULL COMMENT 'tel2 for the chain/bg',
  `tel3` varchar(100) default NULL COMMENT 'tel3 for the chain/bg',
  `fax1` varchar(100) default NULL COMMENT 'fax1 for the chain/bg',
  `fax2` varchar(100) default NULL COMMENT 'fax2 for the chain/bg',
  `fax3` varchar(100) default NULL COMMENT 'fax3 for the chain/bg',
  `status` enum('Active','Inactive','Deleted') NOT NULL default 'Active',
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Stores information about chains and banner groups' AUTO_INCREMENT=40 ;

--
-- Dumping data for table `chainbgs`
--

INSERT INTO `chainbgs` (`id`, `name`, `type`, `street`, `street2`, `suburb`, `city`, `postcode`, `state`, `lat`, `lng`, `website`, `email1`, `email2`, `email3`, `tel1`, `tel2`, `tel3`, `fax1`, `fax2`, `fax3`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Chemist Warehouse NSW', 'Chain', '', '', '', '', 0, 'NSW', -31.253218, 146.921097, '', '', '', '', '', '', '', '', '', '', 'Active', '2010-12-10 10:31:41', '2011-02-03 23:53:32'),
(2, 'Cincotta Discount Chemists', 'Chain', '', '', '', '', 0, 'NSW', -31.253218, 146.921097, '', '', '', '', '', '', '', '', '', '', 'Active', '2010-12-10 11:36:57', '2011-01-02 03:17:36'),
(3, 'Broadway Pharmacy', 'BG', NULL, NULL, NULL, NULL, NULL, 'WA', -27.672817, 121.628311, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Deleted', '2010-12-16 04:52:21', '2010-12-28 23:14:10'),
(4, 'Pulse Pharmacy NSW', 'Chain', '', '', '', '', 0, 'NSW', -31.253218, 146.921097, '', '', '', '', '', '', '', '', '', '', 'Active', '2010-12-28 11:20:55', '2011-02-03 23:52:40'),
(5, 'Discount Drug Stores NSW', 'Chain', '', '', '', '', 0, 'NSW', -31.253218, 146.921097, '', '', '', '', '', '', '', '', '', '', 'Active', '2010-12-28 11:25:01', '2011-02-03 23:54:08'),
(6, 'Good Price Pharmacy Warehouse NSW', 'Chain', '', '', '', '', 0, 'NSW', -31.253218, 146.921097, '', '', '', '', '', '', '', '', '', '', 'Active', '2010-12-28 11:25:32', '2011-02-03 23:55:32'),
(7, 'Price Sense Pharmacy', 'Chain', '', '', '', '', 0, 'NSW', -31.253218, 146.921097, '', '', '', '', '', '', '', '', '', '', 'Active', '2010-12-28 11:25:57', '2010-12-28 23:25:57'),
(8, 'OZE-Pharmacy', 'Chain', '', '', '', '', 0, 'NSW', -31.253218, 146.921097, '', '', '', '', '', '', '', '', '', '', 'Deleted', '2010-12-28 11:26:20', '2011-02-03 23:24:05'),
(9, 'National Pharmacy', 'Chain', '', '', '', '', 0, 'NSW', -31.253218, 146.921097, '', '', '', '', '', '', '', '', '', '', 'Active', '2011-01-02 01:50:14', '2011-01-02 01:50:14'),
(10, 'Think Pharmacy', 'Chain', '', '', '', '', 0, 'NSW', -31.253218, 146.921097, '', '', '', '', '', '', '', '', '', '', 'Active', '2011-01-02 02:44:20', '2011-01-02 02:44:20'),
(11, 'OZE', '', NULL, NULL, NULL, NULL, NULL, 'Cha', -34.821484, 138.871994, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Deleted', '2011-01-19 05:23:09', '2011-02-03 23:13:25'),
(12, 'OZE', '', NULL, NULL, NULL, NULL, NULL, 'Cha', -34.821484, 138.871994, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Deleted', '2011-01-19 05:24:11', '2011-02-03 23:13:45'),
(13, 'OZE', '', NULL, NULL, NULL, NULL, NULL, 'Cha', -34.821484, 138.871994, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Deleted', '2011-01-19 05:24:55', '2011-02-03 23:13:49'),
(14, 'OZE', '', NULL, NULL, NULL, NULL, NULL, 'Cha', -34.821484, 138.871994, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Deleted', '2011-02-03 10:57:40', '2011-02-03 23:13:53'),
(15, 'OZE', '', NULL, NULL, NULL, NULL, NULL, 'Cha', -34.821484, 138.871994, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Deleted', '2011-02-03 11:00:54', '2011-02-03 23:13:57'),
(16, 'OZE', '', NULL, NULL, NULL, NULL, NULL, 'Cha', -34.821484, 138.871994, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Deleted', '2011-02-03 11:01:05', '2011-02-03 23:14:00'),
(17, 'OZE', '', NULL, NULL, NULL, NULL, NULL, 'Cha', -34.821484, 138.871994, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Deleted', '2011-02-03 11:01:10', '2011-02-03 23:14:05'),
(18, 'OZE', '', NULL, NULL, NULL, NULL, NULL, 'Cha', -34.821484, 138.871994, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Deleted', '2011-02-03 11:01:25', '2011-02-03 23:14:08'),
(19, 'OZE', '', NULL, NULL, NULL, NULL, NULL, 'Cha', -34.821484, 138.871994, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Deleted', '2011-02-03 11:03:41', '2011-02-03 23:14:14'),
(20, 'OZE', '', NULL, NULL, NULL, NULL, NULL, 'Cha', -34.821484, 138.871994, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Deleted', '2011-02-03 11:04:07', '2011-02-03 23:14:21'),
(21, '', 'Chain', NULL, NULL, NULL, NULL, NULL, 'NSW', -31.253218, 146.921097, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Deleted', '2011-02-03 11:08:29', '2011-02-03 23:14:27'),
(22, 'OZE', '', NULL, NULL, NULL, NULL, NULL, 'Cha', -34.821484, 138.871994, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Deleted', '2011-02-03 11:08:37', '2011-02-03 23:13:39'),
(23, 'OZE', '', NULL, NULL, NULL, NULL, NULL, 'Cha', -34.821484, 138.871994, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Deleted', '2011-02-03 11:08:55', '2011-02-03 23:14:31'),
(24, 'OZE', '', NULL, NULL, NULL, NULL, NULL, 'Cha', -34.821484, 138.871994, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Deleted', '2011-02-03 11:10:16', '2011-02-03 23:14:35'),
(25, 'OZE', '', NULL, NULL, NULL, NULL, NULL, 'Cha', -34.821484, 138.871994, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Deleted', '2011-02-03 11:10:34', '2011-02-03 23:14:39'),
(26, 'OZE', '', NULL, NULL, NULL, NULL, NULL, 'Cha', -34.821484, 138.871994, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Deleted', '2011-02-03 11:10:55', '2011-02-03 23:14:44'),
(27, 'OZE', '', NULL, NULL, NULL, NULL, NULL, 'Cha', -34.821484, 138.871994, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Deleted', '2011-02-03 11:11:31', '2011-02-03 23:14:49'),
(28, 'OZE', '', NULL, NULL, NULL, NULL, NULL, 'Cha', -34.821484, 138.871994, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Deleted', '2011-02-03 11:12:52', '2011-02-03 23:15:09'),
(29, 'OZE', '', NULL, NULL, NULL, NULL, NULL, 'Cha', -34.821484, 138.871994, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Deleted', '2011-02-03 11:16:12', '2011-02-03 23:16:52'),
(30, 'OZE', '', NULL, NULL, NULL, NULL, NULL, 'Cha', -34.821484, 138.871994, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Deleted', '2011-02-03 11:17:45', '2011-02-03 23:18:06'),
(31, 'OZE', '', NULL, NULL, NULL, NULL, NULL, 'Cha', -34.821484, 138.871994, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Deleted', '2011-02-03 11:19:09', '2011-02-03 23:19:22'),
(32, 'OZE', '', NULL, NULL, NULL, NULL, NULL, 'Cha', -34.821484, 138.871994, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Deleted', '2011-02-03 11:23:12', '2011-02-03 23:24:49'),
(33, 'OZE Pharmacy', 'Chain', '', '', '', '', 0, 'NSW', -31.253218, 146.921097, '', '', '', '', '', '', '', '', '', '', 'Active', '2011-02-03 11:24:38', '2011-02-03 23:24:38'),
(34, 'Pulse Pharmacy VIC', 'Chain', '', '', '', '', 0, 'VIC', -37.471310, 144.785156, '', '', '', '', '', '', '', '', '', '', 'Active', '2011-02-03 11:56:48', '2011-02-03 23:56:48'),
(35, 'Chemist Warehouse NSW', 'Chain', NULL, NULL, NULL, NULL, NULL, 'NS', -7.895396, -34.826790, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Deleted', '2011-06-22 09:15:27', '2011-06-22 09:40:35'),
(36, 'Chemist Warehouse NSW', 'Chain', NULL, NULL, NULL, NULL, NULL, 'NS', -7.895396, -34.826790, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Deleted', '2011-06-22 09:41:45', '2011-06-26 00:42:44'),
(37, 'Chemist Warehouse ACT', 'Chain', '', '', '', '', 0, 'ACT', -35.473469, 149.012375, '', '', '', '', '', '', '', '', '', '', 'Active', '2011-06-22 09:52:12', '2011-06-22 09:52:12'),
(38, 'Chemist Warehouse ACT', 'Chain', NULL, NULL, NULL, NULL, NULL, 'AC', -9.970383, -67.848717, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Deleted', '2011-06-22 09:54:00', '2011-06-26 00:42:39'),
(39, 'Chemist Warehouse NSW', 'Chain', NULL, NULL, NULL, NULL, NULL, 'NS', -7.895396, -34.826790, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', '2011-06-26 12:46:56', '2011-06-26 00:46:56');

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

DROP TABLE IF EXISTS `ci_sessions`;
CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) NOT NULL default '0',
  `ip_address` varchar(16) NOT NULL default '0',
  `user_agent` varchar(50) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL default '0',
  `user_data` text NOT NULL,
  PRIMARY KEY  (`session_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('aae71f7ecf5bb9278da4a9a082f69a6b', '58.7.184.35', 'Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_6_5; ', 1309265039, '');

-- --------------------------------------------------------

--
-- Table structure for table `medicines`
--

DROP TABLE IF EXISTS `medicines`;
CREATE TABLE IF NOT EXISTS `medicines` (
  `id` int(10) NOT NULL auto_increment COMMENT 'Primary Key',
  `name` varchar(256) NOT NULL COMMENT 'The product name medicine',
  `quantity` varchar(128) default NULL COMMENT 'The number of tablets etc',
  `dosage` varchar(10) default NULL COMMENT 'How many grams.ml at medicine level',
  `medicine_type_id` int(10) NOT NULL COMMENT 'The medicine type (Foriegn Key)',
  `company_name` varchar(256) default NULL COMMENT 'The company name medicine',
  `notes` varchar(1024) default NULL,
  `status` enum('Active','Inactive','Deleted') NOT NULL default 'Active',
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`),
  KEY `medicine_type_id` (`medicine_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Stores the medicines' AUTO_INCREMENT=42 ;

--
-- Dumping data for table `medicines`
--

INSERT INTO `medicines` (`id`, `name`, `quantity`, `dosage`, `medicine_type_id`, `company_name`, `notes`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Paracetamol', '50', '0', 1, 'Sandoz', NULL, 'Deleted', '2010-12-29 03:08:56', '2010-12-29 03:09:11'),
(2, 'paracetamol', '0', '0', 1, '', NULL, 'Deleted', '2011-02-07 04:04:44', '2011-02-07 04:11:25'),
(3, 'Lipitor', '40', '100mg/10mg', 1, '', NULL, 'Deleted', '2011-02-07 04:13:14', '2011-04-19 08:38:02'),
(4, 'Abbocillin O/S', '0', '150mg/5ml', 4, '', NULL, 'Active', '2011-03-23 09:21:48', '2011-03-23 09:21:48'),
(5, 'Abbocillin VK', '50', '250mg', 1, '', NULL, 'Active', '2011-03-23 09:23:09', '2011-03-23 09:23:09'),
(6, 'Abbocillin VK', '50', '500mg', 1, '', '', 'Active', '2011-03-31 07:19:49', '2011-03-31 07:19:49'),
(7, 'Filpril', '30', '10mg', 1, '', 'Generic form of Accupril', 'Active', '2011-03-31 07:26:07', '2011-03-31 07:26:07'),
(8, 'Filpril', '30', '20mg', 1, '', 'Generic form of Accupril', 'Active', '2011-03-31 07:27:52', '2011-03-31 07:27:52'),
(9, 'Accupril', '30', '10mg', 1, '', '', 'Active', '2011-03-31 07:31:37', '2011-03-31 07:31:37'),
(10, 'Accupril', '30', '20mg', 1, '', '', 'Active', '2011-04-19 08:38:51', '2011-04-19 08:38:51'),
(11, 'Accupril', '30', '5mg', 1, '', '', 'Active', '2011-04-19 08:43:43', '2011-04-19 08:43:43'),
(12, 'Accuretic', '30', '10mg/12.5m', 1, 'Sigma', '', 'Active', '2011-04-19 08:48:17', '2011-04-19 08:48:17'),
(13, 'Accuretic', '30', '20mg/12.5m', 1, 'Sigma', '', 'Active', '2011-04-19 08:49:34', '2011-04-19 08:49:34'),
(14, 'Actonel Combi D', '4', '35mg', 1, 'Aventis Pharma', '', 'Deleted', '2011-04-19 09:03:43', '2011-04-19 09:07:49'),
(15, 'Actonel Once a Month', '1', '150mg', 1, 'Procter & Gamble', 'PBS Medicine', 'Active', '2011-04-19 09:11:02', '2011-04-19 09:11:59'),
(16, 'Actonel Once a Week', '12', '35mg', 1, 'Aventis Pharma', '', 'Active', '2011-04-19 09:13:36', '2011-04-19 09:13:36'),
(17, 'Actonel Once a Week', '16', '35mg', 1, 'Aventis Pharma', '', 'Active', '2011-04-19 09:14:56', '2011-04-19 09:14:56'),
(18, 'Actonel Once a Week', '24', '35mg', 1, 'Aventis Pharma', '', 'Active', '2011-04-19 09:15:59', '2011-04-19 09:15:59'),
(19, 'Actonel Once a Week', '4', '35mg', 1, 'Aventis Pharma', 'PBS Medicine', 'Active', '2011-04-19 09:17:01', '2011-04-19 09:17:01'),
(20, 'Actos', '28', '15mg', 1, 'Eli Lilly', 'PBS Medicine', 'Active', '2011-04-19 09:23:16', '2011-04-19 09:23:16'),
(21, 'Actos', '28', '30mg', 1, 'Eli Lilly', 'PBS Medicine', 'Active', '2011-04-19 09:24:39', '2011-04-19 09:24:39'),
(22, 'Actos', '28', '45mg', 1, 'Eli Lilly', 'PBS Medicine', 'Active', '2011-04-19 09:26:20', '2011-04-19 09:26:20'),
(23, 'Adalat OROS', '30', '20mg', 1, 'Bayer', '', 'Active', '2011-04-19 09:30:00', '2011-04-19 09:30:00'),
(24, 'Adalat OROS', '90', '20mg', 1, 'Bayer', '', 'Active', '2011-04-19 09:30:49', '2011-04-19 09:30:49'),
(25, 'Adalat OROS', '30', '30mg', 1, 'Bayer', '', 'Active', '2011-04-19 09:31:45', '2011-04-19 09:31:45'),
(26, 'Adalat OROS', '30', '60mg', 1, 'Bayer', '', 'Active', '2011-04-19 09:32:20', '2011-04-19 09:32:20'),
(27, 'Adefin', '60', '10mg', 1, 'Alphapharm', '', 'Active', '2011-04-19 09:34:21', '2011-04-19 09:34:21'),
(28, 'Adefin', '60', '20mg', 1, 'Alphapharm', '', 'Active', '2011-04-19 09:35:13', '2011-04-19 09:35:13'),
(29, 'Advantan', '15g', '0.1%', 5, 'CSL', '', 'Active', '2011-04-19 09:42:42', '2011-04-19 09:43:40'),
(30, 'Advantan', '15g', '0.1%', 6, 'CSL', '', 'Active', '2011-04-19 09:46:21', '2011-04-19 09:46:21'),
(31, 'Advantan', '15g', '0.1%', 7, 'CSL', '', 'Active', '2011-04-19 09:49:56', '2011-04-19 09:49:56'),
(32, 'Advantan', '15g x 2', '0.1%', 6, 'CSL', 'PBS Medicine', 'Active', '2011-04-19 09:51:20', '2011-04-19 09:52:51'),
(33, 'Advantan', '15g x 4', '0.1%', 6, 'CSL', 'PBS Medicine', 'Active', '2011-04-19 09:52:28', '2011-04-19 09:52:28'),
(34, 'Advantan', '15g x 4', '0.1%', 7, 'CSL', 'PBS Medicine', 'Active', '2011-04-19 09:54:24', '2011-04-19 09:54:24'),
(35, 'Airomir Autohaler', '200 doses x 2', '100mcg', 8, 'Aventis Pharma', '', 'Active', '2011-04-19 09:58:11', '2011-04-19 09:58:11'),
(36, 'Akamin', '11', '100mg', 9, 'Alphapharm', '', 'Active', '2011-04-19 10:00:06', '2011-04-19 10:00:06'),
(37, 'Akamin', '180', '50mg', 1, 'Alphapharm', '', 'Active', '2011-04-19 10:06:18', '2011-04-19 10:06:18'),
(38, 'Akamin', '360', '50mg', 1, 'Alphapharm', '', 'Active', '2011-04-19 10:07:05', '2011-04-19 10:07:05'),
(39, 'Akamin', '60', '50mg', 1, 'Alphapharm', '', 'Active', '2011-04-19 10:08:24', '2011-04-19 10:08:24'),
(40, 'Aldactone', '100', '100mg', 1, 'Searle Laboratories', '', 'Active', '2011-04-19 10:12:25', '2011-04-19 10:12:25'),
(41, 'Aldactone', '100', '25mg', 1, 'Searle Laboratories', '', 'Active', '2011-04-19 10:13:33', '2011-04-19 10:13:33');

-- --------------------------------------------------------

--
-- Table structure for table `medicine_prices`
--

DROP TABLE IF EXISTS `medicine_prices`;
CREATE TABLE IF NOT EXISTS `medicine_prices` (
  `id` int(10) NOT NULL auto_increment COMMENT 'The primary key',
  `medicine_id` int(10) NOT NULL COMMENT 'The FK to medicines.id',
  `store_id` int(10) default NULL COMMENT 'The FK to stores.id Exactly one of store_id and chainbg_id will be filled',
  `chainbg_id` int(10) default NULL COMMENT 'The FK to chainbg.id Exactly one of store_id and chainbg_id will be filled',
  `price` decimal(12,2) NOT NULL default '0.00' COMMENT 'The Price',
  `is_store_price` enum('Y','N') NOT NULL default 'N' COMMENT 'If the store level price is to be considered on top of Chain. Ideally Y for store entries',
  `status` enum('Active','Inactive','Deleted') NOT NULL default 'Active',
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `medicine_id` (`medicine_id`,`store_id`),
  UNIQUE KEY `medicine_id_2` (`medicine_id`,`chainbg_id`),
  KEY `medicine_id_3` (`medicine_id`),
  KEY `store_id` (`store_id`),
  KEY `chainbg_id` (`chainbg_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='This table links the medicines with the stores via the price' AUTO_INCREMENT=3 ;

--
-- Dumping data for table `medicine_prices`
--

INSERT INTO `medicine_prices` (`id`, `medicine_id`, `store_id`, `chainbg_id`, `price`, `is_store_price`, `status`, `created_at`, `updated_at`) VALUES
(1, 4, NULL, 1, '10.00', 'N', 'Active', '2011-03-31 06:11:00', '2011-03-31 06:11:00'),
(2, 4, 43, NULL, '8.20', 'Y', 'Active', '2011-03-31 06:14:24', '2011-03-31 06:14:24');

-- --------------------------------------------------------

--
-- Table structure for table `medicine_salt`
--

DROP TABLE IF EXISTS `medicine_salt`;
CREATE TABLE IF NOT EXISTS `medicine_salt` (
  `id` int(10) NOT NULL auto_increment COMMENT 'Primary Key',
  `medicine_id` int(10) NOT NULL COMMENT 'The medicine (Foriegn Key)',
  `salt_id` int(10) NOT NULL COMMENT 'The salt (Foriegn Key)',
  `dosage` varchar(10) NOT NULL COMMENT 'The dosage of this salt(eg 500mg)',
  `status` enum('Active','Inactive','Deleted') NOT NULL default 'Active',
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`),
  KEY `medicine_id` (`medicine_id`),
  KEY `salt_id` (`salt_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Links the medicines with their salts FK-FK table' AUTO_INCREMENT=46 ;

--
-- Dumping data for table `medicine_salt`
--

INSERT INTO `medicine_salt` (`id`, `medicine_id`, `salt_id`, `dosage`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 16, '100', 'Active', '2011-02-07 04:04:44', '2011-02-07 04:04:44'),
(2, 2, 17, '0', 'Deleted', '2011-02-07 04:04:44', '2011-02-07 04:05:12'),
(3, 2, 17, '10', 'Active', '2011-02-07 04:05:35', '2011-02-07 04:05:35'),
(4, 3, 2, '100', 'Active', '2011-02-07 04:13:14', '2011-02-07 04:13:14'),
(5, 3, 13, '10', 'Active', '2011-02-07 04:13:14', '2011-02-07 04:13:14'),
(6, 4, 18, '150mg', 'Active', '2011-03-23 09:21:48', '2011-03-23 09:21:48'),
(7, 4, 19, '5ml', 'Active', '2011-03-23 09:21:48', '2011-03-23 09:21:48'),
(8, 5, 20, '250mg', 'Active', '2011-03-23 09:23:09', '2011-03-23 09:23:09'),
(9, 6, 20, '500mg', 'Active', '2011-03-31 07:19:49', '2011-03-31 07:19:49'),
(10, 7, 21, '10mg', 'Active', '2011-03-31 07:26:07', '2011-03-31 07:26:07'),
(11, 8, 21, '20mg', 'Active', '2011-03-31 07:27:52', '2011-03-31 07:27:52'),
(12, 9, 21, '10mg', 'Active', '2011-03-31 07:31:37', '2011-03-31 07:31:37'),
(13, 10, 21, '20mg', 'Active', '2011-04-19 08:40:18', '2011-04-19 08:40:18'),
(14, 11, 21, '5mg', 'Active', '2011-04-19 08:43:43', '2011-04-19 08:43:43'),
(15, 12, 22, '10mg', 'Active', '2011-04-19 08:48:17', '2011-04-19 08:48:17'),
(16, 12, 23, '12.5mg', 'Active', '2011-04-19 08:48:17', '2011-04-19 08:48:17'),
(17, 13, 22, '20mg', 'Active', '2011-04-19 08:49:34', '2011-04-19 08:49:34'),
(18, 13, 23, '12.5mg', 'Active', '2011-04-19 08:49:34', '2011-04-19 08:49:34'),
(19, 15, 24, '150mg', 'Active', '2011-04-19 09:11:02', '2011-04-19 09:11:02'),
(20, 16, 24, '35mg', 'Active', '2011-04-19 09:13:36', '2011-04-19 09:13:36'),
(21, 17, 24, '35mg', 'Active', '2011-04-19 09:14:56', '2011-04-19 09:14:56'),
(22, 18, 24, '35mg', 'Active', '2011-04-19 09:15:59', '2011-04-19 09:15:59'),
(23, 19, 24, '35mg', 'Active', '2011-04-19 09:17:01', '2011-04-19 09:17:01'),
(24, 20, 28, '15mg', 'Active', '2011-04-19 09:23:16', '2011-04-19 09:23:16'),
(25, 21, 28, '30mg', 'Active', '2011-04-19 09:24:39', '2011-04-19 09:24:39'),
(26, 22, 28, '45mg', 'Active', '2011-04-19 09:26:20', '2011-04-19 09:26:20'),
(27, 23, 30, '20mg', 'Active', '2011-04-19 09:30:00', '2011-04-19 09:30:00'),
(28, 24, 30, '20mg', 'Active', '2011-04-19 09:30:49', '2011-04-19 09:30:49'),
(29, 25, 30, '30mg', 'Active', '2011-04-19 09:31:45', '2011-04-19 09:31:45'),
(30, 26, 30, '60mg', 'Active', '2011-04-19 09:32:20', '2011-04-19 09:32:20'),
(31, 27, 30, '10mg', 'Active', '2011-04-19 09:34:21', '2011-04-19 09:34:21'),
(32, 28, 30, '20mg', 'Active', '2011-04-19 09:35:13', '2011-04-19 09:35:13'),
(33, 29, 33, '0.1%', 'Active', '2011-04-19 09:43:40', '2011-04-19 09:43:40'),
(34, 30, 33, '15g', 'Active', '2011-04-19 09:46:21', '2011-04-19 09:46:21'),
(35, 31, 33, '0.1%', 'Active', '2011-04-19 09:49:56', '2011-04-19 09:49:56'),
(36, 32, 33, '0.1%', 'Active', '2011-04-19 09:51:20', '2011-04-19 09:51:20'),
(37, 33, 33, '0.1%', 'Active', '2011-04-19 09:52:28', '2011-04-19 09:52:28'),
(38, 34, 33, '0.1%', 'Active', '2011-04-19 09:54:24', '2011-04-19 09:54:24'),
(39, 35, 34, '100mcg', 'Active', '2011-04-19 09:58:11', '2011-04-19 09:58:11'),
(40, 36, 35, '100mg', 'Active', '2011-04-19 10:00:33', '2011-04-19 10:00:33'),
(41, 37, 35, '50mg', 'Active', '2011-04-19 10:06:18', '2011-04-19 10:06:18'),
(42, 38, 35, '50mg', 'Active', '2011-04-19 10:07:05', '2011-04-19 10:07:05'),
(43, 39, 35, '50mg', 'Active', '2011-04-19 10:08:24', '2011-04-19 10:08:24'),
(44, 40, 36, '100mg', 'Active', '2011-04-19 10:12:25', '2011-04-19 10:12:25'),
(45, 41, 36, '25mg', 'Active', '2011-04-19 10:13:33', '2011-04-19 10:13:33');

-- --------------------------------------------------------

--
-- Table structure for table `medicine_types`
--

DROP TABLE IF EXISTS `medicine_types`;
CREATE TABLE IF NOT EXISTS `medicine_types` (
  `id` int(10) NOT NULL auto_increment COMMENT 'Primary Key',
  `name` varchar(256) NOT NULL COMMENT 'The Display Value of medicine_type',
  `value` varchar(128) NOT NULL COMMENT 'The value of medicine_type (will mostly be same as name)',
  `status` enum('Active','Inactive','Deleted') NOT NULL default 'Active',
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Stores the medicine types, like pills,syrup etc' AUTO_INCREMENT=10 ;

--
-- Dumping data for table `medicine_types`
--

INSERT INTO `medicine_types` (`id`, `name`, `value`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Tablet', 'Tablet', 'Active', '2010-12-10 10:32:09', '2010-12-10 23:07:41'),
(2, 'Capsule', 'Capsule', 'Active', '2010-12-10 10:32:16', '2010-12-10 10:32:16'),
(3, 'Syrup', 'Syrup', 'Active', '2010-12-10 10:32:22', '2010-12-10 10:32:22'),
(4, 'Suspension', 'Suspension', 'Active', '2010-12-10 11:07:52', '2010-12-10 23:07:52'),
(5, 'Cream', 'Cream', 'Active', '2011-04-19 09:38:50', '2011-04-19 09:38:50'),
(6, 'Fatty Ointment', 'Fatty Ointment', 'Active', '2011-04-19 09:46:21', '2011-04-19 09:46:21'),
(7, 'Ointment', 'Ointment', 'Active', '2011-04-19 09:49:56', '2011-04-19 09:49:56'),
(8, 'Inhaler', 'Inhaler', 'Active', '2011-04-19 09:58:11', '2011-04-19 09:58:11'),
(9, 'Capsules', 'Capsules', 'Active', '2011-04-19 10:00:06', '2011-04-19 10:00:06');

-- --------------------------------------------------------

--
-- Table structure for table `salts`
--

DROP TABLE IF EXISTS `salts`;
CREATE TABLE IF NOT EXISTS `salts` (
  `id` int(10) NOT NULL auto_increment COMMENT 'Primary Key',
  `name` varchar(256) NOT NULL COMMENT 'The name of the salt',
  `status` enum('Active','Inactive','Deleted') NOT NULL default 'Active',
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Stores the medicine salts, like PARACETAMOL' AUTO_INCREMENT=37 ;

--
-- Dumping data for table `salts`
--

INSERT INTO `salts` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Paracetamol', 'Deleted', '2010-12-10 10:32:00', '2010-12-10 23:08:21'),
(2, 'Atorvastatin', 'Active', '2010-12-14 04:48:24', '2010-12-14 04:48:24'),
(3, 'Calcium', 'Active', '2010-12-14 04:48:41', '2010-12-14 04:48:41'),
(4, 'Simvastatin', 'Active', '2010-12-14 04:50:03', '2010-12-14 04:50:03'),
(5, 'Esomeprazole', 'Active', '2010-12-14 04:51:12', '2010-12-14 04:51:12'),
(6, 'Magnesium', 'Active', '2010-12-14 04:51:42', '2010-12-14 04:51:42'),
(7, 'Trihydrate', 'Active', '2010-12-14 04:52:02', '2010-12-14 04:52:02'),
(8, 'Perindopril', 'Active', '2010-12-14 04:52:24', '2010-12-14 04:52:24'),
(9, 'Omeprazole', 'Active', '2010-12-14 04:52:41', '2010-12-14 04:52:41'),
(10, 'Paracetamol', 'Active', '2010-12-14 04:52:49', '2010-12-14 04:52:49'),
(11, 'Atenolol', 'Active', '2010-12-14 04:53:52', '2010-12-14 04:53:52'),
(12, 'Pantoprazole', 'Active', '2010-12-14 04:54:15', '2010-12-14 04:54:15'),
(13, 'Sodium', 'Active', '2010-12-14 04:54:34', '2010-12-14 04:54:34'),
(14, 'Sesquihydrate', 'Active', '2010-12-14 04:54:57', '2010-12-14 04:54:57'),
(15, 'Irbesartan', 'Active', '2010-12-14 04:55:22', '2010-12-14 04:55:22'),
(16, 'sudafed', 'Deleted', '2011-02-07 04:04:44', '2011-03-23 09:12:34'),
(17, 'Test', 'Deleted', '2011-02-07 04:04:44', '2011-03-23 09:12:43'),
(18, 'Phenoxymethyl', 'Active', '2011-03-23 09:11:49', '2011-03-23 09:11:49'),
(19, 'Penicillin', 'Active', '2011-03-23 09:12:13', '2011-03-23 09:12:13'),
(20, 'Phenoxymethylpenicillin', 'Active', '2011-03-23 09:14:34', '2011-03-23 09:14:34'),
(21, 'Quinapril', 'Active', '2011-03-31 07:26:07', '2011-03-31 07:26:07'),
(22, 'Quinapril Hydrochloride', 'Active', '2011-04-19 08:46:15', '2011-04-19 08:46:15'),
(23, 'Hydrochlorothiazide', 'Active', '2011-04-19 08:46:35', '2011-04-19 08:46:35'),
(24, 'Risedronate Sodium', 'Active', '2011-04-19 08:59:31', '2011-04-19 08:59:31'),
(25, 'Calcium Carbonate', 'Active', '2011-04-19 08:59:43', '2011-04-19 08:59:43'),
(26, 'Colecal Ciferol', 'Deleted', '2011-04-19 08:59:56', '2011-04-19 09:01:30'),
(27, 'Colecalciferol', 'Active', '2011-04-19 09:01:41', '2011-04-19 09:01:41'),
(28, 'Pioglitazone', 'Active', '2011-04-19 09:22:17', '2011-04-19 09:22:17'),
(29, 'Nifedine', 'Deleted', '2011-04-19 09:27:35', '2011-04-19 09:27:42'),
(30, 'Nifedipine', 'Active', '2011-04-19 09:27:54', '2011-04-19 09:27:54'),
(31, 'Methylprednisolone', 'Active', '2011-04-19 09:39:27', '2011-04-19 09:39:27'),
(32, 'Aceponate', 'Active', '2011-04-19 09:39:39', '2011-04-19 09:39:39'),
(33, 'Methylprednisolone Aceponate', 'Active', '2011-04-19 09:40:22', '2011-04-19 09:40:22'),
(34, 'Salbutamol Sulfate', 'Active', '2011-04-19 09:55:39', '2011-04-19 09:55:39'),
(35, 'Minocycline', 'Active', '2011-04-19 09:59:21', '2011-04-19 09:59:21'),
(36, 'Spironolactone', 'Active', '2011-04-19 10:11:10', '2011-04-19 10:11:10');

-- --------------------------------------------------------

--
-- Table structure for table `stores`
--

DROP TABLE IF EXISTS `stores`;
CREATE TABLE IF NOT EXISTS `stores` (
  `id` int(10) NOT NULL auto_increment COMMENT 'Primary Key',
  `name` varchar(256) default NULL COMMENT 'Name of store',
  `type` enum('Chain','BG','Ind') NOT NULL default 'Chain' COMMENT 'If store belings to a Chain, Banner Group or is Independent',
  `chainbg_id` int(10) default NULL COMMENT 'Foreign Key to chainbr table to indicate which chain/bg it belongs to.',
  `street` varchar(512) default NULL COMMENT 'First line of address',
  `street2` varchar(512) default NULL COMMENT 'Optional second line of address',
  `suburb` varchar(100) default NULL COMMENT 'Suburb name',
  `city` varchar(100) default NULL COMMENT 'City',
  `postcode` int(4) default NULL COMMENT 'Postcode',
  `state` varchar(3) default NULL COMMENT 'Iso for state like WA, QLD, NSW etc',
  `lat` float(10,6) default '0.000000' COMMENT 'The latitude derived from google maps API',
  `lng` float(10,6) default '0.000000' COMMENT 'The longitude derived from google maps API',
  `website` varchar(512) default NULL COMMENT 'Website for the store',
  `email1` varchar(100) default NULL COMMENT 'email1 for the store',
  `email2` varchar(100) default NULL COMMENT 'email2 for the store',
  `email3` varchar(100) default NULL COMMENT 'email3 for the store',
  `tel1` varchar(100) default NULL COMMENT 'tel1 for the store',
  `tel2` varchar(100) default NULL COMMENT 'tel2 for the store',
  `tel3` varchar(100) default NULL COMMENT 'tel3 for the store',
  `fax1` varchar(100) default NULL COMMENT 'fax1 for the store',
  `fax2` varchar(100) default NULL COMMENT 'fax2 for the store',
  `fax3` varchar(100) default NULL COMMENT 'fax3 for the store',
  `status` enum('Active','Inactive','Deleted') NOT NULL default 'Active',
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`),
  KEY `chainbg_id` (`chainbg_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Stores information about medical stores' AUTO_INCREMENT=137 ;

--
-- Dumping data for table `stores`
--

INSERT INTO `stores` (`id`, `name`, `type`, `chainbg_id`, `street`, `street2`, `suburb`, `city`, `postcode`, `state`, `lat`, `lng`, `website`, `email1`, `email2`, `email3`, `tel1`, `tel2`, `tel3`, `fax1`, `fax2`, `fax3`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Broadway Chemist', 'BG', 3, '', '', '', '', 0, 'WA', -27.672817, 121.628311, '', '', '', '', '', '', '', '', '', '', 'Deleted', '2010-12-16 04:52:22', '2010-12-28 23:28:19'),
(2, 'Broadway Chemist 2', 'BG', 3, '', '', '', '', 0, 'WA', -27.672817, 121.628311, '', '', '', '', '', '', '', '', '', '', 'Deleted', '2010-12-16 04:52:48', '2010-12-28 23:28:21'),
(3, 'Pulse Pharmacy Collaroy Beach', 'Chain', 4, '1117 Pittwater Road', '', 'Collaroy Beach', '', 2097, 'NSW', -33.732323, 151.301102, '', '', '', '', '', '', '', '', '', '', 'Active', '2010-12-28 11:28:03', '2010-12-28 23:30:29'),
(4, 'Pulse Pharmacy Double Bay', 'Chain', 4, '459-463 New South Head Road', '', 'Double Bay', '', 2028, 'NSW', -33.877567, 151.244354, '', '', '', '', '', '', '', '', '', '', 'Active', '2010-12-28 11:31:56', '2010-12-28 23:31:56'),
(5, 'Pulse Pharmacy Bondi Junction', 'Chain', 4, 'Shop 1037-1038 Westfield Bondi Junction', '', 'Bondi Junction', '', 2022, 'NSW', -33.892178, 151.250793, '', '', '', '', '', '', '', '', '', '', 'Active', '2010-12-29 02:52:25', '2010-12-29 02:52:49'),
(6, 'Pulse Pharmacy Pagewood', 'Chain', 4, 'Shop 157-159 Westfield Shoppingtown Eastgardens, Bunnerong Road', '', 'Pagewood', '', 2035, 'NSW', -33.936474, 151.229904, '', '', '', '', '', '', '', '', '', '', 'Active', '2010-12-29 02:54:11', '2010-12-29 02:54:11'),
(7, 'Pulse Pharmacy Brookvale', 'Chain', 4, 'Shop 240, Warringah Mall, Cnr Old Pittwater Rd & Condamine St', '', 'Brookvale', '', 2100, 'NSW', -33.769169, 151.266830, '', '', '', '', '', '', '', '', '', '', 'Active', '2010-12-29 02:55:12', '2010-12-29 02:55:12'),
(8, 'Pulse Pharmacy Chatswood', 'Chain', 4, 'Shop 243 Westfield Shoppingtown Chatswood, Anderson Street', '', 'Chatswood', '', 2067, 'NSW', -33.797367, 151.183975, '', '', '', '', '', '', '', '', '', '', 'Active', '2010-12-29 02:58:51', '2010-12-29 02:58:52'),
(9, 'Pulse Pharmacy Rockdale', 'Chain', 4, 'Shop 34 Rockdale Plaza Shopping Centre Plaza Drive', '', 'Rockdale', '', 2216, 'NSW', -33.950821, 151.138794, '', '', '', '', '', '', '', '', '', '', 'Active', '2010-12-29 03:04:07', '2010-12-29 03:04:08'),
(10, 'Pulse Pharmacy Potts Point', 'Chain', 4, 'Shop 4, 81 Macleay Street', '', 'Potts Point', '', 2011, 'NSW', -33.870609, 151.224808, '', '', '', '', '', '', '', '', '', '', 'Active', '2010-12-29 03:05:15', '2010-12-29 03:05:16'),
(11, 'Pulse Pharmacy Parramatta', 'Chain', 4, 'Shop 5020-5021 Westfield Parramatta, 159-175 Church Street', '', 'Parramatta', '', 2150, 'NSW', -33.817780, 151.001877, '', '', '', '', '', '', '', '', '', '', 'Active', '2010-12-29 03:06:30', '2010-12-29 03:06:30'),
(12, 'Pulse Pharmacy Campbelltown', 'Chain', 4, 'Shop L47 Campbelltown Mall, 271 Queen Street', '', 'Campbelltown', '', 2560, 'NSW', -34.068905, 150.810410, '', '', '', '', '', '', '', '', '', '', 'Active', '2010-12-29 03:07:29', '2010-12-29 03:07:29'),
(13, 'Chemist Warehouse Albury', 'Chain', 1, '483 Olive Street', '', 'Albury', '', 2640, 'NSW', -36.081818, 146.917725, '', '', '', '', '', '', '', '', '', '', 'Active', '2011-01-02 12:59:37', '2011-01-02 01:02:58'),
(14, 'Chemist Warehouse Ashfield', 'Chain', 1, '251 Liverpool Road', '', 'Ashfield', '', 2131, 'NSW', -33.889244, 151.125656, '', '', '', '', '', '', '', '', '', '', 'Active', '2011-01-02 01:01:31', '2011-01-02 01:01:32'),
(15, 'Chemist Warehouse Bondi Junction', 'Chain', 1, '149 Oxford Street', '', 'Bondi Junction', '', 2022, 'NSW', -33.892162, 151.247971, '', '', '', '', '', '', '', '', '', '', 'Active', '2011-01-02 01:02:21', '2011-01-02 01:02:21'),
(16, 'Chemist Warehouse Botany', 'Chain', 1, '1124 Botany Road', '', 'Botany', '', 2019, 'NSW', -33.944729, 151.196411, '', '', '', '', '', '', '', '', '', '', 'Active', '2011-01-02 01:05:45', '2011-01-02 01:05:45'),
(17, 'Chemist Warehouse Burwood', 'Chain', 1, '35 Burwood Road', '', 'Burwood', '', 2134, 'NSW', -33.871548, 151.104538, '', '', '', '', '', '', '', '', '', '', 'Active', '2011-01-02 01:06:44', '2011-01-02 01:06:44'),
(18, 'Chemist Warehouse Burwood Central', 'Chain', 1, '69 Burwood Road', '', 'Burwood', '', 2134, 'NSW', -33.875401, 151.104019, '', '', '', '', '', '', '', '', '', '', 'Active', '2011-01-02 01:08:26', '2011-06-22 09:22:49'),
(19, 'Chemist Warehouse Cambelltown', 'Chain', 1, 'Shop 12 Marketfair Shopping centre Cnr Kellicar and Narellan Roads', '', 'Campbelltown', '', 2560, 'NSW', -34.067776, 150.813187, '', '', '', '', '', '', '', '', '', '', 'Active', '2011-01-02 01:12:16', '2011-01-02 01:12:16'),
(20, 'Chemist Warehouse Campsie - Beamish St', 'Chain', 1, '265 Beamish Street', '', 'Campsie', '', 2194, 'NSW', -33.912216, 151.104034, '', '', '', '', '', '', '', '', '', '', 'Active', '2011-01-02 01:13:10', '2011-06-22 09:23:58'),
(21, 'Chemist Warehouse Campsie', 'Chain', 1, 'Shop 21 Campsie Centre 14-28 Amy Street', '', 'Campsie', '', 2194, 'NSW', -33.912556, 151.102615, '', '', '', '', '', '', '', '', '', '', 'Active', '2011-01-02 01:14:50', '2011-01-02 01:15:12'),
(22, 'Chemist Warehouse Caringbah', 'Chain', 1, 'Shop 4, 29 to 35 President Ave', '', 'Caringbah', '', 2229, 'NSW', -34.042522, 151.120895, '', '', '', '', '', '', '', '', '', '', 'Active', '2011-01-02 01:18:57', '2011-01-02 01:18:57'),
(23, 'Chemist Warehouse Castle Hill', 'Chain', 1, '336 to 338 Old Northern Road', '', 'Castle Hill', '', 2154, 'NSW', -33.730209, 151.016632, '', '', '', '', '', '', '', '', '', '', 'Active', '2011-01-02 01:19:49', '2011-01-02 01:19:49'),
(24, 'Chemist Warehouse Chatswood', 'Chain', 1, 'Shop 1 387 Victoria Avenue', '', 'Chatswood', '', 2067, 'NSW', -33.795444, 151.184860, '', '', '', '', '', '', '', '', '', '', 'Active', '2011-01-02 01:20:46', '2011-01-02 01:20:46'),
(25, 'Chemist Warehouse Dee Why', 'Chain', 1, 'Shop 20 - 22 Dee Why Plaza Shopping Centre', '', 'Dee Why', '', 2099, 'NSW', -33.753563, 151.286133, '', '', '', '', '', '', '', '', '', '', 'Active', '2011-01-02 01:21:46', '2011-01-02 01:21:47'),
(26, 'Chemist Warehouse Eastwood', 'Chain', 1, '157 Rowe Street', '', 'Eastwood', '', 2122, 'NSW', -33.791389, 151.080673, '', '', '', '', '', '', '', '', '', '', 'Active', '2011-01-02 01:24:14', '2011-01-02 01:24:14'),
(27, 'Chemist Warehouse Epping', 'Chain', 1, '58 - 60 Rawson Street', '', 'Epping', '', 2121, 'NSW', -33.772411, 151.080872, '', '', '', '', '', '', '', '', '', '', 'Active', '2011-01-02 01:25:35', '2011-01-02 01:25:36'),
(28, 'Chemist Warehouse Fairfield', 'Chain', 1, '8 Kenyon Street', '', 'Fairfield', '', 2165, 'NSW', -33.870804, 150.953720, '', '', '', '', '', '', '', '', '', '', 'Active', '2011-01-02 01:26:47', '2011-01-02 01:26:47'),
(29, 'Chemist Warehouse Gosford', 'Chain', 1, '125 Mann Street', '', 'Gosford', '', 2250, 'NSW', -33.426449, 151.342316, '', '', '', '', '', '', '', '', '', '', 'Active', '2011-01-02 01:27:30', '2011-01-02 01:27:30'),
(30, 'Chemist Warehouse Griffith', 'Chain', 1, 'Griffith Central Shopping Centre 10 - 12 Yambil Street', '', 'Griffith', '', 2680, 'NSW', -34.290672, 146.051254, '', '', '', '', '', '', '', '', '', '', 'Active', '2011-01-02 01:28:30', '2011-01-02 01:28:30'),
(31, 'Chemist Warehouse Hurstville', 'Chain', 1, 'Shop 216B/218A Westfield Shopping Town', '', 'Hurstville', '', 2220, 'NSW', -33.967110, 151.102859, '', '', '', '', '', '', '', '', '', '', 'Active', '2011-01-02 01:29:32', '2011-01-02 01:29:33'),
(32, 'Chemist Warehouse Hurstville Forest Rd', 'Chain', 1, '272 Forest Road', '', 'Hurstville', '', 2220, 'NSW', -33.967037, 151.103363, '', '', '', '', '', '', '', '', '', '', 'Active', '2011-01-02 01:31:21', '2011-06-22 09:30:29'),
(33, 'Chemist Warehouse Leichhardt', 'Chain', 1, '111 Norton Street', '', 'Leichhardt', '', 2040, 'NSW', -33.882633, 151.156921, '', '', '', '', '', '', '', '', '', '', 'Active', '2011-01-02 01:32:23', '2011-01-02 01:32:23'),
(34, 'Chemist Warehouse Goonellabah', 'Chain', 1, 'Shop 3 - 6, 799 Ballina Road', '', 'Goonellabah', '', 2480, 'NSW', -28.812479, 153.347641, '', '', '', '', '', '', '', '', '', '', 'Active', '2011-01-02 01:33:45', '2011-01-02 01:33:45'),
(35, 'Chemist Warehouse Liverpool', 'Chain', 1, '235 - 243 Macquarie Street', '', 'Liverpool', '', 2170, 'NSW', -33.923473, 150.923508, '', '', '', '', '', '', '', '', '', '', 'Active', '2011-01-02 01:35:02', '2011-01-02 01:35:02'),
(36, 'Chemist Warehouse Maroubra', 'Chain', 1, '229 - 231 Maroubra Road', '', 'Maroubra', '', 2035, 'NSW', -33.942200, 151.240875, '', '', '', '', '', '', '', '', '', '', 'Active', '2011-01-02 01:36:26', '2011-01-02 01:36:27'),
(37, 'Chemist Warehouse Marrickville', 'Chain', 1, 'Shop 3, 258 Illawara Road', '', 'Marrickville', '', 2204, 'NSW', -33.911488, 151.155365, '', '', '', '', '', '', '', '', '', '', 'Active', '2011-01-02 01:37:04', '2011-01-02 01:37:04'),
(38, 'Chemist Warehouse Oxford St', 'Chain', 1, '211 Oxford Street', '', 'Bondi Junction', '', 2022, 'NSW', -33.892262, 151.250153, '', '', '', '', '', '', '', '', '', '', 'Active', '2011-01-02 01:38:54', '2011-06-22 09:21:11'),
(39, 'Chemist Warehouse Parramatta', 'Chain', 1, '202 - 208 Church Street', '', 'Parramatta', '', 2150, 'NSW', -33.814899, 151.003265, '', '', '', '', '', '', '', '', '', '', 'Active', '2011-01-02 01:41:30', '2011-01-02 01:41:31'),
(40, 'Chemist Warehouse Jamisontown', 'Chain', 1, 'Shop 230 SupaCenta Centre 13 to 23 Pattys Place', '', 'Jamisontown', '', 2750, 'NSW', -33.768383, 150.669891, '', '', '', '', '', '', '', '', '', '', 'Active', '2011-01-02 01:42:52', '2011-01-02 01:42:52'),
(41, 'Chemist Warehouse Randwick', 'Chain', 1, '166 - 168 Belmore Road', '', 'Randwick', '', 2031, 'NSW', -33.916946, 151.240799, '', '', '', '', '', '', '', '', '', '', 'Active', '2011-01-02 01:44:07', '2011-01-02 01:44:08'),
(42, 'Chemist Warehouse Shell Harbour', 'Chain', 1, 'Shop 16 Shell Harbour Supa Centre Lake Entrance Road', '', 'Shell Harbour', '', 2529, 'NSW', -34.597195, 150.855118, '', '', '', '', '', '', '', '', '', '', 'Active', '2011-01-02 01:45:31', '2011-01-02 01:45:31'),
(43, 'Chemist Warehouse Tamworth', 'Chain', 1, '121 Johnston Street', '', 'Tamworth', '', 2340, 'NSW', -31.075426, 150.924240, '', '', '', '', '', '', '', '', '', '', 'Active', '2011-01-02 01:46:10', '2011-01-02 01:46:10'),
(44, 'Chemist Warehouse Wollongong', 'Chain', 1, '269 Crown Street', '', 'Wollongong', '', 2500, 'NSW', -34.425446, 150.891754, '', '', '', '', '', '', '', '', '', '', 'Active', '2011-01-02 01:47:01', '2011-01-02 01:47:02'),
(45, 'National Pharmacy', 'Chain', 9, 'Shop 10 Kellyville Plaza, 90 Wrights Road', '', 'Kellyville', '', 2155, 'NSW', -33.715786, 150.967926, '', '', '', '', '', '', '', '', '', '', 'Active', '2011-01-02 01:51:19', '2011-01-02 01:51:19'),
(46, 'Discount Drug Stores Albury', 'Chain', 5, 'Shop 14 Centro Albury, 487 Kiewa Street', '', 'Albury', '', 2640, 'NSW', -36.081757, 146.913925, '', '', '', '', '', '', '', '', '', '', 'Active', '2011-01-02 02:08:50', '2011-01-02 02:19:32'),
(47, 'Discount Drug Stores Drummoyne', 'Chain', 5, 'Birkenhead Point Shopping Centre, Roseby Street', '', 'Drummoyne', '', 2047, 'NSW', -33.855854, 151.161392, '', '', '', '', '', '', '', '', '', '', 'Active', '2011-01-02 02:16:55', '2011-01-02 02:19:54'),
(48, 'Discount Drug Stores Calala', 'Chain', 5, 'Shop 3, Calala Green Shopping Village, 10 Campbell Road', '', 'Calala', '', 2340, 'NSW', -31.126108, 150.941315, '', '', '', '', '', '', '', '', '', '', 'Active', '2011-01-02 02:21:00', '2011-01-02 02:21:00'),
(49, 'Discount Drug Stores Campsie', 'Chain', 5, '259 Beamish Street', '', 'Campsie', '', 2194, 'NSW', -33.912056, 151.104294, '', '', '', '', '', '', '', '', '', '', 'Active', '2011-01-02 02:21:56', '2011-01-02 02:21:56'),
(50, 'Discount Drug Stores Earlwood', 'Chain', 5, '312 - 314 Homer Street', '', 'Earlwood', '', 2206, 'NSW', -33.926720, 151.126251, '', '', '', '', '', '', '', '', '', '', 'Active', '2011-01-02 02:22:53', '2011-01-02 02:22:53'),
(51, 'Discount Drug Stores Grafton', 'Chain', 5, 'Shop 2 Grafton Mall, King Street', '', 'Grafton', '', 2460, 'NSW', -29.689644, 152.932877, '', '', '', '', '', '', '', '', '', '', 'Active', '2011-01-02 02:23:51', '2011-01-02 02:23:51'),
(52, 'Discount Drug Stores Lismore', 'Chain', 5, '45 Woodlark Street', '', 'Lismore', '', 2480, 'NSW', -28.807449, 153.278091, '', '', '', '', '', '', '', '', '', '', 'Active', '2011-01-02 02:24:35', '2011-01-02 02:24:35'),
(53, 'Discount Drug Stores Manilla', 'Chain', 5, '161 Manilla Street', '', 'Manilla', '', 2346, 'NSW', -30.747318, 150.720245, '', '', '', '', '', '', '', '', '', '', 'Active', '2011-01-02 02:25:52', '2011-01-02 02:25:52'),
(54, 'Discount Drug Stores Tamworth South', 'Chain', 5, 'Shop 17 - 22 Southgate Shopping Centre, Kathleen Street', '', 'Tamworth South', '', 2340, 'NSW', -31.107088, 150.918549, '', '', '', '', '', '', '', '', '', '', 'Active', '2011-01-02 02:27:45', '2011-01-02 02:38:31'),
(55, 'Discount Drug Stores Tamworth', 'Chain', 5, 'Tamworth Shopping Village, Robert Street', '', 'Tamworth', '', 2340, 'NSW', -31.109186, 150.909286, '', '', '', '', '', '', '', '', '', '', 'Active', '2011-01-02 02:29:04', '2011-01-02 02:29:04'),
(56, 'Discount Drug Stores Taree', 'Chain', 5, 'Shop 2, 44-46 Manning Street', '', 'Taree', '', 2430, 'NSW', -31.911268, 152.459991, '', '', '', '', '', '', '', '', '', '', 'Active', '2011-01-02 02:31:33', '2011-01-02 02:31:34'),
(57, 'Discount Drug Stores Toongabbie', 'Chain', 5, '13 Aurelia Street', '', 'Toongabbie', '', 2146, 'NSW', -33.787720, 150.950729, '', '', '', '', '', '', '', '', '', '', 'Active', '2011-01-02 02:32:26', '2011-01-02 02:32:26'),
(58, 'Discount Drug Stores Tweed Heads', 'Chain', 5, '38 Wharf Street', '', 'Tweed Heads', '', 2485, 'NSW', -28.174191, 153.542526, '', '', '', '', '', '', '', '', '', '', 'Active', '2011-01-02 02:33:16', '2011-01-02 02:33:17'),
(59, 'Discount Drug Stores Penrith', 'Chain', 5, 'Shop 5A, 61-79 Henry Street', '', 'Penrith', '', 2750, 'NSW', -33.752533, 150.701401, '', '', '', '', '', '', '', '', '', '', 'Active', '2011-01-02 02:43:46', '2011-01-02 02:43:46'),
(60, 'Think Pharmacy Bayswater', 'Chain', 10, '73 Bayswater Road', '', 'Rushcutters Bay', '', 2001, 'NSW', -33.875854, 151.225159, '', '', '', '', '', '', '', '', '', '', 'Active', '2011-01-02 02:45:41', '2011-01-02 02:45:41'),
(61, 'Good Price Pharmacy Warehouse Armidale', 'Chain', 6, 'Shop 33 - 34 Armidale Plaza, Corner Beardy and Dangar Street', '', 'Armidale', '', 2350, 'NSW', -30.513161, 151.665405, '', '', '', '', '', '', '', '', '', '', 'Active', '2011-01-02 02:57:12', '2011-01-02 02:57:13'),
(62, 'Good Price Pharmacy Warehouse Coffs Harbour', 'Chain', 6, 'Shop 6 Bailey Centre 150 Pacific Highway', '', 'Coffs Harbour', '', 2450, 'NSW', -30.291296, 153.119278, '', '', '', '', '', '', '', '', '', '', 'Active', '2011-01-02 02:58:13', '2011-01-02 02:58:13'),
(63, 'Good Price Pharmacy Warehouse Grafton', 'Chain', 6, '63 - 69 Prince Street', '', 'Grafton', '', 2460, 'NSW', -29.690245, 152.934021, '', '', '', '', '', '', '', '', '', '', 'Active', '2011-01-02 02:59:21', '2011-01-02 02:59:21'),
(64, 'Good Price Pharmacy Warehouse McGrath''s Hill', 'Chain', 6, '264-272 Windsor Road', '', 'McGrath''s Hill', '', 2756, 'NSW', -33.628048, 150.838760, '', '', '', '', '', '', '', '', '', '', 'Active', '2011-01-02 03:00:42', '2011-01-02 03:08:08'),
(65, 'Good Price Pharmacy Warehouse South Nowra', 'Chain', 6, 'Shop 8 Homemaker Centre, 28 Central Avenue', '', 'South Nowra', '', 2541, 'NSW', -34.914219, 150.600388, '', '', '', '', '', '', '', '', '', '', 'Active', '2011-01-02 03:02:33', '2011-01-02 03:02:33'),
(66, 'Good Price Pharmacy Warehouse Tamworth', 'Chain', 6, 'Shop 6 Homespace Centre, Corner Greg Norman Drive and New England Highway', '', 'Tamworth', '', 2340, 'NSW', -31.098642, 150.935623, '', '', '', '', '', '', '', '', '', '', 'Active', '2011-01-02 03:04:03', '2011-01-02 03:04:03'),
(67, 'Cincotta Discount Chemist Beaumont Hills', 'Chain', 2, 'Shop 10 - 12, 70 Beaumont Hills Shopping Centre The Parkway', '', 'Beaumont Hills', '', 2155, 'NSW', -33.697826, 150.944153, '', '', '', '', '', '', '', '', '', '', 'Active', '2011-01-02 03:19:37', '2011-01-02 03:20:11'),
(68, 'Cincotta Discount Chemist Belrose', 'Chain', 2, '4 - 6 Niangala Close', '', 'Belrose', '', 2084, 'NSW', -33.702991, 151.212830, '', '', '', '', '', '', '', '', '', '', 'Active', '2011-01-02 03:22:00', '2011-01-02 03:23:59'),
(69, 'Cincotta Discount Chemist Blacktown', 'Chain', 2, '106 Main Street', '', 'Blacktown', '', 2148, 'NSW', -33.770905, 150.910141, '', '', '', '', '', '', '', '', '', '', 'Active', '2011-01-02 03:26:40', '2011-01-02 03:26:40'),
(70, 'Cincotta Discount Chemist Burwood', 'Chain', 2, '213 - 235 Parramatta Road', '', 'Burwood', '', 2046, 'NSW', -33.870293, 151.115234, '', '', '', '', '', '', '', '', '', '', 'Active', '2011-01-02 03:27:36', '2011-01-02 03:27:36'),
(71, 'Cincotta Discount Chemist Campsie', 'Chain', 2, '157 - 159 Beamish Street', '', 'Campsie', '', 2194, 'NSW', -33.908714, 151.103394, '', '', '', '', '', '', '', '', '', '', 'Active', '2011-01-02 03:28:50', '2011-01-02 03:28:50'),
(72, 'Cincotta Discount Chemist Caringbah', 'Chain', 2, '331 The Kingsway', '', 'Caringbah', '', 2229, 'NSW', -34.042404, 151.122787, '', '', '', '', '', '', '', '', '', '', 'Active', '2011-01-02 03:32:35', '2011-01-02 03:32:35'),
(73, 'Cincotta Discount Chemist Carlingford', 'Chain', 2, '821 - 825 Pennant Hills Road', '', 'Carlingford', '', 2118, 'NSW', -33.778194, 151.052200, '', '', '', '', '', '', '', '', '', '', 'Active', '2011-01-02 03:36:01', '2011-01-02 03:36:02'),
(74, 'Cincotta Discount Chemist Engadine', 'Chain', 2, '1097 Old Princes Highway', '', 'Engadine', '', 2233, 'NSW', -34.066563, 151.011856, '', '', '', '', '', '', '', '', '', '', 'Active', '2011-01-02 03:37:03', '2011-01-02 03:37:03'),
(75, 'Cincotta Discount Chemist Five Dock', 'Chain', 2, '125 Great Northern Road', '', 'Five Dock', '', 2046, 'NSW', -33.867485, 151.130096, '', '', '', '', '', '', '', '', '', '', 'Active', '2011-01-02 03:37:59', '2011-01-02 03:37:59'),
(76, 'Cincotta Discount Chemist Marrickville', 'Chain', 2, '248 Marrickville Road', '', 'Marrickville', '', 2204, 'NSW', -33.911442, 151.158173, '', '', '', '', '', '', '', '', '', '', 'Active', '2011-01-02 03:40:25', '2011-01-02 03:40:26'),
(77, 'Cincotta Discount Chemist Merrylands', 'Chain', 2, '185 Merrylands Road', '', 'Merrylands', '', 2160, 'NSW', -33.836491, 150.989868, '', '', '', '', '', '', '', '', '', '', 'Active', '2011-01-02 03:41:21', '2011-01-02 03:41:22'),
(78, 'Cincotta Discount Chemist Neutral Bay', 'Chain', 2, '116 Military Road', '', 'Neutral Bay', '', 2089, 'NSW', -33.829613, 151.217789, '', '', '', '', '', '', '', '', '', '', 'Active', '2011-01-02 03:44:02', '2011-01-02 03:44:02'),
(79, 'Cincotta Discount Chemist Revesby', 'Chain', 2, '38 - 42 Marco Avenue', '', 'Revesby', '', 2212, 'NSW', -33.951523, 151.016022, '', '', '', '', '', '', '', '', '', '', 'Active', '2011-01-02 03:45:52', '2011-01-02 03:45:52'),
(80, 'Cincotta Discount Chemist Toukley', 'Chain', 2, '231 Main Road', '', 'Toukley', '', 2263, 'NSW', -33.263889, 151.540436, '', '', '', '', '', '', '', '', '', '', 'Active', '2011-01-02 03:47:42', '2011-01-02 03:47:42'),
(81, 'Price Sense Pharmacy Dee Why', 'Chain', 7, '1/17 Howard Avenue', '', 'Dee Why', '', 2099, 'NSW', -33.753353, 151.287872, '', '', '', '', '', '', '', '', '', '', 'Active', '2011-01-19 04:54:08', '2011-01-19 04:54:09'),
(82, 'Price Sense Pharmacy Hillsdale', 'Chain', 7, 'Shop 7 Southpoint Shopping Centre 238-262 Bunnerong Road', '', 'Hillsdale', '', 2036, 'NSW', -33.951603, 151.230499, '', '', '', '', '', '', '', '', '', '', 'Active', '2011-01-19 04:55:14', '2011-01-19 04:55:14'),
(83, 'Price Sense Pharmacy Marrickville', 'Chain', 7, '221 Marrickville Road', '', 'Marrickville', '', 2044, 'NSW', -33.910732, 151.157379, '', '', '', '', '', '', '', '', '', '', 'Active', '2011-01-19 04:56:03', '2011-01-19 04:56:03'),
(84, 'OZE-Pharmacy Castle Hill', 'Chain', 31, '10/18 Victoria Ave', '', 'Castle Hill', '', 2154, 'NSW', -33.726116, 150.976395, '', '', '', '', '', '', '', '', '', '', 'Deleted', '2011-01-19 05:23:09', '2011-02-03 23:20:57'),
(85, 'OZE-Pharmacy Richmond', 'Chain', 25, '263 Windsor Street', '', 'Richmond', '', 2753, 'NSW', -33.595890, 150.749817, '', '', '', '', '', '', '', '', '', '', 'Deleted', '2011-01-19 05:24:11', '2011-02-03 23:20:36'),
(86, 'OZE-Pharmacy Blacktown', 'Chain', 27, '46 Main St', '', 'Blacktown', '', 2148, 'NSW', -33.769299, 150.908493, '', '', '', '', '', '', '', '', '', '', 'Deleted', '2011-01-19 05:24:55', '2011-02-03 23:20:27'),
(87, 'Castle Hill', 'Chain', 23, '10/18 Victoria Ave', '', 'Castle Hill', '', 2154, 'NSW', -33.726116, 150.976395, '', '', '', '', '', '', '', '', '', '', 'Deleted', '2011-02-03 11:08:55', '2011-02-03 23:09:32'),
(88, 'OZE-Pharmacy Castle Hill', 'Chain', 32, '10/18 Victoria Ave', '', 'Castle Hill', '', 2154, 'NSW', -33.726116, 150.976395, '', '', '', '', '', '', '', '', '', '', 'Deleted', '2011-02-03 11:23:12', '2011-02-03 23:23:51'),
(89, 'OZE Pharmacy Castle Hill', 'Chain', 33, '10/18 Victoria Ave', '', 'Castle Hill', '', 2154, 'NSW', -33.726116, 150.976395, '', '', '', '', '', '', '', '', '', '', 'Active', '2011-02-03 11:26:43', '2011-02-03 23:26:43'),
(90, 'OZE Pharmacy Richmond', 'Chain', 33, '263 Windsor Street', '', 'Richmond', '', 2753, 'NSW', -33.595890, 150.749817, '', '', '', '', '', '', '', '', '', '', 'Active', '2011-02-03 11:28:43', '2011-02-03 23:28:44'),
(91, 'OZE Pharmacy Blacktown', 'Chain', 33, '46 Main Street', '', 'Blacktown', '', 2148, 'NSW', -33.769299, 150.908493, '', '', '', '', '', '', '', '', '', '', 'Active', '2011-02-03 11:29:38', '2011-02-03 23:29:38'),
(92, 'OZE Pharmacy Penrith', 'Chain', 33, '473 High Street', '', 'Penrith', '', 2750, 'NSW', -33.753262, 150.696304, '', '', '', '', '', '', '', '', '', '', 'Active', '2011-02-03 11:30:50', '2011-02-03 23:30:50'),
(93, 'OZE Pharmacy Mona Vale', 'Chain', 33, 'Shop 4, 1785 Pittwater Road', '', 'Mona Vale', '', 2103, 'NSW', -33.675667, 151.302902, '', '', '', '', '', '', '', '', '', '', 'Active', '2011-02-03 11:35:01', '2011-02-03 23:35:01'),
(94, 'OZE Pharmacy Liverpool', 'Chain', 33, '146-150 Macquarie Street', '', 'Liverpool', '', 2170, 'NSW', -33.920826, 150.924316, '', '', '', '', '', '', '', '', '', '', 'Active', '2011-02-03 11:36:04', '2011-02-03 23:36:04'),
(95, 'OZE Pharmacy Hornsby', 'Chain', 33, '21-23 Florence Street', '', 'Hornsby', '', 2077, 'NSW', -33.703823, 151.099884, '', '', '', '', '', '', '', '', '', '', 'Active', '2011-02-03 11:37:00', '2011-02-03 23:37:01'),
(96, 'OZE Pharmacy Orange', 'Chain', 33, '188-190 Summer Street', '', 'Orange', '', 2800, 'NSW', -33.283722, 149.098297, '', '', '', '', '', '', '', '', '', '', 'Active', '2011-02-03 11:37:45', '2011-02-03 23:37:45'),
(97, 'Pulse Pharmacy Inverloch', 'Chain', 34, '1/12 A''Beckett Street', '', 'Inverloch', '', 3996, 'VIC', -38.633575, 145.728348, '', '', '', '', '', '', '', '', '', '', 'Active', '2011-02-04 12:00:19', '2011-02-04 00:00:20'),
(98, 'Pulse Pharmacy Sunbury', 'Chain', 34, '79 Evans Street', '', 'Sunbury', '', 3429, 'VIC', -37.580643, 144.729233, '', '', '', '', '', '', '', '', '', '', 'Active', '2011-02-04 12:02:11', '2011-02-04 00:02:11'),
(99, 'Pulse Pharmacy Malvern', 'Chain', 34, '1122 Malvern Road', '', 'Malvern', '', 3144, 'VIC', -37.851788, 145.030258, '', '', '', '', '', '', '', '', '', '', 'Active', '2011-02-04 12:06:46', '2011-02-04 00:06:46'),
(100, 'Pulse Pharmacy Richmond', 'Chain', 34, '543-549 Bridge Road', '', 'Richmond', '', 3121, 'VIC', -37.819302, 145.009064, '', '', '', '', '', '', '', '', '', '', 'Active', '2011-02-04 12:08:49', '2011-02-04 00:08:49'),
(101, 'Pulse Pharmacy Camberwell', 'Chain', 34, '1142 Toorak Road', '', 'Camberwell', '', 3124, 'VIC', -37.848522, 145.076920, '', '', '', '', '', '', '', '', '', '', 'Active', '2011-02-04 12:09:33', '2011-02-04 00:09:33'),
(102, 'Pulse Pharmacy Ringwood', 'Chain', 34, 'Eastland Shopping Centre Maroondah Hwy', '', 'Ringwood', '', 3121, 'VIC', -37.811077, 145.219177, '', '', '', '', '', '', '', '', '', '', 'Active', '2011-02-04 12:10:31', '2011-02-04 00:10:31'),
(103, 'Pulse Pharmacy Armadale', 'Chain', 34, '1195 High Street', '', 'Armadale', '', 3143, 'VIC', -37.856174, 145.027603, '', '', '', '', '', '', '', '', '', '', 'Active', '2011-02-04 12:11:38', '2011-02-04 00:11:38'),
(104, 'Pulse Pharmacy Hoppers Crossing', 'Chain', 34, 'Shop 9-10 Hogans Corner Shopping Centre', '', 'Hoppers Crossing', '', 3029, 'VIC', -37.882282, 144.700500, '', '', '', '', '', '', '', '', '', '', 'Active', '2011-02-04 12:12:55', '2011-02-04 00:12:55'),
(105, 'Pulse Pharmacy Kew', 'Chain', 34, '127 High Street', '', 'Kew', '', 3101, 'VIC', -37.806786, 145.029694, '', '', '', '', '', '', '', '', '', '', 'Active', '2011-02-04 12:13:45', '2011-02-04 00:13:45'),
(106, 'Pulse Pharmacy Malvern Central', 'Chain', 34, 'Shop 6 Malvern Central Shooping Centre', '', 'Malvern', '', 3144, 'VIC', -37.862072, 145.028336, '', '', '', '', '', '', '', '', '', '', 'Active', '2011-02-04 12:16:04', '2011-02-04 00:16:04'),
(107, 'Pulse Pharmacy Middle Park', 'Chain', 34, '17 Armstrong Street', '', 'Middle Park', '', 3206, 'VIC', -37.850571, 144.964600, '', '', '', '', '', '', '', '', '', '', 'Active', '2011-02-04 12:16:52', '2011-02-04 00:16:52'),
(108, 'Pulse Pharmacy Melbourne', 'Chain', 34, 'Shop 100 B Australia on Collins Shopping Centre 260 Collins Street', '', 'Melbourne', '', 3000, 'VIC', -37.815731, 144.965424, '', '', '', '', '', '', '', '', '', '', 'Active', '2011-02-04 12:18:37', '2011-02-04 00:18:37'),
(109, 'Pulse Pharmacy Geelong West', 'Chain', 34, '175-177 Parkington Street', '', 'Geelong West', '', 3218, 'VIC', -38.139397, 144.348206, '', '', '', '', '', '', '', '', '', '', 'Active', '2011-02-04 12:20:43', '2011-02-04 00:20:43'),
(110, 'Pulse Pharmacy Wantirna South', 'Chain', 34, 'Shop 1060 Knox Shopping Centre', '', 'Wantirna South', '', 3152, 'VIC', -37.869949, 145.237091, '', '', '', '', '', '', '', '', '', '', 'Active', '2011-02-04 12:22:13', '2011-02-04 00:22:13'),
(111, 'Pulse Pharmacy Cheltenham', 'Chain', 34, 'Shop 1145 Westfield Southland Nepean Hwy', '', 'Cheltenham', '', 3192, 'VIC', -37.965645, 145.057465, '', '', '', '', '', '', '', '', '', '', 'Active', '2011-02-04 12:27:45', '2011-02-04 00:27:46'),
(112, 'Pulse Pharmacy Blackburn', 'Chain', 34, '195 Whitehorse Road', '', 'Blackburn', '', 3130, 'VIC', -37.817467, 145.158325, '', '', '', '', '', '', '', '', '', '', 'Active', '2011-02-04 12:28:35', '2011-02-04 00:28:35'),
(113, 'Pulse Pharmacy Waurn Ponds', 'Chain', 34, '173 - 199 Pioneer Road', '', 'Waurn Ponds', '', 3216, 'VIC', -38.199268, 144.319443, '', '', '', '', '', '', '', '', '', '', 'Active', '2011-02-04 12:31:52', '2011-02-04 00:31:52'),
(114, 'Pulse Pharmacy Brighton', 'Chain', 34, '2/72 Church Street', '', 'Brighton', '', 3186, 'VIC', -37.914814, 144.994843, '', '', '', '', '', '', '', '', '', '', 'Active', '2011-02-04 12:33:28', '2011-02-04 00:33:28'),
(115, 'Pulse Pharmacy Mornington', 'Chain', 34, '20 Robertson Drive', '', 'Mornington', '', 3931, 'VIC', -38.225433, 145.055511, '', '', '', '', '', '', '', '', '', '', 'Active', '2011-02-04 12:35:14', '2011-02-04 00:35:14'),
(116, 'Pulse Pharmacy Diamond Creek', 'Chain', 34, '67 Main Hurstbridge Road', '', 'Diamond Creek', '', 3089, 'VIC', -37.673607, 145.159225, '', '', '', '', '', '', '', '', '', '', 'Active', '2011-02-04 12:36:34', '2011-02-04 00:36:35'),
(117, 'Pulse Pharmacy Preston', 'Chain', 34, '247-249 Murray Road', '', 'Preston', '', 3072, 'VIC', -37.738083, 145.002808, '', '', '', '', '', '', '', '', '', '', 'Active', '2011-02-04 12:37:36', '2011-02-04 00:37:36'),
(118, 'Pulse Pharmacy Maribyrnong', 'Chain', 34, 'Shop 3038 Highpoint Shopping Centre Rosamond Road', '', 'Maribyrnong', '', 3032, 'VIC', -37.777557, 144.885132, '', '', '', '', '', '', '', '', '', '', 'Active', '2011-02-04 12:38:59', '2011-02-04 00:38:59'),
(119, 'Pulse Pharmacy Rowville', 'Chain', 34, 'Shop 36 Stud Park Shopping Centre Stud Road', '', 'Rowville', '', 3178, 'VIC', -37.917400, 145.235443, '', '', '', '', '', '', '', '', '', '', 'Active', '2011-02-04 12:40:37', '2011-02-04 00:40:37'),
(120, 'Pulse Pharmacy Burwood East', 'Chain', 34, '26 Burwood Hwy', '', 'Burwood East', '', 3151, 'VIC', -37.852898, 145.133469, '', '', '', '', '', '', '', '', '', '', 'Active', '2011-02-04 12:42:02', '2011-02-04 00:42:03'),
(121, 'Pulse Pharmacy Kangaroo Flat', 'Chain', 34, 'Shop 40 Centro Lansell Shopping Centre High Street', '', 'Kangaroo Flat', '', 3555, 'VIC', -36.809582, 144.240097, '', '', '', '', '', '', '', '', '', '', 'Active', '2011-02-04 12:43:06', '2011-02-04 00:43:07'),
(122, 'Pulse Pharmacy Northcote', 'Chain', 34, 'Shop 5 Northcote Plaza Shopping Centre Separation Street', '', 'Northcote', '', 3070, 'VIC', -37.770409, 145.007935, '', '', '', '', '', '', '', '', '', '', 'Active', '2011-02-04 12:44:18', '2011-02-04 00:44:19'),
(123, 'Pulse Pharmacy Sale', 'Chain', 34, '381-385 Raymond Street', '', 'Sale', '', 3850, 'VIC', -38.106243, 147.065536, '', '', '', '', '', '', '', '', '', '', 'Active', '2011-02-04 12:45:23', '2011-02-04 00:45:23'),
(124, 'Pulse Pharmacy Newcomb', 'Chain', 34, 'Shop 5A Newcomb Central Shopping Centre', '', 'Newcomb', '', 3219, 'VIC', -38.169731, 144.388962, '', '', '', '', '', '', '', '', '', '', 'Active', '2011-02-04 12:46:15', '2011-02-04 00:46:15'),
(125, 'Pulse Pharmacy Forest Hill', 'Chain', 34, '4 Brentford Square', '', 'Forest Hill', '', 3131, 'VIC', -37.837555, 145.183685, '', '', '', '', '', '', '', '', '', '', 'Active', '2011-02-04 12:47:14', '2011-02-04 00:47:14'),
(126, 'Pulse Pharmacy Bairnsdale', 'Chain', 34, '46 Nicholson Street', '', 'Bairnsdale', '', 3875, 'VIC', -37.824524, 147.630966, '', '', '', '', '', '', '', '', '', '', 'Active', '2011-02-04 12:50:18', '2011-02-04 00:50:19'),
(127, 'Pulse Pharmacy Frankston', 'Chain', 34, '330 Cranbourne Road', '', 'Frankston', '', 3199, 'VIC', -38.153126, 145.165695, '', '', '', '', '', '', '', '', '', '', 'Active', '2011-02-04 12:52:33', '2011-02-04 00:52:33'),
(128, 'Chemist Warehouse Blacktown', 'Chain', 35, '1/9 Patrick Street', '', 'Blacktown', '', 2148, 'NSW', -33.769516, 150.906540, '', '', '', '', '', '', '', '', '', '', 'Deleted', '2011-06-22 09:16:01', '2011-06-22 09:42:14'),
(129, 'Chemist Warehouse Blacktown', 'Chain', 35, '1/9 Patrick Street', '', 'Blacktown', '', 2148, 'NSW', -33.769516, 150.906540, '', '', '', '', '', '', '', '', '', '', 'Deleted', '2011-06-22 09:17:30', '2011-06-26 00:48:04'),
(130, 'Chemist Warehouse Bondi Beach Pharmacy', 'Chain', 35, '132 Campbell Parade', '', 'Bondi Beach', '', 2026, 'NSW', -33.891006, 151.274063, '', '', '', '', '', '', '', '', '', '', 'Active', '2011-06-22 09:18:42', '2011-06-22 09:18:42'),
(131, 'Chemist Warehouse Lane Cove', 'Chain', 35, '73 Longueville Road', '', 'Lane Cove', '', 2066, 'NSW', -33.813267, 151.170181, '', '', '', '', '', '', '', '', '', '', 'Active', '2011-06-22 09:33:12', '2011-06-22 09:33:12'),
(132, 'Chemist Warehouse Lavington', 'Chain', 35, '3-5 338 Kaitlers Road', '', 'Spring Dale Heights', '', 2641, 'NSW', -36.034061, 146.950317, '', '', '', '', '', '', '', '', '', '', 'Active', '2011-06-22 09:36:07', '2011-06-22 09:36:08'),
(133, 'Chemist Warehouse Blacktown', 'Chain', 36, '1/9 Patrick Street', '', 'Blacktown', '', 2148, 'NSW', -33.769516, 150.906540, '', '', '', '', '', '', '', '', '', '', 'Deleted', '2011-06-22 09:41:45', '2011-06-22 09:42:08'),
(134, 'Chemist Warehouse Blacktown', 'Chain', 39, '1/9 Patrick Street', '', 'Blacktown', '', 2148, 'NSW', -33.769516, 150.906540, '', '', '', '', '', '', '', '', '', '', 'Deleted', '2011-06-22 09:44:05', '2011-06-26 00:48:01'),
(135, 'Chemist Warehouse Woden', 'Chain', 38, '24 Corinna Street', '', 'Phillip', '', 2606, 'ACT', -35.345409, 149.083939, '', '', '', '', '', '', '', '', '', '', 'Active', '2011-06-22 09:54:00', '2011-06-22 09:54:01'),
(136, 'Chemist Warehouse Blacktown', 'Chain', 39, '1/9 Patrick Street', '', 'Blacktown', '', 2148, 'NSW', -33.769516, 150.906540, '', '', '', '', '', '', '', '', '', '', 'Deleted', '2011-06-26 12:46:56', '2011-06-26 00:47:56');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `username` varchar(255) NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `status` enum('Active','Inactive','Deleted') NOT NULL default 'Inactive',
  `vcode` varchar(25) default NULL COMMENT 'A column for storing the verification code.',
  `type` enum('Admin','Store') NOT NULL default 'Admin',
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `firstname`, `lastname`, `password`, `email`, `status`, `vcode`, `type`, `created_at`, `updated_at`) VALUES
(1, 'harman83in', 'Harmandeep', 'Dhillon', '550c5c77db909b8e67f7902797c4bc55', 'harman83in@gmail.com', 'Active', 'bb493603a51762234687be528', 'Admin', '2010-11-02 12:19:00', '2010-11-02 12:19:00'),
(2, 'jcaldwell', 'Justin', 'Caldwell', '0befa6901116e443d84f77a00348043e', 'justindcaldwell@gmail.com', 'Active', 'cea7c67a0b2b82561c8150f21', 'Admin', '2010-11-02 06:22:31', '2010-11-02 18:22:31'),
(3, 'default', 'default', 'default', '147dc838c615d6da8ba73b26e78db4d7', 'justin@boozle.com.au', 'Active', '0c5fcc565944b768dfd1dd5da', 'Admin', '2011-01-02 03:54:36', '2011-01-02 03:54:36');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `medicines`
--
ALTER TABLE `medicines`
  ADD CONSTRAINT `medicines_ibfk_1` FOREIGN KEY (`medicine_type_id`) REFERENCES `medicine_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `medicine_salt`
--
ALTER TABLE `medicine_salt`
  ADD CONSTRAINT `medicine_salt_ibfk_1` FOREIGN KEY (`medicine_id`) REFERENCES `medicines` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `medicine_salt_ibfk_2` FOREIGN KEY (`salt_id`) REFERENCES `salts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `stores`
--
ALTER TABLE `stores`
  ADD CONSTRAINT `stores_ibfk_1` FOREIGN KEY (`chainbg_id`) REFERENCES `chainbgs` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
SET FOREIGN_KEY_CHECKS=1;
