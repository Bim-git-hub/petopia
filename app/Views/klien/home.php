<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Petopia - Beranda Klien</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?php echo asset('asset/css/klien.css'); ?>">
</head>
<body>

<?php $menuAktif = 'beranda'; require BASE_PATH . '/app/Views/partials/nav_klien.php'; ?>

<div class="container py-4">

  <div class="hero mb-4">
    <div class="row g-0 align-items-stretch">
      <div class="col-12 col-lg-6 d-flex">
        <div class="hero-copy d-flex flex-column justify-content-center w-100">
          <span class="eyebrow"><i class="bi bi-stars"></i> Paw parents 2.000+ · 08:00–20:00</span>
          <h1>Rawat si anabul <em>tanpa ribet</em></h1>
          <p class="sub">Grooming, vaksin, dan penitipan dalam satu akun. Booking cepat, hasil rapi — si bulu pulang wangi.</p>
          <div class="d-flex flex-wrap gap-2 mt-3">
            <a href="layanan.php" class="btn btn-primary-petopia"><i class="bi bi-plus-lg me-1"></i> Pesan layanan</a>
            <a href="pesanan.php" class="btn btn-ghost">Lihat pesanan</a>
          </div>
          <div class="d-flex gap-2 flex-wrap mt-3 small muted" style="font-size:.78rem">
            <span><i class="bi bi-shield-check me-1" style="color:var(--green)"></i>Login aman</span>
            <span>·</span>
            <span><i class="bi bi-patch-check me-1" style="color:var(--green)"></i>Mitra terverifikasi</span>
          </div>
        </div>
      </div>
      <div class="col-12 col-lg-6">
        <div class="hero-visual">
          <img class="photo" src="https://images.unsplash.com/photo-1543852786-1cf6624b9987?q=80&w=1000&auto=format&fit=crop" alt="Kucing Petopia">
          <div class="float-card">
            <div class="avatar" style="width:38px;height:38px;font-size:.8rem">M</div>
            <div style="min-width:0;flex:1">
              <div style="font-weight:800;font-size:.88rem;line-height:1">Milo — grooming selesai</div>
              <div class="small muted" style="font-size:.78rem">Hari ini · 14:30 · Petopia Gading</div>
            </div>
            <span class="badge-soft"><i class="bi bi-check-circle me-1"></i>Selesai</span>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="d-flex justify-content-between align-items-end gap-2 mb-3 flex-wrap">
    <div>
      <h5 class="fw-bold mb-1" style="font-family:Outfit,sans-serif;letter-spacing:-.02em">Layanan populer</h5>
      <div class="small muted">Pilih layanan — admin konfirmasi jadwal dalam menit.</div>
    </div>
    <a href="layanan.php" class="small fw-semibold" style="color:var(--green);text-decoration:none">Lihat semua →</a>
  </div>

  <div class="row g-3 mb-4">
    <div class="col-12 col-md-4">
      <div class="service-card h-100">
        <div class="pic"><div class="ph" style="background-image:url('https://images.unsplash.com/photo-1583337130417-3346a1be7dee?q=80&w=700&auto=format&fit=crop')"></div><span class="service-icon" style="color:var(--green)"><i class="bi bi-scissors"></i></span></div>
        <div class="p-3">
          <div class="fw-bold">Grooming</div>
          <div class="small muted mb-2">Mandi, potong kuku & styling</div>
          <div class="price small mb-3">Mulai Rp 80k · 60–90 menit</div>
          <a href="<?php echo htmlspecialchars($linkPesan['grooming']); ?>" class="btn btn-primary-petopia btn-sm w-100">Pesan grooming</a>
        </div>
      </div>
    </div>
    <div class="col-12 col-md-4">
      <div class="service-card h-100">
        <div class="pic"><div class="ph" style="background-image:url('https://images.unsplash.com/photo-1576201836106-db1758fd1c97?q=80&w=700&auto=format&fit=crop')"></div><span class="service-icon" style="color:#2f4a7a"><i class="bi bi-capsule"></i></span></div>
        <div class="p-3">
          <div class="fw-bold">Vaksin & Check-up</div>
          <div class="small muted mb-2">Dokter hewan bersertifikat</div>
          <div class="price small mb-3">Mulai Rp 120k</div>
          <a href="<?php echo htmlspecialchars($linkPesan['vaksin']); ?>" class="btn btn-ghost btn-sm w-100">Pesan vaksin</a>
        </div>
      </div>
    </div>
    <div class="col-12 col-md-4">
      <div class="service-card h-100">
        <div class="pic"><div class="ph" style="background-image:url('https://images.unsplash.com/photo-1552053831-71594a27632d?q=80&w=700&auto=format&fit=crop');background-position:center 32%"></div><span class="service-icon" style="color:#8a5a12"><i class="bi bi-house-heart"></i></span></div>
        <div class="p-3">
          <div class="fw-bold">Penitipan</div>
          <div class="small muted mb-2">Harian & mingguan, CCTV</div>
          <div class="price small mb-3">Mulai Rp 65k/hari</div>
          <a href="<?php echo htmlspecialchars($linkPesan['penitipan']); ?>" class="btn btn-ghost btn-sm w-100">Cek jadwal</a>
        </div>
      </div>
    </div>
  </div>

  <div class="row g-3">
    <div class="col-12 col-lg-7">
      <div class="card-soft p-4 h-100">
        <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
          <h6 class="fw-bold mb-0"><i class="bi bi-calendar-check me-1" style="color:var(--green)"></i> Pesanan terbaru</h6>
          <a href="pesanan.php" class="btn btn-ghost btn-sm">Riwayat lengkap</a>
        </div>
        <div class="timeline small">
          <?php if (empty($terbaru)): ?>
          <div class="tl-item"><div class="fw-semibold">Belum ada pesanan</div><div class="muted">Yuk pesan layanan pertama untuk si bulu — <a href="layanan.php" style="color:var(--green);font-weight:600;text-decoration:none">lihat layanan →</a></div></div>
          <?php endif; ?>
          <?php foreach ($terbaru as $t): ?>
          <div class="tl-item"><div class="fw-semibold"><?php echo htmlspecialchars($t['nama_layanan']); ?> — <?php echo htmlspecialchars($t['nama_hewan'] !== '' ? $t['nama_hewan'] : '(Tanpa nama)'); ?> (<?php echo htmlspecialchars($t['jenis_hewan']); ?>) · <span class="badge-soft" style="<?php echo htmlspecialchars(BookingModel::statusStyle($t['status_booking'])); ?>"><?php echo htmlspecialchars(BookingModel::statusLabel($t['status_booking'])); ?></span></div><div class="muted"><?php echo date('d M Y', strtotime($t['tgl_masuk'])); ?> · Rp <?php echo number_format((int) $t['total_harga'], 0, ',', '.'); ?></div></div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
    <div class="col-12 col-lg-5 d-flex flex-column gap-3">
      <div class="card-soft p-4">
        <div class="d-flex align-items-center gap-3 mb-3">
          <div class="avatar"><?php echo strtoupper(substr($_SESSION['nama'],0,1)); ?></div>
          <div>
            <div class="fw-bold"><?php echo htmlspecialchars($_SESSION['nama']); ?></div>
            <div class="small muted">Klien · ID #<?php echo htmlspecialchars($_SESSION['id_pengguna'] ?? '—'); ?></div>
          </div>
          <span class="ms-auto badge" style="background:var(--green-soft);color:var(--green);border-radius:50px;font-size:.7rem;border:1px solid #d6e6db">Aktif</span>
        </div>
        <div class="d-grid gap-2">
          <a href="hewan.php" class="btn btn-primary-petopia"><i class="bi bi-pencil me-1"></i> Lengkapi profil hewan</a>
          <a href="https://wa.me/6285242539520" target="_blank" rel="noopener" class="btn btn-ghost"><i class="bi bi-telephone me-1"></i> Hubungi Petopia</a>
        </div>
      </div>
      <div class="card-soft p-4">
        <div class="quote">“Booking 2 menit, Milo pulang wangi dan anteng. Rekomen!”</div>
        <div class="small muted mt-2">— Sari & Milo · <span style="color:#c48a2a">★★★★★</span> Grooming langganan</div>
      </div>
      <div class="card-soft p-3 d-flex align-items-center gap-3" style="background:var(--green-soft);border-color:#d6e6db">
        <div class="service-icon" style="background:#fff;color:var(--green);position:static"><i class="bi bi-shield-check"></i></div>
        <div class="small"><div class="fw-bold">Akun terverifikasi</div><div class="muted">Login sebagai klien — akses pesanan & layanan.</div></div>
      </div>
    </div>
  </div>

  <?php require BASE_PATH . '/app/Views/partials/footer.php'; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
