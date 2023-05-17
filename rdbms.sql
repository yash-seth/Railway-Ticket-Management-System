-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 11, 2021 at 10:56 AM
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
-- Database: `rdbms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `admin_name` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(2) NOT NULL,
  `mobile_no` varchar(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `regd_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `admin_name`, `dob`, `gender`, `mobile_no`, `email`, `password`, `regd_at`) VALUES
(2, 'Vinay', '2002-08-22', 'M', '7204375904', 'vinaysaloa@gmail.com', '$2y$10$/BdJkg1J0Q/JDiclwHigme0OG/50XGgGwEJXyQ/gCyKl1BZy3dRIa', '2021-05-03 11:15:12');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `receipt_no` int(11) NOT NULL,
  `ticket_no` int(11) NOT NULL,
  `paytype` varchar(50) NOT NULL,
  `bank` varchar(50) NOT NULL,
  `paid_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `ticket_no` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `train_no` int(11) NOT NULL,
  `class` varchar(15) NOT NULL,
  `doj` date NOT NULL,
  `fare` decimal(10,0) NOT NULL,
  `alloc_seat` varchar(15) NOT NULL,
  `PRN` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `trains`
--

CREATE TABLE `trains` (
  `train_no` int(11) NOT NULL,
  `train_name` varchar(50) NOT NULL,
  `source` varchar(50) NOT NULL,
  `destination` varchar(50) NOT NULL,
  `arr_time` time NOT NULL,
  `dep_time` time NOT NULL,
  `distance` int(11) NOT NULL,
  `no_of_seats` int(11) NOT NULL,
  `avlbl_seats` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `trains`
--

INSERT INTO `trains` (`train_no`, `train_name`, `source`, `destination`, `arr_time`, `dep_time`, `distance`, `no_of_seats`, `avlbl_seats`) VALUES
(2, 'SHATABDHI', 'BANGALORE', 'MUMBAI', '23:30:00', '13:25:00', 3800, 250, 238);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(2) NOT NULL,
  `mobile_no` varchar(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `regd_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `dob`, `gender`, `mobile_no`, `email`, `password`, `regd_at`) VALUES
(4, 'Vinay Moolya', '2002-08-22', 'M', '7204375902', 'vinaysalpa@gmail.com', '$2y$10$w9ugOGDCgdI32Hj.gXxYIO5aX8EzAgIl/SBK61jYW64OBXl3SD0RS', '2021-05-03 11:14:05'),
(5, 'Yash', '2002-06-20', 'M', '9878787094', 'yash123@gmail.com', '$2y$10$ppIcjhGa3DLNR.0DURn7uOAdA7uaN542LGEdeUorPlHidbCyHqqGO', '2021-05-03 11:21:01'),
(6, 'santosh', '2002-02-14', 'M', '9088897800', 'santosh123@gmail.com', '$2y$10$BYOcBM9I5fXSGr7xiVBePuzqBbLyP3hsWmqFWe47Au6Q66WkVWW1e', '2021-05-03 11:22:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`receipt_no`),
  ADD KEY `ticket_fk` (`ticket_no`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`ticket_no`),
  ADD KEY `user_fk` (`user_id`),
  ADD KEY `tno_fk` (`train_no`);

--
-- Indexes for table `trains`
--
ALTER TABLE `trains`
  ADD PRIMARY KEY (`train_no`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `receipt_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `ticket_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `trains`
--
ALTER TABLE `trains`
  MODIFY `train_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `ticket_fk` FOREIGN KEY (`ticket_no`) REFERENCES `tickets` (`ticket_no`);

--
-- Constraints for table `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `tno_fk` FOREIGN KEY (`train_no`) REFERENCES `trains` (`train_no`),
  ADD CONSTRAINT `user_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
