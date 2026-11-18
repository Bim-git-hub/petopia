<?php $judul = 'Layanan - Admin Petopia'; $menuAktif = 'layanan'; require BASE_PATH . '/app/Views/partials/admin_top.php'; ?>
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
      <div>
        <h5 class="fw-bold mb-0" style="letter-spacing:-.02em"><i class="bi bi-bag-heart me-1" style="color:var(--green)"></i> Kelola Layanan (<?php echo count($layanan); ?>)</h5>
        <div class="small text-muted">Tampil otomatis di katalog klien. Layanan yang sudah dipakai pesanan tidak bisa dihapus.</div>
      </div>
    </div>

    <div class="row g-3">
      <div class="col-12 col-xl-8">
        <div class="card-soft overflow-hidden h-100">
          <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
              <thead><tr><th class="ps-4">Layanan</th><th>Harga</th><th>Dipakai</th><th class="text-end pe-4">Aksi</th></tr></thead>
              <tbody style="font-size:.88rem">
                <?php if (empty($layanan)): ?>
                <tr><td colspan="4" class="text-center text-muted py-4">Belum ada layanan. Tambahkan lewat formulir.</td></tr>
                <?php endif; ?>
                <?php foreach ($layanan as $l): ?>
                <tr>
                  <td class="ps-4">
                    <div class="fw-semibold"><?php echo htmlspecialchars($l['nama_layanan']); ?></div>
                    <div class="text-muted" style="font-size:.78rem"><?php echo htmlspecialchars($l['deskripsi'] ?? ''); ?></div>
                  </td>
                  <td class="fw-semibold" style="white-space:nowrap">Rp <?php echo number_format((int) $l['harga_perhari'], 0, ',', '.'); ?></td>
                  <td><?php echo (int) $l['dipakai']; ?>× pesanan</td>
                  <td class="text-end pe-4" style="white-space:nowrap">
                    <a href="admin_layanan.php?edit=<?php echo (int) $l['id_pelayanan']; ?>" class="btn btn-ghost btn-sm" style="padding:.3rem .6rem" title="Ubah"><i class="bi bi-pencil"></i></a>
                    <a href="hapus_layanan.php?id=<?php echo (int) $l['id_pelayanan']; ?>" class="btn btn-ghost btn-sm" style="padding:.3rem .6rem" title="Hapus" onclick="return confirm('Hapus layanan ini?')"><i class="bi bi-trash"></i></a>
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
          <h6 class="fw-bold mb-3"><i class="bi bi-<?php echo $edit ? 'pencil' : 'plus-lg'; ?> me-1" style="color:var(--green)"></i> <?php echo $edit ? 'Ubah layanan' : 'Tambah layanan'; ?></h6>
          <form action="proses_layanan.php" method="POST">
            <?php if ($edit): ?>
            <input type="hidden" name="id_pelayanan" value="<?php echo (int) $edit['id_pelayanan']; ?>">
            <?php endif; ?>
            <div class="mb-2">
              <label class="form-label small fw-semibold" for="nama_layanan">Nama *</label>
              <input id="nama_layanan" type="text" name="nama_layanan" class="form-control" style="border-radius:50px" required maxlength="100" placeholder="mis. Grooming Kucing" value="<?php echo htmlspecialchars($edit['nama_layanan'] ?? ''); ?>">
            </div>
            <div class="mb-2">
              <label class="form-label small fw-semibold" for="deskripsi">Deskripsi</label>
              <input id="deskripsi" type="text" name="deskripsi" class="form-control" style="border-radius:50px" maxlength="256" placeholder="mis. Mandi + potong kuku" value="<?php echo htmlspecialchars($edit['deskripsi'] ?? ''); ?>">
            </div>
            <div class="mb-3">
              <label class="form-label small fw-semibold" for="harga_perhari">Harga (Rp) *</label>
              <input id="harga_perhari" type="number" name="harga_perhari" class="form-control" style="border-radius:50px" required min="1" step="500" placeholder="mis. 80000" value="<?php echo $edit ? (int) $edit['harga_perhari'] : ''; ?>">
            </div>
            <button type="submit" class="btn btn-primary-petopia w-100"><i class="bi bi-check-lg me-1"></i> <?php echo $edit ? 'Simpan perubahan' : 'Tambah layanan'; ?></button>
            <?php if ($edit): ?>
            <a href="admin_layanan.php" class="btn btn-ghost w-100 mt-2">Batal</a>
            <?php endif; ?>
          </form>
          <div class="small text-muted mt-3" style="font-size:.76rem">Kategori, durasi & gambar katalog mengikuti nama layanan yang dikenal (<i>Grooming Reguler, Vaksin & Check-up,</i> dst). Nama baru tampil dengan tampilan generik.</div>
        </div>
      </div>
    </div>

  <?php require BASE_PATH . '/app/Views/partials/footer.php'; ?>
<?php require BASE_PATH . '/app/Views/partials/admin_foot.php'; ?>
