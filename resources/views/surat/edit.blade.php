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
        <form action="{{ route('St.update', $surat->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-section">

                <div class="mb-3">
                    <label class="form-label">Nomor Surat</label>
                    <input type="text" name="nomor_surat" class="form-control" placeholder="Nomor Surat"
                        value="{{ old('nomor_surat', $surat->nomor_surat) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Pejabat yang memberi perintah</label>
                    <select name="id_pejabat" class="form-select" required>
                        <option selected disabled>Pilih Pejabat</option>
                        @foreach ($pejabats as $pegawai)
                            <option value="{{ $pegawai->id_pegawai }}"
                                {{ $surat->id_pejabat == $pegawai->id_pegawai ? 'selected' : '' }}>
                                {{ $pegawai->nama_pegawai }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Maksud Perjalanan Dinas</label>
                    <input type="text" name="tugas" class="form-control" placeholder="Maksud Perjalanan Dinas"
                        value="{{ old('tugas', $surat->tugas) }}" required>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="form-label d-block">Kendaraan yang digunakan</label>
                        @foreach (['Darat', 'Laut', 'Udara'] as $jenis)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="kendaraan[]"
                                    value="{{ $jenis }}" id="kendaraan{{ $jenis }}"
                                    {{ in_array($jenis, $surat->kendaraan) ? 'checked' : '' }}>
                                <label class="form-check-label"
                                    for="kendaraan{{ $jenis }}">{{ $jenis }}</label>
                            </div>
                        @endforeach
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Tempat Berangkat</label>
                        <input type="text" name="lokasi_berangkat" class="form-control" placeholder="Tempat Berangkat"
                            value="{{ old('lokasi_berangkat', $surat->lokasi_berangkat) }}" required>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Tempat Tujuan</label>
                        <input type="text" name="lokasi_tujuan" class="form-control" placeholder="Tempat Tujuan"
                            value="{{ old('lokasi_tujuan', $surat->lokasi_tujuan) }}" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="form-label">Tanggal Berangkat</label>
                        <input type="date" name="tgl_mulai" class="form-control"
                            value="{{ old('tgl_mulai', $surat->tgl_mulai) }}" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Tanggal Kembali</label>
                        <input type="date" name="tgl_selesai" class="form-control"
                            value="{{ old('tgl_selesai', $surat->tgl_selesai) }}" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Pegawai yang ditugaskan</label>
                    <select name="id_pegawai_bertugas" class="form-select" required>
                        <option selected disabled>Pilih Pegawai</option>
                        @foreach ($pegawais as $pegawai)
                            <option value="{{ $pegawai->id_pegawai }}"
                                {{ $surat->id_pegawai_bertugas == $pegawai->id_pegawai ? 'selected' : '' }}>
                                {{ $pegawai->nama_pegawai }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Pengikut <span class="text-muted">(optional)</span></label>
                    <div id="pengikut-container">
                        @foreach ($surat->pengikut as $pengikut_id)
                            @php
                                $pengikut = \App\Models\Pegawai::find($pengikut_id);
                            @endphp
                            <div class="input-group mb-2">
                                <select name="pengikut[]" class="form-select">
                                    <option selected disabled>Pilih pengikut</option>
                                    @foreach ($pegawais as $pegawai)
                                        <option value="{{ $pegawai->id_pegawai }}"
                                            {{ $pegawai->id_pegawai == $pengikut->id_pegawai ? 'selected' : '' }}>
                                            {{ $pegawai->nama_pegawai }}</option>
                                    @endforeach
                                </select>
                                <button class="btn btn-outline-danger" type="button" onclick="hapusDropdownPengikut(this)"
                                    disabled>&times;</button>
                            </div>
                        @endforeach

                    </div>
                    <button class="btn btn-outline-success mt-2" type="button" onclick="tambahDropdownPengikut()">Tambah
                        Pengikut</button>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Instansi (Pembebanan Anggaran)</label>
                        <input type="text" name="sumber_dana" class="form-control" placeholder="Instansi"
                            value="{{ old('sumber_dana', $surat->sumber_dana) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Akun</label>
                        <input type="text" name="akun" class="form-control" placeholder="Akun"
                            value="{{ old('akun', $surat->akun) }}" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Keterangan Lain</label>
                    <textarea name="keterangan" class="form-control" rows="2" placeholder="Keterangan lain">{{ old('keterangan', $surat->keterangan) }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
@endsection

@section('script')
    <script>
        function tambahDropdownPengikut() {
            var container = document.getElementById('pengikut-container');

            var newDiv = document.createElement('div');
            newDiv.classList.add('input-group', 'mb-2');

            var select = document.createElement('select');
            select.name = 'pengikut[]';
            select.classList.add('form-select');

            var option = document.createElement('option');
            option.selected = true;
            option.disabled = true;
            option.textContent = 'Pilih pengikut';
            select.appendChild(option);

            @foreach ($pegawais as $pegawai)
                var option = document.createElement('option');
                option.value = '{{ $pegawai->id_pegawai }}';
                option.textContent = '{{ $pegawai->nama_pegawai }}';
                select.appendChild(option);
            @endforeach

            var button = document.createElement('button');
            button.classList.add('btn', 'btn-outline-danger');
            button.type = 'button';
            button.setAttribute('onclick', 'hapusDropdownPengikut(this)');
            button.textContent = '×';
            button.disabled = false;
            newDiv.appendChild(select);
            newDiv.appendChild(button);
            container.appendChild(newDiv);
        }

        function hapusDropdownPengikut(button) {
            var container = document.getElementById('pengikut-container');
            container.removeChild(button.parentElement);
        }
    </script>
@endsection
