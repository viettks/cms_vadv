-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.25 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for vadv_cms
CREATE DATABASE IF NOT EXISTS `vadv_cms` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `vadv_cms`;

-- Dumping structure for table vadv_cms.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table vadv_cms.failed_jobs: ~0 rows (approximately)
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;

-- Dumping structure for table vadv_cms.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table vadv_cms.migrations: ~4 rows (approximately)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2019_12_14_000001_create_personal_access_tokens_table', 1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Dumping structure for table vadv_cms.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table vadv_cms.password_resets: ~0 rows (approximately)
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Dumping structure for table vadv_cms.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table vadv_cms.personal_access_tokens: ~0 rows (approximately)
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;

-- Dumping structure for table vadv_cms.tb_debt
CREATE TABLE IF NOT EXISTS `tb_debt` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_id` int DEFAULT NULL,
  `amount` bigint DEFAULT NULL,
  `payment` bigint DEFAULT NULL,
  `status` int DEFAULT NULL,
  `note` varchar(500) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table vadv_cms.tb_debt: ~4 rows (approximately)
/*!40000 ALTER TABLE `tb_debt` DISABLE KEYS */;
INSERT INTO `tb_debt` (`id`, `order_id`, `amount`, `payment`, `status`, `note`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
	(1, 1, 8642000, 0, 0, NULL, NULL, NULL, '2022-03-25 17:28:50', '2022-03-25 17:28:50'),
	(2, 2, 8642000, 0, 0, NULL, 3, 3, '2022-03-25 17:30:54', '2022-03-25 17:30:54'),
	(3, 3, 8642000, 0, 0, NULL, 3, 3, '2022-03-25 17:31:25', '2022-03-25 17:31:25'),
	(4, 4, 8642000, 0, 0, NULL, 3, 3, '2022-03-25 17:32:44', '2022-03-25 17:32:44');
/*!40000 ALTER TABLE `tb_debt` ENABLE KEYS */;

-- Dumping structure for table vadv_cms.tb_order
CREATE TABLE IF NOT EXISTS `tb_order` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `address` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `payment` bigint DEFAULT NULL,
  `release` datetime DEFAULT NULL,
  `amount` bigint DEFAULT NULL,
  `note` varchar(500) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table vadv_cms.tb_order: ~4 rows (approximately)
/*!40000 ALTER TABLE `tb_order` DISABLE KEYS */;
INSERT INTO `tb_order` (`id`, `name`, `phone`, `address`, `payment`, `release`, `amount`, `note`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
	(1, 'Hòai nam', '0123456789', 'Thanh xuân', 0, '2015-11-11 00:00:00', 8642000, 'test thôi', 3, 3, '2022-03-25 17:28:50', '2022-03-25 17:28:50'),
	(2, 'Hòai nam', '0123456789', 'Thanh xuân', 0, '2015-11-11 00:00:00', 8642000, 'test thôi', 3, 3, '2022-03-25 17:30:54', '2022-03-25 17:30:54'),
	(3, 'Hòai nam', '0123456789', 'Thanh xuân', 0, '2015-11-11 00:00:00', 8642000, 'test thôi', 3, 3, '2022-03-25 17:31:25', '2022-03-25 17:31:25'),
	(4, 'Hòai nam', '0123456789', 'Thanh xuân', 0, '2015-11-11 00:00:00', 8642000, 'test thôi', 3, 3, '2022-03-25 17:32:44', '2022-03-25 17:32:44');
/*!40000 ALTER TABLE `tb_order` ENABLE KEYS */;

-- Dumping structure for table vadv_cms.tb_order_detail
CREATE TABLE IF NOT EXISTS `tb_order_detail` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_id` int DEFAULT NULL,
  `print_id` int DEFAULT NULL,
  `width` float DEFAULT NULL,
  `heigth` float DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `unit_price` float DEFAULT NULL,
  `film_type` bigint DEFAULT NULL,
  `amount` int DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_tb_order_detail_tb_order` (`order_id`),
  KEY `FK_tb_order_detail_tb_print` (`print_id`),
  CONSTRAINT `FK_tb_order_detail_tb_order` FOREIGN KEY (`order_id`) REFERENCES `tb_order` (`id`),
  CONSTRAINT `FK_tb_order_detail_tb_print` FOREIGN KEY (`print_id`) REFERENCES `tb_print` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table vadv_cms.tb_order_detail: ~8 rows (approximately)
/*!40000 ALTER TABLE `tb_order_detail` DISABLE KEYS */;
INSERT INTO `tb_order_detail` (`id`, `order_id`, `print_id`, `width`, `heigth`, `quantity`, `unit_price`, `film_type`, `amount`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
	(1, 1, 2, 1, 1, 1000, 4321, 0, 4321000, 3, 3, '2022-03-25 17:28:50', '2022-03-25 17:28:50'),
	(2, 1, 2, 1, 1, 1000, 4321, 0, 4321000, 3, 3, '2022-03-25 17:28:50', '2022-03-25 17:28:50'),
	(3, 2, 2, 1, 1, 1000, 4321, 0, 4321000, 3, 3, '2022-03-25 17:30:54', '2022-03-25 17:30:54'),
	(4, 2, 2, 1, 1, 1000, 4321, 0, 4321000, 3, 3, '2022-03-25 17:30:54', '2022-03-25 17:30:54'),
	(5, 3, 2, 1, 1, 1000, 4321, 0, 4321000, 3, 3, '2022-03-25 17:31:25', '2022-03-25 17:31:25'),
	(6, 3, 2, 1, 1, 1000, 4321, 0, 4321000, 3, 3, '2022-03-25 17:31:25', '2022-03-25 17:31:25'),
	(7, 4, 2, 1, 1, 1000, 4321, 0, 4321000, 3, 3, '2022-03-25 17:32:44', '2022-03-25 17:32:44'),
	(8, 4, 2, 1, 1, 1000, 4321, 0, 4321000, 3, 3, '2022-03-25 17:32:44', '2022-03-25 17:32:44');
/*!40000 ALTER TABLE `tb_order_detail` ENABLE KEYS */;

-- Dumping structure for table vadv_cms.tb_print
CREATE TABLE IF NOT EXISTS `tb_print` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `big_price` bigint DEFAULT NULL,
  `small_price` bigint DEFAULT NULL,
  `pe_film_1` bigint DEFAULT NULL,
  `pe_film_2` bigint DEFAULT NULL,
  `pe_film_3` bigint DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table vadv_cms.tb_print: ~2 rows (approximately)
/*!40000 ALTER TABLE `tb_print` DISABLE KEYS */;
INSERT INTO `tb_print` (`id`, `name`, `big_price`, `small_price`, `pe_film_1`, `pe_film_2`, `pe_film_3`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
	(2, 'in thường', 1234, 4321, 0, 11111, 22222, 3, 3, '2022-03-24 13:36:12', '2022-03-24 13:36:12'),
	(3, 'in nhanh', 5432, 9999, 0, 44444, 55555, 3, 3, '2022-03-24 13:36:57', '2022-03-24 13:36:57');
/*!40000 ALTER TABLE `tb_print` ENABLE KEYS */;

-- Dumping structure for table vadv_cms.tb_role
CREATE TABLE IF NOT EXISTS `tb_role` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table vadv_cms.tb_role: ~2 rows (approximately)
/*!40000 ALTER TABLE `tb_role` DISABLE KEYS */;
INSERT INTO `tb_role` (`id`, `name`) VALUES
	(1, 'ADMIN'),
	(2, 'USER');
/*!40000 ALTER TABLE `tb_role` ENABLE KEYS */;

-- Dumping structure for table vadv_cms.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role_id` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`user_name`) USING BTREE,
  KEY `FK_tb_user_tb_role` (`role_id`),
  CONSTRAINT `FK_tb_user_tb_role` FOREIGN KEY (`role_id`) REFERENCES `tb_role` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table vadv_cms.users: ~1 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `user_name`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role_id`) VALUES
	(3, 'admin', 'admin', NULL, '$2y$10$/arheh07YGZvqKsd6.5qcuW3roU.196Bu7wd5nkxUWWP.cjq6/u42', NULL, '2022-03-19 10:45:47', '2022-03-19 10:45:47', 1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
