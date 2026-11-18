<?php $judul = 'Pesanan - Admin Petopia'; $menuAktif = 'pesanan'; require BASE_PATH . '/app/Views/partials/admin_top.php'; ?>
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
      <div>
        <h5 class="fw-bold mb-0" style="letter-spacing:-.02em"><i class="bi bi-receipt me-1" style="color:var(--green)"></i> Daftar Pesanan (<?php echo count($pesanan); ?>)</h5>
        <div class="small text-muted">Ubah status + catatan — otomatis tercatat di jejak status.</div>
      </div>
      <a href="admin_layanan.php" class="btn btn-ghost btn-sm"><i class="bi bi-bag-heart me-1"></i> Kelola Layanan</a>
    </div>

    <div class="card-soft overflow-hidden">
      <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
          <thead><tr><th class="ps-4">Kode</th><th>Klien</th><th>Layanan</th><th>Jadwal</th><th>Total</th><th>Status</th><th class="text-end pe-4">Ubah</th></tr></thead>
          <tbody style="font-size:.86rem">
            <?php if (empty($pesanan)): ?>
            <tr><td colspan="7" class="text-center text-muted py-4">Belum ada pesanan masuk.</td></tr>
            <?php endif; ?>
            <?php foreach ($pesanan as $p): ?>
            <tr>
              <td class="ps-4 fw-semibold">#<?php echo (int) $p['id_booking']; ?></td>
              <td>
                <div class="fw-semibold"><?php echo htmlspecialchars($p['nama_lengkap']); ?></div>
                <div class="text-muted" style="font-size:.78rem"><?php echo htmlspecialchars($p['nama_hewan'] !== '' ? $p['nama_hewan'] : '(Tanpa nama)'); ?> (<?php echo htmlspecialchars($p['jenis_hewan']); ?>)</div>
              </td>
              <td class="text-muted"><?php echo htmlspecialchars($p['nama_layanan']); ?></td>
              <td class="text-muted" style="white-space:nowrap"><?php echo date('d M Y', strtotime($p['tgl_masuk'])); ?> → <?php echo date('d M Y', strtotime($p['tgl_keluar'])); ?></td>
              <td class="fw-semibold" style="white-space:nowrap">Rp <?php echo number_format((int) $p['total_harga'], 0, ',', '.'); ?></td>
              <td><span class="badge-pill" style="<?php echo htmlspecialchars(BookingModel::statusStyle($p['status_booking'])); ?>"><?php echo htmlspecialchars(BookingModel::statusLabel($p['status_booking'])); ?></span></td>
              <td class="text-end pe-4">
                <form action="proses_status.php" method="POST" class="d-flex gap-1 justify-content-end" style="min-width:220px">
                  <input type="hidden" name="id_booking" value="<?php echo (int) $p['id_booking']; ?>">
                  <select name="status_booking" class="form-select form-select-sm" style="border-radius:50px;max-width:150px" required>
                    <?php foreach (['P' => 'Pending', 'K' => 'Dikonfirmasi', 'S' => 'Selesai', 'B' => 'Dibatalkan'] as $kode => $label): ?>
                    <option value="<?php echo $kode; ?>"<?php echo $p['status_booking'] === $kode ? ' selected' : ''; ?>><?php echo $label; ?></option>
                    <?php endforeach; ?>
                  </select>
                  <input type="text" name="catatan_admin" class="form-control form-control-sm d-none d-xl-block" style="border-radius:50px;max-width:150px" placeholder="Catatan..." maxlength="256">
                  <button type="submit" class="btn btn-primary-petopia btn-sm" style="padding:.3rem .7rem" title="Simpan"><i class="bi bi-check-lg"></i></button>
                </form>
              </td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>

  <?php require BASE_PATH . '/app/Views/partials/footer.php'; ?>
<?php require BASE_PATH . '/app/Views/partials/admin_foot.php'; ?>
