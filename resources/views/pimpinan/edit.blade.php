{{-- @extends('layout')

@section('container')
    <div class="container mt-4">
        <form action="{{ route('Pimpinan.update', $pegawai->id_pegawai) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-section">

                <div class="mb-3">
                    <label class="form-label">Nama Pimpinan</label>
                    <select class="form-select" name="id_pegawai" disabled>
                        <option selected>{{ $pegawai->nama_pegawai }}</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Wewenang</label>
                    <div class="form-check">
                        <input class="form-check-input wewenang-checkbox" type="checkbox" id="pimpinan_st" name="wewenang[]"
                            value="Pimpinan ST"
                            {{ is_array($pegawai->wewenang) && in_array('Pimpinan ST', $pegawai->wewenang) ? 'checked' : '' }}>
                        <label class="form-check-label" for="pimpinan_st">Pimpinan ST</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input wewenang-checkbox" type="checkbox" id="pimpinan_spd" name="wewenang[]"
                            value="Pimpinan SPD"
                            {{ is_array($pegawai->wewenang) && in_array('Pimpinan SPD', $pegawai->wewenang) ? 'checked' : '' }}>
                        <label class="form-check-label" for="pimpinan_spd">Pimpinan SPD</label>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Perbarui</button>
            </div>
        </form>
    </div>
@endsection --}}
