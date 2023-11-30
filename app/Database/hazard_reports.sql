-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.33 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for hazard_reports
CREATE DATABASE IF NOT EXISTS `hazard_reports` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `hazard_reports`;

-- Dumping structure for table hazard_reports.hazards
CREATE TABLE IF NOT EXISTS `hazards` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `tgl_lapor` date DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `nip` varchar(255) DEFAULT NULL,
  `section` varchar(255) DEFAULT NULL,
  `lokasi` varchar(255) DEFAULT NULL,
  `jenis_bahaya` int(1) DEFAULT NULL,
  `uraian_bahaya` text,
  `penyebab` varchar(255) DEFAULT NULL,
  `tindakan_perbaikan` varchar(255) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `id_user` int(5) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table hazard_reports.hazards: ~0 rows (approximately)
/*!40000 ALTER TABLE `hazards` DISABLE KEYS */;
/*!40000 ALTER TABLE `hazards` ENABLE KEYS */;

-- Dumping structure for table hazard_reports.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `role` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Dumping data for table hazard_reports.users: ~4 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `username`, `password`, `name`, `role`) VALUES
	(1, 'admin', '$2y$10$iaqWClwjt3j1QMVhQxFKouZaWsjTE5aqgCkUNcGAw9m250SNInuAi', 'Admin 1', 1),
	(6, 'admin2', '$2y$10$sq20wL3anwsf.CKvr.AEcuMqogJ9uc.9oevKC6r7VOJaG..kfTQu.', 'Admin2', 1),
	(7, 'user', '$2y$10$MiNlmHaZs60dIZBDHcJgzeXMyl/X5VXR4UnjK1dF8pefUQtlk1eY6', 'User', 2),
	(8, 'user2', '$2y$10$blCM0rZRh558Knc.QK0RheieZAuf3wnVT/CkC1o8/0rMJbxa/Puzy', 'User2', 2);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
