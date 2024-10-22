<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guru - Kelola Materi</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md">
    
    <a href="../role.php" role="button" class="mr-6 inline-block rounded bg-blue-500 text-white shadow-[0_4px_9px_-4px_rgba(51,45,45,0.7)] hover:bg-blue-600 hover:shadow-[0_8px_9px_-4px_rgba(51,45,45,0.2),0_4px_18px_0_rgba(51,45,45,0.1)] focus:bg-blue-800 focus:shadow-[0_8px_9px_-4px_rgba(51,45,45,0.2),0_4px_18px_0_rgba(51,45,45,0.1)] active:bg-blue-700 active:shadow-[0_8px_9px_-4px_rgba(51,45,45,0.2),0_4px_18px_0_rgba(51,45,45,0.1)] px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal transition duration-150 ease-in-out focus:outline-none focus:ring-0">kembali</a>

    <div class="mb-6"></div>

    <h2 class="text-2xl font-bold mb-4">Unggah Materi Baru</h2>
        <form method="POST" enctype="multipart/form-data" action="materi_upload.php" class="space-y-4">
            <div class="flex flex-wrap items-center space-x-4">
                <label for="mata_pelajaran" class="w-32">Mata Pelajaran:</label>
                <input type="text" id="mata_pelajaran" name="mata_pelajaran" required class="flex-1 border rounded-md p-2">
            </div>

            <div class="flex flex-wrap items-center space-x-4">
                <label for="kelas" class="w-32">Kelas:</label>
                <input type="text" id="kelas" name="kelas" required class="flex-1 border rounded-md p-2">
            </div>

            <div class="flex flex-wrap items-center space-x-4">
                <label for="minggu" class="w-32">Minggu:</label>
                <input type="number" id="minggu" name="minggu" required class="flex-1 border rounded-md p-2">
            </div>

            <div class="flex flex-wrap items-center space-x-4">
                <label for="deskripsi" class="w-32">Deskripsi:</label>
                <textarea id="deskripsi" name="deskripsi" class="flex-1 border rounded-md p-2"></textarea>
            </div>

            <div class="flex flex-wrap items-center space-x-4">
                <label for="file" class="w-32">Upload Materi (File):</label>
                <input type="file" id="file" name="file" required class="flex-1">
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Unggah</button>
        </form>
    </div>

    <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md mt-6">
        <h2 class="text-2xl font-bold mb-4">Daftar Materi</h2>
        <div class="overflow-x-auto">
            <table class="table-auto w-full border-collapse border border-gray-200">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border border-gray-300 px-4 py-2">ID</th>
                        <th class="border border-gray-300 px-4 py-2">Mata Pelajaran</th>
                        <th class="border border-gray-300 px-4 py-2">Kelas</th>
                        <th class="border border-gray-300 px-4 py-2">Minggu</th>
                        <th class="border border-gray-300 px-4 py-2">Deskripsi</th>
                        <th class="border border-gray-300 px-4 py-2">File Path</th>
                        <th class="border border-gray-300 px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include '../db.php';
                    $result = $conn->query("SELECT * FROM materi");
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td class='border border-gray-300 px-4 py-2'>" . $row['id'] . "</td>";
                        echo "<td class='border border-gray-300 px-4 py-2'>" . $row['mata_pelajaran'] . "</td>";
                        echo "<td class='border border-gray-300 px-4 py-2'>" . $row['kelas'] . "</td>";
                        echo "<td class='border border-gray-300 px-4 py-2'>" . $row['minggu'] . "</td>";
                        echo "<td class='border border-gray-300 px-4 py-2'>" . $row['deskripsi'] . "</td>";
                        echo "<td class='border border-gray-300 px-4 py-2'><a href='" . $row['file_path'] . "'>Download</a></td>";
                        echo "<td class='border border-gray-300 px-4 py-2'>
                                <a href='materi_edit.php?id=" . $row['id'] . "' class='text-blue-500'>Edit</a>
                                <a href='materi_delete.php?id=" . $row['id'] . "' onclick='return confirm(\"Yakin ingin menghapus?\")' class='text-red-500 ml-2'>Hapus</a>
                            </td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
