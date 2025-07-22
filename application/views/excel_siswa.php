<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Import Data Siswa dari Excel</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="bg-light">

<div class="container mt-5">
  <h3 class="text-center mb-4">Import Data Siswa dari Excel</h3>

  <!-- Form Upload -->
  <form action="<?= base_url('siswa/import_excel') ?>" method="post" enctype="multipart/form-data" class="mb-4">
    <div class="form-group">
      <label>Pilih File Excel</label>
      <input type="file" name="file_excel" class="form-control-file" accept=".xls,.xlsx" required>
    </div>
    <button type="submit" class="btn btn-success">Upload & Preview</button>
  </form>

  <!-- Tampilkan preview jika data tersedia -->
  <?php if (isset($preview) && count($preview) > 0): ?>
    <h5 class="mb-3">Preview Data Siswa</h5>
    <form method="post" action="<?= base_url('siswa/simpan_import') ?>">
      <div class="table-responsive mb-3">
        <table class="table table-bordered">
          <thead class="thead-dark">
            <tr>
              <th>No</th>
              <th>NISN</th>
              <th>NIPD</th>
              <th>Nama</th>
              <th>Kelas</th>
              <th>JK</th>
              <th>Wali Kelas</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($preview as $i => $row): ?>
              <tr>
                <td><?= $i + 1 ?></td>
                <?php foreach ($row as $value): ?>
                  <td><input type="hidden" name="data[<?= $i ?>][]" value="<?= $value ?>"><?= $value ?></td>
                <?php endforeach; ?>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
      <button type="submit" class="btn btn-primary">Simpan ke Database</button>
    </form>
  <?php endif; ?>
</div>
</body>
</html>
