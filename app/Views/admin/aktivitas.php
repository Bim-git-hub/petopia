<?php $judul = 'Semua Aktivitas - Admin Petopia'; $menuAktif = ''; require BASE_PATH . '/app/Views/partials/admin_top.php'; ?>
<?php
$opsi = [
    '' => 'Semua',
    'P' => 'Pending',
    'K' => 'Dikonfirmasi',
    'S' => 'Selesai',
    'B' => 'Dibatalkan',
];
?>

    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
      <div>
        <h5 class="fw-bold mb-0" style="letter-spacing:-.02em"><i class="bi bi-activity me-1" style="color:var(--green)"></i> Semua Aktivitas</h5>
        <div class="small text-muted">Riwayat perubahan status pesanan — terbaru dulu (maks 100).</div>
      </div>
      <a href="admin_dashboard.php" class="btn btn-ghost btn-sm"><i class="bi bi-arrow-left me-1"></i> Dashboard</a>
    </div>

    <div class="d-flex flex-wrap gap-2 mb-3">
      <?php foreach ($opsi as $k => $label): $aktif = ($filter === $k); ?>
      <a href="admin_aktivitas.php<?php echo $k !== '' ? '?status=' . $k : ''; ?>" class="btn btn-sm <?php echo $aktif ? 'btn-primary-petopia' : 'btn-ghost'; ?>" style="border-radius:999px">
        <?php if ($k !== ''): ?><span class="badge-pill me-1" style="<?php echo htmlspecialchars(BookingModel::statusStyle($k)); ?>"><?php echo $k; ?></span><?php endif; ?><?php echo $label; ?>
      </a>
      <?php endforeach; ?>
    </div>

    <div class="card-soft p-4 mb-3">
      <?php if (empty($logs)): ?>
        <div class="text-center py-3">
          <div class="fw-bold mb-1">Belum ada aktivitas</div>
          <div class="small muted">Ubah status pesanan di halaman Pesanan untuk mulai mencatat riwayat.</div>
        </div>
      <?php else: ?>
      <div class="timeline small">
        <?php foreach ($logs as $l): ?>
        <div class="tl-item">
          <div class="fw-semibold">
            #<?php echo (int) $l['id_booking']; ?> · <?php echo htmlspecialchars($l['nama_layanan']); ?> →
            <span class="badge-pill" style="<?php echo htmlspecialchars(BookingModel::statusStyle($l['status_penitipan'])); ?>"><?php echo htmlspecialchars(BookingModel::statusLabel($l['status_penitipan'])); ?></span>
          </div>
          <div class="text-muted">
            <?php echo htmlspecialchars($l['nama_lengkap']); ?> · <?php echo htmlspecialchars($l['nama_hewan'] !== '' ? $l['nama_hewan'] : '(Tanpa nama)'); ?>
            · <?php echo htmlspecialchars(date('d M Y', strtotime($l['tgl_update']))); ?> · oleh <?php echo htmlspecialchars($l['nama_admin']); ?>
          </div>
          <?php if (!empty($l['catatan_admin'])): ?><div class="text-muted fst-italic" style="font-size:.78rem">“<?php echo htmlspecialchars($l['catatan_admin']); ?>”</div><?php endif; ?>
        </div>
        <?php endforeach; ?>
      </div>
      <?php endif; ?>
    </div>

  <?php require BASE_PATH . '/app/Views/partials/footer.php'; ?>
<?php require BASE_PATH . '/app/Views/partials/admin_foot.php'; ?>
