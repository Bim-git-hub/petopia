<?php $judul = 'Pengaturan - Admin Petopia'; $menuAktif = 'pengaturan'; require BASE_PATH . '/app/Views/partials/admin_top.php'; ?>
<?php $akun = $akun ?? null; ?>

    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
      <div>
        <h5 class="fw-bold mb-0" style="letter-spacing:-.02em"><i class="bi bi-gear me-1" style="color:var(--green)"></i> Pengaturan</h5>
        <div class="small text-muted">Profil dan keamanan akun admin.</div>
      </div>
      <a href="admin_dashboard.php" class="btn btn-ghost btn-sm"><i class="bi bi-arrow-left me-1"></i> Dashboard</a>
    </div>

    <div class="row g-3">
      <div class="col-12 col-lg-7">
        <div class="card-soft p-4">
          <h6 class="fw-bold mb-1"><i class="bi bi-person me-1" style="color:var(--green)"></i> Profil Admin</h6>
          <div class="small text-muted mb-3">Nama tampil di sidebar, topbar, dan catatan aktivitas.</div>
          <form action="proses_pengaturan.php" method="POST" autocomplete="off">
            <input type="hidden" name="aksi" value="profil">
            <div class="row g-3">
              <div class="col-12 col-md-6">
                <label class="form-label small fw-semibold" for="nama_admin">Nama lengkap *</label>
                <input id="nama_admin" type="text" name="nama_admin" class="form-control" style="border-radius:50px" required maxlength="100" value="<?php echo htmlspecialchars($akun['nama_admin'] ?? ''); ?>">
              </div>
              <div class="col-12 col-md-6">
                <label class="form-label small fw-semibold" for="username">Username login *</label>
                <input id="username" type="text" name="username" class="form-control" style="border-radius:50px" required maxlength="50" value="<?php echo htmlspecialchars($akun['username'] ?? ''); ?>">
              </div>
              <div class="col-12 col-md-6">
                <label class="form-label small fw-semibold" for="no_telepon_admin">No. telepon *</label>
                <input id="no_telepon_admin" type="text" name="no_telepon_admin" class="form-control" style="border-radius:50px" required maxlength="15" pattern="[0-9]{6,15}" placeholder="mis. 08123456789" value="<?php echo htmlspecialchars($akun['no_telepon_admin'] ?? ''); ?>">
              </div>
              <div class="col-12 col-md-6">
                <label class="form-label small fw-semibold" for="jabatan">Jabatan *</label>
                <input id="jabatan" type="text" name="jabatan" class="form-control" style="border-radius:50px" required maxlength="50" placeholder="mis. Administrator" value="<?php echo htmlspecialchars($akun['jabatan'] ?? ''); ?>">
              </div>
            </div>
            <div class="d-flex justify-content-end mt-3">
              <button type="submit" class="btn btn-primary-petopia"><i class="bi bi-check-lg me-1"></i> Simpan Profil</button>
            </div>
          </form>
        </div>
      </div>

      <div class="col-12 col-lg-5 d-flex flex-column gap-3">
        <div class="card-soft p-4">
          <h6 class="fw-bold mb-1"><i class="bi bi-shield-lock me-1" style="color:var(--green)"></i> Ganti Password</h6>
          <div class="small text-muted mb-3">Password lama wajib dikonfirmasi.</div>
          <form action="proses_pengaturan.php" method="POST" autocomplete="off">
            <input type="hidden" name="aksi" value="password">
            <div class="mb-3">
              <label class="form-label small fw-semibold" for="password_lama">Password lama *</label>
              <input id="password_lama" type="password" name="password_lama" class="form-control" style="border-radius:50px" required maxlength="256">
            </div>
            <div class="mb-3">
              <label class="form-label small fw-semibold" for="password_baru">Password baru * (min 6)</label>
              <input id="password_baru" type="password" name="password_baru" class="form-control" style="border-radius:50px" required minlength="6" maxlength="256">
            </div>
            <div class="mb-3">
              <label class="form-label small fw-semibold" for="password_ulangi">Ulangi password baru *</label>
              <input id="password_ulangi" type="password" name="password_ulangi" class="form-control" style="border-radius:50px" required minlength="6" maxlength="256">
            </div>
            <div class="d-flex justify-content-end">
              <button type="submit" class="btn btn-primary-petopia"><i class="bi bi-key me-1"></i> Ganti Password</button>
            </div>
          </form>
        </div>

        <div class="card-soft p-4">
          <h6 class="fw-bold mb-3"><i class="bi bi-badge-info me-1" style="color:var(--green)"></i> Info Akun</h6>
          <div class="small d-flex flex-column gap-2">
            <div class="d-flex justify-content-between"><span class="text-muted">ID Admin</span><span class="fw-semibold">#<?php echo (int) ($akun['id_admin'] ?? 0); ?></span></div>
            <div class="d-flex justify-content-between"><span class="text-muted">Role</span><span class="badge-pill" style="background:var(--green-soft);border-color:#d6e6db;color:var(--green)">Admin</span></div>
            <div class="d-flex justify-content-between"><span class="text-muted">Jabatan</span><span class="fw-semibold"><?php echo htmlspecialchars($akun['jabatan'] ?? '-'); ?></span></div>
          </div>
        </div>
      </div>
    </div>

  <?php require BASE_PATH . '/app/Views/partials/footer.php'; ?>
<?php require BASE_PATH . '/app/Views/partials/admin_foot.php'; ?>
