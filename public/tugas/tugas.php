<?php
include '../db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$kelas = $_SESSION['kelas'];

// Debugging statement to check class
echo "Kelas: " . $kelas . "<br>";

$sql = "SELECT * FROM tugas WHERE kelas = ? ORDER BY due_date";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $kelas);
$stmt->execute();
$result = $stmt->get_result();

// Debugging statement to check the number of rows
echo "Number of rows: " . $result->num_rows . "<br>";

?>

<!DOCTYPE html>
<html>
<head>
    <title>Tugas</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-6">Daftar Tugas</h2>
        <?php if ($result->num_rows > 0): ?>
            <table class="min-w-full bg-white">
                <thead class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <tr>
                        <th class="py-3 px-6 text-left">Mata Pelajaran</th>
                        <th class="py-3 px-6 text-left">Deskripsi</th>
                        <th class="py-3 px-6 text-left">Due Date</th>
                        <th class="py-3 px-6 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    <?php while($row = $result->fetch_assoc()): ?>
                        <tr class="border-b border-gray-200 bg-gray-50 hover:bg-gray-100">
                            <td class="py-3 px-6 text-left"><?php echo $row['mata_pelajaran']; ?></td>
                            <td class="py-3 px-6 text-left"><?php echo $row['deskripsi']; ?></td>
                            <td class="py-3 px-6 text-left"><?php echo date('d-m-Y H:i', strtotime($row['due_date'])); ?></td>
                            <td class="py-3 px-6 text-left">
                                <form action="upload_tugas.php" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="tugas_id" value="<?php echo $row['id']; ?>">
                                    <input type="file" name="tugas_file" required>
                                    <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600">Upload</button>
                                </form>
                                <form action="hapus_tugas.php" method="POST">
                                    <input type="hidden" name="tugas_id" value="<?php echo $row['id']; ?>">
                                    <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 mt-2">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="text-gray-600">Belum ada tugas.</p>
        <?php endif; ?>
        <tr>
                <td colspan="4" class="px-6 py-4 whitespace-nowrap text-center">
                    <a href="../role.php" role="button" class="mr-6 inline-block rounded bg-blue-500 text-white shadow-[0_4px_9px_-4px_rgba(51,45,45,0.7)] hover:bg-blue-600 hover:shadow-[0_8px_9px_-4px_rgba(51,45,45,0.2),0_4px_18px_0_rgba(51,45,45,0.1)] focus:bg-blue-800 focus:shadow-[0_8px_9px_-4px_rgba(51,45,45,0.2),0_4px_18px_0_rgba(51,45,45,0.1)] active:bg-blue-700 active:shadow-[0_8px_9px_-4px_rgba(51,45,45,0.2),0_4px_18px_0_rgba(51,45,45,0.1)] px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal transition duration-150 ease-in-out focus:outline-none focus:ring-0">kembali</a>
                </td>
            </tr>
    </div>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
