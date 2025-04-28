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
        <form action="{{ route('Pegawai.store') }}" method="POST">
            @csrf
            <div class="form-section">

                <div class="mb-3">
                    <label class="form-label">Nama Pegawai</label>
                    <input type="text" name="nama_pegawai" class="form-control" placeholder="Nama Pegawai" maxlength="50"
                        required>
                </div>

                <div class="mb-3">
                    <label class="form-label">NIP</label>
                    <input type="text" name="nip" class="form-control" placeholder="Nomor Induk Pegawai"
                        maxlength="15" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Pangkat Golongan</label>
                    <input type="text" name="pangkat_golongan" class="form-control"
                        placeholder="Contoh: Penata Muda / III-a" maxlength="50" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Jabatan</label>
                    <input type="text" name="jabatan" class="form-control" placeholder="Jabatan Pegawai" maxlength="15"
                        required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Bagian Kerja</label>
                    <input type="text" name="bagian_kerja" class="form-control" placeholder="Contoh: Keuangan, Umum, dll"
                        maxlength="50" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" class="form-control" name="username" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="text" class="form-control" name="password" value="12345678" required>
                    <small class="text-muted">Password default 12345678, bisa diganti.</small>
                </div>


                <button type="submit" class="btn btn-primary mb-4">Simpan</button>
            </div>
        </form>
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
