-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 07, 2020 at 09:28 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laundering`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `addr1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zipcode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `long` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`id`, `user_id`, `label`, `addr1`, `city`, `state`, `country`, `zipcode`, `lat`, `long`, `created_at`, `updated_at`) VALUES
(1, 3, 'Home', 'RK Dreamland-2', 'Rajkot', 'Gujarati', 'India', '360003', '22.3039', '70.8022', '2020-09-24 00:23:47', '2020-09-24 00:23:47'),
(4, 14, 'Home', 'Gayatri Nagar 1, Near Jalaam Chowk, Bhaktinagar Circle, Rajkot 360002, India', NULL, NULL, NULL, NULL, '22.2914218', '70.8000912', '2020-09-24 05:12:33', '2020-09-24 05:12:33'),
(8, 16, 'hello', 'hello', NULL, NULL, NULL, NULL, '22.2868381', '70.7999553', '2020-09-25 06:54:53', '2020-09-25 06:54:53'),
(13, 14, 'Office', '321 Aakansha Complex , Opposite Dharti Honda , Gonda Road,Rajkot 360002, Gujarat', NULL, NULL, NULL, NULL, '22.2914218', '70.8000912', '2020-09-26 03:18:13', '2020-09-26 03:18:13'),
(15, 14, 'Home 2', 'Jalaram Chowk, Bhakti Nagar, Rajkot, Gujarat 360002, India', NULL, NULL, NULL, NULL, '22.2874142', '70.8010319', '2020-09-26 03:23:26', '2020-09-26 03:23:26'),
(17, 17, 'Home', 'Gayatri 1 ,Closed Street\nNear Khodiar Hall', NULL, NULL, NULL, NULL, '22.2914218', '70.8000912', '2020-09-28 01:28:48', '2020-09-28 01:28:48'),
(18, 18, 'Home', 'Jalaram Chowk, Bhakti Nagar, Rajkot, Gujarat 360002, India', NULL, NULL, NULL, NULL, '22.2874142', '70.8010319', '2020-09-28 01:59:58', '2020-09-28 01:59:58'),
(19, 17, 'Office', 'Gayatri 1 ,Closed Street\nNear Khodiar Hall', NULL, NULL, NULL, NULL, '22.2914218', '70.8000912', '2020-09-28 05:19:51', '2020-09-28 05:19:51');

-- --------------------------------------------------------

--
-- Table structure for table `app_setting`
--

CREATE TABLE `app_setting` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `verify_user` tinyint(1) NOT NULL DEFAULT 1,
  `verify_user_mail` tinyint(1) NOT NULL DEFAULT 1,
  `verify_user_sms` tinyint(1) NOT NULL DEFAULT 1,
  `enable_notification` tinyint(1) NOT NULL DEFAULT 1,
  `enable_mail` tinyint(1) NOT NULL DEFAULT 1,
  `enable_sms` tinyint(1) NOT NULL DEFAULT 1,
  `app_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `app_version` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bg_img` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_data` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `white_logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `black_logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color_logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `favicon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `splash_screen` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency_symbol` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `terms_of_use` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `privacy_policy` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `app_id` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `api_key` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `auth_key` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `project_no` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mail_host` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mail_port` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mail_username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mail_password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sender_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twilio_acc_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twilio_auth_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twilio_phone_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `license_code` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `license_client_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `license_status` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `app_setting`
--

INSERT INTO `app_setting` (`id`, `verify_user`, `verify_user_mail`, `verify_user_sms`, `enable_notification`, `enable_mail`, `enable_sms`, `app_name`, `app_version`, `bg_img`, `color`, `no_data`, `white_logo`, `black_logo`, `color_logo`, `favicon`, `splash_screen`, `currency_code`, `currency_symbol`, `terms_of_use`, `privacy_policy`, `app_id`, `api_key`, `auth_key`, `project_no`, `mail_host`, `mail_port`, `mail_username`, `mail_password`, `sender_email`, `twilio_acc_id`, `twilio_auth_token`, `twilio_phone_no`, `license_code`, `license_client_name`, `license_status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, 1, 1, 'Laundering', '1.0.0', 'bg_img.jpg', '#2c69a5', 'no_data.png', 'white_logo.png', 'black_logo.png', 'color_logo.png', 'favicon_icon.png', 'splash_screen.png', 'USD', '$', '<div>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</div><div>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod<br>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod<br>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod 1<br></div>', '<div>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</div><div>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod<br>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod<br>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod 2</div>', '29561882-aa25-43ef-b277-83a677b09524', 'ZTA3NjgwMGUtNTM4YS00ZTY5LTgyNDItMDZjYWMyOWYwOGI0', 'MjVlODAxNzEtMDY5OC00ZGNjLTk2MTMtYzE5MWJlYWNlZTc5', '900958756549', 'mail.coder12895.com', '587', 'demo@coder12895.com', 'vU^8Rfa=HWM?', 'demo@coder12895.com', 'ACaf2d37292c06f4ec592f5ebb0ec115d9', '2ad866b77280c3b773474a0228edcf8d', '+17179424428', '1', '1', NULL, '2020-09-22 06:45:16', '2020-10-07 01:39:12');

-- --------------------------------------------------------

--
-- Table structure for table `coupon`
--

CREATE TABLE `coupon` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `max_use` int(11) NOT NULL,
  `use_count` int(11) NOT NULL DEFAULT 0,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `end_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coupon`
--

INSERT INTO `coupon` (`id`, `code`, `max_use`, `use_count`, `type`, `discount`, `start_date`, `end_date`, `status`, `created_at`, `updated_at`) VALUES
(1, 'HLTAV2XW6ZF', 20, 20, 'Percentage', '20', '2020-09-23', '2020-10-19', 1, '2020-09-23 07:46:06', '2020-09-28 05:39:21'),
(2, 'RYAEGTSO98U', 20, 12, 'Amount', '50', '2020-09-24', '2020-10-03', 1, '2020-09-23 22:22:49', '2020-09-29 07:06:58'),
(3, '6CKQDXF5WRN', 20, 2, 'Percentage', '15', '2020-09-24', '2020-10-10', 1, '2020-09-23 22:23:29', '2020-09-29 07:25:38'),
(4, 'D08SHGTXM37', 3, 0, 'Amount', '30', '2020-10-04', '2020-10-31', 1, '2020-09-23 22:24:11', '2020-09-25 06:36:35'),
(5, 'F6EMT14SI8G', 5, 1, 'Percentage', '20', '2020-09-24', '2020-10-31', 1, '2020-09-23 22:24:45', '2020-09-28 02:03:20'),
(6, 'R5VN8UF7BX4', 10, 0, 'Amount', '10', '2020-09-24', '2020-11-28', 1, '2020-09-23 22:25:20', '2020-09-23 22:25:20');

-- --------------------------------------------------------

--
-- Table structure for table `currency`
--

CREATE TABLE `currency` (
  `id` int(11) NOT NULL,
  `country` varchar(100) DEFAULT NULL,
  `currency` varchar(100) DEFAULT NULL,
  `code` varchar(100) DEFAULT NULL,
  `symbol` varchar(100) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `currency`
--

INSERT INTO `currency` (`id`, `country`, `currency`, `code`, `symbol`) VALUES
(1, 'Albania', 'Leke', 'ALL', 'Lek'),
(2, 'America', 'Dollars', 'USD', '$'),
(3, 'Afghanistan', 'Afghanis', 'AFN', '؋'),
(4, 'Argentina', 'Pesos', 'ARS', '$'),
(5, 'Aruba', 'Guilders', 'AWG', 'Afl'),
(6, 'Australia', 'Dollars', 'AUD', '$'),
(7, 'Azerbaijan', 'New Manats', 'AZN', '₼'),
(8, 'Bahamas', 'Dollars', 'BSD', '$'),
(9, 'Barbados', 'Dollars', 'BBD', '$'),
(10, 'Belarus', 'Rubles', 'BYR', 'p.'),
(11, 'Belgium', 'Euro', 'EUR', '€'),
(12, 'Beliz', 'Dollars', 'BZD', 'BZ$'),
(13, 'Bermuda', 'Dollars', 'BMD', '$'),
(14, 'Bolivia', 'Bolivianos', 'BOB', '$b'),
(15, 'Bosnia and Herzegovina', 'Convertible Marka', 'BAM', 'KM'),
(16, 'Botswana', 'Pula', 'BWP', 'P'),
(17, 'Bulgaria', 'Leva', 'BGN', 'Лв.'),
(18, 'Brazil', 'Reais', 'BRL', 'R$'),
(19, 'Britain (United Kingdom)', 'Pounds', 'GBP', '£\r\n'),
(20, 'Brunei Darussalam', 'Dollars', 'BND', '$'),
(21, 'Cambodia', 'Riels', 'KHR', '៛'),
(22, 'Canada', 'Dollars', 'CAD', '$'),
(23, 'Cayman Islands', 'Dollars', 'KYD', '$'),
(24, 'Chile', 'Pesos', 'CLP', '$'),
(25, 'China', 'Yuan Renminbi', 'CNY', '¥'),
(26, 'Colombia', 'Pesos', 'COP', '$'),
(27, 'Costa Rica', 'Colón', 'CRC', '₡'),
(28, 'Croatia', 'Kuna', 'HRK', 'kn'),
(29, 'Cuba', 'Pesos', 'CUP', '₱'),
(30, 'Cyprus', 'Euro', 'EUR', '€'),
(31, 'Czech Republic', 'Koruny', 'CZK', 'Kč'),
(32, 'Denmark', 'Kroner', 'DKK', 'kr'),
(33, 'Dominican Republic', 'Pesos', 'DOP ', 'RD$'),
(34, 'East Caribbean', 'Dollars', 'XCD', '$'),
(35, 'Egypt', 'Pounds', 'EGP', '£'),
(36, 'El Salvador', 'Colones', 'SVC', '$'),
(37, 'England (United Kingdom)', 'Pounds', 'GBP', '£'),
(38, 'Euro', 'Euro', 'EUR', '€'),
(39, 'Falkland Islands', 'Pounds', 'FKP', '£'),
(40, 'Fiji', 'Dollars', 'FJD', '$'),
(41, 'France', 'Euro', 'EUR', '€'),
(42, 'Ghana', 'Cedis', 'GHC', 'GH₵'),
(43, 'Gibraltar', 'Pounds', 'GIP', '£'),
(44, 'Greece', 'Euro', 'EUR', '€'),
(45, 'Guatemala', 'Quetzales', 'GTQ', 'Q'),
(46, 'Guernsey', 'Pounds', 'GGP', '£'),
(47, 'Guyana', 'Dollars', 'GYD', '$'),
(48, 'Holland (Netherlands)', 'Euro', 'EUR', '€'),
(49, 'Honduras', 'Lempiras', 'HNL', 'L'),
(50, 'Hong Kong', 'Dollars', 'HKD', '$'),
(51, 'Hungary', 'Forint', 'HUF', 'Ft'),
(52, 'Iceland', 'Kronur', 'ISK', 'kr'),
(53, 'India', 'Rupees', 'INR', '₹'),
(54, 'Indonesia', 'Rupiahs', 'IDR', 'Rp'),
(55, 'Iran', 'Rials', 'IRR', '﷼'),
(56, 'Ireland', 'Euro', 'EUR', '€'),
(57, 'Isle of Man', 'Pounds', 'IMP', '£'),
(58, 'Israel', 'New Shekels', 'ILS', '₪'),
(59, 'Italy', 'Euro', 'EUR', '€'),
(60, 'Jamaica', 'Dollars', 'JMD', 'J$'),
(61, 'Japan', 'Yen', 'JPY', '¥'),
(62, 'Jersey', 'Pounds', 'JEP', '£'),
(63, 'Kazakhstan', 'Tenge', 'KZT', '₸'),
(64, 'Korea (North)', 'Won', 'KPW', '₩'),
(65, 'Korea (South)', 'Won', 'KRW', '₩'),
(66, 'Kyrgyzstan', 'Soms', 'KGS', 'Лв'),
(67, 'Laos', 'Kips', 'LAK', '	₭'),
(68, 'Latvia', 'Lati', 'LVL', 'Ls'),
(69, 'Lebanon', 'Pounds', 'LBP', '£'),
(70, 'Liberia', 'Dollars', 'LRD', '$'),
(71, 'Liechtenstein', 'Switzerland Francs', 'CHF', 'CHF'),
(72, 'Lithuania', 'Litai', 'LTL', 'Lt'),
(73, 'Luxembourg', 'Euro', 'EUR', '€'),
(74, 'Macedonia', 'Denars', 'MKD', 'Ден\r\n'),
(75, 'Malaysia', 'Ringgits', 'MYR', 'RM'),
(76, 'Malta', 'Euro', 'EUR', '€'),
(77, 'Mauritius', 'Rupees', 'MUR', '₹'),
(78, 'Mexico', 'Pesos', 'MXN', '$'),
(79, 'Mongolia', 'Tugriks', 'MNT', '₮'),
(80, 'Mozambique', 'Meticais', 'MZN', 'MT'),
(81, 'Namibia', 'Dollars', 'NAD', '$'),
(82, 'Nepal', 'Rupees', 'NPR', '₹'),
(83, 'Netherlands Antilles', 'Guilders', 'ANG', 'ƒ'),
(84, 'Netherlands', 'Euro', 'EUR', '€'),
(85, 'New Zealand', 'Dollars', 'NZD', '$'),
(86, 'Nicaragua', 'Cordobas', 'NIO', 'C$'),
(87, 'Nigeria', 'Nairas', 'NGN', '₦'),
(88, 'North Korea', 'Won', 'KPW', '₩'),
(89, 'Norway', 'Krone', 'NOK', 'kr'),
(90, 'Oman', 'Rials', 'OMR', '﷼'),
(91, 'Pakistan', 'Rupees', 'PKR', '₹'),
(92, 'Panama', 'Balboa', 'PAB', 'B/.'),
(93, 'Paraguay', 'Guarani', 'PYG', 'Gs'),
(94, 'Peru', 'Nuevos Soles', 'PEN', 'S/.'),
(95, 'Philippines', 'Pesos', 'PHP', 'Php'),
(96, 'Poland', 'Zlotych', 'PLN', 'zł'),
(97, 'Qatar', 'Rials', 'QAR', '﷼'),
(98, 'Romania', 'New Lei', 'RON', 'lei'),
(99, 'Russia', 'Rubles', 'RUB', '₽'),
(100, 'Saint Helena', 'Pounds', 'SHP', '£'),
(101, 'Saudi Arabia', 'Riyals', 'SAR', '﷼'),
(102, 'Serbia', 'Dinars', 'RSD', 'ع.د'),
(103, 'Seychelles', 'Rupees', 'SCR', '₹'),
(104, 'Singapore', 'Dollars', 'SGD', '$'),
(105, 'Slovenia', 'Euro', 'EUR', '€'),
(106, 'Solomon Islands', 'Dollars', 'SBD', '$'),
(107, 'Somalia', 'Shillings', 'SOS', 'S'),
(108, 'South Africa', 'Rand', 'ZAR', 'R'),
(109, 'South Korea', 'Won', 'KRW', '₩'),
(110, 'Spain', 'Euro', 'EUR', '€'),
(111, 'Sri Lanka', 'Rupees', 'LKR', '₹'),
(112, 'Sweden', 'Kronor', 'SEK', 'kr'),
(113, 'Switzerland', 'Francs', 'CHF', 'CHF'),
(114, 'Suriname', 'Dollars', 'SRD', '$'),
(115, 'Syria', 'Pounds', 'SYP', '£'),
(116, 'Taiwan', 'New Dollars', 'TWD', 'NT$'),
(117, 'Thailand', 'Baht', 'THB', '฿'),
(118, 'Trinidad and Tobago', 'Dollars', 'TTD', 'TT$'),
(119, 'Turkey', 'Lira', 'TRY', 'TL'),
(120, 'Turkey', 'Liras', 'TRL', '₺'),
(121, 'Tuvalu', 'Dollars', 'TVD', '$'),
(122, 'Ukraine', 'Hryvnia', 'UAH', '₴'),
(123, 'United Kingdom', 'Pounds', 'GBP', '£'),
(124, 'United States of America', 'Dollars', 'USD', '$'),
(125, 'Uruguay', 'Pesos', 'UYU', '$U'),
(126, 'Uzbekistan', 'Sums', 'UZS', 'so\'m'),
(127, 'Vatican City', 'Euro', 'EUR', '€'),
(128, 'Venezuela', 'Bolivares Fuertes', 'VEF', 'Bs'),
(129, 'Vietnam', 'Dong', 'VND', '₫\r\n'),
(130, 'Yemen', 'Rials', 'YER', '﷼'),
(131, 'Zimbabwe', 'Zimbabwe Dollars', 'ZWD', 'Z$');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `language`
--

CREATE TABLE `language` (
  `id` int(10) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `direction` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `language`
--

INSERT INTO `language` (`id`, `name`, `file`, `image`, `direction`, `status`, `created_at`, `updated_at`) VALUES
(1, 'English', 'English.json', 'English.jpg', 'ltr', 1, '2020-10-03 05:16:48', '2020-10-03 06:10:19'),
(2, 'Arabic', 'Arabic.json', 'Arabic.jpg', 'rtl', 1, '2020-10-03 06:34:08', '2020-10-03 06:34:08');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2016_06_01_000001_create_oauth_auth_codes_table', 2),
(5, '2016_06_01_000002_create_oauth_access_tokens_table', 2),
(6, '2016_06_01_000003_create_oauth_refresh_tokens_table', 2),
(7, '2016_06_01_000004_create_oauth_clients_table', 2),
(8, '2016_06_01_000005_create_oauth_personal_access_clients_table', 2),
(9, '2020_09_22_063548_create_roles_table', 2),
(10, '2020_09_22_063602_create_permissions_table', 2),
(11, '2020_09_22_063616_create_permission_role_table', 2),
(12, '2020_09_22_063634_create_role_user_table', 2),
(13, '2020_09_22_063658_create_app_setting_table', 2),
(14, '2020_09_22_094726_create_offer_table', 3),
(15, '2020_09_23_061442_create_service_table', 4),
(16, '2020_09_23_091811_create_product_table', 5),
(17, '2020_09_23_122635_create_coupon_table', 6),
(18, '2020_09_24_050200_create_address_table', 7),
(21, '2020_09_24_091622_create_order_table', 8),
(22, '2020_09_24_092507_create_order_child_table', 8),
(23, '2020_09_26_035454_create_currency_table', 9),
(24, '2020_09_26_063130_create_payment_setting_table', 9),
(25, '2020_09_28_043342_create_template_table', 10);

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_access_tokens`
--

INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('07becd4fc2f247a3b5a04fcf29bf31897a38aac3ec161dae36cff1292c6c5d2ccb077ae29927682f', 14, 1, 'laundering', '[]', 0, '2020-09-25 03:07:17', '2020-09-25 03:07:17', '2021-09-25 08:37:17'),
('0c9b12abac4cf378085aac881e52fad8e1e9e08b4ebdacc4c9ca88c33800fa4f8fee734a7b6d9597', 14, 1, 'laundering', '[]', 0, '2020-09-25 03:19:52', '2020-09-25 03:19:52', '2021-09-25 08:49:52'),
('0d22542ef85dd5228a794bb3d4363e4f761eab9ddf8176f853740e3cc8f0656a4c64be4110e4132e', 14, 1, 'laundering', '[]', 0, '2020-09-24 00:57:04', '2020-09-24 00:57:04', '2021-09-24 06:27:04'),
('0eb81e17f8445f890d659d825b19c520655db696df215e765d24fd970445ba89a2159851bd27253c', 14, 1, 'thebarber', '[]', 0, '2020-09-24 00:33:41', '2020-09-24 00:33:41', '2021-09-24 06:03:41'),
('0ee380a0786100299614dbe606c0dbac8c29c89cd7e0c27a1b2d68948c9f002b7e7e990b3b5dbe0a', 3, 1, 'laundering', '[]', 0, '2020-09-27 22:25:37', '2020-09-27 22:25:37', '2021-09-28 03:55:37'),
('1536050827c75e1aea97696136df49256f725a61766844dd994fbc1d8a4b525d86820264a77ce75b', 14, 1, 'thebarber', '[]', 0, '2020-09-24 01:09:50', '2020-09-24 01:09:50', '2021-09-24 06:39:50'),
('19b7f4265691972591d369759f32e41440cd51205ba3701a6b0058337fc07ab34eb78ceb25970d81', 14, 1, 'laundering', '[]', 0, '2020-09-25 06:07:15', '2020-09-25 06:07:15', '2021-09-25 11:37:15'),
('1f4d737ee186c999ced630385934fff67aabbf7b92f85cdd2961872e592c5c4349bffbddef9e8dda', 18, 1, 'thebarber', '[]', 0, '2020-09-28 01:58:40', '2020-09-28 01:58:40', '2021-09-28 07:28:40'),
('20e992bb3ab885fda3677eaab26c14a69c7510a495069bbe0e02582cd691c0a779b4b53b0702ee27', 3, 1, 'laundering', '[]', 0, '2020-09-22 07:43:44', '2020-09-22 07:43:44', '2021-09-22 13:13:44'),
('23993b9ab36c9904fbc0df37e50daed4722f9ff49273c4534ca52e38f5657ec03922ec4df616e750', 14, 1, 'laundering', '[]', 0, '2020-09-25 03:09:55', '2020-09-25 03:09:55', '2021-09-25 08:39:55'),
('25c8bf4e4fa3efd0a299227b75be714b41231e4213cd304d1a956869488899a41bfd4488b5e04b4b', 14, 1, 'laundering', '[]', 0, '2020-09-24 01:13:08', '2020-09-24 01:13:08', '2021-09-24 06:43:08'),
('36fbfb1fdc7ebb9d536db422d4bfc37fb31f72ee79969f9d38adfea4868b8f008c583e9208e100fc', 14, 1, 'laundering', '[]', 0, '2020-09-29 01:33:58', '2020-09-29 01:33:58', '2021-09-29 07:03:58'),
('39682cb2d8791678a2d48154e089b33279630284e1f8f57250267b626ddbe54f559a2b8cb47bb63b', 13, 1, 'thebarber', '[]', 0, '2020-09-24 00:28:56', '2020-09-24 00:28:56', '2021-09-24 05:58:56'),
('3d265d15c9da2baff94899bd55f3339dfabce4d91451c9a52fa6c378ffbe948aad8c7cb4c5e65509', 14, 1, 'thebarber', '[]', 0, '2020-09-26 07:32:00', '2020-09-26 07:32:00', '2021-09-26 13:02:00'),
('3ec127074e8ddc3a118967493564f9a218c6ba4bf4332f5d6ee205cfb0c3d232c776ec9801ad9d1f', 14, 1, 'laundering', '[]', 0, '2020-09-25 04:40:03', '2020-09-25 04:40:03', '2021-09-25 10:10:03'),
('42c69de290f85f9c815b4573e3de1e8a275f4d01a2f70000af9f63b85663afb14886384dff2a837f', 3, 1, 'laundering', '[]', 0, '2020-09-22 07:36:25', '2020-09-22 07:36:25', '2021-09-22 13:06:25'),
('42e3f37c0dee3698a457d9243b7f14fde5e3a21d6c30c1030e2c6016152918663b78663ed98a6852', 14, 1, 'laundering', '[]', 0, '2020-09-29 00:14:07', '2020-09-29 00:14:07', '2021-09-29 05:44:07'),
('47d8058081d249b517e1b08c24bc76813e9ac49f694e4d4541f3067f8c4785b80ac1e77eebb7d29a', 1, 1, 'laundering', '[]', 0, '2020-09-22 07:29:45', '2020-09-22 07:29:45', '2021-09-22 12:59:45'),
('48d7ab3f6d1e840d95b0012be1b5faeca9a99e685dba8233ee997595cbd0e5cfec925be14514096d', 3, 1, 'laundering', '[]', 0, '2020-09-22 23:50:41', '2020-09-22 23:50:41', '2021-09-23 05:20:41'),
('49c56a7e655dd5e17b11c2969c5847bb0375b94bf2859d10ff4752a6b57d2542aa327fb5a0fb9dca', 14, 1, 'laundering', '[]', 0, '2020-09-25 04:59:01', '2020-09-25 04:59:01', '2021-09-25 10:29:01'),
('4cdfd85338a94a83efb4ab26b295a0a530672fce5e3696ba40c7d6cfd4f423b21dc9b3e97068a366', 3, 1, 'laundering', '[]', 0, '2020-09-23 22:56:54', '2020-09-23 22:56:54', '2021-09-24 04:26:54'),
('4eea8b759369e2a6508a9964175b1191305a18f6aa6fe5d383a2217a094280c029cb829e63719b01', 14, 1, 'laundering', '[]', 0, '2020-09-28 00:30:45', '2020-09-28 00:30:45', '2021-09-28 06:00:45'),
('4fc9f6c10d0025ab9c303ad83648d2112175b712a4097e8050b45f2a7492ce7176777fc9f7f5d7fc', 1, 1, 'laundering', '[]', 0, '2020-09-22 07:29:37', '2020-09-22 07:29:37', '2021-09-22 12:59:37'),
('59e29268ec78e14b9294195e8321cc0f854141e3c5a5a57e9c79ac2f53c67cfcc305c9e4a024f6b8', 1, 1, 'laundering', '[]', 0, '2020-09-22 07:24:13', '2020-09-22 07:24:13', '2021-09-22 12:54:13'),
('5c2dd98f7dc6c7a5331bc96b3fa828a00c8bcdb255e5cc44f9ae1babdd29fcca2d78b0dc9cae2828', 14, 1, 'laundering', '[]', 0, '2020-09-25 08:04:09', '2020-09-25 08:04:09', '2021-09-25 13:34:09'),
('5d054ad9148631960d3637291ffb83497d9688a1f6fb777b9054cc3d43e4e6a3a3f2b5b0bd9b975e', 14, 1, 'laundering', '[]', 0, '2020-09-25 03:20:28', '2020-09-25 03:20:28', '2021-09-25 08:50:28'),
('620de1af0d284b03de3d3f221f085baaf724a6271030e0e63e6ca6ab3980a1334772e05fb5fc2987', 14, 1, 'laundering', '[]', 0, '2020-09-28 03:53:29', '2020-09-28 03:53:29', '2021-09-28 09:23:29'),
('6577a414988b6c0f4b933dcf8785c377cbc7275ba3087efee898114ee966dcb21fc7096823577031', 14, 1, 'laundering', '[]', 0, '2020-09-25 03:19:16', '2020-09-25 03:19:16', '2021-09-25 08:49:16'),
('6b8f277cab44bb7c18d9e6d903224e9832af48ac0b437f17f6371a34d8b8ddde87152ddbec894c1f', 14, 1, 'laundering', '[]', 0, '2020-09-25 03:30:14', '2020-09-25 03:30:14', '2021-09-25 09:00:14'),
('799e08505364fddc1ccc5858175d552425b688b27e9a7a2c747e0d6e3472853324ea5a8e2837152a', 14, 1, 'laundering', '[]', 0, '2020-09-28 03:58:42', '2020-09-28 03:58:42', '2021-09-28 09:28:42'),
('7dea298575a9554a36343e4572a1fd453d249661a748862bbe3c51f3e9973648ef1f3dab52dfaa1e', 14, 1, 'laundering', '[]', 0, '2020-09-25 04:44:59', '2020-09-25 04:44:59', '2021-09-25 10:14:59'),
('7e70454e3db18e3e1f4958b64c1a765eda06616b49e70a27ac7fe898401190c2556e40e347e72d67', 14, 1, 'thebarber', '[]', 0, '2020-09-24 01:09:50', '2020-09-24 01:09:50', '2021-09-24 06:39:50'),
('80a4d35e46a2d7b451a1aa74953e9363943f58da2891d229a7b3190c5026a5b957572317440afe1c', 14, 1, 'laundering', '[]', 0, '2020-09-24 01:10:04', '2020-09-24 01:10:04', '2021-09-24 06:40:04'),
('92d93077cded4392dea704ed81c2d405b3465e3410c1d82a2ef07a408ccd77bb3e4534eafa88043b', 14, 1, 'thebarber', '[]', 0, '2020-09-24 00:56:33', '2020-09-24 00:56:33', '2021-09-24 06:26:33'),
('9768d1e70848a7820d0455384bee5bd81b0abe41db2d2ec0d1afc073ed02a314022ad7fe437d1c82', 14, 1, 'laundering', '[]', 0, '2020-09-25 03:10:43', '2020-09-25 03:10:43', '2021-09-25 08:40:43'),
('9889561629264a62d7fa1489ab4236e819070af0b388fe6a5571460048df638e919e6092809c2e31', 14, 1, 'laundering', '[]', 0, '2020-09-25 03:12:48', '2020-09-25 03:12:48', '2021-09-25 08:42:48'),
('a1c6a179bad059373213469a967da5f379fc7da7a90beb95467a02ae33e595d905c78b3c6ab02feb', 17, 1, 'thebarber', '[]', 0, '2020-09-28 01:28:24', '2020-09-28 01:28:24', '2021-09-28 06:58:24'),
('a828a2ddbffaefcf205aba1ab1c1ea5d2674e3ef50d30a70dcd3b53a6cbf94d4984cfb305cf43ab0', 3, 1, 'laundering', '[]', 0, '2020-09-22 23:50:48', '2020-09-22 23:50:48', '2021-09-23 05:20:48'),
('a8c02faa868646f2c153e87181cfdc062071d70f4f93eac088039d2a34de6b9c83574e8f1b809b26', 14, 1, 'thebarber', '[]', 0, '2020-09-24 00:50:34', '2020-09-24 00:50:34', '2021-09-24 06:20:34'),
('aad402c26cd67b0363a08e8134d1db70a04d3dd78abf32d9f23bbd616e32e26cca1bc3757f4db0e9', 16, 1, 'laundering', '[]', 0, '2020-09-25 07:58:15', '2020-09-25 07:58:15', '2021-09-25 13:28:15'),
('adb16266d664144272fece2dcb0f4464c97a372b7467fbb1d0d38ff8ed409e3a6b6f24be5503191e', 14, 1, 'laundering', '[]', 0, '2020-09-27 23:12:21', '2020-09-27 23:12:21', '2021-09-28 04:42:21'),
('aff0269b88bae0c565de776b58a230fc979e8e5eb86577b464791946444e647cf29593499811ab96', 14, 1, 'laundering', '[]', 0, '2020-09-25 03:08:49', '2020-09-25 03:08:49', '2021-09-25 08:38:49'),
('b32c18a4371de82f34c3bef60e3d25a61923b5623abec1bb758e9ede8f95327317db8de21afddeb4', 3, 1, 'laundering', '[]', 0, '2020-09-23 22:29:57', '2020-09-23 22:29:57', '2021-09-24 03:59:57'),
('c2bb29221c87d2e6b18b76d920446ff8bb81ab3019eb7494bafb0bfc649910d056b1d04b71d1bd96', 1, 1, 'laundering', '[]', 0, '2020-09-22 07:30:11', '2020-09-22 07:30:11', '2021-09-22 13:00:11'),
('c2de674ace2087792d4f2c6e0c007309e352e673c48e7ad09cdc4df85e3f7a4a0ddb01d18c1cdf84', 14, 1, 'laundering', '[]', 0, '2020-09-25 02:02:15', '2020-09-25 02:02:15', '2021-09-25 07:32:15'),
('c33fd7e858a7a040358424ee3771ca61e5d1a6b27c59f7e9ab966a8f5beab9a333272e453c7f60c0', 14, 1, 'laundering', '[]', 0, '2020-09-25 03:29:31', '2020-09-25 03:29:31', '2021-09-25 08:59:31'),
('c4745f4afd70ff2a1e97c45eda1d5e2aa818764d98d71a554bdb0b350eef12bab4d79273577d0dbf', 14, 1, 'laundering', '[]', 0, '2020-09-26 07:33:24', '2020-09-26 07:33:24', '2021-09-26 13:03:24'),
('c6a85a8b19ecf07df64d44c7d66f080e84aedadaabde1b13877f0d575acbf628daba3d48fdb3a356', 14, 1, 'laundering', '[]', 0, '2020-09-25 03:22:43', '2020-09-25 03:22:43', '2021-09-25 08:52:43'),
('ccfc743018cb2e4e520d22a7485eac730fd8f2b74d7f68351385ab81a547ece6bb28fc32c7b20039', 14, 1, 'laundering', '[]', 0, '2020-09-25 03:17:20', '2020-09-25 03:17:20', '2021-09-25 08:47:20'),
('d300696316f703d2e116a7b64293fd82ca631d825cda819ef4b259ecf28e6fca1a1bd6cd94432bf1', 1, 1, 'laundering', '[]', 0, '2020-09-22 07:24:26', '2020-09-22 07:24:26', '2021-09-22 12:54:26'),
('d32d759854aa48c9bdfea78e7b8c6ac9e161639c9f68dda18ba8071f689d6d79987ac7e90a7d4e0e', 3, 1, 'laundering', '[]', 0, '2020-09-22 07:33:21', '2020-09-22 07:33:21', '2021-09-22 13:03:21'),
('d874a080bfe9b4f8c3160ed87be7533a5874ee0511d1c7949e2fc4def1d82d3dede744a6f060df63', 14, 1, 'laundering', '[]', 0, '2020-09-25 01:46:21', '2020-09-25 01:46:21', '2021-09-25 07:16:21'),
('e28c90b456698009e00d4793a7ffd0b613629c69d7439ffa2ccd4a4bd14f425f795a23117b10e455', 3, 1, 'thebarber', '[]', 0, '2020-09-22 22:51:44', '2020-09-22 22:51:44', '2021-09-23 04:21:44'),
('e9fce24b4edf06b6abbd387f575c7cb791ca999d80bf567349be3f3feb107d18eaadfc6cff0d4ab9', 14, 1, 'laundering', '[]', 0, '2020-09-25 07:33:03', '2020-09-25 07:33:03', '2021-09-25 13:03:03'),
('eabd291620ee746bef2234fabed7334c2e65d0de5d4982b9457504ce3e34d214fdc9e6e38ceae82f', 3, 1, 'laundering', '[]', 0, '2020-09-22 07:36:13', '2020-09-22 07:36:13', '2021-09-22 13:06:13'),
('eba4c9013fb7cc4bf5ea7371b03eef50eee986b9a341a411fafa2d50b9e27db4e7f162bc9fe69088', 14, 1, 'laundering', '[]', 0, '2020-09-25 03:04:23', '2020-09-25 03:04:23', '2021-09-25 08:34:23'),
('f0d3a8f26241b464b27b233203e82b64f910327afcf40f57906aacd84fa240fa71f421e27802d0f1', 16, 1, 'thebarber', '[]', 0, '2020-09-25 06:54:21', '2020-09-25 06:54:21', '2021-09-25 12:24:21'),
('f0d7d758f53063eb9fdd35d89bfba8fbb4a632141aad34ee46c1eb8dedc87383ec31a3a5f33e203f', 13, 1, 'laundering', '[]', 0, '2020-09-24 00:29:25', '2020-09-24 00:29:25', '2021-09-24 05:59:25'),
('f8d7bb71bb19fe933d8d0441fbc864051df4424fcdab34294c7d635ba47fc261fe35d2a9d5391f92', 14, 1, 'laundering', '[]', 0, '2020-09-25 06:34:50', '2020-09-25 06:34:50', '2021-09-25 12:04:50'),
('fcdd845e854363f151f0ef443225ab0b9cacac959ba6aad504deb4b6b55b1b6afad1ef3f3bfa4b4f', 14, 1, 'laundering', '[]', 0, '2020-09-25 03:21:14', '2020-09-25 03:21:14', '2021-09-25 08:51:14'),
('fd53bb71a6ea200f5753da831c9ada7ece05c469ce7405afa0fe201a4b656531b979dfb72ee18f80', 14, 1, 'laundering', '[]', 0, '2020-09-25 03:06:25', '2020-09-25 03:06:25', '2021-09-25 08:36:25');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `provider`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Laravel Personal Access Client', 'SXYmOFgLImC6ntUo60iT4IlTkBqcUZEObzfMGYBV', NULL, 'http://localhost', 1, 0, 0, '2020-09-22 07:24:07', '2020-09-22 07:24:07'),
(2, NULL, 'Laravel Password Grant Client', '0EKC6WHE7LS9EruVXhD6pTPogFWioblWnQD9KBLe', 'users', 'http://localhost', 0, 1, 0, '2020-09-22 07:24:07', '2020-09-22 07:24:07');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2020-09-22 07:24:07', '2020-09-22 07:24:07');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `offer`
--

CREATE TABLE `offer` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `offer`
--

INSERT INTO `offer` (`id`, `title1`, `title2`, `image`, `discount`, `type`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Get the missive discount', 'On any service', 'Offer_1601114153.png', '20', 'Percentage', 1, '2020-09-22 05:19:03', '2020-10-05 03:52:41'),
(2, 'Get the missive discount', 'On any service', 'Offer_1600841990.png', '50', 'Amount', 1, '2020-09-22 05:57:15', '2020-10-03 03:27:45'),
(3, 'Get the missive discount', 'On any service', 'Offer_1600842003.png', '50', 'Percentage', 1, '2020-09-22 06:32:00', '2020-10-03 03:27:54');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `addr_id` int(11) NOT NULL,
  `coupon_id` int(11) DEFAULT NULL,
  `discount` double(8,2) NOT NULL DEFAULT 0.00,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment` double(8,2) NOT NULL,
  `payment_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_status` tinyint(1) NOT NULL DEFAULT 0,
  `order_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `order_id`, `user_id`, `addr_id`, `coupon_id`, `discount`, `date`, `payment`, `payment_type`, `payment_token`, `payment_status`, `order_status`, `created_at`, `updated_at`) VALUES
(2, '#IRLPDXSFE1', 17, 17, NULL, 0.00, '2020-10-03', 200.00, 'STRIPE', 'src_1HWbmuFluOgnsqwfLV1AD1f7', 1, 'Pending', '2020-09-29 00:24:07', '2020-09-29 00:24:07'),
(3, '#FCKRZWDGIX', 17, 17, NULL, 0.00, '2020-10-01', 1200.00, 'STRIPE', 'src_1HWboaFluOgnsqwf7jhnPygo', 1, 'Pending', '2020-09-29 00:25:51', '2020-09-29 00:25:51'),
(4, '#F0AQX5LZ8W', 17, 19, NULL, 0.00, '2020-09-20', 2200.00, 'STRIPE', 'src_1HWcSPFluOgnsqwfWcLXrDJ4', 1, 'Pending', '2020-09-29 01:07:02', '2020-09-29 01:07:02'),
(5, '#41RK8I56D3', 14, 4, NULL, 0.00, '2020-10-06', 220.00, 'STRIPE', 'src_1HWeOLFluOgnsqwfxdr1fShX', 1, 'Completed', '2020-09-29 03:10:58', '2020-09-29 03:10:58'),
(6, '#WAN3MCYLX4', 14, 4, NULL, 0.00, '2020-10-07', 800.00, 'STRIPE', 'src_1HWemwFluOgnsqwfFcSakiPT', 1, 'Pending', '2020-09-29 03:36:24', '2020-09-29 03:36:24'),
(7, '#6HN59UM2OS', 14, 4, NULL, 0.00, '2020-10-08', 500.00, 'STRIPE', 'src_1HWf1cFluOgnsqwfgxhvopQk', 1, 'Completed', '2020-09-29 03:51:33', '2020-09-29 03:51:33'),
(8, '#8NUVHOJ2FX', 14, 4, NULL, 0.00, '2020-10-01', 200.00, 'STRIPE', 'src_1HWf4kFluOgnsqwfgF3NPrYf', 1, 'Pending', '2020-09-29 03:54:48', '2020-09-29 03:54:48'),
(9, '#K7OJ3V0TUQ', 14, 4, NULL, 0.00, '2020-10-09', 1000.00, 'STRIPE', 'src_1HWfMbFluOgnsqwfRVJdWYr0', 1, 'Pending', '2020-09-29 04:13:14', '2020-09-29 04:13:14'),
(10, '#2Q3K04EPN7', 14, 4, NULL, 0.00, '2020-10-06', 200.00, 'STRIPE', 'src_1HWfTaFluOgnsqwfcGYRg988', 1, 'Pending', '2020-09-29 04:20:27', '2020-09-29 04:20:27'),
(11, '#EYOUASF439', 14, 4, NULL, 0.00, '2020-10-10', 4555.00, 'STRIPE', 'src_1HWhnPFluOgnsqwfi57PJjpy', 1, 'Pending', '2020-09-29 06:49:05', '2020-09-29 06:49:05'),
(12, '#4N789AVX15', 14, 4, 2, 50.00, '2020-10-12', 4425.00, 'STRIPE', 'src_1HWi4iFluOgnsqwfzHTv2rRU', 1, 'Cancel', '2020-09-29 07:06:58', '2020-09-29 07:06:58'),
(13, '#FXVT1549CP', 14, 4, 3, 60.00, '2020-10-06', 340.00, 'STRIPE', 'src_1HWiMnFluOgnsqwfUEluJm41', 1, 'Pending', '2020-09-29 07:25:38', '2020-09-29 07:25:38');

-- --------------------------------------------------------

--
-- Table structure for table `order_child`
--

CREATE TABLE `order_child` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` int(11) NOT NULL,
  `service_id` int(10) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_child`
--

INSERT INTO `order_child` (`id`, `order_id`, `service_id`, `product_id`, `qty`, `type`, `price`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 1, 1, 'Cloth', 200.00, '2020-09-29 00:24:07', '2020-09-29 00:24:07'),
(2, 3, 1, 1, 6, 'Cloth', 1200.00, '2020-09-29 00:25:51', '2020-09-29 00:25:51'),
(3, 5, 3, 1, 1, 'Cloth', 200.00, '2020-09-29 03:10:58', '2020-09-29 03:10:58'),
(4, 5, 3, 4, 1, 'Cloth', 20.00, '2020-09-29 03:10:58', '2020-09-29 03:10:58'),
(5, 6, 2, 1, 1, 'Cloth', 200.00, '2020-09-29 03:36:24', '2020-09-29 03:36:24'),
(6, 6, 2, 1, 2, 'Cloth', 400.00, '2020-09-29 03:36:24', '2020-09-29 03:36:24'),
(7, 6, 2, 1, 3, 'Cloth', 600.00, '2020-09-29 03:36:24', '2020-09-29 03:36:24'),
(8, 6, 2, 1, 4, 'Cloth', 800.00, '2020-09-29 03:36:24', '2020-09-29 03:36:24'),
(9, 7, 3, 1, 1, 'Cloth', 200.00, '2020-09-29 03:51:33', '2020-09-29 03:51:33'),
(10, 7, 3, 2, 1, 'KG', 300.00, '2020-09-29 03:51:33', '2020-09-29 03:51:33'),
(11, 9, 1, 1, 2, 'Cloth', 400.00, '2020-09-29 04:13:14', '2020-09-29 04:13:14'),
(12, 9, 1, 1, 3, 'Cloth', 600.00, '2020-09-29 04:13:14', '2020-09-29 04:13:14'),
(13, 9, 1, 1, 4, 'Cloth', 800.00, '2020-09-29 04:13:14', '2020-09-29 04:13:14'),
(14, 9, 1, 1, 5, 'Cloth', 1000.00, '2020-09-29 04:13:14', '2020-09-29 04:13:14'),
(15, 11, 1, 1, 7, 'Cloth', 1400.00, '2020-09-29 06:49:05', '2020-09-29 06:49:05'),
(16, 11, 2, 1, 3, 'Cloth', 600.00, '2020-09-29 06:49:05', '2020-09-29 06:49:05'),
(17, 11, 1, 2, 4, 'KG', 1200.00, '2020-09-29 06:49:05', '2020-09-29 06:49:05'),
(18, 11, 1, 4, 4, 'Cloth', 80.00, '2020-09-29 06:49:05', '2020-09-29 06:49:05'),
(19, 11, 1, 3, 4, 'KG', 1200.00, '2020-09-29 06:49:05', '2020-09-29 06:49:05'),
(20, 11, 1, 6, 3, 'Cloth', 75.00, '2020-09-29 06:49:05', '2020-09-29 06:49:05'),
(21, 12, 1, 1, 9, 'Cloth', 720.00, '2020-09-29 07:06:58', '2020-09-29 07:06:58'),
(22, 12, 2, 1, 6, 'Cloth', 1200.00, '2020-09-29 07:06:58', '2020-09-29 07:06:58'),
(23, 12, 1, 2, 5, 'KG', 1500.00, '2020-09-29 07:06:58', '2020-09-29 07:06:58'),
(24, 12, 1, 4, 4, 'Cloth', 80.00, '2020-09-29 07:06:58', '2020-09-29 07:06:58'),
(25, 12, 1, 3, 3, 'KG', 900.00, '2020-09-29 07:06:58', '2020-09-29 07:06:58'),
(26, 12, 1, 6, 3, 'Cloth', 75.00, '2020-09-29 07:06:58', '2020-09-29 07:06:58'),
(27, 13, 1, 1, 5, 'Cloth', 400.00, '2020-09-29 07:25:38', '2020-09-29 07:25:38');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_setting`
--

CREATE TABLE `payment_setting` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cod` tinyint(1) NOT NULL DEFAULT 1,
  `paypal` tinyint(1) NOT NULL DEFAULT 0,
  `razorpay` tinyint(1) NOT NULL DEFAULT 0,
  `stripe` tinyint(1) NOT NULL DEFAULT 0,
  `paystack` tinyint(1) NOT NULL DEFAULT 0,
  `paypal_sandbox_key` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paypal_production_key` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stripe_public_key` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stripe_secret_key` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `razorpay_public_key` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `razorpay_secret_key` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_setting`
--

INSERT INTO `payment_setting` (`id`, `cod`, `paypal`, `razorpay`, `stripe`, `paystack`, `paypal_sandbox_key`, `paypal_production_key`, `stripe_public_key`, `stripe_secret_key`, `razorpay_public_key`, `razorpay_secret_key`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 0, 1, 0, 'AWoo6mXhv6wlXhlzdWcbP2uJbWGYYKunfoqtue6mC8c1l8GmxJrfeOqi1gwMpu9x1jmi7_81JkqT4bgb', 'AR-guF3mwL1jNVFEmJp9GiwL2GRuwN_kXuUNWfWzt4KfFUvbtaAt0vswqC6uiiLHNT26VE2s0d-XdcnM', 'pk_test_n56atH9x5k506LqzqeyqpwqK', 'sk_test_51H8IRUDX7yQCtHmPiKkmoRwW2uiUSfLxq3D8dpEIHm67IybtGwkyKKRT4CmL2wu2OUeDvU6vNPJBwtuBFt6Syuz600wtbAXAvX', 'rzp_test_9gbnzoM4C96qwB', 'y8VNrhmW3nGHAK6cnErV65vc', NULL, '2020-09-28 00:29:35');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `title`, `created_at`, `updated_at`) VALUES
(1, 'dashboard', NULL, NULL),
(2, 'role_access', NULL, NULL),
(3, 'role_create', NULL, NULL),
(4, 'role_edit', NULL, NULL),
(5, 'role_delete', NULL, NULL),
(6, 'user_access', NULL, NULL),
(7, 'user_create', NULL, NULL),
(8, 'user_edit', NULL, NULL),
(9, 'user_delete', NULL, NULL),
(10, 'offer_access', NULL, NULL),
(11, 'offer_create', NULL, NULL),
(12, 'offer_edit', NULL, NULL),
(13, 'offer_delete', NULL, NULL),
(14, 'service_access', NULL, NULL),
(15, 'service_create', NULL, NULL),
(16, 'service_edit', NULL, NULL),
(17, 'service_delete', NULL, NULL),
(18, 'product_access', NULL, NULL),
(19, 'product_create', NULL, NULL),
(20, 'product_edit', NULL, NULL),
(21, 'product_delete', NULL, NULL),
(22, 'coupon_access', NULL, NULL),
(23, 'coupon_create', NULL, NULL),
(24, 'coupon_edit', NULL, NULL),
(25, 'coupon_delete', NULL, NULL),
(26, 'order_access', NULL, NULL),
(27, 'order_create', NULL, NULL),
(28, 'order_edit', NULL, NULL),
(29, 'order_delete', NULL, NULL),
(30, 'setting_access', NULL, NULL),
(31, 'setting_create', NULL, NULL),
(32, 'setting_edit', NULL, NULL),
(33, 'setting_delete', NULL, NULL),
(34, 'notification_access', NULL, NULL),
(35, 'notification_create', NULL, NULL),
(36, 'notification_edit', NULL, NULL),
(37, 'notification_delete', NULL, NULL),
(38, 'report_access', NULL, NULL),
(39, 'language_access', NULL, NULL),
(40, 'language_create', NULL, NULL),
(41, 'language_edit', NULL, NULL),
(42, 'language_delete', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `role_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `permission_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES
('1', '1'),
('1', '2'),
('1', '3'),
('1', '4'),
('1', '5'),
('1', '7'),
('1', '8'),
('1', '9'),
('1', '10'),
('1', '11'),
('1', '12'),
('1', '13'),
('1', '14'),
('1', '15'),
('1', '16'),
('1', '17'),
('1', '18'),
('1', '19'),
('1', '20'),
('1', '21'),
('1', '22'),
('1', '23'),
('1', '25'),
('1', '26'),
('1', '27'),
('1', '28'),
('1', '29'),
('1', '30'),
('1', '31'),
('1', '32'),
('1', '33'),
('1', '34'),
('1', '35'),
('1', '36'),
('1', '37'),
('1', '38'),
('1', '24'),
('1', '39'),
('1', '40'),
('1', '41'),
('1', '42'),
('1', '6');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `service_id` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `image`, `price`, `type`, `service_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Blazer', 'Product_1600861398.png', '40', 'Cloth', '[\"1\",\"2\",\"3\",\"4\"]', 1, '2020-09-23 05:19:35', '2020-09-23 06:13:18'),
(2, 'Jeans', 'Product_1600860226.png', '200', 'KG', '[\"1\",\"2\",\"3\",\"4\"]', 1, '2020-09-23 05:53:46', '2020-09-23 06:14:02'),
(3, 'Kurta', 'Product_1600861492.png', '150', 'KG', '[\"1\",\"2\",\"3\",\"4\",\"5\"]', 1, '2020-09-23 06:14:52', '2020-09-23 06:14:52'),
(4, 'Shirt', 'Product_1600861557.png', '20', 'Cloth', '[\"1\",\"2\",\"3\",\"4\"]', 1, '2020-09-23 06:15:57', '2020-09-23 06:15:57'),
(5, 'Shorts', 'Product_1600861592.png', '100', 'KG', '[\"2\",\"3\",\"4\"]', 1, '2020-09-23 06:16:32', '2020-09-23 06:16:32'),
(6, 'Track Pant', 'Product_1600861681.png', '20', 'Cloth', '[\"1\",\"2\"]', 1, '2020-09-23 06:18:01', '2020-09-23 06:18:01');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `title`, `created_at`, `updated_at`) VALUES
(1, 'Admin', '2020-09-22 06:52:01', '2020-09-22 06:51:53'),
(2, 'Client', '2020-09-22 03:48:07', '2020-09-22 03:48:07');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`user_id`, `role_id`) VALUES
('1', '1'),
('2', '2'),
('3', '2'),
('4', '2'),
('5', '2'),
('6', '2'),
('7', '2'),
('8', '2'),
('9', '2'),
('10', '2'),
('11', '2'),
('12', '2'),
('13', '2'),
('14', '2'),
('15', '2'),
('16', '2'),
('17', '2'),
('18', '2');

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price_kg` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price_cloth` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`id`, `name`, `image`, `price_kg`, `price_cloth`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Dry Cleaning', 'Service_1600852266.png', '200', '50', 1, '2020-09-23 01:55:50', '2020-09-23 05:43:42'),
(2, 'Wash Cloths', 'Service_1600845986.png', '150', '30', 1, '2020-09-23 01:56:26', '2020-09-23 05:43:59'),
(3, 'Ironing Clothes', 'Service_1600846032.png', '100', '10', 1, '2020-09-23 01:57:12', '2020-09-23 05:44:10'),
(4, 'Wash & Ironing', 'Service_1600846060.png', '250', '40', 1, '2020-09-23 01:57:40', '2020-09-23 05:44:28'),
(5, 'Duvet Cleaning', 'Service_1600846077.png', '500', '80', 1, '2020-09-23 01:57:57', '2020-09-23 05:44:40');

-- --------------------------------------------------------

--
-- Table structure for table `template`
--

CREATE TABLE `template` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mail_content` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `msg_content` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `template`
--

INSERT INTO `template` (`id`, `title`, `subject`, `mail_content`, `msg_content`, `created_at`, `updated_at`) VALUES
(1, 'User Verification', 'User Verification', '<div>Dear&nbsp;{{UserName}},</div><div><br></div><div>&nbsp; &nbsp; Your Verification code is {{OTP}}.</div><div><br></div><div>From {{AdminName}}.</div>', 'Dear {{UserName}}, Your Verification code is {{OTP}}. From {{AdminName}}.', NULL, '2020-09-28 00:41:07'),
(3, 'Order Create', 'Order Create', '<div>Dear&nbsp;{{UserName}},</div><blockquote>Your order is successfully created on {{CreatedDate}} of payment {{Payment}} would&nbsp;delivered on {{DeliveryDate}}.</blockquote><blockquote>Your Order ID is {{OrderId}}.&nbsp;</blockquote><blockquote>Thank you</blockquote><div>From {{AdminName}}.</div>', 'Dear {{UserName}}, Your order is successfully created on {{CreatedDate}} of payment {{Payment}} would delivered on {{DeliveryDate}}. Your Order ID is {{OrderId}}.  Thank you From {{AdminName}}.', NULL, '2020-09-28 03:19:10'),
(4, 'Order Status', 'Order Status', '<div>Dear&nbsp;{{UserName}},</div><blockquote>You&nbsp; created order&nbsp;on {{CreatedDate}} of payment {{Payment}} would&nbsp;delivered on {{DeliveryDate}} is now {{OrderStatus}}.</blockquote><blockquote>Your Order ID is {{OrderId}}.&nbsp;</blockquote><blockquote>Thank you</blockquote><div>From {{AdminName}}.</div>', 'Dear {{UserName}}, You  created order on {{CreatedDate}} of payment {{Payment}} would delivered on {{DeliveryDate}} is now {{OrderStatus}}. Your Order ID is {{OrderId}}.  Thank you From {{AdminName}}.', NULL, '2020-09-28 04:10:07');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'noimage.jpg',
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `otp` int(10) DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `verify` tinyint(1) NOT NULL DEFAULT 0,
  `device_token` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `image`, `status`, `otp`, `password`, `code`, `phone`, `verify`, `device_token`, `email_verified_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', 'admin_1601126860.jpg', 1, 6304, '$2y$10$xY6Ejw1d68yqkWSZZadnQu6YppZZpQAjibZH16L7QW8AaqTYvpAJy', '+91', '1234567890', 1, NULL, NULL, NULL, '2020-09-22 06:50:23', '2020-10-05 04:01:00'),
(3, 'Pranali Lakhalani', 'pranali.thirstydevs@gmail.com', 'User_1601019220.jpg', 1, 4377, '$2y$10$bbjuLajrQsFK94w3jAYSzOOaQ7oRezHfsxFEvyjpTXiWApFFIcw4y', '+91', '1234567890', 1, '123', NULL, NULL, '2020-09-22 04:05:44', '2020-09-28 01:45:52'),
(14, 'hello_mr', 'test@gmail.com', 'User_1601277025.png', 1, 5929, '$2y$10$euktQmP9Mz8BLWqfWxGiVuuHhovER4jmpHm6AWz/pJGxBH/EULqDW', '+44', '1234567890', 1, '123', NULL, NULL, '2020-09-24 00:33:08', '2020-09-29 01:33:58'),
(16, 'jay', 'jay@gmail.com', 'noimage.jpg', 1, 2175, '$2y$10$BnHbp6sAVqHNm/AIKDJf1O3nvNXwntPYOe2KNuH4X9SYwKdihdMrm', '+91', '8469533333', 1, '95633380-0299-48f9-a658-f53864bb43c4', NULL, NULL, '2020-09-25 06:53:39', '2020-09-25 07:58:15'),
(17, 'jay', 'hello@gmail.com', 'noimage.jpg', 1, 2714, '$2y$10$RO9vlxNnVdjsePryaJjjD.vKTAH69QH/y7deU1bFVrbb8L7xz9egS', '+91', '5455454544', 1, NULL, NULL, NULL, '2020-09-28 01:22:57', '2020-09-28 01:28:24'),
(18, 'mr_tt', 'mr@gmail.com', 'noimage.jpg', 1, 6663, '$2y$10$npgFSc9koCryvhwsPsyWj.F3CiIXCOd0wY.fgBoIeWKmrwtBrrwA2', '+91', '8469502588', 1, NULL, NULL, NULL, '2020-09-28 01:42:33', '2020-10-05 01:18:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `app_setting`
--
ALTER TABLE `app_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupon`
--
ALTER TABLE `coupon`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `currency`
--
ALTER TABLE `currency`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `language`
--
ALTER TABLE `language`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_auth_codes_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `offer`
--
ALTER TABLE `offer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_child`
--
ALTER TABLE `order_child`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payment_setting`
--
ALTER TABLE `payment_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template`
--
ALTER TABLE `template`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `app_setting`
--
ALTER TABLE `app_setting`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `coupon`
--
ALTER TABLE `coupon`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `currency`
--
ALTER TABLE `currency`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `language`
--
ALTER TABLE `language`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `offer`
--
ALTER TABLE `offer`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `order_child`
--
ALTER TABLE `order_child`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `payment_setting`
--
ALTER TABLE `payment_setting`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `template`
--
ALTER TABLE `template`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
