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

-- Dumping data for table inventory.ci_sessions: ~3 rows (approximately)
DELETE FROM `ci_sessions`;
/*!40000 ALTER TABLE `ci_sessions` DISABLE KEYS */;
INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
	('8558706745fcfd6035c6bc44636da4c9', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.157 Safari/537.36', 1440399174, 'a:6:{s:9:"user_data";s:0:"";s:9:"logged_in";s:13:"aingLoginYeuh";s:8:"username";s:5:"admin";s:12:"nama_lengkap";s:13:"Administrator";s:4:"foto";s:9:"admin.jpg";s:5:"level";s:2:"01";}'),
	('f12f8e5392424c91967befabc135a003', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:39.0) Gecko/20100101 Firefox/39.0', 1440399343, 'a:6:{s:9:"user_data";s:0:"";s:9:"logged_in";s:13:"aingLoginYeuh";s:8:"username";s:5:"admin";s:12:"nama_lengkap";s:13:"Administrator";s:4:"foto";s:9:"admin.jpg";s:5:"level";s:2:"01";}');
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
  `stok_awal` decimal(10,0) NOT NULL,
  `inputer` varchar(50) NOT NULL,
  `tgl_input` datetime NOT NULL,
  `tgl_update` datetime NOT NULL,
  PRIMARY KEY (`id_glasir`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table inventory.glasir: ~212 rows (approximately)
DELETE FROM `glasir`;
/*!40000 ALTER TABLE `glasir` DISABLE KEYS */;
INSERT INTO `glasir` (`id_glasir`, `nama_glasir`, `nama_alias`, `satuan`, `status`, `stok_awal`, `inputer`, `tgl_input`, `tgl_update`) VALUES
	('Y00001', '0202 Brown', 'Brown si madun', 'Liter', '1', 300, 'admin', '2015-08-07 09:09:08', '2015-08-17 03:44:18'),
	('Y00002', '0202 Brown Floral dream', 'Mirip jenis sabun', 'Liter', '1', 300, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00003', '0202 Pink', 'Pink jambu muda', 'Liter', '1', 50, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00004', '0401 Blue', 'Blue coral', 'Liter', '1', 100, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00005', '0401 Pink', 'Pink ngejreng', 'Liter', '1', 100, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00006', '0402 Blue', 'Blue langit', 'Liter', '1', 100, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00007', '1Tone 5101 Clay', 'Wantun kley', 'Liter', '1', 100, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00008', '1Tone 5102 Spruce', 'Wantun sprus', 'Liter', '1', 100, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00009', '1Tone 8034 Graphite', 'Wantun garapit', 'Liter', '1', 100, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00010', '1Tone 8040 Cream', 'Wantun Krim', 'Liter', '1', 100, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00011', '1Tone 8045 Raspberry', '', 'Liter', '1', 100, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00012', '1Tone 8046 Chocolate', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00013', '1Tone 8049 Suede', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00014', '1Tone 8050 Indigo Blue', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00015', '1Tone 8052 Brown', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00016', '1Tone 8053 Slate', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00017', '1Tone 8059 Moss', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00018', '1Tone 8065 Mustard', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00019', '1Tone 8067 Burgundy', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00020', '1Tone 8090 White', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00021', '1Tone 8092 Teracota', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00022', '1Tone 8093 Turquoise', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00023', '1Tone 8094 Apple', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00024', '1Tone 8098 Plum', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00025', '1Tone 8099 Ice Blue', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00026', '1Tone 8483 Grey', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00027', '1Tone 8484 Blue', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00028', '1Tone 8485 Green', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00029', '1Tone 8486 Purple', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00030', '1Tone 8491 Yellow', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00031', '5100 Chocolate', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00032', '5101 Clay', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00033', '5102 Spruce', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00034', '5300 Summer', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00035', '8034 Graphite', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00036', '8040 Cream', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00037', '8045 Raspberry', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00038', '8046 Chocolate', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00039', '8049 Suede', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00040', '8050 Indigo Blue', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00041', '8050 Indigo Blue shiny', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00042', '8051 Green Forest', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00043', '8052 Brown', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00044', '8052 Brown shiny', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00045', '8053 Slate', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00046', '8053 Slate shiny', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00047', '8059 Moss', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00048', '8059 Moss shiny', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00049', '8065 Mustard', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00050', '8067 Burgundy', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00051', '8067 Burgundy shiny', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00052', '8079 Blue', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00053', '8082 Green', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00054', '8083 Yellow', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00055', '8090 Engobe', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00056', '8090 White', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00057', '8092 Teracota', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00058', '8093 Turquoise', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00059', '8094 Apple', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00060', '8096 Blue', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00061', '8097 Green', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00062', '8098 Plum', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00063', '8099 Ice Blue', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00064', '8170 Blue', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00065', '8170 Green', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00066', '8483 Grey', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00067', '8484 Blue', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00068', '8485 Green', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00069', '8486 Purple', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00070', '8491 Yellow', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00071', 'Andante Brown', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00072', 'Andante Gloss', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00073', 'Andante Lime Green', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00074', 'Andante Red', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00075', 'Andante Turquoise', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00076', 'Andante White', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00077', 'Anis Green', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00078', 'Antique White', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00079', 'Bali Green', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00080', 'Barella Blue Ice', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00081', 'Barella Cafe Latte', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00082', 'Barella French Vanilla', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00083', 'Bastide Brown', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00084', 'Beige Light', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00085', 'Black', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00086', 'Black BOB', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00087', 'Black Matte', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00088', 'Black Migros', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00089', 'Black Noir', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00090', 'Black STN', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00091', 'Black Stone', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00092', 'Blue', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00093', 'Blue Contempo', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00094', 'Blue Ice', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00095', 'Blue Peppercone', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00096', 'Brown', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00097', 'Brown Orchid', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00098', 'Brown Reactive+Speckle', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00099', 'Brown Stitch', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00100', 'Brown+Speckle', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00101', 'Clear+Black Speckle', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00102', 'Combee', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00103', 'Cool Grey 11 C', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00104', 'Cream', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00105', 'Cream Colorvara', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00106', 'Cream JCC', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00107', 'Cream Kaolin', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00108', 'Cream Orchid', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00109', 'Dark Brown Unitable', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00110', 'Dark Heather 5135C (Pantone 258C)', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00111', 'Dark Orange', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00112', 'Debenham Cream', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00113', 'Fronside Kona', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00114', 'Gloss', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00115', 'Gloss Epi', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00116', 'Gloss ICS', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00117', 'GOG', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00118', 'Green', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00119', 'Green Bali', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00120', 'Green Colour Yellow', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00121', 'Green Leaves', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00122', 'Green Reactive', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00123', 'Green Semi Matte', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00124', 'Green Ubud', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00125', 'Gres Fermier', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00126', 'Gress Fermier Grey', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00127', 'Gress Fermier Moss', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00128', 'Grey', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00129', 'Grey JCC', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00130', 'Ice Blue', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00131', 'Italla Apple Red', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00132', 'Italla Edelweish', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00133', 'Italla Graphite', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00134', 'Italla Pale Rose', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00135', 'Italla Sand Glossy', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00136', 'Italla White Glossy', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00137', 'Lava White', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00138', 'Lavender', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00139', 'Light 8050 Indigo Blue', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00140', 'Light 8052 Brown', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00141', 'Light 8053 Slate', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00142', 'Light 8059 Moss', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00143', 'Light 8067 Burgundy', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00144', 'Living Stone Red', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00145', 'Migros Dark Blue', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00146', 'Migros Dark Orange', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00147', 'Mikasa Cream', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00148', 'Mocca', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00149', 'Narumi Cream', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00150', 'New Blue', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00151', 'Ocean Blue', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00152', 'Oneida Green', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00153', 'Orange', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00154', 'P 5555C', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00155', 'Panama Falabela', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00156', 'Pantone 137 C/ Org', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00157', 'Picasso Jaune', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00158', 'Picasso Yellow', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00159', 'Pink', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00160', 'Pink Broderie', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00161', 'Pink Maison', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00162', 'Pink Serena', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00163', 'Purple Beneton', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00164', 'Purple Burgundi', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00165', 'Purple Light', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00166', 'Purple Serena', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00167', 'Reactive Green', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00168', 'Reactive Orange', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00169', 'Reactive Yellow', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00170', 'Red', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00171', 'Red Beneton', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00172', 'Red Chilli', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00173', 'Red Coble', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00174', 'Red Lohan', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00175', 'Red Small Tube', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00176', 'Sage Green', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00177', 'Savanah 3', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00178', 'Savanah Meil', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00179', 'Savanah Noritake', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00180', 'Savanah Speckle', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00181', 'Spice Cayenne', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00182', 'Spice Cilantro', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00183', 'Spice Saffron', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00184', 'Sudo Blue', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00185', 'Tarrerias Griss', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00186', 'Taupe', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00187', 'Ter Lichen', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00188', 'Terrarias Red', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00189', 'Terre Dombre', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00190', 'TOT', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00191', 'Turquise', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00192', 'Turquise Serena', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00193', 'Turquoise Matt', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00194', 'Upper Lava D1/2', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00195', 'Upper White Verceral', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00196', 'Violet 258C', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00197', 'Warm Grey Colorama', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00198', 'WB Cream', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00199', 'WB Pink', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00200', 'WB Powder Blue', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00201', 'WB Sage', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00202', 'White', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00203', 'White Glossy', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00204', 'White Kaolin', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00205', 'White Peptapon', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00206', 'Winterberry Cream', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00207', 'Winterberry Cream ICS', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00208', 'Yello Kuta', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00209', 'Yellow', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00210', 'Yellow C', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00211', 'Yellow Kuta', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00212', 'Yellow Serena', '', 'Liter', '1', 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00');
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
  `tgl_plng` date NOT NULL,
  `no_po` char(15) NOT NULL,
  `inputer` varchar(50) NOT NULL,
  `planner` varchar(50) NOT NULL,
  `tgl_inp` datetime NOT NULL,
  `lst_upd` datetime NOT NULL,
  PRIMARY KEY (`no_prod`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table inventory.glasir_ph: ~3 rows (approximately)
DELETE FROM `glasir_ph`;
/*!40000 ALTER TABLE `glasir_ph` DISABLE KEYS */;
INSERT INTO `glasir_ph` (`no_prod`, `tgl_plng`, `no_po`, `inputer`, `planner`, `tgl_inp`, `lst_upd`) VALUES
	('PG00001', '2015-08-01', 'OG00001', 'admin', 'Yuni', '2015-08-22 11:21:52', '0000-00-00 00:00:00'),
	('PG00002', '2015-08-04', 'OG00002', 'admin', 'Masitoh', '2015-08-24 07:51:43', '0000-00-00 00:00:00'),
	('PG00003', '2015-08-04', 'OG00003', 'admin', 'Yuni', '2015-08-24 08:00:16', '0000-00-00 00:00:00');
/*!40000 ALTER TABLE `glasir_ph` ENABLE KEYS */;


-- Dumping structure for table inventory.glasir_phd
CREATE TABLE IF NOT EXISTS `glasir_phd` (
  `idphd` smallint(6) NOT NULL AUTO_INCREMENT,
  `no_prod` char(15) NOT NULL,
  `id_glasir` varchar(50) NOT NULL,
  `buyer` smallint(6) NOT NULL,
  `jns` smallint(6) NOT NULL,
  `dsc` varchar(255) NOT NULL,
  `volume` double NOT NULL,
  `densitas` double NOT NULL,
  `inputer` varchar(50) NOT NULL,
  `petugas` varchar(50) NOT NULL,
  `tgl_insert` datetime NOT NULL,
  PRIMARY KEY (`idphd`),
  KEY `FK_glasir_phd_glasir` (`id_glasir`),
  KEY `FK_glasir_phd_glasir_ph` (`no_prod`),
  KEY `FK_glasir_phd_admins` (`inputer`),
  KEY `FK_glasir_phd_global_buyer` (`buyer`),
  KEY `FK_glasir_phd_global_delivery` (`jns`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table inventory.glasir_phd: ~3 rows (approximately)
DELETE FROM `glasir_phd`;
/*!40000 ALTER TABLE `glasir_phd` DISABLE KEYS */;
INSERT INTO `glasir_phd` (`idphd`, `no_prod`, `id_glasir`, `buyer`, `jns`, `dsc`, `volume`, `densitas`, `inputer`, `petugas`, `tgl_insert`) VALUES
	(21, 'PG00001', 'Y00011', 1, 1, 'Ok', 100, 1600, 'admin', 'zainudin', '2015-08-22 11:21:52'),
	(23, 'PG00002', 'Y00001', 1, 1, 'ditambah', 200, 1500, 'admin', 'zainudin', '2015-08-24 07:52:34'),
	(24, 'PG00003', 'Y00002', 2, 2, 'Diorder', 200, 0, 'admin', 'sukijan', '2015-08-24 08:00:16');
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

-- Dumping data for table inventory.glasir_rh: ~3 rows (approximately)
DELETE FROM `glasir_rh`;
/*!40000 ALTER TABLE `glasir_rh` DISABLE KEYS */;
INSERT INTO `glasir_rh` (`no_prod`, `tgl_plng`, `inputer`, `planner`, `tgl_inp`, `lst_upd`) VALUES
	('RG00001', '2015-08-01', 'admin', 'Yuni', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	('RG00002', '2015-08-01', 'admin', 'Yuni', '2015-08-24 07:15:09', '0000-00-00 00:00:00'),
	('RG00003', '2015-08-06', 'admin', 'Yuni', '2015-08-24 07:53:43', '0000-00-00 00:00:00');
/*!40000 ALTER TABLE `glasir_rh` ENABLE KEYS */;


-- Dumping structure for table inventory.glasir_rhd
CREATE TABLE IF NOT EXISTS `glasir_rhd` (
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table inventory.glasir_rhd: ~4 rows (approximately)
DELETE FROM `glasir_rhd`;
/*!40000 ALTER TABLE `glasir_rhd` DISABLE KEYS */;
INSERT INTO `glasir_rhd` (`idthd`, `no_prod`, `id_glasir`, `buyer`, `jns`, `shift`, `mpr`, `dsc`, `volume`, `densitas`, `vsc`, `inputer`, `petugas`, `wktp`, `tgl_insert`) VALUES
	(1, 'RG00001', 'Y00001', 2, 2, 2, 24, 'sippo', 5, 1600, 0.1, 'admin', 'Rita', '0000-00-00', '0000-00-00 00:00:00'),
	(2, 'RG00002', 'Y00002', 2, 2, 2, 22, 'Ok jon', 7, 1500, 0.2, 'admin', 'Sukijan', '2015-08-02', '2015-08-24 07:15:09'),
	(3, 'RG00002', 'Y00003', 2, 2, 2, 22, 'Ok jon', 3, 1500, 0.2, 'admin', 'Sukijan', '2015-08-02', '2015-08-24 07:15:39'),
	(6, 'RG00003', 'Y00003', 2, 2, 2, 23, 'Dipakai', 5, 1500, 0.2, 'admin', 'rara', '2015-08-24', '2015-08-24 08:02:21');
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
	('TG00003', '2015-08-06', 'admin', 'Yuni', '2015-08-24 07:53:43', '0000-00-00 00:00:00');
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table inventory.glasir_thd: ~4 rows (approximately)
DELETE FROM `glasir_thd`;
/*!40000 ALTER TABLE `glasir_thd` DISABLE KEYS */;
INSERT INTO `glasir_thd` (`idthd`, `no_prod`, `id_glasir`, `buyer`, `jns`, `shift`, `mpr`, `dsc`, `volume`, `densitas`, `vsc`, `inputer`, `petugas`, `wktp`, `tgl_insert`) VALUES
	(1, 'TG00001', 'Y00001', 2, 2, 2, 24, 'sippo', 20, 1600, 0.1, 'admin', 'Rita', '0000-00-00', '0000-00-00 00:00:00'),
	(2, 'TG00002', 'Y00002', 2, 2, 2, 22, 'Ok jon', 50, 1500, 0.2, 'admin', 'Sukijan', '2015-08-02', '2015-08-24 07:15:09'),
	(3, 'TG00002', 'Y00003', 2, 2, 2, 22, 'Ok jon', 50, 1500, 0.2, 'admin', 'Sukijan', '2015-08-02', '2015-08-24 07:15:39'),
	(6, 'TG00003', 'Y00003', 2, 2, 2, 23, 'Dipakai', 50, 1500, 0.2, 'admin', 'rara', '2015-08-24', '2015-08-24 08:02:21');
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
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table inventory.global_mesin: ~26 rows (approximately)
DELETE FROM `global_mesin`;
/*!40000 ALTER TABLE `global_mesin` DISABLE KEYS */;
INSERT INTO `global_mesin` (`id_bm`, `nama_bm`, `jns_bm`, `no_bm`, `kapasitas`, `satuan`, `lokasi`) VALUES
	(1, 'Tidak ada', 'Tidak ada', 'Tidak ada', 0, 'Tidak ada', 'Tidak ada'),
	(2, 'Ball Mill 200  kg', '200 kg', '1', 200, 'kg', ''),
	(3, 'Ball Mill 200  kg', '200 kg', '2', 200, 'kg', ''),
	(4, 'Ball Mill 200  kg', '200 kg', '3', 200, 'kg', ''),
	(5, 'Ball Mill 200  kg', '200 kg', '4', 200, 'kg', ''),
	(6, 'Ball Mill 500  kg', '500 kg', '1', 500, 'kg', ''),
	(7, 'Ball Mill 500  kg', '500 kg', '2', 500, 'kg', ''),
	(8, 'Ball Mill 500  kg', '500 kg', '3', 500, 'kg', ''),
	(9, 'Ball Mill 500  kg', '500 kg', '4', 500, 'kg', ''),
	(10, 'Ball Mill 500  kg', '500 kg', '5', 500, 'kg', ''),
	(11, 'Ball Mill 500  kg', '500 kg', '6', 500, 'kg', ''),
	(12, 'Ball Mill 500  kg', '500 kg', '7', 500, 'kg', ''),
	(13, 'Ball Mill 500  kg', '500 kg', '8', 500, 'kg', ''),
	(14, 'Ball Mill 500  kg', '500 kg', '9', 500, 'kg', ''),
	(15, 'Ball Mill 500  kg', '500 kg', '10', 500, 'kg', ''),
	(16, 'Ball Mill 2 ton', '2 ton', '1', 2000, 'kg', ''),
	(17, 'Ball Mill 2 ton', '2 ton', '2', 2000, 'kg', ''),
	(18, 'Ball Mill 2 ton', '2 ton', '3', 2000, 'kg', ''),
	(19, 'Ball Mill 3 ton', '3 ton', '1', 3000, 'kg', ''),
	(20, 'Ball Mill 3 ton', '3 ton', '5', 3000, 'kg', ''),
	(21, 'Ball Mill 3 ton', '3 ton', 'P3', 3000, 'kg', ''),
	(22, 'Glasir Dipping 1', 'Glasir Dipping', '1', 0, 'ppj', ''),
	(23, 'Glasir Konveyer 1', 'Glasir Konveyer', '1', 0, 'ppj', ''),
	(24, 'Glasir Mesin 1', 'Glasir Mesin', '1', 0, 'ppj', ''),
	(25, 'Glasir Spray 1', 'Glasir Spray', '1', 0, 'ppj', ''),
	(26, 'Glasir Waterfall 1', 'Glasir Waterfall ', '1', 0, 'ppj', '');
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


-- Dumping structure for trigger inventory.glasir_add_stok
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `glasir_add_stok` AFTER INSERT ON `glasir_phd` FOR EACH ROW BEGIN 
UPDATE glasir 
SET stok_awal = stok_awal + NEW.volume
WHERE
id_glasir = NEW.id_glasir;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;


-- Dumping structure for trigger inventory.glasir_add_stok_tran
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `glasir_add_stok_tran` BEFORE DELETE ON `glasir_thd` FOR EACH ROW BEGIN 
UPDATE glasir 
SET stok_awal = stok_awal + OLD.volume
WHERE
id_glasir = OLD.id_glasir;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;


-- Dumping structure for trigger inventory.glasir_min_stok
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `glasir_min_stok` BEFORE DELETE ON `glasir_phd` FOR EACH ROW BEGIN 
UPDATE glasir 
SET stok_awal = stok_awal - OLD.volume
WHERE
id_glasir = OLD.id_glasir;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;


-- Dumping structure for trigger inventory.glasir_min_stok_tran
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `glasir_min_stok_tran` AFTER INSERT ON `glasir_thd` FOR EACH ROW BEGIN 
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
