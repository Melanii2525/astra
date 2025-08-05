<style>
  html, body {
  height: 100%;
  margin: 0;
}

body {
  display: flex;
  flex-direction: column;
}

.card {
  margin-bottom: 1.5rem; /* spasi sebelum footer */
}

footer.footer {
  flex-shrink: 0; /* footer tidak mengecil */
}

.main-content {
  flex: 1 0 auto;
  padding: 1rem 1rem; /* tambahkan default padding semua ukuran layar */
}

@media (min-width: 1200px) {
  .main-content {
    margin-left: 270px;
    padding-left: 2rem;
    padding-right: 2rem;
  }
}

</style>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded" rel="stylesheet">

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
                    onclick="window.location.href='<?= base_url('pelanggaran'); ?>'">
              Input Pelanggaran
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
</div>

<footer class="footer mt-auto py-4 bg-white shadow-sm">
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
  </footer>
  
  <script>
        if (document.querySelector('.input-group input')) {
          var inputs = document.querySelectorAll('.input-group input');
          inputs.forEach(input => {
            if (input.value != "") {
              input.parentElement.classList.add("is-filled");
            }

            input.addEventListener("focus", function () {
              input.parentElement.classList.add("is-focused");
            });

            input.addEventListener("blur", function () {
              if (input.value == "") {
                input.parentElement.classList.remove("is-filled");
              }
              input.parentElement.classList.remove("is-focused");
            });
          });
        }
      </script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
