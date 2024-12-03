<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Edit Dokumen</h1>

            <!-- Notifikasi berhasil -->
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success">
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>

            <!-- Notifikasi error -->
            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <style>
                .container-fluid.px-4 {
                    padding: 40px;
                }

                form.editdoc {
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
                    width: 100%;
                    padding: 10px;
                    border: 1px solid #ccc;
                    border-radius: 5px;
                    box-sizing: border-box;
                    font-size: 16px;
                    height: 100%;
                }

                input[type="file"] {
                    padding: 10px;
                }

                .btn-primary,
                .btn-secondary {
                    padding: 10px 20px;
                    border: none;
                    border-radius: 5px;
                    cursor: pointer;
                    font-size: 16px;
                }

                .btn-primary {
                    background-color: #007bff;
                    color: #fff;
                }

                .btn-primary:hover {
                    background-color: #0056b3;
                }

                .btn-secondary {
                    background-color: #6c757d;
                    color: #fff;
                }

                .btn-secondary:hover {
                    background-color: #5a6268;
                }

                .btn-group {
                    display: flex;
                    justify-content: space-between;
                    margin-top: 20px;
                }

                /* button {
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

                .btn-secondary {
                    background-color: #6c757d;
                    color: #fff;
                    padding: 10px 20px;
                    border: none;
                    border-radius: 5px;
                    cursor: pointer;
                    font-size: 16px;
                }

                .btn-secondary:hover {
                    background-color: #5a6268;
                }

                @media (max-width: 576px) {
                    .form-group {
                        flex: none;
                    }
                } */

                .form-group {
                    padding: 50px;
                    flex: 0 0 50%;
                }
                .wajib-diisi {
                    color: red;
                    font-size: 14px;
                }
            </style>
             
            <form class="editdoc"
                action="<?= site_url((session()->get('akses') == 'admin' ? 'admin/updatedoc/' : 'pegawai/updatedoc/') . $dokumen['id_dokumen']); ?>"
                method="post" enctype="multipart/form-data">

                <div class="row">
                    <div class="form-group">
                        <label for="judul_dokumen">Judul Dokumen:<span class="wajib-diisi">* Wajib diisi</span></label>
                        <input type="text" class="form-control" id="judul_dokumen" name="judul_dokumen"
                            value="<?= $dokumen['nama_dokumen']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="tahun">Tahun:<span class="wajib-diisi">* Wajib diisi</span></label>
                        <input type="text" class="form-control" id="tahun" name="tahun"
                            value="<?= $dokumen['tahun']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="jenis">Jenis:<span class="wajib-diisi">* Wajib diisi</span></label>
                        <select class="form-control" id="jenis" name="jenis" required>
                            <option value="">Pilih Jenis</option>
                            <?php foreach ($jenis as $jenis_item): ?>
                                <option value="<?= $jenis_item['nama_jenis']; ?>"
                                    <?= $dokumen['id_jenis'] == $jenis_item['id_jenis'] ? 'selected' : ''; ?>>
                                    <?= $jenis_item['nama_jenis']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nama_kategori">Nama Kategori:<span class="wajib-diisi">* Wajib diisi</span></label>
                        <select class="form-control" id="nama_kategori" name="nama_kategori" required>
                            <option value="">Pilih Kategori</option>
                            <?php foreach ($kategori as $kategori_item): ?>
                                <option value="<?= $kategori_item['nama_kategori']; ?>"
                                    <?= $dokumen['id_kategori'] == $kategori_item['id_kategori'] ? 'selected' : ''; ?>>
                                    <?= $kategori_item['nama_kategori']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="file">Upload File:<span class="wajib-diisi">* Wajib diisi</span></label>
                        <input type="file" class="form-control-file" id="file" name="file" accept=".pdf,.doc,.docx">
                        <!-- Tampilkan nama file yang ada -->
                        <?php if (!empty($dokumen['file'])): ?>
                            <p>File Saat Ini: <?= $dokumen['file']; ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="keterangan">Keterangan:</label>
                        <textarea class="form-control" id="keterangan" name="keterangan"
                            rows="3"><?= $dokumen['keterangan']; ?></textarea>
                    </div>
                    <div class="btn-group">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="<?= site_url((session()->get('akses') == 'admin' ? 'admin/lihatdoc/' : 'pegawai/lihatdoc/') . $dokumen['id_dokumen']); ?>"
                            class="btn btn-secondary">Batal</a>
                    </div>

                </div>
            </form>
        </div>
    </main>