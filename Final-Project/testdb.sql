-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2022 at 02:51 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `testdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `id` int(11) NOT NULL,
  `employee_id` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `employee_id`, `password`) VALUES
(1, 'test', 'test'),
(2, 'admin', '123456'),
(3, '20a22', '582');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `Product_ID` int(11) NOT NULL,
  `Product_Name` varchar(100) NOT NULL,
  `Product_Price` decimal(10,0) NOT NULL,
  `Product_Qty` int(11) NOT NULL,
  `Product_Category` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`Product_ID`, `Product_Name`, `Product_Price`, `Product_Qty`, `Product_Category`) VALUES
(1, 'Evian Natural Mineral Water 1L', '92', 24, 'Drinking Water'),
(2, 'Gatorade Cool Blue 20oz', '165', 17, 'Sports Drink'),
(3, 'Nestle Milo Budget Pack', '186', 16, 'Sports Drink'),
(4, 'Wilkins Drinking Water', '26', 17, 'Drinking Water'),
(5, 'Pocari Sweat 2L', '159', 17, 'Sports Drink'),
(6, 'Gatorade Lemon Lime', '165', 19, 'Sports Drink'),
(7, 'Gatorade Orange', '707', 17, 'Sports Drink'),
(8, 'Nature Spring Purified Water 500ml', '10', 17, 'Drinking Water'),
(9, 'Nescafe Coffee Brown 500gm', '800', 22, 'Powdered Drink');

-- --------------------------------------------------------

--
-- Table structure for table `invlogs`
--

CREATE TABLE `invlogs` (
  `INVLogEntry_ID` int(11) NOT NULL,
  `INVLogDateTime` datetime NOT NULL,
  `INVLogAction` varchar(255) NOT NULL,
  `INVLogLocation` varchar(255) NOT NULL,
  `INVLogItems` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `invlogs`
--

INSERT INTO `invlogs` (`INVLogEntry_ID`, `INVLogDateTime`, `INVLogAction`, `INVLogLocation`, `INVLogItems`) VALUES
(1, '2022-11-13 11:14:19', 'Added', 'Item Stock', 'Gatorade Cool Blue 20oz'),
(2, '2022-11-13 11:14:19', 'Added', 'Item Stock', 'Nature Spring Purified Water 500ml'),
(3, '2022-11-13 11:30:24', 'Edited', 'Item Setting', 'Wilkins Drinking Water');

-- --------------------------------------------------------

--
-- Table structure for table `poslogs`
--

CREATE TABLE `poslogs` (
  `POSLogEntry_ID` int(11) NOT NULL,
  `POSLogDateTime` datetime NOT NULL,
  `POSLogItems` varchar(255) NOT NULL,
  `POSLogQty` int(11) NOT NULL,
  `POSLogPrice` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `poslogs`
--

INSERT INTO `poslogs` (`POSLogEntry_ID`, `POSLogDateTime`, `POSLogItems`, `POSLogQty`, `POSLogPrice`) VALUES
(12, '2022-11-13 11:14:19', 'Gatorade Cool Blue 20oz', 2, 330),
(13, '2022-11-13 11:14:19', 'Nature Spring Purified Water 500ml', 5, 50),
(14, '2022-11-13 11:30:24', 'Wilkins Drinking Water', 2, 52),
(15, '2022-11-13 11:30:24', 'Evian Natural Mineral Water 1L', 1, 92),
(16, '2022-11-13 11:31:02', 'Gatorade Orange', 1, 707),
(17, '2022-11-13 11:40:07', 'Nescafe Coffee Brown 500gm', 1, 800),
(18, '2022-11-20 21:49:10', 'Nestle Milo Budget Pack', 1, 186);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `employee_id` (`employee_id`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`Product_ID`),
  ADD UNIQUE KEY `Product_Name` (`Product_Name`);

--
-- Indexes for table `invlogs`
--
ALTER TABLE `invlogs`
  ADD PRIMARY KEY (`INVLogEntry_ID`);

--
-- Indexes for table `poslogs`
--
ALTER TABLE `poslogs`
  ADD PRIMARY KEY (`POSLogEntry_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `Product_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `invlogs`
--
ALTER TABLE `invlogs`
  MODIFY `INVLogEntry_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `poslogs`
--
ALTER TABLE `poslogs`
  MODIFY `POSLogEntry_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
