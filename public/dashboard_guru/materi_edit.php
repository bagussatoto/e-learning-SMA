<?php
include '../db.php';
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'guru') {
    header("Location: ../login.php");
    exit;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $conn->query("SELECT * FROM materi WHERE id = $id");
    $materi = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $mata_pelajaran = $_POST['mata_pelajaran'];
    $kelas = $_POST['kelas'];
    $minggu = $_POST['minggu'];
    $deskripsi = $_POST['deskripsi'];
    $file_path = $materi['file_path'];

    if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
        $target_dir = "../uploads";
        $file_name = basename($_FILES["file"]["name"]);
        $target_file = $target_dir . $file_name;
        $uploadOk = 1;
        $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        if ($_FILES["file"]["size"] > 5000000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
                $file_path = $target_file;
            } else {
                echo "Sorry, there was an error uploading your file: " . $_FILES["file"]["error"];
            }
        }
    }

    $stmt = $conn->prepare("UPDATE materi SET mata_pelajaran = ?, kelas = ?, minggu = ?, deskripsi = ?, file_path = ? WHERE id = ?");
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

    $bind = $stmt->bind_param("ssissi", $mata_pelajaran, $kelas, $minggu, $deskripsi, $file_path, $id);
    if ($bind === false) {
        die("Error binding parameters: " . $stmt->error);
    }

    $exec = $stmt->execute();
    if ($exec === false) {
        die("Error executing statement: " . $stmt->error);
    } else {
        header("Location: materi.php");
        exit;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Materi</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-4">Edit Materi</h2>
        <form method="POST" enctype="multipart/form-data" class="space-y-4">
            <input type="hidden" name="id" value="<?php echo $materi['id']; ?>">

            <div class="flex flex-wrap items-center space-x-4">
                <label for="mata_pelajaran" class="w-32">Mata Pelajaran:</label>
                <input type="text" id="mata_pelajaran" name="mata_pelajaran" value="<?php echo $materi['mata_pelajaran']; ?>" required class="flex-1 border rounded-md p-2">
            </div>

            <div class="flex flex-wrap items-center space-x-4">
                <label for="kelas" class="w-32">Kelas:</label>
                <input type="text" id="kelas" name="kelas" value="<?php echo $materi['kelas']; ?>" required class="flex-1 border rounded-md p-2">
            </div>

            <div class="flex flex-wrap items-center space-x-4">
                <label for="minggu" class="w-32">Minggu:</label>
                <input type="number" id="minggu" name="minggu" value="<?php echo $materi['minggu']; ?>" required class="flex-1 border rounded-md p-2">
            </div>

            <div class="flex flex-wrap items-center space-x-4">
                <label for="deskripsi" class="w-32">Deskripsi:</label>
                <textarea id="deskripsi" name="deskripsi" class="flex-1 border rounded-md p-2"><?php echo $materi['deskripsi']; ?></textarea>
            </div>

            <div class="flex flex-wrap items-center space-x-4">
                <label for="file" class="w-32">Upload Materi Baru (File):</label>
                <input type="file" id="file" name="file" class="flex-1">
            </div>
            <div>
                <p class="mt-2">File saat ini: <a href="<?php echo $materi['file_path']; ?>" class="text-blue-500">Download</a></p>
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Update</button>
        </form>
    </div>
</body>
</html>
