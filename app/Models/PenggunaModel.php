<?php
// app/Models/PenggunaModel.php — query tabel `pengguna` (pindahan proses_login/register)
class PenggunaModel
{
    public static function findByEmail($koneksi, string $email): ?array
    {
        $e = mysqli_real_escape_string($koneksi, $email);
        $q = mysqli_query($koneksi, "SELECT * FROM pengguna WHERE email='$e'");
        if (!$q || mysqli_num_rows($q) === 0) {
            return null;
        }
        return mysqli_fetch_assoc($q);
    }

    public static function emailExists($koneksi, string $email): bool
    {
        return self::findByEmail($koneksi, $email) !== null;
    }

    public static function create($koneksi, array $data): bool
    {
        $nama  = mysqli_real_escape_string($koneksi, $data['nama_lengkap']);
        $email = mysqli_real_escape_string($koneksi, $data['email']);
        $pass  = mysqli_real_escape_string($koneksi, $data['password']);
        $telp  = mysqli_real_escape_string($koneksi, $data['no_telepon']);
        $almt  = mysqli_real_escape_string($koneksi, $data['alamat']);

        return (bool) mysqli_query(
            $koneksi,
            "INSERT INTO pengguna (nama_lengkap, email, password, no_telepon, alamat) " .
            "VALUES ('$nama', '$email', '$pass', '$telp', '$almt')"
        );
    }

    public static function count($koneksi): int
    {
        $q = mysqli_query($koneksi, "SELECT COUNT(*) AS n FROM pengguna");
        if (!$q) {
            return 0;
        }
        $r = mysqli_fetch_assoc($q);
        return (int) ($r['n'] ?? 0);
    }

    public static function recent($koneksi, int $limit = 5): array
    {
        $limit = max(1, $limit);
        $q = mysqli_query($koneksi, "SELECT * FROM pengguna ORDER BY id_pengguna DESC LIMIT $limit");
        if (!$q) {
            return [];
        }
        $rows = [];
        while ($r = mysqli_fetch_assoc($q)) {
            $rows[] = $r;
        }
        return $rows;
    }

    public static function all($koneksi): array
    {
        $q = mysqli_query($koneksi, "SELECT * FROM pengguna ORDER BY id_pengguna DESC");
        if (!$q) {
            return [];
        }
        $rows = [];
        while ($r = mysqli_fetch_assoc($q)) {
            $rows[] = $r;
        }
        return $rows;
    }

    // Cari klien berdasar nama/email/telepon (dipakai search admin)
    public static function search($koneksi, string $kw): array
    {
        $k = '%' . mysqli_real_escape_string($koneksi, $kw) . '%';
        $q = mysqli_query(
            $koneksi,
            "SELECT * FROM pengguna WHERE nama_lengkap LIKE '$k' OR email LIKE '$k' OR no_telepon LIKE '$k' ORDER BY id_pengguna DESC"
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

    // Gagal halus (false) jika klien masih punya hewan/pesanan (FK RESTRICT)
    public static function delete($koneksi, int $id): bool
    {
        try {
            return (bool) mysqli_query($koneksi, "DELETE FROM pengguna WHERE id_pengguna='$id'")
                && mysqli_affected_rows($koneksi) > 0;
        } catch (\Throwable $e) {
            return false;
        }
    }
}
