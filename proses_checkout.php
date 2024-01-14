<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "penjualan";
$koneksi = mysqli_connect($host, $user, $password, $database);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_produk = $_POST['id'];
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);
    $jumlah_barang = $_POST['jumlah_barang'];

    // Insert data checkout ke dalam tabel checkout
    $query_insert = "INSERT INTO checkout (id, nama, alamat, jumlah_barang) VALUES ('$id_produk', '$nama', '$alamat', '$jumlah_barang')";
    $result_insert = mysqli_query($koneksi, $query_insert);

    if ($result_insert) {
        // Redirect ke halaman terimakasih jika insert berhasil
        header("Location: end.php?nama=$nama&id_produk=$id_produk&jumlah_barang=$jumlah_barang");
        exit();
    } else {
        die("Query error: " . mysqli_error($koneksi));
    }
} else {
    header("Location: index.php");
    exit();
}
mysqli_close($koneksi);
