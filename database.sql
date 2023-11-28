-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 15, 2023 at 06:19 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `construction`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`) VALUES
(2);

-- --------------------------------------------------------

--
-- Table structure for table `citizan`
--

CREATE TABLE `citizan` (
  `id` int(11) NOT NULL,
  `cin` varchar(15) NOT NULL,
  `birthDate` date NOT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `address` varchar(150) NOT NULL,
  `phoneNumber` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `citizan`
--

INSERT INTO `citizan` (`id`, `cin`, `birthDate`, `gender`, `address`, `phoneNumber`) VALUES
(1, 'X478987', '1990-05-05', 'Female', '123 Main St, Anytown USA', '+212698985847'),
(3, 'A4758695', '1995-01-01', 'Female', '789 Oak St, Anytown USA', '+212635259874');

-- --------------------------------------------------------

--
-- Table structure for table `demand`
--

CREATE TABLE `demand` (
  `id` int(11) NOT NULL,
  `idCitizan` int(11) NOT NULL,
  `idAdmin` int(11) NOT NULL,
  `typeConstruction` enum('Cafe','House','Residance') DEFAULT NULL,
  `space` float NOT NULL,
  `state` enum('Processing','Accepted','Rejected') NOT NULL,
  `address` varchar(150) NOT NULL,
  `dateDeclared` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `demand`
--

INSERT INTO `demand` (`id`, `idCitizan`, `idAdmin`, `typeConstruction`, `space`, `state`, `address`, `dateDeclared`) VALUES
(3, 1, 2, 'Cafe', 120, 'Processing', 'Agdal, rabat', '2023-11-15 17:12:05'),
(6, 1, 2, 'House', 70, 'Accepted', 'Agdal, avenu ansar, Rabat.', '2023-11-15 17:12:56'),
(7, 1, 2, 'Residance', 95, 'Rejected', 'Al manal, Rabat', '2023-11-15 17:13:01'),
(9, 3, 2, 'House', 100, 'Processing', 'Al joulan, Rabat', '2023-11-15 17:14:08'),
(11, 3, 2, 'Cafe', 98, 'Accepted', 'Bab chellah, Rabat.', '2023-11-15 17:14:33'),
(12, 3, 2, 'Residance', 96, 'Rejected', 'Al joulan, Rabat', '2023-11-15 17:14:39');

-- --------------------------------------------------------

--
-- Table structure for table `discussion`
--

CREATE TABLE `discussion` (
  `idDemand` int(11) NOT NULL,
  `message` varchar(150) NOT NULL,
  `sens` enum('AC','CA') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `discussion`
--

INSERT INTO `discussion` (`idDemand`, `message`, `sens`) VALUES
(7, 'I Wonder why my demand got rejected, even though I am eligible!', 'CA'),
(12, 'Rejected? why?', 'CA'),
(7, 'There was missing information in your application, please consider reapplying!', 'AC'),
(12, 'Due to the violation of the first act concerning previous taxes!', 'AC');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `firstName`, `lastName`, `email`, `password`) VALUES
(1, 'Alice', 'Anderson', 'alice.anderson@example.com', '$2y$10$Q6btmqisnsPoEeH/EmUcs.5M.TCJoUX4eQXCNlULbtBYaueGKNFa2'),
(2, 'Bob', 'Brown', 'bob.brown@example.com', '$2y$10$Q6btmqisnsPoEeH/EmUcs.5M.TCJoUX4eQXCNlULbtBYaueGKNFa2'),
(3, 'Charlie', 'Clark', 'charlie.clark@example.com', '$2y$10$Q6btmqisnsPoEeH/EmUcs.5M.TCJoUX4eQXCNlULbtBYaueGKNFa2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `citizan`
--
ALTER TABLE `citizan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQUE_CIN` (`cin`);

--
-- Indexes for table `demand`
--
ALTER TABLE `demand`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_CITIZAN_DEMAND` (`idCitizan`),
  ADD KEY `FK_CITIZAN_ADMIN` (`idAdmin`);

--
-- Indexes for table `discussion`
--
ALTER TABLE `discussion`
  ADD KEY `FK_DISCUSSION_DEMAND` (`idDemand`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQUE_EMAIL` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `demand`
--
ALTER TABLE `demand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `FK_USER_ADMIN` FOREIGN KEY (`id`) REFERENCES `user` (`id`);

--
-- Constraints for table `citizan`
--
ALTER TABLE `citizan`
  ADD CONSTRAINT `FK_USER_CITIZAN` FOREIGN KEY (`id`) REFERENCES `user` (`id`);

--
-- Constraints for table `demand`
--
ALTER TABLE `demand`
  ADD CONSTRAINT `FK_CITIZAN_ADMIN` FOREIGN KEY (`idAdmin`) REFERENCES `admin` (`id`),
  ADD CONSTRAINT `FK_CITIZAN_DEMAND` FOREIGN KEY (`idCitizan`) REFERENCES `citizan` (`id`);

--
-- Constraints for table `discussion`
--
ALTER TABLE `discussion`
  ADD CONSTRAINT `FK_DISCUSSION_DEMAND` FOREIGN KEY (`idDemand`) REFERENCES `demand` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
