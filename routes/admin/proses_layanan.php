<?php
// Route: POST simpan layanan → AdminController@simpanLayanan
require_once dirname(__DIR__, 2) . '/app/bootstrap.php';
(new AdminController($koneksi))->simpanLayanan();
