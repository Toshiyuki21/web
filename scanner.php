<?php
include 'koneksi.php';

// Proses penyimpanan data setelah scan
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_pc = $_POST['nama_pc'];
    $kondisi_pc = $_POST['kondisi_pc'];
    $lokasi_pc = $_POST['lokasi_pc'];
    $jenis_pc = $_POST['jenis_pc'];
    $tanggal_input = date("Y-m-d"); // Tanggal saat ini

    $sql = "INSERT INTO tel (Nama_pc, Tanggal_input, Kondisi_pc, Lokasi_pc, Jenis_pc) 
            VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $nama_pc, $tanggal_input, $kondisi_pc, $lokasi_pc, $jenis_pc);

    if ($stmt->execute()) {
        echo "<script>alert('Data berhasil disimpan!');</script>";
    } else {
        echo "<script>alert('Error: " . $stmt->error . "');</script>";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scanner QR Code</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://unpkg.com/html5-qrcode"></script>
    <style>
        .button-container {
            margin-top: 20px;
        }
        .btn-back {
            display: inline-block;
            padding: 10px 15px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s;
        }
        .btn-back:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="section">
        <h1>Scanner QR Code</h1>
        <div id="reader"></div>
        <form id="scanForm" method="post" style="display:none;">
            <input type="hidden" id="nama_pc" name="nama_pc">
            
            <label for="kondisi_pc">Kondisi PC:</label>
            <select name="kondisi_pc" required>
                <option value="baik">Baik</option>
                <option value="cukup baik">Cukup Baik</option>
                <option value="kurang baik">Kurang Baik</option>
            </select>
            
            <label for="lokasi_pc">Lokasi PC:</label>
            <input type="text" name="lokasi_pc" required>
            
            <label for="jenis_pc">Jenis PC:</label>
            <input type="text" name="jenis_pc" required>
            
            <input type="submit" value="Simpan Data">
        </form>
        <div class="button-container">
            <a href="index.html" class="btn-back">Kembali ke Menu Utama</a>
        </div>
    </div>

    <script>
        function onScanSuccess(decodedText, decodedResult) {
            document.getElementById('nama_pc').value = decodedText;
            document.getElementById('scanForm').style.display = 'block';
            html5QrcodeScanner.clear();
        }

        function onScanFailure(error) {
            console.warn(`QR code scanning failed: ${error}`);
        }

        let html5QrcodeScanner = new Html5QrcodeScanner(
            "reader",
            { fps: 10, qrbox: {width: 250, height: 250} },
            false
        );
        html5QrcodeScanner.render(onScanSuccess, onScanFailure);
    </script>
</body>
</html>