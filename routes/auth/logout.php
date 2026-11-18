<?php
// Route: logout → AuthController@logout
require_once dirname(__DIR__, 2) . '/app/bootstrap.php';
(new AuthController($koneksi))->logout();
