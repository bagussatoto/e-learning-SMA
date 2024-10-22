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
    $user_id = $_GET['id'];
    $sql = "SELECT * FROM users WHERE id='$user_id'";
    $result = $conn->query($sql);
    $user = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_POST['user_id'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $stmt = $conn->prepare("UPDATE users SET username=?, password=?, role=? WHERE id=?");
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }
    
    $bind = $stmt->bind_param("sssi", $username, $password, $role, $user_id);
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

<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-6">Edit User</h2>
        <form method="POST" action="edit_user.php">
            <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
            <div class="mb-4">
                <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                <input type="text" name="username" id="username" value="<?php echo $user['username']; ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </div>
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="password" id="password" value="<?php echo $user['password']; ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </div>
            <div class="mb-4">
                <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
                <select name="role" id="role" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    <option value="admin" <?php if ($user['role'] == 'admin') echo 'selected'; ?>>Admin</option>
                    <option value="guru" <?php if ($user['role'] == 'guru') echo 'selected'; ?>>Guru</option>
                    <option value="siswa" <?php if ($user['role'] == 'siswa') echo 'selected'; ?>>Siswa</option>
                </select>
            </div>
            <div class="flex justify-end">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Update</button>
            </div>
        </form>
    </div>
</body>
</html>
