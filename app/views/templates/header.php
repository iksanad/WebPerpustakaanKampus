<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman <?= $data['judul']; ?></title>
    <!-- Custom Style (includes Bootstrap) -->
    <link href="<?= BASEURL; ?>/css/styles.css" rel="stylesheet">
    <link href="<?= BASEURL; ?>/css/dataTables.style.min.css" rel="stylesheet">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <style>
        body { background-color: #f8f9fa; }
        .hero-section { background: linear-gradient(45deg, #0d6efd, #0dcaf0); color: white; padding: 50px 0; }
        .card-custom { border: none; shadow: 0 4px 6px rgba(0,0,0,0.1); transition: 0.3s; }
        .card-custom:hover { transform: translateY(-5px); }
    </style>
</head>
<body>

<?php
// Detect current page for active menu
$currentUrl = $_SERVER['REQUEST_URI'];
$urlParts = explode('/', trim(parse_url($currentUrl, PHP_URL_PATH), '/'));
$baseIndex = array_search('WebPerpustakaanKampus', $urlParts);
$controller = isset($urlParts[$baseIndex + 1]) ? $urlParts[$baseIndex + 1] : 'home';
$method = isset($urlParts[$baseIndex + 2]) ? $urlParts[$baseIndex + 2] : 'index';

// Helper function to check if menu is active
function isActive($page, $currentController, $currentMethod = '') {
    if ($page == 'home') {
        return ($currentController == '' || $currentController == 'home') ? 'active' : '';
    } elseif ($page == 'admin') {
        return ($currentController == 'admin') ? 'active' : '';
    } elseif ($page == 'buku') {
        return ($currentController == 'buku' && $currentMethod != 'katalog') ? 'active' : '';
    } elseif ($page == 'katalog') {
        return ($currentController == 'buku' && $currentMethod == 'katalog') ? 'active' : '';
    } elseif ($page == 'peminjaman') {
        return ($currentController == 'peminjaman') ? 'active' : '';
    } elseif ($page == 'mahasiswa') {
        return ($currentController == 'mahasiswa') ? 'active' : '';
    }
    return '';
}
?>


<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
  <div class="container">
    <a class="navbar-brand fw-bold text-primary" href="<?= BASEURL; ?>">Perpustakaan Kampus</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link <?= isActive('home', $controller, $method); ?>" href="<?= BASEURL; ?>">Home</a>
        </li>
        <?php if(isset($_SESSION['user_id'])): ?>
            <?php if($_SESSION['role'] == 'admin'): ?>
                <li class="nav-item">
                    <a class="nav-link <?= isActive('admin', $controller, $method); ?>" href="<?= BASEURL; ?>/admin">Dashboard Admin</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= isActive('buku', $controller, $method); ?>" href="<?= BASEURL; ?>/buku">Kelola Buku</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= isActive('peminjaman', $controller, $method); ?>" href="<?= BASEURL; ?>/peminjaman">Peminjaman</a>
                </li>
            <?php else: ?>
                <li class="nav-item">
                    <a class="nav-link <?= isActive('mahasiswa', $controller, $method); ?>" href="<?= BASEURL; ?>/mahasiswa">Dashboard Saya</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= isActive('katalog', $controller, $method); ?>" href="<?= BASEURL; ?>/buku/katalog">Katalog Buku</a>
                </li>
            <?php endif; ?>
            <li class="nav-item mb-2 mb-lg-0">
                <a class="btn btn-primary text-white ms-2 btn-sm mt-1" href="<?= BASEURL; ?>/auth/logout">Logout</a>
            </li>
        <?php else: ?>
            <li class="nav-item"><a class="nav-link" href="<?= BASEURL; ?>/auth">Login</a></li>
            <li class="nav-item"><a class="nav-link" href="<?= BASEURL; ?>/auth/register">Register</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>
<div class="container mt-4">


