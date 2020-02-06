-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 06, 2020 at 11:39 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cake_msg`
--

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `to_id` int(11) NOT NULL,
  `from_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `to_id`, `from_id`, `content`, `created`, `modified`) VALUES
(1, 2, 3, 'hi this is john', '2020-02-04 09:00:00', '2020-02-04 09:00:00'),
(2, 3, 2, 'hello john i am jane', '2020-02-04 10:00:00', '2020-02-04 10:00:00'),
(3, 4, 20, 'aaaa', '2020-02-06 10:38:07', '2020-02-06 10:38:07'),
(4, 4, 20, 'aaaa', '2020-02-06 10:43:13', '2020-02-06 10:43:13'),
(5, 4, 20, 'asdasdasd', '2020-02-06 10:43:34', '2020-02-06 10:43:34'),
(6, 2, 20, 'asdasdasd', '2020-02-06 10:52:00', '2020-02-06 10:52:00'),
(7, 20, 2, 'from jane', '2020-02-06 10:52:00', '2020-02-06 10:52:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL COMMENT 'auto',
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL COMMENT 'unique',
  `password` varchar(255) NOT NULL,
  `image` varchar(50) DEFAULT NULL,
  `gender` char(1) DEFAULT NULL COMMENT '1=male, 2=female, null=not specified',
  `birthdate` date DEFAULT NULL,
  `hubby` text,
  `last_login_time` datetime NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `created_ip` varchar(20) NOT NULL COMMENT 'user ip address',
  `modified_ip` varchar(20) NOT NULL COMMENT 'user ip address'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `image`, `gender`, `birthdate`, `hubby`, `last_login_time`, `created`, `modified`, `created_ip`, `modified_ip`) VALUES
(2, 'jane', 'jane@email.com', '', NULL, '2', '2000-04-09', 'test text', '2020-02-04 00:00:00', '2020-02-04 00:00:00', '2020-02-04 00:00:00', '', ''),
(4, 'john doe', 'jd@email.com', 'password', '', '1', '2000-01-04', 'test', '2022-02-22 03:51:00', '2020-02-04 02:52:18', '2020-02-04 02:52:18', '', ''),
(3, 'john', 'john@email.com', '', NULL, '1', '1990-02-05', 'test text', '2020-02-04 00:00:00', '2020-02-04 00:00:00', '2020-02-04 00:00:00', '', ''),
(20, 'user123', 'user123@gmail.com', '2e0404c1c351fbaf8a348fe5d04548ea393b5255c70e2850c97aaf2c4f470337', 'Man-Silhouette.jpg', '1', '2020-02-14', 'asdasd', '2020-02-06 17:00:13', '2020-02-05 13:57:59', '2020-02-06 17:00:13', '::1', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sender` (`to_id`),
  ADD KEY `reciever` (`from_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'auto', AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `reciever` FOREIGN KEY (`from_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `sender` FOREIGN KEY (`to_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
