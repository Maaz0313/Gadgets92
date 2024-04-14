-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 14, 2024 at 07:39 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gadgets92`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` varchar(25) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `username`, `password`, `role`, `created_at`) VALUES
(1, 'maaz', 'maaz', 'admin', '2024-02-22 17:24:41');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `brand_id` int NOT NULL,
  `brand_name` varchar(150) NOT NULL,
  `cat_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`brand_id`, `brand_name`, `cat_id`) VALUES
(1, 'Samsung', 1),
(2, 'Nokia', 1),
(3, 'Oppo', 1),
(4, 'Vivo', 1),
(5, 'Tecno', 1),
(6, 'Xiamo', 1),
(7, 'Motorola', 1),
(8, 'Sony', 1),
(9, 'Realme', 1),
(10, 'Redmi', 1),
(11, 'Poco', 1),
(12, 'TCL', 5),
(13, 'Haier', 5),
(14, 'Orient', 5),
(15, 'HP', 2),
(16, 'LG', 5);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int NOT NULL,
  `cat_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_name`) VALUES
(1, 'mobiles'),
(2, 'laptops'),
(3, 'headsets'),
(4, 'smart watches'),
(5, 'televisions');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `headset_specs`
--

CREATE TABLE `headset_specs` (
  `spec_id` int NOT NULL,
  `product_id` int NOT NULL,
  `model` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `design` varchar(100) NOT NULL,
  `connectivity` varchar(100) NOT NULL,
  `wireless_range` varchar(50) NOT NULL,
  `in_the_box` varchar(100) NOT NULL,
  `driver` varchar(50) NOT NULL,
  `frequency_response` varchar(50) NOT NULL,
  `bluetooth` varchar(50) NOT NULL,
  `controls` varchar(50) NOT NULL,
  `control_features` varchar(100) NOT NULL,
  `built-in_mic` tinyint(1) NOT NULL,
  `water_resistant` tinyint(1) NOT NULL,
  `additional_features` varchar(120) NOT NULL,
  `battery_life` varchar(100) NOT NULL,
  `charging_port` varchar(100) NOT NULL,
  `charging_time` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `laptop_specs`
--

CREATE TABLE `laptop_specs` (
  `spec_id` int NOT NULL,
  `product_id` int NOT NULL,
  `model` varchar(100) NOT NULL,
  `os` varchar(100) NOT NULL,
  `touch_screen` tinyint(1) NOT NULL,
  `screen_size` varchar(25) NOT NULL,
  `screen_resolution` varchar(55) NOT NULL,
  `display` varchar(50) NOT NULL,
  `display_features` varchar(100) NOT NULL,
  `processor` varchar(100) NOT NULL,
  `processor_variant` varchar(50) NOT NULL,
  `graphics` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `clock_speed` varchar(150) NOT NULL,
  `cores` varchar(100) NOT NULL,
  `cache` varchar(6) NOT NULL,
  `sys_arch` varchar(50) NOT NULL,
  `ram` varchar(50) NOT NULL,
  `ram_frequency` varchar(50) NOT NULL,
  `ssd_storage` varchar(50) NOT NULL,
  `hdd_storage` varchar(50) NOT NULL,
  `battery` varchar(50) NOT NULL,
  `power_supply` varchar(50) NOT NULL,
  `bluetooth` varchar(50) NOT NULL,
  `wifi` varchar(50) NOT NULL,
  `ethernet_port` varchar(50) NOT NULL,
  `usb_port` varchar(50) NOT NULL,
  `hdmi_port` varchar(50) NOT NULL,
  `headset_jack` varchar(50) NOT NULL,
  `webcam` tinyint(1) NOT NULL,
  `mic` tinyint(1) NOT NULL,
  `disk_drive` tinyint(1) NOT NULL,
  `keyboard` varchar(50) NOT NULL,
  `backlit_keyboard` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mobile_specs`
--

CREATE TABLE `mobile_specs` (
  `spec_id` int NOT NULL,
  `product_id` int NOT NULL,
  `release_date` date NOT NULL,
  `device_type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `sim` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `os` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `dimensions` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `weight` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `waterproof` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `build_material` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `colors` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `touch_screen` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `display` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `screen_size` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `screen_resolution` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `bezel_less_display` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `screen_protection` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `rear_camera` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `sensor` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `flash` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `rear_video_recording` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `rear_features` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `front_camera` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `ram` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `chipset` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `gpu` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `cpu_cores` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `internal_storage` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `sd_card_slot` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `battery` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `fast_charging` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `network_support` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `bluetooth` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `wifi` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `usb` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `gps` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nfc` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `audio_jack` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `fm_radio` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `loud_speaker` tinyint(1) NOT NULL,
  `fingerprint_sensor` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `other_sensors` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int NOT NULL,
  `category_id` int NOT NULL,
  `brand_id` int NOT NULL,
  `product_name` varchar(150) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `product_image` varchar(150) NOT NULL,
  `release_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sm_watch_specs`
--

CREATE TABLE `sm_watch_specs` (
  `spec_id` int NOT NULL,
  `product_id` int NOT NULL,
  `dial_shape` varchar(50) NOT NULL,
  `bluetooth` tinyint(1) NOT NULL,
  `gps` tinyint(1) NOT NULL,
  `call_function` tinyint(1) NOT NULL,
  `notification` tinyint(1) NOT NULL,
  `wifi` varchar(50) NOT NULL,
  `sensors` varchar(255) NOT NULL,
  `battery_type` varchar(100) NOT NULL,
  `battery_life` varchar(100) NOT NULL,
  `touchscreen` tinyint(1) NOT NULL,
  `display` varchar(100) NOT NULL,
  `screen_size` varchar(50) NOT NULL,
  `os` varchar(50) NOT NULL,
  `fitness_features` varchar(255) NOT NULL,
  `features` varchar(200) NOT NULL,
  `extra_features` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tv_specs`
--

CREATE TABLE `tv_specs` (
  `spec_id` int NOT NULL,
  `product_id` int NOT NULL,
  `model` varchar(20) NOT NULL,
  `launch_year` int NOT NULL,
  `in_the_box` text NOT NULL,
  `weight_with_stand` varchar(10) NOT NULL,
  `weight_without_stand` varchar(10) NOT NULL,
  `display` varchar(50) NOT NULL,
  `screen_size` varchar(50) NOT NULL,
  `screen_resolution` varchar(50) NOT NULL,
  `display_features` varchar(150) NOT NULL,
  `video_formats` varchar(50) NOT NULL,
  `audio_formats` varchar(100) NOT NULL,
  `no_of_speakers` tinyint(1) NOT NULL,
  `output_per_speaker` varchar(10) NOT NULL,
  `total_speaker_output` varchar(10) NOT NULL,
  `sound_tech` varchar(100) NOT NULL,
  `smart_tv` tinyint(1) NOT NULL,
  `os` varchar(50) NOT NULL,
  `internet_connectivity` varchar(50) NOT NULL,
  `bluetooth` tinyint(1) NOT NULL,
  `screen_mirroring` tinyint(1) NOT NULL,
  `preloaded_apps` varchar(150) NOT NULL,
  `voice_assistant` varchar(150) NOT NULL,
  `more_features` varchar(100) NOT NULL,
  `usb` varchar(100) NOT NULL,
  `hdmi` varchar(50) NOT NULL,
  `ethernet` tinyint(1) NOT NULL,
  `power_requirement` varchar(100) NOT NULL,
  `power_consumption` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(50) NOT NULL,
  `verify_token` varchar(191) NOT NULL,
  `verify_status` tinyint NOT NULL DEFAULT '0' COMMENT '0=no, 1=yes',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_reviews`
--

CREATE TABLE `user_reviews` (
  `id` int NOT NULL,
  `product_id` int NOT NULL,
  `user_id` int NOT NULL,
  `review_heading` varchar(50) NOT NULL,
  `review_summary` text NOT NULL,
  `created_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`brand_id`),
  ADD KEY `brands_ibfk_1` (`cat_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `headset_specs`
--
ALTER TABLE `headset_specs`
  ADD PRIMARY KEY (`spec_id`),
  ADD KEY `headset_specs_ibfk_1` (`product_id`);

--
-- Indexes for table `laptop_specs`
--
ALTER TABLE `laptop_specs`
  ADD PRIMARY KEY (`spec_id`),
  ADD KEY `laptop_specs_ibfk_1` (`product_id`);

--
-- Indexes for table `mobile_specs`
--
ALTER TABLE `mobile_specs`
  ADD PRIMARY KEY (`spec_id`),
  ADD KEY `mobile_specs_ibfk_1` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `products_ibfk_1` (`category_id`),
  ADD KEY `products_ibfk_2` (`brand_id`);

--
-- Indexes for table `sm_watch_specs`
--
ALTER TABLE `sm_watch_specs`
  ADD PRIMARY KEY (`spec_id`),
  ADD KEY `sm_watch_specs_ibfk_1` (`product_id`);

--
-- Indexes for table `tv_specs`
--
ALTER TABLE `tv_specs`
  ADD PRIMARY KEY (`spec_id`),
  ADD KEY `tv_specs_ibfk_1` (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_reviews`
--
ALTER TABLE `user_reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `user_reviews_ibfk_2` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `brand_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `headset_specs`
--
ALTER TABLE `headset_specs`
  MODIFY `spec_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `laptop_specs`
--
ALTER TABLE `laptop_specs`
  MODIFY `spec_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `mobile_specs`
--
ALTER TABLE `mobile_specs`
  MODIFY `spec_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `sm_watch_specs`
--
ALTER TABLE `sm_watch_specs`
  MODIFY `spec_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tv_specs`
--
ALTER TABLE `tv_specs`
  MODIFY `spec_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_reviews`
--
ALTER TABLE `user_reviews`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `brands`
--
ALTER TABLE `brands`
  ADD CONSTRAINT `brands_ibfk_1` FOREIGN KEY (`cat_id`) REFERENCES `categories` (`cat_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `headset_specs`
--
ALTER TABLE `headset_specs`
  ADD CONSTRAINT `headset_specs_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `laptop_specs`
--
ALTER TABLE `laptop_specs`
  ADD CONSTRAINT `laptop_specs_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mobile_specs`
--
ALTER TABLE `mobile_specs`
  ADD CONSTRAINT `mobile_specs_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`cat_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`brand_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sm_watch_specs`
--
ALTER TABLE `sm_watch_specs`
  ADD CONSTRAINT `sm_watch_specs_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tv_specs`
--
ALTER TABLE `tv_specs`
  ADD CONSTRAINT `tv_specs_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_reviews`
--
ALTER TABLE `user_reviews`
  ADD CONSTRAINT `user_reviews_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_reviews_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
