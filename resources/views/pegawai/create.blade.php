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
                        maxlength="18" required>
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
                    <input type="password" class="form-control" name="password" value="12345678" required>
                    <small class="text-muted">Password default 12345678, bisa diganti.</small>
                </div>

                {{-- <div class="mb-3">
                    <label class="form-label">Wewenang</label>
                    <div class="form-check">
                        <input class="form-check-input wewenang-checkbox" type="checkbox" id="pegawai_biasa" name="wewenang[]"
                            value="Pegawai biasa" {{ is_array(old('wewenang')) && in_array('Pegawai biasa', old('wewenang')) ? 'checked' : '' }}>
                        <label class="form-check-label" for="pegawai_biasa">Pegawai Biasa</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input wewenang-checkbox" type="checkbox" id="pimpinan_st" name="wewenang[]"
                            value="Pimpinan ST" {{ is_array(old('wewenang')) && in_array('Pimpinan ST', old('wewenang')) ? 'checked' : '' }}>
                        <label class="form-check-label" for="pimpinan_st">Pimpinan ST</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input wewenang-checkbox" type="checkbox" id="pimpinan_spd" name="wewenang[]"
                            value="Pimpinan SPD" {{ is_array(old('wewenang')) && in_array('Pimpinan SPD', old('wewenang')) ? 'checked' : '' }}>
                        <label class="form-check-label" for="pimpinan_spd">Pimpinan SPD</label>
                    </div>
                </div> --}}

                <button type="submit" class="btn btn-primary mb-4">Simpan</button>
            </div>
        </form>
    </div>

    {{-- <script>
        function toggleCheckboxLogic() {
            const pegawaiBiasa = document.getElementById('pegawai_biasa');
            const otherCheckboxes = [document.getElementById('pimpinan_st'), document.getElementById('pimpinan_spd')];

            pegawaiBiasa.addEventListener('change', function () {
                otherCheckboxes.forEach(cb => cb.disabled = this.checked);
            });

            otherCheckboxes.forEach(cb => {
                cb.addEventListener('change', function () {
                    pegawaiBiasa.disabled = otherCheckboxes.some(cb => cb.checked);
                });
            });

            if (pegawaiBiasa.checked) {
                otherCheckboxes.forEach(cb => cb.disabled = true);
            }
            if (otherCheckboxes.some(cb => cb.checked)) {
                pegawaiBiasa.disabled = true;
            }
        }

        document.addEventListener('DOMContentLoaded', toggleCheckboxLogic);
    </script> --}}

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
