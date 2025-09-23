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

    <?php if ($total_poin >= 250): ?>
        <p style="color:red; font-weight:bold; text-align:center; font-size:14px; margin-bottom:10px;">
            PERINGATAN: Siswa sudah mencapai batas poin (<?= $total_poin; ?>). 
            Treatment tidak dapat dilakukan.
        </p>
    <?php endif; ?>

    <br>
    <table>
        <tr><th width="25%">NISN</th><td><?= $siswa['nisn']; ?></td></tr>
        <tr><th>Nama</th><td><?= $siswa['nama_siswa']; ?></td></tr>
        <tr><th>Kelas</th><td><?= $siswa['kelas']; ?></td></tr>
        <tr><th>Wali Kelas</th><td><?= $siswa['wali_kelas']; ?></td></tr>
    </table>

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
                foreach($treatment as $t):
                    $total_treatment_poin += $t['poin'];
            ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $t['tanggal']; ?></td>
                    <td><?= $t['poin']; ?></td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <?php if ($total_poin < 250): ?>
                    <tr><td colspan="3" style="text-align:center;">Belum ada treatment</td></tr>
                <?php endif; ?>
            <?php endif; ?>

            <?php if ($total_poin >= 250): ?>
                <tr>
                    <td colspan="3" style="color:red; font-weight:bold; text-align:center;">
                        Peringatan: Siswa sudah mencapai batas poin, treatment tidak dapat dilakukan.
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <h3>Rekap Akhir</h3>
    <table>
        <tr><th>Total Poin Terakhir</th><td><?= max(0, $total_poin); ?></td></tr>
        <tr>
            <th>Jumlah Treatment</th>
            <td>
                <?php if ($total_poin < 250): ?>
                    <?= $treatment_count; ?> kali
                <?php else: ?>
                    <span style="color:red; font-weight:bold;">
                        (sudah mencapai batas, tidak bisa treatment)
                    </span>
                <?php endif; ?>
            </td>
        </tr>
    </table>
</body>
</html>