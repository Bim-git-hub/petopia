<?php
// app/Controllers/KlienController.php — guard + alur klien (home, layanan, hewan, pesan, pesanan)
class KlienController
{
    private $db;

    public function __construct($koneksi)
    {
        $this->db = $koneksi;
    }

    public function home(): void
    {
        require_role('klien');
        // Petakan 3 kartu populer beranda ke ID layanan (fallback: halaman layanan)
        $populer = ['grooming' => 'Grooming Reguler', 'vaksin' => 'Vaksin & Check-up', 'penitipan' => 'Penitipan Harian'];
        $link = ['grooming' => 'layanan.php', 'vaksin' => 'layanan.php', 'penitipan' => 'layanan.php'];
        foreach (LayananModel::all($this->db) as $r) {
            foreach ($populer as $kunci => $nama) {
                if ($r['nama_layanan'] === $nama) {
                    $link[$kunci] = 'pesan.php?id_layanan=' . (int) $r['id_pelayanan'];
                }
            }
        }
        $terbaru = BookingModel::allByPengguna($this->db, (int) $_SESSION['id_pengguna'], 3);
        view('klien/home', ['linkPesan' => $link, 'terbaru' => $terbaru]);
    }

    public function hewan(): void
    {
        require_role('klien');
        $hewan = PeliharaanModel::allByPengguna($this->db, (int) $_SESSION['id_pengguna']);
        view('klien/hewan', ['hewan' => $hewan]);
    }

    public function storeHewan(): void
    {
        require_role('klien');
        $jenis = trim($_POST['jenis_hewan'] ?? '');
        $ras   = trim($_POST['ras'] ?? '');
        $umur  = $_POST['umur'] ?? '';
        $ctt   = trim($_POST['catatan_medis'] ?? '');

        // Kolom jenis/ras/umur/catatan NOT NULL di DB — tolak data kosong/tak valid
        if ($jenis === '' || $ras === '' || $ctt === '' || !ctype_digit((string) $umur)) {
            js_alert('Data belum lengkap! Isi jenis, ras, umur (angka), dan catatan medis.', 'hewan.php');
        }

        $ok = PeliharaanModel::create($this->db, [
            'id_pengguna'   => (int) $_SESSION['id_pengguna'],
            'nama_hewan'    => trim($_POST['nama_hewan'] ?? ''),
            'jenis_hewan'   => $jenis,
            'ras'           => $ras,
            'umur'          => (int) $umur,
            'catatan_medis' => $ctt,
        ]);
        if ($ok) {
            js_alert('Hewan berhasil ditambahkan!', 'hewan.php');
        }
        js_alert('Gagal menyimpan data hewan, coba lagi.', 'hewan.php');
    }

    public function hapusHewan(): void
    {
        require_role('klien');
        $id = (int) ($_GET['id'] ?? 0);
        if ($id > 0 && PeliharaanModel::deleteMilik($this->db, $id, (int) $_SESSION['id_pengguna'])) {
            js_alert('Data hewan dihapus.', 'hewan.php');
        }
        js_alert('Gagal menghapus (mungkin hewan sudah dipakai pesanan).', 'hewan.php');
    }

    public function layanan(): void
    {
        require_role('klien');
        $rows = LayananModel::all($this->db);
        $layanan = [];
        foreach ($rows as $r) {
            $harga = (int) ($r['harga_perhari'] ?? 0);
            $r['harga_label'] = LayananModel::hargaLabel($harga);
            $r['meta'] = LayananModel::metaFor($r['nama_layanan']);
            $layanan[] = $r;
        }
        view('klien/layanan', ['layanan' => $layanan]);
    }

    // Form pesan: ?id_layanan=N (preselect) — wajib sudah punya data hewan
    public function pesan(): void
    {
        require_role('klien');
        $idp = (int) $_SESSION['id_pengguna'];
        $hewan = PeliharaanModel::allByPengguna($this->db, $idp);
        if (empty($hewan)) {
            js_alert('Tambahkan data hewan dulu sebelum memesan layanan.', 'hewan.php');
        }
        $layanan = LayananModel::all($this->db);
        if (empty($layanan)) {
            js_alert('Belum ada layanan tersedia.', 'layanan.php');
        }
        foreach ($layanan as &$r) {
            $r['harga_label'] = LayananModel::hargaLabel((int) ($r['harga_perhari'] ?? 0));
            $r['meta'] = LayananModel::metaFor($r['nama_layanan']);
        }
        unset($r);
        $dipilih = LayananModel::find($this->db, (int) ($_GET['id_layanan'] ?? 0)) ?? $layanan[0];
        $dipilih['harga_label'] = LayananModel::hargaLabel((int) ($dipilih['harga_perhari'] ?? 0));
        $dipilih['meta'] = LayananModel::metaFor($dipilih['nama_layanan']);
        view('klien/pesan', ['layanan' => $layanan, 'dipilih' => $dipilih, 'hewan' => $hewan]);
    }

    public function storePesan(): void
    {
        require_role('klien');
        $idp = (int) $_SESSION['id_pengguna'];

        $service = LayananModel::find($this->db, (int) ($_POST['id_pelayanan'] ?? 0));
        if (!$service) {
            js_alert('Layanan tidak valid.', 'layanan.php');
        }
        $pet = PeliharaanModel::findMilik($this->db, (int) ($_POST['id_peliharaan'] ?? 0), $idp);
        if (!$pet) {
            js_alert('Pilih hewan milik Anda sendiri.', 'pesan.php');
        }

        $masuk  = $_POST['tgl_masuk'] ?? '';
        $keluar = $_POST['tgl_keluar'] ?? '';
        $hariIni = date('Y-m-d');
        if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $masuk) || !preg_match('/^\d{4}-\d{2}-\d{2}$/', $keluar)) {
            js_alert('Tanggal tidak valid.', 'pesan.php');
        }
        if ($masuk < $hariIni || $keluar < $masuk) {
            js_alert('Tanggal masuk minimal hari ini dan tanggal keluar tidak boleh mundur.', 'pesan.php');
        }

        $id_admin = AdminModel::firstId($this->db);
        if ($id_admin === 0) {
            js_alert('Belum ada admin penerima pesanan, hubungi Petopia.', 'layanan.php');
        }

        $meta  = LayananModel::metaFor($service['nama_layanan']);
        $total = BookingModel::hitungTotal((int) $service['harga_perhari'], $meta['satuan'], $masuk, $keluar);

        $ok = BookingModel::create($this->db, [
            'id_pengguna'    => $idp,
            'id_peliharaan'  => (int) $pet['id_peliharaan'],
            'id_pelayanan'   => (int) $service['id_pelayanan'],
            'id_admin'       => $id_admin,
            'tgl_masuk'      => $masuk,
            'tgl_keluar'     => $keluar,
            'total_harga'    => $total,
            'status_booking' => 'P',
        ]);
        if ($ok) {
            js_alert('Pesanan dibuat! Menunggu konfirmasi admin (Rp ' . number_format($total, 0, ',', '.') . ').', 'pesanan.php');
        }
        js_alert('Gagal membuat pesanan, coba lagi.', 'pesan.php');
    }

    public function pesanan(): void
    {
        require_role('klien');
        $pesanan = BookingModel::allByPengguna($this->db, (int) $_SESSION['id_pengguna']);
        view('klien/pesanan', ['pesanan' => $pesanan]);
    }

    public function bantuan(): void
    {
        require_role('klien');
        view('klien/bantuan');
    }
}
