<?php $judul = 'Klien - Admin Petopia'; $menuAktif = 'klien'; require BASE_PATH . '/app/Views/partials/admin_top.php'; ?>
<?php $warnaAvatar = ['#5a7d6a','#7a6a9a','#c48a2a','#2f4a7a','#a03d3d']; ?>

    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
      <div>
        <h5 class="fw-bold mb-0" style="letter-spacing:-.02em"><i class="bi bi-people me-1" style="color:var(--green)"></i> Kelola Klien (<?php echo count($klien); ?>)</h5>
        <div class="small text-muted">Klien yang masih punya hewan/pesanan tidak bisa dihapus.</div>
      </div>
    </div>

    <div class="row g-3">
      <div class="col-12 col-xl-8">
        <div class="card-soft overflow-hidden h-100">
          <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
              <thead><tr><th class="ps-4">Klien</th><th>Email</th><th>Telepon</th><th>Data</th><th class="text-end pe-4">Aksi</th></tr></thead>
              <tbody style="font-size:.88rem">
                <?php if (empty($klien)): ?>
                <tr><td colspan="5" class="text-center text-muted py-4">Belum ada klien terdaftar.</td></tr>
                <?php endif; ?>
                <?php foreach ($klien as $k): ?>
                <?php
                  $kata = preg_split('/\s+/', trim($k['nama_lengkap']));
                  $inisial = strtoupper(substr($kata[0], 0, 1) . (isset($kata[1]) ? substr($kata[1], 0, 1) : ''));
                  $w = $warnaAvatar[(int) $k['id_pengguna'] % count($warnaAvatar)];
                ?>
                <tr>
                  <td class="ps-4"><div class="d-flex align-items-center gap-2"><span class="avatar-sm" style="background:<?php echo $w; ?>"><?php echo htmlspecialchars($inisial); ?></span><div><div class="fw-semibold"><?php echo htmlspecialchars($k['nama_lengkap']); ?></div><div class="text-muted" style="font-size:.78rem">ID #<?php echo (int) $k['id_pengguna']; ?></div></div></div></td>
                  <td class="text-muted"><?php echo htmlspecialchars($k['email'] ?? ''); ?></td>
                  <td class="text-muted"><?php echo htmlspecialchars($k['no_telepon']); ?></td>
                  <td class="text-muted" style="white-space:nowrap"><?php echo (int) $k['n_hewan']; ?> hewan · <?php echo (int) $k['n_pesanan']; ?> pesanan</td>
                  <td class="text-end pe-4" style="white-space:nowrap">
                    <a href="hapus_klien.php?id=<?php echo (int) $k['id_pengguna']; ?>" class="btn btn-ghost btn-sm" style="padding:.3rem .6rem" title="Hapus" onclick="return confirm('Hapus klien ini?')"><i class="bi bi-trash"></i></a>
                  </td>
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="col-12 col-xl-4">
        <div class="card-soft p-4 h-100">
          <h6 class="fw-bold mb-3"><i class="bi bi-plus-lg me-1" style="color:var(--green)"></i> Tambah klien manual</h6>
          <form action="proses_klien.php" method="POST">
            <div class="mb-2">
              <label class="form-label small fw-semibold" for="nama_lengkap">Nama lengkap *</label>
              <input id="nama_lengkap" type="text" name="nama_lengkap" class="form-control" style="border-radius:50px" required maxlength="100">
            </div>
            <div class="mb-2">
              <label class="form-label small fw-semibold" for="email">Email *</label>
              <input id="email" type="email" name="email" class="form-control" style="border-radius:50px" required maxlength="100">
            </div>
            <div class="mb-2">
              <label class="form-label small fw-semibold" for="password">Password *</label>
              <input id="password" type="text" name="password" class="form-control" style="border-radius:50px" required maxlength="256">
            </div>
            <div class="mb-2">
              <label class="form-label small fw-semibold" for="no_telepon">No. telepon *</label>
              <input id="no_telepon" type="text" name="no_telepon" class="form-control" style="border-radius:50px" required maxlength="15">
            </div>
            <div class="mb-3">
              <label class="form-label small fw-semibold" for="alamat">Alamat *</label>
              <input id="alamat" type="text" name="alamat" class="form-control" style="border-radius:50px" required maxlength="256">
            </div>
            <button type="submit" class="btn btn-primary-petopia w-100"><i class="bi bi-check-lg me-1"></i> Tambah klien</button>
          </form>
        </div>
      </div>
    </div>

  <?php require BASE_PATH . '/app/Views/partials/footer.php'; ?>
<?php require BASE_PATH . '/app/Views/partials/admin_foot.php'; ?>
