<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Pesan Layanan - Petopia</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?php echo asset('asset/css/klien.css'); ?>">
</head>
<body>

<?php $menuAktif = 'layanan'; require BASE_PATH . '/app/Views/partials/nav_klien.php'; ?>

<div class="container py-4">

  <div class="card-soft p-4 mb-4 layanan-head">
    <span class="eyebrow"><i class="bi bi-bag-plus me-1"></i> Form pemesanan</span>
    <h4 class="fw-bold mb-1 mt-2" style="font-family:Outfit,sans-serif;letter-spacing:-.02em">Pesan: <?php echo htmlspecialchars($dipilih['nama_layanan']); ?></h4>
    <div class="small muted"><?php echo htmlspecialchars($dipilih['harga_label']); ?><?php echo $dipilih['meta']['durasi'] !== '' ? ' · ' . htmlspecialchars($dipilih['meta']['durasi']) : ''; ?> · Status awal: <span class="badge-soft">Pending</span></div>
  </div>

  <div class="row g-3 mb-4">
    <div class="col-12 col-lg-7">
      <div class="card-soft p-4 h-100">
        <h6 class="fw-bold mb-3"><i class="bi bi-pencil-square me-1" style="color:var(--green)"></i> Detail pesanan</h6>
        <form action="proses_pesan.php" method="POST" id="formPesan">
          <div class="mb-3">
            <label class="form-label small fw-semibold" for="id_pelayanan">Layanan *</label>
            <select id="id_pelayanan" name="id_pelayanan" class="form-select" style="border-radius:50px" required>
              <?php foreach ($layanan as $l): ?>
              <option value="<?php echo (int) $l['id_pelayanan']; ?>" data-harga="<?php echo (int) $l['harga_perhari']; ?>" data-satuan="<?php echo htmlspecialchars($l['meta']['satuan']); ?>"<?php echo (int) $l['id_pelayanan'] === (int) $dipilih['id_pelayanan'] ? ' selected' : ''; ?>><?php echo htmlspecialchars($l['nama_layanan']); ?> — <?php echo htmlspecialchars($l['harga_label']); ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label small fw-semibold" for="id_peliharaan">Hewan *</label>
            <select id="id_peliharaan" name="id_peliharaan" class="form-select" style="border-radius:50px" required>
              <?php foreach ($hewan as $h): ?>
              <option value="<?php echo (int) $h['id_peliharaan']; ?>"><?php echo htmlspecialchars($h['nama_hewan'] !== '' ? $h['nama_hewan'] : '(Tanpa nama)'); ?> — <?php echo htmlspecialchars($h['jenis_hewan']); ?> · <?php echo htmlspecialchars($h['ras']); ?></option>
              <?php endforeach; ?>
            </select>
            <div class="small mt-1"><a href="hewan.php" class="link-muted" style="font-size:.78rem">+ Tambah / ubah data hewan</a></div>
          </div>
          <div class="row g-2">
            <div class="col-6">
              <label class="form-label small fw-semibold" for="tgl_masuk">Tanggal masuk *</label>
              <input id="tgl_masuk" type="date" name="tgl_masuk" class="form-control" style="border-radius:50px" required min="<?php echo date('Y-m-d'); ?>" value="<?php echo date('Y-m-d'); ?>">
            </div>
            <div class="col-6">
              <label class="form-label small fw-semibold" for="tgl_keluar">Tanggal keluar *</label>
              <input id="tgl_keluar" type="date" name="tgl_keluar" class="form-control" style="border-radius:50px" required min="<?php echo date('Y-m-d'); ?>" value="<?php echo date('Y-m-d'); ?>">
            </div>
          </div>
          <div class="small muted mt-2" style="font-size:.78rem">Sesi (grooming/klinik): tarif flat. Harian: tarif × jumlah hari. Mingguan: tarif × jumlah minggu berjalan (per 7 hari).</div>
          <button type="submit" class="btn btn-primary-petopia w-100 mt-3"><i class="bi bi-check-lg me-1"></i> Buat pesanan</button>
        </form>
      </div>
    </div>
    <div class="col-12 col-lg-5 d-flex flex-column gap-3">
      <div class="card-soft p-4">
        <div class="d-flex align-items-center gap-3 mb-3">
          <div class="service-icon" style="position:static;background:var(--green-soft);color:<?php echo htmlspecialchars($dipilih['meta']['warna']); ?>"><i class="bi <?php echo htmlspecialchars($dipilih['meta']['ikon']); ?>"></i></div>
          <div style="min-width:0">
            <div class="fw-bold"><?php echo htmlspecialchars($dipilih['nama_layanan']); ?></div>
            <div class="small muted"><?php echo htmlspecialchars($dipilih['deskripsi'] ?? ''); ?></div>
          </div>
        </div>
        <div class="d-flex justify-content-between align-items-center p-3" style="background:#f8f9f6;border-radius:16px;border:1px solid var(--line)">
          <span class="small muted">Estimasi total</span>
          <span class="price" id="estimasi">—</span>
        </div>
        <div class="small muted mt-2" id="estimasiNote" style="font-size:.78rem"></div>
      </div>
      <div class="card-soft p-3 d-flex align-items-center gap-3" style="background:var(--green-soft);border-color:#d6e6db">
        <div class="service-icon" style="background:#fff;color:var(--green);position:static"><i class="bi bi-shield-check"></i></div>
        <div class="small"><div class="fw-bold">Bayar di tempat</div><div class="muted">Tunjukkan pesanan saat tiba di Petopia.</div></div>
      </div>
    </div>
  </div>

  <?php require BASE_PATH . '/app/Views/partials/footer.php'; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
function rupiah(n){ return 'Rp ' + n.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.'); }
function hitungEstimasi(){
  var opt = document.getElementById('id_pelayanan').selectedOptions[0];
  var harga = parseInt(opt.dataset.harga || '0', 10);
  var satuan = opt.dataset.satuan || 'sesi';
  var masuk = document.getElementById('tgl_masuk').value;
  var keluar = document.getElementById('tgl_keluar').value;
  var box = document.getElementById('estimasi'), note = document.getElementById('estimasiNote');
  if(!masuk || !keluar){ box.textContent = '—'; note.textContent = ''; return; }
  var hari = Math.round((new Date(keluar) - new Date(masuk)) / 86400000) + 1;
  if(satuan === 'sesi'){
    box.textContent = rupiah(harga);
    note.textContent = 'Tarif flat sekali sesi (' + opt.text.split(' — ')[0] + ').';
    return;
  }
  if(hari < 1){ box.textContent = '—'; note.textContent = 'Tanggal keluar tidak boleh mundur dari tanggal masuk.'; return; }
  if(satuan === 'minggu'){
    var minggu = Math.max(1, Math.ceil(hari / 7));
    box.textContent = rupiah(harga * minggu);
    note.textContent = rupiah(harga) + ' × ' + minggu + ' minggu (' + hari + ' hari)';
  } else {
    box.textContent = rupiah(harga * hari);
    note.textContent = rupiah(harga) + ' × ' + hari + ' hari';
  }
}
['id_pelayanan','tgl_masuk','tgl_keluar'].forEach(function(id){
  document.getElementById(id).addEventListener('change', hitungEstimasi);
});
hitungEstimasi();
</script>
</body>
</html>
