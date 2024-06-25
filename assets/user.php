<?php
session_start();

// Periksa apakah pengguna sudah login
if(!isset($_SESSION['username'])){
    header("Location: index.php");
    exit();
}

// Ambil nama pengguna dari sesi
$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Selamat Datang, <?php echo $username; ?></title>
</head>
<body>

<h2>Selamat Datang, <?php echo $username; ?>!</h2>

<p><a href="logout.php">Logout</a></p>

</body>
</html>
