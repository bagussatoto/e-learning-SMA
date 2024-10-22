-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 22 Okt 2024 pada 09.32
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `learning`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `mata_pelajaran` varchar(100) NOT NULL,
  `kelas` varchar(100) NOT NULL,
  `attendance_date` datetime NOT NULL,
  `nama` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `attendance`
--

INSERT INTO `attendance` (`id`, `user_id`, `mata_pelajaran`, `kelas`, `attendance_date`, `nama`) VALUES
(56, 22, 'IPA', 'X', '2024-10-22 08:24:25', 'bagus'),
(57, 22, 'MTK', 'X', '2024-10-22 08:24:31', 'bagus'),
(58, 22, 'Bahasa Indonesia', 'X', '2024-10-22 08:24:38', 'bagus'),
(60, 23, 'Bahasa Inggris', 'X', '2024-10-22 09:04:07', 'budi'),
(61, 24, 'IPS', 'XI', '2024-10-22 09:04:42', 'satoto');

-- --------------------------------------------------------

--
-- Struktur dari tabel `materi`
--

CREATE TABLE `materi` (
  `id` int(11) NOT NULL,
  `mata_pelajaran` varchar(50) NOT NULL,
  `kelas` varchar(10) NOT NULL,
  `minggu` int(11) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `materi`
--

INSERT INTO `materi` (`id`, `mata_pelajaran`, `kelas`, `minggu`, `deskripsi`, `file_path`) VALUES
(16, 'MTK', 'X', 1, 'Kerjakan', '../uploadswisuda pipah.docx');

-- --------------------------------------------------------

--
-- Struktur dari tabel `schedules`
--

CREATE TABLE `schedules` (
  `id` int(11) NOT NULL,
  `kelas` varchar(10) NOT NULL,
  `hari` varchar(10) NOT NULL,
  `mata_pelajaran` varchar(50) NOT NULL,
  `jam` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `schedules`
--

INSERT INTO `schedules` (`id`, `kelas`, `hari`, `mata_pelajaran`, `jam`) VALUES
(4, 'X', 'senin', 'mtk, ips', '09.00'),
(5, 'x', 'selasa', 'fisika, kimia', '09.00'),
(6, 'X', 'Rabu', 'B. INDO, B. INGGRIS', '07.00-12.00'),
(7, 'X', 'Kamis', 'B. ARAB, B. EROPA', '07.00-12.00'),
(8, 'X', 'Jumat', 'olahraga di rumahnya fendi', '07.00-18.00'),
(9, 'XI', 'Senin', 'kelistrikan', '09.00-10.00'),
(10, 'XI', 'Selasa', 'hanacaraka/javascript', '09.00-10.00'),
(11, 'XI', 'Rabu', 'krama inggil', '09.00-10.00'),
(12, 'XI', 'Kamis', 'java alus', '09.00-10.00'),
(13, 'XI', 'Jumat', 'indoneasia, java', '09.00'),
(14, 'XII', 'Senin', 'tasawuf, filsafat', '07.00-10.00'),
(15, 'XII', 'Selasa', 'matematika wajib, fisika kuantum', '09.00'),
(16, 'XII', 'rabu', 'indo,arab', '07.00-12.00'),
(17, 'XII', 'Kamis', 'teknik kendaraan ringan', '07.00-12.00'),
(18, 'XII', 'Jumat', 'senam', '07.00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa_tugas`
--

CREATE TABLE `siswa_tugas` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `tugas_id` int(11) DEFAULT NULL,
  `file_path` text DEFAULT NULL,
  `upload_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `siswa_tugas`
--

INSERT INTO `siswa_tugas` (`id`, `user_id`, `tugas_id`, `file_path`, `upload_time`) VALUES
(1, 22, 17, '../uploadsSertifikat Coding Studio - Fundamental Command Linux - Bagus Budi Satoto.pdf', '2024-10-22 06:28:10'),
(2, 22, 18, '../uploadsScreenshot 2024-08-28 105047.png', '2024-10-22 06:28:18'),
(3, 22, 17, '../uploadsSertifikat Coding Studio - Fundamental Command Linux - Bagus Budi Satoto.pdf', '2024-10-22 06:51:55');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tugas`
--

CREATE TABLE `tugas` (
  `id` int(11) NOT NULL,
  `guru_id` int(11) NOT NULL,
  `kelas` varchar(10) NOT NULL,
  `mata_pelajaran` varchar(50) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `due_date` datetime NOT NULL,
  `overdue` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tugas`
--

INSERT INTO `tugas` (`id`, `guru_id`, `kelas`, `mata_pelajaran`, `deskripsi`, `due_date`, `overdue`) VALUES
(17, 2, 'X', 'MTK', 'Kerjakan', '2024-10-22 14:00:00', 0),
(18, 2, 'X', 'Bahasa Indonesia', 'Kerjakan', '2024-10-22 14:27:00', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` enum('admin','guru','siswa') NOT NULL,
  `kelas` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `kelas`) VALUES
(1, 'admin', 'admin', 'admin', ''),
(2, 'guru', 'guru', 'guru', ''),
(22, 'bagus', 'bagus', 'siswa', 'X'),
(23, 'budi', 'budi', 'siswa', 'XI'),
(24, 'satoto', 'satoto', 'siswa', 'XII');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `materi`
--
ALTER TABLE `materi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `siswa_tugas`
--
ALTER TABLE `siswa_tugas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `tugas_id` (`tugas_id`);

--
-- Indeks untuk tabel `tugas`
--
ALTER TABLE `tugas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `guru_id` (`guru_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT untuk tabel `materi`
--
ALTER TABLE `materi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `siswa_tugas`
--
ALTER TABLE `siswa_tugas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tugas`
--
ALTER TABLE `tugas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ketidakleluasaan untuk tabel `siswa_tugas`
--
ALTER TABLE `siswa_tugas`
  ADD CONSTRAINT `siswa_tugas_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `siswa_tugas_ibfk_2` FOREIGN KEY (`tugas_id`) REFERENCES `tugas` (`id`);

--
-- Ketidakleluasaan untuk tabel `tugas`
--
ALTER TABLE `tugas`
  ADD CONSTRAINT `tugas_ibfk_1` FOREIGN KEY (`guru_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
