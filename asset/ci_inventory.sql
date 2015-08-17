-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.5.44-0ubuntu0.14.04.1 - (Ubuntu)
-- Server OS:                    debian-linux-gnu
-- HeidiSQL Version:             9.2.0.4947
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping database structure for inventory
DROP DATABASE IF EXISTS `inventory`;
CREATE DATABASE IF NOT EXISTS `inventory` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `inventory`;


-- Dumping structure for table inventory.admins
DROP TABLE IF EXISTS `admins`;
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
DROP TABLE IF EXISTS `barang`;
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


-- Dumping structure for table inventory.bm
DROP TABLE IF EXISTS `bm`;
CREATE TABLE IF NOT EXISTS `bm` (
  `id_bm` smallint(6) NOT NULL AUTO_INCREMENT,
  `nama_bm` varchar(50) NOT NULL,
  `jns_bm` varchar(50) NOT NULL,
  `no_bm` varchar(50) NOT NULL,
  `kapasitas` double NOT NULL,
  `satuan` char(50) NOT NULL,
  `lokasi` char(50) NOT NULL,
  PRIMARY KEY (`id_bm`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table inventory.bm: ~20 rows (approximately)
DELETE FROM `bm`;
/*!40000 ALTER TABLE `bm` DISABLE KEYS */;
INSERT INTO `bm` (`id_bm`, `nama_bm`, `jns_bm`, `no_bm`, `kapasitas`, `satuan`, `lokasi`) VALUES
	(1, 'Ball Mill 200  kg', '200 kg', '1', 200, 'kg', ''),
	(2, 'Ball Mill 200  kg', '200 kg', '2', 200, 'kg', ''),
	(3, 'Ball Mill 200  kg', '200 kg', '3', 200, 'kg', ''),
	(4, 'Ball Mill 200  kg', '200 kg', '4', 200, 'kg', ''),
	(5, 'Ball Mill 500  kg', '500 kg', '1', 500, 'kg', ''),
	(6, 'Ball Mill 500  kg', '500 kg', '2', 500, 'kg', ''),
	(7, 'Ball Mill 500  kg', '500 kg', '3', 500, 'kg', ''),
	(8, 'Ball Mill 500  kg', '500 kg', '4', 500, 'kg', ''),
	(9, 'Ball Mill 500  kg', '500 kg', '5', 500, 'kg', ''),
	(10, 'Ball Mill 500  kg', '500 kg', '6', 500, 'kg', ''),
	(11, 'Ball Mill 500  kg', '500 kg', '7', 500, 'kg', ''),
	(12, 'Ball Mill 500  kg', '500 kg', '8', 500, 'kg', ''),
	(13, 'Ball Mill 500  kg', '500 kg', '9', 500, 'kg', ''),
	(14, 'Ball Mill 500  kg', '500 kg', '10', 500, 'kg', ''),
	(15, 'Ball Mill 2 ton', '2 ton', '1', 2000, 'kg', ''),
	(16, 'Ball Mill 2 ton', '2 ton', '2', 2000, 'kg', ''),
	(17, 'Ball Mill 2 ton', '2 ton', '3', 2000, 'kg', ''),
	(18, 'Ball Mill 3 ton', '3 ton', '1', 3000, 'kg', ''),
	(19, 'Ball Mill 3 ton', '3 ton', '5', 3000, 'kg', ''),
	(20, 'Ball Mill 3 ton', '3 ton', 'P3', 3000, 'kg', '');
/*!40000 ALTER TABLE `bm` ENABLE KEYS */;


-- Dumping structure for table inventory.ci_sessions
DROP TABLE IF EXISTS `ci_sessions`;
CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table inventory.ci_sessions: ~16 rows (approximately)
DELETE FROM `ci_sessions`;
/*!40000 ALTER TABLE `ci_sessions` DISABLE KEYS */;
INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
	('0762fb3dbdbec5a5facbca96361b45cb', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:39.0) Gecko/20100101 Firefox/39.0', 1439195960, 'a:6:{s:9:"user_data";s:0:"";s:9:"logged_in";s:13:"aingLoginYeuh";s:8:"username";s:5:"admin";s:12:"nama_lengkap";s:13:"Administrator";s:4:"foto";s:9:"admin.jpg";s:5:"level";s:2:"01";}'),
	('0b07fa1243a9f46892a3a5f129de028e', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:39.0) Gecko/20100101 Firefox/39.0', 1439012329, ''),
	('0c3ac7dc4e85788ea40ca1d57aa63a55', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:39.0) Gecko/20100101 Firefox/39.0', 1439012651, ''),
	('39d9ffbdb19486e9574349425c9ed379', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:39.0) Gecko/20100101 Firefox/39.0', 1439164721, ''),
	('3cfb485be5d43aaebf0454bff67ea9e5', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:39.0) Gecko/20100101 Firefox/39.0', 1439013983, 'a:6:{s:9:"user_data";s:0:"";s:9:"logged_in";s:13:"aingLoginYeuh";s:8:"username";s:5:"admin";s:12:"nama_lengkap";s:13:"Administrator";s:4:"foto";s:9:"admin.jpg";s:5:"level";s:2:"01";}'),
	('4c82d6d34ec39af35b24f4acac346865', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:39.0) Gecko/20100101 Firefox/39.0', 1439200681, ''),
	('5e6eabcd5adc0a3c4917d19ffeef0f1c', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:39.0) Gecko/20100101 Firefox/39.0', 1439013630, ''),
	('7e3f3cceb8858d0169bbe41fa95f0f7b', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:39.0) Gecko/20100101 Firefox/39.0', 1439011512, 'a:6:{s:9:"user_data";s:0:"";s:9:"logged_in";s:13:"aingLoginYeuh";s:8:"username";s:5:"admin";s:12:"nama_lengkap";s:13:"Administrator";s:4:"foto";s:9:"admin.jpg";s:5:"level";s:2:"01";}'),
	('7f3a03e93d457bb8490a9ab4d9882147', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:39.0) Gecko/20100101 Firefox/39.0', 1439200681, ''),
	('8752842a9d6ce264dc9e354963520bfb', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:39.0) Gecko/20100101 Firefox/39.0', 1439010068, ''),
	('9fcb0e4716221b927153b5dc1d036068', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:39.0) Gecko/20100101 Firefox/39.0', 1439011166, 'a:6:{s:9:"user_data";s:0:"";s:9:"logged_in";s:13:"aingLoginYeuh";s:8:"username";s:5:"admin";s:12:"nama_lengkap";s:13:"Administrator";s:4:"foto";s:9:"admin.jpg";s:5:"level";s:2:"01";}'),
	('b3bfe4ca9a502c810a743b48889f42ba', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:39.0) Gecko/20100101 Firefox/39.0', 1439013630, ''),
	('c9d9d37a67d600030d861126bd3a6f97', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:39.0) Gecko/20100101 Firefox/39.0', 1439010068, ''),
	('e7fc66a52c0a80e71dc02ca2cae670ce', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:39.0) Gecko/20100101 Firefox/39.0', 1439010373, 'a:6:{s:9:"user_data";s:0:"";s:9:"logged_in";s:13:"aingLoginYeuh";s:8:"username";s:5:"admin";s:12:"nama_lengkap";s:13:"Administrator";s:4:"foto";s:9:"admin.jpg";s:5:"level";s:2:"01";}'),
	('eb9e0bc0b6f9fd88243715d06d0b4111', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:39.0) Gecko/20100101 Firefox/39.0', 1439013630, ''),
	('fed93a1d3d25527e019d2267033ede6c', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:39.0) Gecko/20100101 Firefox/39.0', 1439010068, 'a:6:{s:9:"user_data";s:0:"";s:9:"logged_in";s:13:"aingLoginYeuh";s:8:"username";s:5:"admin";s:12:"nama_lengkap";s:13:"Administrator";s:4:"foto";s:9:"admin.jpg";s:5:"level";s:2:"01";}');
/*!40000 ALTER TABLE `ci_sessions` ENABLE KEYS */;


-- Dumping structure for table inventory.d_beli
DROP TABLE IF EXISTS `d_beli`;
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
DROP TABLE IF EXISTS `d_jual`;
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
DROP TABLE IF EXISTS `glasir`;
CREATE TABLE IF NOT EXISTS `glasir` (
  `id_glasir` varchar(50) NOT NULL,
  `nama_glasir` varchar(50) NOT NULL,
  `nama_alias` varchar(50) NOT NULL,
  `satuan` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `inputer` varchar(50) NOT NULL,
  `tgl_input` datetime NOT NULL,
  `tgl_update` datetime NOT NULL,
  `stok_awal` decimal(10,0) NOT NULL,
  PRIMARY KEY (`id_glasir`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table inventory.glasir: ~225 rows (approximately)
DELETE FROM `glasir`;
/*!40000 ALTER TABLE `glasir` DISABLE KEYS */;
INSERT INTO `glasir` (`id_glasir`, `nama_glasir`, `nama_alias`, `satuan`, `status`, `inputer`, `tgl_input`, `tgl_update`, `stok_awal`) VALUES
	('Y00001', '0202 Brown', 'Brown si madun', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '2015-08-07 03:39:22', 100),
	('Y00002', '0202 Brown Floral dream', 'Mirip jenis sabun', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 100),
	('Y00003', '0202 Pink', 'Pink jambu muda', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 100),
	('Y00004', '0401 Blue', 'Blue coral', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 100),
	('Y00005', '0401 Pink', 'Pink ngejreng', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 100),
	('Y00006', '0402 Blue', 'Blue langit', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 100),
	('Y00007', '1Tone 5101 Clay', 'Wantun kley', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 100),
	('Y00008', '1Tone 5102 Spruce', 'Wantun sprus', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 100),
	('Y00009', '1Tone 8034 Graphite', 'Wantun garapit', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 100),
	('Y00010', '1Tone 8040 Cream', 'Wantun Krim', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 100),
	('Y00011', '1Tone 8045 Raspberry', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00012', '1Tone 8046 Chocolate', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00013', '1Tone 8049 Suede', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00014', '1Tone 8050 Indigo Blue', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00015', '1Tone 8052 Brown', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00016', '1Tone 8053 Slate', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00017', '1Tone 8059 Moss', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00018', '1Tone 8065 Mustard', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00019', '1Tone 8067 Burgundy', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00020', '1Tone 8090 White', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00021', '1Tone 8092 Teracota', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00022', '1Tone 8093 Turquoise', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00023', '1Tone 8094 Apple', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00024', '1Tone 8098 Plum', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00025', '1Tone 8099 Ice Blue', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00026', '1Tone 8483 Grey', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00027', '1Tone 8484 Blue', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00028', '1Tone 8485 Green', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00029', '1Tone 8486 Purple', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00030', '1Tone 8491 Yellow', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00031', '5100 Chocolate', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00032', '5101 Clay', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00033', '5102 Spruce', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00034', '5300 Summer', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00035', '8034 Graphite', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00036', '8040 Cream', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00037', '8045 Raspberry', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00038', '8046 Chocolate', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00039', '8049 Suede', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00040', '8050 Indigo Blue', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00041', '8050 Indigo Blue shiny', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00042', '8051 Green Forest', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00043', '8052 Brown', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00044', '8052 Brown shiny', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00045', '8053 Slate', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00046', '8053 Slate shiny', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00047', '8059 Moss', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00048', '8059 Moss shiny', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00049', '8065 Mustard', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00050', '8067 Burgundy', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00051', '8067 Burgundy shiny', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00052', '8079 Blue', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00053', '8082 Green', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00054', '8083 Yellow', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00055', '8090 Engobe', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00056', '8090 White', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00057', '8092 Teracota', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00058', '8093 Turquoise', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00059', '8094 Apple', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00060', '8096 Blue', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00061', '8097 Green', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00062', '8098 Plum', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00063', '8099 Ice Blue', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00064', '8170 Blue', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00065', '8170 Green', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00066', '8483 Grey', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00067', '8484 Blue', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00068', '8485 Green', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00069', '8486 Purple', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00070', '8491 Yellow', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00071', 'Andante Brown', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00072', 'Andante Gloss', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00073', 'Andante Lime Green', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00074', 'Andante Red', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00075', 'Andante Turquoise', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00076', 'Andante White', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00077', 'Anis Green', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00078', 'Antique White', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00079', 'Bali Green', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00080', 'Barella Blue Ice', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00081', 'Barella Cafe Latte', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00082', 'Barella French Vanilla', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00083', 'Bastide Brown', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00084', 'Beige Light', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00085', 'Black', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00086', 'Black BOB', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00087', 'Black Matte', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00088', 'Black Migros', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00089', 'Black Noir', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00090', 'Black STN', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00091', 'Black Stone', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00092', 'Blue', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00093', 'Blue Contempo', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00094', 'Blue Ice', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00095', 'Blue Peppercone', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00096', 'Brown', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00097', 'Brown Orchid', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00098', 'Brown Reactive+Speckle', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00099', 'Brown Stitch', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00100', 'Brown+Speckle', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00101', 'Clear+Black Speckle', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00102', 'Combee', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00103', 'Cool Grey 11 C', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00104', 'Cream', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00105', 'Cream Colorvara', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00106', 'Cream JCC', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00107', 'Cream Kaolin', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00108', 'Cream Orchid', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00109', 'Dark Brown Unitable', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00110', 'Dark Heather 5135C (Pantone 258C)', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00111', 'Dark Orange', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00112', 'Debenham Cream', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00113', 'Fronside Kona', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00114', 'Gloss', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00115', 'Gloss Epi', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00116', 'Gloss ICS', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00117', 'GOG', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00118', 'Green', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00119', 'Green Bali', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00120', 'Green Colour Yellow', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00121', 'Green Leaves', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00122', 'Green Reactive', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00123', 'Green Semi Matte', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00124', 'Green Ubud', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00125', 'Gres Fermier', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00126', 'Gress Fermier Grey', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00127', 'Gress Fermier Moss', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00128', 'Grey', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00129', 'Grey JCC', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00130', 'Ice Blue', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00131', 'Italla Apple Red', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00132', 'Italla Edelweish', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00133', 'Italla Graphite', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00134', 'Italla Pale Rose', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00135', 'Italla Sand Glossy', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00136', 'Italla White Glossy', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00137', 'Lava White', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00138', 'Lavender', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00139', 'Light 8050 Indigo Blue', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00140', 'Light 8052 Brown', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00141', 'Light 8053 Slate', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00142', 'Light 8059 Moss', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00143', 'Light 8067 Burgundy', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00144', 'Living Stone Red', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00145', 'Migros Dark Blue', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00146', 'Migros Dark Orange', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00147', 'Mikasa Cream', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00148', 'Mocca', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00149', 'Narumi Cream', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00150', 'New Blue', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00151', 'Ocean Blue', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00152', 'Oneida Green', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00153', 'Orange', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00154', 'P 5555C', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00155', 'Panama Falabela', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00156', 'Pantone 137 C/ Org', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00157', 'Picasso Jaune', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00158', 'Picasso Yellow', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00159', 'Pink', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00160', 'Pink Broderie', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00161', 'Pink Maison', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00162', 'Pink Serena', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00163', 'Purple Beneton', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00164', 'Purple Burgundi', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00165', 'Purple Light', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00166', 'Purple Serena', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00167', 'Reactive Green', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00168', 'Reactive Orange', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00169', 'Reactive Yellow', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00170', 'Red', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00171', 'Red Beneton', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00172', 'Red Chilli', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00173', 'Red Coble', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00174', 'Red Lohan', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00175', 'Red Small Tube', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00176', 'Sage Green', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00177', 'Savanah 3', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00178', 'Savanah Meil', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00179', 'Savanah Noritake', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00180', 'Savanah Speckle', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00181', 'Spice Cayenne', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00182', 'Spice Cilantro', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00183', 'Spice Saffron', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00184', 'Sudo Blue', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00185', 'Tarrerias Griss', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00186', 'Taupe', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00187', 'Ter Lichen', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00188', 'Terrarias Red', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00189', 'Terre Dombre', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00190', 'TOT', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00191', 'Turquise', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00192', 'Turquise Serena', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00193', 'Turquoise Matt', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00194', 'Upper Lava D1/2', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00195', 'Upper White Verceral', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00196', 'Violet 258C', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00197', 'Warm Grey Colorama', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00198', 'WB Cream', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00199', 'WB Pink', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00200', 'WB Powder Blue', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00201', 'WB Sage', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00202', 'White', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00203', 'White Glossy', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00204', 'White Kaolin', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00205', 'White Peptapon', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00206', 'Winterberry Cream', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00207', 'Winterberry Cream ICS', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00208', 'Yello Kuta', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00209', 'Yellow', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00210', 'Yellow C', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00211', 'Yellow Kuta', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0),
	('Y00212', 'Yellow Serena', '', 'Liter', '1', 'admin', '2015-08-07 09:09:08', '0000-00-00 00:00:00', 0);
/*!40000 ALTER TABLE `glasir` ENABLE KEYS */;


-- Dumping structure for table inventory.glasir_status
DROP TABLE IF EXISTS `glasir_status`;
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


-- Dumping structure for table inventory.gps
DROP TABLE IF EXISTS `gps`;
CREATE TABLE IF NOT EXISTS `gps` (
  `idgps` smallint(6) NOT NULL,
  `nama_gps` char(50) NOT NULL,
  `desc_gps` varchar(150) NOT NULL,
  PRIMARY KEY (`idgps`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table inventory.gps: ~6 rows (approximately)
DELETE FROM `gps`;
/*!40000 ALTER TABLE `gps` DISABLE KEYS */;
INSERT INTO `gps` (`idgps`, `nama_gps`, `desc_gps`) VALUES
	(1, 'Selesai Milling', 'Glasir selesai milling belum tes bakar'),
	(2, 'Glasir Ori', 'Glasir selesai tes bakar sudah di tong'),
	(3, 'Glasir Hold', 'Glasir sedang dilakukan proses setel atau setelah '),
	(4, 'Glasir Pass', 'Glasir sudah dilakukan proses setel siap digunakan'),
	(5, 'Glasir No Pass', 'Glasir tidak bisa digunakan'),
	(6, 'Glasir Return', 'Glasir pengembalian dari conveyer');
/*!40000 ALTER TABLE `gps` ENABLE KEYS */;


-- Dumping structure for table inventory.h_beli
DROP TABLE IF EXISTS `h_beli`;
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
DROP TABLE IF EXISTS `h_jual`;
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
DROP TABLE IF EXISTS `jenis_barang`;
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
DROP TABLE IF EXISTS `level`;
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


-- Dumping structure for table inventory.phd_glasir
DROP TABLE IF EXISTS `phd_glasir`;
CREATE TABLE IF NOT EXISTS `phd_glasir` (
  `idphd` smallint(6) NOT NULL AUTO_INCREMENT,
  `no_prod` char(15) NOT NULL,
  `id_glasir` varchar(50) NOT NULL,
  `idgps` smallint(6) NOT NULL,
  `wkt_prod` datetime NOT NULL,
  `volume` double NOT NULL,
  `densitas` double NOT NULL,
  `id_bm` smallint(6) NOT NULL,
  `id_tong` smallint(6) NOT NULL,
  `inputer` char(50) NOT NULL,
  `petugas` char(50) NOT NULL,
  `tgl_insert` datetime NOT NULL,
  PRIMARY KEY (`idphd`),
  KEY `kodebeli` (`no_prod`),
  KEY `kode_barang` (`id_glasir`),
  KEY `phd_glasir_ibfk_3` (`idgps`),
  CONSTRAINT `phd_glasir_ibfk_1` FOREIGN KEY (`no_prod`) REFERENCES `ph_glasir` (`no_prod`),
  CONSTRAINT `phd_glasir_ibfk_2` FOREIGN KEY (`id_glasir`) REFERENCES `glasir` (`id_glasir`),
  CONSTRAINT `phd_glasir_ibfk_3` FOREIGN KEY (`idgps`) REFERENCES `gps` (`idgps`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table inventory.phd_glasir: ~2 rows (approximately)
DELETE FROM `phd_glasir`;
/*!40000 ALTER TABLE `phd_glasir` DISABLE KEYS */;
INSERT INTO `phd_glasir` (`idphd`, `no_prod`, `id_glasir`, `idgps`, `wkt_prod`, `volume`, `densitas`, `id_bm`, `id_tong`, `inputer`, `petugas`, `tgl_insert`) VALUES
	(1, 'PG00001', 'Y00001', 1, '2015-08-07 15:01:01', 50, 1600, 1, 1, 'sukini', 'zainudin', '2015-08-07 15:01:01'),
	(2, 'PG00001', 'Y00001', 1, '2015-08-07 15:01:01', 50, 1600, 1, 1, 'sukini', 'zainudin', '2015-08-07 15:01:01');
/*!40000 ALTER TABLE `phd_glasir` ENABLE KEYS */;


-- Dumping structure for table inventory.ph_glasir
DROP TABLE IF EXISTS `ph_glasir`;
CREATE TABLE IF NOT EXISTS `ph_glasir` (
  `no_prod` char(15) NOT NULL,
  `tgl_plng` date NOT NULL,
  `no_po` char(15) NOT NULL,
  `inputer` varchar(50) NOT NULL,
  `planner` varchar(50) NOT NULL,
  `tgl_inp` datetime NOT NULL,
  `lst_upd` datetime NOT NULL,
  PRIMARY KEY (`no_prod`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table inventory.ph_glasir: ~1 rows (approximately)
DELETE FROM `ph_glasir`;
/*!40000 ALTER TABLE `ph_glasir` DISABLE KEYS */;
INSERT INTO `ph_glasir` (`no_prod`, `tgl_plng`, `no_po`, `inputer`, `planner`, `tgl_inp`, `lst_upd`) VALUES
	('PG00001', '2015-08-13', 'OG00001', 'admin', 'Masitoh', '2015-08-07 15:01:01', '0000-00-00 00:00:00');
/*!40000 ALTER TABLE `ph_glasir` ENABLE KEYS */;


-- Dumping structure for table inventory.supplier
DROP TABLE IF EXISTS `supplier`;
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


-- Dumping structure for table inventory.tong
DROP TABLE IF EXISTS `tong`;
CREATE TABLE IF NOT EXISTS `tong` (
  `id_tong` smallint(6) NOT NULL AUTO_INCREMENT,
  `nama_tong` varchar(50) NOT NULL,
  `jns_tong` varchar(50) NOT NULL,
  `no_tong` varchar(50) NOT NULL,
  `kapasitas` double NOT NULL,
  `satuan` char(50) NOT NULL,
  `lokasi` char(50) NOT NULL,
  PRIMARY KEY (`id_tong`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table inventory.tong: ~11 rows (approximately)
DELETE FROM `tong`;
/*!40000 ALTER TABLE `tong` DISABLE KEYS */;
INSERT INTO `tong` (`id_tong`, `nama_tong`, `jns_tong`, `no_tong`, `kapasitas`, `satuan`, `lokasi`) VALUES
	(1, 'Tong 1', 'Tong Glasir 1', '1', 200, 'kg', ''),
	(2, 'Tong 2', 'Tong Glasir 2', '2', 200, 'kg', ''),
	(3, 'Tong 3', 'Tong Glasir 3', '3', 200, 'kg', ''),
	(4, 'Tong 4', 'Tong Glasir 4', '4', 200, 'kg', ''),
	(5, 'Tong 5', 'Tong Glasir 5', '5', 200, 'kg', ''),
	(6, 'Tong 6', 'Tong Glasir 6', '6', 200, 'kg', ''),
	(7, 'Tong 7', 'Tong Glasir 7', '7', 200, 'kg', ''),
	(8, 'Tong 8', 'Tong Glasir 8', '8', 200, 'kg', ''),
	(9, 'Tong 9', 'Tong Glasir 9', '9', 200, 'kg', ''),
	(10, 'Tong 10', 'Tong Glasir 10', '10', 200, 'kg', ''),
	(11, 'Tong 11', 'Tong Glasir 12', '11', 200, 'kg', '');
/*!40000 ALTER TABLE `tong` ENABLE KEYS */;


-- Dumping structure for trigger inventory.kurang_stok
DROP TRIGGER IF EXISTS `kurang_stok`;
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
DROP TRIGGER IF EXISTS `kurang_stok_jual`;
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
DROP TRIGGER IF EXISTS `tambah_stok`;
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
DROP TRIGGER IF EXISTS `tambah_stok_jual`;
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
