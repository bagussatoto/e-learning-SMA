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
    
    // Menghapus file fisik dari server
    $result = $conn->query("SELECT file_path FROM materi WHERE id = $id");
    $row = $result->fetch_assoc();
    if (file_exists($row['file_path'])) {
        unlink($row['file_path']);
    }

    // Menghapus entri dari database
    $stmt = $conn->prepare("DELETE FROM materi WHERE id = ?");
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

    $bind = $stmt->bind_param("i", $id);
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
