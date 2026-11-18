<?php
// app/Models/LayananModel.php — query tabel `pelayanan`
class LayananModel
{
    public static function all($koneksi): array
    {
        $q = mysqli_query($koneksi, "SELECT * FROM pelayanan ORDER BY id_pelayanan ASC");
        if (!$q) {
            return [];
        }
        $rows = [];
        while ($r = mysqli_fetch_assoc($q)) {
            $rows[] = $r;
        }
        return $rows;
    }

    public static function find($koneksi, int $id): ?array
    {
        $q = mysqli_query($koneksi, "SELECT * FROM pelayanan WHERE id_pelayanan='$id'");
        if (!$q || mysqli_num_rows($q) === 0) {
            return null;
        }
        return mysqli_fetch_assoc($q);
    }

    // Meta tampilan per layanan (kategori, durasi, gambar, CTA) — hardcode di sini
    // karena tabel `pelayanan` (keputusan: tanpa ubah skema) hanya menyimpan
    // nama_layanan, deskripsi, dan harga_perhari. Dipakai katalog + aturan harga booking.
    public static function metaFor(string $nama): array
    {
        static $meta = [
            'Grooming Reguler'     => ['kategori' => 'grooming',  'satuan' => 'sesi',   'durasi' => '60–90 menit', 'gambar' => 'https://images.unsplash.com/photo-1583337130417-3346a1be7dee?q=80&w=700&auto=format&fit=crop', 'warna' => 'var(--green)', 'ikon' => 'bi-scissors',         'cta' => 'Pesan grooming', 'catatan' => 'Paling populer · 120+ bulan ini', 'btn' => 'btn-primary-petopia'],
            'Grooming Express'     => ['kategori' => 'grooming',  'satuan' => 'sesi',   'durasi' => '±45 menit',   'gambar' => 'https://images.unsplash.com/photo-1516734212186-a967f81ad0d7?q=80&w=700&auto=format&fit=crop', 'warna' => 'var(--green)', 'ikon' => 'bi-lightning-charge', 'cta' => 'Pesan express',   'catatan' => 'Bisa walk-in, antrean kilat',          'btn' => 'btn-ghost'],
            'Vaksin & Check-up'    => ['kategori' => 'klinik',    'satuan' => 'sesi',   'durasi' => '30–45 menit', 'gambar' => 'https://images.unsplash.com/photo-1576201836106-db1758fd1c97?q=80&w=700&auto=format&fit=crop', 'warna' => '#2f4a7a',     'ikon' => 'bi-capsule',          'cta' => 'Pesan vaksin',    'catatan' => 'Rabies, F4, V8 available',             'btn' => 'btn-ghost'],
            'Konsultasi Dokter'    => ['kategori' => 'klinik',    'satuan' => 'sesi',   'durasi' => '20 menit',    'gambar' => 'https://images.unsplash.com/photo-1573865526739-10659fec78a5?q=80&w=700&auto=format&fit=crop',  'warna' => '#2f4a7a',     'ikon' => 'bi-clipboard2-pulse', 'cta' => 'Tanya dokter',    'catatan' => 'Bisa chat lanjutan 3x24 jam',          'btn' => 'btn-ghost'],
            'Penitipan Harian'     => ['kategori' => 'penitipan', 'satuan' => 'hari',   'durasi' => 'per hari',    'gambar' => 'https://images.unsplash.com/photo-1552053831-71594a27632d?q=80&w=700&auto=format&fit=crop',  'warna' => '#8a5a12',     'ikon' => 'bi-house-heart',      'cta' => 'Cek jadwal',      'catatan' => 'Pantau 24 jam via CCTV',               'btn' => 'btn-ghost'],
            'Pet Hotel (Mingguan)' => ['kategori' => 'penitipan', 'satuan' => 'minggu', 'durasi' => 'per minggu',  'gambar' => 'https://images.unsplash.com/photo-1587300003388-59208cc962cb?q=80&w=700&auto=format&fit=crop', 'warna' => '#8a5a12',     'ikon' => 'bi-calendar2-week',   'cta' => 'Pesan kamar',     'catatan' => 'Video call tiap sore',                 'btn' => 'btn-ghost'],
        ];
        return $meta[$nama] ?? ['kategori' => 'lainnya', 'satuan' => 'sesi', 'durasi' => '', 'gambar' => 'https://images.unsplash.com/photo-1543466835-00a7907e9de1?q=80&w=700&auto=format&fit=crop', 'warna' => 'var(--green)', 'ikon' => 'bi-bag-heart', 'cta' => 'Pesan', 'catatan' => '', 'btn' => 'btn-ghost'];
    }

    public static function hargaLabel(int $harga): string
    {
        if ($harga <= 0) {
            return 'Tanya admin';
        }
        return 'Mulai Rp ' . rtrim(rtrim(number_format($harga / 1000, 1, ',', '.'), '0'), ',') . 'k';
    }

    public static function count($koneksi): int
    {
        $q = mysqli_query($koneksi, "SELECT COUNT(*) AS n FROM pelayanan");
        if (!$q) {
            return 0;
        }
        $r = mysqli_fetch_assoc($q);
        return (int) ($r['n'] ?? 0);
    }

    // Cari layanan berdasar nama/deskripsi (dipakai search admin)
    public static function search($koneksi, string $kw): array
    {
        $k = '%' . mysqli_real_escape_string($koneksi, $kw) . '%';
        $q = mysqli_query($koneksi, "SELECT * FROM pelayanan WHERE nama_layanan LIKE '$k' OR deskripsi LIKE '$k' ORDER BY id_pelayanan ASC");
        if (!$q) {
            return [];
        }
        $rows = [];
        while ($r = mysqli_fetch_assoc($q)) {
            $rows[] = $r;
        }
        return $rows;
    }

    public static function create($koneksi, array $data): bool
    {
        $nama = mysqli_real_escape_string($koneksi, $data['nama_layanan'] ?? '');
        $desk = mysqli_real_escape_string($koneksi, $data['deskripsi'] ?? '');
        $hrg  = (int) ($data['harga_perhari'] ?? 0);
        if ($nama === '' || $hrg <= 0) {
            return false;
        }
        return (bool) mysqli_query(
            $koneksi,
            "INSERT INTO pelayanan (nama_layanan, deskripsi, harga_perhari) VALUES ('$nama', '$desk', '$hrg')"
        );
    }

    public static function update($koneksi, int $id, array $data): bool
    {
        $nama = mysqli_real_escape_string($koneksi, $data['nama_layanan'] ?? '');
        $desk = mysqli_real_escape_string($koneksi, $data['deskripsi'] ?? '');
        $hrg  = (int) ($data['harga_perhari'] ?? 0);
        if ($nama === '' || $hrg <= 0) {
            return false;
        }
        return (bool) mysqli_query(
            $koneksi,
            "UPDATE pelayanan SET nama_layanan='$nama', deskripsi='$desk', harga_perhari='$hrg' WHERE id_pelayanan='$id'"
        );
    }

    public static function delete($koneksi, int $id): bool
    {
        // Gagal halus (false) jika layanan sudah dipakai pesanan (FK booking);
        // controller sudah menolak lebih dulu via countDipakai().
        try {
            return (bool) mysqli_query($koneksi, "DELETE FROM pelayanan WHERE id_pelayanan='$id'")
                && mysqli_affected_rows($koneksi) > 0;
        } catch (\Throwable $e) {
            return false;
        }
    }
}
