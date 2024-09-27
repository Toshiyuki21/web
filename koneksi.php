<?php
// koneksi.php
$host = 'localhost';
$user = 'root'; // Ganti dengan username database
$pass = ''; // Ganti dengan password database
$db_name = 'pt_tel'; // Nama database

// Membuat koneksi
$conn = new mysqli($host, $user, $pass, $db_name);

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
