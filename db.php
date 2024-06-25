<?php
$servername = "localhost"; // Nama server
$username = "root"; // Username MySQL Anda
$password = ""; // Password MySQL Anda
$database = "dbpenjualan"; // Nama database yang ingin Anda hubungkan

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $database);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
} else {
    echo "Koneksi berhasil!";
}


// Tutup koneksi
$conn->close();
?>
