<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Loading Animation</title>
<style>
    /* CSS untuk loading animation */
    .loader {
        border: 4px solid #f3f3f3; /* Light grey */
        border-top: 4px solid #3498db; /* Blue */
        border-radius: 50%;
        width: 30px;
        height: 30px;
        animation: spin 1s linear infinite;
        margin: auto;
        margin-top: 20vh; /* Center loader on screen */
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    /* CSS untuk menampilkan konten setelah loading selesai */
    .content {
        display: none; /* Mulai dengan konten disembunyikan */
        text-align: center;
        margin-top: 20px;
    }
</style>
</head>
<body>
    <div class="loader"></div>
    <div class="content" id="myContent">
    <h2>Konten yang Dimuat</h2>
    <p>Ini adalah konten yang ditampilkan setelah loading selesai.</p>
    </div>

    <?php
    // Contoh logika PHP untuk menunggu beberapa detik sebelum menampilkan konten
    // Simulasi loading
    sleep(3); // Tunda selama 3 detik

    // Setelah tunda, tampilkan konten dengan mengubah style "display" menjadi "block"
    echo '<script>document.getElementById("myContent").style.display = "block";</script>';
    ?>
</body>
</html>
