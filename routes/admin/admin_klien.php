<?php
// Route: kelola klien (role=admin) → AdminController@klien → app/Views/admin/klien.php
require_once dirname(__DIR__, 2) . '/app/bootstrap.php';
(new AdminController($koneksi))->klien();
