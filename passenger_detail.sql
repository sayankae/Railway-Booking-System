-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 20, 2021 at 10:55 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `passenger_detail`
--

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(11) NOT NULL,
  `e_id` varchar(10) DEFAULT NULL,
  `e_password` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `e_id`, `e_password`) VALUES
(1, 'admin', 'admin'),
(2, 'admin2', 'admin2');

-- --------------------------------------------------------

--
-- Table structure for table `passenger`
--

CREATE TABLE `passenger` (
  `id` bigint(20) NOT NULL,
  `p_id` bigint(20) NOT NULL,
  `p_fname` varchar(30) DEFAULT NULL,
  `p_lname` varchar(30) DEFAULT NULL,
  `p_age` int(11) DEFAULT NULL,
  `p_contact` int(11) DEFAULT NULL,
  `p_gender` varchar(10) DEFAULT NULL,
  `p_email` varchar(100) NOT NULL,
  `p_password` varchar(10) NOT NULL,
  `p_message` text NOT NULL DEFAULT 'Empty'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `passenger`
--

INSERT INTO `passenger` (`id`, `p_id`, `p_fname`, `p_lname`, `p_age`, `p_contact`, `p_gender`, `p_email`, `p_password`, `p_message`) VALUES
(8, 36955437, 'Rahul', 'Sharma', 50, 78496812, 'Male', 'rahul@gmail.com', '123456789', 'Succesfully Ticket is booked. Please check the booked ticket section.'),
(9, 71025, 'Raju', 'Das', 29, 123456789, 'Male', 'rajudas@gmail.com', '123456789', 'Succesfully Ticket is booked. Please check the booked ticket section.'),
(13, 112060435769699762, 'Soni', 'Singh', 35, 123456789, 'Female', 'soni@gmail.com', '123456789', 'Succesfully Ticket is booked. Please check the booked ticket section.'),
(14, 42233358746025572, 'Kamla', 'Nath', 46, 789456123, 'Female', 'kamla@gmail.com', '789456123', 'Succesfully Ticket is booked. Please check the booked ticket section.'),
(15, 470597, 'Hemmant', 'Shikde', 39, 45484512, 'Male', 'yoyo@gmail.com', '123456789', 'Attention, Your Train is canceled due to some problem. We are sorry for your inconvinience. Refund will be sent within 10 days.'),
(16, 456465465, 'Rina', 'Rani', 49, 789789456, 'Female', 'rina@gmail.com', '123456789', 'Attention, Your Train is canceled due to some problem. We are sorry for your inconvinience. Refund will be sent within 10 days.');

-- --------------------------------------------------------

--
-- Table structure for table `station`
--

CREATE TABLE `station` (
  `id` int(11) NOT NULL,
  `st_name` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `station`
--

INSERT INTO `station` (`id`, `st_name`) VALUES
(5, 'Bangalore'),
(4, 'Chennai'),
(1, 'Delhi'),
(11, 'Gaya'),
(8, 'Guwahati'),
(7, 'Indore'),
(3, 'Kolkata'),
(2, 'Mumbai'),
(10, 'Prayagraj'),
(9, 'Pune');

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE `ticket` (
  `id` int(11) NOT NULL,
  `tc_pnr` int(11) NOT NULL,
  `p_id` varchar(20) NOT NULL,
  `t_id` varchar(10) NOT NULL,
  `tc_date` date NOT NULL,
  `tc_class` varchar(10) NOT NULL,
  `tc_seat` tinyint(4) NOT NULL,
  `tc_plat` int(11) DEFAULT NULL,
  `tc_price` int(11) NOT NULL,
  `tc_valid` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ticket`
--

INSERT INTO `ticket` (`id`, `tc_pnr`, `p_id`, `t_id`, `tc_date`, `tc_class`, `tc_seat`, `tc_plat`, `tc_price`, `tc_valid`) VALUES
(38, 608, '36955437 ', '23452E', '2021-04-27', 'AC1', 39, 8, 10300, 1),
(39, 99601112, '71025 ', '23452E', '2021-04-27', 'AC1', 1, 1, 10300, 1),
(40, 23358, '112060435769699762 ', '23679F', '2021-04-30', 'AC1', 23, 9, 10200, 1),
(41, 2147483647, '42233358746025572 ', '23679F', '2021-04-30', 'AC1', 11, 10, 10200, 1),
(43, 264293443, '470597 ', '2345789', '2021-04-29', 'Sleeper', 49, 8, 4760, 0),
(48, 456548, '456465465', '2345789', '2021-04-29', 'AC1', 32, 9, 8000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `train`
--

CREATE TABLE `train` (
  `id` int(11) NOT NULL,
  `t_id` varchar(100) NOT NULL,
  `t_name` varchar(100) NOT NULL,
  `t_from` varchar(100) NOT NULL,
  `t_to` varchar(100) NOT NULL,
  `t_dist` int(11) NOT NULL,
  `t_arr` time NOT NULL,
  `t_dest` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `train`
--

INSERT INTO `train` (`id`, `t_id`, `t_name`, `t_from`, `t_to`, `t_dist`, `t_arr`, `t_dest`) VALUES
(3, '23452E', 'Garibrath', 'Bangalore', 'Kolkata', 1030, '20:27:00', '21:27:00'),
(4, '23679F', 'Rajdhani Express', 'Delhi', 'Mumbai', 1020, '20:53:00', '22:53:00'),
(5, '2345789', 'Jammu Tawi', 'Guwahati', 'Delhi', 1400, '14:02:00', '15:02:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `e_id` (`e_id`);

--
-- Indexes for table `passenger`
--
ALTER TABLE `passenger`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `p_id` (`p_id`),
  ADD KEY `p_fname` (`p_fname`),
  ADD KEY `p_lname` (`p_lname`),
  ADD KEY `p_email` (`p_email`);

--
-- Indexes for table `station`
--
ALTER TABLE `station`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `st_name` (`st_name`),
  ADD KEY `st_name_2` (`st_name`);

--
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tc_pnr` (`tc_pnr`),
  ADD UNIQUE KEY `p_id_2` (`p_id`),
  ADD KEY `tc_pnr_2` (`tc_pnr`),
  ADD KEY `p_id` (`p_id`),
  ADD KEY `t_id` (`t_id`),
  ADD KEY `p_id_3` (`p_id`);

--
-- Indexes for table `train`
--
ALTER TABLE `train`
  ADD PRIMARY KEY (`id`),
  ADD KEY `t_id` (`t_id`),
  ADD KEY `t_name` (`t_name`),
  ADD KEY `t_from` (`t_from`),
  ADD KEY `t_to` (`t_to`),
  ADD KEY `t_dist` (`t_dist`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `passenger`
--
ALTER TABLE `passenger`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `station`
--
ALTER TABLE `station`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `train`
--
ALTER TABLE `train`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
