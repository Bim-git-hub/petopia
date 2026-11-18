<?php
// app/Core/helpers.php — helper global: URL, redirect, view, guard session

if (!defined('BASE_PATH')) {
    define('BASE_PATH', dirname(__DIR__, 2));
}

// Base URL otomatis mengikuti subfolder (mis. /petopia/) agar asset
// tidak error seperti kasus src="/Petopia-01.png" sebelumnya.
// Root .htaccess me-rewrite URL publik (mis. /petopia/login.php) ke file di
// routes/, sehingga SCRIPT_NAME menunjuk ke routes/... — patokan base harus
// REQUEST_URI (URL yang diketik browser), bukan path file internal.
function base_url(string $path = ''): string
{
    $uri = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
    $uri = str_replace('\\', '/', $uri);

    // URL folder (mis. /petopia/) → base = folder itu sendiri.
    // URL file (mis. /petopia/login.php) → base = direktorinya.
    $base = (substr($uri, -1) === '/') ? rtrim($uri, '/') : dirname($uri);
    $base = str_replace('\\', '/', $base); // dirname() memakai '\' di Windows
    if ($base === '/' || $base === '.') {
        $base = '';
    }
    return $base . '/' . ltrim($path, '/');
}

function asset(string $path): string
{
    return base_url($path);
}

function redirect(string $path): void
{
    header('Location: ' . base_url($path));
    exit();
}

function js_alert(string $msg, string $to): void
{
    echo "<script>alert('" . addslashes($msg) . "');window.location='" . base_url($to) . "';</script>";
    exit();
}

function ensure_session(): void
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
}

// Guard role untuk controller dashboard (pindahan cek di tiap file view)
function require_role(string $role): void
{
    ensure_session();
    if (!isset($_SESSION['role']) || $_SESSION['role'] !== $role) {
        redirect('login.php');
    }
}

function view(string $name, array $data = []): void
{
    extract($data);
    require BASE_PATH . '/app/Views/' . $name . '.php';
}
