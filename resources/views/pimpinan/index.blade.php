@extends('layout')

@section('container')
    <a href={{ route('Pimpinan.create') }}><button type="button" class="btn btn-success">Tambah Data</button></a>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama </th>
                <th scope="col">NIP</th>
                <th scope="col">Pangkat/Golongan</th>
                <th scope="col">Jabatan</th>
                <th scope="col">Unit Organisasi</th>
            </tr>
        </thead>
        <tbody>
            {{-- @foreach ($pimpinan as $val) --}}
            <tr>
                {{-- <td>{{ $loop->iteration }}</td> --}}
                {{-- <td>{{ $val->nama }}</td> --}}
                {{-- <td>{{ $val->nip }}</td> --}}
                {{-- <td>{{ $val->pangkatg }}</td> --}}
                {{-- <td>{{ $val->jabatan }}</td> --}}
                {{-- <td>{{ $val->unit }}</td> --}}
                <td><a href={{ 'Pimpinan.update' }}><button type="button" class="btn btn-primary">Edit</button></a></td>
                <td>
                    {{-- <form action="{{ route('Pimpinan.destroy', $val->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"
                            onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</button>
                    </form> --}}
                </td>
            </tr>
            {{-- @endforeach --}}
        </tbody>
    </table>
@endsection
