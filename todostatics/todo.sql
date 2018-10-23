-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost
-- Üretim Zamanı: 21 Eki 2018, 22:37:52
-- Sunucu sürümü: 10.1.36-MariaDB
-- PHP Sürümü: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `todo`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `listduty`
--

CREATE TABLE `listduty` (
  `id` int(11) NOT NULL,
  `duty` varchar(300) COLLATE utf8_turkish_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `timess` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `listduty`
--

INSERT INTO `listduty` (`id`, `duty`, `status`, `timess`) VALUES
(9, 'test123', 0, '2018-10-07 15:48:28'),
(10, 'sdfdsf', 0, '2018-10-13 16:06:46'),
(11, 'dfdsffs', 1, '2018-10-21 16:42:17'),
(12, 'dsfdsfsdfds', 1, '2018-10-19 16:42:16'),
(13, 'dsfdsfsd', 1, '2018-10-21 16:42:15'),
(14, 'sadasdas', 0, '2018-10-21 17:55:25'),
(15, 'sadsadsa', 0, '2018-10-11 17:55:26'),
(16, 'asdasd', 1, '2018-10-21 19:33:36'),
(17, 'hhuhuhuhuhu', 1, '2018-10-21 19:33:35');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `listduty`
--
ALTER TABLE `listduty`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `listduty`
--
ALTER TABLE `listduty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
