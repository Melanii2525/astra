<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" sizes="76x76" href="<?= base_url('assets/img/logo1.png'); ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url('assets/img/logo1.png'); ?>">
    <title>Selamat Datang | ASTRA</title>

    <!-- Bootstrap, Icons, AOS, Google Fonts -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        html,
        body {
            overflow-x: hidden;
        }

        body {
            background-color: #f1fbfb;
            font-family: 'Poppins', sans-serif;
            color: #333;
        }

        .navbar {
            background-color: #2c6a74;
        }

        .navbar-brand,
        .nav-link,
        .btn-outline-light {
            color: white !important;
        }

        .custom-text-primary,
        .custom-text-accent {
            color: #2c6a74;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
        }

        .hero {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background: linear-gradient(to right, #5da9b0, #aee3e0);
            color: white;
            text-align: center;
            padding: 60px 20px;
                overflow-x: hidden;
        }

        .hero h1 {
            font-size: 3rem;
        }

        .maskot-wrapper {
            position: relative;
            width: 100%;
            max-width: 350px;
            margin-left: 0;
            margin-right: auto;
            aspect-ratio: 1 / 1;
        }

        .fade-img {
            opacity: 0;
            transition: opacity 1s ease-in-out;
            position: absolute;
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .fade-img.active {
            opacity: 1;
            z-index: 2;
        }

        .feature-section {
            padding: 80px 0;
            background-color: #fff;
            text-align: center;
        }

        .feature-icon {
            font-size: 40px;
            color: #2c6a74;
            margin-bottom: 20px;
        }

        .cta-modern {
            background: linear-gradient(to right, #2c6a74, #5da9b0);
            color: white;
            padding: 80px 20px;
            border-radius: 40px;
            margin: 60px auto;
            max-width: 1140px;
        }

        .cta-modern img {
            max-height: 320px;
            width: auto;
        }

        footer {
            background-color: #1f3f44;
            color: white;
            padding: 20px 0;
            text-align: center;
        }

        .btn-light {
            background-color: white;
            color: #2c6a74;
            border: 2px solid #aee3e0;
            padding: 10px 25px;
            font-weight: 500;
            transition: all 0.3s ease;
            border-radius: 8px;
        }

        .btn-light:hover {
            background-color: #aee3e0;
            color: #1f3f44;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .btn-outline-light {
            border: 2px solid white;
            padding: 10px 25px;
            font-weight: 500;
            border-radius: 8px;
        }

        .btn-outline-light:hover {
            background-color: white;
            color: #2c6a74 !important;
        }

        @media (max-width: 768px) {
            .hero h1 {
                font-size: 2.2rem;
            }

            .cta-modern {
                border-radius: 20px;
                padding: 60px 20px;
            }

            .cta-modern img {
                max-height: 220px;
            }

            .maskot-wrapper {
                max-width: 240px;
            }
        }


    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">ASTRA Selapan</a>
            <!-- <div class="d-flex gap-2">
            <a href="<?= base_url('auth/login') ?>" class="btn btn-outline-light">Login</a>
            <a href="<?= base_url('auth/sign_up') ?>" class="btn btn-outline-light">Daftar</a>
        </div> -->
        </div>
    </nav>

    <section class="hero">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-start" data-aos="fade-right">
                    <h1 class="fw-bold">
                        Selamat datang di <span class="custom-text-primary">ASTRA</span> <span class="custom-text-accent">Selapan</span>
                    </h1>
                    <p class="lead mb-4">Pantau data siswa, kehadiran, dan poin pelanggaran secara mudah dan efisien.</p>
                    <a href="<?= base_url('auth/login') ?>" class="btn btn-light btn-lg">Login Sekarang</a>
                </div>
                <div class="col-md-6" data-aos="fade-left">
                    <div class="maskot-wrapper mx-auto mx-md-0">
                        <img src="<?= base_url('assets/img/gambar1.png') ?>" class="fade-img active">
                        <img src="<?= base_url('assets/img/gambar2.png') ?>" class="fade-img">
                        <img src="<?= base_url('assets/img/gambar3.png') ?>" class="fade-img">
                        <img src="<?= base_url('assets/img/gambar4.png') ?>" class="fade-img">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="feature-section">
        <div class="container">
            <h2 class="mb-5 fw-bold" data-aos="fade-up">Fitur Unggulan</h2>
            <div class="row g-5">
                <div class="col-md-3" data-aos="fade-up" data-aos-delay="100">
                    <div class="feature-icon"><i class="bi bi-person-lines-fill"></i></div>
                    <h5 class="fw-semibold">Data Siswa</h5>
                    <p>Kelola data siswa secara efisien.</p>
                </div>
                <div class="col-md-3" data-aos="fade-up" data-aos-delay="200">
                    <div class="feature-icon"><i class="bi bi-exclamation-triangle"></i></div>
                    <h5 class="fw-semibold">Pelanggaran</h5>
                    <p>Catat pelanggaran siswa dan secara otomatis.</p>
                </div>
                <div class="col-md-3" data-aos="fade-up" data-aos-delay="300">
                    <div class="feature-icon"><i class="bi bi-calendar-check"></i></div>
                    <h5 class="fw-semibold">Keterangan</h5>
                    <p>Input kehadiran dengan keterangan alpha yang dapat memengaruhi poin siswa.</p>
                </div>
                <div class="col-md-3" data-aos="fade-up" data-aos-delay="400">
                    <div class="feature-icon"><i class="bi bi-pencil-square"></i></div>
                    <h5 class="fw-semibold">Revisi Poin</h5>
                    <p>Revisi poin pelanggaran & kehadiran secara manual jika terjadi kesalahan input atau perubahan keputusan.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="cta-modern">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-7 text-center text-md-start mb-4 mb-md-0" data-aos="fade-right">
                    <h2 class="display-5 fw-bold mb-3 text-white">Transformasi Data Sekolah Jadi Lebih Mudah</h2>
                    <p class="lead text-white mb-4">
                        Mulai gunakan <strong>ASTRA Selapan</strong> untuk mengelola kehadiran, pelanggaran, dan informasi siswa secara efisien dan terstruktur.
                    </p>
                    <div class="d-flex flex-column flex-sm-row gap-3">
                        <!-- <a href="<?= base_url('auth/login') ?>" class="btn btn-light btn-lg">
                <i class="bi bi-box-arrow-in-right me-2"></i> Login Sekarang
                </a> -->
                        <a href="<?= base_url('auth/login') ?>" class="btn btn-outline-light btn-lg">
                            <i class="bi bi-pencil-square me-2"></i> Login Sekarang
                        </a>
                    </div>
                </div>
                <div class="col-md-5 text-center" data-aos="fade-left">
                    <img src="<?= base_url('assets/img/gambar1.png') ?>" alt="Ilustrasi" class="img-fluid">
                </div>
            </div>
        </div>
    </section>

    <footer>
        <div class="container">
            <small>&copy; <?= date('Y') ?> ASTRA Selapan. Dibuat dengan ❤ oleh Meyna.</small>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init();
        const images = document.querySelectorAll('.fade-img');
        let current = 0;
        setInterval(() => {
            images[current].classList.remove('active');
            current = (current + 1) % images.length;
            images[current].classList.add('active');
        }, 2000);
    </script>
</body>

</html>