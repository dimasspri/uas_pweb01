<?php

$host = "localhost";
$user = "root";
$password = "";
$database = "penjualan";
$koneksi = mysqli_connect($host, $user, $password, $database);
// Menghubungkan ke database (seperti yang Anda lakukan sebelumnya)

// Periksa apakah parameter id telah diterima
if (isset($_GET['id'])) {
    $id_produk = $_GET['id'];

    // Query untuk mendapatkan informasi produk berdasarkan ID
    $query_produk = "SELECT * FROM produk WHERE id = $id_produk";
    $result_produk = mysqli_query($koneksi, $query_produk);

    // Periksa kesalahan query
    if (!$result_produk) {
        die("Query error: " . mysqli_error($koneksi));
    }

    // Ambil data produk terpilih
    $produk = mysqli_fetch_assoc($result_produk);
} else {
    // Jika parameter id tidak diterima, alihkan ke halaman lain atau tampilkan pesan kesalahan
    header("Location: index.php"); // Ganti dengan halaman yang sesuai
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="checkout-style.css">
    <title>Checkout</title>
</head>

<body>

    <header>
        <nav class="navbar">
            <div class="container">
                <ul class="nav-links">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="#">Produk</a></li>
                    <li><a href="#">Register</a></li>
                    <li><a href="#">Kontak</a></li>
                    <li><a href="#">Login</a></li>
                </ul>
            </div>
        </nav>
    </header>

    <div class="container">
        <div class="card">
            <img src="img/<?php echo $produk['gambar']; ?>" alt="Gambar Ikan">
            <h1><?php echo $produk['nama_barang']; ?></h1>
            <h2><?php echo $produk['harga']; ?></h2>
            <p><?php echo $produk['deskripsi']; ?></p>
            <br><br>
            <!-- Formulir untuk informasi konsumen -->
            <form action="proses_checkout.php" method="post">
                <label for="nama">Nama:</label>
                <input type="text" id="nama" name="nama" required>

                <label for="alamat">Alamat:</label>
                <textarea id="alamat" name="alamat" required></textarea>

                <label for="jumlah_barang">Jumlah Barang:</label>
                <input type="number" id="jumlah_barang" name="jumlah_barang" required>

                <input type="hidden" name="id" value="<?php echo $produk['id']; ?>">

                <button type="submit">Proses Checkout</button>
            </form>
        </div>
    </div>

</body>
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

</html>

<?php
// Menutup koneksi ke database setelah selesai mengambil data
mysqli_close($koneksi);
?>