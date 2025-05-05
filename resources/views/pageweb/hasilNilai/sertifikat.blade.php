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
            margin: 1.54cm;
            padding: 1cm;
            size: landscape;
            border: 1px solid #000000;
            box-sizing: border-box;
            background-color: #dfa810;

        }


        /* Gaya untuk memastikan gambar di kiri dan teks di tengah */
        .header {
            display: flex;
            /* Menggunakan flexbox untuk tata letak */
            align-items: center;
            /* Mengatur agar elemen sejajar secara vertikal */
            justify-content: flex-start;
            /* Mengatur konten ke kiri */
            margin-bottom: 20px;
            /* Jarak bawah untuk pemisah */
        }

        .header img {
            max-width: 100px;
            /* Atur ukuran maksimum gambar */
            margin-right: 20px;
            /* Jarak antara gambar dan teks */
        }

        .header div {
            flex-grow: 1;
            /* Mengizinkan div teks untuk mengambil ruang yang tersisa */
            text-align: center;
            /* Mengatur teks di tengah */
        }

        .header h3,
        .header p {
            margin: 0;
            /* Menghapus margin default */
        }

        .info {
            margin-bottom: 20px;
            /* Jarak bawah untuk informasi */
        }

        .info p {
            margin: 0;
            /* Menghapus margin default */
        }

        .info span {
            display: inline-block;
            /* Menjaga span pada baris yang sama */
            width: 150px;
            /* Lebar span untuk penataan */
        }

        .table-container {
            margin-bottom: 20px;
            /* Jarak bawah untuk tabel */
        }

        .table-container table {
            width: 100%;
            /* Memastikan tabel mengambil lebar penuh */
            border-collapse: collapse;
            /* Menghapus jarak antara border tabel */
        }

        .table-container th,
        .table-container td {
            border: 1px solid black;
            /* Border untuk sel tabel */
            padding: 8px;
            /* Jarak dalam sel */
            text-align: left;
            /* Teks rata kiri */
        }

        .table-container th {
            background-color: #f2f2f2;
            /* Warna latar belakang untuk header tabel */
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
            /* Ensures the content after this class starts on a new page */
        }
    </style>
</head>

<body>
    <div class="pages">
        <div class="info mb-2">
            <div style="display: flex; align-items: center; justify-content: center;">
                <img src="https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEizlODAh8lXFSXX29FhoUCK3LAFFfQ6l5hUuBQ10ZkVl5RN1fIAoiUX63vpcLYfCZWXLvabvXw5feuTPzs3HOW5pSVzbRoveqevTtESnuAvDW3neKiisGrmDNlXYB5l52pNP8QYvvI_XHL0B31ZcuQ38RsA_gMnOcuJ1FmSJO7pgCDzLLBi9ZAcCNkD/s320/GKL2_Universitas%20Islam%20Kuantan%20Singingi%20-%20Koleksilogo.com.jpg"
                    alt="Logo" style="width: 100px; height: 100px; margin-right: 20px;">
                <div>
                    <h4 class="very-bold">UNIVERSITAS ISLAM KUANTAN SINGINGI</h3>
                        <h4 class="very-bold">LEMBAGA PENELITIAN PENGABDIAN KEPADA MASYARAKAT DAN DAKWAH ISLAMIYAH</h4>
                </div>
            </div>
        </div>
        <hr style="border: 3px solid rgb(87, 20, 20);">
    </div>
    <div class="pages">
        <div class="info mb-2 text-center">
            <h4 class="very-bold">SERTIFIKAT HASIL</h4>
            <h4 class="very-bold">TES KEAGAMAAN</h4>
            <h5 class="">Nomor : {{ $nilaiMahasiswa->nomor_sertifikat }}</h5>
        </div>
    </div>
    <div class="pages mt-2">
        <div class="info mb-2">
            <div class="card">
                <div class="card-body" style="padding-left: 200px;">
                    <h5>Diberikan kepada:</h5>
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
            <div class="pages">
                <div class="info mb-2 text-center">
                    <h5 class="">Telah menyelesaikan <b>Tes Keagamaan</b> pada tanggal <b>{{ $nilaiMahasiswa->created_at->isoFormat('D MMMM Y') }}</b>
                        dengan hasil <b> @php
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
                        </b> dengan <b></b>Nilai :</b></h5>
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
                                    <td>{{ round(($nilaiMahasiswa->nilai_tkdk + $nilaiMahasiswa->nilai_praktek + 2) / 2) }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="pages mb-2">
                        <div class="info text-center">
                            <h5 class="">Teluk Kuantan, {{ \Carbon\Carbon::now()->isoFormat('D MMMM Y') }}</h5>
                        </div>
                    </div>
                    <div class="info">
                        <table style="width: 100%; border-collapse: collapse">
                            <tr>
                                <td style="width: 50%; text-align: center; padding: 10px">
                                    <h5 style="font-weight: bold"><u>{{ $manajemenReport->nama_rektor ?? '' }}</u></h5>
                                    <h5 style="font-weight: bold">REKTOR</h5>
                                </td>
                                <td style="width: 50%; text-align: center; padding: 10px">
                                    <h5 style="font-weight: bold"><u>{{ $manajemenReport->nama_ketua_lppmdi ?? '' }}</u></h5>
                                    <h5 style="font-weight: bold">KETUA LPPMDI</h5>
                                </td>
                            </tr>

                        </table>
                    </div>
                    <script>
                        window.onload = function() {
                            window.print();
                        };
                    </script>
</body>

</html>
