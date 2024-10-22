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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $mata_pelajaran = $_POST['mata_pelajaran'];
    $kelas = $_POST['kelas'];
    $minggu = $_POST['minggu'];
    $deskripsi = $_POST['deskripsi'];

    // Handling file upload
    $target_dir = "../uploads";
    $file_name = basename($_FILES["file"]["name"]);
    $target_file = $target_dir . $file_name;
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check file size
    if ($_FILES["file"]["size"] > 5000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }


    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
            echo "The file ". htmlspecialchars($file_name). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    // Save materi data and file path to database
    $stmt = $conn->prepare("INSERT INTO materi (mata_pelajaran, kelas, minggu, deskripsi, file_path) VALUES (?, ?, ?, ?, ?)");
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

    $bind = $stmt->bind_param("ssiss", $mata_pelajaran, $kelas, $minggu, $deskripsi, $target_file);
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
