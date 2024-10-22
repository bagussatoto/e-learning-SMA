<?php
include '../db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $tugas_id = $_POST['tugas_id'];

    $sql = "SELECT file_path FROM siswa_tugas WHERE user_id = ? AND tugas_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $user_id, $tugas_id);
    $stmt->execute();
    $stmt->bind_result($file_path);
    $stmt->fetch();
    $stmt->close();

    if (file_exists($file_path)) {
        unlink($file_path);
    }

    $sql = "DELETE FROM siswa_tugas WHERE user_id = ? AND tugas_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $user_id, $tugas_id);

    if ($stmt->execute()) {
        header("Location: tugas.php");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>
