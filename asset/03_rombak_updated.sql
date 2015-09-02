-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.21 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL Version:             9.2.0.4947
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping database structure for inventory
CREATE DATABASE IF NOT EXISTS `inventory` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `inventory`;


-- Dumping structure for table inventory.admins
CREATE TABLE IF NOT EXISTS `admins` (
  `username` varchar(50) NOT NULL,
  `password` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `nama_lengkap` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `level` varchar(20) NOT NULL,
  `blokir` enum('Y','N') NOT NULL DEFAULT 'N',
  `foto` varchar(50) NOT NULL,
  PRIMARY KEY (`username`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table inventory.admins: ~2 rows (approximately)
DELETE FROM `admins`;
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` (`username`, `password`, `nama_lengkap`, `level`, `blokir`, `foto`) VALUES
	('admin', '21232f297a57a5a743894a0e4a801fc3', 'Administrator', '01', 'N', 'admin.jpg'),
	('sukini', 'e8aa48533e3bb0a65c11a84fb4d9cb12', 'Sukini', '02', 'N', '');
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;


-- Dumping structure for table inventory.barang
CREATE TABLE IF NOT EXISTS `barang` (
  `kode_barang` char(15) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `id_jenis` char(3) NOT NULL,
  `satuan` char(10) NOT NULL,
  `harga_beli` bigint(20) NOT NULL,
  `harga_jual` bigint(20) NOT NULL,
  `stok_awal` int(11) NOT NULL,
  PRIMARY KEY (`kode_barang`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table inventory.barang: ~0 rows (approximately)
DELETE FROM `barang`;
/*!40000 ALTER TABLE `barang` DISABLE KEYS */;
/*!40000 ALTER TABLE `barang` ENABLE KEYS */;


-- Dumping structure for table inventory.ci_sessions
CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table inventory.ci_sessions: ~2 rows (approximately)
DELETE FROM `ci_sessions`;
/*!40000 ALTER TABLE `ci_sessions` DISABLE KEYS */;
INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
	('4be104a7ac86a85b75663a2bf4299458', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', 1441182885, 'a:6:{s:9:"user_data";s:0:"";s:9:"logged_in";s:13:"aingLoginYeuh";s:8:"username";s:5:"admin";s:12:"nama_lengkap";s:13:"Administrator";s:4:"foto";s:9:"admin.jpg";s:5:"level";s:2:"01";}'),
	('679f1df660ceefe657c6ccf44eaa5a82', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.157 Safari/537.36', 1441179819, 'a:6:{s:9:"user_data";s:0:"";s:9:"logged_in";s:13:"aingLoginYeuh";s:8:"username";s:5:"admin";s:12:"nama_lengkap";s:13:"Administrator";s:4:"foto";s:9:"admin.jpg";s:5:"level";s:2:"01";}');
/*!40000 ALTER TABLE `ci_sessions` ENABLE KEYS */;


-- Dumping structure for table inventory.d_beli
CREATE TABLE IF NOT EXISTS `d_beli` (
  `idbeli` smallint(6) NOT NULL AUTO_INCREMENT,
  `kodebeli` char(15) NOT NULL,
  `kode_barang` char(15) NOT NULL,
  `jmlbeli` int(11) NOT NULL,
  `hargabeli` double NOT NULL,
  PRIMARY KEY (`idbeli`),
  KEY `kodebeli` (`kodebeli`),
  KEY `kode_barang` (`kode_barang`),
  CONSTRAINT `d_beli_ibfk_1` FOREIGN KEY (`kodebeli`) REFERENCES `h_beli` (`kodebeli`),
  CONSTRAINT `d_beli_ibfk_2` FOREIGN KEY (`kode_barang`) REFERENCES `barang` (`kode_barang`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table inventory.d_beli: ~0 rows (approximately)
DELETE FROM `d_beli`;
/*!40000 ALTER TABLE `d_beli` DISABLE KEYS */;
/*!40000 ALTER TABLE `d_beli` ENABLE KEYS */;


-- Dumping structure for table inventory.d_jual
CREATE TABLE IF NOT EXISTS `d_jual` (
  `idjual` smallint(6) NOT NULL AUTO_INCREMENT,
  `kodejual` char(15) NOT NULL,
  `kode_barang` char(15) NOT NULL,
  `jmljual` int(11) NOT NULL,
  `hargajual` double NOT NULL,
  PRIMARY KEY (`idjual`),
  KEY `kode_barang` (`kode_barang`),
  KEY `kodejual` (`kodejual`),
  CONSTRAINT `d_jual_ibfk_1` FOREIGN KEY (`kode_barang`) REFERENCES `barang` (`kode_barang`),
  CONSTRAINT `d_jual_ibfk_2` FOREIGN KEY (`kodejual`) REFERENCES `h_jual` (`kodejual`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table inventory.d_jual: ~0 rows (approximately)
DELETE FROM `d_jual`;
/*!40000 ALTER TABLE `d_jual` DISABLE KEYS */;
/*!40000 ALTER TABLE `d_jual` ENABLE KEYS */;


-- Dumping structure for table inventory.glasir
CREATE TABLE IF NOT EXISTS `glasir` (
  `id_glasir` varchar(50) NOT NULL,
  `nama_glasir` varchar(50) NOT NULL,
  `nama_alias` varchar(50) NOT NULL,
  `satuan` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `s_bgps` decimal(10,0) NOT NULL,
  `s_supply` decimal(10,0) NOT NULL,
  `inputer` varchar(50) NOT NULL,
  `tgl_input` datetime NOT NULL,
  `tgl_update` datetime NOT NULL,
  PRIMARY KEY (`id_glasir`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table inventory.glasir: ~212 rows (approximately)
DELETE FROM `glasir`;
/*!40000 ALTER TABLE `glasir` DISABLE KEYS */;
INSERT INTO `glasir` (`id_glasir`, `nama_glasir`, `nama_alias`, `satuan`, `status`, `s_bgps`, `s_supply`, `inputer`, `tgl_input`, `tgl_update`) VALUES
	('Y00001', '0202 Brown', 'Brown si madun', 'Kilogram', '1', 500, 25, 'admin', '2015-08-07 09:09:08', '2015-08-17 03:44:18'),
	('Y00002', '0202 Brown Floral dream', 'Mirip jenis sabun', 'Kilogram', '1', 700, 25, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00003', '0202 Pink', 'Pink jambu muda', 'Kilogram', '1', 500, 25, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00004', '0401 Blue', 'Blue coral', 'Kilogram', '1', 500, 25, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00005', '0401 Pink', 'Pink ngejreng', 'Kilogram', '1', 500, 25, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00006', '0402 Blue', 'Blue langit', 'Kilogram', '1', 500, 25, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00007', '1Tone 5101 Clay', 'Wantun kley', 'Kilogram', '1', 500, 25, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00008', '1Tone 5102 Spruce', 'Wantun sprus', 'Kilogram', '1', 500, 25, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00009', '1Tone 8034 Graphite', 'Wantun garapit', 'Kilogram', '1', 500, 25, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00010', '1Tone 8040 Cream', 'Wantun Krim', 'Kilogram', '1', 500, 25, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00011', '1Tone 8045 Raspberry', '', 'Kilogram', '1', 100, 25, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00012', '1Tone 8046 Chocolate', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00013', '1Tone 8049 Suede', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00014', '1Tone 8050 Indigo Blue', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00015', '1Tone 8052 Brown', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00016', '1Tone 8053 Slate', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00017', '1Tone 8059 Moss', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00018', '1Tone 8065 Mustard', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00019', '1Tone 8067 Burgundy', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00020', '1Tone 8090 White', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00021', '1Tone 8092 Teracota', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00022', '1Tone 8093 Turquoise', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00023', '1Tone 8094 Apple', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00024', '1Tone 8098 Plum', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00025', '1Tone 8099 Ice Blue', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00026', '1Tone 8483 Grey', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00027', '1Tone 8484 Blue', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00028', '1Tone 8485 Green', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00029', '1Tone 8486 Purple', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00030', '1Tone 8491 Yellow', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00031', '5100 Chocolate', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00032', '5101 Clay', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00033', '5102 Spruce', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00034', '5300 Summer', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00035', '8034 Graphite', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00036', '8040 Cream', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00037', '8045 Raspberry', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00038', '8046 Chocolate', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00039', '8049 Suede', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00040', '8050 Indigo Blue', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00041', '8050 Indigo Blue shiny', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00042', '8051 Green Forest', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00043', '8052 Brown', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00044', '8052 Brown shiny', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00045', '8053 Slate', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00046', '8053 Slate shiny', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00047', '8059 Moss', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00048', '8059 Moss shiny', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00049', '8065 Mustard', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00050', '8067 Burgundy', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00051', '8067 Burgundy shiny', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00052', '8079 Blue', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00053', '8082 Green', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00054', '8083 Yellow', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00055', '8090 Engobe', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00056', '8090 White', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00057', '8092 Teracota', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00058', '8093 Turquoise', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00059', '8094 Apple', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00060', '8096 Blue', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00061', '8097 Green', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00062', '8098 Plum', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00063', '8099 Ice Blue', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00064', '8170 Blue', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00065', '8170 Green', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00066', '8483 Grey', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00067', '8484 Blue', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00068', '8485 Green', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00069', '8486 Purple', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00070', '8491 Yellow', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00071', 'Andante Brown', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00072', 'Andante Gloss', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00073', 'Andante Lime Green', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00074', 'Andante Red', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00075', 'Andante Turquoise', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00076', 'Andante White', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00077', 'Anis Green', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00078', 'Antique White', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00079', 'Bali Green', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00080', 'Barella Blue Ice', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00081', 'Barella Cafe Latte', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00082', 'Barella French Vanilla', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00083', 'Bastide Brown', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00084', 'Beige Light', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00085', 'Black', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00086', 'Black BOB', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00087', 'Black Matte', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00088', 'Black Migros', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00089', 'Black Noir', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00090', 'Black STN', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00091', 'Black Stone', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00092', 'Blue', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00093', 'Blue Contempo', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00094', 'Blue Ice', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00095', 'Blue Peppercone', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00096', 'Brown', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00097', 'Brown Orchid', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00098', 'Brown Reactive+Speckle', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00099', 'Brown Stitch', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00100', 'Brown+Speckle', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00101', 'Clear+Black Speckle', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00102', 'Combee', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00103', 'Cool Grey 11 C', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00104', 'Cream', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00105', 'Cream Colorvara', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00106', 'Cream JCC', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00107', 'Cream Kaolin', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00108', 'Cream Orchid', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00109', 'Dark Brown Unitable', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00110', 'Dark Heather 5135C (Pantone 258C)', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00111', 'Dark Orange', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00112', 'Debenham Cream', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00113', 'Fronside Kona', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00114', 'Gloss', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00115', 'Gloss Epi', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00116', 'Gloss ICS', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00117', 'GOG', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00118', 'Green', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00119', 'Green Bali', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00120', 'Green Colour Yellow', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00121', 'Green Leaves', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00122', 'Green Reactive', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00123', 'Green Semi Matte', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00124', 'Green Ubud', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00125', 'Gres Fermier', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00126', 'Gress Fermier Grey', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00127', 'Gress Fermier Moss', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00128', 'Grey', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00129', 'Grey JCC', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00130', 'Ice Blue', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00131', 'Italla Apple Red', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00132', 'Italla Edelweish', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00133', 'Italla Graphite', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00134', 'Italla Pale Rose', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00135', 'Italla Sand Glossy', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00136', 'Italla White Glossy', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00137', 'Lava White', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00138', 'Lavender', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00139', 'Light 8050 Indigo Blue', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00140', 'Light 8052 Brown', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00141', 'Light 8053 Slate', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00142', 'Light 8059 Moss', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00143', 'Light 8067 Burgundy', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00144', 'Living Stone Red', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00145', 'Migros Dark Blue', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00146', 'Migros Dark Orange', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00147', 'Mikasa Cream', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00148', 'Mocca', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00149', 'Narumi Cream', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00150', 'New Blue', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00151', 'Ocean Blue', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00152', 'Oneida Green', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00153', 'Orange', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00154', 'P 5555C', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00155', 'Panama Falabela', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00156', 'Pantone 137 C/ Org', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00157', 'Picasso Jaune', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00158', 'Picasso Yellow', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00159', 'Pink', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00160', 'Pink Broderie', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00161', 'Pink Maison', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00162', 'Pink Serena', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00163', 'Purple Beneton', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00164', 'Purple Burgundi', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00165', 'Purple Light', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00166', 'Purple Serena', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00167', 'Reactive Green', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00168', 'Reactive Orange', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00169', 'Reactive Yellow', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00170', 'Red', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00171', 'Red Beneton', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00172', 'Red Chilli', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00173', 'Red Coble', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00174', 'Red Lohan', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00175', 'Red Small Tube', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00176', 'Sage Green', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00177', 'Savanah 3', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00178', 'Savanah Meil', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00179', 'Savanah Noritake', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00180', 'Savanah Speckle', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00181', 'Spice Cayenne', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00182', 'Spice Cilantro', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00183', 'Spice Saffron', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00184', 'Sudo Blue', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00185', 'Tarrerias Griss', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00186', 'Taupe', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00187', 'Ter Lichen', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00188', 'Terrarias Red', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00189', 'Terre Dombre', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00190', 'TOT', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00191', 'Turquise', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00192', 'Turquise Serena', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00193', 'Turquoise Matt', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00194', 'Upper Lava D1/2', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00195', 'Upper White Verceral', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00196', 'Violet 258C', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00197', 'Warm Grey Colorama', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00198', 'WB Cream', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00199', 'WB Pink', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00200', 'WB Powder Blue', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00201', 'WB Sage', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00202', 'White', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00203', 'White Glossy', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00204', 'White Kaolin', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00205', 'White Peptapon', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00206', 'Winterberry Cream', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00207', 'Winterberry Cream ICS', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00208', 'Yello Kuta', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00209', 'Yellow', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00210', 'Yellow C', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00211', 'Yellow Kuta', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00212', 'Yellow Serena', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00');
/*!40000 ALTER TABLE `glasir` ENABLE KEYS */;


-- Dumping structure for table inventory.glasir_patt
CREATE TABLE IF NOT EXISTS `glasir_patt` (
  `idgps` smallint(6) NOT NULL,
  `nama_gps` char(50) NOT NULL,
  `desc_gps` varchar(150) NOT NULL,
  PRIMARY KEY (`idgps`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table inventory.glasir_patt: ~5 rows (approximately)
DELETE FROM `glasir_patt`;
/*!40000 ALTER TABLE `glasir_patt` DISABLE KEYS */;
INSERT INTO `glasir_patt` (`idgps`, `nama_gps`, `desc_gps`) VALUES
	(1, 'Selesai Milling', 'Glasir selesai milling belum tes bakar'),
	(2, 'Glasir Ori', 'Glasir selesai tes bakar sudah di tong'),
	(3, 'Glasir Hold', 'Glasir sedang dilakukan proses setel atau setelah '),
	(4, 'Glasir Pass', 'Glasir sudah dilakukan proses setel siap digunakan'),
	(5, 'Glasir No Pass', 'Glasir tidak bisa digunakan');
/*!40000 ALTER TABLE `glasir_patt` ENABLE KEYS */;


-- Dumping structure for table inventory.glasir_ph
CREATE TABLE IF NOT EXISTS `glasir_ph` (
  `no_prod` char(15) NOT NULL,
  `inputer` varchar(50) NOT NULL,
  `tgl_inp` datetime NOT NULL,
  `lst_upd` datetime NOT NULL,
  PRIMARY KEY (`no_prod`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table inventory.glasir_ph: ~4 rows (approximately)
DELETE FROM `glasir_ph`;
/*!40000 ALTER TABLE `glasir_ph` DISABLE KEYS */;
INSERT INTO `glasir_ph` (`no_prod`, `inputer`, `tgl_inp`, `lst_upd`) VALUES
	('PG00001', 'admin', '2015-08-22 11:21:52', '0000-00-00 00:00:00'),
	('PG00002', 'admin', '2015-08-24 07:51:43', '0000-00-00 00:00:00'),
	('PG00003', 'admin', '2015-08-24 08:00:16', '0000-00-00 00:00:00'),
	('PG00004', 'admin', '2015-08-28 05:04:14', '0000-00-00 00:00:00'),
	('PG00005', 'admin', '2015-08-31 02:45:17', '0000-00-00 00:00:00'),
	('PG00006', 'admin', '2015-09-02 02:43:35', '0000-00-00 00:00:00'),
	('PG00007', 'admin', '2015-09-02 02:45:05', '0000-00-00 00:00:00');
/*!40000 ALTER TABLE `glasir_ph` ENABLE KEYS */;


-- Dumping structure for table inventory.glasir_phd
CREATE TABLE IF NOT EXISTS `glasir_phd` (
  `idphd` smallint(6) NOT NULL AUTO_INCREMENT,
  `no_prod` char(15) NOT NULL,
  `id_glasir` varchar(50) NOT NULL,
  `id_bm` smallint(6) NOT NULL,
  `id_bmt` smallint(6) NOT NULL,
  `volume` double NOT NULL,
  `densitas` double NOT NULL,
  `inputer` varchar(50) NOT NULL,
  `dsc` varchar(255) NOT NULL,
  `petugas` varchar(50) NOT NULL,
  `tgl_insert` datetime NOT NULL,
  PRIMARY KEY (`idphd`),
  KEY `FK_glasir_phd_glasir` (`id_glasir`),
  KEY `FK_glasir_phd_glasir_ph` (`no_prod`),
  KEY `FK_glasir_phd_admins` (`inputer`),
  KEY `FK_glasir_phd_global_mesin` (`id_bm`),
  CONSTRAINT `FK_glasir_phd_global_mesin` FOREIGN KEY (`id_bm`) REFERENCES `global_mesin` (`id_bm`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table inventory.glasir_phd: ~6 rows (approximately)
DELETE FROM `glasir_phd`;
/*!40000 ALTER TABLE `glasir_phd` DISABLE KEYS */;
INSERT INTO `glasir_phd` (`idphd`, `no_prod`, `id_glasir`, `id_bm`, `id_bmt`, `volume`, `densitas`, `inputer`, `dsc`, `petugas`, `tgl_insert`) VALUES
	(21, 'PG00001', 'Y00011', 18, 0, 100, 1600, 'admin', 'Ok', 'zainudin', '2015-08-22 11:21:52'),
	(23, 'PG00002', 'Y00001', 18, 0, 200, 1500, 'admin', 'ditambah', 'zainudin', '2015-08-24 07:52:34'),
	(25, 'PG00004', 'Y00001', 18, 0, 1200, 1500, 'admin', 'Kebutuhan export', 'zainudin', '2015-08-28 05:04:14'),
	(35, 'PG00003', 'Y00002', 15, 2, 255.59, 1500, 'admin', 'Monyong', 'Jeni', '2015-09-02 01:37:01'),
	(40, 'PG00005', 'Y00003', 14, 2, 255.59, 1500, 'admin', '', 'lina', '2015-09-02 01:57:59'),
	(41, 'PG00004', 'Y00003', 14, 3, 255.59, 1500, 'admin', 'luna', 'lonja', '2015-09-02 01:58:46'),
	(42, 'PG00006', 'Y00003', 11, 2, 511.18, 1500, 'admin', 'Tambah stok', 'Jono', '2015-09-02 02:43:36'),
	(43, 'PG00007', 'Y00004', 15, 2, 511.18, 1500, 'admin', 'wuhaaa', 'Dono', '2015-09-02 02:45:06'),
	(44, 'PG00007', 'Y00005', 15, 2, 511.18, 1500, 'admin', 'wuhaaa', 'Dono', '2015-09-02 02:45:50'),
	(45, 'PG00007', 'Y00006', 15, 2, 511.18, 1500, 'admin', 'wuhaaa', 'Dono', '2015-09-02 02:45:58'),
	(46, 'PG00007', 'Y00007', 15, 2, 511.18, 1500, 'admin', 'wuhaaa', 'Dono', '2015-09-02 02:46:03'),
	(47, 'PG00007', 'Y00008', 15, 2, 511.18, 1500, 'admin', 'wuhaaa', 'Dono', '2015-09-02 02:46:08'),
	(48, 'PG00007', 'Y00009', 15, 2, 511.18, 1500, 'admin', 'wuhaaa', 'Dono', '2015-09-02 02:46:15'),
	(49, 'PG00007', 'Y00010', 15, 2, 511.18, 1500, 'admin', 'wuhaaa', 'Dono', '2015-09-02 02:46:21'),
	(50, 'PG00001', 'Y00002', 6, 2, 511.18, 1500, 'admin', 'lina', 'rudiyat', '2015-09-02 02:47:12');
/*!40000 ALTER TABLE `glasir_phd` ENABLE KEYS */;


-- Dumping structure for table inventory.glasir_phdh
CREATE TABLE IF NOT EXISTS `glasir_phdh` (
  `idphdh` char(15) NOT NULL,
  `noprod` char(15) NOT NULL,
  `idglasir` varchar(50) NOT NULL,
  `idphd` smallint(6) NOT NULL,
  `tgl` date NOT NULL,
  `idgps` smallint(6) NOT NULL,
  `volume` decimal(10,0) NOT NULL,
  `densitas` decimal(10,0) NOT NULL,
  `idbm` smallint(6) NOT NULL,
  `idtong` smallint(6) NOT NULL,
  `dsc` varchar(255) NOT NULL,
  `petugas` varchar(50) NOT NULL,
  `inp` varchar(50) NOT NULL,
  `inp_time` datetime NOT NULL,
  PRIMARY KEY (`idphdh`),
  KEY `FK_glasir_phdh_glasir_phd` (`noprod`),
  KEY `FK_glasir_phdh_glasir_phd_2` (`idglasir`),
  KEY `FK_glasir_phdh_glasir_phd_3` (`idphd`),
  KEY `FK_glasir_phdh_glasir_patt` (`idgps`),
  KEY `FK_glasir_phdh_bm` (`idbm`),
  KEY `FK_glasir_phdh_tong` (`idtong`),
  CONSTRAINT `FK_glasir_phdh_bm` FOREIGN KEY (`idbm`) REFERENCES `global_mesin` (`id_bm`),
  CONSTRAINT `FK_glasir_phdh_glasir_patt` FOREIGN KEY (`idgps`) REFERENCES `glasir_patt` (`idgps`),
  CONSTRAINT `FK_glasir_phdh_glasir_phd` FOREIGN KEY (`noprod`) REFERENCES `glasir_phd` (`no_prod`),
  CONSTRAINT `FK_glasir_phdh_glasir_phd_2` FOREIGN KEY (`idglasir`) REFERENCES `glasir_phd` (`id_glasir`),
  CONSTRAINT `FK_glasir_phdh_glasir_phd_3` FOREIGN KEY (`idphd`) REFERENCES `glasir_phd` (`idphd`),
  CONSTRAINT `FK_glasir_phdh_tong` FOREIGN KEY (`idtong`) REFERENCES `global_tong` (`id_tong`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table inventory.glasir_phdh: ~7 rows (approximately)
DELETE FROM `glasir_phdh`;
/*!40000 ALTER TABLE `glasir_phdh` DISABLE KEYS */;
INSERT INTO `glasir_phdh` (`idphdh`, `noprod`, `idglasir`, `idphd`, `tgl`, `idgps`, `volume`, `densitas`, `idbm`, `idtong`, `dsc`, `petugas`, `inp`, `inp_time`) VALUES
	('HG00001', 'PG00001', 'Y00011', 21, '2015-08-02', 1, 100, 1600, 21, 1, 'pake bm 3 ton, yang lain pada penuh', 'sukirman', 'admin', '2015-08-23 04:14:30'),
	('HG00002', 'PG00001', 'Y00011', 21, '2015-08-03', 1, 100, 1600, 21, 1, 'giling lagi, belum lulus tes bakar kata pak sukijan', 'sukirman', 'admin', '2015-08-23 04:15:49'),
	('HG00003', 'PG00001', 'Y00011', 21, '2015-08-05', 2, 100, 1600, 1, 2, 'akhirnya lulus tes bakar, bagi 2 tong 50 literan', 'sukirman', 'admin', '2015-08-23 04:17:55'),
	('HG00004', 'PG00001', 'Y00011', 21, '2015-08-05', 2, 100, 1600, 1, 3, 'akhirnya lulus tes bakar, bagi 2 tong 50 literan', 'sukirman', 'admin', '2015-08-23 04:18:03'),
	('HG00005', 'PG00001', 'Y00011', 21, '2015-08-06', 3, 50, 1600, 1, 2, 'dites qc pak sukitman, ', 'sukirman', 'admin', '2015-08-23 04:19:54'),
	('HG00006', 'PG00001', 'Y00011', 21, '2015-08-06', 3, 50, 1600, 1, 3, 'dites qc pak sukitman, ', 'sukirman', 'admin', '2015-08-23 04:20:15'),
	('HG00007', 'PG00001', 'Y00011', 21, '2015-08-07', 4, 100, 1600, 1, 4, 'galsir pass kata pak hadi qc, semua disatukan kembali ke satu tong', 'sukirman', 'admin', '2015-08-23 04:21:21');
/*!40000 ALTER TABLE `glasir_phdh` ENABLE KEYS */;


-- Dumping structure for table inventory.glasir_phd_sp
CREATE TABLE IF NOT EXISTS `glasir_phd_sp` (
  `idphd` smallint(6) NOT NULL AUTO_INCREMENT,
  `no_prod` char(15) NOT NULL,
  `id_glasir` varchar(50) NOT NULL,
  `id_bm` smallint(6) NOT NULL,
  `id_bmt` smallint(6) NOT NULL,
  `volume` double NOT NULL,
  `densitas` double NOT NULL,
  `inputer` varchar(50) NOT NULL,
  `dsc` varchar(255) NOT NULL,
  `petugas` varchar(50) NOT NULL,
  `tgl_insert` datetime NOT NULL,
  PRIMARY KEY (`idphd`),
  KEY `FK_glasir_phd_glasir` (`id_glasir`),
  KEY `FK_glasir_phd_glasir_ph` (`no_prod`),
  KEY `FK_glasir_phd_admins` (`inputer`),
  KEY `FK_glasir_phd_global_mesin` (`id_bm`),
  CONSTRAINT `glasir_phd_sp_ibfk_1` FOREIGN KEY (`id_bm`) REFERENCES `global_mesin` (`id_bm`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table inventory.glasir_phd_sp: ~6 rows (approximately)
DELETE FROM `glasir_phd_sp`;
/*!40000 ALTER TABLE `glasir_phd_sp` DISABLE KEYS */;
INSERT INTO `glasir_phd_sp` (`idphd`, `no_prod`, `id_glasir`, `id_bm`, `id_bmt`, `volume`, `densitas`, `inputer`, `dsc`, `petugas`, `tgl_insert`) VALUES
	(21, 'SG00001', 'Y00011', 18, 0, 31.94888178913738, 1500, 'admin', 'Ok', 'zainudin', '2015-08-22 11:21:52'),
	(23, 'SG00002', 'Y00001', 18, 0, 127.7955271565495, 1500, 'admin', 'ditambah', 'zainudin', '2015-08-24 07:52:34'),
	(25, 'SG00004', 'Y00001', 18, 0, 31.94888178913738, 1500, 'admin', 'Kebutuhan export', 'zainudin', '2015-08-28 05:04:14'),
	(35, 'SG00003', 'Y00002', 15, 2, 63.89776357827475, 1500, 'admin', 'Monyong', 'Jeni', '2015-09-02 01:37:01'),
	(40, 'SG00005', 'Y00003', 14, 2, 31.94888178913738, 1500, 'admin', 'belekok', 'lina', '2015-09-02 01:57:59'),
	(41, 'SG00004', 'Y00003', 14, 3, 63.89776357827475, 1500, 'admin', 'luna', 'lonja', '2015-09-02 01:58:46');
/*!40000 ALTER TABLE `glasir_phd_sp` ENABLE KEYS */;


-- Dumping structure for table inventory.glasir_ph_sp
CREATE TABLE IF NOT EXISTS `glasir_ph_sp` (
  `no_prod` char(15) NOT NULL,
  `inputer` varchar(50) NOT NULL,
  `tgl_inp` datetime NOT NULL,
  `lst_upd` datetime NOT NULL,
  PRIMARY KEY (`no_prod`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table inventory.glasir_ph_sp: ~5 rows (approximately)
DELETE FROM `glasir_ph_sp`;
/*!40000 ALTER TABLE `glasir_ph_sp` DISABLE KEYS */;
INSERT INTO `glasir_ph_sp` (`no_prod`, `inputer`, `tgl_inp`, `lst_upd`) VALUES
	('SG00001', 'admin', '2015-08-22 11:21:52', '0000-00-00 00:00:00'),
	('SG00002', 'admin', '2015-08-24 07:51:43', '0000-00-00 00:00:00'),
	('SG00003', 'admin', '2015-08-24 08:00:16', '0000-00-00 00:00:00'),
	('SG00004', 'admin', '2015-08-28 05:04:14', '0000-00-00 00:00:00'),
	('SG00005', 'admin', '2015-08-31 02:45:17', '0000-00-00 00:00:00');
/*!40000 ALTER TABLE `glasir_ph_sp` ENABLE KEYS */;


-- Dumping structure for table inventory.glasir_rh
CREATE TABLE IF NOT EXISTS `glasir_rh` (
  `no_prod` char(15) NOT NULL,
  `tgl_plng` date NOT NULL,
  `inputer` varchar(50) NOT NULL,
  `planner` varchar(50) NOT NULL,
  `tgl_inp` datetime NOT NULL,
  `lst_upd` datetime NOT NULL,
  PRIMARY KEY (`no_prod`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table inventory.glasir_rh: ~0 rows (approximately)
DELETE FROM `glasir_rh`;
/*!40000 ALTER TABLE `glasir_rh` DISABLE KEYS */;
INSERT INTO `glasir_rh` (`no_prod`, `tgl_plng`, `inputer`, `planner`, `tgl_inp`, `lst_upd`) VALUES
	('RG00001', '2015-08-04', 'admin', 'Masitoh', '2015-08-24 03:28:34', '0000-00-00 00:00:00');
/*!40000 ALTER TABLE `glasir_rh` ENABLE KEYS */;


-- Dumping structure for table inventory.glasir_rhd
CREATE TABLE IF NOT EXISTS `glasir_rhd` (
  `idrhd` smallint(6) NOT NULL AUTO_INCREMENT,
  `no_prod` char(15) NOT NULL,
  `id_glasir` varchar(50) NOT NULL,
  `buyer` smallint(6) NOT NULL,
  `jns` smallint(6) NOT NULL,
  `shift` smallint(6) NOT NULL,
  `mpr` smallint(6) NOT NULL,
  `dsc` varchar(255) NOT NULL,
  `volume` double NOT NULL,
  `densitas` double NOT NULL,
  `vsc` double NOT NULL,
  `inputer` varchar(50) NOT NULL,
  `petugas` varchar(50) NOT NULL,
  `wktp` date NOT NULL,
  `tgl_insert` datetime NOT NULL,
  PRIMARY KEY (`idrhd`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table inventory.glasir_rhd: ~0 rows (approximately)
DELETE FROM `glasir_rhd`;
/*!40000 ALTER TABLE `glasir_rhd` DISABLE KEYS */;
INSERT INTO `glasir_rhd` (`idrhd`, `no_prod`, `id_glasir`, `buyer`, `jns`, `shift`, `mpr`, `dsc`, `volume`, `densitas`, `vsc`, `inputer`, `petugas`, `wktp`, `tgl_insert`) VALUES
	(2, 'RG00001', 'Y00003', 2, 2, 2, 23, 'Salah planning', 50, 1600, 0, 'admin', 'Maesaroh', '2015-08-20', '2015-08-24 03:50:32');
/*!40000 ALTER TABLE `glasir_rhd` ENABLE KEYS */;


-- Dumping structure for table inventory.glasir_rhdh
CREATE TABLE IF NOT EXISTS `glasir_rhdh` (
  `idphdh` char(15) NOT NULL,
  `noprod` char(15) NOT NULL,
  `idglasir` varchar(50) NOT NULL,
  `idphd` smallint(6) NOT NULL,
  `tgl` date NOT NULL,
  `idgps` smallint(6) NOT NULL,
  `volume` decimal(10,0) NOT NULL,
  `densitas` decimal(10,0) NOT NULL,
  `idbm` smallint(6) NOT NULL,
  `idtong` smallint(6) NOT NULL,
  `dsc` varchar(255) NOT NULL,
  `petugas` varchar(50) NOT NULL,
  `inp` varchar(50) NOT NULL,
  `inp_time` datetime NOT NULL,
  PRIMARY KEY (`idphdh`),
  KEY `FK_glasir_phdh_glasir_phd` (`noprod`),
  KEY `FK_glasir_phdh_glasir_phd_2` (`idglasir`),
  KEY `FK_glasir_phdh_glasir_phd_3` (`idphd`),
  KEY `FK_glasir_phdh_glasir_patt` (`idgps`),
  KEY `FK_glasir_phdh_bm` (`idbm`),
  KEY `FK_glasir_phdh_tong` (`idtong`),
  CONSTRAINT `glasir_rhdh_ibfk_1` FOREIGN KEY (`idbm`) REFERENCES `global_mesin` (`id_bm`),
  CONSTRAINT `glasir_rhdh_ibfk_2` FOREIGN KEY (`idgps`) REFERENCES `glasir_patt` (`idgps`),
  CONSTRAINT `glasir_rhdh_ibfk_3` FOREIGN KEY (`noprod`) REFERENCES `glasir_phd` (`no_prod`),
  CONSTRAINT `glasir_rhdh_ibfk_4` FOREIGN KEY (`idglasir`) REFERENCES `glasir_phd` (`id_glasir`),
  CONSTRAINT `glasir_rhdh_ibfk_5` FOREIGN KEY (`idphd`) REFERENCES `glasir_phd` (`idphd`),
  CONSTRAINT `glasir_rhdh_ibfk_6` FOREIGN KEY (`idtong`) REFERENCES `global_tong` (`id_tong`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table inventory.glasir_rhdh: ~0 rows (approximately)
DELETE FROM `glasir_rhdh`;
/*!40000 ALTER TABLE `glasir_rhdh` DISABLE KEYS */;
/*!40000 ALTER TABLE `glasir_rhdh` ENABLE KEYS */;


-- Dumping structure for table inventory.glasir_status
CREATE TABLE IF NOT EXISTS `glasir_status` (
  `id_status` int(11) NOT NULL,
  `status` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_status`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table inventory.glasir_status: ~2 rows (approximately)
DELETE FROM `glasir_status`;
/*!40000 ALTER TABLE `glasir_status` DISABLE KEYS */;
INSERT INTO `glasir_status` (`id_status`, `status`) VALUES
	(0, 'Disabled'),
	(1, 'Active');
/*!40000 ALTER TABLE `glasir_status` ENABLE KEYS */;


-- Dumping structure for table inventory.glasir_th
CREATE TABLE IF NOT EXISTS `glasir_th` (
  `no_prod` char(15) NOT NULL,
  `tgl_plng` date NOT NULL,
  `inputer` varchar(50) NOT NULL,
  `planner` varchar(50) NOT NULL,
  `tgl_inp` datetime NOT NULL,
  `lst_upd` datetime NOT NULL,
  PRIMARY KEY (`no_prod`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table inventory.glasir_th: ~3 rows (approximately)
DELETE FROM `glasir_th`;
/*!40000 ALTER TABLE `glasir_th` DISABLE KEYS */;
INSERT INTO `glasir_th` (`no_prod`, `tgl_plng`, `inputer`, `planner`, `tgl_inp`, `lst_upd`) VALUES
	('TG00001', '2015-08-01', 'admin', 'Yuni', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	('TG00002', '2015-08-01', 'admin', 'Yuni', '2015-08-24 07:15:09', '0000-00-00 00:00:00'),
	('TG00003', '2015-08-06', 'admin', 'Yuni', '2015-08-24 07:53:43', '0000-00-00 00:00:00'),
	('TG00004', '2015-08-03', 'admin', 'Yuni', '2015-08-28 05:24:48', '0000-00-00 00:00:00');
/*!40000 ALTER TABLE `glasir_th` ENABLE KEYS */;


-- Dumping structure for table inventory.glasir_thd
CREATE TABLE IF NOT EXISTS `glasir_thd` (
  `idthd` smallint(6) NOT NULL AUTO_INCREMENT,
  `no_prod` char(15) NOT NULL,
  `id_glasir` varchar(50) NOT NULL,
  `buyer` smallint(6) NOT NULL,
  `jns` smallint(6) NOT NULL,
  `shift` smallint(6) NOT NULL,
  `mpr` smallint(6) NOT NULL,
  `dsc` varchar(255) NOT NULL,
  `volume` double NOT NULL,
  `densitas` double NOT NULL,
  `vsc` double NOT NULL,
  `inputer` varchar(50) NOT NULL,
  `petugas` varchar(50) NOT NULL,
  `wktp` date NOT NULL,
  `tgl_insert` datetime NOT NULL,
  PRIMARY KEY (`idthd`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table inventory.glasir_thd: ~4 rows (approximately)
DELETE FROM `glasir_thd`;
/*!40000 ALTER TABLE `glasir_thd` DISABLE KEYS */;
INSERT INTO `glasir_thd` (`idthd`, `no_prod`, `id_glasir`, `buyer`, `jns`, `shift`, `mpr`, `dsc`, `volume`, `densitas`, `vsc`, `inputer`, `petugas`, `wktp`, `tgl_insert`) VALUES
	(1, 'TG00001', 'Y00001', 2, 2, 2, 24, 'sippo', 20, 1600, 0.1, 'admin', 'Rita', '0000-00-00', '0000-00-00 00:00:00'),
	(2, 'TG00002', 'Y00002', 2, 2, 2, 22, 'Ok jon', 50, 1500, 0.2, 'admin', 'Sukijan', '2015-08-02', '2015-08-24 07:15:09'),
	(3, 'TG00002', 'Y00003', 2, 2, 2, 22, 'Ok jon', 50, 1500, 0.2, 'admin', 'Sukijan', '2015-08-02', '2015-08-24 07:15:39'),
	(6, 'TG00003', 'Y00003', 2, 2, 2, 23, 'Dipakai', 50, 1500, 0.2, 'admin', 'rara', '2015-08-24', '2015-08-24 08:02:21'),
	(7, 'TG00004', 'Y00001', 2, 1, 2, 23, 'Dicoba', 1000, 1500, 0.1, 'admin', 'Sujatna', '2015-08-09', '2015-08-28 05:24:48');
/*!40000 ALTER TABLE `glasir_thd` ENABLE KEYS */;


-- Dumping structure for table inventory.glasir_thdh
CREATE TABLE IF NOT EXISTS `glasir_thdh` (
  `idphdh` char(15) NOT NULL,
  `noprod` char(15) NOT NULL,
  `idglasir` varchar(50) NOT NULL,
  `idphd` smallint(6) NOT NULL,
  `tgl` date NOT NULL,
  `idgps` smallint(6) NOT NULL,
  `volume` decimal(10,0) NOT NULL,
  `densitas` decimal(10,0) NOT NULL,
  `idbm` smallint(6) NOT NULL,
  `idtong` smallint(6) NOT NULL,
  `dsc` varchar(255) NOT NULL,
  `petugas` varchar(50) NOT NULL,
  `inp` varchar(50) NOT NULL,
  `inp_time` datetime NOT NULL,
  PRIMARY KEY (`idphdh`),
  KEY `FK_glasir_phdh_glasir_phd` (`noprod`),
  KEY `FK_glasir_phdh_glasir_phd_2` (`idglasir`),
  KEY `FK_glasir_phdh_glasir_phd_3` (`idphd`),
  KEY `FK_glasir_phdh_glasir_patt` (`idgps`),
  KEY `FK_glasir_phdh_bm` (`idbm`),
  KEY `FK_glasir_phdh_tong` (`idtong`),
  CONSTRAINT `glasir_thdh_ibfk_1` FOREIGN KEY (`idbm`) REFERENCES `global_mesin` (`id_bm`),
  CONSTRAINT `glasir_thdh_ibfk_2` FOREIGN KEY (`idgps`) REFERENCES `glasir_patt` (`idgps`),
  CONSTRAINT `glasir_thdh_ibfk_3` FOREIGN KEY (`noprod`) REFERENCES `glasir_phd` (`no_prod`),
  CONSTRAINT `glasir_thdh_ibfk_4` FOREIGN KEY (`idglasir`) REFERENCES `glasir_phd` (`id_glasir`),
  CONSTRAINT `glasir_thdh_ibfk_5` FOREIGN KEY (`idphd`) REFERENCES `glasir_phd` (`idphd`),
  CONSTRAINT `glasir_thdh_ibfk_6` FOREIGN KEY (`idtong`) REFERENCES `global_tong` (`id_tong`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table inventory.glasir_thdh: ~0 rows (approximately)
DELETE FROM `glasir_thdh`;
/*!40000 ALTER TABLE `glasir_thdh` DISABLE KEYS */;
/*!40000 ALTER TABLE `glasir_thdh` ENABLE KEYS */;


-- Dumping structure for table inventory.global_buyer
CREATE TABLE IF NOT EXISTS `global_buyer` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `dsc` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table inventory.global_buyer: ~3 rows (approximately)
DELETE FROM `global_buyer`;
/*!40000 ALTER TABLE `global_buyer` DISABLE KEYS */;
INSERT INTO `global_buyer` (`id`, `nama`, `dsc`) VALUES
	(1, 'Tidak ada', 'Tidak ada'),
	(2, 'Noritake', 'Noritake from Japan'),
	(3, 'Guydegreene', 'Guydegreene dari Yunani');
/*!40000 ALTER TABLE `global_buyer` ENABLE KEYS */;


-- Dumping structure for table inventory.global_delivery
CREATE TABLE IF NOT EXISTS `global_delivery` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `dsc` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table inventory.global_delivery: ~4 rows (approximately)
DELETE FROM `global_delivery`;
/*!40000 ALTER TABLE `global_delivery` DISABLE KEYS */;
INSERT INTO `global_delivery` (`id`, `nama`, `dsc`) VALUES
	(1, 'Tidak ada', 'Tidak ada'),
	(2, 'Ekspor', ''),
	(3, 'Lokal', ''),
	(4, 'Open Stock', '');
/*!40000 ALTER TABLE `global_delivery` ENABLE KEYS */;


-- Dumping structure for table inventory.global_mesin
CREATE TABLE IF NOT EXISTS `global_mesin` (
  `id_bm` smallint(6) NOT NULL AUTO_INCREMENT,
  `nama_bm` varchar(50) NOT NULL,
  `jns_bm` varchar(50) NOT NULL,
  `no_bm` varchar(50) NOT NULL,
  `kapasitas` double NOT NULL,
  `satuan` char(50) NOT NULL,
  `lokasi` char(50) NOT NULL,
  PRIMARY KEY (`id_bm`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table inventory.global_mesin: ~36 rows (approximately)
DELETE FROM `global_mesin`;
/*!40000 ALTER TABLE `global_mesin` DISABLE KEYS */;
INSERT INTO `global_mesin` (`id_bm`, `nama_bm`, `jns_bm`, `no_bm`, `kapasitas`, `satuan`, `lokasi`) VALUES
	(1, 'Tidak ada', 'Tidak ada', 'Tidak ada', 0, 'Tidak ada', 'Tidak ada'),
	(2, 'Ball Mill 3T.1', '3000 kg', '1', 3000, 'kg', ''),
	(3, 'Ball Mill 3T.5', '3000 kg', '5', 3000, 'kg', ''),
	(4, 'Ball Mill 3TP3', '3000 kg', '3', 3000, 'kg', ''),
	(5, 'Ball Mill 2T.1', '2000 kg', '1', 2000, 'kg', ''),
	(6, 'Ball Mill 2T.2', '2000 kg', '2', 2000, 'kg', ''),
	(7, 'Ball Mill 2T.3', '2000 kg', '3', 2000, 'kg', ''),
	(8, 'Ball Mill 500.1', '500 kg', '1', 500, 'kg', ''),
	(9, 'Ball Mill 500.2', '500 kg', '2', 500, 'kg', ''),
	(10, 'Ball Mill 500.3', '500 kg', '3', 500, 'kg', ''),
	(11, 'Ball Mill 500.4', '500 kg', '4', 500, 'kg', ''),
	(12, 'Ball Mill 500.5', '500 kg', '5', 500, 'kg', ''),
	(13, 'Ball Mill 500.6', '500 kg', '6', 500, 'kg', ''),
	(14, 'Ball Mill 500.7', '500 kg', '7', 500, 'kg', ''),
	(15, 'Ball Mill 500.8', '500 kg', '8', 500, 'kg', ''),
	(16, 'Ball Mill 500.9', '500 kg', '9', 500, 'kg', ''),
	(17, 'Ball Mill 500.10', '500 kg', '10', 500, 'kg', ''),
	(18, 'Ball Mill 501.11', '', '', 0, 'kg', ''),
	(19, 'Ball Mill 300.1', '300 kg', '1', 300, 'kg', ''),
	(20, 'Ball Mill 300.2', '300 kg', '2', 300, 'kg', ''),
	(21, 'Ball Mill 200.1', '200 kg', '1', 200, 'kg', ''),
	(22, 'Ball Mill 200.2', '200 kg', '2', 200, 'kg', ''),
	(23, 'Ball Mill 200.3', '200 kg', '3', 200, 'kg', ''),
	(24, 'Ball Mill 200.4', '200 kg', '4', 200, 'kg', ''),
	(25, 'Glasir 1.01', 'Glasir 1.01', '0', 0, 'ppj', ''),
	(26, 'Glasir 1.02', 'Glasir 1.02', '0', 0, 'ppj', ''),
	(27, 'Glasir 1.03', 'Glasir 1.03', '0', 0, 'ppj', ''),
	(28, 'Glasir 1.04', 'Glasir 1.04', '0', 0, 'ppj', ''),
	(29, 'Glasir 1.05', 'Glasir 1.05', '0', 0, 'ppj', ''),
	(30, 'Glasir 1.06', 'Glasir 1.06', '0', 0, 'ppj', ''),
	(31, 'Glasir 1.07', 'Glasir 1.07', '0', 0, 'ppj', ''),
	(32, 'Glasir 1.08', 'Glasir 1.08', '0', 0, 'ppj', ''),
	(33, 'Glasir 1.09', 'Glasir 1.09', '0', 0, 'ppj', ''),
	(34, 'Glasir 2.01', 'Glasir 2.01\r\n', '0', 0, 'ppj', ''),
	(35, 'Glasir 2.02', 'Glasir 2.02', '0', 0, 'ppj', ''),
	(36, 'Glasir 2.03', 'Glasir 2.03', '0', 0, 'ppj', ''),
	(37, 'Glasir 2.04', 'Glasir 2.04', '0', 0, 'ppj', ''),
	(38, 'Glasir 2.05', 'Glasir 2.05', '0', 0, 'ppj', ''),
	(39, 'Glasir 2.06', 'Glasir 2.06', '0', 0, 'ppj', ''),
	(40, 'Glasir 2.07', 'Glasir 2.07', '0', 0, 'ppj', ''),
	(41, 'Waterfall', 'Glasir 2.07', '0', 0, 'ppj', '');
/*!40000 ALTER TABLE `global_mesin` ENABLE KEYS */;


-- Dumping structure for table inventory.global_shift
CREATE TABLE IF NOT EXISTS `global_shift` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `dsc` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table inventory.global_shift: ~4 rows (approximately)
DELETE FROM `global_shift`;
/*!40000 ALTER TABLE `global_shift` DISABLE KEYS */;
INSERT INTO `global_shift` (`id`, `nama`, `dsc`) VALUES
	(1, 'Tidak ada', 'Tidak ada'),
	(2, 'Shift 1', '06.00-15.00'),
	(3, 'Shift 2', '15.00-00.00'),
	(4, 'Shift 3', '00.00-09.00');
/*!40000 ALTER TABLE `global_shift` ENABLE KEYS */;


-- Dumping structure for table inventory.global_tong
CREATE TABLE IF NOT EXISTS `global_tong` (
  `id_tong` smallint(6) NOT NULL AUTO_INCREMENT,
  `nama_tong` varchar(50) NOT NULL,
  `jns_tong` varchar(50) NOT NULL,
  `no_tong` varchar(50) NOT NULL,
  `kapasitas` double NOT NULL,
  `satuan` char(50) NOT NULL,
  `lokasi` char(50) NOT NULL,
  PRIMARY KEY (`id_tong`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table inventory.global_tong: ~12 rows (approximately)
DELETE FROM `global_tong`;
/*!40000 ALTER TABLE `global_tong` DISABLE KEYS */;
INSERT INTO `global_tong` (`id_tong`, `nama_tong`, `jns_tong`, `no_tong`, `kapasitas`, `satuan`, `lokasi`) VALUES
	(1, 'Tidak ada', 'Tidak ada', 'Tidak ada', 0, 'Tidak ada', 'Tidak ada'),
	(2, 'Tong 1', 'Tong Glasir 1', '1', 200, 'kg', ''),
	(3, 'Tong 2', 'Tong Glasir 2', '2', 200, 'kg', ''),
	(4, 'Tong 3', 'Tong Glasir 3', '3', 200, 'kg', ''),
	(5, 'Tong 4', 'Tong Glasir 4', '4', 200, 'kg', ''),
	(6, 'Tong 5', 'Tong Glasir 5', '5', 200, 'kg', ''),
	(7, 'Tong 6', 'Tong Glasir 6', '6', 200, 'kg', ''),
	(8, 'Tong 7', 'Tong Glasir 7', '7', 200, 'kg', ''),
	(9, 'Tong 8', 'Tong Glasir 8', '8', 200, 'kg', ''),
	(10, 'Tong 9', 'Tong Glasir 9', '9', 200, 'kg', ''),
	(11, 'Tong 10', 'Tong Glasir 10', '10', 200, 'kg', ''),
	(12, 'Tong 11', 'Tong Glasir 12', '11', 200, 'kg', '');
/*!40000 ALTER TABLE `global_tong` ENABLE KEYS */;


-- Dumping structure for table inventory.h_beli
CREATE TABLE IF NOT EXISTS `h_beli` (
  `kodebeli` char(15) NOT NULL,
  `tglbeli` date NOT NULL,
  `kode_supplier` char(5) NOT NULL,
  `username` varchar(50) NOT NULL,
  PRIMARY KEY (`kodebeli`),
  KEY `kode_supplier` (`kode_supplier`),
  KEY `username` (`username`),
  CONSTRAINT `h_beli_ibfk_1` FOREIGN KEY (`kode_supplier`) REFERENCES `supplier` (`kode_supplier`),
  CONSTRAINT `h_beli_ibfk_2` FOREIGN KEY (`username`) REFERENCES `admins` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table inventory.h_beli: ~0 rows (approximately)
DELETE FROM `h_beli`;
/*!40000 ALTER TABLE `h_beli` DISABLE KEYS */;
/*!40000 ALTER TABLE `h_beli` ENABLE KEYS */;


-- Dumping structure for table inventory.h_jual
CREATE TABLE IF NOT EXISTS `h_jual` (
  `kodejual` char(15) NOT NULL,
  `tgljual` date NOT NULL,
  `username` varchar(50) NOT NULL,
  PRIMARY KEY (`kodejual`),
  KEY `username` (`username`),
  CONSTRAINT `h_jual_ibfk_1` FOREIGN KEY (`username`) REFERENCES `admins` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table inventory.h_jual: ~0 rows (approximately)
DELETE FROM `h_jual`;
/*!40000 ALTER TABLE `h_jual` DISABLE KEYS */;
/*!40000 ALTER TABLE `h_jual` ENABLE KEYS */;


-- Dumping structure for table inventory.jenis_barang
CREATE TABLE IF NOT EXISTS `jenis_barang` (
  `id_jenis` char(3) NOT NULL,
  `jenis` varchar(30) NOT NULL,
  PRIMARY KEY (`id_jenis`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table inventory.jenis_barang: ~0 rows (approximately)
DELETE FROM `jenis_barang`;
/*!40000 ALTER TABLE `jenis_barang` DISABLE KEYS */;
INSERT INTO `jenis_barang` (`id_jenis`, `jenis`) VALUES
	('001', 'Glaze');
/*!40000 ALTER TABLE `jenis_barang` ENABLE KEYS */;


-- Dumping structure for table inventory.level
CREATE TABLE IF NOT EXISTS `level` (
  `id_level` char(2) NOT NULL,
  `level` char(30) NOT NULL,
  PRIMARY KEY (`id_level`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table inventory.level: ~3 rows (approximately)
DELETE FROM `level`;
/*!40000 ALTER TABLE `level` DISABLE KEYS */;
INSERT INTO `level` (`id_level`, `level`) VALUES
	('01', 'Super Admin'),
	('02', 'Admin'),
	('03', 'User');
/*!40000 ALTER TABLE `level` ENABLE KEYS */;


-- Dumping structure for table inventory.pck_transaksi
CREATE TABLE IF NOT EXISTS `pck_transaksi` (
  `id_pck` int(11) NOT NULL AUTO_INCREMENT,
  `tgl_input` date NOT NULL,
  `pic` varchar(50) NOT NULL,
  `shift` enum('Shift 1','Shift 2','Shift 3') NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `lokasi` enum('Pabrik 1','Pabrik 2','Pabrik 3') NOT NULL,
  `plan` int(11) NOT NULL,
  `actual` int(11) NOT NULL,
  `ar` double NOT NULL,
  `ac` double NOT NULL,
  `inputer` varchar(50) NOT NULL,
  `tgl_insert` datetime NOT NULL,
  `tgl_update` datetime NOT NULL,
  PRIMARY KEY (`id_pck`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table inventory.pck_transaksi: ~40 rows (approximately)
DELETE FROM `pck_transaksi`;
/*!40000 ALTER TABLE `pck_transaksi` DISABLE KEYS */;
INSERT INTO `pck_transaksi` (`id_pck`, `tgl_input`, `pic`, `shift`, `kategori`, `lokasi`, `plan`, `actual`, `ar`, `ac`, `inputer`, `tgl_insert`, `tgl_update`) VALUES
	(1, '2015-06-01', 'musliman', 'Shift 1', '18', 'Pabrik 1', 38294, 37516, 0.955, 0.979, 'admin', '0000-00-00 00:00:00', '2015-06-30 02:34:38'),
	(2, '2015-06-02', 'surur', 'Shift 1', '18', 'Pabrik 1', 16559, 13181, 0.955, 0.796, 'admin', '2015-06-30 02:02:53', '0000-00-00 00:00:00'),
	(3, '2015-06-03', 'musliman', 'Shift 1', '18', 'Pabrik 1', 36130, 28420, 0.955, 0.78660393, 'admin', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(4, '2015-06-04', 'musliman', 'Shift 1', '18', 'Pabrik 1', 37218, 37418, 0.955, 1.005373744, 'admin', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(5, '2015-06-05', 'musliman', 'Shift 1', '18', 'Pabrik 1', 37876, 32334, 0.955, 0.853680431, 'admin', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(6, '2015-06-06', 'musliman', 'Shift 1', '18', 'Pabrik 1', 32578, 27244, 0.955, 0.836269875, 'admin', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(7, '2015-06-08', 'musliman', 'Shift 1', '18', 'Pabrik 1', 45844, 40412, 0.955, 0.881511212, 'admin', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(8, '2015-06-09', 'musliman', 'Shift 1', '18', 'Pabrik 1', 40837, 42646, 0.955, 1.044298063, 'admin', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(9, '2015-06-10', 'musliman', 'Shift 1', '18', 'Pabrik 1', 45674, 39196, 0.955, 0.858168761, 'admin', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(10, '2015-06-11', 'surur', 'Shift 1', '18', 'Pabrik 1', 39910, 39806, 0.955, 0.997394137, 'admin', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(11, '2015-06-12', 'musliman', 'Shift 1', '18', 'Pabrik 1', 38464, 35536, 0.955, 0.923876872, 'admin', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(12, '2015-06-13', 'musliman', 'Shift 1', '18', 'Pabrik 1', 27958, 24190, 0.955, 0.865226411, 'admin', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(13, '2015-06-14', 'musliman', 'Shift 1', '18', 'Pabrik 1', 12026, 8712, 0.955, 0.724430401, 'admin', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(14, '2015-06-15', 'musliman', 'Shift 1', '18', 'Pabrik 1', 40628, 31986, 0.955, 0.787289554, 'admin', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(15, '2015-06-16', 'musliman', 'Shift 1', '18', 'Pabrik 1', 42104, 45016, 0.955, 1.069162075, 'admin', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(16, '2015-06-17', 'musliman', 'Shift 1', '18', 'Pabrik 1', 54134, 52826, 0.955, 0.975837736, 'admin', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(17, '2015-06-18', 'musliman', 'Shift 1', '18', 'Pabrik 1', 53616, 55940, 0.955, 1.04334527, 'admin', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(18, '2015-06-19', 'musliman', 'Shift 1', '18', 'Pabrik 1', 52858, 43894, 0.955, 0.830413561, 'admin', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(19, '2015-06-20', 'musliman', 'Shift 1', '18', 'Pabrik 1', 45488, 33214, 0.955, 0.730170594, 'admin', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(20, '2015-06-21', 'musliman', 'Shift 1', '18', 'Pabrik 1', 17886, 12412, 0.955, 0.693950576, 'admin', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(21, '2015-06-22', 'musliman', 'Shift 1', '18', 'Pabrik 1', 50700, 45752, 0.955, 0.902406312, 'admin', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(22, '2015-06-23', 'musliman', 'Shift 1', '18', 'Pabrik 1', 49156, 48342, 0.955, 0.983, 'admin', '0000-00-00 00:00:00', '2015-06-30 02:48:01'),
	(23, '2015-06-24', 'musliman', 'Shift 1', '18', 'Pabrik 1', 50960, 47120, 0.955, 0.924646782, 'admin', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(24, '2015-06-25', 'musliman', 'Shift 1', '18', 'Pabrik 1', 39172, 43309, 0.955, 1.105611151, 'admin', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(25, '2015-06-26', 'musliman', 'Shift 1', '18', 'Pabrik 1', 36200, 33908, 0.955, 0.936685083, 'admin', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(26, '2015-06-27', 'musliman', 'Shift 1', '18', 'Pabrik 1', 46308, 35740, 0.955, 0.771788892, 'admin', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(27, '2015-06-28', 'musliman', 'Shift 1', '18', 'Pabrik 1', 30764, 21408, 0.955, 0.695878299, 'admin', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(28, '2015-06-29', 'musliman', 'Shift 1', '18', 'Pabrik 1', 50706, 48216, 0.955, 0.950893385, 'admin', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(29, '2015-06-30', 'musliman', 'Shift 1', '18', 'Pabrik 1', 52280, 38664, 0.955, 0.739556236, 'admin', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(30, '2015-07-01', 'musliman', 'Shift 1', '19', 'Pabrik 1', 47008, 50402, 0.96, 1.072, 'admin', '2015-07-13 02:29:51', '0000-00-00 00:00:00'),
	(31, '2015-07-02', 'musliman', 'Shift 1', '19', 'Pabrik 1', 41328, 35056, 0.96, 0.848, 'admin', '2015-07-13 02:30:15', '0000-00-00 00:00:00'),
	(32, '2015-07-03', 'musliman', 'Shift 1', '19', 'Pabrik 1', 40636, 34950, 0.96, 0.86, 'admin', '2015-07-13 02:30:38', '0000-00-00 00:00:00'),
	(33, '2015-07-04', 'musliman', 'Shift 1', '19', 'Pabrik 1', 31128, 22829, 0.96, 0.733, 'admin', '2015-07-13 02:31:31', '0000-00-00 00:00:00'),
	(34, '2015-07-06', 'musliman', 'Shift 1', '19', 'Pabrik 1', 41740, 39282, 0.96, 0.941, 'admin', '2015-07-13 02:31:52', '0000-00-00 00:00:00'),
	(35, '2015-07-07', 'musliman', 'Shift 1', '19', 'Pabrik 1', 42392, 36452, 0.96, 0.86, 'admin', '2015-07-13 02:32:16', '0000-00-00 00:00:00'),
	(36, '2015-07-08', 'musliman', 'Shift 1', '19', 'Pabrik 1', 39980, 35886, 0.96, 0.898, 'admin', '2015-07-13 02:32:45', '0000-00-00 00:00:00'),
	(37, '2015-07-09', 'musliman', 'Shift 1', '19', 'Pabrik 1', 41598, 40522, 0.96, 0.974, 'admin', '2015-07-13 02:33:14', '0000-00-00 00:00:00'),
	(38, '2015-07-10', 'musliman', 'Shift 1', '19', 'Pabrik 1', 40862, 27792, 0.96, 0.68, 'admin', '2015-07-13 02:33:36', '0000-00-00 00:00:00'),
	(39, '2015-07-11', 'musliman', 'Shift 1', '19', 'Pabrik 1', 28888, 31082, 0.96, 1.076, 'admin', '2015-07-13 02:33:59', '0000-00-00 00:00:00'),
	(40, '2015-07-12', 'musliman', 'Shift 1', '19', 'Pabrik 1', 14104, 11556, 0.96, 0.819, 'admin', '2015-07-13 02:34:18', '0000-00-00 00:00:00');
/*!40000 ALTER TABLE `pck_transaksi` ENABLE KEYS */;


-- Dumping structure for table inventory.supplier
CREATE TABLE IF NOT EXISTS `supplier` (
  `kode_supplier` char(5) NOT NULL DEFAULT '',
  `nama_supplier` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  PRIMARY KEY (`kode_supplier`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table inventory.supplier: ~0 rows (approximately)
DELETE FROM `supplier`;
/*!40000 ALTER TABLE `supplier` DISABLE KEYS */;
/*!40000 ALTER TABLE `supplier` ENABLE KEYS */;


-- Dumping structure for table inventory.wip_keramik_kat
CREATE TABLE IF NOT EXISTS `wip_keramik_kat` (
  `id_wip` int(11) NOT NULL AUTO_INCREMENT,
  `jns_wip` varchar(50) NOT NULL,
  `cat_wip` varchar(50) NOT NULL,
  `time_release` date NOT NULL,
  `cat_target` varchar(50) NOT NULL,
  `target_min` double DEFAULT NULL,
  `pcs_target` double NOT NULL,
  `pcs_target_cat` varchar(50) NOT NULL,
  `period_start` date NOT NULL,
  `period_end` date NOT NULL,
  `pic` varchar(50) NOT NULL,
  `inputer` varchar(50) NOT NULL,
  `ket` varchar(255) DEFAULT NULL,
  `status` varchar(50) NOT NULL,
  `tgl_insert` datetime NOT NULL,
  `tgl_update` datetime NOT NULL,
  PRIMARY KEY (`id_wip`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

-- Dumping data for table inventory.wip_keramik_kat: ~32 rows (approximately)
DELETE FROM `wip_keramik_kat`;
/*!40000 ALTER TABLE `wip_keramik_kat` DISABLE KEYS */;
INSERT INTO `wip_keramik_kat` (`id_wip`, `jns_wip`, `cat_wip`, `time_release`, `cat_target`, `target_min`, `pcs_target`, `pcs_target_cat`, `period_start`, `period_end`, `pic`, `inputer`, `ket`, `status`, `tgl_insert`, `tgl_update`) VALUES
	(1, 'Body Polos', '', '2015-06-26', 'WIP Keramik', 0, 250000, 'pcs', '2015-01-01', '2015-03-31', 'doni', 'admin', 'Target Q1', 'inactive', '0000-00-00 00:00:00', '2015-06-30 07:13:10'),
	(2, 'Colorwave', '', '2015-06-26', 'WIP Keramik', 90000, 140000, 'pcs', '2015-01-01', '2015-03-31', 'doni', 'admin', 'Target Q1', 'inactive', '0000-00-00 00:00:00', '2015-06-30 07:13:45'),
	(3, 'In Glaze', '', '2015-06-26', 'WIP Keramik', 0, 330000, 'pcs', '2015-01-01', '2015-03-31', 'doni', 'admin', 'Target Q1', 'inactive', '0000-00-00 00:00:00', '2015-06-30 07:14:05'),
	(4, 'On Glaze', '', '2015-06-26', 'WIP Keramik', 0, 210000, 'pcs', '2015-01-01', '2015-03-31', 'doni', 'admin', 'Target Q1', 'inactive', '0000-00-00 00:00:00', '2015-06-30 07:14:22'),
	(5, 'Body Polos', '', '2015-06-26', 'WIP Keramik', 0, 235000, 'pcs', '2015-04-01', '2015-06-30', 'doni', 'admin', 'Target Q2', 'active', '0000-00-00 00:00:00', '2015-06-30 07:14:50'),
	(6, 'Colorwave', '', '2015-06-26', 'WIP Keramik', 90000, 130000, 'pcs', '2015-04-01', '2015-06-30', 'doni', 'admin', 'Target Q2', 'active', '0000-00-00 00:00:00', '2015-06-30 07:15:07'),
	(7, 'In Glaze', '', '2015-06-26', 'WIP Keramik', 0, 320000, 'pcs', '2015-04-01', '2015-06-30', 'doni', 'admin', 'Target Q2', 'active', '0000-00-00 00:00:00', '2015-06-30 07:16:30'),
	(8, 'On Glaze', '', '2015-06-26', 'WIP Keramik', 0, 205000, 'pcs', '2015-04-01', '2015-06-30', 'doni', 'admin', 'Target Q2', 'active', '0000-00-00 00:00:00', '2015-06-30 07:16:51'),
	(9, 'Body Polos', '', '2015-06-26', 'WIP Keramik', 0, 210000, 'pcs', '2015-07-01', '2015-09-30', 'doni', 'admin', 'Target Q3', 'active', '0000-00-00 00:00:00', '2015-06-30 07:17:12'),
	(10, 'Colorwave', '', '2015-06-26', 'WIP Keramik', 90000, 125000, 'pcs', '2015-07-01', '2015-09-30', 'doni', 'admin', 'Target Q3', 'active', '0000-00-00 00:00:00', '2015-06-30 07:17:40'),
	(11, 'In Glaze', '', '2015-06-26', 'WIP Keramik', 0, 310000, 'pcs', '2015-07-01', '2015-09-30', 'doni', 'admin', 'Target Q3', 'active', '0000-00-00 00:00:00', '2015-06-30 07:17:58'),
	(12, 'On Glaze', '', '2015-06-26', 'WIP Keramik', 0, 205000, 'pcs', '2015-07-01', '2015-09-30', 'doni', 'admin', 'Target Q3', 'active', '0000-00-00 00:00:00', '2015-06-30 07:18:17'),
	(13, 'Body Polos', '', '2015-06-28', 'WIP Keramik', 0, 190000, 'pcs', '2015-10-01', '2015-12-31', 'doni', 'admin', 'Target Q4', 'active', '2015-06-28 10:05:52', '2015-06-30 07:18:36'),
	(14, 'Colorwave', '', '2015-06-28', 'WIP Keramik', 90000, 120000, 'pcs', '2015-10-01', '2015-12-31', 'doni', 'admin', 'Target Q4', 'active', '2015-06-28 10:06:57', '2015-06-30 07:18:52'),
	(15, 'In Glaze', '', '2015-06-28', 'WIP Keramik', 0, 300000, 'pcs', '2015-10-01', '2015-12-31', 'doni', 'admin', 'Target Q4', 'active', '2015-06-28 02:52:41', '2015-06-30 07:19:10'),
	(16, 'On Glaze', '', '2015-06-28', 'WIP Keramik', 0, 200000, 'pcs', '2015-10-01', '2015-12-31', 'doni', 'admin', 'Target Q4', 'active', '2015-06-28 02:52:41', '2015-06-30 07:28:06'),
	(17, 'AR Packing', '', '2015-07-03', 'Ekspor', 0.95, 0.95, '%', '2015-01-01', '2015-03-31', 'musliman', 'admin', 'Target Q1', 'active', '2015-07-03 10:49:23', '2015-07-03 10:49:53'),
	(18, 'AR Packing', '', '2015-07-03', 'Ekspor', 0.955, 0.955, '%', '2015-04-01', '2015-06-30', 'musliman', 'admin', 'Target Q2', 'active', '2015-07-03 10:49:23', '2015-07-03 10:49:53'),
	(19, 'AR Packing', '', '2015-07-03', 'Ekspor', 0.96, 0.96, '%', '2015-07-01', '2015-09-30', 'musliman', 'admin', 'Target Q3', 'active', '2015-07-03 10:49:23', '2015-07-03 10:49:53'),
	(20, 'AR Packing', '', '2015-07-03', 'Ekspor', 0.965, 0.965, '%', '2015-10-01', '2015-12-31', 'musliman', 'admin', 'Target Q4', 'active', '2015-07-03 10:49:23', '2015-07-03 10:49:53'),
	(21, 'AR Dekorasi', '', '2015-07-03', 'Dekorasi', 0.95, 0.95, '%', '2015-01-01', '2015-03-31', 'rohimah', 'admin', 'Target Q1', 'active', '2015-07-03 10:49:23', '2015-07-03 10:49:53'),
	(22, 'AR Dekorasi', '', '2015-07-03', 'Dekorasi', 0.96, 0.96, '%', '2015-04-01', '2015-06-30', 'rohimah', 'admin', 'Target Q2', 'active', '2015-07-03 10:49:23', '2015-07-03 10:49:53'),
	(23, 'AR Dekorasi', '', '2015-07-03', 'Dekorasi', 0.97, 0.97, '%', '2015-07-01', '2015-09-30', 'rohimah', 'admin', 'Target Q3', 'active', '2015-07-03 10:49:23', '2015-07-03 10:49:53'),
	(24, 'AR Dekorasi', '', '2015-07-03', 'Dekorasi', 0.98, 0.98, '%', '2015-10-01', '2015-12-31', 'rohimah', 'admin', 'Target Q4', 'active', '2015-07-03 10:49:23', '2015-07-03 10:49:53'),
	(25, 'Finish Good', '', '2015-07-13', 'Ekspor', 200000, 500000, 'pcs', '2015-01-01', '2015-12-31', 'gunawan', 'admin', 'Target Q1-Q4', 'active', '2015-07-13 04:34:39', '2015-07-13 04:35:25'),
	(26, 'Finish Good', '', '2015-07-13', 'Lokal', 0, 0, 'pcs', '2015-01-01', '2015-12-31', 'risma', 'admin', 'Target Q1-Q4', 'active', '2015-07-13 04:34:39', '2015-07-13 04:35:25'),
	(27, 'Target Pengiriman Ekspor', '', '2015-03-01', 'PPIC', 746992, 746992, 'pcs', '2015-03-01', '2015-03-31', 'windi', 'admin', 'ekspor', 'active', '2015-08-10 09:46:59', '2015-08-10 09:49:02'),
	(28, 'Target Pengiriman Lokal KW1', '', '2015-03-01', 'PPIC', 59392, 59392, 'pcs', '2015-03-01', '2015-03-31', 'windi', 'admin', 'lokal kw1', 'active', '2015-08-10 09:46:59', '2015-08-10 09:49:02'),
	(29, 'Target Pengiriman Lokal KW2', '', '2015-03-01', 'PPIC', 50000, 50000, 'pcs', '2015-03-01', '2015-03-31', 'windi', 'admin', 'lokal kw2', 'active', '2015-08-10 09:46:59', '2015-08-10 09:49:02'),
	(30, 'Target Pengiriman Ekspor', '', '2015-08-01', 'PPIC', 1015922, 1015922, 'pcs', '2015-08-01', '2015-08-30', 'windi', 'admin', 'ekspor', 'active', '2015-08-10 09:46:59', '2015-08-10 09:49:02'),
	(31, 'Target Pengiriman Lokal KW1', '', '2015-08-01', 'PPIC', 93480, 93480, 'pcs', '2015-08-01', '2015-08-30', 'windi', 'admin', 'lokal kw1', 'active', '2015-08-10 09:46:59', '2015-08-10 09:49:02'),
	(32, 'Target Pengiriman Lokal KW2', '', '2015-08-01', 'PPIC', 60440, 60440, 'pcs', '2015-08-01', '2015-08-30', 'windi', 'admin', 'lokal kw2', 'active', '2015-08-10 09:46:59', '2015-08-10 09:49:02');
/*!40000 ALTER TABLE `wip_keramik_kat` ENABLE KEYS */;


-- Dumping structure for table inventory.wip_lokasi
CREATE TABLE IF NOT EXISTS `wip_lokasi` (
  `id_wip` int(11) NOT NULL AUTO_INCREMENT,
  `lokasi` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_wip`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table inventory.wip_lokasi: ~3 rows (approximately)
DELETE FROM `wip_lokasi`;
/*!40000 ALTER TABLE `wip_lokasi` DISABLE KEYS */;
INSERT INTO `wip_lokasi` (`id_wip`, `lokasi`) VALUES
	(1, 'Pabrik 1'),
	(2, 'Pabrik 2'),
	(3, 'Pabrik 3');
/*!40000 ALTER TABLE `wip_lokasi` ENABLE KEYS */;


-- Dumping structure for table inventory.wip_transaksi
CREATE TABLE IF NOT EXISTS `wip_transaksi` (
  `id_wip` int(11) NOT NULL AUTO_INCREMENT,
  `tgl_input` date NOT NULL,
  `pic` varchar(50) NOT NULL,
  `shift` enum('Shift 1','Shift 2','Shift 3') NOT NULL,
  `jns_wip` varchar(50) NOT NULL,
  `lokasi` enum('Pabrik 1','Pabrik 2','Pabrik 3') NOT NULL,
  `pcs_wip` int(11) NOT NULL,
  `target_min` int(11) NOT NULL,
  `target` int(11) NOT NULL,
  `akurasi` decimal(10,0) NOT NULL,
  `inputer` varchar(50) NOT NULL,
  `tgl_insert` datetime NOT NULL,
  `tgl_update` datetime NOT NULL,
  PRIMARY KEY (`id_wip`)
) ENGINE=InnoDB AUTO_INCREMENT=121 DEFAULT CHARSET=latin1;

-- Dumping data for table inventory.wip_transaksi: ~120 rows (approximately)
DELETE FROM `wip_transaksi`;
/*!40000 ALTER TABLE `wip_transaksi` DISABLE KEYS */;
INSERT INTO `wip_transaksi` (`id_wip`, `tgl_input`, `pic`, `shift`, `jns_wip`, `lokasi`, `pcs_wip`, `target_min`, `target`, `akurasi`, `inputer`, `tgl_insert`, `tgl_update`) VALUES
	(1, '2015-06-01', 'doni', 'Shift 1', '5', 'Pabrik 1', 235000, 0, 235000, 100, 'lia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(2, '2015-06-01', 'sawab', 'Shift 1', '8', 'Pabrik 2', 200000, 0, 205000, 98, 'lia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(3, '2015-06-01', 'sawab', 'Shift 1', '6', 'Pabrik 3', 120000, 90000, 130000, 99, 'lia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(4, '2015-06-01', 'doni', 'Shift 1', '7', 'Pabrik 1', 330000, 0, 320000, 100, 'lia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(5, '2015-06-02', 'doni', 'Shift 1', '5', 'Pabrik 1', 235000, 0, 235000, 100, 'lia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(6, '2015-06-02', 'sawab', 'Shift 1', '8', 'Pabrik 2', 200000, 0, 205000, 98, 'lia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(7, '2015-06-02', 'sawab', 'Shift 3', '7', 'Pabrik 3', 300000, 0, 320000, 97, 'lia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(8, '2015-06-02', 'doni', 'Shift 2', '6', 'Pabrik 1', 100000, 90000, 130000, 98, 'lia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(9, '2015-06-03', 'sawab', 'Shift 1', '5', 'Pabrik 1', 220000, 0, 235000, 100, 'lia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(10, '2015-06-03', 'sawab', 'Shift 2', '8', 'Pabrik 2', 190000, 0, 205000, 80, 'lia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(11, '2015-06-03', 'doni', 'Shift 3', '6', 'Pabrik 1', 120000, 90000, 130000, 100, 'lia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(12, '2015-06-03', 'sawab', 'Shift 2', '7', 'Pabrik 2', 300000, 0, 320000, 80, 'lia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(13, '2015-06-04', 'sawab', 'Shift 2', '7', 'Pabrik 2', 300000, 0, 320000, 80, 'lia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(14, '2015-06-04', 'sawab', 'Shift 3', '5', 'Pabrik 3', 250000, 0, 235000, 98, 'lia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(15, '2015-06-04', 'doni', 'Shift 1', '8', 'Pabrik 1', 220000, 0, 205000, 98, 'lia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(16, '2015-06-04', 'sawab', 'Shift 2', '6', 'Pabrik 3', 120000, 90000, 130000, 98, 'lia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(17, '2015-06-05', 'doni', 'Shift 1', '8', 'Pabrik 3', 185000, 0, 205000, 100, 'lia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(18, '2015-06-05', 'doni', 'Shift 2', '6', 'Pabrik 2', 115000, 90000, 130000, 100, 'lia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(19, '2015-06-05', 'doni', 'Shift 3', '7', 'Pabrik 1', 300000, 0, 320000, 100, 'lia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(20, '2015-06-05', 'sawab', 'Shift 2', '5', 'Pabrik 3', 240000, 0, 235000, 100, 'lia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(21, '2015-06-06', 'sawab', 'Shift 2', '6', 'Pabrik 2', 140000, 90000, 130000, 100, 'lia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(22, '2015-06-06', 'sawab', 'Shift 3', '7', 'Pabrik 1', 325000, 0, 320000, 100, 'lia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(23, '2015-06-06', 'doni', 'Shift 2', '5', 'Pabrik 2', 300000, 0, 235000, 100, 'lia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(24, '2015-06-06', 'doni', 'Shift 1', '8', 'Pabrik 3', 190000, 0, 205000, 100, 'lia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(25, '2015-06-07', 'sawab', 'Shift 3', '5', 'Pabrik 3', 220000, 0, 235000, 98, 'lia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(26, '2015-06-07', 'doni', 'Shift 1', '8', 'Pabrik 1', 200000, 0, 205000, 98, 'lia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(27, '2015-06-07', 'sawab', 'Shift 2', '6', 'Pabrik 3', 115000, 90000, 130000, 98, 'lia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(28, '2015-06-07', 'sawab', 'Shift 3', '7', 'Pabrik 1', 325000, 0, 320000, 100, 'lia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(29, '2015-06-08', 'doni', 'Shift 1', '8', 'Pabrik 3', 200000, 0, 205000, 100, 'lia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(30, '2015-06-08', 'doni', 'Shift 2', '6', 'Pabrik 2', 115000, 90000, 130000, 100, 'lia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(31, '2015-06-08', 'doni', 'Shift 3', '7', 'Pabrik 1', 330000, 0, 320000, 100, 'lia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(32, '2015-06-08', 'sawab', 'Shift 2', '5', 'Pabrik 3', 200000, 0, 235000, 100, 'lia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(33, '2015-06-09', 'doni', 'Shift 1', '5', 'Pabrik 1', 200000, 0, 235000, 100, 'lia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(34, '2015-06-09', 'sawab', 'Shift 1', '8', 'Pabrik 2', 189000, 0, 205000, 98, 'lia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(35, '2015-06-09', 'sawab', 'Shift 1', '6', 'Pabrik 3', 126785, 90000, 130000, 99, 'lia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(36, '2015-06-09', 'doni', 'Shift 1', '7', 'Pabrik 1', 315689, 0, 320000, 100, 'lia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(37, '2015-06-10', 'sawab', 'Shift 2', '8', 'Pabrik 2', 300000, 0, 205000, 80, 'lia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(38, '2015-06-10', 'doni', 'Shift 3', '6', 'Pabrik 1', 130000, 90000, 130000, 100, 'lia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(39, '2015-06-10', 'sawab', 'Shift 2', '7', 'Pabrik 2', 320000, 0, 320000, 80, 'lia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(40, '2015-06-10', 'doni', 'Shift 3', '5', 'Pabrik 1', 225000, 0, 235000, 100, 'lia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(41, '2015-06-11', 'sawab', 'Shift 3', '5', 'Pabrik 3', 245065, 0, 235000, 98, 'lia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(42, '2015-06-11', 'doni', 'Shift 1', '8', 'Pabrik 1', 180000, 0, 205000, 98, 'lia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(43, '2015-06-11', 'sawab', 'Shift 2', '6', 'Pabrik 3', 145000, 90000, 130000, 98, 'lia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(44, '2015-06-11', 'sawab', 'Shift 2', '7', 'Pabrik 2', 320000, 0, 320000, 80, 'lia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(45, '2015-06-12', 'doni', 'Shift 2', '6', 'Pabrik 2', 100000, 90000, 130000, 100, 'lia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(46, '2015-06-12', 'doni', 'Shift 3', '7', 'Pabrik 1', 250000, 0, 320000, 100, 'lia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(47, '2015-06-12', 'sawab', 'Shift 2', '5', 'Pabrik 3', 175600, 0, 235000, 100, 'lia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(48, '2015-06-12', 'sawab', 'Shift 2', '8', 'Pabrik 2', 185000, 0, 205000, 100, 'lia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(49, '2015-06-13', 'doni', 'Shift 1', '5', 'Pabrik 1', 220250, 0, 235000, 100, 'lia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(50, '2015-06-13', 'sawab', 'Shift 1', '8', 'Pabrik 2', 160000, 0, 205000, 98, 'lia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(51, '2015-06-13', 'sawab', 'Shift 1', '6', 'Pabrik 3', 80000, 90000, 130000, 99, 'lia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(52, '2015-06-13', 'doni', 'Shift 1', '7', 'Pabrik 1', 250000, 0, 320000, 100, 'lia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(53, '2015-06-14', 'sawab', 'Shift 3', '7', 'Pabrik 3', 300000, 0, 320000, 97, 'lia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(54, '2015-06-14', 'doni', 'Shift 2', '6', 'Pabrik 1', 50000, 90000, 130000, 98, 'lia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(55, '2015-06-14', 'doni', 'Shift 1', '5', 'Pabrik 1', 220250, 0, 235000, 100, 'lia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(56, '2015-06-14', 'sawab', 'Shift 1', '8', 'Pabrik 2', 160000, 0, 205000, 98, 'lia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(57, '2015-06-15', 'sawab', 'Shift 2', '8', 'Pabrik 2', 188625, 0, 205000, 80, 'lia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(58, '2015-06-15', 'doni', 'Shift 3', '6', 'Pabrik 1', 112535, 90000, 130000, 100, 'lia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(59, '2015-06-15', 'sawab', 'Shift 2', '7', 'Pabrik 2', 168452, 0, 320000, 80, 'lia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(60, '2015-06-15', 'doni', 'Shift 3', '5', 'Pabrik 1', 300000, 0, 235000, 100, 'lia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(61, '2015-06-16', 'sawab', 'Shift 3', '5', 'Pabrik 3', 225681, 0, 235000, 98, 'lia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(62, '2015-06-16', 'doni', 'Shift 1', '8', 'Pabrik 1', 198222, 0, 205000, 98, 'lia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(63, '2015-06-16', 'sawab', 'Shift 2', '6', 'Pabrik 3', 115200, 90000, 130000, 98, 'lia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(64, '2015-06-16', 'sawab', 'Shift 2', '7', 'Pabrik 2', 168452, 0, 320000, 80, 'lia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(65, '2015-06-17', 'doni', 'Shift 1', '8', 'Pabrik 3', 268000, 0, 205000, 100, 'lia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(66, '2015-06-17', 'doni', 'Shift 2', '6', 'Pabrik 2', 110285, 90000, 130000, 100, 'lia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(67, '2015-06-17', 'doni', 'Shift 3', '7', 'Pabrik 1', 400000, 0, 320000, 100, 'lia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(68, '2015-06-17', 'sawab', 'Shift 2', '5', 'Pabrik 3', 165233, 0, 235000, 100, 'lia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(69, '2015-06-18', 'sawab', 'Shift 2', '6', 'Pabrik 2', 112320, 90000, 130000, 100, 'lia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(70, '2015-06-18', 'sawab', 'Shift 3', '7', 'Pabrik 1', 400658, 0, 320000, 100, 'lia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(71, '2015-06-18', 'doni', 'Shift 2', '5', 'Pabrik 2', 200000, 0, 235000, 100, 'lia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(72, '2015-06-18', 'doni', 'Shift 1', '8', 'Pabrik 3', 178520, 0, 205000, 100, 'lia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(73, '2015-06-19', 'sawab', 'Shift 3', '5', 'Pabrik 3', 200000, 0, 235000, 98, 'lia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(74, '2015-06-19', 'doni', 'Shift 1', '8', 'Pabrik 1', 168121, 0, 205000, 98, 'lia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(75, '2015-06-19', 'sawab', 'Shift 2', '6', 'Pabrik 3', 125211, 90000, 130000, 98, 'lia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(76, '2015-06-19', 'sawab', 'Shift 3', '7', 'Pabrik 1', 400658, 0, 320000, 100, 'lia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(77, '2015-06-20', 'doni', 'Shift 1', '8', 'Pabrik 3', 174521, 0, 205000, 100, 'lia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(78, '2015-06-20', 'doni', 'Shift 2', '6', 'Pabrik 2', 110200, 90000, 130000, 100, 'lia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(79, '2015-06-20', 'doni', 'Shift 3', '7', 'Pabrik 1', 300521, 0, 320000, 100, 'lia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(80, '2015-06-20', 'sawab', 'Shift 2', '5', 'Pabrik 3', 150654, 0, 235000, 100, 'lia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(81, '2015-06-21', 'doni', 'Shift 1', '5', 'Pabrik 1', 130512, 0, 235000, 100, 'lia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(82, '2015-06-21', 'sawab', 'Shift 1', '8', 'Pabrik 2', 145621, 0, 205000, 98, 'lia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(83, '2015-06-21', 'sawab', 'Shift 1', '6', 'Pabrik 3', 80202, 90000, 130000, 99, 'lia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(84, '2015-06-21', 'doni', 'Shift 1', '7', 'Pabrik 1', 245212, 0, 320000, 100, 'lia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(85, '2015-06-22', 'doni', 'Shift 3', '6', 'Pabrik 1', 56825, 90000, 130000, 100, 'lia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(86, '2015-06-22', 'sawab', 'Shift 2', '7', 'Pabrik 2', 298532, 0, 320000, 80, 'lia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(87, '2015-06-22', 'doni', 'Shift 3', '5', 'Pabrik 1', 350664, 0, 235000, 100, 'lia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(88, '2015-06-22', 'sawab', 'Shift 1', '8', 'Pabrik 2', 145621, 0, 205000, 98, 'lia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(89, '2015-06-23', 'sawab', 'Shift 3', '5', 'Pabrik 3', 200355, 0, 235000, 98, 'lia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(90, '2015-06-23', 'doni', 'Shift 1', '8', 'Pabrik 1', 175462, 0, 205000, 98, 'lia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(91, '2015-06-23', 'sawab', 'Shift 2', '6', 'Pabrik 3', 56284, 90000, 130000, 98, 'lia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(92, '2015-06-23', 'sawab', 'Shift 2', '7', 'Pabrik 2', 298532, 0, 320000, 80, 'lia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(93, '2015-06-24', 'sawab', 'Shift 3', '5', 'Pabrik 3', 305213, 0, 235000, 98, 'lia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(94, '2015-06-24', 'doni', 'Shift 1', '8', 'Pabrik 1', 156242, 0, 205000, 98, 'lia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(95, '2015-06-24', 'sawab', 'Shift 2', '6', 'Pabrik 3', 65844, 90000, 130000, 98, 'lia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(96, '2015-06-24', 'sawab', 'Shift 2', '7', 'Pabrik 2', 298532, 0, 320000, 80, 'lia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(97, '2015-06-25', 'doni', 'Shift 1', '8', 'Pabrik 3', 182450, 0, 205000, 100, 'lia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(98, '2015-06-25', 'doni', 'Shift 2', '6', 'Pabrik 2', 98652, 90000, 130000, 100, 'lia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(99, '2015-06-25', 'sawab', 'Shift 2', '5', 'Pabrik 3', 250121, 0, 235000, 100, 'lia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(100, '2015-06-25', 'sawab', 'Shift 3', '7', 'Pabrik 1', 300251, 0, 320000, 100, 'lia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(101, '2015-06-26', 'lia', 'Shift 1', '5', 'Pabrik 1', 200000, 0, 235000, 100, 'lia', '2015-06-26 02:19:44', '2015-06-26 02:20:46'),
	(102, '2015-06-26', 'doni', 'Shift 2', '6', 'Pabrik 2', 100000, 90000, 130000, 100, 'lia', '2015-06-27 08:07:44', '2015-06-27 08:12:54'),
	(103, '2015-06-26', 'sawab', 'Shift 2', '7', 'Pabrik 3', 300000, 0, 320000, 100, 'lia', '2015-06-27 08:18:04', '0000-00-00 00:00:00'),
	(104, '2015-06-26', 'doni', 'Shift 2', '8', 'Pabrik 3', 250321, 0, 205000, 90, 'lia', '2015-06-27 08:18:23', '0000-00-00 00:00:00'),
	(105, '2015-06-27', 'lia', 'Shift 1', '5', 'Pabrik 1', 180585, 0, 235000, 100, 'lia', '2015-06-26 02:19:44', '2015-06-26 02:20:46'),
	(106, '2015-06-27', 'doni', 'Shift 2', '6', 'Pabrik 2', 56216, 90000, 130000, 100, 'lia', '2015-06-27 08:07:44', '2015-06-27 08:12:54'),
	(107, '2015-06-27', 'sawab', 'Shift 2', '7', 'Pabrik 3', 250344, 0, 320000, 100, 'lia', '2015-06-27 08:18:04', '0000-00-00 00:00:00'),
	(108, '2015-06-27', 'doni', 'Shift 2', '8', 'Pabrik 3', 232021, 0, 205000, 90, 'lia', '2015-06-27 08:18:23', '0000-00-00 00:00:00'),
	(109, '2015-06-28', 'lia', 'Shift 1', '5', 'Pabrik 1', 198231, 0, 235000, 100, 'lia', '2015-06-26 02:19:44', '2015-06-26 02:20:46'),
	(110, '2015-06-28', 'doni', 'Shift 2', '6', 'Pabrik 2', 115845, 90000, 130000, 100, 'lia', '2015-06-27 08:07:44', '2015-06-27 08:12:54'),
	(111, '2015-06-28', 'sawab', 'Shift 2', '7', 'Pabrik 3', 285431, 0, 320000, 100, 'lia', '2015-06-27 08:18:04', '0000-00-00 00:00:00'),
	(112, '2015-06-28', 'doni', 'Shift 2', '8', 'Pabrik 3', 235143, 0, 205000, 90, 'lia', '2015-06-27 08:18:23', '0000-00-00 00:00:00'),
	(113, '2015-06-29', 'lia', 'Shift 1', '5', 'Pabrik 1', 225000, 0, 235000, 100, 'lia', '2015-06-26 02:19:44', '2015-06-26 02:20:46'),
	(114, '2015-06-29', 'doni', 'Shift 2', '6', 'Pabrik 2', 70354, 90000, 130000, 100, 'lia', '2015-06-27 08:07:44', '2015-06-27 08:12:54'),
	(115, '2015-06-29', 'sawab', 'Shift 2', '7', 'Pabrik 3', 350212, 0, 320000, 100, 'lia', '2015-06-27 08:18:04', '0000-00-00 00:00:00'),
	(116, '2015-06-29', 'doni', 'Shift 2', '8', 'Pabrik 3', 205234, 0, 205000, 90, 'lia', '2015-06-27 08:18:23', '0000-00-00 00:00:00'),
	(117, '2015-06-30', 'lia', 'Shift 1', '5', 'Pabrik 1', 237531, 0, 235000, 100, 'lia', '2015-06-26 02:19:44', '2015-06-26 02:20:46'),
	(118, '2015-06-30', 'doni', 'Shift 2', '6', 'Pabrik 2', 70353, 90000, 130000, 100, 'lia', '2015-06-27 08:07:44', '2015-06-27 08:12:54'),
	(119, '2015-06-30', 'sawab', 'Shift 2', '7', 'Pabrik 3', 310212, 0, 320000, 100, 'lia', '2015-06-27 08:18:04', '0000-00-00 00:00:00'),
	(120, '2015-06-30', 'doni', 'Shift 2', '8', 'Pabrik 3', 195234, 0, 205000, 90, 'lia', '2015-06-27 08:18:23', '0000-00-00 00:00:00');
/*!40000 ALTER TABLE `wip_transaksi` ENABLE KEYS */;


-- Dumping structure for trigger inventory.glasir_add_bgps
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='';
DELIMITER //
CREATE TRIGGER `glasir_add_bgps` AFTER INSERT ON `glasir_phd` FOR EACH ROW BEGIN 
UPDATE glasir 
SET s_bgps = s_bgps + (1.565*((NEW.densitas-1000)/1000)*NEW.volume)
WHERE
id_glasir = NEW.id_glasir AND 
NEW.id_bmt NOT IN (1);
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;


-- Dumping structure for trigger inventory.glasir_add_bgps_min_supply
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `glasir_add_bgps_min_supply` BEFORE DELETE ON `glasir_phd_sp` FOR EACH ROW BEGIN 
UPDATE glasir 
SET s_supply = s_supply - (1.565*((OLD.densitas-1000)/1000)*OLD.volume),
s_bgps = s_bgps + (1.565*((OLD.densitas-1000)/1000)*OLD.volume)
WHERE
id_glasir = OLD.id_glasir;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;


-- Dumping structure for trigger inventory.glasir_add_bgps_retur
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='';
DELIMITER //
CREATE TRIGGER `glasir_add_bgps_retur` AFTER INSERT ON `glasir_rhd` FOR EACH ROW BEGIN 
UPDATE glasir 
SET stok_awal = stok_awal + NEW.volume
WHERE
id_glasir = NEW.id_glasir;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;


-- Dumping structure for trigger inventory.glasir_add_bgps_tran
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='';
DELIMITER //
CREATE TRIGGER `glasir_add_bgps_tran` BEFORE DELETE ON `glasir_thd` FOR EACH ROW BEGIN 
UPDATE glasir 
SET stok_awal = stok_awal + OLD.volume
WHERE
id_glasir = OLD.id_glasir;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;


-- Dumping structure for trigger inventory.glasir_min_bgps
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='';
DELIMITER //
CREATE TRIGGER `glasir_min_bgps` BEFORE DELETE ON `glasir_phd` FOR EACH ROW BEGIN 
UPDATE glasir 
SET s_bgps = s_bgps - (1.565*((OLD.densitas-1000)/1000)*OLD.volume)
WHERE
id_glasir = OLD.id_glasir AND 
OLD.id_bmt NOT IN (1);
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;


-- Dumping structure for trigger inventory.glasir_min_bgps_add_supply
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='';
DELIMITER //
CREATE TRIGGER `glasir_min_bgps_add_supply` AFTER INSERT ON `glasir_phd_sp` FOR EACH ROW BEGIN 
UPDATE glasir 
SET s_supply = s_supply + (1.565*((NEW.densitas-1000)/1000)*NEW.volume),
s_bgps = s_bgps - (1.565*((NEW.densitas-1000)/1000)*NEW.volume)
WHERE
id_glasir = NEW.id_glasir;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;


-- Dumping structure for trigger inventory.glasir_min_bgps_retur
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='';
DELIMITER //
CREATE TRIGGER `glasir_min_bgps_retur` BEFORE DELETE ON `glasir_rhd` FOR EACH ROW BEGIN 
UPDATE glasir 
SET stok_awal = stok_awal - OLD.volume
WHERE
id_glasir = OLD.id_glasir;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;


-- Dumping structure for trigger inventory.glasir_min_bgps_tran
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='';
DELIMITER //
CREATE TRIGGER `glasir_min_bgps_tran` AFTER INSERT ON `glasir_thd` FOR EACH ROW BEGIN 
UPDATE glasir 
SET stok_awal = stok_awal - NEW.volume
WHERE
id_glasir = NEW.id_glasir;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;


-- Dumping structure for trigger inventory.kurang_stok
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='';
DELIMITER //
CREATE TRIGGER `kurang_stok` BEFORE DELETE ON `d_beli` FOR EACH ROW BEGIN 
UPDATE barang 
SET stok_awal = stok_awal - OLD.jmlbeli
WHERE
kode_barang = OLD.kode_barang;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;


-- Dumping structure for trigger inventory.kurang_stok_jual
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='';
DELIMITER //
CREATE TRIGGER `kurang_stok_jual` AFTER INSERT ON `d_jual` FOR EACH ROW BEGIN 
UPDATE barang 
SET stok_awal = stok_awal - NEW.jmljual
WHERE
kode_barang = NEW.kode_barang;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;


-- Dumping structure for trigger inventory.tambah_stok
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='';
DELIMITER //
CREATE TRIGGER `tambah_stok` AFTER INSERT ON `d_beli` FOR EACH ROW BEGIN 
UPDATE barang 
SET stok_awal = stok_awal + NEW.jmlbeli
WHERE
kode_barang = NEW.kode_barang;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;


-- Dumping structure for trigger inventory.tambah_stok_jual
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='';
DELIMITER //
CREATE TRIGGER `tambah_stok_jual` BEFORE DELETE ON `d_jual` FOR EACH ROW BEGIN 
UPDATE barang 
SET stok_awal = stok_awal + OLD.jmljual
WHERE
kode_barang = OLD.kode_barang;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
