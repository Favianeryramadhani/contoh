<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Baju</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo img {
            height: 40px;
        }

        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        nav ul li {
            display: inline;
            margin-left: 20px;
        }

        nav ul li:first-child {
            margin-left: 0;
        }

        nav ul li a {
            text-decoration: none;
            color: #fff;
            padding: 5px 10px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        nav ul li a:hover {
            background-color: #555;
        }

        main {
            text-align: center;
            padding: 50px 0;
        }

        .deskripsi {
            margin-bottom: 20px;
        }

        .gambar {
            display: grid;
            grid-template-columns: repeat(4, 1fr); /* Menampilkan 4 gambar produk per baris */
            grid-gap: 20px; /* Jarak antara gambar */
            justify-items: center; /* Posisi horizontalnya ditengah */
        }

        .gambar img {
            max-width: 100%;
            height: auto;
        }

        .gambar figure {
            background-color: #f9f9f9;
            padding: 10px;
            border-radius: 5px;
            border: 2px solid #ccc; /* Pertebal garis border */
        }

        .button {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .button:hover {
            background-color: #45a049;
        }

        footer {
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: center;
        }

        </style>
</head>
<body>
    <header>
        <div class="logo">
            <img src="assets\Gambar\pict.jpg" alt="Logo Toko Baju">
        </div>
        <nav>
            <ul>
            <li><a href="#">Home</a></li>
                <li><a href="index.php">Home</a></li>
                <a href="wl.php" class="flex items-center gap-2 rounded-lg bg-gray-100 px-4 py-2 text-gray-700">
                    <img src="assets/Gambar/search.png" alt="List Icon" class="h-5 w-5">
                    <span class="text-sm font-medium"></span>
                </a>
                <a href="keranjang.php" class="flex items-center gap-2 rounded-lg bg-gray-100 px-4 py-2 text-gray-700">
                    <img src="assets/Gambar/shoppingcart.png" alt="List Icon" class="h-5 w-5">
                    <span class="text-sm font-medium"></span>
                </a>
                <a href="login.php" class="flex items-center gap-2 rounded-lg bg-gray-100 px-4 py-2 text-gray-700">
                    <img src="assets/Gambar/user.png" alt="List Icon" class="h-5 w-5">
                    <span class="text-sm font-medium"></span>
                </a>
            </ul>
        </nav>
    </header>
    <main>

       <div class="deskripsi">
            <h1>Selamat Datang di Toko Baju</h1>
            <p>Temukan koleksi terbaru dari baju berkualitas di toko kami.</p>
        </div>
        <div class="gambar">
            <?php
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

            // Buat query untuk mengambil data gambar dari database
            $query = "SELECT gambar_produk FROM tb_barang"; // Ganti 'gambar_produk' dengan nama kolom yang berisi path gambar di tabel Anda

            // Eksekusi query
            $result = $koneksi->query($query);

            // Periksa apakah query berhasil dieksekusi
            if ($result->num_rows > 0) {
                // Loop through the data and display images
                while($row = $result->fetch_assoc()) {
                    echo "<figure>";
                    echo "<img src='" . $row['gambar_produk'] . "' alt='Gambar Produk'>";
                    echo "<a href='wl.php'><button class='button'>Detail</button></a>";
                    echo "</figure>";
                }
            } else {
                echo "Data tidak ditemukan";
            }

            // Tutup koneksi database
            mysqli_close($koneksi);
            ?>
        </div>
    </main>
    <footer>
        <small>
            <div class="copyrights-wrapper copyrights-two-columns">
                <div class="container">
                    <div class="min-footer">
                        <div class="col-left set-cont-mb-s reset-last-child">
                            <small><i class="fa fa-copyright"></i> Copyright © 2024 Toko Pakaian. All Rights Reserved.
                            </small>
                          
                    </div>
                </div>
            </div>
        </small>
    </footer>
</body>
</html>