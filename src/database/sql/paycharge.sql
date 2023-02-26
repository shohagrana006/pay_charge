-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 29, 2022 at 12:37 PM
-- Server version: 5.7.33
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `paycharge`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Active',
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `profile_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `last_login_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `user_name`, `email`, `email_verified_at`, `password`, `status`, `phone`, `address`, `profile_image`, `created_by`, `updated_by`, `last_login_time`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'SuperAdmin', 'admin', 'superadmin@example.com', NULL, '$2y$10$LzhakbmMn1fIjO5g5jxXuOq.kV5Hc5A2ZCqHekSRtt6hmneh4FvjC', 'Active', NULL, '{\"city\":\"\",\"zip_code\":\"\",\"postal_code\":\"\",\"state\":\"\",\"address\":\"\"}', NULL, NULL, NULL, '2022-12-29 06:04:05', NULL, '2022-12-29 06:04:05', '2022-12-29 08:31:36'),
(2, 'Hedda Barber', 'wizoxof', 'dane@mailinator.com', NULL, '$2y$10$qpNtnXKSl6M9dDYiF5MxnO7A0gR8g1dgIT6msV1zStjkeO.n5Mi2G', 'DeActive', '+1 (131) 659-7337', '{\"city\":\"Pariatur Impedit s\",\"zip_code\":\"89451\",\"postal_code\":\"Mollit aute reiciend\",\"state\":\"Eligendi qui eaque v\",\"address\":\"Inventore vero animi\"}', NULL, 1, NULL, '2022-12-29 07:28:07', NULL, '2022-12-29 07:28:07', '2022-12-29 08:33:05');

-- --------------------------------------------------------

--
-- Table structure for table `chooses`
--

CREATE TABLE `chooses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qsn` text COLLATE utf8mb4_unicode_ci,
  `ans` longtext COLLATE utf8mb4_unicode_ci,
  `status` enum('Active','DeActive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Active',
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `status` enum('Active','DeActive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `logo`, `created_by`, `updated_by`, `status`, `created_at`, `updated_at`) VALUES
(1, 'uganda', NULL, 1, NULL, 'Active', '2022-12-29 06:41:29', '2022-12-29 06:41:29'),
(2, 'Bangladesh', NULL, 1, NULL, 'Active', '2022-12-29 06:43:04', '2022-12-29 06:43:04');

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `symbol` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rate` decimal(18,5) NOT NULL DEFAULT '0.00000',
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Active',
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `qsn` text COLLATE utf8mb4_unicode_ci,
  `ans` longtext COLLATE utf8mb4_unicode_ci,
  `status` enum('Active','DeActive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Active',
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `general_settings`
--

CREATE TABLE `general_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `favicon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mail_footer` json DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `copy_right_text` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '@2022',
  `pagination_number` int(11) NOT NULL DEFAULT '0',
  `count_by` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ip',
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `demo_mode` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'DeActive',
  `accept_cookie` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'DeActive',
  `maintenance_mood` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'DeActive',
  `currency_setup` json DEFAULT NULL,
  `frontend_loader` text COLLATE utf8mb4_unicode_ci,
  `address` text COLLATE utf8mb4_unicode_ci,
  `recaptcha` json DEFAULT NULL,
  `social_media` longtext COLLATE utf8mb4_unicode_ci,
  `social_login` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `general_settings`
--

INSERT INTO `general_settings` (`id`, `favicon`, `logo`, `mail_footer`, `name`, `phone`, `copy_right_text`, `pagination_number`, `count_by`, `email`, `demo_mode`, `accept_cookie`, `maintenance_mood`, `currency_setup`, `frontend_loader`, `address`, `recaptcha`, `social_media`, `social_login`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, '{\"link\": \"#\", \"logo\": \"\"}', 'Nafiz Khan', '01616243666', '@2022', 0, 'ip', 'nafiz0khan1@gmail.com', 'DeActive', 'DeActive', 'DeActive', '{\"symbol\": \"$\", \"currency\": \"USD\"}', '{\"image\":\"#\",\"status \":\"Active\"}', 'H-09', '{\"key\": \"6LedlgUjAAAAAB2Ya-wfLOaTs_z5PAkceCJgo4Tl\", \"status\": \"Active\", \"secret_key\": \"6LedlgUjAAAAANIo4iedlmSY-zLakPWIMn47MS17\"}', '{\"facebook\":\"{\\\"link\\\":\\\"#\\\",\\\"icon\\\":\\\"<i class=\\\\\\\"fab fa-facebook\\\\\\\"><\\\\\\/i>\\\",\\\"status\\\":\\\"Active\\\"}\",\"twitter\":\"{\\\"link\\\":\\\"#\\\",\\\"icon\\\":\\\"<i class=\\\\\\\"fab fa-facebook\\\\\\\"><\\\\\\/i>\\\",\\\"status\\\":\\\"Active\\\"}\",\"instagram\":\"{\\\"link\\\":\\\"#\\\",\\\"icon\\\":\\\"<i class=\\\\\\\"fab fa-facebook\\\\\\\"><\\\\\\/i>\\\",\\\"status\\\":\\\"Active\\\"}\",\"linkedin\":\"{\\\"link\\\":\\\"#\\\",\\\"icon\\\":\\\"<i class=\\\\\\\"fab fa-facebook\\\\\\\"><\\\\\\/i>\\\",\\\"status\\\":\\\"Active\\\"}\",\"google\":\"{\\\"link\\\":\\\"#\\\",\\\"icon\\\":\\\"<i class=\\\\\\\"fab fa-facebook\\\\\\\"><\\\\\\/i>\\\",\\\"status\\\":\\\"Active\\\"}\"}', '{\"google_oauth\": \"{\\\"client_id\\\":\\\"#\\\",\\\"client_secret\\\":\\\"#\\\",\\\"status\\\":\\\"Active\\\"}\", \"facebook_oauth\": \"{\\\"client_id\\\":\\\"#\\\",\\\"client_secret\\\":\\\"#\\\",\\\"status\\\":\\\"Active\\\"}\"}', '2022-12-29 06:04:05', '2022-12-29 06:04:05');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_default` tinyint(4) DEFAULT NULL COMMENT 'default : 1, Not default : 0',
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'DeActive',
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `name`, `code`, `is_default`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'English', 'us', 1, 'Active', 1, NULL, '2022-12-29 06:04:05', '2022-12-29 06:04:05'),
(2, 'uganda', 'ug', 0, 'Active', 1, NULL, '2022-12-29 06:41:00', '2022-12-29 06:41:06');

-- --------------------------------------------------------

--
-- Table structure for table `mails`
--

CREATE TABLE `mails` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Active',
  `driver_information` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mails`
--

INSERT INTO `mails` (`id`, `name`, `status`, `driver_information`, `created_at`, `updated_at`) VALUES
(1, 'SMTP', 'Active', '{\"from\": {\"name\": \"test@igensolutionsltd.com\", \"address\": \"test@igensolutionsltd.com\"}, \"host\": \"smtp.mailtrap.io\", \"port\": \"2525\", \"driver\": \"smtp\", \"password\": \"e2b07eb5f31ccd\", \"username\": \"4da88de40cc1e5\", \"encryption\": \"tls\"}', '2022-12-29 06:04:05', '2022-12-29 10:27:07'),
(2, 'SendGrid', 'DeActive', '{\"from\": {\"name\": \"\", \"address\": \"\"}, \"host\": \"\", \"port\": \"\", \"driver\": \"\", \"password\": \"\", \"username\": \"\", \"encryption\": \"\"}', '2022-12-29 06:04:05', '2022-12-29 10:27:07');

-- --------------------------------------------------------

--
-- Table structure for table `mail_templates`
--

CREATE TABLE `mail_templates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `body` longtext COLLATE utf8mb4_unicode_ci,
  `codes` json DEFAULT NULL,
  `status` enum('Active','DeActive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mail_templates`
--

INSERT INTO `mail_templates` (`id`, `name`, `slug`, `subject`, `body`, `codes`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Password Reset', 'password-reset', 'Password Reset', '<p> We have received a request to reset the password for your account on {{code}} and Request time {{time}} </p>', '{\"code\": \"Password Reset Code\", \"time\": \"Time\"}', 'Active', '2022-12-29 06:04:05', '2022-12-29 06:04:05'),
(2, 'Admin Support Reply', 'admin-support-reply', 'Support Ticket Reply', NULL, '{\"link\": \"Ticket URL For relpy\", \"ticket_number\": \"Support Ticket Number\"}', 'Active', '2022-12-29 06:04:05', '2022-12-29 06:04:05'),
(3, 'Payment Confirmation', 'payment-confirmation', 'Payment confirm', '<p>Your Transaction Number {{trx}} and payment amount {{amount}} and charge {{charge}}</p>', '{\"trx\": \"Transaction Number\", \"rate\": \"Conversion Rate\", \"amount\": \"Payment Amount\", \"charge\": \"Payment Gateway Charge\", \"currency\": \"Site Currency\", \"method_name\": \"Payment Method name\", \"method_currency\": \"Payment Method Currency\"}', 'Active', '2022-12-29 06:04:05', '2022-12-29 06:04:05'),
(4, 'Admin Password Reset', 'admin-password-reset', 'Admin Password Reset', '<p>We have received a request to reset the password for your account on {{code}} and Request time {{time}}</p>', '{\"code\": \"Password Reset Code\", \"time\": \"Time\"}', 'Active', '2022-12-29 06:04:05', '2022-12-29 06:04:05'),
(5, 'Password Reset Confirm', 'password-reset-confirm', 'Password Reset Confirm', '<p>We have received a request to reset the password for your account on {{code}} and Request time {{time}}</p>', '{\"time\": \"Time\"}', 'Active', '2022-12-29 06:04:05', '2022-12-29 06:04:05'),
(6, 'Registration Verify', 'registration-verify', 'Registration Verify', '<p>Hi, {{name}} We have received a request to create an account, you need to verify email first, your verification code is {{code}} and request time {{time}}</p>', '{\"code\": \"Password Reset Code\", \"name\": \"Name\", \"time\": \"Time\"}', 'Active', '2022-12-29 06:04:05', '2022-12-29 06:04:05');

-- --------------------------------------------------------

--
-- Table structure for table `manual_payments`
--

CREATE TABLE `manual_payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gateway_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `minimum_amount` decimal(16,4) DEFAULT NULL,
  `maximum_amount` decimal(16,4) DEFAULT NULL,
  `fixed_charge` decimal(16,4) DEFAULT NULL,
  `percent_charge` decimal(16,4) DEFAULT NULL,
  `instruction` longtext COLLATE utf8mb4_unicode_ci,
  `info` json DEFAULT NULL,
  `status` enum('DeActive','Active') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Active',
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(4, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(5, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(6, '2016_06_01_000004_create_oauth_clients_table', 1),
(7, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(8, '2019_08_19_000000_create_failed_jobs_table', 1),
(9, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(10, '2022_10_10_104336_create_admins_table', 1),
(11, '2022_10_11_170404_create_permission_tables', 1),
(12, '2022_10_12_081401_create_languages_table', 1),
(13, '2022_10_12_173502_create_general_settings_table', 1),
(14, '2022_11_13_053738_create_mails_table', 1),
(15, '2022_11_26_192151_create_seo_settings_table', 1),
(16, '2022_11_29_105320_create_payment_methods_table', 1),
(17, '2022_12_01_104214_create_payment_logs_table', 1),
(18, '2022_12_03_131717_create_currencies_table', 1),
(19, '2022_12_04_105420_create_countries_table', 1),
(20, '2022_12_05_151524_create_service_categories_table', 1),
(21, '2022_12_06_180655_create_services_table', 1),
(22, '2022_12_07_125347_create_package_lists_table', 1),
(23, '2022_12_07_131158_create_packages_table', 1),
(24, '2022_12_11_113355_create_package_services_table', 1),
(25, '2022_12_13_110447_create_service_logs_table', 1),
(26, '2022_12_13_143149_create_manual_payments_table', 1),
(27, '2022_12_20_125211_create_user_verify_emails_table', 1),
(28, '2022_12_21_105518_create_faqs_table', 1),
(29, '2022_12_22_112431_create_chooses_table', 1),
(30, '2022_12_24_120758_create_mail_templates_table', 1),
(31, '2022_12_27_125254_create_jobs_table', 1),
(32, '2022_12_27_150920_create_notifications_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\Admin', 1),
(1, 'App\\Models\\Admin', 2);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('0308454a-de9d-421c-b935-948a6fae766c', 'App\\Notifications\\NewEventNotification', 'App\\Models\\Admin', 2, '{\"route\":\"http:\\/\\/localhost\\/paycharge\\/admin\\/user\\/show\\/3\",\"message\":\"david Just Registered\"}', NULL, '2022-12-29 09:10:16', '2022-12-29 09:10:16'),
('1d9368de-1c71-4400-a116-3cb5f6570316', 'App\\Notifications\\NewEventNotification', 'App\\Models\\Admin', 1, '{\"route\":\"http:\\/\\/localhost\\/paycharge\\/admin\\/user\\/show\\/8\",\"message\":\"david Just Registered\"}', NULL, '2022-12-29 09:22:07', '2022-12-29 09:22:07'),
('27a2bd61-6f93-4c73-9fe7-138e5c7353d7', 'App\\Notifications\\NewEventNotification', 'App\\Models\\Admin', 1, '{\"route\":\"http:\\/\\/localhost\\/paycharge\\/admin\\/user\\/show\\/3\",\"message\":\"david Just Registered\"}', NULL, '2022-12-29 09:10:16', '2022-12-29 09:10:16'),
('3d7f3350-1c75-457e-86fc-63bd15125181', 'App\\Notifications\\NewEventNotification', 'App\\Models\\Admin', 2, '{\"route\":\"http:\\/\\/localhost\\/paycharge\\/admin\\/user\\/show\\/6\",\"message\":\"david Just Registered\"}', NULL, '2022-12-29 09:19:35', '2022-12-29 09:19:35'),
('5e953ff6-c8ce-4eb1-8b99-1ebc4d319b8a', 'App\\Notifications\\NewEventNotification', 'App\\Models\\Admin', 1, '{\"route\":\"http:\\/\\/localhost\\/paycharge\\/admin\\/user\\/show\\/7\",\"message\":\"david Just Registered\"}', NULL, '2022-12-29 09:20:23', '2022-12-29 09:20:23'),
('6354363a-cd3d-438d-aa9b-c01a165c66d8', 'App\\Notifications\\NewEventNotification', 'App\\Models\\Admin', 2, '{\"route\":\"http:\\/\\/localhost\\/paycharge\\/admin\\/user\\/show\\/4\",\"message\":\"david Just Registered\"}', NULL, '2022-12-29 09:12:52', '2022-12-29 09:12:52'),
('835cd9df-96e4-4d5e-8d1f-f05f027b203b', 'App\\Notifications\\NewEventNotification', 'App\\Models\\Admin', 1, '{\"route\":\"http:\\/\\/localhost\\/paycharge\\/admin\\/user\\/show\\/5\",\"message\":\"david Just Registered\"}', NULL, '2022-12-29 09:14:56', '2022-12-29 09:14:56'),
('8b4315f7-dfa4-4eb9-a7d6-0f9c9a4818cc', 'App\\Notifications\\NewEventNotification', 'App\\Models\\Admin', 2, '{\"route\":\"http:\\/\\/localhost\\/paycharge\\/admin\\/user\\/show\\/5\",\"message\":\"david Just Registered\"}', NULL, '2022-12-29 09:14:56', '2022-12-29 09:14:56'),
('9d0e019e-a1a3-421b-b06c-c891dbc9ea1c', 'App\\Notifications\\NewEventNotification', 'App\\Models\\Admin', 1, '{\"route\":\"http:\\/\\/localhost\\/paycharge\\/admin\\/user\\/show\\/2\",\"message\":\"david Just Registered\"}', NULL, '2022-12-29 08:58:43', '2022-12-29 08:58:43'),
('b60e3987-8578-4f33-b2c5-8c412a77bae0', 'App\\Notifications\\NewEventNotification', 'App\\Models\\Admin', 1, '{\"route\":\"http:\\/\\/localhost\\/paycharge\\/admin\\/user\\/show\\/9\",\"message\":\"david Just Registered\"}', NULL, '2022-12-29 09:22:28', '2022-12-29 09:22:28'),
('b617c2f5-0fcc-4524-8f97-f20dd59c9416', 'App\\Notifications\\NewEventNotification', 'App\\Models\\Admin', 2, '{\"route\":\"http:\\/\\/localhost\\/paycharge\\/admin\\/user\\/show\\/9\",\"message\":\"david Just Registered\"}', NULL, '2022-12-29 09:22:28', '2022-12-29 09:22:28'),
('be59f6cf-d112-4732-b2c2-077225835463', 'App\\Notifications\\NewEventNotification', 'App\\Models\\Admin', 2, '{\"route\":\"http:\\/\\/localhost\\/paycharge\\/admin\\/user\\/show\\/2\",\"message\":\"david Just Registered\"}', NULL, '2022-12-29 08:58:43', '2022-12-29 08:58:43'),
('ce13b6b0-523e-4447-8583-ed2a65325dba', 'App\\Notifications\\NewEventNotification', 'App\\Models\\Admin', 2, '{\"route\":\"http:\\/\\/localhost\\/paycharge\\/admin\\/user\\/show\\/7\",\"message\":\"david Just Registered\"}', NULL, '2022-12-29 09:20:23', '2022-12-29 09:20:23'),
('d01cfcfe-52c8-47c1-87e5-22667be82c3b', 'App\\Notifications\\NewEventNotification', 'App\\Models\\Admin', 1, '{\"route\":\"http:\\/\\/localhost\\/paycharge\\/admin\\/user\\/show\\/1\",\"message\":\"david Just Registered\"}', NULL, '2022-12-29 08:57:05', '2022-12-29 08:57:05'),
('d56723a6-272d-4c7b-a87d-d94fff4b67ea', 'App\\Notifications\\NewEventNotification', 'App\\Models\\Admin', 1, '{\"route\":\"http:\\/\\/localhost\\/paycharge\\/admin\\/user\\/show\\/6\",\"message\":\"david Just Registered\"}', NULL, '2022-12-29 09:19:35', '2022-12-29 09:19:35'),
('de0bbd27-032a-4f5c-8707-d7a849928a2d', 'App\\Notifications\\NewEventNotification', 'App\\Models\\Admin', 1, '{\"route\":\"http:\\/\\/localhost\\/paycharge\\/admin\\/user\\/show\\/4\",\"message\":\"david Just Registered\"}', NULL, '2022-12-29 09:12:52', '2022-12-29 09:12:52'),
('e1cf0f58-1a72-4b63-8a67-fc1c11101507', 'App\\Notifications\\NewEventNotification', 'App\\Models\\Admin', 2, '{\"route\":\"http:\\/\\/localhost\\/paycharge\\/admin\\/user\\/show\\/1\",\"message\":\"david Just Registered\"}', NULL, '2022-12-29 08:57:05', '2022-12-29 08:57:05'),
('e4e6d898-9caf-4794-af22-99a5e189cad6', 'App\\Notifications\\NewEventNotification', 'App\\Models\\Admin', 2, '{\"route\":\"http:\\/\\/localhost\\/paycharge\\/admin\\/user\\/show\\/8\",\"message\":\"david Just Registered\"}', NULL, '2022-12-29 09:22:07', '2022-12-29 09:22:07');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_access_tokens`
--

INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('68997b906cde93baa9e65f6958d76b2eb1fe7ea192cc2a555857a7c0a94101a47d509a6c886395f3', 2, 3, 'a@a.gsss', '[]', 0, '2022-12-29 09:00:44', '2022-12-29 09:00:44', '2023-12-29 15:00:44'),
('86f81fc96e27d359773046a828f45fcecc2cc3ff23d76f4b4cc24974b66fddd7d7fbb1f1d574299d', 7, 3, 'a@a.gssssssss', '[]', 0, '2022-12-29 09:20:49', '2022-12-29 09:20:49', '2023-12-29 15:20:49');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
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
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
(1, NULL, 'Laravel Personal Access Client', 'ziP6rcQf5KJivtor3elWnglUQJJtpPD79oNFst0p', NULL, 'http://localhost', 1, 0, 0, '2022-12-29 08:59:43', '2022-12-29 08:59:43'),
(2, NULL, 'Laravel Password Grant Client', '8MDYJYo8BrSyqfBgfB6myPNXjpjMWrkls8c9ub7H', 'users', 'http://localhost', 0, 1, 0, '2022-12-29 08:59:43', '2022-12-29 08:59:43'),
(3, NULL, 'Laravel Personal Access Client', '0RTuG4cHHio1t2HR6MUn0Sqs2eOvt2hiEjxCqwsj', NULL, 'http://localhost', 1, 0, 0, '2022-12-29 08:59:53', '2022-12-29 08:59:53'),
(4, NULL, 'Laravel Password Grant Client', '2qX9Qg15j90rQy9oXcMb1CmW58xPrhTsFnDTXzcp', 'users', 'http://localhost', 0, 1, 0, '2022-12-29 08:59:53', '2022-12-29 08:59:53');

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
(1, 1, '2022-12-29 08:59:43', '2022-12-29 08:59:43'),
(2, 3, '2022-12-29 08:59:53', '2022-12-29 08:59:53');

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
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('Active','DeActive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Active',
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `package_lists`
--

CREATE TABLE `package_lists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `package_service_id` bigint(20) UNSIGNED DEFAULT NULL,
  `minute` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mb` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sms` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `duration` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` decimal(16,2) DEFAULT NULL,
  `discount_price` decimal(16,2) DEFAULT NULL,
  `details` longtext COLLATE utf8mb4_unicode_ci,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Active',
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `package_services`
--

CREATE TABLE `package_services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `package_id` bigint(20) UNSIGNED NOT NULL,
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_logs`
--

CREATE TABLE `payment_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `method_id` bigint(20) UNSIGNED DEFAULT NULL,
  `amount` text COLLATE utf8mb4_unicode_ci,
  `payment_status` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_methods`
--

CREATE TABLE `payment_methods` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `currency_id` bigint(20) UNSIGNED DEFAULT NULL,
  `charge` decimal(18,2) NOT NULL DEFAULT '0.00',
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unique_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_parameter` json DEFAULT NULL,
  `image` text COLLATE utf8mb4_unicode_ci,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Active',
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `group_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `group_name`, `created_at`, `updated_at`) VALUES
(1, 'dashboard.index', 'admin', 'dashboard', '2022-12-29 06:04:02', '2022-12-29 06:04:02'),
(2, 'admin.index', 'admin', 'admin', '2022-12-29 06:04:02', '2022-12-29 06:04:02'),
(3, 'admin.create', 'admin', 'admin', '2022-12-29 06:04:02', '2022-12-29 06:04:02'),
(4, 'admin.store', 'admin', 'admin', '2022-12-29 06:04:02', '2022-12-29 06:04:02'),
(5, 'admin.edit', 'admin', 'admin', '2022-12-29 06:04:02', '2022-12-29 06:04:02'),
(6, 'admin.destroy', 'admin', 'admin', '2022-12-29 06:04:02', '2022-12-29 06:04:02'),
(7, 'admin.restore', 'admin', 'admin', '2022-12-29 06:04:02', '2022-12-29 06:04:02'),
(8, 'admin.permanentDelete', 'admin', 'admin', '2022-12-29 06:04:02', '2022-12-29 06:04:02'),
(9, 'role.index', 'admin', 'role', '2022-12-29 06:04:02', '2022-12-29 06:04:02'),
(10, 'role.create', 'admin', 'role', '2022-12-29 06:04:02', '2022-12-29 06:04:02'),
(11, 'role.store', 'admin', 'role', '2022-12-29 06:04:02', '2022-12-29 06:04:02'),
(12, 'role.edit', 'admin', 'role', '2022-12-29 06:04:02', '2022-12-29 06:04:02'),
(13, 'role.destroy', 'admin', 'role', '2022-12-29 06:04:02', '2022-12-29 06:04:02'),
(14, 'profile.index', 'admin', 'profile', '2022-12-29 06:04:02', '2022-12-29 06:04:02'),
(15, 'profile.edit', 'admin', 'profile', '2022-12-29 06:04:02', '2022-12-29 06:04:02'),
(16, 'generalSettings.index', 'admin', 'settings', '2022-12-29 06:04:02', '2022-12-29 06:04:02'),
(17, 'configSettings.index', 'admin', 'settings', '2022-12-29 06:04:02', '2022-12-29 06:04:02'),
(18, 'user.index', 'admin', 'user', '2022-12-29 06:04:02', '2022-12-29 06:04:02'),
(19, 'user.create', 'admin', 'user', '2022-12-29 06:04:02', '2022-12-29 06:04:02'),
(20, 'user.store', 'admin', 'user', '2022-12-29 06:04:02', '2022-12-29 06:04:02'),
(21, 'user.edit', 'admin', 'user', '2022-12-29 06:04:02', '2022-12-29 06:04:02'),
(22, 'user.destroy', 'admin', 'user', '2022-12-29 06:04:02', '2022-12-29 06:04:02'),
(23, 'user.restore', 'admin', 'user', '2022-12-29 06:04:02', '2022-12-29 06:04:02'),
(24, 'user.permanentDelete', 'admin', 'user', '2022-12-29 06:04:02', '2022-12-29 06:04:02'),
(25, 'language.index', 'admin', 'language', '2022-12-29 06:04:02', '2022-12-29 06:04:02'),
(26, 'language.create', 'admin', 'language', '2022-12-29 06:04:02', '2022-12-29 06:04:02'),
(27, 'language.store', 'admin', 'language', '2022-12-29 06:04:02', '2022-12-29 06:04:02'),
(28, 'language.edit', 'admin', 'language', '2022-12-29 06:04:02', '2022-12-29 06:04:02'),
(29, 'language.destroy', 'admin', 'language', '2022-12-29 06:04:02', '2022-12-29 06:04:02'),
(30, 'seo.index', 'admin', 'seo', '2022-12-29 06:04:02', '2022-12-29 06:04:02'),
(31, 'seo.create', 'admin', 'seo', '2022-12-29 06:04:02', '2022-12-29 06:04:02'),
(32, 'seo.store', 'admin', 'seo', '2022-12-29 06:04:02', '2022-12-29 06:04:02'),
(33, 'seo.edit', 'admin', 'seo', '2022-12-29 06:04:02', '2022-12-29 06:04:02'),
(34, 'seo.destroy', 'admin', 'seo', '2022-12-29 06:04:03', '2022-12-29 06:04:03'),
(35, 'currency.index', 'admin', 'currency', '2022-12-29 06:04:03', '2022-12-29 06:04:03'),
(36, 'currency.create', 'admin', 'currency', '2022-12-29 06:04:03', '2022-12-29 06:04:03'),
(37, 'currency.store', 'admin', 'currency', '2022-12-29 06:04:03', '2022-12-29 06:04:03'),
(38, 'currency.edit', 'admin', 'currency', '2022-12-29 06:04:03', '2022-12-29 06:04:03'),
(39, 'currency.destroy', 'admin', 'currency', '2022-12-29 06:04:03', '2022-12-29 06:04:03'),
(40, 'country.index', 'admin', 'country', '2022-12-29 06:04:03', '2022-12-29 06:04:03'),
(41, 'country.create', 'admin', 'country', '2022-12-29 06:04:03', '2022-12-29 06:04:03'),
(42, 'country.store', 'admin', 'country', '2022-12-29 06:04:03', '2022-12-29 06:04:03'),
(43, 'country.edit', 'admin', 'country', '2022-12-29 06:04:03', '2022-12-29 06:04:03'),
(44, 'country.destroy', 'admin', 'country', '2022-12-29 06:04:03', '2022-12-29 06:04:03'),
(45, 'service.category.index', 'admin', 'service.category', '2022-12-29 06:04:03', '2022-12-29 06:04:03'),
(46, 'service.category.create', 'admin', 'service.category', '2022-12-29 06:04:03', '2022-12-29 06:04:03'),
(47, 'service.category.store', 'admin', 'service.category', '2022-12-29 06:04:03', '2022-12-29 06:04:03'),
(48, 'service.category.edit', 'admin', 'service.category', '2022-12-29 06:04:03', '2022-12-29 06:04:03'),
(49, 'service.category.destroy', 'admin', 'service.category', '2022-12-29 06:04:03', '2022-12-29 06:04:03'),
(50, 'service.index', 'admin', 'service', '2022-12-29 06:04:03', '2022-12-29 06:04:03'),
(51, 'service.create', 'admin', 'service', '2022-12-29 06:04:03', '2022-12-29 06:04:03'),
(52, 'service.store', 'admin', 'service', '2022-12-29 06:04:03', '2022-12-29 06:04:03'),
(53, 'service.edit', 'admin', 'service', '2022-12-29 06:04:03', '2022-12-29 06:04:03'),
(54, 'service.destroy', 'admin', 'service', '2022-12-29 06:04:03', '2022-12-29 06:04:03'),
(55, 'package.index', 'admin', 'package', '2022-12-29 06:04:03', '2022-12-29 06:04:03'),
(56, 'package.create', 'admin', 'package', '2022-12-29 06:04:04', '2022-12-29 06:04:04'),
(57, 'package.store', 'admin', 'package', '2022-12-29 06:04:04', '2022-12-29 06:04:04'),
(58, 'package.edit', 'admin', 'package', '2022-12-29 06:04:04', '2022-12-29 06:04:04'),
(59, 'package.destroy', 'admin', 'package', '2022-12-29 06:04:04', '2022-12-29 06:04:04'),
(60, 'package.list.index', 'admin', 'package.list', '2022-12-29 06:04:04', '2022-12-29 06:04:04'),
(61, 'package.list.create', 'admin', 'package.list', '2022-12-29 06:04:04', '2022-12-29 06:04:04'),
(62, 'package.list.store', 'admin', 'package.list', '2022-12-29 06:04:04', '2022-12-29 06:04:04'),
(63, 'package.list.edit', 'admin', 'package.list', '2022-12-29 06:04:04', '2022-12-29 06:04:04'),
(64, 'package.list.destroy', 'admin', 'package.list', '2022-12-29 06:04:04', '2022-12-29 06:04:04'),
(65, 'paymentMethod.index', 'admin', 'paymentMethod', '2022-12-29 06:04:04', '2022-12-29 06:04:04'),
(66, 'paymentMethod.edit', 'admin', 'paymentMethod', '2022-12-29 06:04:04', '2022-12-29 06:04:04'),
(67, 'payment.manual.index', 'admin', 'payment.manual', '2022-12-29 06:04:04', '2022-12-29 06:04:04'),
(68, 'payment.manual.create', 'admin', 'payment.manual', '2022-12-29 06:04:04', '2022-12-29 06:04:04'),
(69, 'payment.manual.store', 'admin', 'payment.manual', '2022-12-29 06:04:04', '2022-12-29 06:04:04'),
(70, 'payment.manual.edit', 'admin', 'payment.manual', '2022-12-29 06:04:05', '2022-12-29 06:04:05'),
(71, 'payment.manual.destroy', 'admin', 'payment.manual', '2022-12-29 06:04:05', '2022-12-29 06:04:05'),
(72, 'faq.index', 'admin', 'faq', '2022-12-29 06:04:05', '2022-12-29 06:04:05'),
(73, 'faq.create', 'admin', 'faq', '2022-12-29 06:04:05', '2022-12-29 06:04:05'),
(74, 'faq.store', 'admin', 'faq', '2022-12-29 06:04:05', '2022-12-29 06:04:05'),
(75, 'faq.edit', 'admin', 'faq', '2022-12-29 06:04:05', '2022-12-29 06:04:05'),
(76, 'faq.destroy', 'admin', 'faq', '2022-12-29 06:04:05', '2022-12-29 06:04:05'),
(77, 'choose.index', 'admin', 'choose', '2022-12-29 06:04:05', '2022-12-29 06:04:05'),
(78, 'choose.create', 'admin', 'choose', '2022-12-29 06:04:05', '2022-12-29 06:04:05'),
(79, 'choose.store', 'admin', 'choose', '2022-12-29 06:04:05', '2022-12-29 06:04:05'),
(80, 'choose.edit', 'admin', 'choose', '2022-12-29 06:04:05', '2022-12-29 06:04:05'),
(81, 'choose.destroy', 'admin', 'choose', '2022-12-29 06:04:05', '2022-12-29 06:04:05');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'SuperAdmin', 'admin', 'Active', '2022-12-29 06:04:02', '2022-12-29 06:04:02');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(32, 1),
(33, 1),
(34, 1),
(35, 1),
(36, 1),
(37, 1),
(38, 1),
(39, 1),
(40, 1),
(41, 1),
(42, 1),
(43, 1),
(44, 1),
(45, 1),
(46, 1),
(47, 1),
(48, 1),
(49, 1),
(50, 1),
(51, 1),
(52, 1),
(53, 1),
(54, 1),
(55, 1),
(56, 1),
(57, 1),
(58, 1),
(59, 1),
(60, 1),
(61, 1),
(62, 1),
(63, 1),
(64, 1),
(65, 1),
(66, 1),
(67, 1),
(68, 1),
(69, 1),
(70, 1),
(71, 1),
(72, 1),
(73, 1),
(74, 1),
(75, 1),
(76, 1),
(77, 1),
(78, 1),
(79, 1),
(80, 1),
(81, 1);

-- --------------------------------------------------------

--
-- Table structure for table `seo_settings`
--

CREATE TABLE `seo_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `country_id` bigint(20) UNSIGNED DEFAULT NULL,
  `service_category_id` bigint(20) UNSIGNED NOT NULL,
  `logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `processing_time` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fixed_charge` decimal(8,2) DEFAULT NULL,
  `percent_charge` decimal(8,2) DEFAULT NULL,
  `status` enum('Active','DeActive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Active',
  `info` json DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `country_id`, `service_category_id`, `logo`, `name`, `processing_time`, `fixed_charge`, `percent_charge`, `status`, `info`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 2, 1, NULL, '{\"us\":\"gp\",\"ug\":null}', '10', '50.00', '50.00', 'Active', 'null', 1, NULL, '2022-12-29 06:43:49', '2022-12-29 06:43:49');

-- --------------------------------------------------------

--
-- Table structure for table `service_categories`
--

CREATE TABLE `service_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `status` enum('Active','DeActive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service_categories`
--

INSERT INTO `service_categories` (`id`, `name`, `slug`, `logo`, `created_by`, `updated_by`, `status`, `created_at`, `updated_at`) VALUES
(1, '{\"us\":\"Recharge\",\"ug\":\"rfecharge\"}', '{\"us\":\"Recharge\",\"ug\":\"rfecharge\"}', NULL, 1, 1, 'Active', '2022-12-29 06:41:49', '2022-12-29 06:42:18');

-- --------------------------------------------------------

--
-- Table structure for table `service_logs`
--

CREATE TABLE `service_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `service_id` bigint(20) UNSIGNED DEFAULT NULL,
  `package_id` bigint(20) UNSIGNED DEFAULT NULL,
  `service_list_id` bigint(20) UNSIGNED DEFAULT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(16,4) DEFAULT NULL,
  `charge` decimal(16,4) DEFAULT NULL,
  `after_charge` decimal(16,4) DEFAULT NULL,
  `status` enum('pending','aproved','rejected') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `oauth_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `login_method` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default.jpg',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` longtext COLLATE utf8mb4_unicode_ci,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Active',
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `last_login_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `oauth_id`, `name`, `email`, `login_method`, `profile_image`, `email_verified_at`, `password`, `phone`, `address`, `status`, `created_by`, `updated_by`, `last_login_time`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, NULL, 'david', 'a@a.gss', NULL, 'default.jpg', NULL, '$2y$10$8A2Ryw/dEGRyjJ2iD4x/v.EWH3RubXNIiIPG3j4F.yI1v1JlQEtn6', NULL, NULL, 'Active', NULL, NULL, '2022-12-29 08:57:05', NULL, '2022-12-29 08:57:05', '2022-12-29 08:57:05'),
(2, NULL, 'david', 'a@a.gsss', NULL, 'default.jpg', '2022-12-29 09:00:43', '$2y$10$jujliTXZThn/h5H1n6J7S.8L98HcohN49.SeBKp/FgfTF8JNaDvgq', NULL, NULL, 'Active', NULL, NULL, '2022-12-29 08:58:43', NULL, '2022-12-29 08:58:43', '2022-12-29 09:00:43'),
(3, NULL, 'david', 'a@a.gssss', NULL, 'default.jpg', NULL, '$2y$10$DL5B7xfyQHGWHeG.8zM0bO7Fgipj5XujiUWVVYvCjxkZlocbGH0Gm', NULL, NULL, 'Active', NULL, NULL, '2022-12-29 09:10:16', NULL, '2022-12-29 09:10:16', '2022-12-29 09:10:16'),
(4, NULL, 'david', 'a@a.gsssss', NULL, 'default.jpg', NULL, '$2y$10$ifUW/18YbeOgZBSooJrUVOljgPKTCWbmjcpsDWAvgZlL8PAoM6JWi', NULL, NULL, 'Active', NULL, NULL, '2022-12-29 09:12:52', NULL, '2022-12-29 09:12:52', '2022-12-29 09:12:52'),
(5, NULL, 'david', 'a@a.gssssss', NULL, 'default.jpg', NULL, '$2y$10$j.Qge8Hg8qZOg3gOIguXWufuBB/wjruE67JjqvaVWJVWk7Ewbarh.', NULL, NULL, 'Active', NULL, NULL, '2022-12-29 09:14:56', NULL, '2022-12-29 09:14:56', '2022-12-29 09:14:56'),
(6, NULL, 'david', 'a@a.gsssssss', NULL, 'default.jpg', NULL, '$2y$10$fCk0i16K0G/9KFlkGdAI.umnObeIjby7WzzkE2jCD4sWdY1do6Dqe', NULL, NULL, 'Active', NULL, NULL, '2022-12-29 09:19:35', NULL, '2022-12-29 09:19:35', '2022-12-29 09:19:35'),
(7, NULL, 'david', 'a@a.gssssssss', NULL, 'default.jpg', '2022-12-29 09:20:49', '$2y$10$sDq7K8RPPySqXI00OnjdauDphc8u6fvlRKj5OCKajNPVh/UfCTTfS', NULL, NULL, 'Active', NULL, NULL, '2022-12-29 09:20:23', NULL, '2022-12-29 09:20:23', '2022-12-29 09:20:49'),
(8, NULL, 'david', 'a@a.s', NULL, 'default.jpg', NULL, '$2y$10$Oy7V7ux3f21s6CgFdSRXWuexc3AW6o3a02zEA89B0zOc4bioYQvxm', NULL, NULL, 'Active', NULL, NULL, '2022-12-29 09:22:07', NULL, '2022-12-29 09:22:07', '2022-12-29 09:22:07'),
(9, NULL, 'david', 'a@a.b', NULL, 'default.jpg', NULL, '$2y$10$zssNUjFXowxB9ZBDF0JDdul1jqSDd4l65ANjQVp98/LuD/BmDw5Gm', NULL, NULL, 'Active', NULL, NULL, '2022-12-29 09:22:27', NULL, '2022-12-29 09:22:27', '2022-12-29 09:22:27');

-- --------------------------------------------------------

--
-- Table structure for table `user_verify_emails`
--

CREATE TABLE `user_verify_emails` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_verify_emails`
--

INSERT INTO `user_verify_emails` (`id`, `email`, `token`, `created_at`, `updated_at`) VALUES
(1, 'a@a.gss', 'hhPTvAVRdxUBVc5Wu5qzJgWHrk1TAH3PpkF4hKVj1uRnagU66E3LjM5PvqiYi5so', '2022-12-29 08:57:05', '2022-12-29 08:57:05'),
(3, 'a@a.gssss', 'D7ilZtw6gs6AZhvI8BV9ZFArYJbPWJVoGvVdFEiV8hULU9LrPXsNF5H8nN1hgHxz', '2022-12-29 09:10:16', '2022-12-29 09:10:16'),
(4, 'a@a.gsssss', 'eOiRjEbSMs1uNydbArhgQtfMBIE4UJiH6KHDkr38oxNKYydPDq7x9HIHX7NkS4Df', '2022-12-29 09:12:52', '2022-12-29 09:12:52'),
(5, 'a@a.gssssss', 'QA5KplzjFsnghJIzamR7lkafIPxsFByYZviuc2EcMWaZ0CMFNnnaVJcfuX2XOpRm', '2022-12-29 09:14:56', '2022-12-29 09:14:56'),
(6, 'a@a.gsssssss', 'JbignoMJWXRk7vSnMcEvAZFnnU5CFcTkUrCIpd6nueRQFfbQmXkQ6vYamDrG95Nj', '2022-12-29 09:19:35', '2022-12-29 09:19:35'),
(8, 'a@a.s', 'UzFb15QOjZYbDUKhX7TLSXYOFkFhbKwK36zGY3hNnZ7zsCrOY4rrykPSDvPXbMfG', '2022-12-29 09:22:07', '2022-12-29 09:22:07'),
(9, 'a@a.b', 'G1S7fcB8VjpDGfi5lckjxrX98z1Nc97pP2v1K7HQkZHWT4irLbCz9d0WcpMyURaY', '2022-12-29 09:22:27', '2022-12-29 09:22:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_user_name_unique` (`user_name`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `chooses`
--
ALTER TABLE `chooses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `countries_name_unique` (`name`);

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `general_settings`
--
ALTER TABLE `general_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mails`
--
ALTER TABLE `mails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mail_templates`
--
ALTER TABLE `mail_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manual_payments`
--
ALTER TABLE `manual_payments`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

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
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `packages_name_unique` (`name`);

--
-- Indexes for table `package_lists`
--
ALTER TABLE `package_lists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `package_services`
--
ALTER TABLE `package_services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payment_logs`
--
ALTER TABLE `payment_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

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
-- Indexes for table `seo_settings`
--
ALTER TABLE `seo_settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `seo_settings_name_unique` (`name`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `services_name_unique` (`name`);

--
-- Indexes for table `service_categories`
--
ALTER TABLE `service_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `service_categories_name_unique` (`name`),
  ADD UNIQUE KEY `service_categories_slug_unique` (`slug`);

--
-- Indexes for table `service_logs`
--
ALTER TABLE `service_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_verify_emails`
--
ALTER TABLE `user_verify_emails`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `chooses`
--
ALTER TABLE `chooses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `general_settings`
--
ALTER TABLE `general_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `mails`
--
ALTER TABLE `mails`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `mail_templates`
--
ALTER TABLE `mail_templates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `manual_payments`
--
ALTER TABLE `manual_payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `package_lists`
--
ALTER TABLE `package_lists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `package_services`
--
ALTER TABLE `package_services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_logs`
--
ALTER TABLE `payment_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `seo_settings`
--
ALTER TABLE `seo_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `service_categories`
--
ALTER TABLE `service_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `service_logs`
--
ALTER TABLE `service_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user_verify_emails`
--
ALTER TABLE `user_verify_emails`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
