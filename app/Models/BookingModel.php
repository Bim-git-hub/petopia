<?php
// app/Models/BookingModel.php — query tabel `booking`
class BookingModel
{
    // Aturan total berdasar satuan tagih: sesi = harga flat sekali sesi,
    // hari = harga × jumlah hari (min. 1 hari), minggu = harga × jumlah minggu
    // berjalan (blok 7 hari, min. 1 minggu).
    public static function hitungTotal(int $harga, string $satuan, string $tgl_masuk, string $tgl_keluar): int
    {
        if ($satuan === 'hari' || $satuan === 'minggu') {
            $hari = (int) round((strtotime($tgl_keluar) - strtotime($tgl_masuk)) / 86400) + 1;
            $hari = max(1, $hari);
            $kelipatan = $satuan === 'minggu' ? (int) ceil($hari / 7) : $hari;
            return $harga * max(1, $kelipatan);
        }
        return $harga;
    }

    public static function create($koneksi, array $data): bool
    {
        $idp  = (int) ($data['id_pengguna'] ?? 0);
        $idh  = (int) ($data['id_peliharaan'] ?? 0);
        $idl  = (int) ($data['id_pelayanan'] ?? 0);
        $ida  = (int) ($data['id_admin'] ?? 0);
        $tm   = mysqli_real_escape_string($koneksi, $data['tgl_masuk'] ?? '');
        $tk   = mysqli_real_escape_string($koneksi, $data['tgl_keluar'] ?? '');
        $tot  = (int) ($data['total_harga'] ?? 0);
        $st   = mysqli_real_escape_string($koneksi, $data['status_booking'] ?? 'P');

        return (bool) mysqli_query(
            $koneksi,
            "INSERT INTO booking (id_pengguna, id_peliharaan, id_pelayanan, id_admin, tgl_masuk, tgl_keluar, total_harga, status_booking) " .
            "VALUES ('$idp', '$idh', '$idl', '$ida', '$tm', '$tk', '$tot', '$st')"
        );
    }

    // Riwayat milik satu klien, terbaru dulu (JOIN nama layanan + hewan).
    // $limit > 0 untuk cuplikan (mis. 3 terbaru di beranda).
    public static function allByPengguna($koneksi, int $id_pengguna, int $limit = 0): array
    {
        $lim = $limit > 0 ? ' LIMIT ' . $limit : '';
        $q = mysqli_query(
            $koneksi,
            "SELECT b.*, p.nama_layanan, h.nama_hewan, h.jenis_hewan " .
            "FROM booking b " .
            "JOIN pelayanan p ON p.id_pelayanan=b.id_pelayanan " .
            "JOIN peliharaan h ON h.id_peliharaan=b.id_peliharaan " .
            "WHERE b.id_pengguna='$id_pengguna' ORDER BY b.id_booking DESC$lim"
        );
        if (!$q) {
            return [];
        }
        $rows = [];
        while ($r = mysqli_fetch_assoc($q)) {
            $rows[] = $r;
        }
        return $rows;
    }

    // Kode status_booking yang disepakati Fase 0
    public static function statusLabel(string $kode): string
    {
        static $map = ['P' => 'Pending', 'K' => 'Dikonfirmasi', 'S' => 'Selesai', 'B' => 'Dibatalkan'];
        return $map[$kode] ?? $kode;
    }

    public static function statusStyle(string $kode): string
    {
        static $map = [
            'P' => 'background:#fff7e6;border-color:#fde2b8;color:#8a5a12',
            'K' => 'background:#e6f0ff;border-color:#bcd3f5;color:#2f4a7a',
            'S' => 'background:var(--green-soft);border-color:#d6e6db;color:var(--green)',
            'B' => 'background:#fdeeee;border-color:#f5c6c6;color:#a03d3d',
        ];
        return $map[$kode] ?? '';
    }

    // Semua booking untuk admin (JOIN klien + hewan + layanan), terbaru dulu
    public static function allAdmin($koneksi): array
    {
        $q = mysqli_query(
            $koneksi,
            "SELECT b.*, u.nama_lengkap, p.nama_layanan, h.nama_hewan, h.jenis_hewan " .
            "FROM booking b " .
            "JOIN pengguna u ON u.id_pengguna=b.id_pengguna " .
            "JOIN pelayanan p ON p.id_pelayanan=b.id_pelayanan " .
            "JOIN peliharaan h ON h.id_peliharaan=b.id_peliharaan " .
            "ORDER BY b.id_booking DESC"
        );
        if (!$q) {
            return [];
        }
        $rows = [];
        while ($r = mysqli_fetch_assoc($q)) {
            $rows[] = $r;
        }
        return $rows;
    }

    public static function updateStatus($koneksi, int $id, string $status): bool
    {
        $st = mysqli_real_escape_string($koneksi, $status);
        return (bool) mysqli_query($koneksi, "UPDATE booking SET status_booking='$st' WHERE id_booking='$id'")
            && mysqli_affected_rows($koneksi) > 0;
    }

    // Cari pesanan: kode persis (jika angka) atau nama klien/hewan/layanan (dipakai search admin)
    public static function search($koneksi, string $kw): array
    {
        $k = '%' . mysqli_real_escape_string($koneksi, $kw) . '%';
        $byId = ctype_digit($kw) ? " OR b.id_booking='" . (int) $kw . "'" : '';
        $q = mysqli_query(
            $koneksi,
            "SELECT b.*, u.nama_lengkap, p.nama_layanan, h.nama_hewan, h.jenis_hewan " .
            "FROM booking b " .
            "JOIN pengguna u ON u.id_pengguna=b.id_pengguna " .
            "JOIN pelayanan p ON p.id_pelayanan=b.id_pelayanan " .
            "JOIN peliharaan h ON h.id_peliharaan=b.id_peliharaan " .
            "WHERE u.nama_lengkap LIKE '$k' OR p.nama_layanan LIKE '$k' OR h.nama_hewan LIKE '$k'$byId " .
            "ORDER BY b.id_booking DESC"
        );
        if (!$q) {
            return [];
        }
        $rows = [];
        while ($r = mysqli_fetch_assoc($q)) {
            $rows[] = $r;
        }
        return $rows;
    }

    public static function countByStatus($koneksi, string $status): int
    {
        $st = mysqli_real_escape_string($koneksi, $status);
        $q = mysqli_query($koneksi, "SELECT COUNT(*) AS n FROM booking WHERE status_booking='$st'");
        if (!$q) {
            return 0;
        }
        $r = mysqli_fetch_assoc($q);
        return (int) ($r['n'] ?? 0);
    }

    public static function countBulanIni($koneksi): int
    {
        $q = mysqli_query($koneksi, "SELECT COUNT(*) AS n FROM booking WHERE DATE_FORMAT(tgl_masuk,'%Y-%m')=DATE_FORMAT(CURDATE(),'%Y-%m')");
        if (!$q) {
            return 0;
        }
        $r = mysqli_fetch_assoc($q);
        return (int) ($r['n'] ?? 0);
    }

    public static function countDipakai($koneksi, int $id_pelayanan): int
    {
        $q = mysqli_query($koneksi, "SELECT COUNT(*) AS n FROM booking WHERE id_pelayanan='$id_pelayanan'");
        if (!$q) {
            return 0;
        }
        $r = mysqli_fetch_assoc($q);
        return (int) ($r['n'] ?? 0);
    }

    public static function countByPengguna($koneksi, int $id_pengguna): int
    {
        $q = mysqli_query($koneksi, "SELECT COUNT(*) AS n FROM booking WHERE id_pengguna='$id_pengguna'");
        if (!$q) {
            return 0;
        }
        $r = mysqli_fetch_assoc($q);
        return (int) ($r['n'] ?? 0);
    }
}
