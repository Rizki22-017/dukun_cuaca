@extends('layout')

@section('container')
    <div class="container mt-4">
        <form action="{{ route('Pegawai.update', $pegawai->id_pegawai) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-section">

                <div class="mb-3">
                    <label class="form-label">Nama Pegawai</label>
                    <input type="text" name="nama_pegawai" class="form-control" value="{{ $pegawai->nama_pegawai }}" placeholder="Nama Pegawai" maxlength="50" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">NIP</label>
                    <input type="text" name="nip" class="form-control" value="{{ $pegawai->nip }}" placeholder="Nomor Induk Pegawai" maxlength="15" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Pangkat Golongan</label>
                    <input type="text" name="pangkat_golongan" class="form-control" value="{{ $pegawai->pangkat_golongan }}" placeholder="Contoh: Penata Muda / III-a" maxlength="50" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Jabatan</label>
                    <input type="text" name="jabatan" class="form-control" value="{{ $pegawai->jabatan }}" placeholder="Jabatan Pegawai" maxlength="15" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Bagian Kerja</label>
                    <input type="text" name="bagian_kerja" class="form-control" value="{{ $pegawai->bagian_kerja }}" placeholder="Contoh: Keuangan, Umum, dll" maxlength="50" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" class="form-control" value="{{ $pegawai->tanggal_lahir }}" required>
                </div>

                <button type="submit" class="btn btn-success">Update</button>
            </div>
        </form>
    </div>
@endsection
