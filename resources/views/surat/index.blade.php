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
        <div class="row g-3 align-items-end mb-4">
            <div class="col-auto">
                <label class="date-label">Start Date</label>
                <input type="date" class="form-control" value="2025-01-01">
            </div>
            <div class="col-auto">
                <label class="date-label">End Date</label>
                <input type="date" class="form-control" value="2025-12-31">
            </div>
            <div class="col-auto">
                <button class="btn btn-primary">Filter</button>
            </div>
            <a href={{ route('St.create') }}><button type="button" class="btn btn-success">Tambah Data</button></a>
        </div>

        <div class="mb-2">
            <input type="text" class="form-control" placeholder="🔍 All fields">
        </div>

        <div class="table-wrapper">
            <table class="table table-bordered text-center align-middle">
                <thead class="table-secondary">
                    <tr>
                        <th scope="col">No.Surat</th>
                        <th scope="col">Tanggal Pembuatan</th>
                        <th scope="col">Maksud</th>
                        <th scope="col">Pemberi Perintah</th>
                        <th scope="col">Yang Diperintah</th>
                        <th scope="col">Tujuan</th>
                        {{-- <th scope="col">Kendaraan</th> --}}
                        <th scope="col">Tgl Berangkat</th>
                        <th scope="col">Tgl Kembali</th>
                        <th scope="col">Download</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($surats as $surat)
                        <tr>
                            <td>{{ $surat->notaDinas->nomor_surat }}</td>
                            <td>{{ $surat->created_at->format('d/m/y') }}</td>
                            <td>{{ $surat->tugas }}</td>
                            <td>{{ $surat->pejabat->nama_pegawai ?? '-' }}</td>
                            <td>{{ $surat->pegawaiBertugas->nama_pegawai ?? '-' }}</td>
                            <td>{{ $surat->lokasi_tujuan }}</td>
                            {{-- <td>{{ implode(', ', $surat->kendaraan ?? []) }}</td> --}}
                            <td>{{ \Carbon\Carbon::parse($surat->tgl_mulai)->format('d/m/y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($surat->tgl_selesai)->format('d/m/y') }}</td>
                            <td>
                                <button class="btn btn-outline-primary btn-sm">ST</button>
                                <button class="btn btn-outline-primary btn-sm">SPD</button>
                            </td>
                            <td>
                                <a href="{{ route('St.edit', $surat->id) }}"
                                    class="btn btn-outline-primary btn-sm">Edit</a>

                                <button class="btn btn-outline-danger btn-sm"
                                    onclick="confirmDelete({{ $surat->id }})">Delete</button>

                                <form id="delete-form-{{ $surat->id }}" action="{{ route('St.destroy', $surat->id) }}"
                                    method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
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
