-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 27, 2026 at 09:52 AM
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
-- Database: `iwualai`
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
(7, 'test', 'test', 'e10adc3949ba59abbe56e057f20f883e', '123456', 2, '3', 1, 1),
(9, 'Sutthisak', 'Sutthisak', 'e10adc3949ba59abbe56e057f20f883e', '123456', 2, '1,2,3', 2, 1),
(10, 'wave', 'wave', 'e10adc3949ba59abbe56e057f20f883e', '123456', 2, '1,2,3', 3, 1);

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
(3, 'ค้นพบ iHotels Collection', 'ค้นพบ iHotels Collection', '<p>iHotels Collection คือกลุ่มโรงแรมบูติกในเชียงใหม่ ที่สร้างขึ้นภายใต้ปรัชญา &ldquo;น้อยแต่มาก&rdquo;<br>โรงแรมแต่ละแห่งได้รับการออกแบบอย่างพิถีพิถันเพื่อมอบความสะดวกสบาย ความเรียบง่าย และทำเลที่ตั้งที่ดีเยี่ยม ช่วยให้แขกได้สัมผัสเมืองได้อย่างง่ายดาย<br>ไม่ว่าคุณจะชื่นชอบย่านวัฒนธรรม ความสะดวกสบายใจกลางเมือง หรือการเข้าพักที่ทันสมัยใหม่เอี่ยม โรงแรมของเรามีมาตรฐานการบริการและหลักการออกแบบเดียวกัน &mdash; โดยมีทำเลที่ตั้งและเอกลักษณ์ที่แตกต่างกัน</p>', 'DISCOVER IHOTELS COLLECTION', 'Discover iHotels Collection', '<div class=\"text wow fadeIn animated\" data-wow-delay=\"0.3s\">iHotels Collection is a group of boutique hotels in Chiang Mai, created under the philosophy &ldquo;Less is More.&rdquo;<br>Each hotel is thoughtfully designed to offer comfort, simplicity, and great locations, allowing guests to experience the city with ease.</div>\r\n<div class=\"text mt-3 mb-3 wow fadeIn animated\" data-wow-delay=\"0.4s\">Whether you prefer cultural neighborhoods, city-center convenience, or a brand-new modern stay, our hotels share the same service standards and design principles &mdash; with distinct locations and characters.</div>', '20260519113226_ZEYQr.png');

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
(2, 1, '20260507113318_sKHef.jfif', '1', 1, 0),
(3, 1, '20260522150123_xFHmB.jpg', 'sunbathing chair', 2, 1),
(4, 1, '20260522150147_DU5Ct.jpg', 'key card access', 3, 1),
(5, 1, '20260522150205_RbXfs.jpg', 'water dispenser', 4, 1);

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
(12, 1, '20260525140159_6AJEV.png', '<p>ติดตามเราบนโซเชียลมีเดียเพื่อรับเรื่องราว โปรโมชั่น และช่วงเวลาสุดพิเศษล่าสุด</p>', '<p>Stay connected&mdash;follow us on social media for the latest stories, offers, and moments.</p>', '[\"(+66) 53-271-800\"]', '[\"info@iwualai.com\"]', '<p>84 ถ.วัวลาย. ตำบล หายยา อำเภอ เมือง เชียงใหม่ 50100</p>', '<ul>\r\n<li>84 Wualai Road. Tambon Haiya, Amphoe Muang Chiang Mai 50100</li>\r\n</ul>', 'https://chiangmaizone.net/iwualai/index.php#', 'https://chiangmaizone.net/iwualai/index.php#', 'https://chiangmaizone.net/iwualai/index.php#', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3776.8580809120313!2d99.02991177604962!3d18.80447698234504!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30da253fa9a03aa1%3A0xfee732fe3136f175!2z4Lij4Lix4Lia4LiX4Liz4LmA4Lin4LmH4Lia4LmE4LiL4LiV4LmM4LmA4LiK4Li14Lii4LiH4LmD4Lir4Lih4LmIICjguYDguIrguLXguKLguIfguYPguKvguKHguYjguYLguIvguJnguJTguK3guJfguITguK3guKEp!5e0!3m2!1sen!2sth!4v1778128236919!5m2!1sen!2sth\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>', 1, 1),
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
(1, '20260519120136_UP9Rt.jpg', 'วัวลายโรงแรม', 'โรงแรม iWualai เป็นสาขาแรกของ iHotels Collection ที่สร้างขึ้นภายใต้แนวคิด “น้อยแต่มาก” ตั้งอยู่บนถนนวัวไหล ทำให้โรงแรมแห่งนี้เดินทางไปยังถนนคนเดินวันเสาร์ ตลาดท้องถิ่น และสถานที่ท่องเที่ยวทางประวัติศาสตร์ได้อย่างสะดวก จึงเป็นฐานที่เหมาะสำหรับการสำรวจเมือง', 'iWualai Hotel', 'iWualai Hotel is the first branch of the iHotels Collection, created under the concept “Less is More.” Located in Wualai Road, the hotel offers easy access to the Saturday Walking Street, local markets, and historic attractions, making it an ideal base for exploring the city.', '#a6ff00', 1, 1),
(2, '20260519120318_dMZSx.jpg', 'โรงแรมไอซิลเวอร์', 'โรงแรม iSilver เป็นโรงแรมแห่งที่สองของเครือ iHotels Collection ซึ่งได้รับแรงบันดาลใจจากแนวคิด “น้อยแต่มาก” ตั้งอยู่บนถนนวัวลาย จังหวัดเชียงใหม่ โรงแรมแห่งนี้เดินทางไปยังเมืองเก่าและถนนคนเดินวันเสาร์ได้อย่างสะดวก เหมาะสำหรับทั้งนักท่องเที่ยวและนักธุรกิจที่มองหาความสะดวกสบาย', 'iSilver Hotel', 'iSilver Hotel is the second hotel of the iHotels Collection, inspired by the “Less is More” concept. Located on Wualai Road in Chiang Mai, the hotel offers easy access to the Old City and Saturday Walking Street. It is suitable for both leisure and business travelers seeking comfort and convenience.', '#ff0000', 2, 1),
(3, '20260519120400_0DBoC.jpg', 'โรงแรมไอทาเฟ', 'โรงแรมไอท่าแพเป็นโรงแรมแห่งที่สามและใหม่ล่าสุดของเครือโรงแรมไอโฮเทลส์ เปิดให้บริการในปี 2025 ตั้งอยู่ใกล้ประตูท่าแพในเมืองเก่าเชียงใหม่ โรงแรมแห่งนี้มอบความสะดวกสบายที่ทันสมัยภายใต้แนวคิด “น้อยแต่มาก” พร้อมการเดินทางที่สะดวกไปยังสถานที่ท่องเที่ยวสำคัญและตลาดนัดวันอาทิตย์', 'iThaphae Hotel', 'iThaphae Hotel is the third and newest hotel of the iHotels Collection, opened in 2025. Located near Tha Phae Gate in Chiang Mai Old City, the hotel offers modern comfort under the “Less is More” concept, with easy access to major attractions and Sunday walking street market.', '#ff0000', 3, 1);

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
(1, NULL, '20260519163834_uvlu8.png', 1, 1),
(4, NULL, '20260519164027_oAEhx.png', 4, 1);

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
(1, 1, '20260521183313_DH4z8.png', 1, 0, NULL),
(2, 1, '20260522103025_3lSrv.png', 2, 1, NULL),
(3, 1, '20260522102925_Ryuiq.png', 3, 1, NULL),
(4, 2, '20260526170911_YFYRN.jpg', 1, 1, NULL);

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
(4, 1, '20260521171031_2BzBD.png', '20260521175213_gTlbF.png', 'เกี่ยวกับเรา', 'ABOUT US', 'โรงแรมวัวลาย', 'iWualai Hotel', '<p>ยินดีต้อนรับสู่โรงแรมไอวัวลาย ตั้งอยู่บนถนนวัวลาย ห่างจากถนนคนเดินวันเสาร์เพียง 20 เมตร นอกจากนี้ยังอยู่ห่างจากวัดศรีสุพรรณ (วัดเงิน) เพียง 300 เมตร และใช้เวลาเดินทางโดยรถยนต์จากสนามบินนานาเชียงใหม่เพียง 10 นาที&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; เราขอเชิญท่านมาสัมผัสประสบการณ์การท่องเที่ยวเชียงใหม่ที่โรงแรมไอวัวลาย และเพลิดเพลินไปกับการต้อนรับอันอบอุ่นของเรา</p>', '<div class=\"text wow fadeIn animated\" data-wow-delay=\"0.3s\">Welcome to iWualai Hotel, conveniently located on Wualai Road, just 20 meters from the Saturday Walking Street. We are also within 300 meters of Wat Srisupan (the Silver Temple) and only a 10-minute drive from Chiang Mai International Airport.</div>\r\n<div class=\"text wow fadeIn animated\" data-wow-delay=\"0.3s\">We invite you to make iWualai Hotel a part of your Chiang Mai experience and enjoy our warm hospitality.</div>'),
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
(4, 1, '20260521180452_Lldi1.png', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor inc. Lorem ipsum dolor นั่งตรง, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. เหลือแค่เพียงเท่านี้เท่านั้น.</p>', '<p>Lorem ipsum dolor sit amet, consectetur adipisic- ing elit, sed do eiusmod tempor inc. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud.</p>', '20260522160738_hHljA.png', 'ทำไมต้องเลือกเรา', 'สิ่งอำนวยความสะดวกของเรา', 'WHY CHOOSE US', 'Our Facilities', 'แกลอรี่รูปภาพ', 'PHOTO GALLERY', 'โรงแรมไอวาไล', 'iWualai Hotel'),
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
(4, 1, '20260522154301_D1cGj.png', 'อบอุ่นและผ่อนคลาย', 'COZY AND RELAX', 'ห้องพักของเรา', 'Our Rooms', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor inc. Lorem ipsum dolor นั่งตรง, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. เหลือแค่เพียงเท่านี้เท่านั้น.</p>', '<p>Lorem ipsum dolor sit amet, consectetur adipisic- ing elit, sed do eiusmod tempor inc. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud.</p>'),
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
(11, 1, '20260526090902_WyP8R.jpg', '20260507105531_yCkFf.jfif', '20260507105531_GYGqn.jfif', '20260507105531_h2b91.jfif'),
(12, 2, '20260526170808_FWhc2.jpg', '20260507114851_iWgrT.jfif', '20260507114851_NPsM4.jfif', '20260507114851_L3NIa.jfif');

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
(24, 1, NULL, '20260526154235_pPqwk.jpg', '20260525135449_DgSwM.png', 'ห้องพักเตียงคู่มาตรฐาน', '', 'Standard Double Room', '', 1, 1, '20260526145344_RqT8B.png', '', ''),
(25, 1, NULL, NULL, '20260525135519_Ny2Hv.png', 'ห้องครอบครัวมาตรฐาน', '', 'Standard Family Room', '', 2, 1, '20260526101257_lb3J6.png', '', ''),
(26, 1, NULL, NULL, '20260526152112_474Mq.png', 'ห้องพักมาตรฐานสำหรับสี่ท่าน', '', 'Standard Quadruple Room', '', 3, 1, '20260526145247_ybdrv.png', '', ''),
(38, 1, NULL, NULL, '20260526152134_UMSpz.png', 'ห้องพักสามเตียงมาตรฐาน', '', 'Standard Triple Room', '', 4, 1, '20260526105630_xbiR2.png', '', ''),
(39, 1, NULL, NULL, '20260526105708_4hqBg.png', 'ห้องพักเตียงคู่มาตรฐาน', '', 'Standard Twin Room', '', 5, 1, '20260526151955_Tf5up.png', '', '');

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
(40, 24, 'Air Conditionar'),
(41, 24, 'Swiming Pool'),
(42, 24, 'Gymnasium'),
(43, 24, 'Parking'),
(44, 24, 'Security'),
(45, 24, 'Playground');

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
(11, 26, '20260526103619_YIKb7.png', 0, 1),
(17, 24, '20260527091625_2ljQv.png', 0, 1),
(18, 24, '20260527091625_VtlwF.png', 0, 1),
(19, 24, '20260527091626_fxbpt.png', 0, 1),
(20, 24, '20260527091626_LTZjv.jpg', 0, 1),
(21, 24, '20260527091626_xufsf.png', 0, 1),
(22, 24, '20260527091627_XX47b.jpg', 0, 1),
(23, 24, '20260527091627_6Rew7.jpg', 0, 1),
(24, 24, '20260527091627_ekF5R.jpg', 0, 1),
(25, 24, '20260527091627_5hZWY.jpg', 0, 1),
(26, 24, '20260527091627_03L1o.png', 0, 1),
(27, 24, '20260527091627_ABMIk.png', 0, 1),
(28, 24, '20260527091628_s2Qp9.png', 0, 1),
(29, 24, '20260527091628_kw8Jb.png', 0, 1),
(30, 24, '20260527091629_LscJe.png', 0, 1),
(31, 24, '20260527091629_bXTwV.png', 0, 1),
(32, 24, '20260527091629_TkjQk.png', 0, 1),
(34, 24, '20260527094119_6GKNF.png', 0, 1);

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
(2, '20260519162525_h5baP.jpg', '<p>โรงแรมไอวาไล โรงแรมไอซิลเวอร์ และโรงแรมไอถาเพ เป็นส่วนหนึ่งของเครือโรงแรมไอโฮเทลส์ คอลเล็กชั่น ในเชียงใหม่ นำเสนอที่พักบูติกที่สะดวกสบายในทำเลที่สะดวกที่สุดของเมือง</p>', '<div>\r\n<div>iWualai Hotel, iSilver Hotel, and iThaphae Hotel are part of the iHotels Collection in Chiang Mai, offering comfortable boutique stays in the city&rsquo;s most convenient locations.</div>\r\n</div>');

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
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
  MODIFY `facility_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary key', AUTO_INCREMENT=6;

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
  MODIFY `hotel_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary key', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `hotel_banner`
--
ALTER TABLE `hotel_banner`
  MODIFY `banner_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `hotel_banner_image`
--
ALTER TABLE `hotel_banner_image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary key', AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `room_facility`
--
ALTER TABLE `room_facility`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `room_gallery`
--
ALTER TABLE `room_gallery`
  MODIFY `gallery_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

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
