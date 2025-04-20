@extends('layout')

@section('container')
    <div class="container mt-4">
        <form action="{{ route('Pimpinan.updateSpd', $pimpinan->id_pimpinan_spd) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-section">

                <div class="mb-3">
                    <label class="form-label">Nama Pimpinan</label>
                    <select class="form-select" name="id_pegawai">
                        <option selected disabled>Pilih pimpinan untuk memberikan surat perjalanan dinas</option>
                        @foreach ($pegawais as $pegawai)
                            <option value="{{ $pegawai->id_pegawai }}"
                                @if ($pegawai->id_pegawai == $pimpinan->id_pegawai) selected @endif>
                                {{ $pegawai->nama_pegawai }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
@endsection
