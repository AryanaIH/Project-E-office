<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Pengaturan Aplikasi</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    .card-setting {
      border-radius: 1rem;
      box-shadow: 0 0 10px rgba(0,0,0,0.05);
    }
    .form-label {
      font-weight: 500;
    }
  </style>
</head>
<body>
<div class="d-flex">
  @include('layout.navbar')

  <div class="container mt-4">
    <h4 class="mb-4 fw-bold">Pengaturan Aplikasi</h4>

    <div class="row g-4">
      <!-- Pengaturan Umum -->
      <div class="col-md-6">
        <div class="card card-setting p-4">
          <h5 class="mb-3">Pengaturan Umum</h5>
          <div class="mb-3">
            <label class="form-label">Nama Aplikasi</label>
            <input type="text" class="form-control" value="Sistem Monitoring Proyek">
          </div>
          <div class="mb-3">
            <label class="form-label">Versi Aplikasi</label>
            <input type="text" class="form-control" value="1.0.0" disabled>
          </div>
          <div class="mb-3">
            <label class="form-label">Bahasa</label>
            <select class="form-select">
              <option selected>Bahasa Indonesia</option>
              <option>English</option>
            </select>
          </div>
          <button class="btn btn-primary w-100"><i class="bi bi-save"></i> Simpan Pengaturan</button>
        </div>
      </div>

      <!-- Pengaturan Notifikasi -->
      <div class="col-md-6">
        <div class="card card-setting p-4">
          <h5 class="mb-3">Notifikasi</h5>
          <div class="form-check form-switch mb-3">
            <input class="form-check-input" type="checkbox" checked>
            <label class="form-check-label">Aktifkan Email Notifikasi</label>
          </div>
          <div class="form-check form-switch mb-3">
            <input class="form-check-input" type="checkbox">
            <label class="form-check-label">Aktifkan Push Notification</label>
          </div>
          <div class="mb-3">
            <label class="form-label">Alamat Email Admin</label>
            <input type="email" class="form-control" value="admin@example.com">
          </div>
          <button class="btn btn-primary w-100"><i class="bi bi-save"></i> Simpan Pengaturan</button>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
