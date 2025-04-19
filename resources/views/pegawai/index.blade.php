@extends('layout')

@section('container')
    {{-- CRUD DISINI --}}
    @foreach ($pegawais as $pegawai)
    <p>Nama Pegawai : {{$pegawai->nama_pegawai}}</p>
    <p>Bagian Kerja : {{$pegawai->bagian_kerja}}</p>

    @endforeach
@endsection

