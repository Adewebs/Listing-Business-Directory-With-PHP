-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 25, 2024 at 07:53 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `business_listing`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_table`
--

CREATE TABLE `admin_table` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `role` enum('admin','author','editor') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_table`
--

INSERT INTO `admin_table` (`id`, `username`, `email`, `password`, `first_name`, `last_name`, `role`) VALUES
(1, 'adewebs', 'adewebstech@gmail.com', '$2y$10$i/c/X2sYQFB2xi0rm2l45up.hA8XSTwCdBs2weTOBNjOfWS6HpvDm', 'Adewebs', 'Adewebs', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `business_review`
--

CREATE TABLE `business_review` (
  `id` int(11) NOT NULL,
  `business_id` int(11) NOT NULL,
  `reviewer_name` varchar(255) NOT NULL,
  `reviewer_email` varchar(255) NOT NULL,
  `reviewer_comment` text DEFAULT NULL,
  `business_rating` decimal(2,1) NOT NULL CHECK (`business_rating` between 1 and 5),
  `review_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `review_likes` int(11) DEFAULT 0,
  `review_dislikes` int(11) DEFAULT 0,
  `vote_count` int(11) DEFAULT 0,
  `parent_id` int(11) DEFAULT NULL,
  `upvotes` int(11) NOT NULL DEFAULT 0,
  `downvotes` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `business_review`
--

INSERT INTO `business_review` (`id`, `business_id`, `reviewer_name`, `reviewer_email`, `reviewer_comment`, `business_rating`, `review_time`, `review_likes`, `review_dislikes`, `vote_count`, `parent_id`, `upvotes`, `downvotes`) VALUES
(1, 1, 'Adegboye Adebo', '', 'this is this and this and this', 2.0, '2024-10-25 08:14:17', 0, 0, 0, NULL, 0, 0),
(2, 1, 'Adegboye Adebo', '', 'dfghhgfdsfg', 4.0, '2024-10-25 15:12:23', 0, 0, 0, NULL, 0, 0),
(3, 1, 'EcoStarter', '', 'dghjhgfdghjhgf', 3.0, '2024-10-25 15:16:53', 0, 0, 0, NULL, 2, 2),
(4, 1, 'WP Express', '', 'tehdhdhd', 3.0, '2024-10-25 15:38:29', 0, 0, 0, NULL, 6, 3),
(5, 1, 'Adewebs In', '', 'thetwgsgs', 3.0, '2024-10-25 15:38:49', 0, 0, 0, 4, 0, 0),
(6, 1, 'index.html', '', 'checking it out', 3.0, '2024-10-25 16:21:31', 0, 0, 0, NULL, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `directory_settings`
--

CREATE TABLE `directory_settings` (
  `id` int(11) NOT NULL,
  `directory_name` varchar(255) NOT NULL,
  `directory_logo` varchar(255) DEFAULT NULL,
  `directory_description` text DEFAULT NULL,
  `directory_about` text DEFAULT NULL,
  `directory_tagline` varchar(255) DEFAULT NULL,
  `directory_contact_phone_one` varchar(20) DEFAULT NULL,
  `directory_contact_phone_two` varchar(20) DEFAULT NULL,
  `directory_address` text DEFAULT NULL,
  `directory_google_map_iframe_link` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `directory_settings`
--

INSERT INTO `directory_settings` (`id`, `directory_name`, `directory_logo`, `directory_description`, `directory_about`, `directory_tagline`, `directory_contact_phone_one`, `directory_contact_phone_two`, `directory_address`, `directory_google_map_iframe_link`) VALUES
(1, 'CleanUp', 'uploads/error-img.png', 'Cleaning services in UK and environs', 'this is about the business and what have you', 'Book Your Next Cleaning Company Right Away', '08131116906', NULL, '6 Toronto, Canada', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `listed_business`
--

CREATE TABLE `listed_business` (
  `id` int(11) NOT NULL,
  `business_name` varchar(255) NOT NULL,
  `business_address` text NOT NULL,
  `business_postal_code` varchar(20) DEFAULT NULL,
  `business_website` varchar(255) DEFAULT NULL,
  `business_contact_line_one` varchar(20) DEFAULT NULL,
  `business_contact_line_two` varchar(20) DEFAULT NULL,
  `business_contact_email` varchar(255) DEFAULT NULL,
  `business_pricing` varchar(255) DEFAULT NULL,
  `business_opening_hour` varchar(255) DEFAULT NULL,
  `business_description` text DEFAULT NULL,
  `business_rating` decimal(3,2) DEFAULT 0.00,
  `image` varchar(255) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `listed_business`
--

INSERT INTO `listed_business` (`id`, `business_name`, `business_address`, `business_postal_code`, `business_website`, `business_contact_line_one`, `business_contact_line_two`, `business_contact_email`, `business_pricing`, `business_opening_hour`, `business_description`, `business_rating`, `image`, `status`, `create_at`) VALUES
(1, 'CleanCo', '123 Baker St, London', 'NW1 6XE', 'www.cleanco.co.uk', '020 7946 0958', '020 7946 0959', 'info@cleanco.co.uk', '£2000-£5000', '9:00 AM - 5:00 PM', '<p>A professional cleaning service for offices.</p>', 5.00, 'error-img.png', 1, '2024-10-24 07:29:48'),
(3, 'Neat Solutions', '67 Church Rd, Liverpool', 'L1 1JF', 'www.neatsolutions.co.uk', '0151 908 3210', '0151 908 3211', 'support@neatsolutions.co.uk', '£1800-£4500', '8:30 AM - 5:30 PM', 'Offers cleaning services for events and corporate spaces.', 4.70, 'error-img.png', 1, '2024-10-24 07:31:08'),
(4, 'EcoClean', '22 High St, Birmingham', 'B1 1BB', 'www.ecoclean.co.uk', '0121 345 6789', '0121 345 6790', 'help@ecoclean.co.uk', '£2200-£4800', '7:30 AM - 6:00 PM', 'Environmentally friendly office cleaning services.', 4.80, 'error-img.png', 1, '2024-10-24 07:31:12'),
(5, 'Sparkling Spaces', '89 Queen St, Leeds', 'LS1 3AB', 'www.sparkling-spaces.co.uk', '0113 345 1234', '0113 345 1235', 'enquiries@sparkling-spaces.co.uk', '£1900-£4300', '9:00 AM - 6:00 PM', 'Specialized in workspace cleaning.', 4.60, 'error-img.png', 1, '2024-10-24 07:31:18'),
(6, 'Fresh Start Cleaners', '12 Victoria Rd, Bristol', 'BS1 6AU', 'www.freshstartcleaners.co.uk', '0117 456 7890', '0117 456 7891', 'service@freshstart.co.uk', '£2100-£4600', '8:00 AM - 5:30 PM', 'Offering premium cleaning solutions for retail stores.', 4.30, 'error-img.png', 1, '2024-10-24 07:31:21'),
(7, 'Spotless', '43 King St, Edinburgh', 'EH2 3AA', 'www.spotless.co.uk', '0131 567 8901', '0131 567 8902', 'hello@spotless.co.uk', '£1750-£4200', '8:30 AM - 5:00 PM', 'Expert cleaning services for co-working spaces.', 4.10, 'error-img.png', 1, '2024-10-24 07:31:23'),
(8, 'ClearView', '78 Princes St, Glasgow', 'G1 2AB', 'www.clearview.co.uk', '0141 987 6543', '0141 987 6544', 'info@clearview.co.uk', '£2000-£4700', '8:00 AM - 6:00 PM', 'Office and window cleaning specialists.', 5.00, 'error-img.png', 1, '2024-10-24 07:31:27'),
(9, 'Squeaky Clean', '90 Cowgate, Newcastle', 'NE1 1QX', 'www.squeakyclean.co.uk', '0191 654 3210', '0191 654 3211', 'support@squeakyclean.co.uk', '£1600-£4100', '9:00 AM - 5:30 PM', 'Providing professional cleaning for events.', 4.00, 'error-img.png', 1, '2024-10-24 07:31:30'),
(10, 'Perfect Shine', '33 Regent St, Brighton', 'BN1 1XL', 'www.perfectshine.co.uk', '01273 987 654', '01273 987 655', 'info@perfectshine.co.uk', '£1950-£4400', '9:00 AM - 6:00 PM', 'Specialized in large-scale office cleaning.', 4.50, 'error-img.png', 1, '2024-10-24 07:31:33'),
(11, 'Crystal Clean', '120 Highfield Rd, Cardiff', 'CF1 2AB', 'www.crystalclean.co.uk', '029 2034 5678', '029 2034 5679', 'contact@crystalclean.co.uk', '£1700-£4300', '8:30 AM - 5:30 PM', 'Retail and office cleaning experts.', 4.20, 'error-img.png', 1, '2024-10-24 07:31:39'),
(13, 'Eco Solutions', '34 Station Rd, Belfast', 'BT1 1AA', 'www.ecosolutions.co.uk', '028 9098 7654', '028 9098 7655', 'info@ecosolutions.co.uk', '£2000-£4700', '7:30 AM - 5:30 PM', 'Eco-friendly cleaning services for offices.', 4.80, NULL, 1, '2024-10-24 07:31:44'),
(14, 'Green Clean', '89 Market St, Dublin', 'D1 1AB', 'www.greenclean.ie', '01 678 9101', '01 678 9102', 'service@greenclean.ie', '£2200-£4900', '8:00 AM - 6:00 PM', 'Cleaning solutions for green offices.', 4.70, NULL, 1, '2024-10-24 07:31:48'),
(15, 'Clean & Simple', '50 Grand St, Limerick', 'V94 1AA', 'www.cleanandsimple.ie', '061 345 678', '061 345 679', 'support@cleanandsimple.ie', '£1850-£4300', '9:00 AM - 5:30 PM', 'Simple and effective cleaning services.', 4.40, NULL, 1, '2024-10-24 07:31:55'),
(16, 'Shiny & Bright', '21 O\'Connell St, Cork', 'T12 2AA', 'www.shinybright.ie', '021 345 6789', '021 345 6790', 'contact@shinybright.ie', '£1750-£4200', '8:30 AM - 5:30 PM', 'Corporate and event cleaning experts.', 4.60, NULL, 0, '2024-10-21 09:24:43'),
(17, 'Quick Clean', '11 Park Rd, Galway', 'H91 1AA', 'www.quickclean.ie', '091 234 5678', '091 234 5679', 'info@quickclean.ie', '£1900-£4500', '8:00 AM - 5:00 PM', 'Quick and reliable cleaning for small businesses.', 4.30, NULL, 0, '2024-10-21 09:24:43'),
(18, 'Bright & Tidy', '44 Church St, Waterford', 'X91 2AA', 'www.brighttidy.ie', '051 345 6789', '051 345 6790', 'enquiries@brighttidy.ie', '£1650-£4100', '9:00 AM - 6:00 PM', 'Affordable office and retail cleaning services.', 4.00, NULL, 0, '2024-10-21 09:24:43'),
(19, 'Pure Clean', '67 Main St, Derry', 'BT47 2AB', 'www.pureclean.co.uk', '028 7123 4567', '028 7123 4568', 'support@pureclean.co.uk', '£2000-£4800', '7:30 AM - 5:30 PM', 'Pure and professional cleaning services for events.', 4.50, NULL, 0, '2024-10-21 09:24:43'),
(20, 'Clear Solutions', '78 Bridge St, Armagh', 'BT60 2AA', 'www.clearsolutions.co.uk', '028 3752 1234', '028 3752 1235', 'info@clearsolutions.co.uk', '£1800-£4400', '8:30 AM - 6:00 PM', 'Office and workspace cleaning solutions.', 4.10, NULL, 0, '2024-10-21 09:24:43'),
(21, 'Adegboye Enterprises', '66 Odo Ikoyi Street Akure', '340004', NULL, '0813111118', NULL, NULL, '10', NULL, 'This is the full description of what you see', 0.00, NULL, NULL, '2024-10-21 09:24:43'),
(22, 'SholaGbade', '66 Odo Ikoyi Street Akure', '340004', NULL, '87112333', NULL, NULL, '10', NULL, ';lkxzdsfckjl;\'\r\nlkjgf', 0.00, NULL, NULL, '2024-10-21 09:24:43'),
(23, 'SholaGbade', '66 Odo Ikoyi Street Akure', '340004', NULL, '87112333', NULL, NULL, '10', NULL, ';lkxzdsfckjl;\'\r\nlkjgf', 0.00, NULL, NULL, '2024-10-21 09:24:43'),
(24, 'Adewebs Subsidaries', '66 Odo Ikoyi Street Akure', '340004', NULL, '124', NULL, NULL, '24', NULL, 'wghyjukljkhjghfdsfghjklk', 0.00, NULL, NULL, '2024-10-21 09:24:43'),
(25, 'Hivazinc Technologies', '66 Odo Ikoyi Street Akure', '340004', NULL, '121', NULL, NULL, '11', NULL, '<p>This is the <strong>pcae, get it </strong><span style=\"text-decoration: line-through;\">with</span></p>\r\n<div id=\"gtx-trans\" style=\"position: absolute; left: 162px; top: 32.3333px;\">\r\n<div class=\"gtx-trans-icon\">&nbsp;</div>\r\n</div>', 0.00, NULL, NULL, '2024-10-21 09:24:43'),
(26, 'Hivazinc Technologies', '66 Odo Ikoyi Street Akure', '340004', 'Hivazinc Technologies', 'Hivazinc Technologie', NULL, 'adewebstech@gmail.com', '10', NULL, '<p>hns;lnvpfs</p>', 0.00, NULL, 1, '2024-10-22 15:41:21'),
(27, 'Adewebs Technologies', '66 Odo Ikoyi Street Akure', '340004', 'Hivazinc Technologies', 'Hivazinc Technologie', NULL, 'adewebstech@gmail.com', '35', NULL, '<p>ghyjhgfddt</p>', 0.00, '0', 1, '2024-10-22 15:46:08'),
(28, 'Ade', '66 Odo Ikoyi Street Akure', '340004', 'Ade', 'Ade', NULL, 'adegboye.adebo712@gmail.com', '90', NULL, '<p>khbljopkljoiuvyct</p>', 0.00, '0', 1, '2024-10-22 15:49:56'),
(29, 'idowu', 'hfhjfhjf', '34r', 'nnfnfnfn', 'fff', 'fff', 'fff', '89', '88', 'jfhfhfhh', 0.00, '', 1, '2024-10-24 07:37:49'),
(30, 'Olwausola Technologies', '66 Odo Ikoyi Street Akure', '340004', 'https://adewebstech.ng', '08131116906', '', 'adewebstech@gmail.com', '10', '', 'this and this and this and that, and thatthis and this and this and that, and thatthis and this and this and that, and thatthis and this and this and that, and that', 0.00, 'office/uploads/gh.jpeg', 1, '2024-10-24 08:04:06'),
(31, 'Olwausola Technologies', '66 Odo Ikoyi Street Akure', '340004', 'https://adewebstech.ng', '08131116906', '', 'adewebstech@gmail.com', '10', '', 'this and this and this and that, and thatthis and this and this and that, and thatthis and this and this and that, and thatthis and this and this and that, and that', 0.00, 'gh.jpeg', 1, '2024-10-24 08:09:47');

-- --------------------------------------------------------

--
-- Table structure for table `listed_business_request`
--

CREATE TABLE `listed_business_request` (
  `id` int(11) NOT NULL,
  `business_name` varchar(255) NOT NULL,
  `business_address` text NOT NULL,
  `business_postal_code` varchar(20) DEFAULT NULL,
  `business_website` varchar(255) DEFAULT NULL,
  `business_contact_line_one` varchar(20) DEFAULT NULL,
  `business_contact_line_two` varchar(20) DEFAULT NULL,
  `business_contact_email` varchar(255) DEFAULT NULL,
  `business_pricing` varchar(255) DEFAULT NULL,
  `business_opening_hour` varchar(255) DEFAULT NULL,
  `business_description` text DEFAULT NULL,
  `business_rating` decimal(3,2) DEFAULT 0.00,
  `image` varchar(255) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `traffic_logs`
--

CREATE TABLE `traffic_logs` (
  `id` int(11) NOT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `page_url` text DEFAULT NULL,
  `referrer` text DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `listing_id` int(11) DEFAULT NULL,
  `visit_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `traffic_logs`
--

INSERT INTO `traffic_logs` (`id`, `ip_address`, `user_agent`, `page_url`, `referrer`, `country`, `listing_id`, `visit_time`) VALUES
(1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/', 'Direct', 'Unknown', NULL, '2024-10-20 16:23:59'),
(2, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/office/index.php', 'Direct', 'Unknown', NULL, '2024-10-20 16:24:50'),
(3, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/office/index.php', 'Direct', 'Unknown', NULL, '2024-10-20 16:26:12'),
(4, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/office/reviews.php', 'http://localhost/spacely/office/index.php', 'Unknown', NULL, '2024-10-20 16:26:27'),
(5, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/office/analytics.php', 'http://localhost/spacely/office/reviews.php', 'Unknown', NULL, '2024-10-20 16:28:30'),
(6, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/office/analytics.php', 'http://localhost/spacely/office/reviews.php', 'Unknown', NULL, '2024-10-20 16:30:40'),
(7, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/office/analytics.php', 'http://localhost/spacely/office/reviews.php', 'Unknown', NULL, '2024-10-20 16:31:45'),
(8, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/office/analytics.php', 'http://localhost/spacely/office/reviews.php', 'Unknown', NULL, '2024-10-20 16:32:12'),
(9, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/office/analytics.php', 'http://localhost/spacely/office/reviews.php', 'Unknown', NULL, '2024-10-20 16:32:27'),
(10, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/office/analytics.php', 'http://localhost/spacely/office/reviews.php', 'Unknown', NULL, '2024-10-20 16:34:00'),
(11, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/office/analytics.php', 'http://localhost/spacely/office/reviews.php', 'Unknown', NULL, '2024-10-20 16:39:26'),
(12, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/office/analytics.php', 'Direct', 'Unknown', NULL, '2024-10-20 16:39:56'),
(13, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/office/analytics.php', 'Direct', 'Unknown', NULL, '2024-10-20 16:40:41'),
(14, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/office/analytics.php', 'Direct', 'Unknown', NULL, '2024-10-20 16:41:25'),
(15, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/office/analytics.php', 'Direct', 'Unknown', NULL, '2024-10-20 16:52:12'),
(16, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/office/analytics.php?filter=last_31_days', 'http://localhost/spacely/office/analytics.php', 'Unknown', NULL, '2024-10-20 16:52:34'),
(17, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/office/analytics.php?filter=last_31_days', 'http://localhost/spacely/office/analytics.php', 'Unknown', NULL, '2024-10-20 16:55:03'),
(18, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/office/index.php', 'http://localhost/spacely/office/analytics.php?filter=last_31_days', 'Unknown', NULL, '2024-10-20 16:55:03'),
(19, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/office/analytics.php', 'http://localhost/spacely/office/index.php', 'Unknown', NULL, '2024-10-20 16:55:07'),
(20, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/', 'Direct', 'Unknown', NULL, '2024-10-20 17:00:41'),
(21, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/', 'Direct', 'Unknown', NULL, '2024-10-20 17:00:57'),
(22, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/office/listing-request.php', 'http://localhost/spacely/office/analytics.php', 'Unknown', NULL, '2024-10-20 17:02:01'),
(23, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/office/administrators.php', 'http://localhost/spacely/office/listing-request.php', 'Unknown', NULL, '2024-10-20 17:02:15'),
(24, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/business-details.php?id=1', 'http://localhost/spacely/', 'Unknown', NULL, '2024-10-20 17:04:03'),
(25, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/office/index.php', 'http://localhost/spacely/office/administrators.php', 'Unknown', NULL, '2024-10-20 17:04:16'),
(26, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/office/administrators.php', 'http://localhost/spacely/office/index.php', 'Unknown', NULL, '2024-10-20 17:04:37'),
(27, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/office/system-settings.php', 'http://localhost/spacely/office/administrators.php', 'Unknown', NULL, '2024-10-20 17:05:02'),
(28, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/office/analytics.php', 'http://localhost/spacely/office/system-settings.php', 'Unknown', NULL, '2024-10-20 17:05:36'),
(29, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/office/listing-request.php', 'http://localhost/spacely/office/analytics.php', 'Unknown', NULL, '2024-10-20 17:06:07'),
(30, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/office/listing.php', 'http://localhost/spacely/office/listing-request.php', 'Unknown', NULL, '2024-10-20 17:06:27'),
(31, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/office/analytics.php', 'http://localhost/spacely/office/index.php', 'Unknown', NULL, '2024-10-20 17:08:24'),
(32, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/office/analytics.php', 'http://localhost/spacely/office/index.php', 'Unknown', NULL, '2024-10-20 17:10:05'),
(33, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/index.php', 'http://localhost/spacely/business-details.php?id=1', 'Unknown', NULL, '2024-10-20 17:13:24'),
(34, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/business-details.php?id=6', 'http://localhost/spacely/index.php', 'Unknown', NULL, '2024-10-20 17:13:42'),
(35, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/', 'Direct', 'Unknown', NULL, '2024-10-24 07:02:04'),
(36, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/business-details.php?id=1', 'http://localhost/spacely/', 'Unknown', NULL, '2024-10-24 07:16:09'),
(37, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/business-details.php?id=6', 'http://localhost/spacely/index.php', 'Unknown', NULL, '2024-10-24 07:43:26'),
(38, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/request-list.php', 'http://localhost/spacely/business-details.php?id=6', 'Unknown', NULL, '2024-10-24 07:43:30'),
(39, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/request-list.php', 'http://localhost/spacely/business-details.php?id=6', 'Unknown', NULL, '2024-10-24 07:44:08'),
(40, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/request-list.php', 'http://localhost/spacely/business-details.php?id=6', 'Unknown', NULL, '2024-10-24 07:44:58'),
(41, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/request-list.php', 'http://localhost/spacely/business-details.php?id=6', 'Unknown', NULL, '2024-10-24 07:46:02'),
(42, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/request-list.php', 'http://localhost/spacely/business-details.php?id=6', 'Unknown', NULL, '2024-10-24 07:47:11'),
(43, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/request-list.php', 'http://localhost/spacely/business-details.php?id=6', 'Unknown', NULL, '2024-10-24 07:47:51'),
(44, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/request-list.php', 'http://localhost/spacely/business-details.php?id=6', 'Unknown', NULL, '2024-10-24 07:48:39'),
(45, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/request-list.php', 'http://localhost/spacely/business-details.php?id=6', 'Unknown', NULL, '2024-10-24 07:49:23'),
(46, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/request-list.php', 'http://localhost/spacely/business-details.php?id=6', 'Unknown', NULL, '2024-10-24 07:57:24'),
(47, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/request-list.php', 'http://localhost/spacely/business-details.php?id=6', 'Unknown', NULL, '2024-10-24 07:58:22'),
(48, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/request-list.php', 'http://localhost/spacely/business-details.php?id=6', 'Unknown', NULL, '2024-10-24 08:00:45'),
(49, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/request-list.php', 'http://localhost/spacely/business-details.php?id=6', 'Unknown', NULL, '2024-10-24 08:01:40'),
(50, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/request-list.php', 'http://localhost/spacely/request-list.php', 'Unknown', NULL, '2024-10-24 08:02:54'),
(51, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/', 'Direct', 'Unknown', NULL, '2024-10-24 08:04:36'),
(52, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/?page=4', 'http://localhost/spacely/', 'Unknown', NULL, '2024-10-24 08:04:47'),
(53, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/request-list.php', 'http://localhost/spacely/?page=4', 'Unknown', NULL, '2024-10-24 08:06:16'),
(54, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/request-list.php', 'http://localhost/spacely/request-list.php', 'Unknown', NULL, '2024-10-24 08:06:49'),
(55, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/request-list.php', 'http://localhost/spacely/request-list.php', 'Unknown', NULL, '2024-10-24 08:07:08'),
(56, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/request-list.php', 'http://localhost/spacely/request-list.php', 'Unknown', NULL, '2024-10-24 08:07:24'),
(57, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/request-list.php', 'http://localhost/spacely/request-list.php', 'Unknown', NULL, '2024-10-24 08:07:36'),
(58, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/request-list.php', 'http://localhost/spacely/request-list.php', 'Unknown', NULL, '2024-10-24 08:09:16'),
(59, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/index.php', 'http://localhost/spacely/request-list.php', 'Unknown', NULL, '2024-10-24 08:11:53'),
(60, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/index.php', 'http://localhost/spacely/request-list.php', 'Unknown', NULL, '2024-10-24 08:12:20'),
(61, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/index.php?page=4', 'http://localhost/spacely/index.php', 'Unknown', NULL, '2024-10-24 08:12:25'),
(62, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/index.php?page=4', 'http://localhost/spacely/index.php', 'Unknown', NULL, '2024-10-24 08:13:07'),
(63, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/index.php?page=4', 'http://localhost/spacely/index.php', 'Unknown', NULL, '2024-10-24 08:13:19'),
(64, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/index.php?page=4', 'http://localhost/spacely/index.php', 'Unknown', NULL, '2024-10-24 08:13:33'),
(65, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/index.php?page=4', 'http://localhost/spacely/index.php', 'Unknown', NULL, '2024-10-24 08:16:04'),
(66, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/index.php?page=4', 'http://localhost/spacely/index.php', 'Unknown', NULL, '2024-10-24 08:16:53'),
(67, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/index.php?page=4', 'http://localhost/spacely/index.php', 'Unknown', NULL, '2024-10-24 08:20:31'),
(68, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/index.php?page=4', 'http://localhost/spacely/index.php', 'Unknown', NULL, '2024-10-24 08:20:58'),
(69, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/index.php?page=1', 'http://localhost/spacely/index.php?page=4', 'Unknown', NULL, '2024-10-24 08:21:06'),
(70, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/index.php?page=1', 'http://localhost/spacely/index.php?page=4', 'Unknown', NULL, '2024-10-24 08:21:19'),
(71, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/index.php?page=4', 'http://localhost/spacely/index.php?page=1', 'Unknown', NULL, '2024-10-24 08:21:22'),
(72, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/', 'Direct', 'Unknown', NULL, '2024-10-24 08:22:20'),
(73, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/?page=4', 'http://localhost/spacely/', 'Unknown', NULL, '2024-10-24 08:22:29'),
(74, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/?page=2', 'http://localhost/spacely/', 'Unknown', NULL, '2024-10-24 08:22:29'),
(75, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/?page=4', 'http://localhost/spacely/', 'Unknown', NULL, '2024-10-24 08:39:07'),
(76, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/?page=1', 'http://localhost/spacely/?page=4', 'Unknown', NULL, '2024-10-24 08:39:13'),
(77, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/request-list.php', 'http://localhost/spacely/?page=1', 'Unknown', NULL, '2024-10-24 08:40:51'),
(78, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/request-list.php', 'http://localhost/spacely/?page=1', 'Unknown', NULL, '2024-10-24 08:42:49'),
(79, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/index.php', 'http://localhost/spacely/request-list.php', 'Unknown', NULL, '2024-10-24 08:43:01'),
(80, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/index.php', 'http://localhost/spacely/index.php', 'Unknown', NULL, '2024-10-24 08:43:10'),
(81, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/business-details.php?id=1', 'http://localhost/spacely/', 'Unknown', NULL, '2024-10-25 06:44:18'),
(82, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/business-details.php?id=1', 'http://localhost/spacely/', 'Unknown', NULL, '2024-10-25 06:46:13'),
(83, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/business-details.php?id=1', 'http://localhost/spacely/', 'Unknown', NULL, '2024-10-25 06:47:17'),
(84, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/business-details.php?id=1', 'http://localhost/spacely/', 'Unknown', NULL, '2024-10-25 06:48:28'),
(85, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/business-details.php?id=1', 'http://localhost/spacely/', 'Unknown', NULL, '2024-10-25 06:48:57'),
(86, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/business-details.php?id=1', 'http://localhost/spacely/', 'Unknown', NULL, '2024-10-25 06:49:19'),
(87, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/business-details.php?id=1', 'http://localhost/spacely/', 'Unknown', NULL, '2024-10-25 06:50:47'),
(88, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/business-details.php?id=1', 'http://localhost/spacely/', 'Unknown', NULL, '2024-10-25 06:51:37'),
(89, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/business-details.php?id=1', 'http://localhost/spacely/', 'Unknown', NULL, '2024-10-25 06:52:10'),
(90, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/business-details.php?id=1', 'http://localhost/spacely/', 'Unknown', NULL, '2024-10-25 06:52:28'),
(91, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/business-details.php?id=1', 'http://localhost/spacely/', 'Unknown', NULL, '2024-10-25 06:52:36'),
(92, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/business-details.php?id=1', 'http://localhost/spacely/', 'Unknown', NULL, '2024-10-25 06:53:28'),
(93, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/business-details.php?id=1', 'http://localhost/spacely/', 'Unknown', NULL, '2024-10-25 06:54:31'),
(94, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/business-details.php?id=1', 'http://localhost/spacely/', 'Unknown', NULL, '2024-10-25 06:54:38'),
(95, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/business-details.php?id=1', 'http://localhost/spacely/', 'Unknown', NULL, '2024-10-25 06:54:41'),
(96, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/business-details.php?id=1', 'http://localhost/spacely/', 'Unknown', NULL, '2024-10-25 06:55:06'),
(97, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/business-details.php?id=1', 'http://localhost/spacely/', 'Unknown', NULL, '2024-10-25 07:10:03'),
(98, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/business-details.php?id=1', 'http://localhost/spacely/', 'Unknown', NULL, '2024-10-25 07:11:57'),
(99, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/business-details.php?id=1', 'http://localhost/spacely/', 'Unknown', NULL, '2024-10-25 07:15:11'),
(100, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/business-details.php?id=1', 'http://localhost/spacely/', 'Unknown', NULL, '2024-10-25 07:24:29'),
(101, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/business-details.php?id=1', 'http://localhost/spacely/', 'Unknown', NULL, '2024-10-25 07:25:49'),
(102, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/business-details.php?id=1', 'http://localhost/spacely/', 'Unknown', NULL, '2024-10-25 07:27:54'),
(103, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/business-details.php?id=1', 'http://localhost/spacely/', 'Unknown', NULL, '2024-10-25 07:28:42'),
(104, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/business-details.php?id=1', 'http://localhost/spacely/', 'Unknown', NULL, '2024-10-25 07:34:40'),
(105, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/index.php', 'http://localhost/spacely/business-details.php?id=1', 'Unknown', NULL, '2024-10-25 07:36:35'),
(106, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/business-details.php?id=1', 'http://localhost/spacely/', 'Unknown', NULL, '2024-10-25 07:36:45'),
(107, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/business-details.php?id=1', 'http://localhost/spacely/index.php', 'Unknown', NULL, '2024-10-25 07:36:55'),
(108, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/business-details.php?id=1', 'http://localhost/spacely/business-details.php?id=1', 'Unknown', NULL, '2024-10-25 07:37:34'),
(109, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/business-details.php?id=1', 'http://localhost/spacely/business-details.php?id=1', 'Unknown', NULL, '2024-10-25 07:39:19'),
(110, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/business-details.php?id=1', 'Direct', 'Unknown', NULL, '2024-10-25 07:41:20'),
(111, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/business-details.php?id=1', 'http://localhost/spacely/business-details.php?id=1', 'Unknown', NULL, '2024-10-25 07:41:34'),
(112, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/business-details.php?id=1', 'Direct', 'Unknown', NULL, '2024-10-25 07:48:35'),
(113, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/business-details.php?id=1', 'Direct', 'Unknown', NULL, '2024-10-25 07:48:58'),
(114, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/business-details.php?id=1', 'http://localhost/spacely/business-details.php?id=1', 'Unknown', NULL, '2024-10-25 07:49:29'),
(115, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/business-details.php?id=1', 'Direct', 'Unknown', NULL, '2024-10-25 08:01:22'),
(116, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/business-details.php?id=1', 'Direct', 'Unknown', NULL, '2024-10-25 08:12:43'),
(117, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/business-details.php?id=1', 'Direct', 'Unknown', NULL, '2024-10-25 08:13:29'),
(118, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/business-details.php?id=1', 'http://localhost/spacely/business-details.php?id=1', 'Unknown', NULL, '2024-10-25 08:14:17'),
(119, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/business-details.php?id=1', 'Direct', 'Unknown', NULL, '2024-10-25 08:14:41'),
(120, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/business-details.php?id=1', 'Direct', 'Unknown', NULL, '2024-10-25 08:14:54'),
(121, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/business-details.php?id=1', 'Direct', 'Unknown', NULL, '2024-10-25 08:16:40'),
(122, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/business-details.php?id=1', 'Direct', 'Unknown', NULL, '2024-10-25 08:22:41'),
(123, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/business-details.php?id=1', 'Direct', 'Unknown', NULL, '2024-10-25 08:23:31'),
(124, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/business-details.php?id=1&page=1', 'http://localhost/spacely/business-details.php?id=1', 'Unknown', NULL, '2024-10-25 14:53:45'),
(125, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/business-details.php?id=1&page=1', 'http://localhost/spacely/business-details.php?id=1', 'Unknown', NULL, '2024-10-25 14:55:09'),
(126, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/business-details.php?id=1&page=1', 'http://localhost/spacely/business-details.php?id=1', 'Unknown', NULL, '2024-10-25 15:00:20'),
(127, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/business-details.php?id=1&page=1', 'http://localhost/spacely/business-details.php?id=1', 'Unknown', NULL, '2024-10-25 15:04:09'),
(128, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/business-details.php?id=1', 'Direct', 'Unknown', NULL, '2024-10-25 15:04:25'),
(129, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/business-details.php?id=1', 'Direct', 'Unknown', NULL, '2024-10-25 15:04:32'),
(130, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/business-details.php?id=1', 'Direct', 'Unknown', NULL, '2024-10-25 15:12:04'),
(131, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/business-details.php?id=1', 'http://localhost/spacely/business-details.php?id=1', 'Unknown', NULL, '2024-10-25 15:12:23'),
(132, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/business-details.php?id=1', 'Direct', 'Unknown', NULL, '2024-10-25 15:13:49'),
(133, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/business-details.php?id=1', 'Direct', 'Unknown', NULL, '2024-10-25 15:14:13'),
(134, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/business-details.php?id=1', 'Direct', 'Unknown', NULL, '2024-10-25 15:16:38'),
(135, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/business-details.php?id=1', 'http://localhost/spacely/business-details.php?id=1', 'Unknown', NULL, '2024-10-25 15:16:53'),
(136, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/business-details.php?id=1', 'http://localhost/spacely/business-details.php?id=1', 'Unknown', NULL, '2024-10-25 15:16:57'),
(137, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/business-details.php?id=1', 'http://localhost/spacely/business-details.php?id=1', 'Unknown', NULL, '2024-10-25 15:18:01'),
(138, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/business-details.php?id=1', 'http://localhost/spacely/business-details.php?id=1', 'Unknown', NULL, '2024-10-25 15:30:31'),
(139, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/business-details.php?id=1', 'http://localhost/spacely/business-details.php?id=1', 'Unknown', NULL, '2024-10-25 15:31:05'),
(140, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/business-details.php?id=1', 'http://localhost/spacely/business-details.php?id=1', 'Unknown', NULL, '2024-10-25 15:31:57'),
(141, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/business-details.php?id=1', 'http://localhost/spacely/business-details.php?id=1', 'Unknown', NULL, '2024-10-25 15:34:34'),
(142, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/business-details.php?id=1', 'Direct', 'Unknown', NULL, '2024-10-25 15:38:09'),
(143, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/business-details.php?id=1', 'http://localhost/spacely/business-details.php?id=1', 'Unknown', NULL, '2024-10-25 15:38:29'),
(144, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/business-details.php?id=1', 'http://localhost/spacely/business-details.php?id=1', 'Unknown', NULL, '2024-10-25 15:38:30'),
(145, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/business-details.php?id=1', 'http://localhost/spacely/business-details.php?id=1', 'Unknown', NULL, '2024-10-25 15:38:49'),
(146, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/business-details.php?id=1', 'http://localhost/spacely/business-details.php?id=1', 'Unknown', NULL, '2024-10-25 15:38:50'),
(147, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/business-details.php?id=1', 'http://localhost/spacely/business-details.php?id=1', 'Unknown', NULL, '2024-10-25 15:48:31'),
(148, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/business-details.php?id=1', 'http://localhost/spacely/business-details.php?id=1', 'Unknown', NULL, '2024-10-25 15:48:58'),
(149, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/business-details.php?id=1', 'Direct', 'Unknown', NULL, '2024-10-25 15:49:49'),
(150, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/business-details.php?id=1', 'Direct', 'Unknown', NULL, '2024-10-25 15:58:29'),
(151, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/business-details.php?id=1', 'Direct', 'Unknown', NULL, '2024-10-25 16:01:27'),
(152, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/business-details.php?id=1', 'http://localhost/spacely/business-details.php?id=1', 'Unknown', NULL, '2024-10-25 16:01:32'),
(153, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/business-details.php?id=1', 'http://localhost/spacely/business-details.php?id=1', 'Unknown', NULL, '2024-10-25 16:01:38'),
(154, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/business-details.php?id=1', 'http://localhost/spacely/business-details.php?id=1', 'Unknown', NULL, '2024-10-25 16:01:39'),
(155, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/business-details.php?id=1', 'http://localhost/spacely/business-details.php?id=1', 'Unknown', NULL, '2024-10-25 16:01:41'),
(156, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/business-details.php?id=1', 'Direct', 'Unknown', NULL, '2024-10-25 16:01:43'),
(157, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/business-details.php?id=1', 'http://localhost/spacely/business-details.php?id=1', 'Unknown', NULL, '2024-10-25 16:01:48'),
(158, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/business-details.php?id=1', 'Direct', 'Unknown', NULL, '2024-10-25 16:08:44'),
(159, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/business-details.php?id=1', 'http://localhost/spacely/business-details.php?id=1', 'Unknown', NULL, '2024-10-25 16:08:49'),
(160, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/business-details.php?id=1', 'http://localhost/spacely/business-details.php?id=1', 'Unknown', NULL, '2024-10-25 16:08:49'),
(161, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/business-details.php?id=1', 'http://localhost/spacely/business-details.php?id=1', 'Unknown', NULL, '2024-10-25 16:08:51'),
(162, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/business-details.php?id=1', 'http://localhost/spacely/business-details.php?id=1', 'Unknown', NULL, '2024-10-25 16:08:51'),
(163, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/business-details.php?id=1', 'http://localhost/spacely/business-details.php?id=1', 'Unknown', NULL, '2024-10-25 16:08:52'),
(164, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/business-details.php?id=1', 'http://localhost/spacely/business-details.php?id=1', 'Unknown', NULL, '2024-10-25 16:08:52'),
(165, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/business-details.php?id=1', 'http://localhost/spacely/business-details.php?id=1', 'Unknown', NULL, '2024-10-25 16:08:53'),
(166, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/business-details.php?id=1', 'http://localhost/spacely/business-details.php?id=1', 'Unknown', NULL, '2024-10-25 16:08:54'),
(167, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/business-details.php?id=1', 'Direct', 'Unknown', NULL, '2024-10-25 16:08:55'),
(168, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/business-details.php?id=1', 'Direct', 'Unknown', NULL, '2024-10-25 16:20:23'),
(169, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/business-details.php?id=1', 'http://localhost/spacely/business-details.php?id=1', 'Unknown', NULL, '2024-10-25 16:20:31'),
(170, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/business-details.php?id=1', 'http://localhost/spacely/business-details.php?id=1', 'Unknown', NULL, '2024-10-25 16:20:33'),
(171, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/business-details.php?id=1', 'Direct', 'Unknown', NULL, '2024-10-25 16:20:36'),
(172, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/business-details.php?id=1', 'http://localhost/spacely/business-details.php?id=1', 'Unknown', NULL, '2024-10-25 16:20:41'),
(173, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/business-details.php?id=1', 'http://localhost/spacely/business-details.php?id=1', 'Unknown', NULL, '2024-10-25 16:20:51'),
(174, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/business-details.php?id=1', 'http://localhost/spacely/business-details.php?id=1', 'Unknown', NULL, '2024-10-25 16:20:55'),
(175, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/business-details.php?id=1', 'Direct', 'Unknown', NULL, '2024-10-25 16:20:57'),
(176, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/business-details.php?id=1', 'http://localhost/spacely/business-details.php?id=1', 'Unknown', NULL, '2024-10-25 16:21:31'),
(177, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/business-details.php?id=1', 'http://localhost/spacely/business-details.php?id=1', 'Unknown', NULL, '2024-10-25 16:21:32'),
(178, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/business-details.php?id=1', 'http://localhost/spacely/business-details.php?id=1', 'Unknown', NULL, '2024-10-25 16:22:53'),
(179, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/business-details.php?id=1', 'http://localhost/spacely/business-details.php?id=1', 'Unknown', NULL, '2024-10-25 16:23:39'),
(180, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/business-details.php?id=1', 'http://localhost/spacely/business-details.php?id=1', 'Unknown', NULL, '2024-10-25 16:24:21'),
(181, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/business-details.php?id=1', 'http://localhost/spacely/business-details.php?id=1', 'Unknown', NULL, '2024-10-25 16:24:30'),
(182, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/business-details.php?id=1', 'Direct', 'Unknown', NULL, '2024-10-25 16:24:51'),
(183, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/business-details.php?id=1', 'Direct', 'Unknown', NULL, '2024-10-25 16:26:34'),
(184, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/index.php', 'http://localhost/spacely/business-details.php?id=1', 'Unknown', NULL, '2024-10-25 16:26:58'),
(185, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/request-list.php', 'http://localhost/spacely/index.php', 'Unknown', NULL, '2024-10-25 16:27:13'),
(186, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/index.php', 'http://localhost/spacely/request-list.php', 'Unknown', NULL, '2024-10-25 17:38:35'),
(187, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/index.php', 'http://localhost/spacely/request-list.php', 'Unknown', NULL, '2024-10-25 17:41:24'),
(188, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/index.php', 'http://localhost/spacely/request-list.php', 'Unknown', NULL, '2024-10-25 17:42:09'),
(189, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/index.php', 'http://localhost/spacely/request-list.php', 'Unknown', NULL, '2024-10-25 17:42:54'),
(190, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/index.php', 'http://localhost/spacely/request-list.php', 'Unknown', NULL, '2024-10-25 17:43:42'),
(191, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/index.php', 'http://localhost/spacely/request-list.php', 'Unknown', NULL, '2024-10-25 17:44:10'),
(192, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/index.php', 'http://localhost/spacely/request-list.php', 'Unknown', NULL, '2024-10-25 17:44:22'),
(193, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/index.php', 'http://localhost/spacely/request-list.php', 'Unknown', NULL, '2024-10-25 17:45:09'),
(194, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/index.php', 'http://localhost/spacely/request-list.php', 'Unknown', NULL, '2024-10-25 17:51:51'),
(195, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/index.php?search=cleanup', 'http://localhost/spacely/index.php', 'Unknown', NULL, '2024-10-25 17:52:14'),
(196, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/index.php?search=cleanco', 'http://localhost/spacely/index.php?search=cleanup', 'Unknown', NULL, '2024-10-25 17:52:36'),
(197, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/index.php?search=cleanc', 'http://localhost/spacely/index.php?search=cleanco', 'Unknown', NULL, '2024-10-25 17:52:48'),
(198, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/index.php?search=clean', 'http://localhost/spacely/index.php?search=cleanc', 'Unknown', NULL, '2024-10-25 17:52:54'),
(199, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', '/spacely/index.php?search=fresh', 'http://localhost/spacely/index.php?search=clean', 'Unknown', NULL, '2024-10-25 17:53:16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_table`
--
ALTER TABLE `admin_table`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `business_review`
--
ALTER TABLE `business_review`
  ADD PRIMARY KEY (`id`),
  ADD KEY `business_id` (`business_id`);

--
-- Indexes for table `directory_settings`
--
ALTER TABLE `directory_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `listed_business`
--
ALTER TABLE `listed_business`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `listed_business_request`
--
ALTER TABLE `listed_business_request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `traffic_logs`
--
ALTER TABLE `traffic_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ip_address` (`ip_address`),
  ADD KEY `page_url` (`page_url`(768)),
  ADD KEY `listing_id` (`listing_id`),
  ADD KEY `visit_time` (`visit_time`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_table`
--
ALTER TABLE `admin_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `business_review`
--
ALTER TABLE `business_review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `directory_settings`
--
ALTER TABLE `directory_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `listed_business`
--
ALTER TABLE `listed_business`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `listed_business_request`
--
ALTER TABLE `listed_business_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `traffic_logs`
--
ALTER TABLE `traffic_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=200;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `business_review`
--
ALTER TABLE `business_review`
  ADD CONSTRAINT `business_review_ibfk_1` FOREIGN KEY (`business_id`) REFERENCES `listed_business` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
