@extends('layout')

@section('container')
    <div class="container mt-4">
        <form action="{{ route('Pimpinan.store') }}" method="POST">
            @csrf
            <div class="form-section">

                <div class="mb-3">
                    <label class="form-label">Nama Pimpinan</label>
                    <select class="form-select" name="id_pegawai" required>
                        <option selected disabled>Pilih pimpinan untuk memberikan surat tugas</option>
                        @foreach ($pegawais as $pegawai)
                            <option value="{{ $pegawai->id_pegawai }}">{{ $pegawai->nama_pegawai }}</option>
                        @endforeach
                    </select>
                    <span style="font-size: 10pt"><i>*Nama yang muncul hanya nama pegawai yang berstatus <b>bukan pimpinan</b></i></span>
                </div>

                <div class="mb-3">
                    <label class="form-label">Wewenang</label>
                    <div class="form-check">
                        <input class="form-check-input wewenang-checkbox" type="checkbox" id="pimpinan_st" name="wewenang[]"
                            value="Pimpinan ST">
                        <label class="form-check-label" for="pimpinan_st">Pimpinan ST</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input wewenang-checkbox" type="checkbox" id="pimpinan_spd" name="wewenang[]"
                            value="Pimpinan SPD">
                        <label class="form-check-label" for="pimpinan_spd">Pimpinan SPD</label>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
@endsection
