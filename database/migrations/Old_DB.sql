-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 25, 2019 at 02:50 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hi5_working`
--

-- --------------------------------------------------------

--
-- Table structure for table `about`
--

CREATE TABLE `about` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `about` text COLLATE utf8_unicode_ci,
  `link` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `about`
--

INSERT INTO `about` (`id`, `user_id`, `about`, `link`, `created_at`, `updated_at`) VALUES
(1, 5, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sed massa id leo aliquet suscipit. Vivamus blandit, magna at ultricies venenatis, magna lectus sagittis libero, ac viverra nisl diam et est. Duis ut facilisis diam. Fusce a mi laoreet, molestie ipsum eget, fringilla sem. Aenean ligula diam, tempus in mi non, cursus elementum felis. Fusce sollicitudin ligula at est consequat viverra. Donec pharetra dolor efficitur ipsum porttitor, luctus venenatis metus tincidunt. Duis ac venenatis quam.</p>\r\n<p>&nbsp;</p>\r\n<p>Praesent pulvinar leo in maximus mattis. Suspendisse lacinia, tellus nec commodo tristique, ligula libero facilisis est, et tincidunt felis orci sit amet risus. Morbi elementum vitae lorem ac ultrices. Pellentesque commodo quam risus, non sollicitudin urna pulvinar eu. Integer dictum sapien quis enim ultricies vulputate. Integer id lacus id elit fermentum aliquam vel et mauris. Pellentesque ac vestibulum felis. Aenean placerat tellus euismod rutrum accumsan. Vestibulum turpis arcu, suscipit vitae viverra ac, posuere quis nibh. Curabitur at suscipit arcu. Mauris finibus sem suscipit, maximus tortor nec, consectetur orci. In in malesuada risus. Maecenas vitae enim id dolor interdum ullamcorper.</p>\r\n<p>&nbsp;</p>\r\n<p>Suspendisse vehicula, lectus ac ultricies aliquet, lectus enim tincidunt ligula, ac interdum neque justo ac mauris. Phasellus massa nulla, vulputate et feugiat id, pharetra ac metus. Fusce eu suscipit mauris. Pellentesque non lobortis odio. Phasellus semper tempor metus, non posuere tellus viverra quis. Nulla mi felis, euismod a libero quis, efficitur scelerisque est. Proin sed ex eu dolor egestas fringilla vitae ac enim. Fusce at vehicula lorem. Maecenas commodo vestibulum justo, a vehicula ante mattis vitae. Etiam ac mattis lacus. Donec tincidunt nisl eleifend metus semper dictum. Donec sapien justo, tempor vel odio dictum, varius vestibulum orci. Nullam in nibh semper ante varius hendrerit at vel ex. Nam ut neque in diam interdum hendrerit vitae in neque. Donec metus dui, convallis ac nunc eu, pharetra interdum dui.</p>', 'https://www.youtube.com/watch?v=lAHgMtdaNYQ', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `advertisements`
--

CREATE TABLE `advertisements` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `adds_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `adds_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `position` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `style` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ads_post_on` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `image_link` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `embed_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `referral_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `article_category` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `article_website` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `article_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `article_description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `article_info_from` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `article_info_description` longtext COLLATE utf8_unicode_ci,
  `article_featured_image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `article_saved_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `balances`
--

CREATE TABLE `balances` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `amount` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `details` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `withdraw` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `datwise` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `balances`
--

INSERT INTO `balances` (`id`, `user_id`, `description`, `type`, `amount`, `created_at`, `updated_at`, `details`, `withdraw`, `datwise`) VALUES
(1, 41, 'Blog Read Fee', 'db', '2', '2019-03-14 11:14:27', '2019-03-14 11:14:27', NULL, NULL, '2019-03-14'),
(2, 41, 'Blog Read Fee Collected!', 'cr',  '2', '2019-03-14 11:14:27', '2019-03-14 11:14:27', NULL, NULL, '2019-03-14'),
(3, 41, 'test depo', 'cr', '5', '2019-03-14 11:21:42', '2019-03-14 11:21:42', 'mbb,b,', NULL, '2019-03-14'),
(4, 5, 'test', 'cr', '5', '2019-03-15 09:41:29', '2019-03-15 09:41:29', 'nbvcnbc', NULL, '2019-03-15'),
(5, 5, 'Blog Read Fee', 'db','2', '2019-03-15 23:33:23', '2019-03-15 23:33:23', NULL, NULL, '2019-03-15'),
(6, 41, 'Blog Read Fee Collected!', 'cr', '2', '2019-03-15 23:33:23', '2019-03-15 23:33:23', NULL, NULL, '2019-03-15'),
(7, 5, 'test', 'cr', '5', '2019-03-15 23:52:56', '2019-03-15 23:52:56', 'dfv<br />\r\ndfv<br />\r\ndv', NULL, '2019-03-15'),
(8, 41, 'Blog Read Fee', 'db', '2', '2019-03-16 09:26:43', '2019-03-16 09:26:43', NULL, NULL, '2019-03-16'),
(9, 41, 'Blog Read Fee Collected!', 'cr', '2', '2019-03-16 09:26:43', '2019-03-16 09:26:43', NULL, NULL, '2019-03-16'),
(10, 5, 'Blog Read Fee', 'db', '2', '2019-03-16 09:28:31', '2019-03-16 09:28:31', NULL, NULL, '2019-03-16'),
(11, 41, 'Blog Read Fee Collected!', 'cr', '2', '2019-03-16 09:28:32', '2019-03-16 09:28:32', NULL, NULL, '2019-03-16'),
(12, 5, 'Blog Read Fee', 'db', '2', '2019-03-16 09:29:00', '2019-03-16 09:29:00', NULL, NULL, '2019-03-16'),
(13, 41, 'Blog Read Fee Collected!', 'cr', '2', '2019-03-16 09:29:00', '2019-03-16 09:29:00', NULL, NULL, '2019-03-16'),
(14, 5, 'test5', 'cr', '5', '2019-03-16 09:33:57', '2019-03-16 09:33:57', 'test5<br />\r\ntest5<br />\r\ntest5', NULL, '2019-03-16'),
(15, 5, 'test deposit', 'cr', '20', '2019-03-24 05:51:22', '2019-03-24 05:51:22', 'test deposit description<br />\r\ntest deposit description<br />\r\ntest deposit description', NULL, '2019-03-23');

-- --------------------------------------------------------

--
-- Table structure for table `bids`
--

CREATE TABLE `bids` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `occupation` int(11) NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auto_order` int(11) DEFAULT NULL,
  `current_bid` double NOT NULL,
  `referral` double DEFAULT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `delivery_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `receiver` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `product_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `bids`
--

INSERT INTO `bids` (`id`, `user_id`, `occupation`, `phone`, `address`, `description`, `auto_order`, `current_bid`, `referral`, `country`, `delivery_date`, `created_at`, `updated_at`, `city`, `receiver`, `product_id`) VALUES
(2, 41, 1, '0000000006986969', '16010 Heatherdale Rd', '<p>kjbkjbkj</p>', 1, 6, 6, 'Bangladesh', '5', '2019-03-17 08:29:45', '2019-03-17 08:29:45', 'Victorville', 'uyyfruyfu', 2),
(3, 5, 1, '0000000008686', 'Addressssssssssssss', '<p>456t7yg8uij</p>', 1, 6, 3, 'Bangladesh', '5', '2019-03-18 06:58:47', '2019-03-18 06:58:47', 'Vania', 'Arefa', 3);

-- --------------------------------------------------------

--
-- Table structure for table `blog_posts`
--

CREATE TABLE `blog_posts` (
  `id` int(10) UNSIGNED NOT NULL,
  `heading` text COLLATE utf8_unicode_ci,
  `content` text COLLATE utf8_unicode_ci,
  `image` text COLLATE utf8_unicode_ci,
  `user_id` int(11) DEFAULT NULL,
  `published_at` datetime DEFAULT NULL,
  `is_published` int(11) DEFAULT NULL,
  `comment_count` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `checkbox` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'no',
  `read_amount` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `total_likes` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `total_dislikes` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `total_loves` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `total_angry` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `total_sad` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `total_happy` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `blog_posts`
--

INSERT INTO `blog_posts` (`id`, `heading`, `content`, `image`, `user_id`, `published_at`, `is_published`, `comment_count`, `created_at`, `updated_at`, `checkbox`, `read_amount`, `total_likes`, `total_dislikes`, `total_loves`, `total_angry`, `total_sad`, `total_happy`) VALUES
(1, 'Blog11111111111111111111111111111', 'mn mn , ,', '1552370836.png', 5, NULL, NULL, NULL, '2019-03-12 13:07:16', '2019-03-13 03:10:02', 'on', '0', '0', '1', '0', '0', '0', '0'),
(2, 'Blog11111111111111111111111111111', 'nvmn.,,m././hhnm,4\r\nnkbjnkm\r\nm.,/.', '1552536818.png', 41, NULL, NULL, NULL, '2019-03-14 11:13:38', '2019-03-14 11:13:38', 'no', '2', '0', '0', '0', '0', '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `buyers`
--

CREATE TABLE `buyers` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `buyer_item_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `buyer_status` tinyint(1) DEFAULT NULL,
  `buyer_pro_weight` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `buyer_category` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `buyer_sale_price` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `buyer_website` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `buyer_pro_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `buyer_pro_description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `buyer_location` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `buyer_featured_image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `buyer_commission_percentage` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `buyer_hidden_info` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `buyer_hidden_price` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `buyer_hidden_description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `buyer_saved_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `category` longtext COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chatrooms`
--

CREATE TABLE `chatrooms` (
  `id` int(10) UNSIGNED NOT NULL,
  `chatRoomId` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `chatrooms`
--

INSERT INTO `chatrooms` (`id`, `chatRoomId`, `created_at`, `updated_at`) VALUES
(1, '2,41', '2019-03-12 12:59:15', '2019-03-12 12:59:15'),
(2, '3,41', '2019-03-12 12:59:15', '2019-03-12 12:59:15'),
(3, '4,41', '2019-03-12 12:59:16', '2019-03-12 12:59:16'),
(4, '5,41', '2019-03-12 12:59:16', '2019-03-12 12:59:16'),
(5, '6,41', '2019-03-12 12:59:16', '2019-03-12 12:59:16'),
(6, '41,42', '2019-03-12 12:59:16', '2019-03-12 12:59:16'),
(7, '41,43', '2019-03-12 12:59:16', '2019-03-12 12:59:16'),
(8, '41,44', '2019-03-12 12:59:16', '2019-03-12 12:59:16'),
(9, '41,45', '2019-03-12 12:59:16', '2019-03-12 12:59:16'),
(10, '41,46', '2019-03-12 12:59:16', '2019-03-12 12:59:16'),
(11, '41,47', '2019-03-12 12:59:17', '2019-03-12 12:59:17'),
(12, '41,48', '2019-03-12 12:59:17', '2019-03-12 12:59:17'),
(13, '41,49', '2019-03-12 12:59:17', '2019-03-12 12:59:17'),
(14, '41,51', '2019-03-12 12:59:17', '2019-03-12 12:59:17'),
(15, '2,5', '2019-03-16 11:32:14', '2019-03-16 11:32:14'),
(16, '3,5', '2019-03-16 11:32:14', '2019-03-16 11:32:14'),
(17, '4,5', '2019-03-16 11:32:14', '2019-03-16 11:32:14'),
(18, '5,6', '2019-03-16 11:32:14', '2019-03-16 11:32:14'),
(19, '5,42', '2019-03-16 11:32:14', '2019-03-16 11:32:14'),
(20, '5,43', '2019-03-16 11:32:15', '2019-03-16 11:32:15'),
(21, '5,44', '2019-03-16 11:32:15', '2019-03-16 11:32:15'),
(22, '5,45', '2019-03-16 11:32:15', '2019-03-16 11:32:15'),
(23, '5,46', '2019-03-16 11:32:15', '2019-03-16 11:32:15'),
(24, '5,47', '2019-03-16 11:32:15', '2019-03-16 11:32:15'),
(25, '5,48', '2019-03-16 11:32:15', '2019-03-16 11:32:15'),
(26, '5,49', '2019-03-16 11:32:16', '2019-03-16 11:32:16'),
(27, '5,51', '2019-03-16 11:32:16', '2019-03-16 11:32:16'),
(28, '5,5', '2019-03-21 01:20:40', '2019-03-21 01:20:40'),
(29, '2,6', '2019-03-24 00:13:51', '2019-03-24 00:13:51'),
(30, '3,6', '2019-03-24 00:13:52', '2019-03-24 00:13:52'),
(31, '4,6', '2019-03-24 00:13:52', '2019-03-24 00:13:52'),
(32, '6,42', '2019-03-24 00:13:52', '2019-03-24 00:13:52'),
(33, '6,43', '2019-03-24 00:13:52', '2019-03-24 00:13:52'),
(34, '6,44', '2019-03-24 00:13:52', '2019-03-24 00:13:52'),
(35, '6,45', '2019-03-24 00:13:52', '2019-03-24 00:13:52'),
(36, '6,46', '2019-03-24 00:13:52', '2019-03-24 00:13:52'),
(37, '6,47', '2019-03-24 00:13:52', '2019-03-24 00:13:52'),
(38, '6,48', '2019-03-24 00:13:52', '2019-03-24 00:13:52'),
(39, '6,49', '2019-03-24 00:13:52', '2019-03-24 00:13:52'),
(40, '6,51', '2019-03-24 00:13:52', '2019-03-24 00:13:52');

-- --------------------------------------------------------

--
-- Table structure for table `comment_post`
--

CREATE TABLE `comment_post` (
  `id` int(10) UNSIGNED NOT NULL,
  `content` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `parent_comment_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `comment_post`
--

INSERT INTO `comment_post` (`id`, `content`, `user_id`, `post_id`, `parent_comment_id`, `created_at`, `updated_at`) VALUES
(1, 'jbkjbkjb', 5, 1, NULL, '2019-03-13 11:46:09', '2019-03-13 11:46:09'),
(2, 'n n ,m ,m', 41, 2, NULL, '2019-03-14 11:14:41', '2019-03-14 11:14:41'),
(3, 'jbkjgkjgvk', 41, 2, NULL, '2019-03-16 09:26:54', '2019-03-16 09:26:54');

-- --------------------------------------------------------

--
-- Table structure for table `comment_reactions`
--

CREATE TABLE `comment_reactions` (
  `id` int(10) UNSIGNED NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment_reaction` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `comment_reactions`
--

INSERT INTO `comment_reactions` (`id`, `post_id`, `user_id`, `comment_reaction`, `created_at`, `updated_at`) VALUES
(1, 1, 5, 'dislike', '2019-03-13 03:10:00', '2019-03-13 03:10:02');

-- --------------------------------------------------------

--
-- Table structure for table `coupon`
--

CREATE TABLE `coupon` (
  `id` int(10) UNSIGNED NOT NULL,
  `coupon_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `number_available` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `start_date` date DEFAULT NULL,
  `expiration_date` date DEFAULT NULL,
  `coupon_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `coupon_amount` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `criteria` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `used` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shipping_method` text COLLATE utf8_unicode_ci,
  `selected_product` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `coupon`
--

INSERT INTO `coupon` (`id`, `coupon_code`, `number_available`, `start_date`, `expiration_date`, `coupon_type`, `coupon_amount`, `criteria`, `used`, `shipping_method`, `selected_product`, `created_at`, `updated_at`) VALUES
(1, 'ggggggggggggggggggggggggggg', 'Unlimited', '2019-03-27', '2019-02-27', '%', '5', '1', '1', '', '', '2019-03-14 11:16:20', '2019-03-14 11:16:20'),
(3, 'ggggggggggggggggggggggggggg', 'Unlimited', '2019-02-28', '2019-01-30', '%', '6', '1', '1', '', '', '2019-03-15 23:49:26', '2019-03-15 23:49:26');

-- --------------------------------------------------------

--
-- Table structure for table `disputes`
--

CREATE TABLE `disputes` (
  `id` int(10) UNSIGNED NOT NULL,
  `dispute_no` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dispute_maker` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `open_with` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `note` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `dispute_maker_id` int(11) NOT NULL,
  `replyer_id` int(11) NOT NULL,
  `dispute_subject` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `disputes`
--

INSERT INTO `disputes` (`id`, `dispute_no`, `dispute_maker`, `status`, `open_with`, `note`, `created_at`, `updated_at`, `dispute_maker_id`, `replyer_id`, `dispute_subject`) VALUES
(1, '253238439', 'arefa.akhter.nila@gmail.com', 'closed', '', '', '2019-03-12 12:03:19', '2019-03-21 13:34:10', 5, 5, ''),
(2, '180271907', 'arefa.akhter.nila@gmail.com', 'action_request', 'aa@aa.com', '', '2019-03-12 12:03:58', '2019-03-23 00:10:02', 41, 41, '');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `event_checked` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `schedule_checked` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `event_featured_image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `event_date` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `event_start_time` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `event_end_time` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `event_ticket_price` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `event_details` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `event_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `interested_in_event` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `going_in_event` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `event_city` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `event_country` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `event_phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `event_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `event_is_online` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `no_need_approval` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `need_approval` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `event_host_image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `event_host_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `event_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `event_description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `event_modal_image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_published` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'no',
  `edited` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `edited_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `user_id`, `event_checked`, `schedule_checked`, `event_featured_image`, `event_date`, `event_start_time`, `event_end_time`, `event_ticket_price`, `event_details`, `event_title`, `interested_in_event`, `going_in_event`, `event_city`, `event_country`, `event_phone`, `event_address`, `event_is_online`, `no_need_approval`, `need_approval`, `event_host_image`, `event_host_name`, `event_type`, `event_description`, `created_at`, `updated_at`, `event_modal_image`, `is_published`, `edited`, `edited_id`) VALUES
(1, 5, NULL, NULL, '1552450126.jpg', NULL, NULL, NULL, NULL, NULL, 'Titleeeeeeeeeeeeeeeeeeeeeeeeee', NULL, NULL, 'Victorville', 'United States', '45346326', '16010 Heatherdale Rd', 'on', NULL, NULL, NULL, NULL, 'Event Type', '<p>sxasda</p>\r\n<p>sdcascd</p>\r\n<p>dsswacad</p>', '2019-03-13 11:08:46', '2019-03-13 11:35:49', '1552450204.jpg', 'yes', 'admin', '41');

-- --------------------------------------------------------

--
-- Table structure for table `event_modals`
--

CREATE TABLE `event_modals` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `event_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `event_start_time` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `event_end_time` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `event_ticket_price` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `event_details` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `event_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `event_modals`
--

INSERT INTO `event_modals` (`id`, `user_id`, `event_date`, `event_start_time`, `event_end_time`, `event_ticket_price`, `event_details`, `created_at`, `updated_at`, `event_id`) VALUES
(1, 5, '03/27/2019', '9:09 PM', '11:59 AM', '50', 'front sit', '2019-03-13 11:10:04', '2019-03-13 11:10:04', 1);

-- --------------------------------------------------------

--
-- Table structure for table `event_visitors`
--

CREATE TABLE `event_visitors` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `event_modal_id` int(11) DEFAULT NULL,
  `going_status` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `event_visitors`
--

INSERT INTO `event_visitors` (`id`, `user_id`, `owner_id`, `event_id`, `event_modal_id`, `going_status`, `created_at`, `updated_at`) VALUES
(1, 41, 5, 1, 1, 'rejected', '2019-03-13 11:36:28', '2019-03-13 11:37:52');

-- --------------------------------------------------------

--
-- Table structure for table `examination`
--

CREATE TABLE `examination` (
  `id` int(10) UNSIGNED NOT NULL,
  `question` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `answer` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `youtube_link` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `examination`
--

INSERT INTO `examination` (`id`, `question`, `answer`, `image`, `youtube_link`, `created_at`, `updated_at`) VALUES
(1, 'Test17777777777777777777', 'C', '1552537236jpg', 'https://www.youtube.com/watch?v=hY7m5jjJ9mM', '2019-03-14 11:20:36', '2019-03-14 11:20:36');

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE `faq` (
  `id` int(10) UNSIGNED NOT NULL,
  `question` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `answer` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `youtube_link` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `faq`
--

INSERT INTO `faq` (`id`, `question`, `answer`, `image`, `youtube_link`, `created_at`, `updated_at`) VALUES
(1, 'Test17777777777777777777', 'mmbmvkv', '1552537485png', 'https://www.youtube.com/watch?v=hY7m5jjJ9mM', '2019-03-14 11:24:45', '2019-03-14 11:24:45');

-- --------------------------------------------------------

--
-- Table structure for table `follows`
--

CREATE TABLE `follows` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `followable_id` int(10) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `follows`
--

INSERT INTO `follows` (`id`, `user_id`, `followable_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 5, 41, 1, '2019-03-18 05:52:38', '2019-03-24 00:03:26'),
(2, 41, 5, 1, '2019-03-18 10:52:43', '2019-03-18 10:52:43');

-- --------------------------------------------------------

--
-- Table structure for table `home_page_setups`
--

CREATE TABLE `home_page_setups` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `homepage_link` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `levels`
--

CREATE TABLE `levels` (
  `id` int(10) UNSIGNED NOT NULL,
  `userleveler` int(11) NOT NULL,
  `userbeenleveled` int(11) NOT NULL,
  `value` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `levels`
--

INSERT INTO `levels` (`id`, `userleveler`, `userbeenleveled`, `value`, `created_at`, `updated_at`) VALUES
(1, 5, 41, 'Star', '2019-03-24 00:12:39', '2019-03-24 00:12:39');

-- --------------------------------------------------------

--
-- Table structure for table `memberships`
--

CREATE TABLE `memberships` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `join_date` date DEFAULT NULL,
  `membership_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `membership_category` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `admin_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cell_num` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reference_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reference_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nid_no` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `instagram` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `facebook` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `linkedin` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `twitter` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nationality` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `yearly_income` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `profession_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `profession_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `share_rate` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `blah` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `account_detail` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nationality_2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menu_options`
--

CREATE TABLE `menu_options` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `link` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `show_order` int(11) NOT NULL,
  `ref` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `menu_options`
--

INSERT INTO `menu_options` (`id`, `name`, `link`, `show_order`, `ref`) VALUES
(1, 'User Access', '/UserAccess', 1, 'profile_drop_down'),
(2, 'HelpDesk', '/admin', 3, 'profile_drop_down'),
(3, 'Category Setup', '/CategorySetup', 4, 'profile_drop_down'),
(4, 'Admin Panel', '/admin', 5, 'profile_drop_down'),
(5, 'Edit Product Listing', '/admin', 6, 'profile_drop_down'),
(6, 'Refresh Order', '/admin', 7, 'profile_drop_down'),
(7, 'Query Screen', '/QueryScreen', 2, 'profile_drop_down'),
(8, 'Brand Update', '/brandupdate', 8, 'profile_drop_down'),
(9, 'Accountant', '/accountant', 9, 'profile_drop_down'),
(10, 'Advertisement', '/advertisement', 0, 'profile_drop_down'),
(14, 'Membership admin', '/membership', 0, 'profile_drop_down'),
(15, 'Homepage Setup', '/homepage-setup', 10, 'profile_drop_down'),
(16, 'Training Setup', '/trainsetup', 11, 'profile_drop_down'),
(17, 'Exam Setup', '/examsetup', 12, 'profile_drop_down'),
(18, 'Event Admin', '/events', 13, 'style=\"float:right;margin-right: -124px;'),
(19, 'Blog Admin', '/public-blog', 14, 'profile_drop_down'),
(22, 'SendEmail', '/sendemailforunread', 11, 'profile_drop_down'),
(23, 'Faq Setup', '/faqsetup', 15, 'profile_drop_down'),
(56, 'disputes', '/dispute', 15, 'profile_drop_down');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(10) UNSIGNED NOT NULL,
  `RoomId` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sender` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `receiver` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `readWriteStatus` int(11) NOT NULL,
  `activationStatus` int(11) NOT NULL,
  `UTC` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `selftime` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `RoomId`, `sender`, `receiver`, `message`, `readWriteStatus`, `activationStatus`, `UTC`, `selftime`, `created_at`, `updated_at`) VALUES
(1, '4', '41', '5', 'hi', 1, 1, '420', '22:59:41   11/2/2019', '2019-03-12 12:59:42', '2019-03-13 03:52:36'),
(2, '4', '5', '41', 'kgkjglgl', 1, 1, '420', '19:32:45   13/2/2019', '2019-03-14 09:32:45', '2019-03-14 09:58:36'),
(3, '4', '41', '5', ',mb,jblj,', 1, 1, '420', '21:26:16   13/2/2019', '2019-03-14 11:26:16', '2019-03-15 09:45:14'),
(4, '4', '5', '41', 'nvnvnv', 1, 1, '420', '19:45:26   14/2/2019', '2019-03-15 09:45:27', '2019-03-15 09:57:16'),
(5, '4', '41', '5', 'AAAAAA', 1, 1, '420', '19:57:27   14/2/2019', '2019-03-15 09:57:27', '2019-03-15 23:34:25'),
(6, '4', '5', '41', 'to admin', 1, 1, '420', '9:34:40   15/2/2019', '2019-03-15 23:34:40', '2019-03-16 09:19:40'),
(7, '4', '5', '41', 'tttttttttttttttttt', 1, 1, '420', '9:41:53   15/2/2019', '2019-03-15 23:41:54', '2019-03-16 09:19:41'),
(8, '4', '5', '41', 'htdhgdhjgdj', 1, 1, '420', '19:17:52   15/2/2019', '2019-03-16 09:17:53', '2019-03-16 09:19:41'),
(9, '4', '41', '5', 'hhhhhhhhhhhh', 1, 1, '420', '19:19:48   15/2/2019', '2019-03-16 09:19:49', '2019-03-16 11:32:25'),
(10, '4', '41', '5', 'hhh', 1, 1, '420', '21:37:16   15/2/2019', '2019-03-16 11:37:16', '2019-03-16 11:39:23'),
(11, '4', '5', '41', '>>>>>>>>>>>>>>>>>>>>', 1, 1, '420', '21:40:0   15/2/2019', '2019-03-16 11:40:01', '2019-03-16 11:51:08'),
(12, '4', '41', '5', '><><><>', 1, 1, '420', '21:51:44   15/2/2019', '2019-03-16 11:51:45', '2019-03-16 13:14:55'),
(13, '4', '5', '41', '>>>>>>', 1, 1, '420', '11:52:8   16/2/2019', '2019-03-17 01:52:08', '2019-03-19 08:26:19'),
(14, '4', '5', '41', 'hhhhhhh', 1, 1, '420', '17:45:40   16/2/2019', '2019-03-17 07:45:40', '2019-03-19 08:26:19'),
(15, '4', '5', '41', '>>>>', 1, 1, '420', '18:04:45   17/2/2019', '2019-03-18 08:04:46', '2019-03-19 08:26:20'),
(16, '4', '41', '5', '<>?<>?<>?', 1, 1, '420', '18:26:28   18/2/2019', '2019-03-19 08:26:29', '2019-03-19 08:37:25'),
(17, '4', '41', '5', 'BBBBBBBBBBBBBBBBB', 1, 1, '420', '18:36:54   18/2/2019', '2019-03-19 08:36:54', '2019-03-19 08:37:25'),
(18, '4', '5', '41', 'CCCCCCCCCcc', 1, 1, '420', '11:08:44   19/2/2019', '2019-03-20 01:08:45', '2019-03-20 01:31:18'),
(19, '4', '5', '41', 'CCCCCCCCCcc', 1, 1, '420', '11:09:44   19/2/2019', '2019-03-20 01:09:45', '2019-03-20 01:31:18'),
(20, '4', '5', '41', 'ddddddddddddd', 1, 1, '420', '11:09:58   19/2/2019', '2019-03-20 01:09:59', '2019-03-20 01:31:19'),
(21, '4', '5', '41', 'eeee', 1, 1, '420', '11:27:20   19/2/2019', '2019-03-20 01:27:20', '2019-03-20 01:31:19'),
(22, '4', '41', '5', 'dddddeeeeefffffggggg', 1, 1, '420', '11:31:53   19/2/2019', '2019-03-20 01:31:53', '2019-03-20 01:43:37'),
(23, '4', '5', '41', 'aaa', 1, 1, '420', '11:43:46   19/2/2019', '2019-03-20 01:43:46', '2019-03-20 12:09:43'),
(24, '4', '5', '41', 'bbb', 1, 1, '420', '12:05:44   19/2/2019', '2019-03-20 02:05:45', '2019-03-20 12:09:44'),
(25, '4', '5', '41', 'cccc', 1, 1, '420', '14:22:37   19/2/2019', '2019-03-20 04:22:38', '2019-03-20 12:09:44'),
(26, '4', '5', '41', 'dddd', 1, 1, '420', '19:59:0   19/2/2019', '2019-03-20 09:59:00', '2019-03-20 12:09:44'),
(27, '4', '5', '41', 'fffff', 1, 1, '420', '22:05:33   19/2/2019', '2019-03-20 12:05:34', '2019-03-20 12:09:44'),
(28, '4', '5', '41', 'hhhhhhhhhhhhh', 1, 1, '420', '22:07:3   19/2/2019', '2019-03-20 12:07:04', '2019-03-20 12:09:44'),
(29, '4', '5', '41', 'iiiiiiiiiiiiiiiiiiiiiii', 1, 1, '420', '22:07:12   19/2/2019', '2019-03-20 12:07:13', '2019-03-20 12:09:44'),
(30, '4', '41', '5', 'gggggggggggg', 1, 1, '420', '22:09:49   19/2/2019', '2019-03-20 12:09:50', '2019-03-20 13:12:50'),
(31, '4', '41', '5', 'bbggggggggggggggggg', 1, 1, '420', '23:12:15   19/2/2019', '2019-03-20 13:12:16', '2019-03-20 13:12:51'),
(32, '4', '5', '41', 'nnnn', 1, 1, '420', '11:59:54   20/2/2019', '2019-03-21 01:59:55', '2019-03-21 13:03:35'),
(33, '4', '5', '41', 'BBBBBBBBBB', 1, 1, '420', '23:00:33   20/2/2019', '2019-03-21 13:00:34', '2019-03-21 13:03:35'),
(34, '4', '5', '41', 'RRRRRRRRRRRRRRRRRRRRRRRRRR', 1, 1, '420', '23:09:7   20/2/2019', '2019-03-21 13:09:08', '2019-03-21 13:16:01'),
(35, '4', '41', '5', 'jjjjjjjjjjjjjj', 1, 1, '420', '10:11:58   22/2/2019', '2019-03-23 00:11:59', '2019-03-24 00:01:50'),
(36, '4', '5', '41', 'hhhhhhhhhhhhh', 1, 1, '420', '10:12:27   23/2/2019', '2019-03-24 00:12:27', '2019-03-25 08:30:26'),
(37, '5', '6', '41', 'jfjhfjhfj', 0, 1, '420', '10:14:1   23/2/2019', '2019-03-24 00:14:02', '2019-03-24 00:14:02'),
(38, '4', '5', '41', 'hhhh', 1, 1, '420', '18:01:19   24/2/2019', '2019-03-25 08:01:20', '2019-03-25 08:30:26'),
(39, '4', '5', '41', 'jgkhgk', 1, 1, '420', '18:03:32   24/2/2019', '2019-03-25 08:03:32', '2019-03-25 08:30:26'),
(40, '4', '5', '41', 'DDD', 1, 1, '420', '18:04:24   24/2/2019', '2019-03-25 08:04:25', '2019-03-25 08:30:26'),
(41, '4', '5', '41', 'bbb', 1, 1, '420', '18:29:30   24/2/2019', '2019-03-25 08:29:31', '2019-03-25 08:30:26'),
(42, '4', '41', '5', 'AAAAA', 0, 1, '420', '18:45:46   24/2/2019', '2019-03-25 08:45:47', '2019-03-25 08:45:47');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2018_10_11_191629_create_buyers_table', 1),
(4, '2018_10_11_191646_create_sellers_table', 1),
(5, '2018_10_12_194145_create_articles_table', 1),
(6, '2018_11_07_110554_add_status_column_to_user_table', 1),
(7, '2018_11_08_150306_create_orders_table', 1),
(8, '2018_11_16_221256_create_menu_options_table', 1),
(9, '2018_11_16_221256_create_site_info_table', 1),
(10, '2018_11_16_221256_create_user_menu_table', 1),
(11, '2018_11_17_043724_create_queries_table', 1),
(12, '2018_11_17_091510_add_fields_in_users_table', 1),
(13, '2018_11_22_143254_create_saved_posts_table', 1),
(14, '2018_12_01_104115_add_buyer_saved_status_to_buyers', 1),
(15, '2018_12_01_120751_add_seller_saved_status_to_buyers', 1),
(16, '2018_12_01_124821_add_article_saved_status_to_buyers', 1),
(17, '2018_12_10_201905_change_article_table', 1),
(18, '2018_12_10_202540_change_sellers_table', 1),
(19, '2018_12_12_045327_change_sellers_again_table', 1),
(20, '2018_12_12_045517_change_sellers_again_d_table', 1),
(21, '2018_12_15_083338_create_categories_table', 1),
(22, '2018_12_15_104630_create_balances_table', 1),
(23, '2018_12_15_113749_add_details_to_balances', 1),
(24, '2018_12_15_130629_add_with_to_balances', 1),
(25, '2018_12_15_131535_add_datwise_to_balances', 1),
(26, '2018_12_15_133412_change_nullable_balances_stable', 1),
(27, '2018_12_15_194436_change_nullable_f_balances_table', 1),
(28, '2018_12_23_104046_chatroom', 1),
(29, '2018_12_23_104253_message', 1),
(30, '2018_12_23_134617_create_table_coupon', 1),
(31, '2018_12_31_082958_add_online_status', 1),
(32, '2019_01_05_103903_leveltable', 1),
(33, '2019_01_07_055758_create_professions_table', 1),
(34, '2019_01_10_100052_add_utc_zone_to_user', 1),
(35, '2019_01_10_215839_create_menu_option_seeding_table', 1),
(36, '2019_01_20_123612_updates_menu_option_table', 1),
(37, '2019_01_23_203938_create_home_page_setups', 1),
(38, '2019_01_26_195318_create_memberships_table', 1),
(39, '2019_02_02_125557_create_blog_posts_table', 1),
(40, '2019_02_03_084924_create_event_visitors_table', 1),
(41, '2019_02_05_145812_create_comment_post_table', 1),
(42, '2019_02_09_062719_update_blog_comment_table', 1),
(43, '2019_02_09_075507_create_events_table', 1),
(44, '2019_02_09_075704_create_event_modals_table', 1),
(45, '2019_02_09_130443_advertisement_new_matul', 1),
(46, '2019_02_09_132127_change_to_advertisement_table_matul', 1),
(47, '2019_02_09_135413_create_examination_table', 1),
(48, '2019_02_09_135845_create_faq_table', 1),
(49, '2019_02_09_140119_create_training_table', 1),
(50, '2019_02_09_130443_create__advertisement_new_matul', 2),
(51, '2019_02_16_030943_create_disputes_table', 2),
(52, '2019_02_16_050630_create_replies_table', 2),
(53, '2019_02_16_153805_add_dispute_naker_id_to_disputes', 2),
(54, '2019_02_16_154701_add_replyer_id_to_disputes', 2),
(55, '2019_02_16_155959_add_dispute_no_to_replies', 2),
(56, '2019_02_17_164250_add_event_id_to__event__models', 2),
(57, '2019_02_17_165717_add_event_modal_image_in_events', 2),
(58, '2019_02_17_202030_create_comment_reactions', 2),
(59, '2019_02_20_193608_add_is_published_in_events', 2),
(60, '2019_02_22_062526_add_replyer_id_to_replies', 2),
(61, '2019_02_26_153959_add_buy_colunms_to_blog_posts', 2),
(62, '2019_02_26_185702_add_reactions_to_blog_posts', 2),
(63, '2019_02_27_185918_add_verify', 2),
(64, '2019_02_27_210005_add_cover_image_to_users_table', 3),
(65, '2019_03_03_081143_create_comment_reactions_table', 4),
(66, '2019_02_24_114320_update_menu_option_table', 5),
(67, '2019_03_01_055015_add_dispute_subject_to_disputes', 5),
(68, '2019_03_07_015521_create_bids_table', 5),
(69, '2019_03_07_122255_add_city_country', 5),
(70, '2019_03_07_160553_to_user_name', 5),
(71, '2019_03_10_185450_add_edited_to_events', 6),
(72, '2019_03_10_195053_add_edited_id_to_events', 6),
(73, '2019_03_13_211751_about_to_users_table', 7),
(74, '2019_03_09_125946_create_products_table', 8),
(75, '2019_03_09_130831_alter_votes_to_table_name', 8),
(76, '2019_03_15_083248_create_settings_table', 9),
(77, '2019_03_16_135747_create_follows_table', 10),
(78, '2019_03_16_153952_create_reviews_table', 10),
(79, '2019_03_19_190040_about_page', 11),
(80, '2019_03_23_181733_create_about_page', 12);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `order_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `buyer_status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `seller_order_status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `image`, `created_at`, `updated_at`) VALUES
(1, 'flower', '1552702578,jpg', '2019-03-15 09:37:13', '2019-03-16 09:16:18'),
(2, '6r86r68', '1552786184,PNG', '2019-03-17 08:29:44', '2019-03-17 08:29:44'),
(3, 'flower', '1552867126,jpg', '2019-03-18 06:58:46', '2019-03-18 06:58:46');

-- --------------------------------------------------------

--
-- Table structure for table `professions`
--

CREATE TABLE `professions` (
  `id` int(10) UNSIGNED NOT NULL,
  `profession_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `profession_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `queries`
--

CREATE TABLE `queries` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `replies`
--

CREATE TABLE `replies` (
  `id` int(10) UNSIGNED NOT NULL,
  `note_id` int(11) NOT NULL,
  `notes` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `dispute_no` int(11) NOT NULL,
  `replyer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `replies`
--

INSERT INTO `replies` (`id`, `note_id`, `notes`, `created_at`, `updated_at`, `dispute_no`, `replyer_id`) VALUES
(1, 5, 'Closed', '2019-03-12 12:03:19', '2019-03-21 13:34:10', 253238439, 5);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `reviewable_id` int(10) UNSIGNED NOT NULL,
  `review_number` decimal(2,1) DEFAULT NULL,
  `review_text` text COLLATE utf8_unicode_ci,
  `reviewable_type` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1 => profile',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `user_id`, `reviewable_id`, `review_number`, `review_text`, `reviewable_type`, `created_at`, `updated_at`) VALUES
(1, 5, 41, '4.0', NULL, 1, '2019-03-18 05:56:57', '2019-03-25 08:05:55'),
(2, 41, 5, '1.0', NULL, 1, '2019-03-18 07:41:01', '2019-03-25 08:45:34'),
(3, 6, 41, '5.0', NULL, 1, '2019-03-19 08:47:39', '2019-03-19 08:48:02');

-- --------------------------------------------------------

--
-- Table structure for table `saved_posts`
--

CREATE TABLE `saved_posts` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `post_id` int(10) UNSIGNED NOT NULL,
  `post_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sellers`
--

CREATE TABLE `sellers` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `seller_status` tinyint(1) DEFAULT NULL,
  `seller_item_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `seller_pro_weight` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `seller_category` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `seller_org_price` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `seller_sale_price` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `seller_website` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `seller_pro_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `seller_pro_description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `seller_location` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `seller_info_from` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `seller_info_price` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `seller_info_description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `seller_featured_image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `seller_commission_percentage` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `seller_saved_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `mail_username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mail_password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pusher_app_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pusher_app_key` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pusher_app_secret` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pusher_app_cluster` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `mail_username`, `mail_password`, `pusher_app_id`, `pusher_app_key`, `pusher_app_secret`, `pusher_app_cluster`, `created_at`, `updated_at`) VALUES
(1, '123456789@test.com', '00000', '7172668888BBBBBBBBBBBBBBBBB', '23685fe5defa4e44444422222AAAAAAAAAAAAa', '05aca9f72efa0a0f8079', 'ap2', '2019-03-16 11:35:41', '2019-03-21 12:58:01');

-- --------------------------------------------------------

--
-- Table structure for table `site_info`
--

CREATE TABLE `site_info` (
  `id` int(11) NOT NULL,
  `attr_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `attr_value` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `site_info`
--

INSERT INTO `site_info` (`id`, `attr_name`, `attr_value`) VALUES
(1, 'logo_pic', '1553272965.png'),
(2, 'test_next_to_logo', 'Favicon'),
(3, 'header_left_pic', '1553272965.png'),
(4, 'site_name', '...'),
(5, 'site_slogan', 'everything I need ...'),
(9, 'form_opacity', '1'),
(6, 'header_right_pic', '1548180905.png'),
(7, 'above_footer_pic', '1549780690.png'),
(8, 'footer_pic', '1548180820.PNG');

-- --------------------------------------------------------

--
-- Table structure for table `training`
--

CREATE TABLE `training` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `youtube_link` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `training`
--

INSERT INTO `training` (`id`, `title`, `image`, `youtube_link`, `created_at`, `updated_at`) VALUES
(1, 'T11111111111111111', '1552537202jpg', 'https://www.youtube.com/watch?v=oZFAcp-Qfbs', '2019-03-14 11:20:02', '2019-03-14 11:20:02'),
(2, '22222222222', '1552617979jpg', 'https://www.youtube.com/watch?v=hY7m5jjJ9mM', '2019-03-15 09:46:19', '2019-03-15 09:46:19');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'default.png',
  `IsAdmin` tinyint(1) DEFAULT NULL,
  `location` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone_no` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `paypal_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `photo_id` text COLLATE utf8_unicode_ci,
  `webcam_image` text COLLATE utf8_unicode_ci,
  `onlineStatus` int(11) DEFAULT NULL,
  `utc` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `verify_tokekn` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `verify_status` tinyint(1) NOT NULL,
  `cover_img` text COLLATE utf8_unicode_ci,
  `about` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `avatar`, `IsAdmin`, `location`, `phone_no`, `paypal_email`, `password`, `email_verified_at`, `remember_token`, `created_at`, `updated_at`, `status`, `photo_id`, `webcam_image`, `onlineStatus`, `utc`, `verify_tokekn`, `verify_status`, `cover_img`, `about`) VALUES
(2, 'Bakibillah Sakib', 'sakib192@gmail.com', 'default.png', NULL, NULL, NULL, NULL, '$2y$10$bzWRUgJtWHw1HDrCF/WadOvk5td24f7LoC4VjVez20g2XAFsrDlkS', NULL, NULL, '2018-11-16 12:09:19', '2018-11-16 12:09:19', '1', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL),
(3, 'Arefa', 'arefa@hi5.com', '1542355689.jpg', 1, NULL, NULL, NULL, '$2y$10$lv1HoFX7pJzsYxjPEuZn9ubov9UMUZLMZlsGLyafdIALrKDPPk6OC', NULL, 'nHOrkk8k5fIXpRK23z9Mg71ZYVrQ5njFBinUFsa1QkzVPSjE1pod7k93mIm1', '2018-11-16 13:45:36', '2018-11-16 14:08:09', '1', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL),
(4, 'Awais', 'awais@cbsurety.com', 'default.png', 1, NULL, NULL, NULL, '$2y$10$5A7Jtkle1JzHNcpkTXyRTupkTaSQF1kSowVI.YXNy.dLRyj0d1VSa', '2018-11-16 12:04:35', NULL, '2018-11-19 02:22:08', '2018-11-19 02:22:08', '1', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL),
(5, 'Arefa', 'arefa.akhter.nila@gmail.com', '1553478486.jpg', NULL, NULL, NULL, NULL, '$2y$10$jbFstj1yBMTnEQdnEuavW.eZCXpfKVkxN8EcFoCGiS.QmDiO38ojK', NULL, 'T8Clg0AO2let8tEyUT7YXwEJA4JC4WOMhHqgoiohtTcgJdkP49VNwHoW8Klp', '2018-11-19 02:23:45', '2019-03-25 08:48:12', '1', '1553360659.jpg', '1553360646.png', 1, '420', NULL, 0, '1553478492.jpg', '<p>Arefaaaaammmmmmaaaaaaaaaaaaaaaaaaaaa<strong>amnbmb,88888888888nbvbvn,n,lllllkkkkkk</strong></p>'),
(6, 'Muhammad Kashif', 'aa@aa.com', '1544338965.jpg', NULL, NULL, NULL, NULL, '$2y$10$6uVO5vV8cK0prwGcFq4/n.qL1WdWU9WLnPZ58z.EtWoKv9crCcWaC', NULL, 'LXZA93VZsIIp9a8MWEenu7pYurgW4CV6mbI0KC0jilPV3me0dCmFdap9lNSu', '2018-11-19 02:29:31', '2019-03-24 00:14:07', '1', NULL, NULL, 0, '420', NULL, 0, NULL, NULL),
(41, 'admin', 'admin@hi5.com', '1552869584.png', 1, NULL, NULL, NULL, '$2y$10$6uVO5vV8cK0prwGcFq4/n.qL1WdWU9WLnPZ58z.EtWoKv9crCcWaC', '2018-11-16 12:04:35', 'ssfDknzMN5tu3Pte5m5coaYaa2TjlJ4dRol7sGhw6nJkNNmLQVsMngfH6NpT', '2018-11-16 12:04:35', '2019-03-25 08:46:08', '1', '1552702969.jpg', '1552702975.png', 0, '420', NULL, 0, '1552869596.jpg', NULL),
(42, 'Ujjal', 'ujjal@hi5.com', '1542771611.JPG', NULL, NULL, NULL, NULL, '$2y$10$f9fqtlj4ISGjqR68dOFj1etBCDwfl2F9uOtaFBUHCZItk9Ipcmgvq', NULL, 'UKPebRGWkqLzYIbJ4qj8EOQoigcy7vk5AD0UZX2kxQ9bT66Adp8Z7yJzlyt7', '2018-11-21 09:36:16', '2018-11-21 09:40:11', '1', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL),
(43, 'Hamid Raza', 'badshah.hazor@gmail.com', 'default.png', NULL, NULL, NULL, NULL, '$2y$10$7EsnPOuhgVf2mwUSzPUvd.CFZ6jPLpnqhoGzYBvU78JzNq2C/9ECu', NULL, 'oyACFEx8fkcGxG6CurjyN13n3BwvwiIVEifqslWteXO7vGc8ZYJ8me4JY1wm', '2018-12-03 01:09:52', '2018-12-03 01:09:52', '1', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL),
(44, 'waqas767', 'waqas767@yahoo.com', 'default.png', NULL, NULL, NULL, NULL, '$2y$10$3aM6H6ZFgW3UUGiLQdPEDOb62vh6IaT9J4BcrqzdQilzAiAyh02x6', NULL, NULL, '2018-12-03 08:59:09', '2018-12-03 08:59:09', '1', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL),
(45, 'babar afzal', 'babarmalik6444@gmail.com', 'default.png', NULL, NULL, NULL, NULL, '$2y$10$AurO88j5fhBTrvxErZaVj.QOmhHoX7Ft.aqVH6.7qGOLJ79TJx6u2', NULL, NULL, '2018-12-04 05:43:09', '2018-12-04 05:43:09', '1', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL),
(46, 'Masum Kabir', 'mylearning705@gmail.com', 'default.png', NULL, NULL, NULL, NULL, '$2y$10$9qGpqlt6drufsZ82Qq/9L.oOjXvGLrfmfLNLnxMrxbYeQK/M9tm.G', NULL, 'jkoSnPhe8AGpLqYHzOfunEkictT90Gm8Fk4ulgKQXiRB3Tiu98vweonYn6MX', '2018-12-04 15:11:04', '2018-12-04 15:11:04', '1', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL),
(47, 'ankur', 'ankurmakavana7@gmail.com', 'default.png', NULL, NULL, NULL, NULL, '$2y$10$E1EH/1KEEO5nZ1FOjE5j4OjlOB/g8SlDR.Ixkp/ELG.ZcruwiyAJ.', NULL, NULL, '2018-12-08 14:51:25', '2018-12-08 14:51:25', '1', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL),
(48, 'Bakibillah Sakib', 'developer@sakibian.com', 'default.png', NULL, NULL, NULL, NULL, '$2y$10$vRsVUn0x448z1YLHR5OfHeV5YhTDSnK5IsdtAKbW1.L0y.RnR3JMS', NULL, NULL, '2018-12-24 17:23:27', '2018-12-24 17:23:27', '1', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL),
(49, 'Saleh', 'unmax.systems@gmail.com', 'default.png', NULL, NULL, NULL, NULL, '$2y$10$bvCSMBiK9FkEq/9GkdRQV.srJSKASmnXmHx68KjJ2/HO72SNHf01G', NULL, NULL, '2018-12-31 13:08:13', '2018-12-31 13:08:13', '1', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL),
(51, 'Abu Saleh Matul', 'saleh.matul@gmail.com', 'saleh.matul@gmail.com', NULL, 'Dhaka', '0101010', 'a@a.com', '$2y$10$MpOjpvYKdGHhhDxOer/rl.eZkLO4o7SB1YUQ4EcV13sj9nhA9Vc7i', '2019-02-27 18:00:00', NULL, '2019-02-28 13:53:41', '2019-02-28 13:55:12', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `menu_options_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_menu`
--

INSERT INTO `user_menu` (`id`, `user_id`, `menu_options_id`) VALUES
(461, 41, 23),
(460, 41, 19),
(459, 41, 18),
(458, 41, 17),
(457, 41, 22),
(456, 41, 16),
(455, 41, 15),
(424, 5, 23),
(423, 5, 19),
(422, 5, 18),
(421, 5, 17),
(420, 5, 22),
(419, 5, 16),
(418, 5, 15),
(75, 43, 10),
(76, 43, 1),
(77, 43, 7),
(78, 43, 2),
(79, 43, 3),
(80, 43, 4),
(81, 43, 5),
(82, 43, 6),
(83, 43, 8),
(84, 43, 9),
(454, 41, 9),
(453, 41, 8),
(452, 41, 6),
(451, 41, 5),
(450, 41, 4),
(449, 41, 3),
(448, 41, 2),
(447, 41, 7),
(417, 5, 9),
(416, 5, 8),
(415, 5, 6),
(414, 5, 5),
(413, 5, 4),
(412, 5, 3),
(411, 5, 2),
(410, 5, 7),
(409, 5, 1),
(408, 5, 14),
(446, 41, 1),
(445, 41, 14),
(444, 41, 10),
(407, 5, 10);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about`
--
ALTER TABLE `about`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `advertisements`
--
ALTER TABLE `advertisements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `balances`
--
ALTER TABLE `balances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bids`
--
ALTER TABLE `bids`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_posts`
--
ALTER TABLE `blog_posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `buyers`
--
ALTER TABLE `buyers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `buyers_buyer_item_code_unique` (`buyer_item_code`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chatrooms`
--
ALTER TABLE `chatrooms`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `chatrooms_chatroomid_unique` (`chatRoomId`);

--
-- Indexes for table `comment_post`
--
ALTER TABLE `comment_post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comment_reactions`
--
ALTER TABLE `comment_reactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupon`
--
ALTER TABLE `coupon`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `disputes`
--
ALTER TABLE `disputes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event_modals`
--
ALTER TABLE `event_modals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event_visitors`
--
ALTER TABLE `event_visitors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `examination`
--
ALTER TABLE `examination`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `follows`
--
ALTER TABLE `follows`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `home_page_setups`
--
ALTER TABLE `home_page_setups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `levels`
--
ALTER TABLE `levels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `memberships`
--
ALTER TABLE `memberships`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_options`
--
ALTER TABLE `menu_options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `professions`
--
ALTER TABLE `professions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `queries`
--
ALTER TABLE `queries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `replies`
--
ALTER TABLE `replies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `saved_posts`
--
ALTER TABLE `saved_posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sellers`
--
ALTER TABLE `sellers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sellers_seller_item_code_unique` (`seller_item_code`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site_info`
--
ALTER TABLE `site_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `training`
--
ALTER TABLE `training`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about`
--
ALTER TABLE `about`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `advertisements`
--
ALTER TABLE `advertisements`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `balances`
--
ALTER TABLE `balances`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `bids`
--
ALTER TABLE `bids`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `blog_posts`
--
ALTER TABLE `blog_posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `buyers`
--
ALTER TABLE `buyers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chatrooms`
--
ALTER TABLE `chatrooms`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `comment_post`
--
ALTER TABLE `comment_post`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `comment_reactions`
--
ALTER TABLE `comment_reactions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `coupon`
--
ALTER TABLE `coupon`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `disputes`
--
ALTER TABLE `disputes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `event_modals`
--
ALTER TABLE `event_modals`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `event_visitors`
--
ALTER TABLE `event_visitors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `examination`
--
ALTER TABLE `examination`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `faq`
--
ALTER TABLE `faq`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `follows`
--
ALTER TABLE `follows`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `home_page_setups`
--
ALTER TABLE `home_page_setups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `levels`
--
ALTER TABLE `levels`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `memberships`
--
ALTER TABLE `memberships`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menu_options`
--
ALTER TABLE `menu_options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `professions`
--
ALTER TABLE `professions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `queries`
--
ALTER TABLE `queries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `replies`
--
ALTER TABLE `replies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `saved_posts`
--
ALTER TABLE `saved_posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sellers`
--
ALTER TABLE `sellers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `site_info`
--
ALTER TABLE `site_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `training`
--
ALTER TABLE `training`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=462;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
