-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 15, 2025 at 01:58 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nepaldela`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `articles_id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subtitle` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alias` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent` int DEFAULT NULL,
  `cover` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thumb` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `entries` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `remarks` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `seo_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seo_keyword` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seo_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `display_order` int DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1',
  `createdby` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updatedby` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`articles_id`, `title`, `subtitle`, `alias`, `parent`, `cover`, `thumb`, `description`, `entries`, `remarks`, `seo_title`, `seo_keyword`, `seo_description`, `display_order`, `status`, `createdby`, `updatedby`, `created_at`, `updated_at`) VALUES
(1, 'About Us', 'We Empower What you need', 'about-us', NULL, 'storage/photos/1/about/01.jpg', 'storage/photos/1/about/02.jpg', '<p>Nepal Dela Consultancy Pvt. Ltd. is a dynamic and professionally led educational company dedicated to advancing global learning opportunities for Nepalese students. Managed by seasoned academic professionals, we specialize in connecting students with top-tier Bachelor&#39;s, Master&#39;s, and professional programs offered by leading institutions worldwide. We collaborate with universities and colleges across the USA, UK, Australia, Canada, New Zealand, Japan, and Europe to meet Nepal&rsquo;s growing demand for quality overseas education and help students thrive in a competitive global environment.</p>\r\n\r\n<div class=\"about-list-wrapper\">\r\n<ul>\r\n	<li>\r\n	<div class=\"icon\">&nbsp;</div>\r\n\r\n	<div class=\"text\">\r\n	<p>Professionally managed by experts with strong academic credentials</p>\r\n	</div>\r\n	</li>\r\n	<li>\r\n	<div class=\"icon\">&nbsp;</div>\r\n\r\n	<div class=\"text\">\r\n	<p>Dedicated to promoting international education and global exposure</p>\r\n	</div>\r\n	</li>\r\n	<li>\r\n	<div class=\"icon\">&nbsp;</div>\r\n\r\n	<div class=\"text\">\r\n	<p>Partnered with institutions in the USA, UK, Australia, Canada, Japan &amp; more</p>\r\n	</div>\r\n	</li>\r\n	<li>\r\n	<div class=\"icon\">&nbsp;</div>\r\n\r\n	<div class=\"text\">\r\n	<p>Committed to addressing Nepal&rsquo;s growing demand for quality education abroad</p>\r\n	</div>\r\n	</li>\r\n</ul>\r\n</div>', NULL, NULL, NULL, NULL, NULL, 1, 1, '1', '1', '2025-05-17 11:14:50', '2025-06-14 19:54:37'),
(2, 'Career Guidance', NULL, 'career-guidance', NULL, 'storage/photos/1/service/single-8.jpg', 'storage/photos/1/service/04.jpg', '<p>We help you align your interests, skills, and potential with the right career path before choosing your study destination. Let us turn your aspirations into reality.</p>', NULL, NULL, NULL, NULL, NULL, 3, 1, '1', '1', '2025-05-19 08:21:34', '2025-06-07 06:52:35'),
(3, 'Building Your Global Future Together', 'Why Choose US', 'united-states', NULL, 'storage/photos/1/service/single-4.jpg', 'storage/photos/1/service/single-2.jpg', '<p>Nepal Dela pairs deep academic expertise with end-to-end support to make your overseas education journey seamless and successful.</p>', '[{\"title\":\"Personalized Guidance\",\"subtitle\":\"\",\"description\":\"<p>Tailored advice on career paths, country &amp; university selection, and program matches&mdash;designed around your goals.</p>\",\"extraImg\":\"flaticon-checking\"},{\"title\":\"Document & Application Support\",\"subtitle\":\"\",\"description\":\"<p>Expert assistance with form-filling, SOPs, recommendation letters, and all required documentation.</p>\",\"extraImg\":\"flaticon-education\"},{\"title\":\"High Visa Success Rate\",\"subtitle\":\"\",\"description\":\"<p>Up-to-date immigration expertise and end-to-end visa assistance to maximize your application approval.</p>\",\"extraImg\":\"flaticon-technology\"}]', NULL, NULL, NULL, NULL, 2, 1, '1', '1', '2025-05-19 08:24:35', '2025-06-14 19:55:09'),
(4, 'Delivering the Right Guidance Every Step', 'Our Expertise', 'delivering-the-right-guidance-every-step', NULL, 'storage/photos/1/service/05.jpg', 'storage/photos/1/service/single-8.jpg', '<p>At Nepal Dela, we combine strategic planning, global academic insights, and proven immigration knowledge to help you achieve success abroad &mdash; from consultation to visa approval.</p>', '[{\"title\":\"Student Counseling\",\"subtitle\":\"90\",\"description\":\"<p>Description</p>\",\"extraImg\":\"\"},{\"title\":\"Visa Processing Support\",\"subtitle\":\"80\",\"description\":\"<p>Description</p>\",\"extraImg\":\"\"},{\"title\":\"Pre-Departure & Settlement\",\"subtitle\":\"75\",\"description\":\"<p>Description</p>\",\"extraImg\":\"\"}]', NULL, NULL, NULL, NULL, 4, 1, '1', '1', '2025-06-08 09:27:14', '2025-06-08 09:29:03'),
(5, 'United Kingdom', 'The Great Britain', 'united-kingdom', NULL, 'storage/photos/1/country/single-2.jpg', 'storage/photos/1/country/03.jpg,storage/photos/1/country/uk.jpg', '<p>The United Kingdom is one of the most prestigious and globally respected destinations for higher education, business migration, and skilled professionals. With its centuries-old universities, dynamic cities, and global economic influence, the UK offers an ideal environment for personal, academic, and professional growth.</p>\r\n\r\n<p>Whether you&#39;re seeking world-class education at Oxford or Cambridge, entering the UK job market with a Skilled Worker visa, or exploring start-up and innovator visa pathways, the UK provides structured and efficient immigration routes. The Graduate Route also allows international students to stay and work after completing their studies.</p>\r\n\r\n<p>The UK&#39;s multicultural society, high standard of living, and strong legal and healthcare systems make it one of the most attractive countries for international students and professionals. Institutions offer globally recognized degrees, while employers value the UK&#39;s skilled graduates for their international exposure and industry alignment.</p>', NULL, NULL, NULL, NULL, NULL, 5, 1, '1', '1', '2025-06-10 20:23:03', '2025-06-10 20:25:22'),
(6, 'Abroad Study: Unlock Your Global Future', 'Everything You Need to Know Before Taking the Leap', 'abroad-study-unlock-your-global-future', NULL, 'storage/photos/1/slider/slider-3.jpg', 'storage/photos/1/counter/01.jpg', '<p>Studying abroad opens doors to new cultures, experiences, and career opportunities. This blog covers essential tips, challenges, and benefits of pursuing education in a foreign country.<br />\r\n&nbsp; &nbsp;</p>', '[{\"title\":\"Choosing the Right Destination\",\"subtitle\":\"Find Your Perfect Study Spot\",\"description\":\"<p>Research the culture, language, and education system of potential countries. Consider visa policies, living costs, and course availability to make an informed decision.<br />\\n&nbsp; &nbsp; &nbsp;&nbsp;</p>\",\"extraImg\":\"\"},{\"title\":\"Application Process\",\"subtitle\":\"Step-by-Step Guide\",\"description\":\"<p>Prepare your documents, write a compelling statement of purpose, and ace your interviews. Early planning is key to securing admission and scholarships.</p>\",\"extraImg\":\"\"},{\"title\":\"Adapting to a New Environment\",\"subtitle\":\"Tips for Smooth Transition\",\"description\":\"<p>Cultural shock is real. Build connections, join student groups, and explore local customs to feel at home quickly.</p>\",\"extraImg\":\"\"}]', NULL, NULL, NULL, NULL, 6, 1, '1', '1', '2025-06-10 21:45:41', '2025-06-10 21:45:41');

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `blogs_id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subtitle` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `author` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alias` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent` int DEFAULT NULL,
  `cover` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thumb` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `entries` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `remarks` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `seo_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seo_keyword` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seo_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `display_order` int DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1',
  `createdby` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updatedby` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`blogs_id`, `title`, `subtitle`, `author`, `alias`, `parent`, `cover`, `thumb`, `description`, `entries`, `remarks`, `seo_title`, `seo_keyword`, `seo_description`, `display_order`, `status`, `createdby`, `updatedby`, `created_at`, `updated_at`) VALUES
(1, 'How to Choose the Right Country for Your Higher Studies', 'It is a long established fact that a reader', NULL, 'test-data', NULL, 'storage/photos/1/breadcrumb/breadcrumb.jpg', 'storage/photos/1/blog/02.jpg', '<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</p>\r\n\r\n<p>But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful.</p>\r\n\r\n<p>In a free hour when our power of choice is untrammelled and when nothing prevents our being able to do what we like best, every pleasure is to be welcomed and every pain avoided. But in certain circumstances and owing to the claims of duty or the obligations of business it will frequently occur that pleasures have to be repudiated and annoyances accepted. The wise man therefore always holds in these matters to this principle of selection.</p>\r\n\r\n<p>Power of choice is untrammelled and when nothing prevents our being able to do what we like best, every pleasure is to be welcomed and every pain avoided. But in certain circumstances and owing to the claims of duty or the obligations of business it will frequently occur that pleasures have to be repudiated and annoyances accepted. The wise man therefore always holds in these matters to this principle of selection.</p>\r\n\r\n<h5>&nbsp;</h5>', NULL, NULL, NULL, NULL, NULL, 1, 1, '1', '1', '2025-05-17 21:20:43', '2025-06-10 21:41:22'),
(2, 'second item', NULL, NULL, 'second-item', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 1, '1', '1', '2025-05-17 21:20:56', '2025-06-10 21:41:02'),
(3, 'thire item', NULL, NULL, 'thire-item', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 1, '1', '1', '2025-05-17 21:21:15', '2025-05-17 21:21:15');

-- --------------------------------------------------------

--
-- Table structure for table `buttons`
--

CREATE TABLE `buttons` (
  `buttons_id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alias` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#',
  `target` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '_self',
  `location` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `entries` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `display_order` int DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1',
  `createdby` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updatedby` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `buttons`
--

INSERT INTO `buttons` (`buttons_id`, `title`, `alias`, `url`, `target`, `location`, `entries`, `display_order`, `status`, `createdby`, `updatedby`, `created_at`, `updated_at`) VALUES
(1, 'View Detail', 'view-detail', 'templates,26', '_self', NULL, 'templates,26', 2, 1, '1', '1', '2025-06-10 20:47:52', '2025-06-10 21:35:02'),
(2, 'Country Detail', 'read-more', 'countries,1', '_self', NULL, 'countries,1', 1, 1, '1', '1', '2025-06-10 21:23:35', '2025-06-14 20:11:27'),
(3, 'Read More', 'read-more', 'templates,26', '_self', NULL, 'templates,26', 3, 1, '1', '1', '2025-06-10 21:39:53', '2025-06-10 21:39:53'),
(4, 'View Detail', 'view-detail', 'templates,26', '_self', NULL, 'templates,26', 4, 1, '1', '1', '2025-06-11 08:25:56', '2025-06-11 08:25:56');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('spatie.permission.cache', 'a:3:{s:5:\"alias\";a:3:{s:1:\"a\";s:2:\"id\";s:1:\"b\";s:4:\"name\";s:1:\"c\";s:10:\"guard_name\";}s:11:\"permissions\";a:191:{i:0;a:3:{s:1:\"a\";i:1;s:1:\"b\";s:17:\"unisharp.lfm.show\";s:1:\"c\";s:3:\"web\";}i:1;a:3:{s:1:\"a\";i:2;s:1:\"b\";s:9:\"dashboard\";s:1:\"c\";s:3:\"web\";}i:2;a:3:{s:1:\"a\";i:3;s:1:\"b\";s:5:\"error\";s:1:\"c\";s:3:\"web\";}i:3;a:3:{s:1:\"a\";i:4;s:1:\"b\";s:12:\"profile.edit\";s:1:\"c\";s:3:\"web\";}i:4;a:3:{s:1:\"a\";i:5;s:1:\"b\";s:14:\"profile.update\";s:1:\"c\";s:3:\"web\";}i:5;a:3:{s:1:\"a\";i:6;s:1:\"b\";s:15:\"profile.destroy\";s:1:\"c\";s:3:\"web\";}i:6;a:3:{s:1:\"a\";i:7;s:1:\"b\";s:14:\"articles.index\";s:1:\"c\";s:3:\"web\";}i:7;a:3:{s:1:\"a\";i:8;s:1:\"b\";s:15:\"articles.create\";s:1:\"c\";s:3:\"web\";}i:8;a:3:{s:1:\"a\";i:9;s:1:\"b\";s:14:\"articles.store\";s:1:\"c\";s:3:\"web\";}i:9;a:3:{s:1:\"a\";i:10;s:1:\"b\";s:13:\"articles.edit\";s:1:\"c\";s:3:\"web\";}i:10;a:3:{s:1:\"a\";i:11;s:1:\"b\";s:15:\"articles.update\";s:1:\"c\";s:3:\"web\";}i:11;a:3:{s:1:\"a\";i:12;s:1:\"b\";s:13:\"articles.view\";s:1:\"c\";s:3:\"web\";}i:12;a:3:{s:1:\"a\";i:13;s:1:\"b\";s:15:\"articles.delete\";s:1:\"c\";s:3:\"web\";}i:13;a:3:{s:1:\"a\";i:14;s:1:\"b\";s:14:\"articles.alias\";s:1:\"c\";s:3:\"web\";}i:14;a:3:{s:1:\"a\";i:15;s:1:\"b\";s:16:\"articles.publish\";s:1:\"c\";s:3:\"web\";}i:15;a:3:{s:1:\"a\";i:16;s:1:\"b\";s:20:\"articles.updateOrder\";s:1:\"c\";s:3:\"web\";}i:16;a:3:{s:1:\"a\";i:17;s:1:\"b\";s:11:\"roles.index\";s:1:\"c\";s:3:\"web\";}i:17;a:3:{s:1:\"a\";i:18;s:1:\"b\";s:11:\"roles.store\";s:1:\"c\";s:3:\"web\";}i:18;a:3:{s:1:\"a\";i:19;s:1:\"b\";s:10:\"roles.edit\";s:1:\"c\";s:3:\"web\";}i:19;a:3:{s:1:\"a\";i:20;s:1:\"b\";s:12:\"roles.update\";s:1:\"c\";s:3:\"web\";}i:20;a:3:{s:1:\"a\";i:21;s:1:\"b\";s:10:\"roles.view\";s:1:\"c\";s:3:\"web\";}i:21;a:3:{s:1:\"a\";i:22;s:1:\"b\";s:12:\"roles.delete\";s:1:\"c\";s:3:\"web\";}i:22;a:3:{s:1:\"a\";i:23;s:1:\"b\";s:11:\"roles.alias\";s:1:\"c\";s:3:\"web\";}i:23;a:3:{s:1:\"a\";i:24;s:1:\"b\";s:13:\"roles.publish\";s:1:\"c\";s:3:\"web\";}i:24;a:3:{s:1:\"a\";i:25;s:1:\"b\";s:17:\"roles.updateOrder\";s:1:\"c\";s:3:\"web\";}i:25;a:3:{s:1:\"a\";i:26;s:1:\"b\";s:14:\"settings.index\";s:1:\"c\";s:3:\"web\";}i:26;a:3:{s:1:\"a\";i:27;s:1:\"b\";s:15:\"settings.create\";s:1:\"c\";s:3:\"web\";}i:27;a:3:{s:1:\"a\";i:28;s:1:\"b\";s:14:\"settings.store\";s:1:\"c\";s:3:\"web\";}i:28;a:3:{s:1:\"a\";i:29;s:1:\"b\";s:13:\"settings.edit\";s:1:\"c\";s:3:\"web\";}i:29;a:3:{s:1:\"a\";i:30;s:1:\"b\";s:15:\"settings.update\";s:1:\"c\";s:3:\"web\";}i:30;a:3:{s:1:\"a\";i:31;s:1:\"b\";s:13:\"settings.view\";s:1:\"c\";s:3:\"web\";}i:31;a:3:{s:1:\"a\";i:32;s:1:\"b\";s:15:\"settings.delete\";s:1:\"c\";s:3:\"web\";}i:32;a:3:{s:1:\"a\";i:33;s:1:\"b\";s:14:\"settings.alias\";s:1:\"c\";s:3:\"web\";}i:33;a:3:{s:1:\"a\";i:34;s:1:\"b\";s:16:\"settings.publish\";s:1:\"c\";s:3:\"web\";}i:34;a:3:{s:1:\"a\";i:35;s:1:\"b\";s:20:\"settings.updateOrder\";s:1:\"c\";s:3:\"web\";}i:35;a:3:{s:1:\"a\";i:36;s:1:\"b\";s:11:\"users.index\";s:1:\"c\";s:3:\"web\";}i:36;a:3:{s:1:\"a\";i:37;s:1:\"b\";s:12:\"users.create\";s:1:\"c\";s:3:\"web\";}i:37;a:3:{s:1:\"a\";i:38;s:1:\"b\";s:11:\"users.store\";s:1:\"c\";s:3:\"web\";}i:38;a:3:{s:1:\"a\";i:39;s:1:\"b\";s:10:\"users.edit\";s:1:\"c\";s:3:\"web\";}i:39;a:3:{s:1:\"a\";i:40;s:1:\"b\";s:12:\"users.update\";s:1:\"c\";s:3:\"web\";}i:40;a:3:{s:1:\"a\";i:41;s:1:\"b\";s:10:\"users.view\";s:1:\"c\";s:3:\"web\";}i:41;a:3:{s:1:\"a\";i:42;s:1:\"b\";s:12:\"users.delete\";s:1:\"c\";s:3:\"web\";}i:42;a:3:{s:1:\"a\";i:43;s:1:\"b\";s:11:\"users.alias\";s:1:\"c\";s:3:\"web\";}i:43;a:3:{s:1:\"a\";i:44;s:1:\"b\";s:13:\"users.publish\";s:1:\"c\";s:3:\"web\";}i:44;a:3:{s:1:\"a\";i:45;s:1:\"b\";s:17:\"users.updateOrder\";s:1:\"c\";s:3:\"web\";}i:45;a:3:{s:1:\"a\";i:46;s:1:\"b\";s:11:\"menus.index\";s:1:\"c\";s:3:\"web\";}i:46;a:3:{s:1:\"a\";i:47;s:1:\"b\";s:12:\"menus.create\";s:1:\"c\";s:3:\"web\";}i:47;a:3:{s:1:\"a\";i:48;s:1:\"b\";s:11:\"menus.store\";s:1:\"c\";s:3:\"web\";}i:48;a:3:{s:1:\"a\";i:49;s:1:\"b\";s:10:\"menus.edit\";s:1:\"c\";s:3:\"web\";}i:49;a:3:{s:1:\"a\";i:50;s:1:\"b\";s:12:\"menus.update\";s:1:\"c\";s:3:\"web\";}i:50;a:3:{s:1:\"a\";i:51;s:1:\"b\";s:10:\"menus.view\";s:1:\"c\";s:3:\"web\";}i:51;a:3:{s:1:\"a\";i:52;s:1:\"b\";s:12:\"menus.delete\";s:1:\"c\";s:3:\"web\";}i:52;a:3:{s:1:\"a\";i:53;s:1:\"b\";s:11:\"menus.alias\";s:1:\"c\";s:3:\"web\";}i:53;a:3:{s:1:\"a\";i:54;s:1:\"b\";s:13:\"menus.publish\";s:1:\"c\";s:3:\"web\";}i:54;a:3:{s:1:\"a\";i:55;s:1:\"b\";s:17:\"menus.updateOrder\";s:1:\"c\";s:3:\"web\";}i:55;a:3:{s:1:\"a\";i:56;s:1:\"b\";s:11:\"blogs.index\";s:1:\"c\";s:3:\"web\";}i:56;a:3:{s:1:\"a\";i:57;s:1:\"b\";s:12:\"blogs.create\";s:1:\"c\";s:3:\"web\";}i:57;a:3:{s:1:\"a\";i:58;s:1:\"b\";s:11:\"blogs.store\";s:1:\"c\";s:3:\"web\";}i:58;a:3:{s:1:\"a\";i:59;s:1:\"b\";s:10:\"blogs.edit\";s:1:\"c\";s:3:\"web\";}i:59;a:3:{s:1:\"a\";i:60;s:1:\"b\";s:12:\"blogs.update\";s:1:\"c\";s:3:\"web\";}i:60;a:3:{s:1:\"a\";i:61;s:1:\"b\";s:10:\"blogs.view\";s:1:\"c\";s:3:\"web\";}i:61;a:3:{s:1:\"a\";i:62;s:1:\"b\";s:12:\"blogs.delete\";s:1:\"c\";s:3:\"web\";}i:62;a:3:{s:1:\"a\";i:63;s:1:\"b\";s:11:\"blogs.alias\";s:1:\"c\";s:3:\"web\";}i:63;a:3:{s:1:\"a\";i:64;s:1:\"b\";s:13:\"blogs.publish\";s:1:\"c\";s:3:\"web\";}i:64;a:3:{s:1:\"a\";i:65;s:1:\"b\";s:17:\"blogs.updateOrder\";s:1:\"c\";s:3:\"web\";}i:65;a:3:{s:1:\"a\";i:66;s:1:\"b\";s:13:\"sliders.index\";s:1:\"c\";s:3:\"web\";}i:66;a:3:{s:1:\"a\";i:67;s:1:\"b\";s:14:\"sliders.create\";s:1:\"c\";s:3:\"web\";}i:67;a:3:{s:1:\"a\";i:68;s:1:\"b\";s:13:\"sliders.store\";s:1:\"c\";s:3:\"web\";}i:68;a:3:{s:1:\"a\";i:69;s:1:\"b\";s:12:\"sliders.edit\";s:1:\"c\";s:3:\"web\";}i:69;a:3:{s:1:\"a\";i:70;s:1:\"b\";s:14:\"sliders.update\";s:1:\"c\";s:3:\"web\";}i:70;a:3:{s:1:\"a\";i:71;s:1:\"b\";s:12:\"sliders.view\";s:1:\"c\";s:3:\"web\";}i:71;a:3:{s:1:\"a\";i:72;s:1:\"b\";s:14:\"sliders.delete\";s:1:\"c\";s:3:\"web\";}i:72;a:3:{s:1:\"a\";i:73;s:1:\"b\";s:13:\"sliders.alias\";s:1:\"c\";s:3:\"web\";}i:73;a:3:{s:1:\"a\";i:74;s:1:\"b\";s:15:\"sliders.publish\";s:1:\"c\";s:3:\"web\";}i:74;a:3:{s:1:\"a\";i:75;s:1:\"b\";s:19:\"sliders.updateOrder\";s:1:\"c\";s:3:\"web\";}i:75;a:3:{s:1:\"a\";i:76;s:1:\"b\";s:20:\"menuCategories.index\";s:1:\"c\";s:3:\"web\";}i:76;a:3:{s:1:\"a\";i:77;s:1:\"b\";s:21:\"menuCategories.create\";s:1:\"c\";s:3:\"web\";}i:77;a:3:{s:1:\"a\";i:78;s:1:\"b\";s:20:\"menuCategories.store\";s:1:\"c\";s:3:\"web\";}i:78;a:3:{s:1:\"a\";i:79;s:1:\"b\";s:19:\"menuCategories.edit\";s:1:\"c\";s:3:\"web\";}i:79;a:3:{s:1:\"a\";i:80;s:1:\"b\";s:21:\"menuCategories.update\";s:1:\"c\";s:3:\"web\";}i:80;a:3:{s:1:\"a\";i:81;s:1:\"b\";s:19:\"menuCategories.view\";s:1:\"c\";s:3:\"web\";}i:81;a:3:{s:1:\"a\";i:82;s:1:\"b\";s:21:\"menuCategories.delete\";s:1:\"c\";s:3:\"web\";}i:82;a:3:{s:1:\"a\";i:83;s:1:\"b\";s:20:\"menuCategories.alias\";s:1:\"c\";s:3:\"web\";}i:83;a:3:{s:1:\"a\";i:84;s:1:\"b\";s:22:\"menuCategories.publish\";s:1:\"c\";s:3:\"web\";}i:84;a:3:{s:1:\"a\";i:85;s:1:\"b\";s:26:\"menuCategories.updateOrder\";s:1:\"c\";s:3:\"web\";}i:85;a:3:{s:1:\"a\";i:86;s:1:\"b\";s:11:\"pages.index\";s:1:\"c\";s:3:\"web\";}i:86;a:3:{s:1:\"a\";i:87;s:1:\"b\";s:12:\"pages.create\";s:1:\"c\";s:3:\"web\";}i:87;a:3:{s:1:\"a\";i:88;s:1:\"b\";s:11:\"pages.store\";s:1:\"c\";s:3:\"web\";}i:88;a:3:{s:1:\"a\";i:89;s:1:\"b\";s:10:\"pages.edit\";s:1:\"c\";s:3:\"web\";}i:89;a:3:{s:1:\"a\";i:90;s:1:\"b\";s:12:\"pages.update\";s:1:\"c\";s:3:\"web\";}i:90;a:3:{s:1:\"a\";i:91;s:1:\"b\";s:10:\"pages.view\";s:1:\"c\";s:3:\"web\";}i:91;a:3:{s:1:\"a\";i:92;s:1:\"b\";s:12:\"pages.delete\";s:1:\"c\";s:3:\"web\";}i:92;a:3:{s:1:\"a\";i:93;s:1:\"b\";s:11:\"pages.alias\";s:1:\"c\";s:3:\"web\";}i:93;a:3:{s:1:\"a\";i:94;s:1:\"b\";s:13:\"pages.publish\";s:1:\"c\";s:3:\"web\";}i:94;a:3:{s:1:\"a\";i:95;s:1:\"b\";s:17:\"pages.updateOrder\";s:1:\"c\";s:3:\"web\";}i:95;a:3:{s:1:\"a\";i:96;s:1:\"b\";s:15:\"pages.showChild\";s:1:\"c\";s:3:\"web\";}i:96;a:3:{s:1:\"a\";i:97;s:1:\"b\";s:19:\"pages.fetch.content\";s:1:\"c\";s:3:\"web\";}i:97;a:3:{s:1:\"a\";i:98;s:1:\"b\";s:13:\"buttons.index\";s:1:\"c\";s:3:\"web\";}i:98;a:3:{s:1:\"a\";i:99;s:1:\"b\";s:14:\"buttons.create\";s:1:\"c\";s:3:\"web\";}i:99;a:3:{s:1:\"a\";i:100;s:1:\"b\";s:13:\"buttons.store\";s:1:\"c\";s:3:\"web\";}i:100;a:3:{s:1:\"a\";i:101;s:1:\"b\";s:12:\"buttons.edit\";s:1:\"c\";s:3:\"web\";}i:101;a:3:{s:1:\"a\";i:102;s:1:\"b\";s:14:\"buttons.update\";s:1:\"c\";s:3:\"web\";}i:102;a:3:{s:1:\"a\";i:103;s:1:\"b\";s:12:\"buttons.view\";s:1:\"c\";s:3:\"web\";}i:103;a:3:{s:1:\"a\";i:104;s:1:\"b\";s:14:\"buttons.delete\";s:1:\"c\";s:3:\"web\";}i:104;a:3:{s:1:\"a\";i:105;s:1:\"b\";s:13:\"buttons.alias\";s:1:\"c\";s:3:\"web\";}i:105;a:3:{s:1:\"a\";i:106;s:1:\"b\";s:15:\"buttons.publish\";s:1:\"c\";s:3:\"web\";}i:106;a:3:{s:1:\"a\";i:107;s:1:\"b\";s:19:\"buttons.updateOrder\";s:1:\"c\";s:3:\"web\";}i:107;a:3:{s:1:\"a\";i:108;s:1:\"b\";s:23:\"buttons.getTemplateData\";s:1:\"c\";s:3:\"web\";}i:108;a:3:{s:1:\"a\";i:109;s:1:\"b\";s:15:\"templates.index\";s:1:\"c\";s:3:\"web\";}i:109;a:3:{s:1:\"a\";i:110;s:1:\"b\";s:16:\"templates.create\";s:1:\"c\";s:3:\"web\";}i:110;a:3:{s:1:\"a\";i:111;s:1:\"b\";s:15:\"templates.store\";s:1:\"c\";s:3:\"web\";}i:111;a:3:{s:1:\"a\";i:112;s:1:\"b\";s:14:\"templates.edit\";s:1:\"c\";s:3:\"web\";}i:112;a:3:{s:1:\"a\";i:113;s:1:\"b\";s:16:\"templates.update\";s:1:\"c\";s:3:\"web\";}i:113;a:3:{s:1:\"a\";i:114;s:1:\"b\";s:14:\"templates.view\";s:1:\"c\";s:3:\"web\";}i:114;a:3:{s:1:\"a\";i:115;s:1:\"b\";s:16:\"templates.delete\";s:1:\"c\";s:3:\"web\";}i:115;a:3:{s:1:\"a\";i:116;s:1:\"b\";s:15:\"templates.alias\";s:1:\"c\";s:3:\"web\";}i:116;a:3:{s:1:\"a\";i:117;s:1:\"b\";s:17:\"templates.publish\";s:1:\"c\";s:3:\"web\";}i:117;a:3:{s:1:\"a\";i:118;s:1:\"b\";s:21:\"templates.updateOrder\";s:1:\"c\";s:3:\"web\";}i:118;a:3:{s:1:\"a\";i:119;s:1:\"b\";s:18:\"templates.all-data\";s:1:\"c\";s:3:\"web\";}i:119;a:3:{s:1:\"a\";i:120;s:1:\"b\";s:16:\"templates.parent\";s:1:\"c\";s:3:\"web\";}i:120;a:3:{s:1:\"a\";i:121;s:1:\"b\";s:17:\"templates.getData\";s:1:\"c\";s:3:\"web\";}i:121;a:3:{s:1:\"a\";i:122;s:1:\"b\";s:21:\"templates.getChildren\";s:1:\"c\";s:3:\"web\";}i:122;a:3:{s:1:\"a\";i:123;s:1:\"b\";s:24:\"templates.updateChildren\";s:1:\"c\";s:3:\"web\";}i:123;a:3:{s:1:\"a\";i:124;s:1:\"b\";s:22:\"templates.childPublish\";s:1:\"c\";s:3:\"web\";}i:124;a:3:{s:1:\"a\";i:125;s:1:\"b\";s:23:\"templates.fetchChildren\";s:1:\"c\";s:3:\"web\";}i:125;a:3:{s:1:\"a\";i:126;s:1:\"b\";s:17:\"navigations.index\";s:1:\"c\";s:3:\"web\";}i:126;a:3:{s:1:\"a\";i:127;s:1:\"b\";s:18:\"navigations.create\";s:1:\"c\";s:3:\"web\";}i:127;a:3:{s:1:\"a\";i:128;s:1:\"b\";s:17:\"navigations.store\";s:1:\"c\";s:3:\"web\";}i:128;a:3:{s:1:\"a\";i:129;s:1:\"b\";s:16:\"navigations.edit\";s:1:\"c\";s:3:\"web\";}i:129;a:3:{s:1:\"a\";i:130;s:1:\"b\";s:18:\"navigations.update\";s:1:\"c\";s:3:\"web\";}i:130;a:3:{s:1:\"a\";i:131;s:1:\"b\";s:16:\"navigations.view\";s:1:\"c\";s:3:\"web\";}i:131;a:3:{s:1:\"a\";i:132;s:1:\"b\";s:18:\"navigations.delete\";s:1:\"c\";s:3:\"web\";}i:132;a:3:{s:1:\"a\";i:133;s:1:\"b\";s:17:\"navigations.alias\";s:1:\"c\";s:3:\"web\";}i:133;a:3:{s:1:\"a\";i:134;s:1:\"b\";s:19:\"navigations.publish\";s:1:\"c\";s:3:\"web\";}i:134;a:3:{s:1:\"a\";i:135;s:1:\"b\";s:23:\"navigations.updateOrder\";s:1:\"c\";s:3:\"web\";}i:135;a:3:{s:1:\"a\";i:136;s:1:\"b\";s:24:\"navigations.fetchContent\";s:1:\"c\";s:3:\"web\";}i:136;a:3:{s:1:\"a\";i:137;s:1:\"b\";s:19:\"navigations.getData\";s:1:\"c\";s:3:\"web\";}i:137;a:3:{s:1:\"a\";i:138;s:1:\"b\";s:8:\"register\";s:1:\"c\";s:3:\"web\";}i:138;a:3:{s:1:\"a\";i:139;s:1:\"b\";s:5:\"login\";s:1:\"c\";s:3:\"web\";}i:139;a:3:{s:1:\"a\";i:140;s:1:\"b\";s:6:\"logout\";s:1:\"c\";s:3:\"web\";}i:140;a:3:{s:1:\"a\";i:141;s:1:\"b\";s:19:\"templates.connected\";s:1:\"c\";s:3:\"web\";}i:141;a:3:{s:1:\"a\";i:142;s:1:\"b\";s:21:\"templates.connect-new\";s:1:\"c\";s:3:\"web\";}i:142;a:3:{s:1:\"a\";i:143;s:1:\"b\";s:22:\"templates.editVisually\";s:1:\"c\";s:3:\"web\";}i:143;a:3:{s:1:\"a\";i:144;s:1:\"b\";s:29:\"templates.getInternalTemplate\";s:1:\"c\";s:3:\"web\";}i:144;a:3:{s:1:\"a\";i:145;s:1:\"b\";s:30:\"templates.fetchTemplateOptions\";s:1:\"c\";s:3:\"web\";}i:145;a:3:{s:1:\"a\";i:146;s:1:\"b\";s:17:\"connections.index\";s:1:\"c\";s:3:\"web\";}i:146;a:3:{s:1:\"a\";i:147;s:1:\"b\";s:18:\"connections.create\";s:1:\"c\";s:3:\"web\";}i:147;a:3:{s:1:\"a\";i:148;s:1:\"b\";s:17:\"connections.store\";s:1:\"c\";s:3:\"web\";}i:148;a:3:{s:1:\"a\";i:149;s:1:\"b\";s:16:\"connections.edit\";s:1:\"c\";s:3:\"web\";}i:149;a:3:{s:1:\"a\";i:150;s:1:\"b\";s:18:\"connections.update\";s:1:\"c\";s:3:\"web\";}i:150;a:3:{s:1:\"a\";i:151;s:1:\"b\";s:16:\"connections.view\";s:1:\"c\";s:3:\"web\";}i:151;a:3:{s:1:\"a\";i:152;s:1:\"b\";s:18:\"connections.delete\";s:1:\"c\";s:3:\"web\";}i:152;a:3:{s:1:\"a\";i:153;s:1:\"b\";s:17:\"connections.alias\";s:1:\"c\";s:3:\"web\";}i:153;a:3:{s:1:\"a\";i:154;s:1:\"b\";s:19:\"connections.publish\";s:1:\"c\";s:3:\"web\";}i:154;a:3:{s:1:\"a\";i:155;s:1:\"b\";s:23:\"connections.updateOrder\";s:1:\"c\";s:3:\"web\";}i:155;a:3:{s:1:\"a\";i:156;s:1:\"b\";s:25:\"connections.bidirectional\";s:1:\"c\";s:3:\"web\";}i:156;a:3:{s:1:\"a\";i:157;s:1:\"b\";s:15:\"countries.index\";s:1:\"c\";s:3:\"web\";}i:157;a:3:{s:1:\"a\";i:158;s:1:\"b\";s:16:\"countries.create\";s:1:\"c\";s:3:\"web\";}i:158;a:3:{s:1:\"a\";i:159;s:1:\"b\";s:15:\"countries.store\";s:1:\"c\";s:3:\"web\";}i:159;a:3:{s:1:\"a\";i:160;s:1:\"b\";s:14:\"countries.edit\";s:1:\"c\";s:3:\"web\";}i:160;a:3:{s:1:\"a\";i:161;s:1:\"b\";s:16:\"countries.update\";s:1:\"c\";s:3:\"web\";}i:161;a:3:{s:1:\"a\";i:162;s:1:\"b\";s:14:\"countries.view\";s:1:\"c\";s:3:\"web\";}i:162;a:3:{s:1:\"a\";i:163;s:1:\"b\";s:16:\"countries.delete\";s:1:\"c\";s:3:\"web\";}i:163;a:3:{s:1:\"a\";i:164;s:1:\"b\";s:15:\"countries.alias\";s:1:\"c\";s:3:\"web\";}i:164;a:3:{s:1:\"a\";i:165;s:1:\"b\";s:17:\"countries.publish\";s:1:\"c\";s:3:\"web\";}i:165;a:3:{s:1:\"a\";i:166;s:1:\"b\";s:21:\"countries.updateOrder\";s:1:\"c\";s:3:\"web\";}i:166;a:3:{s:1:\"a\";i:167;s:1:\"b\";s:15:\"coachings.index\";s:1:\"c\";s:3:\"web\";}i:167;a:3:{s:1:\"a\";i:168;s:1:\"b\";s:16:\"coachings.create\";s:1:\"c\";s:3:\"web\";}i:168;a:3:{s:1:\"a\";i:169;s:1:\"b\";s:15:\"coachings.store\";s:1:\"c\";s:3:\"web\";}i:169;a:3:{s:1:\"a\";i:170;s:1:\"b\";s:14:\"coachings.edit\";s:1:\"c\";s:3:\"web\";}i:170;a:3:{s:1:\"a\";i:171;s:1:\"b\";s:16:\"coachings.update\";s:1:\"c\";s:3:\"web\";}i:171;a:3:{s:1:\"a\";i:172;s:1:\"b\";s:14:\"coachings.view\";s:1:\"c\";s:3:\"web\";}i:172;a:3:{s:1:\"a\";i:173;s:1:\"b\";s:16:\"coachings.delete\";s:1:\"c\";s:3:\"web\";}i:173;a:3:{s:1:\"a\";i:174;s:1:\"b\";s:15:\"coachings.alias\";s:1:\"c\";s:3:\"web\";}i:174;a:3:{s:1:\"a\";i:175;s:1:\"b\";s:17:\"coachings.publish\";s:1:\"c\";s:3:\"web\";}i:175;a:3:{s:1:\"a\";i:176;s:1:\"b\";s:21:\"coachings.updateOrder\";s:1:\"c\";s:3:\"web\";}i:176;a:3:{s:1:\"a\";i:177;s:1:\"b\";s:18:\"testimonials.index\";s:1:\"c\";s:3:\"web\";}i:177;a:3:{s:1:\"a\";i:178;s:1:\"b\";s:19:\"testimonials.create\";s:1:\"c\";s:3:\"web\";}i:178;a:3:{s:1:\"a\";i:179;s:1:\"b\";s:18:\"testimonials.store\";s:1:\"c\";s:3:\"web\";}i:179;a:3:{s:1:\"a\";i:180;s:1:\"b\";s:17:\"testimonials.edit\";s:1:\"c\";s:3:\"web\";}i:180;a:3:{s:1:\"a\";i:181;s:1:\"b\";s:19:\"testimonials.update\";s:1:\"c\";s:3:\"web\";}i:181;a:3:{s:1:\"a\";i:182;s:1:\"b\";s:17:\"testimonials.view\";s:1:\"c\";s:3:\"web\";}i:182;a:3:{s:1:\"a\";i:183;s:1:\"b\";s:19:\"testimonials.delete\";s:1:\"c\";s:3:\"web\";}i:183;a:3:{s:1:\"a\";i:184;s:1:\"b\";s:18:\"testimonials.alias\";s:1:\"c\";s:3:\"web\";}i:184;a:3:{s:1:\"a\";i:185;s:1:\"b\";s:20:\"testimonials.publish\";s:1:\"c\";s:3:\"web\";}i:185;a:3:{s:1:\"a\";i:186;s:1:\"b\";s:24:\"testimonials.updateOrder\";s:1:\"c\";s:3:\"web\";}i:186;a:3:{s:1:\"a\";i:187;s:1:\"b\";s:13:\"mappers.index\";s:1:\"c\";s:3:\"web\";}i:187;a:3:{s:1:\"a\";i:188;s:1:\"b\";s:13:\"mappers.store\";s:1:\"c\";s:3:\"web\";}i:188;a:3:{s:1:\"a\";i:189;s:1:\"b\";s:14:\"mappers.update\";s:1:\"c\";s:3:\"web\";}i:189;a:3:{s:1:\"a\";i:190;s:1:\"b\";s:13:\"mappers.alias\";s:1:\"c\";s:3:\"web\";}i:190;a:3:{s:1:\"a\";i:191;s:1:\"b\";s:15:\"mappers.publish\";s:1:\"c\";s:3:\"web\";}}s:5:\"roles\";a:0:{}}', 1750036633);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `coachings`
--

CREATE TABLE `coachings` (
  `coachings_id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alias` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cover` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thumb` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `entries` text COLLATE utf8mb4_unicode_ci,
  `seo_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seo_keyword` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seo_description` text COLLATE utf8mb4_unicode_ci,
  `display_order` int DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1',
  `createdby` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updatedby` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coachings`
--

INSERT INTO `coachings` (`coachings_id`, `title`, `alias`, `cover`, `thumb`, `description`, `entries`, `seo_title`, `seo_keyword`, `seo_description`, `display_order`, `status`, `createdby`, `updatedby`, `created_at`, `updated_at`) VALUES
(1, 'IELTS Coaching', 'ielts-coaching', 'storage/photos/1/coaching/single-4.jpg', 'storage/photos/1/coaching/03.jpg', '<p>Preparing for the IELTS exam? Our expert-led IELTS coaching program is designed to help you achieve your target band score with confidence. We offer comprehensive training covering all four modules &mdash; Listening, Reading, Writing, and Speaking &mdash; tailored to both Academic and General Training formats.</p>\r\n\r\n<p>Whether you&#39;re aiming for university admission, global migration, or professional registration, our IELTS classes are structured to suit your goals, schedule, and learning style. Join our weekday or weekend batches, online or in-class.</p>\r\n\r\n<p>Get unlimited doubt clearing, practice sessions, and full-length mock tests with detailed analysis to track your progress. With certified trainers and updated resources, we ensure your IELTS journey is smooth, focused, and successful.</p>', '[{\"title\":\"Benefits of Our IELTS Coaching\",\"subtitle\":\"\",\"description\":\"<ul>\\n\\t<li>Certified and experienced IELTS trainers.</li>\\n\\t<li>Custom study plans and flexible class timings.</li>\\n\\t<li>Daily assignments, grammar drills &amp; vocabulary building.</li>\\n\\t<li>Live and recorded sessions for revision.</li>\\n\\t<li>Mock tests with score analysis and feedback.</li>\\n</ul>\",\"extraImg\":\"\"},{\"title\":\"Why Choose Us for IELTS Preparation?\",\"subtitle\":\"\",\"description\":\"<p>We go beyond just classroom training. Our approach is result-oriented &mdash; blending strategy, skill, and practice. Whether you are targeting Band 6.5 or Band 8+, we offer expert guidance and motivation throughout your preparation journey.</p>\\n\\n<p>Join thousands of successful candidates who have aced the IELTS with our support. Let us help you open doors to study, work, or live abroad.</p>\",\"extraImg\":\"\"}]', NULL, NULL, NULL, 1, 1, '1', '1', '2025-06-08 10:59:31', '2025-06-08 10:59:31');

-- --------------------------------------------------------

--
-- Table structure for table `connections`
--

CREATE TABLE `connections` (
  `connections_id` bigint UNSIGNED NOT NULL,
  `template_id` bigint UNSIGNED DEFAULT NULL,
  `child_id` bigint UNSIGNED DEFAULT NULL,
  `connected_template_id` bigint UNSIGNED DEFAULT NULL,
  `connected_child_id` bigint UNSIGNED DEFAULT NULL,
  `bidirectional` int NOT NULL DEFAULT '-1',
  `display_order` int DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1',
  `createdby` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updatedby` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `connections`
--

INSERT INTO `connections` (`connections_id`, `template_id`, `child_id`, `connected_template_id`, `connected_child_id`, `bidirectional`, `display_order`, `status`, `createdby`, `updatedby`, `created_at`, `updated_at`) VALUES
(1, 30, 14, 2, 3, -1, 1, 1, '1', '1', '2025-06-09 07:43:28', '2025-06-09 07:43:28'),
(2, 30, 9, 2, 9, -1, 2, 1, '1', '1', '2025-06-09 07:45:02', '2025-06-09 07:45:02');

-- --------------------------------------------------------

--
-- Table structure for table `contents`
--

CREATE TABLE `contents` (
  `contents_id` bigint UNSIGNED NOT NULL,
  `template_id` bigint UNSIGNED DEFAULT NULL,
  `child_id` bigint UNSIGNED DEFAULT NULL,
  `entries` text COLLATE utf8mb4_unicode_ci,
  `display_order` int DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1',
  `createdby` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updatedby` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contents`
--

INSERT INTO `contents` (`contents_id`, `template_id`, `child_id`, `entries`, `display_order`, `status`, `createdby`, `updatedby`, `created_at`, `updated_at`) VALUES
(1, 2, 10, '[]', 1, 1, '1', '1', '2025-06-07 06:46:38', '2025-06-14 19:53:54'),
(2, 2, 3, '[\"Button:4\"]', 2, 1, '1', '1', '2025-06-07 06:48:48', '2025-06-14 19:54:37'),
(3, 2, 12, '[]', 3, 1, '1', '1', '2025-06-07 06:52:26', '2025-06-14 19:55:45'),
(4, 2, 7, '[\"Article:5\",\"Button:1\"]', 4, 1, '1', '1', '2025-06-08 09:03:34', '2025-06-14 19:58:25'),
(5, 2, 13, '[]', 5, 1, '1', '1', '2025-06-08 09:06:34', '2025-06-14 19:55:09'),
(6, 2, 9, '[]', 6, 1, '1', '1', '2025-06-08 09:27:14', '2025-06-14 19:56:19'),
(7, 2, 5, '[]', 7, 1, '1', '1', '2025-06-08 10:59:32', '2025-06-14 20:11:27'),
(8, 2, 11, '[]', 8, 1, '1', '1', '2025-06-08 11:14:49', '2025-06-14 20:00:32'),
(9, 2, 4, '[\"Button:3\",\"Blog:1\",\"Article:6\"]', 9, 1, '1', '1', '2025-06-08 11:34:15', '2025-06-10 21:45:41'),
(10, 30, 28, '[]', 10, 1, '1', '1', '2025-06-09 07:42:42', '2025-06-14 19:27:33'),
(11, 31, 28, '[]', 11, 1, '1', '1', '2025-06-14 19:27:33', '2025-06-14 19:54:06'),
(12, 4, 12, '[\"Slider:2\",\"Slider:1\"]', 12, 1, '1', '1', '2025-06-14 19:53:09', '2025-06-14 19:59:08'),
(13, 28, 3, '[\"Slider:3\"]', 13, 1, '1', '1', '2025-06-14 19:54:06', '2025-06-14 19:54:06'),
(14, 4, 5, '[\"Article:1\"]', 14, 1, '1', '1', '2025-06-14 19:54:38', '2025-06-14 19:54:38'),
(15, 4, 14, '[\"Article:2\"]', 15, 1, '1', '1', '2025-06-14 19:55:09', '2025-06-14 19:58:51'),
(16, 4, 15, '[\"Article:3\"]', 16, 1, '1', '1', '2025-06-14 19:55:45', '2025-06-14 19:58:51'),
(17, 4, 9, '[\"Country:1\",\"Button:2\"]', 17, 1, '1', '1', '2025-06-14 19:58:25', '2025-06-14 20:11:27'),
(18, 4, 11, '[\"Article:4\"]', 18, 1, '1', '1', '2025-06-14 19:59:08', '2025-06-14 19:59:08'),
(19, 4, 7, '[\"Coaching:1\"]', 19, 1, '1', '1', '2025-06-14 19:59:34', '2025-06-14 19:59:34'),
(20, 4, 13, '[\"Testimonial:1\"]', 20, 1, '1', '1', '2025-06-14 20:00:32', '2025-06-14 20:00:32');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `countries_id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alias` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cover` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thumb` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `entries` text COLLATE utf8mb4_unicode_ci,
  `seo_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seo_keyword` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seo_description` text COLLATE utf8mb4_unicode_ci,
  `display_order` int DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1',
  `createdby` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updatedby` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`countries_id`, `title`, `alias`, `cover`, `thumb`, `description`, `entries`, `seo_title`, `seo_keyword`, `seo_description`, `display_order`, `status`, `createdby`, `updatedby`, `created_at`, `updated_at`) VALUES
(1, 'United States Of America', 'united-states-of-america', 'storage/photos/1/country/single-2.jpg', 'storage/photos/1/country/single-2.jpg,storage/photos/1/country/usa.jpg', '<p>The United States continues to be a top destination for international students, skilled professionals, and entrepreneurs from around the world. With its world-renowned universities, robust economy, and dynamic job market, the U.S. offers unparalleled opportunities for education, career growth, and permanent residency.</p>\r\n\r\n<p>Whether you&#39;re aiming to pursue a degree at a top-ranking institution like Harvard or Stanford, launch a business in Silicon Valley, or work in tech, healthcare, or finance, the U.S. provides diverse pathways and the infrastructure to help you succeed. Visa options such as the F-1 Student Visa, H-1B Work Visa, and EB-5 Investor Visa cater to a variety of personal and professional goals.</p>\r\n\r\n<p><img alt=\"\" class=\"p-2\" src=\"http://cms-fms.test/storage/photos/1/country/single-2.jpg\" style=\"height:200px; width:300px\" /> <img alt=\"\" class=\"d-md-block d-none p-2\" src=\"http://cms-fms.test/storage/photos/1/country/usa.jpg\" style=\"height:200px; width:300px\" /></p>\r\n\r\n<p>With more than 4,000 universities, unmatched research funding, and access to global companies, the U.S. education system and labor market are designed to attract top talent. Post-study work opportunities and Optional Practical Training (OPT) allow international students to gain hands-on experience in their field after graduation.</p>\r\n\r\n<p>&nbsp;</p>', '[{\"title\":\"Key Benefits of Studying or Migrating to the USA\",\"subtitle\":\"\",\"description\":\"<ul class=\\\"list-unstyled\\\">\\n    <li class=\\\"d-flex align-items-start mb-2\\\">\\n        <i class=\\\"bi bi-check2 text-success me-2\\\"></i>\\n        Access to globally ranked universities and programs.\\n    </li>\\n    <li class=\\\"d-flex align-items-start mb-2\\\">\\n        <i class=\\\"bi bi-check2 text-success me-2\\\"></i>\\n        Diverse work opportunities in STEM, business, healthcare, and more.\\n    </li>\\n    <li class=\\\"d-flex align-items-start mb-2\\\">\\n        <i class=\\\"bi bi-check2 text-success me-2\\\"></i>\\n        Optional Practical Training (OPT) and STEM OPT extension for graduates.\\n    </li>\\n    <li class=\\\"d-flex align-items-start mb-2\\\">\\n        <i class=\\\"bi bi-check2 text-success me-2\\\"></i>\\n        Competitive salaries and high standard of living.\\n    </li>\\n    <li class=\\\"d-flex align-items-start mb-2\\\">\\n        <i class=\\\"bi bi-check2 text-success me-2\\\"></i>\\n        Multicultural environment and international exposure.\\n    </li>\\n</ul>\",\"extraImg\":\"storage/photos/1/country/single-2.jpg\"},{\"title\":\"Why Choose the United States?\",\"subtitle\":\"\",\"description\":\"<p>The UK blends historical tradition with modern innovation. It&#39;s a leader in industries such as finance, engineering, healthcare, and creative arts. Its cities&mdash;from London and Manchester to Edinburgh and Birmingham&mdash;offer career opportunities in some of the world&rsquo;s most competitive sectors.</p>\\n\\n<p>With flexible visa policies for students, entrepreneurs, and skilled professionals, the UK remains a prime choice for those aiming to build a future in a globally influential and well-structured society.</p>\",\"extraImg\":\"\"}]', NULL, NULL, NULL, 1, 1, '1', '1', '2025-06-08 09:03:33', '2025-06-09 07:50:14');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `icon_atricles`
--

CREATE TABLE `icon_atricles` (
  `icon_atricles_id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subtitle` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alias` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent` int DEFAULT NULL,
  `cover` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thumb` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `entries` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `remarks` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `seo_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seo_keyword` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seo_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `display_order` int DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1',
  `createdby` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updatedby` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `labels`
--

CREATE TABLE `labels` (
  `labels_id` bigint UNSIGNED NOT NULL,
  `en` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alias` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `np` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1',
  `display_order` int DEFAULT NULL,
  `createdby` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updatedby` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `labels`
--

INSERT INTO `labels` (`labels_id`, `en`, `alias`, `np`, `hi`, `status`, `display_order`, `createdby`, `updatedby`, `created_at`, `updated_at`) VALUES
(1, 'Visobotics', NULL, NULL, NULL, 1, 1, '1', '1', NULL, NULL),
(2, 'Dashboard', NULL, NULL, NULL, 1, 2, '1', '1', NULL, NULL),
(3, 'Title', NULL, NULL, NULL, 1, 3, '1', '1', NULL, NULL),
(4, 'Preview', NULL, NULL, NULL, 1, 4, '1', '1', NULL, NULL),
(5, 'Publish', NULL, NULL, NULL, 1, 5, '1', '1', NULL, NULL),
(6, 'Submit', NULL, NULL, NULL, 1, 6, '1', '1', NULL, NULL),
(7, 'Cancel', NULL, NULL, NULL, 1, 7, '1', '1', NULL, NULL),
(8, 'Subtitle', NULL, NULL, NULL, 1, 8, '1', '1', NULL, NULL),
(9, 'Remarks', NULL, NULL, NULL, 1, 9, '1', '1', NULL, NULL),
(10, 'Image', NULL, NULL, NULL, 1, 10, '1', '1', NULL, NULL),
(11, 'Seo Title', NULL, NULL, NULL, 1, 11, '1', '1', NULL, NULL),
(12, 'Seo Keyword', NULL, NULL, NULL, 1, 12, '1', '1', NULL, NULL),
(13, 'Seo Description', NULL, NULL, NULL, 1, 13, '1', '1', NULL, NULL),
(14, 'Cover Image', NULL, NULL, NULL, 1, 14, '1', '1', NULL, NULL),
(15, 'Thumb', NULL, NULL, NULL, 1, 15, '1', '1', NULL, NULL),
(16, 'Description', NULL, NULL, NULL, 1, 16, '1', '1', NULL, NULL),
(17, 'Sub Title', NULL, NULL, NULL, 1, 17, '1', '1', NULL, NULL),
(18, 'Extra Image', NULL, NULL, NULL, 1, 18, '1', '1', NULL, NULL),
(19, 'home', NULL, NULL, NULL, 1, 19, '1', '1', NULL, NULL),
(20, 'Main Menu', NULL, NULL, NULL, 1, 20, '1', '1', NULL, NULL),
(21, 'View Pages', NULL, NULL, NULL, 1, 21, '1', '1', NULL, NULL),
(22, 'Name', NULL, NULL, NULL, 1, 22, '1', '1', NULL, NULL),
(23, 'Position', NULL, NULL, NULL, 1, 23, '1', '1', NULL, NULL),
(24, 'Bind Both Way', NULL, NULL, NULL, 1, 24, '1', '1', NULL, NULL),
(25, 'Detail', NULL, NULL, NULL, 1, 25, '1', '1', NULL, NULL),
(26, 'If Page has any detail, leave it here.', NULL, NULL, NULL, 1, 26, '1', '1', NULL, NULL),
(27, 'URL', NULL, NULL, NULL, 1, 27, '1', '1', NULL, NULL),
(28, 'About Us', NULL, NULL, NULL, 1, 28, '1', '1', NULL, NULL),
(29, 'Detail Page', NULL, NULL, NULL, 1, 29, '1', '1', NULL, NULL),
(30, 'Button URL', NULL, NULL, NULL, 1, 30, '1', '1', NULL, NULL),
(31, 'Custom Button URL', NULL, NULL, NULL, 1, 31, '1', '1', NULL, NULL),
(32, 'Custom URL', NULL, NULL, NULL, 1, 32, '1', '1', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mappers`
--

CREATE TABLE `mappers` (
  `mappers_id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alias` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_order` int DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1',
  `createdby` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updatedby` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mappers`
--

INSERT INTO `mappers` (`mappers_id`, `title`, `alias`, `display_order`, `status`, `createdby`, `updatedby`, `created_at`, `updated_at`) VALUES
(1, 'Article', 'info', 1, 1, '1', '1', '2025-06-10 12:14:48', '2025-06-10 12:14:48'),
(2, 'Country', 'view', 2, 1, '1', '1', '2025-06-10 12:14:59', '2025-06-10 12:14:59'),
(3, 'Template', 'entry', 3, 1, '1', '1', '2025-06-10 12:16:57', '2025-06-10 12:16:57'),
(4, 'Coaching', 'show', 4, 1, '1', '1', '2025-06-10 12:17:23', '2025-06-10 12:17:23'),
(5, 'Testimonial', 'page', 5, 1, '1', '1', '2025-06-10 12:17:43', '2025-06-10 12:17:43'),
(6, 'Blog', 'detail', 6, 1, '1', '1', '2025-06-10 21:40:29', '2025-06-10 21:40:29');

-- --------------------------------------------------------

--
-- Table structure for table `menucategories`
--

CREATE TABLE `menucategories` (
  `menuCategories_id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subtitle` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alias` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cover` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thumb` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent` int DEFAULT NULL,
  `remarks` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `display_order` int DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1',
  `createdby` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updatedby` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `menus_id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subtitle` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alias` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `menuCategory_id` int DEFAULT NULL,
  `price` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thumb` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `display_order` int DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1',
  `createdby` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updatedby` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_11_24_134819_create_routes_table', 1),
(5, '2024_12_09_021547_create_permission_tables', 1),
(6, '2025_02_27_095717_create_pages_table', 1),
(7, '2025_02_27_105940_create_viso_articles_table', 1),
(8, '2025_02_27_105941_create_viso_labels_table', 1),
(9, '2025_02_27_105942_create_viso_settings_table', 1),
(10, '2025_03_06_061453_create_menus_table', 1),
(11, '2025_03_06_061627_create_blogs_table', 1),
(12, '2025_03_06_061709_create_menu_categories_table', 1),
(13, '2025_03_06_061748_create_sliders_table', 1),
(14, '2025_03_07_015808_create_button_table', 1),
(18, '2025_05_18_021826_create_icon_atricles_table', 2),
(24, '2025_06_07_124326_create_countries_table', 4),
(26, '2025_06_08_163903_create_coachings_table', 5),
(27, '2025_06_08_164531_create_testimonials_table', 6),
(29, '2025_06_10_095716_create_mappers_table', 7),
(30, '2025_06_12_130331_create_single_pages_table', 8),
(34, '2025_06_12_130924_create_single_templates_table', 9),
(36, '2025_03_30_031633_create_navigations_table', 10);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1);

-- --------------------------------------------------------

--
-- Table structure for table `navigations`
--

CREATE TABLE `navigations` (
  `navigations_id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alias` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent` int DEFAULT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'javascript:void(0)',
  `target` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '_self',
  `location` int NOT NULL DEFAULT '1',
  `thumb` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `button_id` int DEFAULT NULL,
  `content_from` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content_id` int DEFAULT NULL,
  `destination_to` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `destination_id` int DEFAULT NULL,
  `display_order` int DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1',
  `createdby` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updatedby` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `navigations`
--

INSERT INTO `navigations` (`navigations_id`, `title`, `alias`, `parent`, `url`, `target`, `location`, `thumb`, `button_id`, `content_from`, `content_id`, `destination_to`, `destination_id`, `display_order`, `status`, `createdby`, `updatedby`, `created_at`, `updated_at`) VALUES
(1, 'Home', 'home', NULL, '/', '_self', 1, NULL, NULL, NULL, NULL, 'custom', NULL, 2, 1, '1', '1', '2025-06-14 09:23:39', '2025-06-14 10:08:03'),
(2, 'About', 'about', NULL, '#', '_self', 1, NULL, NULL, NULL, NULL, 'custom', NULL, 4, 1, '1', '1', '2025-06-14 09:25:11', '2025-06-14 10:05:50'),
(3, 'About Us', 'about-us', 2, 'javascript:void(0)', '_self', 1, NULL, NULL, 'articles', 1, 'templates', 26, 3, 1, '1', '1', '2025-06-14 09:29:55', '2025-06-14 09:29:55'),
(4, 'Country', 'country', NULL, 'javascript:void(0)', '_self', 1, NULL, NULL, NULL, NULL, 'custom', NULL, 1, 1, '1', '1', '2025-06-14 10:00:48', '2025-06-14 10:08:03'),
(5, 'USA', 'usa', 4, 'javascript:void(0)', '_self', 1, NULL, NULL, 'countries', 1, 'templates', 26, 2, 1, '1', '1', '2025-06-14 10:01:26', '2025-06-14 10:06:16'),
(6, 'UK', 'uk', 4, 'javascript:void(0)', '_self', 1, NULL, NULL, 'articles', 5, 'templates', 26, 1, 1, '1', '1', '2025-06-14 10:04:08', '2025-06-14 10:04:23'),
(7, 'Blog', 'blog', NULL, 'javascript:void(0)', '_self', 1, NULL, NULL, NULL, NULL, 'templates', 28, 5, 1, '1', '1', '2025-06-14 19:25:17', '2025-06-14 19:33:32');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `pages_id` bigint UNSIGNED NOT NULL,
  `parent` bigint UNSIGNED DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `alias` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `entries` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `template_id` bigint UNSIGNED DEFAULT NULL,
  `remarks` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seo_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seo_keyword` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seo_description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1',
  `display_order` int DEFAULT NULL,
  `createdby` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updatedby` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'unisharp.lfm.show', 'web', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(2, 'dashboard', 'web', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(3, 'error', 'web', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(4, 'profile.edit', 'web', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(5, 'profile.update', 'web', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(6, 'profile.destroy', 'web', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(7, 'articles.index', 'web', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(8, 'articles.create', 'web', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(9, 'articles.store', 'web', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(10, 'articles.edit', 'web', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(11, 'articles.update', 'web', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(12, 'articles.view', 'web', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(13, 'articles.delete', 'web', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(14, 'articles.alias', 'web', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(15, 'articles.publish', 'web', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(16, 'articles.updateOrder', 'web', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(17, 'roles.index', 'web', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(18, 'roles.store', 'web', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(19, 'roles.edit', 'web', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(20, 'roles.update', 'web', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(21, 'roles.view', 'web', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(22, 'roles.delete', 'web', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(23, 'roles.alias', 'web', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(24, 'roles.publish', 'web', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(25, 'roles.updateOrder', 'web', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(26, 'settings.index', 'web', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(27, 'settings.create', 'web', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(28, 'settings.store', 'web', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(29, 'settings.edit', 'web', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(30, 'settings.update', 'web', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(31, 'settings.view', 'web', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(32, 'settings.delete', 'web', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(33, 'settings.alias', 'web', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(34, 'settings.publish', 'web', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(35, 'settings.updateOrder', 'web', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(36, 'users.index', 'web', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(37, 'users.create', 'web', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(38, 'users.store', 'web', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(39, 'users.edit', 'web', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(40, 'users.update', 'web', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(41, 'users.view', 'web', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(42, 'users.delete', 'web', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(43, 'users.alias', 'web', '2025-05-17 10:53:57', '2025-05-17 10:53:57'),
(44, 'users.publish', 'web', '2025-05-17 10:53:57', '2025-05-17 10:53:57'),
(45, 'users.updateOrder', 'web', '2025-05-17 10:53:57', '2025-05-17 10:53:57'),
(46, 'menus.index', 'web', '2025-05-17 10:53:57', '2025-05-17 10:53:57'),
(47, 'menus.create', 'web', '2025-05-17 10:53:57', '2025-05-17 10:53:57'),
(48, 'menus.store', 'web', '2025-05-17 10:53:57', '2025-05-17 10:53:57'),
(49, 'menus.edit', 'web', '2025-05-17 10:53:57', '2025-05-17 10:53:57'),
(50, 'menus.update', 'web', '2025-05-17 10:53:57', '2025-05-17 10:53:57'),
(51, 'menus.view', 'web', '2025-05-17 10:53:57', '2025-05-17 10:53:57'),
(52, 'menus.delete', 'web', '2025-05-17 10:53:57', '2025-05-17 10:53:57'),
(53, 'menus.alias', 'web', '2025-05-17 10:53:57', '2025-05-17 10:53:57'),
(54, 'menus.publish', 'web', '2025-05-17 10:53:57', '2025-05-17 10:53:57'),
(55, 'menus.updateOrder', 'web', '2025-05-17 10:53:57', '2025-05-17 10:53:57'),
(56, 'blogs.index', 'web', '2025-05-17 10:53:57', '2025-05-17 10:53:57'),
(57, 'blogs.create', 'web', '2025-05-17 10:53:57', '2025-05-17 10:53:57'),
(58, 'blogs.store', 'web', '2025-05-17 10:53:57', '2025-05-17 10:53:57'),
(59, 'blogs.edit', 'web', '2025-05-17 10:53:57', '2025-05-17 10:53:57'),
(60, 'blogs.update', 'web', '2025-05-17 10:53:57', '2025-05-17 10:53:57'),
(61, 'blogs.view', 'web', '2025-05-17 10:53:57', '2025-05-17 10:53:57'),
(62, 'blogs.delete', 'web', '2025-05-17 10:53:57', '2025-05-17 10:53:57'),
(63, 'blogs.alias', 'web', '2025-05-17 10:53:57', '2025-05-17 10:53:57'),
(64, 'blogs.publish', 'web', '2025-05-17 10:53:57', '2025-05-17 10:53:57'),
(65, 'blogs.updateOrder', 'web', '2025-05-17 10:53:57', '2025-05-17 10:53:57'),
(66, 'sliders.index', 'web', '2025-05-17 10:53:57', '2025-05-17 10:53:57'),
(67, 'sliders.create', 'web', '2025-05-17 10:53:57', '2025-05-17 10:53:57'),
(68, 'sliders.store', 'web', '2025-05-17 10:53:57', '2025-05-17 10:53:57'),
(69, 'sliders.edit', 'web', '2025-05-17 10:53:57', '2025-05-17 10:53:57'),
(70, 'sliders.update', 'web', '2025-05-17 10:53:57', '2025-05-17 10:53:57'),
(71, 'sliders.view', 'web', '2025-05-17 10:53:57', '2025-05-17 10:53:57'),
(72, 'sliders.delete', 'web', '2025-05-17 10:53:57', '2025-05-17 10:53:57'),
(73, 'sliders.alias', 'web', '2025-05-17 10:53:57', '2025-05-17 10:53:57'),
(74, 'sliders.publish', 'web', '2025-05-17 10:53:57', '2025-05-17 10:53:57'),
(75, 'sliders.updateOrder', 'web', '2025-05-17 10:53:57', '2025-05-17 10:53:57'),
(76, 'menuCategories.index', 'web', '2025-05-17 10:53:57', '2025-05-17 10:53:57'),
(77, 'menuCategories.create', 'web', '2025-05-17 10:53:57', '2025-05-17 10:53:57'),
(78, 'menuCategories.store', 'web', '2025-05-17 10:53:57', '2025-05-17 10:53:57'),
(79, 'menuCategories.edit', 'web', '2025-05-17 10:53:57', '2025-05-17 10:53:57'),
(80, 'menuCategories.update', 'web', '2025-05-17 10:53:57', '2025-05-17 10:53:57'),
(81, 'menuCategories.view', 'web', '2025-05-17 10:53:57', '2025-05-17 10:53:57'),
(82, 'menuCategories.delete', 'web', '2025-05-17 10:53:57', '2025-05-17 10:53:57'),
(83, 'menuCategories.alias', 'web', '2025-05-17 10:53:57', '2025-05-17 10:53:57'),
(84, 'menuCategories.publish', 'web', '2025-05-17 10:53:57', '2025-05-17 10:53:57'),
(85, 'menuCategories.updateOrder', 'web', '2025-05-17 10:53:57', '2025-05-17 10:53:57'),
(86, 'pages.index', 'web', '2025-05-17 10:53:57', '2025-05-17 10:53:57'),
(87, 'pages.create', 'web', '2025-05-17 10:53:57', '2025-05-17 10:53:57'),
(88, 'pages.store', 'web', '2025-05-17 10:53:57', '2025-05-17 10:53:57'),
(89, 'pages.edit', 'web', '2025-05-17 10:53:57', '2025-05-17 10:53:57'),
(90, 'pages.update', 'web', '2025-05-17 10:53:57', '2025-05-17 10:53:57'),
(91, 'pages.view', 'web', '2025-05-17 10:53:57', '2025-05-17 10:53:57'),
(92, 'pages.delete', 'web', '2025-05-17 10:53:57', '2025-05-17 10:53:57'),
(93, 'pages.alias', 'web', '2025-05-17 10:53:57', '2025-05-17 10:53:57'),
(94, 'pages.publish', 'web', '2025-05-17 10:53:57', '2025-05-17 10:53:57'),
(95, 'pages.updateOrder', 'web', '2025-05-17 10:53:57', '2025-05-17 10:53:57'),
(96, 'pages.showChild', 'web', '2025-05-17 10:53:57', '2025-05-17 10:53:57'),
(97, 'pages.fetch.content', 'web', '2025-05-17 10:53:57', '2025-05-17 10:53:57'),
(98, 'buttons.index', 'web', '2025-05-17 10:53:57', '2025-05-17 10:53:57'),
(99, 'buttons.create', 'web', '2025-05-17 10:53:57', '2025-05-17 10:53:57'),
(100, 'buttons.store', 'web', '2025-05-17 10:53:57', '2025-05-17 10:53:57'),
(101, 'buttons.edit', 'web', '2025-05-17 10:53:57', '2025-05-17 10:53:57'),
(102, 'buttons.update', 'web', '2025-05-17 10:53:57', '2025-05-17 10:53:57'),
(103, 'buttons.view', 'web', '2025-05-17 10:53:57', '2025-05-17 10:53:57'),
(104, 'buttons.delete', 'web', '2025-05-17 10:53:57', '2025-05-17 10:53:57'),
(105, 'buttons.alias', 'web', '2025-05-17 10:53:57', '2025-05-17 10:53:57'),
(106, 'buttons.publish', 'web', '2025-05-17 10:53:57', '2025-05-17 10:53:57'),
(107, 'buttons.updateOrder', 'web', '2025-05-17 10:53:57', '2025-05-17 10:53:57'),
(108, 'buttons.getTemplateData', 'web', '2025-05-17 10:53:57', '2025-05-17 10:53:57'),
(109, 'templates.index', 'web', '2025-05-17 10:53:57', '2025-05-17 10:53:57'),
(110, 'templates.create', 'web', '2025-05-17 10:53:57', '2025-05-17 10:53:57'),
(111, 'templates.store', 'web', '2025-05-17 10:53:58', '2025-05-17 10:53:58'),
(112, 'templates.edit', 'web', '2025-05-17 10:53:58', '2025-05-17 10:53:58'),
(113, 'templates.update', 'web', '2025-05-17 10:53:58', '2025-05-17 10:53:58'),
(114, 'templates.view', 'web', '2025-05-17 10:53:58', '2025-05-17 10:53:58'),
(115, 'templates.delete', 'web', '2025-05-17 10:53:58', '2025-05-17 10:53:58'),
(116, 'templates.alias', 'web', '2025-05-17 10:53:58', '2025-05-17 10:53:58'),
(117, 'templates.publish', 'web', '2025-05-17 10:53:58', '2025-05-17 10:53:58'),
(118, 'templates.updateOrder', 'web', '2025-05-17 10:53:58', '2025-05-17 10:53:58'),
(119, 'templates.all-data', 'web', '2025-05-17 10:53:58', '2025-05-17 10:53:58'),
(120, 'templates.parent', 'web', '2025-05-17 10:53:58', '2025-05-17 10:53:58'),
(121, 'templates.getData', 'web', '2025-05-17 10:53:58', '2025-05-17 10:53:58'),
(122, 'templates.getChildren', 'web', '2025-05-17 10:53:58', '2025-05-17 10:53:58'),
(123, 'templates.updateChildren', 'web', '2025-05-17 10:53:58', '2025-05-17 10:53:58'),
(124, 'templates.childPublish', 'web', '2025-05-17 10:53:58', '2025-05-17 10:53:58'),
(125, 'templates.fetchChildren', 'web', '2025-05-17 10:53:58', '2025-05-17 10:53:58'),
(126, 'navigations.index', 'web', '2025-05-17 10:53:58', '2025-05-17 10:53:58'),
(127, 'navigations.create', 'web', '2025-05-17 10:53:58', '2025-05-17 10:53:58'),
(128, 'navigations.store', 'web', '2025-05-17 10:53:58', '2025-05-17 10:53:58'),
(129, 'navigations.edit', 'web', '2025-05-17 10:53:58', '2025-05-17 10:53:58'),
(130, 'navigations.update', 'web', '2025-05-17 10:53:58', '2025-05-17 10:53:58'),
(131, 'navigations.view', 'web', '2025-05-17 10:53:58', '2025-05-17 10:53:58'),
(132, 'navigations.delete', 'web', '2025-05-17 10:53:58', '2025-05-17 10:53:58'),
(133, 'navigations.alias', 'web', '2025-05-17 10:53:58', '2025-05-17 10:53:58'),
(134, 'navigations.publish', 'web', '2025-05-17 10:53:58', '2025-05-17 10:53:58'),
(135, 'navigations.updateOrder', 'web', '2025-05-17 10:53:58', '2025-05-17 10:53:58'),
(136, 'navigations.fetchContent', 'web', '2025-05-17 10:53:58', '2025-05-17 10:53:58'),
(137, 'navigations.getData', 'web', '2025-05-17 10:53:58', '2025-05-17 10:53:58'),
(138, 'register', 'web', '2025-05-17 10:53:58', '2025-05-17 10:53:58'),
(139, 'login', 'web', '2025-05-17 10:53:58', '2025-05-17 10:53:58'),
(140, 'logout', 'web', '2025-05-17 10:53:58', '2025-05-17 10:53:58'),
(141, 'templates.connected', 'web', '2025-06-10 12:13:14', '2025-06-10 12:13:14'),
(142, 'templates.connect-new', 'web', '2025-06-10 12:13:14', '2025-06-10 12:13:14'),
(143, 'templates.editVisually', 'web', '2025-06-10 12:13:14', '2025-06-10 12:13:14'),
(144, 'templates.getInternalTemplate', 'web', '2025-06-10 12:13:14', '2025-06-10 12:13:14'),
(145, 'templates.fetchTemplateOptions', 'web', '2025-06-10 12:13:14', '2025-06-10 12:13:14'),
(146, 'connections.index', 'web', '2025-06-10 12:13:14', '2025-06-10 12:13:14'),
(147, 'connections.create', 'web', '2025-06-10 12:13:14', '2025-06-10 12:13:14'),
(148, 'connections.store', 'web', '2025-06-10 12:13:14', '2025-06-10 12:13:14'),
(149, 'connections.edit', 'web', '2025-06-10 12:13:14', '2025-06-10 12:13:14'),
(150, 'connections.update', 'web', '2025-06-10 12:13:14', '2025-06-10 12:13:14'),
(151, 'connections.view', 'web', '2025-06-10 12:13:14', '2025-06-10 12:13:14'),
(152, 'connections.delete', 'web', '2025-06-10 12:13:14', '2025-06-10 12:13:14'),
(153, 'connections.alias', 'web', '2025-06-10 12:13:14', '2025-06-10 12:13:14'),
(154, 'connections.publish', 'web', '2025-06-10 12:13:14', '2025-06-10 12:13:14'),
(155, 'connections.updateOrder', 'web', '2025-06-10 12:13:14', '2025-06-10 12:13:14'),
(156, 'connections.bidirectional', 'web', '2025-06-10 12:13:14', '2025-06-10 12:13:14'),
(157, 'countries.index', 'web', '2025-06-10 12:13:14', '2025-06-10 12:13:14'),
(158, 'countries.create', 'web', '2025-06-10 12:13:14', '2025-06-10 12:13:14'),
(159, 'countries.store', 'web', '2025-06-10 12:13:14', '2025-06-10 12:13:14'),
(160, 'countries.edit', 'web', '2025-06-10 12:13:14', '2025-06-10 12:13:14'),
(161, 'countries.update', 'web', '2025-06-10 12:13:14', '2025-06-10 12:13:14'),
(162, 'countries.view', 'web', '2025-06-10 12:13:14', '2025-06-10 12:13:14'),
(163, 'countries.delete', 'web', '2025-06-10 12:13:15', '2025-06-10 12:13:15'),
(164, 'countries.alias', 'web', '2025-06-10 12:13:15', '2025-06-10 12:13:15'),
(165, 'countries.publish', 'web', '2025-06-10 12:13:15', '2025-06-10 12:13:15'),
(166, 'countries.updateOrder', 'web', '2025-06-10 12:13:15', '2025-06-10 12:13:15'),
(167, 'coachings.index', 'web', '2025-06-10 12:13:15', '2025-06-10 12:13:15'),
(168, 'coachings.create', 'web', '2025-06-10 12:13:15', '2025-06-10 12:13:15'),
(169, 'coachings.store', 'web', '2025-06-10 12:13:15', '2025-06-10 12:13:15'),
(170, 'coachings.edit', 'web', '2025-06-10 12:13:15', '2025-06-10 12:13:15'),
(171, 'coachings.update', 'web', '2025-06-10 12:13:15', '2025-06-10 12:13:15'),
(172, 'coachings.view', 'web', '2025-06-10 12:13:15', '2025-06-10 12:13:15'),
(173, 'coachings.delete', 'web', '2025-06-10 12:13:15', '2025-06-10 12:13:15'),
(174, 'coachings.alias', 'web', '2025-06-10 12:13:15', '2025-06-10 12:13:15'),
(175, 'coachings.publish', 'web', '2025-06-10 12:13:15', '2025-06-10 12:13:15'),
(176, 'coachings.updateOrder', 'web', '2025-06-10 12:13:15', '2025-06-10 12:13:15'),
(177, 'testimonials.index', 'web', '2025-06-10 12:13:15', '2025-06-10 12:13:15'),
(178, 'testimonials.create', 'web', '2025-06-10 12:13:15', '2025-06-10 12:13:15'),
(179, 'testimonials.store', 'web', '2025-06-10 12:13:15', '2025-06-10 12:13:15'),
(180, 'testimonials.edit', 'web', '2025-06-10 12:13:15', '2025-06-10 12:13:15'),
(181, 'testimonials.update', 'web', '2025-06-10 12:13:15', '2025-06-10 12:13:15'),
(182, 'testimonials.view', 'web', '2025-06-10 12:13:15', '2025-06-10 12:13:15'),
(183, 'testimonials.delete', 'web', '2025-06-10 12:13:15', '2025-06-10 12:13:15'),
(184, 'testimonials.alias', 'web', '2025-06-10 12:13:15', '2025-06-10 12:13:15'),
(185, 'testimonials.publish', 'web', '2025-06-10 12:13:15', '2025-06-10 12:13:15'),
(186, 'testimonials.updateOrder', 'web', '2025-06-10 12:13:15', '2025-06-10 12:13:15'),
(187, 'mappers.index', 'web', '2025-06-10 12:13:15', '2025-06-10 12:13:15'),
(188, 'mappers.store', 'web', '2025-06-10 12:13:15', '2025-06-10 12:13:15'),
(189, 'mappers.update', 'web', '2025-06-10 12:13:15', '2025-06-10 12:13:15'),
(190, 'mappers.alias', 'web', '2025-06-10 12:13:15', '2025-06-10 12:13:15'),
(191, 'mappers.publish', 'web', '2025-06-10 12:13:15', '2025-06-10 12:13:15');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'superadmin', 'web', '2025-05-17 10:53:56', '2025-05-17 10:53:56');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `routes`
--

CREATE TABLE `routes` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `uri` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `routes`
--

INSERT INTO `routes` (`id`, `name`, `uri`, `created_at`, `updated_at`) VALUES
(1, 'unisharp.lfm.show', 'laravel-filemanager', '2025-05-17 10:53:56', '2025-06-10 12:12:58'),
(2, 'dashboard', 'dashboard', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(3, 'error', 'error', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(4, 'profile.edit', 'profile', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(5, 'profile.update', 'profile', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(6, 'profile.destroy', 'profile', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(7, 'articles.index', 'admin/articles', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(8, 'articles.create', 'admin/articles/create', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(9, 'articles.store', 'admin/articles/store', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(10, 'articles.edit', 'admin/articles/edit/{id}', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(11, 'articles.update', 'admin/articles/update/{id}', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(12, 'articles.view', 'admin/articles/view/{id}', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(13, 'articles.delete', 'admin/articles/delete/{id}', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(14, 'articles.alias', 'admin/articles/alias/{id}', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(15, 'articles.publish', 'admin/articles/publish/{id}/{publish}', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(16, 'articles.updateOrder', 'admin/articles/updateOrder', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(17, 'roles.index', 'admin/roles', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(18, 'roles.store', 'admin/roles/store', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(19, 'roles.edit', 'admin/roles/edit/{id}', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(20, 'roles.update', 'admin/roles/update/{id}', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(21, 'roles.view', 'admin/roles/view/{id}', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(22, 'roles.delete', 'admin/roles/delete/{id}', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(23, 'roles.alias', 'admin/roles/alias/{id}', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(24, 'roles.publish', 'admin/roles/publish/{id}/{publish}', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(25, 'roles.updateOrder', 'admin/roles/updateOrder', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(26, 'settings.index', 'admin/settings', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(27, 'settings.create', 'admin/settings/create', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(28, 'settings.store', 'admin/settings/store', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(29, 'settings.edit', 'admin/settings/edit', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(30, 'settings.update', 'admin/settings/update/{id}', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(31, 'settings.view', 'admin/settings/view/{id}', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(32, 'settings.delete', 'admin/settings/delete/{id}', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(33, 'settings.alias', 'admin/settings/alias/{id}', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(34, 'settings.publish', 'admin/settings/publish/{id}/{publish}', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(35, 'settings.updateOrder', 'admin/settings/updateOrder', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(36, 'users.index', 'admin/users', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(37, 'users.create', 'admin/users/create', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(38, 'users.store', 'admin/users/store', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(39, 'users.edit', 'admin/users/edit/{id}', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(40, 'users.update', 'admin/users/update/{id}', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(41, 'users.view', 'admin/users/view/{id}', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(42, 'users.delete', 'admin/users/delete/{id}', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(43, 'users.alias', 'admin/users/alias/{id}', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(44, 'users.publish', 'admin/users/publish/{id}/{publish}', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(45, 'users.updateOrder', 'admin/users/updateOrder', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(46, 'menus.index', 'admin/menus', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(47, 'menus.create', 'admin/menus/create', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(48, 'menus.store', 'admin/menus/store', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(49, 'menus.edit', 'admin/menus/edit/{id}', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(50, 'menus.update', 'admin/menus/update/{id}', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(51, 'menus.view', 'admin/menus/view/{id}', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(52, 'menus.delete', 'admin/menus/delete/{id}', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(53, 'menus.alias', 'admin/menus/alias/{id}', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(54, 'menus.publish', 'admin/menus/publish/{id}/{publish}', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(55, 'menus.updateOrder', 'admin/menus/updateOrder', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(56, 'blogs.index', 'admin/blogs', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(57, 'blogs.create', 'admin/blogs/create', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(58, 'blogs.store', 'admin/blogs/store', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(59, 'blogs.edit', 'admin/blogs/edit/{id}', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(60, 'blogs.update', 'admin/blogs/update/{id}', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(61, 'blogs.view', 'admin/blogs/view/{id}', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(62, 'blogs.delete', 'admin/blogs/delete/{id}', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(63, 'blogs.alias', 'admin/blogs/alias/{id}', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(64, 'blogs.publish', 'admin/blogs/publish/{id}/{publish}', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(65, 'blogs.updateOrder', 'admin/blogs/updateOrder', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(66, 'sliders.index', 'admin/sliders', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(67, 'sliders.create', 'admin/sliders/create', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(68, 'sliders.store', 'admin/sliders/store', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(69, 'sliders.edit', 'admin/sliders/edit/{id}', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(70, 'sliders.update', 'admin/sliders/update/{id}', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(71, 'sliders.view', 'admin/sliders/view/{id}', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(72, 'sliders.delete', 'admin/sliders/delete/{id}', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(73, 'sliders.alias', 'admin/sliders/alias/{id}', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(74, 'sliders.publish', 'admin/sliders/publish/{id}/{publish}', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(75, 'sliders.updateOrder', 'admin/sliders/updateOrder', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(76, 'menuCategories.index', 'admin/menuCategories', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(77, 'menuCategories.create', 'admin/menuCategories/create', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(78, 'menuCategories.store', 'admin/menuCategories/store', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(79, 'menuCategories.edit', 'admin/menuCategories/edit/{id}', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(80, 'menuCategories.update', 'admin/menuCategories/update/{id}', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(81, 'menuCategories.view', 'admin/menuCategories/view/{id}', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(82, 'menuCategories.delete', 'admin/menuCategories/delete/{id}', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(83, 'menuCategories.alias', 'admin/menuCategories/alias/{id}', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(84, 'menuCategories.publish', 'admin/menuCategories/publish/{id}/{publish}', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(85, 'menuCategories.updateOrder', 'admin/menuCategories/updateOrder', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(86, 'pages.index', 'admin/pages', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(87, 'pages.create', 'admin/pages/create', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(88, 'pages.store', 'admin/pages/store', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(89, 'pages.edit', 'admin/pages/edit/{id}', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(90, 'pages.update', 'admin/pages/update/{id}', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(91, 'pages.view', 'admin/pages/view/{id}', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(92, 'pages.delete', 'admin/pages/delete/{id}', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(93, 'pages.alias', 'admin/pages/alias/{id}', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(94, 'pages.publish', 'admin/pages/publish/{id}/{publish}', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(95, 'pages.updateOrder', 'admin/pages/updateOrder', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(96, 'pages.showChild', 'admin/pages/showChild/{id}', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(97, 'pages.fetch.content', 'admin/pages/fetch-content', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(98, 'buttons.index', 'admin/buttons', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(99, 'buttons.create', 'admin/buttons/create', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(100, 'buttons.store', 'admin/buttons/store', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(101, 'buttons.edit', 'admin/buttons/edit/{id}', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(102, 'buttons.update', 'admin/buttons/update/{id}', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(103, 'buttons.view', 'admin/buttons/view/{id}', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(104, 'buttons.delete', 'admin/buttons/delete/{id}', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(105, 'buttons.alias', 'admin/buttons/alias/{id}', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(106, 'buttons.publish', 'admin/buttons/publish/{id}/{publish}', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(107, 'buttons.updateOrder', 'admin/buttons/updateOrder', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(108, 'buttons.getTemplateData', 'admin/buttons/getTemplateData/{id}', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(109, 'templates.index', 'admin/templates', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(110, 'templates.create', 'admin/templates/create', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(111, 'templates.store', 'admin/templates/store', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(112, 'templates.edit', 'admin/templates/edit/{id}', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(113, 'templates.update', 'admin/templates/update/{id}', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(114, 'templates.view', 'admin/templates/view/{id}', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(115, 'templates.delete', 'admin/templates/delete/{id}', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(116, 'templates.alias', 'admin/templates/alias/{id}', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(117, 'templates.publish', 'admin/templates/publish/{id}/{publish}', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(118, 'templates.updateOrder', 'admin/templates/updateOrder', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(119, 'templates.all-data', 'admin/templates/all-data', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(120, 'templates.parent', 'admin/templates/parent/{id}/{parent}', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(121, 'templates.getData', 'admin/templates/getData/{entries}', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(122, 'templates.getChildren', 'admin/templates/getChildren/{id}', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(123, 'templates.updateChildren', 'admin/templates/updateChildren', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(124, 'templates.childPublish', 'admin/templates/childPublish/{id}/{template_id}/{publish}', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(125, 'templates.fetchChildren', 'admin/templates/fetchChildren/{id}', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(126, 'navigations.index', 'admin/navigations', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(127, 'navigations.create', 'admin/navigations/create', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(128, 'navigations.store', 'admin/navigations/store', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(129, 'navigations.edit', 'admin/navigations/edit/{id}', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(130, 'navigations.update', 'admin/navigations/update/{id}', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(131, 'navigations.view', 'admin/navigations/view/{id}', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(132, 'navigations.delete', 'admin/navigations/delete/{id}', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(133, 'navigations.alias', 'admin/navigations/alias/{id}', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(134, 'navigations.publish', 'admin/navigations/publish/{id}/{publish}', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(135, 'navigations.updateOrder', 'admin/navigations/updateOrder', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(136, 'navigations.fetchContent', 'admin/navigations/fetchContent', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(137, 'navigations.getData', 'admin/navigations/getData/{id}', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(138, 'register', 'register', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(139, 'login', 'login', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(140, 'logout', 'logout', '2025-05-17 10:53:56', '2025-05-17 10:53:56'),
(141, 'templates.connected', 'admin/templates/connected', '2025-06-10 12:12:58', '2025-06-10 12:12:58'),
(142, 'templates.connect-new', 'admin/templates/connect-new/{connect}', '2025-06-10 12:12:58', '2025-06-10 12:12:58'),
(143, 'templates.editVisually', 'admin/templates/editVisually/{id}', '2025-06-10 12:12:58', '2025-06-10 12:12:58'),
(144, 'templates.getInternalTemplate', 'admin/templates/getInternalTemplate/{id}/{child}', '2025-06-10 12:12:58', '2025-06-10 12:12:58'),
(145, 'templates.fetchTemplateOptions', 'admin/templates/fetchTemplateOptions', '2025-06-10 12:12:58', '2025-06-10 12:12:58'),
(146, 'connections.index', 'admin/connections', '2025-06-10 12:12:58', '2025-06-10 12:12:58'),
(147, 'connections.create', 'admin/connections/create', '2025-06-10 12:12:58', '2025-06-10 12:12:58'),
(148, 'connections.store', 'admin/connections/store', '2025-06-10 12:12:58', '2025-06-10 12:12:58'),
(149, 'connections.edit', 'admin/connections/edit/{id}', '2025-06-10 12:12:58', '2025-06-10 12:12:58'),
(150, 'connections.update', 'admin/connections/update/{id}', '2025-06-10 12:12:58', '2025-06-10 12:12:58'),
(151, 'connections.view', 'admin/connections/view/{id}', '2025-06-10 12:12:58', '2025-06-10 12:12:58'),
(152, 'connections.delete', 'admin/connections/delete/{id}', '2025-06-10 12:12:58', '2025-06-10 12:12:58'),
(153, 'connections.alias', 'admin/connections/alias/{id}', '2025-06-10 12:12:58', '2025-06-10 12:12:58'),
(154, 'connections.publish', 'admin/connections/publish/{id}/{publish}', '2025-06-10 12:12:58', '2025-06-10 12:12:58'),
(155, 'connections.updateOrder', 'admin/connections/updateOrder', '2025-06-10 12:12:58', '2025-06-10 12:12:58'),
(156, 'connections.bidirectional', 'admin/connections/bidirectional/{id}/{publish}', '2025-06-10 12:12:58', '2025-06-10 12:12:58'),
(157, 'countries.index', 'admin/countries', '2025-06-10 12:12:58', '2025-06-10 12:12:58'),
(158, 'countries.create', 'admin/countries/create', '2025-06-10 12:12:58', '2025-06-10 12:12:58'),
(159, 'countries.store', 'admin/countries/store', '2025-06-10 12:12:58', '2025-06-10 12:12:58'),
(160, 'countries.edit', 'admin/countries/edit/{id}', '2025-06-10 12:12:58', '2025-06-10 12:12:58'),
(161, 'countries.update', 'admin/countries/update/{id}', '2025-06-10 12:12:58', '2025-06-10 12:12:58'),
(162, 'countries.view', 'admin/countries/view/{id}', '2025-06-10 12:12:58', '2025-06-10 12:12:58'),
(163, 'countries.delete', 'admin/countries/delete/{id}', '2025-06-10 12:12:58', '2025-06-10 12:12:58'),
(164, 'countries.alias', 'admin/countries/alias/{id}', '2025-06-10 12:12:58', '2025-06-10 12:12:58'),
(165, 'countries.publish', 'admin/countries/publish/{id}/{publish}', '2025-06-10 12:12:58', '2025-06-10 12:12:58'),
(166, 'countries.updateOrder', 'admin/countries/updateOrder', '2025-06-10 12:12:58', '2025-06-10 12:12:58'),
(167, 'coachings.index', 'admin/coachings', '2025-06-10 12:12:58', '2025-06-10 12:12:58'),
(168, 'coachings.create', 'admin/coachings/create', '2025-06-10 12:12:58', '2025-06-10 12:12:58'),
(169, 'coachings.store', 'admin/coachings/store', '2025-06-10 12:12:58', '2025-06-10 12:12:58'),
(170, 'coachings.edit', 'admin/coachings/edit/{id}', '2025-06-10 12:12:58', '2025-06-10 12:12:58'),
(171, 'coachings.update', 'admin/coachings/update/{id}', '2025-06-10 12:12:58', '2025-06-10 12:12:58'),
(172, 'coachings.view', 'admin/coachings/view/{id}', '2025-06-10 12:12:58', '2025-06-10 12:12:58'),
(173, 'coachings.delete', 'admin/coachings/delete/{id}', '2025-06-10 12:12:58', '2025-06-10 12:12:58'),
(174, 'coachings.alias', 'admin/coachings/alias/{id}', '2025-06-10 12:12:58', '2025-06-10 12:12:58'),
(175, 'coachings.publish', 'admin/coachings/publish/{id}/{publish}', '2025-06-10 12:12:58', '2025-06-10 12:12:58'),
(176, 'coachings.updateOrder', 'admin/coachings/updateOrder', '2025-06-10 12:12:58', '2025-06-10 12:12:58'),
(177, 'testimonials.index', 'admin/testimonials', '2025-06-10 12:12:58', '2025-06-10 12:12:58'),
(178, 'testimonials.create', 'admin/testimonials/create', '2025-06-10 12:12:58', '2025-06-10 12:12:58'),
(179, 'testimonials.store', 'admin/testimonials/store', '2025-06-10 12:12:58', '2025-06-10 12:12:58'),
(180, 'testimonials.edit', 'admin/testimonials/edit/{id}', '2025-06-10 12:12:58', '2025-06-10 12:12:58'),
(181, 'testimonials.update', 'admin/testimonials/update/{id}', '2025-06-10 12:12:58', '2025-06-10 12:12:58'),
(182, 'testimonials.view', 'admin/testimonials/view/{id}', '2025-06-10 12:12:58', '2025-06-10 12:12:58'),
(183, 'testimonials.delete', 'admin/testimonials/delete/{id}', '2025-06-10 12:12:58', '2025-06-10 12:12:58'),
(184, 'testimonials.alias', 'admin/testimonials/alias/{id}', '2025-06-10 12:12:58', '2025-06-10 12:12:58'),
(185, 'testimonials.publish', 'admin/testimonials/publish/{id}/{publish}', '2025-06-10 12:12:58', '2025-06-10 12:12:58'),
(186, 'testimonials.updateOrder', 'admin/testimonials/updateOrder', '2025-06-10 12:12:58', '2025-06-10 12:12:58'),
(187, 'mappers.index', 'admin/mappers', '2025-06-10 12:12:58', '2025-06-10 12:12:58'),
(188, 'mappers.store', 'admin/mappers/store', '2025-06-10 12:12:58', '2025-06-10 12:12:58'),
(189, 'mappers.update', 'admin/mappers/update/{id}', '2025-06-10 12:12:58', '2025-06-10 12:12:58'),
(190, 'mappers.alias', 'admin/mappers/alias/{id}', '2025-06-10 12:12:58', '2025-06-10 12:12:58'),
(191, 'mappers.publish', 'admin/mappers/publish/{id}/{publish}', '2025-06-10 12:12:58', '2025-06-10 12:12:58');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('ckCfeZIv1tslJ1PKuOsfnnZKtBWxEJMvIBDosXjI', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTo3OntzOjY6Il90b2tlbiI7czo0MDoienFrb2V1MndDSGhjdzRtZEhqQWZFUTBFMWtvdklCMUcyNVRDTDJzWSI7czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czo4NDoiaHR0cDovL2Ntcy1mbXMudGVzdC9jb3VudHJpZXMvdW5pdGVkLXN0YXRlcy1vZi1hbWVyaWNhL3ZpZXcvdW5pdGVkLXN0YXRlcy1vZi1hbWVyaWNhIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo3OiJpc19vcGVuIjtiOjE7czo5OiJwYXJlbnRfaWQiO3M6MjoiMjgiO3M6MjI6IlBIUERFQlVHQkFSX1NUQUNLX0RBVEEiO2E6MDp7fX0=', 1749952610);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `setting_id` bigint UNSIGNED NOT NULL,
  `switch_state` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `selected_color` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `custom_color` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1',
  `display_order` int DEFAULT NULL,
  `createdby` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updatedby` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`setting_id`, `switch_state`, `profile_image`, `selected_color`, `custom_color`, `status`, `display_order`, `createdby`, `updatedby`, `created_at`, `updated_at`) VALUES
(1, 'on', NULL, '#530d82', '#000000', 1, 1, '1', '1', '2025-05-17 10:54:11', '2025-06-13 07:33:46');

-- --------------------------------------------------------

--
-- Table structure for table `single_pages`
--

CREATE TABLE `single_pages` (
  `single_pages_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subtitle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alias` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thumb` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `entries` text COLLATE utf8mb4_unicode_ci,
  `children` text COLLATE utf8mb4_unicode_ci,
  `status` int NOT NULL DEFAULT '1',
  `parent` int NOT NULL DEFAULT '1',
  `display_order` int DEFAULT NULL,
  `createdby` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updatedby` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `single_templates`
--

CREATE TABLE `single_templates` (
  `single_templates_id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subtitle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alias` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thumb` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `main_template_id` int NOT NULL DEFAULT '1',
  `entries` text COLLATE utf8mb4_unicode_ci,
  `children` text COLLATE utf8mb4_unicode_ci,
  `status` int NOT NULL DEFAULT '1',
  `display_order` int DEFAULT NULL,
  `createdby` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updatedby` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `single_templates`
--

INSERT INTO `single_templates` (`single_templates_id`, `title`, `subtitle`, `alias`, `thumb`, `main_template_id`, `entries`, `children`, `status`, `display_order`, `createdby`, `updatedby`, `created_at`, `updated_at`) VALUES
(1, 'Country Detail', 'View Country Detail', 'no-thing-just-vibing', NULL, 25, NULL, '24,25,6,23', 1, 1, '1', '1', '2025-06-12 10:35:27', '2025-06-13 07:17:10');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `sliders_id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subtitle` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alias` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cover` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarks` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `seo_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seo_keyword` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seo_description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `display_order` int DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1',
  `createdby` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updatedby` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`sliders_id`, `title`, `subtitle`, `alias`, `cover`, `remarks`, `seo_title`, `seo_keyword`, `seo_description`, `display_order`, `status`, `createdby`, `updatedby`, `created_at`, `updated_at`) VALUES
(1, 'Your dream starts here — believe, act, and achieve greatness.', 'Nepal\'s Trusted Education Service', 'your-dream-starts-here', 'storage/photos/1/slider/slider-2.jpg', 'With years of experience guiding Nepali students and professionals abroad, Nepal Dela ensures personalized visa assistance for every journey.', NULL, NULL, NULL, 2, 1, '1', '1', '2025-05-17 11:05:37', '2025-06-08 11:27:22'),
(2, 'Let’s begin a fresh start here — new opportunities await ahead.', 'Your Journey Begins Here', 'lets-begin-a-fresh-start-here', 'storage/photos/1/slider/slider-1.jpg', 'Believe in yourself — with confidence comes opportunity. When you do, luck naturally finds its way to you.', NULL, NULL, NULL, 1, 1, '1', '1', '2025-05-19 07:56:53', '2025-06-08 11:25:54'),
(3, 'Our Blogs', 'Blog', 'about-us', 'storage/photos/1/coaching/single-3.jpg', NULL, NULL, NULL, NULL, 3, 1, '1', '1', '2025-06-09 07:42:42', '2025-06-14 19:27:33');

-- --------------------------------------------------------

--
-- Table structure for table `templates`
--

CREATE TABLE `templates` (
  `templates_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subtitle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alias` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thumb` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `entries` text COLLATE utf8mb4_unicode_ci,
  `children` text COLLATE utf8mb4_unicode_ci,
  `status` int NOT NULL DEFAULT '1',
  `parent` int NOT NULL DEFAULT '1',
  `display_order` int DEFAULT NULL,
  `createdby` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updatedby` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `templates`
--

INSERT INTO `templates` (`templates_id`, `name`, `title`, `subtitle`, `alias`, `thumb`, `entries`, `children`, `status`, `parent`, `display_order`, `createdby`, `updatedby`, `created_at`, `updated_at`) VALUES
(1, '404', '404', NULL, '404', NULL, NULL, NULL, 1, -1, 1, '1', '1', '2025-06-14 19:32:11', '2025-06-14 19:32:11'),
(2, 'blogs.blog', 'blogs.blog', NULL, 'blogs-blog', NULL, NULL, NULL, 1, -1, 2, '1', '1', '2025-06-14 19:32:11', '2025-06-14 19:32:11'),
(3, 'blogs.slider', 'blogs.slider', NULL, 'blogs-slider', NULL, NULL, NULL, 1, -1, 3, '1', '1', '2025-06-14 19:32:11', '2025-06-14 19:32:11'),
(4, 'home', 'home', NULL, 'home', NULL, NULL, '26,12,5,14,9,15,11,8,7,13,6,10,25', 1, 1, 4, '1', '1', '2025-06-14 19:32:11', '2025-06-14 19:35:31'),
(5, 'home.about', 'home.about', NULL, 'home-about', NULL, NULL, NULL, 1, -1, 5, '1', '1', '2025-06-14 19:32:11', '2025-06-14 19:32:11'),
(6, 'home.blogs', 'home.blogs', NULL, 'home-blogs', NULL, NULL, NULL, 1, -1, 6, '1', '1', '2025-06-14 19:32:11', '2025-06-14 19:32:11'),
(7, 'home.coaching', 'home.coaching', NULL, 'home-coaching', NULL, NULL, NULL, 1, -1, 7, '1', '1', '2025-06-14 19:32:11', '2025-06-14 19:32:11'),
(8, 'home.counter', 'home.counter', NULL, 'home-counter', NULL, NULL, NULL, 1, -1, 8, '1', '1', '2025-06-14 19:32:11', '2025-06-14 19:32:11'),
(9, 'home.country', 'home.country', NULL, 'home-country', NULL, NULL, NULL, 1, -1, 9, '1', '1', '2025-06-14 19:32:11', '2025-06-14 19:32:11'),
(10, 'home.partners', 'home.partners', NULL, 'home-partners', NULL, NULL, NULL, 1, -1, 10, '1', '1', '2025-06-14 19:32:11', '2025-06-14 19:32:11'),
(11, 'home.skills', 'home.skills', NULL, 'home-skills', NULL, NULL, NULL, 1, -1, 11, '1', '1', '2025-06-14 19:32:11', '2025-06-14 19:32:11'),
(12, 'home.slider', 'home.slider', NULL, 'home-slider', NULL, NULL, NULL, 1, -1, 12, '1', '1', '2025-06-14 19:32:11', '2025-06-14 19:32:11'),
(13, 'home.testimonials', 'home.testimonials', NULL, 'home-testimonials', NULL, NULL, NULL, 1, -1, 13, '1', '1', '2025-06-14 19:32:11', '2025-06-14 19:32:11'),
(14, 'home.what-we-offer', 'home.what-we-offer', NULL, 'home-what-we-offer', NULL, NULL, NULL, 1, -1, 14, '1', '1', '2025-06-14 19:32:11', '2025-06-14 19:32:11'),
(15, 'home.why-choose-us', 'home.why-choose-us', NULL, 'home-why-choose-us', NULL, NULL, NULL, 1, -1, 15, '1', '1', '2025-06-14 19:32:11', '2025-06-14 19:32:11'),
(16, 'pages.about', 'pages.about', NULL, 'pages-about', NULL, NULL, NULL, 1, -1, 16, '1', '1', '2025-06-14 19:32:11', '2025-06-14 19:32:11'),
(17, 'pages.blog-details', 'pages.blog-details', NULL, 'pages-blog-details', NULL, NULL, NULL, 1, -1, 17, '1', '1', '2025-06-14 19:32:11', '2025-06-14 19:32:11'),
(18, 'pages.contact', 'pages.contact', NULL, 'pages-contact', NULL, NULL, NULL, 1, -1, 18, '1', '1', '2025-06-14 19:32:11', '2025-06-14 19:32:11'),
(19, 'pages.content-single', 'pages.content-single', NULL, 'pages-content-single', NULL, NULL, NULL, 1, -1, 19, '1', '1', '2025-06-14 19:32:11', '2025-06-14 19:32:11'),
(20, 'pages.faq', 'pages.faq', NULL, 'pages-faq', NULL, NULL, NULL, 1, -1, 20, '1', '1', '2025-06-14 19:32:11', '2025-06-14 19:32:11'),
(21, 'pages.form', 'pages.form', NULL, 'pages-form', NULL, NULL, NULL, 1, -1, 21, '1', '1', '2025-06-14 19:32:11', '2025-06-14 19:32:11'),
(22, 'pages.testimonials', 'pages.testimonials', NULL, 'pages-testimonials', NULL, NULL, NULL, 1, -1, 22, '1', '1', '2025-06-14 19:32:11', '2025-06-14 19:32:11'),
(23, 'partials.coachingForm', 'partials.coachingForm', NULL, 'partials-coachingForm', NULL, NULL, NULL, 1, -1, 23, '1', '1', '2025-06-14 19:32:11', '2025-06-14 19:32:11'),
(24, 'partials.countryForm', 'partials.countryForm', NULL, 'partials-countryForm', NULL, NULL, NULL, 1, -1, 24, '1', '1', '2025-06-14 19:32:11', '2025-06-14 19:32:11'),
(25, 'partials.footer', 'partials.footer', NULL, 'partials-footer', NULL, NULL, NULL, 1, -1, 25, '1', '1', '2025-06-14 19:32:11', '2025-06-14 19:32:11'),
(26, 'partials.header', 'partials.header', NULL, 'partials-header', NULL, NULL, NULL, 1, -1, 26, '1', '1', '2025-06-14 19:32:12', '2025-06-14 19:32:12'),
(27, 'single', 'single', NULL, 'single', NULL, NULL, NULL, 1, -1, 27, '1', '1', '2025-06-14 19:32:12', '2025-06-14 19:32:12'),
(28, 'Blogs', 'Blogs', 'Blogs', 'blogs', NULL, NULL, '26,3,2,20,25', 1, 1, 28, '1', '1', '2025-06-14 19:33:00', '2025-06-14 19:33:00'),
(29, 'Detail Page', 'Detail Page', 'Detail Page', 'detail-page', NULL, NULL, '26,19,25', 1, 1, 29, '1', '1', '2025-06-14 20:05:01', '2025-06-14 20:05:01');

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `testimonials_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alias` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thumb` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `display_order` int DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1',
  `createdby` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updatedby` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`testimonials_id`, `name`, `alias`, `position`, `thumb`, `description`, `display_order`, `status`, `createdby`, `updatedby`, `created_at`, `updated_at`) VALUES
(1, 'Asmita Adhikari', 'pratiksha-dhungana', 'Graduate Student – Canada', 'storage/photos/1/testimonial/03.jpg', 'From university selection to pre-departure support, Nepal Dela provided exceptional service. Their dedication to students is truly commendable.', 1, 1, '1', '1', '2025-06-08 11:14:49', '2025-06-14 20:00:32');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Gokul Subedi', 'subedigokul119@gmail.com', NULL, '$2y$12$m3ezhgiGjQ6m75vJrUBXqOLU.fM0pcj5SYpv.sRlvd7BbfymOvrwa', 'LAuwWpiLaQtN6tE0Xj2BttqOy3Xc8jf3OwkJzfRgtU4D17tjpsaaYTg8FBWd', '2025-05-17 10:53:56', '2025-05-17 10:53:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`articles_id`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`blogs_id`);

--
-- Indexes for table `buttons`
--
ALTER TABLE `buttons`
  ADD PRIMARY KEY (`buttons_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `coachings`
--
ALTER TABLE `coachings`
  ADD PRIMARY KEY (`coachings_id`);

--
-- Indexes for table `connections`
--
ALTER TABLE `connections`
  ADD PRIMARY KEY (`connections_id`);

--
-- Indexes for table `contents`
--
ALTER TABLE `contents`
  ADD PRIMARY KEY (`contents_id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`countries_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `icon_atricles`
--
ALTER TABLE `icon_atricles`
  ADD PRIMARY KEY (`icon_atricles_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `labels`
--
ALTER TABLE `labels`
  ADD PRIMARY KEY (`labels_id`);

--
-- Indexes for table `mappers`
--
ALTER TABLE `mappers`
  ADD PRIMARY KEY (`mappers_id`),
  ADD UNIQUE KEY `mappers_title_unique` (`title`),
  ADD UNIQUE KEY `mappers_alias_unique` (`alias`);

--
-- Indexes for table `menucategories`
--
ALTER TABLE `menucategories`
  ADD PRIMARY KEY (`menuCategories_id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`menus_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `navigations`
--
ALTER TABLE `navigations`
  ADD PRIMARY KEY (`navigations_id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`pages_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `routes`
--
ALTER TABLE `routes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `routes_name_unique` (`name`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`setting_id`);

--
-- Indexes for table `single_pages`
--
ALTER TABLE `single_pages`
  ADD PRIMARY KEY (`single_pages_id`),
  ADD UNIQUE KEY `single_pages_name_unique` (`name`);

--
-- Indexes for table `single_templates`
--
ALTER TABLE `single_templates`
  ADD PRIMARY KEY (`single_templates_id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`sliders_id`);

--
-- Indexes for table `templates`
--
ALTER TABLE `templates`
  ADD PRIMARY KEY (`templates_id`),
  ADD UNIQUE KEY `templates_name_unique` (`name`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`testimonials_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `articles_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `blogs_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `buttons`
--
ALTER TABLE `buttons`
  MODIFY `buttons_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `coachings`
--
ALTER TABLE `coachings`
  MODIFY `coachings_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `connections`
--
ALTER TABLE `connections`
  MODIFY `connections_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `contents`
--
ALTER TABLE `contents`
  MODIFY `contents_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `countries_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `icon_atricles`
--
ALTER TABLE `icon_atricles`
  MODIFY `icon_atricles_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `labels`
--
ALTER TABLE `labels`
  MODIFY `labels_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `mappers`
--
ALTER TABLE `mappers`
  MODIFY `mappers_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `menucategories`
--
ALTER TABLE `menucategories`
  MODIFY `menuCategories_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `menus_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `navigations`
--
ALTER TABLE `navigations`
  MODIFY `navigations_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `pages_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=192;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `routes`
--
ALTER TABLE `routes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=192;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `setting_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `single_pages`
--
ALTER TABLE `single_pages`
  MODIFY `single_pages_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `single_templates`
--
ALTER TABLE `single_templates`
  MODIFY `single_templates_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `sliders_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `templates`
--
ALTER TABLE `templates`
  MODIFY `templates_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `testimonials_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
