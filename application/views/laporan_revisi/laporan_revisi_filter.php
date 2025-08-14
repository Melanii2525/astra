<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; margin: 20px; }
        h4 { text-align: center; margin-bottom: 20px; }
        .item { 
            padding: 10px; 
            margin-bottom: 15px; 
            border: 1px solid #ccc; 
            border-radius: 6px; 
            background: #f9f9f9; 
        }
        .badge { 
            padding: 4px 8px; 
            border-radius: 4px; 
            font-size: 11px; 
            font-weight: bold; 
        }
        .badge-hijau { background-color: #98fb98; color: black; }
        .badge-kuning { background-color: #ffdd32; color: black; }
        .badge-merah { background-color: #ed2939; color: white; }
        .label { font-weight: bold; width: 90px; display: inline-block; }
    </style>
</head>
<body>
    <h4>
        Laporan Revisi Poin Siswa
        <?php if (!empty($filter_tindak_lanjut) && $filter_tindak_lanjut != 'all'): ?>
            - Tindak Lanjut: <?= htmlspecialchars($filter_tindak_lanjut) ?>
        <?php endif; ?>
    </h4>

    <?php foreach ($revisi as $item): ?>
        <?php
            if ($item['poin'] <= 55) $badgeClass = 'badge-hijau';
            elseif ($item['poin'] <= 150) $badgeClass = 'badge-kuning';
            else $badgeClass = 'badge-merah';
        ?>
        <div class="item">
            <div><span class="label">Nama</span>: <?= $item['nama_siswa'] ?> (<?= $item['kelas'] ?>)</div>
            <div><span class="label">NISN</span>: <?= $item['nisn'] ?></div>
            <div><span class="label">Wali Kelas</span>: <?= $item['wali_kelas'] ?></div>
            <div><span class="label">Poin</span>: <span class="badge <?= $badgeClass ?>"><?= $item['poin'] ?></span></div>
            <div><span class="label">Tindak Lanjut</span>: <?= $item['tindak_lanjut'] ?? '-' ?></div>
        </div>
    <?php endforeach; ?>
</body>
</html>
