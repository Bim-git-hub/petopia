<?php
// app/Controllers/AdminController.php — guard + alur admin (dashboard, kelola pesanan, kelola layanan)
class AdminController
{
    private $db;

    public function __construct($koneksi)
    {
        $this->db = $koneksi;
    }

    public function dashboard(): void
    {
        require_role('admin');
        view('admin/dashboard', [
            'totalKlien'      => PenggunaModel::count($this->db),
            'pesananBulanIni' => BookingModel::countBulanIni($this->db),
            'layananAktif'    => LayananModel::count($this->db),
            'pending'         => BookingModel::countByStatus($this->db, 'P'),
            'klienBaru'       => PenggunaModel::recent($this->db, 5),
            'aktivitasTerbaru' => StatusLogModel::allSemua($this->db, 4),
        ]);
    }

    public function aktivitas(): void
    {
        require_role('admin');
        $f = strtoupper($_GET['status'] ?? '');
        if (!in_array($f, ['P', 'K', 'S', 'B'], true)) {
            $f = '';
        }
        view('admin/aktivitas', [
            'logs' => StatusLogModel::allSemua($this->db, 100, $f),
            'filter' => $f,
            'notifPending' => BookingModel::countByStatus($this->db, 'P'),
        ]);
    }

    public function pesanan(): void
    {
        require_role('admin');
        view('admin/pesanan', [
            'pesanan' => BookingModel::allAdmin($this->db),
            'notifPending' => BookingModel::countByStatus($this->db, 'P'),
        ]);
    }

    public function updateStatus(): void
    {
        require_role('admin');
        $id = (int) ($_POST['id_booking'] ?? 0);
        $st = $_POST['status_booking'] ?? '';
        if ($id <= 0 || !in_array($st, ['P', 'K', 'S', 'B'], true)) {
            js_alert('Status tidak valid.', 'admin_pesanan.php');
        }
        if (!BookingModel::updateStatus($this->db, $id, $st)) {
            js_alert('Gagal ubah status (mungkin status sudah sama).', 'admin_pesanan.php');
        }
        StatusLogModel::create($this->db, [
            'id_booking'       => $id,
            'id_admin'         => (int) $_SESSION['id_admin'],
            'tgl_update'       => date('Y-m-d'),
            'status_penitipan' => $st,
            'catatan_admin'    => $_POST['catatan_admin'] ?? '',
        ]);
        js_alert('Status pesanan #' . $id . ' → ' . BookingModel::statusLabel($st) . '.', 'admin_pesanan.php');
    }

    public function layanan(): void
    {
        require_role('admin');
        $edit = null;
        if ((int) ($_GET['edit'] ?? 0) > 0) {
            $edit = LayananModel::find($this->db, (int) $_GET['edit']);
        }
        $rows = LayananModel::all($this->db);
        foreach ($rows as &$r) {
            $r['dipakai'] = BookingModel::countDipakai($this->db, (int) $r['id_pelayanan']);
        }
        unset($r);
        view('admin/layanan', ['layanan' => $rows, 'edit' => $edit, 'notifPending' => BookingModel::countByStatus($this->db, 'P')]);
    }

    public function simpanLayanan(): void
    {
        require_role('admin');
        $id    = (int) ($_POST['id_pelayanan'] ?? 0);
        $nama  = trim($_POST['nama_layanan'] ?? '');
        $harga = (int) ($_POST['harga_perhari'] ?? 0);
        if ($nama === '' || $harga <= 0) {
            js_alert('Nama layanan wajib diisi dan harga harus lebih dari 0.', 'admin_layanan.php');
        }
        $data = ['nama_layanan' => $nama, 'deskripsi' => trim($_POST['deskripsi'] ?? ''), 'harga_perhari' => $harga];
        $ok = $id > 0 ? LayananModel::update($this->db, $id, $data) : LayananModel::create($this->db, $data);
        js_alert($ok ? 'Layanan tersimpan.' : 'Gagal menyimpan layanan.', 'admin_layanan.php');
    }

    public function hapusLayanan(): void
    {
        require_role('admin');
        $id = (int) ($_GET['id'] ?? 0);
        if ($id <= 0) {
            js_alert('ID layanan tidak valid.', 'admin_layanan.php');
        }
        // FK booking → pelayanan: tolak hapus jika sudah dipakai pesanan
        if (BookingModel::countDipakai($this->db, $id) > 0) {
            js_alert('Layanan tidak bisa dihapus karena sudah dipakai pesanan.', 'admin_layanan.php');
        }
        js_alert(LayananModel::delete($this->db, $id) ? 'Layanan dihapus.' : 'Gagal menghapus layanan.', 'admin_layanan.php');
    }

    public function klien(): void
    {
        require_role('admin');
        $rows = PenggunaModel::all($this->db);
        foreach ($rows as &$r) {
            $idp = (int) $r['id_pengguna'];
            $r['n_hewan'] = PeliharaanModel::countByPengguna($this->db, $idp);
            $r['n_pesanan'] = BookingModel::countByPengguna($this->db, $idp);
        }
        unset($r);
        view('admin/klien', ['klien' => $rows]);
    }

    // Tambah klien manual oleh admin (password plaintext ikut konvensi repo)
    public function simpanKlien(): void
    {
        require_role('admin');
        $nama  = trim($_POST['nama_lengkap'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $pass  = $_POST['password'] ?? '';
        $telp  = trim($_POST['no_telepon'] ?? '');
        $almt  = trim($_POST['alamat'] ?? '');
        if ($nama === '' || $email === '' || $pass === '' || $telp === '' || $almt === '') {
            js_alert('Semua field wajib diisi.', 'admin_klien.php');
        }
        if (PenggunaModel::emailExists($this->db, $email)) {
            js_alert('Email sudah terdaftar.', 'admin_klien.php');
        }
        $ok = PenggunaModel::create($this->db, [
            'nama_lengkap' => $nama, 'email' => $email, 'password' => $pass,
            'no_telepon' => $telp, 'alamat' => $almt,
        ]);
        js_alert($ok ? 'Klien ditambahkan.' : 'Gagal menambah klien.', 'admin_klien.php');
    }

    public function hapusKlien(): void
    {
        require_role('admin');
        $id = (int) ($_GET['id'] ?? 0);
        if ($id <= 0) {
            js_alert('ID klien tidak valid.', 'admin_klien.php');
        }
        // FK peliharaan/booking → pengguna: tolak hapus jika masih punya data
        if (PeliharaanModel::countByPengguna($this->db, $id) > 0 || BookingModel::countByPengguna($this->db, $id) > 0) {
            js_alert('Klien tidak bisa dihapus karena masih punya hewan/pesanan.', 'admin_klien.php');
        }
        js_alert(PenggunaModel::delete($this->db, $id) ? 'Klien dihapus.' : 'Gagal menghapus klien.', 'admin_klien.php');
    }

    public function cari(): void
    {
        require_role('admin');
        $q = trim($_GET['q'] ?? '');
        if ($q === '') {
            redirect('admin_dashboard.php');
        }
        view('admin/cari', [
            'q' => $q,
            'qCari' => $q,
            'klien' => PenggunaModel::search($this->db, $q),
            'layanan' => LayananModel::search($this->db, $q),
            'pesanan' => BookingModel::search($this->db, $q),
            'notifPending' => BookingModel::countByStatus($this->db, 'P'),
        ]);
    }

    public function bantuan(): void
    {
        require_role('admin');
        view('admin/bantuan', ['notifPending' => BookingModel::countByStatus($this->db, 'P')]);
    }

    public function pengaturan(): void
    {
        require_role('admin');
        $id = (int) ($_SESSION['id_admin'] ?? 0);
        view('admin/pengaturan', [
            'akun' => AdminModel::findById($this->db, $id),
            'notifPending' => BookingModel::countByStatus($this->db, 'P'),
        ]);
    }

    public function simpanPengaturan(): void
    {
        require_role('admin');
        $id = (int) ($_SESSION['id_admin'] ?? 0);
        $aksi = $_POST['aksi'] ?? '';

        if ($aksi === 'profil') {
            $nama  = trim($_POST['nama_admin'] ?? '');
            $user  = trim($_POST['username'] ?? '');
            $telp  = trim($_POST['no_telepon_admin'] ?? '');
            $jabat = trim($_POST['jabatan'] ?? '');
            if ($nama === '' || $user === '' || $telp === '' || $jabat === '') {
                js_alert('Semua field profil wajib diisi.', 'admin_pengaturan.php');
            }
            if (!preg_match('/^[0-9]{6,15}$/', $telp)) {
                js_alert('Nomor telepon hanya angka (6-15 digit).', 'admin_pengaturan.php');
            }
            if (AdminModel::usernameExists($this->db, $user, $id)) {
                js_alert('Username sudah dipakai admin lain.', 'admin_pengaturan.php');
            }
            if (AdminModel::updateProfil($this->db, $id, [
                'nama_admin' => $nama, 'username' => $user,
                'no_telepon_admin' => $telp, 'jabatan' => $jabat,
            ])) {
                $_SESSION['nama'] = $nama;
                js_alert('Profil diperbarui.', 'admin_pengaturan.php');
            }
            js_alert('Gagal memperbarui profil.', 'admin_pengaturan.php');
        }

        if ($aksi === 'password') {
            $lama  = $_POST['password_lama'] ?? '';
            $baru  = $_POST['password_baru'] ?? '';
            $ulang = $_POST['password_ulangi'] ?? '';
            $akun  = AdminModel::findById($this->db, $id);
            if (!$akun || $akun['password'] !== $lama) {
                js_alert('Password lama salah.', 'admin_pengaturan.php');
            }
            if (strlen($baru) < 6) {
                js_alert('Password baru minimal 6 karakter.', 'admin_pengaturan.php');
            }
            if ($baru !== $ulang) {
                js_alert('Konfirmasi password baru tidak sama.', 'admin_pengaturan.php');
            }
            js_alert(AdminModel::updatePassword($this->db, $id, $baru) ? 'Password diganti.' : 'Gagal mengganti password.', 'admin_pengaturan.php');
        }

        js_alert('Aksi tidak dikenal.', 'admin_pengaturan.php');
    }
}
