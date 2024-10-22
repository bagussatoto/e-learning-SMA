<?php
include '../db.php';

$sql = "SELECT * FROM users";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Read Users</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-6">Users List</h2>
        <table class="w-full table-auto border-collapse">
            <thead>
                <tr>
                    <th class="border px-4 py-2">ID</th>
                    <th class="border px-4 py-2">Name</th>
                    <th class="border px-4 py-2">Mata Pelajaran</th>
                    <th class="border px-4 py-2">Kelas</th>
                    <th class="border px-4 py-2">Created At</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td class='border px-4 py-2'>{$row['id']}</td>
                                <td class='border px-4 py-2'>{$row['name']}</td>
                                <td class='border px-4 py-2'>{$row['mata_pelajaran']}</td>
                                <td class='border px-4 py-2'>{$row['kelas']}</td>
                                <td class='border px-4 py-2'>{$row['created_at']}</td>
                                </td>
                            </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5' class='border px-4 py-2 text-center'>No users found</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <br>
        <a href="create.php" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-700">Add New User</a>
        <a href="./admin/index.php" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-blue-700">admin</a>
    </div>
</body>
</html>
