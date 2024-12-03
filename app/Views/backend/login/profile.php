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
            </style>
            <div class="d-flex mb-4">
                <a href="<?= site_url('admin/tambahuser'); ?>" class="btn btn-primary btn-left">Tambah User</a>
                <a href="<?= site_url('admin/ubahdatadiri'); ?>" class="btn btn-secondary btn-right">Ubah Data Diri</a>
            </div>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Data Pengguna
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>Foto</th>
                                    <th>Username</th>
                                    <th>Nama</th>
                                    <th>NIP</th>
                                    <th>Akses</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Foto</th>
                                    <th>Username</th>
                                    <th>Nama</th>
                                    <th>NIP</th>
                                    <th>Akses</th>
                                    <th>Aksi</th>
                                </tr>
                            </tfoot>
                            <!-- <tbody>
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
                                        <td>
                                            <button class="btn btn-secondary dropdown-toggle" type="button"
                                                id="dropdownMenuButton<?= $user['id_user']; ?>" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                                Aksi
                                            </button>
                                            <ul class="dropdown-menu"
                                                aria-labelledby="dropdownMenuButton<?= $user['id_user']; ?>">
                                                <li><a class="dropdown-item"
                                                        href="<?= site_url('admin/edituser/' . $user['id_user']); ?>">Edit</a>
                                                </li>
                                                <li><a class="dropdown-item"
                                                        href="<?= site_url('admin/deleteuser/' . $user['id_user']); ?>"
                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?');">Hapus</a>
                                                </li>
                                            </ul>
                                        </td>

                                    </tr>
                                <?php endforeach; ?>
                            </tbody> -->
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
                                        <td>
                                            <button class="btn btn-secondary dropdown-toggle" type="button"
                                                id="dropdownMenuButton<?= $user['id_user']; ?>" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                                Aksi
                                            </button>
                                            <ul class="dropdown-menu"
                                                aria-labelledby="dropdownMenuButton<?= $user['id_user']; ?>">
                                                <li><a class="dropdown-item"
                                                        href="<?= site_url('admin/edituser/' . $user['id_user']); ?>">Edit</a>
                                                </li>
                                                <?php if ($user['id_user'] != $loggedInUser['id_user']): ?>
                                                    <li><a class="dropdown-item"
                                                            href="<?= site_url('admin/deleteuser/' . $user['id_user']); ?>"
                                                            onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?');">Hapus</a>
                                                    </li>
                                                <?php endif; ?>
                                            </ul>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>


                        </table>
                    </div>
                </div>
            </div>

        </div>
    </main>