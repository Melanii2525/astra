<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Revisi <?= $siswa['nama_siswa']; ?></title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        h2, h3 { margin: 0; padding: 4px 0; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 15px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>

    <h2 style="text-align:center;">LAPORAN REVISI <?= $siswa['nama_siswa']; ?></h2>
    <br>

    <!-- Biodata Siswa -->
    <table>
        <tr><th width="25%">NISN</th><td><?= $siswa['nisn']; ?></td></tr>
        <tr><th>Nama</th><td><?= $siswa['nama_siswa']; ?></td></tr>
        <tr><th>Kelas</th><td><?= $siswa['kelas']; ?></td></tr>
        <tr><th>Wali Kelas</th><td><?= $siswa['wali_kelas']; ?></td></tr>
    </table>

    <!-- Pelanggaran -->
    <h3>Pelanggaran</h3>
    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Keterangan</th>
                <th>Poin</th>
            </tr>
        </thead>
        <tbody>
            <?php if(!empty($pelanggaran)): ?>
                <?php foreach($pelanggaran as $p): ?>
                <tr>
                    <td><?= $p['tanggal']; ?></td>
                    <td><?= $p['keterangan']; ?></td>
                    <td><?= $p['poin']; ?></td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="3" style="text-align:center;">Tidak ada data pelanggaran</td></tr>
            <?php endif; ?>
        </tbody>
    </table>

    <!-- Kehadiran -->
    <h3>Kehadiran</h3>
    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Status</th>
                <th>Poin</th>
            </tr>
        </thead>
        <tbody>
            <?php if(!empty($kehadiran)): ?>
                <?php foreach($kehadiran as $k): ?>
                <tr>
                    <td><?= $k['tanggal']; ?></td>
                    <td><?= $k['keterangan']; ?></td>
                    <td><?= $k['poin']; ?></td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="3" style="text-align:center;">Tidak ada data kehadiran</td></tr>
            <?php endif; ?>
        </tbody>
    </table>

  <!-- Treatment -->
<h3>Treatment</h3>
<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal Treatment</th>
            <th>Poin Treatment</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $total_treatment_poin = 0;
        if(!empty($treatment)):
            $no = 1;

            // ambil tanggal terakhir dari treatment
            $last_date = $treatment[0]['tanggal'];

            // tampilkan sebanyak jumlah treatment_count
            for($i=1; $i <= $treatment_count; $i++):
                $poin_t = 30;
                $total_treatment_poin += $poin_t;
        ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $last_date; ?></td>
            <td><?= $poin_t; ?></td>
        </tr>
        <?php
            endfor;
        else: ?>
        <tr><td colspan="3" style="text-align:center;">Belum ada treatment</td></tr>
        <?php endif; ?>
    </tbody>
</table>

<!-- Rekap -->
<h3>Rekap Akhir</h3>
<table>
<tr><th>Total Poin Terakhir</th><td><?= max(0, $total_poin); ?></td></tr>
<tr><th>Jumlah Treatment</th><td><?= $treatment_count; ?> kali</td></tr>
</table>

</body>
</html>
