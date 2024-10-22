<?php
include '../db.php';
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit;
}

// Fetch all users
$sql_users = "SELECT * FROM users";
$result_users = $conn->query($sql_users);

// Fetch all attendance records
$sql_attendance = "SELECT * FROM attendance";
$result_attendance = $conn->query($sql_attendance);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-6">Admin Panel</h2>
        <a href="../role.php" class="lg:p-2 py-4 border-b-1 bg-blue-600 text-white p-4 rounded mb-6 inline-block">kembali</a>
        
        <!-- Users Table -->
        <h3 class="text-xl font-bold mb-4">Users</h3>
        <a href="add_user.php" class="text-blue-500 hover:text-blue-700 mb-4 inline-block">Add User</a>
        <table class="min-w-full divide-y divide-gray-200 mb-6">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Username</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <?php while ($row = $result_users->fetch_assoc()): ?>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap"><?php echo $row['id']; ?></td>
                        <td class="px-6 py-4 whitespace-nowrap"><?php echo $row['username']; ?></td>
                        <td class="px-6 py-4 whitespace-nowrap"><?php echo $row['role']; ?></td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <a href="edit_user.php?id=<?php echo $row['id']; ?>" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                            <a href="delete_user.php?id=<?php echo $row['id']; ?>" class="text-red-600 hover:text-red-900 ml-4" onclick="return confirm('yikin miw minghicis pinggini ini?');">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

      <!-- Attendance Table -->
        <h3 class="text-xl font-bold mb-4">Attendance</h3>
        <a href="add_attendance.php" class="text-blue-500 hover:text-blue-700 mb-4 inline-block">Add Attendance</a>
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mata Pelajaran</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kelas</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Attendance Date</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <?php while ($row = $result_attendance->fetch_assoc()): ?>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap"><?php echo $row['id']; ?></td>
                        <td class="px-6 py-4 whitespace-nowrap"><?php echo $row['user_id']; ?></td>
                        <td class="px-6 py-4 whitespace-nowrap"><?php echo $row['nama']; ?></td>
                        <td class="px-6 py-4 whitespace-nowrap"><?php echo $row['mata_pelajaran']; ?></td>
                        <td class="px-6 py-4 whitespace-nowrap"><?php echo $row['kelas']; ?></td>
                        <td class="px-6 py-4 whitespace-nowrap"><?php echo $row['attendance_date']; ?></td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <a href="edit_attendance.php?id=<?php echo $row['id']; ?>" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                            <a href="delete_attendance.php?id=<?php echo $row['id']; ?>" class="text-red-600 hover:text-red-900 ml-4" onclick="return confirm('yakin maw menghacus pengguna ini?');">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>  
    </div>
</body>
</html>
