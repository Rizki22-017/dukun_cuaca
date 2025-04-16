@extends('layout')

@section('container')
    <div class="container mt-4">
        <form>
            <div class="form-section">
                <div class="mb-3">
                    <label class="form-label">Pejabat yang memberi perintah</label>
                    <select class="form-select">
                        <option selected disabled>Pejabat yang memberi perintah</option>
                        {{-- diambil dari database pimpinan --}}
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Maksud Perjalanan Dinas</label>
                    <input type="text" class="form-control" placeholder="Maksud Perjalanan Dinas">
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="form-label">Kendaraan yang digunakan</label>
                        <select class="form-select">
                            <option selected disabled>Kendaraan yang digunakan</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Tempat Berangkat</label>
                        <input type="text" class="form-control" placeholder="Tempat Berangkat">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Tempat Tujuan</label>
                        <input type="text" class="form-control" placeholder="Tempat Tujuan">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="form-label">Durasi Perjalanan (hari)</label>
                        <input type="number" class="form-control" placeholder="Durasi Perjalanan (hari)">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Tanggal Berangkat</label>
                        <input type="date" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Tanggal Kembali</label>
                        <input type="date" class="form-control">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Pegawai yang ditugaskan</label>
                    {{-- nama pegawai yang bawahan dari pimpinan yang dipilih --}}
                    <select class="form-select">
                        <option selected disabled>Pegawai yang ditugaskan</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Pengikut <span class="text-muted">(optional)</span></label>
                    {{-- daftar pegawai lainnya --}}
                    <select class="form-select">
                        <option selected disabled>Pengikut</option>
                    </select>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Instansi (Pembebanan Anggaran)</label>
                        <input type="text" class="form-control" placeholder="Instansi (pembebanan Anggaran)">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Akun</label>
                        <input type="text" class="form-control" placeholder="Akun">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Keterangan Lain</label>
                    <textarea class="form-control" rows="2" placeholder="Keterangan lain"></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
@endsection
