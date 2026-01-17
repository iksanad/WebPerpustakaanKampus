<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Website Perpustakaan Kampus</title>
        <link rel="stylesheet" href="<?= BASEURL; ?>/css/template-global.css">
        <link rel="stylesheet" href="<?= BASEURL; ?>/css/template-home.css">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    </head>
    <body>
        <header class="l-header">
            <nav class="nav bd-grid">
                <div>
                    <a href="#" class="nav-logo">
                        <img src="<?= BASEURL; ?>/img/app-logo.png" alt="Library">
                    </a>
                </div>
                <div class="nav-menu" id="nav-menu">
                    <ul class="nav-list">
                        <li class="nav-item"><a href="#home" class="nav-link active">Beranda</a></li>
                        <li class="nav-item"><a href="#features" class="nav-link">Fitur</a></li>
                        <li class="nav-item"><a href="#statistic" class="nav-link">Statistik</a></li>
                        <?php if(isset($_SESSION['user_id'])): ?>
                            <li class="nav-item">
                                <a href="<?= BASEURL; ?>/<?= $_SESSION['role']; ?>" class="nav-link">
                                    <?= $_SESSION['username']; ?>
                                </a>
                            </li>
                        <?php else: ?>
                            <li class="nav-item"><a href="<?= BASEURL; ?>/auth" class="nav-link">Login</a></li>
                        <?php endif; ?>
                    </ul>
                </div>
                <div class="nav-toggle" id="nav-toggle">
                    <i class='bx bx-menu'></i>
                </div>
            </nav>
        </header>

        <main class="l-main">
            <section class="home bd-grid" id="home">
                <div class="home-data d-flex row">
                    <div class="home-text col col-desktop-6 col-tablet-6 col-mobile-12" style="align-content: center;">
                        <h1>Pinjam Buku dengan mudah tanpa Antrian</h1>
                        <p style="margin:5px 0 25px;">Sistem perpustakaan kampus yang memudahkan mahasiswa untuk meminjam, mengembalikan, dan mencari koleksi buku dengan mudah dan cepat.</p>
                        <a href="<?= BASEURL; ?>/auth" class="button">Mulai Sekarang</a>
                    </div>
                    <div class="home-img col col-desktop-6 col-tablet-6 col-mobile-12">
                        <img src="https://images.unsplash.com/photo-1731200301762-af6a21e9037a?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHx1bml2ZXJzaXR5JTIwbGlicmFyeSUyMGJvb2tzfGVufDF8fHx8MTc2MTYwOTkzOXww&ixlib=rb-4.1.0&q=80&w=1080" alt="Library">
                    </div>
                </div>
            </section>

            <section class="features section" id="features">
                <h2 class="section-title">Fitur Unggulan</h2>
                <div class="features-container bd-grid row">
                    <div class="col col-mobile-12 col-tablet-6 col-desktop-3">
                        <div class="card">
                            <div class="card-icon bg-blue">
                                <i class="bx bx-search-alt text-blue"></i> 
                            </div>
                            <h4>Pencarian Mudah</h4>
                            <p>Cari buku berdasarkan judul, penulis, atau kategori dengan cepat</p>
                        </div>
                    </div>
                    <div class="col col-mobile-12 col-tablet-6 col-desktop-3">
                        <div class="card">
                            <div class="card-icon bg-green">
                                <i class="bx bx-book text-green"></i> 
                            </div>
                            <h4>Peminjaman Online</h4>
                            <p>Ajukan peminjaman buku secara online tanpa perlu antri</p>
                        </div>
                    </div>
                    <div class="col col-mobile-12 col-tablet-6 col-desktop-3">
                        <div class="card">
                            <div class="card-icon bg-purple">
                                <i class="bx bx-time text-purple"></i> 
                            </div>
                            <h4>Tracking Real-time</h4>
                            <p>Pantau status peminjaman dan tanggal pengembalian buku Anda</p>
                        </div>
                    </div>
                    <div class="col col-mobile-12 col-tablet-6 col-desktop-3">
                        <div class="card">
                            <div class="card-icon bg-orange">
                                <i class="bx bx-shield text-orange"></i> 
                            </div>
                            <h4>Aman & Terpercaya</h4>
                            <p>Sistem yang aman dengan data terenkripsi dan tersimpan dengan baik</p>
                        </div>
                    </div>
                </div>
            </section>

            <section class="statistic section" id="statistic">
                <div class="statistic-container bd-grid row">
                    <div class="statistic-data col col-mobile-12 col-tablet-12 col-desktop-4">
                        <h1><?= number_format($data['count_buku']); ?></h1>
                        <p>Koleksi Buku</p>
                    </div>
                    <div class="statistic-data col col-mobile-12 col-tablet-12 col-desktop-4">
                        <h1><?= number_format($data['count_mhs']); ?></h1>
                        <p>Mahasiswa Terdaftar</p>
                    </div>
                    <div class="statistic-data col col-mobile-12 col-tablet-12 col-desktop-4">
                        <h1><?= number_format($data['count_pinjam']); ?></h1>
                        <p>Peminjaman Bulan Ini</p>
                    </div>
                </div>
            </section>
        </main>

        <footer class="footer">
            <p>&#169; 2025 Perpustakaan Kampus. All rights reserved.</p>
        </footer>

        <script src="https://unpkg.com/scrollreveal"></script>
        <script>
            // Navbar Mobile
            const showMenu = (toggleId, navId) => {
                const toggle = document.getElementById(toggleId);
                const nav = document.getElementById(navId);
                if(toggle && nav) {
                    toggle.addEventListener('click', () => {
                        nav.classList.toggle('show');
                    })
                }
            }
            showMenu('nav-toggle', 'nav-menu');
            const navLink = document.querySelectorAll('.nav-link');
            function linkAction() {
                navLink.forEach(n => n.classList.remove('active'));
                this.classList.add('active');
                const navMenu = document.getElementById('nav-menu');
                navMenu.classList.remove('show');
            }
            navLink.forEach(n => n.addEventListener('click', linkAction));

            // Efek Scroll
            const sr = ScrollReveal({
                origin: 'top',
                distance: '80px',
                duration: 2000,
                reset: true
            })
            sr.reveal('.button', {delay: 200} )
            sr.reveal('.home-text', {delay: 200} )
            sr.reveal('.home-img', {delay: 400} )
            sr.reveal('.section-title', {delay: 200} )
            sr.reveal('.card', {interval: 200} )
            sr.reveal('.statistic-data', {interval: 200} )
            sr.reveal('.footer p', {delay: 200} )
        </script>
    </body>
</html>
