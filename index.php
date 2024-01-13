<?php
// Menghubungkan ke database (gantilah dengan detail koneksi sesuai kebutuhan Anda)
$host = "localhost";
$user = "root";
$password = "";
$database = "penjualan";
$koneksi = mysqli_connect($host, $user, $password, $database);

// Periksa koneksi
if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// Lakukan query ke database
$query = "SELECT * FROM produk";
$result = mysqli_query($koneksi, $query);

// Periksa kesalahan query
if (!$result) {
    die("Query error: " . mysqli_error($koneksi));
}

// Menutup koneksi ke database - Pindahkan ini ke akhir setelah data diambil
// mysqli_close($koneksi);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Penjualan Ikan</title>
</head>

<body>

    <header>
        <nav class="navbar">
            <div class="container">
                <ul class="nav-links">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Produk</a></li>
                    <li><a href="#">Register</a></li>
                    <li><a href="#">Kontak</a></li>
                    <li><a href="#">Login</a></li>
                </ul>
            </div>
        </nav>
    </header>

    <!-- Bagian body dengan data dari database -->
    <div class="container">
        <?php
        // Loop melalui hasil query dan tampilkan data
        while ($row = mysqli_fetch_assoc($result)) {
        ?>
            <div class="card">
                <img src="img/<?php echo $row['gambar']; ?>" alt="Gambar Ikan">
                <h1><?php echo $row['nama_barang']; ?></h1>
                <h2>Rp. <?php echo $row['harga']; ?></h2>
                <p><?php echo $row['deskripsi']; ?></p>
                <button class="buy-button" onclick="window.location.href='checkout.php?id=<?php echo $row['id']; ?>'">Beli Sekarang</button>
            </div>
        <?php
        }
        ?>
    </div>

    <!-- Bagian lainnya tetap sama seperti sebelumnya -->

    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-about">
                    <h3>Tentang Kami</h3>
                    <p>Penjualan ikan online, bisa Cod bang >_< </p>
                </div>
                <div class="footer-contact">
                    <h3>Hubungi Kami</h3>
                    <p>Email: fiqri@gmail.com</p>
                    <p>Telepon: 0838-9323-6228</p>
                </div>
            </div>
        </div>
    </footer>

    <?php
    // Menutup koneksi ke database setelah selesai mengambil data
    mysqli_close($koneksi);
    ?>
</body>

</html>