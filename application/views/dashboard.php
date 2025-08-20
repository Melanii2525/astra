<style>
  html,
  body {
    height: 100%;
    margin: 0;
  }

  body {
    display: flex;
    flex-direction: column;
  }

  .card {
    margin-bottom: 1.5rem;
    /* spasi sebelum footer */
  }

  footer.footer {
    flex-shrink: 0;
    /* footer tidak mengecil */
  }

  .main-content {
    flex: 1 0 auto;
    padding: 1rem 1rem;
    /* tambahkan default padding semua ukuran layar */
  }

  @media (min-width: 1200px) {
    .main-content {
      margin-left: 270px;
      padding-left: 2rem;
      padding-right: 2rem;
    }
  }
</style>

<!-- Bootstrap & Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<div class="container-fluid py-2">

  <div class="row">
    <div class="col-12 p-0">
      <h3 class="mb-3 h4 x">Dashboard</h3>

      <div class="card p-4 border-0" style="background-color: #D0EFEF; border-radius: 20px;">
        <div class="row align-items-center">
          <div class="col-md-7 col-12 mb-3 mb-md-0">
            <h4 class="fw-bold">Welcome to ASTRA SELAPAN!</h4>
            <p>Catat dan pantau pelanggaran siswa dengan cepat dan efisien melalui sistem tata tertib digital sekolah.</p>
            <button class="btn px-4 py-2 text-white mt-2"
              style="background-color: #2C6A74; border-radius: 30px;"
              onclick="window.location.href='<?= base_url('data_siswa'); ?>'">
              Input Data Siswa
            </button>
          </div>
          <div class="col-md-5 col-12 text-center">
            <img src="<?= base_url('assets/img/maskot.png'); ?>"
              alt="Robot Astra"
              class="img-fluid"
              style="max-height: 200px;">
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row mt-4">
    <!-- Ranking Siswa -->
    <div class="col-lg-8 col-md-7">
      <div class="card shadow-sm border-0" style="border-radius: 15px;">
        <div class="card-body">
          <h4 class="mb-3 font-weight-bold">Siswa dengan poin terbanyak</h4>

          <?php foreach ($ranking as $i => $row): ?>
            <div class="d-flex align-items-center p-2 mb-2 rounded"
              style="background-color: <?= ($i == 0) ? '#FFD70033' : (($i == 1) ? '#C0C0C033' : (($i == 2) ? '#CD7F3233' : '#F8F9FA')); ?>;">
              <div class="text-center mr-3"
                style="width: 35px; height: 35px; background-color: #2C6A74; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold;">
                <?= $i + 1 ?>
              </div>
              <div class="flex-grow-1">
                <h6 class="mb-0 font-weight-bold"><?= $row['nama_siswa'] ?></h6>
                <small class="text-muted"><?= $row['kelas'] ?></small>
              </div>
              <span class="badge 
              <?= ($row['poin'] <= 55) ? 'badge-success' : (($row['poin'] <= 150) ? 'badge-warning' : 'badge-danger') ?> p-2"
                style="min-width: 60px;">
                <?= $row['poin'] ?> Poin
              </span>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>

    <!-- Statistik Kanan -->
    <div class="col-lg-4 col-md-5">
      <div class="row">
        <h4 class="mb-3 font-weight-bold">Rekap Siswa</h4>
        <div class="col-6 mb-3">
          <div class="p-3 rounded shadow-sm text-center" style="background: #EAEFFF;">
            <h4 class="mb-0 font-weight-bold">
              <?= isset($total_pelanggaran_bulan_lalu) ? $total_pelanggaran_bulan_lalu : '0' ?>
            </h4>
            <small class="text-muted">PELANGGARAN BULAN LALU</small>
          </div>
        </div>
        <div class="col-6 mb-3">
          <div class="p-3 rounded shadow-sm text-center" style="background: #FFEAF4;">
            <h4 class="mb-0 font-weight-bold">
              <?= isset($total_alpha_bulan_lalu) ? $total_alpha_bulan_lalu : '0' ?>
            </h4>
            <small class="text-muted">ALPHA BULAN LALU</small>
          </div>
        </div>
        <div class="col-6">
          <div class="p-3 rounded shadow-sm text-center" style="background: #FFF5E0;">
            <h4>
              <?= isset($total_terlambat_hari_ini) ? $total_terlambat_hari_ini : '0' ?>
            </h4>
            <small class="text-muted">TERLAMBAT HARI INI</small>
          </div>
        </div>
        <div class="col-6">
          <div class="p-3 rounded shadow-sm text-center" style="background: #FFF4E5;">
            <h4>
              <?= isset($total_siswa_treatment_tahun_ini) ? $total_siswa_treatment_tahun_ini : '0' ?>
            </h4>
            <small class="text-muted">TREATMENT TAHUN INI</small>
          </div>
        </div>
      </div>
    </div>
  </div>


</div>

<!-- <footer class="footer mt-auto py-4 bg-white shadow-sm">
    <div class="container-fluid">
      <div class="row align-items-center justify-content-between">
        <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
          <span class="text-sm text-muted">
            © <script>document.write(new Date().getFullYear())</script>, made with ❤️ by 
            <a href="https://www.creative-tim.com" target="_blank" class="text-decoration-none fw-bold">Meyna</a>
          </span>
        </div>
        <div class="col-md-6">
          <ul class="nav justify-content-center justify-content-md-end">
            <li class="nav-item">
              <a class="nav-link text-muted px-2" href="#">Creative Tim</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-muted px-2" href="#">About Us</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-muted px-2" href="#">Blog</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-muted px-2" href="#">License</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </footer> -->

<script>
  if (document.querySelector('.input-group input')) {
    var inputs = document.querySelectorAll('.input-group input');
    inputs.forEach(input => {
      if (input.value != "") {
        input.parentElement.classList.add("is-filled");
      }

      input.addEventListener("focus", function() {
        input.parentElement.classList.add("is-focused");
      });

      input.addEventListener("blur", function() {
        if (input.value == "") {
          input.parentElement.classList.remove("is-filled");
        }
        input.parentElement.classList.remove("is-focused");
      });
    });
  }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>