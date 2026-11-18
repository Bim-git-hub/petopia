<?php
// Route: hasil pencarian admin (role=admin) → AdminController@cari → app/Views/admin/cari.php
require_once dirname(__DIR__, 2) . '/app/bootstrap.php';
(new AdminController($koneksi))->cari();
