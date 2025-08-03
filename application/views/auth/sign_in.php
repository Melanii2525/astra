<!DOCTYPE html>
<html lang="en">

<head>
  <base href="<?= base_url(); ?>">
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="<?= base_url('assets/img/apple-icon.png'); ?>">
  <link rel="icon" type="image/png" href="<?= base_url('assets/img/favicon.png'); ?>">
  <title>ASTRA Selapan - Sign In</title>

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,900" />
  <link href="<?= base_url('assets/css/nucleo-icons.css'); ?>" rel="stylesheet" />
  <link href="<?= base_url('assets/css/nucleo-svg.css'); ?>" rel="stylesheet" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />

  <link id="pagestyle" href="<?= base_url('assets/css/material-dashboard.css?v=3.2.0'); ?>" rel="stylesheet" />
</head>

<body class="bg-gray-200">
  <div class="container position-sticky z-index-sticky top-0">
    <div class="row">
      <div class="col-12">
        <nav class="navbar navbar-expand-lg blur border-radius-xl top-0 z-index-3 shadow position-absolute my-3 py-2 start-0 end-0 mx-4">
          <div class="container-fluid ps-2 pe-0">
            <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3" href="#">ASTRA Selapan</a>
            <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navigation">
              <span class="navbar-toggler-icon mt-2">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </span>
            </button>
            <div class="collapse navbar-collapse" id="navigation">
              <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                  <a class="nav-link me-2" href="<?= base_url('auth/sign_up'); ?>">Sign Up</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link me-2 active" href="<?= base_url('auth/login'); ?>">Sign In</a>
                </li>
              </ul>
            </div>
          </div>
        </nav>
      </div>
    </div>
  </div>

  <main class="main-content mt-0">
    <section>
      <div class="page-header align-items-start min-vh-100" style="background-color: #AEE3E0;">
        <div class="container my-auto">
          <div class="row">
            <div class="col-lg-4 col-md-8 col-12 mx-auto">
              <div class="card z-index-0 fadeIn3 fadeInBottom">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                  <div class="shadow-dark border-radius-lg py-3 pe-1" style="background-color: #2C6A74;">
                    <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">Sign In</h4>
                  </div>
                </div>
                <div class="card-body">
                  <style>
                    .form-control-custom {
                      border: 1px solid #2C6A74;
                      border-radius: 6px;
                      padding: 8px 10px;
                      font-size: 14px;
                      width: 100%;
                      transition: border-color 0.3s;
                      color: #2C6A74;
                    }

                    .form-control-custom:focus {
                      border-color: #2C6A74;
                      outline: none;
                      box-shadow: none;
                    }

                    .form-label-custom {
                      display: block;
                      margin-bottom: 4px;
                      color: #2C6A74;
                      font-weight: 500;
                      font-size: 13px;
                    }

                    .form-check-input-custom {
                      accent-color: #2C6A74;
                      width: 16px;
                      height: 16px;
                    }

                    .btn-custom {
                      background-color: #2C6A74;
                      color: white;
                      font-weight: 600;
                      padding: 8px;
                      border-radius: 6px;
                      width: 100%;
                      font-size: 14px;
                      border: none;
                    }

                    .btn-custom:hover {
                      background-color: #24585f;
                    }

                    .text-link-custom {
                      color: #2C6A74;
                      font-weight: 600;
                      font-size: 13px;
                      text-decoration: none;
                    }

                    .text-link-custom:hover {
                      text-decoration: underline;
                    }

                    .text-sm {
                      font-size: 13px;
                    }

                    .toggle-password {
                      position: absolute;
                      right: 12px;
                      top: 36px;
                      cursor: pointer;
                      color: #2C6A74;
                    }
                  </style>

                  <?php if ($this->session->flashdata('error')) : ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                      <?= $this->session->flashdata('error'); ?>
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                  <?php endif; ?>

                  <form action="<?= base_url('auth/login'); ?>" method="post" class="text-start">
                    <div class="mb-2">
                      <label class="form-label-custom">Email</label>
                      <input type="email" name="email" class="form-control-custom" required>
                      <?= form_error('email', '<div class="text-danger small">', '</div>'); ?>
                    </div>
                    <div class="mb-2 position-relative">
                      <label class="form-label-custom">Password</label>
                      <input type="password" name="password" class="form-control-custom" id="passwordInput">
                      <span class="toggle-password" onclick="togglePassword()">
                        <i class="fas fa-eye" id="eyeIcon"></i>
                      </span>
                      <?= form_error('password', '<small class="text-danger">', '</small>') ?>
                    </div>
                    <div class="form-check d-flex align-items-center mb-2">
                      <input class="form-check-input-custom me-2" type="checkbox" id="rememberMe" checked>
                      <label class="form-check-label text-sm" for="rememberMe">Remember me</label>
                    </div>
                    <div class="text-center">
                      <button type="submit" class="btn-custom mt-2">Sign In</button>
                    </div>
                    <p class="mt-3 text-sm text-center">
                      Don't have an account?
                      <a href="<?= base_url('auth/sign_up'); ?>" class="text-link-custom">Sign up</a>
                    </p>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

  <script src="<?= base_url('assets/js/core/popper.min.js'); ?>"></script>
  <script src="<?= base_url('assets/js/core/bootstrap.min.js'); ?>"></script>
  <script src="<?= base_url('assets/js/plugins/perfect-scrollbar.min.js'); ?>"></script>
  <script src="<?= base_url('assets/js/plugins/smooth-scrollbar.min.js'); ?>"></script>

  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), {
        damping: '0.5'
      });
    }
  </script>

  <script>
    function togglePassword() {
      const input = document.getElementById('passwordInput');
      const icon = document.getElementById('eyeIcon');
      if (input.type === 'password') {
        input.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
      } else {
        input.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
      }
    }
  </script>

  <script src="<?= base_url('assets/js/material-dashboard.min.js?v=3.2.0'); ?>"></script>
</body>
</html>