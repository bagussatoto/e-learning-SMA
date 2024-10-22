<?php
include '../db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit;
}

$kelas = $_SESSION['kelas'];
$sql = "SELECT * FROM materi WHERE kelas='$kelas' ORDER BY minggu";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Materi</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="../style.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-6">
<div class="max-w-8xl bg-white shadow-lg rounded-lg mx-auto my-8 p-16 text-left justify-start">
    <div class="bg-succes p-2 text-dark bg-opacity-10">
        <h2 class="text-2xl font-bold mb-6">Materi Kelas <?php echo $kelas; ?></h2>
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Minggu</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mata Pelajaran</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Deskripsi</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">File</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap"><?php echo "Minggu " . $row['minggu']; ?></td>
                        <td class="px-6 py-4 whitespace-nowrap"><?php echo $row['mata_pelajaran']; ?></td>
                        <td class="px-6 py-4 whitespace-nowrap"><?php echo $row['deskripsi']; ?></td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <?php if ($row['file_path']): ?>
                                <a href="<?php echo $row['file_path']; ?>" class="text-blue-500 hover:text-blue-700">Download</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
            
            <tr>
                <td colspan="4" class="px-6 py-4 whitespace-nowrap text-center">
                    <a href="../role.php" role="button" class="mr-6 inline-block rounded bg-blue-500 text-white shadow-[0_4px_9px_-4px_rgba(51,45,45,0.7)] hover:bg-blue-600 hover:shadow-[0_8px_9px_-4px_rgba(51,45,45,0.2),0_4px_18px_0_rgba(51,45,45,0.1)] focus:bg-blue-800 focus:shadow-[0_8px_9px_-4px_rgba(51,45,45,0.2),0_4px_18px_0_rgba(51,45,45,0.1)] active:bg-blue-700 active:shadow-[0_8px_9px_-4px_rgba(51,45,45,0.2),0_4px_18px_0_rgba(51,45,45,0.1)] px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal transition duration-150 ease-in-out focus:outline-none focus:ring-0">kembali</a>
                </td>
            </tr>

        </table>
    </div>
</div>
</body>
</html>
