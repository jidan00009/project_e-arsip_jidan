<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
        <h1 class="mt-4">Tambah Kategori</h1>
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success">
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <style>
                /* Style untuk membuat tampilan formulir lebih menarik */
                .container-fluid.px-4 {
                    padding: 40px;
                }

                form.tambahkategori {
                    margin: 0 auto;
                    padding: 20px;
                    border: 1px solid #ccc;
                    border-radius: 5px;
                    background-color: #f9f9f9db;
                }

                .form-group {
                    margin-bottom: 20px;
                }

                label {
                    font-weight: bold;
                    font-size: 20px;
                }

                input[type="text"],
                select,
                textarea {
                    padding: 10px;
                    border: 1px solid #ccc;
                    border-radius: 5px;
                    box-sizing: border-box;
                    font-size: 16px;
                }

                input[type="file"] {
                    padding: 10px;
                }

                button {
                    background-color: #007bff;
                    color: #fff;
                    padding: 10px 20px;
                    border: none;
                    border-radius: 5px;
                    cursor: pointer;
                    font-size: 16px;
                }

                button:hover {
                    background-color: #0056b3;
                }

                @media (max-width: 576px) {
                    .form-group {
                        flex: none;
                    }
                }

                .form-group {
                    padding: 50px;
                }
            </style>
            <form class="tambahkategori"
                action="<?= site_url((session()->get('akses') == 'admin' ? 'admin/simpankategori' : 'pegawai/simpankategori')); ?>"
                method="post" enctype="multipart/form-data">

                <div class="row">
                    <div class="form-group">
                        <label for="kategori">Kategori Dokumen</label>
                        <input type="text" class="form-control" id="kategori" name="kategori" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>

            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatablesSimple" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>Kategori Dokumen</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            if (isset($isi)) {
                                foreach ($isi as $row): ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $row['nama_kategori']; ?></td>
                                        <td>
                                            <a href="<?= base_url((session()->get('akses') == 'admin' ? 'admin/editkategori/' : 'pegawai/editkategori/') . $row['id_kategori']); ?>"
                                                class="btn btn-sm btn-warning">Edit</a>
                                            <a href="<?= base_url((session()->get('akses') == 'admin' ? 'admin/hapuskategori/' : 'pegawai/hapuskategori/') . $row['id_kategori']); ?>"
                                                class="btn btn-sm btn-danger"
                                                onclick="return confirm('Anda yakin ingin menghapus kategori dokumen ini?')">Hapus</a>
                                        </td>
                                    </tr>
                                <?php endforeach;
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>