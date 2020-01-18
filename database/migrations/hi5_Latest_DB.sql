-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 27, 2019 at 07:43 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.1.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hi5`
--

-- --------------------------------------------------------

--
-- Table structure for table `about`
--

CREATE TABLE `about` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `about` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `link` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  `article_info_description` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
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
  `datwise` date NOT NULL,
  `transaction_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_pending` int(11) DEFAULT NULL,
  `transfer_to_user_id` int(11) DEFAULT NULL,
  `posted_by` int(11) DEFAULT NULL,
  `transaction_by` int(11) DEFAULT NULL,
  `is_freeze_or_refund` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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

-- --------------------------------------------------------

--
-- Table structure for table `blog_posts`
--

CREATE TABLE `blog_posts` (
  `id` int(10) UNSIGNED NOT NULL,
  `heading` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` text COLLATE utf8_unicode_ci DEFAULT NULL,
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
  `buyer_saved_status` int(11) NOT NULL,
  `buyer_category_option` tinyint(4) NOT NULL,
  `longitude` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `latitude` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `service_option` tinyint(4) NOT NULL,
  `hour` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `rate` varchar(255) COLLATE utf8_unicode_ci NOT NULL
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
  `shipping_method` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `selected_product` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  `event_description` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `event_modal_image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_published` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'no',
  `edited` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `edited_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `event_fee_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Free',
  `event_fee` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'If event not free',
  `event_referral_commission` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `latitude` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `longitude` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  `event_id` int(11) DEFAULT NULL,
  `event_end_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `goingstatus` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'going or not going'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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

-- --------------------------------------------------------

--
-- Table structure for table `faq_categories`
--

CREATE TABLE `faq_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `faq_parent_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `icon` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faq_parents`
--

CREATE TABLE `faq_parents` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `icon` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

CREATE TABLE `favorites` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `favoriteable_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `favoriteable_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `follows`
--

CREATE TABLE `follows` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `followable_id` int(10) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
(1, 'User Access', '/UserAccess', 21, 'profile_drop_down'),
(2, 'HelpDesk Agent', '/admin', 12, 'profile_drop_down'),
(3, 'Category Setup', '/CategorySetup', 7, 'profile_drop_down'),
(4, 'Admin Panel', '/admin', 2, 'profile_drop_down'),
(5, 'Upcoming Services', '/admin', 20, 'profile_drop_down'),
(6, 'Settings', '/settings', 18, 'profile_drop_down'),
(7, 'Query Screen', '/QueryScreen', 16, 'profile_drop_down'),
(8, 'Brand Admin', '/brandupdate', 6, 'profile_drop_down'),
(9, 'Accountant', '/accountant', 1, 'profile_drop_down'),
(10, 'Advertisement', '/advertisement', 3, 'profile_drop_down'),
(14, 'Membership Admin', '/membership', 14, 'profile_drop_down'),
(15, 'Homepage Setup', '/homepage-setup', 13, 'profile_drop_down'),
(16, 'Training Setup', '/trainsetup', 19, 'profile_drop_down'),
(17, 'Exam Setup', '/examsetup', 10, 'profile_drop_down'),
(18, 'Event Admin', '/events', 9, 'style=\"float:right;margin-right: -124px;'),
(19, 'Blog Admin', '/public-blog', 5, 'profile_drop_down'),
(22, 'Send Email', '/sendemailforunread', 17, 'profile_drop_down'),
(23, 'Faq Setup', '/faqsetup', 11, 'profile_drop_down'),
(56, 'Dispute Manager', '/dispute', 8, 'profile_drop_down'),
(57, 'Bid Admin', '/usertaxi', 4, 'profile_drop_down'),
(58, 'More Admin', '/More', 15, 'profile_drop_down');

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
(80, '2019_03_23_181733_create_about_page', 12),
(81, '2019_03_25_190843_create_faq_category_parent_table', 13),
(82, '2019_03_25_191020_create_faq_category_table', 13),
(83, '2019_03_28_061944_add_transaction_to_balances', 13),
(84, '2019_04_17_172843_add_lat_and_long', 13),
(85, '2019_05_07_111009_create_favorites_table', 13),
(86, '2019_05_12_060459_create_taxis_table', 13),
(87, '2019_05_14_203457_add_is_pending_to_balance', 13),
(88, '2019_05_15_133134_add_transfer_to_user_id_balance', 13),
(89, '2019_05_24_115349_add_transfer_by_clolumn_to_table', 13),
(90, '2019_07_31_052805_create_temp_event_date_time', 13),
(91, '2019_07_31_054541_add_event_fee_type_to_events', 13),
(92, '2019_07_31_055648_add_event_end_date_to_event_modals', 13),
(93, '2019_08_16_125704_update_evnets_description', 13),
(94, '2019_08_16_130111_add_events_lat_lon', 13),
(95, '2019_10_02_111021_create_referral_post_table', 13),
(96, '2019_10_07_210853_modify_buyer_table', 13),
(97, '2019_10_08_201614_create_post_bids_table', 13),
(98, '2019_10_18_120336_change_post_bid_table_status', 13),
(99, '2019_10_19_212708_add_bid_id_into_reivew_table', 13);

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
-- Table structure for table `post_bids`
--

CREATE TABLE `post_bids` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `bid_type` enum('buy','sell') COLLATE utf8_unicode_ci DEFAULT NULL,
  `reference_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'buyer table id or seller table id',
  `amount` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` enum('pending','ordered','in_process','delivered','paid','closed','got_dispute','send_dispute','got_dispute_accept','send_dispute_accept','got_dispute_decline','send_dispute_decline') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'pending',
  `due_date` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reference_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
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
-- Table structure for table `referral_post`
--

CREATE TABLE `referral_post` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `referred_id` int(11) NOT NULL DEFAULT 0,
  `event_id` int(11) NOT NULL DEFAULT 0,
  `referral_per` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `post_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
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

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `reviewable_id` int(10) UNSIGNED NOT NULL,
  `review_number` decimal(2,1) DEFAULT NULL,
  `review_text` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `reviewable_type` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1 => profile',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `bid_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'for checking review on order bid'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  `paypal_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `paypal_client_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `paypal_secret_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
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
-- Table structure for table `taxis`
--

CREATE TABLE `taxis` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `vahical_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `referral` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `car_image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `license_image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `registration_images` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `security_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `rate_per_our` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `location` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `condition_note` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_booked` tinyint(4) NOT NULL DEFAULT 0,
  `status` tinyint(4) NOT NULL DEFAULT 2,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `temp_event_date_time`
--

CREATE TABLE `temp_event_date_time` (
  `id` int(10) UNSIGNED NOT NULL,
  `temp_event_id` int(11) NOT NULL DEFAULT 0,
  `start_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `start_hours` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `start_minit` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `start_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `end_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `end_hours` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `end_minit` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `end_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `goingstatus` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  `photo_id` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `webcam_image` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `onlineStatus` int(11) DEFAULT NULL,
  `utc` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `verify_tokekn` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `verify_status` tinyint(1) NOT NULL,
  `cover_img` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `about` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `alt` decimal(8,2) DEFAULT NULL,
  `lng` decimal(8,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `avatar`, `IsAdmin`, `location`, `phone_no`, `paypal_email`, `password`, `email_verified_at`, `remember_token`, `created_at`, `updated_at`, `status`, `photo_id`, `webcam_image`, `onlineStatus`, `utc`, `verify_tokekn`, `verify_status`, `cover_img`, `about`, `alt`, `lng`) VALUES
(2, 'Bakibillah Sakib', 'sakib192@gmail.com', 'default.png', NULL, NULL, NULL, NULL, '$2y$10$bzWRUgJtWHw1HDrCF/WadOvk5td24f7LoC4VjVez20g2XAFsrDlkS', NULL, NULL, '2018-11-16 12:09:19', '2018-11-16 12:09:19', '1', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(3, 'Arefa', 'arefa@hi5.com', '1542355689.jpg', 1, NULL, NULL, NULL, '$2y$10$lv1HoFX7pJzsYxjPEuZn9ubov9UMUZLMZlsGLyafdIALrKDPPk6OC', NULL, 'nHOrkk8k5fIXpRK23z9Mg71ZYVrQ5njFBinUFsa1QkzVPSjE1pod7k93mIm1', '2018-11-16 13:45:36', '2018-11-16 14:08:09', '1', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(4, 'Awais', 'awais@cbsurety.com', 'default.png', 1, NULL, NULL, NULL, '$2y$10$5A7Jtkle1JzHNcpkTXyRTupkTaSQF1kSowVI.YXNy.dLRyj0d1VSa', '2018-11-16 12:04:35', NULL, '2018-11-19 02:22:08', '2018-11-19 02:22:08', '1', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(5, 'Arefa', 'arefa.akhter.nila@gmail.com', '1553478486.jpg', NULL, NULL, NULL, NULL, '$2y$10$jbFstj1yBMTnEQdnEuavW.eZCXpfKVkxN8EcFoCGiS.QmDiO38ojK', NULL, 'T8Clg0AO2let8tEyUT7YXwEJA4JC4WOMhHqgoiohtTcgJdkP49VNwHoW8Klp', '2018-11-19 02:23:45', '2019-03-25 08:48:12', '1', '1553360659.jpg', '1553360646.png', 1, '420', NULL, 0, '1553478492.jpg', '<p>Arefaaaaammmmmmaaaaaaaaaaaaaaaaaaaaa<strong>amnbmb,88888888888nbvbvn,n,lllllkkkkkk</strong></p>', NULL, NULL),
(6, 'Muhammad Kashif', 'aa@aa.com', '1544338965.jpg', NULL, NULL, NULL, NULL, '$2y$10$6uVO5vV8cK0prwGcFq4/n.qL1WdWU9WLnPZ58z.EtWoKv9crCcWaC', NULL, 'LXZA93VZsIIp9a8MWEenu7pYurgW4CV6mbI0KC0jilPV3me0dCmFdap9lNSu', '2018-11-19 02:29:31', '2019-03-24 00:14:07', '1', NULL, NULL, 0, '420', NULL, 0, NULL, NULL, NULL, NULL),
(41, 'admin', 'admin@hi5.com', '1552869584.png', 1, NULL, NULL, NULL, '$2y$10$6uVO5vV8cK0prwGcFq4/n.qL1WdWU9WLnPZ58z.EtWoKv9crCcWaC', '2018-11-16 12:04:35', 'ssfDknzMN5tu3Pte5m5coaYaa2TjlJ4dRol7sGhw6nJkNNmLQVsMngfH6NpT', '2018-11-16 12:04:35', '2019-03-25 08:46:08', '1', '1552702969.jpg', '1552702975.png', 0, '420', NULL, 0, '1552869596.jpg', NULL, NULL, NULL),
(42, 'Ujjal', 'ujjal@hi5.com', '1542771611.JPG', NULL, NULL, NULL, NULL, '$2y$10$f9fqtlj4ISGjqR68dOFj1etBCDwfl2F9uOtaFBUHCZItk9Ipcmgvq', NULL, 'UKPebRGWkqLzYIbJ4qj8EOQoigcy7vk5AD0UZX2kxQ9bT66Adp8Z7yJzlyt7', '2018-11-21 09:36:16', '2018-11-21 09:40:11', '1', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(43, 'Hamid Raza', 'badshah.hazor@gmail.com', 'default.png', NULL, NULL, NULL, NULL, '$2y$10$7EsnPOuhgVf2mwUSzPUvd.CFZ6jPLpnqhoGzYBvU78JzNq2C/9ECu', NULL, 'oyACFEx8fkcGxG6CurjyN13n3BwvwiIVEifqslWteXO7vGc8ZYJ8me4JY1wm', '2018-12-03 01:09:52', '2018-12-03 01:09:52', '1', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(44, 'waqas767', 'waqas767@yahoo.com', 'default.png', NULL, NULL, NULL, NULL, '$2y$10$3aM6H6ZFgW3UUGiLQdPEDOb62vh6IaT9J4BcrqzdQilzAiAyh02x6', NULL, NULL, '2018-12-03 08:59:09', '2018-12-03 08:59:09', '1', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(45, 'babar afzal', 'babarmalik6444@gmail.com', 'default.png', NULL, NULL, NULL, NULL, '$2y$10$AurO88j5fhBTrvxErZaVj.QOmhHoX7Ft.aqVH6.7qGOLJ79TJx6u2', NULL, NULL, '2018-12-04 05:43:09', '2018-12-04 05:43:09', '1', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(46, 'Masum Kabir', 'mylearning705@gmail.com', 'default.png', NULL, NULL, NULL, NULL, '$2y$10$9qGpqlt6drufsZ82Qq/9L.oOjXvGLrfmfLNLnxMrxbYeQK/M9tm.G', NULL, 'jkoSnPhe8AGpLqYHzOfunEkictT90Gm8Fk4ulgKQXiRB3Tiu98vweonYn6MX', '2018-12-04 15:11:04', '2018-12-04 15:11:04', '1', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(47, 'ankur', 'ankurmakavana7@gmail.com', 'default.png', NULL, NULL, NULL, NULL, '$2y$10$E1EH/1KEEO5nZ1FOjE5j4OjlOB/g8SlDR.Ixkp/ELG.ZcruwiyAJ.', NULL, NULL, '2018-12-08 14:51:25', '2018-12-08 14:51:25', '1', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(48, 'Bakibillah Sakib', 'developer@sakibian.com', 'default.png', NULL, NULL, NULL, NULL, '$2y$10$vRsVUn0x448z1YLHR5OfHeV5YhTDSnK5IsdtAKbW1.L0y.RnR3JMS', NULL, NULL, '2018-12-24 17:23:27', '2018-12-24 17:23:27', '1', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(49, 'Saleh', 'unmax.systems@gmail.com', 'default.png', NULL, NULL, NULL, NULL, '$2y$10$bvCSMBiK9FkEq/9GkdRQV.srJSKASmnXmHx68KjJ2/HO72SNHf01G', NULL, NULL, '2018-12-31 13:08:13', '2018-12-31 13:08:13', '1', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(51, 'Abu Saleh Matul', 'saleh.matul@gmail.com', 'saleh.matul@gmail.com', NULL, 'Dhaka', '0101010', 'a@a.com', '$2y$10$MpOjpvYKdGHhhDxOer/rl.eZkLO4o7SB1YUQ4EcV13sj9nhA9Vc7i', '2019-02-27 18:00:00', NULL, '2019-02-28 13:53:41', '2019-02-28 13:55:12', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(52, 'escrow', 'escrow@hi5.com', 'default.png', NULL, NULL, NULL, NULL, '$2y$10$RaVlcf34pNpThCxHUrUszOa3byWK4ZCCefYrfOMfrBrzUGZXq2tTC', '2019-10-26 01:29:40', NULL, '2019-10-26 01:29:40', '2019-10-26 01:29:40', '1', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(53, 'hi5', 'hi5@hi5.com', 'default.png', NULL, NULL, NULL, NULL, '$2y$10$mUGotfAPcN6PKKpne8sJcONZ97HY3LcdPiO7oUmZx8ODqpJIU/obG', '2019-10-26 01:29:40', NULL, '2019-10-26 01:29:40', '2019-10-26 01:29:40', '1', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL);

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
-- Indexes for table `faq_categories`
--
ALTER TABLE `faq_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `faq_categories_faq_parent_id_foreign` (`faq_parent_id`);

--
-- Indexes for table `faq_parents`
--
ALTER TABLE `faq_parents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`user_id`,`favoriteable_id`,`favoriteable_type`),
  ADD KEY `favorites_favoriteable_type_favoriteable_id_index` (`favoriteable_type`,`favoriteable_id`),
  ADD KEY `favorites_user_id_index` (`user_id`);

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
-- Indexes for table `post_bids`
--
ALTER TABLE `post_bids`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `referral_post`
--
ALTER TABLE `referral_post`
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
-- Indexes for table `taxis`
--
ALTER TABLE `taxis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `temp_event_date_time`
--
ALTER TABLE `temp_event_date_time`
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
-- AUTO_INCREMENT for table `faq_categories`
--
ALTER TABLE `faq_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faq_parents`
--
ALTER TABLE `faq_parents`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `post_bids`
--
ALTER TABLE `post_bids`
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
-- AUTO_INCREMENT for table `referral_post`
--
ALTER TABLE `referral_post`
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
-- AUTO_INCREMENT for table `taxis`
--
ALTER TABLE `taxis`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `temp_event_date_time`
--
ALTER TABLE `temp_event_date_time`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `training`
--
ALTER TABLE `training`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=462;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `faq_categories`
--
ALTER TABLE `faq_categories`
  ADD CONSTRAINT `faq_categories_faq_parent_id_foreign` FOREIGN KEY (`faq_parent_id`) REFERENCES `faq_parents` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
