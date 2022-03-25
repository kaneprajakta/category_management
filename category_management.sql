-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 25, 2022 at 03:34 AM
-- Server version: 8.0.27
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `category_management`
--

DELIMITER $$
--
-- Functions
--
DROP FUNCTION IF EXISTS `figure_up_depth`$$
CREATE DEFINER=`root`@`localhost` FUNCTION `figure_up_depth` (`idToSearch` INT) RETURNS INT BEGIN


 DECLARE depth INT;
 SET depth = 0;


 WHILE ( idToSearch  is not null) DO

   SET idToSearch = ( select parent_id
     from categories
     where cat_id = idToSearch
                  );

   SET depth = depth + 1;

 END WHILE;

 RETURN depth;

END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `cat_id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `parent_id` int UNSIGNED DEFAULT NULL,
  `sort_order` int NOT NULL,
  `level` int NOT NULL,
  PRIMARY KEY (`cat_id`),
  UNIQUE KEY `cat_name` (`cat_name`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_name`, `parent_id`, `sort_order`, `level`) VALUES
(1, 'level1-cat1', NULL, 1, 1),
(2, 'level2-cat2', 1, 2, 2),
(4, 'level2-cat1', 1, 1, 2),
(5, 'level3-cat1', 4, 0, 3),
(8, 'level2-cat3', 1, 3, 2),
(12, 'level4-cat1', 5, 0, 4);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
