<?php
include '../db.php';
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'guru') {
    header("Location: ../login.php");
    exit;
}

// Fetch attendance data
$sql = "SELECT * FROM attendance";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title> kehadiran siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-6">kehadiran siswa</h2>
        <a href="../role.php" role="button" class="mr-6 inline-block rounded bg-blue-500 text-white shadow-[0_4px_9px_-4px_rgba(51,45,45,0.7)] hover:bg-blue-600 hover:shadow-[0_8px_9px_-4px_rgba(51,45,45,0.2),0_4px_18px_0_rgba(51,45,45,0.1)] focus:bg-blue-800 focus:shadow-[0_8px_9px_-4px_rgba(51,45,45,0.2),0_4px_18px_0_rgba(51,45,45,0.1)] active:bg-blue-700 active:shadow-[0_8px_9px_-4px_rgba(51,45,45,0.2),0_4px_18px_0_rgba(51,45,45,0.1)] px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal transition duration-150 ease-in-out focus:outline-none focus:ring-0 mb-6">kembali</a>
        <table class="w-full table-auto border-collapse">
            <thead>
                <tr>
                    <th class="border px-4 py-2">ID</th>
                    <th class="border px-4 py-2">Nama</th>
                    <th class="border px-4 py-2">Mata Pelajaran</th>
                    <th class="border px-4 py-2">Kelas</th>
                    <th class="border px-4 py-2">Attendance Date</th>
                    <th class="border px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td class='border px-4 py-2'>{$row['id']}</td>
                                <td class='border px-4 py-2'>{$row['nama']}</td>
                                <td class='border px-4 py-2'>{$row['mata_pelajaran']}</td>
                                <td class='border px-4 py-2'>{$row['kelas']}</td>
                                <td class='border px-4 py-2'>{$row['attendance_date']}</td>
                                <td class='border px-4 py-2'>
                                    <a href='edit_siswa.php?id={$row['id']}' class='text-blue-500 hover:underline'>Edit</a> |
                                    <a href='delete_siswa.php?id={$row['id']}' class='text-red-500 hover:underline'>Delete</a>
                                </td>
                            </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6' class='border px-4 py-2 text-center'>No attendance records found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
