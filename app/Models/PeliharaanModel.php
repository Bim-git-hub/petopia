<?php
// app/Models/PeliharaanModel.php — query tabel `peliharaan`
class PeliharaanModel
{
    public static function allByPengguna($koneksi, int $id_pengguna): array
    {
        $q = mysqli_query($koneksi, "SELECT * FROM peliharaan WHERE id_pengguna='$id_pengguna' ORDER BY id_peliharaan ASC");
        if (!$q) {
            return [];
        }
        $rows = [];
        while ($r = mysqli_fetch_assoc($q)) {
            $rows[] = $r;
        }
        return $rows;
    }

    public static function countByPengguna($koneksi, int $id_pengguna): int
    {
        $q = mysqli_query($koneksi, "SELECT COUNT(*) AS n FROM peliharaan WHERE id_pengguna='$id_pengguna'");
        if (!$q) {
            return 0;
        }
        $r = mysqli_fetch_assoc($q);
        return (int) ($r['n'] ?? 0);
    }

    public static function create($koneksi, array $data): bool
    {
        $idp  = (int) ($data['id_pengguna'] ?? 0);
        $nama = mysqli_real_escape_string($koneksi, $data['nama_hewan'] ?? '');
        $jns  = mysqli_real_escape_string($koneksi, $data['jenis_hewan'] ?? '');
        $ras  = mysqli_real_escape_string($koneksi, $data['ras'] ?? '');
        $umur = (int) ($data['umur'] ?? 0);
        $ctt  = mysqli_real_escape_string($koneksi, $data['catatan_medis'] ?? '');
        $namaSql = $nama !== '' ? "'$nama'" : "NULL";

        return (bool) mysqli_query(
            $koneksi,
            "INSERT INTO peliharaan (id_pengguna, nama_hewan, jenis_hewan, ras, umur, catatan_medis) " .
            "VALUES ('$idp', $namaSql, '$jns', '$ras', '$umur', '$ctt')"
        );
    }

    // Ambil satu hewan hanya jika milik klien yang login (validasi booking)
    public static function findMilik($koneksi, int $id, int $id_pengguna): ?array
    {
        $q = mysqli_query($koneksi, "SELECT * FROM peliharaan WHERE id_peliharaan='$id' AND id_pengguna='$id_pengguna'");
        if (!$q || mysqli_num_rows($q) === 0) {
            return null;
        }
        return mysqli_fetch_assoc($q);
    }

    // Hapus hanya jika baris milik klien yang login (cegah hapus data orang lain).
    // Gagal halus (false) jika hewan sudah dipakai pesanan (FK booking).
    public static function deleteMilik($koneksi, int $id, int $id_pengguna): bool
    {
        try {
            return (bool) mysqli_query(
                $koneksi,
                "DELETE FROM peliharaan WHERE id_peliharaan='$id' AND id_pengguna='$id_pengguna'"
            ) && mysqli_affected_rows($koneksi) > 0;
        } catch (\Throwable $e) {
            return false;
        }
    }
}
