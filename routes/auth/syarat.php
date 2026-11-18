<?php
// Route: syarat & ketentuan (publik) → AuthController@syarat → app/Views/auth/syarat.php
require_once dirname(__DIR__, 2) . '/app/bootstrap.php';
(new AuthController($koneksi))->syarat();
