<style>
  .tab-kategori {
    background-color: #aee3e0;
    color: #2c6a74;
    margin-right: 10px;
    font-weight: 500;
    transition: 0.3s;
    border-radius: 8px;
  }

  .tab-kategori:hover {
    background-color: #5da9b0;
    color: white;
  }

  .tab-kategori.active {
    background: linear-gradient(135deg, #2C6A74, #5DA9B0) !important;
    color: white !important;
    box-shadow: 0 4px 10px rgba(45, 106, 116, 0.4);
  }

  thead.table-light {
    background-color: #AEE3E0 !important;
  }

  table.table-bordered th,
  table.table-bordered td {
    border: 1px solid #2C6A74 !important;
    vertical-align: middle;
    font-weight: 500; 
  }

  table.table-bordered th {
    background-color: #2C6A74 !important;
    color: white;
  }

  table.table-bordered td {
    background-color: #f9fdfd; 
  }

  /* Mencegah scroll horizontal di seluruh halaman */
html, body {
  overflow-x: hidden;
  width: 100%;
}

/* Untuk responsif tab kategori */
.nav-pills {
  flex-wrap: wrap;
  gap: 0.5rem;
  justify-content: start;
}

/* Perbaiki tabel agar tetap dalam layar kecil */
.table-responsive {
  overflow-x: auto;
}

/* Untuk teks panjang pada kolom tabel */
.table td, .table th {
  word-wrap: break-word;
  word-break: break-word;
  white-space: normal;
}

/* Responsive tab button padding */
.tab-kategori {
  padding: 0.5rem 1rem;
  font-size: 0.9rem;
}

/* Perbaikan layout tombol nav agar tidak memaksa lebar */
ul#kategoriTab {
  padding-left: 1rem;
  padding-right: 1rem;
}

.table td.long-text,
.table th.long-text {
  word-wrap: break-word;
  word-break: break-word;
  white-space: normal;
}

.table td.text-center,
.table th.text-center {
  white-space: nowrap !important;
}

.table td, .table th {
  font-size: 14px;
  padding: 8px;
}


</style>



<div class="container-fluid py-5">
  <div class="row">
    <div class="col-12 px-4">
      <h3 class="mb-0 h4 fw-bold">Pasal 20</h3>
      <p class="mb-4">Kategori Pelanggaran</p>
    </div>

    <ul class="nav nav-pills mb-4 px-3 d-flex flex-wrap gap-2" id="kategoriTab" role="tablist">
      <li class="nav-item" role="presentation">
        <button class="nav-link active tab-kategori" id="kelakuan-tab" data-bs-toggle="tab" data-bs-target="#kelakuan" type="button" role="tab">A. Kelakuan</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link tab-kategori" id="kerajinan-tab" data-bs-toggle="tab" data-bs-target="#kerajinan" type="button" role="tab">B. Kerajinan</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link tab-kategori" id="kerapian-tab" data-bs-toggle="tab" data-bs-target="#kerapian" type="button" role="tab">C. Kerapian</button>
      </li>
    </ul>

    <div class="tab-content" id="kategoriTabContent">

      <div class="tab-pane fade show active" id="kelakuan" role="tabpanel">
      <div class="col-12">
      <div class="card h-100 w-100">
        <div class="card-header pb-0">
          <h6 class="fw-semibold">A. Kelakuan</h6>
        </div>
        <div class="card-body p-3">
          <div class="table-responsive">
            <table class="table table-bordered text-dark text-sm w-100" style="table-layout: fixed;">
              <thead class="table-light">
              <th class="text-center" style="width: 5%;">No.</th>
              <th class="text-center long-text" style="width: 75%;">Jenis Pelanggaran</th>
              <th class="text-center" style="width: 10%;">Poin</th>
              </thead>
              <tbody>
                <tr><td class="text-center">1</td><td class="long-text">Tidak membawa alat atau bahan pembelajaran yang disepakati</td><td class="text-center">10</td></tr>
                <tr><td class="text-center">2</td><td class="long-text">Membuat kegaduhan di kelas atau di sekolah</td><td class="text-center">10</td></tr>
                <tr><td class="text-center">3</td><td class="long-text">Mencoret-coret atau mengotori dinding, pintu, meja, kursi, dan pagar sekolah</td><td class="text-center">10</td></tr>
                <tr><td class="text-center">4</td><td class="long-text">Membawa atau bermain kartu remi dan domino atau sejenisnya di sekolah</td><td class="text-center">10</td></tr>
                <tr><td class="text-center">5</td><td class="long-text">Memarkir sepeda/motor tidak pada tempatnya</td><td class="text-center">10</td></tr>
                <tr><td class="text-center">6</td><td class="long-text">Bermain bola di koridor dan di dalam kelas</td><td class="text-center">10</td></tr>
                <tr><td class="text-center">7</td><td class="long-text">Menyontek</td><td class="text-center">10</td></tr>
                <tr><td class="text-center">8</td><td class="long-text">Menggunakan kendaraan bermotor tidak sesuai dengan standar kepolisian dan/atau tidak dilengkapi dengan persuratan mengendarai</td><td class="text-center">10</td></tr>
                <tr><td class="text-center">9</td><td class="long-text">Melindungi teman yang bersalah</td><td class="text-center">15</td></tr>
                <tr><td class="text-center">10</td><td class="long-text">Menggunakan handphone pada waktu KBM yang tidak sesuai kesepakatan</td><td class="text-center">20</td></tr>
                <tr><td class="text-center">11</td><td class="long-text">Berpacaran di Sekolah</td><td class="text-center">20</td></tr>
                <tr><td class="text-center">12</td><td class="long-text">Merayakan ulang tahun berlebihan</td><td class="text-center">20</td></tr>
                <tr><td class="text-center">13</td><td class="long-text">Mengabaikan surat panggilan dari sekolah</td><td class="text-center">20</td></tr>
                <tr><td class="text-center">14</td><td class="long-text">Mengabaikan panggilan guru, kepala sekolah atau karyawan</td><td class="text-center">20</td></tr>
                <tr><td class="text-center">15</td><td class="long-text">Menyalahgunakan uang Program Tambahan</td><td class="text-center">25</td></tr>
                <tr><td class="text-center">16</td><td class="long-text">Berperilaku atau melakukan perbuatan asusila baik di dalam maupun di luar sekolah</td><td class="text-center">25</td></tr>
                <tr><td class="text-center">17</td><td class="long-text">Mencemarkan nama baik sekolah, guru, kepala sekolah atau karyawan</td><td class="text-center">25</td></tr>
                <tr><td class="text-center">18</td><td class="long-text">Membawa atau membunyikan petasan</td><td class="text-center">30</td></tr>
                <tr><td class="text-center">19</td><td class="long-text">Membuat surat izin palsu</td><td class="text-center">40</td></tr>
                <tr><td class="text-center">20</td><td class="long-text">Meloncat jendela dan pagar sekolah</td><td class="text-center">40</td></tr>
                <tr><td class="text-center">21</td><td class="long-text">Merusak sarana dan prasarana sekolah</td><td class="text-center">40</td></tr>
                <tr><td class="text-center">22</td><td class="long-text">Bertindak tidak sopan / melecehkan Kepala Sekolah, guru dan karyawan di sekolah</td><td class="text-center">50</td></tr>
                <tr><td class="text-center">23</td><td class="long-text">Memalsu tandatangan orang tua, guru, kepala sekolah, dan karyawan</td><td class="text-center">50</td></tr>
                <tr><td class="text-center">24</td><td class="long-text">Mengancam / mengintimidasi teman sekelas / teman sekolah</td><td class="text-center">75</td></tr>
                <tr><td class="text-center">25</td><td class="long-text">Mengancam / mengintimidasi Kepala Sekolah, guru dan karyawan</td><td class="text-center">100</td></tr>
                <tr><td class="text-center">26</td><td class="long-text">Membawa / merokok saat masih mengenakan seragam sekolah</td><td class="text-center">100</td></tr>
                <tr><td class="text-center">27</td><td class="long-text">Menyalahgunakan media sosial yang merugikan pihak lain yang berhubungan dengan sekolah</td><td class="text-center">100</td></tr>
                <tr><td class="text-center">28</td><td class="long-text">Berjudi dalam bentuk apapun di sekolah</td><td class="text-center">150</td></tr>
                <tr><td class="text-center">29</td><td class="long-text">Membawa senjata tajam, senjata api dsb. di sekolah</td><td class="text-center">150</td></tr>
                <tr><td class="text-center">30</td><td class="long-text">Terlibat langsung maupun tidak langsung perkelahian/tawuran di sekolah, di luar sekolah atau antar sekolah</td><td class="text-center">150</td></tr>
                <tr><td class="text-center">31</td><td class="long-text">Terlibat langsung maupun tidak langsung perkelahian/tawuran di sekolah, di luar sekolah atau antar sekolah</td><td class="text-center">150</td></tr>
                <tr><td class="text-center">32</td><td class="long-text">Membawa dan/atau membuat VCD Porno, buku porno, majalah porno atau sesuatu yang berbau pornografi dan pornoaksi</td><td class="text-center">200</td></tr>
                <tr><td class="text-center">33</td><td class="long-text">Mencuri di sekolah dan di luar sekolah</td><td class="text-center">200</td></tr>
                <tr><td class="text-center">34</td><td class="long-text">Membawa, menggunakan atau mengedarkan miras dan narkoba</td><td class="text-center">250</td></tr>
                <tr><td class="text-center">35</td><td class="long-text">Memalsukan stempel sekolah dan edaran sekolah</td><td class="text-center">250</td></tr>
                <tr><td class="text-center">36</td><td class="long-text">Terlibat tindakan kriminal, mencemarkan nama baik sekolah</td><td class="text-center">250</td></tr>
                <tr><td class="text-center">37</td><td class="long-text">Terbukti hamil atau menghamili</td><td class="text-center">250</td></tr>
                <tr><td class="text-center">38</td><td class="long-text">Terbukti menikah</td><td class="text-center">250</td></tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      </div>
      </div>

      <div class="tab-pane fade" id="kerajinan" role="tabpanel">
      <div class="col-12">
      <div class="card h-100 w-100">
        <div class="card-header pb-0">
          <h6 class="fw-semibold">B. Kerajinan</h6>
        </div>
        <div class="card-body p-3">
          <div class="table-responsive">
            <table class="table table-bordered text-dark text-sm w-100" style="table-layout: fixed;">
              <thead class="table-light">
                <tr>
                  <th class="text-center"style="width: 5%;">No.</th>
                  <th class="text-center" style="width: 75%; word-wrap: break-word;">Jenis Pelanggaran</th>
                  <th class="text-center" style="width: 10%;">Poin</th>
                </tr>
              </thead>
              <tbody>
                <tr><td class="text-center">1</td><td style="word-wrap: break-word;">Datang terlambat</td><td class="text-center">2</td></tr>
                <tr><td class="text-center">2</td><td style="word-wrap: break-word;">Di kantin saat jam pelajaran</td><td class="text-center">3</td></tr>
                <tr><td class="text-center">3</td><td style="word-wrap: break-word;">Tidak mengikuti dan melaksanakan piket 7K</td><td class="text-center">3</td></tr>
                <tr><td class="text-center">4</td><td style="word-wrap: break-word;">Tidur di kelas saat pelajaran berlangsung</td><td class="text-center">3</td></tr>
                <tr><td class="text-center">5</td><td style="word-wrap: break-word;">Membawa alat/bahan yang tidak berkaitan dengan pelajaran (gitar dll)</td><td class="text-center">3</td></tr>
                <tr><td class="text-center">6</td><td style="word-wrap: break-word;">Tidak mengikuti kegiatan ekstrakurikuler tanpa keterangan</td><td class="text-center">3</td></tr>
                <tr><td class="text-center">7</td><td style="word-wrap: break-word;">Meninggalkan kelas tanpa izin</td><td class="text-center">7</td></tr>
                <tr><td class="text-center">8</td><td style="word-wrap: break-word;">Pulang sebelum waktunya tanpa izin dari sekolah</td><td class="text-center">7</td></tr>
                <tr><td class="text-center">9</td><td style="word-wrap: break-word;">Tidak masuk sekolah tanpa keterangan</td><td class="text-center">7</td></tr>
                <tr><td class="text-center">10</td><td style="word-wrap: break-word;">Tidak mengikuti kegiatan sekolah</td><td class="text-center">7</td></tr>
                <tr><td class="text-center">11</td><td style="word-wrap: break-word;">Tidak mengikuti upacara</td><td class="text-center">10</td></tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      </div>
      </div>

      <div class="tab-pane fade" id="kerapian" role="tabpanel">
      <div class="col-12">
      <div class="card h-100 w-100">
        <div class="card-header pb-0">
          <h6 class="fw-semibold">C. Kerapian</h6>
        </div>
        <div class="card-body p-3">
          <div class="table-responsive">
            <table class="table table-bordered text-dark text-sm w-100" style="table-layout: fixed;">
            <thead class="table-light">
              <tr>
                <th class="text-center" style="width: 5%;">No.</th>
                <th class="text-center long-text" style="width: 75%;">Jenis Pelanggaran</th>
                <th class="text-center" style="width: 10%;">Poin</th>
              </tr>
            </thead>

              <tbody>
                <tr><td class="text-center">1</td><td class="long-text">Siswa putra memakai perhiasan (gelang, kalung, dll)</td><td class="text-center">2</td></tr>
                <tr><td class="text-center">2</td><td class="long-text">Siswa putri memakai perhiasan serta make up berlebihan</td><td class="text-center">2</td></tr>
                <tr><td class="text-center">3</td><td class="long-text">Memakai jaket/sweater di dalam lingkungan sekolah (kecuali ada surat ijin)</td><td class="text-center">2</td></tr>
                <tr><td class="text-center">4</td><td class="long-text">Tidak berseragam sesuai dengan ketentuan</td><td class="text-center">4</td></tr>
                <tr><td class="text-center">5</td><td class="long-text">Melipat lengan baju, baju tidak dikancingkan</td><td class="text-center">4</td></tr>
                <tr><td class="text-center">6</td><td class="long-text">Seragam yang dicoret-coret</td><td class="text-center">4</td></tr>
                <tr><td class="text-center">7</td><td class="long-text">Rambut tidak rapi (putra maksimal 5 cm) atau rambut panjang terurai (putri)</td><td class="text-center">4</td></tr>
                <tr><td class="text-center">8</td><td class="long-text">Mewarnai rambut selain hitam</td><td class="text-center">4</td></tr>
                <tr><td class="text-center">9</td><td class="long-text">Celana atau rok sobek</td><td class="text-center">4</td></tr>
                <tr><td class="text-center">10</td><td class="long-text">Tidak memakai kaos kaki</td><td class="text-center">4</td></tr>
                <tr><td class="text-center">11</td><td class="long-text">Memakai kaos kaki tidak sesuai ketentuan</td><td class="text-center">4</td></tr>
                <tr><td class="text-center">12</td><td class="long-text">Tidak memakai ikat pinggang</td><td class="text-center">4</td></tr>
                <tr><td class="text-center">13</td><td class="long-text">Memakai ikat pinggang tidak sesuai dengan ketentuan (hitam)</td><td class="text-center">4</td></tr>
                <tr><td class="text-center">14</td><td class="long-text">Seragam atribut tidak lengkap</td><td class="text-center">4</td></tr>
                <tr><td class="text-center">15</td><td class="long-text">Tidak memakai sepatu hitam polos</td><td class="text-center">4</td></tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      </div>
      </div>
    </div>
  </div>
</div>

<canvas id="myChart" style="display: none;"></canvas>
