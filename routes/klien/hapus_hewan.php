<?php
// Route: hapus hewan milik sendiri → KlienController@hapusHewan
require_once dirname(__DIR__, 2) . '/app/bootstrap.php';
(new KlienController($koneksi))->hapusHewan();
