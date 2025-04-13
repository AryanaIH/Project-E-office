<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Surat</title>
    
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

    <style>
        html, body {
            height: 100%;
            margin: 0;
        }

        .full-height {
            height: 100vh;
            overflow: hidden;
        }

        .form-wrapper {
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .scrollable-form {
            flex: 1;
            overflow-y: auto;
            padding: 1.5rem;
        }

        .form-footer {
            padding: 1rem 1.5rem;
            border-top: 1px solid #ddd;
            background-color: #fff;
            text-align: right;
        }

        /* Optional: biar scroll tetap mulus */
        .scrollable-form::-webkit-scrollbar {
            width: 8px;
        }

        .scrollable-form::-webkit-scrollbar-thumb {
            background-color: #ccc;
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <div class="d-flex full-height">
        @include('layout.navbar')

        <div class="flex-grow-1 form-wrapper">
            <h1 class="ms-4 mt-4">Form Tambah Surat</h1>

            <!-- Scrollable form content -->
            <div class="scrollable-form">
                <form id="tambahSuratForm" method="POST" action="{{ route('surat.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="kepada" class="form-label">Kepada</label>
                        <input type="text" class="form-control" id="kepada" name="kepada" required>
                    </div>

                    <div class="mb-3">
                        <label for="subject" class="form-label">Subject</label>
                        <input type="text" class="form-control" id="subject" name="subject" required>
                    </div>

                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="file" class="form-label">File</label>
                        <input type="file" class="form-control" id="file" name="file">
                    </div>
                </form>
            </div>

            <!-- Fixed footer (outside scroll) -->
            <div class="form-footer">
                <a href="{{ route('surat.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary" form="tambahSuratForm">Simpan</button>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
