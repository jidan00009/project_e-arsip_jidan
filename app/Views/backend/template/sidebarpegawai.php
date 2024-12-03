<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>E-arsip</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="/admin/css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <style>
        /* Custom styles if needed */
    </style>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand -->
        <a href="<?= site_url((session()->get('akses') == 'admin' ? 'admin/dashboard' : 'pegawai/dashboard')); ?>"
            class="navbar-brand ps-3">E-arsip</a>

        <!-- Sidebar Toggle -->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle"><i
                class="fas fa-bars"></i></button>

        <!-- Navbar Search -->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <!-- Add search form if needed -->
        </form>

        <!-- Navbar -->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown profile profile-menu">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <?php
                    $session = session();
                    $profileImage = $session->get('foto') ? base_url('admin/assets/img/' . $session->get('foto')) : base_url('admin/assets/img/profile.png');
                    ?>
                    <img src="<?= $profileImage; ?>" class="profile-image img-circle" alt="Profile Image">
                    <span class="hidden-xs"><?= $session->get('username'); ?></span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <!-- Profile image -->
                    <li class="profile-header">
                        <img src="<?= $profileImage; ?>" class="img-circle" alt="Profile Image">
                        <p>
                            <?= $session->get('username'); ?> - <?= $session->get('akses'); ?>
                            <small><?= $session->get('nama'); ?> - NIP: <?= $session->get('nip'); ?></small>
                        </p>
                    </li>
                    <!-- Menu Footer -->
                    <li class="profile-footer">
                        <div class="pull-left">
                            <a href="<?= site_url((session()->get('akses') == 'admin' ? 'admin/profile' : 'pegawai/profile')); ?>"
                                class="btn btn-default btn-flat">Profile</a>
                        </div>
                        <div class="pull-right">
                            <a href="<?= site_url('login/logout'); ?>" class="btn btn-default btn-flat">Sign out</a>
                        </div>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>

    <!-- Sidebar -->
    <div id="sidebar" class="sidebar">
        <!-- Sidebar content here -->
    </div>

    <!-- Page Content -->
    <div id="content">
        <!-- Page content here -->
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Popper.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function () {
            // Toggle sidebar
            $('#sidebarToggle').click(function () {
                $('#sidebar').toggleClass('active');
            });
        });
    </script>
</body>

</html>