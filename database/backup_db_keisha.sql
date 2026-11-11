/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19  Distrib 10.6.22-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: 127.0.0.1    Database: db_keisha
-- ------------------------------------------------------
-- Server version	8.0.35

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `alat`
--

DROP TABLE IF EXISTS `alat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `alat` (
  `id_alat` int NOT NULL AUTO_INCREMENT,
  `nama_alat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_alat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `id_kategori` int DEFAULT NULL,
  `stok` int DEFAULT NULL,
  PRIMARY KEY (`id_alat`),
  KEY `fk_alat_id_kategori_ab7488` (`id_kategori`),
  CONSTRAINT `fk_alat_id_kategori_ab7488` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alat`
--

LOCK TABLES `alat` WRITE;
/*!40000 ALTER TABLE `alat` DISABLE KEYS */;
INSERT INTO `alat` VALUES (5,'Bola Voli','BLA-001','2026-09-22 10:24:32','2026-10-24 19:40:12',1,40),(11,'Net Voli','NET-002','2026-09-27 22:06:53','2026-11-09 16:45:55',1,49),(12,'Tiang Net','TNG-003','2026-09-27 22:07:18','2026-10-03 23:07:49',1,50),(13,'Antena','ANT-004','2026-09-27 22:07:50','2026-10-03 23:07:42',1,50),(14,'Peluit Wasit','PLT-005','2026-09-27 22:08:42','2026-10-09 06:55:46',1,50),(15,'Papan Skor','PPN-006','2026-09-27 22:09:05','2026-10-09 06:55:00',1,50),(17,'Meteran Lapangan','MTR-007','2026-09-27 22:09:25','2026-10-03 23:07:15',1,50),(18,'Pompa Bola','PMP-008','2026-09-27 22:09:41','2026-10-03 23:07:03',1,50),(19,'Jarum Pompa','JRM-009','2026-09-27 22:10:00','2026-10-03 23:06:52',1,50),(20,'Kerucut Lapangan','KRC-010','2026-09-27 22:10:18','2026-10-21 06:47:16',1,30),(21,'Tali Pembatas','TLI-011','2026-09-27 22:10:44','2026-10-03 22:43:18',1,50),(22,'Pelindung Lutut','LTT-012','2026-09-27 22:11:43','2026-10-03 22:43:09',4,50),(23,'Pelindung Siku','SKU-013','2026-09-27 22:11:57','2026-10-04 12:15:56',4,50),(25,'Penyangga Pergelangan Kaki ','PPK-14','2026-10-03 23:11:11','2026-10-03 23:11:25',4,50),(26,'Pelindung Pergelangan Tangan ','PPT-15','2026-10-03 23:12:32','2026-10-03 23:16:18',4,50),(27,'Pelindung Jari','PLJ-16','2026-10-03 23:16:54','2026-10-24 19:40:17',4,0),(28,'Manset Lengan','MSL-17','2026-10-03 23:45:47','2026-10-03 23:45:47',4,50),(29,'Baju Jersey','BJY-18','2026-10-03 23:46:27','2026-10-03 23:48:03',4,50),(30,'Celana Jersey','CJY-19','2026-10-03 23:47:17','2026-10-03 23:47:17',4,50),(31,'Sepatu Voli','SVI-20','2026-10-03 23:48:46','2026-10-03 23:48:46',4,50),(32,'Corong Latihan','CRL-21','2026-10-03 23:49:29','2026-10-03 23:56:19',5,100),(33,'Tangga Kelincahan(Ladder Agility)','TKC-22','2026-10-03 23:51:18','2026-10-03 23:55:52',5,50),(34,'Pita Elastis (Resistance Band)','PLSS-23','2026-10-03 23:53:03','2026-10-03 23:55:59',5,50),(35,'Lompat Tali (Skipping)','LTI-24','2026-10-03 23:54:26','2026-10-09 06:55:35',5,50),(36,'Bola Voli Gantung','BVG-25','2026-10-03 23:55:40','2026-10-03 23:55:40',5,50),(37,'Alat Rintangan Kecil (Hurde Mini)','ARK-26','2026-10-03 23:58:23','2026-10-03 23:58:23',5,50),(38,'Selang Elastis (Resistance Tube)','SLS-27','2026-10-04 00:00:03','2026-10-24 19:43:18',5,49),(39,'Papan Pantul (Rebounder)','PTL-28','2026-10-04 00:01:18','2026-10-23 05:52:35',5,49);
/*!40000 ALTER TABLE `alat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kategori`
--

DROP TABLE IF EXISTS `kategori`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `kategori` (
  `id_kategori` int NOT NULL AUTO_INCREMENT,
  `kode_kategori` varchar(10) NOT NULL,
  `nama_kategori` varchar(255) NOT NULL,
  `keterangan` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kategori`
--

LOCK TABLES `kategori` WRITE;
/*!40000 ALTER TABLE `kategori` DISABLE KEYS */;
INSERT INTO `kategori` VALUES (1,'RPL-001','ALAT LAPANGAN','Milik Keisha','2026-09-17 14:06:58','2026-09-22 10:37:41'),(4,'RPL-002','ALAT TUBUH','Milik Keisha','2026-09-22 10:34:43','2026-09-22 10:37:55'),(5,'RPL-003','ALAT LATIHAN','Milik Keisha','2026-09-22 10:39:53','2026-10-03 19:43:01');
/*!40000 ALTER TABLE `kategori` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `log_aktivitas`
--

DROP TABLE IF EXISTS `log_aktivitas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `log_aktivitas` (
  `id_log` int NOT NULL AUTO_INCREMENT,
  `id_user` int unsigned NOT NULL,
  `aktivitas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_log`),
  KEY `fk_log_aktivitas_id_user_8cdfc6` (`id_user`),
  CONSTRAINT `fk_log_aktivitas_id_user_8cdfc6` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `log_aktivitas`
--

LOCK TABLES `log_aktivitas` WRITE;
/*!40000 ALTER TABLE `log_aktivitas` DISABLE KEYS */;
INSERT INTO `log_aktivitas` VALUES (1,6,'Menyetujui peminjaman #9','2026-10-08 10:58:50','2026-10-08 10:58:50'),(2,6,'Menolak peminjaman #10','2026-10-08 11:21:20','2026-10-08 11:21:20'),(3,6,'Menyetujui peminjaman #11','2026-10-09 18:29:15','2026-10-09 18:29:15'),(4,6,'Menyetujui peminjaman #13','2026-10-21 06:47:16','2026-10-21 06:47:16'),(5,6,'Menyetujui peminjaman #16','2026-10-24 19:40:12','2026-10-24 19:40:12'),(6,6,'Menyetujui peminjaman #18','2026-10-24 19:40:17','2026-10-24 19:40:17'),(7,6,'Menolak peminjaman #19','2026-10-24 19:42:14','2026-10-24 19:42:14'),(8,6,'Menyetujui peminjaman #20','2026-10-24 19:43:03','2026-10-24 19:43:03'),(9,6,'Menyetujui peminjaman #25','2026-11-09 16:45:56','2026-11-09 16:45:56');
/*!40000 ALTER TABLE `log_aktivitas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ran_at` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2026_08_20_090000_create_users_table.sql','2026-09-14 08:57:27'),(2,'2026_08_21_090000_create_roles_table.sql','2026-09-14 08:57:38'),(3,'2026_08_23_100000_add_can_register_to_roles_table.sql','2026-09-14 08:57:45'),(4,'2026_09_01_082221_create_kategoris_table.sql','2026-09-14 08:57:52'),(5,'2026_09_17_142843_create_alats_table.sql','2026-09-17 16:02:32'),(6,'2026_09_17_143008_create_peminjams_table.sql','2026-09-17 16:02:32'),(7,'2026_09_27_210812_create_peminjamans_table.sql','2026-09-27 21:55:06'),(8,'2026_09_28_114703_create_pengembalians_table.sql','2026-09-28 12:19:22');
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `peminjam`
--

DROP TABLE IF EXISTS `peminjam`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `peminjam` (
  `id_peminjam` int NOT NULL AUTO_INCREMENT,
  `id_user` int unsigned NOT NULL,
  `nis` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_peminjam` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kelas` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_peminjam`),
  KEY `fk_peminjam_id_user_4fced2` (`id_user`),
  CONSTRAINT `fk_peminjam_id_user_4fced2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `peminjam`
--

LOCK TABLES `peminjam` WRITE;
/*!40000 ALTER TABLE `peminjam` DISABLE KEYS */;
/*!40000 ALTER TABLE `peminjam` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `peminjaman`
--

DROP TABLE IF EXISTS `peminjaman`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `peminjaman` (
  `id_peminjaman` int unsigned NOT NULL AUTO_INCREMENT,
  `id_user` int unsigned NOT NULL,
  `id_alat` int NOT NULL,
  `jumlah` int NOT NULL DEFAULT '1',
  `tanggal_pinjam` date NOT NULL,
  `tanggal_kembali` date DEFAULT NULL,
  `status` enum('Pending','Disetujui','Ditolak','Dipinjam','Dikembalikan') DEFAULT 'Pending',
  `denda` int DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_peminjaman`),
  KEY `fk_peminjaman_id_alat_cde558` (`id_alat`),
  KEY `fk_peminjaman_id_user_0b1f99` (`id_user`),
  CONSTRAINT `fk_peminjaman_id_alat_cde558` FOREIGN KEY (`id_alat`) REFERENCES `alat` (`id_alat`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_peminjaman_id_alat_ef93dd` FOREIGN KEY (`id_alat`) REFERENCES `alat` (`id_alat`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_peminjaman_id_user_0b1f99` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_peminjaman_id_user_4ba40e` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_peminjaman_id_user_bc981d` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `peminjaman`
--

LOCK TABLES `peminjaman` WRITE;
/*!40000 ALTER TABLE `peminjaman` DISABLE KEYS */;
INSERT INTO `peminjaman` VALUES (5,4,14,2,'2026-10-05','2026-10-06','Dikembalikan',15000,'2026-10-04 00:04:09','2026-10-09 06:55:46'),(6,4,23,1,'2026-10-05','2026-10-06','Dikembalikan',0,'2026-10-04 00:11:57','2026-10-04 12:15:56'),(7,4,15,1,'2026-10-04','2026-10-04','Dikembalikan',25000,'2026-10-04 12:56:23','2026-10-09 06:55:00'),(9,4,35,2,'2026-10-08','2026-10-09','Dikembalikan',0,'2026-10-08 10:58:26','2026-10-09 06:55:35'),(11,4,39,1,'2026-10-09','2026-10-10','Disetujui',0,'2026-10-09 18:28:49','2026-10-09 18:29:15'),(12,12,38,1,'2026-10-20','2026-10-21','Disetujui',0,'2026-10-20 10:49:45','2026-10-21 06:45:56'),(13,4,20,20,'2026-10-21','2026-10-22','Disetujui',0,'2026-10-21 06:47:05','2026-10-23 12:14:22'),(14,4,15,1,'2026-10-23','2026-10-24','Pending',0,'2026-10-23 13:24:17','2026-10-23 13:24:17'),(15,4,39,3,'2026-10-23','2026-10-24','Pending',0,'2026-10-23 15:15:12','2026-10-23 15:15:12'),(16,15,5,10,'2026-10-24','2026-10-26','Disetujui',0,'2026-10-24 19:38:51','2026-10-24 19:40:12'),(17,15,31,3,'2026-10-24','2026-10-26','Pending',0,'2026-10-24 19:39:30','2026-10-24 19:39:30'),(19,15,32,50,'2026-10-24','2026-10-26','Ditolak',0,'2026-10-24 19:41:58','2026-10-24 19:42:14'),(20,15,38,1,'2026-10-24','2026-10-26','Dikembalikan',0,'2026-10-24 19:42:44','2026-10-24 19:43:18'),(21,17,39,1,'2026-10-29','2026-10-30','Pending',0,'2026-10-29 23:25:06','2026-10-29 23:25:06'),(22,17,38,1,'2026-10-29','2026-10-23','Pending',0,'2026-10-29 23:25:26','2026-10-29 23:25:26'),(23,17,29,50,'2026-10-29','2026-10-06','Pending',0,'2026-10-29 23:25:59','2026-10-29 23:25:59'),(24,19,35,10,'2026-11-04','2026-11-05','Pending',0,'2026-11-04 11:54:59','2026-11-04 11:54:59'),(25,20,11,1,'2026-11-09','2026-11-12','Disetujui',0,'2026-11-09 16:41:39','2026-11-09 16:45:55');
/*!40000 ALTER TABLE `peminjaman` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pengembalian`
--

DROP TABLE IF EXISTS `pengembalian`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `pengembalian` (
  `id_pengembalian` int unsigned NOT NULL AUTO_INCREMENT,
  `id_peminjaman` int unsigned NOT NULL,
  `tanggal_pengembalian` datetime NOT NULL,
  `terlambat_hari` int unsigned DEFAULT '0',
  `denda` int DEFAULT '0',
  `kondisi_barang` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT 'Baik',
  `catatan` text COLLATE utf8mb4_unicode_ci,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_pengembalian`),
  KEY `fk_pengembalian_peminjaman` (`id_peminjaman`),
  CONSTRAINT `fk_pengembalian_peminjaman` FOREIGN KEY (`id_peminjaman`) REFERENCES `peminjaman` (`id_peminjaman`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pengembalian`
--

LOCK TABLES `pengembalian` WRITE;
/*!40000 ALTER TABLE `pengembalian` DISABLE KEYS */;
INSERT INTO `pengembalian` VALUES (4,6,'2026-10-04 00:00:00',0,20000000,'Rusak Berat',NULL,'2026-10-04 12:15:56','2026-10-04 18:36:49'),(6,7,'2026-10-09 00:00:00',5,25000,'Baik','Dikembalikan oleh peminjam','2026-10-09 06:55:00','2026-10-09 06:55:00'),(7,9,'2026-10-09 00:00:00',0,0,'Baik','Dikembalikan oleh peminjam','2026-10-09 06:55:35','2026-10-09 06:55:35'),(8,5,'2026-10-09 00:00:00',3,15000,'Baik','Dikembalikan oleh peminjam','2026-10-09 06:55:46','2026-10-09 06:55:46'),(9,20,'2026-10-24 00:00:00',0,0,'Baik','Dikembalikan oleh peminjam','2026-10-24 19:43:18','2026-10-24 19:43:18');
/*!40000 ALTER TABLE `pengembalian` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `can_register` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'admin','2026-09-14 08:57:37','2026-09-14 08:57:37',0),(2,'peminjam','2026-09-22 10:28:34','2026-09-22 10:28:34',1),(3,'petugas','2026-10-01 15:20:24','2026-10-04 12:20:20',0);
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL DEFAULT 'user',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','$2y$10$2qINBU7JUITh89Z4fS3aR.F0nBgX5TD7hrg7lnGdDm3OW4jQU1t4q','admin','2026-09-14 08:57:25','2026-09-14 08:57:25'),(4,'kekei','$2y$10$zRKFfAdSiE64mVRJmdu9xe36lyg9fpTvUGK4RXQXqB4S4p3Qilqwu','peminjam','2026-09-29 11:23:49','2026-09-29 11:23:49'),(5,'siska','$2y$10$v3amPJqTy6Pi2GQEo///fu3ulY1IqV110JuTqWUljdA6Vw4gdP4PS','peminjam','2026-10-03 22:19:43','2026-10-03 22:19:43'),(6,'petugas','$2y$10$NnGI6pH.liz0hoVseAdM3uJ5ZBkF2nhwXFcz4srYV3auqFgs1ZZVG','petugas','2026-10-04 12:21:28','2026-10-04 12:21:28'),(11,'cici','$2y$10$0G/xbDPsxDzSaSYJnljGu.zSIFwMwa2p1O5Sjb9.kvz1eaGqPotfO','peminjam','2026-10-17 11:08:33','2026-10-17 11:08:33'),(12,'siskanih','$2y$10$XCmd0im9dYvl.jNptsyzmuXUTIKQc6mqB9Ft7lLKSSA5VQ1VVL5zW','peminjam','2026-10-20 10:48:05','2026-10-20 10:48:05'),(15,'peminjam','$2y$10$XUF/kOEOzXkwxLL.hqXLp.SbDCwZa091jqXGyfQhIEfv8PajUhPtW','peminjam','2026-10-24 14:29:30','2026-10-24 14:29:30'),(16,'AgusCihuy','$2y$10$gh11dHkI7hdjw3eQPMcVyuOQtBr.HTUnbE/xsR0gK34xTvf3byl.2','peminjam','2026-10-29 13:14:39','2026-10-29 13:14:39'),(17,'BLACKHAT','$2y$10$9i.9Vrhit4TMfNjDZjm6c.nMG2bLAyXGIQEtUZG81AAwehLwz2pLy','peminjam','2026-10-29 23:24:48','2026-10-29 23:24:48'),(18,'arifalganteng','$2y$10$WOuEuzzOFCr0Td7uUEg1W.7e502C3dXPuguUXZUPAbMnBxp80lT56','peminjam','2026-10-30 18:49:20','2026-10-30 18:49:20'),(19,'didin','$2y$10$r9P6cia76rOFO5CE5yGL4.WE8wLX6bVo4Ad2koX2thCH/O4uFBHSK','peminjam','2026-11-04 11:54:25','2026-11-04 11:54:25'),(20,'bilaa14','$2y$10$xE..IpEyBLcKHmEBX53K4OEOuC3MiGOuDycRuS5rKZpjThXHDIdEy','peminjam','2026-11-09 16:41:20','2026-11-09 16:41:20');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-11-11  8:26:39
