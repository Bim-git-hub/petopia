<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Bantuan - Petopia</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?php echo asset('asset/css/klien.css'); ?>">
</head>
<body>

<?php $menuAktif = 'bantuan'; require BASE_PATH . '/app/Views/partials/nav_klien.php'; ?>

<div class="container py-4">

  <div class="card-soft p-4 mb-4 layanan-head">
    <span class="eyebrow"><i class="bi bi-chat-dots me-1"></i> Pusat bantuan</span>
    <h4 class="fw-bold mb-1 mt-2" style="font-family:Outfit,sans-serif;letter-spacing:-.02em">Ada yang bisa dibantu?</h4>
    <div class="small muted">Jawaban cepat + kontak langsung tim Petopia (08:00–20:00).</div>
  </div>

  <div class="row g-3 mb-4">
    <div class="col-12 col-lg-7">
      <div class="accordion" id="faqPetopia">
        <div class="accordion-item" style="border-radius:16px;overflow:hidden;margin-bottom:10px;border:1px solid var(--line)">
          <h2 class="accordion-header"><button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">Bagaimana cara memesan layanan?</button></h2>
          <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqPetopia"><div class="accordion-body small muted">Buka Layanan → klik Pesan → pilih hewan & tanggal → Buat pesanan. Status awal Pending sampai dikonfirmasi admin.</div></div>
        </div>
        <div class="accordion-item" style="border-radius:16px;overflow:hidden;margin-bottom:10px;border:1px solid var(--line)">
          <h2 class="accordion-header"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">Bagaimana cara bayar?</button></h2>
          <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqPetopia"><div class="accordion-body small muted">Bayar di tempat saat tiba di Petopia. Tunjukkan kode pesanan (mis. #12) dari halaman Pesanan Saya.</div></div>
        </div>
        <div class="accordion-item" style="border-radius:16px;overflow:hidden;margin-bottom:10px;border:1px solid var(--line)">
          <h2 class="accordion-header"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">Bagaimana hitungan harga penitipan?</button></h2>
          <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqPetopia"><div class="accordion-body small muted">Penitipan Harian: tarif × jumlah hari. Pet Hotel: tarif × minggu berjalan (1–7 hari dihitung 1 minggu). Grooming & klinik: tarif flat sekali sesi.</div></div>
        </div>
        <div class="accordion-item" style="border-radius:16px;overflow:hidden;margin-bottom:10px;border:1px solid var(--line)">
          <h2 class="accordion-header"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">Bisakah membatalkan pesanan?</button></h2>
          <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqPetopia"><div class="accordion-body small muted">Bisa, selama status masih Pending/Dikonfirmasi — hubungi admin via WhatsApp dengan menyebut kode pesanan.</div></div>
        </div>
        <div class="accordion-item" style="border-radius:16px;overflow:hidden;margin-bottom:10px;border:1px solid var(--line)">
          <h2 class="accordion-header"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq5">Apakah penitipan dipantau CCTV?</button></h2>
          <div id="faq5" class="accordion-collapse collapse" data-bs-parent="#faqPetopia"><div class="accordion-body small muted">Ya, area penitipan terpantau CCTV 24 jam. Laporan harian + video call sore untuk paket mingguan.</div></div>
        </div>
      </div>
    </div>
    <div class="col-12 col-lg-5 d-flex flex-column gap-3">
      <div class="card-soft p-4">
        <div class="d-flex align-items-center gap-3 mb-3">
          <div class="service-icon" style="position:static;background:var(--green-soft);color:var(--green)"><i class="bi bi-headset"></i></div>
          <div style="min-width:0">
            <div class="fw-bold">Masih buntu?</div>
            <div class="small muted">Chat admin, balasan menit di jam operasional.</div>
          </div>
        </div>
        <a href="https://wa.me/6285242539520" target="_blank" rel="noopener" class="btn btn-primary-petopia w-100"><i class="bi bi-whatsapp me-1"></i> Chat WhatsApp</a>
        <div class="small muted mt-2 text-center" style="font-size:.76rem">Senin–Minggu · 08:00–20:00</div>
      </div>
      <div class="card-soft p-3 d-flex align-items-center gap-3" style="background:var(--green-soft);border-color:#d6e6db">
        <div class="service-icon" style="background:#fff;color:var(--green);position:static"><i class="bi bi-file-text"></i></div>
        <div class="small"><div class="fw-bold">Syarat & Ketentuan</div><div class="muted"><a href="syarat.php" style="color:var(--green);font-weight:600;text-decoration:none">Baca S&K →</a></div></div>
      </div>
    </div>
  </div>

  <?php require BASE_PATH . '/app/Views/partials/footer.php'; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
