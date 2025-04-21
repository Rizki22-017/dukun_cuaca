@extends('layout')

@section('container')
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

                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
@endsection
