-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 07, 2026 at 01:37 PM
-- Server version: 5.7.24
-- PHP Version: 8.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hotel`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admin_user` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admin_pass` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admin_realpass` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admin_permission` int(1) DEFAULT '2',
  `hotel_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admin_sort` int(11) DEFAULT NULL,
  `admin_status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_name`, `admin_user`, `admin_pass`, `admin_realpass`, `admin_permission`, `hotel_id`, `admin_sort`, `admin_status`) VALUES
(1, 'Admin', 'admin', 'e698f2679be5ba5c9c0b0031cb5b057c', '@admin', 1, NULL, 0, 1),
(7, 'test', 'test', 'e10adc3949ba59abbe56e057f20f883e', '123456', 2, NULL, 1, 1),
(9, 'Sutthisak', 'Sutthisak', 'e10adc3949ba59abbe56e057f20f883e', '123456', 2, '1,2', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `big_title`
--

CREATE TABLE `big_title` (
  `title_id` int(11) NOT NULL COMMENT 'Primary key',
  `title_th` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subtitle_th` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description_th` text COLLATE utf8mb4_unicode_ci,
  `title_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subtitle_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description_en` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'ชื่อไฟล์รูปภาพ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `big_title`
--

INSERT INTO `big_title` (`title_id`, `title_th`, `subtitle_th`, `description_th`, `title_en`, `subtitle_en`, `description_en`, `image`) VALUES
(3, '1z', '1z', '<p>1z</p>', '1z', '1z', '<p>1z</p>', '20260507114750_QlsOm.jfif');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `contact_id` int(11) NOT NULL,
  `hotel_id` int(11) NOT NULL DEFAULT '1',
  `mail_des_th` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mail_des_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_des_th` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_des_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`contact_id`, `hotel_id`, `mail_des_th`, `mail_des_en`, `contact_des_th`, `contact_des_en`) VALUES
(1, 1, '<p>z</p>', '<p>z</p>', '<p>z</p>', '<p>z</p>'),
(2, 2, '<p>1</p>', '<p>1</p>', '<p>1</p>', '<p>1</p>');

-- --------------------------------------------------------

--
-- Table structure for table `facility`
--

CREATE TABLE `facility` (
  `facility_id` int(11) NOT NULL COMMENT 'Primary key',
  `hotel_id` int(11) DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'รูปภาพ เช่น sunbathing chair, key card access',
  `facility_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'ชื่อสิ่งอำนวยความสะดวก',
  `sort_order` int(11) DEFAULT '0' COMMENT 'ลำดับการแสดงผล',
  `status` tinyint(1) DEFAULT '1' COMMENT '1=เปิด, 0=ปิด'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='สิ่งอำนวยความสะดวก';

--
-- Dumping data for table `facility`
--

INSERT INTO `facility` (`facility_id`, `hotel_id`, `image`, `facility_name`, `sort_order`, `status`) VALUES
(1, 2, '20260507111029_U5jTO.jfif', '1', 1, 1),
(2, 1, '20260507113318_sKHef.jfif', '1', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `footer`
--

CREATE TABLE `footer` (
  `footer_id` int(11) NOT NULL COMMENT 'Primary key',
  `hotel_id` int(11) DEFAULT NULL COMMENT 'FK → hotel.hotel_id',
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'ชื่อไฟล์รูป logo',
  `description_th` text COLLATE utf8mb4_unicode_ci COMMENT 'คำอธิบายใต้ logo (ไทย)',
  `description_en` text COLLATE utf8mb4_unicode_ci COMMENT 'คำอธิบายใต้ logo (อังกฤษ)',
  `phone` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'เบอร์โทรศัพท์',
  `email` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'อีเมล',
  `address_th` text COLLATE utf8mb4_unicode_ci COMMENT 'ที่อยู่ (ไทย)',
  `address_en` text COLLATE utf8mb4_unicode_ci COMMENT 'ที่อยู่ (อังกฤษ)',
  `facebook_url` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'ลิงก์ Facebook',
  `instagram_url` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'ลิงก์ Instagram',
  `line_url` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'ลิงก์ Line OA',
  `map_url` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Google Map Embed URL',
  `status` tinyint(1) DEFAULT '1' COMMENT '1=เปิด, 0=ปิด',
  `soft_order` int(11) DEFAULT '1' COMMENT '1=เปิด, 0=ปิด'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='ข้อมูล Footer ของแต่ละโรงแรม';

--
-- Dumping data for table `footer`
--

INSERT INTO `footer` (`footer_id`, `hotel_id`, `logo`, `description_th`, `description_en`, `phone`, `email`, `address_th`, `address_en`, `facebook_url`, `instagram_url`, `line_url`, `map_url`, `status`, `soft_order`) VALUES
(12, 1, '20260507115142_qpeJQ.jfif', '<p>z</p>', '<p>z</p>', '[\"z\"]', '[\"z\"]', '<p>z</p>', '<p>z</p>', 'z', 'z', 'z', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3776.8580809120313!2d99.02991177604962!3d18.80447698234504!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30da253fa9a03aa1%3A0xfee732fe3136f175!2z4Lij4Lix4Lia4LiX4Liz4LmA4Lin4LmH4Lia4LmE4LiL4LiV4LmM4LmA4LiK4Li14Lii4LiH4LmD4Lir4Lih4LmIICjguYDguIrguLXguKLguIfguYPguKvguKHguYjguYLguIvguJnguJTguK3guJfguITguK3guKEp!5e0!3m2!1sen!2sth!4v1778128236919!5m2!1sen!2sth\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>', 1, 1),
(13, 2, '20260507115644_rhmHo.jfif', '<p>z</p>', '<p>z</p>', '[\"z\"]', '[\"z\"]', '<p>z</p>', '<p>z</p>', 'z', 'z', 'z', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3776.8580809120313!2d99.02991177604962!3d18.80447698234504!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30da253fa9a03aa1%3A0xfee732fe3136f175!2z4Lij4Lix4Lia4LiX4Liz4LmA4Lin4LmH4Lia4LmE4LiL4LiV4LmM4LmA4LiK4Li14Lii4LiH4LmD4Lir4Lih4LmIICjguYDguIrguLXguKLguIfguYPguKvguKHguYjguYLguIvguJnguJTguK3guJfguITguK3guKEp!5e0!3m2!1sen!2sth!4v1778128236919!5m2!1sen!2sth\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `gallery_id` int(11) NOT NULL,
  `hotel_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `sort_order` int(11) DEFAULT '1',
  `status` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`gallery_id`, `hotel_id`, `category_id`, `image`, `sort_order`, `status`) VALUES
(1, 1, 1, '20260507113353_Fyrqr.jfif', 1, 1),
(2, 1, 1, '20260507113353_XXffm.jfif', 2, 1),
(3, 2, 2, '20260507115740_91Wkp.jfif', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `gallery_category`
--

CREATE TABLE `gallery_category` (
  `category_id` int(11) NOT NULL,
  `hotel_id` int(11) DEFAULT NULL,
  `name_th` varchar(255) DEFAULT NULL,
  `name_en` varchar(255) DEFAULT NULL,
  `sort_order` int(11) DEFAULT '1',
  `status` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gallery_category`
--

INSERT INTO `gallery_category` (`category_id`, `hotel_id`, `name_th`, `name_en`, `sort_order`, `status`) VALUES
(1, 1, '1', '1', 1, 1),
(2, 2, 'z', 'z', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `hotel`
--

CREATE TABLE `hotel` (
  `hotel_id` int(11) NOT NULL COMMENT 'Primary key',
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'รูปภาพ',
  `title_th` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description_th` text COLLATE utf8mb4_unicode_ci,
  `title_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description_en` text COLLATE utf8mb4_unicode_ci,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort_order` int(11) DEFAULT NULL COMMENT 'ลำดับการแสดงผล',
  `status` tinyint(1) DEFAULT NULL COMMENT '1=เปิด, 0=ปิด'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hotel`
--

INSERT INTO `hotel` (`hotel_id`, `image`, `title_th`, `description_th`, `title_en`, `description_en`, `color`, `sort_order`, `status`) VALUES
(1, '20260507105334_2a9TL.jfif', 'ฟ', 'ฟ', 'ฟ', 'ฟ', '#ff0000', 1, 1),
(2, '20260507114720_txDeO.jfif', 'zz', 'zz', 'z', 'z', '#ff0000', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `hotel_banner`
--

CREATE TABLE `hotel_banner` (
  `banner_id` int(11) NOT NULL,
  `hotel_id` int(11) DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort_order` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hotel_banner`
--

INSERT INTO `hotel_banner` (`banner_id`, `hotel_id`, `image`, `sort_order`, `status`) VALUES
(1, NULL, '20260507113536_8Llti.jfif', 1, 1),
(2, NULL, '20260507114658_gjhld.jfif', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `hotel_banner_image`
--

CREATE TABLE `hotel_banner_image` (
  `id` int(11) NOT NULL,
  `hotel_id` int(11) NOT NULL,
  `banner_image` varchar(255) DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `url_check_in` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hotel_banner_image`
--

INSERT INTO `hotel_banner_image` (`id`, `hotel_id`, `banner_image`, `sort_order`, `status`, `url_check_in`) VALUES
(1, 1, '20260507111224_1PFEw.jfif', 1, 1, 'https://chiangmaizone.net/iwualai/index.php'),
(2, 2, '20260507114928_wBd8v.jfif', 1, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `hotel_home_banner`
--

CREATE TABLE `hotel_home_banner` (
  `id` int(11) NOT NULL,
  `hotel_id` int(11) NOT NULL COMMENT 'FK → hotel.hotel_id',
  `banner_backgroud_1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'รูป Banner หน้าหลัก (1920×600 px)',
  `banner_hotel_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'รูปพื้นหลัง About (1000×800 px)',
  `banner_title_th` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'ชื่อหัวข้อ (ไทย)',
  `banner_title_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'ชื่อหัวข้อ (อังกฤษ)',
  `banner_subtitle_th` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'ชื่อรอง (ไทย)',
  `banner_subtitle_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'ชื่อรอง (อังกฤษ)',
  `banner_desc_th` text COLLATE utf8mb4_unicode_ci COMMENT 'คำอธิบาย Banner (ไทย)',
  `banner_desc_en` text COLLATE utf8mb4_unicode_ci COMMENT 'คำอธิบาย Banner (อังกฤษ)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Banner หน้าหลักของโรงแรม (1 โรงแรม : 1 แถว)';

--
-- Dumping data for table `hotel_home_banner`
--

INSERT INTO `hotel_home_banner` (`id`, `hotel_id`, `banner_backgroud_1`, `banner_hotel_image`, `banner_title_th`, `banner_title_en`, `banner_subtitle_th`, `banner_subtitle_en`, `banner_desc_th`, `banner_desc_en`) VALUES
(4, 1, '20260507111421_aXzTs.jfif', '20260507111421_uj0Y3.jfif', '1', '1', '1', '1', '<p>1</p>', '<p>1</p>'),
(5, 2, '20260507114949_7DYW.jfif', '20260507114949_Rxwtm.jfif', 'z', 'z', 'z', 'z', '<p>z</p>', '<p>z</p>');

-- --------------------------------------------------------

--
-- Table structure for table `hotel_home_facilities`
--

CREATE TABLE `hotel_home_facilities` (
  `id` int(11) NOT NULL,
  `hotel_id` int(11) NOT NULL,
  `gallery_bg_img` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'ชื่อไฟล์รูป Background ของ Gallery section',
  `gallery_desc_th` text COLLATE utf8mb4_unicode_ci COMMENT 'คำอธิบาย Gallery (ภาษาไทย)',
  `gallery_desc_en` text COLLATE utf8mb4_unicode_ci COMMENT 'คำอธิบาย Gallery (English)',
  `facilities_bg_img` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'ชื่อไฟล์รูป Background ของ Facilities section',
  `facilities_title_th` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'หัวข้อ Facilities (ภาษาไทย)',
  `facilities_subtitle_th` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'หัวข้อรอง Facilities (ภาษาไทย)',
  `facilities_title_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'หัวข้อ Facilities (English)',
  `facilities_subtitle_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'หัวข้อรอง Facilities (English)',
  `gallery_title_th` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gallery_title_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gallery_sub_title_th` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gallery_sub_title_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='ข้อมูล Section Gallery และ Facilities ของหน้า Home แต่ละโรงแรม';

--
-- Dumping data for table `hotel_home_facilities`
--

INSERT INTO `hotel_home_facilities` (`id`, `hotel_id`, `gallery_bg_img`, `gallery_desc_th`, `gallery_desc_en`, `facilities_bg_img`, `facilities_title_th`, `facilities_subtitle_th`, `facilities_title_en`, `facilities_subtitle_en`, `gallery_title_th`, `gallery_title_en`, `gallery_sub_title_th`, `gallery_sub_title_en`) VALUES
(4, 1, '20260507111502_TBY15.jfif', '<p>1</p>', '<p>1</p>', '20260507111502_gsptw.jfif', '1', '1', '1', '1', '1', '1', '1', '1'),
(5, 2, '20260507115027_AiddK.jfif', '<p>z</p>', '<p>z</p>', '20260507115027_OxeSq.jfif', 'z', 'z', 'z', 'z', 'z', 'z', 'z', 'z');

-- --------------------------------------------------------

--
-- Table structure for table `hotel_home_rooms`
--

CREATE TABLE `hotel_home_rooms` (
  `id` int(11) NOT NULL,
  `hotel_id` int(11) NOT NULL COMMENT 'FK → hotel.hotel_id',
  `rooms_bg_img` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'รูป Background Rooms (2000×1000 px)',
  `rooms_title_th` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'หัวข้อ (ไทย)',
  `rooms_title_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'หัวข้อ (อังกฤษ)',
  `rooms_subtitle_th` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'หัวข้อรอง (ไทย)',
  `rooms_subtitle_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'หัวข้อรอง (อังกฤษ)',
  `rooms_desc_th` text COLLATE utf8mb4_unicode_ci COMMENT 'คำอธิบาย (ไทย)',
  `rooms_desc_en` text COLLATE utf8mb4_unicode_ci COMMENT 'คำอธิบาย (อังกฤษ)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Rooms Section หน้าหลักของโรงแรม (1 โรงแรม : 1 แถว)';

--
-- Dumping data for table `hotel_home_rooms`
--

INSERT INTO `hotel_home_rooms` (`id`, `hotel_id`, `rooms_bg_img`, `rooms_title_th`, `rooms_title_en`, `rooms_subtitle_th`, `rooms_subtitle_en`, `rooms_desc_th`, `rooms_desc_en`) VALUES
(4, 1, '20260507111437_GdNJ.jfif', '1', '1', '1', '1', '<p>1</p>', '<p>1</p>'),
(5, 2, '20260507115002_JKi1t.png', 'z', 'z', 'z', 'z', '<p>z</p>', '<p>z</p>');

-- --------------------------------------------------------

--
-- Table structure for table `other_slides`
--

CREATE TABLE `other_slides` (
  `other_slide_id` int(11) NOT NULL,
  `hotel_id` int(11) DEFAULT NULL,
  `img_room` varchar(255) DEFAULT NULL,
  `img_facilities` varchar(255) DEFAULT NULL,
  `img_gallery` varchar(255) DEFAULT NULL,
  `img_contact` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `other_slides`
--

INSERT INTO `other_slides` (`other_slide_id`, `hotel_id`, `img_room`, `img_facilities`, `img_gallery`, `img_contact`) VALUES
(11, 1, '20260507105531_wscEW.png', '20260507105531_yCkFf.jfif', '20260507105531_GYGqn.jfif', '20260507105531_h2b91.jfif'),
(12, 2, '20260507114851_IeOIe.jfif', '20260507114851_iWgrT.jfif', '20260507114851_NPsM4.jfif', '20260507114851_L3NIa.jfif');

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `room_id` int(11) NOT NULL COMMENT 'Primary key',
  `hotel_id` int(11) DEFAULT NULL,
  `room_type` int(11) DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'ชื่อไฟล์รูปภาพห้อง',
  `banner_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title_th` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'ชื่อประเภทห้อง (ไทย)',
  `subtitle_th` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'ชื่อประเภทห้อง (อังกฤษ)',
  `subtitle_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort_order` int(11) DEFAULT '0' COMMENT 'ลำดับการแสดงผล',
  `status` tinyint(1) DEFAULT '0' COMMENT '0=ว่าง, 1=มีผู้เข้าพัก',
  `amenity_bg_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_th` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='ห้องพักจริงแต่ละห้องในโรงแรม';

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`room_id`, `hotel_id`, `room_type`, `image`, `banner_image`, `title_th`, `subtitle_th`, `title_en`, `subtitle_en`, `sort_order`, `status`, `amenity_bg_image`, `name_th`, `name_en`) VALUES
(22, 2, NULL, NULL, '20260507105430_IjeD5.jfif', '1', '1', '1', '1', 1, 1, '20260507105430_9r7tt.jfif', '1', '1'),
(23, 1, NULL, NULL, '20260507114502_OWkL6.jfif', '1', '1', '1', '1', 1, 1, '20260507114502_Gam1u.jfif', '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `room_facility`
--

CREATE TABLE `room_facility` (
  `id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='ความสัมพันธ์ระหว่างห้องพักและสิ่งอำนวยความสะดวก';

--
-- Dumping data for table `room_facility`
--

INSERT INTO `room_facility` (`id`, `room_id`, `name`) VALUES
(1, 22, '1'),
(3, 23, '1');

-- --------------------------------------------------------

--
-- Table structure for table `room_gallery`
--

CREATE TABLE `room_gallery` (
  `gallery_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL COMMENT 'เชื่อมกับตาราง room',
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'ชื่อไฟล์รูปภาพ',
  `sort_order` int(11) DEFAULT '1' COMMENT 'ลำดับการเรียง',
  `status` tinyint(1) DEFAULT '1' COMMENT '1=แสดง, 0=ซ่อน'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `room_gallery`
--

INSERT INTO `room_gallery` (`gallery_id`, `room_id`, `image`, `sort_order`, `status`) VALUES
(3, 22, '20260507105430_zipUZ.jfif', 0, 1),
(4, 22, '20260507105430_5dtP2.jfif', 0, 1),
(5, 23, '20260507113307_CwZeA.jfif', 0, 1),
(6, 23, '20260507113307_oMoIX.jfif', 0, 1),
(7, 23, '20260507114502_uXFpB.jfif', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `seo_meta`
--

CREATE TABLE `seo_meta` (
  `seo_id` int(11) NOT NULL,
  `page_name` varchar(100) NOT NULL,
  `meta_content` text,
  `robots` varchar(100) DEFAULT 'index, follow',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `seo_meta`
--

INSERT INTO `seo_meta` (`seo_id`, `page_name`, `meta_content`, `robots`, `created_at`, `updated_at`) VALUES
(1, 'home', '<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\r\n    <title>ปายวินเทจการ์เด้น,ที่พัก ปาย,ห้องพัก ปาย,รีสอร์ท ปาย,ที่พัก เมืองปาย </title>', 'index, follow', '2026-03-03 15:16:15', '2026-03-19 10:39:40'),
(2, 'room', '<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\r\n    <title>ปายวินเทจการ์เด้น,ที่พัก ปาย,ห้องพัก ปาย,รีสอร์ท ปาย,ที่พัก เมืองปาย </title>', 'index, follow', '2026-03-11 14:28:32', '2026-03-11 15:38:55'),
(3, 'gallery', '<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\r\n    <title>ปายวินเทจการ์เด้น,ที่พัก ปาย,ห้องพัก ปาย,รีสอร์ท ปาย,ที่พัก เมืองปาย </title>', 'index, follow', '2026-03-11 15:49:15', '2026-03-11 15:49:15'),
(4, 'contact', '<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\r\n    <title>ปายวินเทจการ์เด้น,ที่พัก ปาย,ห้องพัก ปาย,รีสอร์ท ปาย,ที่พัก เมืองปา,เวียงใต้ </title>', 'index, follow', '2026-03-11 15:49:21', '2026-03-19 09:50:42');

-- --------------------------------------------------------

--
-- Table structure for table `sub_title`
--

CREATE TABLE `sub_title` (
  `sub_id` int(11) NOT NULL COMMENT 'Primary key',
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'เก็บชื่อไฟล์รูปภาพ',
  `sub_desc_th` text COLLATE utf8mb4_unicode_ci COMMENT 'รายละเอียดภาษาไทย',
  `sub_desc_en` text COLLATE utf8mb4_unicode_ci COMMENT 'รายละเอียดภาษาอังกฤษ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_title`
--

INSERT INTO `sub_title` (`sub_id`, `image`, `sub_desc_th`, `sub_desc_en`) VALUES
(2, '20260507114801_QcuXS.jfif', '<p>1z</p>', '<p>1z</p>');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `big_title`
--
ALTER TABLE `big_title`
  ADD PRIMARY KEY (`title_id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`contact_id`),
  ADD KEY `fk_contact_hotel` (`hotel_id`);

--
-- Indexes for table `facility`
--
ALTER TABLE `facility`
  ADD PRIMARY KEY (`facility_id`),
  ADD KEY `idx_hotel_id` (`hotel_id`);

--
-- Indexes for table `footer`
--
ALTER TABLE `footer`
  ADD PRIMARY KEY (`footer_id`),
  ADD UNIQUE KEY `uq_footer_hotel` (`hotel_id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`gallery_id`),
  ADD KEY `fk_gallery_category` (`category_id`),
  ADD KEY `idx_gallery_hotel_id` (`hotel_id`);

--
-- Indexes for table `gallery_category`
--
ALTER TABLE `gallery_category`
  ADD PRIMARY KEY (`category_id`),
  ADD KEY `idx_gallery_category_hotel_id` (`hotel_id`);

--
-- Indexes for table `hotel`
--
ALTER TABLE `hotel`
  ADD PRIMARY KEY (`hotel_id`);

--
-- Indexes for table `hotel_banner`
--
ALTER TABLE `hotel_banner`
  ADD PRIMARY KEY (`banner_id`),
  ADD KEY `idx_banner_hotel_id` (`hotel_id`);

--
-- Indexes for table `hotel_banner_image`
--
ALTER TABLE `hotel_banner_image`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hotel_id` (`hotel_id`);

--
-- Indexes for table `hotel_home_banner`
--
ALTER TABLE `hotel_home_banner`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_hotel_home_banner_hotel` (`hotel_id`);

--
-- Indexes for table `hotel_home_facilities`
--
ALTER TABLE `hotel_home_facilities`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_hotel_id` (`hotel_id`);

--
-- Indexes for table `hotel_home_rooms`
--
ALTER TABLE `hotel_home_rooms`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_hotel_home_rooms_hotel` (`hotel_id`);

--
-- Indexes for table `other_slides`
--
ALTER TABLE `other_slides`
  ADD PRIMARY KEY (`other_slide_id`),
  ADD KEY `hotel_id` (`hotel_id`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`room_id`),
  ADD KEY `fk_room_room_type` (`room_type`),
  ADD KEY `hotel_id` (`hotel_id`);

--
-- Indexes for table `room_facility`
--
ALTER TABLE `room_facility`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_room_id` (`room_id`);

--
-- Indexes for table `room_gallery`
--
ALTER TABLE `room_gallery`
  ADD PRIMARY KEY (`gallery_id`),
  ADD KEY `idx_room_id` (`room_id`);

--
-- Indexes for table `seo_meta`
--
ALTER TABLE `seo_meta`
  ADD PRIMARY KEY (`seo_id`),
  ADD UNIQUE KEY `seo_id` (`seo_id`),
  ADD UNIQUE KEY `page_name` (`page_name`);

--
-- Indexes for table `sub_title`
--
ALTER TABLE `sub_title`
  ADD PRIMARY KEY (`sub_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `big_title`
--
ALTER TABLE `big_title`
  MODIFY `title_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary key', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `facility`
--
ALTER TABLE `facility`
  MODIFY `facility_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary key', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `footer`
--
ALTER TABLE `footer`
  MODIFY `footer_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary key', AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `gallery_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `gallery_category`
--
ALTER TABLE `gallery_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `hotel`
--
ALTER TABLE `hotel`
  MODIFY `hotel_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary key', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `hotel_banner`
--
ALTER TABLE `hotel_banner`
  MODIFY `banner_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `hotel_banner_image`
--
ALTER TABLE `hotel_banner_image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `hotel_home_banner`
--
ALTER TABLE `hotel_home_banner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `hotel_home_facilities`
--
ALTER TABLE `hotel_home_facilities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `hotel_home_rooms`
--
ALTER TABLE `hotel_home_rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `other_slides`
--
ALTER TABLE `other_slides`
  MODIFY `other_slide_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary key', AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `room_facility`
--
ALTER TABLE `room_facility`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `room_gallery`
--
ALTER TABLE `room_gallery`
  MODIFY `gallery_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `seo_meta`
--
ALTER TABLE `seo_meta`
  MODIFY `seo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sub_title`
--
ALTER TABLE `sub_title`
  MODIFY `sub_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary key', AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `contact`
--
ALTER TABLE `contact`
  ADD CONSTRAINT `fk_contact_hotel` FOREIGN KEY (`hotel_id`) REFERENCES `hotel` (`hotel_id`) ON DELETE CASCADE;

--
-- Constraints for table `footer`
--
ALTER TABLE `footer`
  ADD CONSTRAINT `fk_footer_hotel` FOREIGN KEY (`hotel_id`) REFERENCES `hotel` (`hotel_id`) ON DELETE CASCADE;

--
-- Constraints for table `hotel_home_banner`
--
ALTER TABLE `hotel_home_banner`
  ADD CONSTRAINT `fk_hotel_home_banner_hotel` FOREIGN KEY (`hotel_id`) REFERENCES `hotel` (`hotel_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `hotel_home_facilities`
--
ALTER TABLE `hotel_home_facilities`
  ADD CONSTRAINT `fk_hhf_hotel` FOREIGN KEY (`hotel_id`) REFERENCES `hotel` (`hotel_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `hotel_home_rooms`
--
ALTER TABLE `hotel_home_rooms`
  ADD CONSTRAINT `fk_hotel_home_rooms_hotel` FOREIGN KEY (`hotel_id`) REFERENCES `hotel` (`hotel_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `room_facility`
--
ALTER TABLE `room_facility`
  ADD CONSTRAINT `fk_rf_room` FOREIGN KEY (`room_id`) REFERENCES `room` (`room_id`) ON DELETE CASCADE;

--
-- Constraints for table `room_gallery`
--
ALTER TABLE `room_gallery`
  ADD CONSTRAINT `fk_room_gallery_room` FOREIGN KEY (`room_id`) REFERENCES `room` (`room_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
