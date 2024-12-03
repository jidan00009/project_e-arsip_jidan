<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">

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

                form.tambahjenis {

                    margin: 0 auto;
                    padding: 20px;
                    border: 1px solid #ccc;
                    border-radius: 5px;
                    background-color: #f9f9f9;
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
                    -ms-flex: 0 0 50%;
                    /* flex: 0 0 50%; */
                    /* max-width: 50%; */
                }
            </style>
            <form class="tambahjenis"
                action="<?= site_url((session()->get('akses') == 'admin' ? 'admin/simpanjenis' : 'pegawai/simpanjenis')); ?>"
                method="post" enctype="multipart/form-data">

                <div class="row">
                    <div class="form-group">
                        <label for="jenis">Jenis Dokumen</label>
                        <input type="text" class="form-control" id="jenis" name="jenis" required>
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
                                <th>Jenis Dokumen</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            if (isset($isi)) {
                                foreach ($isi as $row): ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $row['nama_jenis']; ?></td>
                                        <td>
                                            <a href="<?= base_url((session()->get('akses') == 'admin' ? 'admin/editjenis/' : 'pegawai/editjenis/') . $row['id_jenis']); ?>"
                                                class="btn btn-sm btn-warning">Edit</a>
                                            <a href="<?= base_url((session()->get('akses') == 'admin' ? 'admin/hapusjenis/' : 'pegawai/hapusjenis/') . $row['id_jenis']); ?>"
                                                class="btn btn-sm btn-danger"
                                                onclick="return confirm('Anda yakin ingin menghapus jenis dokumen ini?')">Hapus</a>
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