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
        <form action="{{ route('St.store') }}" method="POST">
            @csrf
            <div class="form-section">

                <div class="mb-3">
                    <label class="form-label">Nomor Surat</label>
                    <input type="text" name="nomor_surat" class="form-control" placeholder="Nomor Surat" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Pejabat yang memberi perintah</label>
                    <select name="id_pejabat_st" class="form-select" required>
                        <option selected disabled>Pilih Pejabat ST</option>
                        @foreach ($pimpinanST as $pegawai)
                            <option value="{{ $pegawai->id_pegawai }}">{{ $pegawai->nama_pegawai }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Pejabat Surat Perjalanan Dinas</label>
                    <select name="id_pejabat_spd" class="form-select" required>
                        <option selected disabled>Pilih Pejabat SPD</option>
                        @foreach ($pimpinanSPD as $pegawai)
                            <option value="{{ $pegawai->id_pegawai }}">{{ $pegawai->nama_pegawai }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Maksud Perjalanan Dinas</label>
                    <input type="text" name="tugas" class="form-control" placeholder="Maksud Perjalanan Dinas"
                        required>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="form-label d-block">Kendaraan yang digunakan</label>
                        @foreach (['Darat', 'Laut', 'Udara'] as $jenis)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="kendaraan[]"
                                    value="{{ $jenis }}" id="kendaraan{{ $jenis }}">
                                <label class="form-check-label"
                                    for="kendaraan{{ $jenis }}">{{ $jenis }}</label>
                            </div>
                        @endforeach
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Tempat Berangkat</label>
                        <input type="text" name="lokasi_berangkat" class="form-control" placeholder="Tempat Berangkat"
                            required>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Tempat Tujuan</label>
                        <input type="text" name="lokasi_tujuan" class="form-control" placeholder="Tempat Tujuan"
                            required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="form-label">Tanggal Berangkat</label>
                        <input type="date" name="tgl_mulai" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Tanggal Kembali</label>
                        <input type="date" name="tgl_selesai" class="form-control" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Pegawai yang ditugaskan</label>
                    <select name="id_pegawai_bertugas" class="form-select" required>
                        <option selected disabled>Pilih Pegawai</option>
                        @foreach ($pegawais as $pegawai)
                            <option value="{{ $pegawai->id_pegawai }}">{{ $pegawai->nama_pegawai }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-section">
                    <label for="pengikut">Pengikut <span class="text-muted">(optional)</span></label>
                    <div id="pengikut-container">
                        <div class="input-group mb-2">
                            <select name="pengikut[]" class="form-select">
                                <option selected disabled>Pilih pengikut</option>
                                @foreach ($pegawais as $pegawai)
                                    <option value="{{ $pegawai->id_pegawai }}">{{ $pegawai->nama_pegawai }}</option>
                                @endforeach
                            </select>
                            <button class="btn btn-outline-danger" type="button"
                                onclick="hapusDropdownPengikut(this)">&times;</button>
                        </div>
                    </div>
                    <button class="btn btn-outline-success mt-2" type="button" onclick="tambahDropdownPengikut()">Tambah
                        Pengikut</button>
                </div>


                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Instansi (Pembebanan Anggaran)</label>
                        <input type="text" name="sumber_dana" class="form-control" placeholder="Instansi" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Akun</label>
                        <input type="text" name="akun" class="form-control" placeholder="Akun" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Keterangan Lain</label>
                    <textarea name="keterangan" class="form-control" rows="2" placeholder="Keterangan lain"></textarea>
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
            option.value = '';
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
            newDiv.appendChild(select);
            newDiv.appendChild(button);
            container.appendChild(newDiv);
        }

        function hapusDropdownPengikut(button) {
            var select = button.parentElement.querySelector('select');

            if (document.querySelectorAll('#pengikut-container .input-group').length === 1) {
                select.value = '';
            } else {
                var container = document.getElementById('pengikut-container');
                container.removeChild(button.parentElement);
            }
        }
    </script>
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
