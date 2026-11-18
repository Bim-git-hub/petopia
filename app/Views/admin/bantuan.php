<?php $judul = 'Bantuan - Admin Petopia'; $menuAktif = 'bantuan'; require BASE_PATH . '/app/Views/partials/admin_top.php'; ?>

    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
      <div>
        <h5 class="fw-bold mb-0" style="letter-spacing:-.02em"><i class="bi bi-question-circle me-1" style="color:var(--green)"></i> Panduan Panel Admin</h5>
        <div class="small text-muted">Cara memakai setiap menu dalam 1 menit per tugas.</div>
      </div>
    </div>

    <div class="row g-3 mb-4">
      <div class="col-12 col-lg-6">
        <div class="card-soft p-4 h-100">
          <h6 class="fw-bold mb-3"><i class="bi bi-receipt me-1" style="color:var(--green)"></i> Konfirmasi pesanan</h6>
          <div class="timeline small">
            <div class="tl-item"><div class="fw-semibold">1. Buka Pesanan</div><div class="text-muted">Bell di topbar menyala merah bila ada Pending.</div></div>
            <div class="tl-item"><div class="fw-semibold">2. Ubah status + catatan</div><div class="text-muted">Pending → Dikonfirmasi → Selesai (atau Dibatalkan). Tercatat otomatis di jejak status.</div></div>
            <div class="tl-item"><div class="fw-semibold">3. Kabari klien via WhatsApp</div><div class="text-muted">Sistem belum kirim notifikasi otomatis.</div></div>
          </div>
          <a href="admin_pesanan.php" class="btn btn-ghost btn-sm">Buka pesanan →</a>
        </div>
      </div>
      <div class="col-12 col-lg-6">
        <div class="card-soft p-4 h-100">
          <h6 class="fw-bold mb-3"><i class="bi bi-bag-heart me-1" style="color:var(--green)"></i> Kelola layanan & klien</h6>
          <div class="timeline small">
            <div class="tl-item"><div class="fw-semibold">Tambah/ubah layanan</div><div class="text-muted">Nama + harga wajib. Nama baru tampil generik di katalog (tanpa kategori/gambar khusus).</div></div>
            <div class="tl-item"><div class="fw-semibold">Hapus aman</div><div class="text-muted">Layanan/hewan/klien yang sudah dipakai pesanan otomatis ditolak.</div></div>
            <div class="tl-item"><div class="fw-semibold">Cari cepat</div><div class="text-muted">Kotak cari topbar mencari klien, layanan, dan pesanan sekaligus.</div></div>
          </div>
          <div class="d-flex gap-2 flex-wrap">
            <a href="admin_layanan.php" class="btn btn-ghost btn-sm">Layanan →</a>
            <a href="admin_klien.php" class="btn btn-ghost btn-sm">Klien →</a>
          </div>
        </div>
      </div>
      <div class="col-12">
        <div class="card-soft p-4">
          <h6 class="fw-bold mb-3"><i class="bi bi-info-circle me-1" style="color:var(--green)"></i> Arti status pesanan</h6>
          <div class="d-flex gap-2 flex-wrap small">
            <span class="badge-pill" style="background:#fff7e6;border-color:#fde2b8;color:#8a5a12">P — Pending: menunggu konfirmasi</span>
            <span class="badge-pill" style="background:#e6f0ff;border-color:#bcd3f5;color:#2f4a7a">K — Dikonfirmasi: jadwal disepakati</span>
            <span class="badge-pill" style="background:var(--green-soft);border-color:#d6e6db;color:var(--green)">S — Selesai: layanan sudah diberikan</span>
            <span class="badge-pill" style="background:#fdeeee;border-color:#f5c6c6;color:#a03d3d">B — Dibatalkan: pesanan batal</span>
          </div>
          <div class="small text-muted mt-3">Aturan harga: sesi = flat · harian = tarif × hari · mingguan = tarif × minggu berjalan (per 7 hari). Booking baru selalu memakai admin pertama sebagai penanggung jawab.</div>
        </div>
      </div>
    </div>

  <?php require BASE_PATH . '/app/Views/partials/footer.php'; ?>
<?php require BASE_PATH . '/app/Views/partials/admin_foot.php'; ?>
