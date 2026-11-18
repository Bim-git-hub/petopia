<?php
// Route: bantuan admin (role=admin) → AdminController@bantuan → app/Views/admin/bantuan.php
require_once dirname(__DIR__, 2) . '/app/bootstrap.php';
(new AdminController($koneksi))->bantuan();
