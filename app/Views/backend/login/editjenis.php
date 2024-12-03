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
            <!-- editjenis.php -->

            <div class="container-fluid px-4">
                <form class="tambahjenis"
                    action="<?= site_url((session()->get('akses') == 'admin' ? 'admin/updatejenis/' : 'pegawai/updatejenis/') . $jenis['id_jenis']); ?>"
                    method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="form-group">
                            <label for="jenis">Jenis Dokumen</label>
                            <input type="text" class="form-control" id="jenis" name="jenis"
                                value="<?= $jenis['nama_jenis']; ?>" required>
                        </div>
                        <div class="btn-group">
                            <button type="submit" class="btn btn-primary"
                                onclick="return confirm('Perubahan mempengaruhi dokumen terkait, Anda yakin ingin merubah jenis dokumen ini?')">Simpan
                                Perubahan</button>
                            <button type="button" class="btn btn-secondary" onclick="history.back()">Batal</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatablesSimple" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>Jenis Dokumen</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td><?= $jenis['nama_jenis']; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>