<?php
// app/Controllers/AuthController.php — alur login/register/logout (pindahan proses_*.php)
class AuthController
{
    private $db;

    public function __construct($koneksi)
    {
        $this->db = $koneksi;
    }

    public function showLogin(): void
    {
        view('auth/login');
    }

    public function showRegister(): void
    {
        view('auth/register');
    }

    // Halaman publik (tanpa guard) — ditaut dari checkbox register
    public function syarat(): void
    {
        view('auth/syarat');
    }

    public function login(): void
    {
        ensure_session();
        $ident = $_POST['username'] ?? '';
        $pass  = $_POST['password'] ?? '';

        // 1. Admin dulu (login pakai `username`)
        $admin = AdminModel::findByUsername($this->db, $ident);
        if ($admin && $admin['password'] === $pass) {
            $_SESSION['id_admin'] = $admin['id_admin'];
            $_SESSION['nama']     = $admin['nama_admin'];
            $_SESSION['role']     = 'admin';
            redirect('admin_dashboard.php');
        }

        // 2. Klien (login pakai `email`)
        $user = PenggunaModel::findByEmail($this->db, $ident);
        if ($user && $user['password'] === $pass) {
            $_SESSION['id_pengguna'] = $user['id_pengguna'];
            $_SESSION['nama']        = $user['nama_lengkap'];
            $_SESSION['role']        = 'klien';
            redirect('index.php');
        }

        js_alert('Login gagal! Username/Email atau Password Anda salah.', 'login.php');
    }

    public function register(): void
    {
        $email = $_POST['email'] ?? '';
        if (PenggunaModel::emailExists($this->db, $email)) {
            js_alert('Pendaftaran Gagal! Email sudah terdaftar.', 'register.php');
        }

        $ok = PenggunaModel::create($this->db, $_POST);
        if ($ok) {
            js_alert('Pendaftaran Berhasil! Silakan login.', 'login.php');
        }
        js_alert('Terjadi kesalahan sistem saat mendaftar.', 'register.php');
    }

    public function logout(): void
    {
        ensure_session();
        session_destroy();
        redirect('login.php');
    }
}
