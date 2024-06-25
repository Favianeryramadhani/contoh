<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
body {
  font-family: Arial, Helvetica, sans-serif;
  margin: 0;
}

/* Style untuk form */
.container {
  padding: 16px;
}

input[type=text], input[type=password] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

/* Style untuk tombol login */
button {
  background-color: #04AA6D;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}

button:hover {
  opacity: 0.8;
}

/* Style untuk cancel button */
.cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f44336;
}

.imgcontainer {
  text-align: center;
  margin: 24px 0 12px 0;
  position: relative;
}

img.avatar {
  width: 40%;
  border-radius: 50%;
}

.container {
  padding: 16px;
}

span.pass {
  float: right;
  padding-top: 16px;
}
</style>
</head>
<body>

<h2>Login Form</h2>

<!-- Form login -->
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
  <div class="container">
    <label for="user"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="user" required>

    <label for="pass"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="pass" required>
        
    <button type="submit">Login</button>
    <label>
      <input type="checkbox" checked="checked" name="remember"> Remember me
    </label>
  </div>

  <div class="container" style="background-color:#f1f1f1">
    <button type="button" class="cancelbtn">Cancel</button>
    <span class="pass">Forgot <a href="#">password?</a></span>
  </div>
</form>

<?php
// Konfigurasi database
$servername = "localhost";
$username = "root";
$password = "";
$database = "dbpenjualan";

// Membuat koneksi ke database
$conn = new mysqli($servername, $username, $password, $database);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Jika form login dikirimkan
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['user'];
    $password = $_POST['pass'];

    // Melakukan query untuk mencari pengguna dengan kredensial yang sesuai
    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    // Memeriksa jika pengguna ditemukan
    if ($result->num_rows > 0) {
        // Pengguna ditemukan, lakukan proses login
        session_start();
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        header("location: welcome.php"); // Redirect ke halaman selamat datang atau halaman utama setelah login
    } else {
        // Jika pengguna tidak ditemukan, tampilkan pesan error
        echo "<script>alert('Username atau password salah. Silakan coba lagi.');</script>";
    }
}

// Tutup koneksi database
$conn->close();
?>

</body>
</html>
