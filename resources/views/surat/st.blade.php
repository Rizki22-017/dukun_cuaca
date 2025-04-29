<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Surat Tugas</title>
</head>

<body>

    <div style="text-align: center;">
        <img src="{{ public_path('assets/img/kopsurat.jpg') }}" alt="Kop Surat" style="width: 100%; max-width: 900px;">
    </div>

    <div
        style="font-family: 'Times New Roman', Times, serif; font-size: 12pt; margin-left: 50px; margin-right: 50px; line-height: 1;">

        <div style="text-align: center; margin-top:10px">
            <span style="text-decoration: underline; font-weight: bold; font-size: 14pt;">SURAT TUGAS</span><br>
            <div style="margin-top: 8px;">
                NOMOR: {{ $surat->notaDinas->nomor_surat }}
            </div>
        </div>

        <div style="margin-top: 24px;">
            Yang bertanda tangan di bawah ini:
            <table style="width: 100%; margin-top: 8px; border-collapse: collapse;">
                <tr>
                    <td style="width: 30%;">Nama</td>
                    <td style="width: 2%;">:</td>
                    <td>{{ $surat->pejabatSt->nama_pegawai }}</td>
                </tr>
                <tr>
                    <td>NIP</td>
                    <td>:</td>
                    <td>{{ $surat->pejabatSt->nip }}</td>
                </tr>
                <tr>
                    <td>Pangkat/Golongan</td>
                    <td>:</td>
                    <td>{{ $surat->pejabatSt->pangkat_golongan }}</td>
                </tr>
                <tr>
                    <td>Jabatan</td>
                    <td>:</td>
                    <td>{{ $surat->pejabatSt->jabatan }}</td>
                </tr>
                <tr>
                    <td>Unit Organisasi</td>
                    <td>:</td>
                    <td>{{ $surat->pejabatSt->bagian_kerja }}</td>
                </tr>
            </table>
        </div>

        <div style="margin-top: 24px;">
            Dengan ini memberikan tugas kepada:
            <table style="width: 100%; margin-top: 8px; border-collapse: collapse;">
                @php
                    $no = 1;
                @endphp
                <tr>
                    <td style="width: 5%; vertical-align: top;">{{ $no++ }}.</td>
                    <td style="width: 95%;">
                        <table style="width: 100%; border-collapse: collapse;">
                            <tr>
                                <td style="width: 25%;">Nama</td>
                                <td style="width: 2%;">:</td>
                                <td>{{ $surat->pegawaiBertugas->nama_pegawai }}</td>
                            </tr>
                            <tr>
                                <td>NIP</td>
                                <td>:</td>
                                <td>{{ $surat->pegawaiBertugas->nip }}</td>
                            </tr>
                            <tr>
                                <td>Pangkat/Gol.</td>
                                <td>:</td>
                                <td>{{ $surat->pegawaiBertugas->pangkat_golongan }}</td>
                            </tr>
                            <tr>
                                <td>Jabatan</td>
                                <td>:</td>
                                <td>{{ $surat->pegawaiBertugas->jabatan }}</td>
                            </tr>
                            <tr>
                                <td>Unit Organisasi</td>
                                <td>:</td>
                                <td>{{ $surat->pegawaiBertugas->bagian_kerja }}</td>
                            </tr>
                        </table>
                    </td>
                </tr>

                {{-- ini untuk pengikut, nnti di cek apa ada pengikut atau kaga --}}
                @if (!empty($surat->pengikut))
                    @foreach ($surat->pengikut as $pengikutId)
                        @php
                            $pengikut = \App\Models\Pegawai::find($pengikutId);
                        @endphp
                        @if ($pengikut)
                            <tr>
                                <td style="vertical-align: top;">{{ $no++ }}.</td>
                                <td>
                                    <table style="width: 100%; border-collapse: collapse;">
                                        <tr>
                                            <td style="width: 25%;">Nama</td>
                                            <td style="width: 2%;">:</td>
                                            <td>{{ $pengikut->nama_pegawai }}</td>
                                        </tr>
                                        <tr>
                                            <td>NIP</td>
                                            <td>:</td>
                                            <td>{{ $pengikut->nip }}</td>
                                        </tr>
                                        <tr>
                                            <td>Pangkat/Gol.</td>
                                            <td>:</td>
                                            <td>{{ $pengikut->pangkat_golongan }}</td>
                                        </tr>
                                        <tr>
                                            <td>Jabatan</td>
                                            <td>:</td>
                                            <td>{{ $pengikut->jabatan }}</td>
                                        </tr>
                                        <tr>
                                            <td>Unit Organisasi</td>
                                            <td>:</td>
                                            <td>{{ $pengikut->bagian_kerja }}</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                @endif

            </table>
        </div>

        <div style="margin-top: 24px;">
            Untuk melaksanakan:
            <table style="width: 100%; margin-top: 8px; border-collapse: collapse;">
                <tr>
                    <td style="width: 30%;">Tugas</td>
                    <td style="width: 2%;">:</td>
                    <td>{{ $surat->tugas }}</td>
                </tr>
                {{-- bagian ini tuh rumusnya +1 biar hitungan hari, bukan malam --}}
                <tr>
                    <td>Selama</td>
                    <td>:</td>
                    <td>{{ \Carbon\Carbon::parse($surat->tgl_mulai)->diffInDays(\Carbon\Carbon::parse($surat->tgl_selesai)) + 1 }}
                        hari</td>
                </tr>
                <tr>
                    <td>Lokasi</td>
                    <td>:</td>
                    <td>{{ $surat->lokasi_tujuan }}</td>
                </tr>
                <tr>
                    <td>Tanggal</td>
                    <td>:</td>
                    <td>{{ \Carbon\Carbon::parse($surat->tgl_mulai)->translatedFormat('d F Y') }} s.d.
                        {{ \Carbon\Carbon::parse($surat->tgl_selesai)->translatedFormat('d F Y') }}</td>
                </tr>
                <tr>
                    <td>Sumber Dana</td>
                    <td>:</td>
                    <td>{{ $surat->sumber_dana }}</td>
                </tr>
            </table>
        </div>

        <div style="margin-top: 48px; text-align: right;">
            {{ $surat->lokasi_berangkat ?? 'Lokasi Berangkat' }},
            {{ \Carbon\Carbon::parse($surat->tgl_mulai)->translatedFormat('d F Y') }}<br>
            Kepala,<br><br><br><br><br><br>
            <span style="font-weight: bold; text-decoration: underline;">{{ $surat->pejabatSt->nama_pegawai }}</span>
        </div>

        <div style="margin-top: 48px;">
            <hr>
            <small><i>
                    Dokumen ini telah ditandatangani secara sah yang diterbitkan
                    oleh BMKG Wilayah.
                </i></small>
        </div>

    </div>

</body>

</html>
