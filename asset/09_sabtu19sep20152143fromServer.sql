-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               5.5.16 - MySQL Community Server (GPL)
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

-- Dumping data for table inventory.admins: ~4 rows (approximately)
DELETE FROM `admins`;
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` (`username`, `password`, `nama_lengkap`, `level`, `blokir`, `foto`) VALUES
	('admin', '21232f297a57a5a743894a0e4a801fc3', 'Administrator', '01', 'N', 'admin.jpg'),
	('rifqi', '9284e0ff53e24a17c0e6e4e91a1e1ee1', 'Rifqi Sufra', '01', 'N', ''),
	('rosmiati', '9284e0ff53e24a17c0e6e4e91a1e1ee1', 'Rosmiati', '01', 'N', ''),
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

-- Dumping data for table inventory.ci_sessions: ~1 rows (approximately)
DELETE FROM `ci_sessions`;
/*!40000 ALTER TABLE `ci_sessions` DISABLE KEYS */;
INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
	('3d588d4b67647f7993d85c7c52377092', '192.168.2.1', 'Mozilla/5.0 (Windows NT 6.1; rv:40.0) Gecko/20100101 Firefox/40.0', 1442670661, 'a:6:{s:9:"user_data";s:0:"";s:9:"logged_in";s:13:"aingLoginYeuh";s:8:"username";s:5:"admin";s:12:"nama_lengkap";s:13:"Administrator";s:4:"foto";s:9:"admin.jpg";s:5:"level";s:2:"01";}');
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
  `s_bgps` decimal(10,2) NOT NULL,
  `s_supply` decimal(10,2) NOT NULL,
  `inputer` varchar(50) NOT NULL,
  `tgl_input` datetime NOT NULL,
  `tgl_update` datetime NOT NULL,
  `deleted` smallint(1) DEFAULT NULL,
  PRIMARY KEY (`id_glasir`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table inventory.glasir: ~287 rows (approximately)
DELETE FROM `glasir`;
/*!40000 ALTER TABLE `glasir` DISABLE KEYS */;
INSERT INTO `glasir` (`id_glasir`, `nama_glasir`, `nama_alias`, `satuan`, `status`, `s_bgps`, `s_supply`, `inputer`, `tgl_input`, `tgl_update`, `deleted`) VALUES
	('Y0001', '0202 Blue', '', 'Kilogram', '1', 0.00, 21.22, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0002', '0202 Brown', '', 'Kilogram', '1', 0.00, 175.99, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0003', '0202 Pink', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0004', '0401 Blue', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0005', '0401 Pink', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0006', '0402 Blue', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0007', '5100 Chocolate', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0008', '5101 Clay', '', 'Kilogram', '1', 176.88, 53.60, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0009', '5102 Spruce', '', 'Kilogram', '1', 0.00, 40.06, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0010', '5300 Summer', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0011', '8034 Graphite', '', 'Kilogram', '1', 580.13, 50.24, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0012', '8040 Cream', '', 'Kilogram', '1', 0.00, 161.98, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0013', '8045 Raspberry', '', 'Kilogram', '1', 0.00, 126.08, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0014', '8046 Chocolate', '', 'Kilogram', '1', 177.72, 231.34, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0015', '8049 Suede', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0016', '8050 Indigo Blue', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0017', '8050 Indigo Blue Shiny', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0018', '8051 Green Forest', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0019', '8052 Brown', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0020', '8052 Brown Shiny', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0021', '8053 Slate', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0022', '8053 Slate Shiny', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0023', '8059 Moss', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0024', '8059 Moss Shiny', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0025', '8065 Mustard', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0026', '8067 Burgundy', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0027', '8067 Burgundy Shiny', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0028', '8079 Blue', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0029', '8082 Green', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0030', '8083 Yellow', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0031', '8090 White', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0032', '8092 Teracota', '', 'Kilogram', '1', 324.50, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0033', '8093 Turquoise', '', 'Kilogram', '1', 0.00, 152.53, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0034', '8094 Apple', '', 'Kilogram', '1', 0.00, 111.06, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0035', '8096 Blue', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0036', '8097 Green', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0037', '8098 Plum', '', 'Kilogram', '1', 153.37, 31.64, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0038', '8099 Ice Blue', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0039', '8170 Blue', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0040', '8170 Green', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0041', '8483 Grey', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0042', '8484 Blue', '', 'Kilogram', '1', 163.86, 247.13, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0043', '8485 Green', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0044', '8486 Purple', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0045', '8491 Yellow', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0046', 'A7 Reactive', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0047', 'Andante Brown', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0048', 'Andante Gloss', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0049', 'Andante Lime Green', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0050', 'Andante Red', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0051', 'Andante Turquoise', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0052', 'Andante White', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0053', 'Anis Green', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0054', 'Antique White', '', 'Kilogram', '1', 1085.42, 691.98, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0055', 'Barella Blue Ice', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0056', 'Barella Cafe Latte', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0057', 'Barella French Vanilla', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0058', 'Bastide Brown', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0059', 'Beige Light', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0060', 'Black', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0061', 'Black BOB', '', 'Kilogram', '1', 150.01, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0062', 'Black Migros', '', 'Kilogram', '1', 269.96, 211.67, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0063', 'Black Noir', '', 'Kilogram', '1', 0.00, 545.97, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0064', 'Black STN', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0065', 'Black Stone', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0066', 'Blue', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0067', 'Blue 8170', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0068', 'Blue Contempo', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0069', 'Blue Ice', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0070', 'Blue Maison', '', 'Kilogram', '1', 323.11, 236.63, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0071', 'Brown', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0072', 'Brown Orchid', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0073', 'Brown Orchid New', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0074', 'Brown Stitch', '', 'Kilogram', '1', 0.00, 352.83, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0075', 'Clay', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0076', 'Clay 1044', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0077', 'Combee', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0078', 'Cool Grey 11 C', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0079', 'Cream', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0080', 'Cream Colorvara', '', 'Kilogram', '1', 308.04, 45.11, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0081', 'Cream JCC', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0082', 'Cream Orchid', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0083', 'Dark Brown Unitable', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0084', 'Dark Grey', '', 'Kilogram', '1', 141.60, 366.53, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0085', 'Dark Grey Ltb', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0086', 'Dark Heather 5135C (Pantone 258C)', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0087', 'Dark Orange', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0088', 'Debenham Cream', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0089', 'Dove Grey', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0090', 'Erde Navy', '', 'Kilogram', '1', 472.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0091', 'Erde White', '', 'Kilogram', '1', 68.08, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0092', 'Fronside Kona', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0093', 'Gloss', '', 'Kilogram', '1', 2398.95, 150.08, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0094', 'Gloss Epi', 'Glose Epi', 'Kilogram', '1', 524.12, 711.84, 'admin', '2015-09-17 10:48:08', '2015-09-17 08:04:44', 0),
	('Y0095', 'Gloss ICS', '', 'Kilogram', '1', 454.81, 59.34, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0096', 'GOG', '', 'Kilogram', '1', 184.04, 41.38, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0097', 'Graphite', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0098', 'Green', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0099', 'Green 8170', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0100', 'Green Bali', '', 'Kilogram', '1', 87.33, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0101', 'Green Leaves', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0102', 'Green Semi Matte', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0103', 'Green Ubud', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0104', 'Gres Fermier', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0105', 'Gress Fermier Grey', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0106', 'Gress Fermier Moss', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0107', 'Grey', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0108', 'Grey JCC', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0109', 'Grey1043', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0110', 'Ice Blue', '', 'Kilogram', '1', 139.91, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0111', 'Iittala Apple Red', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0112', 'Iittala Edelweish', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0113', 'Iittala Graphite', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0114', 'Iittala Pale Rose', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0115', 'Iittala Sand Glossy', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0116', 'Iittala White Glossy', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0117', 'Kaolin White', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0118', 'Lava White', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0119', 'Lavender', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0120', 'Light 8050 Indigo Blue', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0121', 'Light 8052 Brown', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0122', 'Light 8053 Slate', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0123', 'Light 8059 Moss', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0124', 'Light 8067 Burgundy', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0125', 'Light Grey', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0126', 'Light Grey Ltb', '', 'Kilogram', '1', 342.74, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0127', 'Lilac', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0128', 'Lohan Black', '', 'Kilogram', '1', 17.77, 348.06, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0129', 'Migros Dark Blue', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0130', 'Migros Dark Orange', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0131', 'Mikasa Cream', '', 'Kilogram', '1', 385.93, 347.80, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0132', 'Mocca', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0133', 'Narumi Cream', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0134', 'Ocean Blue', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0135', 'Oneida Green', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0136', 'Orange', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0137', 'P 5555C', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0138', 'Panama Falabella', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0139', 'Pantone 137 C/ Org', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0140', 'Picasso Rouge', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0141', 'Picasso Yellow', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0142', 'Pink', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0143', 'Pink Broderie', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0144', 'Pink Maison', '', 'Kilogram', '1', 224.42, 420.59, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0145', 'Pink Serena', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0146', 'Porcini Oneida', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0147', 'Purple Beneton', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0148', 'Purple Burgundi', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0149', 'Purple Light', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0150', 'Purple Serena', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0151', 'Reactive Brown', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0152', 'Reactive Green', '', 'Kilogram', '1', 0.00, 34.66, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0153', 'Reactive Orange', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0154', 'Reactive Red', '', 'Kilogram', '1', 146.14, 308.74, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0155', 'Reactive Yellow', '', 'Kilogram', '1', 0.00, 97.66, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0156', 'Red', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0157', 'Red Beneton', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0158', 'Red Chilli', '', 'Kilogram', '1', 806.82, 576.61, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0159', 'Red Coble', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0160', 'Red Lohan', '', 'Kilogram', '1', 0.00, 239.95, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0161', 'Red Small Tube', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0162', 'Savana Meil', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0163', 'Savanah', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0164', 'Savanah 3', '', 'Kilogram', '1', 145.23, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0165', 'Savanah Meil', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0166', 'Savanah Noritake', '', 'Kilogram', '1', 0.00, 131.46, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0167', 'Slate', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0168', 'Spice Cayenne', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0169', 'Spice Cilantro', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0170', 'Spice Saffron', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0171', 'Sudo Blue', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0172', 'Tarrerias Griss', '', 'Kilogram', '1', 295.92, 686.76, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0173', 'Tarrerias Grey', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0174', 'Taupe', '', 'Kilogram', '1', 0.00, 761.62, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0175', 'Taupe EMC', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0176', 'Ter Lichen', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0177', 'Terrarias Red', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0178', 'Terre Dombre', '', 'Kilogram', '1', 840.72, 219.57, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0179', 'TOT', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0180', 'Turquoise', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0181', 'Turquoise Matt', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0182', 'Turquoise Serena', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0183', 'Upper Lava D1/2', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0184', 'Upper White Verceral', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0185', 'Warm Grey Colorama', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0186', 'WB Cream', 'Winter Berry', 'Kilogram', '1', 533.47, 553.09, 'admin', '2015-09-17 10:48:08', '2015-09-17 07:38:21', 0),
	('Y0187', 'WB Pink', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0188', 'WB Powder Blue', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0189', 'WB Sage Green', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0190', 'White', '', 'Kilogram', '1', 0.00, -92.18, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0191', 'White Glossy', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0192', 'White Kaolin', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0193', 'White Peptapon', '', 'Kilogram', '1', 0.00, 207.92, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0194', 'Yellow', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0195', 'Yellow C', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0196', 'Yellow Kuta', '', 'Kilogram', '1', 209.78, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0197', 'Yellow Serena', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 10:48:08', '2015-09-17 10:48:08', 0),
	('Y0198', 'Gloss Waterfall', 'Glose Waterfall', 'Kilogram', '1', 302.72, 493.46, 'admin', '2015-09-17 07:28:34', '2015-09-17 07:42:34', 0),
	('Y0199', 'White Mesin Spray', '', 'Kilogram', '1', 447.68, 214.94, 'admin', '2015-09-17 07:29:04', '0000-00-00 00:00:00', 0),
	('Y0200', 'ADF Kaolin', '', 'Kilogram', '1', 0.00, 358.60, 'admin', '2015-09-17 07:30:38', '0000-00-00 00:00:00', 0),
	('Y0201', 'White Waterfall', '', 'Kilogram', '1', 1742.51, 785.76, 'admin', '2015-09-17 07:31:37', '0000-00-00 00:00:00', 0),
	('Y0202', 'Turquoise Blue', '', 'Kilogram', '1', 739.31, 21.91, 'admin', '2015-09-17 07:33:29', '0000-00-00 00:00:00', 0),
	('Y0203', 'Strong Brown', '', 'Kilogram', '1', 233.44, 0.00, 'admin', '2015-09-17 07:34:03', '0000-00-00 00:00:00', 0),
	('Y0204', 'Sanibel Green', '', 'Kilogram', '1', 128.72, 24.26, 'admin', '2015-09-17 07:35:16', '0000-00-00 00:00:00', 0),
	('Y0205', 'Semangat Cream', '', 'Kilogram', '1', 0.00, 269.49, 'admin', '2015-09-17 07:35:58', '0000-00-00 00:00:00', 0),
	('Y0206', 'Red Flory', '', 'Kilogram', '1', 0.00, 273.64, 'admin', '2015-09-17 07:36:58', '0000-00-00 00:00:00', 0),
	('Y0207', 'Light Grey (Barbier)', '', 'Kilogram', '1', 0.00, 296.64, 'admin', '2015-09-17 07:39:40', '0000-00-00 00:00:00', 0),
	('Y0208', 'Light Grey (Hammered)', '', 'Kilogram', '1', 0.00, 39.19, 'admin', '2015-09-17 07:41:09', '0000-00-00 00:00:00', 0),
	('Y0209', 'Light Grey (Bastide)', '', 'Kilogram', '1', 0.00, 27.17, 'admin', '2015-09-17 07:41:44', '0000-00-00 00:00:00', 0),
	('Y0210', 'Colour Vara Green', 'Colorvara Green', 'Kilogram', '1', 0.00, 114.56, 'admin', '2015-09-17 07:43:58', '2015-09-17 07:45:25', 0),
	('Y0211', 'Engobe', '', 'Kilogram', '1', 0.00, 116.75, 'admin', '2015-09-17 07:44:21', '0000-00-00 00:00:00', 0),
	('Y0212', 'R/D Navy Blue', '', 'Kilogram', '1', 0.00, 20.35, 'admin', '2015-09-17 07:46:07', '0000-00-00 00:00:00', 0),
	('Y0213', '8484 (Mug)', '', 'Kilogram', '1', 0.00, 21.03, 'admin', '2015-09-17 07:46:30', '0000-00-00 00:00:00', 0),
	('Y0214', 'RD Blue', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 07:47:18', '0000-00-00 00:00:00', 0),
	('Y0215', '8485 (Mug)', '', 'Kilogram', '1', 0.00, 21.22, 'admin', '2015-09-17 07:47:50', '0000-00-00 00:00:00', 0),
	('Y0216', 'FUU Colour 5300', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 07:57:18', '0000-00-00 00:00:00', 0),
	('Y0217', 'Royal Orchid', '', 'Kilogram', '1', 0.00, 452.22, 'admin', '2015-09-17 07:57:51', '0000-00-00 00:00:00', 0),
	('Y0218', 'Purple', '', 'Kilogram', '1', 0.00, 223.90, 'admin', '2015-09-17 07:58:14', '0000-00-00 00:00:00', 0),
	('Y0219', 'Havana Orange', '', 'Kilogram', '1', 0.00, 82.63, 'admin', '2015-09-17 07:59:14', '0000-00-00 00:00:00', 0),
	('Y0220', 'Black Fortessa', '', 'Kilogram', '1', 0.00, 103.60, 'admin', '2015-09-17 08:04:24', '0000-00-00 00:00:00', 0),
	('Y0221', 'Antique Waterfall', '', 'Kilogram', '1', 0.00, 488.28, 'admin', '2015-09-17 08:05:31', '0000-00-00 00:00:00', 0),
	('Y0222', 'ADF Kaolin Waterfall', '', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-17 08:05:58', '0000-00-00 00:00:00', 0),
	('Y0223', 'Grey Porcini', '', 'Kilogram', '1', 0.00, 418.79, 'admin', '2015-09-17 08:08:15', '0000-00-00 00:00:00', 0),
	('Y0224', 'Serena Turquise Amanda', '', 'Kilogram', '1', 0.00, 108.92, 'admin', '2015-09-17 08:08:58', '0000-00-00 00:00:00', 0),
	('Y0225', 'Cressy', '', 'Kilogram', '1', 0.00, 378.03, 'admin', '2015-09-17 08:10:02', '0000-00-00 00:00:00', 0),
	('Y0226', 'Savanah Radial', '', 'Kilogram', '1', 0.00, 173.48, 'admin', '2015-09-17 08:10:26', '0000-00-00 00:00:00', 0),
	('Y0227', 'Royal Orchid (CMC)', '', 'Kilogram', '1', 0.00, 95.78, 'admin', '2015-09-17 08:13:01', '0000-00-00 00:00:00', 0),
	('Y0228', 'Cressy Mix 1:1', '', 'Kilogram', '1', 0.00, 104.04, 'admin', '2015-09-17 08:14:02', '0000-00-00 00:00:00', 0),
	('Y0229', '8170 Green Instant', '', 'Kilogram', '1', 0.00, 93.90, 'admin', '2015-09-17 08:14:47', '0000-00-00 00:00:00', 0),
	('Y0230', 'Panama Mug', '', 'Kilogram', '1', 0.00, 211.90, 'admin', '2015-09-17 08:15:14', '0000-00-00 00:00:00', 0),
	('Y0231', 'White Mesin Spray (Exp)', '', 'Kilogram', '1', 0.00, 141.23, 'admin', '2015-09-17 08:16:00', '0000-00-00 00:00:00', 0),
	('Y0232', 'Gloss Mesin Spray (CMC)', '', 'Kilogram', '1', 185.92, 71.99, 'admin', '2015-09-17 08:16:53', '2015-09-17 08:16:58', 0),
	('Y0233', 'NON', 'Navy O Navy', 'Kilogram', '1', 0.00, 0.00, 'admin', '2015-09-19 07:16:01', '0000-00-00 00:00:00', 0);
/*!40000 ALTER TABLE `glasir` ENABLE KEYS */;


-- Dumping structure for table inventory.glasir_oh
CREATE TABLE IF NOT EXISTS `glasir_oh` (
  `no_prod` char(15) NOT NULL,
  `inputer` varchar(50) NOT NULL,
  `tgl_inp` datetime NOT NULL,
  `lst_upd` datetime NOT NULL,
  `deleted` smallint(1) DEFAULT NULL,
  PRIMARY KEY (`no_prod`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table inventory.glasir_oh: ~10 rows (approximately)
DELETE FROM `glasir_oh`;
/*!40000 ALTER TABLE `glasir_oh` DISABLE KEYS */;
INSERT INTO `glasir_oh` (`no_prod`, `inputer`, `tgl_inp`, `lst_upd`, `deleted`) VALUES
	('OB00001', 'admin', '2015-09-17 11:24:06', '0000-00-00 00:00:00', NULL),
	('OB00002', 'admin', '2015-09-17 11:45:29', '0000-00-00 00:00:00', NULL),
	('OB00003', 'admin', '2015-09-18 08:11:28', '0000-00-00 00:00:00', NULL),
	('OB00004', 'admin', '2015-09-18 08:41:01', '0000-00-00 00:00:00', NULL),
	('OB00005', 'admin', '2015-09-18 08:46:07', '0000-00-00 00:00:00', NULL),
	('OB00006', 'admin', '2015-09-18 09:54:45', '0000-00-00 00:00:00', NULL),
	('OB00007', 'admin', '2015-09-18 10:06:49', '0000-00-00 00:00:00', NULL),
	('OB00008', 'admin', '2015-09-18 10:16:38', '0000-00-00 00:00:00', NULL),
	('OB00009', 'admin', '2015-09-18 10:29:47', '0000-00-00 00:00:00', NULL),
	('OB00010', 'admin', '2015-09-18 11:15:35', '0000-00-00 00:00:00', NULL);
/*!40000 ALTER TABLE `glasir_oh` ENABLE KEYS */;


-- Dumping structure for table inventory.glasir_ohd
CREATE TABLE IF NOT EXISTS `glasir_ohd` (
  `idthd` smallint(6) NOT NULL AUTO_INCREMENT,
  `no_prod` char(15) NOT NULL,
  `id_glasir` varchar(50) NOT NULL,
  `shift` smallint(6) NOT NULL,
  `id_bm` smallint(6) NOT NULL,
  `dsc` varchar(255) NOT NULL,
  `area` varchar(255) NOT NULL,
  `volume` double NOT NULL,
  `densitas` double NOT NULL,
  `sts` double NOT NULL,
  `bkg` double NOT NULL,
  `selisih` double NOT NULL,
  `vsc` double NOT NULL,
  `inputer` varchar(50) NOT NULL,
  `petugas` varchar(50) NOT NULL,
  `tgl` date NOT NULL,
  `tglp` date NOT NULL,
  `tglb` date NOT NULL,
  `jam` time NOT NULL,
  `tgl_insert` datetime NOT NULL,
  `deleted` smallint(1) NOT NULL,
  PRIMARY KEY (`idthd`),
  KEY `FK_glasir_ohd_glasir_oh` (`no_prod`),
  KEY `FK_glasir_ohd_glasir` (`id_glasir`),
  KEY `FK_glasir_ohd_admins` (`inputer`),
  KEY `FK_glasir_ohd_global_shift` (`shift`),
  KEY `FK_glasir_ohd_global_mesin` (`id_bm`),
  CONSTRAINT `FK_glasir_ohd_admins` FOREIGN KEY (`inputer`) REFERENCES `admins` (`username`),
  CONSTRAINT `FK_glasir_ohd_glasir` FOREIGN KEY (`id_glasir`) REFERENCES `glasir` (`id_glasir`),
  CONSTRAINT `FK_glasir_ohd_glasir_oh` FOREIGN KEY (`no_prod`) REFERENCES `glasir_oh` (`no_prod`),
  CONSTRAINT `FK_glasir_ohd_global_mesin` FOREIGN KEY (`id_bm`) REFERENCES `global_mesin` (`id_bm`),
  CONSTRAINT `FK_glasir_ohd_global_shift` FOREIGN KEY (`shift`) REFERENCES `global_shift` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=181 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table inventory.glasir_ohd: ~175 rows (approximately)
DELETE FROM `glasir_ohd`;
/*!40000 ALTER TABLE `glasir_ohd` DISABLE KEYS */;
INSERT INTO `glasir_ohd` (`idthd`, `no_prod`, `id_glasir`, `shift`, `id_bm`, `dsc`, `area`, `volume`, `densitas`, `sts`, `bkg`, `selisih`, `vsc`, `inputer`, `petugas`, `tgl`, `tglp`, `tglb`, `jam`, `tgl_insert`, `deleted`) VALUES
	(2, 'OB00001', 'Y0095', 3, 15, '', '2', 295, 1674, 0, 0, 311.16895, 0, 'admin', 'Zainuddin', '2015-09-16', '2015-09-11', '2015-09-13', '14:00:00', '2015-09-17 11:24:06', 0),
	(3, 'OB00002', 'Y0158', 2, 1, '', '3', 140, 1590, 0, 0, 129.26899999999998, 0, 'admin', 'Zainudin', '2015-09-16', '2015-08-20', '2015-08-23', '14:00:00', '2015-09-17 11:45:29', 0),
	(4, 'OB00002', 'Y0074', 3, 1, '', '3', 140, 1520, 0, 0, 113.932, 0, 'admin', 'Zainudin', '2015-09-16', '2015-07-27', '2015-07-29', '14:00:00', '2015-09-18 07:12:17', 0),
	(5, 'OB00002', 'Y0155', 3, 1, '', '3', 120, 1520, 0, 0, 97.65599999999999, 0, 'admin', 'Zainudin', '2015-09-16', '2015-09-11', '2015-09-13', '14:00:00', '2015-09-18 07:14:29', 0),
	(6, 'OB00002', 'Y0144', 3, 12, '', '3', 190, 1633, 0, 0, 188.22255, 0, 'admin', 'Zainudin', '2015-09-16', '2015-09-08', '2015-09-10', '14:00:00', '2015-09-18 07:17:24', 0),
	(7, 'OB00002', 'Y0063', 3, 13, '', '3', 190, 1580, 0, 0, 172.463, 0, 'admin', 'Zainudin', '2015-09-16', '2015-09-05', '2015-09-07', '14:00:00', '2015-09-18 07:18:22', 0),
	(8, 'OB00002', 'Y0154', 3, 17, '', '3', 160, 1547, 0, 0, 136.9688, 0, 'admin', 'Zainudin', '2015-09-16', '2015-08-27', '2015-08-29', '14:00:00', '2015-09-18 07:19:42', 0),
	(9, 'OB00002', 'Y0205', 3, 19, '', '3', 100, 1476, 0, 0, 74.494, 0, 'admin', 'Zainudin', '2015-09-16', '2015-09-06', '2015-09-08', '14:00:00', '2015-09-18 07:20:55', 0),
	(10, 'OB00002', 'Y0095', 3, 15, '', '3', 120, 1316, 0, 0, 59.3448, 0, 'admin', 'Zainudin', '2015-09-16', '2015-08-19', '2015-09-21', '14:00:00', '2015-09-18 07:24:39', 0),
	(11, 'OB00002', 'Y0158', 3, 15, '', '3', 340, 1614, 129.27, 0, 197.43939999999995, 0, 'admin', 'Zainudin', '2015-09-16', '2015-08-21', '2015-09-23', '14:00:00', '2015-09-18 07:31:26', 0),
	(12, 'OB00002', 'Y0186', 3, 5, '', '3', 190, 1600, 0, 0, 178.41, 0, 'admin', 'Zainudin', '2015-09-16', '2015-09-09', '2015-09-11', '14:00:00', '2015-09-18 07:33:21', 0),
	(13, 'OB00002', 'Y0063', 3, 13, '', '3', 310, 1584, 172.46, 0, 110.86759999999995, 0, 'admin', 'Zainudin', '2015-09-16', '2015-09-05', '2015-09-08', '14:00:00', '2015-09-18 07:36:37', 0),
	(14, 'OB00002', 'Y0074', 3, 9, '', '3', 270, 1565, 113.93, 0, 124.81074999999998, 0, 'admin', 'Zainudin', '2015-09-16', '2015-07-27', '2015-07-29', '14:00:00', '2015-09-18 07:39:55', 0),
	(15, 'OB00002', 'Y0200', 3, 2, '', '3', 80, 1502, 0, 0, 62.85039999999999, 0, 'admin', 'Zainudin', '2015-09-16', '2015-08-24', '2015-08-26', '14:00:00', '2015-09-18 07:42:37', 0),
	(16, 'OB00002', 'Y0206', 3, 1, '', '3', 50, 1545, 0, 0, 42.64625, 0, 'admin', 'Zainudin', '2015-09-16', '2015-05-18', '2015-05-20', '14:00:00', '2015-09-18 07:43:32', 0),
	(17, 'OB00002', 'Y0131', 3, 15, '', '3', 200, 1485, 0, 0, 151.80499999999998, 0, 'admin', 'Zainudin', '2015-09-16', '2015-08-24', '2015-08-26', '14:00:00', '2015-09-18 07:45:00', 0),
	(18, 'OB00002', 'Y0063', 3, 12, '', '3', 510, 1591, 283.33, 0, 188.37664999999998, 0, 'admin', 'Zainudin', '2015-09-16', '2015-08-29', '2015-08-31', '14:00:00', '2015-09-18 07:48:02', 0),
	(19, 'OB00002', 'Y0174', 3, 5, '', '3', 170, 1618, 0, 0, 164.4189, 0, 'admin', 'Zainudin', '2015-09-16', '2015-09-01', '2015-08-03', '14:00:00', '2015-09-18 07:49:47', 0),
	(20, 'OB00002', 'Y0131', 3, 5, '', '3', 400, 1555, 151.8, 0, 195.63000000000005, 0, 'admin', 'Zainudin', '2015-09-16', '2015-08-26', '2015-08-28', '14:00:00', '2015-09-18 07:53:01', 0),
	(21, 'OB00002', 'Y0186', 3, 5, '', '3', 410, 1595, 178.41, 0, 203.37175, 0, 'admin', 'Zainudin', '2015-09-16', '2015-09-09', '2015-09-11', '14:00:00', '2015-09-18 07:55:38', 0),
	(22, 'OB00003', 'Y0186', 3, 5, 'P', '3', 590, 1599, 381.78, 0, 171.30665, 0, 'admin', 'Zainudin', '2015-09-16', '2015-09-09', '2015-09-11', '14:00:00', '2015-09-18 08:11:28', 0),
	(23, 'OB00003', 'Y0207', 3, 17, 'P', '3', 160, 1560, 0, 0, 140.22400000000002, 0, 'admin', 'Zainudin', '2015-09-16', '2015-08-31', '2015-09-02', '14:00:00', '2015-09-18 08:13:08', 0),
	(24, 'OB00003', 'Y0207', 3, 11, 'Aging 6 Jam', '3', 360, 1585, 140.22, 0, 189.369, 0, 'admin', 'Zainudin', '2015-09-16', '2015-09-04', '2015-09-06', '14:00:00', '2015-09-18 08:19:32', 0),
	(25, 'OB00003', 'Y0070', 3, 24, 'Instant', '3', 160, 1570, 0, 0, 142.72799999999998, 0, 'admin', 'Zainudin', '2015-09-16', '0000-00-00', '2015-08-19', '14:00:00', '2015-09-18 08:20:48', 0),
	(26, 'OB00003', 'Y0207', 3, 11, 'P', '3', 530, 1537, 329.59, 0, 115.82465000000008, 0, 'admin', 'Zainudin', '2015-09-16', '2015-09-04', '2015-09-06', '14:00:00', '2015-09-18 08:23:32', 0),
	(27, 'OB00003', 'Y0193', 3, 1, 'P', '3', 200, 1454, 0, 0, 142.102, 0, 'admin', 'Zainudin', '2015-09-16', '2015-08-28', '2015-08-30', '14:00:00', '2015-09-18 08:26:28', 0),
	(28, 'OB00003', 'Y0193', 3, 1, 'P', '3', 400, 1509, 142.1, 0, 176.53400000000002, 0, 'admin', 'Zainudin', '2015-09-16', '2015-08-31', '2015-09-02', '15:00:00', '2015-09-18 08:28:03', 0),
	(29, 'OB00003', 'Y0208', 3, 1, 'P Stainless', '3', 80, 1313, 0, 0, 39.187599999999996, 0, 'admin', 'Zainudin', '2015-09-16', '2015-08-08', '2015-08-10', '15:00:00', '2015-09-18 08:29:02', 0),
	(30, 'OB00003', 'Y0209', 3, 1, 'P Stainless', '3', 40, 1434, 0, 0, 27.1684, 0, 'admin', 'Zainudin', '2015-09-16', '2015-08-31', '2015-09-02', '15:00:00', '2015-09-18 08:30:24', 0),
	(31, 'OB00003', 'Y0094', 3, 1, 'P Stainless', '3', 100, 1446, 0, 0, 69.799, 0, 'admin', 'Zainudin', '2015-09-16', '0000-00-00', '0000-00-00', '15:00:00', '2015-09-18 08:31:11', 0),
	(32, 'OB00003', 'Y0063', 3, 1, 'P Stainless', '3', 610, 1556, 471.71, 0, 59.0754, 0, 'admin', 'Zainudin', '2015-09-16', '0000-00-00', '0000-00-00', '15:00:00', '2015-09-18 08:33:45', 0),
	(33, 'OB00003', 'Y0172', 3, 1, 'Stainless', '3', 40, 1469, 0, 0, 29.359399999999994, 0, 'admin', 'Zainudin', '2015-09-16', '0000-00-00', '0000-00-00', '15:00:00', '2015-09-18 08:35:57', 0),
	(34, 'OB00003', 'Y0152', 3, 23, 'Stainless', '3', 50, 1443, 0, 0, 34.66475, 0, 'admin', 'Zainudin', '2015-09-16', '2015-09-07', '2015-09-09', '15:00:00', '2015-09-18 08:36:41', 0),
	(35, 'OB00003', 'Y0198', 3, 5, 'Stainless', '3', 270, 1673, 0, 0, 284.37615, 0, 'admin', 'Sisa Konveyer', '2015-09-16', '2015-09-06', '2015-09-08', '15:00:00', '2015-09-18 08:37:40', 0),
	(36, 'OB00004', 'Y0160', 3, 13, 'P', '3', 20, 1720, 0, 0, 22.536, 0, 'admin', 'Zainudin', '2015-09-16', '2015-08-25', '2015-09-27', '05:00:00', '2015-09-18 08:41:01', 0),
	(37, 'OB00004', 'Y0033', 3, 8, 'P', '3', 20, 1744, 0, 0, 23.287200000000002, 0, 'admin', 'Zainudin', '2015-09-16', '2015-08-27', '2015-09-29', '05:00:00', '2015-09-18 08:41:52', 0),
	(38, 'OB00005', 'Y0144', 3, 12, 'P', '3', 210, 1645, 188.22, 0, 23.75925000000001, 0, 'admin', 'Zainudin', '2015-09-16', '2015-09-04', '2015-09-06', '14:00:00', '2015-09-18 08:46:07', 0),
	(39, 'OB00005', 'Y0158', 3, 2, 'P', '3', 380, 1628, 326.71, 0, 46.76159999999999, 0, 'admin', 'Zainudin', '2015-09-16', '2015-08-21', '2015-08-23', '14:00:00', '2015-09-18 08:50:08', 0),
	(40, 'OB00005', 'Y0200', 3, 2, 'P', '3', 210, 1682, 62.85, 0, 161.28930000000003, 0, 'admin', 'Zainudin', '2015-09-16', '2015-08-21', '2015-08-23', '14:00:00', '2015-09-18 08:53:11', 0),
	(41, 'OB00005', 'Y0008', 3, 2, '', '3', 50, 1685, 0, 0, 53.60125, 0, 'admin', 'Zainudin', '2015-09-16', '2015-08-01', '2015-08-03', '14:00:00', '2015-09-18 08:53:58', 0),
	(42, 'OB00005', 'Y0202', 3, 8, '', '3', 20, 1700, 0, 0, 21.909999999999997, 0, 'admin', 'Zainudin', '2015-09-16', '2015-08-31', '0000-00-00', '14:00:00', '2015-09-18 08:54:47', 0),
	(43, 'OB00005', 'Y0128', 3, 16, 'Test Ulang 09/09/2015', '3', 150, 1757, 0, 0, 177.70575, 0, 'admin', 'Zainudin', '2015-09-16', '2015-09-03', '2015-09-05', '14:00:00', '2015-09-18 09:02:54', 0),
	(44, 'OB00005', 'Y0128', 3, 19, '', '3', 200, 1645, 177.71, 0, 24.174999999999983, 0, 'admin', 'Zainudin', '2015-09-16', '2015-09-03', '2015-09-05', '14:00:00', '2015-09-18 09:04:54', 0),
	(45, 'OB00005', 'Y0013', 3, 19, 'Test Ulang 09/09/2015', '3', 50, 1796, 0, 0, 62.287000000000006, 0, 'admin', 'Zainudin', '2015-09-16', '2015-08-23', '2015-09-01', '14:00:00', '2015-09-18 09:05:54', 0),
	(46, 'OB00005', 'Y0160', 3, 12, 'Test Ulang 09/09/2015', '3', 100, 1746, 22.54, 116.749, 94.209, 0, 'admin', 'Zainudin', '2015-09-16', '2015-06-13', '2015-06-15', '14:00:00', '2015-09-18 09:19:01', 0),
	(47, 'OB00005', 'Y0014', 3, 16, '', '3', 100, 1701, 0, 109.70649999999999, 109.70649999999999, 0, 'admin', 'Zainudin', '2015-09-16', '2015-05-03', '2015-05-07', '14:00:00', '2015-09-18 09:27:45', 0),
	(48, 'OB00005', 'Y0042', 3, 16, '', '3', 100, 1698, 0, 109.23699999999998, 109.23699999999998, 0, 'admin', 'Zainudin', '2015-09-16', '0000-00-00', '2015-08-28', '14:00:00', '2015-09-18 09:28:31', 0),
	(49, 'OB00005', 'Y0210', 3, 12, '', '3', 100, 1732, 0, 114.558, 114.558, 0, 'admin', 'Zainudin', '2015-09-16', '0000-00-00', '2015-07-28', '14:00:00', '2015-09-18 09:29:19', 0),
	(50, 'OB00005', 'Y0204', 3, 24, '', '3', 20, 1775, 0, 24.2575, 24.2575, 0, 'admin', 'Zainudin', '2015-09-16', '2015-08-27', '2015-08-29', '14:00:00', '2015-09-18 09:30:53', 0),
	(51, 'OB00005', 'Y0178', 3, 11, '', '3', 100, 1744, 0, 116.436, 116.436, 0, 'admin', 'Zainudin', '2015-09-16', '2015-08-25', '2015-08-27', '14:00:00', '2015-09-18 09:31:35', 0),
	(52, 'OB00005', 'Y0080', 3, 19, '', '3', 20, 1728, 0, 22.786399999999997, 22.786399999999997, 0, 'admin', 'Zainudin', '2015-09-16', '2015-08-29', '2015-08-31', '14:00:00', '2015-09-18 09:33:05', 0),
	(53, 'OB00005', 'Y0012', 3, 11, '', '3', 100, 1675, 0, 105.6375, 105.6375, 0, 'admin', 'Zainudin', '2015-09-16', '2015-08-18', '2015-08-20', '14:00:00', '2015-09-18 09:35:08', 0),
	(54, 'OB00005', 'Y0211', 3, 19, '', '3', 100, 1746, 0, 116.749, 116.749, 0, 'admin', 'Zainudin', '2015-09-16', '2015-08-27', '2015-08-29', '14:00:00', '2015-09-18 09:37:39', 0),
	(55, 'OB00005', 'Y0200', 3, 1, 'Sisa Konveyer', '3', 20, 1626, 224.14, 19.593799999999998, -204.5462, 0, 'admin', 'Zainudin', '2015-09-16', '0000-00-00', '0000-00-00', '14:00:00', '2015-09-18 09:39:16', 0),
	(56, 'OB00005', 'Y0200', 3, 1, 'Sisa Konveyer', '3', 40, 1451, 224.14, 28.232599999999998, -195.9074, 0, 'admin', 'Zainudin', '2015-09-16', '0000-00-00', '0000-00-00', '14:00:00', '2015-09-18 09:39:59', 0),
	(57, 'OB00005', 'Y0034', 3, 1, 'Sisa Konveyer', '3', 20, 1660, 0, 20.657999999999998, 20.657999999999998, 0, 'admin', 'Zainudin', '2015-09-16', '0000-00-00', '0000-00-00', '14:00:00', '2015-09-18 09:40:38', 0),
	(58, 'OB00005', 'Y0063', 3, 1, 'Sisa Konveyer', '3', 20, 1485, 530.79, 15.180499999999999, -515.6094999999999, 0, 'admin', 'Zainudin', '2015-09-16', '0000-00-00', '0000-00-00', '14:00:00', '2015-09-18 09:40:59', 0),
	(59, 'OB00005', 'Y0160', 3, 1, 'Sisa Konveyer', '3', 80, 1674, 139.29, 84.3848, -54.905199999999994, 0, 'admin', 'Zainudin', '2015-09-16', '0000-00-00', '0000-00-00', '14:00:00', '2015-09-18 09:41:22', 0),
	(60, 'OB00005', 'Y0160', 3, 1, 'Sisa Konveyer', '3', 20, 1520, 139.29, 16.276, -123.014, 0, 'admin', 'Zainudin', '2015-09-16', '0000-00-00', '0000-00-00', '14:00:00', '2015-09-18 09:41:44', 0),
	(62, 'OB00005', 'Y0012', 1, 1, '', '3', 60, 1600, 105.64, 56.339999999999996, -49.300000000000004, 0, 'admin', 'Zainudin', '2015-09-16', '0000-00-00', '0000-00-00', '14:00:00', '2015-09-18 09:45:58', 0),
	(63, 'OB00005', 'Y0178', 1, 1, '', '3', 80, 1660, 116.44, 82.63199999999999, -33.80800000000001, 0, 'admin', 'Zainudin', '2015-09-16', '0000-00-00', '0000-00-00', '14:00:00', '2015-09-18 09:46:49', 0),
	(64, 'OB00005', 'Y0212', 1, 1, '', '3', 20, 1650, 0, 20.345, 20.345, 0, 'admin', 'Zainudin', '2015-09-16', '0000-00-00', '0000-00-00', '14:00:00', '2015-09-18 09:47:38', 0),
	(65, 'OB00005', 'Y0080', 1, 1, '', '3', 20, 1713, 22.79, 22.3169, -0.47309999999999874, 0, 'admin', 'Zainudin', '2015-09-16', '0000-00-00', '0000-00-00', '14:00:00', '2015-09-18 09:48:01', 0),
	(66, 'OB00005', 'Y0178', 1, 1, '', '3', 20, 1655, 199.07, 20.5015, -178.5685, 0, 'admin', 'Zainudin', '2015-09-16', '0000-00-00', '0000-00-00', '14:00:00', '2015-09-18 09:48:22', 0),
	(67, 'OB00005', 'Y0014', 1, 1, '', '3', 40, 1643, 109.71, 40.251799999999996, -69.4582, 0, 'admin', 'Zainudin', '2015-09-16', '0000-00-00', '0000-00-00', '14:00:00', '2015-09-18 09:48:40', 0),
	(68, 'OB00005', 'Y0033', 1, 1, '', '3', 20, 1640, 23.29, 20.032, -129.928, 0, 'admin', 'Zainudin', '2015-09-16', '0000-00-00', '0000-00-00', '14:00:00', '2015-09-18 09:48:57', 0),
	(69, 'OB00005', 'Y0009', 1, 1, '', '3', 40, 1640, 0, 40.064, 40.064, 0, 'admin', 'Zainudin', '2015-09-16', '0000-00-00', '0000-00-00', '14:00:00', '2015-09-18 09:49:28', 0),
	(70, 'OB00005', 'Y0213', 1, 1, '', '3', 20, 1672, 0, 21.0336, 21.0336, 0, 'admin', 'Zainudin', '2015-09-16', '0000-00-00', '0000-00-00', '14:00:00', '2015-09-18 09:49:55', 0),
	(71, 'OB00005', 'Y0037', 1, 1, '', '3', 30, 1674, 0, 31.6443, 31.6443, 0, 'admin', 'Zainudin', '2015-09-16', '0000-00-00', '0000-00-00', '14:00:00', '2015-09-18 09:50:37', 0),
	(72, 'OB00005', 'Y0033', 1, 1, '', '3', 80, 1700, 43.32, 87.63999999999999, 44.319999999999986, 0, 'admin', 'Zainudin', '2015-09-16', '0000-00-00', '0000-00-00', '14:00:00', '2015-09-18 09:50:54', 0),
	(73, 'OB00006', 'Y0033', 3, 1, 'Sisa Konveyer', '3', 20, 1689, 130.96, 21.5657, -109.39430000000002, 0, 'admin', 'Zainudin', '2015-09-16', '0000-00-00', '0000-00-00', '15:00:00', '2015-09-18 09:54:45', 0),
	(74, 'OB00006', 'Y0054', 3, 1, 'Sisa Konveyer', '3', 170, 1727, 0, 193.41834999999998, 193.41834999999998, 0, 'admin', 'Zainudin', '2015-09-16', '0000-00-00', '0000-00-00', '15:00:00', '2015-09-18 09:55:09', 0),
	(75, 'OB00006', 'Y0096', 3, 1, '', '3', 40, 1661, 0, 41.3786, 41.3786, 0, 'admin', 'Zainudin', '2015-09-16', '0000-00-00', '0000-00-00', '15:00:00', '2015-09-18 09:56:54', 0),
	(76, 'OB00006', 'Y0014', 3, 1, '', '3', 80, 1650, 149.96, 81.38, -68.58000000000001, 0, 'admin', 'Zainudin', '2015-09-16', '0000-00-00', '0000-00-00', '15:00:00', '2015-09-18 09:57:21', 0),
	(77, 'OB00006', 'Y0013', 3, 1, '', '3', 40, 1689, 62.29, 43.1314, -19.1586, 0, 'admin', 'Zainudin', '2015-09-16', '0000-00-00', '0000-00-00', '15:00:00', '2015-09-18 09:57:57', 0),
	(78, 'OB00006', 'Y0054', 3, 1, '', '3', 100, 1665, 193.42, 104.07250000000002, -89.34749999999997, 0, 'admin', 'Zainudin', '2015-09-16', '0000-00-00', '0000-00-00', '15:00:00', '2015-09-18 09:58:18', 0),
	(79, 'OB00006', 'Y0128', 3, 1, '', '3', 60, 1665, 201.89, 62.44350000000001, -139.4465, 0, 'admin', 'Zainudin', '2015-09-16', '0000-00-00', '0000-00-00', '15:00:00', '2015-09-18 09:58:36', 0),
	(80, 'OB00006', 'Y0042', 3, 1, '', '3', 80, 1640, 109.24, 80.128, -29.111999999999995, 0, 'admin', 'Zainudin', '2015-09-16', '0000-00-00', '0000-00-00', '15:00:00', '2015-09-18 09:59:10', 0),
	(81, 'OB00006', 'Y0054', 3, 1, 'Sasi Konveyer', '3', 70, 1665, 297.49, 72.85075, -224.63925, 0, 'admin', 'Zainudin', '2015-09-16', '0000-00-00', '0000-00-00', '15:00:00', '2015-09-18 09:59:36', 0),
	(82, 'OB00006', 'Y0042', 3, 1, 'Sasi Konveyer', '3', 50, 1495, 189.37, 38.73375, -150.63625000000002, 0, 'admin', 'Zainudin', '2015-09-16', '0000-00-00', '0000-00-00', '15:00:00', '2015-09-18 10:00:01', 0),
	(83, 'OB00006', 'Y0144', 3, 1, 'Sasi Konveyer', '3', 20, 1700, 211.98, 21.909999999999997, -190.07, 0, 'admin', 'Zainudin', '2015-09-16', '0000-00-00', '0000-00-00', '15:00:00', '2015-09-18 10:00:28', 0),
	(84, 'OB00006', 'Y0215', 3, 1, 'Sasi Konveyer', '3', 20, 1678, 0, 21.2214, 21.2214, 0, 'admin', 'Zainudin', '2015-09-16', '0000-00-00', '0000-00-00', '15:00:00', '2015-09-18 10:01:03', 0),
	(85, 'OB00006', 'Y0131', 3, 1, 'Sasi Konveyer', '3', 20, 1687, 347.43, 21.503100000000003, -325.9269, 0, 'admin', 'Zainudin', '2015-09-16', '0000-00-00', '0000-00-00', '15:00:00', '2015-09-18 10:01:29', 0),
	(86, 'OB00006', 'Y0034', 3, 1, 'Sasi Konveyer', '3', 20, 1683, 20.66, 21.377900000000004, 0.7179000000000038, 0, 'admin', 'Zainudin', '2015-09-16', '0000-00-00', '0000-00-00', '15:00:00', '2015-09-18 10:01:43', 0),
	(87, 'OB00006', 'Y0013', 3, 1, 'Sasi Konveyer', '3', 20, 1660, 105.42, 20.657999999999998, -84.762, 0, 'admin', 'Zainudin', '2015-09-16', '0000-00-00', '0000-00-00', '15:00:00', '2015-09-18 10:01:57', 0),
	(88, 'OB00006', 'Y0042', 3, 1, 'Sasi Konveyer', '3', 20, 1608, 228.1, 19.0304, -209.06959999999998, 0, 'admin', 'Zainudin', '2015-09-16', '0000-00-00', '0000-00-00', '15:00:00', '2015-09-18 10:02:11', 0),
	(89, 'OB00006', 'Y0054', 3, 1, 'Sasi Konveyer', '3', 90, 1668, 370.34, 94.0878, -276.25219999999996, 0, 'admin', 'Zainudin', '2015-09-16', '0000-00-00', '0000-00-00', '15:00:00', '2015-09-18 10:02:30', 0),
	(90, 'OB00006', 'Y0011', 3, 1, 'Sasi Konveyer', '3', 50, 1642, 0, 50.23649999999999, 50.23649999999999, 0, 'admin', 'Zainudin', '2015-09-16', '0000-00-00', '0000-00-00', '15:00:00', '2015-09-18 10:02:51', 0),
	(91, 'OB00007', 'Y0094', 3, 1, 'Retak', '3', 200, 1607, 69.8, 189.99099999999999, 120.19099999999999, 0, 'admin', 'zainudin', '2015-09-17', '0000-00-00', '0000-00-00', '14:00:00', '2015-09-18 10:06:49', 0),
	(92, 'OB00007', 'Y0154', 3, 1, 'Retak', '3', 80, 1562, 136.97, 70.36240000000001, -66.60759999999999, 0, 'admin', 'zainudin', '2015-09-17', '0000-00-00', '0000-00-00', '14:00:00', '2015-09-18 10:07:31', 0),
	(93, 'OB00007', 'Y0201', 3, 1, 'Retak', '3', 200, 1680, 0, 212.84, 212.84, 0, 'admin', 'zainudin', '2015-09-17', '0000-00-00', '0000-00-00', '14:00:00', '2015-09-18 10:07:56', 0),
	(94, 'OB00007', 'Y0201', 3, 1, 'Retak', '3', 160, 1726, 0, 181.7904, 181.7904, 0, 'admin', 'zainudin', '2015-09-17', '0000-00-00', '0000-00-00', '14:00:00', '2015-09-18 10:08:16', 0),
	(95, 'OB00007', 'Y0217', 3, 1, 'Retak', '3', 200, 1650, 0, 203.45, 203.45, 0, 'admin', 'zainudin', '2015-09-17', '0000-00-00', '0000-00-00', '14:00:00', '2015-09-18 10:09:03', 0),
	(96, 'OB00007', 'Y0218', 3, 1, 'Retak', '3', 190, 1753, 0, 223.90455, 223.90455, 0, 'admin', 'zainudin', '2015-09-17', '0000-00-00', '0000-00-00', '14:00:00', '2015-09-18 10:09:24', 0),
	(97, 'OB00007', 'Y0002', 3, 1, 'Retak', '3', 100, 1772, 0, 120.818, 120.818, 0, 'admin', 'zainudin', '2015-09-17', '0000-00-00', '0000-00-00', '14:00:00', '2015-09-18 10:09:48', 0),
	(98, 'OB00007', 'Y0219', 3, 1, 'Retak', '3', 80, 1660, 0, 82.63199999999999, 82.63199999999999, 0, 'admin', 'zainudin', '2015-09-17', '0000-00-00', '0000-00-00', '14:00:00', '2015-09-18 10:10:18', 0),
	(99, 'OB00007', 'Y0220', 3, 1, 'Retak', '3', 100, 1662, 0, 103.603, 103.603, 0, 'admin', 'zainudin', '2015-09-17', '0000-00-00', '0000-00-00', '14:00:00', '2015-09-18 10:10:36', 0),
	(100, 'OB00007', 'Y0094', 3, 1, 'Retak', '3', 250, 1693, 259.79, 271.13624999999996, 11.34624999999994, 0, 'admin', 'zainudin', '2015-09-17', '0000-00-00', '0000-00-00', '14:00:00', '2015-09-18 10:11:02', 0),
	(101, 'OB00007', 'Y0206', 3, 1, 'Retak', '3', 200, 1738, 42.65, 230.994, 188.344, 0, 'admin', 'zainudin', '2015-09-17', '0000-00-00', '0000-00-00', '14:00:00', '2015-09-18 10:11:44', 0),
	(102, 'OB00007', 'Y0221', 3, 1, 'Retak', '3', 200, 1782, 0, 244.766, 244.766, 0, 'admin', 'zainudin', '2015-09-17', '0000-00-00', '0000-00-00', '14:00:00', '2015-09-18 10:12:05', 0),
	(103, 'OB00007', 'Y0221', 3, 1, 'Retak', '3', 200, 1778, 0, 243.514, 243.514, 0, 'admin', 'zainudin', '2015-09-17', '0000-00-00', '0000-00-00', '14:00:00', '2015-09-18 10:12:26', 0),
	(104, 'OB00008', 'Y0002', 3, 1, 'Hold', '3', 50, 1705, 120.82, 55.16624999999999, -65.65375, 0, 'admin', 'Zainudin', '2015-09-17', '0000-00-00', '0000-00-00', '14:00:00', '2015-09-18 10:16:38', 0),
	(105, 'OB00008', 'Y0084', 3, 1, 'Hold', '3', 200, 1629, 0, 196.87699999999998, 196.87699999999998, 0, 'admin', 'Zainudin', '2015-09-17', '0000-00-00', '0000-00-00', '14:00:00', '2015-09-18 10:17:12', 0),
	(106, 'OB00008', 'Y0166', 3, 1, 'Hold', '3', 150, 1560, 0, 131.46, 131.46, 0, 'admin', 'Zainudin', '2015-09-17', '0000-00-00', '0000-00-00', '14:00:00', '2015-09-18 10:17:40', 0),
	(107, 'OB00008', 'Y0084', 3, 1, 'Hold Retak', '3', 200, 1542, 196.88, 169.64600000000002, -27.23399999999998, 0, 'admin', 'Zainudin', '2015-09-17', '0000-00-00', '0000-00-00', '14:00:00', '2015-09-18 10:18:16', 0),
	(108, 'OB00008', 'Y0205', 3, 1, 'No Pass Retak', '3', 200, 1623, 74.49, 194.999, 120.509, 0, 'admin', 'Zainudin', '2015-09-17', '0000-00-00', '0000-00-00', '14:00:00', '2015-09-18 10:19:02', 0),
	(109, 'OB00008', 'Y0223', 3, 1, 'No Pass Retak', '3', 200, 1545, 0, 170.585, 170.585, 0, 'admin', 'Zainudin', '2015-09-17', '0000-00-00', '0000-00-00', '14:00:00', '2015-09-18 10:21:25', 0),
	(110, 'OB00008', 'Y0224', 3, 1, 'Hold', '3', 120, 1580, 0, 108.92399999999999, 108.92399999999999, 0, 'admin', 'Zainudin', '2015-09-17', '0000-00-00', '0000-00-00', '14:00:00', '2015-09-18 10:22:15', 0),
	(111, 'OB00008', 'Y0174', 3, 1, 'No Pass Retak', '3', 200, 1648, 164.42, 202.82399999999998, 38.403999999999996, 0, 'admin', 'Zainudin', '2015-09-17', '0000-00-00', '0000-00-00', '14:00:00', '2015-09-18 10:22:53', 0),
	(112, 'OB00008', 'Y0144', 3, 1, 'No Pass Retak', '3', 100, 1545, 233.89, 85.2925, -148.59749999999997, 0, 'admin', 'Zainudin', '2015-09-17', '0000-00-00', '0000-00-00', '14:00:00', '2015-09-18 10:23:17', 0),
	(113, 'OB00008', 'Y0223', 3, 1, 'Hold', '3', 200, 1575, 170.59, 179.97499999999997, 9.384999999999962, 0, 'admin', 'Zainudin', '2015-09-17', '0000-00-00', '0000-00-00', '14:00:00', '2015-09-18 10:24:05', 0),
	(114, 'OB00008', 'Y0174', 3, 1, 'Hold Retak', '3', 200, 1700, 367.24, 219.1, -148.14000000000001, 0, 'admin', 'Zainudin', '2015-09-17', '0000-00-00', '0000-00-00', '14:00:00', '2015-09-18 10:24:38', 0),
	(115, 'OB00008', 'Y0225', 3, 1, 'Hold Retak', '3', 150, 1709, 0, 166.43774999999997, 166.43774999999997, 0, 'admin', 'Zainudin', '2015-09-17', '0000-00-00', '0000-00-00', '14:00:00', '2015-09-18 10:24:55', 0),
	(116, 'OB00008', 'Y0226', 3, 1, 'Hold Retak', '3', 150, 1739, 0, 173.48024999999998, 173.48024999999998, 0, 'admin', 'Zainudin', '2015-09-17', '0000-00-00', '0000-00-00', '14:00:00', '2015-09-18 10:25:15', 0),
	(117, 'OB00008', 'Y0200', 3, 1, 'Hold Retak', '3', 80, 1692, 271.96, 86.63839999999999, -185.3216, 0, 'admin', 'Zainudin', '2015-09-17', '0000-00-00', '0000-00-00', '14:00:00', '2015-09-18 10:25:32', 0),
	(118, 'OB00008', 'Y0223', 3, 1, 'Hold Retak', '3', 80, 1545, 350.56, 68.23400000000001, -282.326, 0, 'admin', 'Zainudin', '2015-09-17', '0000-00-00', '0000-00-00', '14:00:00', '2015-09-18 10:25:48', 0),
	(119, 'OB00008', 'Y0172', 3, 1, 'Hold Retak', '3', 200, 1524, 29.36, 164.012, 134.652, 0, 'admin', 'Zainudin', '2015-09-17', '0000-00-00', '0000-00-00', '14:00:00', '2015-09-18 10:26:02', 0),
	(120, 'OB00008', 'Y0074', 3, 1, 'Hold Retak', '3', 150, 1486, 238.74, 114.0885, -124.65150000000001, 0, 'admin', 'Zainudin', '2015-09-17', '0000-00-00', '0000-00-00', '14:00:00', '2015-09-18 10:26:17', 0),
	(121, 'OB00008', 'Y0144', 3, 1, 'Hold Retak', '3', 100, 1648, 319.18, 101.41199999999999, -217.76800000000003, 0, 'admin', 'Zainudin', '2015-09-17', '0000-00-00', '0000-00-00', '14:00:00', '2015-09-18 10:26:35', 0),
	(122, 'OB00008', 'Y0158', 3, 1, 'Hold Retak', '3', 200, 1649, 373.47, 203.137, -170.33300000000003, 0, 'admin', 'Zainudin', '2015-09-17', '0000-00-00', '0000-00-00', '14:00:00', '2015-09-18 10:26:54', 0),
	(123, 'OB00009', 'Y0217', 3, 1, 'Retak', '3', 120, 1692, 203.45, 129.95759999999999, -73.4924, 0, 'admin', 'Zainudin', '2015-09-17', '0000-00-00', '0000-00-00', '15:00:00', '2015-09-18 10:29:47', 0),
	(124, 'OB00009', 'Y0217', 3, 1, 'Retak', '3', 130, 1584, 203.45, 118.81479999999999, -84.6352, 0, 'admin', 'Zainudin', '2015-09-17', '0000-00-00', '0000-00-00', '15:00:00', '2015-09-18 10:30:15', 0),
	(125, 'OB00009', 'Y0062', 3, 1, 'Hold', '3', 250, 1541, 0, 211.66625, 211.66625, 0, 'admin', 'Zainudin', '2015-09-17', '0000-00-00', '0000-00-00', '14:00:00', '2015-09-18 10:31:20', 0),
	(126, 'OB00009', 'Y0227', 3, 1, 'Hold', '3', 100, 1612, 0, 95.77799999999999, 95.77799999999999, 0, 'admin', 'Zainudin', '2015-09-17', '0000-00-00', '0000-00-00', '14:00:00', '2015-09-18 10:31:45', 0),
	(127, 'OB00009', 'Y0154', 3, 1, 'Retak', '3', 120, 1540, 207.33, 101.412, -105.918, 0, 'admin', 'Zainudin', '2015-09-17', '0000-00-00', '0000-00-00', '14:00:00', '2015-09-18 10:32:08', 0),
	(128, 'OB00009', 'Y0228', 3, 1, 'Retak', '3', 120, 1554, 0, 104.0412, 104.0412, 0, 'admin', 'Zainudin', '2015-09-17', '0000-00-00', '0000-00-00', '14:00:00', '2015-09-18 10:32:31', 0),
	(129, 'OB00009', 'Y0229', 3, 1, 'Kering', '3', 80, 1750, 0, 93.9, 93.9, 0, 'admin', 'Zainudin', '2015-09-17', '0000-00-00', '0000-00-00', '14:00:00', '2015-09-18 10:32:58', 0),
	(130, 'OB00009', 'Y0230', 3, 1, 'Hold', '3', 200, 1677, 0, 211.90100000000004, 211.90100000000004, 0, 'admin', 'Zainudin', '2015-09-17', '0000-00-00', '0000-00-00', '14:00:00', '2015-09-18 10:33:22', 0),
	(131, 'OB00009', 'Y0001', 3, 1, 'Hold', '3', 20, 1678, 0, 21.2214, 21.2214, 0, 'admin', 'Zainudin', '2015-09-17', '0000-00-00', '0000-00-00', '14:00:00', '2015-09-18 10:33:54', 0),
	(132, 'OB00009', 'Y0172', 3, 1, 'Retak', '3', 200, 1600, 193.37, 187.79999999999998, -5.570000000000022, 0, 'admin', 'Zainudin', '2015-09-17', '0000-00-00', '0000-00-00', '14:00:00', '2015-09-18 10:34:23', 0),
	(133, 'OB00009', 'Y0231', 3, 1, 'Hold', '3', 120, 1752, 0, 141.2256, 141.2256, 0, 'admin', 'Zainudin', '2015-09-17', '0000-00-00', '0000-00-00', '14:00:00', '2015-09-18 10:34:41', 0),
	(134, 'OB00009', 'Y0070', 3, 1, 'Retak', '3', 100, 1600, 142.73, 93.89999999999999, -48.83, 0, 'admin', 'Zainudin', '2015-09-17', '0000-00-00', '0000-00-00', '14:00:00', '2015-09-18 10:35:18', 0),
	(135, 'OB00009', 'Y0198', 3, 1, 'Retak', '3', 200, 1668, 284.38, 209.084, -75.29599999999999, 0, 'admin', 'Zainudin', '2015-09-17', '0000-00-00', '0000-00-00', '14:00:00', '2015-09-18 10:35:37', 0),
	(136, 'OB00009', 'Y0232', 3, 1, 'Tidak bisa dipakai', '3', 200, 1230, 0, 71.99, 71.99, 0, 'admin', 'Zainudin', '2015-09-17', '0000-00-00', '0000-00-00', '14:00:00', '2015-09-18 10:35:57', 0),
	(137, 'OB00009', 'Y0201', 3, 1, 'Retak', '3', 120, 1726, 394.63, 136.3428, -258.2872, 0, 'admin', 'Zainudin', '2015-09-17', '0000-00-00', '0000-00-00', '14:00:00', '2015-09-18 10:36:17', 0),
	(138, 'OB00009', 'Y0174', 3, 1, 'Kering Retak', '3', 160, 1700, 586.34, 175.27999999999997, -411.06000000000006, 0, 'admin', 'Zainudin', '2015-09-17', '0000-00-00', '0000-00-00', '14:00:00', '2015-09-18 10:36:42', 0),
	(139, 'OB00009', 'Y0225', 3, 1, 'Retak', '3', 200, 1676, 166.44, 211.58800000000002, 45.148000000000025, 0, 'admin', 'Zainudin', '2015-09-17', '0000-00-00', '0000-00-00', '14:00:00', '2015-09-18 10:37:12', 0),
	(140, 'OB00009', 'Y0201', 3, 1, 'Retak', '3', 120, 1720, 530.97, 135.216, -395.754, 0, 'admin', 'Zainudin', '2015-09-17', '0000-00-00', '0000-00-00', '14:00:00', '2015-09-18 10:37:31', 0),
	(141, 'OB00009', 'Y0201', 3, 1, 'Retak', '3', 100, 1764, 530.97, 119.56599999999999, -411.40400000000005, 0, 'admin', 'Zainudin', '2015-09-17', '0000-00-00', '0000-00-00', '14:00:00', '2015-09-18 10:37:46', 0),
	(142, 'OB00001', 'Y0094', 3, 1, '', '2', 328, 1680, 0, 349.05, 349.05760000000004, 0, 'admin', 'Zainudin', '2015-09-16', '0000-00-00', '0000-00-00', '16:00:00', '2015-09-18 10:49:01', 0),
	(143, 'OB00001', 'Y0198', 3, 1, '', '2', 290, 1667, 0, 302.72, 302.71795, 0, 'admin', 'Zainudin', '2015-09-16', '0000-00-00', '0000-00-00', '16:00:00', '2015-09-18 10:49:43', 0),
	(144, 'OB00001', 'Y0199', 3, 1, '', '2', 580, 1730, 0, 662.62, 662.621, 0, 'admin', 'Zainudin', '2015-09-16', '0000-00-00', '0000-00-00', '16:00:00', '2015-09-18 10:50:25', 0),
	(145, 'OB00001', 'Y0093', 3, 1, '', '2', 650, 1708, 0, 720.21, 720.213, 0, 'admin', 'Zainudin', '2015-09-16', '0000-00-00', '0000-00-00', '16:00:00', '2015-09-18 10:50:49', 0),
	(146, 'OB00001', 'Y0054', 3, 1, '', '2', 1154, 1727, 0, 1312.97, 1312.9692699999998, 0, 'admin', 'Zainudin', '2015-09-16', '0000-00-00', '0000-00-00', '16:00:00', '2015-09-18 10:51:36', 0),
	(147, 'OB00001', 'Y0201', 3, 1, '', '2', 1060, 1795, 0, 1318.83, 1318.8255, 0, 'admin', 'Zainudin', '2015-09-16', '0000-00-00', '0000-00-00', '16:00:00', '2015-09-18 10:52:23', 0),
	(148, 'OB00001', 'Y0158', 3, 1, '', '2', 692, 1745, 0, 806.82, 806.8200999999999, 0, 'admin', 'Zainudin', '2015-09-16', '0000-00-00', '0000-00-00', '16:00:00', '2015-09-18 10:52:54', 0),
	(149, 'OB00001', 'Y0011', 3, 1, 'Sedang di', '2', 95, 1732, 0, 108.83, 108.8301, 0, 'admin', 'Zainudin', '2015-09-16', '0000-00-00', '0000-00-00', '16:00:00', '2015-09-18 10:56:22', 0),
	(150, 'OB00001', 'Y0011', 3, 1, 'Sedang di', '2', 115, 1740, 0, 133.18, 133.1815, 0, 'admin', 'Zainudin', '2015-09-16', '0000-00-00', '0000-00-00', '16:00:00', '2015-09-18 10:56:35', 0),
	(151, 'OB00001', 'Y0131', 3, 1, 'Sedang di', '2', 360, 1685, 0, 385.93, 385.929, 0, 'admin', 'Zainudin', '2015-09-16', '0000-00-00', '0000-00-00', '16:00:00', '2015-09-18 10:56:58', 0),
	(152, 'OB00001', 'Y0186', 3, 1, 'Sedang di', '2', 505, 1675, 0, 533.47, 533.469375, 0, 'admin', 'Zainudin', '2015-09-16', '0000-00-00', '0000-00-00', '16:00:00', '2015-09-18 10:57:32', 0),
	(153, 'OB00001', 'Y0201', 3, 1, 'Buat Campuran', '2', 360, 1752, 0, 423.68, 423.67679999999996, 0, 'admin', 'Zainudin', '2015-09-16', '0000-00-00', '0000-00-00', '16:00:00', '2015-09-18 10:58:22', 0),
	(154, 'OB00001', 'Y0095', 3, 1, 'Buat Campuran', '2', 130, 1706, 311.17, 143.64, -167.53430000000003, 0, 'admin', 'Zainudin', '2015-09-16', '0000-00-00', '0000-00-00', '16:00:00', '2015-09-18 10:58:39', 0),
	(155, 'OB00001', 'Y0154', 3, 1, '', '2', 140, 1667, 0, 146.14, 146.1397, 0, 'admin', 'Zainudin', '2015-09-16', '0000-00-00', '0000-00-00', '16:00:00', '2015-09-18 10:59:23', 0),
	(156, 'OB00001', 'Y0037', 3, 1, '', '2', 140, 1700, 0, 153.37, 153.36999999999998, 0, 'admin', 'Zainudin', '2015-09-16', '0000-00-00', '0000-00-00', '16:00:00', '2015-09-18 10:59:59', 0),
	(157, 'OB00010', 'Y0062', 3, 1, '', '2', 250, 1690, 0, 269.9625, 269.9625, 0, 'admin', 'Zainudin', '2015-09-16', '0000-00-00', '0000-00-00', '17:00:00', '2015-09-18 11:15:35', 0),
	(158, 'OB00010', 'Y0096', 3, 1, '', '2', 160, 1735, 0, 184.04399999999998, 184.04399999999998, 0, 'admin', 'Zainudin', '2015-09-16', '0000-00-00', '0000-00-00', '17:00:00', '2015-09-18 11:16:16', 0),
	(159, 'OB00010', 'Y0008', 3, 1, '', '2', 165, 1685, 0, 176.884125, 176.884125, 0, 'admin', 'Zainudin', '2015-09-16', '0000-00-00', '0000-00-00', '17:00:00', '2015-09-18 11:17:00', 0),
	(160, 'OB00010', 'Y0202', 3, 1, '', '2', 300, 1730, 0, 342.735, 342.735, 0, 'admin', 'Zainudin', '2015-09-16', '0000-00-00', '0000-00-00', '17:00:00', '2015-09-18 11:17:28', 0),
	(161, 'OB00010', 'Y0172', 3, 1, '', '2', 290, 1731, 0, 331.76435, 331.76435, 0, 'admin', 'Zainudin', '2015-09-16', '0000-00-00', '0000-00-00', '17:00:00', '2015-09-18 11:17:53', 0),
	(162, 'OB00010', 'Y0090', 3, 1, '', '2', 230, 1700, 0, 251.96499999999997, 251.96499999999997, 0, 'admin', 'Zainudin', '2015-09-16', '0000-00-00', '0000-00-00', '17:00:00', '2015-09-18 11:18:34', 0),
	(163, 'OB00010', 'Y0091', 3, 1, '', '2', 75, 1580, 0, 68.0775, 68.0775, 0, 'admin', 'Zainudin', '2015-09-16', '0000-00-00', '0000-00-00', '17:00:00', '2015-09-18 11:18:49', 0),
	(164, 'OB00010', 'Y0203', 3, 1, '', '2', 220, 1678, 0, 233.4354, 233.4354, 0, 'admin', 'Zainudin', '2015-09-16', '0000-00-00', '0000-00-00', '17:00:00', '2015-09-18 11:19:04', 0),
	(165, 'OB00010', 'Y0128', 3, 1, '', '2', 155, 1757, 0, 183.62927499999998, 183.62927499999998, 0, 'admin', 'Zainudin', '2015-09-16', '0000-00-00', '0000-00-00', '17:00:00', '2015-09-18 11:23:39', 0),
	(166, 'OB00010', 'Y0178', 3, 1, '', '2', 260, 1700, 0, 284.83, 284.83, 0, 'admin', 'Zainudin', '2015-09-16', '0000-00-00', '0000-00-00', '17:00:00', '2015-09-18 11:25:01', 0),
	(167, 'OB00010', 'Y0084', 3, 1, '', '2', 145, 1624, 0, 141.6012, 141.6012, 0, 'admin', 'Zainudin', '2015-09-16', '0000-00-00', '0000-00-00', '17:00:00', '2015-09-18 11:25:21', 0),
	(168, 'OB00010', 'Y0172', 3, 1, '', '2', 300, 1723, 331.76, 339.44849999999997, 7.688499999999976, 0, 'admin', 'Zainudin', '2015-09-16', '0000-00-00', '0000-00-00', '17:00:00', '2015-09-18 11:25:53', 0),
	(169, 'OB00010', 'Y0034', 3, 1, '', '2', 70, 1630, 0, 69.0165, 69.0165, 0, 'admin', 'Zainudin', '2015-09-16', '0000-00-00', '0000-00-00', '17:00:00', '2015-09-18 11:26:23', 0),
	(170, 'OB00010', 'Y0014', 3, 1, '', '2', 162, 1701, 0, 177.72453, 177.72453, 0, 'admin', 'Zainudin', '2015-09-16', '0000-00-00', '0000-00-00', '17:00:00', '2015-09-18 11:26:39', 0),
	(171, 'OB00010', 'Y0110', 3, 1, '', '2', 120, 1745, 0, 139.91099999999997, 139.91099999999997, 0, 'admin', 'Zainudin', '2015-09-16', '0000-00-00', '0000-00-00', '17:00:00', '2015-09-18 11:27:01', 0),
	(172, 'OB00010', 'Y0090', 3, 1, '', '2', 100, 1621, 251.96, 97.1865, -154.7735, 0, 'admin', 'Zainudin', '2015-09-16', '0000-00-00', '0000-00-00', '17:00:00', '2015-09-18 11:27:19', 0),
	(173, 'OB00010', 'Y0202', 3, 1, '', '2', 350, 1724, 342.74, 396.57099999999997, 53.83099999999996, 0, 'admin', 'Zainudin', '2015-09-16', '0000-00-00', '0000-00-00', '17:00:00', '2015-09-18 11:28:07', 0),
	(174, 'OB00010', 'Y0196', 3, 1, '', '2', 95, 1753, 0, 111.952275, 111.952275, 0, 'admin', 'Zainudin', '2015-09-16', '0000-00-00', '0000-00-00', '17:00:00', '2015-09-18 11:28:30', 0),
	(175, 'OB00010', 'Y0042', 3, 1, '', '2', 150, 1698, 0, 163.85549999999998, 163.85549999999998, 0, 'admin', 'Zainudin', '2015-09-16', '0000-00-00', '0000-00-00', '17:00:00', '2015-09-18 11:28:52', 0),
	(176, 'OB00010', 'Y0144', 3, 1, '', '2', 200, 1717, 0, 224.421, 224.421, 0, 'admin', 'Zainudin', '2015-09-16', '0000-00-00', '0000-00-00', '17:00:00', '2015-09-18 11:29:14', 0),
	(177, 'OB00010', 'Y0204', 3, 1, '', '2', 125, 1658, 0, 128.72125, 128.72125, 0, 'admin', 'Zainudin', '2015-09-16', '0000-00-00', '0000-00-00', '17:00:00', '2015-09-18 11:29:30', 0),
	(178, 'OB00010', 'Y0178', 3, 1, '', '2', 210, 1690, 284.83, 226.7685, -58.061499999999995, 0, 'admin', 'Zainudin', '2015-09-16', '0000-00-00', '0000-00-00', '17:00:00', '2015-09-18 11:29:48', 0),
	(179, 'OB00010', 'Y0178', 3, 1, '', '2', 300, 1701, 284.83, 329.11949999999996, 44.289499999999975, 0, 'admin', 'Zainudin', '2015-09-16', '0000-00-00', '0000-00-00', '17:00:00', '2015-09-18 11:29:55', 0),
	(180, 'OB00010', 'Y0100', 3, 1, '', '2', 90, 1620, 0, 87.327, 87.327, 0, 'admin', 'Zainudin', '2015-09-16', '0000-00-00', '0000-00-00', '17:00:00', '2015-09-18 11:30:06', 0);
/*!40000 ALTER TABLE `glasir_ohd` ENABLE KEYS */;


-- Dumping structure for table inventory.glasir_ph
CREATE TABLE IF NOT EXISTS `glasir_ph` (
  `no_prod` char(15) NOT NULL,
  `inputer` varchar(50) NOT NULL,
  `tgl_inp` datetime NOT NULL,
  `lst_upd` datetime NOT NULL,
  `deleted` smallint(1) DEFAULT NULL,
  PRIMARY KEY (`no_prod`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table inventory.glasir_ph: ~5 rows (approximately)
DELETE FROM `glasir_ph`;
/*!40000 ALTER TABLE `glasir_ph` DISABLE KEYS */;
INSERT INTO `glasir_ph` (`no_prod`, `inputer`, `tgl_inp`, `lst_upd`, `deleted`) VALUES
	('PG00001', 'rosmiati', '2015-09-18 02:07:15', '0000-00-00 00:00:00', 0),
	('PG00002', 'rosmiati', '2015-09-18 02:31:33', '0000-00-00 00:00:00', 0),
	('PG00003', 'rosmiati', '2015-09-18 02:40:52', '0000-00-00 00:00:00', 0),
	('PG00004', 'rosmiati', '2015-09-18 02:55:12', '0000-00-00 00:00:00', 0),
	('PG00005', 'rosmiati', '2015-09-19 09:08:56', '0000-00-00 00:00:00', 0);
/*!40000 ALTER TABLE `glasir_ph` ENABLE KEYS */;


-- Dumping structure for table inventory.glasir_phd
CREATE TABLE IF NOT EXISTS `glasir_phd` (
  `idphd` smallint(6) NOT NULL AUTO_INCREMENT,
  `no_prod` char(15) NOT NULL,
  `id_glasir` varchar(50) NOT NULL,
  `id_bm` smallint(6) NOT NULL,
  `id_bmt` smallint(6) NOT NULL,
  `shift` smallint(6) NOT NULL,
  `volume` double NOT NULL,
  `densitas` double NOT NULL,
  `inputer` varchar(50) NOT NULL,
  `dsc` varchar(255) NOT NULL,
  `petugas` varchar(50) NOT NULL,
  `jam` time NOT NULL,
  `tgl` date NOT NULL,
  `tglp` date NOT NULL,
  `tglb` date NOT NULL,
  `tgl_insert` datetime NOT NULL,
  `deleted` smallint(1) NOT NULL,
  PRIMARY KEY (`idphd`),
  KEY `FK_glasir_phd_glasir` (`id_glasir`),
  KEY `FK_glasir_phd_glasir_ph` (`no_prod`),
  KEY `FK_glasir_phd_admins` (`inputer`),
  KEY `FK_glasir_phd_global_mesin` (`id_bm`),
  KEY `FK_glasir_phd_global_shift` (`shift`),
  CONSTRAINT `FK_glasir_phd_global_mesin` FOREIGN KEY (`id_bm`) REFERENCES `global_mesin` (`id_bm`),
  CONSTRAINT `FK_glasir_phd_global_shift` FOREIGN KEY (`shift`) REFERENCES `global_shift` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table inventory.glasir_phd: ~12 rows (approximately)
DELETE FROM `glasir_phd`;
/*!40000 ALTER TABLE `glasir_phd` DISABLE KEYS */;
INSERT INTO `glasir_phd` (`idphd`, `no_prod`, `id_glasir`, `id_bm`, `id_bmt`, `shift`, `volume`, `densitas`, `inputer`, `dsc`, `petugas`, `jam`, `tgl`, `tglp`, `tglb`, `tgl_insert`, `deleted`) VALUES
	(1, 'PG00001', 'Y0094', 15, 52, 2, 335, 1679, 'rosmiati', '', 'Nandi', '10:30:00', '2015-09-16', '2015-09-12', '2015-09-13', '2015-09-18 02:07:15', 0),
	(2, 'PG00001', 'Y0126', 17, 52, 2, 300, 1730, 'rosmiati', '', 'Nandi', '11:00:00', '2015-09-16', '2015-09-16', '2015-09-06', '2015-09-18 02:20:40', 0),
	(3, 'PG00002', 'Y0196', 23, 52, 3, 94, 1665, 'rosmiati', '', 'Nandi', '19:00:00', '2015-09-16', '2015-09-16', '2015-09-13', '2015-09-18 02:31:33', 0),
	(4, 'PG00002', 'Y0232', 23, 52, 3, 180, 1660, 'rosmiati', '', 'Nandi', '20:00:00', '2015-09-16', '2015-09-16', '2015-09-17', '2015-09-18 02:33:34', 0),
	(5, 'PG00002', 'Y0080', 11, 52, 2, 270, 1729, 'rosmiati', '', 'Nandi', '15:00:00', '2015-09-17', '2015-09-17', '2015-09-15', '2015-09-18 02:36:58', 0),
	(6, 'PG00003', 'Y0061', 22, 52, 2, 135, 1710, 'rosmiati', '', 'Nandi', '15:30:00', '2015-09-17', '2015-09-17', '2015-09-16', '2015-09-18 02:40:52', 0),
	(7, 'PG00003', 'Y0093', 22, 52, 2, 1708, 1710, 'rosmiati', '', 'Nandi', '10:30:00', '2015-09-17', '2015-09-14', '2015-09-16', '2015-09-18 02:42:51', 0),
	(8, 'PG00004', 'Y0090', 24, 52, 2, 100, 1785, 'rosmiati', '', 'Nandi', '13:30:00', '2015-09-17', '2015-09-10', '2015-09-16', '2015-09-18 02:55:12', 0),
	(9, 'PG00005', 'Y0032', 10, 52, 2, 290, 1715, 'rosmiati', '', 'Nandi', '14:00:00', '2015-09-18', '2015-09-16', '2015-09-18', '2015-09-19 09:08:57', 0),
	(10, 'PG00005', 'Y0164', 21, 52, 2, 145, 1640, 'rosmiati', '', 'Nandi', '14:30:00', '2015-09-18', '2015-09-16', '2015-09-18', '2015-09-19 09:10:38', 0),
	(11, 'PG00005', 'Y0011', 18, 52, 2, 290, 1745, 'rosmiati', 'Tambah sand 1 %', 'Nandi', '15:30:00', '2015-09-18', '2015-09-12', '2015-09-18', '2015-09-19 09:14:29', 0),
	(12, 'PG00005', 'Y0070', 15, 52, 3, 310, 1666, 'rosmiati', '', 'Nandi', '17:00:00', '2015-09-18', '2015-09-16', '2015-09-17', '2015-09-19 09:17:07', 0);
/*!40000 ALTER TABLE `glasir_phd` ENABLE KEYS */;


-- Dumping structure for table inventory.glasir_phd_sp
CREATE TABLE IF NOT EXISTS `glasir_phd_sp` (
  `idphd` smallint(6) NOT NULL AUTO_INCREMENT,
  `no_prod` char(15) NOT NULL,
  `id_glasir` varchar(50) NOT NULL,
  `id_bm` smallint(6) NOT NULL,
  `id_gps` smallint(6) NOT NULL,
  `shift` smallint(6) NOT NULL,
  `jam` time NOT NULL,
  `tgl` date NOT NULL,
  `tglp` date NOT NULL,
  `tglb` date NOT NULL,
  `volume` double NOT NULL,
  `densitas` double NOT NULL,
  `inputer` varchar(50) NOT NULL,
  `dsc` varchar(255) NOT NULL,
  `petugas` varchar(50) NOT NULL,
  `tgl_insert` datetime NOT NULL,
  `deleted` smallint(1) DEFAULT NULL,
  PRIMARY KEY (`idphd`),
  KEY `FK_glasir_phd_glasir` (`id_glasir`),
  KEY `FK_glasir_phd_glasir_ph` (`no_prod`),
  KEY `FK_glasir_phd_admins` (`inputer`),
  KEY `FK_glasir_phd_global_mesin` (`id_bm`),
  KEY `FK_glasir_phd_sp_global_status` (`id_gps`),
  KEY `FK_glasir_phd_sp_global_shift` (`shift`),
  CONSTRAINT `FK_glasir_phd_sp_global_shift` FOREIGN KEY (`shift`) REFERENCES `global_shift` (`id`),
  CONSTRAINT `FK_glasir_phd_sp_global_status` FOREIGN KEY (`id_gps`) REFERENCES `global_status` (`idgps`),
  CONSTRAINT `glasir_phd_sp_ibfk_1` FOREIGN KEY (`id_bm`) REFERENCES `global_mesin` (`id_bm`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table inventory.glasir_phd_sp: ~8 rows (approximately)
DELETE FROM `glasir_phd_sp`;
/*!40000 ALTER TABLE `glasir_phd_sp` DISABLE KEYS */;
INSERT INTO `glasir_phd_sp` (`idphd`, `no_prod`, `id_glasir`, `id_bm`, `id_gps`, `shift`, `jam`, `tgl`, `tglp`, `tglb`, `volume`, `densitas`, `inputer`, `dsc`, `petugas`, `tgl_insert`, `deleted`) VALUES
	(1, 'SG00001', 'Y0199', 1, 2, 3, '17:00:00', '2015-09-16', '2015-09-01', '2015-09-05', 180, 1763, 'rifqi', '', 'None', '2015-09-18 05:46:09', 0),
	(2, 'SG00002', 'Y0093', 1, 2, 3, '19:45:00', '2015-09-16', '2015-09-09', '2015-09-11', 200, 1700, 'rifqi', '', 'None', '2015-09-18 05:49:42', 0),
	(3, 'SG00002', 'Y0094', 1, 2, 3, '19:45:00', '2015-09-16', '2015-09-12', '2015-09-13', 170, 1680, 'rifqi', '', 'None', '2015-09-18 05:51:17', 0),
	(4, 'SG00002', 'Y0172', 1, 2, 3, '22:00:00', '2015-09-16', '2015-09-10', '2015-09-12', 200, 1723, 'rifqi', '', 'None', '2015-09-18 05:52:43', 0),
	(5, 'SG00003', 'Y0172', 1, 2, 2, '10:00:00', '2015-09-17', '2015-09-10', '2015-09-12', 100, 1691, 'rifqi', '', 'None', '2015-09-18 05:55:31', 0),
	(6, 'SG00003', 'Y0128', 1, 2, 3, '20:00:00', '2015-09-16', '2015-09-05', '2015-09-03', 140, 1757, 'rifqi', '', 'None', '2015-09-18 05:59:38', 0),
	(7, 'SG00003', 'Y0054', 1, 2, 3, '21:00:00', '2015-09-16', '2015-09-02', '2015-09-04', 200, 1727, 'rifqi', '', 'None', '2015-09-18 06:01:04', 0),
	(8, 'SG00003', 'Y0034', 1, 2, 3, '16:00:00', '2015-09-17', '2015-09-14', '2015-09-16', 70, 1630, 'rifqi', '', 'None', '2015-09-18 06:02:04', 0);
/*!40000 ALTER TABLE `glasir_phd_sp` ENABLE KEYS */;


-- Dumping structure for table inventory.glasir_ph_sp
CREATE TABLE IF NOT EXISTS `glasir_ph_sp` (
  `no_prod` char(15) NOT NULL,
  `inputer` varchar(50) NOT NULL,
  `tgl_inp` datetime NOT NULL,
  `lst_upd` datetime NOT NULL,
  `deleted` smallint(1) DEFAULT NULL,
  PRIMARY KEY (`no_prod`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table inventory.glasir_ph_sp: ~3 rows (approximately)
DELETE FROM `glasir_ph_sp`;
/*!40000 ALTER TABLE `glasir_ph_sp` DISABLE KEYS */;
INSERT INTO `glasir_ph_sp` (`no_prod`, `inputer`, `tgl_inp`, `lst_upd`, `deleted`) VALUES
	('SG00001', 'rifqi', '2015-09-18 05:46:09', '0000-00-00 00:00:00', 0),
	('SG00002', 'rifqi', '2015-09-18 05:49:42', '0000-00-00 00:00:00', 0),
	('SG00003', 'rifqi', '2015-09-18 05:55:31', '0000-00-00 00:00:00', 0);
/*!40000 ALTER TABLE `glasir_ph_sp` ENABLE KEYS */;


-- Dumping structure for table inventory.glasir_rh
CREATE TABLE IF NOT EXISTS `glasir_rh` (
  `no_prod` char(15) NOT NULL,
  `inputer` varchar(50) NOT NULL,
  `tgl_inp` datetime NOT NULL,
  `lst_upd` datetime NOT NULL,
  `deleted` smallint(1) DEFAULT NULL,
  PRIMARY KEY (`no_prod`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table inventory.glasir_rh: ~3 rows (approximately)
DELETE FROM `glasir_rh`;
/*!40000 ALTER TABLE `glasir_rh` DISABLE KEYS */;
INSERT INTO `glasir_rh` (`no_prod`, `inputer`, `tgl_inp`, `lst_upd`, `deleted`) VALUES
	('RG00001', 'rifqi', '2015-09-18 06:47:40', '0000-00-00 00:00:00', 0),
	('RG00002', 'rifqi', '2015-09-18 07:41:58', '0000-00-00 00:00:00', 0),
	('RG00003', 'rifqi', '2015-09-18 07:45:51', '0000-00-00 00:00:00', 0);
/*!40000 ALTER TABLE `glasir_rh` ENABLE KEYS */;


-- Dumping structure for table inventory.glasir_rhd
CREATE TABLE IF NOT EXISTS `glasir_rhd` (
  `idthd` smallint(6) NOT NULL AUTO_INCREMENT,
  `no_prod` char(15) NOT NULL,
  `id_glasir` varchar(50) NOT NULL,
  `shift` smallint(6) NOT NULL,
  `id_bm` smallint(6) NOT NULL,
  `dsc` varchar(255) NOT NULL,
  `ddri` varchar(255) NOT NULL,
  `volume` double NOT NULL,
  `densitas` double NOT NULL,
  `vsc` double NOT NULL,
  `inputer` varchar(50) NOT NULL,
  `petugas1` varchar(50) NOT NULL,
  `petugas2` varchar(50) NOT NULL,
  `petugas3` varchar(50) NOT NULL,
  `petugas4` varchar(50) NOT NULL,
  `tgl` date NOT NULL,
  `tglp` date NOT NULL,
  `tglb` date NOT NULL,
  `jam` time NOT NULL,
  `tgl_insert` datetime NOT NULL,
  `deleted` smallint(1) NOT NULL,
  PRIMARY KEY (`idthd`),
  KEY `FK_glasir_thd_glasir` (`id_glasir`),
  KEY `FK_glasir_thd_global_shift` (`shift`),
  KEY `FK_glasir_thd_global_mesin` (`id_bm`),
  KEY `FK_glasir_thd_admins` (`inputer`),
  KEY `FK_glasir_rhd_glasir_rh` (`no_prod`),
  CONSTRAINT `FK_glasir_rhd_glasir_rh` FOREIGN KEY (`no_prod`) REFERENCES `glasir_rh` (`no_prod`),
  CONSTRAINT `glasir_rhd_ibfk_1` FOREIGN KEY (`inputer`) REFERENCES `admins` (`username`),
  CONSTRAINT `glasir_rhd_ibfk_2` FOREIGN KEY (`id_glasir`) REFERENCES `glasir` (`id_glasir`),
  CONSTRAINT `glasir_rhd_ibfk_4` FOREIGN KEY (`id_bm`) REFERENCES `global_mesin` (`id_bm`),
  CONSTRAINT `glasir_rhd_ibfk_5` FOREIGN KEY (`shift`) REFERENCES `global_shift` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table inventory.glasir_rhd: ~8 rows (approximately)
DELETE FROM `glasir_rhd`;
/*!40000 ALTER TABLE `glasir_rhd` DISABLE KEYS */;
INSERT INTO `glasir_rhd` (`idthd`, `no_prod`, `id_glasir`, `shift`, `id_bm`, `dsc`, `ddri`, `volume`, `densitas`, `vsc`, `inputer`, `petugas1`, `petugas2`, `petugas3`, `petugas4`, `tgl`, `tglp`, `tglb`, `jam`, `tgl_insert`, `deleted`) VALUES
	(2, 'RG00001', 'Y0193', 3, 26, '', 'Tong Stainless', 82, 1429, 48, 'rifqi', '', '', 'Siti Rohmah', 'Samsul', '2015-09-16', '0000-00-00', '0000-00-00', '00:00:00', '2015-09-18 06:47:40', 0),
	(4, 'RG00001', 'Y0190', 3, 25, '', 'Tong Stainless', 79, 1430, 51, 'rifqi', '', '', '', '', '2015-09-16', '0000-00-00', '0000-00-00', '00:00:00', '2015-09-18 06:59:50', 0),
	(5, 'RG00002', 'Y0207', 2, 35, '', 'Tong Stainless', 100, 1388, 45, 'rifqi', '', '', 'Winarni', '', '2015-09-17', '0000-00-00', '0000-00-00', '00:00:00', '2015-09-18 07:41:58', 0),
	(6, 'RG00002', 'Y0093', 2, 34, '', 'Tong Stainless', 100, 1420, 44, 'rifqi', '', '', 'Winarni', '', '2015-09-17', '0000-00-00', '0000-00-00', '00:00:00', '2015-09-18 07:43:45', 0),
	(7, 'RG00003', 'Y0172', 2, 36, '', 'Tong Stainless', 84, 1427, 47, 'rifqi', '', '', 'Suparni', '', '2015-09-17', '0000-00-00', '0000-00-00', '00:00:00', '2015-09-18 07:45:51', 0),
	(8, 'RG00003', 'Y0131', 2, 37, '', 'Tong Stainless', 100, 1450, 49, 'rifqi', '', '', 'Suparni', '', '2015-09-17', '0000-00-00', '0000-00-00', '00:00:00', '2015-09-18 07:48:14', 0),
	(9, 'RG00003', 'Y0193', 2, 34, '', 'Tong Stainless', 100, 1439, 48, 'rifqi', '', '', 'Winarni', '', '2015-09-17', '0000-00-00', '0000-00-00', '00:00:00', '2015-09-18 07:49:13', 0),
	(10, 'RG00003', 'Y0190', 2, 37, '', 'Tong Stainless', 60, 1430, 51, 'rifqi', '', '', 'Suparni', '', '2015-09-17', '0000-00-00', '0000-00-00', '00:00:00', '2015-09-18 07:50:52', 0);
/*!40000 ALTER TABLE `glasir_rhd` ENABLE KEYS */;


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
  `inputer` varchar(50) NOT NULL,
  `tgl_inp` datetime NOT NULL,
  `lst_upd` datetime NOT NULL,
  `deleted` smallint(1) DEFAULT NULL,
  PRIMARY KEY (`no_prod`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table inventory.glasir_th: ~11 rows (approximately)
DELETE FROM `glasir_th`;
/*!40000 ALTER TABLE `glasir_th` DISABLE KEYS */;
INSERT INTO `glasir_th` (`no_prod`, `inputer`, `tgl_inp`, `lst_upd`, `deleted`) VALUES
	('TG00001', 'rifqi', '2015-09-18 06:05:38', '0000-00-00 00:00:00', 0),
	('TG00002', 'rifqi', '2015-09-18 06:17:35', '0000-00-00 00:00:00', 0),
	('TG00003', 'rifqi', '2015-09-18 06:20:49', '0000-00-00 00:00:00', 0),
	('TG00004', 'rifqi', '2015-09-18 06:21:05', '0000-00-00 00:00:00', 0),
	('TG00005', 'rifqi', '2015-09-18 06:26:39', '0000-00-00 00:00:00', 0),
	('TG00006', 'rifqi', '2015-09-18 06:28:37', '0000-00-00 00:00:00', 0),
	('TG00007', 'rifqi', '2015-09-18 06:36:49', '0000-00-00 00:00:00', 0),
	('TG00008', 'rifqi', '2015-09-18 06:43:15', '0000-00-00 00:00:00', 0),
	('TG00009', 'rifqi', '2015-09-18 07:02:30', '0000-00-00 00:00:00', 0),
	('TG00010', 'rifqi', '2015-09-18 07:05:28', '0000-00-00 00:00:00', 0),
	('TG00011', 'rifqi', '2015-09-18 07:35:16', '0000-00-00 00:00:00', 0);
/*!40000 ALTER TABLE `glasir_th` ENABLE KEYS */;


-- Dumping structure for table inventory.glasir_thd
CREATE TABLE IF NOT EXISTS `glasir_thd` (
  `idthd` smallint(6) NOT NULL AUTO_INCREMENT,
  `no_prod` char(15) NOT NULL,
  `id_glasir` varchar(50) NOT NULL,
  `shift` smallint(6) NOT NULL,
  `id_bm` smallint(6) NOT NULL,
  `dsc` varchar(255) NOT NULL,
  `ddri` varchar(255) NOT NULL,
  `volume` double NOT NULL,
  `densitas` double NOT NULL,
  `vsc` double NOT NULL,
  `inputer` varchar(50) NOT NULL,
  `petugas1` varchar(50) NOT NULL,
  `petugas2` varchar(50) NOT NULL,
  `petugas3` varchar(50) NOT NULL,
  `petugas4` varchar(50) NOT NULL,
  `tgl` date NOT NULL,
  `tglp` date NOT NULL,
  `tglb` date NOT NULL,
  `jam` time NOT NULL,
  `tgl_insert` datetime NOT NULL,
  `deleted` smallint(1) NOT NULL,
  PRIMARY KEY (`idthd`),
  KEY `FK_glasir_thd_glasir_th` (`no_prod`),
  KEY `FK_glasir_thd_glasir` (`id_glasir`),
  KEY `FK_glasir_thd_global_shift` (`shift`),
  KEY `FK_glasir_thd_global_mesin` (`id_bm`),
  KEY `FK_glasir_thd_admins` (`inputer`),
  CONSTRAINT `FK_glasir_thd_admins` FOREIGN KEY (`inputer`) REFERENCES `admins` (`username`),
  CONSTRAINT `FK_glasir_thd_glasir` FOREIGN KEY (`id_glasir`) REFERENCES `glasir` (`id_glasir`),
  CONSTRAINT `FK_glasir_thd_glasir_th` FOREIGN KEY (`no_prod`) REFERENCES `glasir_th` (`no_prod`),
  CONSTRAINT `FK_glasir_thd_global_mesin` FOREIGN KEY (`id_bm`) REFERENCES `global_mesin` (`id_bm`),
  CONSTRAINT `FK_glasir_thd_global_shift` FOREIGN KEY (`shift`) REFERENCES `global_shift` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table inventory.glasir_thd: ~16 rows (approximately)
DELETE FROM `glasir_thd`;
/*!40000 ALTER TABLE `glasir_thd` DISABLE KEYS */;
INSERT INTO `glasir_thd` (`idthd`, `no_prod`, `id_glasir`, `shift`, `id_bm`, `dsc`, `ddri`, `volume`, `densitas`, `vsc`, `inputer`, `petugas1`, `petugas2`, `petugas3`, `petugas4`, `tgl`, `tglp`, `tglb`, `jam`, `tgl_insert`, `deleted`) VALUES
	(1, 'TG00001', 'Y0193', 3, 26, '', 'Tong', 100, 1429, 43, 'rifqi', '', '', 'Siti Rohmah', 'Samsul', '2015-09-16', '0000-00-00', '0000-00-00', '16:30:00', '2015-09-18 06:05:38', 0),
	(2, 'TG00002', 'Y0193', 3, 26, '', 'Tong', 100, 1432, 48, 'rifqi', '', '', 'Siti Rohmah', '', '2015-09-16', '0000-00-00', '0000-00-00', '21:00:00', '2015-09-18 06:17:35', 0),
	(11, 'TG00006', 'Y0190', 3, 1, '', 'Tangki', 100, 1430, 51, 'rifqi', '', '', '', '', '2015-09-16', '0000-00-00', '0000-00-00', '20:00:00', '2015-09-18 06:28:37', 0),
	(12, 'TG00007', 'Y0128', 3, 1, '', 'Tong', 30, 1425, 4, 'rifqi', '', '', '', 'Firman', '2015-09-16', '0000-00-00', '0000-00-00', '15:00:00', '2015-09-18 06:36:49', 0),
	(15, 'TG00008', 'Y0190', 3, 1, '', '', 96, 1430, 51, 'rifqi', '', '', '', '', '2015-09-16', '0000-00-00', '0000-00-00', '20:30:00', '2015-09-18 06:43:55', 0),
	(16, 'TG00009', 'Y0207', 2, 26, '', 'Tong', 105, 1388, 45, 'rifqi', '', '', 'Susilah', '', '2015-09-17', '0000-00-00', '0000-00-00', '07:00:00', '2015-09-18 07:02:30', 0),
	(17, 'TG00010', 'Y0093', 2, 34, '', 'Tong', 100, 1420, 44, 'rifqi', '', '', 'Winarni', '', '2015-09-17', '0000-00-00', '0000-00-00', '07:00:00', '2015-09-18 07:05:28', 0),
	(18, 'TG00010', 'Y0207', 2, 35, '', 'Tong', 110, 1388, 45, 'rifqi', '', '', 'Winarni', '', '2015-09-17', '0000-00-00', '0000-00-00', '07:00:00', '2015-09-18 07:07:17', 0),
	(19, 'TG00010', 'Y0131', 2, 36, '', 'Tong', 105, 1450, 49, 'rifqi', '', '', 'Suparni', '', '2015-09-17', '0000-00-00', '0000-00-00', '07:00:00', '2015-09-18 07:08:08', 0),
	(20, 'TG00010', 'Y0193', 2, 34, '', 'Tong', 105, 1439, 48, 'rifqi', '', '', 'Winarni', '', '2015-09-17', '0000-00-00', '0000-00-00', '13:00:00', '2015-09-18 07:09:05', 0),
	(21, 'TG00010', 'Y0190', 2, 37, '', 'Tangki', 105, 1430, 51, 'rifqi', '', '', 'Suparni', '', '2015-09-17', '0000-00-00', '0000-00-00', '13:30:00', '2015-09-18 07:11:08', 0),
	(22, 'TG00011', 'Y0207', 2, 35, '', 'Tong', 95, 1388, 45, 'rifqi', '', '', 'Winarni', '', '2015-09-17', '0000-00-00', '0000-00-00', '00:00:00', '2015-09-18 07:35:16', 0),
	(23, 'TG00011', 'Y0093', 2, 34, '', 'Tong', 125, 1420, 44, 'rifqi', '', '', 'Winarni', '', '2015-09-17', '0000-00-00', '0000-00-00', '00:00:00', '2015-09-18 07:35:58', 0),
	(24, 'TG00011', 'Y0172', 2, 36, '', 'Tong', 120, 1670, 47, 'rifqi', '', '', 'Suparni', '', '2015-09-17', '0000-00-00', '0000-00-00', '00:00:00', '2015-09-18 07:38:44', 0),
	(25, 'TG00011', 'Y0131', 2, 37, '', 'Tong', 25, 1450, 49, 'rifqi', '', '', 'Suparni', '', '2015-09-17', '0000-00-00', '0000-00-00', '00:00:00', '2015-09-18 07:39:27', 0),
	(26, 'TG00011', 'Y0193', 2, 37, '', 'Tangki', 30, 1439, 43, 'rifqi', '', '', 'Suparni', '', '2015-09-17', '0000-00-00', '0000-00-00', '00:00:00', '2015-09-18 07:40:29', 0);
/*!40000 ALTER TABLE `glasir_thd` ENABLE KEYS */;


-- Dumping structure for table inventory.global_area
CREATE TABLE IF NOT EXISTS `global_area` (
  `id_area` smallint(6) NOT NULL AUTO_INCREMENT,
  `nama_area` varchar(50) NOT NULL,
  `jns_area` varchar(50) NOT NULL,
  `no_area` varchar(50) NOT NULL,
  `kapasitas` double NOT NULL,
  `satuan` char(50) NOT NULL,
  `lokasi` char(50) NOT NULL,
  PRIMARY KEY (`id_area`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table inventory.global_area: ~3 rows (approximately)
DELETE FROM `global_area`;
/*!40000 ALTER TABLE `global_area` DISABLE KEYS */;
INSERT INTO `global_area` (`id_area`, `nama_area`, `jns_area`, `no_area`, `kapasitas`, `satuan`, `lokasi`) VALUES
	(1, 'Tidak ada', 'Tidak ada', 'Tidak ada', 0, 'Tidak ada', 'Tidak ada'),
	(2, 'Area BGPS', 'Produksi', '1', 0, 'Tidak ada', 'Tidak ada'),
	(3, 'Area Glasir', 'Produksi', '2', 0, 'Tidak ada', 'Tidak ada');
/*!40000 ALTER TABLE `global_area` ENABLE KEYS */;


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
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table inventory.global_mesin: ~54 rows (approximately)
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
	(41, 'Waterfall', 'Glasir 2.07', '0', 0, 'ppj', ''),
	(42, 'Tong 1', 'Tong 1', '1', 0, 'liter', ''),
	(43, 'Tong 2', 'Tong 2', '1', 0, 'liter', ''),
	(44, 'Tong 3', 'Tong 3', '1', 0, 'liter', ''),
	(45, 'Tong 4', 'Tong 4', '1', 0, 'liter', ''),
	(46, 'Tong 5', 'Tong 5', '1', 0, 'liter', ''),
	(47, 'Tong 6', 'Tong 6', '1', 0, 'liter', ''),
	(48, 'Tong 7', 'Tong 7', '1', 0, 'liter', ''),
	(49, 'Tong 8', 'Tong 8', '1', 0, 'liter', ''),
	(50, 'Tong 9', 'Tong 9', '1', 0, 'liter', ''),
	(51, 'Tong 10', 'Tong 10', '1', 0, 'liter', ''),
	(52, 'Tong', 'Tong [Umum]', '0', 0, 'liter', ''),
	(53, 'Kapsul', 'Kapsul [Umum]', '0', 0, 'liter', ''),
	(54, 'Tanker', 'Tanker [Umum]', '0', 0, 'liter', '');
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


-- Dumping structure for table inventory.global_status
CREATE TABLE IF NOT EXISTS `global_status` (
  `idgps` smallint(6) NOT NULL,
  `nama_gps` char(50) NOT NULL,
  `desc_gps` varchar(150) NOT NULL,
  PRIMARY KEY (`idgps`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table inventory.global_status: ~7 rows (approximately)
DELETE FROM `global_status`;
/*!40000 ALTER TABLE `global_status` DISABLE KEYS */;
INSERT INTO `global_status` (`idgps`, `nama_gps`, `desc_gps`) VALUES
	(1, 'Tidak ada', 'Tidak ada'),
	(2, 'Glasir Ori', 'Glasir selesai tes bakar sudah di tong'),
	(3, 'Glasir Hold', 'Glasir sedang dilakukan proses setel atau setelah '),
	(4, 'Glasir Pass', 'Glasir sudah dilakukan proses setel siap digunakan'),
	(5, 'Glasir No Pass', 'Glasir tidak bisa digunakan'),
	(6, 'Glasir Recycle', 'Glasir Recycle'),
	(7, 'Glasir Scrap', 'Glasir Recycle');
/*!40000 ALTER TABLE `global_status` ENABLE KEYS */;


-- Dumping structure for table inventory.global_tong
CREATE TABLE IF NOT EXISTS `global_tong` (
  `id_area` smallint(6) NOT NULL AUTO_INCREMENT,
  `nama_area` varchar(50) NOT NULL,
  `jns_area` varchar(50) NOT NULL,
  `no_area` varchar(50) NOT NULL,
  `kapasitas` double NOT NULL,
  `satuan` char(50) NOT NULL,
  `lokasi` char(50) NOT NULL,
  PRIMARY KEY (`id_area`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table inventory.global_tong: ~3 rows (approximately)
DELETE FROM `global_tong`;
/*!40000 ALTER TABLE `global_tong` DISABLE KEYS */;
INSERT INTO `global_tong` (`id_area`, `nama_area`, `jns_area`, `no_area`, `kapasitas`, `satuan`, `lokasi`) VALUES
	(1, 'Tidak ada', 'Tidak ada', 'Tidak ada', 0, 'Tidak ada', 'Tidak ada'),
	(2, 'BGPS Glasir', 'Produksi', '1', 0, 'Tidak ada', ''),
	(3, 'Supply Glasir', 'Produksi', '2', 0, 'Tidak ada', '');
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

-- Dumping data for table inventory.jenis_barang: ~1 rows (approximately)
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


-- Dumping structure for trigger inventory.glasir_add_bgps
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='';
DELIMITER //
CREATE TRIGGER `glasir_add_bgps` AFTER INSERT ON `glasir_phd` FOR EACH ROW BEGIN 
UPDATE glasir 
SET s_bgps = s_bgps + (1.565*((NEW.densitas-1000)/1000)*NEW.volume)
WHERE
id_glasir = NEW.id_glasir AND 
NEW.id_bmt NOT IN (53);
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


-- Dumping structure for trigger inventory.glasir_add_supply_opna_supply
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='';
DELIMITER //
CREATE TRIGGER `glasir_add_supply_opna_supply` AFTER INSERT ON `glasir_ohd` FOR EACH ROW BEGIN
 IF NEW.area = 3 THEN
	UPDATE glasir SET s_supply = s_supply + (NEW.bkg) WHERE id_glasir = NEW.id_glasir AND NEW.area = 3;
 ELSEIF NEW.area = 2 THEN
 	UPDATE glasir SET s_bgps = s_bgps + (NEW.bkg) WHERE id_glasir = NEW.id_glasir AND NEW.area = 2;
 END IF;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;


-- Dumping structure for trigger inventory.glasir_add_supply_retu
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `glasir_add_supply_retu` AFTER INSERT ON `glasir_rhd` FOR EACH ROW BEGIN 
UPDATE glasir 
SET s_supply = s_supply + (1.565*((NEW.densitas-1000)/1000)*NEW.volume)
WHERE
id_glasir = NEW.id_glasir;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;


-- Dumping structure for trigger inventory.glasir_add_supply_tran
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `glasir_add_supply_tran` BEFORE DELETE ON `glasir_thd` FOR EACH ROW BEGIN 
UPDATE glasir 
SET s_supply = s_supply + (1.565*((OLD.densitas-1000)/1000)*OLD.volume)
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
OLD.id_bmt NOT IN (53);
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


-- Dumping structure for trigger inventory.glasir_min_supply_opna_supply
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='';
DELIMITER //
CREATE TRIGGER `glasir_min_supply_opna_supply` BEFORE DELETE ON `glasir_ohd` FOR EACH ROW BEGIN
 IF OLD.area = 3 THEN
	UPDATE glasir SET s_supply = s_supply - (OLD.bkg) WHERE id_glasir = OLD.id_glasir AND OLD.area = 3;
 ELSEIF OLD.area = 2 THEN
	UPDATE glasir SET s_bgps = s_bgps - (OLD.bkg) WHERE id_glasir = OLD.id_glasir AND OLD.area = 2;
 END IF;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;


-- Dumping structure for trigger inventory.glasir_min_supply_retu
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `glasir_min_supply_retu` BEFORE DELETE ON `glasir_rhd` FOR EACH ROW BEGIN 
UPDATE glasir 
SET s_supply = s_supply - (1.565*((OLD.densitas-1000)/1000)*OLD.volume)
WHERE
id_glasir = OLD.id_glasir;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;


-- Dumping structure for trigger inventory.glasir_min_supply_tran
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `glasir_min_supply_tran` AFTER INSERT ON `glasir_thd` FOR EACH ROW BEGIN 
UPDATE glasir 
SET s_supply = s_supply - (1.565*((NEW.densitas-1000)/1000)*NEW.volume)
WHERE
id_glasir = NEW.id_glasir;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
