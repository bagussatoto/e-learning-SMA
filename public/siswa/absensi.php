<?php
include '../db.php';
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'siswa') {
    header("Location: ../login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_POST['user_id'];
    $nama = $_POST['nama'];
    $mata_pelajaran = $_POST['mata_pelajaran'];
    $kelas = $_POST['kelas'];
    $attendance_date = date('Y-m-d H:i:s');

    // Debugging statement
    echo "User ID: $user_id<br>";
    echo "Nama: $nama<br>";
    echo "Mata Pelajaran: $mata_pelajaran<br>";
    echo "Kelas: $kelas<br>";
    echo "Attendance Date: $attendance_date<br>";

    $stmt = $conn->prepare("INSERT INTO attendance (user_id, nama, mata_pelajaran, kelas, attendance_date) VALUES (?, ?, ?, ?, ?)");
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }
    
    $bind = $stmt->bind_param("issss", $user_id, $nama, $mata_pelajaran, $kelas, $attendance_date);
    if ($bind === false) {
        die("Error binding parameters: " . $stmt->error);
    }

    $exec = $stmt->execute();
    if ($exec === false) {
        die("Error executing statement: " . $stmt->error);
    } else {
        echo "Kehadiran telah terekam.";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Absensi</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="antialised bg-gray-100 p-6">
<div class="container mx-auto px-4 py-10">
    <div class="block bg-white rounded-lg shadow-md overflow-hidden">
        <h2 class="text-2xl font-bold mb-6">Absensi telah terekam</h2>
        <a href="../role.php" class="block  bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Kembali ke Home</a>
    </div>
</div>

</body>

</html>
