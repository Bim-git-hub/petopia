<?php
// Route: POST tambah hewan → KlienController@storeHewan
require_once dirname(__DIR__, 2) . '/app/bootstrap.php';
(new KlienController($koneksi))->storeHewan();
