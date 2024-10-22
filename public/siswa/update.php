<?php
include '../db.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM users WHERE id=$id";
    $result = $conn->query($sql);
    $user = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $age = $_POST['age'];

    $sql = "UPDATE users SET name='$name', email='$email', age='$age' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update User</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-6">Update User</h2>
        <form method="POST" action="update.php" class="space-y-4">
            <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
            <div>
                <label class="block text-gray-700">Name:</label>
                <input type="text" name="name" value="<?php echo $user['name']; ?>" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500">
            </div>
            <div>
                <label class="block text-gray-700">Email:</label>
                <input type="email" name="email" value="<?php echo $user['email']; ?>" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500">
            </div>
            <div>
                <label class="block text-gray-700">Age:</label>
                <input type="number" name="age" value="<?php echo $user['age']; ?>" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500">
            </div>
            <div>
                <input type="submit" value="Update" class="w-full bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-700 cursor-pointer">
            </div>
        </form>
    </div>
</body>
</html>
