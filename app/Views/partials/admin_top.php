<?php
// app/Views/partials/admin_top.php — cangkang atas admin: <head>, sidebar, topbar, buka .content.
// Variabel: $judul (title halaman), $menuAktif ('dashboard'|'klien'|'layanan'|'pesanan'|'pengaturan'|'bantuan').
// Dipakai via: $judul = '...'; $menuAktif = '...'; require BASE_PATH . '/app/Views/partials/admin_top.php';
$judul = $judul ?? 'Admin - Petopia';
$menuAktif = $menuAktif ?? '';
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo htmlspecialchars($judul); ?></title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?php echo asset('asset/css/admin.css'); ?>">
</head>
<body>

<div class="overlay" id="overlay" onclick="toggleSidebar()"></div>

<aside class="sidebar" id="sidebar">
  <div class="sidebar-brand">
    <img src="<?php echo asset('asset/img/Petopia-01.png'); ?>" alt="Petopia" class="brand-logo">
    <div>
      <div style="font-weight:800;letter-spacing:.2px;line-height:1">Petopia</div>
      <div style="font-size:.72rem;color:#8a9096;font-weight:600;letter-spacing:.06em;text-transform:uppercase">Admin Panel</div>
    </div>
  </div>
  <nav class="sidebar-nav">
    <ul class="nav-petopia">
      <li><a<?php echo $menuAktif === 'dashboard' ? ' class="active"' : ''; ?> href="admin_dashboard.php"><i class="bi bi-grid-1x2"></i> Dashboard</a></li>
      <li><a<?php echo $menuAktif === 'klien' ? ' class="active"' : ''; ?> href="admin_klien.php"><i class="bi bi-people"></i> Klien</a></li>
      <li><a<?php echo $menuAktif === 'layanan' ? ' class="active"' : ''; ?> href="admin_layanan.php"><i class="bi bi-bag-heart"></i> Layanan</a></li>
      <li><a<?php echo $menuAktif === 'pesanan' ? ' class="active"' : ''; ?> href="admin_pesanan.php"><i class="bi bi-receipt"></i> Pesanan</a></li>
    </ul>
    <div class="label">Pengaturan</div>
    <ul class="nav-petopia">
      <li><a<?php echo $menuAktif === 'pengaturan' ? ' class="active"' : ''; ?> href="admin_pengaturan.php"><i class="bi bi-gear"></i> Pengaturan</a></li>
      <li><a<?php echo $menuAktif === 'bantuan' ? ' class="active"' : ''; ?> href="admin_bantuan.php"><i class="bi bi-question-circle"></i> Bantuan</a></li>
    </ul>
  </nav>
  <div class="sidebar-foot">
    <div class="user-mini">
      <div class="avatar"><?php echo strtoupper(substr($_SESSION['nama'],0,1)); ?></div>
      <div style="min-width:0;flex:1">
        <div style="font-weight:700;font-size:.88rem;white-space:nowrap;overflow:hidden;text-overflow:ellipsis"><?php echo htmlspecialchars($_SESSION['nama']); ?></div>
        <div style="font-size:.72rem;color:#8a9096">Admin</div>
      </div>
      <a href="logout.php" class="icon-btn" style="width:32px;height:32px" title="Keluar"><i class="bi bi-box-arrow-right" style="font-size:.9rem"></i></a>
    </div>
  </div>
</aside>

<main class="main">
  <div class="topbar">
    <button class="menu-btn" id="menuBtn" onclick="toggleSidebar()" aria-label="Menu"><i class="bi bi-list" style="font-size:1.2rem"></i></button>
    <form class="search-wrap" action="admin_cari.php" method="GET" role="search">
      <i class="bi bi-search"></i>
      <input type="search" name="q" value="<?php echo htmlspecialchars($qCari ?? ''); ?>" placeholder="Cari klien, layanan, pesanan..." aria-label="Cari">
    </form>
    <div class="ms-auto d-flex align-items-center gap-2">
      <?php $nPending = $notifPending ?? $pending ?? 0; ?>
      <a href="admin_pesanan.php" class="icon-btn" aria-label="Pesanan menunggu konfirmasi" title="<?php echo (int) $nPending; ?> pesanan menunggu konfirmasi"><i class="bi bi-bell"></i><?php if ($nPending > 0): ?><span class="dot"></span><?php endif; ?></a>
      <a href="logout.php" class="btn btn-logout-sm d-none d-sm-inline-flex align-items-center gap-1"><i class="bi bi-box-arrow-right"></i> Keluar</a>
      <div class="d-none d-sm-flex align-items-center gap-2 ps-2" style="border-left:1px solid #eef0f2">
        <div class="text-end d-none d-md-block">
          <div style="font-weight:700;font-size:.84rem;line-height:1"><?php echo htmlspecialchars($_SESSION['nama']); ?></div>
          <div style="font-size:.72rem;color:#8a9096">Administrator</div>
        </div>
        <div style="width:38px;height:38px;border-radius:50%;background:var(--green);color:#fff;display:flex;align-items:center;justify-content:center;font-weight:800"><?php echo strtoupper(substr($_SESSION['nama'],0,1)); ?></div>
      </div>
    </div>
  </div>

  <div class="content">
