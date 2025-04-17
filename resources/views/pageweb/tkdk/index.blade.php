@extends('template-web.layout')

@section('content')
<div class="page-wrapper">
    <div class="page-content">
        <div class="container">
            
            <table class="table table-bordered">
                <tr>
                    <td width="20%"><strong>Tanggal Mulai</strong></td>
                    <td>{{ \Carbon\Carbon::parse($tanggal_mulai)->isoFormat('dddd, D MMMM Y') }}</td>
                </tr>
                <tr>
                    <td width="20%"><strong>Waktu Mulai</strong></td>
                    <td>{{ $waktu_mulai }}</td>
                </tr>
                <tr>
                    <td width="20%"><strong>Waktu Selesai</strong></td>
                    <td>{{ $waktu_selesai }}</td>
                </tr>
                <tr>
                    <td width="20%"><strong>Sisa Waktu</strong></td>
                    <td><span id="countdown" class="fw-bold text-danger"></span></td>
                </tr>
            </table>
            
            @if(count($soal) > 0)
                <form action="{{ route('saveNilaiTkdk') }}" method="POST" id="form-tkdk">
                    @csrf
                    <input type="hidden" name="nilai_tkdk" id="nilai_tkdk" value="0">
                    
                    <ul class="list-group">
                        @foreach($soal as $key => $item)
                            <li class="list-group-item">
                                <div class="mb-3">
                                    <strong>Pertanyaan {{ $key+1 }}:</strong> {{ $item['pertanyaan'] }}
                                </div>
    
                                @if($item['gambar'])
                                    <div class="mb-3">
                                        <img src="{{ asset($item['gambar']) }}" alt="Soal Image" class="img-fluid" style="max-width: 150px; height: auto; border-radius: 8px; object-fit: cover;">
                                    </div>
                                @endif
    
                                <div class="mb-3">
                                    <strong>Pilihan:</strong>
                                    <div class="form-check">
                                        <input class="form-check-input jawaban-radio" type="radio" name="jawaban{{ $key }}" id="pilihan_a{{ $key }}" value="a" data-soal-id="{{ $key }}" data-jawaban-benar="{{ $item['jawaban'] }}">
                                        <label class="form-check-label" for="pilihan_a{{ $key }}">
                                            A: {{ $item['pilihan']['a'] }}
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input jawaban-radio" type="radio" name="jawaban{{ $key }}" id="pilihan_b{{ $key }}" value="b" data-soal-id="{{ $key }}" data-jawaban-benar="{{ $item['jawaban'] }}">
                                        <label class="form-check-label" for="pilihan_b{{ $key }}">
                                            B: {{ $item['pilihan']['b'] }}
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input jawaban-radio" type="radio" name="jawaban{{ $key }}" id="pilihan_c{{ $key }}" value="c" data-soal-id="{{ $key }}" data-jawaban-benar="{{ $item['jawaban'] }}">
                                        <label class="form-check-label" for="pilihan_c{{ $key }}">
                                            C: {{ $item['pilihan']['c'] }}
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input jawaban-radio" type="radio" name="jawaban{{ $key }}" id="pilihan_d{{ $key }}" value="d" data-soal-id="{{ $key }}" data-jawaban-benar="{{ $item['jawaban'] }}">
                                        <label class="form-check-label" for="pilihan_d{{ $key }}">
                                            D: {{ $item['pilihan']['d'] }}
                                        </label>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                    
                    <div class="mt-4 mb-4">
                        <button type="submit" class="btn btn-primary" id="submit-btn">Kirim Jawaban</button>
                    </div>
                </form>
                
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        let skor = 0;
                        const totalSoal = {{ count($soal) }};
                        const radioButtons = document.querySelectorAll('.jawaban-radio');
                        const skorInput = document.getElementById('nilai_tkdk');
                        const submitBtn = document.getElementById('submit-btn');
                        const formTkdk = document.getElementById('form-tkdk');
                        
                        // Menyimpan jawaban yang sudah dipilih
                        let jawabanDipilih = 0;
                        
                        // Hitung mundur waktu
                        const waktuMulai = new Date('{{ $tanggal_mulai }} {{ $waktu_mulai }}');
                        const waktuSelesai = new Date('{{ $tanggal_mulai }} {{ $waktu_selesai }}');
                        const totalWaktu = Math.floor((waktuSelesai - waktuMulai) / 1000 / 60); // dalam menit
                        
                        // Fungsi untuk memformat waktu
                        function formatTime(seconds) {
                            const minutes = Math.floor(seconds / 60);
                            const remainingSeconds = seconds % 60;
                            return `${minutes}:${remainingSeconds < 10 ? '0' : ''}${remainingSeconds}`;
                        }
                        
                        // Hitung mundur
                        let timeLeft = totalWaktu * 60; // konversi ke detik
                        const countdownElement = document.getElementById('countdown');
                        
                        const countdownInterval = setInterval(function() {
                            timeLeft--;
                            countdownElement.textContent = formatTime(timeLeft);
                            
                            // Jika waktu habis, kirim form
                            if (timeLeft <= 0) {
                                clearInterval(countdownInterval);
                                countdownElement.textContent = "Waktu Habis!";
                                formTkdk.submit();
                            }
                        }, 1000);
                        
                        radioButtons.forEach(radio => {
                            radio.addEventListener('change', function() {
                                const soalId = this.getAttribute('data-soal-id');
                                const jawabanBenar = this.getAttribute('data-jawaban-benar');
                                const jawabanTerpilih = this.value;
                                
                                // Hitung skor
                                if (jawabanTerpilih === jawabanBenar) {
                                    skor++;
                                    skorInput.value = skor;
                                }
                                
                                // Cek apakah radio button ini belum pernah dipilih sebelumnya
                                if (!this.hasAttribute('data-counted')) {
                                    jawabanDipilih++;
                                    this.setAttribute('data-counted', 'true');
                                }
                                
                                // Aktifkan tombol submit jika semua soal sudah dijawab
                                if (jawabanDipilih === totalSoal) {
                                    submitBtn.disabled = false;
                                }
                            });
                        });
                    });
                </script>
            @else
                <p>Tidak ada soal yang tersedia.</p>
            @endif
        </div>
    </div>
</div>
@endsection
