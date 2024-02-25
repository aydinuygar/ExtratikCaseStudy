-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1:3306
-- Üretim Zamanı: 25 Şub 2024, 11:57:30
-- Sunucu sürümü: 8.2.0
-- PHP Sürümü: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `extratikcasestudy`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `medical`
--

DROP TABLE IF EXISTS `medical`;
CREATE TABLE IF NOT EXISTS `medical` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `conditions` json DEFAULT NULL,
  `alergies` json DEFAULT NULL,
  `medication` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `medical`
--

INSERT INTO `medical` (`id`, `conditions`, `alergies`, `medication`, `created_at`, `updated_at`) VALUES
(1, '[{\"name\": \"Allergic cough\", \"notes\": \"Cough details\"}]', '[{\"name\": \"Gluten\", \"notes\": \"Gluten details\"}]', '[{\"name\": \"GlutenAmlodipine 5mg Tab\", \"notes\": \"Gluten details\", \"end_date\": null, \"start_date\": \"2014-06-04\"}, {\"name\": \"Diazepam\", \"notes\": null, \"end_date\": \"2019-08-04\", \"start_date\": \"2019-06-04\"}]', '2024-02-25 08:51:22', '2024-02-25 08:51:22'),
(2, '[{\"name\": \"Allergic cough\", \"notes\": \"Cough details\"}]', '[{\"name\": \"Gluten\", \"notes\": \"Gluten details\"}, {\"name\": \"Dairy\", \"notes\": \"Dairy products details\"}]', '[{\"name\": \"Amlodipine 5mg Tab\", \"notes\": null, \"end_date\": null, \"start_date\": \"2014-06-04\"}]', '2024-02-25 08:54:01', '2024-02-25 08:54:01'),
(3, '[{\"name\": \"Allergic dermatitis\", \"notes\": \"Allergic dermatitis details\"}]', '[{\"name\": \"Erythromycin\", \"notes\": null}]', '[{\"name\": \"Amlodipine 5mg Tab\", \"notes\": null, \"end_date\": \"2020-06-04\", \"start_date\": \"2016-06-04\"}]', '2024-02-25 08:55:39', '2024-02-25 08:55:39'),
(4, '[{\"name\": \"Conjucntivits\", \"notes\": null}]', '[{\"name\": \"Sulphonamides\", \"notes\": \"Sulphonamides details\"}]', '[{\"name\": \"Amlodipine 5mg Tab\", \"notes\": null, \"end_date\": \"2020-06-04\", \"start_date\": \"2019-06-04\"}]', '2024-02-25 08:57:13', '2024-02-25 08:57:13');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `next_of_kin`
--

DROP TABLE IF EXISTS `next_of_kin`;
CREATE TABLE IF NOT EXISTS `next_of_kin` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `patient_id` bigint UNSIGNED NOT NULL,
  `IdCard` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Surname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ContactNumber1` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ContactNumber2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `next_of_kin_patient_id_foreign` (`patient_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `next_of_kin`
--

INSERT INTO `next_of_kin` (`id`, `patient_id`, `IdCard`, `Name`, `Surname`, `ContactNumber1`, `ContactNumber2`, `created_at`, `updated_at`) VALUES
(1, 1, '002543G', 'Alvin', 'Smith', '21334123', '79534145', '2024-02-25 08:51:22', '2024-02-25 08:51:22'),
(2, 1, '002543K', 'Andy', 'Smith', '21334455', '79794545', '2024-02-25 08:51:22', '2024-02-25 08:51:22'),
(3, 2, '001345T', 'Fred', 'Limea', '21295042', '79285390', '2024-02-25 08:54:01', '2024-02-25 08:54:01'),
(4, 2, '007628G', 'Jane', 'Limea', '21790316', '90390645', '2024-02-25 08:54:01', '2024-02-25 08:54:01'),
(5, 3, '001345G', 'Tony', 'Micale', '21517234', '79197451', '2024-02-25 08:55:39', '2024-02-25 08:55:39'),
(6, 4, '007496G', 'Philip', 'Bore', '21555789', '79547234', '2024-02-25 08:57:13', '2024-02-25 08:57:13');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `patients`
--

DROP TABLE IF EXISTS `patients`;
CREATE TABLE IF NOT EXISTS `patients` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `IdCard` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Gender` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Surname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `DateOfBirth` date NOT NULL,
  `Address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Postcode` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ContactNumber1` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ContactNumber2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `patients`
--

INSERT INTO `patients` (`id`, `IdCard`, `Gender`, `Name`, `Surname`, `DateOfBirth`, `Address`, `Postcode`, `ContactNumber1`, `ContactNumber2`, `created_at`, `updated_at`) VALUES
(1, '002482G', 'Male', 'John', 'Smith', '1982-02-15', '21334455', '1456', '21334455', '79794545', '2024-02-25 08:51:22', '2024-02-25 08:51:22'),
(2, '004332H', 'Male', 'Paul', 'Limea', '1985-03-16', 'Angel  St Camille', '2444', '04321514456', '09321514456', '2024-02-25 08:54:01', '2024-02-25 08:54:01'),
(3, '004332G', 'Male', 'Peter', 'Micale', '1990-05-21', '5 St. Mark Street', '3333', '21263464', '91477889', '2024-02-25 08:55:39', '2024-02-25 08:55:39'),
(4, '006780G', 'Female', 'Mary', 'Bore', '1950-01-15', '55 St. George Street', '4141', '21555789', '80777889', '2024-02-25 08:57:13', '2024-02-25 08:57:13');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `patient_health_data`
--

DROP TABLE IF EXISTS `patient_health_data`;
CREATE TABLE IF NOT EXISTS `patient_health_data` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `patient_id` bigint UNSIGNED NOT NULL,
  `next_of_kin_ids` json DEFAULT NULL,
  `medical_id` bigint UNSIGNED NOT NULL,
  `deleted` enum('yes','no') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `patient_health_data_patient_id_foreign` (`patient_id`),
  KEY `patient_health_data_medical_id_foreign` (`medical_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `patient_health_data`
--

INSERT INTO `patient_health_data` (`id`, `patient_id`, `next_of_kin_ids`, `medical_id`, `deleted`, `created_at`, `updated_at`) VALUES
(1, 1, '[1, 2]', 1, 'no', '2024-02-25 08:51:22', '2024-02-25 08:51:22'),
(2, 2, '[3, 4]', 2, 'no', '2024-02-25 08:54:01', '2024-02-25 08:54:01'),
(3, 3, '[5]', 3, 'no', '2024-02-25 08:55:39', '2024-02-25 08:55:39'),
(4, 4, '[6]', 4, 'no', '2024-02-25 08:57:13', '2024-02-25 08:57:13');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
