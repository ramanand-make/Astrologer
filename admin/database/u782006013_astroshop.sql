-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 17, 2026 at 06:03 AM
-- Server version: 11.8.6-MariaDB-log
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u782006013_astroshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `username`, `password`, `email`, `profile_picture`, `created_at`) VALUES
(1, 'RajeevG', '$2y$10$NcV5MRqQYTqBcFPC4hfozOQeSRGQY8PR3HdILScsUC6caAr6/PBpi', 'admin@astrorajeev.com', 'uploads/profile/profile_69dce4a1386680.23168642.png', '2026-03-18 10:56:51');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT 0,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `parent_id`, `name`, `slug`, `status`, `created_at`) VALUES
(1, 0, 'Products', 'products', 1, '2026-05-07 09:09:10'),
(2, 0, 'Zodiac', 'zodiac', 1, '2026-05-07 09:09:10'),
(4, 0, 'Gifting', 'gifting', 1, '2026-05-07 09:09:10'),
(5, 0, 'Pooja Need', 'pooja-need', 1, '2026-05-07 09:09:10'),
(6, 0, 'Mala', 'mala', 1, '2026-05-07 09:09:10'),
(7, 1, 'Bracelet', 'bracelet', 1, '2026-05-07 09:09:44'),
(8, 1, 'Necklace', 'necklace', 1, '2026-05-07 09:09:44'),
(9, 2, 'Gemini', 'gemini', 1, '2026-05-07 09:09:44'),
(14, 0, 'Combos', 'combos', 1, '2026-05-07 09:09:10'),
(15, 0, 'Shop By Purpose', 'shop-by-purpose', 1, '2026-05-12 15:30:10'),
(16, 0, 'Siddh Collection', 'siddh-collection', 1, '2026-05-12 15:30:44'),
(17, 0, 'Evil Eye', 'evil-eye', 1, '2026-05-12 15:31:59'),
(18, 1, 'Karungali', 'karungali', 1, '2026-05-12 10:07:39'),
(19, 1, 'Evil Eye', 'evil-eye', 1, '2026-05-12 10:08:09'),
(20, 1, 'Rudraksha', 'rudraksha', 1, '2026-05-12 10:08:26'),
(21, 1, 'Pyrite', 'pyrite', 1, '2026-05-12 10:08:44'),
(22, 0, 'Yantras', 'yantras', 1, '2026-05-12 10:08:57'),
(23, 1, 'Gemstones', 'gemstones', 1, '2026-05-12 10:09:12'),
(24, 1, 'Pendants', 'pendants', 1, '2026-05-12 10:09:28'),
(25, 1, 'Trees', 'trees', 1, '2026-05-12 10:09:41'),
(26, 1, 'Puja Products', 'puja-products', 1, '2026-05-12 10:10:03'),
(27, 15, 'Love', 'love', 1, '2026-05-12 10:11:08'),
(28, 15, 'Money', 'money', 1, '2026-05-12 10:11:18'),
(29, 15, 'Carrer', 'carrer', 1, '2026-05-12 10:11:31'),
(30, 15, 'Health', 'health', 1, '2026-05-12 10:11:41'),
(31, 15, 'Marriage', 'marriage', 1, '2026-05-12 10:12:04'),
(32, 15, 'Gifts', 'gifts', 1, '2026-05-12 10:12:15'),
(33, 2, 'Aries', 'aries', 1, '2026-05-12 10:14:14'),
(34, 2, 'Taurus', 'taurus', 1, '2026-05-12 10:14:27'),
(35, 2, 'Cancer', 'cancer', 1, '2026-05-12 10:14:40'),
(36, 2, 'Leo', 'leo', 1, '2026-05-12 10:14:51'),
(37, 2, 'Virgo', 'virgo', 1, '2026-05-12 10:15:05'),
(38, 2, 'Libra', 'libra', 1, '2026-05-12 10:15:14'),
(39, 2, 'Scorpius', 'scorpius', 1, '2026-05-12 10:15:29'),
(40, 2, 'Sagittarius', 'sagittarius', 1, '2026-05-12 10:15:45'),
(41, 2, 'Capricornus', 'capricornus', 1, '2026-05-12 10:16:01'),
(42, 2, 'Aquarius', 'aquarius', 1, '2026-05-12 10:16:16'),
(43, 2, 'Pisces', 'pisces', 1, '2026-05-12 10:16:29');

-- --------------------------------------------------------

--
-- Table structure for table `navbar_menu`
--

CREATE TABLE `navbar_menu` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `parent_id` int(11) DEFAULT 0,
  `order_no` int(11) DEFAULT 0,
  `status` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `navbar_menu`
--

INSERT INTO `navbar_menu` (`id`, `title`, `link`, `parent_id`, `order_no`, `status`) VALUES
(1, 'Products', '#', 0, 1, 1),
(2, 'Zodiac', '#', 0, 2, 1),
(3, 'Combo', 'combos.php', 0, 4, 1),
(4, 'Gifting', 'gifting.php', 0, 5, 1),
(5, 'Pooja Need', 'pooja-need.php', 0, 6, 1),
(6, 'Mala', 'mala.php', 0, 7, 1),
(7, 'Shop By Purpose', '#', 0, 3, 1),
(8, 'Siddh Collection', '#', 0, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_email` varchar(255) NOT NULL,
  `customer_phone` varchar(20) DEFAULT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `status` varchar(50) DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` longtext DEFAULT NULL,
  `gotanyquestion` longtext DEFAULT NULL,
  `returnexchange` longtext DEFAULT NULL,
  `disclaimer` longtext DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `sale_price` decimal(10,2) DEFAULT NULL,
  `stock` int(11) DEFAULT 0,
  `image` varchar(255) DEFAULT NULL,
  `out_of_stock` enum('0','1') NOT NULL DEFAULT '0',
  `product_review` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1,
  `is_featured` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `slug`, `description`, `gotanyquestion`, `returnexchange`, `disclaimer`, `price`, `sale_price`, `stock`, `image`, `out_of_stock`, `product_review`, `status`, `is_featured`, `created_at`) VALUES
(15, NULL, 'Dhan Yog Bracelets', 'dhan-yog-bracelets', '<p>dfgfdg</p>', '<p>fdgfdg</p>', '<p>dfgfdg</p>', '<p>dg</p>', 400.00, 300.00, 0, 'assets/images/products/dhan-yog-bracelets-1778675428-0.png', '0', '4.5', 1, 0, '2026-05-13 12:30:28'),
(16, NULL, 'Evil Eye Car Hanging', 'evil-eye-car-hanging', '<p>This <strong>Evil Eye Car Hanging</strong> is made with traditional blue glass evil eye beads, <strong>designed to bring protective energy into your vehicle</strong>. Hanging it inside your car is believed to help&nbsp; guard against negative energies and unwanted influences while traveling. Its simple design fits well with any car interior and adds a meaningful touch to daily commutes.</p><p>&nbsp;</p><p><strong>Who Is This For?</strong></p><p>People who drive daily and want positive energy</p><p>Families who want protection during travel</p><p>Car owners who like meaningful accessories</p><p>Anyone looking for a simple, symbolic car decor</p>', '<p>We’re happy to help. If you have a question about an order or our products, contact us here. We aim to respond to all messages within a day.<br>Email: customercare@astrorajeev.com</p>', '<p>Returns are applicable within 7 days and only apply to defective, damaged, or incorrect products in unused condition with original packaging. Note: Natural variations in Rudraksha or gemstones are not defects. Non-returnable items include any used, altered, or personalized items.<br>Refunds incur ₹100 fee.<br>Please get in touch with the \"Customer Support\" for any query/assistance.</p>', '<p>Images are for reference only. There\'s no guarantee of the effectiveness of the product.</p>', 1999.00, 799.00, 0, 'assets/images/products/evil-eye-car-hanging-1778750825-0.png', '0', '4.5', 1, 0, '2026-05-14 09:27:05'),
(17, NULL, '7 Mukhi Rudraksha Bracelet', '7-mukhi-rudraksha-bracelet', '<p>This<strong> 7 Mukhi Rudraksha bracelet</strong> is made with natural Rudraksha beads, each with seven separate lines. It is traditionally believed <strong>to attract wealth, emotional strength, and disciplined thinking</strong>. Wearing it daily can help you stay focused and grounded during stressful times, making it suitable for people who want calmness and better control over their thoughts.</p>', '<p>We’re happy to help. If you have a question about an order or our products, contact us here. We aim to respond to all messages within a day.<br>Email:&nbsp;</p>', '<p>Returns are applicable within 7 days and only apply to defective, damaged, or incorrect products in unused condition with original packaging. Note: Natural variations in Rudraksha or gemstones are not defects. Non-returnable items include any used, altered, or personalized items.<br>Refunds incur ₹100 fee.<br>Please get in touch with the \"Customer Support\" for any query/assistance.</p>', '<p>Images are for reference only. There\'s no guarantee of the effectiveness of the product.</p>', 1999.00, 699.00, 0, 'assets/images/products/7-mukhi-rudraksha-bracelet-1778751076-0.png', '0', '5', 1, 0, '2026-05-14 09:31:16'),
(18, NULL, 'Pyrite Tortoise (Kachhua) for Money', 'pyrite-tortoise-kachhua-for-money', '<p><strong>Pyrite Tortoise</strong> is a powerful, vastu, and feng shui product made from natural Pyrite stone, a mineral found in the earth. Pyrite is often called the “<strong>money stone</strong>” because it <strong>is believed to attract wealth and positive energy. </strong>From a scientific point of view, Pyrite is known for its <strong>strong metallic energy</strong>, which is said to <strong>support focus</strong>, <strong>confidence, and mental clarity</strong>. Keeping it in your home or office may help <strong>create a balanced and motivated environment</strong>.</p><p>In traditional beliefs, the <strong>turtle </strong>represents stability, protection, and long life. When combined with Pyrite, it is thought <strong>to bring financial growth and career success.</strong> The <strong>original Pyrite Tortoise</strong> from Astroyogi is <strong>made with authentic stone and designed as per Vastu guidelines</strong>, making it a reliable choice <strong>for those seeking positive results.</strong></p>', '<p>We’re happy to help. If you have a question about an order or our products, contact us here. We aim to respond to all messages within a day.<br>Email:&nbsp;</p>', '<p>Returns are applicable within 7 days and only apply to defective, damaged, or incorrect products in unused condition with original packaging.<br><br>Note: Natural variations in Rudraksha or gemstones are not defects. Non-returnable items include any used, altered, or personalized items.<br>Refunds incur ₹100 fee.<br>Please get in touch with the \"Customer Support\" for any query/assistance.</p>', '<p>Images are for reference only. There\'s no guarantee of the effectiveness of the product.</p>', 1299.00, 719.00, 0, 'assets/images/products/pyrite-tortoise-kachhua-for-money-1778751438-4.png', '0', '4.5', 1, 0, '2026-05-14 09:37:18'),
(19, NULL, 'Dhan Yog Bracelet', 'dhan-yog-bracelet', '<p>This <strong>Dhan yog bracelet</strong> is super powerful because it has been designed with 6 powerful money magnet crystals, which are <strong>Citrine, Tiger Eye, Clear Quartz, Green Jade, Green Aventurine, and a Raw Pyrite.</strong> Wearing this bracelet daily supports <strong>financial focus, stability, and abundance thinking</strong>. It is a premium choice for abundance seekers.</p>', '<p>We’re happy to help. If you have a question about an order or our products, contact us here. We aim to respond to all messages within a day.<br>Email:&nbsp;</p>', '<p>Returns are applicable within 7 days and only apply to defective, damaged, or incorrect products in unused condition with original packaging.<br><br>Note: Natural variations in Rudraksha or gemstones are not defects. Non-returnable items include any used, altered, or personalized items.<br>Refunds incur ₹100 fee<br>Please get in touch with the \"Customer Support\" for any query/assistance.</p>', '<p>Images are for reference only. There\'s no guarantee of the effectiveness of the product.</p>', 1999.00, 699.00, 0, 'assets/images/products/dhan-yog-bracelet-1778751684-0.png', '0', '4.5', 1, 0, '2026-05-14 09:41:24'),
(20, NULL, 'Pyrite Tortoise with Vyapar Vriddhi Yantra Combo ', 'pyrite-tortoise-with-vyapar-vriddhi-yantra-combo', '<p>True success is not rushed; it is built steadily over time. This meaningful pairing of the Pyrite Tortoise and Vyapar Vriddhi Yantra by Astroyogi <strong>symbolizes stability,</strong> <strong>protection, and consistent financial progress.</strong> Together, they <strong>help you to be a bit more patient</strong> to make thoughtful decisions, and<strong> nurture business growth with balance, resilience, and long-term vision.</strong></p>', '<p>We’re happy to help. If you have a question about an order or our products, contact us here. We aim to respond to all messages within a day.<br>Email:&nbsp;</p>', '<p>Returns are applicable within 7 days and only apply to defective, damaged, or incorrect products in unused condition with original packaging. Note: Natural variations in Rudraksha or gemstones are not defects. Non-returnable items include any used, altered, or personalized items.<br>Refunds incur ₹100 fee.<br>Please get in touch with the \"Customer Support\" for any query/assistance.</p>', '<p>Images are for reference only. There\'s no guarantee of the effectiveness of the product.</p>', 1499.00, 899.00, 0, 'assets/images/products/pyrite-tortoise-with-vyapar-vriddhi-yantra-combo-f-1778752040-1.png', '0', '5', 1, 0, '2026-05-14 09:47:20');

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE `product_category` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_category`
--

INSERT INTO `product_category` (`id`, `product_id`, `category_id`, `created_at`) VALUES
(46, 15, 14, '2026-05-13 12:30:28'),
(47, 15, 17, '2026-05-13 12:30:28'),
(48, 15, 6, '2026-05-13 12:30:28'),
(49, 15, 5, '2026-05-13 12:30:28'),
(50, 15, 15, '2026-05-13 12:30:28'),
(51, 15, 32, '2026-05-13 12:30:28'),
(52, 15, 42, '2026-05-13 12:30:28'),
(53, 16, 17, '2026-05-14 09:27:05'),
(54, 16, 4, '2026-05-14 09:27:05'),
(55, 16, 15, '2026-05-14 09:27:05'),
(56, 16, 27, '2026-05-14 09:27:05'),
(57, 17, 7, '2026-05-14 09:31:16'),
(58, 17, 18, '2026-05-14 09:31:16'),
(59, 17, 24, '2026-05-14 09:31:16'),
(60, 17, 25, '2026-05-14 09:31:16'),
(61, 18, 14, '2026-05-14 09:37:18'),
(62, 18, 17, '2026-05-14 09:37:18'),
(63, 18, 15, '2026-05-14 09:37:18'),
(64, 18, 40, '2026-05-14 09:37:18'),
(65, 18, 20, '2026-05-14 09:37:18'),
(66, 18, 25, '2026-05-14 09:37:18'),
(67, 19, 6, '2026-05-14 09:41:24'),
(68, 19, 31, '2026-05-14 09:41:24'),
(69, 19, 7, '2026-05-14 09:41:24'),
(70, 19, 23, '2026-05-14 09:41:24'),
(71, 19, 18, '2026-05-14 09:41:24'),
(72, 19, 26, '2026-05-14 09:41:24'),
(73, 19, 25, '2026-05-14 09:41:24'),
(80, 20, 14, '2026-05-14 12:32:57'),
(81, 20, 4, '2026-05-14 12:32:57'),
(82, 20, 7, '2026-05-14 12:32:57'),
(83, 20, 24, '2026-05-14 12:32:57'),
(84, 20, 25, '2026-05-14 12:32:57'),
(85, 20, 15, '2026-05-14 12:32:57');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `image`, `created_at`) VALUES
(28, 15, 'assets/images/products/dhan-yog-bracelets-1778675428-0.png', '2026-05-13 12:30:28'),
(29, 15, 'assets/images/products/dhan-yog-bracelets-1778675428-1.png', '2026-05-13 12:30:28'),
(30, 15, 'assets/images/products/dhan-yog-bracelets-1778675428-2.png', '2026-05-13 12:30:28'),
(31, 16, 'assets/images/products/evil-eye-car-hanging-1778750825-0.png', '2026-05-14 09:27:05'),
(32, 16, 'assets/images/products/evil-eye-car-hanging-1778750825-1.png', '2026-05-14 09:27:05'),
(33, 16, 'assets/images/products/evil-eye-car-hanging-1778750825-2.png', '2026-05-14 09:27:05'),
(34, 16, 'assets/images/products/evil-eye-car-hanging-1778750825-3.png', '2026-05-14 09:27:05'),
(35, 16, 'assets/images/products/evil-eye-car-hanging-1778750825-4.png', '2026-05-14 09:27:05'),
(36, 17, 'assets/images/products/7-mukhi-rudraksha-bracelet-1778751076-0.png', '2026-05-14 09:31:16'),
(37, 17, 'assets/images/products/7-mukhi-rudraksha-bracelet-1778751076-1.png', '2026-05-14 09:31:16'),
(38, 17, 'assets/images/products/7-mukhi-rudraksha-bracelet-1778751076-2.png', '2026-05-14 09:31:16'),
(39, 17, 'assets/images/products/7-mukhi-rudraksha-bracelet-1778751076-3.png', '2026-05-14 09:31:16'),
(40, 17, 'assets/images/products/7-mukhi-rudraksha-bracelet-1778751076-4.png', '2026-05-14 09:31:16'),
(41, 18, 'assets/images/products/pyrite-tortoise-kachhua-for-money-1778751438-0.png', '2026-05-14 09:37:18'),
(42, 18, 'assets/images/products/pyrite-tortoise-kachhua-for-money-1778751438-1.png', '2026-05-14 09:37:18'),
(43, 18, 'assets/images/products/pyrite-tortoise-kachhua-for-money-1778751438-2.png', '2026-05-14 09:37:18'),
(44, 18, 'assets/images/products/pyrite-tortoise-kachhua-for-money-1778751438-3.png', '2026-05-14 09:37:18'),
(45, 18, 'assets/images/products/pyrite-tortoise-kachhua-for-money-1778751438-4.png', '2026-05-14 09:37:18'),
(46, 19, 'assets/images/products/dhan-yog-bracelet-1778751684-0.png', '2026-05-14 09:41:24'),
(47, 19, 'assets/images/products/dhan-yog-bracelet-1778751684-1.png', '2026-05-14 09:41:24'),
(48, 19, 'assets/images/products/dhan-yog-bracelet-1778751684-2.png', '2026-05-14 09:41:24'),
(49, 19, 'assets/images/products/dhan-yog-bracelet-1778751684-3.png', '2026-05-14 09:41:24'),
(50, 19, 'assets/images/products/dhan-yog-bracelet-1778751684-4.png', '2026-05-14 09:41:24'),
(51, 20, 'assets/images/products/pyrite-tortoise-with-vyapar-vriddhi-yantra-combo-f-1778752040-0.png', '2026-05-14 09:47:20'),
(52, 20, 'assets/images/products/pyrite-tortoise-with-vyapar-vriddhi-yantra-combo-f-1778752040-1.png', '2026-05-14 09:47:20'),
(53, 20, 'assets/images/products/pyrite-tortoise-with-vyapar-vriddhi-yantra-combo-f-1778752040-2.png', '2026-05-14 09:47:20'),
(54, 20, 'assets/images/products/pyrite-tortoise-with-vyapar-vriddhi-yantra-combo-f-1778752040-3.png', '2026-05-14 09:47:20'),
(55, 20, 'assets/images/products/pyrite-tortoise-with-vyapar-vriddhi-yantra-combo-f-1778752040-4.png', '2026-05-14 09:47:20');

-- --------------------------------------------------------

--
-- Table structure for table `uploads`
--

CREATE TABLE `uploads` (
  `id` int(11) NOT NULL,
  `image1` varchar(255) DEFAULT NULL,
  `image2` varchar(255) DEFAULT NULL,
  `image3` varchar(255) DEFAULT NULL,
  `video` varchar(255) DEFAULT NULL,
  `video_title` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `uploads`
--

INSERT INTO `uploads` (`id`, `image1`, `image2`, `image3`, `video`, `video_title`, `created_at`) VALUES
(2, NULL, NULL, NULL, NULL, 'Test Video', '2026-04-17 09:54:42'),
(3, NULL, 'uploads/images/image5.webp', 'uploads/images/image6.webp', NULL, NULL, '2026-04-18 05:22:43'),
(4, 'uploads/images/image7.webp', 'uploads/images/image8.webp', NULL, NULL, NULL, '2026-04-18 05:23:17'),
(6, 'uploads/images/image4.webp', NULL, NULL, NULL, NULL, '2026-04-20 10:16:32'),
(7, NULL, NULL, NULL, NULL, 'Test Video', '2026-04-24 09:19:11'),
(8, NULL, NULL, NULL, NULL, 'Test Video', '2026-04-27 12:04:52'),
(9, NULL, NULL, NULL, NULL, 'Test Video', '2026-05-06 05:49:08'),
(10, NULL, NULL, NULL, 'uploads/videos/Main-Video.mp4', 'Test Video', '2026-05-06 05:52:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `navbar_menu`
--
ALTER TABLE `navbar_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `uploads`
--
ALTER TABLE `uploads`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `navbar_menu`
--
ALTER TABLE `navbar_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `product_category`
--
ALTER TABLE `product_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `uploads`
--
ALTER TABLE `uploads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `product_category`
--
ALTER TABLE `product_category`
  ADD CONSTRAINT `product_category_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
