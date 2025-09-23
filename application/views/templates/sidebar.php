<link href="https://cdnjs.cloudflare.com/ajax/libs/nucleo/2.0.6/css/nucleo-icons.min.css" rel="stylesheet">

<style>
  .bg-dashboard {
    background: linear-gradient(135deg, #2C6A74, #5DA9B0) !important;
  }

  .sidenav {
    height: 100vh;
    overflow-y: auto;
  }

  @media (min-width: 1200px) {
    .main-content {
      margin-left: 270px;
      padding-right: 0.5rem;
    }
  }

  .modal-content {
    background-color: #ffffff;
    border-radius: 16px;
    padding: 2rem 1.5rem;
    border: none;
  }

  .modal-body i {
    font-size: 3rem;
    color: #FFA726;
  }

  .modal-body h5 {
    font-weight: 600;
    color: #2C6A74;
  }

  .modal-body .btn-outline-secondary {
    border-color: #2C6A74;
    color: #2C6A74;
  }

  .modal-body .btn-outline-secondary:hover {
    background-color: #2C6A74;
    color: white;
  }

  .modal-body .btn-danger {
    background-color: #FF5C5C;
    border-color: #FF5C5C;
  }

  .modal-body .btn-danger:hover {
    background-color: #e04b4b;
  }

  .sidebar-floating {
    position: fixed;
    top: 20px;
    left: 20px;
    width: 250px;
    top: 0;
    bottom: 0;
    height: auto;
    background-color: white;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    z-index: 1050;
    overflow-y: auto;
    padding-top: 20px;
  }

  .main-content {
    margin-left: 270px;
    transition: margin-left 0.3s ease;
  }

  @media (max-width: 1199px) {
    .sidebar-floating {
      position: fixed;
      top: 20px;
      left: 20px;
      width: 250px;
      top: 0;
      bottom: 0;
      height: auto;
      background-color: white;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      z-index: 1050;
      overflow-y: auto;
      padding-top: 20px;
    }

    .sidebar-floating.show {
      transform: translateX(0);
    }
  }

  @media (max-width: 1199px) {
    .main-content {
      margin-left: 0 !important;
      padding-right: 0.5rem;
    }
  }
   

  body,
  html {
    overflow-x: hidden;
  }
</style>

<body class="g-sidenav-show bg-gray-100 g-sidenav-pinned">

  <?php
  function active_menu($uri)
  {
    return uri_string() == $uri ? 'active bg-dashboard text-white' : 'text-dark';
  }

  function active_parent($keyword)
  {
    return strpos(uri_string(), $keyword) !== false ? 'bg-dashboard text-white' : 'text-dark';
  }

  ?>

  <aside id="sidebarToggle"
    class="sidenav navbar navbar-vertical sidebar-floating navbar-expand-xs border-radius-lg bg-white my-2 offcanvas-xl offcanvas-start d-xl-block"
    tabindex="-1">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-dark opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand px-4 py-3 m-0">
        <img src="<?php echo base_url() ?>assets/img/maskot.png" class="navbar-brand-img" width="30" height="30" alt="main_logo">
        <span class="ms-1 text-sm text-dark">ASTRA Selapan</span>
      </a>
    </div>
   
    <hr class="horizontal dark mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link <?php echo active_menu('dashboard'); ?>" href="<?php echo base_url('dashboard'); ?>">
            <i class="material-symbols-rounded opacity-5">dashboard</i>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>
        <li class="nav-item">
          <a data-bs-toggle="collapse" href="#submenuPasal"
            class="nav-link <?php echo active_parent('pasal'); ?>"
            aria-controls="submenuPasal" role="button"
            aria-expanded="<?php echo strpos(uri_string(), 'pasal') !== false ? 'true' : 'false'; ?>">
            <i class="material-symbols-rounded opacity-5">gavel</i>
            <span class="nav-link-text ms-1">Pasal</span>
          </a>

          <div class="collapse" id="submenuPasal">
            <ul class="nav ms-4 ps-3">
              <li class="nav-item">
                <a class="nav-link text-dark" href="<?php echo base_url('pasal/pasal_16'); ?>">Pasal 16</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-dark" href="<?php echo base_url('pasal/pasal_17'); ?>">Pasal 17</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-dark" href="<?php echo base_url('pasal/pasal_18'); ?>">Pasal 18</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-dark" href="<?php echo base_url('pasal/pasal_19'); ?>">Pasal 19</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-dark" href="<?php echo base_url('pasal/pasal_20'); ?>">Pasal 20</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-dark" href="<?php echo base_url('pasal/pasal_21'); ?>">Pasal 21</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-dark" href="<?php echo base_url('pasal/pasal_22'); ?>">Pasal 22</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-dark" href="<?php echo base_url('pasal/pasal_23'); ?>">Pasal 23</a>
              </li>
            </ul>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php echo active_menu('data_siswa'); ?>" href="<?php echo base_url('data_siswa'); ?>">
            <i class="material-symbols-rounded opacity-5">person_add</i>
            <span class="nav-link-text ms-1">Input Data Siswa</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php echo active_menu('pelanggaran'); ?>" href="<?php echo base_url('pelanggaran'); ?>">
            <i class="material-symbols-rounded opacity-5">error</i>
            <span class="nav-link-text ms-1">Input Pelanggaran</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php echo active_menu('kehadiran'); ?>" href="<?php echo base_url('kehadiran'); ?>">
            <i class="material-symbols-rounded opacity-5">how_to_reg</i>
            <span class="nav-link-text ms-1">Input Kehadiran</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php echo active_menu('revisi'); ?>" href="<?php echo base_url('revisi'); ?>">
            <i class="material-symbols-rounded opacity-5">autorenew</i>
            <span class="nav-link-text ms-1">Validasi Poin</span>
          </a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link text-danger" data-bs-toggle="modal" data-bs-target="#logoutModal">
            <i class="material-symbols-rounded opacity-5">logout</i>
            <span class="nav-link-text ms-1">Logout</span>
          </a>
        </li>
      </ul>
    </div>
  </aside>

  <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content text-center border-0 shadow-lg p-4">
        <div class="modal-body">
          <i class="fas fa-exclamation-circle fa-3x text-warning mb-3"></i>
          <h5 class="modal-title mb-3" id="logoutModalLabel">Apakah Anda yakin ingin logout?</h5>
          <div class="d-flex justify-content-center gap-2 mt-4">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
              Batal
            </button>
            <a href="<?= base_url('auth/logout') ?>" class="btn btn-danger">
              Ya, Logout
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="d-xl-none bg-white px-3 py-2 shadow-sm sticky-top zindex-sticky">
    <button class="btn btn-outline-dark" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarToggle" aria-controls="sidebarToggle">
      <i class="fas fa-bars"></i>
    </button>
  </div>

  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 shadow-none border-radius-xl">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm opacity-5 text-dark">
              <span>Pages</span>
            </li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page"><?php echo get_page_title(); ?></li>
          </ol>
        </nav>
      </div>
    </nav>

    <script src="../assets/js/material-dashboard.min.js?v=3.2.0"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>