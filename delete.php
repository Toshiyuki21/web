<?php
// Menghubungkan ke koneksi.php
include 'koneksi.php';

$message = ''; // Inisialisasi pesan

if (isset($_GET['id'])) {
    $id = $_GET['id'];  
    
    // Query untuk menghapus data
    $sql = "DELETE FROM tel WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {     
        $message = "Data berhasil dihapus!";
    } else {
        $message = "Error: " . $conn->error;
    }
} else {
    $message = "ID tidak ditemukan!";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hapus Data</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f4f9;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        h1 {
            color: #ff6b6b; /* Warna utama baru */
        }
        .message {
            background-color: #f0f0f0;
            color: #333;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .btn {
            display: inline-block;
            padding: 10px 15px;
            background-color: #ff6b6b; /* Warna tombol */
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .btn:hover {
            background-color: #ff4a4a;
        }
        .container {
            max-width: 800px;
            margin: auto;
            background: white; /* Background konten */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Hapus Data</h1>

    <?php if ($message): ?>
        <div class="message">
        <?php echo $message; ?>
        </div>
    <?php endif; ?>

    <p><a href="search_data.php" class="btn">Kembali ke Pencarian</a></p>
</div>

</body>
</html>
