<?php
// Route: halaman login → AuthController@showLogin → app/Views/auth/login.php
require_once dirname(__DIR__, 2) . '/app/bootstrap.php';
(new AuthController($koneksi))->showLogin();
