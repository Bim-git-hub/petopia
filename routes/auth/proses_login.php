<?php
// Route: POST login → AuthController@login (cek admin lalu pengguna)
require_once dirname(__DIR__, 2) . '/app/bootstrap.php';
(new AuthController($koneksi))->login();
