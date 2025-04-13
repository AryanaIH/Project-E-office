<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Daftar Monitoring Proyek</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    .badge-status {
      font-size: 0.75rem;
      padding: 5px 10px;
      border-radius: 12px;
    }
    .progress-bar {
      height: 6px;
      border-radius: 4px;
    }
  </style>
</head>
<body>
<div class="d-flex">
  @include('layout.navbar')

  <div class="container mt-4">
    <h4 class="mb-4 fw-bold">Daftar Monitoring Proyek</h4>

    <!-- Filter -->
    <div class="row g-2 align-items-end mb-4">
      <div class="col-md-2">
        <label>Status</label>
        <select class="form-select">
          <option>Semua Status</option>
        </select>
      </div>
      <div class="col-md-2">
        <label>Client</label>
        <select class="form-select">
          <option>Semua Client</option>
        </select>
      </div>
      <div class="col-md-2">
        <label>Tanggal Mulai</label>
        <input type="date" class="form-control">
      </div>
      <div class="col-md-2">
        <label>Tanggal Selesai</label>
        <input type="date" class="form-control">
      </div>
      <div class="col-md-3">
        <label>Cari proyek...</label>
        <input type="text" class="form-control" placeholder="Cari proyek...">
      </div>
      <div class="col-md-1 text-end">
        <button class="btn btn-primary w-100"><i class="bi bi-funnel-fill"></i></button>
      </div>
    </div>

    <!-- Tabel -->
    <div class="table-responsive">
      <table class="table align-middle table-bordered table-striped text-center">
        <thead class="table-light">
          <tr>
            <th>Nama Proyek</th>
            <th>Tanggal Proyek</th>
            <th>Deadline Proyek</th>
            <th>Client</th>
            <th>Status</th>
            <th>Syarat Terpenuhi</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <!-- Baris data -->
          <tr>
            <td>Pengembangan Sistem ERP</td>
            <td>10 Jan 2025</td>
            <td>20 Jul 2025</td>
            <td>PT Maju Bersama</td>
            <td><span class="badge bg-success badge-status">On Track</span></td>
            <td>
              12 / 18 syarat
              <div class="progress mt-1">
                <div class="progress-bar bg-primary" style="width: 66.7%"></div>
              </div>
            </td>
            <td><a class="btn btn-sm btn-primary"><i class="bi bi-eye"></i> Detail</a></td>
          </tr>
          <tr>
            <td>Implementasi Jaringan</td>
            <td>05 Feb 2025</td>
            <td class="text-danger">30 Mar 2025</td>
            <td>Dinas Komunikasi</td>
            <td><span class="badge bg-warning text-dark badge-status">At Risk</span></td>
            <td>
              8 / 15 syarat
              <div class="progress mt-1">
                <div class="progress-bar bg-primary" style="width: 53.3%"></div>
              </div>
            </td>
            <td><a class="btn btn-sm btn-primary"><i class="bi bi-eye"></i> Detail</a></td>
          </tr>
          <tr>
            <td>Pengadaan Infrastruktur IT</td>
            <td>15 Dec 2024</td>
            <td class="text-danger">15 Mar 2025</td>
            <td>PT Karya Digital</td>
            <td><span class="badge bg-danger badge-status">Delayed</span></td>
            <td>
              7 / 12 syarat
              <div class="progress mt-1">
                <div class="progress-bar bg-primary" style="width: 58.3%"></div>
              </div>
            </td>
            <td><a class="btn btn-sm btn-primary"><i class="bi bi-eye"></i> Detail</a></td>
          </tr>
          <tr>
            <td>Pengembangan Aplikasi Mobile</td>
            <td>01 Nov 2024</td>
            <td>15 Feb 2025</td>
            <td>CV Teknologi Mandiri</td>
            <td><span class="badge bg-secondary badge-status">Completed</span></td>
            <td>
              20 / 20 syarat
              <div class="progress mt-1">
                <div class="progress-bar bg-primary" style="width: 100%"></div>
              </div>
            </td>
            <td><a class="btn btn-sm btn-primary"><i class="bi bi-eye"></i> Detail</a></td>
          </tr>
          <tr>
            <td>Pembuatan Website Corporate</td>
            <td>20 Feb 2025</td>
            <td>10 May 2025</td>
            <td>PT Indah Karya</td>
            <td><span class="badge bg-success badge-status">On Track</span></td>
            <td>
              5 / 10 syarat
              <div class="progress mt-1">
                <div class="progress-bar bg-primary" style="width: 50%"></div>
              </div>
            </td>
            <td><a class="btn btn-sm btn-primary"><i class="bi bi-eye"></i> Detail</a></td>
          </tr>
          <tr>
            <td>Sistem Manajemen Aset</td>
            <td>05 Mar 2025</td>
            <td>15 Aug 2025</td>
            <td>Dinas Pendidikan</td>
            <td><span class="badge bg-success badge-status">On Track</span></td>
            <td>
              3 / 14 syarat
              <div class="progress mt-1">
                <div class="progress-bar bg-primary" style="width: 21.4%"></div>
              </div>
            </td>
            <td><a class="btn btn-sm btn-primary"><i class="bi bi-eye"></i> Detail</a></td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-end mt-3">
      <nav>
        <ul class="pagination">
          <li class="page-item"><a class="page-link" href="#">«</a></li>
          <li class="page-item active"><a class="page-link" href="#">1</a></li>
          <li class="page-item"><a class="page-link" href="#">2</a></li>
          <li class="page-item"><a class="page-link" href="#">3</a></li>
          <li class="page-item"><a class="page-link" href="#">»</a></li>
        </ul>
      </nav>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
