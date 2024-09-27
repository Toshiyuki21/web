<?php
// Menghubungkan ke koneksi.php
include 'koneksi.php'; // Pastikan jalur ini benar

// Ambil data dari database berdasarkan pencarian
$searchTerm = $_POST['search_term'] ?? ''; // Ambil data dari form pencarian, jika ada

// Query berdasarkan pencarian
$sql = "SELECT * FROM tel WHERE nama_pc LIKE '%$searchTerm%'"; 
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pencarian Data PC</title>
    <link rel="stylesheet" href="style.css"> <!-- Link ke CSS -->
</head>
<body>
    <div class="container"> <!-- Tambahkan div container untuk layout -->
        <h1>Pencarian Data PC</h1>
        <form method="post" action="">
            <label for="search_term">Cari Nama PC:</label>
            <input type="text" name="search_term" required>
            <input type="submit" value="Cari">
        </form>

        <?php if ($result !== null): ?>
            <h2>Hasil Pencarian:</h2>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Nama PC</th>
                    <th>Tanggal Input</th>
                    <th>Kondisi PC</th>
                    <th>Jenis PC</th>
                    <th>Lokasi PC</th>
                    <th>Aksi</th>
                </tr>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['id']); ?></td>
                            <td><?php echo htmlspecialchars($row['nama_pc']); ?></td>
                            <td><?php echo htmlspecialchars($row['tanggal_input']); ?></td>
                            <td class="<?php echo htmlspecialchars($row['kondisi_pc']); ?>">
                                <?php echo htmlspecialchars($row['kondisi_pc']); ?>
                            </td>
                            <td><?php echo htmlspecialchars($row['jenis_pc']); ?></td>
                            <td><?php echo htmlspecialchars($row['lokasi_pc']); ?></td>
                            <td>
                                <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn">Edit</a>
                                <a href="delete.php?id=<?php echo $row['id']; ?>" class="btn" onclick="return confirm('Apakah Anda yakin ingin menghapus?');">Hapus</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7">Data tidak ditemukan.</td>
                    </tr>
                <?php endif; ?>
            </table>
        <?php endif; ?>
        <p>
            <a href="index.html" class="btn">Kembali ke Home</a>
        </p>
    </div>

    <?php $conn->close(); ?>
</body>
</html>
