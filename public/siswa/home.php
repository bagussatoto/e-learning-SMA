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

$user_id = $_SESSION['user_id'];

// Fetch user details
$sql = "SELECT * FROM users WHERE id='$user_id'";
$result = $conn->query($sql);
$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-6">Welcome, <?php echo $user['username']; ?></h2>
        <form method="POST" action="absensi.php">
            <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
            <input type="hidden" name="nama" value="<?php echo $user['username']; ?>">
            <div>
                <label class="block text-gray-700">Mata Pelajaran:</label>
                <select name="mata_pelajaran" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500">
                    <option value="IPA" >IPA</option>
                    <option value="MTK" >MTK</option>
                    <option value="IPS" >IPS</option>
                    <option value="Bahasa Indonesia" >Bahasa Indonesia</option>
                    <option value="Bahasa Inggris" >Bahasa Inggris</option>
                </select>
            </div>
            <div>
                <label class="block text-gray-700">Kelas:</label>
                <select name="kelas" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500">
                    <option value="X" >X</option>
                    <option value="XI" >XI</option>
                    <option value="XII" >XII</option>
                </select>
            </div>
            <input type="submit" value="Hadir" class="w-full bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-700 cursor-pointer mb-4">
            <a href="../role.php" role="button" class="mr-6 inline-block rounded bg-blue-500 text-white shadow-[0_4px_9px_-4px_rgba(51,45,45,0.7)] hover:bg-blue-600 hover:shadow-[0_8px_9px_-4px_rgba(51,45,45,0.2),0_4px_18px_0_rgba(51,45,45,0.1)] focus:bg-blue-800 focus:shadow-[0_8px_9px_-4px_rgba(51,45,45,0.2),0_4px_18px_0_rgba(51,45,45,0.1)] active:bg-blue-700 active:shadow-[0_8px_9px_-4px_rgba(51,45,45,0.2),0_4px_18px_0_rgba(51,45,45,0.1)] px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal transition duration-150 ease-in-out focus:outline-none focus:ring-0">kembali</a>
        </form>
    </div>
</body>
</html>
