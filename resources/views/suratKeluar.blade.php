<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Surat Keluar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
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

        .btn-buat-surat {
            margin-top: -20px;
        }
    </style>
</head>
<body>
<div class="d-flex">
    @include('layout.navbar')

    <div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0"><strong>Daftar Surat Keluar</strong></h4>
    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalBuatSurat">
        + Buat Surat Baru
    </button>
</div>

        <!-- Filter dan Tombol -->
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
            <!-- </div>
            <div class="col-md-1 text-end btn-buat-surat">
                <button class="btn btn-success w-100" data-bs-toggle="modal" data-bs-target="#modalBuatSurat">
                    + Buat Surat Baru
                </button>
            </div> -->
        </div>

        <!-- Tabel -->
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
                                <a class="btn btn-sm btn-primary" href="{{ route('surat-keluar.show', $surat->id) }}">Lihat</a>

                                @if(in_array($statusLower, ['menunggu persetujuan', 'draft', 'ditolak']))
                                    <a class="btn btn-sm btn-warning" href="{{ route('surat-keluar.edit', $surat->id) }}">Edit</a>
                                @else
                                    <a class="btn btn-sm btn-purple" href="{{ route('surat-keluar.download', $surat->id) }}">Unduh</a>
                                @endif
                            </td>
                        </tr>
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

<!-- Modal Buat Surat Baru -->
<div class="modal fade" id="modalBuatSurat" tabindex="-1" aria-labelledby="modalBuatSuratLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalBuatSuratLabel">Formulir Pembuatan Surat Keluar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('surat-keluar.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Jenis Surat <span class="text-danger">*</span></label>
                        <select name="jenis_surat" class="form-select" required>
                            <option value="">-- Pilih Jenis Surat --</option>
                            <option value="Surat Permohonan">Surat Permohonan</option>
                            <option value="Surat Pemberitahuan">Surat Pemberitahuan</option>
                            <option value="Surat Undangan">Surat Undangan</option>
                            <option value="Surat Keterangan">Surat Keterangan</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tanggal Surat <span class="text-danger">*</span></label>
                        <input type="date" name="tanggal_surat" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Perihal <span class="text-danger">*</span></label>
                        <input type="text" name="perihal" class="form-control" placeholder="Masukkan perihal surat" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tujuan Surat <span class="text-danger">*</span></label>
                        <select name="tujuan" class="form-select" required>
                            <option value="">-- Pilih Tujuan Surat --</option>
                            <option value="PT Maju Jaya">PT Maju Jaya</option>
                            <option value="PT Abadi Sentosa">PT Abadi Sentosa</option>
                            <option value="Dinas Pekerjaan Umum">Dinas Pekerjaan Umum</option>
                            <option value="Kepolisian Sektor Kota">Kepolisian Sektor Kota</option>
                            <option value="Semua Mitra">Semua Mitra</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Isi Surat <span class="text-danger">*</span></label>
                        <textarea name="isi" rows="6" class="form-control" placeholder="Tulis isi surat disini..." required></textarea>
                    </div>
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
