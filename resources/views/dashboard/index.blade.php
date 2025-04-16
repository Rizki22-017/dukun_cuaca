@extends('layout')

@section('container')
    <div class="card border-secondary">
        <div class="card-header bg-light text-center fw-bold">
            Tentang Aplikasi SPD
        </div>
        <div class="card-body">
            <h6 class="card-title text-center fw-bold">Petunjuk Penggunaan Aplikasi SPD</h6>
            <ul class="mt-3">
                <li>Pimpinan atau Admin menerbitkan Surat Tugas untuk pegawai di menu Nota Dinas</li>
                <li>Admin atau pegawai TU membuat Surat Tugas dan Surat Perjalanan Dinas dengan mengisi form pada menu
                    surat tugas</li>
                <li>Surat Tugas dan SPD otomatis akan dibuat</li>
                <li>Unduh Surat Tugas dan SPD di menu Surat Perjalanan Dinas dan menu Laporan Perjalanan Dinas</li>
            </ul>
        </div>
    </div>
@endsection
