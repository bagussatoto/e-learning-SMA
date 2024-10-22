-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 21, 2024 at 06:51 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smansagong`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
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
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `user_id`, `mata_pelajaran`, `kelas`, `attendance_date`, `nama`) VALUES
(51, 3, 'IPA', 'X', '2024-07-04 16:34:03', 'indra'),
(52, 3, 'IPA', 'X', '2024-07-10 05:09:34', 'indra'),
(54, 3, 'MTK', 'XII', '2024-07-17 07:10:12', 'indra');

-- --------------------------------------------------------

--
-- Table structure for table `materi`
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
-- Dumping data for table `materi`
--

INSERT INTO `materi` (`id`, `mata_pelajaran`, `kelas`, `minggu`, `deskripsi`, `file_path`) VALUES
(2, 'mtk', 'x', 2, 'dibaca dengan seksama', 'uploads/materi/UTS UI UX dempo.pdf'),
(6, 'ghgh', '4', 2, 'dadas', 'dashboard_guru/materi/ .jpg'),
(7, 'ips', 'X', 3, 'DBA', 'dashboard_guru/materi/5+Novhan+Rizki.pdf'),
(9, 'JAWA', 'XII', 4, 'dqdqf', 'dashboard_guru/materi/# sanji_.jpg'),
(10, 'HI', 'XI', 6, 'vgcjg', 'dashboard_guru/materi/5+Novhan+Rizki.pdf'),
(11, 'INN', 'X', 7, 'jknoioib', '../uploads/_21ca84b2-ebef-4332-8403-ed0297437893.jpg'),
(13, 'IPS', 'x', 2, 'HHHH', '../uploads -2.jpg'),
(14, 'b indo', 'XI', 2, 'hahahha', '../uploads_.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `id` int(11) NOT NULL,
  `kelas` varchar(10) NOT NULL,
  `hari` varchar(10) NOT NULL,
  `mata_pelajaran` varchar(50) NOT NULL,
  `jam` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `schedules`
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
-- Table structure for table `siswa_tugas`
--

CREATE TABLE `siswa_tugas` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `tugas_id` int(11) DEFAULT NULL,
  `file_path` text DEFAULT NULL,
  `upload_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tugas`
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
-- Dumping data for table `tugas`
--

INSERT INTO `tugas` (`id`, `guru_id`, `kelas`, `mata_pelajaran`, `deskripsi`, `due_date`, `overdue`) VALUES
(13, 2, 'XII', 'IPA', 'KERJAKAN', '2024-07-04 09:36:00', 0),
(15, 2, 'XII', 'Biologi', 'Kerjakan soal tentang Venotif dan genotif', '2024-07-18 16:30:00', 0),
(16, 2, 'X', 'mtk', 'kerjakan tugas', '2024-07-18 16:10:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` enum('admin','guru','siswa') NOT NULL,
  `kelas` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `kelas`) VALUES
(1, 'admin', 'admin', 'admin', ''),
(2, 'guru', 'guru', 'guru', ''),
(3, 'indra', 'indra', 'siswa', 'X'),
(15, 'ucup mansur', '1234', 'siswa', 'X'),
(16, 'siswa1', 'siswa1', 'siswa', 'xi'),
(17, 'nana', 'nana', 'siswa', 'xii'),
(19, 'Dhiko Wahyu Ramantaka', 'dhiko123', 'siswa', 'XII'),
(20, 'dian', '123', 'siswa', ''),
(21, 'dewi', '', 'siswa', 'x');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `materi`
--
ALTER TABLE `materi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `siswa_tugas`
--
ALTER TABLE `siswa_tugas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `tugas_id` (`tugas_id`);

--
-- Indexes for table `tugas`
--
ALTER TABLE `tugas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `guru_id` (`guru_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `materi`
--
ALTER TABLE `materi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `siswa_tugas`
--
ALTER TABLE `siswa_tugas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tugas`
--
ALTER TABLE `tugas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `siswa_tugas`
--
ALTER TABLE `siswa_tugas`
  ADD CONSTRAINT `siswa_tugas_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `siswa_tugas_ibfk_2` FOREIGN KEY (`tugas_id`) REFERENCES `tugas` (`id`);

--
-- Constraints for table `tugas`
--
ALTER TABLE `tugas`
  ADD CONSTRAINT `tugas_ibfk_1` FOREIGN KEY (`guru_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
