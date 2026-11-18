<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Hewan Saya - Petopia</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?php echo asset('asset/css/klien.css'); ?>">
</head>
<body>

<?php $menuAktif = ''; require BASE_PATH . '/app/Views/partials/nav_klien.php'; ?>

<div class="container py-4">

  <div class="card-soft p-4 mb-4 layanan-head">
    <span class="eyebrow"><i class="bi bi-heart me-1"></i> Profil hewan</span>
    <h4 class="fw-bold mb-1 mt-2" style="font-family:Outfit,sans-serif;letter-spacing:-.02em">Hewan saya (<?php echo count($hewan); ?>)</h4>
    <div class="small muted">Data hewan wajib diisi sebelum bisa memesan layanan — satu pesanan untuk satu hewan.</div>
  </div>

  <div class="row g-3 mb-4">
    <?php if (empty($hewan)): ?>
      <div class="col-12">
        <div class="card-soft p-4 text-center small muted">Belum ada data hewan. Tambahkan lewat formulir di bawah ya.</div>
      </div>
    <?php endif; ?>
    <?php foreach ($hewan as $h): ?>
    <div class="col-12 col-md-6 col-lg-4">
      <div class="card-soft p-4 h-100">
        <div class="d-flex align-items-center gap-3 mb-2">
          <div class="avatar"><?php echo strtoupper(substr($h['nama_hewan'] !== '' ? $h['nama_hewan'] : $h['jenis_hewan'], 0, 1)); ?></div>
          <div style="min-width:0;flex:1">
            <div class="fw-bold" style="white-space:nowrap;overflow:hidden;text-overflow:ellipsis"><?php echo htmlspecialchars($h['nama_hewan'] !== '' ? $h['nama_hewan'] : '(Tanpa nama)'); ?></div>
            <div class="small muted"><?php echo htmlspecialchars($h['jenis_hewan']); ?> · <?php echo htmlspecialchars($h['ras']); ?></div>
          </div>
          <a href="hapus_hewan.php?id=<?php echo (int) $h['id_peliharaan']; ?>" class="btn btn-ghost btn-sm" title="Hapus" onclick="return confirm('Hapus data hewan ini?')"><i class="bi bi-trash"></i></a>
        </div>
        <div class="small d-flex flex-wrap gap-2 mt-2">
          <span class="badge-soft"><i class="bi bi-cake me-1"></i><?php echo (int) $h['umur']; ?> thn</span>
        </div>
        <div class="small muted mt-2"><i class="bi bi-clipboard2-pulse me-1"></i><?php echo htmlspecialchars($h['catatan_medis']); ?></div>
      </div>
    </div>
    <?php endforeach; ?>
  </div>

  <div class="row g-3 mb-4">
    <div class="col-12 col-lg-7">
      <div class="card-soft p-4 h-100">
        <h6 class="fw-bold mb-1"><i class="bi bi-plus-lg me-1" style="color:var(--green)"></i> Tambah hewan</h6>
        <div class="small muted mb-3">Nama boleh kosong, selain itu wajib diisi.</div>
        <form action="proses_hewan.php" method="POST">
          <div class="row g-2">
            <div class="col-12 col-sm-6">
              <label class="form-label small fw-semibold" for="nama_hewan">Nama hewan <span class="muted">(opsional)</span></label>
              <input id="nama_hewan" type="text" name="nama_hewan" class="form-control" style="border-radius:50px" placeholder="mis. Milo" maxlength="50">
            </div>
            <div class="col-12 col-sm-6">
              <label class="form-label small fw-semibold" for="jenis_hewan">Jenis *</label>
              <select id="jenis_hewan" name="jenis_hewan" class="form-select" style="border-radius:50px" required>
                <option value="" selected disabled>Pilih jenis...</option>
                <option value="Kucing">Kucing</option>
                <option value="Anjing">Anjing</option>
                <option value="Kelinci">Kelinci</option>
                <option value="Burung">Burung</option>
                <option value="Hamster">Hamster</option>
                <option value="Lainnya">Lainnya</option>
              </select>
            </div>
            <div class="col-12 col-sm-6">
              <label class="form-label small fw-semibold" for="ras">Ras *</label>
              <input id="ras" type="text" name="ras" class="form-control" style="border-radius:50px" placeholder="mis. Persia / Beagle" required maxlength="50">
            </div>
            <div class="col-12 col-sm-6">
              <label class="form-label small fw-semibold" for="umur">Umur (tahun) *</label>
              <input id="umur" type="number" name="umur" class="form-control" style="border-radius:50px" placeholder="mis. 2" required min="0" max="50" step="1">
            </div>
            <div class="col-12">
              <label class="form-label small fw-semibold" for="catatan_medis">Catatan medis *</label>
              <input id="catatan_medis" type="text" name="catatan_medis" class="form-control" style="border-radius:50px" placeholder="mis. Sehat / alergi ayam" required maxlength="100">
            </div>
          </div>
          <button type="submit" class="btn btn-primary-petopia w-100 mt-3"><i class="bi bi-plus-lg me-1"></i> Simpan hewan</button>
        </form>
      </div>
    </div>
    <div class="col-12 col-lg-5 d-flex flex-column gap-3">
      <div class="card-soft p-4">
        <h6 class="fw-bold mb-3"><i class="bi bi-info-circle me-1" style="color:var(--green)"></i> Kenapa wajib?</h6>
        <div class="timeline small">
          <div class="tl-item"><div class="fw-semibold">Dosis & penanganan tepat</div><div class="muted">Dokter butuh jenis, ras, dan umur hewan.</div></div>
          <div class="tl-item"><div class="fw-semibold">Syarat booking</div><div class="muted">Satu pesanan terhubung ke satu hewan.</div></div>
          <div class="tl-item"><div class="fw-semibold">Bisa banyak hewan</div><div class="muted">Tambahkan semua anabul dalam satu akun.</div></div>
        </div>
        <a href="layanan.php" class="btn btn-ghost w-100 mt-1"><i class="bi bi-bag-heart me-1"></i> Lihat layanan</a>
      </div>
    </div>
  </div>

  <?php require BASE_PATH . '/app/Views/partials/footer.php'; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
