<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Laporan Rekap Nilai</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />

    <style>
        * {
            margin: 0;
            padding: 0;
            font-family: "Times New Roman", Times, serif;
        }

        .very-bold {
            font-weight: 1000;
        }

        @page {
            margin: 2.54cm;
            box-sizing: border-box;
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
        <div class="info mb-5 text-center">
            <div style="display: flex; align-items: center; justify-content: center;">
                <img src="https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEizlODAh8lXFSXX29FhoUCK3LAFFfQ6l5hUuBQ10ZkVl5RN1fIAoiUX63vpcLYfCZWXLvabvXw5feuTPzs3HOW5pSVzbRoveqevTtESnuAvDW3neKiisGrmDNlXYB5l52pNP8QYvvI_XHL0B31ZcuQ38RsA_gMnOcuJ1FmSJO7pgCDzLLBi9ZAcCNkD/s320/GKL2_Universitas%20Islam%20Kuantan%20Singingi%20-%20Koleksilogo.com.jpg"
                    alt="Logo" style="width: 170px; height: 170px; margin-right: 20px;">
                <div>
                    <h4 class="very-bold">YAYASAN PERGURUAN TINGGI ISLAM KUANTAN SINGINGI</h4>
                    <h4 class="very-bold">UNIVERSITAS ISLAM KUANTAN SINGINGI</h4>
                    <h4 class="very-bold">LEMBAGA PENELITIAN PENGABDIAN KEPADA MASYARAKAT DAN DAKWAH ISLAMIYAH</h4>
                    <h5>Jl. Gatot Subroto KM.7, Kel. Teluk Kuantan - Kab. Kuantan Singingi</h5>
                </div>
            </div>
        </div>
        <hr style="border: 1px solid black;">
        <div class="info mb-5 text-center">
            <div style="display: flex; align-items: center; justify-content: center;">
                <div>
                    <h5 class="very-bold">HASIL TES KEAGAMAAN {{ strtoupper($gelombangAktif->nama_gelombang) }} TAHUN
                        {{ $tahunAktif->tahun_akademik }}</h5>
                </div>
            </div>
        </div>
        <div class="info">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Mahasiswa/i</th>
                        <th>NPM</th>
                        <th>Program Studi</th>
                        <th>Fakultas</th>
                        <th>TKDK</th>
                        <th>Praktek</th>
                        <th>Total</th>
                        <th>Prediket Kelulusan</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($nilaiMahasiswa as $key => $item)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $item->user->mahasiswa->nama }}</td>
                            <td>{{ $item->user->mahasiswa->npm }}</td>
                            <td>{{ $item->user->mahasiswa->prodi }}</td>
                            <td>{{ $item->user->mahasiswa->fakultas }}</td>
                            <td>{{ $item->nilai_tkdk ?? '-' }}</td>
                            <td>{{ $item->nilai_praktek ?? '-' }}</td>
                            <td>{{ round(($item->nilai_tkdk + $item->nilai_praktek + 2) / 2) ?? '-' }}</td>
                            <td>
                                @php
                                    $totalNilai = round(($item->nilai_tkdk + $item->nilai_praktek + 2) / 2);
                                @endphp
                                @if($totalNilai >= 80)
                                    Sangat Memuaskan
                                @elseif($totalNilai >= 70)
                                    Memuaskan
                                @elseif($totalNilai >= 60)
                                    Cukup Memuaskan
                                @else
                                    Tidak Memuaskan
                                @endif
                            </td>
                            <td>
                                @php
                                    $totalNilai = round(($item->nilai_tkdk + $item->nilai_praktek + 2) / 2);
                                @endphp
                             
                                @if($totalNilai >= 60)
                                    Lulus
                                @else
                                    Tidak Lulus
                                @endif
                            </td>
                            
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="info">
            <table style="width: 100%; border-collapse: collapse">
                <tr>
                    <td style="width: 50%; text-align: center; padding: 10px">
                        <h5 style="margin-bottom: 60px"></h5>
                        <h5></h5>
                    </td>
                    <td style="width: 50%; text-align: center; padding: 10px">
                        <h5>Teluk Kuantan, {{ \Carbon\Carbon::now()->format('d F Y') }}</h5>
                        <h5 style="margin-bottom: 60px">Ketua,</h5>
                        <h5 style="font-weight: bold"><u>{{ $manajemenReport->nama_ketua_lppmdi ?? '' }}</u></h5>
                        <h5 style="font-weight: bold">NIDN. {{ $manajemenReport->nidn_ketua_lppmdi ?? '' }}</h5>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="padding: 10px; height: 100px"></td>
                </tr>
            </table>
        </div>
        
    </div>
    <script>
        window.onload = function() {
            window.print();
        };
    </script>
</body>

</html>
