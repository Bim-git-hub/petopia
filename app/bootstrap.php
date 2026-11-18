<?php
// app/bootstrap.php — dimuat tiap route root: config + helper + model + controller
require_once __DIR__ . '/Core/helpers.php';
require_once BASE_PATH . '/config/database.php';
require_once BASE_PATH . '/app/Models/AdminModel.php';
require_once BASE_PATH . '/app/Models/PenggunaModel.php';
require_once BASE_PATH . '/app/Models/LayananModel.php';
require_once BASE_PATH . '/app/Models/PeliharaanModel.php';
require_once BASE_PATH . '/app/Models/BookingModel.php';
require_once BASE_PATH . '/app/Models/StatusLogModel.php';
require_once BASE_PATH . '/app/Controllers/AuthController.php';
require_once BASE_PATH . '/app/Controllers/AdminController.php';
require_once BASE_PATH . '/app/Controllers/KlienController.php';
