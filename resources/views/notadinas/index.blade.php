@extends('layout')

@section('container')
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 1500
            })
        </script>
    @endif
    @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                html: `
            @foreach ($errors->all() as $error)
                {{ $error }}
            @endforeach
    `,
                showConfirmButton: true
            });
        </script>
    @endif
    @if (session('warning'))
        <script>
            Swal.fire({
                icon: 'warning',
                title: 'Perhatian',
                text: '{{ session('warning') }}',
                showConfirmButton: true
            });
        </script>
    @endif

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
                            <a href="{{ asset('storage/nodin/' . $pdf->filename) }}" target="_blank"
                                class="btn btn-outline-primary btn-sm">Lihat</a>

                            <button class="btn btn-outline-danger btn-sm"
                                onclick="confirmDelete({{ $pdf->id }})">Delete</button>

                            <form id="delete-form-{{ $pdf->id }}" action="{{ route('NotaDinas.destroy', $pdf->id) }}"
                                method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>
                    </li>
                @empty
                    <li class="list-group-item text-muted">Belum ada file nota dinas yang diupload.</li>
                @endforelse
            </ul>
        </div>
    </div>

    <script>
        function confirmDelete(pegawaiId) {
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Data yang dihapus tidak dapat dikembalikan",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    console.log(`Submitting delete form for pegawai ID: ${pegawaiId}`);
                    document.getElementById(`delete-form-${pegawaiId}`).submit();
                }
            });
        }
    </script>
@endsection
