<?php
// Route: halaman pengaturan admin (role=admin) → AdminController@pengaturan → app/Views/admin/pengaturan.php
require_once dirname(__DIR__, 2) . '/app/bootstrap.php';
(new AdminController($koneksi))->pengaturan();
