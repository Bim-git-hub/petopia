<?php
// Route: hapus layanan → AdminController@hapusLayanan
require_once dirname(__DIR__, 2) . '/app/bootstrap.php';
(new AdminController($koneksi))->hapusLayanan();
