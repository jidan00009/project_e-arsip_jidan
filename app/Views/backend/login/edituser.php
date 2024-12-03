<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
        <h1 class="mt-4">Edit Pengguna</h1>




            <style>
                /* Style untuk membuat tampilan formulir lebih menarik */
                .container-fluid.px-4 {
                    padding: 40px;
                }

                form.tambahakses {

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
                    /* max-width: 50%; */
                }
            </style>
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success">
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('errors')): ?>
                <div class="alert alert-danger">
                    <?php foreach (session()->getFlashdata('errors') as $error): ?>
                        <p><?= $error ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <form class="tambahakses" action="<?= site_url('admin/updateuser/' . $user['id_user']); ?>" method="post">
                <div class="row">
                    <div class="form-group">
                        <label for="username">User Name:</label>
                        <input type="text" class="form-control" id="username" name="username"
                            value="<?= $user['username']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama:</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="<?= $user['nama']; ?>"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="nip">NIP:</label>
                        <input type="text" class="form-control" id="nip" name="nip" value="<?= $user['nip']; ?>"
                            required pattern="[0-9]+">
                    </div>
                    <div class="form-group">
                        <label for="akses">Akses:</label>
                        <select class="form-control" id="akses" name="akses" required>
                            <option value="">Pilih Akses</option>
                            <?php foreach ($akses as $akses_item): ?>
                                <option value="<?= $akses_item; ?>" <?= ($akses_item == $user['akses']) ? 'selected' : ''; ?>>
                                    <?= $akses_item; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" id="password" name="password">
                        <small>Kosongkan jika tidak ingin mengubah password</small>
                    </div>
                    <div class="form-group">
                        <label for="verifikasi_password">Verifikasi Password:</label>
                        <input type="password" class="form-control" id="verifikasi_password" name="verifikasi_password">
                    </div>
                    <div class="btn-group">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <button type="button" class="btn btn-secondary" onclick="history.back()">Batal</button>
                    </div>
                </div>
            </form>





        </div>

    </main>