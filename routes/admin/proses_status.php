<?php
// Route: POST ubah status pesanan → AdminController@updateStatus
require_once dirname(__DIR__, 2) . '/app/bootstrap.php';
(new AdminController($koneksi))->updateStatus();
