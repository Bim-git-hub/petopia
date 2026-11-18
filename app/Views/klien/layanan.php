<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Layanan - Petopia</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?php echo asset('asset/css/klien.css'); ?>">
</head>
<body>

<?php $menuAktif = 'layanan'; require BASE_PATH . '/app/Views/partials/nav_klien.php'; ?>

<div class="container py-4">

  <div class="card-soft p-4 mb-4 layanan-head">
    <div class="d-flex justify-content-between align-items-end flex-wrap gap-3">
      <div>
        <span class="eyebrow"><i class="bi bi-grid me-1"></i> Katalog layanan</span>
        <h4 class="fw-bold mb-1 mt-2" style="font-family:Outfit,sans-serif;letter-spacing:-.02em">Mau rawat si bulu apa hari ini?</h4>
        <div class="small muted">Harga transparan, admin konfirmasi jadwal dalam menit · 08:00–20:00</div>
      </div>
      <div class="d-flex gap-2 flex-wrap" id="filterChips">
        <button class="chip active" data-filter="all" type="button">Semua</button>
        <button class="chip" data-filter="grooming" type="button"><i class="bi bi-scissors me-1"></i>Grooming</button>
        <button class="chip" data-filter="klinik" type="button"><i class="bi bi-capsule me-1"></i>Klinik</button>
        <button class="chip" data-filter="penitipan" type="button"><i class="bi bi-house-heart me-1"></i>Penitipan</button>
      </div>
    </div>
  </div>

  <div class="row g-3 mb-4" id="gridLayanan">

    <?php if (empty($layanan)): ?>
      <div class="col-12">
        <div class="card-soft p-4 text-center small muted">Belum ada layanan tersedia. Silakan hubungi admin Petopia.</div>
      </div>
    <?php endif; ?>

    <?php foreach ($layanan as $l): $m = $l['meta']; ?>
    <div class="col-12 col-md-6 col-lg-4" data-cat="<?php echo htmlspecialchars($m['kategori']); ?>">
      <div class="service-card h-100">
        <div class="pic"><div class="ph" style="background-image:url('<?php echo htmlspecialchars($m['gambar']); ?>')"></div><span class="service-icon" style="color:<?php echo htmlspecialchars($m['warna']); ?>"><i class="bi <?php echo htmlspecialchars($m['ikon']); ?>"></i></span></div>
        <div class="p-3 d-flex flex-column flex-fill">
          <div class="fw-bold"><?php echo htmlspecialchars($l['nama_layanan']); ?></div>
          <div class="small muted mb-2"><?php echo htmlspecialchars($l['deskripsi'] ?? ''); ?></div>
          <div class="price small mb-1"><?php echo htmlspecialchars($l['harga_label']); ?><?php echo $m['durasi'] !== '' ? ' · ' . htmlspecialchars($m['durasi']) : ''; ?></div>
          <?php if ($m['catatan'] !== ''): ?>
          <div class="small muted mb-3" style="font-size:.74rem"><i class="bi bi-check2-circle me-1"></i><?php echo htmlspecialchars($m['catatan']); ?></div>
          <?php endif; ?>
          <a href="pesan.php?id_layanan=<?php echo (int) $l['id_pelayanan']; ?>" class="btn <?php echo htmlspecialchars($m['btn']); ?> btn-sm w-100 mt-auto"><?php echo htmlspecialchars($m['cta']); ?></a>
        </div>
      </div>
    </div>
    <?php endforeach; ?>

  </div>

  <div class="row g-3 mb-4">
    <div class="col-12 col-lg-7">
      <div class="card-soft p-4 h-100">
        <h6 class="fw-bold mb-3"><i class="bi bi-info-circle me-1" style="color:var(--green)"></i> Cara pesan</h6>
        <div class="timeline small">
          <div class="tl-item"><div class="fw-semibold">1. Pilih layanan</div><div class="muted">Klik "Pesan" pada layanan yang diinginkan.</div></div>
          <div class="tl-item"><div class="fw-semibold">2. Tunggu konfirmasi admin</div><div class="muted">Admin cek jadwal & konfirmasi via WhatsApp dalam menit.</div></div>
          <div class="tl-item"><div class="fw-semibold">3. Datang & bayar di tempat</div><div class="muted">Tunjukkan kode pesanan saat tiba di Petopia.</div></div>
        </div>
      </div>
    </div>
    <div class="col-12 col-lg-5 d-flex flex-column gap-3">
      <div class="card-soft p-4">
        <div class="d-flex align-items-center gap-3">
          <div class="service-icon" style="position:static;background:var(--green-soft);color:var(--green)"><i class="bi bi-headset"></i></div>
          <div style="min-width:0">
            <div class="fw-bold">Butuh layanan custom?</div>
            <div class="small muted">Punya kebutuhan khusus? Tim kami siap bantu.</div>
          </div>
        </div>
        <a href="https://wa.me/6285242539520" target="_blank" rel="noopener" class="btn btn-primary-petopia w-100 mt-3"><i class="bi bi-whatsapp me-1"></i> Chat Petopia</a>
      </div>
      <div class="card-soft p-3 d-flex align-items-center gap-3" style="background:var(--green-soft);border-color:#d6e6db">
        <div class="service-icon" style="background:#fff;color:var(--green);position:static"><i class="bi bi-shield-check"></i></div>
        <div class="small"><div class="fw-bold">Harga tanpa kejutan</div><div class="muted">Semua harga di atas sudah termasuk pajak.</div></div>
      </div>
    </div>
  </div>

  <?php require BASE_PATH . '/app/Views/partials/footer.php'; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.querySelectorAll('#filterChips .chip').forEach(function(chip){
  chip.addEventListener('click', function(){
    document.querySelectorAll('#filterChips .chip').forEach(function(c){ c.classList.remove('active'); });
    chip.classList.add('active');
    var f = chip.dataset.filter;
    document.querySelectorAll('#gridLayanan [data-cat]').forEach(function(card){
      card.style.display = (f === 'all' || card.dataset.cat === f) ? '' : 'none';
    });
  });
});
</script>
</body>
</html>
