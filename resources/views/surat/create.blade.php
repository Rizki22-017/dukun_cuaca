@extends('layout')

@section('container')
    <div class="container mt-4">
        <form>
            <div class="form-section">

                <div class="mb-3">
                    <label class="form-label">Nomor Surat</label>
                    <input type="text" class="form-control" placeholder="Nomor Surat">
                </div>

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
                        <label class="form-label d-block">Kendaraan yang digunakan</label>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="kendaraan[]" value="Darat"
                                id="kendaraanDarat">
                            <label class="form-check-label" for="kendaraanDarat">Darat</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="kendaraan[]" value="Laut"
                                id="kendaraanLaut">
                            <label class="form-check-label" for="kendaraanLaut">Laut</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="kendaraan[]" value="Udara"
                                id="kendaraanUdara">
                            <label class="form-check-label" for="kendaraanUdara">Udara</label>
                        </div>
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
                    <select name="pegawai_ditugaskan" class="form-select" required>
                        <option selected disabled>Pilih pegawai</option>
                        {{-- @foreach ($pegawaiList as $pegawai)
                            <option value="{{ $pegawai->id }}">{{ $pegawai->nama }}</option>
                        @endforeach --}}
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Pengikut <span class="text-muted">(optional)</span></label>
                    <div id="pengikut-container">
                        <div class="input-group mb-2">
                            <select name="pengikut[]" class="form-select" onchange="tambahDropdownPengikut(this)">
                                <option selected disabled>Pilih pengikut</option>
                                {{-- @foreach ($pegawaiList as $pegawai)
                                    <option value="{{ $pegawai->id }}">{{ $pegawai->nama }}</option>
                                @endforeach --}}
                            </select>
                            <button class="btn btn-outline-danger" type="button" onclick="hapusDropdownPengikut(this)"
                                disabled>&times;</button>
                        </div>
                    </div>
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

@section('script')
    <script>
        function tambahDropdownPengikut(selectElement) {
            const container = document.getElementById('pengikut-container');
            const lastInputGroup = container.lastElementChild;

            if (selectElement.parentElement === lastInputGroup && selectElement.value) {
                const newGroup = lastInputGroup.cloneNode(true);

                // Reset nilai dan enable tombol hapus
                const select = newGroup.querySelector('select');
                select.value = '';
                select.addEventListener('change', function() {
                    tambahDropdownPengikut(this);
                });

                const deleteButton = newGroup.querySelector('button');
                deleteButton.disabled = false;

                container.appendChild(newGroup);
            }
        }

        function hapusDropdownPengikut(button) {
            const container = document.getElementById('pengikut-container');
            const groups = container.querySelectorAll('.input-group');

            // Jangan hapus kalau hanya satu dropdown tersisa
            if (groups.length > 1) {
                button.parentElement.remove();
            }
        }
    </script>
@endsection
