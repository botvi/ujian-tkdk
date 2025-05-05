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
                    <h4 class="very-bold">DAFTAR PENDAFTARAN TKDK TAHUN {{ $tahunAktif->tahun_akademik }} {{ strtoupper($gelombangAktif->nama_gelombang) }}</h4>
                    <h4 class="very-bold">UNIVERSITAS ISLAM KUANTAN SINGINGI</h4>
                    <h4 class="very-bold">LEMBAGA PENELITIAN PENGABDIAN KEPADA MASYARAKAT DAN DAKWAH ISLAMIYAH</h4>
                    <h5>Hari : {{ \Carbon\Carbon::now()->isoFormat('dddd') }}, Tanggal : {{ \Carbon\Carbon::now()->isoFormat('D MMMM Y') }}, Jam : {{ \Carbon\Carbon::now()->format('H:i') }} WIB</h5>
                </div>
            </div>
        </div>


        <div class="info">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NPM</th>
                        <th>Nama Mahasiswa/i</th>
                        <th>Program Studi</th>
                        <th>Fakultas</th>
                        <th>Semester</th>
                        <th>No. WA</th>
                        <th>Tanda Tangan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($mahasiswa as $key => $item)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $item->npm }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->prodi }}</td>
                            <td>{{ $item->fakultas }}</td>
                            <td>{{ $item->semester }}</td>
                            <td>{{ $item->no_wa }}</td>
                            <td></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <table>
                <thead>
                    <tr>
                        <th>Teluk Kuantan, {{ \Carbon\Carbon::now()->isoFormat('D MMMM Y') }}</th>
                    </tr>
                    <tr style="height: 50px">
                        <th><strong>Pengawas Ujian,</strong></th>
                    </tr>
                    <tr style="height: 50px">
                        <th><strong>1. ........................................................</strong></th>
                        <th style="padding-left: 50px">1.</th>
                    </tr>
                    <tr style="height: 50px">
                        <th><strong>2. ........................................................</strong></th>
                        <th style="padding-left: 200px">2.</th>
                    </tr>
                    <tr style="height: 50px">
                        <th><strong>3. ........................................................</strong></th>
                        <th style="padding-left: 50px">3.</th>
                    </tr>
                    <tr style="height: 50px">
                        <th><strong>4. ........................................................</strong></th>
                        <th style="padding-left: 200px">4.</th>
                    </tr>
                </thead>
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
