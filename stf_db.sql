-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 17, 2013 at 10:49 PM
-- Server version: 5.6.11
-- PHP Version: 5.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `stf_db`
--
CREATE DATABASE IF NOT EXISTS `stf_db` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `stf_db`;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `USERS_TIN` int(10) unsigned NOT NULL,
  `order_Date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `order_Status` varchar(45) NOT NULL,
  `finished_Order` tinyint(1) NOT NULL,
  `discount` float NOT NULL,
  `money_Amount` double NOT NULL,
  PRIMARY KEY (`order_id`),
  KEY `fk_ORDERS_USERS1_idx` (`USERS_TIN`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE IF NOT EXISTS `order_details` (
  `ORDERS_order_id` int(11) NOT NULL AUTO_INCREMENT,
  `PRODUCTS_productId` int(11) NOT NULL,
  `quantityOrdered` int(11) NOT NULL,
  `priceEach` double NOT NULL,
  `orderLineNumber` tinyint(4) NOT NULL,
  PRIMARY KEY (`ORDERS_order_id`,`PRODUCTS_productId`),
  KEY `fk_ORDER_DETAILS_PRODUCTS_idx` (`PRODUCTS_productId`),
  KEY `fk_ORDER_DETAILS_ORDERS1_idx` (`ORDERS_order_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE IF NOT EXISTS `payments` (
  `USERS_TIN` int(10) unsigned NOT NULL,
  `check_Id` int(11) NOT NULL AUTO_INCREMENT,
  `payment_Date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `amount` double NOT NULL,
  `payment_method` varchar(45) NOT NULL,
  PRIMARY KEY (`USERS_TIN`,`check_Id`),
  UNIQUE KEY `check_Id` (`check_Id`),
  KEY `fk_PAYMENTS_USERS1_idx` (`USERS_TIN`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `productId` int(11) NOT NULL AUTO_INCREMENT,
  `productName` varchar(45) NOT NULL,
  `substance` varchar(45) NOT NULL,
  `totalQuantity` int(11) NOT NULL,
  `minQuantity` int(11) NOT NULL,
  `price` float NOT NULL,
  `description` text NOT NULL,
  `image` varchar(45) NOT NULL,
  `manufacturer` varchar(45) NOT NULL,
  `category` varchar(45) NOT NULL,
  PRIMARY KEY (`productId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`productId`, `productName`, `substance`, `totalQuantity`, `minQuantity`, `price`, `description`, `image`, `manufacturer`, `category`) VALUES
(14, 'Depon', 'Depon', 1000, 20, 1.3, 'Depon is a product for headaches.', '3d6f5ba4-a59d-a7d0-dcfc-10ccde5eb982', 'Bristol', 'Other'),
(15, 'Ponstan', 'Ponstan', 2000, 20, 1.2, 'Ponstan is a drug for antipyretic purposes.', 'c9d63246-2178-aa39-1955-4951a635cf47', 'Bayer', 'Other'),
(17, 'Adcirca', 'Tadalafil', 1000, 30, 2.3, 'Adcirca (tadalafil) is an oral inhibitor of phosphodiesterase type 5 (PDE5), the enzyme responsible for the degradation of cyclic guanosine monophosphate (cGMP).', '647b4e93-80c3-0d58-c2f8-8ffcad1a6ca6', 'Eli Lilly', 'Cardiovascular'),
(18, 'Aspirin', 'Acetylsalicylic', 1000, 30, 2.3, 'Aspirin is an analgetic drug.', '84b5134a-1067-85ae-f604-0c22c52cfc3a', 'Bayer', 'Acetylsalicylic'),
(19, 'Panadol', 'Panadol', 1000, 20, 2.1, 'Panadol is a pathological drug.', 'e68f8816-aa11-d932-35d1-2edf8b756326', 'Bayer', 'Pathologic');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `TIN` int(10) unsigned NOT NULL,
  `userType` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `salt` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(65) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `email` varchar(45) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `firstName` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `lastName` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `pharmacy` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `postalCode` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `town` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `ranking` double NOT NULL,
  `register_Date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`TIN`),
  UNIQUE KEY `username_UNIQUE` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`TIN`, `userType`, `username`, `salt`, `password`, `email`, `firstName`, `lastName`, `pharmacy`, `address`, `postalCode`, `town`, `phone`, `ranking`, `register_Date`) VALUES
(123498765, 'U', 'user', 'ÂÂˆ>!Ã¹Â½g?6z+Ã›e', '07d5e55d21c834ab6bc206bd8158ae8a89bdb5c9789719f0c07d0a0e4aa3bd86', 'johnlennon@stf.gr', 'John', 'Lennon', 'JohnPharm', 'Glavani 38', '38221', 'Volos', '2421012345', 0, '2013-12-16 16:34:11'),
(432112345, 'U', 'jacksp', 'ÂÂ¿]ÃÃ›Â½Â¹^Â’Ã‚Â+Â±', '6b0277b2b069e39ef5711f8a12a19ae3555b0874f43a414e0d465164ab61e5c3', 'jack_sp@stf.gr', 'Jack', 'Sparrow', 'JacksPharm', 'Glavani 23', '38221', 'Volos', '2421045321', 0, '2013-12-16 10:23:17'),
(456321789, 'U', 'johncena', 'Ã¶ÃœvÃ­Âž2RÃ„j1Ã·OÃ½ÃŒ(k', '310be99da2be09dd7d5db0d3e01f96fe16258cbbc77ffc518ab3bcd9adf99186', 'johncena@stf.gr', 'John', 'Cena', 'CenaPharm', 'Glavani 65', '38221', 'Volos', '2421067890', 0, '2013-12-16 10:26:10'),
(1234567890, 'A', 'admin', '¹CoÄDó?V¸''“L', '7714c6a177f30d147dc655991697dbfdfaea601f0e9258b51be0501af25d50e7', 'admin@stf.gr', 'admin', 'admin', 'adminpharm', 'Volos 123', '12345', 'Volos', '1234567890', 0, '2013-12-10 10:26:14');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_ORDERS_USERS1` FOREIGN KEY (`USERS_TIN`) REFERENCES `users` (`TIN`) ON UPDATE CASCADE;

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `fk_ORDER_DETAILS_ORDERS1` FOREIGN KEY (`ORDERS_order_id`) REFERENCES `orders` (`order_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_ORDER_DETAILS_PRODUCTS` FOREIGN KEY (`PRODUCTS_productId`) REFERENCES `products` (`productId`) ON UPDATE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `fk_PAYMENTS_USERS1` FOREIGN KEY (`USERS_TIN`) REFERENCES `users` (`TIN`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
