-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 12 Bulan Mei 2025 pada 04.19
-- Versi server: 8.0.42-0ubuntu0.24.04.1
-- Versi PHP: 8.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `warehouse2_jkl`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `categories`
--

CREATE TABLE `categories` (
  `category_id` bigint NOT NULL,
  `warehouse_id` bigint NOT NULL DEFAULT '1',
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `categories`
--

INSERT INTO `categories` (`category_id`, `warehouse_id`, `category_name`) VALUES
(8, 2, 'Cat 1'),
(14, 1, 'HomeDecor');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `products`
--

CREATE TABLE `products` (
  `product_id` bigint NOT NULL,
  `warehouse_id` bigint NOT NULL,
  `user_id` bigint NOT NULL,
  `product_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` bigint DEFAULT NULL,
  `variant` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `products`
--

INSERT INTO `products` (`product_id`, `warehouse_id`, `user_id`, `product_code`, `product_name`, `category_id`, `variant`, `color`) VALUES
(31, 1, 1, '8809486680001', 'RIBBON SOAP PUMP //Botol Sabun Bentuk Pita/Botol Sabun Cream Pink Unik/Botol Sabun Cantik/Cute Dispenser Soap/Botol Sabun Pump/Botol Sabun Pencet/Pump Soap Dispenser/Tempat Sabun keramik', 14, 'Dispenser', 'Yellow'),
(32, 1, 1, 'DYNC99880002', 'RIBBON SOAP PUMP //Botol Sabun Bentuk Pita/Botol Sabun Cream Pink Unik/Botol Sabun Cantik/Cute Dispenser Soap/Botol Sabun Pump/Botol Sabun Pencet/Pump Soap Dispenser/Tempat Sabun keramik', 14, 'Dispenser', 'Pink'),
(33, 1, 1, 'DYNC99880003', 'RIBBON SOAP PUMP //Botol Sabun Bentuk Pita/Botol Sabun Cream Pink Unik/Botol Sabun Cantik/Cute Dispenser Soap/Botol Sabun Pump/Botol Sabun Pencet/Pump Soap Dispenser/Tempat Sabun keramik', 14, 'Dispenser', 'White'),
(34, 1, 1, 'DYNC99880004', 'Vas bunga Keramik Arkasela / Vas bunga etnik new', 14, 'Vas', 'Type A'),
(35, 1, 1, 'DYNC99880005', 'Vas bunga Keramik Arkasela / Vas bunga etnik new', 14, 'Vas', 'Type B'),
(36, 1, 1, 'DYNC99880006', 'Vas bunga Keramik Arkasela / Vas bunga etnik new', 14, 'Vas', 'Type C'),
(37, 1, 1, 'DYNC99880007', 'Vas bunga Keramik Arkasela / Vas bunga etnik new', 14, 'Vas', 'Type D');

-- --------------------------------------------------------

--
-- Struktur dari tabel `products_wip`
--

CREATE TABLE `products_wip` (
  `product_wip_id` bigint NOT NULL,
  `warehouse_id` bigint NOT NULL,
  `product_id` bigint NOT NULL,
  `product_amount` bigint NOT NULL,
  `date_in` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_out` datetime DEFAULT NULL,
  `status` int NOT NULL DEFAULT '0' COMMENT '0 = Progress; 1 = Done;'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `products_wip`
--

INSERT INTO `products_wip` (`product_wip_id`, `warehouse_id`, `product_id`, `product_amount`, `date_in`, `date_out`, `status`) VALUES
(1, 1, 1, 50, '2021-05-19 22:05:17', '2021-05-19 22:05:56', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `roles_permissions`
--

CREATE TABLE `roles_permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `role` int DEFAULT NULL,
  `permission` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `roles_permissions`
--

INSERT INTO `roles_permissions` (`id`, `role`, `permission`, `deleted_at`) VALUES
(3, 1, 'create-product', '2025-05-04 01:57:24'),
(11, 1, 'delete-product', '2025-05-04 01:57:24'),
(13, 0, 'all', NULL),
(14, 1, 'edit-product', '2025-05-04 01:57:24'),
(16, 1, 'show-product', '2025-05-04 01:57:24'),
(17, 1, 'create-category', '2025-05-04 01:57:24'),
(19, 1, 'delete-category', '2025-05-04 01:57:24'),
(20, 1, 'edit-category', '2025-05-04 01:57:24'),
(21, 1, 'show-category', '2025-05-04 01:57:24'),
(22, 1, 'create-shelf', '2025-05-04 01:57:24'),
(23, 1, 'edit-shelf', '2025-05-04 01:57:24'),
(24, 1, 'delete-shelf', '2025-05-04 01:57:24'),
(25, 1, 'add-productslist', '2025-05-04 02:00:37'),
(26, 1, 'add-wip', '2025-05-04 02:10:54'),
(27, 1, 'add-product-wip', '2025-05-04 02:12:31');

-- --------------------------------------------------------

--
-- Struktur dari tabel `shelf`
--

CREATE TABLE `shelf` (
  `shelf_id` bigint NOT NULL,
  `warehouse_id` bigint NOT NULL,
  `shelf_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `shelf`
--

INSERT INTO `shelf` (`shelf_id`, `warehouse_id`, `shelf_name`) VALUES
(7, 1, 'Gudang A'),
(8, 1, 'Gudang B'),
(9, 1, 'Gudang C'),
(10, 2, 'Rak 1'),
(12, 1, 'Gudang D'),
(13, 1, 'Gudang Inhouse');

-- --------------------------------------------------------

--
-- Struktur dari tabel `stock`
--

CREATE TABLE `stock` (
  `stock_id` bigint NOT NULL,
  `warehouse_id` bigint NOT NULL DEFAULT '1',
  `user_id` bigint NOT NULL,
  `shelf_id` bigint NOT NULL,
  `product_id` bigint NOT NULL,
  `stock_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_nota` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_amount` bigint NOT NULL DEFAULT '0',
  `type` int NOT NULL DEFAULT '1' COMMENT '0 = OUT; 1 = IN; 2 = Refund;',
  `datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ending_amount` bigint NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `stock`
--

INSERT INTO `stock` (`stock_id`, `warehouse_id`, `user_id`, `shelf_id`, `product_id`, `stock_name`, `no_nota`, `product_amount`, `type`, `datetime`, `ending_amount`) VALUES
(23, 1, 1, 7, 31, 'DynamicHouse', NULL, 10, 1, '2025-05-05 13:05:58', 10),
(24, 1, 6, 7, 31, NULL, NULL, 1, 2, '2025-05-05 13:09:35', 11),
(25, 1, 6, 7, 31, NULL, NULL, 5, 1, '2025-05-05 13:10:48', 15),
(26, 1, 6, 7, 31, NULL, NULL, 1, 0, '2025-05-05 13:13:14', 14),
(27, 1, 6, 7, 31, NULL, NULL, 1, 0, '2025-05-07 14:12:37', 13),
(28, 1, 6, 9, 31, NULL, NULL, 20, 1, '2025-05-07 14:31:38', 33),
(29, 1, 1, 7, 31, NULL, NULL, 1, 1, '2025-05-09 08:30:44', 34),
(30, 1, 1, 0, 31, NULL, NULL, 11, 1, '2025-05-09 12:36:40', 45),
(31, 1, 1, 0, 31, NULL, NULL, 1, 0, '2025-05-09 13:43:59', 44),
(32, 1, 1, 0, 31, NULL, NULL, 1, 0, '2025-05-09 13:44:08', 43),
(33, 1, 1, 0, 31, NULL, NULL, 1, 1, '2025-05-09 13:47:04', 44),
(34, 1, 1, 0, 31, NULL, NULL, 1, 2, '2025-05-09 13:48:09', 45),
(35, 1, 1, 0, 31, NULL, NULL, 1, 0, '2025-05-09 13:48:17', 43),
(36, 1, 1, 0, 31, NULL, NULL, 1, 2, '2025-05-12 11:12:33', 44),
(37, 1, 1, 0, 31, NULL, NULL, 1, 2, '2025-05-12 11:19:04', 47);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` int NOT NULL DEFAULT '1' COMMENT '0 = Admin; 1 = User;',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `username`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'desman@pardosi.net', 'admin', 0, NULL, '$2a$12$XTOdNU1fOSHwlFjLYeRdJOfQW1Du.bmc/BixnVabZPb1IcLznkE9e', 'xh8t3ilyNJtYcn1WAxk9mdcxHkrA2lfLGVS3I6rLEwbrBuSIi80kRVTDIhM4', '2021-02-18 08:15:56', '2021-02-18 08:15:56'),
(6, 'Erin', NULL, 'user99', 1, NULL, '$2y$10$6K6m3O/MFnBLiFmYUr0/Nu/HxRsaDHZJr7NvBgwg8gBYWpL4pBTZi', NULL, NULL, NULL),
(7, 'Riska', NULL, 'user88', 0, NULL, '$2y$10$JHkQ3L/XVHz3DQ/JlxPEjeFwinn2RQNPqeh9.gW38qjXHkgJJzTGa', NULL, NULL, NULL),
(8, 'Riska', NULL, 'user77', 1, NULL, '$2y$10$K8oXDQSB1WBGXzIKjqaoi.nxSePpO3Vh19vhcHHWieQIB7aeXFXkO', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `warehouse`
--

CREATE TABLE `warehouse` (
  `warehouse_id` bigint NOT NULL,
  `warehouse_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `warehouse`
--

INSERT INTO `warehouse` (`warehouse_id`, `warehouse_name`) VALUES
(1, 'DynamicHouse');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indeks untuk tabel `products_wip`
--
ALTER TABLE `products_wip`
  ADD PRIMARY KEY (`product_wip_id`);

--
-- Indeks untuk tabel `roles_permissions`
--
ALTER TABLE `roles_permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permission` (`permission`),
  ADD KEY `role` (`role`);

--
-- Indeks untuk tabel `shelf`
--
ALTER TABLE `shelf`
  ADD PRIMARY KEY (`shelf_id`);

--
-- Indeks untuk tabel `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`stock_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username_2` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `username` (`username`),
  ADD KEY `role` (`role`);

--
-- Indeks untuk tabel `warehouse`
--
ALTER TABLE `warehouse`
  ADD PRIMARY KEY (`warehouse_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `products`
--
ALTER TABLE `products`
  MODIFY `product_id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT untuk tabel `products_wip`
--
ALTER TABLE `products_wip`
  MODIFY `product_wip_id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `roles_permissions`
--
ALTER TABLE `roles_permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `shelf`
--
ALTER TABLE `shelf`
  MODIFY `shelf_id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `stock`
--
ALTER TABLE `stock`
  MODIFY `stock_id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `warehouse`
--
ALTER TABLE `warehouse`
  MODIFY `warehouse_id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `roles_permissions`
--
ALTER TABLE `roles_permissions`
  ADD CONSTRAINT `roles_permissions_ibfk_1` FOREIGN KEY (`role`) REFERENCES `users` (`role`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
