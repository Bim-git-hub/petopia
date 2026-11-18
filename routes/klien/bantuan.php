<?php
// Route: bantuan klien (role=klien) → KlienController@bantuan → app/Views/klien/bantuan.php
require_once dirname(__DIR__, 2) . '/app/bootstrap.php';
(new KlienController($koneksi))->bantuan();
