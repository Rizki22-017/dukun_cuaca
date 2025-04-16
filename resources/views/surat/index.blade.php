@extends('layout')

@section('container')
    <div class="container mt-4">
        <div class="row g-3 align-items-end mb-4">
            <div class="col-auto">
                <label class="date-label">Start Date</label>
                <input type="date" class="form-control" value="2025-01-01">
            </div>
            <div class="col-auto">
                <label class="date-label">End Date</label>
                <input type="date" class="form-control" value="2025-12-31">
            </div>
            <div class="col-auto">
                <button class="btn btn-primary">Filter</button>
            </div>
            <a href={{ route('Surat.create') }}><button type="button" class="btn btn-success">Tambah Data</button></a>
        </div>

        <div class="mb-2">
            <input type="text" class="form-control" placeholder="🔍 All fields">
        </div>

        <div class="table-wrapper">
            <table class="table table-bordered text-center align-middle">
                <thead class="table-secondary">
                    <tr>
                        <th scope="col">No SPD</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Maksud</th>
                        <th scope="col">Pemberi Perintah</th>
                        <th scope="col">Yang Diperintah</th>
                        <th scope="col">Tujuan</th>
                        <th scope="col">Tgl Berangkat</th>
                        <th scope="col">Tgl Kembali</th>
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
