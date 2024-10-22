<?php
include '../db.php';
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'guru') {
    header("Location: ../login.php");
    exit;
}

$tugas_id = $_GET['id'];
$mata_pelajaran = '';
$kelas = '';
$deskripsi = '';
$due_date = '';

$sql = "SELECT * FROM tugas WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $tugas_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $mata_pelajaran = $row['mata_pelajaran'];
    $kelas = $row['kelas'];
    $deskripsi = $row['deskripsi'];
    $due_date = date('Y-m-d\TH:i', strtotime($row['due_date']));
} else {
    header("Location: tugas_siswa.php");
    exit;
}

$stmt->close();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mata_pelajaran = $_POST['mata_pelajaran'];
    $kelas = $_POST['kelas'];
    $deskripsi = $_POST['deskripsi'];
    $due_date = $_POST['due_date'];

    $sql = "UPDATE tugas SET mata_pelajaran = ?, kelas = ?, deskripsi = ?, due_date = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $mata_pelajaran, $kelas, $deskripsi, $due_date, $tugas_id);

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
    <title>Edit Tugas</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-6">Edit Tugas</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?id=<?php echo $tugas_id; ?>" method="POST">
            <div class="mb-4">
                <label for="mata_pelajaran" class="block text-sm font-medium text-gray-700">Mata Pelajaran</label>
                <input type="text" id="mata_pelajaran" name="mata_pelajaran" value="<?php echo $mata_pelajaran; ?>" required class="mt-1 p-2 w-full border border-gray-300 rounded-md">
            </div>
            <div class="mb-4">
                <label for="kelas" class="block text-sm font-medium text-gray-700">Kelas</label>
                <select id="kelas" name="kelas" required class="mt-1 p-2 w-full border border-gray-300 rounded-md">
                    <option value="X" <?php if ($kelas == 'X') echo 'selected'; ?>>Kelas X</option>
                    <option value="XI" <?php if ($kelas == 'XI') echo 'selected'; ?>>Kelas XI</option>
                    <option value="XII" <?php if ($kelas == 'XII') echo 'selected'; ?>>Kelas XII</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                <textarea id="deskripsi" name="deskripsi" rows="4" required class="mt-1 p-2 w-full border border-gray-300 rounded-md"><?php echo $deskripsi; ?></textarea>
            </div>
            <div class="mb-4">
                <label for="due_date" class="block text-sm font-medium text-gray-700">Due Date</label>
                <input type="datetime-local" id="due_date" name="due_date" value="<?php echo $due_date; ?>" required class="mt-1 p-2 w-full border border-gray-300 rounded-md">
            </div>
            <div class="flex items-center justify-end">
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:bg-blue-600">Update</button>
            </div>
        </form>
    </div>
</body>
</html>
