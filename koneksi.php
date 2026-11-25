<?php
// Mematikan exception bawaan MySQLi agar kesalahan koneksi dapat diperiksa dengan if
mysqli_report(MYSQLI_REPORT_OFF);

$host = "localhost";
$username = "root";
$password = "";
$database = "db_perpustakaan";

// Membuat koneksi menggunakan mysqli_connect()
$koneksi = mysqli_connect($host, $username, $password, $database);

// Memeriksa kesalahan koneksi dengan mysqli_connect_error()
if (!$koneksi) {
    die("Koneksi gagal: " . htmlspecialchars(mysqli_connect_error()));
}

// Mengatur karakter agar huruf dan simbol tersimpan dengan benar
mysqli_set_charset($koneksi, "utf8mb4");