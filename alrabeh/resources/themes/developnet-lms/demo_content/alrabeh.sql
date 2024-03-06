-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               10.3.10-MariaDB-log - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             9.5.0.5332
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table alrabeh.activity_log
CREATE TABLE IF NOT EXISTS `activity_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `log_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `subject_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `causer_id` int(11) DEFAULT NULL,
  `causer_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `properties` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `activity_log_log_name_index` (`log_name`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table alrabeh.activity_log: ~42 rows (approximately)
/*!40000 ALTER TABLE `activity_log` DISABLE KEYS */;
INSERT INTO `activity_log` (`id`, `log_name`, `description`, `subject_id`, `subject_type`, `causer_id`, `causer_type`, `properties`, `created_at`, `updated_at`) VALUES
	(1, 'default', 'created', 2, 'Modules\\User\\Models\\User', NULL, NULL, '{"attributes":{"name":"Modules Member","email":"member@developnet.net"}}', '2018-12-02 13:55:06', '2018-12-02 13:55:06'),
	(2, 'default', 'created', 1, 'Modules\\Settings\\Models\\Module', 1, 'Modules\\User\\Models\\User', '[]', '2018-12-02 13:56:36', '2018-12-02 13:56:36'),
	(3, 'default', 'created', 2, 'Modules\\Settings\\Models\\Module', 1, 'Modules\\User\\Models\\User', '[]', '2018-12-02 13:56:36', '2018-12-02 13:56:36'),
	(4, 'default', 'created', 3, 'Modules\\Settings\\Models\\Module', 1, 'Modules\\User\\Models\\User', '[]', '2018-12-02 13:56:37', '2018-12-02 13:56:37'),
	(5, 'default', 'created', 4, 'Modules\\Settings\\Models\\Module', 1, 'Modules\\User\\Models\\User', '[]', '2018-12-02 13:56:37', '2018-12-02 13:56:37'),
	(6, 'default', 'created', 5, 'Modules\\Settings\\Models\\Module', 1, 'Modules\\User\\Models\\User', '[]', '2018-12-02 13:56:37', '2018-12-02 13:56:37'),
	(7, 'default', 'created', 6, 'Modules\\Settings\\Models\\Module', 1, 'Modules\\User\\Models\\User', '[]', '2018-12-02 13:56:37', '2018-12-02 13:56:37'),
	(8, 'default', 'created', 7, 'Modules\\Settings\\Models\\Module', 1, 'Modules\\User\\Models\\User', '[]', '2018-12-02 13:56:37', '2018-12-02 13:56:37'),
	(9, 'default', 'created', 8, 'Modules\\Settings\\Models\\Module', 1, 'Modules\\User\\Models\\User', '[]', '2018-12-02 13:56:37', '2018-12-02 13:56:37'),
	(10, 'default', 'created', 9, 'Modules\\Settings\\Models\\Module', 1, 'Modules\\User\\Models\\User', '[]', '2018-12-02 13:56:38', '2018-12-02 13:56:38'),
	(11, 'default', 'created', 10, 'Modules\\Settings\\Models\\Module', 1, 'Modules\\User\\Models\\User', '[]', '2018-12-02 13:56:38', '2018-12-02 13:56:38'),
	(12, 'default', 'created', 11, 'Modules\\Settings\\Models\\Module', 1, 'Modules\\User\\Models\\User', '[]', '2018-12-02 13:56:38', '2018-12-02 13:56:38'),
	(13, 'default', 'created', 12, 'Modules\\Settings\\Models\\Module', 1, 'Modules\\User\\Models\\User', '[]', '2018-12-02 13:56:38', '2018-12-02 13:56:38'),
	(14, 'default', 'created', 13, 'Modules\\Settings\\Models\\Module', 1, 'Modules\\User\\Models\\User', '[]', '2018-12-02 13:56:38', '2018-12-02 13:56:38'),
	(15, 'default', 'created', 14, 'Modules\\Settings\\Models\\Module', 1, 'Modules\\User\\Models\\User', '[]', '2018-12-02 13:56:39', '2018-12-02 13:56:39'),
	(16, 'default', 'updated', 6, 'Modules\\Settings\\Models\\Module', 1, 'Modules\\User\\Models\\User', '[]', '2018-12-02 14:02:57', '2018-12-02 14:02:57'),
	(17, 'default', 'updated', 6, 'Modules\\Settings\\Models\\Module', 1, 'Modules\\User\\Models\\User', '[]', '2018-12-02 14:03:16', '2018-12-02 14:03:16'),
	(18, 'default', 'updated', 3, 'Modules\\Settings\\Models\\Module', 1, 'Modules\\User\\Models\\User', '[]', '2018-12-02 14:09:00', '2018-12-02 14:09:00'),
	(19, 'default', 'updated', 3, 'Modules\\Settings\\Models\\Module', 1, 'Modules\\User\\Models\\User', '[]', '2018-12-02 14:10:47', '2018-12-02 14:10:47'),
	(20, 'default', 'updated', 1, 'Modules\\Settings\\Models\\Module', 1, 'Modules\\User\\Models\\User', '[]', '2018-12-02 14:11:18', '2018-12-02 14:11:18'),
	(21, 'default', 'updated', 1, 'Modules\\Settings\\Models\\Module', 1, 'Modules\\User\\Models\\User', '[]', '2018-12-02 14:11:27', '2018-12-02 14:11:27'),
	(22, 'default', 'updated', 2, 'Modules\\Settings\\Models\\Module', 1, 'Modules\\User\\Models\\User', '[]', '2018-12-02 14:11:42', '2018-12-02 14:11:42'),
	(23, 'default', 'created', 1, 'Modules\\Components\\FormBuilder\\Models\\Form', 1, 'Modules\\User\\Models\\User', '[]', '2018-12-02 14:11:46', '2018-12-02 14:11:46'),
	(24, 'default', 'updated', 2, 'Modules\\Settings\\Models\\Module', 1, 'Modules\\User\\Models\\User', '[]', '2018-12-02 14:11:47', '2018-12-02 14:11:47'),
	(25, 'exception', 'Undefined index: remote_updates. ', NULL, NULL, 1, 'Modules\\User\\Models\\User', '{"attributes":{"action":"index","object":"ThemesController","message":"Undefined index: remote_updates. "}}', '2018-12-02 14:13:37', '2018-12-02 14:13:37'),
	(26, 'default', 'updated', 17, 'Modules\\Settings\\Models\\Setting', 1, 'Modules\\User\\Models\\User', '{"attributes":{"value":"developnet-lms"},"old":{"value":"corals-basic"}}', '2018-12-02 14:16:05', '2018-12-02 14:16:05'),
	(27, 'default', 'created', 1, 'Modules\\Components\\CMS\\Models\\Page', 1, 'Modules\\User\\Models\\User', '{"attributes":{"title":"\\u0627\\u0644\\u0631\\u0626\\u064a\\u0633\\u064a\\u0629"}}', '2018-12-02 14:17:02', '2018-12-02 14:17:02'),
	(28, 'default', 'created', 2, 'Modules\\Components\\CMS\\Models\\Page', 1, 'Modules\\User\\Models\\User', '{"attributes":{"title":"\\u0627\\u062a\\u0635\\u0644 \\u0628\\u0646\\u0627"}}', '2018-12-02 14:18:30', '2018-12-02 14:18:30'),
	(29, 'default', 'updated', 2, 'Modules\\Components\\CMS\\Models\\Page', 1, 'Modules\\User\\Models\\User', '{"attributes":{"title":"\\u0627\\u062a\\u0635\\u0644 \\u0628\\u0646\\u0627"},"old":{"title":"\\u0627\\u062a\\u0635\\u0644 \\u0628\\u0646\\u0627"}}', '2018-12-02 14:19:19', '2018-12-02 14:19:19'),
	(30, 'default', 'updated', 1, 'Modules\\Components\\FormBuilder\\Models\\Form', 1, 'Modules\\User\\Models\\User', '[]', '2018-12-02 14:22:12', '2018-12-02 14:22:12'),
	(31, 'default', 'updated', 1, 'Modules\\Components\\FormBuilder\\Models\\Form', 1, 'Modules\\User\\Models\\User', '[]', '2018-12-02 14:22:46', '2018-12-02 14:22:46'),
	(32, 'default', 'created', 3, 'Modules\\Components\\CMS\\Models\\Page', 1, 'Modules\\User\\Models\\User', '{"attributes":{"title":"\\u0627\\u0644\\u0645\\u062f\\u0648\\u0646\\u0629"}}', '2018-12-02 14:24:03', '2018-12-02 14:24:03'),
	(33, 'default', 'updated', 3, 'Modules\\Components\\CMS\\Models\\Page', 1, 'Modules\\User\\Models\\User', '{"attributes":{"title":"\\u0645\\u0646 \\u0646\\u062d\\u0646"},"old":{"title":"\\u0627\\u0644\\u0645\\u062f\\u0648\\u0646\\u0629"}}', '2018-12-02 14:26:09', '2018-12-02 14:26:09'),
	(34, 'default', 'created', 4, 'Modules\\Components\\CMS\\Models\\Page', 1, 'Modules\\User\\Models\\User', '{"attributes":{"title":"\\u0627\\u0644\\u062f\\u0641\\u0639"}}', '2018-12-02 14:28:58', '2018-12-02 14:28:58'),
	(35, 'default', 'updated', 25, 'Modules\\Settings\\Models\\Setting', 1, 'Modules\\User\\Models\\User', '{"attributes":{"value":{"ar":"Arabic"}},"old":{"value":{"en":"English","pt-br":"Brazilian","ar":"Arabic"}}}', '2018-12-02 14:30:20', '2018-12-02 14:30:20'),
	(36, 'default', 'updated', 5, 'Modules\\Settings\\Models\\Setting', 1, 'Modules\\User\\Models\\User', '{"attributes":{"value":{"facebook":"https:\\/\\/www.facebook.com","twitter":"https:\\/\\/twitter.com","linkedin":"https:\\/\\/www.linkedin.com\\/","instagram":"https:\\/\\/www.instagram.com\\/","pinterest":"https:\\/\\/www.pinterest.com\\/"}},"old":{"value":{"facebook":"https:\\/\\/www.facebook.com\\/coralslaraship","twitter":"https:\\/\\/twitter.com\\/corals_laraship","linkedin":"https:\\/\\/www.linkedin.com\\/","instagram":"https:\\/\\/www.instagram.com\\/","pinterest":"https:\\/\\/www.pinterest.com\\/"}}}', '2018-12-02 14:32:38', '2018-12-02 14:32:38'),
	(37, 'default', 'created', 5, 'Modules\\Components\\CMS\\Models\\Page', 1, 'Modules\\User\\Models\\User', '{"attributes":{"title":"\\u0627\\u0644\\u0645\\u062f\\u0648\\u0646\\u0629"}}', '2018-12-02 14:34:10', '2018-12-02 14:34:10'),
	(38, 'default', 'updated', 36, 'Modules\\Settings\\Models\\Setting', 1, 'Modules\\User\\Models\\User', '{"attributes":{"value":"http:\\/\\/alrabeh.test\\/uploads\\/settings\\/1543761852-62586b55f358701.jpg"},"old":{"value":""}}', '2018-12-02 14:44:13', '2018-12-02 14:44:13'),
	(39, 'default', 'updated', 36, 'Modules\\Settings\\Models\\Setting', 1, 'Modules\\User\\Models\\User', '{"attributes":{"value":"http:\\/\\/alrabeh.test\\/uploads\\/settings\\/1543761938-blackboard-pencils-apple.jpg"},"old":{"value":"http:\\/\\/alrabeh.test\\/uploads\\/settings\\/1543761852-62586b55f358701.jpg"}}', '2018-12-02 14:45:39', '2018-12-02 14:45:39'),
	(40, 'default', 'updated', 9, 'Modules\\Settings\\Models\\Setting', 1, 'Modules\\User\\Models\\User', '{"attributes":{"value":"http:\\/\\/alrabeh.test\\/uploads\\/settings\\/1543762250-Alrabeh-white.png"},"old":{"value":"http:\\/\\/alrabeh.test\\/uploads\\/settings\\/site_logo_white.png"}}', '2018-12-02 14:50:51', '2018-12-02 14:50:51'),
	(41, 'default', 'updated', 10, 'Modules\\Settings\\Models\\Setting', 1, 'Modules\\User\\Models\\User', '{"attributes":{"value":"http:\\/\\/alrabeh.test\\/uploads\\/settings\\/1543762281-Alrabeh.png"},"old":{"value":"http:\\/\\/alrabeh.test\\/uploads\\/settings\\/site_logo.png"}}', '2018-12-02 14:51:22', '2018-12-02 14:51:22'),
	(42, 'default', 'updated', 11, 'Modules\\Settings\\Models\\Setting', 1, 'Modules\\User\\Models\\User', '{"attributes":{"value":"http:\\/\\/alrabeh.test\\/uploads\\/settings\\/1543762307-Alrabeh.png"},"old":{"value":"http:\\/\\/alrabeh.test\\/uploads\\/settings\\/site_favicon.png"}}', '2018-12-02 14:51:48', '2018-12-02 14:51:48'),
	(43, 'default', 'updated', 2, 'Modules\\User\\Models\\User', 1, 'Modules\\User\\Models\\User', '{"attributes":{"name":"Modules Member","email":"member@developnet.net"},"old":{"name":"Modules Member","email":"member@developnet.net"}}', '2018-12-02 14:56:44', '2018-12-02 14:56:44'),
	(44, 'default', 'updated', 2, 'Modules\\User\\Models\\User', 1, 'Modules\\User\\Models\\User', '{"attributes":{"name":"Modules Member","email":"member@developnet.net"},"old":{"name":"Modules Member","email":"member@developnet.net"}}', '2018-12-02 14:59:21', '2018-12-02 14:59:21');
/*!40000 ALTER TABLE `activity_log` ENABLE KEYS */;

-- Dumping structure for table alrabeh.attachments
CREATE TABLE IF NOT EXISTS `attachments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `message_id` int(10) unsigned NOT NULL,
  `source` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mime_type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `chat_attachments_message_id_foreign` (`message_id`),
  CONSTRAINT `chat_attachments_message_id_foreign` FOREIGN KEY (`message_id`) REFERENCES `messages` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table alrabeh.attachments: ~0 rows (approximately)
/*!40000 ALTER TABLE `attachments` DISABLE KEYS */;
/*!40000 ALTER TABLE `attachments` ENABLE KEYS */;

-- Dumping structure for table alrabeh.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_name_unique` (`name`),
  UNIQUE KEY `categories_slug_unique` (`slug`),
  KEY `categories_created_by_index` (`created_by`),
  KEY `categories_updated_by_index` (`updated_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table alrabeh.categories: ~0 rows (approximately)
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;

-- Dumping structure for table alrabeh.category_post
CREATE TABLE IF NOT EXISTS `category_post` (
  `post_id` int(10) unsigned NOT NULL,
  `category_id` int(10) unsigned NOT NULL,
  UNIQUE KEY `category_post_post_id_category_id_unique` (`post_id`,`category_id`),
  KEY `category_post_category_id_foreign` (`category_id`),
  CONSTRAINT `category_post_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `category_post_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table alrabeh.category_post: ~0 rows (approximately)
/*!40000 ALTER TABLE `category_post` DISABLE KEYS */;
/*!40000 ALTER TABLE `category_post` ENABLE KEYS */;

-- Dumping structure for table alrabeh.conversations
CREATE TABLE IF NOT EXISTS `conversations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_one` int(10) unsigned NOT NULL,
  `user_two` int(10) unsigned NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `chat_conversations_user_one_foreign` (`user_one`),
  KEY `chat_conversations_user_two_foreign` (`user_two`),
  CONSTRAINT `chat_conversations_user_one_foreign` FOREIGN KEY (`user_one`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `chat_conversations_user_two_foreign` FOREIGN KEY (`user_two`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table alrabeh.conversations: ~0 rows (approximately)
/*!40000 ALTER TABLE `conversations` DISABLE KEYS */;
/*!40000 ALTER TABLE `conversations` ENABLE KEYS */;

-- Dumping structure for table alrabeh.countries
CREATE TABLE IF NOT EXISTS `countries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(75) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `countries_code_index` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=250 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table alrabeh.countries: ~249 rows (approximately)
/*!40000 ALTER TABLE `countries` DISABLE KEYS */;
INSERT INTO `countries` (`id`, `code`, `name`) VALUES
	(1, 'AF', 'Afghanistan'),
	(2, 'AX', 'Åland Islands'),
	(3, 'AL', 'Albania'),
	(4, 'DZ', 'Algeria'),
	(5, 'AS', 'American Samoa'),
	(6, 'AD', 'Andorra'),
	(7, 'AO', 'Angola'),
	(8, 'AI', 'Anguilla'),
	(9, 'AQ', 'Antarctica'),
	(10, 'AG', 'Antigua and Barbuda'),
	(11, 'AR', 'Argentina'),
	(12, 'AM', 'Armenia'),
	(13, 'AW', 'Aruba'),
	(14, 'AU', 'Australia'),
	(15, 'AT', 'Austria'),
	(16, 'AZ', 'Azerbaijan'),
	(17, 'BS', 'Bahamas'),
	(18, 'BH', 'Bahrain'),
	(19, 'BD', 'Bangladesh'),
	(20, 'BB', 'Barbados'),
	(21, 'BY', 'Belarus'),
	(22, 'BE', 'Belgium'),
	(23, 'BZ', 'Belize'),
	(24, 'BJ', 'Benin'),
	(25, 'BM', 'Bermuda'),
	(26, 'BT', 'Bhutan'),
	(27, 'BO', 'Bolivia, Plurinational State of'),
	(28, 'BQ', 'Bonaire, Sint Eustatius and Saba'),
	(29, 'BA', 'Bosnia and Herzegovina'),
	(30, 'BW', 'Botswana'),
	(31, 'BV', 'Bouvet Island'),
	(32, 'BR', 'Brazil'),
	(33, 'IO', 'British Indian Ocean Territory'),
	(34, 'BN', 'Brunei Darussalam'),
	(35, 'BG', 'Bulgaria'),
	(36, 'BF', 'Burkina Faso'),
	(37, 'BI', 'Burundi'),
	(38, 'KH', 'Cambodia'),
	(39, 'CM', 'Cameroon'),
	(40, 'CA', 'Canada'),
	(41, 'CV', 'Cape Verde'),
	(42, 'KY', 'Cayman Islands'),
	(43, 'CF', 'Central African Republic'),
	(44, 'TD', 'Chad'),
	(45, 'CL', 'Chile'),
	(46, 'CN', 'China'),
	(47, 'CX', 'Christmas Island'),
	(48, 'CC', 'Cocos (Keeling) Islands'),
	(49, 'CO', 'Colombia'),
	(50, 'KM', 'Comoros'),
	(51, 'CG', 'Congo'),
	(52, 'CD', 'Congo, the Democratic Republic of the'),
	(53, 'CK', 'Cook Islands'),
	(54, 'CR', 'Costa Rica'),
	(55, 'CI', 'Côte d\'Ivoire'),
	(56, 'HR', 'Croatia'),
	(57, 'CU', 'Cuba'),
	(58, 'CW', 'Curaçao'),
	(59, 'CY', 'Cyprus'),
	(60, 'CZ', 'Czech Republic'),
	(61, 'DK', 'Denmark'),
	(62, 'DJ', 'Djibouti'),
	(63, 'DM', 'Dominica'),
	(64, 'DO', 'Dominican Republic'),
	(65, 'EC', 'Ecuador'),
	(66, 'EG', 'Egypt'),
	(67, 'SV', 'El Salvador'),
	(68, 'GQ', 'Equatorial Guinea'),
	(69, 'ER', 'Eritrea'),
	(70, 'EE', 'Estonia'),
	(71, 'ET', 'Ethiopia'),
	(72, 'FK', 'Falkland Islands (Malvinas)'),
	(73, 'FO', 'Faroe Islands'),
	(74, 'FJ', 'Fiji'),
	(75, 'FI', 'Finland'),
	(76, 'FR', 'France'),
	(77, 'GF', 'French Guiana'),
	(78, 'PF', 'French Polynesia'),
	(79, 'TF', 'French Southern Territories'),
	(80, 'GA', 'Gabon'),
	(81, 'GM', 'Gambia'),
	(82, 'GE', 'Georgia'),
	(83, 'DE', 'Germany'),
	(84, 'GH', 'Ghana'),
	(85, 'GI', 'Gibraltar'),
	(86, 'GR', 'Greece'),
	(87, 'GL', 'Greenland'),
	(88, 'GD', 'Grenada'),
	(89, 'GP', 'Guadeloupe'),
	(90, 'GU', 'Guam'),
	(91, 'GT', 'Guatemala'),
	(92, 'GG', 'Guernsey'),
	(93, 'GN', 'Guinea'),
	(94, 'GW', 'Guinea-Bissau'),
	(95, 'GY', 'Guyana'),
	(96, 'HT', 'Haiti'),
	(97, 'HM', 'Heard Island and McDonald Mcdonald Islands'),
	(98, 'VA', 'Holy See (Vatican City State)'),
	(99, 'HN', 'Honduras'),
	(100, 'HK', 'Hong Kong'),
	(101, 'HU', 'Hungary'),
	(102, 'IS', 'Iceland'),
	(103, 'IN', 'India'),
	(104, 'ID', 'Indonesia'),
	(105, 'IR', 'Iran, Islamic Republic of'),
	(106, 'IQ', 'Iraq'),
	(107, 'IE', 'Ireland'),
	(108, 'IM', 'Isle of Man'),
	(109, 'IL', 'Israel'),
	(110, 'IT', 'Italy'),
	(111, 'JM', 'Jamaica'),
	(112, 'JP', 'Japan'),
	(113, 'JE', 'Jersey'),
	(114, 'JO', 'Jordan'),
	(115, 'KZ', 'Kazakhstan'),
	(116, 'KE', 'Kenya'),
	(117, 'KI', 'Kiribati'),
	(118, 'KP', 'Korea, Democratic People\'s Republic of'),
	(119, 'KR', 'Korea, Republic of'),
	(120, 'KW', 'Kuwait'),
	(121, 'KG', 'Kyrgyzstan'),
	(122, 'LA', 'Lao People\'s Democratic Republic'),
	(123, 'LV', 'Latvia'),
	(124, 'LB', 'Lebanon'),
	(125, 'LS', 'Lesotho'),
	(126, 'LR', 'Liberia'),
	(127, 'LY', 'Libya'),
	(128, 'LI', 'Liechtenstein'),
	(129, 'LT', 'Lithuania'),
	(130, 'LU', 'Luxembourg'),
	(131, 'MO', 'Macao'),
	(132, 'MK', 'Macedonia, the Former Yugoslav Republic of'),
	(133, 'MG', 'Madagascar'),
	(134, 'MW', 'Malawi'),
	(135, 'MY', 'Malaysia'),
	(136, 'MV', 'Maldives'),
	(137, 'ML', 'Mali'),
	(138, 'MT', 'Malta'),
	(139, 'MH', 'Marshall Islands'),
	(140, 'MQ', 'Martinique'),
	(141, 'MR', 'Mauritania'),
	(142, 'MU', 'Mauritius'),
	(143, 'YT', 'Mayotte'),
	(144, 'MX', 'Mexico'),
	(145, 'FM', 'Micronesia, Federated States of'),
	(146, 'MD', 'Moldova, Republic of'),
	(147, 'MC', 'Monaco'),
	(148, 'MN', 'Mongolia'),
	(149, 'ME', 'Montenegro'),
	(150, 'MS', 'Montserrat'),
	(151, 'MA', 'Morocco'),
	(152, 'MZ', 'Mozambique'),
	(153, 'MM', 'Myanmar'),
	(154, 'NA', 'Namibia'),
	(155, 'NR', 'Nauru'),
	(156, 'NP', 'Nepal'),
	(157, 'NL', 'Netherlands'),
	(158, 'NC', 'New Caledonia'),
	(159, 'NZ', 'New Zealand'),
	(160, 'NI', 'Nicaragua'),
	(161, 'NE', 'Niger'),
	(162, 'NG', 'Nigeria'),
	(163, 'NU', 'Niue'),
	(164, 'NF', 'Norfolk Island'),
	(165, 'MP', 'Northern Mariana Islands'),
	(166, 'NO', 'Norway'),
	(167, 'OM', 'Oman'),
	(168, 'PK', 'Pakistan'),
	(169, 'PW', 'Palau'),
	(170, 'PS', 'Palestine, State of'),
	(171, 'PA', 'Panama'),
	(172, 'PG', 'Papua New Guinea'),
	(173, 'PY', 'Paraguay'),
	(174, 'PE', 'Peru'),
	(175, 'PH', 'Philippines'),
	(176, 'PN', 'Pitcairn'),
	(177, 'PL', 'Poland'),
	(178, 'PT', 'Portugal'),
	(179, 'PR', 'Puerto Rico'),
	(180, 'QA', 'Qatar'),
	(181, 'RE', 'Réunion'),
	(182, 'RO', 'Romania'),
	(183, 'RU', 'Russian Federation'),
	(184, 'RW', 'Rwanda'),
	(185, 'BL', 'Saint Barthélemy'),
	(186, 'SH', 'Saint Helena, Ascension and Tristan da Cunha'),
	(187, 'KN', 'Saint Kitts and Nevis'),
	(188, 'LC', 'Saint Lucia'),
	(189, 'MF', 'Saint Martin (French part)'),
	(190, 'PM', 'Saint Pierre and Miquelon'),
	(191, 'VC', 'Saint Vincent and the Grenadines'),
	(192, 'WS', 'Samoa'),
	(193, 'SM', 'San Marino'),
	(194, 'ST', 'Sao Tome and Principe'),
	(195, 'SA', 'Saudi Arabia'),
	(196, 'SN', 'Senegal'),
	(197, 'RS', 'Serbia'),
	(198, 'SC', 'Seychelles'),
	(199, 'SL', 'Sierra Leone'),
	(200, 'SG', 'Singapore'),
	(201, 'SX', 'Sint Maarten (Dutch part)'),
	(202, 'SK', 'Slovakia'),
	(203, 'SI', 'Slovenia'),
	(204, 'SB', 'Solomon Islands'),
	(205, 'SO', 'Somalia'),
	(206, 'ZA', 'South Africa'),
	(207, 'GS', 'South Georgia and the South Sandwich Islands'),
	(208, 'SS', 'South Sudan'),
	(209, 'ES', 'Spain'),
	(210, 'LK', 'Sri Lanka'),
	(211, 'SD', 'Sudan'),
	(212, 'SR', 'Suriname'),
	(213, 'SJ', 'Svalbard and Jan Mayen'),
	(214, 'SZ', 'Swaziland'),
	(215, 'SE', 'Sweden'),
	(216, 'CH', 'Switzerland'),
	(217, 'SY', 'Syrian Arab Republic'),
	(218, 'TW', 'Taiwan'),
	(219, 'TJ', 'Tajikistan'),
	(220, 'TZ', 'Tanzania, United Republic of'),
	(221, 'TH', 'Thailand'),
	(222, 'TL', 'Timor-Leste'),
	(223, 'TG', 'Togo'),
	(224, 'TK', 'Tokelau'),
	(225, 'TO', 'Tonga'),
	(226, 'TT', 'Trinidad and Tobago'),
	(227, 'TN', 'Tunisia'),
	(228, 'TR', 'Turkey'),
	(229, 'TM', 'Turkmenistan'),
	(230, 'TC', 'Turks and Caicos Islands'),
	(231, 'TV', 'Tuvalu'),
	(232, 'UG', 'Uganda'),
	(233, 'UA', 'Ukraine'),
	(234, 'AE', 'United Arab Emirates'),
	(235, 'GB', 'United Kingdom'),
	(236, 'US', 'United States'),
	(237, 'UM', 'United States Minor Outlying Islands'),
	(238, 'UY', 'Uruguay'),
	(239, 'UZ', 'Uzbekistan'),
	(240, 'VU', 'Vanuatu'),
	(241, 'VE', 'Venezuela, Bolivarian Republic of'),
	(242, 'VN', 'Viet Nam'),
	(243, 'VG', 'Virgin Islands, British'),
	(244, 'VI', 'Virgin Islands, U.S.'),
	(245, 'WF', 'Wallis and Futuna'),
	(246, 'EH', 'Western Sahara'),
	(247, 'YE', 'Yemen'),
	(248, 'ZM', 'Zambia'),
	(249, 'ZW', 'Zimbabwe');
/*!40000 ALTER TABLE `countries` ENABLE KEYS */;

-- Dumping structure for table alrabeh.custom_fields
CREATE TABLE IF NOT EXISTS `custom_fields` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` int(10) unsigned NOT NULL,
  `field_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `string_value` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `number_value` double DEFAULT NULL,
  `text_value` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `multi_value` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_value` timestamp NULL DEFAULT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `custom_fields_created_by_index` (`created_by`),
  KEY `custom_fields_updated_by_index` (`updated_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table alrabeh.custom_fields: ~0 rows (approximately)
/*!40000 ALTER TABLE `custom_fields` DISABLE KEYS */;
/*!40000 ALTER TABLE `custom_fields` ENABLE KEYS */;

-- Dumping structure for table alrabeh.custom_field_settings
CREATE TABLE IF NOT EXISTS `custom_field_settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `model` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `label` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `required` tinyint(1) NOT NULL DEFAULT 0,
  `options` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `options_options` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `custom_attributes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `default_value` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `validation_rules` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `custom_field_settings_created_by_index` (`created_by`),
  KEY `custom_field_settings_updated_by_index` (`updated_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table alrabeh.custom_field_settings: ~0 rows (approximately)
/*!40000 ALTER TABLE `custom_field_settings` DISABLE KEYS */;
/*!40000 ALTER TABLE `custom_field_settings` ENABLE KEYS */;

-- Dumping structure for table alrabeh.forms
CREATE TABLE IF NOT EXISTS `forms` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `properties` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `actions` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `submission` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `is_public` tinyint(1) NOT NULL DEFAULT 0,
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `forms_short_code_unique` (`short_code`),
  KEY `forms_created_by_index` (`created_by`),
  KEY `forms_updated_by_index` (`updated_by`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table alrabeh.forms: ~1 rows (approximately)
/*!40000 ALTER TABLE `forms` DISABLE KEYS */;
INSERT INTO `forms` (`id`, `name`, `short_code`, `content`, `properties`, `actions`, `submission`, `status`, `is_public`, `created_by`, `updated_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(1, 'Contact Us', 'contact-us', '[{"type":"header","subtype":"h3","label":"للتواصل معنا املء النموذج التالي"},{"type":"text","required":true,"label":"الاسم","placeholder":"الاسم","className":"form-control","name":"name","subtype":"text"},{"type":"text","subtype":"email","required":true,"label":"البريد الإلكتروني","placeholder":"البريد الإلكتروني","className":"form-control","name":"email"},{"type":"text","required":true,"label":"موضوع الرسالة","placeholder":"موضوع الرسالة","className":"form-control","name":"subject","subtype":"text"},{"type":"textarea","required":true,"label":"الرسالة","placeholder":"الرسالة","className":"form-control","name":"message","subtype":"textarea","rows":"5"},{"type":"button","subtype":"submit","label":"ارسال","className":"btn  btn-warning","name":"send","style":"warning"}]', NULL, '{"email":[{"to":"support@developnet.net","subject":"Contact us submission","body":"You received a message from : [name]\\n<p>Name: [name]<\\/p>\\n<p> Email: [email]<\\/p>\\n<p>Company: [company]<\\/p>\\n<p>Subject: [subject]<\\/p>\\n<p>Message: [message]<\\/p>"}]}', '{"on_success":{"action":"show_message","content":"Your message has been sent successfully.<br\\/> Thank you."},"on_failure":{"action":"show_message","content":"Sorry something went wrong!!<br\\/> Thank you."}}', 'active', 0, 1, 1, NULL, '2018-12-02 14:11:46', '2018-12-02 14:22:46');
/*!40000 ALTER TABLE `forms` ENABLE KEYS */;

-- Dumping structure for table alrabeh.form_submissions
CREATE TABLE IF NOT EXISTS `form_submissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `unique_identifier` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `form_id` int(10) unsigned NOT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `form_submissions_form_id_foreign` (`form_id`),
  KEY `form_submissions_created_by_index` (`created_by`),
  KEY `form_submissions_updated_by_index` (`updated_by`),
  CONSTRAINT `form_submissions_form_id_foreign` FOREIGN KEY (`form_id`) REFERENCES `forms` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table alrabeh.form_submissions: ~0 rows (approximately)
/*!40000 ALTER TABLE `form_submissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `form_submissions` ENABLE KEYS */;

-- Dumping structure for table alrabeh.fulltext_search
CREATE TABLE IF NOT EXISTS `fulltext_search` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `indexable_id` int(11) NOT NULL,
  `indexable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `indexed_title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `indexed_content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `fulltext_search_indexable_type_indexable_id_unique` (`indexable_type`,`indexable_id`),
  KEY `fulltext_search_created_by_index` (`created_by`),
  KEY `fulltext_search_updated_by_index` (`updated_by`),
  FULLTEXT KEY `fulltext_title` (`indexed_title`),
  FULLTEXT KEY `fulltext_title_content` (`indexed_title`,`indexed_content`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table alrabeh.fulltext_search: 0 rows
/*!40000 ALTER TABLE `fulltext_search` DISABLE KEYS */;
/*!40000 ALTER TABLE `fulltext_search` ENABLE KEYS */;

-- Dumping structure for table alrabeh.lms_answers
CREATE TABLE IF NOT EXISTS `lms_answers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hint` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `order` int(11) NOT NULL DEFAULT 0,
  `is_correct` tinyint(1) NOT NULL DEFAULT 0,
  `options` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `question_id` int(10) unsigned NOT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `lms_answers_question_id_foreign` (`question_id`),
  KEY `lms_answers_created_by_index` (`created_by`),
  KEY `lms_answers_updated_by_index` (`updated_by`),
  CONSTRAINT `lms_answers_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `lms_questions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table alrabeh.lms_answers: ~12 rows (approximately)
/*!40000 ALTER TABLE `lms_answers` DISABLE KEYS */;
INSERT INTO `lms_answers` (`id`, `title`, `hint`, `status`, `order`, `is_correct`, `options`, `question_id`, `created_by`, `updated_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(1, 'اجابه صحيحة', NULL, 0, 0, 1, NULL, 1, 1, 1, NULL, '2018-09-04 14:07:05', '2018-09-04 14:07:05'),
	(2, 'اجابه خاطئة', NULL, 0, 0, 0, NULL, 1, 1, 1, NULL, '2018-09-04 14:07:06', '2018-09-04 14:07:06'),
	(3, 'اجابه خاطءهةة', NULL, 0, 0, 0, NULL, 1, 1, 1, NULL, '2018-09-04 14:07:06', '2018-09-04 14:07:06'),
	(4, 'اجابه صحيحة', NULL, 0, 0, 1, NULL, 2, 1, 1, NULL, '2018-09-04 14:08:11', '2018-09-04 14:08:11'),
	(5, 'اجابه خاطئة', NULL, 0, 0, 0, NULL, 2, 1, 1, NULL, '2018-09-04 14:08:12', '2018-09-04 14:08:12'),
	(6, 'ذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة', NULL, 0, 0, 1, NULL, 2, 1, 1, NULL, '2018-09-04 14:08:12', '2018-09-04 14:08:12'),
	(7, 'لقد تم توليد هذا النص من مولد النص العربى', NULL, 0, 0, 0, NULL, 2, 1, 1, NULL, '2018-09-04 14:08:12', '2018-09-04 14:08:12'),
	(8, 'مفهوم', NULL, 0, 0, 1, NULL, 3, 1, 1, NULL, '2018-09-04 14:11:01', '2018-09-04 14:11:01'),
	(9, 'غير منظم', NULL, 0, 0, 0, NULL, 3, 1, 1, NULL, '2018-09-04 14:11:01', '2018-09-04 14:11:01'),
	(10, 'و حتى غير مفهوم.', NULL, 0, 0, 0, NULL, 3, 1, 1, NULL, '2018-09-04 14:11:02', '2018-09-04 14:11:02'),
	(13, 'اجابه صحيحة', NULL, 0, 0, 1, NULL, 4, 1, 1, NULL, '2018-09-04 14:16:11', '2018-09-04 14:16:11'),
	(14, 'اجابه خاطئة', NULL, 0, 0, 0, NULL, 4, 1, 1, NULL, '2018-09-04 14:16:11', '2018-09-04 14:16:11');
/*!40000 ALTER TABLE `lms_answers` ENABLE KEYS */;

-- Dumping structure for table alrabeh.lms_asks
CREATE TABLE IF NOT EXISTS `lms_asks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `askable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `askable_id` int(10) unsigned NOT NULL,
  `log_id` int(10) unsigned DEFAULT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `user_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `send_to` int(10) unsigned DEFAULT NULL,
  `receiver_machain` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `lms_asks_log_id_foreign` (`log_id`),
  KEY `lms_asks_user_id_index` (`user_id`),
  KEY `lms_asks_send_to_index` (`send_to`),
  KEY `lms_asks_created_by_index` (`created_by`),
  KEY `lms_asks_updated_by_index` (`updated_by`),
  CONSTRAINT `lms_asks_log_id_foreign` FOREIGN KEY (`log_id`) REFERENCES `lms_logs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `lms_asks_send_to_foreign` FOREIGN KEY (`send_to`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `lms_asks_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table alrabeh.lms_asks: ~0 rows (approximately)
/*!40000 ALTER TABLE `lms_asks` DISABLE KEYS */;
/*!40000 ALTER TABLE `lms_asks` ENABLE KEYS */;

-- Dumping structure for table alrabeh.lms_authors
CREATE TABLE IF NOT EXISTS `lms_authors` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `authorable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `authorable_id` int(10) unsigned NOT NULL,
  `role` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'primary',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `lms_authors_created_by_index` (`created_by`),
  KEY `lms_authors_updated_by_index` (`updated_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table alrabeh.lms_authors: ~0 rows (approximately)
/*!40000 ALTER TABLE `lms_authors` DISABLE KEYS */;
/*!40000 ALTER TABLE `lms_authors` ENABLE KEYS */;

-- Dumping structure for table alrabeh.lms_books
CREATE TABLE IF NOT EXISTS `lms_books` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keywords` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `preview_video` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `summary` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subscribers` int(11) DEFAULT 0,
  `book_link` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `book_format` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `can_download` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pages_count` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `sale_price` decimal(10,2) DEFAULT 0.00,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `author_id` int(10) unsigned DEFAULT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `lms_books_slug_unique` (`slug`),
  KEY `lms_books_author_id_foreign` (`author_id`),
  KEY `lms_books_created_by_index` (`created_by`),
  KEY `lms_books_updated_by_index` (`updated_by`),
  CONSTRAINT `lms_books_author_id_foreign` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table alrabeh.lms_books: ~0 rows (approximately)
/*!40000 ALTER TABLE `lms_books` DISABLE KEYS */;
/*!40000 ALTER TABLE `lms_books` ENABLE KEYS */;

-- Dumping structure for table alrabeh.lms_categoriables
CREATE TABLE IF NOT EXISTS `lms_categoriables` (
  `lms_categoriable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lms_categoriable_id` int(10) unsigned NOT NULL,
  `category_id` int(10) unsigned NOT NULL,
  KEY `lms_categoriables_category_id_foreign` (`category_id`),
  CONSTRAINT `lms_categoriables_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `lms_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table alrabeh.lms_categoriables: ~17 rows (approximately)
/*!40000 ALTER TABLE `lms_categoriables` DISABLE KEYS */;
INSERT INTO `lms_categoriables` (`lms_categoriable_type`, `lms_categoriable_id`, `category_id`) VALUES
	('quiz', 3, 2),
	('quiz', 3, 4),
	('quiz', 4, 1),
	('quiz', 4, 4),
	('quiz', 4, 3),
	('quiz', 5, 2),
	('quiz', 6, 4),
	('quiz', 7, 2),
	('quiz', 7, 1),
	('quiz', 7, 4),
	('quiz', 7, 3),
	('course', 3, 2),
	('course', 3, 3),
	('course', 2, 2),
	('lesson', 5, 3),
	('lesson', 4, 3),
	('lesson', 3, 1);
/*!40000 ALTER TABLE `lms_categoriables` ENABLE KEYS */;

-- Dumping structure for table alrabeh.lms_categories
CREATE TABLE IF NOT EXISTS `lms_categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `in_home` tinyint(1) NOT NULL DEFAULT 0,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'general',
  `parent_id` int(10) unsigned DEFAULT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `lms_categories_name_unique` (`name`),
  UNIQUE KEY `lms_categories_slug_unique` (`slug`),
  KEY `lms_categories_parent_id_foreign` (`parent_id`),
  KEY `lms_categories_created_by_index` (`created_by`),
  KEY `lms_categories_updated_by_index` (`updated_by`),
  CONSTRAINT `lms_categories_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `lms_categories` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table alrabeh.lms_categories: ~4 rows (approximately)
/*!40000 ALTER TABLE `lms_categories` DISABLE KEYS */;
INSERT INTO `lms_categories` (`id`, `name`, `slug`, `is_featured`, `in_home`, `status`, `type`, `parent_id`, `created_by`, `updated_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(1, 'تربيه قوميه', '8652', 0, 0, 'active', 'general', NULL, 1, 1, NULL, '2018-09-04 13:26:41', '2018-09-04 13:26:41'),
	(2, 'تاريخ', '111342', 1, 0, 'active', 'general', 3, 1, 1, NULL, '2018-09-04 13:27:20', '2018-09-05 08:19:04'),
	(3, 'عربية', '1111', 0, 0, 'active', 'general', NULL, 1, 1, NULL, '2018-09-04 13:28:19', '2018-09-04 13:28:19'),
	(4, 'رياضه', '1111km', 1, 0, 'inactive', 'general', NULL, 1, 1, NULL, '2018-09-04 13:30:02', '2018-09-05 08:18:35');
/*!40000 ALTER TABLE `lms_categories` ENABLE KEYS */;

-- Dumping structure for table alrabeh.lms_certificates
CREATE TABLE IF NOT EXISTS `lms_certificates` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `certificatable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `certificatable_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `log_id` int(10) unsigned DEFAULT NULL,
  `temp_id` int(10) unsigned DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `lms_certificates_code_unique` (`code`),
  KEY `lms_certificates_user_id_index` (`user_id`),
  KEY `lms_certificates_log_id_index` (`log_id`),
  KEY `lms_certificates_temp_id_index` (`temp_id`),
  KEY `lms_certificates_created_by_index` (`created_by`),
  KEY `lms_certificates_updated_by_index` (`updated_by`),
  CONSTRAINT `lms_certificates_log_id_foreign` FOREIGN KEY (`log_id`) REFERENCES `lms_logs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `lms_certificates_temp_id_foreign` FOREIGN KEY (`temp_id`) REFERENCES `lms_certificate_templates` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `lms_certificates_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table alrabeh.lms_certificates: ~0 rows (approximately)
/*!40000 ALTER TABLE `lms_certificates` DISABLE KEYS */;
/*!40000 ALTER TABLE `lms_certificates` ENABLE KEYS */;

-- Dumping structure for table alrabeh.lms_certificate_templates
CREATE TABLE IF NOT EXISTS `lms_certificate_templates` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `manager_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `manager_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `lms_certificate_templates_created_by_index` (`created_by`),
  KEY `lms_certificate_templates_updated_by_index` (`updated_by`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table alrabeh.lms_certificate_templates: ~0 rows (approximately)
/*!40000 ALTER TABLE `lms_certificate_templates` DISABLE KEYS */;
INSERT INTO `lms_certificate_templates` (`id`, `title`, `manager_name`, `manager_title`, `category`, `content`, `note`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
	(1, 'شهادة تقدير', 'محمد فتحي', NULL, NULL, '<p style="text-align: center;"><span style="font-size:22px;">تشهد أكادمية الرابح أن الطالب :</span></p>\r\n\r\n<p style="text-align: center;"><strong><span style="color:#e67e22;"><span style="font-size:22px;">Samar Muhammad Muhammad</span></span></strong></p>\r\n\r\n<p style="text-align: center;"><span style="font-size:22px;">اكمل مادة</span></p>\r\n\r\n<p style="text-align: center;"><span style="font-size:22px;">@codeMaterial</span></p>\r\n\r\n<p style="text-align: center;"><span style="font-size:22px;">تم تدريس الماده في الفتره بين 10اغسطس 2018 و30 سبتمبر 2018</span></p>\r\n\r\n<p style="text-align: center;"><span style="font-size:22px;">حصل حامل هذه الشهادة علي درجة</span></p>\r\n\r\n<p style="text-align: center;"><span style="font-size:22px;">90%</span></p>', '<section>\r\n<p>هذه شهادة اكمال من أكادمية الرابح تصدر لكل طالب حقق شروط استيفاء الدراسة في مالمادة www.elrabeh.com</p>\r\n</section>\r\n\r\n<section>&nbsp;</section>', 1, 1, 1, '2018-09-26 00:42:07', '2018-09-26 01:47:11');
/*!40000 ALTER TABLE `lms_certificate_templates` ENABLE KEYS */;

-- Dumping structure for table alrabeh.lms_couponables
CREATE TABLE IF NOT EXISTS `lms_couponables` (
  `coupon_id` int(10) unsigned NOT NULL,
  `lms_couponable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lms_couponable_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `lms_couponables_coupon_id_index` (`coupon_id`),
  CONSTRAINT `lms_couponables_coupon_id_foreign` FOREIGN KEY (`coupon_id`) REFERENCES `lms_coupons` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table alrabeh.lms_couponables: ~0 rows (approximately)
/*!40000 ALTER TABLE `lms_couponables` DISABLE KEYS */;
/*!40000 ALTER TABLE `lms_couponables` ENABLE KEYS */;

-- Dumping structure for table alrabeh.lms_coupons
CREATE TABLE IF NOT EXISTS `lms_coupons` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('fixed','percentage') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'fixed',
  `uses` int(11) DEFAULT NULL,
  `min_cart_total` decimal(8,2) DEFAULT NULL,
  `max_discount_value` decimal(8,2) DEFAULT NULL,
  `value` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start` datetime DEFAULT NULL,
  `expiry` datetime DEFAULT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`),
  KEY `lms_coupons_created_by_index` (`created_by`),
  KEY `lms_coupons_updated_by_index` (`updated_by`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table alrabeh.lms_coupons: ~0 rows (approximately)
/*!40000 ALTER TABLE `lms_coupons` DISABLE KEYS */;
INSERT INTO `lms_coupons` (`id`, `code`, `type`, `uses`, `min_cart_total`, `max_discount_value`, `value`, `start`, `expiry`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
	(1, '8Dvc29O7UofWY2', 'fixed', 10, NULL, NULL, '10000', '2018-09-04 06:08:48', '2018-09-07 17:08:51', NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `lms_coupons` ENABLE KEYS */;

-- Dumping structure for table alrabeh.lms_coupon_user
CREATE TABLE IF NOT EXISTS `lms_coupon_user` (
  `coupon_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `lms_coupon_user_coupon_id_index` (`coupon_id`),
  KEY `lms_coupon_user_user_id_index` (`user_id`),
  CONSTRAINT `lms_coupon_user_coupon_id_foreign` FOREIGN KEY (`coupon_id`) REFERENCES `lms_coupons` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `lms_coupon_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table alrabeh.lms_coupon_user: ~0 rows (approximately)
/*!40000 ALTER TABLE `lms_coupon_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `lms_coupon_user` ENABLE KEYS */;

-- Dumping structure for table alrabeh.lms_courseables
CREATE TABLE IF NOT EXISTS `lms_courseables` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order` int(11) NOT NULL DEFAULT 0,
  `lms_courseable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lms_courseable_id` int(10) unsigned NOT NULL,
  `course_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `lms_courseables_course_id_foreign` (`course_id`),
  CONSTRAINT `lms_courseables_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `lms_courses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table alrabeh.lms_courseables: ~7 rows (approximately)
/*!40000 ALTER TABLE `lms_courseables` DISABLE KEYS */;
INSERT INTO `lms_courseables` (`id`, `order`, `lms_courseable_type`, `lms_courseable_id`, `course_id`, `created_at`, `updated_at`) VALUES
	(1, 0, 'lesson', 1, 2, NULL, NULL),
	(2, 0, 'lesson', 3, 2, NULL, NULL),
	(3, 0, 'lesson', 5, 2, NULL, NULL),
	(4, 0, 'lesson', 2, 2, NULL, NULL),
	(5, 0, 'lesson', 4, 2, NULL, NULL),
	(7, 0, 'quiz', 6, 2, NULL, NULL),
	(8, 0, 'lesson', 6, 3, NULL, NULL);
/*!40000 ALTER TABLE `lms_courseables` ENABLE KEYS */;

-- Dumping structure for table alrabeh.lms_courses
CREATE TABLE IF NOT EXISTS `lms_courses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keywords` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `level` enum('deficult','easy','medium','very_easy','very_deficult') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'medium',
  `content` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `summary` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `duration` int(11) NOT NULL DEFAULT 5,
  `duration_unit` enum('minute','hour','day','week') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'week',
  `max_students` int(11) NOT NULL DEFAULT 0,
  `enrolled_students` int(11) NOT NULL DEFAULT 0,
  `retake_count` int(11) NOT NULL DEFAULT 1,
  `price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `sale_price` decimal(10,2) DEFAULT 0.00,
  `featured` tinyint(1) NOT NULL DEFAULT 0,
  `block_lessons` tinyint(1) NOT NULL DEFAULT 0,
  `submission_form` tinyint(1) NOT NULL DEFAULT 0,
  `allow_comments` tinyint(1) NOT NULL DEFAULT 1,
  `evaluation_type` enum('completed_lessons_quizzes','final_quiz','passed_quizzes','completed_lessons','quizzes_results') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'completed_lessons_quizzes',
  `passing_grade` int(11) NOT NULL DEFAULT 60,
  `passing_grade_type` enum('percentage','points') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'percentage',
  `featured_image_link` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `preview_video` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `in_home` tinyint(1) NOT NULL DEFAULT 0,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `published_at` datetime DEFAULT NULL,
  `published_at_hij` datetime DEFAULT NULL,
  `started_at` datetime DEFAULT NULL,
  `started_at_hij` datetime DEFAULT NULL,
  `pagination_lessons` tinyint(1) NOT NULL DEFAULT 0,
  `options` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `certificate_id` int(10) unsigned DEFAULT NULL,
  `author_id` int(10) unsigned DEFAULT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `lms_courses_slug_unique` (`slug`),
  KEY `lms_courses_certificate_id_foreign` (`certificate_id`),
  KEY `lms_courses_author_id_foreign` (`author_id`),
  KEY `lms_courses_created_by_index` (`created_by`),
  KEY `lms_courses_updated_by_index` (`updated_by`),
  CONSTRAINT `lms_courses_author_id_foreign` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `lms_courses_certificate_id_foreign` FOREIGN KEY (`certificate_id`) REFERENCES `lms_certificate_templates` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table alrabeh.lms_courses: ~4 rows (approximately)
/*!40000 ALTER TABLE `lms_courses` DISABLE KEYS */;
INSERT INTO `lms_courses` (`id`, `title`, `slug`, `meta_keywords`, `meta_description`, `level`, `content`, `summary`, `duration`, `duration_unit`, `max_students`, `enrolled_students`, `retake_count`, `price`, `sale_price`, `featured`, `block_lessons`, `submission_form`, `allow_comments`, `evaluation_type`, `passing_grade`, `passing_grade_type`, `featured_image_link`, `preview_video`, `is_featured`, `in_home`, `status`, `published_at`, `published_at_hij`, `started_at`, `started_at_hij`, `pagination_lessons`, `options`, `certificate_id`, `author_id`, `created_by`, `updated_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(1, 'دوره تاريخ مصري', 'th345k', NULL, NULL, 'medium', '<p>هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق.<br />\r\nإذا كنت تحتاج إلى عدد أكبر من الفقرات يتيح لك مولد النص العربى زيادة عدد الفقرات كما تريد، النص لن يبدو مقسما ولا يحوي أخطاء لغوية، مولد النص العربى مفيد لمصممي المواقع على وجه الخصوص، حيث يحتاج العميل فى كثير من الأحيان أن يطلع على صورة حقيقية لتصميم الموقع.</p>', 'هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى', 7, 'hour', 9, 8, 6, 7.00, 5.00, 0, 0, 0, 0, '', 60, 'percentage', NULL, NULL, 0, 0, 1, NULL, NULL, NULL, NULL, 0, NULL, NULL, 1, 1, 1, NULL, '2018-09-04 12:53:03', '2018-09-04 12:53:03'),
	(2, 'دوره في اللغه العربية', 'wrwe', NULL, NULL, 'medium', '<p>هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق.<br />\r\nإذا كنت تحتاج إلى عدد أكبر من الفقرات يتيح لك مولد النص العربى زيادة عدد الفقرات كما تريد، النص لن يبدو مقسما ولا يحوي أخطاء لغوية، مولد النص العربى مفيد لمصممي المواقع على وجه الخصوص، حيث يحتاج العميل فى كثير من الأحيان أن يطلع على صورة حقيقية لتصميم الموقع.</p>', 'هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق.\r\nإذا كنت تحتاج إلى عدد أكبر من الفقرات يتيح لك مولد النص العربى زيادة عدد الفقرات كما تريد، النص لن يبدو مقسما ولا يحوي أخطاء لغوية، مولد النص العربى مفيد لمصممي المواقع على وجه الخصوص، حيث يحتاج العميل فى كثير من الأحيان أن يطلع على صورة حقيقية لتصميم الموقع.', 0, 'week', 0, 0, 1, 0.00, 0.00, 1, 1, 0, 1, '', 60, 'percentage', NULL, 'https://youtu.be/VdvEdMMtNMY', 0, 0, 1, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 1, NULL, '2018-09-04 13:10:30', '2018-09-04 20:29:19'),
	(3, 'دوره تدريبيه عامه', 'sybsyoe', NULL, NULL, 'medium', '<p>ومن هنا وجب على المصمم أن يضع نصوصا مؤقتة على التصميم ليظهر للعميل الشكل كاملًا،دور مولد النص العربى أن يوفر على المصمم عناء البحث عن نص بديل لا علاقة له بالموضوع الذى يتحدث عنه التصميم فيظهر بشكل لا يليق.&nbsp;ومن هنا وجب على المصمم أن يضع نصوصا مؤقتة على التصميم ليظهر للعميل الشكل كاملًا،دور مولد النص العربى أن يوفر على المصمم عناء البحث عن نص بديل لا علاقة له بالموضوع الذى يتحدث عنه التصميم فيظهر بشكل لا يليق.</p>', 'ومن هنا وجب على المصمم أن يضع نصوصا مؤقتة على التصميم ليظهر للعميل الشكل كاملًا،دور مولد النص العربى أن يوفر على المصمم عناء البحث عن نص بديل لا علاقة له بالموضوع الذى يتحدث عنه التصميم فيظهر بشكل لا يليق.', 0, 'week', 0, 0, 1, 0.00, 0.00, 1, 0, 0, 1, '', 60, 'percentage', NULL, 'https://youtu.be/VdvEdMMtNMY', 0, 0, 1, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 1, NULL, '2018-09-04 14:23:34', '2018-09-04 22:37:56'),
	(4, 'دوره تدريبيه جديده', 'shksk', NULL, NULL, 'medium', '<p>ومن هنا وجب على المصمم أن يضع نصوصا مؤقتة على التصميم ليظهر للعميل الشكل كاملًا،دور مولد النص العربى أن يوفر على المصمم عناء البحث عن نص بديل لا علاقة له بالموضوع الذى يتحدث عنه التصميم فيظهر بشكل لا يليق.</p>', 'ومن هنا وجب على المصمم أن يضع نصوصا مؤقتة على التصميم ليظهر للعميل الشكل ظهر بشكل لا يليق.', 0, 'week', 0, 0, 1, 8.00, 5.00, 0, 0, 0, 0, '', 60, 'percentage', NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 1, NULL, '2018-09-04 14:25:44', '2018-09-04 14:26:05');
/*!40000 ALTER TABLE `lms_courses` ENABLE KEYS */;

-- Dumping structure for table alrabeh.lms_favourites
CREATE TABLE IF NOT EXISTS `lms_favourites` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `favourittable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `favourittable_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `lms_favourites_user_id_index` (`user_id`),
  KEY `lms_favourites_created_by_index` (`created_by`),
  KEY `lms_favourites_updated_by_index` (`updated_by`),
  CONSTRAINT `lms_favourites_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table alrabeh.lms_favourites: ~0 rows (approximately)
/*!40000 ALTER TABLE `lms_favourites` DISABLE KEYS */;
INSERT INTO `lms_favourites` (`id`, `favourittable_type`, `favourittable_id`, `user_id`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
	(3, 'quiz', 3, 1, 1, 1, 1, '2018-09-28 11:52:41', '2018-09-28 11:52:41');
/*!40000 ALTER TABLE `lms_favourites` ENABLE KEYS */;

-- Dumping structure for table alrabeh.lms_invoicables
CREATE TABLE IF NOT EXISTS `lms_invoicables` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `paid` decimal(8,2) NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `amount` int(11) NOT NULL DEFAULT 1,
  `lms_invoicable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lms_invoicable_id` int(10) unsigned NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `options` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `invoice_id` int(10) unsigned NOT NULL,
  `coupon_id` int(10) unsigned DEFAULT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `lms_invoicables_code_unique` (`code`),
  KEY `lms_invoicables_invoice_id_foreign` (`invoice_id`),
  KEY `lms_invoicables_coupon_id_foreign` (`coupon_id`),
  KEY `lms_invoicables_created_by_index` (`created_by`),
  KEY `lms_invoicables_updated_by_index` (`updated_by`),
  CONSTRAINT `lms_invoicables_coupon_id_foreign` FOREIGN KEY (`coupon_id`) REFERENCES `lms_coupons` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `lms_invoicables_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `lms_invoices` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table alrabeh.lms_invoicables: ~2 rows (approximately)
/*!40000 ALTER TABLE `lms_invoicables` DISABLE KEYS */;
INSERT INTO `lms_invoicables` (`id`, `code`, `paid`, `price`, `amount`, `lms_invoicable_type`, `lms_invoicable_id`, `description`, `notes`, `options`, `invoice_id`, `coupon_id`, `created_by`, `updated_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(6, 'yEbeu0ez', 14.00, 14.00, 1, 'plan', 1, NULL, NULL, NULL, 6, 1, 1, 1, NULL, NULL, NULL),
	(7, 'aZiFfseM', 0.00, 11.00, 1, 'plan', 2, NULL, NULL, NULL, 7, NULL, 1, 1, NULL, NULL, NULL);
/*!40000 ALTER TABLE `lms_invoicables` ENABLE KEYS */;

-- Dumping structure for table alrabeh.lms_invoices
CREATE TABLE IF NOT EXISTS `lms_invoices` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `currency` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `options` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('paid','pending','cancelled','failed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `total_price` decimal(8,2) NOT NULL,
  `coupon_id` int(10) unsigned DEFAULT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `lms_invoices_code_unique` (`code`),
  KEY `lms_invoices_user_id_foreign` (`user_id`),
  KEY `lms_invoices_coupon_id_foreign` (`coupon_id`),
  KEY `lms_invoices_created_by_index` (`created_by`),
  KEY `lms_invoices_updated_by_index` (`updated_by`),
  CONSTRAINT `lms_invoices_coupon_id_foreign` FOREIGN KEY (`coupon_id`) REFERENCES `lms_coupons` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `lms_invoices_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table alrabeh.lms_invoices: ~2 rows (approximately)
/*!40000 ALTER TABLE `lms_invoices` DISABLE KEYS */;
INSERT INTO `lms_invoices` (`id`, `code`, `currency`, `description`, `notes`, `options`, `status`, `total_price`, `coupon_id`, `user_id`, `created_by`, `updated_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(6, 'lmdOYewq9l', 'SR', NULL, NULL, NULL, 'paid', 14.00, 1, 1, 1, 1, NULL, '2018-09-05 23:44:09', '2018-09-05 23:44:09'),
	(7, 'hxjrc0d4t1', 'SR', NULL, NULL, NULL, 'pending', 11.00, NULL, 1, 1, 1, NULL, '2018-09-05 23:55:00', '2018-09-05 23:55:00');
/*!40000 ALTER TABLE `lms_invoices` ENABLE KEYS */;

-- Dumping structure for table alrabeh.lms_lessons
CREATE TABLE IF NOT EXISTS `lms_lessons` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keywords` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `duration` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `duration_unit` enum('minute','hour','day','week') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'minute',
  `level` enum('deficult','easy','medium','very_easy','very_deficult') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'medium',
  `preview_video` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `preview` tinyint(1) NOT NULL DEFAULT 0,
  `allow_comments` tinyint(1) NOT NULL DEFAULT 0,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `published_at` datetime DEFAULT NULL,
  `private` tinyint(1) NOT NULL DEFAULT 0,
  `type` enum('standard','video','quiz','audio','docs') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'standard',
  `options` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `author_id` int(10) unsigned DEFAULT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `lms_lessons_slug_unique` (`slug`),
  KEY `lms_lessons_author_id_foreign` (`author_id`),
  KEY `lms_lessons_created_by_index` (`created_by`),
  KEY `lms_lessons_updated_by_index` (`updated_by`),
  CONSTRAINT `lms_lessons_author_id_foreign` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table alrabeh.lms_lessons: ~6 rows (approximately)
/*!40000 ALTER TABLE `lms_lessons` DISABLE KEYS */;
INSERT INTO `lms_lessons` (`id`, `title`, `slug`, `meta_keywords`, `meta_description`, `content`, `duration`, `duration_unit`, `level`, `preview_video`, `preview`, `allow_comments`, `status`, `published_at`, `private`, `type`, `options`, `author_id`, `created_by`, `updated_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(1, 'تلخيص لمحتوي الوحدة', 'lesson-11q0412n-cvsfyw4', NULL, NULL, NULL, NULL, 'minute', 'medium', NULL, 0, 0, 0, NULL, 0, 'standard', NULL, NULL, 1, 1, NULL, '2018-09-04 12:43:40', '2018-09-04 12:43:40'),
	(2, 'نصوص عربيه', 'lesson-1111rxmyyhc1a9mq', NULL, NULL, '<p>هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق.<br />\r\nإذا كنت تحتاج إلى عدد أكبر من الفقرات يتيح لك مولد النص العربى زيادة عدد الفقرات كما تريد، النص لن يبدو مقسما ولا يحوي أخطاء لغوية، مولد النص العربى مفيد لمصممي المواقع على وجه الخصوص، حيث يحتاج العميل فى كثير من الأحيان أن يطلع على صورة حقيقية لتصميم الموقع.</p>', '3', 'minute', 'medium', NULL, 0, 0, 1, NULL, 0, 'quiz', NULL, NULL, 1, 1, NULL, '2018-09-04 12:44:13', '2018-09-04 19:52:29'),
	(3, 'نصوص عربيه هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى', 'lesson-1cslef-zh2jjij3x', NULL, NULL, 'https://youtu.be/VdvEdMMtNMY', '3', 'minute', 'medium', NULL, 0, 1, 1, NULL, 0, 'video', NULL, NULL, 1, 1, NULL, '2018-09-04 12:44:27', '2018-09-04 19:50:20'),
	(4, 'مقدمه في الادب المصري', 'lesson-14yi56t1n0asql6e', NULL, NULL, '<p>هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق.<br />\r\nإذا كنت تحتاج إلى عدد أكبر من الفقرات يتيح لك مولد النص العربى زيادة عدد الفقرات كما تريد، النص لن يبدو مقسما ولا يحوي أخطاء لغوية، مولد النص العربى مفيد لمصممي المواقع على وجه الخصوص، حيث يحتاج العميل فى كثير من الأحيان أن يطلع على صورة حقيقية لتصميم الموقع.</p>\r\n\r\n<p>هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق.<br />\r\nإذا كنت تحتاج إلى عدد أكبر من الفقرات يتيح لك مولد النص العربى زيادة عدد الفقرات كما تريد، النص لن يبدو مقسما ولا يحوي أخطاء لغوية، مولد النص العربى مفيد لمصممي المواقع على وجه الخصوص، حيث يحتاج العميل فى كثير من الأحيان أن يطلع على صورة حقيقية لتصميم الموقع.</p>\r\n\r\n<p>هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق.<br />\r\nإذا كنت تحتاج إلى عدد أكبر من الفقرات يتيح لك مولد النص العربى زيادة عدد الفقرات كما تريد، النص لن يبدو مقسما ولا يحوي أخطاء لغوية، مولد النص العربى مفيد لمصممي المواقع على وجه الخصوص، حيث يحتاج العميل فى كثير من الأحيان أن يطلع على صورة حقيقية لتصميم الموقع.</p>\r\n\r\n<p>هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق.<br />\r\nإذا كنت تحتاج إلى عدد أكبر من الفقرات يتيح لك مولد النص العربى زيادة عدد الفقرات كما تريد، النص لن يبدو مقسما ولا يحوي أخطاء لغوية، مولد النص العربى مفيد لمصممي المواقع على وجه الخصوص، حيث يحتاج العميل فى كثير من الأحيان أن يطلع على صورة حقيقية لتصميم الموقع.</p>', '1', 'hour', 'medium', NULL, 1, 1, 1, NULL, 0, 'docs', NULL, NULL, 1, 1, NULL, '2018-09-04 12:44:59', '2018-09-04 19:49:35'),
	(5, 'الادب المصري الحديث', 'lesson-1amjup7cyu-jy5j', NULL, NULL, '<p>هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق.<br />\r\nإذا كنت تحتاج إلى عدد أكبر من الفقرات يتيح لك مولد النص العربى زيادة عدد الفقرات كما تريد، النص لن يبدو مقسما ولا يحوي أخطاء لغوية، مولد النص العربى مفيد لمصممي المواقع على وجه الخصوص، حيث يحتاج العميل فى كثير من الأحيان أن يطلع على صورة حقيقية لتصميم الموقع.</p>', '5', 'minute', 'medium', NULL, 1, 1, 1, NULL, 0, 'standard', NULL, NULL, 1, 1, NULL, '2018-09-04 12:45:22', '2018-09-04 19:48:18'),
	(6, 'درس جديد', 'lesson-14m9ajnzbo-rhpx3', NULL, NULL, NULL, NULL, 'minute', 'medium', NULL, 0, 0, 0, NULL, 0, 'standard', NULL, NULL, 1, 1, NULL, '2018-09-04 22:37:37', '2018-09-04 22:37:37');
/*!40000 ALTER TABLE `lms_lessons` ENABLE KEYS */;

-- Dumping structure for table alrabeh.lms_logs
CREATE TABLE IF NOT EXISTS `lms_logs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `lms_loggable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lms_loggable_id` int(10) unsigned NOT NULL,
  `degree` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `enrolls_number` int(11) NOT NULL DEFAULT 1,
  `passed` tinyint(1) NOT NULL DEFAULT 0,
  `delayed` tinyint(1) NOT NULL DEFAULT 0,
  `skipped` tinyint(1) NOT NULL DEFAULT 0,
  `easy_status` tinyint(4) NOT NULL DEFAULT 0,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `preview` tinyint(1) NOT NULL DEFAULT 0,
  `preview_num` int(11) DEFAULT 0,
  `notes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `points` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `passing_grade` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `current_page` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `plan_id` int(10) unsigned DEFAULT NULL,
  `invoice_id` int(10) unsigned DEFAULT NULL,
  `options` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `parent_id` int(10) unsigned DEFAULT NULL,
  `finished_at` datetime DEFAULT NULL,
  `passing_grade_type` enum('percentage','points') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'percentage',
  `is_exercise` tinyint(4) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `lms_logs_parent_id_foreign` (`parent_id`),
  KEY `lms_logs_user_id_foreign` (`user_id`),
  KEY `lms_logs_plan_id_foreign` (`plan_id`),
  KEY `lms_logs_invoice_id_foreign` (`invoice_id`),
  KEY `lms_logs_created_by_index` (`created_by`),
  KEY `lms_logs_updated_by_index` (`updated_by`),
  CONSTRAINT `lms_logs_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `lms_invoices` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `lms_logs_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `lms_logs` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `lms_logs_plan_id_foreign` FOREIGN KEY (`plan_id`) REFERENCES `lms_plans` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `lms_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table alrabeh.lms_logs: ~0 rows (approximately)
/*!40000 ALTER TABLE `lms_logs` DISABLE KEYS */;
/*!40000 ALTER TABLE `lms_logs` ENABLE KEYS */;

-- Dumping structure for table alrabeh.lms_media
CREATE TABLE IF NOT EXISTS `lms_media` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `mediable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mediable_id` int(10) unsigned NOT NULL,
  `type` enum('video','audio','doc','image','file','pdf','slides') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'file',
  `file_type` enum('video','audio','doc','image','file','pdf','slides') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'file',
  `file_url` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `source` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `preview` tinyint(1) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `lms_media_created_by_index` (`created_by`),
  KEY `lms_media_updated_by_index` (`updated_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table alrabeh.lms_media: ~0 rows (approximately)
/*!40000 ALTER TABLE `lms_media` DISABLE KEYS */;
/*!40000 ALTER TABLE `lms_media` ENABLE KEYS */;

-- Dumping structure for table alrabeh.lms_plannables
CREATE TABLE IF NOT EXISTS `lms_plannables` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `lms_plannable_id` int(10) unsigned NOT NULL,
  `lms_plannable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `notes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price_options` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `options` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `plan_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `lms_plannables_plan_id_foreign` (`plan_id`),
  CONSTRAINT `lms_plannables_plan_id_foreign` FOREIGN KEY (`plan_id`) REFERENCES `lms_plans` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table alrabeh.lms_plannables: ~25 rows (approximately)
/*!40000 ALTER TABLE `lms_plannables` DISABLE KEYS */;
INSERT INTO `lms_plannables` (`id`, `lms_plannable_id`, `lms_plannable_type`, `order`, `status`, `notes`, `price_options`, `options`, `plan_id`, `created_at`, `updated_at`) VALUES
	(1, 2, 'category', 0, 1, NULL, NULL, NULL, 1, NULL, NULL),
	(2, 3, 'category', 0, 1, NULL, NULL, NULL, 1, NULL, NULL),
	(3, 1, 'quiz', 0, 1, NULL, NULL, NULL, 1, NULL, NULL),
	(4, 2, 'quiz', 0, 1, NULL, NULL, NULL, 1, NULL, NULL),
	(5, 3, 'quiz', 0, 1, NULL, NULL, NULL, 1, NULL, NULL),
	(6, 4, 'quiz', 0, 1, NULL, NULL, NULL, 1, NULL, NULL),
	(7, 2, 'category', 0, 1, NULL, NULL, NULL, 2, NULL, NULL),
	(8, 3, 'category', 0, 1, NULL, NULL, NULL, 2, NULL, NULL),
	(9, 1, 'course', 0, 1, NULL, NULL, NULL, 2, NULL, NULL),
	(10, 2, 'course', 0, 1, NULL, NULL, NULL, 2, NULL, NULL),
	(11, 2, 'category', 0, 1, NULL, NULL, NULL, 3, NULL, NULL),
	(12, 1, 'category', 0, 1, NULL, NULL, NULL, 3, NULL, NULL),
	(13, 4, 'category', 0, 1, NULL, NULL, NULL, 3, NULL, NULL),
	(14, 3, 'category', 0, 1, NULL, NULL, NULL, 3, NULL, NULL),
	(15, 1, 'course', 0, 1, NULL, NULL, NULL, 3, NULL, NULL),
	(16, 2, 'course', 0, 1, NULL, NULL, NULL, 3, NULL, NULL),
	(17, 2, 'quiz', 0, 1, NULL, NULL, NULL, 3, NULL, NULL),
	(18, 4, 'quiz', 0, 1, NULL, NULL, NULL, 3, NULL, NULL),
	(19, 6, 'quiz', 0, 1, NULL, NULL, NULL, 3, NULL, NULL),
	(20, 2, 'category', 0, 1, NULL, NULL, NULL, 4, NULL, NULL),
	(21, 1, 'category', 0, 1, NULL, NULL, NULL, 4, NULL, NULL),
	(22, 1, 'course', 0, 1, NULL, NULL, NULL, 4, NULL, NULL),
	(23, 6, 'quiz', 0, 1, NULL, NULL, NULL, 4, NULL, NULL),
	(24, 1, 'category', 0, 1, NULL, NULL, NULL, 5, NULL, NULL),
	(25, 1, 'course', 0, 1, NULL, NULL, NULL, 5, NULL, NULL);
/*!40000 ALTER TABLE `lms_plannables` ENABLE KEYS */;

-- Dumping structure for table alrabeh.lms_plans
CREATE TABLE IF NOT EXISTS `lms_plans` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `sale_price` decimal(10,2) DEFAULT 0.00,
  `meta_keywords` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` enum('duration','items','duration_items') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'items',
  `duration_type` enum('minutes','hours','days','weeks','months','years') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'months',
  `duration` int(11) NOT NULL DEFAULT 1,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `is_recommended` tinyint(1) NOT NULL DEFAULT 0,
  `only_planables` tinyint(1) NOT NULL DEFAULT 0,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `notes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price_options` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `options` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `lms_plans_slug_unique` (`slug`),
  KEY `lms_plans_created_by_index` (`created_by`),
  KEY `lms_plans_updated_by_index` (`updated_by`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table alrabeh.lms_plans: ~5 rows (approximately)
/*!40000 ALTER TABLE `lms_plans` DISABLE KEYS */;
INSERT INTO `lms_plans` (`id`, `title`, `content`, `price`, `sale_price`, `meta_keywords`, `meta_description`, `slug`, `type`, `duration_type`, `duration`, `is_featured`, `is_recommended`, `only_planables`, `status`, `notes`, `price_options`, `options`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
	(1, 'خطة اختبارات فقط', '<p style="text-align: right;">هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق.<br />\r\nإذا كنت تحتاج إلى عدد أكبر من الفقرات يتيح لك مولد النص العربى زيادة عدد الفقرات كما تريد، النص لن يبدو مقسما ولا يحوي أخطاء لغوية، مولد النص العربى مفيد لمصممي المواقع على وجه الخصوص، حيث يحتاج العميل فى كثير من الأحيان أن يطلع على صورة حقيقية لتصميم الموقع.</p>', 19.00, 14.00, NULL, NULL, 'home853', 'items', 'months', 1, 1, 0, 0, 1, NULL, NULL, NULL, 1, 1, '2018-09-04 13:46:21', '2018-09-04 13:46:21'),
	(2, 'خطه دورات تدريبيه', '<p>هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم&nbsp;<br />\r\n&nbsp;</p>', 18.00, 11.00, NULL, NULL, '1111', 'items', 'months', 1, 0, 0, 0, 1, NULL, NULL, NULL, 1, 1, '2018-09-04 14:34:43', '2018-09-04 14:34:43'),
	(3, 'خطه شاملة', '<p style="text-align: right;">ومن هنا وجب على المصمم أن يضع نصوصا مؤقتة على التصميم ليظهر للعميل الشكل كاملًا،دور مولد النص العربى أن يوفر على المصمم عناء البحث عن نص بديل لا علاقة له بالموضوع الذى يتحدث عنه التصميم فيظهر بشكل لا يليق.</p>', 30.00, 30.00, NULL, NULL, 'skths', 'items', 'months', 1, 1, 0, 0, 1, NULL, NULL, NULL, 1, 1, '2018-09-04 14:35:54', '2018-09-04 14:35:54'),
	(4, 'خطه مجانيه', '<p>ومن هنا وجب على المصمم أن يضع نصوصا مؤقتة على التصميم ليظهر للعميل الشكل كاملًا،دور مولد النص العربى أن يوفر على المصمم عناء البحث عن نص بديل لا علاقة له بالموضوع الذى يتحدث عنه التصميم فيظهر بشكل لا يليق.</p>', 12.00, 0.00, NULL, NULL, '4k4ysyb', 'items', 'months', 1, 1, 0, 0, 1, NULL, NULL, NULL, 1, 1, '2018-09-04 14:37:19', '2018-09-04 14:37:45'),
	(5, 'نص عربي', '<p>ومن هنا وجب على المصمم أن يضع نصوصا مؤقتة على التصميم ليظهر للعميل الشكل كاملًا،دور مولد النص العربى أن يوفر على المصمم عناء البحث عن نص بديل لا علاقة له بالموضوع الذى يتحدث عنه التصميم فيظهر بشكل لا يليق.</p>', 8.00, 5.00, NULL, NULL, 'oer', 'items', 'months', 1, 0, 0, 0, 0, NULL, NULL, NULL, 1, 1, '2018-09-04 14:38:58', '2018-09-04 14:38:58');
/*!40000 ALTER TABLE `lms_plans` ENABLE KEYS */;

-- Dumping structure for table alrabeh.lms_prices
CREATE TABLE IF NOT EXISTS `lms_prices` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `lms_pricable_id` int(10) unsigned NOT NULL,
  `lms_pricable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(8,2) NOT NULL DEFAULT 0.00,
  `new_price` decimal(8,2) NOT NULL DEFAULT 0.00,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `notes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `options` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table alrabeh.lms_prices: ~0 rows (approximately)
/*!40000 ALTER TABLE `lms_prices` DISABLE KEYS */;
/*!40000 ALTER TABLE `lms_prices` ENABLE KEYS */;

-- Dumping structure for table alrabeh.lms_questions
CREATE TABLE IF NOT EXISTS `lms_questions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) unsigned DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `preview_video` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `duration` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `duration_unit` enum('minute','hour','day','week') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'minute',
  `points` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `question_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'true_false',
  `question_explanation` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `question_hint` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `difficulty` int(11) NOT NULL DEFAULT 1,
  `show_question_title` tinyint(1) NOT NULL DEFAULT 0,
  `show_check_answer` tinyint(4) NOT NULL DEFAULT 0,
  `skip_question` tinyint(4) NOT NULL DEFAULT 0,
  `show_hint` tinyint(1) NOT NULL DEFAULT 0,
  `allow_comments` tinyint(1) NOT NULL DEFAULT 0,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `type` enum('standard','video','audio','docs') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'standard',
  `options` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `lms_questions_parent_id_foreign` (`parent_id`),
  KEY `lms_questions_created_by_index` (`created_by`),
  KEY `lms_questions_updated_by_index` (`updated_by`),
  CONSTRAINT `lms_questions_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `lms_questions` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table alrabeh.lms_questions: ~4 rows (approximately)
/*!40000 ALTER TABLE `lms_questions` DISABLE KEYS */;
INSERT INTO `lms_questions` (`id`, `parent_id`, `title`, `preview_video`, `content`, `duration`, `duration_unit`, `points`, `question_type`, `question_explanation`, `question_hint`, `difficulty`, `show_question_title`, `show_check_answer`, `skip_question`, `show_hint`, `allow_comments`, `status`, `type`, `options`, `created_by`, `updated_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(1, NULL, 'ومن هنا وجب على المصمم أن يضع نصوصا مؤقتة على التصميم ليظهر للعميل الشكل كاملًا', NULL, 'ومن هنا وجب على المصمم أن يضع نصوصا مؤقتة على التصميم ليظهر للعميل الشكل كاملًا ومن هنا وجب على المصمم أن يضع نصوصا مؤقتة على التصميم ليظهر للعميل الشكل كاملًا', NULL, 'minute', '4', 'true_false', 'ومن هنا وجب على المصمم أن يضع نصوصا مؤقتة على التصميم ليظهر للعميل الشكل كاملًا', 'ومن هنا وجب على المصمم أن يضع نصوصا مؤقتة على التصميم ليظهر للعميل الشكل كاملًا', 1, 0, 0, 0, 0, 0, 1, 'standard', NULL, 1, 1, NULL, '2018-09-04 14:07:05', '2018-09-04 14:07:05'),
	(2, NULL, 'ذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى', NULL, 'ذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى ذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى', NULL, 'minute', '5', 'multi_choice', NULL, NULL, 1, 0, 0, 0, 0, 0, 1, 'standard', NULL, 1, 1, NULL, '2018-09-04 14:08:10', '2018-09-04 14:08:10'),
	(3, NULL, 'هذا النص يمكن أن يتم تركيبه على أي تصميم دون مشكلة فلن يبدو وكأنه نص منسوخ،', NULL, 'هذا النص يمكن أن يتم تركيبه على أي تصميم دون مشكلة فلن يبدو وكأنه نص منسوخ، غير منظم، غير منسق، أو حتى غير مفهوم. لأنه مازال نصًا بديلًا ومؤقتًا.', NULL, 'minute', '4', 'single_choice', 'لأنه مازال نصًا بديلًا ومؤقتًا.', 'لأنه مازال نصًا بديلًا ومؤقتًا.', 1, 0, 0, 0, 0, 0, 1, 'standard', NULL, 1, 1, NULL, '2018-09-04 14:11:00', '2018-09-04 14:11:00'),
	(4, NULL, 'ومن هنا وجب على المصمم أن يضع نصوصا مؤقتة على التصميم ليظهر للعميل الشكل كاملًا،دور', NULL, 'ومن هنا وجب على المصمم أن يضع نصوصا مؤقتة على التصميم ليظهر للعميل الشكل كاملًا،دور مولد النص العربى أن يوفر على المصمم عناء البحث عن نص بديل لا علاقة له بالموضوع الذى يتحدث عنه التصميم فيظهر بشكل لا يليق.', NULL, 'minute', '10', 'single_choice', 'ه بالموضوع الذى يتحدث عنه التصميم فيظهر بشكل لا يليق.', 'ن نص بديل لا علاقة له بالموضوع الذى يتحدث عنه التصميم فيظهر بشكل لا يليق.', 1, 0, 0, 0, 0, 0, 1, 'standard', NULL, 1, 1, NULL, '2018-09-04 14:15:45', '2018-09-04 14:16:10');
/*!40000 ALTER TABLE `lms_questions` ENABLE KEYS */;

-- Dumping structure for table alrabeh.lms_quizzes
CREATE TABLE IF NOT EXISTS `lms_quizzes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keywords` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `duration` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `duration_unit` enum('minute','hour','day','week') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'minute',
  `preview` tinyint(1) NOT NULL DEFAULT 0,
  `price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `sale_price` decimal(10,2) DEFAULT 0.00,
  `preview_video` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `question_per_page` int(11) DEFAULT 1,
  `show_q_group_title` tinyint(1) NOT NULL DEFAULT 1,
  `pagination_questions` tinyint(1) NOT NULL DEFAULT 0,
  `review_questions` tinyint(1) NOT NULL DEFAULT 0,
  `is_standlone` tinyint(1) NOT NULL DEFAULT 0,
  `show_questions_title` tinyint(1) NOT NULL DEFAULT 0,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `in_home` tinyint(1) NOT NULL DEFAULT 0,
  `total_degree` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `passing_grade` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '50',
  `retake_count` int(11) NOT NULL DEFAULT 1,
  `show_check_answer` tinyint(1) NOT NULL DEFAULT 0,
  `skip_question` tinyint(1) NOT NULL DEFAULT 1,
  `show_hint` tinyint(1) NOT NULL DEFAULT 0,
  `allow_comments` tinyint(1) NOT NULL DEFAULT 0,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `published_at` datetime DEFAULT NULL,
  `private` tinyint(1) NOT NULL DEFAULT 0,
  `type` enum('standard','video','audio','docs') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'standard',
  `level` enum('deficult','easy','medium','very_easy','very_deficult') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'medium',
  `options` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `certificate_id` int(10) unsigned DEFAULT NULL,
  `author_id` int(10) unsigned DEFAULT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `lms_quizzes_slug_unique` (`slug`),
  KEY `lms_quizzes_certificate_id_foreign` (`certificate_id`),
  KEY `lms_quizzes_author_id_foreign` (`author_id`),
  KEY `lms_quizzes_created_by_index` (`created_by`),
  KEY `lms_quizzes_updated_by_index` (`updated_by`),
  CONSTRAINT `lms_quizzes_author_id_foreign` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `lms_quizzes_certificate_id_foreign` FOREIGN KEY (`certificate_id`) REFERENCES `lms_certificate_templates` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table alrabeh.lms_quizzes: ~7 rows (approximately)
/*!40000 ALTER TABLE `lms_quizzes` DISABLE KEYS */;
INSERT INTO `lms_quizzes` (`id`, `title`, `slug`, `meta_keywords`, `meta_description`, `content`, `duration`, `duration_unit`, `preview`, `price`, `sale_price`, `preview_video`, `question_per_page`, `show_q_group_title`, `pagination_questions`, `review_questions`, `is_standlone`, `show_questions_title`, `is_featured`, `in_home`, `total_degree`, `passing_grade`, `retake_count`, `show_check_answer`, `skip_question`, `show_hint`, `allow_comments`, `status`, `published_at`, `private`, `type`, `level`, `options`, `certificate_id`, `author_id`, `created_by`, `updated_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(1, 'اختبار علي الوحده الاولى', 'quiz-1baldj88rc9psyr4', NULL, NULL, NULL, NULL, 'minute', 0, 0.00, 0.00, 'https://youtu.be/VdvEdMMtNMY', 1, 1, 0, 0, 0, 0, 0, 0, NULL, '50', 1, 0, 0, 0, 0, 0, NULL, 0, 'standard', 'medium', NULL, NULL, NULL, 1, 1, NULL, '2018-09-04 12:44:41', '2018-09-04 12:44:41'),
	(2, 'اختبار على الادب', 'quiz-1lattu10rn24qyw', NULL, NULL, NULL, NULL, 'minute', 0, 0.00, 0.00, 'https://youtu.be/VdvEdMMtNMY', 1, 1, 0, 0, 0, 0, 0, 0, '0', '50', 1, 0, 0, 0, 0, 0, NULL, 0, 'standard', 'medium', NULL, NULL, NULL, 1, 1, NULL, '2018-09-04 12:45:50', '2018-09-04 13:37:25'),
	(3, 'اختبار عام علي الوحدتين', 'quiz-1c8xe0hvqu09r1yg', NULL, NULL, '<p>هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق.<br />\r\nإذا كنت تحتاج إلى عدد أكبر من الفقرات يتيح لك مولد النص العربى زيادة عدد الفقرات كما تريد، النص لن يبدو مقسما ولا يحوي أخطاء لغوية، مولد النص العربى مفيد لمصممي المواقع على وجه الخصوص، حيث يحتاج العميل فى كثير من الأحيان أن يطلع على صورة حقيقية لتصميم الموقع.</p>', '5', 'minute', 0, 8.00, 8.00, 'https://youtu.be/VdvEdMMtNMY', 1, 1, 0, 0, 1, 0, 0, 0, '9', '50', 1, 0, 0, 1, 1, 1, NULL, 0, 'standard', 'medium', NULL, NULL, NULL, 1, 1, NULL, '2018-09-04 12:46:03', '2018-09-04 14:09:09'),
	(4, 'اختبار لغة عربية', '654654', NULL, NULL, '<p>هذا النص يمكن أن يتم تركيبه على أي تصميم دون مشكلة فلن يبدو وكأنه نص منسوخ، غير منظم، غير منسق، أو حتى غير مفهوم. لأنه مازال نصًا بديلًا ومؤقتًا.</p>', '1', 'hour', 1, 0.00, 7.00, NULL, 1, 1, 1, 1, 1, 0, 0, 0, '13', '50', 1, 1, 1, 1, 1, 1, NULL, 0, 'standard', 'medium', NULL, NULL, NULL, 1, 1, NULL, '2018-09-04 13:39:22', '2018-09-04 14:11:41'),
	(5, 'اختبار تاريخ', '111sthb', NULL, NULL, '<p>ومن هنا وجب على المصمم أن يضع نصوصا مؤقتة على التصميم ليظهر للعميل الشكل كاملًا،دور مولد النص العربى أن يوفر على المصمم عناء البحث عن نص بديل لا علاقة له بالموضوع الذى يتحدث عنه التصميم فيظهر بشكل لا يليق.</p>', '4', 'minute', 0, 5.00, 5.00, 'https://youtu.be/VdvEdMMtNMY', 1, 1, 0, 0, 1, 0, 0, 0, '13', '50', 1, 1, 0, 1, 0, 1, NULL, 0, 'standard', 'medium', NULL, NULL, NULL, 1, 1, NULL, '2018-09-04 14:13:02', '2018-09-04 14:13:04'),
	(6, 'اختبار رياضيات', '65365', NULL, NULL, '<p>ومن هنا وجب على المصمم أن يضع نصوصا مؤقتة على التصميم ليظهر للعميل الشكل كاملًا،دور مولد النص العربى أن يوفر على المصمم عناء البحث عن نص بديل لا علاقة له بالموضوع الذى يتحدث عنه التصميم فيظهر بشكل لا يليق.&nbsp;ومن هنا وجب على المصمم أن يضع نصوصا مؤقتة على التصميم ليظهر للعميل الشكل كاملًا،دور مولد النص العربى أن يوفر على المصمم عناء البحث عن نص بديل لا علاقة له بالموضوع الذى يتحدث عنه التصميم فيظهر بشكل لا يليق.</p>', '8', 'minute', 1, 21.00, 19.00, 'https://youtu.be/VdvEdMMtNMY', 1, 1, 0, 0, 1, 0, 0, 0, '13', '50', 1, 0, 0, 1, 1, 1, NULL, 0, 'standard', 'medium', NULL, NULL, NULL, 1, 1, NULL, '2018-09-04 14:14:29', '2018-09-04 14:14:31'),
	(7, 'اختباار عاااام', '643132', NULL, NULL, '<p>ومن هنا وجب على المصمم أن يضع نصوصا مؤقتة على التصميم ليظهر للعميل الشكل كاملًا،دور مولد النص العربى أن يوفر على المصمم عناء البحث عن نص بديل لا علاقة له بالموضوع الذى يتحدث عنه التصميم فيظهر بشكل لا يليق.&nbsp;ومن هنا وجب على المصمم أن يضع نصوصا مؤقتة على التصميم ليظهر للعميل الشكل كاملًا،دور مولد النص العربى أن يوفر على المصمم عناء البحث عن نص بديل لا علاقة له بالموضوع الذى يتحدث عنه التصميم فيظهر بشكل لا يليق.</p>', NULL, 'minute', 1, 8.00, 6.00, NULL, 1, 1, 1, 1, 0, 0, 0, 0, '23', '50', 1, 1, 1, 1, 1, 1, NULL, 0, 'standard', 'medium', NULL, NULL, NULL, 1, 1, NULL, '2018-09-04 14:18:17', '2018-09-04 14:18:19');
/*!40000 ALTER TABLE `lms_quizzes` ENABLE KEYS */;

-- Dumping structure for table alrabeh.lms_quiz_questions
CREATE TABLE IF NOT EXISTS `lms_quiz_questions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `quiz_id` int(10) unsigned NOT NULL,
  `question_id` int(10) unsigned NOT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `lms_quiz_questions_quiz_id_foreign` (`quiz_id`),
  KEY `lms_quiz_questions_question_id_foreign` (`question_id`),
  CONSTRAINT `lms_quiz_questions_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `lms_questions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `lms_quiz_questions_quiz_id_foreign` FOREIGN KEY (`quiz_id`) REFERENCES `lms_quizzes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table alrabeh.lms_quiz_questions: ~15 rows (approximately)
/*!40000 ALTER TABLE `lms_quiz_questions` DISABLE KEYS */;
INSERT INTO `lms_quiz_questions` (`id`, `quiz_id`, `question_id`, `order`, `created_at`, `updated_at`) VALUES
	(1, 3, 1, 0, NULL, NULL),
	(2, 3, 2, 1, NULL, NULL),
	(3, 4, 2, 0, NULL, NULL),
	(4, 4, 1, 1, NULL, NULL),
	(5, 4, 3, 2, NULL, NULL),
	(6, 5, 2, 0, NULL, NULL),
	(7, 5, 1, 1, NULL, NULL),
	(8, 5, 3, 2, NULL, NULL),
	(9, 6, 2, 0, NULL, NULL),
	(10, 6, 3, 1, NULL, NULL),
	(11, 6, 1, 2, NULL, NULL),
	(12, 7, 2, 0, NULL, NULL),
	(13, 7, 1, 1, NULL, NULL),
	(14, 7, 3, 2, NULL, NULL),
	(15, 7, 4, 3, NULL, NULL);
/*!40000 ALTER TABLE `lms_quiz_questions` ENABLE KEYS */;

-- Dumping structure for table alrabeh.lms_sectionables
CREATE TABLE IF NOT EXISTS `lms_sectionables` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `lms_sectionable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lms_sectionable_id` int(10) unsigned NOT NULL,
  `is_private` tinyint(4) NOT NULL DEFAULT 1,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `section_id` int(10) unsigned NOT NULL,
  `course_id` int(10) unsigned NOT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `lms_sectionables_section_id_foreign` (`section_id`),
  KEY `lms_sectionables_course_id_foreign` (`course_id`),
  CONSTRAINT `lms_sectionables_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `lms_courses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `lms_sectionables_section_id_foreign` FOREIGN KEY (`section_id`) REFERENCES `lms_sections` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table alrabeh.lms_sectionables: ~9 rows (approximately)
/*!40000 ALTER TABLE `lms_sectionables` DISABLE KEYS */;
INSERT INTO `lms_sectionables` (`id`, `lms_sectionable_type`, `lms_sectionable_id`, `is_private`, `type`, `section_id`, `course_id`, `order`) VALUES
	(2, 'lesson', 3, 1, 'lesson', 3, 0, 0),
	(3, 'lesson', 5, 1, 'lesson', 4, 0, 0),
	(4, 'lesson', 2, 1, 'lesson', 4, 0, 1),
	(6, 'lesson', 4, 1, 'lesson', 3, 0, 1),
	(7, 'lesson', 2, 1, 'lesson', 3, 0, 2),
	(8, 'quiz', 6, 1, 'quiz', 3, 0, 3),
	(9, 'lesson', 1, 1, 'lesson', 4, 0, 2),
	(10, 'lesson', 3, 1, 'lesson', 4, 0, 3),
	(11, 'lesson', 6, 1, 'lesson', 5, 0, 0);
/*!40000 ALTER TABLE `lms_sectionables` ENABLE KEYS */;

-- Dumping structure for table alrabeh.lms_sections
CREATE TABLE IF NOT EXISTS `lms_sections` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `course_id` int(10) unsigned DEFAULT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `lms_sections_course_id_index` (`course_id`),
  KEY `lms_sections_created_by_index` (`created_by`),
  KEY `lms_sections_updated_by_index` (`updated_by`),
  CONSTRAINT `lms_sections_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `lms_courses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table alrabeh.lms_sections: ~7 rows (approximately)
/*!40000 ALTER TABLE `lms_sections` DISABLE KEYS */;
INSERT INTO `lms_sections` (`id`, `title`, `content`, `order`, `course_id`, `created_by`, `updated_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(1, 'مقدمه في اللفه العربية', NULL, 0, NULL, 1, 1, NULL, '2018-09-04 12:41:20', '2018-09-04 12:41:20'),
	(2, 'دراسه الادب العربي', NULL, 0, NULL, 1, 1, NULL, '2018-09-04 12:42:43', '2018-09-04 12:42:43'),
	(3, 'مقدمه في اللغه العربية', NULL, 0, 2, 1, 1, NULL, '2018-09-04 13:13:55', '2018-09-04 13:16:48'),
	(4, 'دروس الادب المصري', NULL, 1, 2, 1, 1, NULL, '2018-09-04 13:14:23', '2018-09-04 13:16:49'),
	(5, 'الوحده الاولي', NULL, 0, 3, 1, 1, NULL, '2018-09-04 14:22:21', '2018-09-04 14:23:34'),
	(6, 'الوحده الاولي', NULL, 0, 4, 1, 1, NULL, '2018-09-04 14:24:58', '2018-09-04 14:25:44'),
	(7, 'الوحده التانيه', NULL, 0, NULL, 1, 1, NULL, '2018-09-04 14:43:10', '2018-09-04 14:43:10');
/*!40000 ALTER TABLE `lms_sections` ENABLE KEYS */;

-- Dumping structure for table alrabeh.lms_subscriptions
CREATE TABLE IF NOT EXISTS `lms_subscriptions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `subscriptionnable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subscriptionnable_id` int(10) unsigned NOT NULL,
  `is_timable` tinyint(1) NOT NULL DEFAULT 0,
  `finish_time` date DEFAULT NULL,
  `options` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `invoice_id` int(10) unsigned DEFAULT NULL,
  `plan_id` int(10) unsigned DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `lms_subscriptions_user_id_foreign` (`user_id`),
  KEY `lms_subscriptions_plan_id_foreign` (`plan_id`),
  KEY `lms_subscriptions_invoice_id_foreign` (`invoice_id`),
  KEY `lms_subscriptions_created_by_index` (`created_by`),
  KEY `lms_subscriptions_updated_by_index` (`updated_by`),
  CONSTRAINT `lms_subscriptions_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `lms_invoices` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `lms_subscriptions_plan_id_foreign` FOREIGN KEY (`plan_id`) REFERENCES `lms_plans` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `lms_subscriptions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table alrabeh.lms_subscriptions: ~2 rows (approximately)
/*!40000 ALTER TABLE `lms_subscriptions` DISABLE KEYS */;
INSERT INTO `lms_subscriptions` (`id`, `subscriptionnable_type`, `subscriptionnable_id`, `is_timable`, `finish_time`, `options`, `user_id`, `invoice_id`, `plan_id`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
	(7, 'plan', 1, 0, NULL, NULL, 1, 6, NULL, 1, 1, 1, '2018-09-05 23:44:09', '2018-09-05 23:44:09'),
	(8, 'plan', 2, 0, NULL, NULL, 1, 7, NULL, 0, 1, 1, '2018-09-05 23:55:01', '2018-09-05 23:55:01');
/*!40000 ALTER TABLE `lms_subscriptions` ENABLE KEYS */;

-- Dumping structure for table alrabeh.lms_taggables
CREATE TABLE IF NOT EXISTS `lms_taggables` (
  `lms_taggable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lms_taggable_id` int(10) unsigned NOT NULL,
  `tag_id` int(10) unsigned NOT NULL,
  KEY `lms_taggables_tag_id_foreign` (`tag_id`),
  CONSTRAINT `lms_taggables_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `lms_tags` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table alrabeh.lms_taggables: ~7 rows (approximately)
/*!40000 ALTER TABLE `lms_taggables` DISABLE KEYS */;
INSERT INTO `lms_taggables` (`lms_taggable_type`, `lms_taggable_id`, `tag_id`) VALUES
	('course', 2, 2),
	('course', 2, 1),
	('course', 3, 2),
	('course', 3, 1),
	('course', 4, 2),
	('lesson', 5, 2),
	('lesson', 3, 2);
/*!40000 ALTER TABLE `lms_taggables` ENABLE KEYS */;

-- Dumping structure for table alrabeh.lms_tags
CREATE TABLE IF NOT EXISTS `lms_tags` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `lms_tags_name_unique` (`name`),
  UNIQUE KEY `lms_tags_slug_unique` (`slug`),
  KEY `lms_tags_created_by_index` (`created_by`),
  KEY `lms_tags_updated_by_index` (`updated_by`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table alrabeh.lms_tags: ~2 rows (approximately)
/*!40000 ALTER TABLE `lms_tags` DISABLE KEYS */;
INSERT INTO `lms_tags` (`id`, `name`, `slug`, `status`, `created_by`, `updated_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(1, 'س عربي', 'بقثسقبصث', 'active', NULL, NULL, NULL, '2018-09-04 16:20:22', '2018-09-04 16:20:24'),
	(2, 'س عامه', 'قبسيب', 'active', NULL, NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `lms_tags` ENABLE KEYS */;

-- Dumping structure for table alrabeh.lms_testimonials
CREATE TABLE IF NOT EXISTS `lms_testimonials` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `user_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keywords` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `in_home` tinyint(1) NOT NULL DEFAULT 1,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `lms_testimonials_user_id_index` (`user_id`),
  KEY `lms_testimonials_created_by_index` (`created_by`),
  KEY `lms_testimonials_updated_by_index` (`updated_by`),
  CONSTRAINT `lms_testimonials_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table alrabeh.lms_testimonials: ~0 rows (approximately)
/*!40000 ALTER TABLE `lms_testimonials` DISABLE KEYS */;
INSERT INTO `lms_testimonials` (`id`, `user_id`, `user_name`, `title`, `content`, `meta_keywords`, `meta_description`, `in_home`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
	(1, NULL, 'محمد احمد', 'ابو رابح مبدع', '<p>الموقع جيد و الشروحات اكثر من ممتازه وافادتني كثيرا .. شكرا للقائمين على الموقع</p>', NULL, NULL, 1, 1, 1, 1, '2018-09-29 13:21:49', '2018-09-29 13:21:49');
/*!40000 ALTER TABLE `lms_testimonials` ENABLE KEYS */;

-- Dumping structure for table alrabeh.media
CREATE TABLE IF NOT EXISTS `media` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  `collection_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mime_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `disk` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` int(10) unsigned NOT NULL,
  `manipulations` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `custom_properties` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_column` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `media_model_type_model_id_index` (`model_type`,`model_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table alrabeh.media: ~21 rows (approximately)
/*!40000 ALTER TABLE `media` DISABLE KEYS */;
INSERT INTO `media` (`id`, `model_type`, `model_id`, `collection_name`, `name`, `file_name`, `mime_type`, `disk`, `size`, `manipulations`, `custom_properties`, `order_column`, `created_at`, `updated_at`) VALUES
	(1, 'course', 1, 'lms-course-thumbnail', '06', '06.jpg', 'image/jpeg', 'media', 4040, '[]', '{"root":"lms_demo"}', 1, '2018-09-04 12:53:04', '2018-09-04 12:53:04'),
	(2, 'category', 1, 'lms-category-thumbnail', 'mind', 'mind.png', 'image/png', 'media', 10160, '[]', '{"root":"lms_demo"}', 2, '2018-09-04 13:26:42', '2018-09-04 13:26:42'),
	(3, 'category', 2, 'lms-category-thumbnail', 'check', 'check.png', 'image/png', 'media', 5116, '[]', '{"root":"lms_demo"}', 3, '2018-09-04 13:27:21', '2018-09-04 13:27:21'),
	(4, 'category', 3, 'lms-category-thumbnail', 'bag', 'bag.png', 'image/png', 'media', 3917, '[]', '{"root":"lms_demo"}', 4, '2018-09-04 13:28:19', '2018-09-04 13:28:19'),
	(5, 'category', 4, 'lms-category-thumbnail', '1', '1.jpg', 'image/jpeg', 'media', 18874, '[]', '{"root":"lms_demo"}', 5, '2018-09-04 13:30:02', '2018-09-04 13:30:02'),
	(6, 'quiz', 4, 'lms-quiz-thumbnail', '05', '05.jpg', 'image/jpeg', 'media', 8278, '[]', '{"root":"lms_demo"}', 6, '2018-09-04 13:39:23', '2018-09-04 13:39:23'),
	(7, 'quiz', 3, 'lms-quiz-thumbnail', '03', '03.jpg', 'image/jpeg', 'media', 8464, '[]', '{"root":"lms_demo"}', 7, '2018-09-04 14:09:08', '2018-09-04 14:09:08'),
	(8, 'quiz', 5, 'lms-quiz-thumbnail', 'students', 'students.png', 'image/png', 'media', 7492, '[]', '{"root":"lms_demo"}', 8, '2018-09-04 14:13:03', '2018-09-04 14:13:03'),
	(9, 'quiz', 6, 'lms-quiz-thumbnail', '02', '02.jpg', 'image/jpeg', 'media', 6491, '[]', '{"root":"lms_demo"}', 9, '2018-09-04 14:14:30', '2018-09-04 14:14:30'),
	(10, 'quiz', 7, 'lms-quiz-thumbnail', 'teacher', 'teacher.png', 'image/png', 'media', 6550, '[]', '{"root":"lms_demo"}', 10, '2018-09-04 14:18:17', '2018-09-04 14:18:17'),
	(11, 'course', 2, 'lms-course-thumbnail', '02', '02.jpg', 'image/jpeg', 'media', 6491, '[]', '{"root":"lms_demo"}', 11, '2018-09-04 14:21:42', '2018-09-04 14:21:42'),
	(12, 'course', 3, 'lms-course-thumbnail', 'about', 'about.jpg', 'image/jpeg', 'media', 192308, '[]', '{"root":"lms_demo"}', 12, '2018-09-04 14:23:35', '2018-09-04 14:23:35'),
	(13, 'course', 4, 'lms-course-thumbnail', 'bag', 'bag.png', 'image/png', 'media', 3917, '[]', '{"root":"lms_demo"}', 13, '2018-09-04 14:25:45', '2018-09-04 14:25:45'),
	(14, 'plan', 2, 'lms-plan-thumbnail', '01', '01.jpg', 'image/jpeg', 'media', 6489, '[]', '{"root":"lms_demo"}', 14, '2018-09-04 14:34:43', '2018-09-04 14:34:43'),
	(15, 'plan', 3, 'lms-plan-thumbnail', 'students', 'students.png', 'image/png', 'media', 7492, '[]', '{"root":"lms_demo"}', 15, '2018-09-04 14:35:54', '2018-09-04 14:35:54'),
	(16, 'plan', 4, 'lms-plan-thumbnail', '06', '06.jpg', 'image/jpeg', 'media', 4040, '[]', '{"root":"lms_demo"}', 16, '2018-09-04 14:37:19', '2018-09-04 14:37:19'),
	(17, 'lesson', 5, 'lms-lesson-thumbnail', '06', '06.jpg', 'image/jpeg', 'media', 4040, '[]', '{"root":"lms_demo"}', 17, '2018-09-04 19:48:18', '2018-09-04 19:48:18'),
	(18, 'lesson', 4, 'lms-lesson-thumbnail', '03', '03.jpg', 'image/jpeg', 'media', 8464, '[]', '{"root":"lms_demo"}', 18, '2018-09-04 19:49:35', '2018-09-04 19:49:35'),
	(19, 'lesson', 3, 'lms-lesson-thumbnail', 'bag', 'bag.png', 'image/png', 'media', 3917, '[]', '{"root":"lms_demo"}', 19, '2018-09-04 19:50:20', '2018-09-04 19:50:20'),
	(20, 'lesson', 2, 'lms-lesson-thumbnail', 'mind', 'mind.png', 'image/png', 'media', 10160, '[]', '{"root":"lms_demo"}', 20, '2018-09-04 19:52:29', '2018-09-04 19:52:29'),
	(22, 'Modules\\Components\\LMS\\Models\\Testimonial', 1, 'lms-testimonial-thumbnail', 'avatar_8', 'avatar_8.png', 'image/png', 'media', 33683, '[]', '{"root":"user_oeb0qA042O"}', 22, '2018-12-02 15:02:47', '2018-12-02 15:02:47');
/*!40000 ALTER TABLE `media` ENABLE KEYS */;

-- Dumping structure for table alrabeh.menus
CREATE TABLE IF NOT EXISTS `menus` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) unsigned NOT NULL DEFAULT 0,
  `key` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active_menu_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `roles` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `target` enum('_blank','_self') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `order` int(11) NOT NULL DEFAULT 0,
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `menus_key_unique` (`key`),
  KEY `menus_created_by_index` (`created_by`),
  KEY `menus_updated_by_index` (`updated_by`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table alrabeh.menus: ~47 rows (approximately)
/*!40000 ALTER TABLE `menus` DISABLE KEYS */;
INSERT INTO `menus` (`id`, `parent_id`, `key`, `url`, `active_menu_url`, `icon`, `roles`, `name`, `description`, `target`, `status`, `order`, `created_by`, `updated_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(1, 0, 'sidebar', NULL, NULL, NULL, NULL, 'Sidebar', 'Sidebar Root Menu', NULL, 'active', 0, NULL, 1, NULL, NULL, '2018-12-02 14:38:52'),
	(2, 1, 'administration', NULL, NULL, 'fa fa-plug', '["1"]', 'Administration', 'Administration Root Menu', NULL, 'active', 7, NULL, NULL, NULL, NULL, '2018-12-02 14:38:23'),
	(3, 1, NULL, 'file-manager', 'file-manager*', 'fa fa-folder-o', '["1"]', 'File Manager', 'File Manager Menu Item', NULL, 'active', 5, NULL, NULL, NULL, NULL, '2018-12-02 14:38:23'),
	(4, 2, NULL, 'menus', 'menu*', 'fa fa-conversations', '["1"]', 'Menu', 'Menu Menu Item', NULL, 'active', 1, NULL, NULL, NULL, NULL, '2018-12-02 14:38:26'),
	(5, 2, 'notification_templates', 'notification-templates', 'notification-templates*', 'fa fa-bell-o', '["1"]', 'Notification Templates', 'Notification Templates Menu Item', NULL, 'active', 0, NULL, NULL, NULL, NULL, '2018-12-02 14:38:26'),
	(7, 2, NULL, 'settings', 'settings*', 'fa fa-gears', '["1"]', 'Settings', 'Settings Menu Item', NULL, 'active', 2, NULL, NULL, NULL, NULL, '2018-12-02 14:38:26'),
	(8, 2, NULL, 'activities', 'activities*', 'fa fa-history', '["1"]', 'Activities', 'Activities Menu Item', NULL, 'active', 3, NULL, NULL, NULL, NULL, '2018-12-02 14:38:27'),
	(11, 2, NULL, 'cache-management', 'cache-management', 'fa fa-fighter-jet', '["1"]', 'Cache Management', 'Cache Management Menu Item', NULL, 'active', 4, NULL, NULL, NULL, NULL, '2018-12-02 14:38:27'),
	(12, 1, 'user', NULL, 'users*', 'fa fa-users', '["1"]', 'Users', 'Users Menu Item', NULL, 'active', 0, NULL, NULL, NULL, NULL, '2018-12-02 14:38:23'),
	(13, 12, NULL, 'users', 'users*', 'fa fa-user-o', '["1"]', 'Users', 'Users List Menu Item', NULL, 'active', 0, NULL, NULL, NULL, NULL, '2018-12-02 14:38:23'),
	(14, 12, NULL, 'roles', 'roles*', 'fa fa-key', '["1"]', 'Roles', 'Roles List Menu Item', NULL, 'active', 1, NULL, NULL, NULL, NULL, '2018-12-02 14:38:23'),
	(15, 1, 'utility', NULL, 'utilities*', 'fa fa-cloud', '["1"]', 'Utilities', 'Utilities Menu Item', NULL, 'inactive', 6, NULL, 1, NULL, NULL, '2018-12-02 14:38:37'),
	(16, 15, NULL, 'utilities/address/locations', 'utilities/address/locations*', 'fa fa-map-o', '["1"]', 'Locations', 'Locations List Menu Item', NULL, 'active', 0, NULL, NULL, NULL, NULL, '2018-12-02 14:38:26'),
	(17, 15, NULL, 'utilities/tags', 'utilities/tags*', 'fa fa-tags', '["1"]', 'Tags', 'Tags List Menu Item', NULL, 'active', 1, NULL, NULL, NULL, NULL, '2018-12-02 14:38:26'),
	(18, 15, NULL, 'utilities/categories', 'utilities/categories*', 'fa fa-folder-open', '["1"]', 'Categories', 'Categories List Menu Item', NULL, 'active', 2, NULL, NULL, NULL, NULL, '2018-12-02 14:38:26'),
	(19, 15, NULL, 'utilities/attributes', 'utilities/attributes*', 'fa fa-sliders', '["1"]', 'Attributes', 'Attributes List Menu Item', NULL, 'active', 3, NULL, NULL, NULL, NULL, '2018-12-02 14:38:26'),
	(20, 0, 'lms_frontend_footer', NULL, NULL, '', '', 'Frontend Footer Root Menu', 'Frontend Footer Root Menu', NULL, 'active', 0, NULL, NULL, NULL, NULL, NULL),
	(21, 0, 'lms_frontend', NULL, NULL, '', '', 'Frontend Root Menu', 'Frontend Root Menu', NULL, 'active', 0, NULL, NULL, NULL, NULL, NULL),
	(22, 21, NULL, '/', '', '', '', 'الرئيسية', 'Home List Menu Item', NULL, 'active', 0, NULL, NULL, NULL, NULL, NULL),
	(23, 21, NULL, 'http://alrabeh.test/courses', '/courses*', '', '', 'الدورات التدريبية', 'Courses List Menu Item', NULL, 'active', 0, NULL, NULL, NULL, NULL, NULL),
	(24, 21, NULL, 'http://alrabeh.test/quizzes', '/quizzes*', '', '', 'الإختبارات', 'Quizzes List Menu Item', NULL, 'active', 0, NULL, NULL, NULL, NULL, NULL),
	(25, 21, NULL, 'http://alrabeh.test/packages', '/packages*', '', '', 'الباقات', 'Plans List Menu Item', NULL, 'active', 0, NULL, NULL, NULL, NULL, NULL),
	(26, 21, NULL, '/contact-us', '/contact-us*', '', '', 'اتصل بنا', 'contact us List Menu Item', NULL, 'active', 0, NULL, NULL, NULL, NULL, NULL),
	(27, 21, NULL, '/about-us', '/about-us*', '', '', 'من نحن', 'about us List Menu Item', NULL, 'active', 0, NULL, NULL, NULL, NULL, NULL),
	(28, 1, NULL, '/manage/books', 'manage/books*', 'fa fa-book', '["1"]', 'Books', 'Books Menu Item', NULL, 'active', 1, NULL, NULL, NULL, NULL, '2018-12-02 14:38:23'),
	(29, 1, 'lms', NULL, 'lms*', 'fa fa-graduation-cap', '["1"]', 'LMS', 'LMS Menu Item', NULL, 'active', 2, NULL, NULL, NULL, NULL, '2018-12-02 14:38:23'),
	(30, 29, NULL, 'lms/categories', 'lms/categories*', 'fa fa-folder-open', '["1"]', 'Categories', 'Categories List Menu Item', NULL, 'active', 0, NULL, NULL, NULL, NULL, '2018-12-02 14:38:24'),
	(31, 29, NULL, 'lms/courses', 'lms/courses*', 'fa fa-chalkboard-teacher', '["1"]', 'Courses', 'Courses List Menu Item', NULL, 'active', 1, NULL, NULL, NULL, NULL, '2018-12-02 14:38:24'),
	(32, 29, NULL, 'lms/lessons', 'lms/lessons*', 'fa fa-book-open', '["1"]', 'Lessons', 'Lessons List Menu Item', NULL, 'active', 2, NULL, NULL, NULL, NULL, '2018-12-02 14:38:24'),
	(33, 29, NULL, 'lms/quizzes', 'lms/quizzes*', 'fa fa-chess-clock', '["1"]', 'Quizzes', 'Quizzes List Menu Item', NULL, 'active', 3, NULL, NULL, NULL, NULL, '2018-12-02 14:38:24'),
	(34, 29, NULL, 'lms/questions', 'lms/questions*', 'fa fa-question-circle', '["1"]', 'Questions', 'Questions List Menu Item', NULL, 'active', 4, NULL, NULL, NULL, NULL, '2018-12-02 14:38:24'),
	(35, 29, NULL, 'lms/tags', 'lms/tags*', 'fa fa-tags', '["1"]', 'Tags', 'Tags List Menu Item', NULL, 'active', 5, NULL, NULL, NULL, NULL, '2018-12-02 14:38:24'),
	(36, 29, NULL, 'lms/plans', 'lms/plans*', 'fa fa-plans', '["1"]', 'Plans', 'Plans List Menu Item', NULL, 'active', 6, NULL, NULL, NULL, NULL, '2018-12-02 14:38:24'),
	(37, 29, NULL, 'lms/invoices', 'lms/invoices*', 'fa fa-plans', '["1"]', 'invoices', 'invoices List Menu Item', NULL, 'active', 7, NULL, NULL, NULL, NULL, '2018-12-02 14:38:25'),
	(38, 29, NULL, 'lms/subscriptions', 'lms/subscriptions*', 'fa fa-subscriptions', '["1"]', 'subscriptions', 'subscriptions List Menu Item', NULL, 'active', 8, NULL, NULL, NULL, NULL, '2018-12-02 14:38:25'),
	(39, 29, NULL, 'lms/coupons', 'lms/coupons*', 'fa fa-plans', '["1"]', 'coupons', 'coupons List Menu Item', NULL, 'active', 9, NULL, NULL, NULL, NULL, '2018-12-02 14:38:25'),
	(40, 29, NULL, 'lms/certificates', 'lms/certificates*', 'fa fa-plans', '["1"]', 'Certificates', 'Certificates List Menu Item', NULL, 'active', 10, NULL, NULL, NULL, NULL, '2018-12-02 14:38:25'),
	(41, 29, NULL, 'lms/testimonials', 'lms/testimonials*', 'fa fa-plans', '["1"]', 'testimonials', 'testimonials List Menu Item', NULL, 'active', 11, NULL, NULL, NULL, NULL, '2018-12-02 14:38:25'),
	(42, 1, 'cms', NULL, 'cms*', 'fa fa-desktop', '["1"]', 'CMS', 'CMS Menu Item', NULL, 'active', 3, NULL, NULL, NULL, NULL, '2018-12-02 14:38:23'),
	(43, 42, NULL, 'cms/pages', 'cms/pages*', 'fa fa-files-o', '["1"]', 'Pages', 'Pages List Menu Item', NULL, 'active', 0, NULL, NULL, NULL, NULL, '2018-12-02 14:38:25'),
	(44, 42, NULL, 'cms/posts', 'cms/posts*', 'fa fa-thumb-tack', '["1"]', 'Posts', 'Posts List Menu Item', NULL, 'active', 1, NULL, NULL, NULL, NULL, '2018-12-02 14:38:25'),
	(45, 42, NULL, 'cms/categories', 'cms/categories*', 'fa fa-folder-open', '["1"]', 'Categories', 'Categories List Menu Item', NULL, 'active', 2, NULL, NULL, NULL, NULL, '2018-12-02 14:38:25'),
	(46, 42, NULL, 'cms/blog', 'cms/blog*', 'fa fa-book', '["1","2"]', 'Internal Content', 'Internal Content List Menu Item', NULL, 'active', 3, NULL, NULL, NULL, NULL, '2018-12-02 14:38:25'),
	(47, 42, NULL, 'cms/news', 'cms/news*', 'fa fa-newspaper-o', '["1"]', 'News', 'News List Menu Item', NULL, 'active', 4, NULL, NULL, NULL, NULL, '2018-12-02 14:38:26'),
	(48, 1, 'form_builder', NULL, 'form-builder*', 'fa fa-edit', '["1"]', 'Form Builder', 'Form Builder Item', NULL, 'active', 4, NULL, NULL, NULL, NULL, '2018-12-02 14:38:23'),
	(49, 48, NULL, 'form-builder/forms', 'form-builder/forms*', 'fa fa-list-alt', '["1"]', 'Forms', 'Forms List Menu Item', NULL, 'active', 0, NULL, NULL, NULL, NULL, '2018-12-02 14:38:26'),
	(50, 48, NULL, 'form-builder/settings', 'form-builder/settings*', 'fa fa-cog fa-fw', '["1"]', 'Forms Settings', 'Forms Settings Menu Item', NULL, 'active', 1, NULL, NULL, NULL, NULL, '2018-12-02 14:38:26');
/*!40000 ALTER TABLE `menus` ENABLE KEYS */;

-- Dumping structure for table alrabeh.messages
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `message` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `media_url` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'text',
  `is_seen` tinyint(1) NOT NULL DEFAULT 0,
  `deleted_from_sender` tinyint(1) NOT NULL DEFAULT 0,
  `deleted_from_receiver` tinyint(1) NOT NULL DEFAULT 0,
  `user_id` int(10) unsigned NOT NULL,
  `conversation_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `chat_messages_user_id_foreign` (`user_id`),
  KEY `chat_messages_conversation_id_foreign` (`conversation_id`),
  CONSTRAINT `chat_messages_conversation_id_foreign` FOREIGN KEY (`conversation_id`) REFERENCES `conversations` (`id`) ON DELETE CASCADE,
  CONSTRAINT `chat_messages_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table alrabeh.messages: ~0 rows (approximately)
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;

-- Dumping structure for table alrabeh.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table alrabeh.migrations: ~18 rows (approximately)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '0000_00_00_000000_create_activity_log_table', 1),
	(2, '0000_00_00_000000_create_media_table', 1),
	(3, '0000_00_00_000000_create_settings_table', 1),
	(4, '2014_10_12_000000_create_users_table', 1),
	(5, '2014_10_12_100000_create_password_resets_table', 1),
	(6, '2017_01_23_222300_create_translatable_translations_table', 1),
	(7, '2017_05_03_204317_create_plans_table', 1),
	(8, '2017_05_03_204335_create_plan_features_table', 1),
	(9, '2017_05_03_204353_create_plan_subscriptions_table', 1),
	(10, '2017_05_03_204408_create_plan_subscription_usage_table', 1),
	(11, '2017_09_13_195204_create_permission_tables', 1),
	(12, '2017_09_16_000000_create_menus_table', 1),
	(13, '2017_12_18_000000_create_countries_table', 1),
	(14, '2017_12_31_000000_create_modules_table', 1),
	(15, '2018_01_02_152913_create_fulltext_search_table', 1),
	(16, '2018_02_19_000000_create_custom_fields_table', 1),
	(17, '2018_07_19_000000_add_confirmation_to_users_table', 1),
	(18, '2018_2_26_000000_update_users_address_table', 1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Dumping structure for table alrabeh.model_has_permissions
CREATE TABLE IF NOT EXISTS `model_has_permissions` (
  `permission_id` int(10) unsigned NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_type_model_id_index` (`model_type`,`model_id`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table alrabeh.model_has_permissions: ~0 rows (approximately)
/*!40000 ALTER TABLE `model_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `model_has_permissions` ENABLE KEYS */;

-- Dumping structure for table alrabeh.model_has_roles
CREATE TABLE IF NOT EXISTS `model_has_roles` (
  `role_id` int(10) unsigned NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_type_model_id_index` (`model_type`,`model_id`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table alrabeh.model_has_roles: ~2 rows (approximately)
/*!40000 ALTER TABLE `model_has_roles` DISABLE KEYS */;
INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
	(1, 'Modules\\User\\Models\\User', 1),
	(2, 'Modules\\User\\Models\\User', 2);
/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */;

-- Dumping structure for table alrabeh.modules
CREATE TABLE IF NOT EXISTS `modules` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL DEFAULT 0,
  `installed` tinyint(1) NOT NULL DEFAULT 0,
  `installed_version` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `load_order` int(11) NOT NULL DEFAULT 0,
  `provider` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `folder` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` enum('core','module','payment') COLLATE utf8mb4_unicode_ci NOT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `license_key` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `modules_code_unique` (`code`),
  KEY `modules_created_by_index` (`created_by`),
  KEY `modules_updated_by_index` (`updated_by`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table alrabeh.modules: ~14 rows (approximately)
/*!40000 ALTER TABLE `modules` DISABLE KEYS */;
INSERT INTO `modules` (`id`, `code`, `enabled`, `installed`, `installed_version`, `load_order`, `provider`, `folder`, `type`, `notes`, `license_key`, `created_by`, `updated_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(1, 'corals-cms', 1, 1, '1.7', 9999, 'Modules\\Components\\CMS\\CMSServiceProvider', 'CMS', 'module', NULL, NULL, 1, 1, NULL, '2018-12-02 13:56:36', '2018-12-02 14:11:27'),
	(2, 'corals-form-builder', 1, 1, '1.6.7', 10, 'Modules\\Components\\FormBuilder\\FormBuilderServiceProvider', 'FormBuilder', 'module', NULL, NULL, 1, 1, NULL, '2018-12-02 13:56:36', '2018-12-02 14:11:47'),
	(3, 'developnet-lms', 1, 1, '1.0', 0, 'Modules\\Components\\LMS\\LMSServiceProvider', 'LMS', 'module', NULL, NULL, 1, 1, NULL, '2018-12-02 13:56:36', '2018-12-02 14:10:45'),
	(4, 'developnet-payments', 0, 0, NULL, 0, 'Modules\\Components\\Payments\\PaymentsServiceProvider', 'Payments', 'module', NULL, NULL, 1, 1, NULL, '2018-12-02 13:56:37', '2018-12-02 13:56:37'),
	(5, 'corals-cms-slider', 0, 0, NULL, 0, 'Modules\\Components\\Slider\\SliderServiceProvider', 'Slider', 'module', NULL, NULL, 1, 1, NULL, '2018-12-02 13:56:37', '2018-12-02 13:56:37'),
	(6, 'corals-utility', 1, 1, '1.0.4', 0, 'Modules\\Components\\Utility\\UtilityServiceProvider', 'Utility', 'module', NULL, NULL, 1, 1, NULL, '2018-12-02 13:56:37', '2018-12-02 14:03:16'),
	(7, 'corals-activity', 1, 1, '1.2', 35, 'Modules\\Activity\\ActivityServiceProvider', 'Activity', 'core', NULL, NULL, 1, 1, NULL, '2018-12-02 13:56:37', '2018-12-02 13:56:37'),
	(8, 'corals-file-manager', 1, 1, '1.3', 30, 'Modules\\Elfinder\\ElfinderServiceProvider', 'Elfinder', 'core', NULL, NULL, 1, 1, NULL, '2018-12-02 13:56:37', '2018-12-02 13:56:37'),
	(9, 'corals-foundation', 1, 1, '1.7.7', 100, 'Modules\\Foundation\\FoundationServiceProvider', 'Foundation', 'core', NULL, NULL, 1, 1, NULL, '2018-12-02 13:56:38', '2018-12-02 13:56:38'),
	(10, 'corals-media', 1, 1, '1.3', 25, 'Modules\\Media\\MediaServiceProvider', 'Media', 'core', NULL, NULL, 1, 1, NULL, '2018-12-02 13:56:38', '2018-12-02 13:56:38'),
	(11, 'corals-menu', 1, 1, '1.3', 20, 'Modules\\Menu\\MenuServiceProvider', 'Menu', 'core', NULL, NULL, 1, 1, NULL, '2018-12-02 13:56:38', '2018-12-02 13:56:38'),
	(12, 'corals-settings', 1, 1, '2.1.1', 15, 'Modules\\Settings\\SettingsServiceProvider', 'Settings', 'core', NULL, NULL, 1, 1, NULL, '2018-12-02 13:56:38', '2018-12-02 13:56:38'),
	(13, 'corals-theme', 1, 1, '1.5.5', 40, 'Modules\\Theme\\ThemeServiceProvider', 'Theme', 'core', NULL, NULL, 1, 1, NULL, '2018-12-02 13:56:38', '2018-12-02 13:56:38'),
	(14, 'corals-user', 1, 1, '1.5.6', 10, 'Modules\\User\\UserServiceProvider', 'User', 'core', NULL, NULL, 1, 1, NULL, '2018-12-02 13:56:38', '2018-12-02 13:56:38');
/*!40000 ALTER TABLE `modules` ENABLE KEYS */;

-- Dumping structure for table alrabeh.notifications
CREATE TABLE IF NOT EXISTS `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint(20) unsigned NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table alrabeh.notifications: ~0 rows (approximately)
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;

-- Dumping structure for table alrabeh.notification_templates
CREATE TABLE IF NOT EXISTS `notification_templates` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `friendly_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `body` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `extras` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `via` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notification_templates_updated_by_index` (`updated_by`),
  KEY `notification_templates_created_by_index` (`created_by`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table alrabeh.notification_templates: ~2 rows (approximately)
/*!40000 ALTER TABLE `notification_templates` DISABLE KEYS */;
INSERT INTO `notification_templates` (`id`, `name`, `friendly_name`, `title`, `body`, `extras`, `via`, `updated_by`, `created_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(1, 'notifications.user.registered', 'New user registration', 'Welcome to Modules', '{"mail":"<table align=\\"center\\" border=\\"0\\" cellpadding=\\"0\\" cellspacing=\\"0\\" style=\\"max-width:600px;\\" width=\\"100%\\"><tbody><tr><td align=\\"left\\" style=\\"font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-bottom: 15px;\\"><p style=\\"font-size: 18px; font-weight: 800; line-height: 24px; color: #333333;\\">Hello {name},<\\/p><p style=\\"font-size: 16px; font-weight: 400; line-height: 24px; color: #777777;\\">Welcome to Laraship and thanks for registration! hope you find what you are looking for in our platform.<\\/p><\\/td><\\/tr><tr><td align=\\"center\\" style=\\"padding: 10px 0 25px 0;\\"><table border=\\"0\\" cellpadding=\\"0\\" cellspacing=\\"0\\"><tbody><tr><td align=\\"center\\" bgcolor=\\"#ed8e20\\" style=\\"border-radius: 5px;\\"><a href=\\"{dashboard_link}\\" style=\\"font-size: 18px; font-family: Open Sans, Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; border-radius: 5px; background-color: #ed8e20; padding: 15px 30px; border: 1px solid #ed8e20; display: block;\\" target=\\"_blank\\">Visit your Dashboard<\\/a><\\/td><\\/tr><\\/tbody><\\/table><\\/td><\\/tr><\\/tbody><\\/table>","database":"<p>Welcome to <strong>Laraship<\\/strong> and thanks for registration! hope you find what you are looking for in <em>our platform<\\/em>.<\\/p>"}', NULL, '["mail","database"]', 0, 0, NULL, '2018-12-02 13:55:05', '2018-12-02 13:55:05'),
	(2, 'notifications.user.confirmation', 'New user email confirmation', 'Email confirmation', '{"mail":"<table align=\\"center\\" border=\\"0\\" cellpadding=\\"0\\" cellspacing=\\"0\\" style=\\"max-width:600px;\\" width=\\"100%\\"> <tbody> <tr> <td align=\\"left\\" style=\\"font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-bottom: 15px;\\"> <p style=\\"font-size: 18px; font-weight: 800; line-height: 24px; color: #333333;\\">Hello {name},<\\/p><p style=\\"font-size: 16px; font-weight: 400; line-height: 24px; color: #777777;\\"> Please confirm your email address in order to access corals website. Click on the button below to confirm your email. <\\/p><\\/td><\\/tr><tr> <td align=\\"center\\" style=\\"padding: 10px 0 25px 0;\\"> <table border=\\"0\\" cellpadding=\\"0\\" cellspacing=\\"0\\"> <tbody> <tr> <td align=\\"center\\" bgcolor=\\"#ed8e20\\" style=\\"border-radius: 5px;\\"> <a href=\\"{confirmation_link}\\" style=\\"font-size: 18px; font-family: Open Sans, Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; border-radius: 5px; background-color: #ed8e20; padding: 15px 30px; border: 1px solid #ed8e20; display: block;\\" target=\\"_blank\\"> Confirm now <\\/a> <\\/td><\\/tr><\\/tbody> <\\/table> <\\/td><\\/tr><\\/tbody><\\/table>"}', NULL, '["mail"]', 0, 0, NULL, '2018-12-02 13:55:05', '2018-12-02 13:55:05');
/*!40000 ALTER TABLE `notification_templates` ENABLE KEYS */;

-- Dumping structure for table alrabeh.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table alrabeh.password_resets: ~0 rows (approximately)
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Dumping structure for table alrabeh.permissions
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=124 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table alrabeh.permissions: ~123 rows (approximately)
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
	(1, 'Activity::activity.view', 'web', '2018-12-02 13:55:04', '2018-12-02 13:55:04'),
	(2, 'Activity::activity.delete', 'web', '2018-12-02 13:55:04', '2018-12-02 13:55:04'),
	(3, 'Settings::setting.view', 'web', '2018-12-02 13:55:04', '2018-12-02 13:55:04'),
	(4, 'Settings::setting.create', 'web', '2018-12-02 13:55:04', '2018-12-02 13:55:04'),
	(5, 'Settings::setting.update', 'web', '2018-12-02 13:55:04', '2018-12-02 13:55:04'),
	(6, 'Settings::setting.delete', 'web', '2018-12-02 13:55:04', '2018-12-02 13:55:04'),
	(7, 'Settings::custom_field_setting.view', 'web', '2018-12-02 13:55:04', '2018-12-02 13:55:04'),
	(8, 'Settings::custom_field_setting.create', 'web', '2018-12-02 13:55:04', '2018-12-02 13:55:04'),
	(9, 'Settings::custom_field_setting.update', 'web', '2018-12-02 13:55:04', '2018-12-02 13:55:04'),
	(10, 'Settings::custom_field_setting.delete', 'web', '2018-12-02 13:55:04', '2018-12-02 13:55:04'),
	(11, 'Settings::module.manage', 'web', '2018-12-02 13:55:04', '2018-12-02 13:55:04'),
	(12, 'Settings::theme.manage', 'web', '2018-12-02 13:55:04', '2018-12-02 13:55:04'),
	(13, 'User::user.view', 'web', '2018-12-02 13:55:04', '2018-12-02 13:55:04'),
	(14, 'User::user.create', 'web', '2018-12-02 13:55:04', '2018-12-02 13:55:04'),
	(15, 'User::user.update', 'web', '2018-12-02 13:55:04', '2018-12-02 13:55:04'),
	(16, 'User::user.delete', 'web', '2018-12-02 13:55:04', '2018-12-02 13:55:04'),
	(17, 'User::role.view', 'web', '2018-12-02 13:55:04', '2018-12-02 13:55:04'),
	(18, 'User::role.create', 'web', '2018-12-02 13:55:04', '2018-12-02 13:55:04'),
	(19, 'User::role.update', 'web', '2018-12-02 13:55:04', '2018-12-02 13:55:04'),
	(20, 'User::role.delete', 'web', '2018-12-02 13:55:04', '2018-12-02 13:55:04'),
	(21, 'User::user.view_dashboard', 'web', '2018-12-02 13:55:04', '2018-12-02 13:55:04'),
	(22, 'Notification::notification_template.view', 'web', '2018-12-02 13:55:05', '2018-12-02 13:55:05'),
	(23, 'Notification::notification_template.create', 'web', '2018-12-02 13:55:05', '2018-12-02 13:55:05'),
	(24, 'Notification::notification_template.update', 'web', '2018-12-02 13:55:05', '2018-12-02 13:55:05'),
	(25, 'Notification::notification_template.delete', 'web', '2018-12-02 13:55:05', '2018-12-02 13:55:05'),
	(26, 'Notification::my_notification.view', 'web', '2018-12-02 13:55:05', '2018-12-02 13:55:05'),
	(27, 'Notification::my_notification.update', 'web', '2018-12-02 13:55:05', '2018-12-02 13:55:05'),
	(28, 'Notification::my_notification.delete', 'web', '2018-12-02 13:55:05', '2018-12-02 13:55:05'),
	(29, 'Menu::menu.view', 'web', '2018-12-02 13:55:06', '2018-12-02 13:55:06'),
	(30, 'Menu::menu.create', 'web', '2018-12-02 13:55:06', '2018-12-02 13:55:06'),
	(31, 'Menu::menu.update', 'web', '2018-12-02 13:55:06', '2018-12-02 13:55:06'),
	(32, 'Menu::menu.delete', 'web', '2018-12-02 13:55:06', '2018-12-02 13:55:06'),
	(33, 'Utility::rating.create', 'web', '2018-12-02 14:03:15', '2018-12-02 14:03:15'),
	(34, 'Utility::my_wishlist.access', 'web', '2018-12-02 14:03:15', '2018-12-02 14:03:15'),
	(35, 'Utility::location.view', 'web', '2018-12-02 14:03:15', '2018-12-02 14:03:15'),
	(36, 'Utility::location.create', 'web', '2018-12-02 14:03:15', '2018-12-02 14:03:15'),
	(37, 'Utility::location.update', 'web', '2018-12-02 14:03:15', '2018-12-02 14:03:15'),
	(38, 'Utility::location.delete', 'web', '2018-12-02 14:03:15', '2018-12-02 14:03:15'),
	(39, 'Utility::tag.view', 'web', '2018-12-02 14:03:15', '2018-12-02 14:03:15'),
	(40, 'Utility::tag.create', 'web', '2018-12-02 14:03:15', '2018-12-02 14:03:15'),
	(41, 'Utility::tag.update', 'web', '2018-12-02 14:03:15', '2018-12-02 14:03:15'),
	(42, 'Utility::tag.delete', 'web', '2018-12-02 14:03:15', '2018-12-02 14:03:15'),
	(43, 'Utility::category.view', 'web', '2018-12-02 14:03:15', '2018-12-02 14:03:15'),
	(44, 'Utility::category.create', 'web', '2018-12-02 14:03:15', '2018-12-02 14:03:15'),
	(45, 'Utility::category.update', 'web', '2018-12-02 14:03:15', '2018-12-02 14:03:15'),
	(46, 'Utility::category.delete', 'web', '2018-12-02 14:03:15', '2018-12-02 14:03:15'),
	(47, 'Utility::attribute.view', 'web', '2018-12-02 14:03:15', '2018-12-02 14:03:15'),
	(48, 'Utility::attribute.create', 'web', '2018-12-02 14:03:15', '2018-12-02 14:03:15'),
	(49, 'Utility::attribute.update', 'web', '2018-12-02 14:03:15', '2018-12-02 14:03:15'),
	(50, 'Utility::attribute.delete', 'web', '2018-12-02 14:03:15', '2018-12-02 14:03:15'),
	(51, 'LMS::course.view', 'web', '2018-12-02 14:10:44', '2018-12-02 14:10:44'),
	(52, 'LMS::course.create', 'web', '2018-12-02 14:10:44', '2018-12-02 14:10:44'),
	(53, 'LMS::course.update', 'web', '2018-12-02 14:10:44', '2018-12-02 14:10:44'),
	(54, 'LMS::course.delete', 'web', '2018-12-02 14:10:44', '2018-12-02 14:10:44'),
	(55, 'LMS::quiz.view', 'web', '2018-12-02 14:10:44', '2018-12-02 14:10:44'),
	(56, 'LMS::quiz.create', 'web', '2018-12-02 14:10:44', '2018-12-02 14:10:44'),
	(57, 'LMS::quiz.update', 'web', '2018-12-02 14:10:44', '2018-12-02 14:10:44'),
	(58, 'LMS::quiz.delete', 'web', '2018-12-02 14:10:44', '2018-12-02 14:10:44'),
	(59, 'LMS::question.view', 'web', '2018-12-02 14:10:44', '2018-12-02 14:10:44'),
	(60, 'LMS::question.create', 'web', '2018-12-02 14:10:44', '2018-12-02 14:10:44'),
	(61, 'LMS::question.update', 'web', '2018-12-02 14:10:44', '2018-12-02 14:10:44'),
	(62, 'LMS::question.delete', 'web', '2018-12-02 14:10:44', '2018-12-02 14:10:44'),
	(63, 'LMS::category.view', 'web', '2018-12-02 14:10:44', '2018-12-02 14:10:44'),
	(64, 'LMS::category.create', 'web', '2018-12-02 14:10:44', '2018-12-02 14:10:44'),
	(65, 'LMS::category.update', 'web', '2018-12-02 14:10:44', '2018-12-02 14:10:44'),
	(66, 'LMS::category.delete', 'web', '2018-12-02 14:10:44', '2018-12-02 14:10:44'),
	(67, 'LMS::tag.view', 'web', '2018-12-02 14:10:44', '2018-12-02 14:10:44'),
	(68, 'LMS::tag.create', 'web', '2018-12-02 14:10:44', '2018-12-02 14:10:44'),
	(69, 'LMS::tag.update', 'web', '2018-12-02 14:10:44', '2018-12-02 14:10:44'),
	(70, 'LMS::tag.delete', 'web', '2018-12-02 14:10:44', '2018-12-02 14:10:44'),
	(71, 'LMS::lesson.view', 'web', '2018-12-02 14:10:44', '2018-12-02 14:10:44'),
	(72, 'LMS::lesson.create', 'web', '2018-12-02 14:10:44', '2018-12-02 14:10:44'),
	(73, 'LMS::lesson.update', 'web', '2018-12-02 14:10:44', '2018-12-02 14:10:44'),
	(74, 'LMS::lesson.delete', 'web', '2018-12-02 14:10:44', '2018-12-02 14:10:44'),
	(75, 'LMS::coupon.view', 'web', '2018-12-02 14:10:44', '2018-12-02 14:10:44'),
	(76, 'LMS::coupon.create', 'web', '2018-12-02 14:10:44', '2018-12-02 14:10:44'),
	(77, 'LMS::coupon.update', 'web', '2018-12-02 14:10:44', '2018-12-02 14:10:44'),
	(78, 'LMS::coupon.delete', 'web', '2018-12-02 14:10:44', '2018-12-02 14:10:44'),
	(79, 'LMS::invoice.view', 'web', '2018-12-02 14:10:44', '2018-12-02 14:10:44'),
	(80, 'LMS::invoice.create', 'web', '2018-12-02 14:10:44', '2018-12-02 14:10:44'),
	(81, 'LMS::invoice.update', 'web', '2018-12-02 14:10:44', '2018-12-02 14:10:44'),
	(82, 'LMS::invoice.delete', 'web', '2018-12-02 14:10:44', '2018-12-02 14:10:44'),
	(83, 'LMS::plan.view', 'web', '2018-12-02 14:10:44', '2018-12-02 14:10:44'),
	(84, 'LMS::plan.create', 'web', '2018-12-02 14:10:44', '2018-12-02 14:10:44'),
	(85, 'LMS::plan.update', 'web', '2018-12-02 14:10:44', '2018-12-02 14:10:44'),
	(86, 'LMS::plan.delete', 'web', '2018-12-02 14:10:44', '2018-12-02 14:10:44'),
	(87, 'LMS::subscription.view', 'web', '2018-12-02 14:10:44', '2018-12-02 14:10:44'),
	(88, 'LMS::subscription.create', 'web', '2018-12-02 14:10:44', '2018-12-02 14:10:44'),
	(89, 'LMS::subscription.update', 'web', '2018-12-02 14:10:44', '2018-12-02 14:10:44'),
	(90, 'LMS::subscription.delete', 'web', '2018-12-02 14:10:44', '2018-12-02 14:10:44'),
	(91, 'LMS::logs.view', 'web', '2018-12-02 14:10:44', '2018-12-02 14:10:44'),
	(92, 'LMS::logs.create', 'web', '2018-12-02 14:10:44', '2018-12-02 14:10:44'),
	(93, 'LMS::logs.update', 'web', '2018-12-02 14:10:44', '2018-12-02 14:10:44'),
	(94, 'LMS::Logs.delete', 'web', '2018-12-02 14:10:44', '2018-12-02 14:10:44'),
	(95, 'CMS::post.view', 'web', '2018-12-02 14:11:26', '2018-12-02 14:11:26'),
	(96, 'CMS::post.create', 'web', '2018-12-02 14:11:26', '2018-12-02 14:11:26'),
	(97, 'CMS::post.update', 'web', '2018-12-02 14:11:26', '2018-12-02 14:11:26'),
	(98, 'CMS::post.delete', 'web', '2018-12-02 14:11:26', '2018-12-02 14:11:26'),
	(99, 'CMS::page.view', 'web', '2018-12-02 14:11:26', '2018-12-02 14:11:26'),
	(100, 'CMS::page.create', 'web', '2018-12-02 14:11:26', '2018-12-02 14:11:26'),
	(101, 'CMS::page.update', 'web', '2018-12-02 14:11:26', '2018-12-02 14:11:26'),
	(102, 'CMS::page.delete', 'web', '2018-12-02 14:11:26', '2018-12-02 14:11:26'),
	(103, 'CMS::category.view', 'web', '2018-12-02 14:11:26', '2018-12-02 14:11:26'),
	(104, 'CMS::category.create', 'web', '2018-12-02 14:11:26', '2018-12-02 14:11:26'),
	(105, 'CMS::category.update', 'web', '2018-12-02 14:11:26', '2018-12-02 14:11:26'),
	(106, 'CMS::category.delete', 'web', '2018-12-02 14:11:26', '2018-12-02 14:11:26'),
	(107, 'CMS::news.view', 'web', '2018-12-02 14:11:26', '2018-12-02 14:11:26'),
	(108, 'CMS::news.create', 'web', '2018-12-02 14:11:26', '2018-12-02 14:11:26'),
	(109, 'CMS::news.update', 'web', '2018-12-02 14:11:26', '2018-12-02 14:11:26'),
	(110, 'CMS::news.delete', 'web', '2018-12-02 14:11:26', '2018-12-02 14:11:26'),
	(111, 'FormBuilder::form.view', 'web', '2018-12-02 14:11:46', '2018-12-02 14:11:46'),
	(112, 'FormBuilder::form.access_all_forms', 'web', '2018-12-02 14:11:46', '2018-12-02 14:11:46'),
	(113, 'FormBuilder::form.create', 'web', '2018-12-02 14:11:46', '2018-12-02 14:11:46'),
	(114, 'FormBuilder::form.update', 'web', '2018-12-02 14:11:46', '2018-12-02 14:11:46'),
	(115, 'FormBuilder::form.delete', 'web', '2018-12-02 14:11:46', '2018-12-02 14:11:46'),
	(116, 'FormBuilder::form.action_email', 'web', '2018-12-02 14:11:46', '2018-12-02 14:11:46'),
	(117, 'FormBuilder::form.action_api', 'web', '2018-12-02 14:11:46', '2018-12-02 14:11:46'),
	(118, 'FormBuilder::form.action_database', 'web', '2018-12-02 14:11:46', '2018-12-02 14:11:46'),
	(119, 'FormBuilder::form.action_aweber', 'web', '2018-12-02 14:11:46', '2018-12-02 14:11:46'),
	(120, 'FormBuilder::form.action_mailchimp', 'web', '2018-12-02 14:11:46', '2018-12-02 14:11:46'),
	(121, 'FormBuilder::form.action_constant_contact', 'web', '2018-12-02 14:11:46', '2018-12-02 14:11:46'),
	(122, 'FormBuilder::form.action_get_response', 'web', '2018-12-02 14:11:46', '2018-12-02 14:11:46'),
	(123, 'FormBuilder::form.action_covert_commissions', 'web', '2018-12-02 14:11:46', '2018-12-02 14:11:46');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;

-- Dumping structure for table alrabeh.plans
CREATE TABLE IF NOT EXISTS `plans` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `price` decimal(8,2) NOT NULL DEFAULT 0.00,
  `signup_fee` decimal(8,2) NOT NULL DEFAULT 0.00,
  `currency` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `trial_period` smallint(5) unsigned NOT NULL DEFAULT 0,
  `trial_interval` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'day',
  `invoice_period` smallint(5) unsigned NOT NULL DEFAULT 0,
  `invoice_interval` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'month',
  `grace_period` smallint(5) unsigned NOT NULL DEFAULT 0,
  `grace_interval` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'day',
  `prorate_day` tinyint(3) unsigned DEFAULT NULL,
  `prorate_period` tinyint(3) unsigned DEFAULT NULL,
  `prorate_extend_due` tinyint(3) unsigned DEFAULT NULL,
  `active_subscribers_limit` smallint(5) unsigned DEFAULT NULL,
  `sort_order` mediumint(8) unsigned NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `plans_slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table alrabeh.plans: ~0 rows (approximately)
/*!40000 ALTER TABLE `plans` DISABLE KEYS */;
/*!40000 ALTER TABLE `plans` ENABLE KEYS */;

-- Dumping structure for table alrabeh.plan_features
CREATE TABLE IF NOT EXISTS `plan_features` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `plan_id` int(10) unsigned NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `resettable_period` smallint(5) unsigned NOT NULL DEFAULT 0,
  `resettable_interval` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'month',
  `sort_order` mediumint(8) unsigned NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `plan_features_plan_id_slug_unique` (`plan_id`,`slug`),
  CONSTRAINT `plan_features_plan_id_foreign` FOREIGN KEY (`plan_id`) REFERENCES `plans` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table alrabeh.plan_features: ~0 rows (approximately)
/*!40000 ALTER TABLE `plan_features` DISABLE KEYS */;
/*!40000 ALTER TABLE `plan_features` ENABLE KEYS */;

-- Dumping structure for table alrabeh.plan_subscriptions
CREATE TABLE IF NOT EXISTS `plan_subscriptions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `plan_id` int(10) unsigned NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trial_ends_at` datetime DEFAULT NULL,
  `starts_at` datetime DEFAULT NULL,
  `ends_at` datetime DEFAULT NULL,
  `cancels_at` datetime DEFAULT NULL,
  `canceled_at` datetime DEFAULT NULL,
  `timezone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `plan_subscriptions_slug_unique` (`slug`),
  KEY `plan_subscriptions_user_type_user_id_index` (`user_type`,`user_id`),
  KEY `plan_subscriptions_plan_id_foreign` (`plan_id`),
  CONSTRAINT `plan_subscriptions_plan_id_foreign` FOREIGN KEY (`plan_id`) REFERENCES `plans` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table alrabeh.plan_subscriptions: ~0 rows (approximately)
/*!40000 ALTER TABLE `plan_subscriptions` DISABLE KEYS */;
/*!40000 ALTER TABLE `plan_subscriptions` ENABLE KEYS */;

-- Dumping structure for table alrabeh.plan_subscription_usage
CREATE TABLE IF NOT EXISTS `plan_subscription_usage` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `subscription_id` int(10) unsigned NOT NULL,
  `feature_id` int(10) unsigned NOT NULL,
  `used` smallint(5) unsigned NOT NULL,
  `valid_until` datetime DEFAULT NULL,
  `timezone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `plan_subscription_usage_subscription_id_feature_id_unique` (`subscription_id`,`feature_id`),
  KEY `plan_subscription_usage_feature_id_foreign` (`feature_id`),
  CONSTRAINT `plan_subscription_usage_feature_id_foreign` FOREIGN KEY (`feature_id`) REFERENCES `plan_features` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `plan_subscription_usage_subscription_id_foreign` FOREIGN KEY (`subscription_id`) REFERENCES `plan_subscriptions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table alrabeh.plan_subscription_usage: ~0 rows (approximately)
/*!40000 ALTER TABLE `plan_subscription_usage` DISABLE KEYS */;
/*!40000 ALTER TABLE `plan_subscription_usage` ENABLE KEYS */;

-- Dumping structure for table alrabeh.postables
CREATE TABLE IF NOT EXISTS `postables` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `content_id` int(11) NOT NULL,
  `postable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `postable_id` bigint(20) unsigned NOT NULL,
  `sourcable_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sourcable_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `postables_postable_type_postable_id_index` (`postable_type`,`postable_id`),
  KEY `postables_sourcable_type_sourcable_id_index` (`sourcable_type`,`sourcable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table alrabeh.postables: ~0 rows (approximately)
/*!40000 ALTER TABLE `postables` DISABLE KEYS */;
/*!40000 ALTER TABLE `postables` ENABLE KEYS */;

-- Dumping structure for table alrabeh.posts
CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_keywords` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `published` tinyint(1) NOT NULL DEFAULT 0,
  `published_at` datetime DEFAULT NULL,
  `private` tinyint(1) NOT NULL DEFAULT 0,
  `internal` tinyint(1) NOT NULL DEFAULT 0,
  `type` enum('post','page','news') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'post',
  `template` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `featured_image_link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `extras` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `author_id` int(10) unsigned DEFAULT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `posts_slug_unique` (`slug`),
  KEY `posts_created_by_index` (`created_by`),
  KEY `posts_updated_by_index` (`updated_by`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table alrabeh.posts: ~5 rows (approximately)
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` (`id`, `title`, `slug`, `meta_keywords`, `meta_description`, `content`, `published`, `published_at`, `private`, `internal`, `type`, `template`, `featured_image_link`, `extras`, `author_id`, `created_by`, `updated_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(1, 'الرئيسية', 'home', NULL, NULL, NULL, 1, '2018-12-02 14:17:02', 0, 0, 'page', 'home', NULL, NULL, 1, 1, 1, NULL, '2018-12-02 14:17:02', '2018-12-02 14:17:02'),
	(2, 'اتصل بنا', 'contact-us', NULL, NULL, '<p><b id="shortcode_1">@form(contact-us)</b></p>', 1, '2018-12-02 14:19:19', 0, 0, 'page', 'contact-us', NULL, NULL, 1, 1, 1, NULL, '2018-12-02 14:18:30', '2018-12-02 14:19:19'),
	(3, 'من نحن', 'about-us', NULL, NULL, NULL, 1, '2018-12-02 14:26:09', 0, 0, 'page', 'about-us', NULL, NULL, 1, 1, 1, NULL, '2018-12-02 14:24:02', '2018-12-02 14:26:09'),
	(4, 'الدفع', 'info-payment', NULL, NULL, '<p>هنا نكتب معلومات وطريقة الدفع</p>', 1, '2018-12-02 14:28:58', 0, 0, 'page', 'about-us', NULL, NULL, 1, 1, 1, NULL, '2018-12-02 14:28:58', '2018-12-02 14:28:58'),
	(5, 'المدونة', 'blog', NULL, NULL, NULL, 1, '2018-12-02 14:34:10', 0, 0, 'page', NULL, NULL, NULL, 1, 1, 1, NULL, '2018-12-02 14:34:10', '2018-12-02 14:34:10');
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;

-- Dumping structure for table alrabeh.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `label` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subscription_required` tinyint(1) NOT NULL DEFAULT 0,
  `disable_login` tinyint(1) NOT NULL DEFAULT 0,
  `redirect_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dashboard_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dashboard_theme` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`),
  KEY `roles_created_by_index` (`created_by`),
  KEY `roles_updated_by_index` (`updated_by`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table alrabeh.roles: ~2 rows (approximately)
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` (`id`, `name`, `label`, `subscription_required`, `disable_login`, `redirect_url`, `dashboard_url`, `dashboard_theme`, `guard_name`, `created_by`, `updated_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(1, 'superuser', 'Super User', 0, 0, NULL, NULL, NULL, 'web', NULL, NULL, NULL, '2018-12-02 13:55:05', '2018-12-02 13:55:05'),
	(2, 'member', 'Member', 1, 0, NULL, NULL, NULL, 'web', NULL, NULL, NULL, '2018-12-02 13:55:05', '2018-12-02 13:55:05');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;

-- Dumping structure for table alrabeh.role_has_permissions
CREATE TABLE IF NOT EXISTS `role_has_permissions` (
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table alrabeh.role_has_permissions: ~6 rows (approximately)
/*!40000 ALTER TABLE `role_has_permissions` DISABLE KEYS */;
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
	(26, 2),
	(27, 2),
	(28, 2),
	(33, 2),
	(34, 2),
	(47, 2);
/*!40000 ALTER TABLE `role_has_permissions` ENABLE KEYS */;

-- Dumping structure for table alrabeh.settings
CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('BOOLEAN','NUMBER','DATE','TEXT','SELECT','FILE','TEXTAREA') COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'General',
  `label` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `editable` tinyint(1) NOT NULL DEFAULT 1,
  `hidden` tinyint(1) NOT NULL DEFAULT 0,
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `settings_code_unique` (`code`),
  KEY `settings_created_by_index` (`created_by`),
  KEY `settings_updated_by_index` (`updated_by`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table alrabeh.settings: ~53 rows (approximately)
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` (`id`, `code`, `type`, `category`, `label`, `value`, `editable`, `hidden`, `created_by`, `updated_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(1, 'site_name', 'TEXT', 'General', 'Site Name', 'Modules', 1, 0, NULL, NULL, NULL, '2018-12-02 13:55:04', '2018-12-02 13:55:04'),
	(2, 'super_user_id', 'NUMBER', 'General', 'Super user id', '1', 0, 1, NULL, NULL, NULL, '2018-12-02 13:55:04', '2018-12-02 13:55:04'),
	(3, 'super_user_role_id', 'NUMBER', 'General', 'Super user role id', '1', 0, 1, NULL, NULL, NULL, '2018-12-02 13:55:04', '2018-12-02 13:55:04'),
	(4, 'default_user_role', 'TEXT', 'User', 'Default User Role', 'Member', 1, 0, NULL, NULL, NULL, '2018-12-02 13:55:04', '2018-12-02 13:55:04'),
	(5, 'social_links', 'SELECT', 'General', 'Social Links', '{"facebook":"https:\\/\\/www.facebook.com","twitter":"https:\\/\\/twitter.com","linkedin":"https:\\/\\/www.linkedin.com\\/","instagram":"https:\\/\\/www.instagram.com\\/","pinterest":"https:\\/\\/www.pinterest.com\\/"}', 1, 0, NULL, 1, NULL, '2018-12-02 13:55:04', '2018-12-02 14:32:38'),
	(6, 'twitter_id', 'TEXT', 'General', 'twitter_id', 'corals_laraship', 1, 0, NULL, NULL, NULL, '2018-12-02 13:55:04', '2018-12-02 13:55:04'),
	(7, 'footer_text', 'TEXTAREA', 'General', 'Footer Text', '&copy; 2018 <a target="_blank" href="http://developnet.net/"\r\n                               title="Developnet.net">Developnet.net</a>.\r\n                All Rights Reserved.', 1, 0, NULL, NULL, NULL, '2018-12-02 13:55:04', '2018-12-02 13:55:04'),
	(8, 'terms_and_policy', 'TEXTAREA', 'General', 'Terms and Policy Text', '<p>\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Duis iaculis ante eget urna tincidunt, sed tristique velit fermentum. Vivamus viverra urna sed quam semper feugiat. Mauris accumsan imperdiet metus, vitae porttitor mi egestas sit amet. Duis a nibh quam. Sed sit amet purus fringilla, auctor tellus et, consectetur libero. Nullam non orci tristique, sollicitudin magna sed, convallis est. Aenean fermentum arcu aliquet purus placerat, ut aliquam libero commodo. Pellentesque tortor purus, gravida rhoncus porttitor in, pulvinar eu mi. Sed vitae consectetur justo.\r\n</p>\r\n<p>\r\nAliquam aliquam, elit ac malesuada blandit, nulla ligula posuere nisl, non mattis arcu eros et enim. Proin dapibus erat sit amet egestas egestas. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Duis vulputate tortor a massa porttitor, sit amet posuere mi pharetra. Cras efficitur lobortis condimentum. Vivamus dapibus cursus eros bibendum finibus. Donec rhoncus libero a sem volutpat, ut mattis orci sollicitudin. Pellentesque malesuada metus quis ullamcorper vestibulum. Aenean erat dui, elementum finibus ligula vitae, feugiat placerat tellus. Cras placerat in dolor in iaculis. Suspendisse tempor gravida vehicula. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi odio urna, lobortis sed euismod eget, semper sed lorem.\r\n</p>', 1, 0, NULL, NULL, NULL, '2018-12-02 13:55:04', '2018-12-02 13:55:04'),
	(9, 'site_logo', 'FILE', 'General', 'Site Logo', '1543762250-Alrabeh-white.png', 1, 0, NULL, 1, NULL, '2018-12-02 13:55:04', '2018-12-02 14:50:50'),
	(10, 'site_logo_dark', 'FILE', 'General', 'Site Dark Logo', '1543762281-Alrabeh.png', 1, 0, NULL, 1, NULL, '2018-12-02 13:55:04', '2018-12-02 14:51:21'),
	(11, 'site_favicon', 'FILE', 'General', 'Site favicon', '1543762307-Alrabeh.png', 1, 0, NULL, 1, NULL, '2018-12-02 13:55:04', '2018-12-02 14:51:47'),
	(12, 'login_background', 'TEXTAREA', 'General', 'Login Background', 'background: url(/media/demo/login_backgrounds/login_background.png);\r\nbackground-repeat: repeat-y;\r\nbackground-size: 100% auto;\r\nbackground-position: center top;\r\nbackground-attachment: fixed;', 1, 0, NULL, NULL, NULL, '2018-12-02 13:55:04', '2018-12-02 13:55:04'),
	(13, 'google_map_url', 'TEXT', 'General', 'Google Map URL', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3387.331591494841!2d35.19981536504809!3d31.897586781246385!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x518201279a8595!2sLeaders!5e0!3m2!1sen!2s!4v1512481232226', 1, 0, NULL, NULL, NULL, '2018-12-02 13:55:04', '2018-12-02 13:55:04'),
	(14, 'contact_form_email', 'TEXT', 'General', 'Contact Email', 'support@developnet.net', 1, 0, NULL, NULL, NULL, '2018-12-02 13:55:04', '2018-12-02 13:55:04'),
	(15, 'google_analytics_id', 'TEXT', 'General', 'Google Analytics Id', 'UA-76211720-1', 1, 0, NULL, NULL, NULL, '2018-12-02 13:55:04', '2018-12-02 13:55:04'),
	(16, 'active_admin_theme', 'TEXT', 'Theme', 'Active admin theme', 'corals-admin', 1, 1, NULL, NULL, NULL, '2018-12-02 13:55:04', '2018-12-02 13:55:04'),
	(17, 'active_frontend_theme', 'TEXT', 'Theme', 'Active frontend theme', 'developnet-lms', 1, 1, NULL, 1, NULL, '2018-12-02 13:55:04', '2018-12-02 14:16:05'),
	(18, 'two_factor_auth_enabled', 'BOOLEAN', 'User', 'Two factor auth enabled?', 'false', 1, 0, NULL, NULL, NULL, '2018-12-02 13:55:04', '2018-12-02 13:55:04'),
	(19, 'two_factor_auth_provider', 'TEXT', 'User', 'Two factor auth provider?', '', 1, 0, NULL, NULL, NULL, '2018-12-02 13:55:04', '2018-12-02 13:55:04'),
	(20, 'address_types', 'SELECT', 'User', 'Address Types', '{"home":"Home","office":"Office","shipping":"Shipping","billing":"Billing"}', 1, 0, NULL, NULL, NULL, '2018-12-02 13:55:04', '2018-12-02 13:55:04'),
	(21, 'custom_js', 'TEXTAREA', 'Theme', 'Custom JS', '', 1, 0, NULL, NULL, NULL, '2018-12-02 13:55:04', '2018-12-02 13:55:04'),
	(22, 'custom_css', 'TEXTAREA', 'Theme', 'Custom CSS', '', 1, 0, NULL, NULL, NULL, '2018-12-02 13:55:04', '2018-12-02 13:55:04'),
	(23, 'custom_admin_js', 'TEXTAREA', 'Theme', 'Custom Admin JS', '', 1, 0, NULL, NULL, NULL, '2018-12-02 13:55:04', '2018-12-02 13:55:04'),
	(24, 'custom_admin_css', 'TEXTAREA', 'Theme', 'Custom Admin CSS', '', 1, 0, NULL, NULL, NULL, '2018-12-02 13:55:04', '2018-12-02 13:55:04'),
	(25, 'supported_languages', 'SELECT', 'General', 'Supported system languages', '{"ar":"Arabic"}', 1, 0, NULL, 1, NULL, '2018-12-02 13:55:04', '2018-12-02 14:30:19'),
	(26, 'confirm_user_registration_email', 'BOOLEAN', 'User', 'Confirm email on registration?', 'false', 1, 0, NULL, NULL, NULL, '2018-12-02 13:55:05', '2018-12-02 13:55:05'),
	(27, 'cookie_consent', 'BOOLEAN', 'User', 'Enable Cookie Consent', 'false', 1, 0, NULL, NULL, NULL, '2018-12-02 13:55:05', '2018-12-02 13:55:05'),
	(28, 'cookie_consent_config', 'TEXTAREA', 'User', 'Cookie Consent Configuration', '{\r\n                        type: "opt-in",\r\n                        position: "bottom",\r\n                        palette: { "popup": { "background": "#252e39" }, "button": { "background": "#14a7d0", padding: "5px 50px" } }\r\n            \r\n                    }', 1, 0, NULL, NULL, NULL, '2018-12-02 13:55:05', '2018-12-02 13:55:05'),
	(29, 'utility_google_address_api_key', 'TEXT', 'Utilities', 'Google address api key', 'AIzaSyBrMjtZWqBiHz1Nr9XZTTbBLjvYFICPHDM', 1, 0, NULL, NULL, NULL, '2018-12-02 14:03:16', '2018-12-02 14:03:16'),
	(30, 'utility_mailchimp_api_key', 'TEXT', 'Utilities', 'Mailchimp API Key', '', 1, 0, NULL, NULL, NULL, '2018-12-02 14:03:16', '2018-12-02 14:03:16'),
	(31, 'utility_mailchimp_list_id', 'TEXT', 'Utilities', 'Mailchimp List Id', '', 1, 0, NULL, NULL, NULL, '2018-12-02 14:03:16', '2018-12-02 14:03:16'),
	(32, 'utility_schedule_time', 'SELECT', 'Utilities', 'Schedule Time', '{"Off":"- Off -","06":"06 AM","07":"07 AM"}', 1, 0, NULL, NULL, NULL, '2018-12-02 14:03:16', '2018-12-02 14:03:16'),
	(33, 'utility_days_of_the_week', 'SELECT', 'Utilities', 'Days of the week', '{"Mon":"Mon","Tue":"Tue","Wed":"Wed","Thu":"Thu","Fri":"Fri","Sat":"Sat","Sun":"Sun"}', 1, 0, NULL, NULL, NULL, '2018-12-02 14:03:16', '2018-12-02 14:03:16'),
	(34, 'site_contact_phone', 'TEXT', 'General', 'Site contact phone', '(+996) 054444444', 1, 0, NULL, NULL, NULL, '2018-12-02 14:10:45', '2018-12-02 14:10:45'),
	(35, 'site_url', 'TEXT', 'General', 'Site URL', 'http://localhost', 1, 0, NULL, NULL, NULL, '2018-12-02 14:10:45', '2018-12-02 14:10:45'),
	(36, 'home_page_background', 'FILE', 'HomePage', 'Home Page Background', '1543761938-blackboard-pencils-apple.jpg', 1, 0, NULL, 1, NULL, '2018-12-02 14:10:45', '2018-12-02 14:45:38'),
	(37, 'office_address', 'TEXT', 'General', 'Office Address', '', 1, 0, NULL, NULL, NULL, '2018-12-02 14:10:45', '2018-12-02 14:10:45'),
	(38, 'about_site', 'TEXTAREA', 'General', 'About Site', '', 1, 0, NULL, NULL, NULL, '2018-12-02 14:10:45', '2018-12-02 14:10:45'),
	(39, 'home_about_academy', 'TEXTAREA', 'HomePage', 'عن الأكاديمية', '<p class="p-desc mt-20">القراءة على شبكة الإنترنت. يمكنك توسيع نطاق محتوى الموقع الإلكتروني الخاص بك عبر الإنترنت من خلال خلق إصدار صوتي فوري له </p>\r\n                      <ul class="list-desc">\r\n                        <li><i class="fa fa-check"></i>القراءة على شبكة الإنترنت. يمكنك توسيع نطاق محتوى الموقع</li>\r\n                        <li><i class="fa fa-check"></i>القراءة على شبكة الإنترنت. يمكنك توسيع نطاق محتوى الموقع</li>\r\n                        <li><i class="fa fa-check"></i>القراءة على شبكة الإنترنت. يمكنك توسيع نطاق محتوى الموقع</li>\r\n                      </ul>', 1, 0, NULL, NULL, NULL, '2018-12-02 14:10:45', '2018-12-02 14:10:45'),
	(40, 'home_guide_video', 'TEXTAREA', 'HomePage', 'رابط فيديو تعريفي عن الأكاديمية', '', 1, 0, NULL, NULL, NULL, '2018-12-02 14:10:45', '2018-12-02 14:10:45'),
	(41, 'site_pages_titles', 'SELECT', 'SEO', 'Site Pages Titles', '{"general":"","home":"","user_profile":"","courses":"","packages":"","quizzes":"","exercises":"","blog":"","categories":"", "search":"", "books":""}', 1, 0, NULL, NULL, NULL, '2018-12-02 14:10:45', '2018-12-02 14:10:45'),
	(42, 'site_meta_keywords', 'SELECT', 'SEO', 'Site Meta Keywords', '{"general":"", "home":"","user_profile":"","courses":"","packages":"","quizzes":"","blog":"","categories":"", "search":"", "books":""}', 1, 0, NULL, NULL, NULL, '2018-12-02 14:10:45', '2018-12-02 14:10:45'),
	(43, 'site_meta_descriptions', 'SELECT', 'SEO', 'Site Meta Descriptions', '{"general":"","home":"","user_profile":"","courses":"","packages":"","quizzes":"","blog":"","categories":"", "search":"", "books":""}', 1, 0, NULL, NULL, NULL, '2018-12-02 14:10:45', '2018-12-02 14:10:45'),
	(44, 'site_meta_titles', 'SELECT', 'SEO', 'Site Meta Titles', '{"general":"","home":"","user_profile":"","courses":"","packages":"","quizzes":"","blog":"","categories":"", "search":"", "books":""}', 1, 0, NULL, NULL, NULL, '2018-12-02 14:10:45', '2018-12-02 14:10:45'),
	(45, 'sidebar_bannar_img', 'FILE', 'General', 'Sidebar Banner Image', '', 1, 0, NULL, NULL, NULL, '2018-12-02 14:10:45', '2018-12-02 14:10:45'),
	(46, 'sidebar_bannar_url', 'TEXT', 'General', 'Sidebar Banner URL', '#', 1, 0, NULL, NULL, NULL, '2018-12-02 14:10:45', '2018-12-02 14:10:45'),
	(47, 'home_page_slug', 'TEXT', 'CMS', 'Home page slug', 'home', 1, 0, NULL, NULL, NULL, '2018-12-02 14:11:27', '2018-12-02 14:11:27'),
	(48, 'blog_page_slug', 'TEXT', 'CMS', 'Blog page slug', 'blog', 1, 0, NULL, NULL, NULL, '2018-12-02 14:11:27', '2018-12-02 14:11:27'),
	(49, 'pricing_page_slug', 'TEXT', 'CMS', 'Pricing page slug', 'pricing', 1, 0, NULL, NULL, NULL, '2018-12-02 14:11:27', '2018-12-02 14:11:27'),
	(50, 'form_builder_aweber_consumer_key', 'TEXT', 'FormBuilder', 'form_builder_aweber_consumer_key', 'AkSuzXGUe2gHugnazR0qXQTS', 1, 1, NULL, NULL, NULL, '2018-12-02 14:11:46', '2018-12-02 14:11:46'),
	(51, 'form_builder_aweber_consumer_secret', 'TEXT', 'FormBuilder', 'form_builder_aweber_consumer_secret', 'xSO7CoYgYsVEAQokMAqI9cGy15gfHU5KzkUZhpmL', 1, 1, NULL, NULL, NULL, '2018-12-02 14:11:46', '2018-12-02 14:11:46'),
	(52, 'form_builder_aweber_access_key', 'TEXT', 'FormBuilder', 'form_builder_aweber_access_key', '', 1, 1, NULL, NULL, NULL, '2018-12-02 14:11:46', '2018-12-02 14:11:46'),
	(53, 'form_builder_aweber_access_secret', 'TEXT', 'FormBuilder', 'form_builder_aweber_access_secret', '', 1, 1, NULL, NULL, NULL, '2018-12-02 14:11:46', '2018-12-02 14:11:46');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;

-- Dumping structure for table alrabeh.social_accounts
CREATE TABLE IF NOT EXISTS `social_accounts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `provider_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `provider` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `social_accounts_user_id_foreign` (`user_id`),
  KEY `social_accounts_created_by_index` (`created_by`),
  KEY `social_accounts_updated_by_index` (`updated_by`),
  CONSTRAINT `social_accounts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table alrabeh.social_accounts: ~0 rows (approximately)
/*!40000 ALTER TABLE `social_accounts` DISABLE KEYS */;
/*!40000 ALTER TABLE `social_accounts` ENABLE KEYS */;

-- Dumping structure for table alrabeh.translatable_translations
CREATE TABLE IF NOT EXISTS `translatable_translations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `translatable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `translatable_id` int(11) NOT NULL,
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `translation` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `locale` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table alrabeh.translatable_translations: ~0 rows (approximately)
/*!40000 ALTER TABLE `translatable_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `translatable_translations` ENABLE KEYS */;

-- Dumping structure for table alrabeh.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'male',
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_teacher` tinyint(1) DEFAULT 0,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'member',
  `job_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_country_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `two_factor_options` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `integration_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gateway` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_brand` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_last_four` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trial_ends_at` timestamp NULL DEFAULT NULL,
  `payment_method_token` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `properties` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `confirmation_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `confirmed_at` datetime DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `notification_preferences` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_created_by_index` (`created_by`),
  KEY `users_updated_by_index` (`updated_by`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table alrabeh.users: ~2 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `email`, `gender`, `password`, `is_teacher`, `address`, `user_type`, `job_title`, `phone_country_code`, `phone_number`, `two_factor_options`, `integration_id`, `gateway`, `card_brand`, `card_last_four`, `trial_ends_at`, `payment_method_token`, `properties`, `confirmation_code`, `confirmed_at`, `remember_token`, `created_by`, `updated_by`, `deleted_at`, `created_at`, `updated_at`, `notification_preferences`) VALUES
	(1, 'Super User', 'superuser@developnet.net', 'male', '$2y$10$I5p1HrT0TNhDcwX8w2fTaeMUWFdgGbZzoZwcS.PEabTo62CSWRfki', 0, NULL, 'member', 'Administrator', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-12-02 13:55:06', NULL, NULL, NULL, NULL, '2018-12-02 13:55:06', '2018-12-02 13:55:06', NULL),
	(2, 'Modules Member', 'member@developnet.net', 'male', '$2y$10$dxZ2nEy1IcRbAUvvVm471.3YWP.uaxqQ2kcZdHOtpNvABwQ2wvI/u', 0, 'القاهرة', 'member', 'Ads Coordinator', '1', '01212121212121', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '{"about":null}', NULL, NULL, NULL, 0, 1, NULL, '2018-12-02 13:55:06', '2018-12-02 14:59:21', NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Dumping structure for table alrabeh.utility_attributes
CREATE TABLE IF NOT EXISTS `utility_attributes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `label` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_order` int(11) NOT NULL DEFAULT 0,
  `use_as_filter` tinyint(1) NOT NULL DEFAULT 0,
  `required` tinyint(1) NOT NULL DEFAULT 0,
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `utility_attributes_created_by_index` (`created_by`),
  KEY `utility_attributes_updated_by_index` (`updated_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table alrabeh.utility_attributes: ~0 rows (approximately)
/*!40000 ALTER TABLE `utility_attributes` DISABLE KEYS */;
/*!40000 ALTER TABLE `utility_attributes` ENABLE KEYS */;

-- Dumping structure for table alrabeh.utility_attribute_options
CREATE TABLE IF NOT EXISTS `utility_attribute_options` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `attribute_id` int(10) unsigned NOT NULL,
  `option_order` int(11) NOT NULL,
  `option_value` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `option_display` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `utility_attribute_options_attribute_id_index` (`attribute_id`),
  KEY `utility_attribute_options_created_by_index` (`created_by`),
  KEY `utility_attribute_options_updated_by_index` (`updated_by`),
  CONSTRAINT `utility_attribute_options_attribute_id_foreign` FOREIGN KEY (`attribute_id`) REFERENCES `utility_attributes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table alrabeh.utility_attribute_options: ~0 rows (approximately)
/*!40000 ALTER TABLE `utility_attribute_options` DISABLE KEYS */;
/*!40000 ALTER TABLE `utility_attribute_options` ENABLE KEYS */;

-- Dumping structure for table alrabeh.utility_categories
CREATE TABLE IF NOT EXISTS `utility_categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `module` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int(10) unsigned DEFAULT 0,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `utility_categories_name_unique` (`name`),
  UNIQUE KEY `utility_categories_slug_unique` (`slug`),
  KEY `utility_categories_created_by_index` (`created_by`),
  KEY `utility_categories_updated_by_index` (`updated_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table alrabeh.utility_categories: ~0 rows (approximately)
/*!40000 ALTER TABLE `utility_categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `utility_categories` ENABLE KEYS */;

-- Dumping structure for table alrabeh.utility_category_attributes
CREATE TABLE IF NOT EXISTS `utility_category_attributes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `attribute_id` int(10) unsigned NOT NULL,
  `category_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `utility_category_attributes_attribute_id_index` (`attribute_id`),
  KEY `utility_category_attributes_category_id_index` (`category_id`),
  CONSTRAINT `utility_category_attributes_attribute_id_foreign` FOREIGN KEY (`attribute_id`) REFERENCES `utility_attributes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `utility_category_attributes_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `utility_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table alrabeh.utility_category_attributes: ~0 rows (approximately)
/*!40000 ALTER TABLE `utility_category_attributes` DISABLE KEYS */;
/*!40000 ALTER TABLE `utility_category_attributes` ENABLE KEYS */;

-- Dumping structure for table alrabeh.utility_comments
CREATE TABLE IF NOT EXISTS `utility_comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `commentable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `commentable_id` int(10) unsigned NOT NULL,
  `parent_id` int(10) unsigned DEFAULT NULL,
  `author_id` int(10) unsigned DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `utility_comments_author_id_foreign` (`author_id`),
  KEY `utility_comments_parent_id_foreign` (`parent_id`),
  KEY `utility_comments_created_by_index` (`created_by`),
  KEY `utility_comments_updated_by_index` (`updated_by`),
  CONSTRAINT `utility_comments_author_id_foreign` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `utility_comments_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `utility_comments` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table alrabeh.utility_comments: ~0 rows (approximately)
/*!40000 ALTER TABLE `utility_comments` DISABLE KEYS */;
/*!40000 ALTER TABLE `utility_comments` ENABLE KEYS */;

-- Dumping structure for table alrabeh.utility_locations
CREATE TABLE IF NOT EXISTS `utility_locations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lat` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `long` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `module` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `utility_locations_slug_unique` (`slug`),
  KEY `utility_locations_created_by_index` (`created_by`),
  KEY `utility_locations_updated_by_index` (`updated_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table alrabeh.utility_locations: ~0 rows (approximately)
/*!40000 ALTER TABLE `utility_locations` DISABLE KEYS */;
/*!40000 ALTER TABLE `utility_locations` ENABLE KEYS */;

-- Dumping structure for table alrabeh.utility_model_attribute_options
CREATE TABLE IF NOT EXISTS `utility_model_attribute_options` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `attribute_id` int(10) unsigned DEFAULT NULL,
  `attribute_option_id` int(10) unsigned DEFAULT NULL,
  `model_id` int(10) unsigned NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `string_value` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `number_value` double DEFAULT NULL,
  `text_value` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `utility_model_attribute_options_attribute_id_index` (`attribute_id`),
  KEY `utility_model_attribute_options_attribute_option_id_index` (`attribute_option_id`),
  KEY `utility_model_attribute_options_created_by_index` (`created_by`),
  KEY `utility_model_attribute_options_updated_by_index` (`updated_by`),
  CONSTRAINT `utility_model_attribute_options_attribute_id_foreign` FOREIGN KEY (`attribute_id`) REFERENCES `utility_attributes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `utility_model_attribute_options_attribute_option_id_foreign` FOREIGN KEY (`attribute_option_id`) REFERENCES `utility_attribute_options` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table alrabeh.utility_model_attribute_options: ~0 rows (approximately)
/*!40000 ALTER TABLE `utility_model_attribute_options` DISABLE KEYS */;
/*!40000 ALTER TABLE `utility_model_attribute_options` ENABLE KEYS */;

-- Dumping structure for table alrabeh.utility_model_has_category
CREATE TABLE IF NOT EXISTS `utility_model_has_category` (
  `model_id` int(10) unsigned NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` int(10) unsigned NOT NULL,
  KEY `utility_model_has_category_category_id_foreign` (`category_id`),
  CONSTRAINT `utility_model_has_category_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `utility_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table alrabeh.utility_model_has_category: ~0 rows (approximately)
/*!40000 ALTER TABLE `utility_model_has_category` DISABLE KEYS */;
/*!40000 ALTER TABLE `utility_model_has_category` ENABLE KEYS */;

-- Dumping structure for table alrabeh.utility_ratings
CREATE TABLE IF NOT EXISTS `utility_ratings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rating` int(11) NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reviewrateable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reviewrateable_id` bigint(20) unsigned NOT NULL,
  `author_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `author_id` bigint(20) unsigned NOT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `utility_ratings_reviewrateable_type_reviewrateable_id_index` (`reviewrateable_type`,`reviewrateable_id`),
  KEY `utility_ratings_author_type_author_id_index` (`author_type`,`author_id`),
  KEY `utility_ratings_created_by_index` (`created_by`),
  KEY `utility_ratings_updated_by_index` (`updated_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table alrabeh.utility_ratings: ~0 rows (approximately)
/*!40000 ALTER TABLE `utility_ratings` DISABLE KEYS */;
/*!40000 ALTER TABLE `utility_ratings` ENABLE KEYS */;

-- Dumping structure for table alrabeh.utility_schedules
CREATE TABLE IF NOT EXISTS `utility_schedules` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `scheduleable_id` int(10) unsigned NOT NULL,
  `scheduleable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `day_of_the_week` enum('Mon','Tue','Wed','Thu','Fri','Sat','Sun') COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `utility_schedules_user_id_foreign` (`user_id`),
  KEY `utility_schedules_created_by_index` (`created_by`),
  KEY `utility_schedules_updated_by_index` (`updated_by`),
  CONSTRAINT `utility_schedules_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table alrabeh.utility_schedules: ~0 rows (approximately)
/*!40000 ALTER TABLE `utility_schedules` DISABLE KEYS */;
/*!40000 ALTER TABLE `utility_schedules` ENABLE KEYS */;

-- Dumping structure for table alrabeh.utility_taggables
CREATE TABLE IF NOT EXISTS `utility_taggables` (
  `tag_id` int(10) unsigned NOT NULL,
  `taggable_id` int(10) unsigned NOT NULL,
  `taggable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  KEY `utility_taggables_tag_id_foreign` (`tag_id`),
  CONSTRAINT `utility_taggables_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `utility_tags` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table alrabeh.utility_taggables: ~0 rows (approximately)
/*!40000 ALTER TABLE `utility_taggables` DISABLE KEYS */;
/*!40000 ALTER TABLE `utility_taggables` ENABLE KEYS */;

-- Dumping structure for table alrabeh.utility_tags
CREATE TABLE IF NOT EXISTS `utility_tags` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `module` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `utility_tags_created_by_index` (`created_by`),
  KEY `utility_tags_updated_by_index` (`updated_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table alrabeh.utility_tags: ~0 rows (approximately)
/*!40000 ALTER TABLE `utility_tags` DISABLE KEYS */;
/*!40000 ALTER TABLE `utility_tags` ENABLE KEYS */;

-- Dumping structure for table alrabeh.utility_wishlists
CREATE TABLE IF NOT EXISTS `utility_wishlists` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `wishlistable_id` int(10) unsigned NOT NULL,
  `wishlistable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `utility_wishlists_user_id_foreign` (`user_id`),
  KEY `utility_wishlists_created_by_index` (`created_by`),
  KEY `utility_wishlists_updated_by_index` (`updated_by`),
  CONSTRAINT `utility_wishlists_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table alrabeh.utility_wishlists: ~0 rows (approximately)
/*!40000 ALTER TABLE `utility_wishlists` DISABLE KEYS */;
/*!40000 ALTER TABLE `utility_wishlists` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
