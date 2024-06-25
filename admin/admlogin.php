<?php
// File: login.php

// Konfigurasi database
$host = 'localhost';
$dbname = 'dbpenjualan';
$username = 'root';
$password = '';

// Inisialisasi variabel pesan kesalahan
$error_message = '';

// Proses login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Koneksi ke database
        $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Ambil data dari formulir
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Query untuk mencari pengguna berdasarkan username dan password
        $stmt = $conn->prepare("SELECT * FROM tb_admin WHERE username=:username AND password=:password");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->execute();

        // Ambil hasil query
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Login berhasil
            session_start();
            $_SESSION['username'] = $user['username'];
            header("Location: PI\admin.php");
            exit();
        } else {
            // Login gagal
            $error_message = "Login gagal. Periksa kembali username dan password Anda.";
        }
    } catch(PDOException $e) {
        // Tangani kesalahan koneksi database
        $error_message = "Koneksi gagal: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login Admin</title>
<style>
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
}

.container {
    max-width: 400px;
    margin: 0 auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h2 {
    text-align: center;
    margin-bottom: 15px;
}

input[type="text"],
input[type="password"],
input[type="submit"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 3px;
    box-sizing: border-box;
}

input[type="submit"] {
    background-color: #4CAF50;
    color: white;
    border: none;
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color: #45a049;
}

.error-message {
    color: #ff0000;
    margin-top: 5px;
    text-align: center;
}

ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

ul li {
    display: inline-block;
    margin-right: 10px;
}

ul li:last-child {
    margin-right: 0;
}
</style>
</head>
<body>

<div class="container">
<ul>

<li class="close-btn" style="cursor: default;" onclick="window.location.href='index.php';">X</li> <!-- Tombol X untuk kembali ke menu index.php -->



    <h2>Login Admin</h2>
    <?php if ($error_message): ?>
    <p class="error-message"><?php echo $error_message; ?></p>
    <?php endif; ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="submit" value="Login">
    </form>
    

</div>

</body>
</html>