-- phpMyAdmin SQL Dump
-- version 4.0.5deb1.precise~ppa.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 26, 2013 at 04:27 PM
-- Server version: 5.5.32-0ubuntu0.12.04.1
-- PHP Version: 5.3.10-1ubuntu3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mkyrrh_makaya`
--

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE IF NOT EXISTS `article` (
  `article_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `article_image` varchar(500) NOT NULL,
  `article_title` varchar(200) NOT NULL,
  `article_body` longtext NOT NULL,
  `article_type_id` tinyint(4) NOT NULL,
  `article_status` tinyint(4) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `date_created` timestamp NULL DEFAULT NULL,
  `last_modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`article_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `article_type`
--

CREATE TABLE IF NOT EXISTS `article_type` (
  `article_type_id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `article_type` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`article_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `artisan`
--

CREATE TABLE IF NOT EXISTS `artisan` (
  `artisan_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `artisan_name` varchar(200) NOT NULL,
  `artisan_description` longtext NOT NULL,
  `artisan_status` tinyint(4) NOT NULL,
  `article_id` bigint(20) NOT NULL,
  `enterprise_id` bigint(20) NOT NULL,
  `date_created` timestamp NULL DEFAULT NULL,
  `last_modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`artisan_id`),
  KEY `article_id` (`article_id`),
  KEY `enterprise_id` (`enterprise_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `artisan_album`
--

CREATE TABLE IF NOT EXISTS `artisan_album` (
  `artisan_album_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `artisan_image` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `artisan_id` bigint(20) NOT NULL,
  `is_primary` tinyint(1) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`artisan_album_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `artisan_product`
--

CREATE TABLE IF NOT EXISTS `artisan_product` (
  `ap_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `artisan_id` bigint(20) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ap_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `collection`
--

CREATE TABLE IF NOT EXISTS `collection` (
  `collection_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `collection_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `collection_status` tinyint(4) NOT NULL,
  `date_created` timestamp NULL DEFAULT NULL,
  `last_modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`collection_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `collection_artisan`
--

CREATE TABLE IF NOT EXISTS `collection_artisan` (
  `ca_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `collection_id` bigint(20) NOT NULL,
  `artisan_id` bigint(20) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ca_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `collection_enterprise`
--

CREATE TABLE IF NOT EXISTS `collection_enterprise` (
  `ce_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `collection_id` bigint(20) NOT NULL,
  `enterprise_id` bigint(20) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ce_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `collection_product`
--

CREATE TABLE IF NOT EXISTS `collection_product` (
  `cp_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `collection_id` bigint(20) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`cp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `comment_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `article_id` bigint(11) NOT NULL,
  `date_created` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`comment_id`),
  KEY `article_id` (`article_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE IF NOT EXISTS `country` (
  `country_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `country_code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `country_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `date_created` timestamp NULL DEFAULT NULL,
  `last_modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`country_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `enterprise`
--

CREATE TABLE IF NOT EXISTS `enterprise` (
  `enterprise_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `enterprise_name` varchar(200) NOT NULL,
  `enterprise_description` longtext NOT NULL,
  `enterprise_status` tinyint(4) NOT NULL,
  `article_id` bigint(20) NOT NULL,
  `date_created` timestamp NULL DEFAULT NULL,
  `last_modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`enterprise_id`),
  KEY `article_id` (`article_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `enterprise_album`
--

CREATE TABLE IF NOT EXISTS `enterprise_album` (
  `enterprise_album_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `enterprise_id` bigint(20) NOT NULL,
  `enterprise_image` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `is_primary` tinyint(4) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`enterprise_album_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `enterprise_artisan`
--

CREATE TABLE IF NOT EXISTS `enterprise_artisan` (
  `ea_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `enterprise_id` bigint(20) NOT NULL,
  `artisan_id` bigint(20) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ea_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE IF NOT EXISTS `feedback` (
  `feedback_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `feedback_subject` varchar(100) NOT NULL,
  `feedback_email` varchar(100) NOT NULL,
  `feedback_message` longtext NOT NULL,
  `date_added` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`feedback_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `product_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(300) NOT NULL,
  `product_description` varchar(500) NOT NULL,
  `product_quantity` int(11) NOT NULL DEFAULT '0',
  `product_status` tinyint(4) NOT NULL,
  `width` int(11) NOT NULL,
  `height` int(11) NOT NULL,
  `weight` int(11) NOT NULL,
  `variant` varchar(200) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `is_highlighted` tinyint(4) NOT NULL DEFAULT '0',
  `artisan_id` bigint(20) NOT NULL,
  `article_id` bigint(20) DEFAULT '0',
  `date_created` timestamp NULL DEFAULT NULL,
  `last_modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`product_id`),
  KEY `article_id` (`article_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Table structure for table `product_album`
--

CREATE TABLE IF NOT EXISTS `product_album` (
  `product_album_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `product_image` varchar(500) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `is_primary` tinyint(4) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`product_album_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `product_country`
--

CREATE TABLE IF NOT EXISTS `product_country` (
  `pc_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `product_id` bigint(20) NOT NULL,
  `country_id` bigint(20) NOT NULL,
  `country_product_price` decimal(10,2) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`pc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `product_order`
--

CREATE TABLE IF NOT EXISTS `product_order` (
  `order_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `quantity` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `is_purchased` tinyint(1) NOT NULL DEFAULT '0',
  `date_created` timestamp NULL DEFAULT NULL,
  `last_modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`order_id`),
  KEY `product_id` (`product_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `transaction_history`
--

CREATE TABLE IF NOT EXISTS `transaction_history` (
  `tx_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `transaction_id` varchar(500) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `order_id` bigint(20) NOT NULL,
  `transaction_date` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`tx_id`),
  KEY `product_order_id` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_email` varchar(100) NOT NULL,
  `user_password` varchar(88) DEFAULT NULL,
  `firstname` varchar(30) DEFAULT NULL,
  `lastname` varchar(30) DEFAULT NULL,
  `is_member` tinyint(1) NOT NULL,
  `user_type` tinyint(4) NOT NULL DEFAULT '0',
  `user_status` tinyint(4) NOT NULL DEFAULT '0',
  `date_created` timestamp NULL DEFAULT NULL,
  `last_modified` timestamp NULL DEFAULT NULL,
  `access_token` varchar(100) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
