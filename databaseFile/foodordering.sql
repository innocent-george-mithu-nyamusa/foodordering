-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 13, 2021 at 12:12 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `foodordering`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_table`
--

CREATE TABLE `admin_table` (
  `id` int(11) NOT NULL,
  `admin_email` varchar(70) NOT NULL,
  `admin_password` varchar(70) NOT NULL,
  `admin_role` varchar(10) NOT NULL DEFAULT 'user',
  `name` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_table`
--

INSERT INTO `admin_table` (`id`, `admin_email`, `admin_password`, `admin_role`, `name`) VALUES
(1, 'admin@msufoodordering.com', '824682b7c01d5c745bb87d6b1b4308c1', 'admin', 'MackMill');

-- --------------------------------------------------------

--
-- Table structure for table `food_customer`
--

CREATE TABLE `food_customer` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `regnumber` varchar(9) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `user_amount` decimal(11,0) NOT NULL DEFAULT 0,
  `status` varchar(70) NOT NULL DEFAULT 'to_collect',
  `bank_name` varchar(150) NOT NULL DEFAULT 'N/A',
  `bank_slip_code` varchar(70) NOT NULL DEFAULT 'N/A',
  `deposit_date` varchar(10) NOT NULL DEFAULT 'N/A'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `food_customer`
--

INSERT INTO `food_customer` (`id`, `name`, `regnumber`, `email`, `password`, `phone`, `address`, `user_amount`, `status`, `bank_name`, `bank_slip_code`, `deposit_date`) VALUES
(1, 'chinyichacho', 'r1912990j', 'R1912990j@gmail.com', '824682b7c01d5c745bb87d6b1b4308c1', '+263778836946', '248 Samora Machel Marimba', '348', 'active', '', '', ''),
(2, 'innocent', 'R156278W', 'juiceup@mail.com', '824682b7c01d5c745bb87d6b1b4308c1', '+263773141650', 'Address 1 Mithu', '334', 'disabled', '', '', ''),
(3, 'tino', 'r1912990j', 'R1912990j@gmail.com', '824682b7c01d5c745bb87d6b1b4308c1', '0778836946', 'Address 1 Mithu', '900', 'disabled', '', '', ''),
(4, 'admin', 'R156278W', 'innocentnyamusa@gmail.com', '824682b7c01d5c745bb87d6b1b4308c1', '+263774959490', 'Address 1 Mithu', '6825', 'active', 'Steward ', '45677-90865-8765-8986', '2021-08-04'),
(5, 'godfrey', 'R156278W', 'innocent.nyamusa@uofzmail.uz.ac.zw', '824682b7c01d5c745bb87d6b1b4308c1', '+876 787 655 765', 'Address 1 Mithu', '900', 'active', '', '', ''),
(6, 'michael', 'R156278W', 'georgemithu@gmail.com', '824682b7c01d5c745bb87d6b1b4308c1', '+876 787 655 765', 'Address 1 Mithu', '208', 'active', '', '', ''),
(7, 'officer3', 'r1912990j', 'innocentnyamusa@gmail.com', '824682b7c01d5c745bb87d6b1b4308c1', '+263774959490', 'Address 1 Mithu', '900', 'active', '', '', ''),
(8, 'innocent', 'r142589z', 'mithu@gmail.com', '824682b7c01d5c745bb87d6b1b4308c1', '+876 787 655 765', 'Address 1 Mithu', '900', 'active', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `food_items`
--

CREATE TABLE `food_items` (
  `id` int(30) NOT NULL,
  `name` varchar(30) NOT NULL,
  `price` int(30) NOT NULL,
  `description` varchar(200) NOT NULL,
  `images` varchar(200) NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'ENABLE',
  `meal_type` varchar(100) NOT NULL,
  `meal_chef` varchar(150) NOT NULL,
  `meal_ingredients` varchar(200) NOT NULL,
  `meal_place` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `food_items`
--

INSERT INTO `food_items` (`id`, `name`, `price`, `description`, `images`, `status`, `meal_type`, `meal_chef`, `meal_ingredients`, `meal_place`) VALUES
(29, 'Baahhulali Thali', 90, 'The special thali has papad, two types of chutney and pickles, salad, one steamed and one fried farsan, four different types of vegetable dishes and one special dish of the day.', 'Baahubali_Thali.jpg', 'ENABLE', 'Breakfast', 'Chef 1', 'papad, two types of chutney and pickles, salad, one steamed and one fried farsan', 'japan'),
(30, 'Burger', 36, 'Hamburger, a burger consisting of one or more cooked patties of ground beef, placed inside a sliced bread roll or bun.', 'burger.jpg', 'ENABLE', 'Lunch', 'Chef 2', 'bun, Cheese, Ham', 'china');

-- --------------------------------------------------------

--
-- Table structure for table `food_orders`
--

CREATE TABLE `food_orders` (
  `id` int(30) NOT NULL,
  `item_id` int(30) NOT NULL,
  `name` varchar(30) NOT NULL,
  `price` int(30) NOT NULL,
  `quantity` int(30) NOT NULL,
  `order_date` date NOT NULL,
  `order_id` varchar(50) NOT NULL,
  `status` varchar(70) NOT NULL DEFAULT 'to_collect',
  `order_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `order_client_name` varchar(150) NOT NULL,
  `order_client_id` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `food_orders`
--

INSERT INTO `food_orders` (`id`, `item_id`, `name`, `price`, `quantity`, `order_date`, `order_id`, `status`, `order_time`, `order_client_name`, `order_client_id`) VALUES
(76, 3, 'Burger', 36, 4, '2021-08-06', '900221481867929732', 'to_collect', '2021-08-06 08:57:22', 'innocent', '2'),
(77, 27, 'Hamburger', 566, 1, '2021-08-08', '988998884042378872', 'to_collect', '2021-08-08 17:19:45', 'innocent', '2'),
(78, 27, 'Hamburger', 566, 1, '2021-08-09', '732119861464533492', 'to_collect', '2021-08-09 13:28:48', 'innocent', '2');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `id` int(11) NOT NULL,
  `ref` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`id`, `ref`) VALUES
(1, 'f2972b2e-dade-4f1c-8c1e-4f07217b7ff9'),
(2, '2ab7a8d9-3aec-41a2-b874-a144c74a59db');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_table`
--
ALTER TABLE `admin_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `food_customer`
--
ALTER TABLE `food_customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `food_items`
--
ALTER TABLE `food_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `food_orders`
--
ALTER TABLE `food_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_table`
--
ALTER TABLE `admin_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `food_customer`
--
ALTER TABLE `food_customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `food_items`
--
ALTER TABLE `food_items`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `food_orders`
--
ALTER TABLE `food_orders`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
