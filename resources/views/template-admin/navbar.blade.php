<ul class="metismenu" id="menu">
    <li class="menu-label">DASHBOARD</li>
    @if(Auth::user()->role == 'admin')
    <li>
        <a href="/dashboard">
            <div class="parent-icon"><i class='bx bx-home-circle'></i></div>
            <div class="menu-title">DASHBOARD</div>
        </a>
    </li>
    <li>
        <a href="/profil">
            <div class="parent-icon"><i class='bx bx-user'></i></div>
            <div class="menu-title">PROFIL ADMIN</div>
        </a>
    </li>
    <li class="menu-label">MANAJEMEN SOAL TKDK</li>
    <li>
        <a href="/quis">
            <div class="parent-icon"><i class='bx bx-book'></i></div>
            <div class="menu-title">QUIZ (SOAL TKDK)</div>
        </a>
    </li>
    <li class="menu-label">MASTER DATA</li>
    <li>
        <a href="/master-gelombang">
            <div class="parent-icon"><i class='bx bx-calendar'></i></div>
            <div class="menu-title">MASTER GELOMBANG</div>
        </a>
    </li>
    <li>
        <a href="/master-tahun-akademik">
            <div class="parent-icon"><i class='bx bx-calendar'></i></div>
            <div class="menu-title">MASTER TAHUN AKADEMIK</div>
        </a>
    </li>
    <li>
        <a href="/master-penguji">
            <div class="parent-icon"><i class='bx bx-user'></i></div>
            <div class="menu-title">MASTER AKUN PENGUJI</div>  
        </a>
    </li>
    <li class="menu-label">MANAJEMEN MAHASISWA</li>
    <li>
        <a href="/konfirmasi-registrasi">
            <div class="parent-icon"><i class='bx bx-user-check'></i></div>
            <div class="menu-title">KONFIRMASI REGISTRASI</div>
        </a>
    </li>
 
    <li>
        <a href="/nilai-mahasiswa">
            <div class="parent-icon"><i class='bx bx-calendar'></i></div>
            <div class="menu-title">DATA NILAI MAHASISWA</div>
        </a>
    </li>
    <li>
        <a href="/jadwal-praktek">
            <div class="parent-icon"><i class='bx bx-calendar'></i></div>
            <div class="menu-title">JADWAL PRAKTEK</div>
        </a>
    </li>
    <li>
        <a href="/manajemen-report">
            <div class="parent-icon"><i class='bx bx-file'></i></div>
            <div class="menu-title">MANAJEMEN REPORT</div>
        </a>
    </li>
    <li>
        <a href="/laporan">
            <div class="parent-icon"><i class='bx bx-file'></i></div>
            <div class="menu-title">LAPORAN</div>
        </a>
    </li>
    @endif
    @if(Auth::user()->role == 'penguji')
    <li>
        <a href="/penguji/dashboard">
            <div class="parent-icon"><i class='bx bx-user'></i></div>
            <div class="menu-title">DASHBOARD</div>
        </a>
    </li>
    <li>
        <a href="/penguji/daftar-mahasiswa-praktek">
            <div class="parent-icon"><i class='bx bx-book'></i></div>
            <div class="menu-title">NILAI PRAKTEK</div>
        </a>
    </li>
    @endif
</ul>
