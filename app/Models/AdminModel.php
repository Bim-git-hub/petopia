<?php
// app/Models/AdminModel.php — query tabel `admin` (pindahan proses_login.php blok 1)
class AdminModel
{
    public static function findByUsername($koneksi, string $username): ?array
    {
        $u = mysqli_real_escape_string($koneksi, $username);
        $q = mysqli_query($koneksi, "SELECT * FROM admin WHERE username='$u'");
        if (!$q || mysqli_num_rows($q) === 0) {
            return null;
        }
        return mysqli_fetch_assoc($q);
    }

    public static function findById($koneksi, int $id): ?array
    {
        $q = mysqli_query($koneksi, "SELECT * FROM admin WHERE id_admin='" . (int) $id . "'");
        if (!$q || mysqli_num_rows($q) === 0) {
            return null;
        }
        return mysqli_fetch_assoc($q);
    }

    // Admin default untuk kolom booking.id_admin yang NOT NULL
    // (keputusan: diisi otomatis saat booking dibuat, tanpa ubah skema)
    public static function firstId($koneksi): int
    {
        $q = mysqli_query($koneksi, "SELECT id_admin FROM admin ORDER BY id_admin ASC LIMIT 1");
        if (!$q || mysqli_num_rows($q) === 0) {
            return 0;
        }
        $r = mysqli_fetch_assoc($q);
        return (int) $r['id_admin'];
    }

    // Username sudah dipakai admin lain? ($kecualiId = id admin yang sedang diedit)
    public static function usernameExists($koneksi, string $username, int $kecualiId = 0): bool
    {
        $u = mysqli_real_escape_string($koneksi, $username);
        $not = " AND id_admin<>'" . (int) $kecualiId . "'";
        $q = mysqli_query($koneksi, "SELECT id_admin FROM admin WHERE username='$u'$not");
        return $q && mysqli_num_rows($q) > 0;
    }

    public static function updateProfil($koneksi, int $id, array $data): bool
    {
        $nama  = mysqli_real_escape_string($koneksi, $data['nama_admin'] ?? '');
        $user  = mysqli_real_escape_string($koneksi, $data['username'] ?? '');
        $telp  = mysqli_real_escape_string($koneksi, $data['no_telepon_admin'] ?? '');
        $jabat = mysqli_real_escape_string($koneksi, $data['jabatan'] ?? '');
        if ($nama === '' || $user === '' || $telp === '' || $jabat === '') {
            return false;
        }
        return (bool) mysqli_query(
            $koneksi,
            "UPDATE admin SET nama_admin='$nama', username='$user', no_telepon_admin='$telp', jabatan='$jabat' WHERE id_admin='" . (int) $id . "'"
        );
    }

    // Password plaintext — konvensi proyek (jangan tambah hash tanpa migrasi data)
    public static function updatePassword($koneksi, int $id, string $password): bool
    {
        $p = mysqli_real_escape_string($koneksi, $password);
        return (bool) mysqli_query($koneksi, "UPDATE admin SET password='$p' WHERE id_admin='" . (int) $id . "'");
    }
}
