<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 12px;
            line-height: 1.5;
        }
        .judul {
            text-align: center;
            font-weight: bold;
            font-size: 16px;
            margin-bottom: 20px;
        }
        .isi-surat {
            margin: 20px 0;
        }
    </style>
</head>
<body>

    <div class="judul">SURAT TUGAS</div>

    <p>Nomor:
        {{-- {{ $data->nomor_surat }} --}}
    </p>

    <div class="isi-surat">
        <p>Yang bertanda tangan di bawah ini:</p>
        <p><strong>Nama Pejabat:</strong>
            {{-- {{ $data->pejabat->nama_pegawai ?? '-' }} --}}
        </p>

        <p>Menugaskan kepada:</p>
        <p><strong>Nama:</strong>
            {{-- {{ $data->pegawai->nama_pegawai ?? '-' }} --}}
        </p>
        <p><strong>Maksud Tugas:</strong>
            {{-- {{ $data->tugas }} --}}
        </p>
        <p><strong>Lokasi:</strong>
            {{-- {{ $data->lokasi_berangkat }} → {{ $data->lokasi_tujuan }} --}}
        </p>
        <p><strong>Tanggal:</strong>
            {{-- {{ \Carbon\Carbon::parse($data->tgl_mulai)->translatedFormat('d F Y') }} s/d {{ \Carbon\Carbon::parse($data->tgl_selesai)->translatedFormat('d F Y') }} --}}
        </p>
    </div>

    <br><br>
    <p style="text-align:right;">Padang,
        {{-- {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }} --}}
    </p>
    <p style="text-align:right;">
        {{-- {{ $data->pejabat->nama_pegawai ?? '-' }} --}}
    </p>

</body>
</html>
