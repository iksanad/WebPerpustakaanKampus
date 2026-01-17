<div class="row mt-4">
    <div class="col-md-6">
        <h3>Daftar Peminjaman</h3>
        <a href="<?= BASEURL; ?>/peminjaman/tambah" class="btn btn-primary mb-3">Input Peminjaman Baru</a>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-datatable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Peminjam</th>
                                <th>Buku</th>
                                <th>Tgl Pinjam</th>
                                <th>Tgl Kembali (Rencana)</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(empty($data['peminjaman'])): ?>
                                <tr>
                                    <td colspan="7" class="text-center">Belum ada data peminjaman.</td>
                                </tr>
                            <?php else: ?>
                                <?php $no=1; foreach($data['peminjaman'] as $pinjam): ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $pinjam['nama_peminjam']; ?></td>
                                    <td><?= $pinjam['judul_buku']; ?></td>
                                    <td><?= $pinjam['tanggal_pinjam']; ?></td>
                                    <td><?= $pinjam['tanggal_kembali_rencana']; ?></td>
                                    <td>
                                        <?php if($pinjam['status'] == 'diajukan'): ?>
                                            <span class="badge bg-warning text-dark">Diajukan</span>
                                        <?php elseif($pinjam['status'] == 'dipinjam'): ?>
                                            <span class="badge bg-primary">Dipinjam</span>
                                        <?php elseif($pinjam['status'] == 'dikembalikan'): ?>
                                            <span class="badge bg-success">Dikembalikan</span>
                                        <?php else: ?>
                                            <span class="badge bg-danger">Ditolak</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if($pinjam['status'] == 'diajukan'): ?>
                                            <a href="<?= BASEURL; ?>/peminjaman/setujui/<?= $pinjam['id']; ?>" class="btn btn-sm btn-success" onclick="return confirm('Setujui peminjaman?');">Terima</a>
                                            <a href="<?= BASEURL; ?>/peminjaman/tolak/<?= $pinjam['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Tolak peminjaman?');">Tolak</a>
                                        <?php elseif($pinjam['status'] == 'dipinjam'): ?>
                                            <a href="<?= BASEURL; ?>/peminjaman/kembali/<?= $pinjam['id']; ?>" class="btn btn-sm btn-info" onclick="return confirm('Tandai buku sudah kembali?');">Dikembalikan</a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
