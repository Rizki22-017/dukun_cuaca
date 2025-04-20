@extends('layout')

@section('container')
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'success',
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

    <div class="container mt-4">

        <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pst-tab" data-bs-toggle="tab" data-bs-target="#pst" type="button"
                    role="tab" aria-controls="pst" aria-selected="true"><b>Pimpinan Surat Tugas</b></button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pspd-tab" data-bs-toggle="tab" data-bs-target="#pspd" type="button"
                    role="tab" aria-controls="pspd" aria-selected="false"><b>Pimpinan Surat Perjalanan
                        Dinas</b></button>
            </li>
        </ul>

        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="pst" role="tabpanel" aria-labelledby="pst-tab">

                <div class="mb-4 mt-4">
                    <a href={{ route('Pimpinan.create') }}><button type="button" class="btn btn-success">Tambah
                            Data</button></a>
                </div>

                <div class="mb-2">
                    <input type="text" class="form-control" placeholder="🔍 All fields">
                </div>
                <div class="table-wrapper">
                    <table class="table table-bordered text-center align-middle">
                        <thead class="table-secondary">
                            <tr>
                                <th scope="col">NIP</th>
                                <th scope="col">Nama Pimpinan ST</th>
                                <th scope="col">Pangkat Golongan</th>
                                <th scope="col">Jabatan</th>
                                <th scope="col">Bagian Kerja</th>
                                <th scope="col">Tanggal Lahir</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pimpinansts as $pst)
                                <tr>
                                    <td>{{ $pst->pegawai->nip }}</td>
                                    <td>{{ $pst->pegawai->nama_pegawai }}</td>
                                    <td>{{ $pst->pegawai->pangkat_golongan }}</td>
                                    <td>{{ $pst->pegawai->jabatan }}</td>
                                    <td>{{ $pst->pegawai->bagian_kerja }}</td>
                                    <td>{{ $pst->pegawai->tanggal_lahir }}</td>
                                    <td>
                                        <a href="{{ route('Pimpinan.edit', $pst->id_pimpinan_st) }}"
                                            class="btn btn-outline-primary btn-sm">Edit</a>

                                        <button class="btn btn-outline-danger btn-sm"
                                            onclick="confirmDelete({{ $pst->id_pimpinan_st }})">Delete</button>

                                        <form id="delete-form-{{ $pst->id_pimpinan_st }}"
                                            action="{{ route('Pimpinan.destroy', $pst->id_pimpinan_st) }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="tab-pane fade" id="pspd" role="tabpanel" aria-labelledby="pspd-tab">

                <div class="mb-4 mt-4">
                    <a href={{ route('Pimpinan.createSpd') }}><button type="button" class="btn btn-success">Tambah
                            Data</button></a>
                </div>

                <div class="mb-2">
                    <input type="text" class="form-control" placeholder="🔍 All fields">
                </div>
                <div class="table-wrapper">
                    <table class="table table-bordered text-center align-middle">
                        <thead class="table-secondary">
                            <tr>
                                <th scope="col">NIP</th>
                                <th scope="col">Nama Pimpinan SPD</th>
                                <th scope="col">Pangkat Golongan</th>
                                <th scope="col">Jabatan</th>
                                <th scope="col">Bagian Kerja</th>
                                <th scope="col">Tanggal Lahir</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pimpinanspds as $pspd)
                                <tr>
                                    <td>{{ $pspd->pegawai->nip }}</td>
                                    <td>{{ $pspd->pegawai->nama_pegawai }}</td>
                                    <td>{{ $pspd->pegawai->pangkat_golongan }}</td>
                                    <td>{{ $pspd->pegawai->jabatan }}</td>
                                    <td>{{ $pspd->pegawai->bagian_kerja }}</td>
                                    <td>{{ $pspd->pegawai->tanggal_lahir }}</td>
                                    <td>
                                        <a href="{{ route('Pimpinan.editSpd', $pspd->id_pimpinan_spd) }}"
                                            class="btn btn-outline-primary btn-sm">Edit</a>

                                        <button class="btn btn-outline-danger btn-sm"
                                            onclick="confirmDelete({{ $pspd->id_pimpinan_spd }})">Delete</button>

                                        <form id="delete-form-{{ $pspd->id_pimpinan_spd }}"
                                            action="{{ route('Pimpinan.destroySpd', $pspd->id_pimpinan_spd) }}"
                                            method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        function confirmDelete(pimpinanId) {
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Data yang dihapus tidak dapat dikembalikan",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus'
            }).then((result) => {
                if (result.isConfirmed) {
                    console.log(`Submitting delete form for pimpinan ID: ${pimpinanId}`);
                    document.getElementById(`delete-form-${pimpinanId}`).submit();
                }
            });
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const activeTab = '{{ session('activeTab') }}';

            if (activeTab) {
                const allTabs = document.querySelectorAll('.tab-pane');
                allTabs.forEach(tab => {
                    tab.classList.remove('show', 'active');
                });

                const allTabLinks = document.querySelectorAll('.nav-link');
                allTabLinks.forEach(tabLink => {
                    tabLink.classList.remove('active');
                });

                const activeTabButton = document.getElementById(activeTab);
                if (activeTabButton) {
                    activeTabButton.classList.add('active');
                    const activeTabContent = document.querySelector(activeTabButton.getAttribute('data-bs-target'));
                    if (activeTabContent) {
                        activeTabContent.classList.add('show',
                        'active');
                    }
                }
            }
        });
    </script>
@endsection
