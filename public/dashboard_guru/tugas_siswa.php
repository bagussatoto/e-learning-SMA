<?php
include '../db.php';
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'guru') {
    header("Location: ../login.php");
    exit;
}

$guru_id = $_SESSION['user_id'];
$sql = "SELECT * FROM tugas WHERE guru_id='$guru_id'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Guru</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <a href="../role.php" role="button" class="mr-6 inline-block rounded bg-blue-500 text-white shadow-[0_4px_9px_-4px_rgba(51,45,45,0.7)] hover:bg-blue-600 hover:shadow-[0_8px_9px_-4px_rgba(51,45,45,0.2),0_4px_18px_0_rgba(51,45,45,0.1)] focus:bg-blue-800 focus:shadow-[0_8px_9px_-4px_rgba(51,45,45,0.2),0_4px_18px_0_rgba(51,45,45,0.1)] active:bg-blue-700 active:shadow-[0_8px_9px_-4px_rgba(51,45,45,0.2),0_4px_18px_0_rgba(51,45,45,0.1)] px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal transition duration-150 ease-in-out focus:outline-none focus:ring-0 mb-4">kembali</a>
        <h2 class="text-2xl font-bold mb-6">Dashboard Guru</h2>
        <a ahref=""></a>
        <a href="add_tugas.php" class="text-blue-500 hover:text-blue-700 mb-4 inline-block">Add Tugas</a>
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kelas</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mata Pelajaran</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Deskripsi</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Due Date</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap"><?php echo $row['kelas']; ?></td>
                        <td class="px-6 py-4 whitespace-nowrap"><?php echo $row['mata_pelajaran']; ?></td>
                        <td class="px-6 py-4 whitespace-nowrap"><?php echo $row['deskripsi']; ?></td>
                        <td class="px-6 py-4 whitespace-nowrap"><?php echo $row['due_date']; ?></td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <a href="edit_tugas.php?id=<?php echo $row['id']; ?>" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                            <a href="delete_tugas.php?id=<?php echo $row['id']; ?>" class="text-red-600 hover:text-red-900 ml-4" onclick="return confirm('yakin ingin menghapus tugas ini?');">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
