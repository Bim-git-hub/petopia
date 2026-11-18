<?php
// Route: riwayat pesanan klien (role=klien) → KlienController@pesanan → app/Views/klien/pesanan.php
require_once dirname(__DIR__, 2) . '/app/bootstrap.php';
(new KlienController($koneksi))->pesanan();
