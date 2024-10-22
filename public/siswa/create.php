<?php
include '../db.php';
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: ./admin/login.php");
    exit;
}

$id = $_GET['id'];
$sql = "SELECT * FROM users WHERE id='$id'";
$result = $conn->query($sql);
$user = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Menggunakan prepared statement untuk menghindari duplikasi
    $stmt = $conn->prepare("UPDATE users SET username=?, password=?, role=? WHERE id=?");
    $stmt->bind_param("sssi", $username, $password, $role, $id);

    if ($stmt->execute()) {
        header("Location: ./admin/manage_users.php");
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Create User</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-6">Create User</h2>
        <form method="POST" action="create.php" class="space-y-4">
            <div>
                <label class="block text-gray-700">Name:</label>
                <input type="text" name="name" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500">
            </div>
            <div>
                <label class="block text-gray-700">Mata Pelajaran:</label>
                <select name="mata_pelajaran" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500">
                    <option value="IPA">IPA</option>
                    <option value="MTK">MTK</option>
                    <option value="IPS">IPS</option>
                    <option value="Bahasa Indonesia">Bahasa Indonesia</option>
                    <option value="Bahasa Inggris">Bahasa Inggris</option>
                </select>
            </div>
            <div>
                <label class="block text-gray-700">Kelas:</label>
                <select name="kelas" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500">
                    <option value="X">X</option>
                    <option value="XI">XI</option>
                    <option value="XII">XII</option>
                </select>
            </div>
            <div>
                <input type="submit" value="Create" class="w-full bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-700 cursor-pointer">
            </div>
        </form>
        <br>
        <a href="read.php" class="block w-full text-center bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-700">Kembali ke Halaman Read</a>
    </div>
</body>
</html>
