-- phpMyAdmin SQL Dump
-- version 4.0.5deb1.precise~ppa.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 26, 2013 at 04:28 PM
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

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`article_id`, `article_image`, `article_title`, `article_body`, `article_type_id`, `article_status`, `user_id`, `date_created`, `last_modified`) VALUES
(1, '123123.jpg', 'The Red Ballpen', 'Lorem ipsum dolor sit amet, saperet expetenda complectitur pro no, graeco doctus eleifend pro ei. Sonet detraxit vis ex, salutandi suscipiantur et mea, quo odio labore temporibus cu. Eu sed ponderum perpetua dissentiunt, pri consequat concludaturque te, te usu wisi scribentur. Magna legendos an his. Iisque luptatum his at, te wisi tincidunt voluptatum has, justo percipit sea et.\r\n\r\nLorem ipsum dolor sit amet, saperet expetenda complectitur pro no, graeco doctus eleifend pro ei. Sonet detraxit vis ex, salutandi suscipiantur et mea, quo odio labore temporibus cu. Eu sed ponderum perpetua dissentiunt, pri consequat concludaturque te, te usu wisi scribentur. Magna legendos an his. Iisque luptatum his at, te wisi tincidunt voluptatum has, justo percipit sea et.\r\n\r\nLorem ipsum dolor sit amet, saperet expetenda complectitur pro no, graeco doctus eleifend pro ei. Sonet detraxit vis ex, salutandi suscipiantur et mea, quo odio labore temporibus cu. Eu sed ponderum perpetua dissentiunt, pri consequat concludaturque te, te usu wisi scribentur. Magna legendos an his. Iisque luptatum his at, te wisi tincidunt voluptatum has, justo percipit sea et.\r\n\r\nLorem ipsum dolor sit amet, saperet expetenda complectitur pro no, graeco doctus eleifend pro ei. Sonet detraxit vis ex, salutandi suscipiantur et mea, quo odio labore temporibus cu. Eu sed ponderum perpetua dissentiunt, pri consequat concludaturque te, te usu wisi scribentur. Magna legendos an his. Iisque luptatum his at, te wisi tincidunt voluptatum has, justo percipit sea et.', 1, 1, 1, '2013-10-14 05:57:10', '0000-00-00 00:00:00'),
(2, '123123.jpg', 'The Blue Ballpen', '<p>Lorem ipsum dolor sit amet, saperet expetenda complectitur pro no, graeco doctus eleifend pro ei. Sonet detraxit vis ex, salutandi suscipiantur et mea, quo odio labore temporibus cu. Eu sed ponderum perpetua dissentiunt, pri consequat concludaturque te, te usu wisi scribentur. Magna legendos an his. Iisque luptatum his at, te wisi tincidunt voluptatum has, justo percipit sea et.\r\n</p>\r\n\r\n<p>\r\nLorem ipsum dolor sit amet, saperet expetenda complectitur pro no, graeco doctus eleifend pro ei. Sonet detraxit vis ex, salutandi suscipiantur et mea, quo odio labore temporibus cu. Eu sed ponderum perpetua dissentiunt, pri consequat concludaturque te, te usu wisi scribentur. Magna legendos an his. Iisque luptatum his at, te wisi tincidunt voluptatum has, justo percipit sea et.\r\n</p>\r\nLorem ipsum dolor sit amet, saperet expetenda complectitur pro no, graeco doctus eleifend pro ei. Sonet detraxit vis ex, salutandi suscipiantur et mea, quo odio labore temporibus cu. Eu sed ponderum perpetua dissentiunt, pri consequat concludaturque te, te usu wisi scribentur. Magna legendos an his. Iisque luptatum his at, te wisi tincidunt voluptatum has, justo percipit sea et.\r\n\r\nLorem ipsum dolor sit amet, saperet expetenda complectitur pro no, graeco doctus eleifend pro ei. Sonet detraxit vis ex, salutandi suscipiantur et mea, quo odio labore temporibus cu. Eu sed ponderum perpetua dissentiunt, pri consequat concludaturque te, te usu wisi scribentur. Magna legendos an his. Iisque luptatum his at, te wisi tincidunt voluptatum has, justo percipit sea et.\r\n\r\nLorem ipsum dolor sit amet, saperet expetenda complectitur pro no, graeco doctus eleifend pro ei. Sonet detraxit vis ex, salutandi suscipiantur et mea, quo odio labore temporibus cu. Eu sed ponderum perpetua dissentiunt, pri consequat concludaturque te, te usu wisi scribentur. Magna legendos an his. Iisque luptatum his at, te wisi tincidunt voluptatum has, justo percipit sea et.', 1, 1, 1, '2013-10-14 05:57:10', '0000-00-00 00:00:00'),
(3, 'image', 'Nullam quis risus', 'Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nullam id dolor id nibh ultricies vehicula.\r\n\r\nCum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec ullamcorper nulla non metus auctor fringilla. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Donec ullamcorper nulla non metus auctor fringilla.\r\n\r\nMaecenas sed diam eget risus varius blandit sit amet non magna. Donec id elit non mi porta gravida at eget metus. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit.', 1, 1, 1, '2013-10-19 11:55:17', '2013-10-19 11:55:17');

--
-- Dumping data for table `article_type`
--

INSERT INTO `article_type` (`article_type_id`, `article_type`) VALUES
(1, 'product'),
(2, 'artisan'),
(3, 'enterprise');

--
-- Dumping data for table `artisan`
--

INSERT INTO `artisan` (`artisan_id`, `artisan_name`, `artisan_description`, `artisan_status`, `article_id`, `enterprise_id`, `date_created`, `last_modified`) VALUES
(1, 'Aleng Penchang', 'She is creating website', 1, 1, 1, NULL, NULL),
(2, 'Mang Jayvz', 'He is creating website', 1, 2, 1, NULL, NULL);

--
-- Dumping data for table `artisan_album`
--

INSERT INTO `artisan_album` (`artisan_album_id`, `artisan_image`, `artisan_id`, `is_primary`, `date_added`) VALUES
(1, '20130921015223.jpeg', 1, 1, '2013-10-19 10:49:43'),
(2, '20130921015223.jpeg', 2, 1, '2013-10-19 10:49:43');

--
-- Dumping data for table `artisan_product`
--

INSERT INTO `artisan_product` (`ap_id`, `artisan_id`, `product_id`, `date_added`) VALUES
(1, 1, 3, '2013-10-19 09:42:21'),
(2, 1, 4, '2013-10-19 09:42:21'),
(3, 2, 5, '2013-10-19 09:42:38');

--
-- Dumping data for table `collection`
--

INSERT INTO `collection` (`collection_id`, `collection_name`, `collection_status`, `date_created`, `last_modified`) VALUES
(1, 'Home And Office', 1, NULL, NULL),
(2, 'House and Lot', 1, '2013-10-14 06:06:57', '0000-00-00 00:00:00');

--
-- Dumping data for table `enterprise`
--

INSERT INTO `enterprise` (`enterprise_id`, `enterprise_name`, `enterprise_description`, `enterprise_status`, `article_id`, `date_created`, `last_modified`) VALUES
(1, 'Gkonomiks', 'Gkonomiks Description', 1, 0, '2013-10-19 09:45:23', '2013-10-19 09:45:23'),
(2, 'Manufacturer', 'Manufacturer Description1', 1, 2, '2013-10-19 12:29:50', '2013-10-19 12:29:50');

--
-- Dumping data for table `enterprise_album`
--

INSERT INTO `enterprise_album` (`enterprise_album_id`, `enterprise_id`, `enterprise_image`, `is_primary`, `date_added`) VALUES
(1, 1, '20130921015223.jpeg', 1, '2013-10-19 10:50:08');

--
-- Dumping data for table `enterprise_artisan`
--

INSERT INTO `enterprise_artisan` (`ea_id`, `enterprise_id`, `artisan_id`, `date_added`) VALUES
(1, 1, 1, '2013-10-19 09:45:42'),
(2, 1, 2, '2013-10-19 09:45:42');

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `product_description`, `product_quantity`, `product_status`, `width`, `height`, `weight`, `variant`, `price`, `is_highlighted`, `artisan_id`, `article_id`, `date_created`, `last_modified`) VALUES
(3, 'Red Ballpen', 'a shiny red ballpen. Lorem ipsum dolor sit amet, saperet expetenda complectitur pro no, graeco doctus eleifend pro ei. Sonet detraxit vis ex, salutandi suscipiantur et mea, quo odio labore temporibus cu. Eu sed ponderum perpetua dissentiunt, pri consequat concludaturque te, te usu wisi scribentur. Magna legendos an his. Iisque luptatum his at, te wisi tincidunt voluptatum has, justo percipit sea et.', 5, 1, 5, 10, 2, '', 10.25, 1, 1, 2, '2013-10-14 08:21:20', '0000-00-00 00:00:00'),
(4, 'Blue Ballpen', 'a shiny Blue ballpen', 5, 1, 5, 10, 2, '', 5.25, 0, 1, 1, '2013-10-14 08:23:32', '0000-00-00 00:00:00'),
(5, 'Black Ballpen', 'a shiny black ballpen', 1, 1, 5, 10, 2, '', 8.25, 0, 1, 3, '2013-10-14 08:23:19', '2013-10-14 08:30:09');

--
-- Dumping data for table `product_album`
--

INSERT INTO `product_album` (`product_album_id`, `product_image`, `product_id`, `is_primary`, `date_added`) VALUES
(1, '20130921015223.jpeg', 3, 1, '2013-10-19 10:44:22'),
(2, '20130921015223.jpeg', 4, 1, '2013-10-19 10:46:59'),
(3, '20130921015223.jpeg', 5, 1, '2013-10-19 10:46:59');

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_email`, `user_password`, `firstname`, `lastname`, `is_member`, `user_type`, `user_status`, `date_created`, `last_modified`, `access_token`) VALUES
(1, 'jayvzolazo@gmail.com', 'dfe74cac7654a17b5b717091daec8b2693fe03e1', 'Jayvz', 'Olazo', 0, 1, 1, '2013-10-13 07:58:00', NULL, '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
