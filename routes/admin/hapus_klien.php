<?php
// Route: hapus klien → AdminController@hapusKlien
require_once dirname(__DIR__, 2) . '/app/bootstrap.php';
(new AdminController($koneksi))->hapusKlien();
