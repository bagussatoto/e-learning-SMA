<?php
include '../db.php';
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit;
}

if (isset($_GET['id'])) {
    $attendance_id = $_GET['id'];

    $stmt = $conn->prepare("DELETE FROM users WHERE id=?");
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }
    
    $bind = $stmt->bind_param("i", $attendance_id);
    if ($bind === false) {
        die("Error binding parameters: " . $stmt->error);
    }

    $exec = $stmt->execute();
    if ($exec === false) {
        die("Error executing statement: " . $stmt->error);
    } else {
        header("Location: admin.php");
        exit;
    }

    $stmt->close();
}
?>
