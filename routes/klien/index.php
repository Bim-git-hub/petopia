<?php
// Route: beranda klien (role=klien) → KlienController@home → app/Views/klien/home.php
require_once dirname(__DIR__, 2) . '/app/bootstrap.php';
(new KlienController($koneksi))->home();
