<?php
// Route: layanan klien (role=klien) → KlienController@layanan → app/Views/klien/layanan.php
require_once dirname(__DIR__, 2) . '/app/bootstrap.php';
(new KlienController($koneksi))->layanan();
