

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Baju</title>
    <style>
        body {
            background-color: #F2E8DF;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        header {
            background-color: #F27B35;
            color: #fff;
            padding: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo img {
            height: 40px;
        }






        .sidebar {
    background-color: #f9f9f9;
    border: 2px solid #ccc;
    border-radius: 5px;
    padding: 10px;
    width: 270px; /* Atur lebar sesuai kebutuhan */
    position: absolute; /* Memastikan posisi absolut */
    top: 60px; /* Jarak dari bagian atas halaman */
    right: 1px; /* Jarak dari bagian kanan halaman */
}

.sidebar .head {
    background-color: #F27B35;
    color: #fff;
    padding: 20px;
    text-align: center;
    border-radius: 5px 5px 0 0;
}

.sidebar .foot {
    background-color: #333;
    color: #fff;
    padding: 10px;
    text-align: center;
    border-radius: 0 0 5px 5px;
}







        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        nav ul li {
            display: inline;
            margin-left: 0px;
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
            padding : 0px;
        }

        .gambar {
            margin-top: 110px; /* Jarak dari bagian atas elemen sebelumnya */
            display: grid;
            grid-template-columns: repeat(4, 1fr); /* Menampilkan 4 gambar produk per baris */
            grid-gap: auto; /* Jarak antara gambar */
            justify-items: center; /* Posisi horizontalnya ditengah */
        }

        .gambar img {
            max-width: 70%; /* Menggunakan max-width agar gambar tidak melebihi lebar kontainer */
            height: auto; /* Memastikan tinggi gambar menyesuaikan dengan proporsionalnya */
        }
 

        .gambar figure {
            background-color: #f9f9f9;
            padding: 5px;
            border-radius: 5px;
            border: 2px solid #ccc;
            position: relative;
            text-align: center;
            overflow: hidden;
            width: 200px; /* Atur lebar figure sesuai preferensi Anda */
            height: 300px; /* Atur tinggi figure sesuai preferensi Anda */
        }

        .gambar figcaption {
            position: absolute; /* Memastikan posisi absolut */
            bottom: 0; /* Meletakkan di bagian bawah */
            left: 0; /* Meletakkan di kiri */
            width: 100%; /* Lebar penuh */
            background-color: rgba(0, 0, 0, 0.5); /* Transparansi latar belakang */
            color: #fff; /* Warna teks putih */
            padding: 35px; /* Padding untuk figcaption */
            margin: 0; /* Menghapus margin */
            box-sizing: border-box; /* Memastikan padding dan border tidak menambah lebar */
            transition: transform 0.3s ease; /* Transisi perubahan */
            transform: translateY(100%); /* Translasi awal ke bawah */
        }

        .gambar figure:hover figcaption {
            transform: translateY(0); /* Translasi ke atas pada hover */
        }

        .button {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: block; /* Mengubah menjadi block agar bisa diatur posisinya */
            font-size: 16px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            position: absolute; /* Memastikan posisi absolut */
            bottom: 10px; /* Jarak dari bawah */
            left: 50%; /* Posisi di tengah */
            transform: translateX(-50%); /* Memindahkan posisi horizontal ke tengah */
        }

        .button:hover {
            background-color: #45a049;
        }

        footer {
            background-color: #F27B35;
            color: #FFF;
            padding: 10px;
            text-align: center;
        }

        .min-footer1 {
            text-decoration: none;
            background-color: #FFFFFF;
            color: #000000;
            padding: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
    </style>
</head>









<script>
    document.addEventListener('DOMContentLoaded', function() ){}
        // Mendaftar semua tombol "Add to Cart" untuk menanggapi klik
        const addToCartButtons = document.querySelectorAll('button[name="add_to_cart"]');
        
        // Mengambil elemen keranjang dan total harga
        const cartItemElement = document.getElementById('cartItem');
        const totalElement = document.getElementById('total');
        
        // Array untuk menyimpan produk yang dipilih
        let cart = [];
        
        // Fungsi untuk menampilkan keranjang belanja
        function displayCart() {
            let total = 0;
            if (cart.length === 0) {
                cartItemElement.innerHTML = "Your cart is empty";
                totalElement.innerHTML = "$ 0.00";
            } else {
                cartItemElement.innerHTML = cart.map(item => {
                    total += item.price;
                    return 
                        <div class='cart-item'>
                            <div class='row-img'>
                                <img class='rowimg' src='${item.image}' alt='Product Image'>
                            </div>
                            <p style='font-size:12px;'>${item.title}</p>
                            <h2 style='font-size: 15px;'>$ ${item.price}.00</h2>
                            <i class='fa-solid fa-trash' onclick='removeFromCart(${item.id})'></i>
                        </div>
                    ;
                }).join('');
                totalElement.innerHTML = `$ ${total.toFixed(2)}`;
            }
        }
    
    
</script>








<body>
    <header>
        <div class="logo">
            <img src="assets\Gambar\pict.jpg" alt="Logo Toko Baju">
        </div>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="keranjang_user.php">Keranjang</a></li>
                <li><a href="inde.php">Wishlist</a></li>
                <li><a href="logout.php">Logout</a></li>
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

        // Buat query untuk mengambil data barang dari database
        $query = "SELECT * FROM tb_barang"; // Ganti 'tb_barang' dengan nama tabel Anda

        // Eksekusi query
        $result = $koneksi->query($query);

        // Periksa apakah query berhasil dieksekusi
        if ($result->num_rows > 0) {
            // Loop through the data and display images
            while($row = $result->fetch_assoc()) {
                echo "<figure>";
                echo "<img src='" . $row['gambar_produk'] . "' alt='Gambar Produk'>";
            
                echo "<p> " . htmlspecialchars($row['nama_barang']) . "</p>"; // Menampilkan nama barang
                echo "<p> " . htmlspecialchars($row['harga_barang']) . "</p>"; // Menampilkan harga barang
        
                echo "<form action='keranjang_user.php' method='post'>";
                echo "<input type='hidden' name='id_barang' value='" . $row['id_barang'] . "'>"; // Hidden input untuk menyimpan ID barang
                echo "<input type='submit' name='add_to_cart' value='Add to Cart' class='button'>"; // Tombol "Add to Cart"
                echo "</form>";
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





    <div class="min-footer1" style="padding-top: 20px; padding-bottom: 50px;">
        <div class="container">
            <nav>
                <small>
                    <ul>
            <h2>Toko</h2>                       
            <img src="assets\Gambar\location.png"> Jawa Barat,Bogor,Gunung Putri                     
            </ul>
           
            <img src="assets\Gambar\whatsapp.png"> 081286895xxx
            </ul>
            </nav>
            <img src="assets\Gambar\gmaill.png"> @xxgmail.com
            </small>
        </div>
    </div>





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
                </div>
            </div>
        </small>
    </footer>
</body>
</html>
