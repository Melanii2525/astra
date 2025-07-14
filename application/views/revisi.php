<style>
  body {
    background-color: #d0efef;
  }
  .container {
    max-width: 700px;
    margin: auto;
  }
  .timeline {
    position: relative;
    padding-left: 40px;
  }
  .timeline-item {
    position: relative;
    margin-bottom: 30px;
  }
  .timeline-line {
    position: absolute;
    left: -18px;
    top: 0;
    width: 12px;
    height: 12px;
    background-color: #5da9b0;
    border-radius: 50%;
    border: 3px solid white;
    z-index: 1;
  }
  .timeline-line::after {
    content: '';
    position: absolute;
    left: 4px;
    top: 12px;
    width: 3px;
    height: 100%;
    background-color: #5da9b0;
  }
  .course-card {
    border-radius: 12px;
    padding: 20px;
    color: #2c6a74;
  }
  .bg-soft-blue {
    background-color: #aee3e0;
  }
  .bg-soft-teal {
    background-color: #d0efef;
  }
  .bg-soft-pink {
    background-color: #fbe6e6;
  }
  .course-title {
    font-weight: bold;
    font-size: 1.1rem;
    margin-bottom: 6px;
  }
  .course-desc, .course-info {
    margin: 0;
    font-size: 0.9rem;
    color: #2c6a74;
  }
  .badge {
    padding: 5px 10px;
    font-size: 0.8rem;
    border-radius: 20px;
    margin-top: 10px;
    display: inline-block;
  }
  .bg-green {
    background-color: #4caf50;
    color: white;
  }
  .bg-dark-blue {
    background-color: #2c6a74;
    color: white;
  }
</style>

<?php
$page_title = "Revisi Poin";
?>

<!-- <div class="container py-4"> -->
  <h4 class="mb-4">Revisi Poin Siswa</h4>
  <div class="timeline">

    <!-- Card 1 -->
    <div class="timeline-item">
      <div class="timeline-line"></div>
      <div class="card course-card bg-soft-blue">
        <div class="card-body">
          <h6 class="course-title">UX/UI Design &mdash; Website</h6>
          <p class="course-desc">Komposisi, tipografi, teori warna, dll.</p>
          <p class="course-info">68 pelajaran</p>
          <span class="badge bg-green">Selesai</span>
        </div>
      </div>
    </div>

    <!-- Card 2 -->
    <div class="timeline-item">
      <div class="timeline-line"></div>
      <div class="card course-card bg-soft-teal">
        <div class="card-body">
          <h6 class="course-title">UX/UI Design &mdash; Aplikasi</h6>
          <p class="course-desc">Desain antarmuka mobile aplikasi modern.</p>
          <p class="course-info">12 pelajaran</p>
          <span class="badge bg-green">Selesai</span>
        </div>
      </div>
    </div>

    <!-- Card 3 -->
    <div class="timeline-item">
      <div class="timeline-line"></div>
      <div class="card course-card bg-soft-pink">
        <div class="card-body">
          <h6 class="course-title">UX/UI Design &mdash; Animasi</h6>
          <p class="course-desc">Animasi elemen dalam antarmuka pengguna.</p>
          <p class="course-info">12 pelajaran</p>
          <span class="badge bg-dark-blue">Mulai: 13.06.2023</span>
        </div>
      </div>
    </div>

  </div>
</div>