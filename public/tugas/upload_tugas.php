<?php
include '../db.php';
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'siswa') {
    header("Location: ../login.php");
    exit;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $tugas_id = $_POST['tugas_id'];
    $file_name = $_FILES['tugas_file']['name'];
    $file_tmp = $_FILES['tugas_file']['tmp_name'];
    $upload_dir = "../uploads";
    $file_path = $upload_dir . basename($file_name);

    if (move_uploaded_file($file_tmp, $file_path)) {
        $sql = "INSERT INTO siswa_tugas (user_id, tugas_id, file_path) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iis", $user_id, $tugas_id, $file_path);

        if ($stmt->execute()) {
            header("Location: tugas.php");
            exit;
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $stmt->close();
    } else {
        echo "Error uploading file.";
    }

    $conn->close();
}
?>
