<?php
// Route: halaman register → AuthController@showRegister → app/Views/auth/register.php
require_once dirname(__DIR__, 2) . '/app/bootstrap.php';
(new AuthController($koneksi))->showRegister();
