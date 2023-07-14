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

 Date: 24/06/2023 12:05:55
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for tb_akun
-- ----------------------------
DROP TABLE IF EXISTS `tb_akun`;
CREATE TABLE `tb_akun` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `kode_akun` varchar(16) NOT NULL,
  `nama_akun` varchar(100) NOT NULL,
  `kelompok_akun` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_akun
-- ----------------------------
BEGIN;
INSERT INTO `tb_akun` VALUES (4, 'PD', '001', '0012', '2023-06-21 19:59:03', '2023-06-23 23:32:36');
INSERT INTO `tb_akun` VALUES (5, 'PD02', '002', '002', '2023-06-21 20:30:19', '2023-06-21 20:30:19');
COMMIT;

-- ----------------------------
-- Table structure for tb_transaksi
-- ----------------------------
DROP TABLE IF EXISTS `tb_transaksi`;
CREATE TABLE `tb_transaksi` (
  `id` int(16) NOT NULL AUTO_INCREMENT,
  `no_transaksi` varchar(255) NOT NULL,
  `kode_akun` varchar(16) NOT NULL,
  `penerimaan` int(16) DEFAULT NULL,
  `pengeluaran` int(16) DEFAULT NULL,
  `keterangan` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `id_pengguna` int(5) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_transaksi
-- ----------------------------
BEGIN;
INSERT INTO `tb_transaksi` VALUES (3, 'TRK000001', 'PD', 1500000, NULL, 'Masukan Ketssss', '2023-06-23', 1, '2023-06-23 23:45:36', '2023-06-24 00:06:15');
INSERT INTO `tb_transaksi` VALUES (5, 'TRK000002', 'PD02', NULL, 300000, 'ssss', '2023-06-24', 1, '2023-06-24 00:06:03', '2023-06-24 00:06:03');
INSERT INTO `tb_transaksi` VALUES (6, 'TRK000003', 'PD02', NULL, 500000, 'Aqua', '2023-06-24', 1, '2023-06-24 00:39:28', '2023-06-24 00:39:28');
INSERT INTO `tb_transaksi` VALUES (7, 'TRK000004', 'PD', 800000, NULL, 'masuk', '2023-06-24', 1, '2023-06-24 01:16:37', '2023-06-24 01:16:37');
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
