<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Daftar Pra-Proyek</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    .badge-status {
      font-size: 0.75rem;
      padding: 5px 10px;
      border-radius: 12px;
    }
  </style>
</head>
<body>
<div class="d-flex">
  @include('layout.navbar')

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
              <div class="mb-2">
                <label class="form-label">Nama Proyek</label>
                <input type="text" name="nama_proyek" class="form-control" required>
              </div>
              <div class="mb-2">
                <label class="form-label">Pengusul</label>
                <input type="text" name="pengusul" class="form-control" required>
              </div>
              <div class="mb-2">
                <label class="form-label">Tanggal Usulan</label>
                <input type="date" name="tanggal_usulan" class="form-control" required>
              </div>
              <div class="mb-2">
                <label class="form-label">Status</label>
                <select name="status" class="form-select" required>
                  <option value="Menunggu Review">Menunggu Review</option>
                  <option value="Disetujui">Disetujui</option>
                  <option value="Ditolak">Ditolak</option>
                </select>
              </div>
              <div class="mb-2">
                <label class="form-label">Catatan</label>
                <textarea name="catatan" class="form-control" rows="2"></textarea>
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

    <!-- Tabel Pra-Proyek -->
    <div class="table-responsive mt-4">
      <table class="table table-bordered table-hover">
        <thead class="table-light">
          <tr>
            <th>Nama Proyek</th>
            <th>Pengusul</th>
            <th>Tanggal Usulan</th>
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
              @if($item->status === 'Menunggu Review')
                <span class="badge bg-primary badge-status">Menunggu Review</span>
              @elseif($item->status === 'Disetujui')
                <span class="badge bg-success badge-status">Disetujui</span>
              @else
                <span class="badge bg-danger badge-status">Ditolak</span>
              @endif
            </td>
            <td>{{ $item->catatan ?? '-' }}</td>
            <td>
              <!-- Tombol Aksi -->
              <div class="btn-group">
                <a href="{{ route('pra-proyek.show', $item->id) }}" class="btn btn-sm btn-info" title="Lihat"><i class="bi bi-eye"></i></a>
                <a href="{{ route('pra-proyek.edit', $item->id) }}" class="btn btn-sm btn-warning" title="Edit"><i class="bi bi-pencil"></i></a>
                <form action="{{ route('pra-proyek.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')" style="display:inline;">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-sm btn-danger" title="Hapus"><i class="bi bi-trash"></i></button>
                </form>
              </div>
            </td>
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-end mt-3">
      {{ $praProyeks->links() }}
    </div>

  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
