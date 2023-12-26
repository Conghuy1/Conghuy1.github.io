-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 26, 2023 lúc 04:10 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `dashboard`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tatistical`
--

CREATE TABLE `tatistical` (
  `date` date NOT NULL,
  `customer` int(9) NOT NULL,
  `occ` float NOT NULL,
  `revenue` bigint(12) NOT NULL,
  `useracc` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tatistical`
--

INSERT INTO `tatistical` (`date`, `customer`, `occ`, `revenue`, `useracc`) VALUES
('2023-12-01', 247, 27.341, 24700000, 2),
('2023-12-02', 202, 23.767, 20200000, 3),
('2023-12-03', 154, 15.983, 15400000, 6),
('2023-12-04', 244, 35.012, 24400000, 8),
('2023-12-05', 512, 76.272, 51200000, 12),
('2023-12-06', 134, 30.628, 13400000, 12),
('2023-12-07', 88, 24.812, 8800000, 21),
('2023-12-08', 212, 39.123, 21200000, 25),
('2023-12-09', 162, 25.345, 16200000, 29),
('2023-12-10', 300, 45.567, 30000000, 35),
('2023-12-11', 123, 13.652, 12300000, 40),
('2023-12-12', 171, 21.241, 17100000, 42),
('2023-12-13', 137, 15.477, 13700000, 43),
('2023-12-14', 168, 19.323, 16800000, 48),
('2023-12-15', 111, 14.298, 11100000, 51),
('2023-12-16', 162, 18.333, 16200000, 60),
('2023-12-17', 205, 29.767, 20500000, 63),
('2023-12-18', 199, 27.367, 19900000, 67),
('2023-12-19', 165, 22.852, 16500000, 67),
('2023-12-20', 182, 24.981, 18200000, 69),
('2023-12-21', 225, 23.632, 22500000, 77),
('2023-12-22', 204, 20.294, 20400000, 80),
('2023-12-23', 195, 20.004, 19500000, 91),
('2023-12-24', 231, 27.442, 23100000, 104),
('2023-12-26', 165, 17.452, 16500000, 108);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `tatistical`
--
ALTER TABLE `tatistical`
  ADD PRIMARY KEY (`date`);

DELIMITER $$
--
-- Sự kiện
--
CREATE DEFINER=`root`@`localhost` EVENT `delete_old_data_event` ON SCHEDULE EVERY 1 DAY STARTS '2023-12-10 23:06:02' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN END$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
