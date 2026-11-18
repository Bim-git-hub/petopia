<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login - Petopia</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@500;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?php echo asset('asset/css/auth.css'); ?>">
</head>
<body>

<div class="top-mini">
  <a class="brand" href="login.php" aria-label="Petopia beranda">
    <img src="<?php echo asset('asset/img/Petopia-01.png'); ?>" alt="Petopia" class="brand-logo">
    <span>
      <span class="brand-name" style="display:block">Petopia</span>
      <span class="brand-sub">Pet care • Grooming • Clinic</span>
    </span>
  </a>
  <a href="register.php" class="small fw-semibold d-none d-sm-inline-flex align-items-center gap-1" style="text-decoration:none;color:var(--muted)">Butuh akun? <span style="color:var(--green)">Daftar →</span></a>
</div>

<div class="shell">
  <div class="login-wrapper">
    <div class="form-section">
      <span class="eyebrow"><i class="bi bi-headset"></i> Butuh bantuan? CS 08.00–20.00</span>
      <h1>Welcome back</h1>
      <p class="sub">Masuk untuk kelola jadwal grooming, vaksin, dan penitipan si bulu.</p>

      <form action="proses_login.php" method="POST" novalidate>
        <div class="field">
          <label class="form-label" for="username">Email atau username</label>
          <div class="input-wrap">
            <i class="bi bi-person"></i>
            <input id="username" type="text" name="username" class="form-control custom-input" placeholder="nama@email.com" required autocomplete="username">
          </div>
        </div>
        <div class="field">
          <div class="d-flex justify-content-between align-items-center" style="margin:0 2px 6px">
            <label class="form-label" for="password" style="margin:0">Password</label>
            <a href="https://wa.me/6285242539520" target="_blank" rel="noopener" class="link-muted" style="font-size:.76rem">Lupa password? Chat admin</a>
          </div>
          <div class="input-wrap">
            <i class="bi bi-lock"></i>
            <input id="password" type="password" name="password" class="form-control custom-input" placeholder="••••••••" required autocomplete="current-password">
          </div>
        </div>

        <div class="row-meta">
          <label class="check"><input type="checkbox" name="remember"> Ingat saya</label>
          <span class="small" style="color:var(--muted);font-size:.76rem"><i class="bi bi-telephone me-1"></i>CS 08.00–20.00</span>
        </div>

        <button type="submit" class="btn btn-custom w-100 mt-2">Log in <i class="bi bi-arrow-right"></i></button>
      </form>

      <div class="divider">atau</div>
      <a href="register.php" class="btn-ghost w-100"><i class="bi bi-person-plus"></i> Register as New Client</a>

      <div class="trust">
        <span><i class="bi bi-whatsapp"></i> Bantuan via WhatsApp</span>
        <span><i class="bi bi-heart"></i> Grooming · Vaksin · Penitipan</span>
        <span><i class="bi bi-telephone"></i> CS 08.00–20.00</span>
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
        <div class="q-head">
          <span class="q-ava">S</span>
          <div style="min-width:0">
            <div style="font-weight:800;font-size:.84rem;line-height:1">Sari & Milo</div>
            <div class="stars">★★★★★ <span style="color:var(--muted);font-weight:600">· Grooming langganan</span></div>
          </div>
          <span class="ms-auto small" style="color:var(--muted)"><i class="bi bi-quote" style="font-size:1.1rem"></i></span>
        </div>
        <div style="font-size:.82rem;color:#3a4440;line-height:1.5">"Booking 2 menit, hasil rapi. Milo pulang wangi dan anteng."</div>
      </div>
    </div>
  </div>
</div>

  <?php require BASE_PATH . '/app/Views/partials/footer.php'; ?>

</body>
</html>
