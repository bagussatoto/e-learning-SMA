<?php
include 'db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['kelas'] = $user['kelas']; // Menyimpan kelas dalam sesi
        $_SESSION['role'] = $user['role'];
        header("Location: role.php");
    } else {
        echo "Nama atau password salah.";
    }
    $stmt->close();

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
      body {
        background-image: url('./foto/background.jpg');
        background-size: cover;
        background-position: center;
      }
    </style>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center">
        <div class="bg-white p-6 rounded shadow-md w-full max-w-sm">
          <div class="flex items-center mb-4">
            <img src="foto/logo.jpeg" alt="logoSMA" class="w-16 h-16 mr-4">
            <div class="ml-8">
              <h2 class="text-2xl font-bold ">ELEARNING</h2>
              <h2 class="text-base">SMAN 1 GOMBONG</h2>
            </div>
          </div> 
            <form method="POST" action="login.php" class="space-y-4">
                <div class="mb-4">
                    <label class="block mb-2"></label>
                    <input type="text" name="username" placeholder="username" required class="w-full p-2 border rounded">
                </div>
                <div class="mb-4">
                    <label class="block mb-2"></label>
                    <input type="password" name="password" placeholder="password" required class="w-full p-2 border rounded" required>
                </div>
                <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded">Login</button>
            </form>
        </div>
    </div>
    </div>
</body>
</html>