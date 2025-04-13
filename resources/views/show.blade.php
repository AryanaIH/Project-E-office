@extends('layout.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0"><strong>Detail Surat Keluar</strong></h4>
        <a href="{{ route('surat-keluar.index') }}" class="btn btn-secondary">
            &larr; Kembali ke Daftar
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <p><strong>Nomor Surat:</strong> {{ $surat->nomor_surat ?? '-' }}</p>
                    <p><strong>Jenis Surat:</strong> {{ $surat->jenis_surat }}</p>
                    <p><strong>Tujuan:</strong> {{ $surat->tujuan }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Tanggal Surat:</strong> {{ \Carbon\Carbon::parse($surat->tanggal_surat)->translatedFormat('d F Y') }}</p>
                    <p>
                        <strong>Status:</strong> 
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
                    </p>
                </div>
            </div>

            <hr>

            <p><strong>Perihal:</strong></p>
            <p>{{ $surat->perihal }}</p>

            <hr>

            <p><strong>Isi Surat:</strong></p>
            <div class="border p-3 rounded bg-light" style="white-space: pre-line;">
                {{ $surat->isi }}
            </div>
        </div>
    </div>

    <div class="mt-4 d-flex gap-2">
        @if(in_array(strtolower($surat->status), ['menunggu persetujuan', 'draft', 'ditolak']))
            <a href="{{ route('surat-keluar.edit', $surat->id) }}" class="btn btn-warning">Edit Surat</a>
        @else
            <a href="{{ route('surat-keluar.download', $surat->id) }}" class="btn btn-purple">Unduh Surat</a>
        @endif
    </div>
</div>
@endsection
