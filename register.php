<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
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
            margin-bottom: 20px;
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

        input[type="checkbox"] {
            margin-top: 10px;
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

        /* Menghapus tanda bulat dari ul */
        ul {
            list-style-type: none;
            padding: 0;
        }

        /* Menata elemen secara horizontal */
        .horizontal {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
    </style>
</head>
<body>

<div class="container">
    <ul class="close-btn" style="cursor: default;" onclick="window.location.href='login.php';">X</ul> <!-- Tombol X untuk kembali ke menu index.php -->
    <h2>Register</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <input type="text" name="username" placeholder="Nama" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="text" name="alamat" placeholder="Alamat" required>
        <input type="text" name="no_hp" placeholder="No HP" required>
        <label for="jenis_kelamin">Jenis Kelamin:</label>
        <select name="jenis_kelamin" id="jenis_kelamin">
        <option value="male">Male</option>
        <option value="female">Female</option>
  </select>

        <input type="submit" value="Register">
    </form>
    <div class="horizontal">
        <p>Have an account?</p>
        <a href="login.php">Login</a>
    </div>
</div>

<?php
// Konfigurasi database
$host = 'localhost';
$dbname = 'dbpenjualan';
$username = 'root';
$password = '';

// Koneksi ke database
try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Koneksi gagal: " . $e->getMessage();
}

// Proses registrasi
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $alamat = $_POST['alamat'];
    $no_hp = $_POST['no_hp'];
    $jenis_kelamin = $_POST['jenis_kelamin'];

    // Lakukan pengecekan apakah username sudah ada dalam database
    $stmt_check = $conn->prepare("SELECT * FROM tb_user WHERE username=:username");
    $stmt_check->bindParam(':username', $username);
    $stmt_check->execute();

    if ($stmt_check->rowCount() > 0) {
        echo "Username sudah terdaftar.";
    } else {
        // Jika username belum terdaftar, lakukan pendaftaran
        $stmt_register = $conn->prepare("INSERT INTO tb_user (username, password, almt_user, hp_user, jenis_kelamin) VALUES (:username, :password, :alamat, :no_hp, :jenis_kelamin)");
        $stmt_register->bindParam(':username', $username);
        $stmt_register->bindParam(':password', $password);
        $stmt_register->bindParam(':alamat', $alamat);
        $stmt_register->bindParam(':no_hp', $no_hp);
        $stmt_register->bindParam(':jenis_kelamin', $jenis_kelamin);

        if ($stmt_register->execute()) {
            echo "Registrasi berhasil.";
        } else {
            echo "Registrasi gagal.";
        }
    }
}
?>
</body>
</html>
