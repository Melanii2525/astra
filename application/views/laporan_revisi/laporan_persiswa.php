<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        h3 { margin-bottom: 10px; }
        .siswa { margin-bottom: 20px; }
        .label { font-weight: bold; }
    </style>
</head>
<body>
    <h3>Laporan Pelanggaran & Kehadiran Per Siswa</h3>

    <?php if (!empty($siswa)): ?>
        <?php $no = 1; foreach ($siswa as $row): ?>
            <div class="siswa">
                <div class="label">Siswa <?= $no++ ?>:</div>
                <div><span class="label">Nama:</span> <?= $row['nama_siswa'] ?></div>
                <div><span class="label">Kelas:</span> <?= $row['kelas'] ?></div>

                <div><span class="label">Jenis Pelanggaran:</span>
                    <?php 
                        if (!empty($row['pelanggaran'])) {
                            echo implode(', ', array_column($row['pelanggaran'], 'keterangan'));
                        } else {
                            echo '-';
                        }
                    ?>
                </div>

                <div><span class="label">Kehadiran:</span>
                    <?php 
                        if (!empty($row['kehadiran'])) {
                            echo implode(', ', array_column($row['kehadiran'], 'keterangan'));
                        } else {
                            echo '-';
                        }
                    ?>
                </div>

                <div><span class="label">Total Treatment:</span> <?= $row['treatment_count'] ?> kali</div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Tidak ada data siswa.</p>
    <?php endif; ?>
</body>
</html>