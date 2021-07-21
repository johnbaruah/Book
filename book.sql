-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 21, 2021 at 05:34 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `book`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `id` int(10) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `address` varchar(100) NOT NULL,
  `city` varchar(30) NOT NULL,
  `landmark` varchar(50) NOT NULL,
  `pin` varchar(7) NOT NULL,
  `state` varchar(30) NOT NULL,
  `country` varchar(30) NOT NULL,
  `contact_no` varchar(12) NOT NULL,
  `mail` varchar(30) NOT NULL,
  `pay_method` varchar(10) DEFAULT NULL,
  `buyer_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(10) NOT NULL,
  `buyer_id` int(10) NOT NULL,
  `product_id` int(10) NOT NULL,
  `quantity` int(10) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `buyer_id`, `product_id`, `quantity`) VALUES
(101, 1001, 57, 1);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(10) NOT NULL,
  `cat_name` varchar(30) NOT NULL,
  `cat_details` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `cat_name`, `cat_details`) VALUES
(1, 'old', 'You can sell your old books'),
(2, 'new', 'You can sell your new books');

-- --------------------------------------------------------

--
-- Table structure for table `placeorder`
--

CREATE TABLE `placeorder` (
  `id` int(10) NOT NULL,
  `fname` varchar(30) NOT NULL,
  `lname` varchar(30) NOT NULL,
  `address` varchar(100) NOT NULL,
  `city` varchar(30) NOT NULL,
  `landmark` varchar(30) NOT NULL,
  `pin` varchar(7) NOT NULL,
  `state` varchar(20) NOT NULL,
  `country` varchar(20) NOT NULL,
  `contact_no` varchar(20) NOT NULL,
  `mail` varchar(30) NOT NULL,
  `pay_method` varchar(10) NOT NULL,
  `p_id` int(10) NOT NULL,
  `buyer_id` int(10) NOT NULL,
  `seller_id` int(10) NOT NULL,
  `p_quantity` varchar(10) NOT NULL,
  `p_price` varchar(10) NOT NULL,
  `p_name` varchar(30) NOT NULL,
  `status` int(5) NOT NULL DEFAULT 0,
  `accept_reject` int(5) NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(10) NOT NULL,
  `seller_id` int(10) NOT NULL,
  `cat_name` varchar(30) NOT NULL,
  `p_name` varchar(30) NOT NULL,
  `p_author` varchar(30) NOT NULL,
  `p_publication` varchar(30) NOT NULL,
  `p_des` varchar(50) NOT NULL,
  `p_org_price` int(10) NOT NULL,
  `p_price` int(10) NOT NULL,
  `p_quantity` int(10) NOT NULL,
  `p_img1` varchar(30) NOT NULL,
  `p_img2` varchar(30) NOT NULL,
  `p_img3` varchar(30) NOT NULL,
  `crdate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `available` varchar(10) NOT NULL,
  `days` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `seller_id`, `cat_name`, `p_name`, `p_author`, `p_publication`, `p_des`, `p_org_price`, `p_price`, `p_quantity`, `p_img1`, `p_img2`, `p_img3`, `crdate`, `available`, `days`) VALUES
(56, 1001, 'old', 'java', 'john', '2019', 'dsv', 99, 888, 2, '1625676268cc.jpeg', '1625676268dd.jpg', '1625676268ee.jpeg', '2021-07-07 16:44:27', 'yes', '7'),
(57, 1001, 'new', 'csc', 'john', '2019', 'vd', 88, 66, 2, '1625676319cc.jpeg', '1625676319dd.jpeg', '1625676319ee.jpg', '2021-07-07 16:45:18', 'yes', '9'),
(58, 1001, 'new', 'Java n', 'Chetan Bhagat', '2017', 'cs', 88, 788, 2, '1625676382cc.jpg', '1625676382dd.jpeg', '1625676382ee.jpeg', '2021-07-07 16:46:21', 'yes', '8'),
(59, 1001, 'old', 'java', 'Peter Thill', '2019', 'good book', 77, 77, 2, '1625676431cc.jpeg', '1625676431dd.jpg', '1625676431ee.jpg', '2021-07-07 16:47:11', 'yes', '7');

-- --------------------------------------------------------

--
-- Table structure for table `seller_reg`
--

CREATE TABLE `seller_reg` (
  `id` int(10) NOT NULL,
  `name` varchar(30) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `contact_no` varchar(30) NOT NULL,
  `address` varchar(30) NOT NULL,
  `profile_img` varchar(50) NOT NULL,
  `pan_card` varchar(30) NOT NULL,
  `address_proof` varchar(30) NOT NULL,
  `password` varchar(60) NOT NULL,
  `verified` tinyint(2) DEFAULT NULL,
  `pin` int(10) NOT NULL,
  `crdate` timestamp NOT NULL DEFAULT current_timestamp(),
  `sell_permission` int(10) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `seller_reg`
--

INSERT INTO `seller_reg` (`id`, `name`, `lname`, `email`, `contact_no`, `address`, `profile_img`, `pan_card`, `address_proof`, `password`, `verified`, `pin`, `crdate`, `sell_permission`) VALUES
(1001, 'Admin', '', 'Admin@gmail.com', '', '', '', '1625676203aa.jpeg', '1625676203bb.jpeg', 'e3afed0047b08059d0fada10f400c1e5', 2, 0, '2021-07-02 07:59:01', 1),
(1002, 'JOHN', 'BARUAH', 'johnbaruah8@gmail.com', '7002555495', 'TIHU, NALBARI(ASSAM), INDIA', '', '', '', '3d02649f3da70297f58b01114347f820', 1, 781371, '2021-07-07 16:20:11', 0);

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE `subscribers` (
  `id` int(10) NOT NULL,
  `sub_email` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subscribers`
--

INSERT INTO `subscribers` (`id`, `sub_email`) VALUES
(1, 'johnbaruah8@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`id`),
  ADD KEY `buyer_id` (`buyer_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `placeorder`
--
ALTER TABLE `placeorder`
  ADD PRIMARY KEY (`id`),
  ADD KEY `buyer_id` (`buyer_id`),
  ADD KEY `p_id` (`p_id`),
  ADD KEY `seller_id` (`seller_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `seller_id` (`seller_id`);

--
-- Indexes for table `seller_reg`
--
ALTER TABLE `seller_reg`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `placeorder`
--
ALTER TABLE `placeorder`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `seller_reg`
--
ALTER TABLE `seller_reg`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1003;

--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `address_ibfk_1` FOREIGN KEY (`buyer_id`) REFERENCES `seller_reg` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `placeorder`
--
ALTER TABLE `placeorder`
  ADD CONSTRAINT `placeorder_ibfk_1` FOREIGN KEY (`buyer_id`) REFERENCES `seller_reg` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `placeorder_ibfk_2` FOREIGN KEY (`p_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `placeorder_ibfk_3` FOREIGN KEY (`seller_id`) REFERENCES `product` (`seller_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`seller_id`) REFERENCES `seller_reg` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
