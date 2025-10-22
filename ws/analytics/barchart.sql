-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 15, 2025 at 03:43 PM
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
-- Database: `barchart`
--

-- --------------------------------------------------------

--
-- Table structure for table `chart_data`
--

CREATE TABLE `chart_data` (
  `id` int(11) NOT NULL,
  `category` date NOT NULL,
  `value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chart_data`
--

INSERT INTO `chart_data` (`id`, `category`, `value`) VALUES
(1, '2024-03-25', 120),
(2, '2024-03-26', 150),
(3, '2024-03-27', 180),
(4, '2024-03-28', 200),
(5, '2024-03-29', 170),
(6, '2024-03-30', 190),
(7, '2024-03-31', 210);

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`id`, `name`, `start_date`, `end_date`) VALUES
(1, 'Alice Johnson', '2025-04-01', '2025-04-07'),
(2, 'Bob Smith', '2025-04-01', '2025-04-07'),
(3, 'Carla White', '2025-04-05', '2025-04-10'),
(4, 'David Lee', '2025-04-10', '2025-04-15'),
(5, 'Emma Green', '2025-04-01', '2025-04-07'),
(6, 'Frank Brown', '2025-04-12', '2025-04-20'),
(7, 'Grace Kim', '2025-04-15', '2025-04-18'),
(8, 'Henry Young', '2025-04-18', '2025-04-25'),
(9, 'Isla Moore', '2025-04-01', '2025-04-07'),
(10, 'Jack Wilson', '2025-04-01', '2025-04-07'),
(11, 'Karen Adams', '2025-04-03', '2025-04-09'),
(12, 'Liam Scott', '2025-04-10', '2025-04-20'),
(13, 'Mia Hill', '2025-04-01', '2025-04-07'),
(14, 'Nathan Clark', '2025-04-12', '2025-04-18'),
(15, 'Olivia Lewis', '2025-04-15', '2025-04-21'),
(16, 'Paul Walker', '2025-04-18', '2025-04-23'),
(17, 'Quinn Hall', '2025-04-05', '2025-04-10'),
(18, 'Riley Allen', '2025-04-06', '2025-04-12'),
(19, 'Sophia Wright', '2025-04-08', '2025-04-14'),
(20, 'Tom King', '2025-04-01', '2025-04-07'),
(21, 'Uma Diaz', '2025-04-01', '2025-04-07'),
(22, 'Victor Evans', '2025-04-09', '2025-04-13'),
(23, 'Wendy Collins', '2025-04-10', '2025-04-15'),
(24, 'Xander Hughes', '2025-04-15', '2025-04-19'),
(25, 'Yara Barnes', '2025-04-17', '2025-04-21'),
(26, 'Zack Reed', '2025-04-19', '2025-04-25'),
(27, 'Amy Powell', '2025-04-02', '2025-04-08'),
(28, 'Brian Foster', '2025-04-01', '2025-04-07'),
(29, 'Chloe Bryant', '2025-04-11', '2025-04-16'),
(30, 'Dylan Stone', '2025-04-03', '2025-04-09'),
(31, 'Alice', '2025-03-01', '2025-03-02'),
(32, 'Bob', '2025-03-01', '2025-03-03'),
(33, 'Charlie', '2025-03-02', '2025-03-04'),
(34, 'Alice', '2025-03-03', '2025-03-05'),
(35, 'David', '2025-03-03', '2025-03-05'),
(36, 'Emma', '2025-03-04', '2025-03-06'),
(37, 'Frank', '2025-03-04', '2025-03-06'),
(38, 'Grace', '2025-03-05', '2025-03-07'),
(39, 'Hannah', '2025-03-05', '2025-03-08'),
(40, 'Ian', '2025-03-06', '2025-03-09'),
(41, 'Jack', '2025-03-07', '2025-03-10'),
(42, 'Alice', '2025-03-07', '2025-03-10'),
(43, 'Karen', '2025-03-08', '2025-03-11'),
(44, 'Leo', '2025-03-09', '2025-03-12'),
(45, 'Mia', '2025-03-10', '2025-03-13'),
(46, 'Nina', '2025-03-11', '2025-03-14'),
(47, 'Oscar', '2025-03-11', '2025-03-14'),
(48, 'Paul', '2025-03-12', '2025-03-15'),
(49, 'Quincy', '2025-03-13', '2025-03-16'),
(50, 'Rachel', '2025-03-13', '2025-03-16'),
(51, 'Sam', '2025-03-14', '2025-03-17'),
(52, 'Tina', '2025-03-15', '2025-03-18'),
(53, 'Uma', '2025-03-15', '2025-03-19'),
(54, 'Victor', '2025-03-16', '2025-03-20'),
(55, 'Wendy', '2025-03-17', '2025-03-21'),
(56, 'Xander', '2025-03-18', '2025-03-22'),
(57, 'Yara', '2025-03-19', '2025-03-23'),
(58, 'Zane', '2025-03-20', '2025-03-24'),
(59, 'Bob', '2025-03-21', '2025-03-25'),
(60, 'Charlie', '2025-03-22', '2025-03-26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chart_data`
--
ALTER TABLE `chart_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chart_data`
--
ALTER TABLE `chart_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
