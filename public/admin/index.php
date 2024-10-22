<?php
include '../db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$role = $_SESSION['role'];

?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-6">Dashboard ADMIN</h2>
        <?php if ($role == 'admin'): ?>
            <a href="manage_users.php" class="block w-full text-center bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-700">edit guru user</a>
        <?php elseif ($role == 'guru'): ?>
            <a href="manage_attendance.php" class="block w-full text-center bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-700">kehadiran siswa</a>
        <?php endif; ?>
        <br>
        <a href="logout.php" class="block w-full text-center bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-700">Logout</a>
    </div>
</body>
</html>
