-- Adminer 4.7.7 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `coas`;
CREATE TABLE `coas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` bigint(20) unsigned DEFAULT NULL,
  `no_coa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cabang_id` bigint(20) unsigned DEFAULT NULL,
  `saldo_normal` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) unsigned DEFAULT NULL,
  `updated_by` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `coas_category_id_foreign` (`category_id`),
  KEY `coas_cabang_id_foreign` (`cabang_id`),
  KEY `coas_created_by_foreign` (`created_by`),
  KEY `coas_updated_by_foreign` (`updated_by`),
  CONSTRAINT `coas_cabang_id_foreign` FOREIGN KEY (`cabang_id`) REFERENCES `m_cabangs` (`id`),
  CONSTRAINT `coas_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `coa_categories` (`id`),
  CONSTRAINT `coas_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  CONSTRAINT `coas_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `coas` (`id`, `category_id`, `no_coa`, `nama`, `cabang_id`, `saldo_normal`, `is_active`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1,	1,	'1.01.01.01.01',	'Kas',	1,	'debit',	1,	'2021-04-11 07:24:51',	'2021-04-11 14:53:39',	1,	1),
(3,	7,	'1.02.01.01.01',	'Potongan Penjualan',	1,	'debit',	1,	'2021-04-17 08:00:42',	'2021-04-17 08:00:42',	1,	1),
(4,	3,	'1.03.01.01.01.',	'Hutang Pajak',	1,	'credit',	1,	'2021-04-17 08:03:15',	'2021-04-17 08:03:15',	1,	1),
(5,	7,	'1.04.01.01.01',	'Penjualan',	1,	'credit',	1,	'2021-04-17 08:05:32',	'2021-04-17 08:05:32',	1,	1),
(6,	3,	'11618974272',	'Biaya Gaji',	1,	'debit',	1,	'2021-04-21 03:05:27',	'2021-04-21 03:07:25',	1,	1),
(7,	3,	'11618974331',	'Biaya Perlengkapan',	1,	'debit',	1,	'2021-04-21 03:05:41',	'2021-04-21 03:07:37',	1,	1),
(8,	3,	'11618974350',	'Biaya Pemeliharaan',	1,	'debit',	1,	'2021-04-21 03:05:58',	'2021-04-21 03:08:21',	1,	1),
(9,	3,	'11618974519',	'Biaya Telepon',	1,	'debit',	1,	'2021-04-21 03:08:49',	'2021-04-21 03:08:49',	1,	1),
(10,	3,	'11618974532',	'Biaya Listrik',	1,	'debit',	1,	'2021-04-21 03:09:00',	'2021-04-21 03:09:00',	1,	1),
(11,	3,	'11618974547',	'Biaya Air',	1,	'debit',	1,	'2021-04-21 03:09:19',	'2021-04-21 03:09:19',	1,	1),
(12,	3,	'11618974667',	'Biaya Asuransi',	1,	'debit',	1,	'2021-04-21 03:11:17',	'2021-04-21 03:14:12',	1,	1),
(13,	3,	'11618974691',	'Biaya Bunga',	1,	'debit',	1,	'2021-04-21 03:11:42',	'2021-04-21 03:14:23',	1,	1),
(14,	3,	'11618974761',	'Biaya Sewa',	1,	'debit',	1,	'2021-04-21 03:12:52',	'2021-04-21 03:14:34',	1,	1),
(15,	3,	'11618974778',	'Biaya Iklan',	1,	'debit',	1,	'2021-04-21 03:13:04',	'2021-04-21 03:14:51',	1,	1),
(16,	3,	'11618974791',	'Biaya Transportasi',	1,	'debit',	1,	'2021-04-21 03:13:17',	'2021-04-21 03:15:03',	1,	1);

DROP TABLE IF EXISTS `coa_categories`;
CREATE TABLE `coa_categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` int(11) DEFAULT NULL,
  `cabang_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) unsigned NOT NULL,
  `updated_by` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `coa_categories_cabang_id_foreign` (`cabang_id`),
  CONSTRAINT `coa_categories_cabang_id_foreign` FOREIGN KEY (`cabang_id`) REFERENCES `m_cabangs` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `coa_categories` (`id`, `nama`, `is_active`, `cabang_id`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1,	'Assets',	1,	1,	'2021-04-08 08:35:13',	'2021-04-21 03:16:53',	1,	1),
(3,	'Liabilities',	1,	1,	'2021-04-11 07:40:17',	'2021-04-17 08:02:39',	1,	1),
(4,	'Modal',	1,	1,	'2021-04-11 07:40:23',	'2021-04-11 07:40:23',	1,	1),
(5,	'Pendapatan',	1,	1,	'2021-04-11 07:40:29',	'2021-04-11 07:40:29',	1,	1),
(6,	'Beban',	1,	1,	'2021-04-11 07:40:33',	'2021-04-11 07:40:33',	1,	1),
(7,	'Revenue',	1,	1,	'2021-04-17 07:59:50',	'2021-04-17 07:59:50',	1,	1),
(8,	'-',	1,	1,	'2021-04-21 03:03:32',	'2021-04-21 03:03:32',	1,	1);

DROP TABLE IF EXISTS `expenses`;
CREATE TABLE `expenses` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tanggal` datetime NOT NULL,
  `ref_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `coa_id` bigint(20) unsigned NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `cabang_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) unsigned NOT NULL,
  `updated_by` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `expenses_coa_id_foreign` (`coa_id`),
  KEY `expenses_cabang_id_foreign` (`cabang_id`),
  KEY `expenses_created_by_foreign` (`created_by`),
  KEY `expenses_updated_by_foreign` (`updated_by`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `expenses` (`id`, `tanggal`, `ref_no`, `coa_id`, `note`, `status`, `cabang_id`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1,	'2021-04-24 00:00:00',	'11619278354',	1,	'-',	1,	1,	'2021-04-24 15:32:47',	'2021-04-24 15:35:49',	1,	1);

DROP TABLE IF EXISTS `expense_lines`;
CREATE TABLE `expense_lines` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `expense_id` bigint(20) unsigned NOT NULL,
  `coa_id` bigint(20) unsigned NOT NULL,
  `nominal` double(15,2) NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `expense_lines_coa_id_foreign` (`coa_id`),
  KEY `expense_lines_expense_id_foreign` (`expense_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `expense_lines` (`id`, `expense_id`, `coa_id`, `nominal`, `note`, `created_at`, `updated_at`) VALUES
(2,	1,	9,	155000.00,	'Wifi',	'2021-04-24 15:35:49',	'2021-04-24 15:35:49'),
(3,	1,	16,	25000.00,	'Bensin',	'2021-04-24 15:35:49',	'2021-04-24 15:35:49');

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `incomes`;
CREATE TABLE `incomes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tanggal` datetime NOT NULL,
  `ref_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `coa_id` bigint(20) unsigned NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `cabang_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) unsigned NOT NULL,
  `updated_by` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `incomes_coa_id_foreign` (`coa_id`),
  KEY `incomes_cabang_id_foreign` (`cabang_id`),
  KEY `incomes_created_by_foreign` (`created_by`),
  KEY `incomes_updated_by_foreign` (`updated_by`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `incomes` (`id`, `tanggal`, `ref_no`, `coa_id`, `note`, `status`, `cabang_id`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(14,	'2021-04-22 00:00:00',	'11619039030',	1,	'-',	1,	1,	'2021-04-21 21:04:07',	'2021-04-21 21:05:20',	1,	1);

DROP TABLE IF EXISTS `income_lines`;
CREATE TABLE `income_lines` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `income_id` bigint(20) unsigned NOT NULL,
  `coa_id` bigint(20) unsigned NOT NULL,
  `nominal` double(15,2) NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `income_lines_coa_id_foreign` (`coa_id`),
  KEY `income_lines_income_id_foreign` (`income_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `income_lines` (`id`, `income_id`, `coa_id`, `nominal`, `note`, `created_at`, `updated_at`) VALUES
(1,	1,	3,	34353453.00,	'hj',	'2021-04-20 22:50:02',	'2021-04-20 22:50:02'),
(2,	2,	4,	10000.00,	'-',	'2021-04-20 22:51:43',	'2021-04-20 22:51:43'),
(3,	3,	3,	76876867.00,	'ikj',	'2021-04-20 22:52:23',	'2021-04-20 22:52:23'),
(4,	4,	4,	4543543.00,	NULL,	'2021-04-20 22:52:30',	'2021-04-20 22:52:30'),
(5,	5,	4,	9999.00,	NULL,	'2021-04-20 22:53:02',	'2021-04-20 22:53:02'),
(6,	6,	3,	1.00,	'2',	'2021-04-20 23:00:01',	'2021-04-20 23:00:01'),
(7,	7,	3,	1.00,	NULL,	'2021-04-20 23:01:06',	'2021-04-20 23:01:06'),
(8,	7,	4,	2.00,	'2',	'2021-04-20 23:01:06',	'2021-04-20 23:01:06'),
(9,	8,	1,	3.00,	NULL,	'2021-04-20 23:01:25',	'2021-04-20 23:01:25'),
(10,	8,	3,	4.00,	'4',	'2021-04-20 23:01:25',	'2021-04-20 23:01:25'),
(11,	8,	5,	5.00,	NULL,	'2021-04-20 23:01:25',	'2021-04-20 23:01:25'),
(12,	9,	10,	500000.00,	'biaya listrik',	'2021-04-21 08:16:53',	'2021-04-21 08:16:53'),
(13,	9,	14,	750000.00,	'biaya sewa',	'2021-04-21 08:16:53',	'2021-04-21 08:16:53'),
(14,	10,	10,	500000.00,	'biaya listrik',	'2021-04-21 08:19:26',	'2021-04-21 08:19:26'),
(15,	10,	15,	1000000.00,	'biaya iklan',	'2021-04-21 08:19:26',	'2021-04-21 08:19:26'),
(29,	11,	10,	500000.00,	'listrik',	'2021-04-21 20:52:58',	'2021-04-21 20:52:58'),
(18,	12,	10,	500000.00,	'listrik',	'2021-04-21 14:20:14',	'2021-04-21 14:20:14'),
(19,	12,	15,	100000.00,	'iklan',	'2021-04-21 14:20:14',	'2021-04-21 14:20:14'),
(20,	12,	14,	1500000.00,	'Biaya Sewa',	'2021-04-21 14:20:14',	'2021-04-21 14:20:14'),
(28,	11,	15,	100000.00,	'iklan',	'2021-04-21 20:52:58',	'2021-04-21 20:52:58'),
(30,	11,	12,	15000.00,	NULL,	'2021-04-21 20:52:58',	'2021-04-21 20:52:58'),
(32,	13,	10,	500000.00,	'listrik',	'2021-04-21 21:02:37',	'2021-04-21 21:02:37'),
(33,	13,	14,	750000.00,	'Biaya Sewa',	'2021-04-21 21:02:37',	'2021-04-21 21:02:37'),
(38,	14,	10,	500000.00,	'biaya listrik',	'2021-04-21 21:05:20',	'2021-04-21 21:05:20'),
(37,	14,	16,	150000.00,	'tol',	'2021-04-21 21:05:20',	'2021-04-21 21:05:20'),
(39,	14,	12,	25000.00,	'asuransi',	'2021-04-21 21:05:20',	'2021-04-21 21:05:20');

DROP TABLE IF EXISTS `ledgers`;
CREATE TABLE `ledgers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tanggal` datetime NOT NULL,
  `ledger_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ref_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `cabang_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) unsigned NOT NULL,
  `updated_by` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ledgers_cabang_id_foreign` (`cabang_id`),
  KEY `ledgers_created_by_foreign` (`created_by`),
  KEY `ledgers_updated_by_foreign` (`updated_by`),
  CONSTRAINT `ledgers_cabang_id_foreign` FOREIGN KEY (`cabang_id`) REFERENCES `m_cabangs` (`id`),
  CONSTRAINT `ledgers_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  CONSTRAINT `ledgers_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `ledgers` (`id`, `tanggal`, `ledger_number`, `ref_no`, `type`, `status`, `cabang_id`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(3,	'2021-04-18 00:00:00',	'jurnal-1618707602',	'210418080002',	NULL,	NULL,	1,	'2021-04-18 01:00:02',	'2021-04-18 01:00:02',	1,	1),
(4,	'2021-04-18 00:00:00',	'jurnal-1618707760',	'210418080239',	NULL,	NULL,	1,	'2021-04-18 01:02:40',	'2021-04-18 01:02:40',	1,	1),
(5,	'2021-04-18 00:00:00',	'jurnal-1618710715',	'210418085155',	NULL,	NULL,	1,	'2021-04-18 01:51:55',	'2021-04-18 01:51:55',	1,	1),
(6,	'2021-04-18 00:00:00',	'jurnal-1618710973',	'1210418085613',	NULL,	NULL,	1,	'2021-04-18 01:56:13',	'2021-04-18 01:56:13',	1,	1),
(12,	'2021-04-22 00:00:00',	'income-1-1619039120',	'11619039030',	'income',	NULL,	1,	'2021-04-21 21:05:20',	'2021-04-21 21:05:20',	1,	1),
(14,	'2021-04-24 00:00:00',	'expense-1-1619278550',	'11619278354',	'expense',	NULL,	1,	'2021-04-24 15:35:50',	'2021-04-24 15:35:50',	1,	1);

DROP TABLE IF EXISTS `ledger_lines`;
CREATE TABLE `ledger_lines` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `ledger_id` bigint(20) unsigned NOT NULL,
  `coa_id` bigint(20) unsigned NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `debit` double(15,2) NOT NULL,
  `credit` double(15,2) NOT NULL,
  `cabang_id` bigint(20) unsigned NOT NULL,
  `tanggal` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ledger_lines_cabang_id_foreign` (`cabang_id`),
  KEY `ledger_lines_coa_id_foreign` (`coa_id`),
  KEY `ledger_id` (`ledger_id`),
  CONSTRAINT `ledger_lines_cabang_id_foreign` FOREIGN KEY (`cabang_id`) REFERENCES `m_cabangs` (`id`),
  CONSTRAINT `ledger_lines_coa_id_foreign` FOREIGN KEY (`coa_id`) REFERENCES `coas` (`id`) ON DELETE CASCADE,
  CONSTRAINT `ledger_lines_ibfk_1` FOREIGN KEY (`ledger_id`) REFERENCES `ledgers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `ledger_lines` (`id`, `ledger_id`, `coa_id`, `description`, `debit`, `credit`, `cabang_id`, `tanggal`, `created_at`, `updated_at`) VALUES
(6,	3,	1,	'Kas',	11880.00,	0.00,	1,	'2021-04-18 00:00:00',	'2021-04-18 01:00:02',	'2021-04-18 01:00:02'),
(7,	3,	3,	'Potongan Penjualan',	1200.00,	0.00,	1,	'2021-04-18 00:00:00',	'2021-04-18 01:00:02',	'2021-04-18 01:00:02'),
(8,	3,	4,	'Hutang Pajak',	0.00,	1080.00,	1,	'2021-04-18 00:00:00',	'2021-04-18 01:00:02',	'2021-04-18 01:00:02'),
(9,	3,	5,	'Penjualan',	0.00,	12000.00,	1,	'2021-04-18 00:00:00',	'2021-04-18 01:00:02',	'2021-04-18 01:00:02'),
(10,	4,	1,	'Kas',	28000.00,	0.00,	1,	'2021-04-18 00:00:00',	'2021-04-18 01:02:40',	'2021-04-18 01:02:40'),
(11,	4,	5,	'Penjualan',	0.00,	28000.00,	1,	'2021-04-18 00:00:00',	'2021-04-18 01:02:40',	'2021-04-18 01:02:40'),
(12,	5,	1,	'Kas',	12276.00,	0.00,	1,	'2021-04-18 00:00:00',	'2021-04-18 01:51:55',	'2021-04-18 01:51:55'),
(13,	5,	3,	'Potongan Penjualan',	840.00,	0.00,	1,	'2021-04-18 00:00:00',	'2021-04-18 01:51:55',	'2021-04-18 01:51:55'),
(14,	5,	4,	'Hutang Pajak',	0.00,	1116.00,	1,	'2021-04-18 00:00:00',	'2021-04-18 01:51:55',	'2021-04-18 01:51:55'),
(15,	5,	5,	'Penjualan',	0.00,	12000.00,	1,	'2021-04-18 00:00:00',	'2021-04-18 01:51:55',	'2021-04-18 01:51:55'),
(16,	6,	1,	'Kas',	68000.00,	0.00,	1,	'2021-04-18 00:00:00',	'2021-04-18 01:56:13',	'2021-04-18 01:56:13'),
(17,	6,	5,	'Penjualan',	0.00,	68000.00,	1,	'2021-04-18 00:00:00',	'2021-04-18 01:56:13',	'2021-04-18 01:56:13'),
(32,	12,	10,	'biaya listrik',	0.00,	500000.00,	1,	'2021-04-22 00:00:00',	'2021-04-21 21:05:20',	'2021-04-21 21:05:20'),
(33,	12,	16,	'tol',	0.00,	150000.00,	1,	'2021-04-22 00:00:00',	'2021-04-21 21:05:20',	'2021-04-21 21:05:20'),
(34,	12,	12,	'asuransi',	0.00,	25000.00,	1,	'2021-04-22 00:00:00',	'2021-04-21 21:05:20',	'2021-04-21 21:05:20'),
(35,	12,	1,	'-',	675000.00,	0.00,	1,	'2021-04-22 00:00:00',	'2021-04-21 21:05:20',	'2021-04-21 21:05:20'),
(38,	14,	9,	'Wifi',	155000.00,	0.00,	1,	'2021-04-24 00:00:00',	'2021-04-24 15:35:50',	'2021-04-24 15:35:50'),
(39,	14,	16,	'Bensin',	25000.00,	0.00,	1,	'2021-04-24 00:00:00',	'2021-04-24 15:35:50',	'2021-04-24 15:35:50'),
(40,	14,	1,	'-',	0.00,	180000.00,	1,	'2021-04-24 00:00:00',	'2021-04-24 15:35:50',	'2021-04-24 15:35:50');

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1,	'2014_10_12_000000_create_users_table',	1),
(2,	'2014_10_12_100000_create_password_resets_table',	1),
(3,	'2014_10_12_200000_add_two_factor_columns_to_users_table',	1),
(4,	'2019_08_19_000000_create_failed_jobs_table',	1),
(5,	'2020_12_02_122640_create_sessions_table',	1),
(6,	'2019_12_14_000001_create_personal_access_tokens_table',	2),
(7,	'2020_12_02_224343_create_m_kontrakans_table',	2),
(8,	'2020_12_04_091728_create_m_roles_table',	2),
(9,	'2020_12_04_132143_role_users',	3),
(10,	'2020_05_21_100000_create_teams_table',	4),
(11,	'2020_05_21_200000_create_team_user_table',	4),
(12,	'2020_12_04_224038_create_m_permissions_table',	4),
(13,	'2020_12_05_134623_create_role_permissions_table',	5),
(14,	'2020_12_06_233229_create_m_customers_table',	6),
(15,	'2020_12_07_000132_alter_users_wa',	7),
(16,	'2020_12_07_001908_create_paket_laundries_table',	8),
(17,	'2020_12_07_224227_create_m_statuses_table',	8),
(18,	'2020_12_09_020318_create_transaksis_table',	9),
(19,	'2020_12_09_133509_create_transaksi_lines_table',	9),
(20,	'2020_12_12_122534_create_wa_templates_table',	10),
(21,	'2021_01_27_090657_create_m_profiles_table',	11),
(22,	'2021_03_31_222909_create_m_cabangs_table',	12),
(23,	'2021_03_31_223114_cabang_user',	13),
(24,	'2021_03_31_231427_cabang_paket',	14),
(25,	'2021_04_01_233334_cabang_transaksi',	15),
(26,	'2021_04_02_133552_cabang_roles',	16),
(27,	'2021_04_02_142101_cabang_prm_role',	17),
(28,	'2021_04_02_142254_cabang_m_permis',	18),
(29,	'2021_04_02_145649_cabang_m_profil',	19),
(30,	'2021_04_02_154858_create_m_satuans_table',	20),
(31,	'2021_04_03_021853_status_paket',	21),
(32,	'2021_04_03_140537_customer_users',	22),
(33,	'2021_04_04_050750_create_m_produks_table',	23),
(34,	'2021_04_04_052125_create_m_suppliers_table',	23),
(35,	'2021_04_08_025941_create_coa_categories_table',	24),
(36,	'2021_04_08_152411_saldo_cabang',	25),
(37,	'2021_04_08_152425_coa_categori',	25),
(38,	'2021_04_10_225912_create_coas_table',	26),
(40,	'2021_04_12_085315_create_ledgers_table',	27),
(41,	'2021_04_12_085342_create_ledger_lines_table',	27),
(44,	'2021_04_18_204735_create_incomes_table',	28),
(45,	'2021_04_18_205313_create_income_lines_table',	28),
(46,	'2021_04_24_122638_create_expenses_table',	29),
(47,	'2021_04_24_122641_create_expense_lines_table',	29);

DROP TABLE IF EXISTS `m_cabangs`;
CREATE TABLE `m_cabangs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `saldo` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `m_cabangs` (`id`, `kode`, `nama`, `created_at`, `updated_at`, `saldo`) VALUES
(1,	'DE',	'DEMO',	NULL,	'2021-04-18 01:56:13',	3600),
(2,	'SHFL',	'Shafa Laundry',	NULL,	NULL,	NULL);

DROP TABLE IF EXISTS `m_permissions`;
CREATE TABLE `m_permissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `cabang_id` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `m_permissions_cabang_id_foreign` (`cabang_id`),
  CONSTRAINT `m_permissions_cabang_id_foreign` FOREIGN KEY (`cabang_id`) REFERENCES `m_cabangs` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `m_permissions` (`id`, `title`, `keterangan`, `created_at`, `updated_at`, `cabang_id`) VALUES
(1,	'list-role',	'Melihat List Role',	'2020-12-05 03:38:53',	'2020-12-05 03:38:53',	NULL),
(2,	'create-role',	'Menambah data Role',	'2020-12-05 03:40:53',	'2020-12-05 03:40:53',	NULL),
(3,	'edit-role',	'Mengedit Data Role',	'2020-12-05 03:41:02',	'2020-12-05 03:41:02',	NULL),
(4,	'delete-role',	'Menghapus data role',	'2020-12-05 03:41:16',	'2020-12-05 03:41:16',	NULL),
(5,	'list-user',	'Melihat List User',	'2020-12-05 03:44:44',	'2020-12-05 03:44:44',	NULL),
(6,	'create-user',	'Menambah Data User',	'2020-12-05 03:44:56',	'2020-12-05 03:44:56',	NULL),
(7,	'edit-user',	'Mengedit Data User',	'2020-12-05 03:45:13',	'2020-12-05 03:45:13',	NULL),
(8,	'delete-user',	'menghapus Data User',	'2020-12-05 03:45:26',	'2020-12-05 03:45:26',	NULL),
(9,	'manage-permission',	'Mengatur permission pada masing2 role',	'2020-12-05 03:47:14',	'2020-12-05 03:47:14',	NULL),
(10,	'delete-manage-permission',	'Menghapus permission pada sebuah role',	'2020-12-05 07:14:40',	'2020-12-05 07:14:40',	NULL),
(11,	'list-permissions',	'Melihat List Master Permission',	'2020-12-05 07:30:22',	'2020-12-05 07:30:22',	NULL),
(12,	'create-permissions',	'Menambahkan Data Master Permissions',	'2020-12-05 07:30:40',	'2020-12-05 07:30:40',	NULL),
(13,	'change-password',	'Mengganti Password',	'2020-12-06 15:25:23',	'2020-12-06 15:25:23',	NULL),
(15,	'list-paket-laundry',	'Melihat List Paket Laundry',	'2020-12-07 15:50:38',	'2020-12-07 15:50:38',	NULL),
(16,	'create-paket-laundry',	'Tambah data paket laundry',	'2020-12-08 02:10:41',	'2020-12-08 02:10:41',	NULL),
(17,	'edit-paket-laundry',	'Edit Data Paket Laundry',	'2020-12-08 02:14:29',	'2020-12-08 02:14:29',	NULL),
(18,	'delete-paket-laundry',	'Menghapus Data Paket Laundry',	'2020-12-08 02:36:54',	'2020-12-08 02:36:54',	NULL),
(19,	'update-status-paket-laundry',	'Update Status Paket Laundry',	'2020-12-08 07:08:34',	'2020-12-08 07:08:34',	NULL),
(20,	'list-all-transaksi',	'Melihat List All Transaksi',	'2020-12-12 06:05:06',	'2020-12-12 06:05:06',	NULL),
(21,	'create-transaksi',	'Create Transaksi',	'2020-12-12 06:11:51',	'2020-12-12 06:11:51',	NULL),
(22,	'list-transaksi-ku',	'Melihat List Transaksi Ku Per Customer',	'2020-12-15 08:06:16',	'2020-12-15 08:06:16',	NULL),
(23,	'dashboard',	'Melihat Dashboard Admin',	'2020-12-15 08:33:43',	'2020-12-15 08:33:43',	NULL),
(24,	'wa-token',	'Mengubah WA Token',	'2020-12-15 08:41:18',	'2020-12-15 08:41:18',	NULL),
(25,	'update-company-profile',	'Update Company Profile',	'2021-01-27 08:03:42',	'2021-01-27 08:03:42',	NULL),
(26,	'update-status-bayar-transaksi',	'Update Status Bayar Transaksi',	'2021-04-03 09:05:05',	'2021-04-03 09:05:05',	NULL),
(27,	'update-status-pengerjaan-transaksi',	'Update Status Pengerjaan Transaksi',	'2021-04-03 09:06:25',	'2021-04-03 09:06:25',	NULL),
(28,	'delete-transaksi',	'Delete Transaksi',	'2021-04-03 09:09:19',	'2021-04-03 09:09:19',	NULL),
(29,	'edit-transaksi',	'Edit Transaksi',	'2021-04-03 09:10:38',	'2021-04-03 09:10:38',	NULL),
(30,	'view-transaksi',	'View Detail Transaksi',	'2021-04-03 09:11:20',	'2021-04-03 09:11:20',	NULL);

DROP TABLE IF EXISTS `m_produks`;
CREATE TABLE `m_produks` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `min_qty` int(11) DEFAULT NULL,
  `tax` int(11) DEFAULT NULL,
  `order_tax` int(11) DEFAULT NULL,
  `supplier_id` bigint(20) unsigned DEFAULT NULL,
  `is_active` int(11) DEFAULT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cabang_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `m_produks_cabang_id_foreign` (`cabang_id`),
  CONSTRAINT `m_produks_cabang_id_foreign` FOREIGN KEY (`cabang_id`) REFERENCES `m_cabangs` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `m_profiles`;
CREATE TABLE `m_profiles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `greeting_notif` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `cabang_id` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `m_profiles_cabang_id_foreign` (`cabang_id`),
  CONSTRAINT `m_profiles_cabang_id_foreign` FOREIGN KEY (`cabang_id`) REFERENCES `m_cabangs` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `m_profiles` (`id`, `nama`, `alamat`, `greeting_notif`, `created_at`, `updated_at`, `cabang_id`) VALUES
(1,	'Sangcahaya.com',	'Pondok Melati Bekasi 17415',	'Assalaamualaikum.. Berikut adalah data tagihan kamu',	'2021-01-27 02:24:20',	'2021-01-27 02:24:20',	1);

DROP TABLE IF EXISTS `m_roles`;
CREATE TABLE `m_roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `cabang_id` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `m_roles_cabang_id_foreign` (`cabang_id`),
  CONSTRAINT `m_roles_cabang_id_foreign` FOREIGN KEY (`cabang_id`) REFERENCES `m_cabangs` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `m_roles` (`id`, `nama`, `created_at`, `updated_at`, `cabang_id`) VALUES
(1,	'Super Admin',	'2020-12-04 03:23:44',	'2020-12-05 15:21:09',	1),
(2,	'Customer',	'2020-12-04 03:24:14',	'2021-04-02 06:51:50',	1),
(4,	'Admin',	'2020-12-06 17:07:44',	'2020-12-06 17:07:44',	1),
(6,	'test',	'2021-04-02 06:53:10',	'2021-04-02 06:53:10',	1);

DROP TABLE IF EXISTS `m_satuans`;
CREATE TABLE `m_satuans` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `m_satuans` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(1,	'Pcs',	NULL,	NULL),
(2,	'Gram',	NULL,	NULL),
(3,	'Kg',	NULL,	NULL),
(4,	'Box',	NULL,	NULL),
(5,	'Sachet',	NULL,	NULL);

DROP TABLE IF EXISTS `m_statuses`;
CREATE TABLE `m_statuses` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `m_statuses` (`id`, `nama`, `color`, `created_at`, `updated_at`) VALUES
(1,	'Aktif',	'success',	NULL,	NULL),
(2,	'Tidak Aktif',	'danger',	NULL,	NULL),
(3,	'Sudah Dibayar',	'success',	NULL,	NULL),
(4,	'Belum Dibayar',	'warning',	NULL,	NULL),
(5,	'Sedang Dikerjakan',	'info',	NULL,	NULL),
(6,	'Selesai',	'success',	NULL,	NULL),
(7,	'Menunggu',	'info',	NULL,	NULL),
(8,	'Sachet',	'',	NULL,	NULL);

DROP TABLE IF EXISTS `m_suppliers`;
CREATE TABLE `m_suppliers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_npwp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_telp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kota` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provinsi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat_lengkap` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kode_pos` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cabang_id` bigint(20) unsigned DEFAULT NULL,
  `is_active` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `m_suppliers_cabang_id_foreign` (`cabang_id`),
  CONSTRAINT `m_suppliers_cabang_id_foreign` FOREIGN KEY (`cabang_id`) REFERENCES `m_cabangs` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `m_suppliers` (`id`, `nama`, `company_name`, `no_npwp`, `no_telp`, `email`, `kota`, `provinsi`, `alamat_lengkap`, `kode_pos`, `cabang_id`, `is_active`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1,	'Warung Sebelah',	'Warung Sebelah',	'321',	NULL,	NULL,	'Bekasi',	NULL,	NULL,	NULL,	1,	1,	'2021-04-04 08:28:40',	'2021-04-07 10:49:58',	1,	1),
(2,	'Warung H. Ucok',	'Warung H. Ucok',	'123',	'089608498550',	'fadlyrifai95@gmail.com',	'Bekasi',	'Jawa Barat',	'Bekasi',	'17425',	1,	NULL,	'2021-04-04 08:30:02',	'2021-04-07 10:49:35',	1,	1);

DROP TABLE IF EXISTS `paket_laundries`;
CREATE TABLE `paket_laundries` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `harga` int(11) NOT NULL,
  `estimasi_pengerjaan` int(11) NOT NULL,
  `is_active` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `cabang_id` bigint(20) unsigned DEFAULT NULL,
  `satuan_id` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `paket_laundries_cabang_id_foreign` (`cabang_id`),
  KEY `paket_laundries_satuan_id_foreign` (`satuan_id`),
  CONSTRAINT `paket_laundries_cabang_id_foreign` FOREIGN KEY (`cabang_id`) REFERENCES `m_cabangs` (`id`),
  CONSTRAINT `paket_laundries_satuan_id_foreign` FOREIGN KEY (`satuan_id`) REFERENCES `m_satuans` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `paket_laundries` (`id`, `nama`, `keterangan`, `harga`, `estimasi_pengerjaan`, `is_active`, `created_at`, `updated_at`, `cabang_id`, `satuan_id`) VALUES
(1,	'Reguler',	'-',	4000,	3,	1,	'2021-04-03 00:15:49',	'2021-04-03 06:46:09',	1,	3);

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `role_permissions`;
CREATE TABLE `role_permissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` bigint(20) unsigned NOT NULL,
  `permission_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `cabang_id` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `role_permissions_role_id_foreign` (`role_id`),
  KEY `role_permissions_permission_id_foreign` (`permission_id`),
  KEY `role_permissions_cabang_id_foreign` (`cabang_id`),
  CONSTRAINT `role_permissions_cabang_id_foreign` FOREIGN KEY (`cabang_id`) REFERENCES `m_cabangs` (`id`),
  CONSTRAINT `role_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `m_permissions` (`id`),
  CONSTRAINT `role_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `m_roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `role_permissions` (`id`, `role_id`, `permission_id`, `created_at`, `updated_at`, `cabang_id`) VALUES
(1,	1,	1,	'2020-12-05 07:12:20',	'2020-12-05 07:12:20',	1),
(2,	1,	2,	'2020-12-05 07:13:34',	'2020-12-05 07:13:34',	1),
(3,	1,	3,	'2020-12-05 07:13:37',	'2020-12-05 07:13:37',	1),
(4,	1,	4,	'2020-12-05 07:13:39',	'2020-12-05 07:13:39',	1),
(7,	1,	7,	'2020-12-05 07:13:43',	'2020-12-05 07:13:43',	1),
(8,	1,	8,	'2020-12-05 07:13:44',	'2020-12-05 07:13:44',	1),
(12,	1,	5,	'2020-12-05 07:31:09',	'2020-12-05 07:31:09',	1),
(13,	1,	10,	'2020-12-05 15:21:20',	'2020-12-05 15:21:20',	1),
(14,	1,	11,	'2020-12-05 15:21:23',	'2020-12-05 15:21:23',	1),
(15,	1,	12,	'2020-12-05 15:21:26',	'2020-12-05 15:21:26',	1),
(16,	1,	6,	'2020-12-05 15:21:46',	'2020-12-05 15:21:46',	1),
(17,	1,	9,	'2020-12-05 15:23:28',	'2020-12-05 15:23:28',	1),
(18,	1,	13,	'2020-12-06 15:26:17',	'2020-12-06 15:26:17',	1),
(19,	1,	15,	'2020-12-07 16:02:11',	'2020-12-07 16:02:11',	1),
(20,	1,	16,	'2020-12-08 02:12:02',	'2020-12-08 02:12:02',	1),
(21,	1,	17,	'2020-12-08 02:17:22',	'2020-12-08 02:17:22',	1),
(22,	1,	18,	'2020-12-08 06:53:22',	'2020-12-08 06:53:22',	1),
(23,	1,	19,	'2020-12-08 07:09:53',	'2020-12-08 07:09:53',	1),
(24,	1,	20,	'2020-12-12 06:12:07',	'2020-12-12 06:12:07',	1),
(25,	1,	21,	'2020-12-12 06:12:10',	'2020-12-12 06:12:10',	1),
(28,	1,	22,	'2020-12-15 08:07:00',	'2020-12-15 08:07:00',	1),
(29,	2,	22,	'2020-12-15 08:07:47',	'2020-12-15 08:07:47',	1),
(30,	1,	23,	'2020-12-15 08:33:53',	'2020-12-15 08:33:53',	1),
(31,	4,	1,	'2020-12-15 08:34:30',	'2020-12-15 08:34:30',	1),
(32,	4,	5,	'2020-12-15 08:34:48',	'2020-12-15 08:34:48',	1),
(33,	4,	6,	'2020-12-15 08:34:52',	'2020-12-15 08:34:52',	1),
(34,	4,	7,	'2020-12-15 08:34:55',	'2020-12-15 08:34:55',	1),
(35,	4,	8,	'2020-12-15 08:34:57',	'2020-12-15 08:34:57',	1),
(36,	4,	11,	'2020-12-15 08:35:08',	'2020-12-15 08:35:08',	1),
(37,	4,	15,	'2020-12-15 08:35:18',	'2020-12-15 08:35:18',	1),
(38,	4,	16,	'2020-12-15 08:35:22',	'2020-12-15 08:35:22',	1),
(39,	4,	17,	'2020-12-15 08:35:26',	'2020-12-15 08:35:26',	1),
(40,	4,	18,	'2020-12-15 08:35:30',	'2020-12-15 08:35:30',	1),
(41,	4,	19,	'2020-12-15 08:35:39',	'2020-12-15 08:35:39',	1),
(42,	4,	20,	'2020-12-15 08:36:20',	'2020-12-15 08:36:20',	1),
(43,	4,	21,	'2020-12-15 08:36:24',	'2020-12-15 08:36:24',	1),
(44,	4,	22,	'2020-12-15 08:36:27',	'2020-12-15 08:36:27',	1),
(45,	4,	23,	'2020-12-15 08:36:30',	'2020-12-15 08:36:30',	1),
(46,	2,	15,	'2020-12-15 08:37:47',	'2020-12-15 08:37:47',	1),
(47,	1,	24,	'2020-12-15 08:41:35',	'2020-12-15 08:41:35',	1),
(48,	1,	25,	'2021-01-27 08:04:43',	'2021-01-27 08:04:43',	1),
(49,	4,	25,	'2021-01-27 08:05:02',	'2021-01-27 08:05:02',	1),
(52,	1,	30,	'2021-04-03 09:11:58',	'2021-04-03 09:11:58',	1);

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('jw1tvv3s7PMc1MX4TIDtVgwMSMUEcktkCfRuoSWV',	1,	'::1',	'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:78.0) Gecko/20100101 Firefox/78.0',	'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiS3pJb3pVNGVJUUN1S0pPem5GUE42SmdYYkFwV1pEREdQOTVNbEpyZiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjUwOiJodHRwOi8vbG9jYWxob3N0L2xhdW5kcnlfcGhwbXUvcHVibGljL2FkbWluL2p1cm5hbCI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czoxNzoicGFzc3dvcmRfaGFzaF93ZWIiO3M6NjA6IiQyeSQxMCRLOFgwZC9VNW9FdXRTZk40U0UvVGYud1VJeUE2dkVFaDlycnFOTWhEZnVyOU52OVJhRVREcSI7fQ==',	1619278559),
('LcvHnQyjfqOu08NQsioZ2wdik8JdRtkLR7h2eesL',	NULL,	'208.80.194.41',	'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.1.4322; .NET CLR 2.0.50728)',	'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYkRaTmtMN3o2YWtsa2EyYTlDN21MUE1GRndtRjdmMG4xV1FFdDkydCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHBzOi8vZGlsb25kcmkuY29tL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',	1619272613);

DROP TABLE IF EXISTS `teams`;
CREATE TABLE `teams` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_team` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `teams_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `team_user`;
CREATE TABLE `team_user` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `team_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `team_user_team_id_user_id_unique` (`team_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `transaksis`;
CREATE TABLE `transaksis` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `reference_no` varchar(115) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal` datetime NOT NULL,
  `harga_lines` int(11) DEFAULT NULL,
  `diskon` int(11) DEFAULT NULL,
  `total` float DEFAULT NULL,
  `tax` float(8,2) DEFAULT NULL,
  `order_tax` double(8,2) DEFAULT NULL,
  `grand_total_amount` double(8,2) DEFAULT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `created_by` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status_bayar` int(11) DEFAULT NULL,
  `status_pengerjaan` int(11) DEFAULT NULL,
  `cabang_id` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `transaksis_user_id_foreign` (`user_id`),
  KEY `transaksis_cabang_id_foreign` (`cabang_id`),
  CONSTRAINT `transaksis_cabang_id_foreign` FOREIGN KEY (`cabang_id`) REFERENCES `m_cabangs` (`id`),
  CONSTRAINT `transaksis_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `transaksis` (`id`, `reference_no`, `tanggal`, `harga_lines`, `diskon`, `total`, `tax`, `order_tax`, `grand_total_amount`, `user_id`, `created_by`, `created_at`, `updated_at`, `status_bayar`, `status_pengerjaan`, `cabang_id`) VALUES
(5,	'210403143906',	'2021-04-03 00:00:00',	28000,	1000,	28000,	10.00,	2700.00,	29700.00,	22,	1,	'2021-04-03 07:39:06',	'2021-04-03 07:39:46',	3,	6,	1),
(6,	'210408152740',	'2021-04-08 00:00:00',	8000,	0,	8000,	0.00,	0.00,	8000.00,	22,	1,	'2021-04-08 08:27:40',	'2021-04-08 08:27:40',	4,	7,	1),
(7,	'210408152816',	'2021-04-08 00:00:00',	8000,	0,	8000,	0.00,	0.00,	8000.00,	23,	1,	'2021-04-08 08:28:16',	'2021-04-08 08:28:16',	4,	7,	1),
(9,	'210417070552',	'2021-04-17 00:00:00',	9560,	1876,	9560,	10.00,	956.00,	10516.00,	22,	1,	'2021-04-17 00:05:52',	'2021-04-17 00:05:52',	4,	5,	1),
(10,	'210417071104',	'2021-04-17 00:00:00',	12000,	3000,	6000,	0.00,	0.00,	6000.00,	22,	1,	'2021-04-17 00:11:04',	'2021-04-17 00:11:04',	4,	7,	1),
(11,	'210417071140',	'2021-04-17 00:00:00',	12000,	3000,	6000,	10.00,	600.00,	6600.00,	22,	1,	'2021-04-17 00:11:40',	'2021-04-17 00:11:40',	4,	7,	1),
(12,	'210417071948',	'2021-04-17 00:00:00',	12000,	6000,	6000,	0.00,	0.00,	6000.00,	22,	1,	'2021-04-17 00:19:48',	'2021-04-17 00:19:48',	4,	7,	1),
(13,	'210417072014',	'2021-04-17 00:00:00',	28000,	14000,	14000,	10.00,	1400.00,	15400.00,	23,	1,	'2021-04-17 00:20:14',	'2021-04-17 00:20:14',	4,	7,	1),
(14,	'210417072447',	'2021-04-17 00:00:00',	32000,	11800,	20200,	10.00,	2020.00,	22220.00,	22,	1,	'2021-04-17 00:24:47',	'2021-04-17 00:24:47',	4,	7,	1),
(17,	'210417144052',	'2021-04-17 00:00:00',	16000,	1120,	14880,	0.00,	0.00,	14880.00,	22,	1,	'2021-04-17 07:40:52',	'2021-04-17 07:40:52',	4,	7,	1),
(18,	'210417162930',	'2021-04-17 00:00:00',	28000,	3600,	24400,	10.00,	2440.00,	26840.00,	23,	1,	'2021-04-17 09:29:30',	'2021-04-17 09:29:30',	4,	7,	1),
(19,	'210418080002',	'2021-04-18 00:00:00',	12000,	1200,	10800,	10.00,	1080.00,	11880.00,	22,	1,	'2021-04-18 01:00:02',	'2021-04-18 01:00:02',	4,	7,	1),
(20,	'210418080239',	'2021-04-18 00:00:00',	28000,	0,	28000,	0.00,	0.00,	28000.00,	22,	1,	'2021-04-18 01:02:39',	'2021-04-18 01:02:39',	4,	7,	1),
(21,	'210418085155',	'2021-04-18 00:00:00',	12000,	840,	11160,	10.00,	1116.00,	12276.00,	22,	1,	'2021-04-18 01:51:55',	'2021-04-18 01:51:55',	4,	7,	1),
(22,	'1210418085613',	'2021-04-18 00:00:00',	68000,	0,	68000,	0.00,	0.00,	68000.00,	22,	1,	'2021-04-18 01:56:13',	'2021-04-18 01:56:13',	4,	7,	1);

DROP TABLE IF EXISTS `transaksi_lines`;
CREATE TABLE `transaksi_lines` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `transaksi_id` bigint(20) unsigned NOT NULL,
  `paket_laundry_id` bigint(20) unsigned NOT NULL,
  `berat` double(8,2) NOT NULL,
  `harga` double(8,2) NOT NULL,
  `diskon` int(11) DEFAULT 0,
  `order_diskon` float(15,2) DEFAULT NULL,
  `total_harga` double(8,2) NOT NULL,
  `estimasi_selesai` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `transaksi_lines_transaksi_id_foreign` (`transaksi_id`),
  KEY `transaksi_lines_paket_laundry_id_foreign` (`paket_laundry_id`),
  CONSTRAINT `transaksi_lines_paket_laundry_id_foreign` FOREIGN KEY (`paket_laundry_id`) REFERENCES `paket_laundries` (`id`),
  CONSTRAINT `transaksi_lines_transaksi_id_foreign` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksis` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `transaksi_lines` (`id`, `transaksi_id`, `paket_laundry_id`, `berat`, `harga`, `diskon`, `order_diskon`, `total_harga`, `estimasi_selesai`, `created_at`, `updated_at`) VALUES
(7,	5,	1,	7.00,	4000.00,	0,	NULL,	28000.00,	'2021-04-06 00:00:00',	'2021-04-03 07:39:06',	'2021-04-03 07:39:06'),
(8,	6,	1,	2.00,	4000.00,	0,	NULL,	8000.00,	'2021-04-11 00:00:00',	'2021-04-08 08:27:40',	'2021-04-08 08:27:40'),
(9,	7,	1,	2.00,	4000.00,	0,	NULL,	8000.00,	'2021-04-11 00:00:00',	'2021-04-08 08:28:16',	'2021-04-08 08:28:16'),
(12,	9,	1,	2.00,	4000.00,	15,	1020.00,	6800.00,	'2021-04-20 00:00:00',	'2021-04-17 00:05:52',	'2021-04-17 00:05:52'),
(13,	9,	1,	1.00,	4000.00,	31,	855.60,	2760.00,	'2021-04-20 00:00:00',	'2021-04-17 00:05:52',	'2021-04-17 00:05:52'),
(14,	10,	1,	3.00,	4000.00,	50,	3000.00,	6000.00,	'2021-04-20 00:00:00',	'2021-04-17 00:11:04',	'2021-04-17 00:11:04'),
(15,	11,	1,	3.00,	4000.00,	50,	3000.00,	6000.00,	'2021-04-20 00:00:00',	'2021-04-17 00:11:40',	'2021-04-17 00:11:40'),
(16,	12,	1,	3.00,	4000.00,	50,	6000.00,	6000.00,	'2021-04-20 00:00:00',	'2021-04-17 00:19:48',	'2021-04-17 00:19:48'),
(17,	13,	1,	7.00,	4000.00,	50,	14000.00,	14000.00,	'2021-04-20 00:00:00',	'2021-04-17 00:20:14',	'2021-04-17 00:20:14'),
(18,	14,	1,	3.00,	4000.00,	15,	1800.00,	10200.00,	'2021-04-20 00:00:00',	'2021-04-17 00:24:47',	'2021-04-17 00:24:47'),
(19,	14,	1,	5.00,	4000.00,	50,	10000.00,	10000.00,	'2021-04-20 00:00:00',	'2021-04-17 00:24:47',	'2021-04-17 00:24:47'),
(22,	17,	1,	4.00,	4000.00,	7,	1120.00,	14880.00,	'2021-04-20 00:00:00',	'2021-04-17 07:40:52',	'2021-04-17 07:40:52'),
(23,	18,	1,	2.00,	4000.00,	5,	400.00,	7600.00,	'2021-04-20 00:00:00',	'2021-04-17 09:29:30',	'2021-04-17 09:29:30'),
(24,	18,	1,	5.00,	4000.00,	16,	3200.00,	16800.00,	'2021-04-20 00:00:00',	'2021-04-17 09:29:30',	'2021-04-17 09:29:30'),
(25,	19,	1,	3.00,	4000.00,	10,	1200.00,	10800.00,	'2021-04-21 00:00:00',	'2021-04-18 01:00:02',	'2021-04-18 01:00:02'),
(26,	20,	1,	7.00,	4000.00,	0,	0.00,	28000.00,	'2021-04-21 00:00:00',	'2021-04-18 01:02:39',	'2021-04-18 01:02:39'),
(27,	21,	1,	3.00,	4000.00,	7,	840.00,	11160.00,	'2021-04-21 00:00:00',	'2021-04-18 01:51:55',	'2021-04-18 01:51:55'),
(28,	22,	1,	17.00,	4000.00,	0,	0.00,	68000.00,	'2021-04-21 00:00:00',	'2021-04-18 01:56:13',	'2021-04-18 01:56:13');

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_team_id` bigint(20) unsigned DEFAULT NULL,
  `profile_photo_path` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role_id` bigint(20) unsigned DEFAULT NULL,
  `no_telp` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenis_kelamin` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cabang_id` bigint(20) unsigned DEFAULT NULL,
  `is_customer` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_role_id` (`role_id`),
  KEY `users_cabang_id_foreign` (`cabang_id`),
  CONSTRAINT `users_cabang_id_foreign` FOREIGN KEY (`cabang_id`) REFERENCES `m_cabangs` (`id`),
  CONSTRAINT `users_role_id` FOREIGN KEY (`role_id`) REFERENCES `m_roles` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`, `role_id`, `no_telp`, `jenis_kelamin`, `alamat`, `cabang_id`, `is_customer`) VALUES
(1,	'admin',	'superadmin@admin.com',	NULL,	'$2y$10$K8X0d/U5oEutSfN4SE/Tf.wUIyA6vEEh9rrqNMhDfur9Nv9RaETDq',	NULL,	NULL,	NULL,	NULL,	NULL,	'2020-12-02 05:30:15',	'2020-12-15 08:34:04',	1,	NULL,	NULL,	NULL,	1,	NULL),
(2,	'Customer 1',	'customer1@gmail.com',	NULL,	'$2y$10$QRjEJ.83GJVeask3HWiQZeOcL/OqUo.xQ1fIL6e0.x.EGGqU.7Fyq',	NULL,	NULL,	NULL,	NULL,	NULL,	'2020-12-04 15:13:33',	'2021-03-19 19:32:32',	2,	'089608498550',	'w',	'Bekasi',	1,	NULL),
(7,	'Admin',	'admin@admin.com',	NULL,	'$2y$10$3hne2NXpscaA70rUNhUFnOQAcWFDMO6DVHuS7/deulsHZXHokn1UC',	NULL,	NULL,	NULL,	NULL,	NULL,	'2020-12-15 08:42:58',	'2021-04-03 07:25:23',	4,	'089608498550',	'p',	'Bekasi',	1,	NULL),
(17,	'pai',	'pai@pai.com',	NULL,	'$2y$10$Gt4aB9sFa5BSibaUa./vYu19WWd2TFRrUL.tF/spSI1.1INn8mCRu',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'2021-04-03 07:33:55',	2,	'089608498550',	'p',	'Bekasi',	1,	NULL),
(21,	'user cabang',	'us@us.com',	NULL,	'$2y$10$U3hxNXU2ymcmUxt6kv8Yeu.9pKKJ3x7gdZa.qKDOcmnTOuREEXWwK',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'2021-04-02 01:16:05',	2,	'089608498550',	'p',	'Bekasi',	1,	NULL),
(22,	'tes user',	'1617459036@1617459036',	NULL,	'$2y$10$0NU2xjoHM9eTUB.Gb79mF.mX77LchpKyYsnbGEGOhwR1RZ5ERqHnm',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'2021-04-18 01:56:13',	NULL,	'089608498550',	'p',	'Bekasi',	1,	1),
(23,	'tes user',	'1617459064@1617459064',	NULL,	'$2y$10$xCKllAp2GZTvKz/eIgKbe.cYOPTcXWDmgulxfj5fXmSBWTiJQZsfy',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'2021-04-17 09:29:30',	NULL,	'8789',	'p',	'-',	1,	1),
(24,	'tes user',	'1617459075@1617459075',	NULL,	'$2y$10$bzvQ9kjPnWyw2knuVPGfAeiAosiIj3ybPKT3zBPqEcVuBbo4KLNgG',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'8789',	'p',	'-',	1,	1);

DROP TABLE IF EXISTS `wa_templates`;
CREATE TABLE `wa_templates` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `token` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `base_url` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `template_create_transaksi` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `wa_templates` (`id`, `token`, `base_url`, `template_create_transaksi`, `created_at`, `updated_at`) VALUES
(1,	'n59oRp2CkUokXfc06zd22VavH8jXBaIfr2nYbZQb50ugqiGStW680XpJONlAYthd',	'https://sambi.wablas.com',	NULL,	NULL,	'2021-03-07 16:12:33');

-- 2021-04-24 15:39:41
