<?php
// Koneksi ke database
$host = 'localhost';
$user = 'root'; // Username database
$pass = ''; // Password database
$db_name = 'pt_tel'; // Nama database

$conn = mysqli_connect($host, $user, $pass, $db_name);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Proses pengiriman data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_pc = $_POST['nama_pc'];
    $tanggal_input = $_POST['tanggal_input'];
    $kondisi_pc = $_POST['kondisi_pc'];
    $jenis_pc = $_POST['jenis_pc'];
    $lokasi_pc = $_POST['lokasi_pc'];

    // Query untuk menyimpan data ke tabel "tel"
    $sql = "INSERT INTO tel (Nama_pc, Tanggal_input, Kondisi_pc, Jenis_pc, Lokasi_pc) 
            VALUES ('$nama_pc', '$tanggal_input', '$kondisi_pc', '$jenis_pc', '$lokasi_pc')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Data berhasil disimpan!');</script>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Input Data PC</title>
    <link rel="stylesheet" href="style.css"> <!-- Link ke CSS -->
</head>
<body>
    <div class="section">
        <h3>Input Data PC</h3>
        <form method="post" action="input_data.php">
            <label for="nama_pc">Nama PC:</label>
            <input type="text" name="nama_pc" required>

            <label for="tanggal_input">Tanggal Input:</label>
            <input type="date" name="tanggal_input" required>

            <label for="kondisi_pc">Kondisi PC:</label>
            <select name="kondisi_pc" required>
                <option value="baik">Baik</option>
                <option value="cukup Baik">Cukup Baik</option>
                <option value="kurang Baik">Kurang Baik</option>
            </select>

            <label for="jenis_pc">Jenis PC:</label>
            <input type="text" name="jenis_pc" required>

            <label for="lokasi_pc">Lokasi PC:</label>
            <input type="text" name="lokasi_pc" required>

            <div class="button-group">
                <input type="submit" value="Simpan Data">
                <a href="index.html" class="btn-back">Kembali ke Home</a>
            </div>
        </form>
    </div>
</body>
</html>
