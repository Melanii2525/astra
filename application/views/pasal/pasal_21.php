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

  html, body {
  max-width: 100%;
  overflow-x: hidden;
}
</style>

<div class="container-fluid py-5">
  <div class="row">
    <div class="col-12 px-4"></div>
      <h3 class="mb-0 h4 fw-bold">Pasal 21</h3>
      <p class="mb-4">Sanksi dan Penanganan Pelanggaran</p>
    </div>

    <div class="col-12">
      <div class="card h-100 w-100">
        <div class="card-body p-3">
          <div class="table-responsive">
            <table class="table table-bordered table-sm text-dark text-sm align-middle" style="font-size: 13px;">
              <thead class="table-light text-center">
                <tr>
                  <th style="width: 4%;">No.</th>
                  <th style="width: 18%;">Kategori</th>
                  <th style="width: 13%;">Poin</th>
                  <th style="width: 10%;">Predikat</th>
                  <th style="width: 6%;">Huruf</th>
                  <th style="width: 49%;">Tindak Lanjut</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td class="text-center">1</td>
                  <td>Pelanggaran sangat ringan</td>
                  <td class="text-center">0 – 10</td>
                  <td class="text-center">Sangat Baik</td>
                  <td class="text-center">SB</td>
                  <td>Pengarahan Tim Tatib</td>
                </tr>
                <tr>
                  <td class="text-center" rowspan="2">2</td>
                  <td rowspan="2">Pelanggaran ringan</td>
                  <td class="text-center">11 – 35</td>
                  <td class="text-center">Baik</td>
                  <td class="text-center">B</td>
                  <td>Peringatan ke I (Petugas Ketertiban)</td>
                </tr>
                <tr>
                  <td class="text-center">36 – 55</td>
                  <td class="text-center">Baik</td>
                  <td class="text-center">B</td>
                  <td>Peringatan ke II (Koordinator Ketertiban)</td>
                </tr>
                <tr>
                  <td class="text-center" rowspan="3">3</td>
                  <td rowspan="3">Pelanggaran sedang</td>
                  <td class="text-center">56 – 75</td>
                  <td class="text-center">Cukup</td>
                  <td class="text-center">C</td>
                  <td>Panggilan Orang tua ke I (oleh Wali Kelas) + Form Treatment <br>(Petugas Ketertiban)</td>
                </tr>
                <tr>
                  <td class="text-center">76 – 100</td>
                  <td class="text-center">Cukup</td>
                  <td class="text-center">C</td>
                  <td>Panggilan Orang tua ke II (oleh Wali Kelas dan Guru BK) + <br>Surat Peringatan I</td>
                </tr>
                <tr>
                  <td class="text-center">101 – 150</td>
                  <td class="text-center">Cukup</td>
                  <td class="text-center">C</td>
                  <td>Panggilan Orang tua ke III (oleh Wali Kelas dan Guru BK) + <br>Surat Peringatan II</td>
                </tr>
                <tr>
                  <td class="text-center" rowspan="3">4</td>
                  <td rowspan="3">Pelanggaran berat</td>
                  <td class="text-center">151 – 200</td>
                  <td class="text-center">Kurang</td>
                  <td class="text-center">K</td>
                  <td>Panggilan Orang tua ke IV (oleh Wali Kelas, Guru BK, dan Koord. Tatib) + <br>Surat Peringatan III</td>
                </tr>
                <tr>
                  <td class="text-center">201 – 249</td>
                  <td class="text-center">Kurang</td>
                  <td class="text-center">K</td>
                  <td>Skorsing (Waka Kesiswaan)</td>
                </tr>
                <tr>
                  <td class="text-center">250 ke atas</td>
                  <td class="text-center">Kurang</td>
                  <td class="text-center">K</td>
                  <td>Dikembalikan ke orang tua (Kepala Sekolah)</td>
                </tr>
              </tbody>
            </table>
          </div>

          <div class="mt-4 text-sm">
            <strong>Catatan:</strong>
            <ol class="mb-0">
              <li>Pelanggaran insidental langsung diberi sanksi oleh petugas tatib.</li>
              <li>Penghargaan atas perubahan sikap dan tingkah laku pada saat proses treatment akan menjadi pertimbangan pengurangan poin bagi peserta didik yang melanggar.</li>
              <li>
                Nilai perkembangan karakter berdasarkan komponen non akademik (kesiswaan) diambil dari ranah kelakuan, kerajinan dan kerapian berupa deskripsi dari konversi nilai SB, B, C, dan K.
              </li>
            </ol>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<canvas id="myChart" style="display: none;"></canvas>