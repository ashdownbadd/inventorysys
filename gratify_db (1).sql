-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 13, 2024 at 01:12 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gratify_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin_credentials`
--

CREATE TABLE `tbl_admin_credentials` (
  `id` int(11) NOT NULL,
  `last_name` varchar(200) NOT NULL,
  `first_name` varchar(200) NOT NULL,
  `middle_name` varchar(200) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_admin_credentials`
--

INSERT INTO `tbl_admin_credentials` (`id`, `last_name`, `first_name`, `middle_name`, `username`, `password`, `email`) VALUES
(1, 'admin', 'admin', 'admin', 'admin', '$2y$10$lvBXIolFQqmeHJzhjo06BOsa5UiUtE42w78ziu9tdhghlR/Ynswzu', 'try@gmail.com'),
(2, 'lastica', 'mark', 'aldrin', 'user', 'user', ''),
(5, 'newonly', 'newonly', 'newonly', 'newonly', '$2y$10$wn3pCl3.VPv7l8MKsx5gxe/EyKIdNYQxGciZiP4ezyLGpzTQG5yUa', ''),
(6, 'pogi', 'miguelfranz', '321e', '321e', '$2y$10$hALq9R0y0kCairlanN3xv.cNpkiyBWaY.9CEGzzY7yBz2ii5sIBKa', ''),
(7, 'b1322', 'b132', 'b132', 'b132', '$2y$10$XBB5l.kcy/yrjH1Y/jWr1.LS8hJP.4WLtbn/hKmxS2iJWAkmdfDH.', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_categories`
--

CREATE TABLE `tbl_categories` (
  `id` int(55) NOT NULL,
  `category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_categories`
--

INSERT INTO `tbl_categories` (`id`, `category`) VALUES
(1, 'Mug'),
(2, 'ID Lace'),
(3, 'Tarpaulin'),
(4, 'Tote Bag'),
(5, 'Jersey'),
(6, 'T Shirt');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_inventory`
--

CREATE TABLE `tbl_inventory` (
  `id` int(255) NOT NULL,
  `item_img` varchar(255) NOT NULL,
  `item_category_id` int(255) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `item_code` varchar(255) NOT NULL,
  `item_size` varchar(255) NOT NULL,
  `item_color` varchar(255) NOT NULL,
  `item_price` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_inventory`
--

INSERT INTO `tbl_inventory` (`id`, `item_img`, `item_category_id`, `item_name`, `item_code`, `item_size`, `item_color`, `item_price`) VALUES
(1, 'imageupload/mug1.png', 1, 'Glass', 'FY123', 'Small', 'Red', 200),
(2, 'imageupload/amelia-pcwallpaper3.jpg', 1, 'ccc', 'cc', 'cc', 'cc', 0),
(3, 'imageupload/03_Bebefinn_still-image.jpg', 0, '44', '44', '44', '44', 44),
(4, 'imageupload/lownine-building-wall.jpg', 2, '1123123', '1123123', '1123123', '1123123', 12),
(5, 'imageupload/AAAABdkp0mHFkBCqc3efuyqTM6CXdkaxtXq7LNnXFOwXJIOTwF5HyqnF5FnlYYEUj4SagaKrJfL5VGtsNN_rwyk8Yuj-JfgC_6iwhXrM.jpg', 3, 'zxc', '1111', '1111', '1111', 1111),
(6, 'imageupload/image_1.jpg', 6, 'z11', '11', '11', '11', 11);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_notes`
--

CREATE TABLE `tbl_notes` (
  `id` int(55) NOT NULL,
  `notes` longtext NOT NULL,
  `notes_date` varchar(255) NOT NULL,
  `notes_time` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_notes`
--

INSERT INTO `tbl_notes` (`id`, `notes`, `notes_date`, `notes_time`) VALUES
(2, 'new', '', ''),
(3, 'zxc', '2024-04-13', '19:03:08');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_orders`
--

CREATE TABLE `tbl_orders` (
  `id` int(11) NOT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `supplier` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `ordered_by` varchar(255) DEFAULT NULL,
  `order_date` varchar(255) DEFAULT NULL,
  `order_deadline` varchar(255) DEFAULT NULL,
  `person_assigned` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_orders`
--

INSERT INTO `tbl_orders` (`id`, `product_name`, `quantity`, `supplier`, `status`, `ordered_by`, `order_date`, `order_deadline`, `person_assigned`) VALUES
(1, '123', 123, '123', '123', '123s', '123', '123', '123'),
(2, 'xzczc', 0, 'zxczc', 'zxczxc', 'zxczx', 'czxczxc', 'zxczxc', 'zxczc'),
(3, 'new', 1, 'new', 'new', 'new', 'new', 'new', 'new'),
(4, '4v21v4214', 4214214, '4v21v4214', '4v21v4214', '4v21v4214', '4v21v4214', '4v21v4214', '4v21v4214');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pos`
--

CREATE TABLE `tbl_pos` (
  `id` int(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `total_sold` int(255) NOT NULL,
  `total_sales` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_pos`
--

INSERT INTO `tbl_pos` (`id`, `product_name`, `status`, `total_sold`, `total_sales`) VALUES
(2, 'zxccxz', 'Incomplete', 11, 0),
(3, 'test', 'Pending', 11, 0),
(4, 'newzxc', 'Complete', 123, 123);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_products`
--

CREATE TABLE `tbl_products` (
  `id` int(55) NOT NULL,
  `product_img` varchar(255) NOT NULL,
  `product_type` varchar(250) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_code` varchar(255) NOT NULL,
  `product_color` varchar(255) NOT NULL,
  `product_price` int(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_suppliers`
--

CREATE TABLE `tbl_suppliers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone_number` int(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `products` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_suppliers`
--

INSERT INTO `tbl_suppliers` (`id`, `name`, `phone_number`, `email`, `location`, `products`) VALUES
(1, 'Juan Dela Cruz', 0, 'juancruz@gmail.com', 'Block 66 st. Lot 6', ''),
(2, 'zxc', 123, '13213@gm', '123e', '123');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_credentials`
--

CREATE TABLE `tbl_user_credentials` (
  `id` int(100) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_user_credentials`
--

INSERT INTO `tbl_user_credentials` (`id`, `last_name`, `first_name`, `middle_name`, `email`, `username`, `password`, `position`) VALUES
(2, 'newasd', 'newasd', 'newasd', 'newasd@43242', '123123', '$2y$10$K5GGXdmxYMX14j5fEzkk.u5T2eDOT6yymU6.rp1jGsmwmS5lvrCmC', ''),
(3, 'zxczxc', 'zxczxc', 'zxczxc', 'zxczxc@54242', 'zxczxc', '$2y$10$ezLTHQVpjJu6ZYBg.LBLWOI27XF1FThYv..g5wVPS5CrATpLlOe1u', 'test');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin_credentials`
--
ALTER TABLE `tbl_admin_credentials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_categories`
--
ALTER TABLE `tbl_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_inventory`
--
ALTER TABLE `tbl_inventory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_notes`
--
ALTER TABLE `tbl_notes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_orders`
--
ALTER TABLE `tbl_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_pos`
--
ALTER TABLE `tbl_pos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_products`
--
ALTER TABLE `tbl_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_suppliers`
--
ALTER TABLE `tbl_suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user_credentials`
--
ALTER TABLE `tbl_user_credentials`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin_credentials`
--
ALTER TABLE `tbl_admin_credentials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_categories`
--
ALTER TABLE `tbl_categories`
  MODIFY `id` int(55) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_inventory`
--
ALTER TABLE `tbl_inventory`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_notes`
--
ALTER TABLE `tbl_notes`
  MODIFY `id` int(55) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_orders`
--
ALTER TABLE `tbl_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_pos`
--
ALTER TABLE `tbl_pos`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_products`
--
ALTER TABLE `tbl_products`
  MODIFY `id` int(55) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_suppliers`
--
ALTER TABLE `tbl_suppliers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_user_credentials`
--
ALTER TABLE `tbl_user_credentials`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
