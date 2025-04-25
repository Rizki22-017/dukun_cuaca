@extends('layout')

@section('container')
    <div class="container mt-4">

        <div class="card mb-4">
            <div class="card-body">
                <form action="{{ route('NotaDinas.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="nomor_surat" class="form-label">Nomor Surat</label>
                        <input type="text" name="nomor_surat" id="nomor_surat" class="form-control" required
                            value="{{ old('nomor_surat') }}">
                    </div>

                    <div class="mb-3">
                        <label for="pdf_file" class="form-label">Upload Nota Dinas (PDF)</label>
                        <input type="file" name="pdf_file" id="pdf_file" accept="application/pdf" class="form-control"
                            required>
                    </div>
                    <button type="submit" class="btn btn-primary">Upload</button>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <strong>Daftar Nota Dinas</strong>
            </div>
            <ul class="list-group list-group-flush">
                @forelse($notadinas as $pdf)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span>{{ $pdf->nomor_surat }}</span>
                        <div>
                            <a href="{{ asset('storage/nodin/' . $pdf->filename) }}" target="_blank">Lihat</a>
                            <form action="{{ route('NotaDinas.destroy', $pdf->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger"
                                    onclick="return confirm('Hapus file ini?')">Hapus</button>
                            </form>

                        </div>
                    </li>
                @empty
                    <li class="list-group-item text-muted">Belum ada file nota dinas yang diupload.</li>
                @endforelse
            </ul>
        </div>
    </div>
@endsection
