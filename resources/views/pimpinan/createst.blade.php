@extends('layout')

@section('container')
    <div class="container mt-4">
        <form action="{{ route('Pegawai.store') }}" method="POST">
            @csrf
            <div class="form-section">

                <div class="mb-3">
                    <label class="form-label">Nama Pimpinan</label>
                    <select class="form-select">
                        <option selected disabled>Pilih pimpinan untuk memberikan surat tugas</option>
                        @foreach ($pegawais as $pegawai)
                            <option value="{{ $pegawai->id_pegawai }}">{{ $pegawai->nama_pegawai }}</option>
                        @endforeach
                    </select>
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
