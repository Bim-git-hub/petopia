<?php
// Route: POST buat booking → KlienController@storePesan
require_once dirname(__DIR__, 2) . '/app/bootstrap.php';
(new KlienController($koneksi))->storePesan();
