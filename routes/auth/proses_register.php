<?php
// Route: POST register → AuthController@register (cek duplikat + insert pengguna)
require_once dirname(__DIR__, 2) . '/app/bootstrap.php';
(new AuthController($koneksi))->register();
