<?php
// Route: POST tambah klien manual → AdminController@simpanKlien
require_once dirname(__DIR__, 2) . '/app/bootstrap.php';
(new AdminController($koneksi))->simpanKlien();
