<?php
$conn = mysqli_connect("localhost", "root", "", "dbpenjualan");

// Fungsi untuk menambahkan data user
function tambahData($conn, $id_user, $username, $password, $almt_user, $hp_user, $jenis_kelamin) {
    $id_user = mysqli_real_escape_string($conn, $id_user);
    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);
    $almt_user = mysqli_real_escape_string($conn, $almt_user);
    $hp_user = mysqli_real_escape_string($conn, $hp_user);
    $jenis_kelamin = mysqli_real_escape_string($conn, $jenis_kelamin);

    $query = "INSERT INTO tb_user (id_user, username, password, almt_user, hp_user, jenis_kelamin) VALUES ('$id_user', '$username', '$password', '$almt_user', '$hp_user', '$jenis_kelamin')";

    if (mysqli_query($conn, $query)) {
        echo "Data berhasil ditambahkan.";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}

// Fungsi untuk menampilkan data user
function tampilData($conn) {
    $query = "SELECT * FROM tb_user";
    $result = mysqli_query($conn, $query);
    return $result;
}

// Fungsi untuk mengedit data user
function editData($conn, $id_user, $username, $password, $almt_user, $hp_user, $jenis_kelamin) {
    $id_user = $_POST['id_user']; // Ambil nilai id_user dari form

    $query = "UPDATE tb_user SET username=?, password=?, almt_user=?, hp_user=?, jenis_kelamin=? WHERE id_user=?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "sssssi", $username, $password, $almt_user, $hp_user, $jenis_kelamin, $id_user);
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_affected_rows($stmt) > 0) {
        echo "Data berhasil diupdate.";
    } else {
        echo "Gagal mengupdate data.";
    }
}

// Fungsi untuk menghapus data user
function hapusData($conn, $id_user) {
    $query = "DELETE FROM tb_user WHERE id_user='$id_user'";
    if (mysqli_query($conn, $query)) {
        echo "Data berhasil dihapus.";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}

// Menangani form submission tambah dan edit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['tambah'])) {
        $id_user = $_POST['id_user'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $almt_user = $_POST['almt_user'];
        $hp_user = $_POST['hp_user'];
        $jenis_kelamin = $_POST['jenis_kelamin'];

        tambahData($conn, $id_user, $username, $password, $almt_user, $hp_user, $jenis_kelamin);
    } elseif (isset($_POST['edit'])) {
        $id_user = $_POST['id_user'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $almt_user = $_POST['almt_user'];
        $hp_user = $_POST['hp_user'];
        $jenis_kelamin = $_POST['jenis_kelamin'];

        editData($conn, $id_user, $username, $password, $almt_user, $hp_user, $jenis_kelamin);
    }
}

// Menampilkan data user
$dataResult = tampilData($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <p class="close-btn" style="cursor: default;" onclick="window.location.href='admin.php';">X</p>
    <title>Data User</title>
    <style>
        /* Gaya CSS disini */
        body {
            background-color: #E0FFFF;
        }

    </style>
</head>
<body>
    <h2>Data User</h2>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <input type="text" name="id_user" placeholder="ID User" required>
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="text" name="almt_user" placeholder="Alamat User" required>
        <input type="text" name="hp_user" placeholder="Nomor HP User" required>
        <select name="jenis_kelamin">
            <option value="Laki-laki">Laki-laki</option>
            <option value="Perempuan">Perempuan</option>
        </select>
        <input type="submit" name="tambah" value="Tambah">
        <input type="submit" name="edit" value="Edit">
    </form>

    <table border="1">
        <tr>
            <th>ID User</th>
            <th>Username</th>
            <th>Password</th>
            <th>Alamat User</th>
            <th>Nomor HP User</th>
            <th>Jenis Kelamin</th>
            <th>Action</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($dataResult)) { ?>
            <tr>
                <td><?php echo $row['id_user']; ?></td>
                <td><?php echo $row['username']; ?></td>
                <td><?php echo $row['password']; ?></td>
                <td><?php echo $row['almt_user']; ?></td>
                <td><?php echo $row['hp_user']; ?></td>
                <td><?php echo $row['jenis_kelamin']; ?></td>
                <td>
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                        <input type="hidden" name="id_user" value="<?php echo $row['id_user']; ?>">
                        <input type="submit" name="edit" value="Edit">
                    </form>
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                        <input type="hidden" name="id_user" value="<?php echo $row['id_user']; ?>">
                        <input type="submit" name="hapus" value="Hapus">
                    </form>
                </td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>

<?php
// Menangani penghapusan data
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['hapus'])) {
    hapusData($conn, $_POST['id_user']);
}
?>
