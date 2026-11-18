<?php
// Route: simpan pengaturan admin (role=admin, POST aksi=profil|password) → AdminController@simpanPengaturan
require_once dirname(__DIR__, 2) . '/app/bootstrap.php';
(new AdminController($koneksi))->simpanPengaturan();
