<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Pesanan Saya - Petopia</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?php echo asset('asset/css/klien.css'); ?>">
</head>
<body>

<?php $menuAktif = 'pesanan'; require BASE_PATH . '/app/Views/partials/nav_klien.php'; ?>

<div class="container py-4">

  <div class="card-soft p-4 mb-4 layanan-head">
    <div class="d-flex justify-content-between align-items-end flex-wrap gap-3">
      <div>
        <span class="eyebrow"><i class="bi bi-calendar-check me-1"></i> Riwayat pesanan</span>
        <h4 class="fw-bold mb-1 mt-2" style="font-family:Outfit,sans-serif;letter-spacing:-.02em">Pesanan saya (<?php echo count($pesanan); ?>)</h4>
        <div class="small muted">Terbaru di atas. Status diperbarui admin setelah konfirmasi.</div>
      </div>
      <a href="layanan.php" class="btn btn-primary-petopia btn-sm"><i class="bi bi-plus-lg me-1"></i> Pesan lagi</a>
    </div>
  </div>

  <?php if (empty($pesanan)): ?>
    <div class="card-soft p-5 text-center">
      <div class="service-icon mx-auto mb-3" style="position:static;width:52px;height:52px;font-size:1.4rem;background:var(--green-soft);color:var(--green)"><i class="bi bi-calendar-x"></i></div>
      <div class="fw-bold mb-1">Belum ada pesanan</div>
      <div class="small muted mb-3">Yuk pesan layanan pertama untuk si bulu.</div>
      <a href="layanan.php" class="btn btn-primary-petopia btn-sm"><i class="bi bi-bag-heart me-1"></i> Lihat layanan</a>
    </div>
  <?php endif; ?>

  <div class="row g-3 mb-4">
    <?php foreach ($pesanan as $p): ?>
    <div class="col-12">
      <div class="card-soft p-3 p-md-4">
        <div class="d-flex flex-wrap align-items-center gap-3">
          <div class="avatar"><?php echo strtoupper(substr($p['nama_hewan'] !== '' ? $p['nama_hewan'] : $p['jenis_hewan'], 0, 1)); ?></div>
          <div style="min-width:200px;flex:1">
            <div class="fw-bold"><?php echo htmlspecialchars($p['nama_layanan']); ?></div>
            <div class="small muted">
              <?php echo htmlspecialchars($p['nama_hewan'] !== '' ? $p['nama_hewan'] : '(Tanpa nama)'); ?> (<?php echo htmlspecialchars($p['jenis_hewan']); ?>)
              · <?php echo date('d M Y', strtotime($p['tgl_masuk'])); ?> → <?php echo date('d M Y', strtotime($p['tgl_keluar'])); ?>
            </div>
          </div>
          <div class="text-md-end">
            <div class="price">Rp <?php echo number_format((int) $p['total_harga'], 0, ',', '.'); ?></div>
            <span class="badge-soft mt-1 d-inline-block" style="<?php echo htmlspecialchars(BookingModel::statusStyle($p['status_booking'])); ?>"><?php echo htmlspecialchars(BookingModel::statusLabel($p['status_booking'])); ?></span>
          </div>
        </div>
        <div class="small muted mt-2" style="font-size:.76rem">Kode #<?php echo (int) $p['id_booking']; ?> · Bayar di tempat saat tiba di Petopia.</div>
      </div>
    </div>
    <?php endforeach; ?>
  </div>

  <?php require BASE_PATH . '/app/Views/partials/footer.php'; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
