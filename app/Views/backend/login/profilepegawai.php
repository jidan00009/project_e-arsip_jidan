<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Profile</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                <li class="breadcrumb-item active">Profile</li>

            </ol>
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
  <!-- Display flash messages -->
  <?php if (session()->getFlashdata('success')): ?>
                        <div class="alert alert-success">
                            <?= session()->getFlashdata('success'); ?>
                        </div>
                    <?php elseif (session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger">
                            <?= session()->getFlashdata('error'); ?>
                        </div>
                    <?php endif; ?>

            <style>
                .d-flex {
                    display: flex;
                    justify-content: space-between;
                }

                .btn-left {
                    margin-right: auto;
                }

                .btn-right {
                    margin-left: auto;
                }

                .profile-container {
                    position: relative;
                    display: inline-block;
                }

                .profile-container img {
                    display: block;
                    width: 300px;

                    border-radius: 50%;
                    transition: opacity 0.3s;
                }

                .profile-container:hover img {
                    opacity: 0.7;
                }

                .profile-container .image-overlay {
                    position: absolute;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    background: rgba(128, 128, 128, 0.5);
                    /* gray transparent background */
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    opacity: 0;
                    transition: opacity 0.3s;
                    color: white;
                    font-weight: bold;
                    text-align: center;
                }

                .datatable-top {
                    display: none;
                }

                .profile-container:hover .image-overlay {
                    opacity: 1;
                    cursor: pointer;
                }
            </style>
            <center>
                <div class="profile-container">
                    <img id="profileImage" src="<?= base_url('admin/assets/img/' . $loggedInUser['foto']); ?>"
                        class="img-circle" alt="Profile Image">
                    <div class="image-overlay" data-bs-toggle="modal" data-bs-target="#profileImageModal">
                        Ubah Gambar
                    </div>

                </div>
            </center>
            <!-- Popup Modal -->
            <div id="profileImageModal" class="modal fade" tabindex="-1" role="dialog"
                aria-labelledby="profileImageModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="profileImageModalLabel">Update Profile Image</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="<?= site_url('pegawai/updateProfileImage'); ?>" method="post"
                                enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="profileImageInput">Choose a new profile image</label>
                                    <input type="file" class="form-control" id="profileImageInput" name="profile_image"
                                        accept="image/*" required>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Upload</button>
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex mb-4">

                <a href="<?= site_url('pegawai/ubahdatadiri'); ?>" class="btn btn-secondary btn-right">Ubah Data
                    Diri</a>
            </div>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Data Diri
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatablesSimple">


                            <thead>
                                <tr>
                                    <th data-sortable="false">Foto</th>
                                    <th data-sortable="false">Username</th>
                                    <th data-sortable="false">Nama</th>
                                    <th data-sortable="false">NIP</th>
                                    <th data-sortable="false">Akses</th>


                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th data-sortable="false">Foto</th>
                                    <th data-sortable="false">Username</th>
                                    <th data-sortable="false">Nama</th>
                                    <th data-sortable="false">NIP</th>
                                    <th data-sortable="false">Akses</th>


                                </tr>
                            </tfoot>
                            <tbody>
                                <?php foreach ($userdata as $user): ?>
                                    <tr>
                                        <td>
                                            <img src="<?= base_url('admin/assets/img/' . ($user['foto'] ?: 'profile.png')); ?>"
                                                alt="Foto Profil" width="50" height="50">
                                        </td>
                                        <td><?= $user['username']; ?></td>
                                        <td><?= $user['nama']; ?></td>
                                        <td><?= $user['nip']; ?></td>
                                        <td><?= $user['akses']; ?></td>



                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </main>