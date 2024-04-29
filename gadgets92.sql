-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 29, 2024 at 04:08 PM
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
(6, 'Xiaomi', 1),
(7, 'Motorola', 1),
(8, 'Sony', 1),
(9, 'Realme', 1),
(10, 'Redmi', 1),
(11, 'Poco', 1),
(12, 'TCL', 5),
(13, 'Haier', 5),
(14, 'Orient', 5),
(15, 'HP', 2),
(16, 'LG', 5),
(18, 'Dell', 2),
(19, 'Lenovo', 2),
(20, 'Acer', 2),
(21, 'Apple', 2),
(22, 'Samsung', 2),
(23, 'Asus', 2),
(24, 'Samsung', 5),
(25, 'Samsung', 4),
(27, 'Huawei', 4),
(28, 'Amazfit', 4),
(29, 'A4Tech', 3),
(30, 'Logitech', 3),
(31, 'HP', 3),
(32, 'Sony', 3),
(33, 'JBL', 3),
(34, 'boAt', 3);

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
  `in_the_box` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `driver` varchar(50) NOT NULL,
  `frequency_response` varchar(50) NOT NULL,
  `bluetooth` varchar(50) NOT NULL,
  `controls` varchar(50) NOT NULL,
  `control_features` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `built-in_mic` tinyint(1) NOT NULL,
  `water_resistant` tinyint(1) NOT NULL,
  `additional_features` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `battery_life` varchar(100) NOT NULL,
  `charging_port` varchar(100) NOT NULL,
  `charging_time` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `headset_specs`
--

INSERT INTO `headset_specs` (`spec_id`, `product_id`, `model`, `type`, `design`, `connectivity`, `wireless_range`, `in_the_box`, `driver`, `frequency_response`, `bluetooth`, `controls`, `control_features`, `built-in_mic`, `water_resistant`, `additional_features`, `battery_life`, `charging_port`, `charging_time`) VALUES
(2, 17, '2J875AA#ABL', 'Over The Ear', 'Headphone', 'Bluetooth v5.0', '10 m', 'Headset, USB-C charging cord, Quick Start poster, Warranty, Product notices', 'No Driver Unit', '20 Hz - 20 KHz', 'Yes, v5.0', 'Yes', 'Power on and off, Answer calls, Adjust volume, Voice Control, Charging status indicator', 1, 1, 'Digital Signal Processor: For clearer calls in noisy environments', 'Up to 20 hrs', 'USB Type-C', '3 hrs'),
(3, 4, 'WH-CH520', 'On the Ear', 'Headphone', 'Bluetooth v5.2', '10 m', '1 Headphone, USB Cable', '30 mm', '20 Hz - 20 KHz', 'Yes, v5.2', 'Yes', 'Play/Pause, Answer calls, Adjust volume, Voice Control, Forward, Backward, Skip tracks, Charging status indicator', 1, 0, 'Fast Charging, Pair with two Bluetooth devices simultaneously. Restores harmonics and liveliness lost during music compression using Digital Sound Enhancement Engine (DSEE)', 'Up to 40 hrs', 'USB Type-C', '3 hrs'),
(4, 18, 'Rockerz 235v2/238', 'In the Ear', 'Neckband', 'Bluetooth v5.0', '10 m', 'Rockerz 235v2, Additional Earbuds(S&amp;L), Ear Supporters, Micro USB Charging Cable, Manual, Warranty Card', '10 mm', '20 Hz - 20 KHz', 'Yes, v5.0', 'Yes', 'Play, Pause, Next, Prev, Answer/End Call, Voice Control', 1, 1, 'IPX5 sweat and water resistance, Call vibration alert', 'Up to 8 hrs', 'Micro USB', '20 min');

-- --------------------------------------------------------

--
-- Table structure for table `laptop_specs`
--

CREATE TABLE `laptop_specs` (
  `spec_id` int NOT NULL,
  `product_id` int NOT NULL,
  `model` varchar(100) NOT NULL,
  `os` varchar(100) NOT NULL,
  `dimensions` varchar(200) NOT NULL,
  `weight` varchar(100) NOT NULL,
  `colors` varchar(200) NOT NULL,
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
  `ram_memory` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `ram_type` varchar(100) NOT NULL,
  `ram_frequency` varchar(50) NOT NULL,
  `ssd_storage` varchar(50) NOT NULL,
  `hdd_storage` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'Not Present',
  `battery` varchar(50) NOT NULL,
  `power_supply` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `bluetooth` varchar(50) NOT NULL,
  `wifi` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `ethernet_port` varchar(50) NOT NULL,
  `usb_port` varchar(50) NOT NULL,
  `hdmi_port` varchar(50) NOT NULL,
  `multi_card_slot` varchar(200) NOT NULL,
  `headset_jack` varchar(50) NOT NULL,
  `webcam` tinyint(1) NOT NULL,
  `mic` tinyint(1) NOT NULL,
  `speakers` varchar(200) NOT NULL,
  `disk_drive` tinyint(1) NOT NULL,
  `keyboard` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `backlit_keyboard` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `laptop_specs`
--

INSERT INTO `laptop_specs` (`spec_id`, `product_id`, `model`, `os`, `dimensions`, `weight`, `colors`, `touch_screen`, `screen_size`, `screen_resolution`, `display`, `display_features`, `processor`, `processor_variant`, `graphics`, `clock_speed`, `cores`, `cache`, `sys_arch`, `ram_memory`, `ram_type`, `ram_frequency`, `ssd_storage`, `hdd_storage`, `battery`, `power_supply`, `bluetooth`, `wifi`, `ethernet_port`, `usb_port`, `hdmi_port`, `multi_card_slot`, `headset_jack`, `webcam`, `mic`, `speakers`, `disk_drive`, `keyboard`, `backlit_keyboard`) VALUES
(1, 3, '15s-FR5012TU', 'Windows 11 Home', '358.5 x 242 x 17.9 mm', '1.69 kg', 'Natural Silver ', 0, '15.6 inches', '1920 x 1080 pixels', 'IPS Screen, 250 nits, 60 Hz', 'Anti-Glare, Micro-edge, 45 Percent NTSC, FHD, BrightView', 'Intel Core i3 12th Gen', '1215U', 'Intel HD Graphics', '2 x 1.2 GHz (Turbo Speed upto 4.4 GHz) Performance Cores, 4 x 900 MHz (Turbo Speed upto 3.3 GHz) Efficient Cores', 'Hexa Core (2P + 4E), 8 Threads', '10 MB', '64 Bit', '8 GB', 'DDR4', '2400 MHz', '512 GB', 'Not Present', '3 Cell Battery', '65 W Smart AC Power Adapter', 'Yes, v5.2', 'Yes, IEEE 802.11a/b/g/n/ac/ax', 'No', '1 x USB Type-C, 2 x USB 3.0', '1 x HDMI 2.1', 'Yes', 'Yes', 1, 1, 'Yes, Dual Speakers', 1, 'Yes', 1),
(2, 12, 'Vostro 3520', 'Windows 11 Home', '358.5 x 235.56 x 16.96-22.47 mm', '1.66 kg', 'Plastic: Carbon Black, Titan Grey; Aluminum: Titan Grey', 0, '15.6 inches', '1920 x 1080 pixels', 'WVA Screen, 250 nits, 120 Hz', 'Anti-Glare, LED-backlit, Color Gamut: 45% NTSC', 'Intel Core i5 12th Gen', '1235U', 'Intel® Iris® Xᵉ Graphics', '2 x 1.3 GHz (Turbo Speed upto 4.4 GHz) Performance Cores, 8 x 900 MHz (Turbo Speed upto 3.3 GHz) Efficient Cores', '10 Cores, 12 Threads', '12 MB', '64 Bit', '8 GB', 'DDR4', '2666 MHz', '512 GB', 'Not Present', '3-cell, 41 Wh lithium-polymer', '65W Type-C EPEAT Adapter', 'Yes, v5.2', 'Yes, Wi-Fi 802.11a/b/g, Wi-Fi 4 (Wi-Fi 802.11n), Wi-Fi 5 (Wi-Fi 802.11ac), and Wi-Fi 6 (WiFi 802.11ax)', 'Yes, RJ45 Ethernet port', '2 x USB 3.0, 1 x USB 2.0', '1 HDMI 1.4 port', 'Yes, 1 SD 3.0 card slot', '1', 1, 1, 'Yes, Dual Speakers', 0, 'Yes, Carbon, non-backlit keyboard', 0),
(3, 13, 'VivoBook 15 M515DA-EJ521T', 'Windows 10 Home', '235 x 360 x 19 mm', '1.9 kg', 'slate grey, transparent silver, and peacock blue', 0, '15.6 inches', '1920 x 1080 pixels', 'LED', '60Hz refresh rate, 200nits, 45% NTSC color gamut, Anti-glare display, Non-touch screen', '3rd Gen AMD Ryzen 5', '3500U', 'AMD Radeon™ Vega 8 Graphics', '4 x 2.1 GHz (Turbo Speed upto 3.7 GHz) Cores', 'Quad Core, 8 Threads', '4 MB', '64 Bit', '4 GB', 'DDR4', '2400 MHz', '256 GB', 'Not Present', '37WHrs, 2S1P, 2-cell Li-ion', 'ø4.0, 45W AC Adapter, Output: 19V DC, 2.37A, 45W, Input: 100~240V AC 50/60Hz universal', 'Yes, v5.1', 'Yes, Wi-Fi 5 (802.11 ac)', 'No', '1 x USB Type-C, 1 x USB 3.0, 2 x USB 2.0', '1x HDMI 1.4', 'Yes', '1', 1, 1, 'Yes, SonicMaster Speakers', 0, 'Full-size, backlit chiclet keyboard with 1.4mm Key-travel', 1),
(4, 14, 'IdeaPad D330 82H0001YIN', 'Windows 10 Home', '249 x 178 x 9.5 mm', '1.13 kg', 'mineral grey', 1, '10.1 inches', '1200 x 800 pixels', 'IPS Screen', 'Anti-Glare, 300 nits brightness, 2.0 MP front camera and a 5.0 MP rear camera', 'Intel Celeron N4020', 'N4020', 'Intel UHD Graphics 600', '4 x 1.1 GHz (Turbo Speed upto 2.8 GHz) Cores', 'Quad Core, 2 Threads', '4 MB', '64 Bit', '4 GB', 'DDR4', '2133 MHz', 'Not Present', '128GB eMMC 5.1', '3-cell, 39 Wh Li-ion polymer', '45W Round Tip (2-pin, Wall-mount)', 'Yes, v4.2', 'Yes, 802.11b / g / n / ac', 'No', '1 x USB Type-C, 1 x USB 3.0', '1 x Mini HDMI Port', 'Yes', '1', 1, 1, 'Stereo speakers, 1W x2, optimized with Dolby® Audio™ Premium', 0, 'Non-backlit, English Keyboard', 0);

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
  `sensor` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `flash` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `rear_video_recording` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `rear_features` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `front_camera` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `ram` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `chipset` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `gpu` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `cpu_cores` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `internal_storage` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `sd_card_slot` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `battery_capacity` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `battery_features` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `fast_charging` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `network_support` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `bluetooth` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `wifi` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `usb` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `gps` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nfc` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `audio_jack` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `fm_radio` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `loud_speaker` tinyint(1) NOT NULL,
  `fingerprint_sensor` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `other_sensors` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mobile_specs`
--

INSERT INTO `mobile_specs` (`spec_id`, `product_id`, `release_date`, `device_type`, `sim`, `os`, `dimensions`, `weight`, `waterproof`, `build_material`, `colors`, `touch_screen`, `display`, `screen_size`, `screen_resolution`, `bezel_less_display`, `screen_protection`, `rear_camera`, `sensor`, `flash`, `rear_video_recording`, `rear_features`, `front_camera`, `ram`, `chipset`, `gpu`, `cpu_cores`, `internal_storage`, `sd_card_slot`, `battery_capacity`, `battery_features`, `fast_charging`, `network_support`, `bluetooth`, `wifi`, `usb`, `gps`, `nfc`, `audio_jack`, `fm_radio`, `loud_speaker`, `fingerprint_sensor`, `other_sensors`) VALUES
(1, 11, '2023-08-09', 'Smartphone', 'Dual SIM (Nano)', 'Android v13, HiOS', '162.7 x 75.9 x 7.8 mm', 'N/A', 'No', 'Glass Front, Lychee pattern leather back', 'Dark Welkin, Serenity Blue', 'Yes, Capacitive Touchscreen, Multi-touch', 'AMOLED, 120 Hz', '6.67 inches', '1080 x 2400 pixels', 'Yes, Punch hole', 'No', '64 MP + 2 MP + 2 MP', '64MP main sensor with an RGBW color filter, 2MP depth sensor, AI Shining Selfie sensor', 'Yes, Dual LED', '1080P @ 30 fps, 2160P @ 30 fps', 'Digital Zoom, Auto Flash, Face detection, Touch to focus, Autofocus, OIS', '32 MP', '8 GB', 'MediaTek Dimensity 8050', 'Mali-G77 MC9', 'Octa core (1 x 3 GHz Cortex A78 + 3 x 2.6 GHz Cortex A78 + 4 x 2 GHz Cortex A55)', '128 GB', 'Unspecified', '5000 mAh', 'Li-ion', 'Yes, Super, 33W', '4G, 3G, 2G', 'Yes, v5.2', 'Yes, Wi-Fi 5 (802.11 a/b/g/n/ac)', 'USB Type-C, USB On-The-Go', 'Yes with A-GPS', 'Yes', 'Yes, 3.5 mm', 'Yes', 1, 'Yes, In-display', 'Light sensor, Proximity sensor, Accelerometer, Compass'),
(2, 1, '2016-03-11', 'Smartphone', 'Dual SIM (Nano-SIM, dual stand-by)', 'Android 6.0 (Marshmallow), TouchWiz UI', '150.9 x 72.6 x 7.7 mm', '157 g', 'No', 'Glass front (Gorilla Glass 4), glass back (Gorilla Glass 4), aluminum frame', 'Black, White, Gold, Silver, Pink Gold, Black Pearl, Coral Blue', 'Yes, Capacitive Touchscreen, Multi-touch', 'Super AMOLED', '5.5 inches', '1440 x 2560 pixels', 'Yes', 'Corning Gorilla Glass 4', '12 MP rear camera with dual pixel', 'Fingerprint (front-mounted), accelerometer, gyro, proximity, compass, barometer, heart rate, SpO2', 'Yes, Multi-color LED', '4K@30fps, 1080p@30fps (gyro-EIS), 1080p@60fps, 720p@240fps, HDR, stereo sound rec., OIS', 'LED flash, auto-HDR, panorama', '5 MP', '4 GB', 'Snapdragon 820 or Exynos 8890', 'Qualcomm Adreno 530', 'Quad-core (2x2.15 GHz Kryo &amp; 2x1.6 GHz Kryo) - G9350', '128 GB', 'Yes, microSDXC supported, Up to 2 TB', '3600 mAh', 'Li-ion', 'Yes, 15W wired (QC2), Wireless (Qi/PMA) (market dependent)', '4G, 3G, 2G', 'Yes, v4.2', 'Yes, Wi-Fi 802.11 a/b/g/n/ac, dual-band, Wi-Fi Direct', 'microUSB 2.0, OTG', 'Yes with A-GPS', 'Yes', 'Yes, 3.5 mm', 'No', 1, 'Yes, Fingerprint (front-mounted)', 'Accelerometer, gyro, proximity, compass, barometer, heart rate, SpO2'),
(3, 7, '2024-02-22', 'Smartphone', 'Dual SIM (Nano-SIM, dual stand-by)', 'Android v14, Funtouch OS', '163.17 x 75.81 x 7.79 mm', '185.5 g', 'Yes, Splash proof, IP54', 'eco-fiber leather finish', 'Saffron Delight, Black Diamond', 'Yes, Capacitive Touchscreen, Multi-touch', 'AMOLED, 120 Hz', '6.67 inches', '1080 x 2400 pixels', 'Yes, Punch hole', 'No', '50MP + 2MP', '50 MP ISOCELL JN1, 2 MP depth sensor', 'Yes, LED Flash', '1080p @ 30 fps', 'Digital Zoom, Auto Flash, Face detection, Touch to focus, Autofocus', '16 MP', '6 GB ', 'Qualcomm Snapdragon 4 Gen 2, 4 nm', 'Adreno 613', 'Octa core (2 x 2.2 GHz Cortex A78 + 6 x 1.95 GHz Cortex A55)', '128 GB', 'Yes, Up to 1 TB', '5000 mAh', 'Li-ion', 'Yes, Flash, 44W', '5G, 4G, 3G, 2G', 'Yes, v5.0', 'Yes, Wi-Fi 4 (802.11 b/g/n) 5GHz', 'USB Type-C, USB On-The-Go (OTG)', 'Yes with A-GPS, Glonass', 'No', 'Yes, USB Type-C', 'No', 1, 'Yes, In-display', 'Light sensor, Proximity sensor, Accelerometer, Compass'),
(4, 8, '2024-02-22', 'Smartphone', 'Dual SIM (Nano-SIM, dual stand-by)', 'Android v14, Funtouch OS', '163.17 x 75.81 x 7.79 mm', '185.5 g', 'Yes, Splash proof, IP54', 'eco-fiber leather finish', 'Saffron Delight, Black Diamond', 'Yes, Capacitive Touchscreen, Multi-touch', 'AMOLED, 120 Hz', '6.67 inches', '1080 x 2400 pixels', 'Yes, Punch hole', 'No', '50MP + 2MP', '50 MP ISOCELL JN1, 2 MP depth sensor', 'Yes, LED Flash', '1080p @ 30 fps', 'Digital Zoom, Auto Flash, Face detection, Touch to focus, Autofocus', '16 MP', '8 GB ', 'Qualcomm Snapdragon 4 Gen 2, 4 nm', 'Adreno 613', 'Octa core (2 x 2.2 GHz Cortex A78 + 6 x 1.95 GHz Cortex A55)', '128 GB', 'Yes, Up to 1 TB', '5000 mAh', 'Li-ion', 'Yes, Flash, 44W', '5G, 4G, 3G, 2G', 'Yes, v5.0', 'Yes, Wi-Fi 4 (802.11 b/g/n) 5GHz', 'USB Type-C, USB On-The-Go (OTG)', 'Yes with A-GPS, Glonass', 'No', 'Yes, USB Type-C', 'No', 1, 'Yes, In-display', 'Light sensor, Proximity sensor, Accelerometer, Compass'),
(5, 9, '2024-03-07', 'Smartphone', 'Dual SIM (Nano + Nano)', 'Android v14, Funtouch OS', '164.36 x 75.1 x 7.45 mm', '188 g', 'Yes, Splash proof, IP54', 'Back: Mineral Glass', 'Classic Black, Andaman Blue', 'Yes, Capacitive Touchscreen, Multi-touch', 'AMOLED, 120 Hz, HDR 10+', '6.78 inches', '1260 x 2800 pixels', 'Yes, Punch hole', 'Yes', '50MP + 50 MP + 50 MP', 'IMX920, CMOS image sensor, Exmor-RS CMOS Sensor', 'Yes, Smart Aura Light', '1080p @ 30 fps, 2160p @ 30 fps', 'Digital Zoom, Auto Flash, Face detection, Touch to focus, Autofocus, OIS', '50 MP', '8 GB ', 'MediaTek Dimensity 8200 MT6896Z, 4 nm', 'Mali-G610 MC6', 'Octa core (1 x 3.1 GHz Cortex A78 + 3 x 3 GHz Cortex A78 + 4 x 2 GHz Cortex A55)', '256 GB', 'No', '5000 mAh', 'Li-ion', 'Yes, Flash, 80W', '5G, 4G, 3G, 2G', 'Yes, v5.3', 'Yes, Wi-Fi 5 (802.11 b/g/n/ac) 5GHz', 'USB Type-C, USB On-The-Go (OTG)', 'Yes with A-GPS, Glonass', 'No', 'Yes, USB Type-C', 'No', 1, 'Yes, In-display', 'Light sensor, Proximity sensor, Accelerometer, Compass, Gyroscope'),
(6, 10, '2024-03-07', 'Smartphone', 'Dual SIM (Nano + Nano)', 'Android v14, Funtouch OS', '164.36 x 75.1 x 7.45 mm', '188 g', 'Yes, Splash proof, IP54', 'Back: Mineral Glass', 'Classic Black, Andaman Blue', 'Yes, Capacitive Touchscreen, Multi-touch', 'AMOLED, 120 Hz, HDR 10+', '6.78 inches', '1260 x 2800 pixels', 'Yes, Punch hole', 'Yes', '50MP + 50 MP + 50 MP', 'IMX920, CMOS image sensor, Exmor-RS CMOS Sensor', 'Yes, Smart Aura Light', '1080p @ 30 fps, 2160p @ 30 fps', 'Digital Zoom, Auto Flash, Face detection, Touch to focus, Autofocus, OIS', '50 MP', '12 GB ', 'MediaTek Dimensity 8200 MT6896Z, 4 nm', 'Mali-G610 MC6', 'Octa core (1 x 3.1 GHz Cortex A78 + 3 x 3 GHz Cortex A78 + 4 x 2 GHz Cortex A55)', '512 GB', 'No', '5000 mAh', 'Li-ion', 'Yes, Flash, 80W', '5G, 4G, 3G, 2G', 'Yes, v5.3', 'Yes, Wi-Fi 5 (802.11 b/g/n/ac) 5GHz', 'USB Type-C, USB On-The-Go (OTG)', 'Yes with A-GPS, Glonass', 'No', 'Yes, USB Type-C', 'No', 1, 'Yes, In-display', 'Light sensor, Proximity sensor, Accelerometer, Compass, Gyroscope'),
(7, 2, '2016-03-11', 'Smartphone', 'Dual SIM (Nano-SIM, dual stand-by)', 'Android 6.0 (Marshmallow), TouchWiz UI', '150.9 x 72.6 x 7.7 mm', '157 g', 'No', 'Glass front (Gorilla Glass 4), glass back (Gorilla Glass 4), aluminum frame', 'Black, White, Gold, Silver, Pink Gold, Black Pearl, Coral Blue', 'Yes, Capacitive Touchscreen, Multi-touch', 'Super AMOLED', '5.5 inches', '1440 x 2560 pixels', 'Yes', 'Corning Gorilla Glass 4', '12 MP rear camera with dual pixel', 'Fingerprint (front-mounted), accelerometer, gyro, proximity, compass, barometer, heart rate, SpO2', 'Yes, Multi-color LED', '4K@30fps, 1080p@30fps (gyro-EIS), 1080p@60fps, 720p@240fps, HDR, stereo sound rec., OIS', 'LED flash, auto-HDR, panorama', '5 MP', '4 GB', 'Snapdragon 820 or Exynos 8890', 'Qualcomm Adreno 530', 'Quad-core (2x2.15 GHz Kryo &amp; 2x1.6 GHz Kryo) - G9350', '32 GB', 'Yes, microSDXC supported, Up to 2 TB', '3600 mAh', 'Li-ion, non-removable', 'Yes, 15W wired (QC2), Wireless (Qi/PMA) (market dependent)', '4G, 3G, 2G', 'Yes, v4.2', 'Yes, Wi-Fi 802.11 a/b/g/n/ac, dual-band, Wi-Fi Direct', 'microUSB 2.0, OTG', 'Yes with A-GPS', 'Yes', 'Yes, 3.5 mm', 'No', 1, 'Yes, Fingerprint (front-mounted)', 'Accelerometer, gyro, proximity, compass, barometer, heart rate, SpO2'),
(8, 19, '2024-07-30', 'Smartphone', 'Dual Sim, GSM+GSM', 'Android v14, OriginOS 4', '142.4 x 160 x 5.2 mm', '236 g', 'Yes, IPX8', 'high-quality aluminum and glass, outer screen(armor glass), inner screeen (UTG ultra-tough glass, TPU anti-impact film)', 'Black, White', 'Yes, Capacitive Touchscreen, Multi-touch', 'Color LTPO AMOLED Screen (1B Colors), 240 Hz', '8.03 inches', '2200 x 2480 pixels', 'Yes, Punch hole', 'Yes', '50MP + 64 MP + 50 MP', '50 MP main camera: With an f/1.68 lens, optical image stabilization (OIS), and a 1/1.3-inch OmniVision OV50H sensor; 50 MP ultra-wide sensor: With a 1/2.76-inch JN1 sensor and a 119-degree field of view (FOV); 64 MP telephoto sensor: With 3x optical zoom, 10x HD zoom, and 100x digital zoom', 'Yes, Dual LED', 'HDR 1080p@30fps)', 'Zeiss Optics, Zeiss T lens Coating, Photo, Portrait, Night Scene, Snapshot, Video, Movie Portrait, Micro Movie, High Pixel, Panorama, Ultra-Clear Document , Slow Motion, Time-Lapse Photography, Time-Lapse, Super Moon, Starry Sky', '32 MP + 32 MP', '16 GB', 'Qualcomm SM8550-AB Snapdragon 8 Gen 2 (4 nm)', 'Adreno 740', '1xCortex-X4@3.3 GHz &amp; 5xCortex-A720@3.2 GHz &amp; 2x Cortex-A520@2.3 GHz', '512 GB', 'No', '5700 mAh', 'Li-Po, Non-Removable Battery', 'Yes, 100W Fast Charging + 50 W Wireless Charging + Reverse wireless charging', '5G, 4G, 3G, 2G', 'Yes, v5.3', 'Wi-Fi 802.11 a/b/g/n/ac/6e/7, tri-band, Wi-Fi Direct', 'Yes, USB-C v3.2', 'Yes, with A-GPS, GLONASS, BDS, GALILEO, QZSS, NavIC', 'Yes', 'No', 'No', 1, 'Yes, In-display', 'Accelerometer, Gyro, Proximity, Compass, Barometer, Color Spectrum');

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
  `release_date` date NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `category_id`, `brand_id`, `product_name`, `price`, `product_image`, `release_date`, `status`) VALUES
(1, 1, 1, 'Samsung Galaxy S7 Edge (4GB RAM +128)', 56999, 's7 edge.jpeg', '2016-03-11', 1),
(2, 1, 1, 'Samsung Galaxy S7 Edge (4GB RAM +32)', 50999, 's7 edge.jpeg', '2016-03-11', 1),
(3, 2, 15, 'HP 15s-FR5012TU Intel Core i3 12th Gen (8GB/512GB SSD/Win 11)', 132900, 'hp-15s-fr5012tu-lapt.png', '2024-02-28', 1),
(4, 3, 8, 'Sony WH-CH520 Headphone', 14500, 'sony-wh-ch520-headphone.png', '2023-04-11', 1),
(5, 4, 25, 'Samsung Watch 4 Smartwatch', 36499, 'samsung-watch-4.png', '2021-08-27', 1),
(6, 5, 16, 'LG B3 77 inch Ultra HD 4K Smart OLED TV', 629000, 'OLED77B3PUA_gallery_01_front_3000x3000.png', '2023-04-03', 1),
(7, 1, 4, 'Vivo Y200e 5G (6GB RAM + 128)', 69999, 'vivo-y200e-5g.webp', '2024-02-22', 1),
(8, 1, 4, 'Vivo Y200e 5G (8GB RAM + 128)', 77999, 'vivo-y200e-5g.webp', '2024-02-22', 1),
(9, 1, 4, 'Vivo V30 Pro (8GB RAM + 256)', 141000, 'vivo-v30-pro.webp', '2024-03-07', 1),
(10, 1, 4, 'Vivo V30 Pro (12GB RAM + 512)', 150000, 'vivo-v30-pro.webp', '2024-03-07', 1),
(11, 1, 5, 'Tecno Camon 20', 60999, 'tecno-camon-20-pro-pakistan-priceoye-i672r-500x500.png', '2023-06-15', 1),
(12, 2, 18, 'Dell Vostro 3520 Laptop (12th Gen Core i5/ 8GB/ 512GB SSD/ Win11)', 204999, 'notebook-vostro-15-3520.jpg', '2022-01-09', 1),
(13, 2, 23, 'Asus VivoBook 15 (2020) M515DA-EJ521T Laptop', 141930, 'asus-vivobook-15-2020-m515da-ej521t.jpg', '2020-12-15', 1),
(14, 2, 19, 'Lenovo IdeaPad D330 82H0001YIN Laptop', 85465, 'Lenovo IdeaPad D330 82H0001YIN Laptop.png', '2022-02-18', 1),
(15, 5, 24, 'Samsung UA85CU8000KXXL 85 inches 4K Smart TV', 846999, 'samsung-ua85cu8000kxxl.webp', '2023-04-01', 1),
(16, 4, 28, 'Amazfit T-Rex Ultra Smartwatch', 87499, 'amazfit-t-rex-ultra-smartwatch.webp', '2023-03-20', 1),
(17, 3, 31, 'HP Bluetooth Headset 500 Headphone', 26799, 'hp-bluetooth-headset-500-headphone.webp', '2020-09-15', 1),
(18, 3, 34, 'boAt Rockerz 235V2', 2500, 'boat-rockerz-235v2.webp', '2022-06-01', 1),
(19, 1, 4, 'Vivo X Fold 3 Pro', 384999, 'vivo-x-fold-3-pro.webp', '2024-07-30', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sm_watch_specs`
--

CREATE TABLE `sm_watch_specs` (
  `spec_id` int NOT NULL,
  `product_id` int NOT NULL,
  `weight` varchar(10) NOT NULL,
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
  `compatible_os` varchar(100) NOT NULL,
  `fitness_features` varchar(255) NOT NULL,
  `water_resistant` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `extra_features` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `sm_watch_specs`
--

INSERT INTO `sm_watch_specs` (`spec_id`, `product_id`, `weight`, `dial_shape`, `bluetooth`, `gps`, `call_function`, `notification`, `wifi`, `sensors`, `battery_type`, `battery_life`, `touchscreen`, `display`, `screen_size`, `os`, `compatible_os`, `fitness_features`, `water_resistant`, `extra_features`) VALUES
(1, 5, '30.3 g', 'Circle', 1, 1, 1, 1, 'Wi-Fi 802.11 a/b/g/n 2.4+5GHz', 'Bioelectrical Impedance Analysis Sensor, Geomagnetic Sensor, Optical Heart Rate Sensor, Electrical Heart Sensor, Accelerometer, Barometer, Gyro Sensor, Light Sensor', 'Li-ion 361 mAh, non-removable', 'Up to 40 hrs', 1, 'Super AMOLED', '1.4 inches', 'Wear OS', 'Android', 'Calorie Count, Step Count, Heart Rate Monitor', 'Yes, Up to 50 m depth', 'Alarm Clock, Voice Control, Gesture Control'),
(2, 16, '89 g', 'Circle', 1, 1, 0, 1, 'No', 'Geomagnetic, Gyro, Acceleration, Barometric altimeter, Ambient light sensors', 'Li-ion 500 mAh', 'Up to 5 days', 1, 'AMOLED, 1000 nits', '1.36 inches', 'Zepp OS', 'Android, iOS', 'Altimeter, Pedometer, Heart Rate Monitor, SpO2 (Blood Oxygen) Monitor, Calorie Count, Step Count, Sleep Monitor', 'Yes, Up to 100 m depth', 'Alarm Clock');

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
  `display_tech` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `screen_size` varchar(50) NOT NULL,
  `screen_resolution` varchar(50) NOT NULL,
  `display_features` varchar(150) NOT NULL,
  `video_formats` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `audio_formats` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
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
  `more_features` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `usb` varchar(100) NOT NULL,
  `hdmi` varchar(50) NOT NULL,
  `ethernet` tinyint(1) NOT NULL,
  `power_requirement` varchar(100) NOT NULL,
  `power_consumption` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tv_specs`
--

INSERT INTO `tv_specs` (`spec_id`, `product_id`, `model`, `launch_year`, `in_the_box`, `weight_with_stand`, `weight_without_stand`, `display_tech`, `screen_size`, `screen_resolution`, `display_features`, `video_formats`, `audio_formats`, `no_of_speakers`, `output_per_speaker`, `total_speaker_output`, `sound_tech`, `smart_tv`, `os`, `internet_connectivity`, `bluetooth`, `screen_mirroring`, `preloaded_apps`, `voice_assistant`, `more_features`, `usb`, `hdmi`, `ethernet`, `power_requirement`, `power_consumption`) VALUES
(1, 6, 'OLED77PSA', 2023, 'Television, Remote Control, Magic Remote, Batteries, Table Stand, Wall Mount, Power Cord, User Manual &amp; Warranty card', '30 kg', '26.7 kg', 'OLED, 120 Hz', '77 inches, 4K', '3840 x 2160 pixels', 'α7 AI Processor 4K Gen6, HDR10, HLG, Dolby Vision, Pixel Dimming, Perfect Black, 100% Color Fidelity &amp; Color Volume', 'MP4', 'AC4, AC3(Dolby Digital), EAC3, HE-AAC, AAC, MP2, MP3, PCM, WMA, apt-X (refer to manual)', 2, '10 W', '20 W', 'AI Sound Pro (Virtual 5.1.2 Up-mix), Clear Voice Pro, Dolby Atmos', 1, 'Web OS', 'Wi-Fi', 1, 1, 'Apple TV, Netflix, Prime Video, Disney+Hotstar, YouTube, etc.', 'Amazon Alexa, Apple Airplay2, Apple Home, Hey Google', 'Nvidia GeForce Now Cloud Gaming, Utomik Cloud Gaming, Game Optimizer, Auto Low Latency Mode', '2 (Side)', '2 (Side), 2 (Rear)', 1, 'AC 100 - 240V 50-60Hz', '0.5 W'),
(2, 15, 'UA85CU8000KXXL', 2023, '1 Unit TV, Power Cord, Remote, 2 Stand', '43.5 kg', '41.5 kg', 'LED, 100 Hz', '85 inches, 4K', '3840 x 2160 pixels', 'HDR 10+, 1 Billion Colors, Brightness Detection', 'AVI, MKV, ASF, MP4, 3GP, MOV, FLV, VRO, 264 UHD, HEVC FHD, and HEVC UHD.', 'PCM, Dolby Digital, DD+ (Dolby Digital Plus), Vorbis, WMA (Windows Media Audio) 10 Pro, DTS Digital Surround', 2, '10 W', '20 W', 'downward-firing speakers, Object Tracking Sound Lite (OTS Lite)', 1, 'Tizen', 'Wi-Fi', 1, 1, 'Netflix, Youtube, Disney+Hotstar, Prime Video, etc.', 'Bixby and Google Assistant', 'Mobile Camera Support, Mobile to TV, TV Sound to Mobile, Sound Mirroring, Wireless TV On, ConnectShare™, EPG, Teletext (TTX), MBR Support', '2', '3', 1, '220-240V AC', '310 W');

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

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `verify_token`, `verify_status`, `created_at`) VALUES
(1, 'Maaz', 'maaztajammul63@gmail.com', 'maaz', '33ba087cbca6cc482e5566e933d2dbdc', 1, '2024-02-10 13:01:16'),
(2, 'Kami', 'kami.009211@gmail.com', 'kami', 'f900cc923ae127b9162120313eb2b02a', 0, '2024-02-24 13:09:12');

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
-- Dumping data for table `user_reviews`
--

INSERT INTO `user_reviews` (`id`, `product_id`, `user_id`, `review_heading`, `review_summary`, `created_at`) VALUES
(1, 11, 1, 'Amazing Mobile', 'Very nice mobile phone ', '2024-03-25 06:00:32'),
(2, 11, 1, 'High performance mobile ', 'The mobile\'s performance is very good for gamers.', '2024-03-25 06:14:19');

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
  MODIFY `brand_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

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
  MODIFY `spec_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `laptop_specs`
--
ALTER TABLE `laptop_specs`
  MODIFY `spec_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `mobile_specs`
--
ALTER TABLE `mobile_specs`
  MODIFY `spec_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `sm_watch_specs`
--
ALTER TABLE `sm_watch_specs`
  MODIFY `spec_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tv_specs`
--
ALTER TABLE `tv_specs`
  MODIFY `spec_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
