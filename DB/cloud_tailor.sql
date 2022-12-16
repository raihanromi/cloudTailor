-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 16, 2022 at 09:02 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cloud_tailor`
--

-- --------------------------------------------------------

--
-- Table structure for table `c_products`
--

CREATE TABLE `c_products` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `p_type` varchar(255) NOT NULL,
  `p_desc` varchar(255) NOT NULL,
  `p_title` varchar(100) NOT NULL,
  `p_price` varchar(100) NOT NULL,
  `p_imgurl` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `c_products`
--

INSERT INTO `c_products` (`order_id`, `user_id`, `p_type`, `p_desc`, `p_title`, `p_price`, `p_imgurl`) VALUES
(1, 1, 'readymadedress', 'blue color,size:30,materila:3', 'WOMEN DRESS', '900', 'IMG-6394e91a887900.69874536.jpg'),
(3, 1, 'readymadedress', 'new dress', 'WOMEN DRESS 1', '100', 'IMG-6394e95e7f6a42.52653403.jpg'),
(4, 1, 'readymadedress', 'pink color,size:30,materila:3', 'WOMEN DRESS', '1000', 'IMG-6394e8c4535754.96923881.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_type` varchar(255) NOT NULL,
  `product_desc` varchar(255) NOT NULL,
  `product_price` varchar(255) NOT NULL,
  `product_img` varchar(255) NOT NULL,
  `product_title` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_type`, `product_desc`, `product_price`, `product_img`, `product_title`) VALUES
(8, 'readymadedress', 'pink color,size:30,materila:3', '1000', 'IMG-6394e8c4535754.96923881.jpg', 'WOMEN DRESS'),
(9, 'readymadedress', 'blue color,size:30,materila:3', '900', 'IMG-6394e91a887900.69874536.jpg', 'WOMEN DRESS'),
(10, 'readymadedress', 'new dress', '100', 'IMG-6394e95e7f6a42.52653403.jpg', 'WOMEN DRESS 1');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`) VALUES
(1, 'raihan', 'raihansarker98@gmail.com', '$2y$10$tHdZqsnPGF8xoWQbCLniS.E6vewqA70uoy218eFal25LavHbvHa0O'),
(3, 'r', 'dragneel728@gmail.com', '$2y$10$I0yB6kSzzk.MaCVTqcTIIuCDYvZG1FKDLdXi5BFmEC6NNwzdso/1S'),
(4, 'admin', 'admin@example.com', '$2y$10$nPFcr8sJbXBlCc85f4zlo.CSBqnUV1neoi9AdntkwSE8aiK.b5xPy');

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `info_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`info_id`, `user_id`, `name`, `phone_number`, `address`) VALUES
(1, 1, 'Raihan Romi', '01723029189', 'Haji camp, airport to prembagan road');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `c_products`
--
ALTER TABLE `c_products`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `test` (`user_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`info_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `c_products`
--
ALTER TABLE `c_products`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `info_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `c_products`
--
ALTER TABLE `c_products`
  ADD CONSTRAINT `test` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
