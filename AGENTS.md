# Petopia — Agent Guide

## Project

Simple PHP web app for pet care services. No framework, no build system, no tests, no CI.

**Stack:** Plain PHP + MySQL (mysqli) + Bootstrap 5 (CDN)

## Setup

- **Server:** Laragon (or any Apache+PHP stack) serving from `C:\laragon\www\petopia`
- **Database:** MySQL, database name `db_petopia`, user `root`, no password
- **Database schema is NOT in the repo** — you must create the `db_petopia` database and tables manually or ask the user for the schema. Known tables: `admin`, `pengguna`, `pelayanan` (seed: 6 layanan), `peliharaan`, `booking`, `status_logs`.

## Architecture (MVC, no framework)

- `config/database.php` — DB connection (`$koneksi`). Single source of truth.
- `app/bootstrap.php` — Loaded by every route in `routes/`. Wires config + helpers + models + controllers.
- `app/Core/helpers.php` — `base_url()`, `asset()`, `redirect()`, `js_alert()`, `ensure_session()`, `require_role()`, `view()`. Always use `asset()` for CSS/JS/img paths — never a leading `/` (breaks under Laragon subfolder URLs, e.g. `/petopia/`). `base_url()` menghitung prefix dari `REQUEST_URI` (bukan `SCRIPT_NAME`) karena file route berada di `routes/`.
- `app/Models/` — `AdminModel` (`admin`: findByUsername, findById, firstId, usernameExists, updateProfil, updatePassword), `PenggunaModel` (`pengguna`: find, exists, create, count, recent, all, delete, search), `LayananModel` (`pelayanan`: all, find, metaFor, hargaLabel, count, create, update, delete, search), `PeliharaanModel` (`peliharaan`: allByPengguna, count, create, findMilik, deleteMilik), `BookingModel` (`booking`: hitungTotal, create, allByPengguna, allAdmin, updateStatus, countByStatus, countBulanIni, countDipakai, countByPengguna, statusLabel, statusStyle, search), `StatusLogModel` (`status_logs`: create, allByBooking, allSemua).
- `app/Controllers/` — `AuthController` (login: cek admin dulu lalu pengguna; register; syarat; logout; constructor terima `$koneksi`), `AdminController` (dashboard + kelola pesanan/layanan/klien + cari + bantuan + aktivitas + pengaturan; constructor terima `$koneksi`), `KlienController` (home, layanan, hewan, pesan, pesanan, bantuan; constructor terima `$koneksi`).
- `app/Views/` — Pure presentation; session guards live in controllers. Data dari controller via `view($name, $data)` (extract).
  - `auth/` — `login.php`, `register.php`, `syarat.php` (publik).
  - `klien/` — `home.php` (terima `$linkPesan`, `$terbaru`), `layanan.php` (`$layanan`), `hewan.php` (`$hewan`), `pesan.php` (`$layanan`, `$dipilih`, `$hewan`), `pesanan.php` (`$pesanan`), `bantuan.php` (FAQ statis).
  - `admin/` — `dashboard.php` (`$totalKlien`, `$pesananBulanIni`, `$layananAktif`, `$pending`, `$klienBaru`, `$aktivitasTerbaru`), `pesanan.php` (`$pesanan`), `layanan.php` (`$layanan`, `$edit`), `klien.php` (`$klien`), `cari.php` (`$q`, `$klien`, `$layanan`, `$pesanan`), `bantuan.php` (statis), `aktivitas.php` (`$logs`, `$filter`), `pengaturan.php` (`$akun`).
  - `partials/` — `nav_klien.php` (variabel `$menuAktif`: beranda/layanan/pesanan/bantuan), `admin_top.php` (`$judul`, `$menuAktif`: dashboard/klien/layanan/pesanan/pengaturan/bantuan), `admin_foot.php`, `footer.php` (teks © + link bantuan, dipakai semua halaman auth/klien/admin). Dipakai via `require BASE_PATH . '/app/Views/partials/...'` langsung di view.
- `routes/` — Thin routes (3 baris each) delegating to controllers, dikelompokkan per role: `routes/auth/`, `routes/klien/`, `routes/admin/` (29 file). Tiap file `require_once dirname(__DIR__, 2) . '/app/bootstrap.php';`. URL publik **tidak berubah** — root `.htaccess` me-rewrite `/login.php`, `/admin_dashboard.php`, dst. ke file di `routes/` (butuh mod_rewrite + `AllowOverride All`; vhost Laragon `petopia.test` sudah begitu, dan untuk akses subfolder `localhost/petopia/` juga jalan).
  - Auth: `login.php`, `register.php`, `proses_login.php`, `proses_register.php`, `logout.php`, `syarat.php`.
  - Klien: `index.php`, `layanan.php`, `hewan.php`, `proses_hewan.php`, `hapus_hewan.php`, `pesan.php`, `proses_pesan.php`, `pesanan.php`, `bantuan.php`.
  - Admin: `admin_dashboard.php`, `admin_pesanan.php`, `proses_status.php`, `admin_layanan.php`, `proses_layanan.php`, `hapus_layanan.php`, `admin_klien.php`, `proses_klien.php`, `hapus_klien.php`, `admin_cari.php`, `admin_bantuan.php`, `admin_aktivitas.php`, `admin_pengaturan.php`, `proses_pengaturan.php`.
  - Menambah URL baru = tambah file di `routes/<grup>/` **plus** satu baris `RewriteRule` di `.htaccess`. Jangan tautkan URL langsung ke `routes/...` (diblokir `.htaccess` via `[F]`).
- `asset/` — `css/` (`auth.css`, `klien.css`, `admin.css`), `js/` (`admin.js`: toggleSidebar + Escape), `img/` (logo `Petopia-01.png` lives in `asset/img/`).

## Business Rules (disepakati, tanpa ubah skema DB)

- Meta tampilan layanan (kategori, satuan tagih, durasi, gambar, CTA) di-hardcode di `LayananModel::metaFor()` per nama layanan; layanan baru tampil generik.
- Satuan tagih: `sesi` = flat, `hari` = harga × hari (min 1), `minggu` = harga × ceil(hari/7) (min 1). Server (`hitungTotal`) dan estimasi JS di `pesan.php` wajib sama.
- Status booking: `P` pending, `K` dikonfirmasi, `S` selesai, `B` dibatalkan. Label/warna via `statusLabel()`/`statusStyle()`.
- `booking.id_admin` NOT NULL → diisi admin pertama (`AdminModel::firstId()`) saat booking dibuat.
- Hapus layanan/hewan yang sudah dipakai pesanan ditolak (FK RESTRICT; model delete gagal-halus false).

## Keputusan Fitur (final, hasil sesi pengembangan)

- **`status_logs` = satu-satunya riwayat aktivitas.** Cakupannya ganti status pesanan saja; halaman global `admin_aktivitas.php` (filter `?status=P/K/S/B`) dan timeline dashboard pakai `StatusLogModel::allSemua()`. Aksi tanpa pesanan (login, CRUD layanan/klien) **tidak dicatat** — kalau suatu hari dibutuhkan, harus ALTER tabel (`id_booking`/`status_penitipan` nullable + kolom `aksi`/`id_ref`); jangan buat tabel log baru.
- **Search admin** — topbar form GET → `admin_cari.php?q=`, hasil grup klien/layanan/pesanan (`search()` di 3 model). Kata kosong redirect ke dashboard.
- **Pengaturan admin** — 2 form di `admin_pengaturan.php` via `proses_pengaturan.php` (`aksi=profil|password`): profil (nama, username unik — dicek `usernameExists()` dengan kecuali id sendiri, telepon 6–15 angka, jabatan; sukses → `$_SESSION['nama']` disegarkan) dan ganti password (lama diverifikasi, baru min 6, ulangi sama; plaintext).
- **Lupa password** — ditunda, bagian materi API (butuh SMTP + tabel token). Link `href="#"` di `login.php` dibiarkan dulu.
- **Pesan/broadcast** — dibuang dari produk (klien diarahkan chat WA `wa.me/6285242539520`); menu "Pesan" dan tombol "Broadcast" di admin sudah dihapus. Jangan dihidupkan lagi tanpa tabel `pesan` baru.

## Two Roles

| Role | Session key | DB table | Login field | Dashboard |
|------|------------|----------|-------------|-----------|
| Admin | `role = "admin"` (`id_admin`, `nama`) | `admin` | `username` | `admin_dashboard.php` |
| Klien | `role = "klien"` (`id_pengguna`, `nama`) | `pengguna` | `email` | `index.php` |

## Gotchas

- Passwords are stored and compared in **plaintext** — do not add hashing without migrating existing data.
- SQL queries use string concatenation (mysqli_real_escape_string is used, but no prepared statements). When adding queries, match the existing style or flag the inconsistency.
- Session via `ensure_session()` in helpers — do not add a second `session_start()` after including route files.
- No form CSRF protection exists anywhere.
- No `composer.json` or dependency management. Do not assume any PHP packages are available.
- URL publik dipetakan di root `.htaccess` ke `routes/`. Kalau deploy ke server tanpa `mod_rewrite`/`AllowOverride All`, semua URL publik 404. Menambah route = file di `routes/<grup>/` + baris `RewriteRule`.
- `config/database.php` memanggil `mysqli_report(MYSQLI_REPORT_OFF)` supaya query gagal mengembalikan `false` (bukan exception). Jangan dihapus — model mengandalkan `false` untuk kasus FK gagal-halus.
- Shape rule: tombol/badge/input = pill, kartu = 20px, avatar = bulat. Tema `#405d4d` / `#e9ecef` dipertahankan.
