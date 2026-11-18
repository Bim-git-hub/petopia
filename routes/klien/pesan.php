<?php
// Route: form pesan layanan (role=klien) → KlienController@pesan → app/Views/klien/pesan.php
require_once dirname(__DIR__, 2) . '/app/bootstrap.php';
(new KlienController($koneksi))->pesan();
