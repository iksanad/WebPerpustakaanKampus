<div class="row mt-4">
    <div class="col-md-6">
        <?php Flasher::flash(); ?>
        <h3>Daftar Buku</h3>
        
        <a href="<?= BASEURL; ?>/buku/form" class="btn btn-primary mb-3">
            <i class="fas fa-plus"></i> Tambah Data Buku
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th style="width: 100px;">Gambar</th>
                                <th>Judul</th>
                                <th>Deskripsi</th>
                                <th>Pengarang</th>
                                <th>Penerbit</th>
                                <th>Stok</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no=1; foreach($data['buku'] as $buku): ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td>
                                    <?php 
                                        $imgSrc = BASEURL . '/img/default.jpg';
                                        if (!empty($buku['gambar']) && file_exists('img/' . $buku['gambar'])) {
                                            $imgSrc = BASEURL . '/img/' . $buku['gambar'];
                                        }
                                    ?>
                                    <img src="<?= $imgSrc; ?>" style="width: 50px; height: 70px; object-fit: cover; border-radius: 4px;" alt="Buku" onerror="this.onerror=null;this.src='https://placehold.co/50x70?text=No+Img';">
                                </td>
                                <td><?= $buku['judul']; ?></td>
                                <td><?= (str_word_count($buku['deskripsi'] ?? '') > 10 ? substr($buku['deskripsi'] ?? '',0,50)."..." : $buku['deskripsi'] ?? ''); ?></td>
                                <td><?= $buku['pengarang']; ?></td>
                                <td><?= $buku['penerbit']; ?></td>
                                <td><?= $buku['stok']; ?></td>
                                <td>
                                    <a href="<?= BASEURL; ?>/buku/form/<?= $buku['id']; ?>" class="badge bg-success text-decoration-none">
                                        <i class="fas fa-edit"></i> Ubah
                                    </a>
                                    <a href="<?= BASEURL; ?>/buku/hapus/<?= $buku['id']; ?>" class="badge bg-danger text-decoration-none" onclick="return confirm('Yakin ingin menghapus buku ini?');">
                                        <i class="fas fa-trash"></i> Hapus
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
