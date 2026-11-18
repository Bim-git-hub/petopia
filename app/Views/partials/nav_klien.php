<?php
// app/Views/partials/nav_klien.php — navbar klien. Variabel: $menuAktif ('beranda'|'layanan'|'pesanan'|'bantuan').
// Dipakai via: $menuAktif = 'layanan'; require BASE_PATH . '/app/Views/partials/nav_klien.php';
$menuAktif = $menuAktif ?? '';
?>
<nav class="navbar navbar-expand-lg navbar-klien sticky-top">
  <div class="container">
    <a class="brand" href="index.php"><img src="<?php echo asset('asset/img/Petopia-01.png'); ?>" alt="Petopia" class="brand-logo"> Petopia</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navKlien" aria-label="Menu"><span class="navbar-toggler-icon"></span></button>
    <div class="collapse navbar-collapse" id="navKlien">
      <ul class="navbar-nav ms-lg-3 gap-1">
        <li class="nav-item"><a class="nav-link nav-link-klien<?php echo $menuAktif === 'beranda' ? ' active' : ''; ?>" href="index.php"><i class="bi bi-house me-1"></i> Beranda</a></li>
        <li class="nav-item"><a class="nav-link nav-link-klien<?php echo $menuAktif === 'layanan' ? ' active' : ''; ?>" href="layanan.php"><i class="bi bi-bag-heart me-1"></i> Layanan</a></li>
        <li class="nav-item"><a class="nav-link nav-link-klien<?php echo $menuAktif === 'pesanan' ? ' active' : ''; ?>" href="pesanan.php"><i class="bi bi-calendar-check me-1"></i> Pesanan Saya</a></li>
        <li class="nav-item"><a class="nav-link nav-link-klien<?php echo $menuAktif === 'bantuan' ? ' active' : ''; ?>" href="bantuan.php"><i class="bi bi-chat-dots me-1"></i> Bantuan</a></li>
      </ul>
      <div class="ms-auto d-flex align-items-center gap-2 mt-3 mt-lg-0">
        <span class="small muted d-none d-md-inline">Halo, <strong style="color:var(--green)"><?php echo htmlspecialchars($_SESSION['nama']); ?></strong></span>
        <div class="avatar" style="width:36px;height:36px;font-size:.85rem"><?php echo strtoupper(substr($_SESSION['nama'],0,1)); ?></div>
        <a href="logout.php" class="btn btn-ghost btn-sm"><i class="bi bi-box-arrow-right me-1"></i> Keluar</a>
      </div>
    </div>
  </div>
</nav>
