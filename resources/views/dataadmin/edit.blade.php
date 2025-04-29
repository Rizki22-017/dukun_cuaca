@extends('layout')

@section('container')
    <div class="container mt-4">
        <form action="{{ route('Admin.update', $pegawai->id_pegawai) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-section">

                <div class="mb-3">
                    <label class="form-label">Nama Pegawai</label>
                    <input type="text" name="nama_pegawai" class="form-control" value="{{ $pegawai->nama_pegawai }}"
                        placeholder="Nama Pegawai" maxlength="50" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">NIP</label>
                    <input type="text" name="nip" class="form-control" value="{{ $pegawai->nip }}"
                        placeholder="Nomor Induk Pegawai" maxlength="15" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Pangkat Golongan</label>
                    <input type="text" name="pangkat_golongan" class="form-control"
                        value="{{ $pegawai->pangkat_golongan }}" placeholder="Contoh: Penata Muda / III-a" maxlength="50"
                        required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Jabatan</label>
                    <input type="text" name="jabatan" class="form-control" value="{{ $pegawai->jabatan }}"
                        placeholder="Jabatan Pegawai" maxlength="15" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Bagian Kerja</label>
                    <input type="text" name="bagian_kerja" class="form-control" value="{{ $pegawai->bagian_kerja }}"
                        placeholder="Contoh: Keuangan, Umum, dll" maxlength="50" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" class="form-control" value="{{ $pegawai->tanggal_lahir }}"
                        required>
                </div>

                <div class="mb-3">
                    @php
                        $isAdmin = is_array($pegawai->wewenang) && in_array('Admin', $pegawai->wewenang);
                    @endphp

                    <label class="form-label">Wewenang</label>
                    <div class="form-check">
                        <input class="form-check-input wewenang-checkbox" type="checkbox" id="pegawai_biasa"
                            name="wewenang[]" value="Pegawai biasa"
                            {{ is_array(old('wewenang', $pegawai->wewenang)) && in_array('Pegawai biasa', old('wewenang', $pegawai->wewenang)) ? 'checked' : '' }}
                            {{ $isAdmin ? 'disabled' : '' }}>
                        <label class="form-check-label" for="pegawai_biasa">Pegawai Biasa</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input wewenang-checkbox" type="checkbox" id="pimpinan_st" name="wewenang[]"
                            value="Pimpinan ST"
                            {{ is_array(old('wewenang', $pegawai->wewenang)) && in_array('Pimpinan ST', old('wewenang', $pegawai->wewenang)) ? 'checked' : '' }}
                            {{ $isAdmin ? 'disabled' : '' }}>
                        <label class="form-check-label" for="pimpinan_st">Pimpinan ST</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input wewenang-checkbox" type="checkbox" id="pimpinan_spd"
                            name="wewenang[]" value="Pimpinan SPD"
                            {{ is_array(old('wewenang', $pegawai->wewenang)) && in_array('Pimpinan SPD', old('wewenang', $pegawai->wewenang)) ? 'checked' : '' }}
                            {{ $isAdmin ? 'disabled' : '' }}>
                        <label class="form-check-label" for="pimpinan_spd">Pimpinan SPD</label>
                    </div>
                </div>

                <button type="submit" class="btn btn-success mb-4">Perbarui</button>
            </div>
        </form>
    </div>

    <script>
        function toggleCheckboxLogic() {
            const pegawaiBiasa = document.getElementById('pegawai_biasa');
            const otherCheckboxes = [document.getElementById('pimpinan_st'), document.getElementById('pimpinan_spd')];

            pegawaiBiasa.addEventListener('change', function() {
                otherCheckboxes.forEach(cb => cb.disabled = this.checked);
            });

            otherCheckboxes.forEach(cb => {
                cb.addEventListener('change', function() {
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
    </script>
@endsection
