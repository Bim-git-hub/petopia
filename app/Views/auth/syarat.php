<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Syarat & Ketentuan - Petopia</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@500;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?php echo asset('asset/css/auth.css'); ?>">
</head>
<body>

<div class="top-mini">
  <a class="brand" href="login.php" aria-label="Petopia beranda">
    <img src="<?php echo asset('asset/img/Petopia-01.png'); ?>" alt="Petopia" class="brand-logo">
    <span>
      <span class="brand-name" style="display:block">Petopia</span>
      <span class="brand-sub">Pet care • Grooming • Clinic</span>
    </span>
  </a>
  <a href="register.php" class="small fw-semibold d-none d-sm-inline-flex align-items-center gap-1" style="text-decoration:none;color:var(--muted)">Kembali <span style="color:var(--green)">Daftar →</span></a>
</div>

<div class="shell">
  <div class="login-wrapper">
    <div class="form-section" style="flex:1 1 100%">
      <span class="eyebrow"><i class="bi bi-file-text"></i> Berlaku sejak 2026</span>
      <h1>Syarat & Ketentuan</h1>
      <p class="sub">Ringkas, tanpa bahasa hukum berbelit.</p>
      <ol class="small" style="color:#3a4440;line-height:1.7;padding-left:1.1rem">
        <li><strong>Akun.</strong> Satu email untuk satu akun. Jaga kerahasiaan password Anda.</li>
        <li><strong>Data hewan.</strong> Wajib jujur mengisi jenis, umur, dan catatan medis — dokter memakai data ini untuk dosis & penanganan.</li>
        <li><strong>Pemesanan.</strong> Pesanan berstatus Pending sampai dikonfirmasi admin via WhatsApp.</li>
        <li><strong>Harga.</strong> Sesi = flat; harian = tarif × hari; mingguan = tarif × minggu berjalan (per 7 hari). Harga sudah termasuk pajak.</li>
        <li><strong>Pembayaran.</strong> Bayar di tempat dengan menunjukkan kode pesanan.</li>
        <li><strong>Pembatalan.</strong> Gratis selama status Pending/Dikonfirmasi, via WhatsApp admin.</li>
        <li><strong>Penitipan.</strong> Hewan sakit menular wajib dilaporkan. Area terpantau CCTV 24 jam.</li>
        <li><strong>Privasi.</strong> Data dipakai hanya untuk operasional layanan, tidak dijual.</li>
      </ol>
      <div class="d-flex gap-2 flex-wrap mt-2">
        <a href="register.php" class="btn btn-custom" style="text-decoration:none">Saya setuju — daftar</a>
        <a href="login.php" class="btn-ghost" style="padding:.78rem 1rem;text-decoration:none">Kembali login</a>
      </div>
    </div>
  </div>
</div>

  <?php require BASE_PATH . '/app/Views/partials/footer.php'; ?>

</body>
</html>
