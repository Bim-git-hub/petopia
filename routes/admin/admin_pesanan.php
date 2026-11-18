<?php
// Route: daftar pesanan (role=admin) → AdminController@pesanan → app/Views/admin/pesanan.php
require_once dirname(__DIR__, 2) . '/app/bootstrap.php';
(new AdminController($koneksi))->pesanan();
