<div class="row mt-4">
    <div class="col-md-12">
        <div class="alert alert-info">Selamat Datang, <strong><?= $_SESSION['nama']; ?></strong> (Administrator)</div>
    </div>
</div>

<div class="row mb-4">
    <!-- Total Buku -->
    <div class="col-md-4">
        <div class="card text-white bg-primary mb-3 h-100">
            <div class="card-header">Jumlah Buku</div>
            <div class="card-body">
                <h5 class="card-title display-4"><?= $data['total_buku']; ?></h5>
                <p class="card-text">Total judul buku dalam koleksi.</p>
                <a href="<?= BASEURL; ?>/buku" class="text-white stretched-link">Kelola Buku</a>
            </div>
        </div>
    </div>

    <!-- Sedang Dipinjam -->
    <div class="col-md-4">
        <div class="card text-white bg-success mb-3 h-100">
            <div class="card-header">Sedang Dipinjam</div>
            <div class="card-body">
                <h5 class="card-title display-4"><?= $data['active_loans']; ?></h5>
                <p class="card-text">Buku yang sedang dipinjam mahasiswa.</p>
                <a href="<?= BASEURL; ?>/peminjaman" class="text-white stretched-link">Lihat Detail</a>
            </div>
        </div>
    </div>

    <!-- Terlambat -->
    <div class="col-md-4">
        <div class="card text-white bg-danger mb-3 h-100">
            <div class="card-header">Terlambat Pengembalian</div>
            <div class="card-body">
                <h5 class="card-title display-4"><?= $data['overdue_loans']; ?></h5>
                <p class="card-text">Peminjaman melewati batas waktu.</p>
                <a href="<?= BASEURL; ?>/peminjaman" class="text-white stretched-link">Cek Peminjaman</a>
            </div>
        </div>
    </div>
</div>
