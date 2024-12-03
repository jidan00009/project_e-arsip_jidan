<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Arsip Perumdam Tirta Khatulistiwa</title>
    
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="/admin/css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?= base_url('css/bootstrap.min.css'); ?>">
    
    <style>
        body {
            background: url('<?= base_url('admin/assets/img/bgberanda.jpg'); ?>') no-repeat center center fixed;
            background-size: cover;
            color: #ffffff; /* Menambahkan warna teks putih agar terlihat jelas di atas gambar */
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
        }
        .navbar {
            background-color: rgb(43 54 67 / 93%); /* Warna navbar dengan sedikit transparansi */
        }
        .navbar-brand {
            padding: 10px;
            font-size: 24px;
            font-weight: bold;
        }
        .navbar-brand span {
            color: #00a2a2; /* Warna akua muda */
        }
        .navbar-brand strong {
            color: #ffffff; /* Warna putih */
        }
        .main-content {
            flex-grow: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 20px;
            background-color: rgb(0 0 0 / 38%); /* Background semi-transparan untuk meningkatkan keterbacaan */
            border-radius: 10px; /* Radius sudut untuk elemen konten utama */
        }
        .welcome-text {
            margin-bottom: 20px;
            font-size: calc(1.2rem + 1.4vw); /* Ukuran font responsif */
        }
        .login-text {
            font-size: calc(1rem + 0.8vw); /* Ukuran font responsif yang lebih besar untuk teks login */
            margin-top: 10px;
        }
        .login-btn {
            margin-top: 10px;
            font-size: calc(0.9rem + 0.5vw); /* Ukuran font responsif untuk tombol */
            border: 2px solid #00a2a2; /* Border berwarna akua muda */
            border-radius: 5px; /* Radius sudut untuk border tombol */
            padding: 10px 20px; /* Padding di dalam tombol */
            background-color: #007bff; /* Warna latar belakang tombol */
            color: #ffffff; /* Warna teks tombol */
            text-decoration: none; /* Menghilangkan garis bawah pada teks tombol */
        }
        .login-btn:hover {
            background-color: #0056b3; /* Warna latar belakang tombol saat hover */
            border-color: #0056b3; /* Warna border tombol saat hover */
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark">
    <a class="navbar-brand" href="<?= base_url('/'); ?>">
        <span>PERUMDAM</span> <strong>TIRTA KHATULISTIWA</strong>
    </a>
</nav>

<div class="main-content">
    <div>
        <h1 class="welcome-text">Selamat Datang di Aplikasi E-Arsip</h1>
        <p class="welcome-text">Manfaatkan E-Arsip untuk mengelola arsip dengan mudah dan efisien.</p>
        <p class="login-text">Login untuk menikmati semua fitur </p>
        <a href="<?= base_url('/login'); ?>" class="btn login-btn">Login</a>
    </div>
</div>

<script src="<?= base_url('js/bootstrap.bundle.min.js'); ?>"></script>
</body>
</html>
