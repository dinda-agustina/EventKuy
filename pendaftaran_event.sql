-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 24, 2024 at 11:01 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pendaftaran_event`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `deleteEvent` (IN `p_id_event` INT)   BEGIN
    -- Delete related rows in peserta table
    DELETE FROM peserta WHERE id_event = p_id_event;

    -- Delete the event
    DELETE FROM event WHERE id_event = p_id_event;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `deleteKategori` (IN `p_id_kategori` INT)   BEGIN
    DELETE FROM kategori_event WHERE id_kategori = p_id_kategori;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertEvent` (IN `eventTitle` VARCHAR(100), IN `penyelenggara` VARCHAR(50), IN `beginDate` DATETIME, IN `endDate` DATETIME, IN `location` VARCHAR(100), IN `description` VARCHAR(100), IN `kuota` INT, IN `kategoriId` INT, IN `userId` INT)   BEGIN
    INSERT INTO event (nama_event, penyelenggara, tgl_mulai, tgl_selesai, lokasi, keterangan, kuota, jumlah_peserta, id_kategori, user_id)
    VALUES (eventTitle, penyelenggara, beginDate, endDate, location, description, kuota, 0, kategoriId, userId);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertKategori` (IN `p_nama_kategori` VARCHAR(60))   BEGIN
    INSERT INTO kategori_event (nama_kategori) VALUES (p_nama_kategori);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updateEvent` (IN `p_id_event` INT, IN `p_nama_event` VARCHAR(100), IN `p_penyelenggara` VARCHAR(50), IN `p_tgl_mulai` DATETIME, IN `p_tgl_selesai` DATETIME, IN `p_lokasi` VARCHAR(100), IN `p_keterangan` VARCHAR(100), IN `p_kuota` INT, IN `p_id_kategori` INT)   BEGIN
    UPDATE event
    SET nama_event = p_nama_event,
        penyelenggara = p_penyelenggara,
        tgl_mulai = p_tgl_mulai,
        tgl_selesai = p_tgl_selesai,
        lokasi = p_lokasi,
        keterangan = p_keterangan,
        kuota = p_kuota,
        id_kategori = p_id_kategori
        
    WHERE id_event = p_id_event;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updateKategori` (IN `p_id_kategori` INT, IN `p_nama_kategori` VARCHAR(255))   BEGIN
    UPDATE kategori_event 
    SET nama_kategori = p_nama_kategori 
    WHERE id_kategori = p_id_kategori;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `id_event` int(11) NOT NULL,
  `nama_event` varchar(100) NOT NULL,
  `penyelenggara` varchar(50) NOT NULL,
  `tgl_mulai` datetime NOT NULL,
  `tgl_selesai` datetime NOT NULL,
  `lokasi` varchar(100) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `kuota` int(11) NOT NULL,
  `jumlah_peserta` int(11) NOT NULL DEFAULT 0,
  `id_kategori` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Triggers `event`
--
DELIMITER $$
CREATE TRIGGER `after_event_delete` AFTER DELETE ON `event` FOR EACH ROW BEGIN
    DECLARE nm_kategori VARCHAR(60);
    SELECT nama_kategori INTO nm_kategori FROM kategori_event WHERE id_kategori = OLD.id_kategori;
    INSERT INTO event_log (event_type, id_event, nama_event, penyelenggara, tgl_mulai, tgl_selesai, lokasi, keterangan, kuota, jumlah_peserta, nama_kategori, user_id)
    VALUES ('DELETE', OLD.id_event, OLD.nama_event, OLD.penyelenggara, OLD.tgl_mulai, OLD.tgl_selesai, OLD.lokasi, OLD.keterangan, OLD.kuota, OLD.jumlah_peserta, nm_kategori, OLD.user_id);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_event_insert` AFTER INSERT ON `event` FOR EACH ROW BEGIN
    DECLARE nm_kategori VARCHAR(60);

    SELECT nama_kategori INTO nm_kategori FROM kategori_event WHERE id_kategori = NEW.id_kategori;

    INSERT INTO event_log (event_type, id_event, nama_event, penyelenggara, tgl_mulai, tgl_selesai, lokasi, keterangan, kuota, jumlah_peserta, nama_kategori, user_id)
    VALUES ('INSERT', NEW.id_event, NEW.nama_event, NEW.penyelenggara, NEW.tgl_mulai, NEW.tgl_selesai, NEW.lokasi, NEW.keterangan, NEW.kuota, NEW.jumlah_peserta, nm_kategori, NEW.user_id);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_event_update` AFTER UPDATE ON `event` FOR EACH ROW BEGIN
    DECLARE nm_kategori VARCHAR(60);
    SELECT nama_kategori INTO nm_kategori FROM kategori_event WHERE id_kategori = NEW.id_kategori;
    INSERT INTO event_log (event_type, id_event, nama_event, penyelenggara, tgl_mulai, tgl_selesai, lokasi, keterangan, kuota, jumlah_peserta, nama_kategori, user_id)
    VALUES ('UPDATE', NEW.id_event, NEW.nama_event, NEW.penyelenggara, NEW.tgl_mulai, NEW.tgl_selesai, NEW.lokasi, NEW.keterangan, NEW.kuota, NEW.jumlah_peserta, nm_kategori, NEW.user_id);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `event_log`
--

CREATE TABLE `event_log` (
  `id` int(11) NOT NULL,
  `event_type` varchar(10) DEFAULT NULL,
  `id_event` int(11) DEFAULT NULL,
  `nama_event` varchar(100) DEFAULT NULL,
  `penyelenggara` varchar(50) DEFAULT NULL,
  `tgl_mulai` datetime DEFAULT NULL,
  `tgl_selesai` datetime DEFAULT NULL,
  `lokasi` varchar(100) DEFAULT NULL,
  `keterangan` varchar(100) DEFAULT NULL,
  `kuota` int(11) NOT NULL,
  `jumlah_peserta` int(11) NOT NULL,
  `nama_kategori` varchar(60) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `log_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kategori_event`
--

CREATE TABLE `kategori_event` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Triggers `kategori_event`
--
DELIMITER $$
CREATE TRIGGER `after_kategori_delete` AFTER DELETE ON `kategori_event` FOR EACH ROW BEGIN
    INSERT INTO kategori_log (event_type, kategori_id, nama_kategori)
    VALUES ('DELETE', OLD.id_kategori, OLD.nama_kategori);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_kategori_insert` AFTER INSERT ON `kategori_event` FOR EACH ROW BEGIN
    INSERT INTO kategori_log (event_type, kategori_id, nama_kategori)
    VALUES ('INSERT', NEW.id_kategori, NEW.nama_kategori);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_kategori_update` AFTER UPDATE ON `kategori_event` FOR EACH ROW BEGIN
    INSERT INTO kategori_log (event_type, kategori_id, nama_kategori)
    VALUES ('UPDATE', NEW.id_kategori, NEW.nama_kategori);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `kategori_log`
--

CREATE TABLE `kategori_log` (
  `id` int(11) NOT NULL,
  `event_type` varchar(10) DEFAULT NULL,
  `kategori_id` int(11) DEFAULT NULL,
  `nama_kategori` varchar(60) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `peserta`
--

CREATE TABLE `peserta` (
  `id_peserta` int(11) NOT NULL,
  `nama_lengkap` varchar(225) NOT NULL,
  `email` varchar(60) NOT NULL,
  `jk` varchar(12) NOT NULL,
  `usia` int(10) UNSIGNED NOT NULL,
  `alamat` varchar(225) NOT NULL,
  `id_event` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Triggers `peserta`
--
DELIMITER $$
CREATE TRIGGER `after_peserta_delete` AFTER DELETE ON `peserta` FOR EACH ROW BEGIN
    DECLARE nm_event VARCHAR(60);
    DECLARE usnm VARCHAR(20);
    
    SELECT nama_event INTO nm_event FROM event WHERE id_event = OLD.id_event;
    SELECT username INTO usnm FROM users WHERE user_id = OLD.user_id;
    
    INSERT INTO peserta_log (event_type, id_peserta, nama_lengkap, email, jk, usia, alamat, nama_event, username)
    VALUES ('DELETE', OLD.id_peserta, OLD.nama_lengkap, OLD.email, OLD.jk, OLD.usia, OLD.alamat, nm_event, usnm);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_peserta_insert` AFTER INSERT ON `peserta` FOR EACH ROW BEGIN
    DECLARE nm_event VARCHAR(60);
    DECLARE usnm VARCHAR(20);
    
    SELECT nama_event INTO nm_event FROM event WHERE id_event = NEW.id_event;
    SELECT username INTO usnm FROM users WHERE user_id = NEW.user_id;
    
    INSERT INTO peserta_log (event_type, id_peserta, nama_lengkap, email, jk, usia, alamat, nama_event, username)
    VALUES ('INSERT', NEW.id_peserta, NEW.nama_lengkap, NEW.email, NEW.jk, NEW.usia, NEW.alamat, nm_event, usnm);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_peserta_update` AFTER UPDATE ON `peserta` FOR EACH ROW BEGIN
    DECLARE nm_event VARCHAR(60);
    DECLARE usnm VARCHAR(20);
    
    SELECT nama_event INTO nm_event FROM event WHERE id_event = NEW.id_event;
    SELECT username INTO usnm FROM users WHERE user_id = NEW.user_id;
    
    INSERT INTO peserta_log (event_type, id_peserta, nama_lengkap, email, jk, usia, alamat, nama_event, username)
    VALUES ('UPDATE', NEW.id_peserta, NEW.nama_lengkap, NEW.email, NEW.jk, NEW.usia, NEW.alamat, nm_event, usnm);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `peserta_log`
--

CREATE TABLE `peserta_log` (
  `id` int(11) NOT NULL,
  `event_type` varchar(10) DEFAULT NULL,
  `id_peserta` int(11) DEFAULT NULL,
  `nama_lengkap` varchar(225) DEFAULT NULL,
  `email` varchar(60) DEFAULT NULL,
  `jk` varchar(12) DEFAULT NULL,
  `usia` int(10) DEFAULT NULL,
  `alamat` varchar(225) DEFAULT NULL,
  `nama_event` varchar(60) DEFAULT NULL,
  `username` varchar(20) DEFAULT NULL,
  `log_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(225) NOT NULL,
  `password` varchar(225) NOT NULL,
  `role` varchar(50) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `name`, `email`, `password`, `role`) VALUES
(1, 'admin', 'admin', 'admin@gmail.com', '$2y$10$mFkFGHwyPAbViYPaptgTRujgcUAtE3PSfQlKAO8l7QkCVegqw7moO', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id_event`),
  ADD KEY `id_kategori` (`id_kategori`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `event_log`
--
ALTER TABLE `event_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori_event`
--
ALTER TABLE `kategori_event`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `kategori_log`
--
ALTER TABLE `kategori_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `peserta`
--
ALTER TABLE `peserta`
  ADD PRIMARY KEY (`id_peserta`),
  ADD UNIQUE KEY `id_event` (`id_event`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `peserta_log`
--
ALTER TABLE `peserta_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `id_event` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `event_log`
--
ALTER TABLE `event_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kategori_event`
--
ALTER TABLE `kategori_event`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kategori_log`
--
ALTER TABLE `kategori_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `peserta`
--
ALTER TABLE `peserta`
  MODIFY `id_peserta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `peserta_log`
--
ALTER TABLE `peserta_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `event`
--
ALTER TABLE `event`
  ADD CONSTRAINT `event_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori_event` (`id_kategori`),
  ADD CONSTRAINT `event_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `peserta`
--
ALTER TABLE `peserta`
  ADD CONSTRAINT `peserta_ibfk_1` FOREIGN KEY (`id_event`) REFERENCES `event` (`id_event`),
  ADD CONSTRAINT `peserta_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
