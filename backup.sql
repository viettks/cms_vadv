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
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table vadv_cms.migrations: ~0 rows (approximately)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Dumping structure for table vadv_cms.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table vadv_cms.password_resets: ~0 rows (approximately)
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Dumping structure for table vadv_cms.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
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
  `bill_code` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `amount` bigint DEFAULT NULL,
  `payment` bigint DEFAULT NULL,
  `status` int DEFAULT NULL,
  `note` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table vadv_cms.tb_debt: ~0 rows (approximately)
/*!40000 ALTER TABLE `tb_debt` DISABLE KEYS */;
INSERT INTO `tb_debt` (`id`, `order_id`, `bill_code`, `amount`, `payment`, `status`, `note`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
	(1, 4, 'VAD000000004', 1000, 0, 0, NULL, 3, 3, '2022-05-05 13:25:53', '2022-05-05 13:25:53');
/*!40000 ALTER TABLE `tb_debt` ENABLE KEYS */;

-- Dumping structure for table vadv_cms.tb_order
CREATE TABLE IF NOT EXISTS `tb_order` (
  `id` int NOT NULL AUTO_INCREMENT,
  `bill_code` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `phone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `address` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `payment` bigint DEFAULT NULL,
  `release` datetime DEFAULT NULL,
  `amount` bigint DEFAULT NULL,
  `note` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` int DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table vadv_cms.tb_order: ~5 rows (approximately)
/*!40000 ALTER TABLE `tb_order` DISABLE KEYS */;
INSERT INTO `tb_order` (`id`, `bill_code`, `name`, `phone`, `address`, `payment`, `release`, `amount`, `note`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
	(4, 'VAD000000004', 'Westen Union', '0123456789', 'Khối Phố Xuân Tây', 0, NULL, 1000, NULL, 0, 3, 3, '2022-05-05 13:25:53', '2022-05-05 13:25:53'),
	(7, 'VAD000000007', 'Westen Union', '0123456789', 'Khối Phố Xuân Tây', 0, NULL, 0, NULL, 0, 3, 3, '2022-05-10 17:53:52', '2022-05-10 17:53:52'),
	(8, 'VAD000000008', 'Westen Union', '0123456789', 'Khối Phố Xuân Tây', 0, NULL, 0, NULL, 0, 3, 3, '2022-05-10 17:54:47', '2022-05-10 17:54:47'),
	(9, 'VAD000000009', 'Westen Union', '0123456789', 'Khối Phố Xuân Tây', 0, NULL, 0, NULL, 0, 3, 3, '2022-05-10 18:02:02', '2022-05-10 18:02:02'),
	(10, 'VAD000000010', 'Westen Union', '0123456789', 'Khối Phố Xuân Tây', 0, NULL, 0, NULL, 0, 3, 3, '2022-05-10 18:06:33', '2022-05-10 18:06:33'),
	(11, 'VAD000000011', 'Westen Union', '0123456789', 'Khối Phố Xuân Tây', 0, NULL, 0, NULL, 0, 3, 3, '2022-05-10 18:10:06', '2022-05-10 18:10:06');
/*!40000 ALTER TABLE `tb_order` ENABLE KEYS */;

-- Dumping structure for table vadv_cms.tb_order_detail
CREATE TABLE IF NOT EXISTS `tb_order_detail` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_id` int DEFAULT NULL,
  `print_id` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `print_name` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `print_type` tinyint(1) DEFAULT NULL,
  `machine1` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `machine2` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `width` float DEFAULT NULL,
  `heigth` float DEFAULT NULL,
  `size` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `unit_price` int DEFAULT NULL,
  `total_size` float DEFAULT NULL,
  `unit` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `amount` bigint DEFAULT NULL,
  `amount_display` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `colunm1` bigint DEFAULT NULL,
  `Column2` bigint DEFAULT NULL,
  `Column3` bigint DEFAULT NULL,
  `Column4` bigint DEFAULT NULL,
  `Column5` bigint DEFAULT NULL,
  `Column6` bigint DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_tb_order_detail_tb_order` (`order_id`),
  CONSTRAINT `FK_tb_order_detail_tb_order` FOREIGN KEY (`order_id`) REFERENCES `tb_order` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table vadv_cms.tb_order_detail: ~6 rows (approximately)
/*!40000 ALTER TABLE `tb_order_detail` DISABLE KEYS */;
INSERT INTO `tb_order_detail` (`id`, `order_id`, `print_id`, `print_name`, `print_type`, `machine1`, `machine2`, `width`, `heigth`, `size`, `quantity`, `unit_price`, `total_size`, `unit`, `amount`, `amount_display`, `colunm1`, `Column2`, `Column3`, `Column4`, `Column5`, `Column6`) VALUES
	(1, 4, NULL, 'In PP / Trong Nhà', NULL, 'Cán Màng Bóng', 'Cắt Thành Phẩm', 1, 1, NULL, 1, 1000, 1, 'm2', 1000, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(2, 7, NULL, 'Loại 3 / phụ', 3, 'test1', 'GC 1', 0, NULL, 'A2', 5, 5, 5, 'tam', 25, '25', NULL, NULL, NULL, NULL, NULL, NULL),
	(3, 8, NULL, 'Loại 3 / phụ', 3, 'test1', 'GC 1', 0, NULL, 'A2', 5, 5, 5, 'tam', 25, '25', NULL, NULL, NULL, NULL, NULL, NULL),
	(4, 8, NULL, 'Loại 3 / phụ', 3, 'test1', 'GC 1', 0, NULL, 'A1', 12131, 1231231231, 12131, 'tam', 14936066063261, '14.936.066.063.261', NULL, NULL, NULL, NULL, NULL, NULL),
	(5, 9, NULL, 'Loại 3 / phụ', 3, 'test1', 'GC 1', 0, NULL, 'A1', 123, 2312, 123, 'tam', 284376, '284.376', NULL, NULL, NULL, NULL, NULL, NULL),
	(6, 10, NULL, 'Loại 3 / phụ', 3, 'test1', 'GC 1', 0, 0, 'A1', 1, 1, 1, 'tam', 1, '1', NULL, NULL, NULL, NULL, NULL, NULL),
	(7, 11, '39', 'loai 4 / laoi 4', 4, 'test1', 'GC 1', 2, 2, '2m2 x 2m2', 1, 1, 1, 'ks', 1, '1', NULL, NULL, NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `tb_order_detail` ENABLE KEYS */;

-- Dumping structure for table vadv_cms.tb_print_sub
CREATE TABLE IF NOT EXISTS `tb_print_sub` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sub_name` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `price_type` tinyint(1) DEFAULT NULL,
  `type_name` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `is_delete` tinyint(1) DEFAULT '0',
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table vadv_cms.tb_print_sub: ~2 rows (approximately)
/*!40000 ALTER TABLE `tb_print_sub` DISABLE KEYS */;
INSERT INTO `tb_print_sub` (`id`, `name`, `sub_name`, `price_type`, `type_name`, `is_delete`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
	(38, 'Loại 3', 'phụ', 3, 'tam', 0, 3, 3, '2022-05-10 15:07:03', '2022-05-10 15:07:03'),
	(39, 'loai 4', 'laoi 4', 4, 'ks', 0, 3, 3, '2022-05-10 17:15:08', '2022-05-10 17:15:08');
/*!40000 ALTER TABLE `tb_print_sub` ENABLE KEYS */;

-- Dumping structure for table vadv_cms.tb_print_sub_manufacture
CREATE TABLE IF NOT EXISTS `tb_print_sub_manufacture` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0',
  `sub_type` tinyint(1) DEFAULT NULL,
  `print_id` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=175 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table vadv_cms.tb_print_sub_manufacture: ~7 rows (approximately)
/*!40000 ALTER TABLE `tb_print_sub_manufacture` DISABLE KEYS */;
INSERT INTO `tb_print_sub_manufacture` (`id`, `name`, `sub_type`, `print_id`) VALUES
	(168, 'test1', 1, 38),
	(169, 'GC 1', 2, 38),
	(170, 'A1', 3, 38),
	(171, 'A2', 3, 38),
	(172, 'A3', 3, 38),
	(173, 'test1', 1, 39),
	(174, 'GC 1', 2, 39);
/*!40000 ALTER TABLE `tb_print_sub_manufacture` ENABLE KEYS */;

-- Dumping structure for table vadv_cms.tb_revenue
CREATE TABLE IF NOT EXISTS `tb_revenue` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `phone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `note` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `amount` bigint DEFAULT NULL,
  `url` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `file_name` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` int DEFAULT NULL,
  `created_by` int DEFAULT '0',
  `updated_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table vadv_cms.tb_revenue: ~0 rows (approximately)
/*!40000 ALTER TABLE `tb_revenue` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_revenue` ENABLE KEYS */;

-- Dumping structure for table vadv_cms.tb_role
CREATE TABLE IF NOT EXISTS `tb_role` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `decription` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table vadv_cms.tb_role: ~2 rows (approximately)
/*!40000 ALTER TABLE `tb_role` DISABLE KEYS */;
INSERT INTO `tb_role` (`id`, `name`, `decription`) VALUES
	(1, 'ADMIN', 'Quản trị viên'),
	(2, 'USER', 'Thành viên');
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
  `is_delete` int NOT NULL DEFAULT '0',
  `role_id` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`user_name`) USING BTREE,
  KEY `FK_tb_user_tb_role` (`role_id`),
  CONSTRAINT `FK_tb_user_tb_role` FOREIGN KEY (`role_id`) REFERENCES `tb_role` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table vadv_cms.users: ~5 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `user_name`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `is_delete`, `role_id`) VALUES
	(3, 'admin', 'admin', NULL, '$2y$10$qdYvNoUBf1RIYApEDlV5Yu7ypkqD1C1xVtS/WiJWA/8yM1KP93JpK', NULL, '2022-03-19 10:45:47', '2022-04-05 18:05:01', 0, 1),
	(4, 'Westen Union', 'abc', NULL, '$2y$10$x2vqngAftpLpduTkynPYTelD48BKH9VmWhNBOQY9ojZFMPSlkZNNu', NULL, '2022-04-01 11:07:41', '2022-04-01 15:11:48', 0, 1),
	(5, 'test', 'abc1', NULL, '$2y$10$8lnpdZXmy6wXOwJ6lf6wPulEoqtwgNCegyJn3hNf/LhFfvDxc19EO', NULL, '2022-04-01 11:10:15', '2022-04-01 15:06:16', 0, 2),
	(6, 'Westen Union', '24', NULL, '$2y$10$iS3zwffiTMQoEBvK.ObGiuJU/Jfm88rHuXKUOCf6YNOEldKBJf1ha', NULL, '2022-04-01 11:12:26', '2022-04-01 15:18:33', 1, 2),
	(7, 'member', 'member', NULL, '$2y$10$nelDszcqkbU6MJqYIkoJ7Omhm1kZk.E88B6kAlLoOEA4dbsz6vzGe', NULL, '2022-04-02 07:03:01', '2022-04-02 07:03:01', 0, 2);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
