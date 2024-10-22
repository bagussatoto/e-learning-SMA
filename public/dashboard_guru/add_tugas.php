<?php
include '../db.php';
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'guru') {
    header("Location: ../login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mata_pelajaran = $_POST['mata_pelajaran'];
    $kelas = $_POST['kelas'];
    $deskripsi = $_POST['deskripsi'];
    $due_date = $_POST['due_date'];
    $guru_id = $_SESSION['user_id'];

    $sql = "INSERT INTO tugas (mata_pelajaran, kelas, deskripsi, due_date, guru_id) 
            VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $mata_pelajaran, $kelas, $deskripsi, $due_date, $guru_id);

    if ($stmt->execute()) {
        header("Location: tugas_siswa.php");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Tugas</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <a href="../role.php" role="button" class="mr-6 inline-block rounded bg-blue-500 text-white shadow-[0_4px_9px_-4px_rgba(51,45,45,0.7)] hover:bg-blue-600 hover:shadow-[0_8px_9px_-4px_rgba(51,45,45,0.2),0_4px_18px_0_rgba(51,45,45,0.1)] focus:bg-blue-800 focus:shadow-[0_8px_9px_-4px_rgba(51,45,45,0.2),0_4px_18px_0_rgba(51,45,45,0.1)] active:bg-blue-700 active:shadow-[0_8px_9px_-4px_rgba(51,45,45,0.2),0_4px_18px_0_rgba(51,45,45,0.1)] px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal transition duration-150 ease-in-out focus:outline-none focus:ring-0 mb-6">kembali</a>

        <h2 class="text-2xl font-bold mb-6">Add Tugas</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <div class="mb-4">
                <label for="mata_pelajaran" class="block text-sm font-medium text-gray-700">Mata Pelajaran</label>
                <input type="text" id="mata_pelajaran" name="mata_pelajaran" required class="mt-1 p-2 w-full border border-gray-300 rounded-md">
            </div>
            <div class="mb-4">
                <label for="kelas" class="block text-sm font-medium text-gray-700">Kelas</label>
                <select id="kelas" name="kelas" required class="mt-1 p-2 w-full border border-gray-300 rounded-md">
                    <option value="X">Kelas X</option>
                    <option value="XI">Kelas XI</option>
                    <option value="XII">Kelas XII</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                <textarea id="deskripsi" name="deskripsi" rows="4" required class="mt-1 p-2 w-full border border-gray-300 rounded-md"></textarea>
            </div>
            <div class="mb-4">
                <label for="due_date" class="block text-sm font-medium text-gray-700">Due Date</label>
                <input type="datetime-local" id="due_date" name="due_date" required class="mt-1 p-2 w-full border border-gray-300 rounded-md">
            </div>
            <div class="flex items-center justify-end">
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:bg-blue-600">Submit</button>
            </div>
        </form>
    </div>
</body>
</html>
