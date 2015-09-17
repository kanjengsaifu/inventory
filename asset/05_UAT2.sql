-- --------------------------------------------------------
-- Host:                         192.168.2.3
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
	('rosmiati', '9284e0ff53e24a17c0e6e4e91a1e1ee1', 'Rosmiyati', '01', 'N', ''),
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
	('2420dd2c87ff2ead1d2aec6e4b9a2e92', '192.168.2.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/45.0.2454.85 Safari/537.36', 1441856199, 'a:6:{s:9:"user_data";s:0:"";s:9:"logged_in";s:13:"aingLoginYeuh";s:8:"username";s:5:"admin";s:12:"nama_lengkap";s:13:"Administrator";s:4:"foto";s:9:"admin.jpg";s:5:"level";s:2:"01";}'),
	('56a97ea85faa567bf9c0caf6de594c0d', '192.168.2.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0', 1441674522, 'a:6:{s:9:"user_data";s:0:"";s:9:"logged_in";s:13:"aingLoginYeuh";s:8:"username";s:5:"admin";s:12:"nama_lengkap";s:13:"Administrator";s:4:"foto";s:9:"admin.jpg";s:5:"level";s:2:"01";}'),
	('a1886c16548e0177932efa82fe84503e', '192.168.2.1', 'Mozilla/5.0 (Windows NT 6.1; rv:40.0) Gecko/20100101 Firefox/40.0', 1441676895, 'a:6:{s:9:"user_data";s:0:"";s:9:"logged_in";s:13:"aingLoginYeuh";s:8:"username";s:5:"admin";s:12:"nama_lengkap";s:13:"Administrator";s:4:"foto";s:9:"admin.jpg";s:5:"level";s:2:"01";}');
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

-- Dumping data for table inventory.glasir: ~245 rows (approximately)
DELETE FROM `glasir`;
/*!40000 ALTER TABLE `glasir` DISABLE KEYS */;
INSERT INTO `glasir` (`id_glasir`, `nama_glasir`, `nama_alias`, `satuan`, `status`, `s_bgps`, `s_supply`, `inputer`, `tgl_input`, `tgl_update`) VALUES
	('Y00001', '0202 Brown', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '2015-08-17 03:44:18'),
	('Y00002', '0202 Brown Floral dream', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00003', '0202 Pink', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00004', '0401 Blue', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00005', '0401 Pink', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00006', '0402 Blue', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00007', '1Tone 5101 Clay', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00008', '1Tone 5102 Spruce', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00009', '1Tone 8034 Graphite', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00010', '1Tone 8040 Cream', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
	('Y00011', '1Tone 8045 Raspberry', '', 'Kilogram', '1', 0, 0, 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00'),
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


-- Dumping structure for table inventory.glasir_oh
CREATE TABLE IF NOT EXISTS `glasir_oh` (
  `no_prod` char(15) NOT NULL,
  `inputer` varchar(50) NOT NULL,
  `tgl_inp` datetime NOT NULL,
  `lst_upd` datetime NOT NULL,
  PRIMARY KEY (`no_prod`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table inventory.glasir_oh: ~0 rows (approximately)
DELETE FROM `glasir_oh`;
/*!40000 ALTER TABLE `glasir_oh` DISABLE KEYS */;
/*!40000 ALTER TABLE `glasir_oh` ENABLE KEYS */;


-- Dumping structure for table inventory.glasir_ohd
CREATE TABLE IF NOT EXISTS `glasir_ohd` (
  `idthd` smallint(6) NOT NULL AUTO_INCREMENT,
  `no_prod` char(15) NOT NULL,
  `id_glasir` varchar(50) NOT NULL,
  `shift` smallint(6) NOT NULL,
  `dsc` varchar(255) NOT NULL,
  `area` varchar(255) NOT NULL,
  `volume` double NOT NULL,
  `densitas` double NOT NULL,
  `sts` double NOT NULL,
  `selisih` double NOT NULL,
  `vsc` double NOT NULL,
  `inputer` varchar(50) NOT NULL,
  `petugas` varchar(50) NOT NULL,
  `tgl` date NOT NULL,
  `jam` time NOT NULL,
  `tgl_insert` datetime NOT NULL,
  PRIMARY KEY (`idthd`),
  KEY `FK_glasir_ohd_glasir_oh` (`no_prod`),
  KEY `FK_glasir_ohd_glasir` (`id_glasir`),
  KEY `FK_glasir_ohd_admins` (`inputer`),
  CONSTRAINT `FK_glasir_ohd_admins` FOREIGN KEY (`inputer`) REFERENCES `admins` (`username`),
  CONSTRAINT `FK_glasir_ohd_glasir` FOREIGN KEY (`id_glasir`) REFERENCES `glasir` (`id_glasir`),
  CONSTRAINT `FK_glasir_ohd_glasir_oh` FOREIGN KEY (`no_prod`) REFERENCES `glasir_oh` (`no_prod`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table inventory.glasir_ohd: ~0 rows (approximately)
DELETE FROM `glasir_ohd`;
/*!40000 ALTER TABLE `glasir_ohd` DISABLE KEYS */;
/*!40000 ALTER TABLE `glasir_ohd` ENABLE KEYS */;


-- Dumping structure for table inventory.glasir_ph
CREATE TABLE IF NOT EXISTS `glasir_ph` (
  `no_prod` char(15) NOT NULL,
  `inputer` varchar(50) NOT NULL,
  `tgl_inp` datetime NOT NULL,
  `lst_upd` datetime NOT NULL,
  PRIMARY KEY (`no_prod`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table inventory.glasir_ph: ~0 rows (approximately)
DELETE FROM `glasir_ph`;
/*!40000 ALTER TABLE `glasir_ph` DISABLE KEYS */;
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
  `tgl_insert` datetime NOT NULL,
  PRIMARY KEY (`idphd`),
  KEY `FK_glasir_phd_glasir` (`id_glasir`),
  KEY `FK_glasir_phd_glasir_ph` (`no_prod`),
  KEY `FK_glasir_phd_admins` (`inputer`),
  KEY `FK_glasir_phd_global_mesin` (`id_bm`),
  KEY `FK_glasir_phd_global_shift` (`shift`),
  CONSTRAINT `FK_glasir_phd_global_mesin` FOREIGN KEY (`id_bm`) REFERENCES `global_mesin` (`id_bm`),
  CONSTRAINT `FK_glasir_phd_global_shift` FOREIGN KEY (`shift`) REFERENCES `global_shift` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table inventory.glasir_phd: ~0 rows (approximately)
DELETE FROM `glasir_phd`;
/*!40000 ALTER TABLE `glasir_phd` DISABLE KEYS */;
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
  KEY `FK_glasir_phd_sp_global_status` (`id_gps`),
  KEY `FK_glasir_phd_sp_global_shift` (`shift`),
  CONSTRAINT `FK_glasir_phd_sp_global_shift` FOREIGN KEY (`shift`) REFERENCES `global_shift` (`id`),
  CONSTRAINT `FK_glasir_phd_sp_global_status` FOREIGN KEY (`id_gps`) REFERENCES `global_status` (`idgps`),
  CONSTRAINT `glasir_phd_sp_ibfk_1` FOREIGN KEY (`id_bm`) REFERENCES `global_mesin` (`id_bm`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table inventory.glasir_phd_sp: ~0 rows (approximately)
DELETE FROM `glasir_phd_sp`;
/*!40000 ALTER TABLE `glasir_phd_sp` DISABLE KEYS */;
/*!40000 ALTER TABLE `glasir_phd_sp` ENABLE KEYS */;


-- Dumping structure for table inventory.glasir_ph_sp
CREATE TABLE IF NOT EXISTS `glasir_ph_sp` (
  `no_prod` char(15) NOT NULL,
  `inputer` varchar(50) NOT NULL,
  `tgl_inp` datetime NOT NULL,
  `lst_upd` datetime NOT NULL,
  PRIMARY KEY (`no_prod`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table inventory.glasir_ph_sp: ~0 rows (approximately)
DELETE FROM `glasir_ph_sp`;
/*!40000 ALTER TABLE `glasir_ph_sp` DISABLE KEYS */;
/*!40000 ALTER TABLE `glasir_ph_sp` ENABLE KEYS */;


-- Dumping structure for table inventory.glasir_rh
CREATE TABLE IF NOT EXISTS `glasir_rh` (
  `no_prod` char(15) NOT NULL,
  `inputer` varchar(50) NOT NULL,
  `tgl_inp` datetime NOT NULL,
  `lst_upd` datetime NOT NULL,
  PRIMARY KEY (`no_prod`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table inventory.glasir_rh: ~4 rows (approximately)
DELETE FROM `glasir_rh`;
/*!40000 ALTER TABLE `glasir_rh` DISABLE KEYS */;
INSERT INTO `glasir_rh` (`no_prod`, `inputer`, `tgl_inp`, `lst_upd`) VALUES
	('RG00001', 'admin', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	('RG00003', 'admin', '2015-08-24 07:53:43', '0000-00-00 00:00:00'),
	('RG00004', 'admin', '2015-08-28 05:24:48', '0000-00-00 00:00:00'),
	('RG00005', 'admin', '2015-09-03 10:04:11', '0000-00-00 00:00:00');
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
  `jam` time NOT NULL,
  `tgl_insert` datetime NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table inventory.glasir_rhd: ~0 rows (approximately)
DELETE FROM `glasir_rhd`;
/*!40000 ALTER TABLE `glasir_rhd` DISABLE KEYS */;
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
  PRIMARY KEY (`no_prod`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table inventory.glasir_th: ~4 rows (approximately)
DELETE FROM `glasir_th`;
/*!40000 ALTER TABLE `glasir_th` DISABLE KEYS */;
INSERT INTO `glasir_th` (`no_prod`, `inputer`, `tgl_inp`, `lst_upd`) VALUES
	('RG00004', 'admin', '2015-09-03 09:58:30', '0000-00-00 00:00:00'),
	('TG00001', 'admin', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	('TG00003', 'admin', '2015-08-24 07:53:43', '0000-00-00 00:00:00'),
	('TG00004', 'admin', '2015-08-28 05:24:48', '0000-00-00 00:00:00');
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
  `jam` time NOT NULL,
  `tgl_insert` datetime NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table inventory.glasir_thd: ~0 rows (approximately)
DELETE FROM `glasir_thd`;
/*!40000 ALTER TABLE `glasir_thd` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

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
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table inventory.global_mesin: ~51 rows (approximately)
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
	(51, 'Tong 10', 'Tong 10', '1', 0, 'liter', '');
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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

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
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
