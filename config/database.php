<?php
// config/database.php — satu-satunya tempat kredensial DB (pindahan koneksi.php)
$host     = "localhost";
$user     = "root";
$password = "";          // Kosongkan jika memakai bawaan Laragon
$database = "db_petopia";

// PHP 8.1+ membuat mysqli melempar exception saat koneksi/query gagal.
// Dimatikan agar kode yang mengecek nilai balik (mis. delete gagal-halus
// karena FK) tetap berjalan, dan kegagalan koneksi memakai pesan di bawah.
mysqli_report(MYSQLI_REPORT_OFF);

$koneksi = mysqli_connect($host, $user, $password, $database);

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error() . " — pastikan MySQL sudah jalan (Laragon → Start All).");
}
