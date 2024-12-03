<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
   
    <title>Login</title>
    <link href="<?= base_url('/admin/css/styles.css') ?>" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <style>
        .alert {
            color: red;
            font-weight: bold;
        }

        body.bg-primary {
            background-image: url('/admin/assets/img/background.png');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
        }
    </style>
</head>

<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                <h1 class="text-center font-weight-light my-4">E-arsip</h1>
                                    <h3 class="text-center font-weight-light my-4">Login</h3>
                                </div>
                                <div class="card-body">

                                    <?php if (session()->getFlashdata('pesan')): ?>

                                        <div class="alert alert-danger">
                                            <?= session()->getFlashdata('pesan') ?>
                                        </div>
                                    <?php endif; ?>

                                    <form method="post" action="<?= base_url('login/login_action') ?>">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputUsername" name="username" type="text"
                                                placeholder="Username" required />
                                            <label for="inputUsername">Username</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputPassword" name="password"
                                                type="password" placeholder="Password" required />
                                            <label for="inputPassword">Password</label>
                                        </div>
                                       
                                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                          
                                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                                        </div>
                                    </form>
                                </div>
                               
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div id="layoutAuthentication_footer">
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; jidan 2024</div>
                      
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
    <!-- <script src="<?= base_url('js/scripts.js') ?>"></script> -->

</body>

</html>