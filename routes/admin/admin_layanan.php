<?php
// Route: kelola layanan (role=admin) → AdminController@layanan → app/Views/admin/layanan.php
require_once dirname(__DIR__, 2) . '/app/bootstrap.php';
(new AdminController($koneksi))->layanan();
