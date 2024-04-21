-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 21, 2024 at 04:56 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `finalproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `bill`
--

CREATE TABLE `bill` (
  `ID` varchar(255) NOT NULL,
  `purchaseDate` date NOT NULL,
  `customerPhone` varchar(255) NOT NULL,
  `userEmail` varchar(255) NOT NULL,
  `totalProducts` int(11) NOT NULL,
  `totalPrice` float NOT NULL,
  `moneyReceived` float NOT NULL,
  `moneyBack` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `billdetails`
--

CREATE TABLE `billdetails` (
  `billID` varchar(255) NOT NULL,
  `productBarcodes` varchar(255) NOT NULL,
  `productNumber` int(11) NOT NULL,
  `totalPrice` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `phone` varchar(255) NOT NULL,
  `birthday` date NOT NULL,
  `fullName` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `isMale` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `barcodes` varchar(255) NOT NULL,
  `creationDate` date NOT NULL,
  `entryPrice` float NOT NULL,
  `price` float NOT NULL,
  `productName` varchar(255) NOT NULL,
  `productType` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `email` varchar(255) NOT NULL,
  `isLock` tinyint(1) NOT NULL,
  `isActivate` tinyint(1) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `fullName` varchar(255) NOT NULL,
  `isAdmin` tinyint(1) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`email`, `isLock`, `isActivate`, `picture`, `fullName`, `isAdmin`, `password`) VALUES
('admin@gmail.com', 1, 1, '\"x.png\"', 'Quach Gia Hao', 1, 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bill`
--
ALTER TABLE `bill`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`phone`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`barcodes`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
