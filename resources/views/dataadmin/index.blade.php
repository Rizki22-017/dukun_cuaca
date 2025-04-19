@extends('layout')

@section('container')
    <div class="container mt-4">

        <div class="mb-4">
            <a href={{ route('Surat.create') }}><button type="button" class="btn btn-success">Tambah Data</button></a>
        </div>

        <div class="mb-2">
            <input type="text" class="form-control" placeholder="🔍 All fields">
        </div>

        <div class="table-wrapper">
            <table class="table table-bordered text-center align-middle">
                <thead class="table-secondary">
                    <tr>
                        <th scope="col">NIP</th>
                        <th scope="col">Nama Pegawai</th>
                        <th scope="col">Pangkat Golongan</th>
                        <th scope="col">Jabatan</th>
                        <th scope="col">Bagian Kerja</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @foreach ($namadatabase as val) --}}
                    <tr>
                        {{-- <td>{{ $val -> namatabel }}</td> --}}
                        {{-- <td>{{ $val -> namatabel }}</td> --}}
                        {{-- <td>{{ $val -> namatabel }}</td> --}}
                        {{-- <td>{{ $val -> namatabel }}</td> --}}
                        {{-- <td>{{ $val -> namatabel }}</td> --}}
                        {{-- <td>{{ $val -> namatabel }}</td> --}}
                        {{-- <td>{{ $val -> namatabel }}</td> --}}
                        {{-- <td>{{ $val -> namatabel }}</td> --}}
                        {{-- <td><button class="btn btn-outline-primary btn-sm">Unduh Surat Tugas</button>
                            <button class="btn btn-outline-primary btn-sm">Unduh SPD</button>
                        </td> --}}
                    </tr>
                    {{-- @endforeach --}}
                </tbody>
            </table>
        </div>
    </div>
@endsection
