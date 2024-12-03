<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>E-arsip</title>
<!-- CSS Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Custom CSS -->
<style>
    .profile-header {
        position: relative;
        display: inline-block;
    }

    .profile-header img {
        display: block;
        width: 150px;
        height: 150px;
        border-radius: 50%;
        transition: opacity 0.3s;
    }

    .profile-header:hover img {
        opacity: 0.7;
    }

    .profile-header .overlay {
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

    .profile-header:hover .overlay {
        opacity: 1;
        cursor: pointer;
    }
</style>


<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">Profile</div>
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
                    <li class="profile-header">
                        <img id="profileImage" src="<?= base_url('admin/assets/img/' . $loggedInUser['foto']); ?>"
                            class="img-circle" alt="Profile Image">
                        <div class="overlay" data-bs-toggle="modal" data-bs-target="#profileImageModal">
                            Ubah Gambar
                        </div>
                        <p>
                            <?= $loggedInUser['username']; ?> - <?= $loggedInUser['akses']; ?>
                            <small><?= $loggedInUser['nama']; ?> - NIP: <?= $loggedInUser['nip']; ?></small>
                        </p>
                    </li>
                </div>
            </div>
            <div class="sb-sidenav-footer">
                <a href="<?= site_url(session()->get('akses') == 'admin' ? 'admin/dashboard' : 'pegawai/dashboard'); ?>"
                    class="btn btn-primary". style="    background-color: #212529;">
                    Back
                </a>
            </div>

        </nav>
    </div>

    <!-- Popup Modal -->
    <div id="profileImageModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="profileImageModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="profileImageModalLabel">Update Gambar Profile </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?= site_url('admin/updateProfileImage'); ?>" method="post"
                        enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="profileImageInput">Pilih gambar profil baru</label>
                            <input type="file" class="form-control" id="profileImageInput" name="profile_image"
                                accept="image/*" required>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Upload</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </form>


                </div>
            </div>
        </div>


        <!-- JavaScript -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </div>