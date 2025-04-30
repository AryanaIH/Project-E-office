<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Daftar Pra-Proyek</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body, html {
      height: 100%;
      margin: 0;
      padding: 0;
    }

    .wrapper {
      display: flex;
      height: 100vh;
      overflow: hidden;
    }

    .sidebar {
      width: 250px;
      background-color: #f8f9fa;
      border-right: 1px solid #dee2e6;
      flex-shrink: 0;
    }

    .content {
      flex-grow: 1;
      overflow-y: auto;
      padding: 2rem;
      background-color: #f5f5f5;
    }

    .content-inner {
      min-height: 100%;
    }

    .badge-status {
      font-size: 0.75rem;
      padding: 5px 10px;
      border-radius: 12px;
    }

    .btn-purple {
      background-color: #6f42c1;
      color: #fff;
    }

    .btn-purple:hover {
      background-color: #5a32a3;
      color: #fff;
    }
  </style>
</head>
<body>

<div class="wrapper">
  <!-- Sidebar -->
  <div class="sidebar">
    @include('layout.navbar')
  </div>

  <!-- Konten Scrollable -->
  <div class="content">
    <div class="content-inner">
  <div class="container mt-4">
    <h4 class="mb-4 fw-bold">Daftar Pra-Proyek</h4>

    <!-- Tombol Tambah -->
    <div class="mb-3">
      <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalTambah">
        <i class="bi bi-plus-lg"></i> Tambah Pra-Proyek
      </button>
    </div>

    <!-- Modal Tambah -->
    <div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <form action="{{ route('pra-proyek.store') }}" method="POST">
            @csrf
            <div class="modal-header">
              <h5 class="modal-title" id="modalTambahLabel">Tambah Pra-Proyek</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <!-- Form Input Tambah -->
              <div class="mb-2">
                <label class="form-label">Nama Proyek</label>
                <input type="text" name="nama_proyek" class="form-control" required>
              </div>

              <div class="mb-2">
                <label class="form-label">Klient</label>
                <input type="text" name="pengusul" class="form-control" required>
              </div>

              <div class="mb-2">
                <label class="form-label">Lokasi</label>
                <input type="text" name="tanggal" class="form-control" required>
              </div>

              <div class="mb-2">
                <label class="form-label">Jenis Proyek</label>
                <select name="status_dokumen" class="form-select" required>
                  <option value="Master">Master</option>
                  <option value="Konsultasi">Konsultasi</option>
                  <option value="Pengembangan">Pengembangan</option>
                </select>
              </div>

              <div class="row">
  <div class="col-md-6 mb-3">
    <label class="form-label">Tanggal Mulai</label>
    <input type="date" name="tanggal_mulai" class="form-control" value="2025-04-28" required>
  </div>
  <div class="col-md-6 mb-3">
    <label class="form-label">Tanggal Selesai</label>
    <input type="date" name="tanggal_selesai" class="form-control" value="2025-04-30" required>
  </div>
</div>

              <div class="mb-2">
                <label class="form-label">Status</label>
                <select name="keterangan_status" class="form-select" required>
                  <option value="lengkap">Draft</option>
                  <option value="belum">Berjalan</option>
                  <option value="belum">Selesai</option>
                </select>
              </div>
            </div>

            <div class="modal-footer justify-content-start" style="gap: 10px;">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Atur Syarat Dokumen</button>
              <button type="submit" class="btn btn-primary">Simpan Proyek</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Tabel Pra-Proyek -->
    <div class="table-responsive mt-4">
      <table class="table table-bordered table-hover">
        <thead class="table-light">
          <tr>
            <th>Nama Proyek</th>
            <th>Pengusul</th>
            <th>Tanggal Usulan</th>
            <th>Dokumen</th>
            <th>Status Dokumen</th>
            <th>Keterangan Status</th>
            <th>Status</th>
            <th>Catatan</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
        @foreach($praProyeks as $item)
          <tr>
            <td>{{ $item->nama_proyek }}</td>
            <td>{{ $item->pengusul }}</td>
            <td>{{ \Carbon\Carbon::parse($item->tanggal_usulan)->format('d M Y') }}</td>
            <td>
              @if($item->dokumen && is_array($item->dokumen))
                {{ implode(', ', $item->dokumen) }}
              @else
                -
              @endif
            </td>
            <td>
              <span class="badge bg-{{ $item->status_dokumen === 'ada' ? 'success' : 'secondary' }}">
                {{ ucfirst($item->status_dokumen) }}
              </span>
            </td>
            <td>
              <span class="badge bg-{{ $item->keterangan_status === 'lengkap' ? 'success' : 'danger' }}">
                {{ ucfirst($item->keterangan_status) }}
              </span>
            </td>
            <td>
              <span class="badge bg-{{ $item->status === 'Menunggu Review' ? 'warning' : ($item->status === 'Disetujui' ? 'success' : 'danger') }}">
                {{ ucfirst($item->status) }}
              </span>
            </td>
            <td>{{ $item->catatan ?? '-' }}</td>
            <td>
              <!-- Lihat Modal -->
              <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#modalLihat{{ $item->id }}">
                Lihat
              <!-- Tombol Edit -->
<button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalTambah{{ $item->id }}">
  Edit
</button>

<!-- Modal Edit (Menggunakan Modal Tambah untuk Edit) -->
<div class="modal fade" id="modalTambah{{ $item->id }}" tabindex="-1" aria-labelledby="modalTambahLabel{{ $item->id }}" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="{{ route('pra-proyek.update', $item->id) }}" method="POST">
        @csrf
        @method('PUT') <!-- Menambahkan metode PUT untuk update -->
        <div class="modal-header">
          <h5 class="modal-title" id="modalTambahLabel{{ $item->id }}">Edit Pra-Proyek</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!-- Form Input untuk Edit -->
          <div class="mb-2">
            <label class="form-label">Nama Proyek</label>
            <input type="text" name="nama_proyek" class="form-control" value="{{ old('nama_proyek', $item->nama_proyek) }}" required>
          </div>

          <div class="mb-2">
            <label class="form-label">Klient</label>
            <input type="text" name="Klient" class="form-control" value="{{ old('Klient', $item->Klient) }}" required>
          </div>

          <div class="mb-2">
            <label class="form-label">Lokasi</label>
            <input type="text" name="Lokasi" class="form-control" value="{{ old('Lokasi', $item->Lokasi) }}" required>
          </div>

          <div class="mb-2">
            <label class="form-label">Jenis Proyek</label>
            <select name="jenis_proyek" class="form-select" required>
              <option value="master" {{ $item->jenis_proyek == 'master' ? 'selected' : '' }}>Master</option>
              <option value="konsultasi" {{ $item->jenis_proyek == 'konsultasi' ? 'selected' : '' }}>Konsultasi</option>
              <option value="pengembangan" {{ $item->jenis_proyek == 'pengembangan' ? 'selected' : '' }}>Pengembangan</option>
            </select>
            </div>

            <div class="mb-2">
            <label class="form-label">Tanggal Mulai</label>
            <input type="date" name="tanggal_mulai" class="form-control" value="{{ old('tanggal', $item->tanggal_usulan) }}" required>
          </div>

          <div class="mb-2">
            <label class="form-label">Status</label>
            <select name="status" class="form-select" required>
              <option value="draft" {{ $item->status == 'draft' ? 'selected' : '' }}>Draft</option>
              <option value="berjalan" {{ $item->status == 'berjalan' ? 'selected' : '' }}>Berjalan</option>
              <option value="lengkap" {{ $item->status == 'lengkap' ? 'selected' : '' }}>Lengkap</option>
            </select>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

              <!-- Hapus -->
              <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalHapus{{ $item->id }}">
                Hapus
              </button>

              <!-- Modal Lihat Detail -->
              <div class="modal fade" id="modalLihat{{ $item->id }}" tabindex="-1" aria-labelledby="modalLihatLabel{{ $item->id }}" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="modalLihatLabel{{ $item->id }}">Detail Pra-Proyek</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <p><strong>Nama Proyek:</strong> {{ $item->nama_proyek }}</p>
                      <p><strong>Pengusul:</strong> {{ $item->pengusul }}</p>
                      <p><strong>Tanggal Usulan:</strong> {{ \Carbon\Carbon::parse($item->tanggal_usulan)->format('d M Y') }}</p>
                      <p><strong>Dokumen:</strong> {{ $item->dokumen ? implode(', ', $item->dokumen) : '-' }}</p>
                      <p><strong>Status Dokumen:</strong> {{ ucfirst($item->status_dokumen) }}</p>
                      <p><strong>Keterangan Status:</strong> {{ ucfirst($item->keterangan_status) }}</p>
                      <p><strong>Status:</strong> {{ ucfirst($item->status) }}</p>
                      <p><strong>Catatan:</strong> {{ $item->catatan ?? '-' }}</p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Modal Konfirmasi Hapus -->
              <div class="modal fade" id="modalHapus{{ $item->id }}" tabindex="-1" aria-labelledby="modalHapusLabel{{ $item->id }}" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="modalHapusLabel{{ $item->id }}">Konfirmasi Hapus</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <p>Apakah Anda yakin ingin menghapus proyek ini?</p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                      <form action="{{ route('pra-proyek.destroy', $item->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </td>
          </tr>
        @endforeach
        </tbody>
      </table>

      <!-- Paginasi -->
      <div class="mt-3">
        {{ $praProyeks->links() }}
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
