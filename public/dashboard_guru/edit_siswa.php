<?php
include '../db.php';
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'guru') {
    header("Location: ../login.php");
    exit;
}

if (isset($_GET['id'])) {
    $attendance_id = $_GET['id'];
    $sql = "SELECT * FROM attendance WHERE id='$attendance_id'";
    $result = $conn->query($sql);
    $attendance = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $attendance_id = $_POST['attendance_id'];
    $user_id = $_POST['user_id'];
    $nama = $_POST['nama'];
    $mata_pelajaran = $_POST['mata_pelajaran'];
    $kelas = $_POST['kelas'];
    $attendance_date = $_POST['attendance_date'];

    $stmt = $conn->prepare("UPDATE attendance SET user_id=?, nama=?, mata_pelajaran=?, kelas=?, attendance_date=? WHERE id=?");
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }
    
    $bind = $stmt->bind_param("issssi", $user_id, $nama, $mata_pelajaran, $kelas, $attendance_date, $attendance_id);
    if ($bind === false) {
        die("Error binding parameters: " . $stmt->error);
    }

    $exec = $stmt->execute();
    if ($exec === false) {
        die("Error executing statement: " . $stmt->error);
    } else {
        header("Location: kehadiranSiswa.php");
        exit;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Attendance</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-6">Edit Attendance</h2>
        <form method="POST" action="edit_siswa.php">
            <input type="hidden" name="attendance_id" value="<?php echo $attendance['id']; ?>">
            <div class="mb-4">
                <label for="user_id" class="block text-sm font-medium text-gray-700">User ID</label>
                <input type="text" name="user_id" id="user_id" value="<?php echo $attendance['user_id']; ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </div>
            <div class="mb-4">
                <label for="nama" class="block text-sm font-medium text-gray-700">Nama</label>
                <input type="text" name="nama" id="nama" value="<?php echo $attendance['nama']; ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </div>
            <div class="mb-4">
                <label for="mata_pelajaran" class="block text-sm font-medium text-gray-700">Mata Pelajaran</label>
                <input type="text" name="mata_pelajaran" id="mata_pelajaran" value="<?php echo $attendance['mata_pelajaran']; ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </div>
            <div class="mb-4">
                <label for="kelas" class="block text-sm font-medium text-gray-700">Kelas</label>
                <input type="text" name="kelas" id="kelas" value="<?php echo $attendance['kelas']; ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </div>
            <div class="mb-4">
                <label for="attendance_date" class="block text-sm font-medium text-gray-700">Attendance Date</label>
                <input type="text" name="attendance_date" id="attendance_date" value="<?php echo $attendance['attendance_date']; ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </div>
            <div class="flex justify-end">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Update</button>
            </div>
        </form>
    </div>
</body>
</html>
