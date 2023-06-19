/*
 Navicat Premium Data Transfer

 Source Server         : MacOs okal
 Source Server Type    : MySQL
 Source Server Version : 50734
 Source Host           : localhost:3306
 Source Schema         : jessy

 Target Server Type    : MySQL
 Target Server Version : 50734
 File Encoding         : 65001

 Date: 19/06/2023 15:54:44
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for tb_beban
-- ----------------------------
DROP TABLE IF EXISTS `tb_beban`;
CREATE TABLE `tb_beban` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `kode_beban` varchar(255) NOT NULL,
  `nama_beban` varchar(100) NOT NULL,
  `keterangan` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_beban
-- ----------------------------
BEGIN;
INSERT INTO `tb_beban` VALUES (1, 'BBNLIS', 'Listrik', 'pembayaran listrik', '2023-05-18 14:33:30', '2023-05-18 14:41:42');
INSERT INTO `tb_beban` VALUES (2, 'BBNAIR', 'PDAM', 'Pembayaran Air PDAM', '2023-05-31 09:51:11', '2023-05-31 09:51:11');
COMMIT;

-- ----------------------------
-- Table structure for tb_penerimaan
-- ----------------------------
DROP TABLE IF EXISTS `tb_penerimaan`;
CREATE TABLE `tb_penerimaan` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `no_income` varchar(255) NOT NULL,
  `jumlah_penerimaan` int(16) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `tanggal_penerimaan` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_penerimaan
-- ----------------------------
BEGIN;
INSERT INTO `tb_penerimaan` VALUES (1, 'I002/VI/2023', 500000, 'Pemasukan Awal Edit', '2023-06-19', '2023-06-19 13:00:33', '2023-06-19 13:15:07');
INSERT INTO `tb_penerimaan` VALUES (2, 'I001/VI/2023', 1000000, 'Penerimaan 0', '2023-06-01', '2023-06-19 15:38:03', '2023-06-19 15:38:03');
COMMIT;

-- ----------------------------
-- Table structure for tb_pengeluaran
-- ----------------------------
DROP TABLE IF EXISTS `tb_pengeluaran`;
CREATE TABLE `tb_pengeluaran` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `no_expenditure` varchar(255) NOT NULL,
  `jumlah_pengeluaran` int(16) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `tanggal_pengeluaran` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_pengeluaran
-- ----------------------------
BEGIN;
INSERT INTO `tb_pengeluaran` VALUES (1, 'E001/VI/2023', 5000000, 'Pengeluaran 1 Edit', '2023-06-19', '2023-06-19 13:23:34', '2023-06-19 13:23:42');
COMMIT;

-- ----------------------------
-- Table structure for tb_users
-- ----------------------------
DROP TABLE IF EXISTS `tb_users`;
CREATE TABLE `tb_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `status` varchar(1) DEFAULT '0',
  `role` enum('admin','owner') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `nama` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_users
-- ----------------------------
BEGIN;
INSERT INTO `tb_users` VALUES (1, 'admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '1', 'admin', '2022-12-14 21:52:28', '2022-12-14 21:52:28', 'Administrator');
INSERT INTO `tb_users` VALUES (16, 'owner', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '1', 'owner', '2023-03-25 21:12:31', '2023-03-25 21:12:31', 'Owener');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
