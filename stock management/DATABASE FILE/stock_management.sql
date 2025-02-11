-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 21, 2024 at 02:56 AM
-- Server version: 8.3.0
-- PHP Version: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stock_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `create_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `create_at`) VALUES
(1, 'Admin', 'e6e061838856bf47e1de730719fb2609', '2024-09-18 18:06:09');

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

DROP TABLE IF EXISTS `stock`;
CREATE TABLE IF NOT EXISTS `stock` (
  `p_code` varchar(11) NOT NULL,
  `p_name` varchar(255) NOT NULL,
  `p_quantity` int NOT NULL,
  `p_price` int NOT NULL,
  `p_total_price` int NOT NULL,
  `create_at` datetime NOT NULL,
  PRIMARY KEY (`p_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`p_code`, `p_name`, `p_quantity`, `p_price`, `p_total_price`, `create_at`) VALUES
('p_82', 'Nguvu', 166, 1500, 249000, '2024-09-17 12:23:24'),
('trx23', 'books', 0, 3300, 0, '2024-09-17 19:26:58'),
('iio', 'rice', 24, 545, 13080, '2024-09-17 17:15:08'),
('NN89', 'Crane Book', 100, 2300, 230000, '2024-09-18 09:51:54');

-- --------------------------------------------------------

--
-- Table structure for table `stock_in`
--

DROP TABLE IF EXISTS `stock_in`;
CREATE TABLE IF NOT EXISTS `stock_in` (
  `p_code` varchar(11) NOT NULL,
  `p_name` varchar(255) NOT NULL,
  `p_quantity` int NOT NULL,
  `p_price` int NOT NULL,
  `p_total_price` int NOT NULL,
  `create_at` datetime NOT NULL,
  KEY `p_code` (`p_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `stock_in`
--

INSERT INTO `stock_in` (`p_code`, `p_name`, `p_quantity`, `p_price`, `p_total_price`, `create_at`) VALUES
('p_82', 'Nguvu', 1000, 1500, 1500000, '2024-09-17 12:23:24'),
('WSG', 'Maize Flour', 2500, 1200, 3000000, '2024-09-17 12:23:44'),
('iio', 'rice', 5, 545, 2725, '2024-09-17 17:15:08'),
('trx', 'books', 45, 330, 14850, '2024-09-17 19:26:58'),
('iio', 'rice', 67, 1500, 100500, '2024-09-17 19:29:15'),
('NN89', 'Crane Book', 500, 2300, 1150000, '2024-09-18 09:51:54');

-- --------------------------------------------------------

--
-- Table structure for table `stock_out`
--

DROP TABLE IF EXISTS `stock_out`;
CREATE TABLE IF NOT EXISTS `stock_out` (
  `p_code` varchar(11) NOT NULL,
  `p_name` varchar(255) NOT NULL,
  `p_quantity` int NOT NULL,
  `p_price` int NOT NULL,
  `p_total_price` int NOT NULL,
  `create_at` datetime NOT NULL,
  KEY `p_code` (`p_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `stock_out`
--

INSERT INTO `stock_out` (`p_code`, `p_name`, `p_quantity`, `p_price`, `p_total_price`, `create_at`) VALUES
('trx23', 'books', 50, 3300, 165000, '2024-09-18 19:20:34'),
('NN89', 'Crane Book', 200, 2300, 460000, '2024-09-18 10:04:49'),
('p_82', 'Nguvu', 34, 1500, 51000, '2024-09-17 19:31:46'),
('iio', 'rice', 46, 545, 25070, '2024-09-17 19:31:23'),
('NN89', 'Crane Book', 200, 2300, 460000, '2024-09-18 14:58:05');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
