<?php
// app/Models/StatusLogModel.php — query tabel `status_logs` (jejak ubah status oleh admin)
class StatusLogModel
{
    public static function create($koneksi, array $data): bool
    {
        $idb = (int) ($data['id_booking'] ?? 0);
        $ida = (int) ($data['id_admin'] ?? 0);
        $tgl = mysqli_real_escape_string($koneksi, $data['tgl_update'] ?? date('Y-m-d'));
        $st  = mysqli_real_escape_string($koneksi, $data['status_penitipan'] ?? '');
        $ctt = trim($data['catatan_admin'] ?? '');
        $cttSql = $ctt !== '' ? "'" . mysqli_real_escape_string($koneksi, $ctt) . "'" : "NULL";

        return (bool) mysqli_query(
            $koneksi,
            "INSERT INTO status_logs (id_booking, id_admin, tgl_update, status_penitipan, catatan_admin) " .
            "VALUES ('$idb', '$ida', '$tgl', '$st', $cttSql)"
        );
    }

    public static function allByBooking($koneksi, int $id_booking): array
    {
        $q = mysqli_query(
            $koneksi,
            "SELECT l.*, a.nama_admin FROM status_logs l " .
            "JOIN admin a ON a.id_admin=l.id_admin " .
            "WHERE l.id_booking='$id_booking' ORDER BY l.id_logs DESC"
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

    // Riwayat aktivitas global: semua log + info pesanan/klien/layanan/pelaku.
    // $filter = '' (semua) atau 1 huruf status P/K/S/B
    public static function allSemua($koneksi, int $limit = 100, string $filter = ''): array
    {
        $limit = max(1, min(500, $limit));
        $where = '';
        if (in_array($filter, ['P', 'K', 'S', 'B'], true)) {
            $where = " WHERE l.status_penitipan='$filter'";
        }
        $q = mysqli_query(
            $koneksi,
            "SELECT l.*, a.nama_admin, u.nama_lengkap, p.nama_layanan, h.nama_hewan " .
            "FROM status_logs l " .
            "JOIN admin a ON a.id_admin=l.id_admin " .
            "JOIN booking b ON b.id_booking=l.id_booking " .
            "JOIN pengguna u ON u.id_pengguna=b.id_pengguna " .
            "JOIN pelayanan p ON p.id_pelayanan=b.id_pelayanan " .
            "JOIN peliharaan h ON h.id_peliharaan=b.id_peliharaan" .
            $where .
            " ORDER BY l.id_logs DESC LIMIT $limit"
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
}
