<?php
include 'koneksi.php'; // Pastikan jalur ini benar

// Cek apakah ada ID yang diberikan untuk diedit
$id = $_GET['id'] ?? '';
if ($id) {
    // Ambil data berdasarkan ID
    $sql = "SELECT * FROM tel WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
}

// Proses form ketika disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_pc = $_POST['nama_pc'] ?? '';
    $tanggal_input = $_POST['tanggal_input'] ?? '';
    $kondisi_pc = $_POST['kondisi_pc'] ?? '';
    $jenis_pc = $_POST['jenis_pc'] ?? '';
    $lokasi_pc = $_POST['lokasi_pc'] ?? '';

    // Update data ke database
    $sql = "UPDATE tel SET nama_pc = ?, tanggal_input = ?, kondisi_pc = ?, jenis_pc = ?, lokasi_pc = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $nama_pc, $tanggal_input, $kondisi_pc, $jenis_pc, $lokasi_pc, $id);
    $stmt->execute();

    // Redirect setelah update
    header("Location: search_data.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data PC</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="section">
        <h1>Edit Data PC</h1>
        <form method="post" action="">
            <label for="nama_pc">Nama PC:</label>
            <input type="text" name="nama_pc" value="<?php echo htmlspecialchars($data['nama_pc']); ?>" required>

            <label for="tanggal_input">Tanggal Input:</label>
            <input type="date" name="tanggal_input" value="<?php echo htmlspecialchars($data['tanggal_input']); ?>" required>

            <label for="kondisi_pc">Kondisi PC:</label>
            <select name="kondisi_pc">
                <option value="baik" <?php echo $data['kondisi_pc'] === 'baik' ? 'selected' : ''; ?>>Baik</option>
                <option value="cukup baik" <?php echo $data['kondisi_pc'] === 'cukup baik' ? 'selected' : ''; ?>>Cukup Baik</option>
                <option value="kurang baik" <?php echo $data['kondisi_pc'] === 'kurang baik' ? 'selected' : ''; ?>>Kurang Baik</option>
            </select>

            <label for="jenis_pc">Jenis PC:</label>
            <input type="text" name="jenis_pc" value="<?php echo htmlspecialchars($data['jenis_pc']); ?>" required>

            <label for="lokasi_pc">Lokasi PC:</label>
            <input type="text" name="lokasi_pc" value="<?php echo htmlspecialchars($data['lokasi_pc']); ?>" required>

            <input type="submit" value="Simpan">
            <a href="search_data.php" class="btn">Batal</a>
        </form>
    </div>

    <?php $conn->close(); ?>
</body>
</html>
