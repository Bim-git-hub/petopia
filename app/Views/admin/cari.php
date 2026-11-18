<?php $judul = 'Cari "' . $q . '" - Admin Petopia'; $menuAktif = ''; require BASE_PATH . '/app/Views/partials/admin_top.php'; ?>
<?php $total = count($klien) + count($layanan) + count($pesanan); ?>

    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
      <div>
        <h5 class="fw-bold mb-0" style="letter-spacing:-.02em"><i class="bi bi-search me-1" style="color:var(--green)"></i> Hasil cari: “<?php echo htmlspecialchars($q); ?>” (<?php echo $total; ?>)</h5>
        <div class="small text-muted"><?php echo count($klien); ?> klien · <?php echo count($layanan); ?> layanan · <?php echo count($pesanan); ?> pesanan</div>
      </div>
      <a href="admin_dashboard.php" class="btn btn-ghost btn-sm"><i class="bi bi-arrow-left me-1"></i> Dashboard</a>
    </div>

    <?php if ($total === 0): ?>
    <div class="card-soft p-5 text-center">
      <div class="service-icon mx-auto mb-3" style="position:static;width:52px;height:52px;font-size:1.4rem;background:var(--green-soft);color:var(--green)"><i class="bi bi-search"></i></div>
      <div class="fw-bold mb-1">Tidak ada hasil</div>
      <div class="small muted">Coba kata kunci lain — nama, email, telepon, layanan, atau kode pesanan.</div>
    </div>
    <?php endif; ?>

    <?php if (!empty($klien)): ?>
    <div class="card-soft overflow-hidden mb-3">
      <div class="p-3 px-4 border-bottom d-flex justify-content-between align-items-center" style="background:#fcfdfc">
        <h6 class="fw-bold mb-0"><i class="bi bi-people me-1" style="color:var(--green)"></i> Klien (<?php echo count($klien); ?>)</h6>
        <a href="admin_klien.php" class="small fw-semibold" style="color:var(--green);text-decoration:none">Kelola →</a>
      </div>
      <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
          <tbody style="font-size:.88rem">
            <?php foreach ($klien as $k): ?>
            <tr>
              <td class="ps-4"><div class="fw-semibold"><?php echo htmlspecialchars($k['nama_lengkap']); ?></div><div class="text-muted" style="font-size:.78rem">ID #<?php echo (int) $k['id_pengguna']; ?></div></td>
              <td class="text-muted"><?php echo htmlspecialchars($k['email'] ?? ''); ?></td>
              <td class="text-muted"><?php echo htmlspecialchars($k['no_telepon']); ?></td>
              <td class="text-end pe-4"><a href="admin_klien.php" class="btn btn-ghost btn-sm" style="padding:.3rem .6rem" title="Kelola"><i class="bi bi-arrow-right"></i></a></td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
    <?php endif; ?>

    <?php if (!empty($layanan)): ?>
    <div class="card-soft overflow-hidden mb-3">
      <div class="p-3 px-4 border-bottom d-flex justify-content-between align-items-center" style="background:#fcfdfc">
        <h6 class="fw-bold mb-0"><i class="bi bi-bag-heart me-1" style="color:var(--green)"></i> Layanan (<?php echo count($layanan); ?>)</h6>
        <a href="admin_layanan.php" class="small fw-semibold" style="color:var(--green);text-decoration:none">Kelola →</a>
      </div>
      <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
          <tbody style="font-size:.88rem">
            <?php foreach ($layanan as $l): ?>
            <tr>
              <td class="ps-4"><div class="fw-semibold"><?php echo htmlspecialchars($l['nama_layanan']); ?></div><div class="text-muted" style="font-size:.78rem"><?php echo htmlspecialchars($l['deskripsi'] ?? ''); ?></div></td>
              <td class="fw-semibold" style="white-space:nowrap">Rp <?php echo number_format((int) $l['harga_perhari'], 0, ',', '.'); ?></td>
              <td class="text-end pe-4"><a href="admin_layanan.php?edit=<?php echo (int) $l['id_pelayanan']; ?>" class="btn btn-ghost btn-sm" style="padding:.3rem .6rem" title="Ubah"><i class="bi bi-pencil"></i></a></td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
    <?php endif; ?>

    <?php if (!empty($pesanan)): ?>
    <div class="card-soft overflow-hidden mb-3">
      <div class="p-3 px-4 border-bottom d-flex justify-content-between align-items-center" style="background:#fcfdfc">
        <h6 class="fw-bold mb-0"><i class="bi bi-receipt me-1" style="color:var(--green)"></i> Pesanan (<?php echo count($pesanan); ?>)</h6>
        <a href="admin_pesanan.php" class="small fw-semibold" style="color:var(--green);text-decoration:none">Kelola →</a>
      </div>
      <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
          <tbody style="font-size:.88rem">
            <?php foreach ($pesanan as $p): ?>
            <tr>
              <td class="ps-4 fw-semibold">#<?php echo (int) $p['id_booking']; ?></td>
              <td><div class="fw-semibold"><?php echo htmlspecialchars($p['nama_layanan']); ?></div><div class="text-muted" style="font-size:.78rem"><?php echo htmlspecialchars($p['nama_lengkap']); ?> · <?php echo htmlspecialchars($p['nama_hewan'] !== '' ? $p['nama_hewan'] : '(Tanpa nama)'); ?></div></td>
              <td><span class="badge-pill" style="<?php echo htmlspecialchars(BookingModel::statusStyle($p['status_booking'])); ?>"><?php echo htmlspecialchars(BookingModel::statusLabel($p['status_booking'])); ?></span></td>
              <td class="text-end pe-4"><a href="admin_pesanan.php" class="btn btn-ghost btn-sm" style="padding:.3rem .6rem" title="Kelola"><i class="bi bi-arrow-right"></i></a></td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
    <?php endif; ?>

  <?php require BASE_PATH . '/app/Views/partials/footer.php'; ?>
<?php require BASE_PATH . '/app/Views/partials/admin_foot.php'; ?>
