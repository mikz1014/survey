-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 12, 2024 at 02:37 PM
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
-- Database: `surveydb`
--

-- --------------------------------------------------------

--
-- Table structure for table `questionare`
--

CREATE TABLE `questionare` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `age` int(11) NOT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `question1` varchar(11) NOT NULL,
  `question2` varchar(11) NOT NULL,
  `question3` varchar(11) NOT NULL,
  `question4` varchar(11) NOT NULL,
  `question5` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `questionare`
--

INSERT INTO `questionare` (`id`, `name`, `age`, `gender`, `question1`, `question2`, `question3`, `question4`, `question5`) VALUES
(48, 'Genaro P. Lor', 49, 'Male', 'Array', 'Array', 'Array', 'Array', 'Array'),
(49, 'Genaro P. Lor', 49, 'Male', 'always', 'always', 'always', 'always', 'always'),
(50, 'Genaro P. Lor', 50, 'Male', 'Always', 'Always', 'Always', 'Never', 'Never'),
(51, 'Marain Navarro', 18, 'Female', 'Always', 'Always', 'Always', 'Always', 'Never'),
(52, 'Marain Navarro', 18, 'Female', 'Always', 'Always', 'Always', 'Always', 'Never'),
(53, 'Marain Navarro', 18, 'Female', 'Always', 'Always', 'Always', 'Always', 'Never'),
(54, 'Marain Navarro', 18, 'Female', 'Always', 'Always', 'Always', 'Always', 'Never'),
(55, 'Marain Navarro', 18, 'Female', 'Always', 'Always', 'Always', 'Always', 'Never'),
(56, 'Marain Navarro', 18, 'Female', 'Always', 'Always', 'Always', 'Always', 'Never'),
(57, 'Marain Navarro', 18, 'Female', 'Always', 'Always', 'Always', 'Always', 'Never'),
(58, 'Marain Navarro', 18, 'Female', 'Always', 'Always', 'Always', 'Always', 'Never'),
(59, 'Marain Navarro', 18, 'Female', 'Always', 'Always', 'Always', 'Always', 'Never'),
(60, 'Marain Navarro', 18, 'Female', 'Always', 'Always', 'Always', 'Always', 'Never'),
(61, 'Marain Navarro', 18, 'Female', 'Always', 'Always', 'Always', 'Always', 'Never'),
(62, 'Marain Navarro', 18, 'Female', 'Always', 'Always', 'Always', 'Always', 'Never'),
(63, 'Marain Navarro', 18, 'Female', 'Always', 'Always', 'Always', 'Always', 'Never'),
(64, 'Marain Navarro', 18, 'Female', 'Always', 'Always', 'Always', 'Always', 'Never'),
(65, 'Marain Navarro', 18, 'Female', 'Always', 'Always', 'Always', 'Always', 'Never'),
(66, 'Marain Navarro', 18, 'Female', 'Always', 'Always', 'Always', 'Always', 'Never'),
(67, 'Marain Navarro', 18, 'Female', 'Always', 'Always', 'Always', 'Always', 'Never'),
(68, 'Marain Navarro', 18, 'Female', 'Always', 'Always', 'Always', 'Always', 'Never'),
(69, 'Marain Navarro', 18, 'Female', 'Always', 'Always', 'Always', 'Always', 'Never'),
(70, 'Marain Navarro', 18, 'Female', 'Always', 'Always', 'Always', 'Always', 'Never'),
(71, 'Khanyao Lor', 19, 'Male', 'Always', 'Always', 'Always', 'Always', 'Always'),
(72, 'Khanyao Lor', 20, 'Male', 'Always', 'Always', 'Always', 'Always', 'Always'),
(73, 'Khanyao Lor', 20, 'Male', 'Always', 'Always', 'Always', 'Always', 'Always'),
(74, 'Khanyao Lor', 20, 'Male', 'Always', 'Always', 'Always', 'Always', 'Always'),
(75, 'Khanyao Lor', 20, 'Male', 'Always', 'Always', 'Always', 'Always', 'Always'),
(76, 'Khanyao Lor', 20, 'Male', 'Always', 'Always', 'Always', 'Always', 'Always'),
(77, 'Khanyao Lor', 20, 'Male', 'Always', 'Always', 'Always', 'Always', 'Always'),
(78, 'mikko geverola', 20, 'Male', 'Always', 'Never', 'Never', 'Always', 'Always'),
(79, 'lea', 20, 'Male', 'Always', 'Always', 'Always', 'Always', 'Always');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `questionare`
--
ALTER TABLE `questionare`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `questionare`
--
ALTER TABLE `questionare`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

