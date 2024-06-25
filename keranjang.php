<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f0f0f0;
        }

        .product {
            text-align: center;
            margin-top: 50px;
        }

        .wishlist-btn {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #007BFF;
            color: white;
            border: none;
            cursor: pointer;
        }

        .wishlist-btn:hover {
            background-color: #0056b3;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0,0,0);
            background-color: rgba(0,0,0,0.4);
            padding-top: 60px;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 400px;
            text-align: center;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .login-link {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #007BFF;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .login-link:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="product">
        <h2>Nama Produk</h2>
        <button id="wishlist-button" class="wishlist-btn">Tambahkan ke Keranjang</button>
    </div>

    <div id="login-modal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Login Diperlukan</h2>
            <p>Anda harus login untuk menambahkan produk ke Keranjang.</p>
            <a href="login.php" class="login-link">Login Sekarang</a>
        </div>
    </div>

    <script>
        document.getElementById('wishlist-button').addEventListener('click', function() {
            // Assuming this is the user login status check
            var isLoggedIn = false; // Change this to the actual login status of the user

            if (!isLoggedIn) {
                // Show the login modal
                document.getElementById('login-modal').style.display = 'block';
            } else {
                // Add to wishlist logic
                alert('Produk telah ditambahkan ke wishlist!');
            }
        });

        // Get the modal
        var modal = document.getElementById('login-modal');

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName('close')[0];

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = 'none';
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = 'none';
            }
        }
    </script>
</body>
</html>
