<?php
$conn = mysqli_connect("localhost", "root", "", "dbpenjualan");

// Fungsi untuk menambahkan data
function tambahData($conn, $id_barang, $nama_barang, $stock, $harga_barang, $gambar_produk) {
    // Escape strings untuk menghindari SQL Injection
    $id_barang = mysqli_real_escape_string($conn, $id_barang);
    $nama_barang = mysqli_real_escape_string($conn, $nama_barang);
    $stock = mysqli_real_escape_string($conn, $stock);
    $harga_barang = mysqli_real_escape_string($conn, $harga_barang);
    $gambar_produk = mysqli_real_escape_string($conn, $gambar_produk);

    $query = "INSERT INTO tb_barang (id_barang, nama_barang, stock, harga_barang, gambar_produk) VALUES ('$id_barang', '$nama_barang', '$stock', '$harga_barang', '$gambar_produk')";

    if (mysqli_query($conn, $query)) {
        echo "Data berhasil ditambahkan.";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}

// Fungsi untuk menampilkan data
function tampilData($conn) {
    $query = "SELECT * FROM tb_barang";
    $result = mysqli_query($conn, $query);
    return $result;
}

// Fungsi untuk mengedit data
function editData($conn, $id_barang, $nama_barang, $stock, $harga_barang, $gambar_produk) {
    $id = $_POST['id_barang']; // Ambil nilai id_barang dari form
    
    if (!empty($_FILES['gambar_produk']['name'])) {
        $fileName = $_FILES['gambar_produk']['name'];
        $fileTmpName = $_FILES['gambar_produk']['tmp_name'];
        $fileDestination = 'uploads/' . $fileName;
        move_uploaded_file($fileTmpName, $fileDestination);

        $query = "UPDATE tb_barang SET nama_barang=?, stock=?, harga_barang=?, gambar_produk=? WHERE id_barang=?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "ssssi", $nama_barang, $stock, $harga_barang, $fileDestination, $id);
        mysqli_stmt_execute($stmt);

        if (mysqli_stmt_affected_rows($stmt) > 0) {
            echo "Data berhasil diupdate.";
        } else {
            echo "Gagal mengupdate data.";
        }
    } else {
        $query = "UPDATE tb_barang SET nama_barang=?, stock=?, harga_barang=? WHERE id_barang=?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "sssi", $nama_barang, $stock, $harga_barang, $id);
        mysqli_stmt_execute($stmt);

        if (mysqli_stmt_affected_rows($stmt) > 0) {
            echo "Data berhasil diupdate.";
        } else {
            echo "Gagal mengupdate data.";
        }
    }
}

// Fungsi untuk menghapus data
function hapusData($conn, $id) {
    $query = "DELETE FROM tb_barang WHERE id_barang='$id'";
    if (mysqli_query($conn, $query)) {
        echo "Data berhasil dihapus.";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}

// Menangani form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['tambah'])) {
        $id_barang = $_POST['id_barang'];
        $nama_barang = $_POST['nama_barang'];
        $stock = $_POST['stock'];
        $harga_barang = $_POST['harga_barang'];
        $gambar_produk = '';

        // Jika admin memilih gambar dari galeri
        if (!empty($_POST['gambar_produk'])) {
            $gambar_produk = $_POST['gambar_produk'];
        } elseif (!empty($_FILES['gambar_produk']['name'])) {
            // Jika admin mengunggah gambar baru
            $fileName = $_FILES['gambar_produk']['name'];
            $fileTmpName = $_FILES['gambar_produk']['tmp_name'];
            $fileDestination = 'uploads/' . $fileName;
            move_uploaded_file($fileTmpName, $fileDestination);
            $gambar_produk = $fileDestination;
        }

        // Simpan data ke database
        tambahData($conn, $id_barang, $nama_barang, $stock, $harga_barang, $gambar_produk);
    } elseif (isset($_POST['edit'])) {
        $id_barang = $_POST['id_barang'];
        $nama_barang = $_POST['nama_barang'];
        $stock = $_POST['stock'];
        $harga_barang = $_POST['harga_barang'];
        $gambar_produk = '';

        // Jika admin memilih gambar dari galeri
        if (!empty($_POST['gambar_produk'])) {
            $gambar_produk = $_POST['gambar_produk'];
        } elseif (!empty($_FILES['gambar_produk']['name'])) {
            // Jika admin mengunggah gambar baru
            $fileName = $_FILES['gambar_produk']['name'];
            $fileTmpName = $_FILES['gambar_produk']['tmp_name'];
            $fileDestination = 'uploads/' . $fileName;
            move_uploaded_file($fileTmpName, $fileDestination);
            $gambar_produk = $fileDestination;
        }

        // Edit data di database
        editData($conn, $id_barang, $nama_barang, $stock, $harga_barang, $gambar_produk);
    }
}

// Menampilkan data
$dataResult = tampilData($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk</title>
    <style>
        /* Gaya CSS disini */
        body {
            background-color: #E0FFFF;
        }
    </style>
</head>
<body>
    <p class="close-btn" style="cursor: default;" onclick="window.location.href='admin.php';">X</p>
    <h2>Tabel Barang</h2>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
        <!-- Kotak input untuk ID barang -->
        <input type="text" name="id_barang" placeholder="ID Barang" value="<?php echo isset($_POST['id_barang']) ? $_POST['id_barang'] : ''; ?>">
        <input type="text" name="nama_barang" placeholder="Nama Barang" value="<?php echo isset($_POST['nama_barang']) ? $_POST['nama_barang'] : ''; ?>">
        <input type="text" name="stock" placeholder="Stock" value="<?php echo isset($_POST['stock']) ? $_POST['stock'] : ''; ?>">
        <input type="text" name="harga_barang" placeholder="Harga Barang" value="<?php echo isset($_POST['harga_barang']) ? $_POST['harga_barang'] : ''; ?>">
        <select name="gambar_produk">
            <option value="">Pilih gambar dari galeri</option>
            <?php
            // Ambil daftar gambar dari galeri
            $galleryPath = 'uploads/';
            $files = glob($galleryPath . '*.{jpg,jpeg,png}', GLOB_BRACE);
            foreach ($files as $file) {
                $filename = basename($file);
                echo "<option value='$filename'>$filename</option>";
            }
            ?>
        </select>
        <input type="file" name="gambar_produk" id="gambar_produk" accept=".jpg, .jpeg, .png">
        <input type="submit" name="tambah" value="Tambah">
        <input type="submit" name="edit" value="Edit">
    </form>

    <table>
        <tr>
            <th>ID Barang</th>
            <th>Nama Barang</th>
            <th>Stock</th>
            <th>Harga Barang</th>
            <th>Gambar Produk</th>
            <th>Action</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($dataResult)) { ?>
            <tr>
                <td><?php echo $row['id_barang']; ?></td>
                <td><?php echo $row['nama_barang']; ?></td>
                <td><?php echo $row['stock']; ?></td>
                <td><?php echo number_format($row['harga_barang'], 0, ',', '.'); ?></td>
                <td><img src="<?php echo $row['gambar_produk']; ?>" width="100"></td> <!-- Menampilkan gambar -->
                <td>
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
                        <!-- Input hidden untuk id_barang saat edit -->
                        <input type="hidden" name="id_barang" value="<?php echo $row['id_barang']; ?>">
                        <input type="text" name="nama_barang" value="<?php echo $row['nama_barang']; ?>">
                        <input type="text" name="stock" value="<?php echo $row['stock']; ?>">
                        <input type="text" name="harga_barang" value="<?php echo $row['harga_barang']; ?>">
                        <input type="file" name="gambar_produk" id="gambar_produk" accept=".jpg, .jpeg, .png"> <!-- Input untuk gambar -->
                        <input type="submit" name="edit" value="Edit">
                    </form>
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                        <input type="hidden" name="id" value="<?php echo $row['id_barang']; ?>">
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
    hapusData($conn, $_POST['id']);
}
?>
