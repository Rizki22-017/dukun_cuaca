<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Surat Perjalanan Dinas (SPD)</title>
    <style type="text/css">
        table.tg {
            border-collapse: collapse;
            border-spacing: 0;
            width: 100%;
        }

        .tg td {
            border-color: black;
            border-style: solid;
            border-width: 1px;
            font-family: Arial, sans-serif;
            font-size: 14px;
            overflow: hidden;
            padding: 10px 5px;
            word-break: normal;
        }

        .tg th {
            border-color: black;
            border-style: solid;
            border-width: 1px;
            font-family: Arial, sans-serif;
            font-size: 14px;
            font-weight: normal;
            overflow: hidden;
            padding: 10px 5px;
            word-break: normal;
            text-align: left;
            vertical-align: top;
        }

        .tg .tg-0pky {
            border-color: inherit;
            text-align: left;
            vertical-align: top;
        }
    </style>
</head>

<body style="font-family: Arial, sans-serif; font-size: 14px; margin: 40px;">

    <table style="width:100%; border-collapse: collapse;">
        <tr style="border-color: black">
            <td style="width:45%; vertical-align: top;">
                Kementerian Negara / Lembaga<br>
                <strong>Badan Meteorologi Klimatologi dan Geofisika</strong>
            </td>
            <td style="width:55%; vertical-align: top;">
                <table style="width:100%; border-collapse: collapse;">
                    <tr>
                        <td style="width:40%;">Lembar Ke</td>
                        <td style="width:5%;">:</td>
                        <td style="width:55%;">I</td>
                    </tr>
                    <tr>
                        <td>Kode Nota Dinas</td>
                        <td>:</td>
                        <td>{{ $surat->id_nota_dinas }}</td>
                    </tr>
                    <tr>
                        <td>Nomor Surat</td>
                        <td>:</td>
                        <td>{{ $surat->notaDinas->nomor_surat }}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <div style="text-align: center; font-weight: bold; text-decoration: underline; margin: 20px 0; font-size: 16px;">
        SURAT PERJALANAN DINAS (SPD)
    </div>

    <table class="tg">
        <thead>
            @php
                $no = 1;
            @endphp
        </thead>
        <tbody>
            <tr>
                <th class="tg-0pky">{{ $no++ }}</th>
                <th class="tg-0pky">Pejabat Pembuat Komitmen</th>
                <th class="tg-0pky" colspan="2">{{ $surat->pejabatSt->nama_pegawai }}</th>
            </tr>
            <tr>
                <td class="tg-0pky">{{ $no++ }}</td>
                <td class="tg-0pky">Nama/NIP Pegawai yang melaksanakan perjalanan dinas</td>
                <td class="tg-0pky" colspan="2">{{ $surat->pegawaiBertugas->nama_pegawai }} /
                    {{ $surat->pegawaiBertugas->nip }}</td>
            </tr>
            <tr>
                <td class="tg-0pky" rowspan="3">{{ $no++ }}</td>
                <td class="tg-0pky">Pangkat dan Golongan</td>
                <td class="tg-0pky" colspan="2">{{ $surat->pegawaiBertugas->pangkat_golongan }}</td>
            </tr>
            <tr>
                <td class="tg-0pky">Jabatan / Instansi</td>
                <td class="tg-0pky" colspan="2">{{ $surat->pegawaiBertugas->jabatan }} /
                    {{ $surat->pegawaiBertugas->bagian_kerja }}</td>
            </tr>
            <tr>
                <td class="tg-0pky">Tingkat Biaya Perjalanan Dinas</td>
                <td class="tg-0pky" colspan="2">C</td>
            </tr>
            <tr>
                <td class="tg-0pky">{{ $no++ }}</td>
                <td class="tg-0pky">Maksud Perjalanan Dinas</td>
                <td class="tg-0pky" colspan="2">{{ $surat->tugas }}</td>
            </tr>
            <tr>
                <td class="tg-0pky">{{ $no++ }}</td>
                <td class="tg-0pky">Alat Angkutan yang Dipergunakan</td>
                <td class="tg-0pky" colspan="2">{{ implode(', ', $surat->kendaraan) }}</td>
            </tr>
            <tr>
                <td class="tg-0pky" rowspan="2">{{ $no++ }}</td>
                <td class="tg-0pky">Tempat Berangkat</td>
                <td class="tg-0pky" colspan="2">{{ $surat->lokasi_berangkat }}</td>
            </tr>
            <tr>
                <td class="tg-0pky">Tempat Tujuan</td>
                <td class="tg-0pky" colspan="2">{{ $surat->lokasi_tujuan }}</td>
                </td>
            </tr>
            <tr>
                <td class="tg-0pky" rowspan="3">{{ $no++ }}</td>
                <td class="tg-0pky">Lamanya Perjalanan Dinas</td>
                <td class="tg-0pky" colspan="2">
                    {{ \Carbon\Carbon::parse($surat->tgl_mulai)->diffInDays($surat->tgl_selesai) + 1 }} Hari</td>
                </td>
            </tr>
            <tr>
                <td class="tg-0pky">Tanggal Berangkat</td>
                <td class="tg-0pky" colspan="2">{{ \Carbon\Carbon::parse($surat->tgl_mulai)->format('d F Y') }}</td>
            </tr>
            <tr>
                <td class="tg-0pky">Tanggal Kembali</td>
                <td class="tg-0pky" colspan="2">{{ \Carbon\Carbon::parse($surat->tgl_selesai)->format('d F Y') }}
                </td>
            </tr>

            @if (!empty($surat->pengikut))
                @foreach ($surat->pengikut as $pengikutId)
                    @php
                        $pengikut = \App\Models\Pegawai::find($pengikutId);
                    @endphp
                    @if ($pengikut)
                        <tr>
                            <td class="tg-0pky">{{ $no++ }}</td>
                            <td class="tg-0pky">Pengikut : Nama/NIP</td>
                            <td class="tg-0pky">Tanggal Lahir</td>
                            </td>
                            <td class="tg-0pky">Jabatan</td>
                        </tr>
                        <tr>
                            <td class="tg-0pky"></td>
                            <td class="tg-0pky">{{ $pengikut->nama_pegawai }} / {{ $pengikut->nip }}</td>
                            <td class="tg-0pky">
                                {{ \Carbon\Carbon::parse($pengikut['tanggal_lahir'])->format('d F Y') }}
                            </td>
                            <td class="tg-0pky"> {{ $pengikut->jabatan }}</td>
                        </tr>
                    @endif
                @endforeach

            @endif

            <tr>
                <td class="tg-0pky" rowspan="3">{{ $no++ }}</td>
                <td class="tg-0pky" colspan="3">Pembebanan Anggaran</td>
            </tr>
            <tr>
                <td class="tg-0pky">Instansi</td>
                <td class="tg-0pky" colspan="2">{{ $surat->sumber_dana }}</td>
            </tr>
            <tr>
                <td class="tg-0pky">Akun</td>
                <td class="tg-0pky" colspan="2">{{ $surat->akun }}</td>
            </tr>
            <tr>
                <td class="tg-0pky">{{ $no++ }}</td>
                <td class="tg-0pky">Keterangan Lain-Lain</td>
                <td class="tg-0pky" colspan="2">{{ $surat->keterangan }}</td>
            </tr>
        </tbody>
    </table>

    <br><br>
    <table style="width:100%; border-collapse: collapse;">
        <tr>
            <td style="width:50%;"></td>
            <td style="width:50%; text-align: right;">
                Dikeluarkan di Padang<br>
                Tanggal {{ \Carbon\Carbon::parse($surat->tgl_mulai)->format('d F Y') }}
                <br><br>
                Pejabat Pembuat Komitmen,
                <div style="height: 80px;"></div>
                <strong>{{ $surat->pejabatSpd->nama_pegawai }}</strong><br>
                NIP. {{ $surat->pejabatSpd->nip }}
            </td>
        </tr>
    </table>

    <br><br>
    <table style="width:100%; border-collapse: collapse; border: 1px solid black;">
        <tr>
            @php
                $no = 1;
            @endphp
            <td style="border: 1px solid black; width:5%;">{{ $no++ }}</td>
            <td style="border: 1px solid black; width:45%;">
                <strong>Nama</strong>: {{ $surat->pegawaiBertugas->nama_pegawai }}<br>
                <strong>Berangkat dari</strong>: {{ $surat->lokasi_berangkat }}<br>
                <strong>Pada Tanggal</strong>:
            </td>
            <td style="border: 1px solid black; width:50%;">
                <strong>Tiba di</strong>: {{ $surat->lokasi_tujuan }}<br>
                <strong>Pada Tanggal</strong>:
            </td>
        </tr>


        @if (!empty($surat->pengikut))
            @foreach ($surat->pengikut as $pengikutId)
                @php
                    $pengikut = \App\Models\Pegawai::find($pengikutId);
                @endphp
                @if ($pengikut)
                    <tr>
                        <td style="border: 1px solid black; width:5%;">{{ $no++ }}</td>
                        <td style="border: 1px solid black; width:45%;">
                            <strong>Nama</strong>: {{ $pengikut->nama_pegawai }}<br>
                            <strong>Berangkat dari</strong>: {{ $surat->lokasi_berangkat }}<br>
                            <strong>Pada Tanggal</strong>:
                        </td>
                        <td style="border: 1px solid black; width:50%;">
                            <strong>Tiba di</strong>: {{ $surat->lokasi_tujuan }} <br>
                            <strong>Pada Tanggal</strong>:
                        </td>
                    </tr>
                @endif
            @endforeach

        @endif

        <tr>
            <td style="border: 1px solid black;">{{ $no++ }}</td>
            <td style="border: 1px solid black; text-align: center;">
                Pejabat Yang Berwenang / Pejabat lainnya yang ditunjuk,
                <div style="height: 80px;"></div>
                <strong>{{ $surat->pejabatSt->nama_pegawai }}</strong><br>
                NIP. {{ $surat->pejabatSt->nip }}
            </td>
            <td style="border: 1px solid black; text-align: center;">
                Telah diperiksa, dengan keterangan bahwa perjalanan tersebut atas perintahnya dan semata-mata untuk
                kepentingan jabatan
                <div style="height: 80px;"></div>
                <strong>{{ $surat->pejabatSpd->nama_pegawai }}</strong><br>
                NIP. {{ $surat->pejabatSpd->nip }}
            </td>
        </tr>

        <tr>
            <td style="border: 1px solid black;">{{ $no++ }}</td>
            <td style="border: 1px solid black;">Catatan lain-lain</td>
            <td style="border: 1px solid black; text-align: justify;">

            </td>
        </tr>

        <tr>
            <td style="border: 1px solid black;">{{ $no++ }}</td>
            <td style="border: 1px solid black;" colspan="2" class="text-justify">
                PERHATIAN: Pegawai yang melakukan perjalanan dinas diwajibkan menghemat biaya dan mempertanggungjawabkan
                penggunaannya.
            </td>
        </tr>
    </table>


</body>

</html>
