-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 25, 2023 at 06:34 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `todolistdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `note`
--

CREATE TABLE `note` (
  `note_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `note_title` varchar(255) NOT NULL,
  `note_body` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `note`
--

INSERT INTO `note` (`note_id`, `user_id`, `note_title`, `note_body`) VALUES
(1, 2, 'subjects', 'P,e\r\nInformation Management\r\nQM\r\nOOP\r\nData COmm\r\nNET'),
(2, 2, 'chores', '-manghugas\r\n-manglimpyo\r\n-maligo\r\n-code\r\n-matug'),
(3, 2, 'some note title', 'lorem imspum wakakeoko kawok\r\nawokdokwa dasdmm \r\nawkorwe dlskaj n,zmns \r\n6969dsadasyesssir'),
(4, 2, 'to do', '-eat\r\n-exercise\r\n-code\r\n-cry\r\n-sleep\r\n'),
(5, 2, 'Lorem ipsum', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamc tae'),
(7, 3, 'Lorem ipsum dolor ', 'Nisl rhoncus mattis rhoncus urna neque viverra justo nec ultrices. Eget est lorem ipsum dolor sit amet consectetur adipiscing. ');

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `task_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `task_name` varchar(255) NOT NULL,
  `task_status` varchar(20) NOT NULL,
  `task_priority` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`task_id`, `user_id`, `task_name`, `task_status`, `task_priority`) VALUES
(10, 2, 'code', 'done', 'low'),
(12, 2, ' LOREM IPSUM ASD FAKLKD WAOkWOQE M<>NMNkajh AjiwjddE', 'pending', 'low'),
(13, 2, 'Sleep', 'pending', 'favorite'),
(14, 2, 'Exercise', 'pending', 'favorite'),
(15, 2, 'drink water', 'pending', 'low'),
(16, 3, 'stare at the wall', 'pending', 'low'),
(17, 3, 'code', 'pending', 'low'),
(18, 3, 'maligo', 'done', 'low'),
(20, 3, ' dssddd', 'pending', 'low'),
(21, 2, ' eat rice and ', 'pending', 'low');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_pass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_email`, `user_name`, `user_pass`) VALUES
(2, 'joren@e.com', 'joren 123', '123'),
(3, 'epoy@email.com', 'Jebe inoc', '123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `note`
--
ALTER TABLE `note`
  ADD PRIMARY KEY (`note_id`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`task_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `note`
--
ALTER TABLE `note`
  MODIFY `note_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
