<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Surat Keluar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

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

        .badge-custom {
            font-size: 0.75rem;
            padding: 6px 10px;
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

            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="mb-0"><strong>Daftar Surat Keluar</strong></h4>
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalBuatSurat">
                    + Buat Surat Baru
                </button>
            </div>

            <!-- Filter -->
            <div class="row g-2 mb-3 align-items-end">
                <div class="col-md-2">
                    <label>Status</label>
                    <select class="form-select">
                        <option>Semua Status</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label>Tanggal Mulai</label>
                    <input type="date" class="form-control">
                </div>
                <div class="col-md-2">
                    <label>Tanggal Akhir</label>
                    <input type="date" class="form-control">
                </div>
                <div class="col-md-2">
                    <label>Jenis Surat</label>
                    <select class="form-select">
                        <option>Semua Jenis</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label>Pencarian</label>
                    <input type="text" class="form-control" placeholder="Cari nomor surat, tujuan, ...">
                </div>
            </div>

            <!-- Tabel Surat -->
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped align-middle text-center">
                            <thead class="table-light">
                                <tr>
                                    <th>Nomor Surat</th>
                                    <th>Tanggal Surat</th>
                                    <th>Jenis Surat</th>
                                    <th>Perihal</th>
                                    <th>Tujuan</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($suratKeluar as $surat)
                                    <tr>
                                        <td>{{ $surat->nomor_surat }}</td>
                                        <td>{{ \Carbon\Carbon::parse($surat->tanggal_surat)->translatedFormat('d F Y') }}</td>
                                        <td>{{ $surat->jenis_surat }}</td>
                                        <td>{{ $surat->perihal }}</td>
                                        <td>{{ $surat->tujuan }}</td>
                                        <td>
                                            @php
                                                $statusLower = strtolower($surat->status);
                                                $badgeColor = match($statusLower) {
                                                    'terkirim' => 'bg-info',
                                                    'menunggu persetujuan' => 'bg-warning text-dark',
                                                    'draft' => 'bg-secondary',
                                                    'disetujui' => 'bg-success',
                                                    'ditolak' => 'bg-danger',
                                                    default => 'bg-light text-dark'
                                                };
                                            @endphp
                                            <span class="badge {{ $badgeColor }} badge-custom">
                                                {{ $surat->status }}
                                            </span>
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modalIsiSurat{{ $surat->id }}">
                                                Lihat
                                            </button>

                                            @if(in_array($statusLower, ['menunggu persetujuan', 'draft', 'ditolak']))
                                                <a class="btn btn-sm btn-warning" href="{{ route('surat-keluar.edit', $surat->id) }}">Edit</a>
                                            @else
                                                <a class="btn btn-sm btn-purple" href="{{ route('surat-keluar.download', $surat->id) }}">Unduh</a>
                                            @endif
                                        </td>
                                    </tr>

                                    <!-- Modal Isi Surat -->
                                    <div class="modal fade" id="modalIsiSurat{{ $surat->id }}" tabindex="-1">
                                        <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Isi Surat - {{ $surat->nomor_surat }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($surat->tanggal_surat)->translatedFormat('d F Y') }}</p>
                                                    <p><strong>Perihal:</strong> {{ $surat->perihal }}</p>
                                                    <p><strong>Tujuan:</strong> {{ $surat->tujuan }}</p>
                                                    <hr>
                                                    <p>{{ $surat->isi }}</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">Belum ada data surat keluar.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-end">
                        {{ $suratKeluar->links() }}
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Modal Buat Surat -->
<div class="modal fade" id="modalBuatSurat" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <form action="{{ route('surat-keluar.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Formulir Pembuatan Surat Keluar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <!-- Input fields -->
                    <!-- [Isi form seperti sebelumnya, tidak diulang agar ringkas] -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Surat</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
