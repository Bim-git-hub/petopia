<?php $judul = 'Dashboard Admin - Petopia'; $menuAktif = 'dashboard'; require BASE_PATH . '/app/Views/partials/admin_top.php'; ?>
    <!-- hero -->
    <div class="hero p-4 p-md-4 mb-4 d-flex flex-wrap gap-3 align-items-center justify-content-between">
      <div style="position:relative;z-index:1;min-width:240px">
        <div style="display:inline-flex;align-items:center;gap:6px;background:rgba(255,255,255,.16);border:1px solid rgba(255,255,255,.22);border-radius:50px;padding:5px 10px;font-size:.72rem;font-weight:700;letter-spacing:.06em;text-transform:uppercase"><i class="bi bi-stars"></i> Kelola Petopia</div>
        <h4 class="fw-bold mt-3 mb-1" style="letter-spacing:-.02em">Halo, <?php echo htmlspecialchars($_SESSION['nama']); ?> — siap merawat hari ini?</h4>
        <p class="mb-3" style="opacity:.9;font-size:.9rem;max-width:520px">Pantau klien, layanan, dan pesanan dalam satu tempat.</p>
        <div class="d-flex flex-wrap gap-2">
          <a href="admin_layanan.php" class="btn btn-light" style="border-radius:50px;font-weight:700;color:var(--green);padding:.5rem 1rem;font-size:.86rem"><i class="bi bi-plus-lg me-1"></i> Tambah Layanan</a>
          <a href="admin_pesanan.php" class="btn" style="border-radius:50px;font-weight:600;color:#fff;border:1.5px solid rgba(255,255,255,.6);padding:.5rem 1rem;font-size:.86rem">Lihat Pesanan</a>
        </div>
      </div>
      <div class="d-none d-md-flex align-items-center justify-content-center" style="position:relative;z-index:1;width:148px;height:96px;border-radius:18px;background:rgba(255,255,255,.14);border:1px solid rgba(255,255,255,.18);backdrop-filter:blur(6px)"><i class="bi bi-heart-pulse" style="font-size:2.6rem;opacity:.95"></i></div>
      <svg class="wave d-none d-lg-block" width="220" height="120" viewBox="0 0 220 120" fill="none"><path d="M0 70 Q60 10 120 60 T220 40 L220 120 L0 120 Z" fill="white"/></svg>
    </div>

    <!-- stats -->
    <div class="row g-3 mb-4">
      <div class="col-6 col-xl-3">
        <div class="card-soft stat h-100">
          <div class="d-flex justify-content-between align-items-start mb-3">
            <div class="stat-icon green"><i class="bi bi-people"></i></div>
          </div>
          <div class="kpi"><?php echo (int) $totalKlien; ?></div>
          <div class="small text-muted">Total Klien</div>
          <div class="progress mt-3" style="height:4px;background:#eef0f2"><div class="progress-bar" style="width:68%;background:var(--green)"></div></div>
        </div>
      </div>
      <div class="col-6 col-xl-3">
        <div class="card-soft stat h-100">
          <div class="d-flex justify-content-between align-items-start mb-3">
            <div class="stat-icon blue"><i class="bi bi-receipt"></i></div>
          </div>
          <div class="kpi"><?php echo (int) $pesananBulanIni; ?></div>
          <div class="small text-muted">Pesanan Bulan Ini</div>
          <div class="progress mt-3" style="height:4px;background:#eef0f2"><div class="progress-bar" style="width:52%;background:#2f4a7a"></div></div>
        </div>
      </div>
      <div class="col-6 col-xl-3">
        <div class="card-soft stat h-100">
          <div class="d-flex justify-content-between align-items-start mb-3">
            <div class="stat-icon amber"><i class="bi bi-bag-heart"></i></div>
          </div>
          <div class="kpi"><?php echo (int) $layananAktif; ?></div>
          <div class="small text-muted">Layanan Aktif</div>
          <div class="progress mt-3" style="height:4px;background:#eef0f2"><div class="progress-bar" style="width:74%;background:#c48a2a"></div></div>
        </div>
      </div>
      <div class="col-6 col-xl-3">
        <div class="card-soft stat h-100">
          <div class="d-flex justify-content-between align-items-start mb-3">
            <div class="stat-icon rose"><i class="bi bi-receipt"></i></div>
          </div>
          <div class="kpi"><?php echo (int) $pending; ?></div>
          <div class="small text-muted">Perlu Konfirmasi</div>
          <div class="progress mt-3" style="height:4px;background:#eef0f2"><div class="progress-bar" style="width:41%;background:#c0504d"></div></div>
        </div>
      </div>
    </div>

    <div class="row g-3">
      <!-- table -->
      <div class="col-12 col-xl-8">
        <div class="card-soft overflow-hidden h-100">
          <div class="p-3 px-4 d-flex flex-wrap justify-content-between align-items-center gap-2 border-bottom" style="background:#fcfdfc">
            <h6 class="fw-bold mb-0"><i class="bi bi-table me-1" style="color:var(--green)"></i> Klien Terbaru</h6>
            <div class="d-flex gap-2 align-items-center">
              <input id="cariKlien" type="search" class="form-control form-control-sm d-none" style="border-radius:50px;max-width:200px" placeholder="Ketik nama/email..." aria-label="Filter klien">
              <button id="btnFilterKlien" type="button" class="btn btn-ghost btn-sm"><i class="bi bi-funnel me-1"></i> Filter</button>
              <a href="admin_klien.php" class="btn btn-primary-petopia btn-sm">Lihat Semua</a>
            </div>
          </div>
          <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
              <thead><tr><th class="ps-4">Klien</th><th>Email</th><th>Telepon</th><th>Status</th><th class="text-end pe-4">Aksi</th></tr></thead>
              <tbody id="tblKlienBaru" style="font-size:.88rem">
                <?php if (empty($klienBaru)): ?>
                <tr><td colspan="5" class="text-center text-muted py-3" style="font-size:.82rem">Belum ada klien terdaftar.</td></tr>
                <?php endif; ?>
                <?php $warnaAvatar = ['#5a7d6a','#7a6a9a','#c48a2a','#2f4a7a','#a03d3d']; ?>
                <?php foreach ($klienBaru as $k): ?>
                <?php
                  $kata = preg_split('/\s+/', trim($k['nama_lengkap']));
                  $inisial = strtoupper(substr($kata[0], 0, 1) . (isset($kata[1]) ? substr($kata[1], 0, 1) : ''));
                  $w = $warnaAvatar[(int) $k['id_pengguna'] % count($warnaAvatar)];
                ?>
                <tr>
                  <td class="ps-4"><div class="d-flex align-items-center gap-2"><span class="avatar-sm" style="background:<?php echo $w; ?>"><?php echo htmlspecialchars($inisial); ?></span><div><div class="fw-semibold"><?php echo htmlspecialchars($k['nama_lengkap']); ?></div><div class="text-muted" style="font-size:.78rem">ID #<?php echo (int) $k['id_pengguna']; ?></div></div></div></td>
                  <td class="text-muted"><?php echo htmlspecialchars($k['email'] ?? ''); ?></td>
                  <td class="text-muted"><?php echo htmlspecialchars($k['no_telepon']); ?></td>
                  <td><span class="badge-pill badge-active"><i class="bi bi-check-circle me-1"></i>Aktif</span></td>
                  <td class="text-end pe-4"><a href="admin_klien.php" class="btn btn-ghost btn-sm" style="padding:.3rem .6rem" title="Kelola"><i class="bi bi-three-dots"></i></a></td>
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!-- right -->
      <div class="col-12 col-xl-4 d-flex flex-column gap-3">
        <div class="card-soft p-4">
          <h6 class="fw-bold mb-3"><i class="bi bi-lightning me-1" style="color:var(--green)"></i> Aksi Cepat</h6>
          <div class="d-grid gap-2">
            <a href="admin_klien.php" class="btn btn-primary-petopia"><i class="bi bi-plus-lg me-1"></i> Tambah Klien Manual</a>
            <a href="admin_layanan.php" class="btn btn-ghost"><i class="bi bi-bag-plus me-1"></i> Tambah Layanan</a>
          </div>
        </div>
        <div class="card-soft p-4">
          <h6 class="fw-bold mb-3"><i class="bi bi-activity me-1" style="color:var(--green)"></i> Aktivitas Terbaru</h6>
          <div class="timeline small">
            <?php if (empty($aktivitasTerbaru)): ?>
            <div class="tl-item"><div class="fw-semibold">Belum ada aktivitas</div><div class="text-muted">Ubah status pesanan untuk mulai mencatat.</div></div>
            <?php else: foreach ($aktivitasTerbaru as $l): ?>
            <div class="tl-item">
              <div class="fw-semibold">#<?php echo (int) $l['id_booking']; ?> · <?php echo htmlspecialchars($l['nama_layanan']); ?> → <?php echo htmlspecialchars(BookingModel::statusLabel($l['status_penitipan'])); ?></div>
              <div class="text-muted"><?php echo htmlspecialchars($l['nama_lengkap']); ?> · <?php echo htmlspecialchars(date('d M', strtotime($l['tgl_update']))); ?> · oleh <?php echo htmlspecialchars($l['nama_admin']); ?></div>
            </div>
            <?php endforeach; endif; ?>
          </div>
          <a href="admin_aktivitas.php" class="small fw-semibold" style="color:var(--green);text-decoration:none">Lihat semua aktivitas →</a>
        </div>
        <div class="card-soft p-3 d-flex align-items-center gap-3" style="background:var(--green-soft);border-color:#d6e6db">
          <div class="stat-icon green" style="background:#fff"><i class="bi bi-shield-check"></i></div>
          <div class="small"><div class="fw-bold">Role: Admin</div><div class="text-muted">Akses penuh panel pengelola.</div></div>
        </div>
      </div>
    </div>

  <?php require BASE_PATH . '/app/Views/partials/footer.php'; ?>
<script>
(function(){
  var input = document.getElementById('cariKlien');
  var btnFilter = document.getElementById('btnFilterKlien');
  var rows = document.querySelectorAll('#tblKlienBaru tr');
  if(!input || !btnFilter) return;
  btnFilter.addEventListener('click', function(){
    input.classList.toggle('d-none');
    if(!input.classList.contains('d-none')) input.focus();
    else { input.value = ''; saring(''); }
  });
  input.addEventListener('input', function(){ saring(input.value); });
  function saring(kata){
    kata = kata.toLowerCase();
    rows.forEach(function(tr){
      tr.style.display = tr.innerText.toLowerCase().indexOf(kata) !== -1 ? '' : 'none';
    });
  }
})();
</script>
<?php require BASE_PATH . '/app/Views/partials/admin_foot.php'; ?>
