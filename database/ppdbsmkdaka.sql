-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Waktu pembuatan: 27 Sep 2025 pada 06.38
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ppdbsmkdaka`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `no_hp` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `gurus`
--

CREATE TABLE `gurus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `nip` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `no_hp` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jurusan`
--

CREATE TABLE `jurusan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `jurusan`
--

INSERT INTO `jurusan` (`id`, `nama`) VALUES
(1, 'IPA (Ilmu Pengetahuan Alam)'),
(2, 'IPS (Ilmu Pengetahuan Soasial)'),
(3, 'Teknik Alat Berat'),
(5, 'Office Management');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2024_02_16_140323_jurusan', 1),
(10, '2024_02_16_150102_siswa', 2),
(11, '2024_02_17_095452_profile_sekolah', 3),
(12, '2024_02_17_102354_pendaftaran', 4),
(13, '2024_02_17_102646_pendaftaran_detail', 4),
(14, '2025_09_27_092020_user_migration', 5),
(15, '2025_09_27_092327_create_admins_table', 5),
(16, '2025_09_27_092503_create_gurus_table', 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pendaftaran`
--

CREATE TABLE `pendaftaran` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tahun_angkatan` int(11) NOT NULL,
  `gelombang` int(11) NOT NULL,
  `kuota` int(11) NOT NULL,
  `tutup` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pendaftaran`
--

INSERT INTO `pendaftaran` (`id`, `tahun_angkatan`, `gelombang`, `kuota`, `tutup`, `created_at`, `updated_at`) VALUES
(1, 2026, 1, 500, 0, '2025-09-27 03:55:48', '2025-09-27 03:55:48');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pendaftaran_detail`
--

CREATE TABLE `pendaftaran_detail` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pendaftaran_id` int(11) NOT NULL,
  `siswa_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `notif` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `profile_sekolah`
--

CREATE TABLE `profile_sekolah` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `kepsek` varchar(255) NOT NULL,
  `nip_kepsek` varchar(255) NOT NULL,
  `ttd_kepsek` varchar(255) NOT NULL,
  `panitia` varchar(255) NOT NULL,
  `nip_panitia` varchar(255) NOT NULL,
  `ttd_panitia` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `logo_dark` varchar(255) NOT NULL,
  `alamat` longtext NOT NULL,
  `telpon` varchar(255) NOT NULL,
  `website` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `profile_sekolah`
--

INSERT INTO `profile_sekolah` (`id`, `username`, `password`, `nama`, `kepsek`, `nip_kepsek`, `ttd_kepsek`, `panitia`, `nip_panitia`, `ttd_panitia`, `foto`, `logo_dark`, `alamat`, `telpon`, `website`, `email`) VALUES
(1, 'admin', '123', 'SMK Darussalam Karangpucung', 'Dr. Risa Fita Hapsari, S.Pd, M.M.', '92736826181292', 'ttd-kepsek.png', 'Waryanto, S.Pd', '-', 'kAdnfChXL3w4bigPJBPd08vkWoplcbqiC2BweGfC.png', 'OzHwuS7i18XXpyQ5hycLASimLlF9nqaBh2wgcJWs.png', 'W8swQZQmXEHKZxZyiWMjQ4jlmPLAawk3I1NSPGTD.png', 'Jl. Raya Karangpucung-Majenang, Km. 02 No. 08, Karangpucung, Cilacap Regency, Central Java 53255', '021-4645-7878', 'smkdaka.sch.id', 'smkdkrpc@gmail.com');

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa`
--

CREATE TABLE `siswa` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `no_regis` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `referral_id` int(11) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `nisn` varchar(255) DEFAULT NULL,
  `nis` varchar(255) DEFAULT NULL,
  `jurusan` varchar(255) DEFAULT NULL,
  `jenis_kelamin` varchar(255) DEFAULT NULL,
  `tempat_lahir` varchar(255) DEFAULT NULL,
  `tgl_lahir` varchar(255) DEFAULT NULL,
  `agama` varchar(255) DEFAULT NULL,
  `anak_ke` int(11) DEFAULT NULL,
  `jumlah_saudara` int(11) DEFAULT NULL,
  `hp` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `desa` varchar(255) DEFAULT NULL,
  `kecamatan` varchar(255) DEFAULT NULL,
  `kabupaten` varchar(255) DEFAULT NULL,
  `provinsi` varchar(255) DEFAULT NULL,
  `no_kk` bigint(255) DEFAULT NULL,
  `nama_ayah` varchar(255) DEFAULT NULL,
  `nama_ibu` varchar(255) DEFAULT NULL,
  `sekolah_asal` varchar(255) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `akta` varchar(255) NOT NULL,
  `kk` varchar(255) NOT NULL,
  `kip` varchar(255) DEFAULT NULL,
  `suket` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','guru','siswa') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'admin1', '$2y$10$DhoIRGDTny3HBSv.aWkI1ufONUCw2IJd4Pjkz7J8Z6qVIFCl7mdsW', 'admin', '2025-09-27 03:00:56', '2025-09-27 03:00:56'),
(2, 'admin2', '$2y$10$DhoIRGDTny3HBSv.aWkI1ufONUCw2IJd4Pjkz7J8Z6qVIFCl7mdsW', 'admin', '2025-09-27 03:00:56', '2025-09-27 03:00:56'),
(3, 'admin3', '$2y$10$DhoIRGDTny3HBSv.aWkI1ufONUCw2IJd4Pjkz7J8Z6qVIFCl7mdsW', 'admin', '2025-09-27 03:00:56', '2025-09-27 03:00:56'),
(4, 'guru1', '$2y$10$DhoIRGDTny3HBSv.aWkI1ufONUCw2IJd4Pjkz7J8Z6qVIFCl7mdsW', 'guru', '2025-09-27 03:00:57', '2025-09-27 03:00:57'),
(5, 'guru2', '$2y$10$DhoIRGDTny3HBSv.aWkI1ufONUCw2IJd4Pjkz7J8Z6qVIFCl7mdsW', 'guru', '2025-09-27 03:00:57', '2025-09-27 03:00:57'),
(6, 'guru3', '$2y$10$DhoIRGDTny3HBSv.aWkI1ufONUCw2IJd4Pjkz7J8Z6qVIFCl7mdsW', 'guru', '2025-09-27 03:00:58', '2025-09-27 03:00:58'),
(7, 'siswa1', '$2y$10$DhoIRGDTny3HBSv.aWkI1ufONUCw2IJd4Pjkz7J8Z6qVIFCl7mdsW', 'siswa', '2025-09-27 03:00:58', '2025-09-27 03:00:58'),
(8, 'siswa2', '$2y$10$DhoIRGDTny3HBSv.aWkI1ufONUCw2IJd4Pjkz7J8Z6qVIFCl7mdsW', 'siswa', '2025-09-27 03:00:59', '2025-09-27 03:00:59'),
(9, 'siswa3', '$2y$10$DhoIRGDTny3HBSv.aWkI1ufONUCw2IJd4Pjkz7J8Z6qVIFCl7mdsW', 'siswa', '2025-09-27 03:00:59', '2025-09-27 03:00:59');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`),
  ADD KEY `admins_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `gurus`
--
ALTER TABLE `gurus`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `gurus_email_unique` (`email`),
  ADD UNIQUE KEY `gurus_nip_unique` (`nip`),
  ADD KEY `gurus_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pendaftaran`
--
ALTER TABLE `pendaftaran`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pendaftaran_detail`
--
ALTER TABLE `pendaftaran_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `profile_sekolah`
--
ALTER TABLE `profile_sekolah`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `gurus`
--
ALTER TABLE `gurus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jurusan`
--
ALTER TABLE `jurusan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `pendaftaran`
--
ALTER TABLE `pendaftaran`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `pendaftaran_detail`
--
ALTER TABLE `pendaftaran_detail`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `profile_sekolah`
--
ALTER TABLE `profile_sekolah`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `admins`
--
ALTER TABLE `admins`
  ADD CONSTRAINT `admins_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `gurus`
--
ALTER TABLE `gurus`
  ADD CONSTRAINT `gurus_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
