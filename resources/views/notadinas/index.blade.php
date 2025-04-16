@extends('layout')

@section('container')
    <div class="container mt-4">

        {{-- @if (Auth::user()->role === 'admin' || Auth::user()->role === 'pimpinan') --}}
        <div class="card mb-4">
            <div class="card-body">
                <form action="/NotaDinas#" method="POST" enctype="multipart/form-data">
                    {{-- {{ route('notadinas.upload') }} --}}
                    {{-- @csrf --}}
                    <div class="mb-3">
                        <label for="pdf_file" class="form-label">Upload Nota Dinas (PDF)</label>
                        <input type="file" name="pdf_file" id="pdf_file" accept="application/pdf" class="form-control"
                            required>
                    </div>
                    <button type="submit" class="btn btn-primary">Upload</button>
                </form>
            </div>
        </div>
        {{-- @endif --}}

        <div class="card">
            <div class="card-header">
                <strong>Daftar Nota Dinas</strong>
            </div>
            <ul class="list-group list-group-flush">
                {{-- @forelse($pdfs as $pdf) --}}
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    {{-- {{ $pdf->filename }} --}}
                    <a href="/NotaDinas#" target="_blank" {{-- {{ asset('storage/notadinas/' . $pdf->filename) }} --}} class="btn btn-sm btn-outline-primary">
                        Lihat
                    </a>
                </li>
                {{-- @empty --}}
                <li class="list-group-item text-muted">Belum ada file nota dinas yang diupload.</li>
                {{-- @endforelse --}}
            </ul>
        </div>
    </div>
@endsection
