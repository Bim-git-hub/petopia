<?php
// Route: dashboard admin (role=admin) → AdminController@dashboard → app/Views/admin/dashboard.php
require_once dirname(__DIR__, 2) . '/app/bootstrap.php';
(new AdminController($koneksi))->dashboard();
