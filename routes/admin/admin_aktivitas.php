<?php
// Route: riwayat aktivitas global (role=admin) → AdminController@aktivitas → app/Views/admin/aktivitas.php
require_once dirname(__DIR__, 2) . '/app/bootstrap.php';
(new AdminController($koneksi))->aktivitas();
