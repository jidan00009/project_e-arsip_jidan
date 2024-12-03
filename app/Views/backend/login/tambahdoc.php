<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Tambah Dokumen</h1>

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

                form.tambahdoc {
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

                .wajib-diisi {
                    color: red;
                    font-size: 14px;
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
                    -ms-flex: 0 0 50%;
                    flex: 0 0 50%;
                }
            </style>
            <form class="tambahdoc"
                action="<?= site_url((session()->get('akses') == 'admin' ? 'admin/simpandoc' : 'pegawai/simpandoc')); ?>"
                method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="form-group">
                        <label for="judul_dokumen">Judul Dokumen: <span class="wajib-diisi">* Wajib diisi</span></label>
                        <input type="text" class="form-control" id="judul_dokumen" name="judul_dokumen" required>
                       
                    </div>
                    <div class="form-group">
                        <label for="tahun">Tahun: <span class="wajib-diisi">* Wajib diisi</span></label>
                        <input type="text" class="form-control" id="tahun" name="tahun" required pattern="\d{4}" title="Masukkan tahun dengan format 4 digit, contoh: 2024">
                        <div class="invalid-feedback">
                            Silakan masukkan tahun yang valid (4 digit).
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="jenis">Jenis: <span class="wajib-diisi">* Wajib diisi</span></label>
                        <select class="form-control" id="jenis" name="jenis" required>
                            <option value="">Pilih Jenis</option>
                            <?php foreach ($jenis as $jenis_item): ?>
                                <option value="<?php echo $jenis_item; ?>"><?php echo $jenis_item; ?></option>
                            <?php endforeach; ?>
                        </select>
                       
                    </div>
                    <div class="form-group">
                        <label for="nama_kategori">Nama Kategori: <span class="wajib-diisi">* Wajib diisi</span></label>
                        <select class="form-control" id="nama_kategori" name="nama_kategori" required>
                            <option value="">Pilih Kategori</option>
                            <?php foreach ($kategori as $kategori_item): ?>
                                <option value="<?php echo $kategori_item['nama_kategori']; ?>">
                                    <?php echo $kategori_item['nama_kategori']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        
                    </div>
                    <div class="form-group">
                        <p>Silakan upload file dokumen dalam format PDF.</p>
                        <label for="file">Upload File: <span class="wajib-diisi">* Wajib diisi</span></label>
                        <input type="file" class="form-control-file" id="file" name="file" accept=".pdf" required>
                        
                    </div>
                    <div class="form-group">
                        <label for="keterangan">Keterangan:</label>
                        <textarea class="form-control" id="keterangan" name="keterangan" rows="3"></textarea>
                    </div>
                    <div class="btn-group">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="<?= site_url((session()->get('akses') == 'admin' ? 'admin/dashboard' : 'pegawai/dashboard') ); ?>" class="btn btn-secondary">Batal</a>
                    </div>
                </div>
            </form>
        </div>
    </main>

