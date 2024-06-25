<?php
session_start();

// Inisialisasi keranjang belanja jika belum ada
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Tambahkan produk ke keranjang jika tombol "Add to Cart" diklik
if (isset($_POST['add_to_cart'])) {
    $id_barang = $_POST['id_barang'];

    // Lakukan koneksi ke database
    $servername = "localhost"; // Nama server
    $username = "root"; // Username MySQL Anda
    $password = ""; // Password MySQL Anda
    $database = "dbpenjualan"; // Nama database yang ingin Anda hubungkan

    // Membuat koneksi
    $koneksi = new mysqli($servername, $username, $password, $database);

    // Periksa koneksi
    if ($koneksi->connect_error) {
        die("Koneksi gagal: " . $koneksi->connect_error);
    }

    // Query untuk mendapatkan detail barang berdasarkan ID
    $query = "SELECT * FROM tb_barang WHERE id_barang = $id_barang";
    $result = $koneksi->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Tambahkan produk ke dalam session cart
        $_SESSION['cart'][] = [
            'id_barang' => $row['id_barang'],
            'nama_barang' => $row['nama_barang'],
            'harga_barang' => $row['harga_barang'],
            'quantity' => 1, // Default quantity set to 1
            // tambahkan atribut lain jika diperlukan
        ];
    }

    // Tutup koneksi database
    mysqli_close($koneksi);

    // Redirect kembali ke halaman sebelumnya atau halaman keranjang belanja
    header("Location: user.php");
    exit();
}

// Hapus produk dari keranjang jika tombol "Delete" diklik
if (isset($_POST['delete_from_cart'])) {
    $index = $_POST['index']; // Index produk yang akan dihapus dari keranjang

    // Hapus item dari session cart berdasarkan index
    if (isset($_SESSION['cart'][$index])) {
        unset($_SESSION['cart'][$index]);
    }

    // Redirect kembali ke halaman keranjang belanja
    header("Location: keranjang_user.php");
    exit();
}

// Ubah kuantitas produk dalam keranjang
if (isset($_POST['change_qty'])) {
    $index = $_POST['index']; // Index produk yang akan diubah kuantitasnya
    $quantity = (int)$_POST['quantity']; // Kuantitas baru

    // Pastikan kuantitas tidak kurang dari 1
    if ($quantity < 1) {
        $quantity = 1;
    }

    // Ubah kuantitas produk dalam session cart
    if (isset($_SESSION['cart'][$index])) {
        $_SESSION['cart'][$index]['quantity'] = $quantity;
    }

    // Redirect kembali ke halaman keranjang belanja
    header("Location: keranjang_user.php");
    exit();
}
?>




<!-- HTML untuk menampilkan keranjang belanja -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja</title>
    <!-- Styling CSS -->
    <style>
        /* Your CSS styles */
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header h1 {
            margin: 0;
        }

        .back-btn {
            color: #fff;
            text-decoration: none;
            padding: 8px 16px;
            border-radius: 4px;
            background-color: #4CAF50;
            transition: background-color 0.3s ease;
        }

        .back-btn:hover {
            background-color: #45a049;
        }

        main {
            width: 80%;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .cart-items {
            margin-bottom: 20px;
        }

        .cart-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #ccc;
            padding: 10px 0;
        }

        .cart-item p {
            margin: 0;
        }

        .cart-item form {
            display: flex;
            align-items: center;
        }

        .quantity {
            display: flex;
            align-items: center;
        }

        .quantity button {
            background: none;
            border: none;
            color: #333;
            cursor: pointer;
            font-size: 1em;
            padding: 4px;
        }

        .quantity input {
            width: 40px;
            text-align: center;
            border: 1px solid #ccc;
            margin: 0 5px;
            padding: 4px;
            font-size: 1em;
        }

        .cart-item button {
            background: none;
            border: none;
            color: #f44336;
            cursor: pointer;
            margin-left: 10px;
        }

        .cart-item button:hover {
            text-decoration: underline;
        }

        .total {
            text-align: right;
            margin-top: 20px;
        }

        .total h3 {
            font-size: 1.2em;
        }

        footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 10px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>
    <header>
        <!-- Header Anda -->
        <a href="user.php" class="back-btn">Home</a>
        <h1>Keranjang Belanja</h1>
    </header>

    <main>
        <h1>Keranjang Belanja</h1>
        <div class="cart-items">
            <?php
            // Tampilkan item-item dari session cart
            $totalHarga = 0; // Inisialisasi total harga

            if (!empty($_SESSION['cart'])) {
                foreach ($_SESSION['cart'] as $index => $item) {
                    echo "<div class='cart-item'>";
                    echo "<p>" . htmlspecialchars($item['nama_barang']) . "</p>";
                    echo "<p>Rp " . htmlspecialchars($item['harga_barang']) . "</p>";
                    echo "<form action='keranjang_user.php' method='post'>";
                    echo "<input type='hidden' name='index' value='$index'>";
                    echo "<div class='quantity'>";
                    echo "<input type='number' name='quantity' value='" . $item['quantity'] . "' min='1'>";
                    echo "</div>";
                    echo "<button type='submit' name='delete_from_cart'><i class='fas fa-trash'></i> Delete</button>";
                    echo "</form>";
                    echo "</div>";

                    // Tambahkan harga barang ke totalHarga
                    $totalHarga += $item['harga_barang'] * $item['quantity'];
                }
            } else {
                echo "<p>Keranjang belanja Anda kosong.</p>";
            }
            ?>
        </div>

        <div class="total">
            <h3>Total Harga: Rp <?php echo number_format($totalHarga, 2); ?></h3>
        </div>

        <h3>Metode Pembayaran</h3>
    </main>

    <footer>
        <!-- Footer Anda -->
    </footer>
</body>
</html>
