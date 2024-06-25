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
            padding: 1px; 
            display: flex;
            justify-content: space-between;
            align-items: center;
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
            text-align: left;
            padding: 50px 20px;
        }

        .deskripsi {
            margin-bottom: 20px;
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
        <main>
            <div class="deskripsi">
                <?php
                    session_start();
                    if(isset($_SESSION['username'])){
                        echo "<h1>Selamat Datang, ".$_SESSION['username']."</h1>";
                    } else {
                        echo "<h1>Selamat Datang</h1>";
                    }
                ?>
            </div>
        </main>

        <nav>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="produk.php">Data Barang</a></li>
                <li><a href="data_user.php">Data User</a></li>
                <li><a href="#">Pesanan</a></li>
                <li><a href="admin/pengaturan.php">Pengaturan</a></li>
                <li><a href="logout.php">Logout</a></li>
                </ul>

<body>
</body>



          
        </nav>
    </header>     
    <footer>
       
    </footer>
</body>
</html>
