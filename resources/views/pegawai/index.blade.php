@extends('layout')

@section('container')
@if (session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'success',
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


    <div class="container mt-4">

        <div class="mb-4">
            <a href={{ route('Pegawai.create') }}><button type="button" class="btn btn-success">Tambah Data</button></a>
        </div>

        <div class="mb-2">
            <input type="text" class="form-control" placeholder="🔍 All fields">
        </div>

        <div class="table-wrapper">
            <table class="table table-bordered text-center align-middle">
                <thead class="table-secondary">
                    <tr>
                        <th scope="col">NIP</th>
                        <th scope="col">Nama Pegawai</th>
                        <th scope="col">Pangkat Golongan</th>
                        <th scope="col">Jabatan</th>
                        <th scope="col">Bagian Kerja</th>
                        <th scope="col">Tanggal Lahir</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pegawais as $pegawai)
                    <tr>
                        <td>{{ $pegawai->nip }}</td>
                        <td>{{ $pegawai->nama_pegawai }}</td>
                        <td>{{ $pegawai->pangkat_golongan }}</td>
                        <td>{{ $pegawai->jabatan }}</td>
                        <td>{{ $pegawai->bagian_kerja }}</td>
                        <td>{{ $pegawai->tanggal_lahir }}</td>
                        <td><button class="btn btn-outline-primary btn-sm">Edit</button>

                            <button class="btn btn-outline-danger btn-sm"
                            onclick="confirmDelete({{ $pegawai->id_pegawai }})">Delete</button>

                            <form id="delete-form-{{ $pegawai->id_pegawai }}"
                                action=" {{ route('Pegawai.destroy', $pegawai->id_pegawai) }}" method="POST"
                                style="display: none;">
                                @csrf @method('DELETE')
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
                confirmButtonText: 'Ya, Hapus'
            }).then((result) => {
                if (result.isConfirmed) {
                    console.log(`Submitting delete form for pegawai ID: ${pegawaiId}`);
                    document.getElementById(`delete-form-${pegawaiId}`).submit();
                }
            });
        }
    </script>
@endsection
