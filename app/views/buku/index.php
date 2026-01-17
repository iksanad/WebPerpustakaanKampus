<div class="row mt-4">
    <div class="col-md-6">
        <?php Flasher::flash(); ?>
        <h3>Daftar Buku</h3>
        
        <button type="button" class="btn btn-primary mb-3 tombolTambahData" data-bs-toggle="modal" data-bs-target="#formModal">
            Tambah Data Buku
        </button>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Gambar</th>
                                <th>Judul</th>
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
                                    <?php if (!empty($buku['gambar']) && file_exists('img/' . $buku['gambar'])): ?>
                                        <img src="<?= BASEURL; ?>/img/<?= $buku['gambar']; ?>" width="50" style="object-fit:cover; height:70px;">
                                    <?php else: ?>
                                        <img src="<?= BASEURL; ?>/img/default.jpg" width="50" style="object-fit:cover; height:70px;" alt="No Image">
                                    <?php endif; ?>
                                </td>
                                <td><?= $buku['judul']; ?></td>
                                <td><?= $buku['pengarang']; ?></td>
                                <td><?= $buku['penerbit']; ?></td>
                                <td><?= $buku['stok']; ?></td>
                                <td>
                                    <a href="<?= BASEURL; ?>/buku/ubah/<?= $buku['id']; ?>" class="badge bg-success text-decoration-none modalUbah" data-bs-toggle="modal" data-bs-target="#formModal" request-id="<?= $buku['id']; ?>">Ubah</a>
                                    <a href="<?= BASEURL; ?>/buku/hapus/<?= $buku['id']; ?>" class="badge bg-danger text-decoration-none" onclick="return confirm('yakin?');">Hapus</a>
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

<!-- Modal -->
<div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="judulModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="judulModal">Tambah Data Buku</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
        <form action="<?= BASEURL; ?>/buku/tambah" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" id="id">
            <input type="hidden" name="gambarLama" id="gambarLama">
            
            <div class="mb-3">
                <label for="gambar" class="form-label">Gambar Buku</label>
                <div class="mb-2">
                    <img src="" alt="Preview" id="previewGambar" class="img-thumbnail d-none" width="100">
                </div>
                <input type="file" class="form-control" id="gambar" name="gambar">
            </div>
            <div class="mb-3">
                <label for="judul" class="form-label">Judul Buku</label>
                <input type="text" class="form-control" id="judul" name="judul" required>
            </div>

            <div class="mb-3">
                <label for="pengarang" class="form-label">Pengarang</label>
                <input type="text" class="form-control" id="pengarang" name="pengarang" required>
            </div>

            <div class="mb-3">
                <label for="penerbit" class="form-label">Penerbit</label>
                <input type="text" class="form-control" id="penerbit" name="penerbit" required>
            </div>

            <div class="mb-3">
                <label for="tahun" class="form-label">Tahun Terbit</label>
                <input type="number" class="form-control" id="tahun" name="tahun" required>
            </div>

            <div class="mb-3">
                <label for="stok" class="form-label">Stok</label>
                <input type="number" class="form-control" id="stok" name="stok" required>
            </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Tambah Data</button>
        </form>
      </div>
    </div>
  </div>
</div>
