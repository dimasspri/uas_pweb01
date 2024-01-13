<?php
// Menghubungkan ke database
$host = "localhost";
$user = "root";
$password = "";
$database = "penjualan";
$koneksi = mysqli_connect($host, $user, $password, $database);

// Periksa koneksi
if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// Periksa apakah parameter URL telah diterima
if (isset($_GET['nama']) && isset($_GET['id_produk']) && isset($_GET['jumlah_barang'])) {
    $nama = $_GET['nama'];
    $id_produk = $_GET['id_produk'];
    $jumlah_barang = $_GET['jumlah_barang'];

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
    // Jika parameter URL tidak lengkap, alihkan ke halaman lain atau tampilkan pesan kesalahan
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
    <title>Terimakasih</title>
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
            <h2>Terima kasih, <?php echo $nama; ?>!</h2>
            <p>Anda telah berhasil melakukan checkout dengan detail sebagai berikut:</p>

            <img src="img/<?php echo $produk['gambar']; ?>" alt="Gambar Ikan">
            <p>Nama Barang: <?php echo $produk['nama_barang']; ?></p>
            <p>Jumlah Barang: <?php echo $jumlah_barang; ?></p>
            <p>Terimakasih atas pembelian Anda. Semoga Anda puas dengan produk kami.</p>
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