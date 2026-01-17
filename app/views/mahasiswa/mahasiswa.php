<div class="row mt-4">
    <div class="col-md-12">
        <div class="alert alert-success">Selamat Datang, <strong><?= $_SESSION['nama']; ?></strong></div>
        <?php Flasher::flash(); ?>
        
        <?php 
        $has_overdue = false;
        foreach($data['riwayat'] as $r) {
            if($r['status'] == 'dipinjam' && $r['tanggal_kembali_rencana'] < date('Y-m-d')) {
                echo '<div class="alert alert-danger"><strong>PERINGATAN:</strong> Buku "'.$r['judul_buku'].'" sudah lewat batas waktu pengembalian ('.$r['tanggal_kembali_rencana'].'). Harap segera dikembalikan!</div>';
                $has_overdue = true;
            }
        }
        ?>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-12 text-center">
        <div class="p-4 bg-light rounded-3 shadow-sm">
            <h3>Mau pinjam buku apa hari ini?</h3>
            <p>Cari buku favoritmu di katalog perpustakaan.</p>
            <a href="<?= BASEURL; ?>/buku/katalog" class="btn btn-primary btn-lg">Lihat Katalog Buku</a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <h4>Status Peminjaman Saya</h4>
        <?php if(empty($data['riwayat'])): ?>
            <div class="alert alert-warning">Anda belum memiliki riwayat peminjaman.</div>
        <?php else: ?>
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Buku</th>
                                <th>Tgl Pinjam</th>
                                <th>Tgl Kembali (Rencana)</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no=1; foreach($data['riwayat'] as $r): ?>
                            <!-- Show active loans first or highlight them -->
                            <tr class="<?= ($r['status'] == 'dipinjam') ? 'table-info' : ''; ?>">
                                <td><?= $no++; ?></td>
                                <td><?= $r['judul_buku']; ?></td>
                                <td><?= $r['tanggal_pinjam']; ?></td>
                                <td><?= $r['tanggal_kembali_rencana']; ?></td>
                                <td>
                                    <?php if($r['status'] == 'diajukan'): ?>
                                        <span class="badge bg-warning text-dark">Diajukan</span>
                                    <?php elseif($r['status'] == 'dipinjam'): ?>
                                        <span class="badge bg-primary">Dipinjam</span>
                                    <?php elseif($r['status'] == 'dikembalikan'): ?>
                                        <span class="badge bg-success">Dikembalikan</span>
                                    <?php else: ?>
                                        <span class="badge bg-danger">Ditolak</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>
