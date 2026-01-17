<div class="p-5 mb-4 bg-light rounded-3 shadow-sm mt-4">
    <div class="container-fluid py-5">
        <h1 class="display-5 fw-bold">Selamat Datang di Perpustakaan Kampus</h1>
        <p class="col-md-8 fs-4">Sistem Informasi Peminjaman Buku Online. Memudahkan mahasiswa dalam mencari dan meminjam buku serta membantu admin dalam pengelolaan data perpustakaan.</p>
        <?php if(!isset($_SESSION['user_id'])): ?>
            <a class="btn btn-primary btn-lg" href="<?= BASEURL; ?>/auth" role="button">Login Sekarang</a>
        <?php else: ?>
            <p>Halo, <strong><?= $_SESSION['nama']; ?></strong>!</p>
            <?php if($_SESSION['role'] == 'admin'): ?>
                <a class="btn btn-primary btn-lg" href="<?= BASEURL; ?>/admin" role="button">Ke Dashboard Admin</a>
            <?php else: ?>
                <a class="btn btn-primary btn-lg" href="<?= BASEURL; ?>/mahasiswa" role="button">Cari Buku</a>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</div>

<div class="row align-items-md-stretch">
    <div class="col-md-6">
        <div class="h-100 p-5 text-white bg-dark rounded-3">
            <h2>Koleksi Buku Lengkap</h2>
            <p>Kami memiliki ribuan koleksi buku dari berbagai kategori yang siap untuk Anda pinjam.</p>
            <a href="<?= BASEURL; ?>/buku/katalog" class="btn btn-outline-light" type="button">Lihat Katalog</a>
        </div>
    </div>
    <div class="col-md-6">
        <div class="h-100 p-5 bg-light border rounded-3">
            <h2>Layanan Mudah</h2>
            <p>Pinjam buku tanpa antre, cukup pesan lewat web dan ambil di perpustakaan.</p>
        </div>
    </div>
</div>
