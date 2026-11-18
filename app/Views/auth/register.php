<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Daftar Akun - Petopia</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@500;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?php echo asset('asset/css/auth.css'); ?>">
</head>
<body class="register">

<div class="top-mini">
  <a class="brand" href="login.php" aria-label="Petopia beranda">
    <img src="<?php echo asset('asset/img/Petopia-01.png'); ?>" alt="Petopia" class="brand-logo">
    <span>
      <span class="brand-name" style="display:block">Petopia</span>
      <span class="brand-sub">Pet care • Grooming • Clinic</span>
    </span>
  </a>
  <a href="login.php" class="small fw-semibold d-none d-sm-inline-flex align-items-center gap-1" style="text-decoration:none;color:var(--muted)">Sudah punya akun? <span style="color:var(--green)">Log in →</span></a>
</div>

<div class="shell">
  <div class="login-wrapper">
    <div class="form-section">
      <span class="eyebrow"><i class="bi bi-stars"></i> Daftar 1 menit — gratis</span>
      <h1>Create account</h1>
      <p class="sub">Buat akun klien untuk pesan grooming, vaksin, dan penitipan lebih cepat.</p>

      <form action="proses_register.php" method="POST" novalidate>
        <div class="field">
          <label class="form-label" for="nama_lengkap">Nama lengkap</label>
          <div class="input-wrap">
            <i class="bi bi-person"></i>
            <input id="nama_lengkap" type="text" name="nama_lengkap" class="form-control custom-input" placeholder="Nama sesuai KTP" required autocomplete="name">
          </div>
        </div>

        <div class="row g-2">
          <div class="col-12 col-sm-7 field">
            <label class="form-label" for="email">Email</label>
            <div class="input-wrap">
              <i class="bi bi-envelope"></i>
              <input id="email" type="email" name="email" class="form-control custom-input" placeholder="nama@email.com" required autocomplete="email">
            </div>
          </div>
          <div class="col-12 col-sm-5 field">
            <label class="form-label" for="no_telepon">No. telepon</label>
            <div class="input-wrap">
              <i class="bi bi-telephone"></i>
              <input id="no_telepon" type="text" name="no_telepon" class="form-control custom-input" placeholder="08xx xxxx xxxx" required autocomplete="tel" inputmode="numeric">
            </div>
          </div>
        </div>

        <div class="field">
          <label class="form-label" for="password">Password</label>
          <div class="input-wrap">
            <i class="bi bi-lock"></i>
            <input id="password" type="password" name="password" class="form-control custom-input" placeholder="Minimal 8 karakter" required autocomplete="new-password">
          </div>
          <div class="hint">Gunakan kombinasi huruf & angka untuk keamanan.</div>
        </div>

        <div class="field">
          <label class="form-label" for="alamat">Alamat lengkap</label>
          <div class="input-wrap textarea">
            <i class="bi bi-geo-alt"></i>
            <textarea id="alamat" name="alamat" class="form-control custom-input" rows="2" placeholder="Jl. Contoh No. 12, Kelurahan, Kota" required></textarea>
          </div>
        </div>

        <label class="small d-flex align-items-start gap-2 mt-2" style="color:#5a645f;font-size:.78rem;line-height:1.4">
          <input type="checkbox" required style="margin-top:3px;accent-color:var(--green)"> Saya setuju dengan <a href="syarat.php" class="link-muted">Syarat & Ketentuan</a> Petopia.
        </label>

        <button type="submit" class="btn btn-custom w-100 mt-3">Daftar sekarang <i class="bi bi-arrow-right"></i></button>
      </form>

      <div class="divider">sudah punya akun?</div>
      <div class="text-center"><a href="login.php" class="link-muted" style="font-size:.88rem">Log in di sini →</a></div>

      <div class="bullets">
        <span><i class="bi bi-lightning"></i> Booking cepat</span>
        <span><i class="bi bi-chat-dots"></i> CS 08.00–20.00</span>
        <span><i class="bi bi-heart"></i> Grooming · Vaksin · Penitipan</span>
      </div>
    </div>

    <div class="image-section" aria-hidden="true">
      <div class="photo"></div>
      <svg class="wave-divider" viewBox="0 0 100 800" preserveAspectRatio="none" focusable="false">
        <path d="M0,0 C60,150 -20,350 40,550 C80,680 0,800 0,800 L0,0 Z" fill="rgba(0,0,0,0.10)" transform="translate(5,0)"/>
        <path d="M0,0 C70,180 -10,380 50,580 C90,700 0,800 0,800 L0,0 Z" fill="rgba(0,0,0,0.05)" transform="translate(10,0)"/>
        <path d="M0,0 C50,150 -30,350 30,550 C70,680 0,800 0,800 L-10,800 L-10,0 Z" fill="#ffffff"/>
      </svg>
      <div class="card-quote">
        <div style="display:flex;align-items:center;gap:10px;margin-bottom:8px">
          <span style="width:34px;height:34px;border-radius:50%;background:var(--green);color:#fff;display:flex;align-items:center;justify-content:center;font-weight:800;font-size:.8rem">B</span>
          <div>
            <div style="font-weight:800;font-size:.84rem;line-height:1">Budi & Cici</div>
            <div style="color:#8a9096;font-size:.74rem;font-weight:600">Penitipan 3 hari · ★★★★★</div>
          </div>
        </div>
        <div style="font-size:.82rem;color:#3a4440;line-height:1.5">"Daftar sebentar, langsung bisa booking. Admin ramah, tempat bersih."</div>
      </div>
    </div>
  </div>
</div>

  <?php require BASE_PATH . '/app/Views/partials/footer.php'; ?>

</body>
</html>
