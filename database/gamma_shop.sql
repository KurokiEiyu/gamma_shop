-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 30, 2021 at 07:29 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gamma_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(10) UNSIGNED NOT NULL,
  `nama_lengkap` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_pengguna` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kata_sandi` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `nama_lengkap`, `email`, `nama_pengguna`, `kata_sandi`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'admin@gmail.com', 'admin', '$2y$10$H.kA.ZxNBMqNluYTBESS2e8ZXjMfqzBjfThWeaOKnuj0/WPWtc9VS', NULL, NULL),
(2, 'Aruna', 'rapipaa@gmail.com', 'MINA', '$2y$10$8qTCNZ9UXEmL2gRLgr4PCeiDKPw8S4vuw5khJgt2LlkRcldt1bUcC', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `deposit`
--

CREATE TABLE `deposit` (
  `id_deposit` int(10) UNSIGNED NOT NULL,
  `pelapak_id` int(10) UNSIGNED NOT NULL,
  `rekening_id` int(10) UNSIGNED NOT NULL,
  `nominal` int(11) NOT NULL,
  `tgl_deposit` datetime NOT NULL,
  `bukti_transfer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('menunggu konfirmasi','diterima') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `deposit`
--

INSERT INTO `deposit` (`id_deposit`, `pelapak_id`, `rekening_id`, `nominal`, `tgl_deposit`, `bukti_transfer`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 500000, '2021-03-22 18:08:13', 'bukti_transfer/deposit-1.jpg', 'diterima', NULL, '2021-03-22 11:08:57'),
(2, 2, 1, 100000, '2021-03-26 21:35:35', 'bukti_transfer/deposit-2.jpg', 'diterima', NULL, '2021-03-26 14:36:45');

-- --------------------------------------------------------

--
-- Table structure for table `favorit`
--

CREATE TABLE `favorit` (
  `id_favorit` int(10) UNSIGNED NOT NULL,
  `pembeli_id` int(10) UNSIGNED NOT NULL,
  `produk_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `favorit`
--

INSERT INTO `favorit` (`id_favorit`, `pembeli_id`, `produk_id`, `created_at`, `updated_at`) VALUES
(2, 1, 8, NULL, NULL),
(3, 1, 8, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(10) UNSIGNED NOT NULL,
  `admin_id` int(10) UNSIGNED NOT NULL,
  `nama_kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `admin_id`, `nama_kategori`, `created_at`, `updated_at`) VALUES
(1, 1, 'Pakaian Pria', NULL, NULL),
(2, 1, 'Pakaian Wanita', NULL, NULL),
(3, 1, 'Pakaian Anak', NULL, NULL),
(4, 1, 'Sepatu', NULL, NULL),
(5, 1, 'Aksesoris', NULL, NULL),
(6, 2, 'Buku', NULL, '2021-03-22 10:27:38');

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE `keranjang` (
  `id_keranjang` int(10) UNSIGNED NOT NULL,
  `pembeli_id` int(10) UNSIGNED NOT NULL,
  `produk_id` int(10) UNSIGNED NOT NULL,
  `qty` tinyint(4) NOT NULL,
  `ukuran_terpilih` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2021_02_15_091308_create_rekening_table', 1),
(2, '2021_02_15_130643_create_admin_table', 1),
(3, '2021_02_15_131030_create_pembeli_table', 1),
(4, '2021_02_15_131356_create_pelapak_table', 1),
(5, '2021_02_15_131757_create_kategori_table', 1),
(6, '2021_02_15_132056_create_produk_table', 1),
(7, '2021_02_15_132651_create_keranjang_table', 1),
(8, '2021_02_15_133132_create_order_detail_table', 1),
(9, '2021_02_15_133710_create_order_item_table', 1),
(10, '2021_02_15_134241_create_pembayaran_table', 1),
(11, '2021_02_15_134719_create_transaksi_table', 1),
(12, '2021_02_15_135244_create_riwayat_pesanan_table', 1),
(13, '2021_02_15_162903_create_favorit_table', 1),
(14, '2021_02_25_131408_create_saldo_table', 1),
(15, '2021_02_25_202144_create_deposit_table', 1),
(16, '2021_02_26_124923_create_withdraw_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `id_order_detail` int(10) UNSIGNED NOT NULL,
  `pembeli_id` int(10) UNSIGNED NOT NULL,
  `alamat_penerima` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `telepon_penerima` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_penerima` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`id_order_detail`, `pembeli_id`, `alamat_penerima`, `telepon_penerima`, `email_penerima`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 1, 'Kakampungan', '0864445798', 'arthuriapendragon@gmail.com', NULL, NULL, NULL),
(2, 1, 'Kakampungan', '0864445798', 'arthuriapendragon@gmail.com', NULL, NULL, NULL),
(3, 1, 'England', '0864445798', 'arthuriapendragon@gmail.com', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--

CREATE TABLE `order_item` (
  `id_order_item` int(10) UNSIGNED NOT NULL,
  `produk_id` int(10) UNSIGNED NOT NULL,
  `order_detail_id` int(10) UNSIGNED NOT NULL,
  `qty` tinyint(4) NOT NULL,
  `ukuran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('menunggu konfirmasi','dikemas','dikirim','penilaian','selesai') COLLATE utf8mb4_unicode_ci NOT NULL,
  `fee_admin` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_item`
--

INSERT INTO `order_item` (`id_order_item`, `produk_id`, `order_detail_id`, `qty`, `ukuran`, `status`, `fee_admin`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 1, 'L', 'selesai', 22500, NULL, '2021-03-23 15:43:35'),
(2, 5, 2, 1, 'Pria', 'penilaian', 550, NULL, '2021-03-30 05:25:11'),
(3, 4, 2, 1, '40', 'penilaian', 2300, NULL, '2021-03-30 05:25:18'),
(4, 12, 3, 1, 'S', 'selesai', 25000, NULL, '2021-03-26 15:04:44'),
(5, 12, 3, 1, 'M', 'dikemas', 25000, NULL, '2021-03-26 15:01:51');

-- --------------------------------------------------------

--
-- Table structure for table `pelapak`
--

CREATE TABLE `pelapak` (
  `id_pelapak` int(10) UNSIGNED NOT NULL,
  `nama_toko` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_pemilik` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_pengguna` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telepon` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kelamin` enum('L','P') COLLATE utf8mb4_unicode_ci NOT NULL,
  `kata_sandi` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pelapak`
--

INSERT INTO `pelapak` (`id_pelapak`, `nama_toko`, `nama_pemilik`, `nama_pengguna`, `email`, `telepon`, `alamat`, `jenis_kelamin`, `kata_sandi`, `created_at`, `updated_at`) VALUES
(1, 'Clothes Store', 'Chloe', 'pelapak', 'Chlo@gmail.com', '08213345', 'Indonesia', 'P', '$2y$10$aWAT7nHKi56yH5QJXUmAjuJlG.olHAsnoDPRoTeM4uc.xxLFigJxu', NULL, '2021-03-22 10:07:33'),
(2, 'EROS STORE', 'Nero Claudia', 'claudia', 'NeClau@gmail.com', '08213345221', 'Roma', 'P', '$2y$10$l1BkHS.BGXPIYTLSh03Z/eESqIA3DkU0V2GEsQtt08432U2yQ30yW', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(10) UNSIGNED NOT NULL,
  `rekening_id` int(10) UNSIGNED DEFAULT NULL,
  `tgl_bayar` datetime NOT NULL,
  `metode_pembayaran` enum('Cash on Delivery','Transfer Bank') COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_bayar` int(11) NOT NULL,
  `total_fee_admin` int(11) NOT NULL,
  `bukti_transfer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `rekening_id`, `tgl_bayar`, `metode_pembayaran`, `total_bayar`, `total_fee_admin`, `bukti_transfer`, `created_at`, `updated_at`) VALUES
(1, 1, '2021-03-23 22:36:07', 'Transfer Bank', 450000, 22500, 'bukti_transfer/1.jpg', NULL, '2021-03-23 15:36:07'),
(2, NULL, '2021-03-23 22:39:47', 'Cash on Delivery', 170000, 2850, NULL, NULL, NULL),
(3, NULL, '2021-03-26 21:57:10', 'Cash on Delivery', 1000000, 50000, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pembeli`
--

CREATE TABLE `pembeli` (
  `id_pembeli` int(10) UNSIGNED NOT NULL,
  `nama_lengkap` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_pengguna` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telepon` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kelamin` enum('P','L') COLLATE utf8mb4_unicode_ci NOT NULL,
  `kata_sandi` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pembeli`
--

INSERT INTO `pembeli` (`id_pembeli`, `nama_lengkap`, `nama_pengguna`, `email`, `telepon`, `alamat`, `jenis_kelamin`, `kata_sandi`, `created_at`, `updated_at`) VALUES
(3, 'Arthuria Pendragon', 'arthur', 'arthuriapendragon@gmail.com', '08213345221', 'England', 'P', '$2y$10$3oUdqKPmEzvXJMoYRDOMMevQurEF0y51pECw1tqSviwydKLGqM.na', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(10) UNSIGNED NOT NULL,
  `pelapak_id` int(10) UNSIGNED NOT NULL,
  `kategori_id` int(10) UNSIGNED NOT NULL,
  `nama_produk` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `ukuran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `path_foto` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `pelapak_id`, `kategori_id`, `nama_produk`, `deskripsi`, `ukuran`, `path_foto`, `harga`, `stok`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Jaket Pria', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestiae praesentium, commodi porro consequuntur modi rem doloremque! Rerum dolorem molestiae odio, repellat voluptatibus, aliquam ipsam dicta facere magni nostrum eum eveniet?', 'S, M, L, XL', 'foto_produk/', 225000, 10, NULL, '2021-03-22 09:48:20'),
(2, 1, 2, 'Jaket Hangat Wanita', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestiae praesentium, commodi porro consequuntur modi rem doloremque! Rerum dolorem molestiae odio, repellat voluptatibus, aliquam ipsam dicta facere magni nostrum eum eveniet?', 'S, M, L, XL', 'foto_produk/', 450000, 9, NULL, '2021-03-23 15:36:07'),
(3, 1, 3, 'Kaos Hitam Polos', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestiae praesentium, commodi porro consequuntur modi rem doloremque! Rerum dolorem molestiae odio, repellat voluptatibus, aliquam ipsam dicta facere magni nostrum eum eveniet?', 'S, M, L, XL', 'foto_produk/', 75000, 10, NULL, '2021-03-22 10:15:28'),
(4, 1, 4, 'Sepatu Warrior Hitam Putih', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestiae praesentium, commodi porro consequuntur modi rem doloremque! Rerum dolorem molestiae odio, repellat voluptatibus, aliquam ipsam dicta facere magni nostrum eum eveniet?', '35, 38, 40, 42', 'foto_produk/', 115000, 9, NULL, '2021-03-23 15:39:47'),
(5, 1, 5, 'Jam Tangan Pria & Wanita', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestiae praesentium, commodi porro consequuntur modi rem doloremque! Rerum dolorem molestiae odio, repellat voluptatibus, aliquam ipsam dicta facere magni nostrum eum eveniet?', 'Pria, Wanita', 'foto_produk/', 55000, 9, NULL, '2021-03-23 15:39:47'),
(6, 1, 5, 'Tas Putih Hitam', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestiae praesentium, commodi porro consequuntur modi rem doloremque! Rerum dolorem molestiae odio, repellat voluptatibus, aliquam ipsam dicta facere magni nostrum eum eveniet?', 'Kecil, Sedang, Besar', 'foto_produk/', 70000, 13, NULL, NULL),
(7, 1, 5, 'Tas Putih camo Abu-abu', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestiae praesentium, commodi porro consequuntur modi rem doloremque! Rerum dolorem molestiae odio, repellat voluptatibus, aliquam ipsam dicta facere magni nostrum eum eveniet?', 'Kecil, Sedang, Besar', 'foto_produk/', 65000, 5, NULL, NULL),
(8, 1, 1, 'Rompi Biru + Rante', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestiae praesentium, commodi porro consequuntur modi rem doloremque! Rerum dolorem molestiae odio, repellat voluptatibus, aliquam ipsam dicta facere magni nostrum eum eveniet?', 'S, M, L, XL', 'foto_produk/', 85000, 6, NULL, NULL),
(9, 1, 2, 'Kemeja Abu-abu', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestiae praesentium, commodi porro consequuntur modi rem doloremque! Rerum dolorem molestiae odio, repellat voluptatibus, aliquam ipsam dicta facere magni nostrum eum eveniet?', 'S, M, L, XL', 'foto_produk/', 250000, 11, NULL, NULL),
(10, 1, 3, 'Kaos Putih Kaktus', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestiae praesentium, commodi porro consequuntur modi rem doloremque! Rerum dolorem molestiae odio, repellat voluptatibus, aliquam ipsam dicta facere magni nostrum eum eveniet?', 'S, M, L, XL', 'foto_produk/', 30000, 5, NULL, NULL),
(11, 2, 6, 'Anak Semua Bangsa', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestiae praesentium, commodi porro consequuntur modi rem doloremque! Rerum dolorem molestiae odio, repellat voluptatibus, aliquam ipsam dicta facere magni nostrum eum eveniet?', 'Biasa, Lebar', 'foto_produk/', 80000, 25, NULL, NULL),
(12, 2, 1, 'Hodie man Black', 'Jaek nam pha kyom .....\r\nkhot nam tiam pek', 'S, M, L, XL', 'foto_produk/', 500000, 48, NULL, '2021-03-26 14:57:11');

-- --------------------------------------------------------

--
-- Table structure for table `rekening`
--

CREATE TABLE `rekening` (
  `id_rekening` int(10) UNSIGNED NOT NULL,
  `nama_bank` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `atas_nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_rekening` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rekening`
--

INSERT INTO `rekening` (`id_rekening`, `nama_bank`, `atas_nama`, `no_rekening`, `created_at`, `updated_at`) VALUES
(1, 'BCA', 'Developer', '123456789', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `riwayat_pesanan`
--

CREATE TABLE `riwayat_pesanan` (
  `id_riwayat_pesanan` int(10) UNSIGNED NOT NULL,
  `transaksi_id` int(10) UNSIGNED NOT NULL,
  `pembeli_id` int(10) UNSIGNED NOT NULL,
  `tgl_pesan` datetime NOT NULL,
  `bintang` tinyint(4) DEFAULT NULL,
  `ulasan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `riwayat_pesanan`
--

INSERT INTO `riwayat_pesanan` (`id_riwayat_pesanan`, `transaksi_id`, `pembeli_id`, `tgl_pesan`, `bintang`, `ulasan`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2021-03-23 22:36:07', 5, 'Keren banget sesuai pict\r\nBest seller !', NULL, '2021-03-23 15:43:35'),
(2, 2, 1, '2021-03-23 22:39:47', NULL, NULL, NULL, NULL),
(3, 3, 1, '2021-03-26 21:57:11', 5, 'Kah tap huaing nay', NULL, '2021-03-26 15:04:44');

-- --------------------------------------------------------

--
-- Table structure for table `saldo`
--

CREATE TABLE `saldo` (
  `id_saldo` int(10) UNSIGNED NOT NULL,
  `pelapak_id` int(10) UNSIGNED NOT NULL,
  `nominal` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `saldo`
--

INSERT INTO `saldo` (`id_saldo`, `pelapak_id`, `nominal`, `created_at`, `updated_at`) VALUES
(1, 1, 924650, NULL, '2021-03-23 15:39:47'),
(2, 2, 50000, NULL, '2021-03-26 14:57:11');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(10) UNSIGNED NOT NULL,
  `pembeli_id` int(10) UNSIGNED NOT NULL,
  `pembayaran_id` int(10) UNSIGNED NOT NULL,
  `order_detail_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `pembeli_id`, `pembayaran_id`, `order_detail_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, NULL, NULL),
(2, 1, 2, 2, NULL, NULL),
(3, 1, 3, 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `withdraw`
--

CREATE TABLE `withdraw` (
  `id_withdraw` int(10) UNSIGNED NOT NULL,
  `pelapak_id` int(10) UNSIGNED NOT NULL,
  `tgl_withdraw` datetime NOT NULL,
  `nominal` int(11) NOT NULL,
  `nama_bank` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_rek_tujuan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `atas_nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('menunggu konfirmasi','disetujui') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `deposit`
--
ALTER TABLE `deposit`
  ADD PRIMARY KEY (`id_deposit`),
  ADD KEY `deposit_pelapak_id_foreign` (`pelapak_id`),
  ADD KEY `deposit_rekening_id_foreign` (`rekening_id`);

--
-- Indexes for table `favorit`
--
ALTER TABLE `favorit`
  ADD PRIMARY KEY (`id_favorit`),
  ADD KEY `favorit_pembeli_id_foreign` (`pembeli_id`),
  ADD KEY `favorit_produk_id_foreign` (`produk_id`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`),
  ADD KEY `kategori_admin_id_foreign` (`admin_id`);

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id_keranjang`),
  ADD KEY `keranjang_pembeli_id_foreign` (`pembeli_id`),
  ADD KEY `keranjang_produk_id_foreign` (`produk_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id_order_detail`),
  ADD KEY `order_detail_pembeli_id_foreign` (`pembeli_id`);

--
-- Indexes for table `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`id_order_item`),
  ADD KEY `order_item_produk_id_foreign` (`produk_id`),
  ADD KEY `order_item_order_detail_id_foreign` (`order_detail_id`);

--
-- Indexes for table `pelapak`
--
ALTER TABLE `pelapak`
  ADD PRIMARY KEY (`id_pelapak`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`),
  ADD KEY `pembayaran_rekening_id_foreign` (`rekening_id`);

--
-- Indexes for table `pembeli`
--
ALTER TABLE `pembeli`
  ADD PRIMARY KEY (`id_pembeli`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`),
  ADD KEY `produk_pelapak_id_foreign` (`pelapak_id`),
  ADD KEY `produk_kategori_id_foreign` (`kategori_id`);

--
-- Indexes for table `rekening`
--
ALTER TABLE `rekening`
  ADD PRIMARY KEY (`id_rekening`);

--
-- Indexes for table `riwayat_pesanan`
--
ALTER TABLE `riwayat_pesanan`
  ADD PRIMARY KEY (`id_riwayat_pesanan`),
  ADD KEY `riwayat_pesanan_transaksi_id_foreign` (`transaksi_id`),
  ADD KEY `riwayat_pesanan_pembeli_id_foreign` (`pembeli_id`);

--
-- Indexes for table `saldo`
--
ALTER TABLE `saldo`
  ADD PRIMARY KEY (`id_saldo`),
  ADD KEY `saldo_pelapak_id_foreign` (`pelapak_id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `transaksi_pembeli_id_foreign` (`pembeli_id`),
  ADD KEY `transaksi_pembayaran_id_foreign` (`pembayaran_id`),
  ADD KEY `transaksi_order_detail_id_foreign` (`order_detail_id`);

--
-- Indexes for table `withdraw`
--
ALTER TABLE `withdraw`
  ADD PRIMARY KEY (`id_withdraw`),
  ADD KEY `withdraw_pelapak_id_foreign` (`pelapak_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `deposit`
--
ALTER TABLE `deposit`
  MODIFY `id_deposit` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `favorit`
--
ALTER TABLE `favorit`
  MODIFY `id_favorit` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id_keranjang` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id_order_detail` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `order_item`
--
ALTER TABLE `order_item`
  MODIFY `id_order_item` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pelapak`
--
ALTER TABLE `pelapak`
  MODIFY `id_pelapak` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pembeli`
--
ALTER TABLE `pembeli`
  MODIFY `id_pembeli` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `rekening`
--
ALTER TABLE `rekening`
  MODIFY `id_rekening` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `riwayat_pesanan`
--
ALTER TABLE `riwayat_pesanan`
  MODIFY `id_riwayat_pesanan` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `saldo`
--
ALTER TABLE `saldo`
  MODIFY `id_saldo` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `withdraw`
--
ALTER TABLE `withdraw`
  MODIFY `id_withdraw` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `deposit`
--
ALTER TABLE `deposit`
  ADD CONSTRAINT `deposit_pelapak_id_foreign` FOREIGN KEY (`pelapak_id`) REFERENCES `pelapak` (`id_pelapak`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `deposit_rekening_id_foreign` FOREIGN KEY (`rekening_id`) REFERENCES `rekening` (`id_rekening`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `favorit`
--
ALTER TABLE `favorit`
  ADD CONSTRAINT `favorit_pembeli_id_foreign` FOREIGN KEY (`pembeli_id`) REFERENCES `pembeli` (`id_pembeli`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `favorit_produk_id_foreign` FOREIGN KEY (`produk_id`) REFERENCES `produk` (`id_produk`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kategori`
--
ALTER TABLE `kategori`
  ADD CONSTRAINT `kategori_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`id_admin`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD CONSTRAINT `keranjang_pembeli_id_foreign` FOREIGN KEY (`pembeli_id`) REFERENCES `pembeli` (`id_pembeli`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `keranjang_produk_id_foreign` FOREIGN KEY (`produk_id`) REFERENCES `produk` (`id_produk`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD CONSTRAINT `order_detail_pembeli_id_foreign` FOREIGN KEY (`pembeli_id`) REFERENCES `pembeli` (`id_pembeli`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_item`
--
ALTER TABLE `order_item`
  ADD CONSTRAINT `order_item_order_detail_id_foreign` FOREIGN KEY (`order_detail_id`) REFERENCES `order_detail` (`id_order_detail`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_item_produk_id_foreign` FOREIGN KEY (`produk_id`) REFERENCES `produk` (`id_produk`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_rekening_id_foreign` FOREIGN KEY (`rekening_id`) REFERENCES `rekening` (`id_rekening`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `produk_kategori_id_foreign` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `produk_pelapak_id_foreign` FOREIGN KEY (`pelapak_id`) REFERENCES `pelapak` (`id_pelapak`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `riwayat_pesanan`
--
ALTER TABLE `riwayat_pesanan`
  ADD CONSTRAINT `riwayat_pesanan_pembeli_id_foreign` FOREIGN KEY (`pembeli_id`) REFERENCES `pembeli` (`id_pembeli`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `riwayat_pesanan_transaksi_id_foreign` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`id_transaksi`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `saldo`
--
ALTER TABLE `saldo`
  ADD CONSTRAINT `saldo_pelapak_id_foreign` FOREIGN KEY (`pelapak_id`) REFERENCES `pelapak` (`id_pelapak`) ON DELETE CASCADE;

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_order_detail_id_foreign` FOREIGN KEY (`order_detail_id`) REFERENCES `order_detail` (`id_order_detail`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_pembayaran_id_foreign` FOREIGN KEY (`pembayaran_id`) REFERENCES `pembayaran` (`id_pembayaran`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_pembeli_id_foreign` FOREIGN KEY (`pembeli_id`) REFERENCES `pembeli` (`id_pembeli`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `withdraw`
--
ALTER TABLE `withdraw`
  ADD CONSTRAINT `withdraw_pelapak_id_foreign` FOREIGN KEY (`pelapak_id`) REFERENCES `pelapak` (`id_pelapak`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
