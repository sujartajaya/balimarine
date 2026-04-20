-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: Apr 19, 2026 at 08:18 PM
-- Server version: 8.0.40
-- PHP Version: 8.2.27

-- SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
-- START TRANSACTION;
-- SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `radius`
--

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

-- CREATE TABLE `countries` (
--   `id` bigint UNSIGNED NOT NULL,
--   `country_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
--   `iso2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
--   `iso3` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
--   `top_level_domain` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
--   `fips` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
--   `iso_numeric` int NOT NULL,
--   `geo_name_id` int DEFAULT NULL,
--   `e164` int NOT NULL,
--   `phone_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
--   `continent` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
--   `capital` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
--   `time_zone_in_capital` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
--   `currency` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
--   `created_at` timestamp NULL DEFAULT NULL,
--   `updated_at` timestamp NULL DEFAULT NULL
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `country_name`, `iso2`, `iso3`, `top_level_domain`, `fips`, `iso_numeric`, `geo_name_id`, `e164`, `phone_code`, `continent`, `capital`, `time_zone_in_capital`, `currency`, `created_at`, `updated_at`) VALUES
(1, 'Afghanistan', 'AF', 'AFG', 'af', 'AF', 4, 1149361, 93, '93', 'Asia', 'Kabul', 'Asia/Kabul', 'Afghani', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(2, 'Albania', 'AL', 'ALB', 'al', 'AL', 8, 783754, 355, '355', 'Europe', 'Tirana', 'Europe/Tirane', 'Lek', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(3, 'Algeria', 'DZ', 'DZA', 'dz', 'AG', 12, 2589581, 213, '213', 'Africa', 'Algiers', 'Africa/Algiers', 'Dinar', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(4, 'American Samoa', 'AS', 'ASM', 'as', 'AQ', 16, 5880801, 1, '1-684', 'Oceania', 'Pago Pago', 'Pacific/Pago_Pago', 'Dollar', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(5, 'Andorra', 'AD', 'AND', 'ad', 'AN', 20, 3041565, 376, '376', 'Europe', 'Andorra la Vella', 'Europe/Andorra', 'Euro', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(6, 'Angola', 'AO', 'AGO', 'ao', 'AO', 24, 3351879, 244, '244', 'Africa', 'Luanda', 'Africa/Lagos', 'Kwanza', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(7, 'Anguilla', 'AI', 'AIA', 'ai', 'AV', 660, 3573511, 1, '1-264', 'North America', 'The Valley', 'America/Port_of_Spain', 'Dollar', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(8, 'Antarctica', 'AQ', 'ATA', 'aq', 'AY', 10, 6697173, 672, '672', 'Antarctica', '', 'Antarctica/Troll', '', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(9, 'Antigua and Barbuda', 'AG', 'ATG', 'ag', 'AC', 28, 3576396, 1, '1-268', 'North America', 'St. John\'s', 'America/Antigua', 'Dollar', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(10, 'Argentina', 'AR', 'ARG', 'ar', 'AR', 32, 3865483, 54, '54', 'South America', 'Buenos Aires', 'America/Argentina/Buenos_Aires', 'Peso', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(11, 'Armenia', 'AM', 'ARM', 'am', 'AM', 51, 174982, 374, '374', 'Asia', 'Yerevan', 'Asia/Yerevan', 'Dram', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(12, 'Aruba', 'AW', 'ABW', 'aw', 'AA', 533, 3577279, 297, '297', 'North America', 'Oranjestad', 'America/Curacao', 'Guilder', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(13, 'Australia', 'AU', 'AUS', 'au', 'AS', 36, 2077456, 61, '61', 'Oceania', 'Canberra', 'Australia/Sydney', 'Dollar', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(14, 'Austria', 'AT', 'AUT', 'at', 'AU', 40, 2782113, 43, '43', 'Europe', 'Vienna', 'Europe/Vienna', 'Euro', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(15, 'Azerbaijan', 'AZ', 'AZE', 'az', 'AJ', 31, 587116, 994, '994', 'Asia', 'Baku', 'Asia/Baku', 'Manat', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(16, 'Bahamas', 'BS', 'BHS', 'bs', 'BF', 44, 3572887, 1, '1-242', 'North America', 'Nassau', 'America/Nassau', 'Dollar', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(17, 'Bahrain', 'BH', 'BHR', 'bh', 'BA', 48, 290291, 973, '973', 'Asia', 'Manama', 'Asia/Bahrain', 'Dinar', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(18, 'Bangladesh', 'BD', 'BGD', 'bd', 'BG', 50, 1210997, 880, '880', 'Asia', 'Dhaka', 'Asia/Dhaka', 'Taka', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(19, 'Barbados', 'BB', 'BRB', 'bb', 'BB', 52, 3374084, 1, '1-246', 'North America', 'Bridgetown', 'America/Barbados', 'Dollar', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(20, 'Belarus', 'BY', 'BLR', 'by', 'BO', 112, 630336, 375, '375', 'Europe', 'Minsk', 'Europe/Minsk', 'Ruble', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(21, 'Belgium', 'BE', 'BEL', 'be', 'BE', 56, 2802361, 32, '32', 'Europe', 'Brussels', 'Europe/Brussels', 'Euro', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(22, 'Belize', 'BZ', 'BLZ', 'bz', 'BH', 84, 3582678, 501, '501', 'North America', 'Belmopan', 'America/Belize', 'Dollar', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(23, 'Benin', 'BJ', 'BEN', 'bj', 'BN', 204, 2395170, 229, '229', 'Africa', 'Porto-Novo', 'Africa/Lagos', 'Franc', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(24, 'Bermuda', 'BM', 'BMU', 'bm', 'BD', 60, 3573345, 1, '1-441', 'North America', 'Hamilton', 'Atlantic/Bermuda', 'Dollar', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(25, 'Bhutan', 'BT', 'BTN', 'bt', 'BT', 64, 1252634, 975, '975', 'Asia', 'Thimphu', 'Asia/Thimphu', 'Ngultrum', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(26, 'Bolivia', 'BO', 'BOL', 'bo', 'BL', 68, 3923057, 591, '591', 'South America', 'Sucre', 'America/La_Paz', 'Boliviano', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(27, 'Bosnia and Herzegovina', 'BA', 'BIH', 'ba', 'BK', 70, 3277605, 387, '387', 'Europe', 'Sarajevo', 'Europe/Belgrade', 'Marka', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(28, 'Botswana', 'BW', 'BWA', 'bw', 'BC', 72, 933860, 267, '267', 'Africa', 'Gaborone', 'Africa/Maputo', 'Pula', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(29, 'Brazil', 'BR', 'BRA', 'br', 'BR', 76, 3469034, 55, '55', 'South America', 'Brasilia', 'America/Sao_Paulo', 'Real', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(30, 'British Indian Ocean Territory', 'IO', 'IOT', 'io', 'IO', 86, 1282588, 246, '246', 'Asia', 'Diego Garcia', 'Indian/Chagos', 'Dollar', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(31, 'British Virgin Islands', 'VG', 'VGB', 'vg', 'VI', 92, 3577718, 1, '1-284', 'North America', 'Road Town', 'America/Port_of_Spain', 'Dollar', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(32, 'Brunei', 'BN', 'BRN', 'bn', 'BX', 96, 1820814, 673, '673', 'Asia', 'Bandar Seri Begawan', 'Asia/Brunei', 'Dollar', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(33, 'Bulgaria', 'BG', 'BGR', 'bg', 'BU', 100, 732800, 359, '359', 'Europe', 'Sofia', 'Europe/Sofia', 'Lev', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(34, 'Burkina Faso', 'BF', 'BFA', 'bf', 'UV', 854, 2361809, 226, '226', 'Africa', 'Ouagadougou', 'Africa/Abidjan', 'Franc', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(35, 'Burundi', 'BI', 'BDI', 'bi', 'BY', 108, 433561, 257, '257', 'Africa', 'Bujumbura', 'Africa/Maputo', 'Franc', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(36, 'Cambodia', 'KH', 'KHM', 'kh', 'CB', 116, 1831722, 855, '855', 'Asia', 'Phnom Penh', 'Asia/Phnom_Penh', 'Riels', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(37, 'Cameroon', 'CM', 'CMR', 'cm', 'CM', 120, 2233387, 237, '237', 'Africa', 'Yaounde', 'Africa/Lagos', 'Franc', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(38, 'Canada', 'CA', 'CAN', 'ca', 'CA', 124, 6251999, 1, '1', 'North America', 'Ottawa', 'America/Toronto', 'Dollar', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(39, 'Cape Verde', 'CV', 'CPV', 'cv', 'CV', 132, 3374766, 238, '238', 'Africa', 'Praia', 'Atlantic/Cape_Verde', 'Escudo', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(40, 'Cayman Islands', 'KY', 'CYM', 'ky', 'CJ', 136, 3580718, 1, '1-345', 'North America', 'George Town', 'America/Cayman', 'Dollar', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(41, 'Central African Republic', 'CF', 'CAF', 'cf', 'CT', 140, 239880, 236, '236', 'Africa', 'Bangui', 'Africa/Lagos', 'Franc', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(42, 'Chad', 'TD', 'TCD', 'td', 'CD', 148, 2434508, 235, '235', 'Africa', 'N\'Djamena', 'Africa/Ndjamena', 'Franc', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(43, 'Chile', 'CL', 'CHL', 'cl', 'CI', 152, 3895114, 56, '56', 'South America', 'Santiago', 'America/Santiago', 'Peso', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(44, 'China', 'CN', 'CHN', 'cn', 'CH', 156, 1814991, 86, '86', 'Asia', 'Beijing', 'Asia/Shanghai', 'Yuan Renminbi', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(45, 'Christmas Island', 'CX', 'CXR', 'cx', 'KT', 162, 2078138, 61, '61', 'Asia', 'Flying Fish Cove', 'Indian/Christmas', 'Dollar', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(46, 'Cocos Islands', 'CC', 'CCK', 'cc', 'CK', 166, 1547376, 61, '61', 'Asia', 'West Island', 'Indian/Cocos', 'Dollar', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(47, 'Colombia', 'CO', 'COL', 'co', 'CO', 170, 3686110, 57, '57', 'South America', 'Bogota', 'America/Bogota', 'Peso', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(48, 'Comoros', 'KM', 'COM', 'km', 'CN', 174, 921929, 269, '269', 'Africa', 'Moroni', 'Indian/Comoro', 'Franc', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(49, 'Cook Islands', 'CK', 'COK', 'ck', 'CW', 184, 1899402, 682, '682', 'Oceania', 'Avarua', 'Pacific/Rarotonga', 'Dollar', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(50, 'Costa Rica', 'CR', 'CRI', 'cr', 'CS', 188, 3624060, 506, '506', 'North America', 'San Jose', 'America/Costa_Rica', 'Colon', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(51, 'Croatia', 'HR', 'HRV', 'hr', 'HR', 191, 3202326, 385, '385', 'Europe', 'Zagreb', 'Europe/Belgrade', 'Kuna', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(52, 'Cuba', 'CU', 'CUB', 'cu', 'CU', 192, 3562981, 53, '53', 'North America', 'Havana', 'America/Havana', 'Peso', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(53, 'Curacao', 'CW', 'CUW', 'cw', 'UC', 531, 7626836, 599, '599', 'North America', 'Willemstad', 'America/Curacao', 'Guilder', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(54, 'Cyprus', 'CY', 'CYP', 'cy', 'CY', 196, 146669, 357, '357', 'Europe', 'Nicosia', 'Asia/Nicosia', 'Euro', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(55, 'Czech Republic', 'CZ', 'CZE', 'cz', 'EZ', 203, 3077311, 420, '420', 'Europe', 'Prague', 'Europe/Prague', 'Koruna', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(56, 'Democratic Republic of the Congo', 'CD', 'COD', 'cd', 'CG', 180, 203312, 243, '243', 'Africa', 'Kinshasa', 'Africa/Lagos', 'Franc', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(57, 'Denmark', 'DK', 'DNK', 'dk', 'DA', 208, 2623032, 45, '45', 'Europe', 'Copenhagen', 'Europe/Copenhagen', 'Krone', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(58, 'Djibouti', 'DJ', 'DJI', 'dj', 'DJ', 262, 223816, 253, '253', 'Africa', 'Djibouti', 'Africa/Djibouti', 'Franc', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(59, 'Dominica', 'DM', 'DMA', 'dm', 'DO', 212, 3575830, 1, '1-767', 'North America', 'Roseau', 'America/Port_of_Spain', 'Dollar', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(60, 'Dominican Republic', 'DO', 'DOM', 'do', 'DR', 214, 3508796, 1, '1-809, 1-829, 1-849', 'North America', 'Santo Domingo', 'America/Santo_Domingo', 'Peso', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(61, 'East Timor', 'TL', 'TLS', 'tl', 'TT', 626, 1966436, 670, '670', 'Oceania', 'Dili', 'Asia/Dili', 'Dollar', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(62, 'Ecuador', 'EC', 'ECU', 'ec', 'EC', 218, 3658394, 593, '593', 'South America', 'Quito', 'America/Guayaquil', 'Dollar', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(63, 'Egypt', 'EG', 'EGY', 'eg', 'EG', 818, 357994, 20, '20', 'Africa', 'Cairo', 'Africa/Cairo', 'Pound', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(64, 'El Salvador', 'SV', 'SLV', 'sv', 'ES', 222, 3585968, 503, '503', 'North America', 'San Salvador', 'America/El_Salvador', 'Dollar', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(65, 'Equatorial Guinea', 'GQ', 'GNQ', 'gq', 'EK', 226, 2309096, 240, '240', 'Africa', 'Malabo', 'Africa/Lagos', 'Franc', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(66, 'Eritrea', 'ER', 'ERI', 'er', 'ER', 232, 338010, 291, '291', 'Africa', 'Asmara', 'Africa/Asmara', 'Nakfa', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(67, 'Estonia', 'EE', 'EST', 'ee', 'EN', 233, 453733, 372, '372', 'Europe', 'Tallinn', 'Europe/Tallinn', 'Euro', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(68, 'Ethiopia', 'ET', 'ETH', 'et', 'ET', 231, 337996, 251, '251', 'Africa', 'Addis Ababa', 'Africa/Addis_Ababa', 'Birr', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(69, 'Falkland Islands', 'FK', 'FLK', 'fk', 'FK', 238, 3474414, 500, '500', 'South America', 'Stanley', 'Atlantic/Stanley', 'Pound', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(70, 'Faroe Islands', 'FO', 'FRO', 'fo', 'FO', 234, 2622320, 298, '298', 'Europe', 'Torshavn', 'Atlantic/Faroe', 'Krone', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(71, 'Fiji', 'FJ', 'FJI', 'fj', 'FJ', 242, 2205218, 679, '679', 'Oceania', 'Suva', 'Pacific/Fiji', 'Dollar', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(72, 'Finland', 'FI', 'FIN', 'fi', 'FI', 246, 660013, 358, '358', 'Europe', 'Helsinki', 'Europe/Helsinki', 'Euro', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(73, 'France', 'FR', 'FRA', 'fr', 'FR', 250, 3017382, 33, '33', 'Europe', 'Paris', 'Europe/Paris', 'Euro', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(74, 'French Polynesia', 'PF', 'PYF', 'pf', 'FP', 258, 4030656, 689, '689', 'Oceania', 'Papeete', 'Pacific/Tahiti', 'Franc', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(75, 'Gabon', 'GA', 'GAB', 'ga', 'GB', 266, 2400553, 241, '241', 'Africa', 'Libreville', 'Africa/Lagos', 'Franc', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(76, 'Gambia', 'GM', 'GMB', 'gm', 'GA', 270, 2413451, 220, '220', 'Africa', 'Banjul', 'Africa/Abidjan', 'Dalasi', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(77, 'Georgia', 'GE', 'GEO', 'ge', 'GG', 268, 614540, 995, '995', 'Asia', 'Tbilisi', 'Asia/Tbilisi', 'Lari', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(78, 'Germany', 'DE', 'DEU', 'de', 'GM', 276, 2921044, 49, '49', 'Europe', 'Berlin', 'Europe/Berlin', 'Euro', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(79, 'Ghana', 'GH', 'GHA', 'gh', 'GH', 288, 2300660, 233, '233', 'Africa', 'Accra', 'Africa/Accra', 'Cedi', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(80, 'Gibraltar', 'GI', 'GIB', 'gi', 'GI', 292, 2411586, 350, '350', 'Europe', 'Gibraltar', 'Europe/Gibraltar', 'Pound', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(81, 'Greece', 'GR', 'GRC', 'gr', 'GR', 300, 390903, 30, '30', 'Europe', 'Athens', 'Europe/Athens', 'Euro', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(82, 'Greenland', 'GL', 'GRL', 'gl', 'GL', 304, 3425505, 299, '299', 'North America', 'Nuuk', 'America/Godthab', 'Krone', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(83, 'Grenada', 'GD', 'GRD', 'gd', 'GJ', 308, 3580239, 1, '1-473', 'North America', 'St. George\'s', 'America/Port_of_Spain', 'Dollar', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(84, 'Guam', 'GU', 'GUM', 'gu', 'GQ', 316, 4043988, 1, '1-671', 'Oceania', 'Hagatna', 'Pacific/Guam', 'Dollar', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(85, 'Guatemala', 'GT', 'GTM', 'gt', 'GT', 320, 3595528, 502, '502', 'North America', 'Guatemala City', 'America/Guatemala', 'Quetzal', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(86, 'Guernsey', 'GG', 'GGY', 'gg', 'GK', 831, 3042362, 44, '44-1481', 'Europe', 'St Peter Port', 'Europe/London', 'Pound', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(87, 'Guinea', 'GN', 'GIN', 'gn', 'GV', 324, 2420477, 224, '224', 'Africa', 'Conakry', 'Africa/Abidjan', 'Franc', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(88, 'Guinea-Bissau', 'GW', 'GNB', 'gw', 'PU', 624, 2372248, 245, '245', 'Africa', 'Bissau', 'Africa/Bissau', 'Franc', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(89, 'Guyana', 'GY', 'GUY', 'gy', 'GY', 328, 3378535, 592, '592', 'South America', 'Georgetown', 'America/Guyana', 'Dollar', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(90, 'Haiti', 'HT', 'HTI', 'ht', 'HA', 332, 3723988, 509, '509', 'North America', 'Port-au-Prince', 'America/Port-au-Prince', 'Gourde', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(91, 'Honduras', 'HN', 'HND', 'hn', 'HO', 340, 3608932, 504, '504', 'North America', 'Tegucigalpa', 'America/Tegucigalpa', 'Lempira', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(92, 'Hong Kong', 'HK', 'HKG', 'hk', 'HK', 344, 1819730, 852, '852', 'Asia', 'Hong Kong', 'Asia/Hong_Kong', 'Dollar', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(93, 'Hungary', 'HU', 'HUN', 'hu', 'HU', 348, 719819, 36, '36', 'Europe', 'Budapest', 'Europe/Budapest', 'Forint', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(94, 'Iceland', 'IS', 'ISL', 'is', 'IC', 352, 2629691, 354, '354', 'Europe', 'Reykjavik', 'Atlantic/Reykjavik', 'Krona', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(95, 'India', 'IN', 'IND', 'in', 'IN', 356, 1269750, 91, '91', 'Asia', 'New Delhi', 'Asia/Kolkata', 'Rupee', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(96, 'Indonesia', 'ID', 'IDN', 'id', 'ID', 360, 1643084, 62, '62', 'Asia', 'Jakarta', 'Asia/Jakarta', 'Rupiah', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(97, 'Iran', 'IR', 'IRN', 'ir', 'IR', 364, 130758, 98, '98', 'Asia', 'Tehran', 'Asia/Tehran', 'Rial', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(98, 'Iraq', 'IQ', 'IRQ', 'iq', 'IZ', 368, 99237, 964, '964', 'Asia', 'Baghdad', 'Asia/Baghdad', 'Dinar', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(99, 'Ireland', 'IE', 'IRL', 'ie', 'EI', 372, 2963597, 353, '353', 'Europe', 'Dublin', 'Europe/Dublin', 'Euro', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(100, 'Isle of Man', 'IM', 'IMN', 'im', 'IM', 833, 3042225, 44, '44-1624', 'Europe', 'Douglas, Isle of Man', 'Europe/London', 'Pound', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(101, 'Israel', 'IL', 'ISR', 'il', 'IS', 376, 294640, 972, '972', 'Asia', 'Jerusalem', 'Asia/Jerusalem', 'Shekel', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(102, 'Italy', 'IT', 'ITA', 'it', 'IT', 380, 3175395, 39, '39', 'Europe', 'Rome', 'Europe/Rome', 'Euro', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(103, 'Ivory Coast', 'CI', 'CIV', 'ci', 'IV', 384, 2287781, 225, '225', 'Africa', 'Yamoussoukro', 'Africa/Abidjan', 'Franc', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(104, 'Jamaica', 'JM', 'JAM', 'jm', 'JM', 388, 3489940, 1, '1-876', 'North America', 'Kingston', 'America/Jamaica', 'Dollar', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(105, 'Japan', 'JP', 'JPN', 'jp', 'JA', 392, 1861060, 81, '81', 'Asia', 'Tokyo', 'Asia/Tokyo', 'Yen', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(106, 'Jersey', 'JE', 'JEY', 'je', 'JE', 832, 3042142, 44, '44-1534', 'Europe', 'Saint Helier', 'Europe/London', 'Pound', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(107, 'Jordan', 'JO', 'JOR', 'jo', 'JO', 400, 248816, 962, '962', 'Asia', 'Amman', 'Asia/Amman', 'Dinar', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(108, 'Kazakhstan', 'KZ', 'KAZ', 'kz', 'KZ', 398, 1522867, 7, '7', 'Asia', 'Astana', 'Asia/Almaty', 'Tenge', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(109, 'Kenya', 'KE', 'KEN', 'ke', 'KE', 404, 192950, 254, '254', 'Africa', 'Nairobi', 'Africa/Nairobi', 'Shilling', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(110, 'Kiribati', 'KI', 'KIR', 'ki', 'KR', 296, 4030945, 686, '686', 'Oceania', 'Tarawa', 'Pacific/Tarawa', 'Dollar', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(111, 'Kosovo', 'XK', 'XKX', '', 'KV', 0, 831053, 383, '383', 'Europe', 'Pristina', 'Europe/Belgrade', 'Euro', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(112, 'Kuwait', 'KW', 'KWT', 'kw', 'KU', 414, 285570, 965, '965', 'Asia', 'Kuwait City', 'Asia/Kuwait', 'Dinar', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(113, 'Kyrgyzstan', 'KG', 'KGZ', 'kg', 'KG', 417, 1527747, 996, '996', 'Asia', 'Bishkek', 'Asia/Bishkek', 'Som', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(114, 'Laos', 'LA', 'LAO', 'la', 'LA', 418, 1655842, 856, '856', 'Asia', 'Vientiane', 'Asia/Vientiane', 'Kip', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(115, 'Latvia', 'LV', 'LVA', 'lv', 'LG', 428, 458258, 371, '371', 'Europe', 'Riga', 'Europe/Riga', 'Euro', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(116, 'Lebanon', 'LB', 'LBN', 'lb', 'LE', 422, 272103, 961, '961', 'Asia', 'Beirut', 'Asia/Beirut', 'Pound', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(117, 'Lesotho', 'LS', 'LSO', 'ls', 'LT', 426, 932692, 266, '266', 'Africa', 'Maseru', 'Africa/Johannesburg', 'Loti', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(118, 'Liberia', 'LR', 'LBR', 'lr', 'LI', 430, 2275384, 231, '231', 'Africa', 'Monrovia', 'Africa/Monrovia', 'Dollar', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(119, 'Libya', 'LY', 'LBY', 'ly', 'LY', 434, 2215636, 218, '218', 'Africa', 'Tripolis', 'Africa/Tripoli', 'Dinar', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(120, 'Liechtenstein', 'LI', 'LIE', 'li', 'LS', 438, 3042058, 423, '423', 'Europe', 'Vaduz', 'Europe/Zurich', 'Franc', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(121, 'Lithuania', 'LT', 'LTU', 'lt', 'LH', 440, 597427, 370, '370', 'Europe', 'Vilnius', 'Europe/Vilnius', 'Euro', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(122, 'Luxembourg', 'LU', 'LUX', 'lu', 'LU', 442, 2960313, 352, '352', 'Europe', 'Luxembourg', 'Europe/Luxembourg', 'Euro', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(123, 'Macau', 'MO', 'MAC', 'mo', 'MC', 446, 1821275, 853, '853', 'Asia', 'Macao', 'Asia/Macau', 'Pataca', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(124, 'Macedonia', 'MK', 'MKD', 'mk', 'MK', 807, 718075, 389, '389', 'Europe', 'Skopje', 'Europe/Belgrade', 'Denar', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(125, 'Madagascar', 'MG', 'MDG', 'mg', 'MA', 450, 1062947, 261, '261', 'Africa', 'Antananarivo', 'Indian/Antananarivo', 'Ariary', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(126, 'Malawi', 'MW', 'MWI', 'mw', 'MI', 454, 927384, 265, '265', 'Africa', 'Lilongwe', 'Africa/Maputo', 'Kwacha', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(127, 'Malaysia', 'MY', 'MYS', 'my', 'MY', 458, 1733045, 60, '60', 'Asia', 'Kuala Lumpur', 'Asia/Kuala_Lumpur', 'Ringgit', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(128, 'Maldives', 'MV', 'MDV', 'mv', 'MV', 462, 1282028, 960, '960', 'Asia', 'Male', 'Indian/Maldives', 'Rufiyaa', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(129, 'Mali', 'ML', 'MLI', 'ml', 'ML', 466, 2453866, 223, '223', 'Africa', 'Bamako', 'Africa/Abidjan', 'Franc', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(130, 'Malta', 'MT', 'MLT', 'mt', 'MT', 470, 2562770, 356, '356', 'Europe', 'Valletta', 'Europe/Malta', 'Euro', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(131, 'Marshall Islands', 'MH', 'MHL', 'mh', 'RM', 584, 2080185, 692, '692', 'Oceania', 'Majuro', 'Pacific/Majuro', 'Dollar', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(132, 'Mauritania', 'MR', 'MRT', 'mr', 'MR', 478, 2378080, 222, '222', 'Africa', 'Nouakchott', 'Africa/Abidjan', 'Ouguiya', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(133, 'Mauritius', 'MU', 'MUS', 'mu', 'MP', 480, 934292, 230, '230', 'Africa', 'Port Louis', 'Indian/Mauritius', 'Rupee', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(134, 'Mayotte', 'YT', 'MYT', 'yt', 'MF', 175, 1024031, 262, '262', 'Africa', 'Mamoudzou', 'Indian/Mayotte', 'Euro', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(135, 'Mexico', 'MX', 'MEX', 'mx', 'MX', 484, 3996063, 52, '52', 'North America', 'Mexico City', 'America/Mexico_City', 'Peso', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(136, 'Micronesia', 'FM', 'FSM', 'fm', 'FM', 583, 2081918, 691, '691', 'Oceania', 'Palikir', 'Pacific/Pohnpei', 'Dollar', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(137, 'Moldova', 'MD', 'MDA', 'md', 'MD', 498, 617790, 373, '373', 'Europe', 'Chisinau', 'Europe/Chisinau', 'Leu', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(138, 'Monaco', 'MC', 'MCO', 'mc', 'MN', 492, 2993457, 377, '377', 'Europe', 'Monaco', 'Europe/Monaco', 'Euro', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(139, 'Mongolia', 'MN', 'MNG', 'mn', 'MG', 496, 2029969, 976, '976', 'Asia', 'Ulan Bator', 'Asia/Ulaanbaatar', 'Tugrik', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(140, 'Montenegro', 'ME', 'MNE', 'me', 'MJ', 499, 3194884, 382, '382', 'Europe', 'Podgorica', 'Europe/Belgrade', 'Euro', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(141, 'Montserrat', 'MS', 'MSR', 'ms', 'MH', 500, 3578097, 1, '1-664', 'North America', 'Plymouth', 'America/Port_of_Spain', 'Dollar', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(142, 'Morocco', 'MA', 'MAR', 'ma', 'MO', 504, 2542007, 212, '212', 'Africa', 'Rabat', 'Africa/Casablanca', 'Dirham', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(143, 'Mozambique', 'MZ', 'MOZ', 'mz', 'MZ', 508, 1036973, 258, '258', 'Africa', 'Maputo', 'Africa/Maputo', 'Metical', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(144, 'Myanmar', 'MM', 'MMR', 'mm', 'BM', 104, 1327865, 95, '95', 'Asia', 'Nay Pyi Taw', 'Asia/Rangoon', 'Kyat', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(145, 'Namibia', 'NA', 'NAM', 'na', 'WA', 516, 3355338, 264, '264', 'Africa', 'Windhoek', 'Africa/Windhoek', 'Dollar', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(146, 'Nauru', 'NR', 'NRU', 'nr', 'NR', 520, 2110425, 674, '674', 'Oceania', 'Yaren', 'Pacific/Nauru', 'Dollar', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(147, 'Nepal', 'NP', 'NPL', 'np', 'NP', 524, 1282988, 977, '977', 'Asia', 'Kathmandu', 'Asia/Kathmandu', 'Rupee', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(148, 'Netherlands', 'NL', 'NLD', 'nl', 'NL', 528, 2750405, 31, '31', 'Europe', 'Amsterdam', 'Europe/Amsterdam', 'Euro', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(150, 'New Caledonia', 'NC', 'NCL', 'nc', 'NC', 540, 2139685, 687, '687', 'Oceania', 'Noumea', 'Pacific/Noumea', 'Franc', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(151, 'New Zealand', 'NZ', 'NZL', 'nz', 'NZ', 554, 2186224, 64, '64', 'Oceania', 'Wellington', 'Pacific/Auckland', 'Dollar', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(152, 'Nicaragua', 'NI', 'NIC', 'ni', 'NU', 558, 3617476, 505, '505', 'North America', 'Managua', 'America/Managua', 'Cordoba', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(153, 'Niger', 'NE', 'NER', 'ne', 'NG', 562, 2440476, 227, '227', 'Africa', 'Niamey', 'Africa/Lagos', 'Franc', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(154, 'Nigeria', 'NG', 'NGA', 'ng', 'NI', 566, 2328926, 234, '234', 'Africa', 'Abuja', 'Africa/Lagos', 'Naira', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(155, 'Niue', 'NU', 'NIU', 'nu', 'NE', 570, 4036232, 683, '683', 'Oceania', 'Alofi', 'Pacific/Niue', 'Dollar', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(156, 'North Korea', 'KP', 'PRK', 'kp', 'KN', 408, 1873107, 850, '850', 'Asia', 'Pyongyang', 'Asia/Pyongyang', 'Won', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(157, 'Northern Mariana Islands', 'MP', 'MNP', 'mp', 'CQ', 580, 4041468, 1, '1-670', 'Oceania', 'Saipan', 'Pacific/Saipan', 'Dollar', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(158, 'Norway', 'NO', 'NOR', 'no', 'NO', 578, 3144096, 47, '47', 'Europe', 'Oslo', 'Europe/Oslo', 'Krone', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(159, 'Oman', 'OM', 'OMN', 'om', 'MU', 512, 286963, 968, '968', 'Asia', 'Muscat', 'Asia/Muscat', 'Rial', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(160, 'Pakistan', 'PK', 'PAK', 'pk', 'PK', 586, 1168579, 92, '92', 'Asia', 'Islamabad', 'Asia/Karachi', 'Rupee', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(161, 'Palau', 'PW', 'PLW', 'pw', 'PS', 585, 1559582, 680, '680', 'Oceania', 'Melekeok', 'Pacific/Palau', 'Dollar', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(162, 'Palestine', 'PS', 'PSE', 'ps', 'WE', 275, 6254930, 970, '970', 'Asia', 'East Jerusalem', 'Asia/Hebron', 'Shekel', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(163, 'Panama', 'PA', 'PAN', 'pa', 'PM', 591, 3703430, 507, '507', 'North America', 'Panama City', 'America/Panama', 'Balboa', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(164, 'Papua New Guinea', 'PG', 'PNG', 'pg', 'PP', 598, 2088628, 675, '675', 'Oceania', 'Port Moresby', 'Pacific/Port_Moresby', 'Kina', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(165, 'Paraguay', 'PY', 'PRY', 'py', 'PA', 600, 3437598, 595, '595', 'South America', 'Asuncion', 'America/Asuncion', 'Guarani', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(166, 'Peru', 'PE', 'PER', 'pe', 'PE', 604, 3932488, 51, '51', 'South America', 'Lima', 'America/Lima', 'Sol', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(167, 'Philippines', 'PH', 'PHL', 'ph', 'RP', 608, 1694008, 63, '63', 'Asia', 'Manila', 'Asia/Manila', 'Peso', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(168, 'Pitcairn', 'PN', 'PCN', 'pn', 'PC', 612, 4030699, 64, '64', 'Oceania', 'Adamstown', 'Pacific/Pitcairn', 'Dollar', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(169, 'Poland', 'PL', 'POL', 'pl', 'PL', 616, 798544, 48, '48', 'Europe', 'Warsaw', 'Europe/Warsaw', 'Zloty', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(170, 'Portugal', 'PT', 'PRT', 'pt', 'PO', 620, 2264397, 351, '351', 'Europe', 'Lisbon', 'Europe/Lisbon', 'Euro', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(171, 'Puerto Rico', 'PR', 'PRI', 'pr', 'RQ', 630, 4566966, 1, '1-787, 1-939', 'North America', 'San Juan', 'America/Puerto_Rico', 'Dollar', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(172, 'Qatar', 'QA', 'QAT', 'qa', 'QA', 634, 289688, 974, '974', 'Asia', 'Doha', 'Asia/Qatar', 'Rial', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(173, 'Republic of the Congo', 'CG', 'COG', 'cg', 'CF', 178, 2260494, 242, '242', 'Africa', 'Brazzaville', 'Africa/Lagos', 'Franc', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(174, 'Reunion', 'RE', 'REU', 're', 'RE', 638, 935317, 262, '262', 'Africa', 'Saint-Denis', 'Indian/Reunion', 'Euro', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(175, 'Romania', 'RO', 'ROU', 'ro', 'RO', 642, 798549, 40, '40', 'Europe', 'Bucharest', 'Europe/Bucharest', 'Leu', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(176, 'Russia', 'RU', 'RUS', 'ru', 'RS', 643, 2017370, 7, '7', 'Europe', 'Moscow', 'Europe/Moscow', 'Ruble', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(177, 'Rwanda', 'RW', 'RWA', 'rw', 'RW', 646, 49518, 250, '250', 'Africa', 'Kigali', 'Africa/Maputo', 'Franc', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(178, 'Saint Barthelemy', 'BL', 'BLM', 'gp', 'TB', 652, 3578476, 590, '590', 'North America', 'Gustavia', 'America/Port_of_Spain', 'Euro', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(179, 'Saint Helena', 'SH', 'SHN', 'sh', 'SH', 654, 3370751, 290, '290', 'Africa', 'Jamestown', 'Africa/Abidjan', 'Pound', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(180, 'Saint Kitts and Nevis', 'KN', 'KNA', 'kn', 'SC', 659, 3575174, 1, '1-869', 'North America', 'Basseterre', 'America/Port_of_Spain', 'Dollar', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(181, 'Saint Lucia', 'LC', 'LCA', 'lc', 'ST', 662, 3576468, 1, '1-758', 'North America', 'Castries', 'America/Port_of_Spain', 'Dollar', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(182, 'Saint Martin', 'MF', 'MAF', 'gp', 'RN', 663, 3578421, 1, '590', 'North America', 'Marigot', 'America/Port_of_Spain', 'Euro', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(183, 'Saint Pierre and Miquelon', 'PM', 'SPM', 'pm', 'SB', 666, 3424932, 508, '508', 'North America', 'Saint-Pierre', 'America/Miquelon', 'Euro', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(184, 'Saint Vincent and the Grenadines', 'VC', 'VCT', 'vc', 'VC', 670, 3577815, 1, '1-784', 'North America', 'Kingstown', 'America/Port_of_Spain', 'Dollar', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(185, 'Samoa', 'WS', 'WSM', 'ws', 'WS', 882, 4034894, 685, '685', 'Oceania', 'Apia', 'Pacific/Apia', 'Tala', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(186, 'San Marino', 'SM', 'SMR', 'sm', 'SM', 674, 3168068, 378, '378', 'Europe', 'San Marino', 'Europe/Rome', 'Euro', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(187, 'Sao Tome and Principe', 'ST', 'STP', 'st', 'TP', 678, 2410758, 239, '239', 'Africa', 'Sao Tome', 'Africa/Abidjan', 'Dobra', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(188, 'Saudi Arabia', 'SA', 'SAU', 'sa', 'SA', 682, 102358, 966, '966', 'Asia', 'Riyadh', 'Asia/Riyadh', 'Rial', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(189, 'Senegal', 'SN', 'SEN', 'sn', 'SG', 686, 2245662, 221, '221', 'Africa', 'Dakar', 'Africa/Abidjan', 'Franc', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(190, 'Serbia', 'RS', 'SRB', 'rs', 'RI', 688, 6290252, 381, '381', 'Europe', 'Belgrade', 'Europe/Belgrade', 'Dinar', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(191, 'Seychelles', 'SC', 'SYC', 'sc', 'SE', 690, 241170, 248, '248', 'Africa', 'Victoria', 'Indian/Mahe', 'Rupee', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(192, 'Sierra Leone', 'SL', 'SLE', 'sl', 'SL', 694, 2403846, 232, '232', 'Africa', 'Freetown', 'Africa/Abidjan', 'Leone', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(193, 'Singapore', 'SG', 'SGP', 'sg', 'SN', 702, 1880251, 65, '65', 'Asia', 'Singapore', 'Asia/Singapore', 'Dollar', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(194, 'Sint Maarten', 'SX', 'SXM', 'sx', 'NN', 534, 7609695, 1, '1-721', 'North America', 'Philipsburg', 'America/Curacao', 'Guilder', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(195, 'Slovakia', 'SK', 'SVK', 'sk', 'LO', 703, 3057568, 421, '421', 'Europe', 'Bratislava', 'Europe/Prague', 'Euro', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(196, 'Slovenia', 'SI', 'SVN', 'si', 'SI', 705, 3190538, 386, '386', 'Europe', 'Ljubljana', 'Europe/Belgrade', 'Euro', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(197, 'Solomon Islands', 'SB', 'SLB', 'sb', 'BP', 90, 2103350, 677, '677', 'Oceania', 'Honiara', 'Pacific/Guadalcanal', 'Dollar', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(198, 'Somalia', 'SO', 'SOM', 'so', 'SO', 706, 51537, 252, '252', 'Africa', 'Mogadishu', 'Africa/Mogadishu', 'Shilling', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(199, 'South Africa', 'ZA', 'ZAF', 'za', 'SF', 710, 953987, 27, '27', 'Africa', 'Pretoria', 'Africa/Johannesburg', 'Rand', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(200, 'South Korea', 'KR', 'KOR', 'kr', 'KS', 410, 1835841, 82, '82', 'Asia', 'Seoul', 'Asia/Seoul', 'Won', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(201, 'South Sudan', 'SS', 'SSD', 'ss', 'OD', 728, 7909807, 211, '211', 'Africa', 'Juba', 'Africa/Khartoum', 'Pound', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(202, 'Spain', 'ES', 'ESP', 'es', 'SP', 724, 2510769, 34, '34', 'Europe', 'Madrid', 'Europe/Madrid', 'Euro', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(203, 'Sri Lanka', 'LK', 'LKA', 'lk', 'CE', 144, 1227603, 94, '94', 'Asia', 'Colombo', 'Asia/Colombo', 'Rupee', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(204, 'Sudan', 'SD', 'SDN', 'sd', 'SU', 729, 366755, 249, '249', 'Africa', 'Khartoum', 'Africa/Khartoum', 'Pound', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(205, 'Suriname', 'SR', 'SUR', 'sr', 'NS', 740, 3382998, 597, '597', 'South America', 'Paramaribo', 'America/Paramaribo', 'Dollar', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(206, 'Svalbard and Jan Mayen', 'SJ', 'SJM', 'sj', 'SV', 744, 607072, 47, '47', 'Europe', 'Longyearbyen', 'Europe/Oslo', 'Krone', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(207, 'Swaziland', 'SZ', 'SWZ', 'sz', 'WZ', 748, 934841, 268, '268', 'Africa', 'Mbabane', 'Africa/Johannesburg', 'Lilangeni', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(208, 'Sweden', 'SE', 'SWE', 'se', 'SW', 752, 2661886, 46, '46', 'Europe', 'Stockholm', 'Europe/Stockholm', 'Krona', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(209, 'Switzerland', 'CH', 'CHE', 'ch', 'SZ', 756, 2658434, 41, '41', 'Europe', 'Berne', 'Europe/Zurich', 'Franc', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(210, 'Syria', 'SY', 'SYR', 'sy', 'SY', 760, 163843, 963, '963', 'Asia', 'Damascus', 'Asia/Damascus', 'Pound', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(211, 'Taiwan', 'TW', 'TWN', 'tw', 'TW', 158, 1668284, 886, '886', 'Asia', 'Taipei', 'Asia/Taipei', 'Dollar', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(212, 'Tajikistan', 'TJ', 'TJK', 'tj', 'TI', 762, 1220409, 992, '992', 'Asia', 'Dushanbe', 'Asia/Dushanbe', 'Somoni', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(213, 'Tanzania', 'TZ', 'TZA', 'tz', 'TZ', 834, 149590, 255, '255', 'Africa', 'Dodoma', 'Africa/Dar_es_Salaam', 'Shilling', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(214, 'Thailand', 'TH', 'THA', 'th', 'TH', 764, 1605651, 66, '66', 'Asia', 'Bangkok', 'Asia/Bangkok', 'Baht', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(215, 'Togo', 'TG', 'TGO', 'tg', 'TO', 768, 2363686, 228, '228', 'Africa', 'Lome', 'Africa/Abidjan', 'Franc', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(216, 'Tokelau', 'TK', 'TKL', 'tk', 'TL', 772, 4031074, 690, '690', 'Oceania', '', 'Pacific/Fakaofo', 'Dollar', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(217, 'Tonga', 'TO', 'TON', 'to', 'TN', 776, 4032283, 676, '676', 'Oceania', 'Nuku\'alofa', 'Pacific/Tongatapu', 'Pa\'anga', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(218, 'Trinidad and Tobago', 'TT', 'TTO', 'tt', 'TD', 780, 3573591, 1, '1-868', 'North America', 'Port of Spain', 'America/Port_of_Spain', 'Dollar', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(219, 'Tunisia', 'TN', 'TUN', 'tn', 'TS', 788, 2464461, 216, '216', 'Africa', 'Tunis', 'Africa/Tunis', 'Dinar', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(220, 'Turkey', 'TR', 'TUR', 'tr', 'TU', 792, 298795, 90, '90', 'Asia', 'Ankara', 'Europe/Istanbul', 'Lira', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(221, 'Turkmenistan', 'TM', 'TKM', 'tm', 'TX', 795, 1218197, 993, '993', 'Asia', 'Ashgabat', 'Asia/Ashgabat', 'Manat', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(222, 'Turks and Caicos Islands', 'TC', 'TCA', 'tc', 'TK', 796, 3576916, 1, '1-649', 'North America', 'Cockburn Town', 'America/Grand_Turk', 'Dollar', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(223, 'Tuvalu', 'TV', 'TUV', 'tv', 'TV', 798, 2110297, 688, '688', 'Oceania', 'Funafuti', 'Pacific/Funafuti', 'Dollar', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(224, 'U.S. Virgin Islands', 'VI', 'VIR', 'vi', 'VQ', 850, 4796775, 1, '1-340', 'North America', 'Charlotte Amalie', 'America/Port_of_Spain', 'Dollar', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(225, 'Uganda', 'UG', 'UGA', 'ug', 'UG', 800, 226074, 256, '256', 'Africa', 'Kampala', 'Africa/Kampala', 'Shilling', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(226, 'Ukraine', 'UA', 'UKR', 'ua', 'UP', 804, 690791, 380, '380', 'Europe', 'Kiev', 'Europe/Kiev', 'Hryvnia', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(227, 'United Arab Emirates', 'AE', 'ARE', 'ae', 'AE', 784, 290557, 971, '971', 'Asia', 'Abu Dhabi', 'Asia/Dubai', 'Dirham', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(228, 'United Kingdom', 'GB', 'GBR', 'uk', 'UK', 826, 2635167, 44, '44', 'Europe', 'London', 'Europe/London', 'Pound', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(229, 'United States', 'US', 'USA', 'us', 'US', 840, 6252001, 1, '1', 'North America', 'Washington', 'America/New_York', 'Dollar', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(230, 'Uruguay', 'UY', 'URY', 'uy', 'UY', 858, 3439705, 598, '598', 'South America', 'Montevideo', 'America/Montevideo', 'Peso', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(231, 'Uzbekistan', 'UZ', 'UZB', 'uz', 'UZ', 860, 1512440, 998, '998', 'Asia', 'Tashkent', 'Asia/Tashkent', 'Som', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(232, 'Vanuatu', 'VU', 'VUT', 'vu', 'NH', 548, 2134431, 678, '678', 'Oceania', 'Port Vila', 'Pacific/Efate', 'Vatu', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(233, 'Vatican', 'VA', 'VAT', 'va', 'VT', 336, 3164670, 39, '379', 'Europe', 'Vatican City', 'Europe/Rome', 'Euro', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(234, 'Venezuela', 'VE', 'VEN', 've', 'VE', 862, 3625428, 58, '58', 'South America', 'Caracas', 'America/Caracas', 'Bolivar', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(235, 'Vietnam', 'VN', 'VNM', 'vn', 'VM', 704, 1562822, 84, '84', 'Asia', 'Hanoi', 'Asia/Ho_Chi_Minh', 'Dong', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(236, 'Wallis and Futuna', 'WF', 'WLF', 'wf', 'WF', 876, 4034749, 681, '681', 'Oceania', 'Mata Utu', 'Pacific/Wallis', 'Franc', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(237, 'Western Sahara', 'EH', 'ESH', 'eh', 'WI', 732, 2461445, 212, '212', 'Africa', 'El-Aaiun', 'Africa/El_Aaiun', 'Dirham', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(238, 'Yemen', 'YE', 'YEM', 'ye', 'YM', 887, 69543, 967, '967', 'Asia', 'Sanaa', 'Asia/Aden', 'Rial', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(239, 'Zambia', 'ZM', 'ZMB', 'zm', 'ZA', 894, 895949, 260, '260', 'Africa', 'Lusaka', 'Africa/Maputo', 'Kwacha', '2025-03-01 04:55:19', '2025-03-01 04:55:19'),
(240, 'Zimbabwe', 'ZW', 'ZWE', 'zw', 'ZI', 716, 878675, 263, '263', 'Africa', 'Harare', 'Africa/Maputo', 'Dollar', '2025-03-01 04:55:19', '2025-03-01 04:55:19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `countries`
--
-- ALTER TABLE `countries`
--   ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `countries`
--
-- ALTER TABLE `countries`
--   MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=241;
-- COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
