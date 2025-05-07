<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Laporan Rekap Pendaftaran</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    <style>
        * {
            margin: 0;
            padding: 0;
            font-family: "Times New Roman", Times, serif;
        }

        body {
            background-color: #ffffff;
        }

        .very-bold {
            font-weight: 1000;
        }

        @page {
            margin: 1cm;
            size: landscape;
            border: 1px solid #000000;
            box-sizing: border-box;
            background-color: #dfa810;
        }

        .header {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            margin-bottom: 20px;
        }

        .header img {
            max-width: 100px;
            margin-right: 20px;
        }

        .header div {
            flex-grow: 1;
            text-align: center;
        }

        .header h3,
        .header p {
            margin: 0;
        }

        .info {
            margin-bottom: 20px;
        }

        .info p {
            margin: 0;
        }

        .info span {
            display: inline-block;
            width: 150px;
        }

        .table-container {
            margin-bottom: 20px;
        }

        .table-container table {
            width: 100%;
            border-collapse: collapse;
        }

        .table-container th,
        .table-container td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        .table-container th {
            background-color: #f2f2f2;
        }

        .line {
            border-left: 2px solid black;
            display: inline-block;
            margin: 0 10px;
        }

        .line-short {
            height: 500px;
        }

        .line-long {
            height: 700px;
        }

        .page-break {
            page-break-after: always;
        }
    </style>
</head>

<body>
    <div class="pages">
        <div class="info">
            <div style="display: flex; align-items: center; justify-content: center; margin: 20px 0;">
                <img src="https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEizlODAh8lXFSXX29FhoUCK3LAFFfQ6l5hUuBQ10ZkVl5RN1fIAoiUX63vpcLYfCZWXLvabvXw5feuTPzs3HOW5pSVzbRoveqevTtESnuAvDW3neKiisGrmDNlXYB5l52pNP8QYvvI_XHL0B31ZcuQ38RsA_gMnOcuJ1FmSJO7pgCDzLLBi9ZAcCNkD/s320/GKL2_Universitas%20Islam%20Kuantan%20Singingi%20-%20Koleksilogo.com.jpg"
                    alt="Logo" style="width: 100px; height: 100px; margin-right: 20px;">
                <div style="display: flex; flex-direction: column; justify-content: center;">
                    <h5 class="very-bold" style="margin: 5px 0;">UNIVERSITAS ISLAM KUANTAN SINGINGI</h5>
                    <h5 class="very-bold" style="margin: 5px 0;">LEMBAGA PENELITIAN PENGABDIAN KEPADA MASYARAKAT</h5>
                    <h5 class="very-bold" style="margin: 5px 0;">DAN DAKWAH ISLAMIYAH</h5>
                </div>
            </div>
        </div>
        <hr style="border: 3px solid rgb(87, 20, 20); margin: 20px 0;">
    </div>

    <div class="pages">
        <div class="info mb-2 text-center">
            <p class="very-bold">SERTIFIKAT HASIL</p>
            <p class="very-bold">TES KEAGAMAAN</p>
            <p>Nomor : {{ $nilaiMahasiswa->nomor_sertifikat }}</p>
        </div>
    </div>

    <div class="pages mt-2">
        <div class="info mb-2">
            <div class="card">
                <div class="card-body" style="padding-left: 200px;">
                    <p style="font-size: 16px;">Diberikan kepada:</p>
                    <table>
                        <tr>
                            <td colspan="4" style="padding-right: 70px;">NAMA</td>
                            <td style="padding-right: 40px;">:</td>
                            <td>{{ $nilaiMahasiswa->user->mahasiswa->nama }}</td>
                        </tr>
                        <tr>
                            <td colspan="4" style="padding-right: 70px;">NPM</td>
                            <td style="padding-right: 40px;">:</td>
                            <td>{{ $nilaiMahasiswa->user->mahasiswa->npm }}</td>
                        </tr>
                        <tr>
                            <td colspan="4" style="padding-right: 70px;">PROGRAM STUDI</td>
                            <td style="padding-right: 40px;">:</td>
                            <td>{{ $nilaiMahasiswa->user->mahasiswa->prodi }}</td>
                        </tr>
                        <tr>
                            <td colspan="4" style="padding-right: 70px;">FAKULTAS</td>
                            <td style="padding-right: 40px;">:</td>
                            <td>{{ $nilaiMahasiswa->user->mahasiswa->fakultas }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="pages">
            <div class="info mb-2 text-center">
                <p style="font-size: 16px;">
                    Telah menyelesaikan <b>Tes Keagamaan</b> pada tanggal
                    <b>{{ $nilaiMahasiswa->created_at->isoFormat('D MMMM Y') }}</b>
                    dengan hasil <b>
                        @php
                            $totalNilai = round(($nilaiMahasiswa->nilai_tkdk + $nilaiMahasiswa->nilai_praktek + 2) / 2);
                        @endphp
                        @if ($totalNilai >= 80)
                            Sangat Memuaskan
                        @elseif($totalNilai >= 70)
                            Memuaskan
                        @elseif($totalNilai >= 60)
                            Cukup Memuaskan
                        @else
                            Tidak Memuaskan
                        @endif
                    </b> dengan <b>Nilai:</b>
                </p>
            </div>
        </div>

        <div class="pages mt-2">
            <div class="info mb-2">
                <div class="card">
                    <div class="card-body" style="padding-left: 200px;">
                        <table>
                            <tr>
                                <td colspan="4" style="padding-right: 70px;">Tes Kemampuan Dasar Keagamaan</td>
                                <td style="padding-right: 40px;">:</td>
                                <td>{{ $nilaiMahasiswa->nilai_tkdk }}</td>
                            </tr>
                            <tr>
                                <td colspan="4" style="padding-right: 70px;">Tes Praktek/Lisan Keagamaan</td>
                                <td style="padding-right: 40px;">:</td>
                                <td>{{ $nilaiMahasiswa->nilai_praktek }}</td>
                            </tr>
                            <tr>
                                <td colspan="4" style="padding-right: 70px;">Total</td>
                                <td style="padding-right: 40px;">:</td>
                                <td>{{ round(($nilaiMahasiswa->nilai_tkdk + $nilaiMahasiswa->nilai_praktek + 2) / 2 - 1) }}
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div style="text-align: center">
                <p style="font-size: 16px;">Teluk Kuantan,
                    {{ \Carbon\Carbon::now()->isoFormat('D MMMM Y') }}</p>
            </div>

            <div class="pages" style="margin-top: -60px;">
                <div style="display: flex; justify-content: space-between; align-items: flex-end;">
                    <div style="text-align: center; flex: 1;">
                        @if ($manajemenReport->ttd_rektor)
                            <img src="{{ asset('/' . $manajemenReport->ttd_rektor) }}" alt="Tanda Tangan Rektor"
                                style="width: 150px; margin-bottom: -50px; display: block; margin-left: auto; margin-right: auto;">
                        @else
                            <div
                                style="width: 150px; height: 150px; margin-bottom: -50px; margin-left: auto; margin-right: auto;">
                            </div>
                        @endif
                        <p style="font-size: 16px; font-weight: bold; margin: 0;">
                            <u>{{ $manajemenReport->nama_rektor ?? '' }}</u>
                        </p>
                        <p style="font-size: 16px; font-weight: bold; margin: 0;">REKTOR</p>
                    </div>



                    <div style="text-align: center; flex: 1;">
                        @if ($manajemenReport->ttd_ketua_lppmdi)
                            <img src="{{ asset('/' . $manajemenReport->ttd_ketua_lppmdi) }}"
                                alt="Tanda Tangan Ketua LPPMDI"
                                style="width: 150px; margin-bottom: -50px; display: block; margin-left: auto; margin-right: auto;">
                        @else
                            <div
                                style="width: 150px; height: 150px; margin-bottom: -50px; margin-left: auto; margin-right: auto;">
                            </div>
                        @endif
                        <p style="font-size: 16px; font-weight: bold; margin: 0;">
                            <u>{{ $manajemenReport->nama_ketua_lppmdi ?? '' }}</u>
                        </p>
                        <p style="font-size: 16px; font-weight: bold; margin: 0;">KETUA LPPMDI</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        window.onload = function() {
            window.print();
        };
    </script>
</body>

</html>
