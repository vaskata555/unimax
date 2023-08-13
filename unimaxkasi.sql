-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Време на генериране: 13 авг 2023 в 20:29
-- Версия на сървъра: 10.4.20-MariaDB
-- Версия на PHP: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данни: `unimaxkasi`
--

-- --------------------------------------------------------

--
-- Структура на таблица `appointments`
--

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL,
  `technician_id` int(11) NOT NULL,
  `appointment_type_id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `warranty_date` varchar(45) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Схема на данните от таблица `appointments`
--

INSERT INTO `appointments` (`id`, `technician_id`, `appointment_type_id`, `user_id`, `title`, `order_id`, `warranty_date`, `date`, `time`) VALUES
(354, 3, 2, 33, 'Daisy eXpert SX/ 01 мобилен апарат', '20230628205758-9563', '2024-06-28', '2023-06-28', '12:00:00'),
(355, 1, 3, 33, 'Daisy eXpert SX/ 01 мобилен апарат', '20230628205758-9563', '2024-06-28', '2023-06-28', '15:00:00'),
(356, 1, 3, 33, 'Daisy eXpert SX/ 01 мобилен апарат', '20230628205758-9563', '2024-06-28', '2023-06-28', '16:00:00'),
(357, 1, 1, 33, 'Datecs Дигитален Екран DPD-201', '20230628215437-1296', '2024-06-28', '2023-06-29', '13:00:00'),
(358, 1, 1, 33, 'ELTRADE A3 стационарен апарат', '20230701180736-6130', '2024-07-01', '2023-07-01', '15:00:00'),
(359, 2, 2, 33, 'Касов апарат Daisy Compact M', '20230701180410-440', '2024-07-01', '2023-07-01', '12:00:00'),
(360, 3, 3, 33, 'Datecs Дигитален Екран DPD-201', '20230701180418-8259', '2024-07-01', '2023-07-01', '13:00:00'),
(361, 3, 3, 33, 'Datecs Дигитален Екран DPD-201', '20230701180418-8259', '2024-07-01', '2023-07-01', '14:00:00'),
(362, 2, 2, 33, 'Datecs Дигитален Екран DPD-201', '20230701180418-8259', '2024-07-01', '2023-07-01', '16:00:00'),
(363, 1, 1, 33, 'Eltrade a1 стационарен апарат', '20230701181441-2320', '2024-07-01', '2023-07-01', '17:00:00'),
(365, 1, 1, 33, 'Eltrade a1 стационарен апарат', '20230701181441-2320', '2024-07-01', '2023-07-11', '15:00:00'),
(366, 1, 3, 33, 'Datecs Дигитален Екран DPD-201', '20230701180418-8259', '2024-07-01', '2023-07-23', '10:00:00'),
(367, 1, 3, 33, 'Datecs Дигитален Екран DPD-201', '20230701180418-8259', '2024-07-01', '2023-07-23', '11:00:00');

-- --------------------------------------------------------

--
-- Структура на таблица `appointment_type`
--

CREATE TABLE `appointment_type` (
  `appointment_type_id` int(255) NOT NULL,
  `appointment_type_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Схема на данните от таблица `appointment_type`
--

INSERT INTO `appointment_type` (`appointment_type_id`, `appointment_type_name`) VALUES
(1, 'доставка'),
(2, 'Авария'),
(3, 'Монтаж');

-- --------------------------------------------------------

--
-- Структура на таблица `brands`
--

CREATE TABLE `brands` (
  `id` int(11) NOT NULL,
  `brand` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Схема на данните от таблица `brands`
--

INSERT INTO `brands` (`id`, `brand`) VALUES
(4, 'Датекс'),
(5, 'Дейзи'),
(6, 'Елрейд');

-- --------------------------------------------------------

--
-- Структура на таблица `category`
--

CREATE TABLE `category` (
  `id` int(255) NOT NULL,
  `category_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Схема на данните от таблица `category`
--

INSERT INTO `category` (`id`, `category_name`) VALUES
(35, 'касови апарати'),
(36, 'видео наблюдение'),
(37, 'фискални принтери'),
(38, 'сензори'),
(39, 'Бензинови сонди'),
(40, 'консумативи'),
(41, 'аксесоари'),
(42, 'POS терминали'),
(43, 'Ролки'),
(44, 'касови апарати69');

-- --------------------------------------------------------

--
-- Структура на таблица `category_subcategory`
--

CREATE TABLE `category_subcategory` (
  `id` int(255) NOT NULL,
  `category_id` int(255) NOT NULL,
  `subcategory_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Схема на данните от таблица `category_subcategory`
--

INSERT INTO `category_subcategory` (`id`, `category_id`, `subcategory_id`) VALUES
(66, 42, 25),
(67, 35, 21),
(69, 35, 22),
(70, 35, 25),
(71, 41, 28),
(72, 41, 26),
(73, 40, 26),
(74, 36, 23),
(75, 36, 24),
(76, 37, 25),
(77, 41, 29),
(78, 42, 25),
(79, 43, 26),
(80, 38, 23),
(81, 42, 22),
(82, 42, 22),
(83, 42, 22),
(84, 42, 22),
(85, 42, 22),
(86, 42, 22),
(87, 42, 21),
(88, 42, 21),
(89, 42, 21),
(90, 42, 21),
(91, 42, 21),
(92, 42, 21),
(93, 42, 21),
(94, 42, 21),
(95, 42, 21),
(96, 42, 21),
(97, 42, 21),
(98, 42, 21),
(99, 42, 21),
(100, 44, 30);

-- --------------------------------------------------------

--
-- Структура на таблица `orders`
--

CREATE TABLE `orders` (
  `order_number` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `payment_type` varchar(255) NOT NULL,
  `invoice` varchar(255) NOT NULL,
  `order_date` varchar(45) NOT NULL,
  `warranty_date` varchar(45) NOT NULL,
  `user_id` int(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `organization` varchar(255) NOT NULL,
  `bulstat` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `total_price` varchar(255) NOT NULL,
  `address1` varchar(255) NOT NULL,
  `address2` varchar(255) NOT NULL,
  `post_code` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Схема на данните от таблица `orders`
--

INSERT INTO `orders` (`order_number`, `payment_type`, `invoice`, `order_date`, `warranty_date`, `user_id`, `email`, `phone_number`, `username`, `organization`, `bulstat`, `first_name`, `last_name`, `total_price`, `address1`, `address2`, `post_code`) VALUES
('20230628205758-9563', 'cash', 'invoices/payment_invoice_20230628205758-9563.pdf', '2023-06-28', '2024-06-28', 33, 'vaskata555@abv.bg', '0876377928', 'vaskata555', 'unimax', '812171419', 'Васил', 'Стоянов', '239', 'Бургас Лазур Блок 5 вход 3 етаж 6', 'Бургас Лазур Блок 5 вход 3 етаж 6', '8000'),
('20230628215437-1296', 'cash', 'invoices/payment_invoice_20230628215437-1296.pdf', '2023-06-28', '2024-06-28', 33, 'vaskata555@abv.bg', '0876377928', 'vaskata555', 'unimax', '812171419', 'Васил', 'Стоянов', '586.3', 'Лазур Блок 5 вход 3', 'Лазур Блок 5 вход 3', '8000'),
('20230629142421-4052', 'card', 'invoices/payment_invoice_20230629142421-4052.pdf', '2023-06-29', '2024-06-29', 33, 'vaskata555@abv.bg', '0876377928', 'vaskata555', 'unimax', '812171419', 'Васил', 'Стоянов', '1286', 'Лазур Блок 5 вход 3', 'Лазур Блок 5 вход 3', '8000'),
('20230630230053-923', 'cash', 'invoices/payment_invoice_20230630230053-923.pdf', '2023-06-30', '2024-06-30', 33, 'vaskata555@abv.bg', '0876377928', 'vaskata555', 'unimax', '812171419', 'Васил', 'Стоянов', '11.6', 'Лазур Блок 5 вход 3', 'Лазур Блок 5 вход 3', '8000'),
('20230630230118-7801', 'cash', 'invoices/payment_invoice_20230630230118-7801.pdf', '2023-06-30', '2024-06-30', 33, 'vaskata555@abv.bg', '0876377928', 'vaskata555', 'unimax', '812171419', 'Васил', 'Стоянов', '11.6', 'Лазур Блок 5 вход 3', 'Лазур Блок 5 вход 3', '8000'),
('20230701144818-8949', 'cash', 'invoices/payment_invoice_20230701144818-8949.pdf', '2023-07-01', '2024-07-01', 33, 'vaskata555@abv.bg', '0876377928', 'vaskata555', 'unimax', '812171419', 'Васил', 'Стоянов', '239', 'Лазур Блок 5 вход 3', 'Лазур Блок 5 вход 3', '8000'),
('20230701180410-440', 'cash', 'invoices/payment_invoice_20230701180410-440.pdf', '2023-07-01', '2024-07-01', 33, 'vaskata555@abv.bg', '0876377928', 'vaskata555', 'unimax', '812171419', 'Васил', 'Стоянов', '479.6', 'Лазур Блок 5 вход 3', 'Лазур Блок 5 вход 3', '8000'),
('20230701180418-8259', 'cash', 'invoices/payment_invoice_20230701180418-8259.pdf', '2023-07-01', '2024-07-01', 33, 'vaskata555@abv.bg', '0876377928', 'vaskata555', 'unimax', '812171419', 'Васил', 'Стоянов', '110', 'Лазур Блок 5 вход 3', 'Лазур Блок 5 вход 3', '8000'),
('20230701180724-2691', 'cash', 'invoices/payment_invoice_20230701180724-2691.pdf', '2023-07-01', '2024-07-01', 33, 'vaskata555@abv.bg', '0876377928', 'vaskata555', 'unimax', '812171419', 'Васил', 'Стоянов', '340', 'Лазур Блок 5 вход 3', 'Лазур Блок 5 вход 3', '8000'),
('20230701180736-6130', 'cash', 'invoices/payment_invoice_20230701180736-6130.pdf', '2023-07-01', '2024-07-01', 33, 'vaskata555@abv.bg', '0876377928', 'vaskata555', 'unimax', '812171419', 'Васил', 'Стоянов', '330', 'Лазур Блок 5 вход 3', 'Лазур Блок 5 вход 3', '8000'),
('20230701181441-2320', 'card', 'invoices/payment_invoice_20230701181441-2320.pdf', '2023-07-01', '2024-07-01', 33, 'vaskata555@abv.bg', '0876377928', 'vaskata555', 'unimax', '812171419', 'Васил', 'Стоянов', '1539.2', 'Лазур Блок 5 вход 3', 'Лазур Блок 5 вход 3', '8000'),
('20230701185033-5665', 'card', 'invoices/payment_invoice_20230701185033-5665.pdf', '2023-07-01', '2024-07-01', 33, 'vaskata555@abv.bg', '0876377928', 'vaskata555', 'unimax', '812171419', 'Васил', 'Стоянов', '1129', 'Лазур Блок 5 вход 3', 'Лазур Блок 5 вход 3', '8000'),
('20230702224457-2065', 'card', 'invoices/payment_invoice_20230702224457-2065.pdf', '2023-07-02', '2024-07-02', 33, 'vaskata555@abv.bg', '0876377928', 'vaskata555', 'unimax', '812171419', 'Васил', 'Стоянов', '239', 'Лазур Блок 5 вход 3', 'Лазур Блок 5 вход 3', '8000'),
('20230702225041-3953', 'card', 'invoices/payment_invoice_20230702225041-3953.pdf', '2023-07-02', '2024-07-02', 33, 'vaskata555@abv.bg', '0876377928', 'vaskata555', 'unimax', '812171419', 'Васил', 'Стоянов', '239', 'Лазур Блок 5 вход 3', 'Лазур Блок 5 вход 3', '8000'),
('20230703200640-8469', 'cash', 'invoices/payment_invoice_20230703200640-8469.pdf', '2023-07-03', '2024-07-03', 33, 'vaskata555@abv.bg', '0876377928', 'vaskata555', 'unimax', '812171419', 'Васил', 'Стоянов', '340', 'Лазур Блок 5 вход 3', 'Лазур Блок 5 вход 3', '8000'),
('20230711160327-1702', 'cash', 'invoices/payment_invoice_20230711160327-1702.pdf', '2023-07-11', '2024-07-11', 33, 'vaskata555@abv.bg', '0876377928', 'vaskata555', 'unimax', '812171419', 'Васил', 'Стоянов', '239', 'Лазур Блок 5 вход 3', 'Лазур Блок 5 вход 3', '8000'),
('20230711160328-4285', 'card', 'invoices/payment_invoice_20230711160328-4285.pdf', '2023-07-11', '2024-07-11', 33, 'vaskata555@abv.bg', '0876377928', 'vaskata555', 'unimax', '812171419', 'Васил', 'Стоянов', '239', 'Лазур Блок 5 вход 3', 'Лазур Блок 5 вход 3', '8000'),
('20230711160353-5559', 'cash', 'invoices/payment_invoice_20230711160353-5559.pdf', '2023-07-11', '2024-07-11', 33, 'vaskata555@abv.bg', '0876377928', 'vaskata555', 'unimax', '812171419', 'Васил', 'Стоянов', '110', 'Лазур Блок 5 вход 3', 'Лазур Блок 5 вход 3', '8000'),
('20230711164841-1261', 'card', 'invoices/payment_invoice_20230711164841-1261.pdf', '2023-07-11', '2024-07-11', 33, 'vaskata555@abv.bg', '0876377928', 'vaskata555', 'unimax', '812171419', 'Васил', 'Стоянов', '956', 'Лазур Блок 5 вход 3', 'Лазур Блок 5 вход 3', '8000'),
('20230711165455-5273', 'cash', 'invoices/payment_invoice_20230711165455-5273.pdf', '2023-07-11', '2024-07-11', 33, 'vaskata555@abv.bg', '0876377928', 'vaskata555', 'unimax', '812171419', 'Васил', 'Стоянов', '110', 'Лазур Блок 5 вход 3', 'Лазур Блок 5 вход 3', '8000'),
('20230723174012-2578', 'card', 'invoices/payment_invoice_20230723174012-2578.pdf', '2023-07-23', '2024-07-23', 33, 'vaskata555@abv.bg', '0876377928', 'vaskata555', 'unimax', '812171419', 'Васил', 'Стоянов', '956', 'Лазур Блок 5 вход 3', 'Лазур Блок 5 вход 3', '8000'),
('20230806164532-5479', 'card', 'invoices/payment_invoice_20230806164532-5479.pdf', '2023-08-06', '2024-08-06', 33, 'vaskata555@abv.bg', '0876377928', 'vaskata555', 'unimax', '812171419', 'Васил', 'Стоянов', '239', 'Лазур Блок 5 вход 3', 'Лазур Блок 5 вход 3', '8000');

-- --------------------------------------------------------

--
-- Структура на таблица `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `order_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `id_product` int(255) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `quantity` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Схема на данните от таблица `order_details`
--

INSERT INTO `order_details` (`id`, `order_number`, `id_product`, `title`, `code`, `quantity`, `price`) VALUES
(25, '20230701144818-8949', 104, 'Daisy eXpert SX/ 01 мобилен апарат', 'expertSX2023daisy', '1', '239'),
(26, '20230701180410-440', 102, 'Ролки 57мм/ф40мм/19м термо 12бр', 'qfqwfqwf', '1', '11.6'),
(27, '20230701180410-440', 107, 'Касов апарат Daisy Compact M', 'daisycompactm', '1', '229'),
(28, '20230701180410-440', 104, 'Daisy eXpert SX/ 01 мобилен апарат', 'expertSX2023daisy', '1', '239'),
(29, '20230701180418-8259', 114, 'Datecs Дигитален Екран DPD-201', 'datectsdpdscreen', '1', '110'),
(30, '20230701180724-2691', 116, 'WP-500', 'avv3112sgf', '1', '340'),
(31, '20230701180736-6130', 105, 'ELTRADE A3 стационарен апарат', 'eltradea32023', '1', '330'),
(32, '20230701181441-2320', 114, 'Datecs Дигитален Екран DPD-201', 'datectsdpdscreen', '2', '110'),
(33, '20230701181441-2320', 102, 'Ролки 57мм/ф40мм/19м термо 12бр', 'qfqwfqwf', '2', '11.6'),
(34, '20230701181441-2320', 105, 'ELTRADE A3 стационарен апарат', 'eltradea32023', '3', '330'),
(35, '20230701181441-2320', 109, 'Eltrade a1 стационарен апарат', 'eltradea12023', '1', '306'),
(36, '20230701185033-5665', 104, 'Daisy eXpert SX/ 01 мобилен апарат', 'expertSX2023daisy', '1', '239'),
(37, '20230701185033-5665', 114, 'Datecs Дигитален Екран DPD-201', 'datectsdpdscreen', '2', '110'),
(38, '20230701185033-5665', 116, 'WP-500', 'avv3112sgf', '1', '340'),
(39, '20230701185033-5665', 105, 'ELTRADE A3 стационарен апарат', 'eltradea32023', '1', '330'),
(40, '20230702224457-2065', 104, 'Daisy eXpert SX/ 01 мобилен апарат', 'expertSX2023daisy', '1', '239'),
(41, '20230702225041-3953', 104, 'Daisy eXpert SX/ 01 мобилен апарат', 'expertSX2023daisy', '1', '239'),
(42, '20230703200640-8469', 116, 'WP-500', 'avv3112sgf', '1', '340'),
(43, '20230711160327-1702', 104, 'Daisy eXpert SX/ 01 мобилен апарат', 'expertSX2023daisy', '1', '239'),
(44, '20230711160328-4285', 104, 'Daisy eXpert SX/ 01 мобилен апарат', 'expertSX2023daisy', '1', '239'),
(45, '20230711160353-5559', 114, 'Datecs Дигитален Екран DPD-201', 'datectsdpdscreen', '1', '110'),
(46, '20230711164841-1261', 104, 'Daisy eXpert SX/ 01 мобилен апарат', 'expertSX2023daisy', '4', '239'),
(47, '20230711165455-5273', 114, 'Datecs Дигитален Екран DPD-201', 'datectsdpdscreen', '1', '110'),
(48, '20230723174012-2578', 104, 'Daisy eXpert SX/ 01 мобилен апарат', 'expertSX2023daisy', '4', '239'),
(49, '20230806164532-5479', 104, 'Daisy eXpert SX/ 01 мобилен апарат', 'expertSX2023daisy', '1', '239');

-- --------------------------------------------------------

--
-- Структура на таблица `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `code` varchar(28) NOT NULL,
  `image` varchar(255) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `uploaded` date NOT NULL,
  `short_desc` mediumtext NOT NULL,
  `price` double NOT NULL,
  `long_desc` mediumtext NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `brand_id` int(255) NOT NULL,
  `category_id` int(255) NOT NULL,
  `subcategory_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Схема на данните от таблица `products`
--

INSERT INTO `products` (`id`, `code`, `image`, `file_name`, `uploaded`, `short_desc`, `price`, `long_desc`, `title`, `brand_id`, `category_id`, `subcategory_id`) VALUES
(102, 'qfqwfqwf', 'img/rolka.jpg', 'rolka.jpg', '2023-06-30', 'edvwvew', 11.6, 'vewfwefw', 'Ролки 57мм/ф40мм/19м термо 12бр', 4, 40, 26),
(104, 'expertSX2023daisy', 'img/59expertSX.png', 'img/59expertSX.png', '2045-09-05', 'Daisy eXpert SX/ 01 мобилен апарат', 239, 'Daisy eXpert SX е компактен мобилен касов апарат, съобразен с последните изисквания на Наредба Н-18 на Министерство на финансите ( изм. ДВ бр.9- 31.01.2020г.), включително за онлайн търговия.<br>Подобно на всички фискални устройства от eXpert серията, произвеждани от Daisy Tech, eXpert SX е:<ul><li> лек и компактен</li><li> удобен и устойчив</li><li>ергономичен</li><li>подходящ за работа на открити пазари, при разносна търговия, куриерска дейност и др.</li></ul>', 'Daisy eXpert SX/ 01 мобилен апарат', 5, 35, 21),
(105, 'eltradea32023', 'img/A3-stacionaren.jpg', 'img/A3-stacionaren.jpg', '2045-09-05', 'ELTRADE A3 стационарен', 330, 'ELTRADE A3 е стационарен касов апарат с функционален дизайн, подходящ за работа в натоварени търговски обекти като:\n<br>\n<ul><li>Магазини</li>\n<li>Ресторанти</li>\n<li>Кафенета и барове</li>\n<li>Вериги магазини</li></ul><br>Касовият апарат е съобразен с изискванията на Наредба Н-18. Моделът е съвместим с предлаганите на българския пазар популярни софтуери за управление на продажбите в търговските обекти.', 'ELTRADE A3 стационарен апарат', 6, 35, 22),
(107, 'daisycompactm', 'img/Compact-M.jpeg', 'img/Compact-M.jpeg', '2045-09-05', 'Daisy Compact Мобилен', 229, 'Daisy Compact M е касов апарат от серията Compact.<br>Съобразен с последните изисквания на Наредба Н-18 на Министерство на финансите ( изм. ДВ бр.9- 31.01.2020г.), той е с голям операторски дисплей, клиентски дисплей и вградена батерия. Лек и удобен, с иновативен дизайн. Възможност за връзка по Bluetooth и Wi-Fi. Могат да се зареждат данни за артикули и клиенти. Благодарение на технология, използвана при производство на батерии за електромобили, батерията на Daisy Compact M е с изключително дълъг живот. Подобрената литиево-йонна батерия позволява над 20 000 цикъла зареждане и разреждане! Благодарение на това, батерията на Daisy Compact M е с четири години гаранция!<br>Подходящ за търговски обекти с голяма натовареност като хранителни магазини, аптеки, ресторанти и други.', 'Касов апарат Daisy Compact M', 5, 35, 21),
(109, 'eltradea12023', 'img/А1.jpg', 'А1.jpg', '2045-09-05', 'стационарен апарат ELTRADE А1', 306, 'ELTRADE A1 е разработен на базата на модерна технология, която позволява:<br><ul><li>Интуитивна работа</li>\n<li>Печат на 6 вида баркодове</li>\n<li>Връзка с компютър</li>\n<li>GPRS безжична връзка с отдалечен сървър и други</li>\n<li>Опция за безжична Bluetooth връзка с периферни устройства  </li></ul>', 'Eltrade a1 стационарен апарат', 6, 35, 22),
(114, 'datectsdpdscreen', 'img/DPD-201.jpg', 'DPD-201.jpg', '2045-09-05', 'Datecs Дигитален Екран DPD-201', 110, 'Клиентски дисплей за свързване с принтер или PC. вземи сега на най-изгодната цена<br>Операторски дисплей Вакуум Флуоресцентен<br>\n2 реда по 20 знака<br>\nЧетири нива на яркост<br>\nШрифт Поддържа кирилица<br>\nСвързаност RS-232 C<br>\nСъвместимост с устройства Принтер<br>Захранване DC 10-24V<br>\nРазмери Ш х Д х В в мм 240 x 50 x 420<br>\nТегло 715 гр<br>\nРаботни условия -10 to 40 °C, 5 to 85 % RH<br>\nУсловия за съхранение -20 to 50 °C, 5 to 90 % RH<br>\nГаранция: 12 месеца<br>', 'Datecs Дигитален Екран DPD-201', 5, 41, 29),
(116, 'avv3112sgf', 'img/WP-500.jpg', 'WP-500.jpg', '2023-07-01', 'Датекс WP-500 ', 340, 'Касов апарат Datecs WP-500 KL е най-новия модел на фирма Датекс.<br>\r\n\r\nПритежава възможност за добавяне на 100 000 артикула в 99 департамента.<br>\r\n\r\nОпция за Ethernet, която позволява устройството да бъде използвано като компютър.<br>\r\n\r\n7-редов операторски дисплей.<br>\r\n\r\nИндикатор за батерия.<br>', 'WP-500', 4, 35, 25);

-- --------------------------------------------------------

--
-- Структура на таблица `subcategory`
--

CREATE TABLE `subcategory` (
  `id` int(255) NOT NULL,
  `subcategory_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Схема на данните от таблица `subcategory`
--

INSERT INTO `subcategory` (`id`, `subcategory_name`) VALUES
(21, 'Daisy'),
(22, 'Eltrade'),
(23, 'Kамери'),
(24, 'DVR Устройства'),
(25, 'Datecs'),
(26, 'Касови ролки'),
(27, 'eltrade56'),
(28, 'Калъфи'),
(29, 'Екран'),
(30, 'pedal');

-- --------------------------------------------------------

--
-- Структура на таблица `technician`
--

CREATE TABLE `technician` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Схема на данните от таблица `technician`
--

INSERT INTO `technician` (`id`, `name`) VALUES
(1, 'Стоян'),
(2, 'Младен'),
(3, 'Николай');

-- --------------------------------------------------------

--
-- Структура на таблица `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `verified` int(5) NOT NULL,
  `verification_token` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(100) NOT NULL,
  `type` varchar(50) NOT NULL,
  `organization` varchar(45) DEFAULT NULL,
  `bulstat` varchar(255) DEFAULT NULL,
  `first_name` varchar(40) NOT NULL,
  `last_name` varchar(45) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `address1` varchar(255) NOT NULL,
  `address2` varchar(255) NOT NULL,
  `post_code` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Схема на данните от таблица `users`
--

INSERT INTO `users` (`id`, `verified`, `verification_token`, `email`, `username`, `password`, `type`, `organization`, `bulstat`, `first_name`, `last_name`, `phone_number`, `address1`, `address2`, `post_code`) VALUES
(33, 1, 'ohYAchfwmMKAXdOQVWGdsfcpQnD2izO8', 'vaskata555@abv.bg', 'vaskata555', '$2y$10$EQeJyELN.ccCHUOpFOUvQuPPQ74trHjwTUhkG4/0pu9dtXvZWZJoe', 'admin', 'unimax', '812171419', 'Васил', 'Стоянов', '0876377928', 'Лазур Блок 5 вход 3', 'Лазур Блок 5 вход 3', '8000'),
(34, 0, 'JUjl04xlpQfYOq8uyIkpPEYxSZ84ekXC', 'asqperivate@gmail.com', 'asq121555', '$2y$10$jiG7JC1d7XBsYE4KUpQSA.ABRmqf0jGvjbSmXpbLY9U1b6dGhWsum', 'user', 'asqood', '812171419', 'asq', 'ivanova', '359555577928', '', '', ''),
(35, 0, 'IQJRW31kQxCZ9DXVhBpMMBcay6n1uKI3', 'canko@gmail.com', 'cankoseller', '$2y$10$GcCwXQrLs.TeTlljVqhRQ./6DiPxPjia63bfo40co0w/dEkZqw1Vu', 'user', 'cankosellerood', '812171419', 'canko', 'petrov', '359876447928', '', '', ''),
(37, 0, 'vrJSI6j1hmUtOIZwOjsN0gdbjQmYJvbd', 'smeshko@gmail.com', 'snejina233', '$2y$10$AHbxL4xAIqx6szVkitBqx.s66oJPg8xPN.s/i9DLJWssduW/sX5eK', 'user', 'cankosellerood', '812171419', 'snejina', 'petrova', '359876377928', '', '', ''),
(39, 0, '9xzSQ6rckTWuQjc8V8CTzzcaSiOp4Ten', 'vaskata5ssbb@abv.bg', 'vaskata123dh', '$2y$10$Plu3GezSrP5JkQYqwgUZW.83Dt7A/.0Io7M/REq61PdTlIQBFWb.2', 'user', 'unimaxood', '812171419', 'vasil', 'stoyanov', '359876377928', '', '', ''),
(40, 1, 'Er8xqPohsZ5ibK2vTcKg3kSjOnS1qjgw', 'vaskata5fss@abv.bg', 'vasiltest', '$2y$10$H0PXHzpzQHPaJlLU0DZ3YO1f8zTy213aBXVDNoBz6poNUZapPSN0i', 'admin', 'unimaxood', '812171419', 'ВАСИЛ', 'стоянов', '0876377928', '', '', ''),
(41, 1, '3nRrzaTocmC9DWtPcUTpVIENWUEnWMSK', 'vasko@abv.bg', 'vasko1067', '$2y$10$0r.5f54MxErLjOCNThif5.iv.VTzrSdZw6JQd0Eg84XQ2oPefVeS6', 'user', NULL, NULL, 'Васил', 'Стоянов', '0876377928', '', '', ''),
(42, 0, 'YG988gV4R42AQquxZHVfepsvEw71Q7Wz', 'vaskata555@h.bg', 'manqka2123', '$2y$10$YTI7IupRh/.5SRYh0VNZ4uGPadpQEmMcr13MIgnkHiFcy3iLl3AYC', 'user', NULL, NULL, 'vasko', 'keshaa', ' 0876377917', '', '', ''),
(43, 0, 'iPrqzklxHcGx622gCk5BWevMb4xYasDs', 'vaskata555@s.bg', 'manqkass3', '$2y$10$bzzvEO/3sIss7Ar75KYE7ON1ss46YmXlZs4gL01mRwqUwgcgdMS8e', 'user', NULL, NULL, 'Васил', 'Стоянов', ' 0876377917', '', '', '');

--
-- Indexes for dumped tables
--

--
-- Индекси за таблица `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `appointment_type_id` (`appointment_type_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `appointments_ibfk_1` (`technician_id`);

--
-- Индекси за таблица `appointment_type`
--
ALTER TABLE `appointment_type`
  ADD PRIMARY KEY (`appointment_type_id`);

--
-- Индекси за таблица `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Индекси за таблица `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Индекси за таблица `category_subcategory`
--
ALTER TABLE `category_subcategory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `subcategory_id` (`subcategory_id`);

--
-- Индекси за таблица `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_number`),
  ADD KEY `user_id` (`user_id`);

--
-- Индекси за таблица `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_number` (`order_number`) USING BTREE,
  ADD KEY `id_product` (`id_product`);

--
-- Индекси за таблица `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `subcategory_id` (`subcategory_id`),
  ADD KEY `brand_id` (`brand_id`);

--
-- Индекси за таблица `subcategory`
--
ALTER TABLE `subcategory`
  ADD PRIMARY KEY (`id`);

--
-- Индекси за таблица `technician`
--
ALTER TABLE `technician`
  ADD PRIMARY KEY (`id`);

--
-- Индекси за таблица `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=368;

--
-- AUTO_INCREMENT for table `appointment_type`
--
ALTER TABLE `appointment_type`
  MODIFY `appointment_type_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `category_subcategory`
--
ALTER TABLE `category_subcategory`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT for table `subcategory`
--
ALTER TABLE `subcategory`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `technician`
--
ALTER TABLE `technician`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- Ограничения за дъмпнати таблици
--

--
-- Ограничения за таблица `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`technician_id`) REFERENCES `technician` (`id`),
  ADD CONSTRAINT `appointments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_appointments_appointment_type` FOREIGN KEY (`appointment_type_id`) REFERENCES `appointment_type` (`appointment_type_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения за таблица `category_subcategory`
--
ALTER TABLE `category_subcategory`
  ADD CONSTRAINT `category_subcategory_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `category_subcategory_ibfk_2` FOREIGN KEY (`subcategory_id`) REFERENCES `subcategory` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения за таблица `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения за таблица `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`order_number`) REFERENCES `orders` (`order_number`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`id_product`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения за таблица `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`subcategory_id`) REFERENCES `subcategory` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `products_ibfk_3` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
