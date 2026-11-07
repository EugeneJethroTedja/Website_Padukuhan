@extends('layouts.app')

@section('content')

{{-- **START OF INLINE CSS FOR KEGIATAN SHOW (DEBUGGING/TEMPORARY)** --}}
<style>
    /* Mengimpor Font Google */
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Montserrat:wght@300;400;500;700&display=swap');

    /* Variabel Warna Global (Konsisten dengan file lain) */
    :root {
        --primary-accent: #064a9e; /* Blue-Grey Dark - "Biru susu tua" yang elegan untuk aksen utama */
        --secondary-accent: #064a9e; /* Blue-Grey Light - Untuk aksen sekunder/hover */
        --heading-dark: #212529; /* Very dark almost black for main headings */
        --text-dark: #343A40; /* Dark grey for body text */
        --text-light: #DEE2E6; /* Very light grey for text on dark backgrounds */
        --background-light: #F8F9FA; /* Off-white for main background */
        --background-dark: #2C3034; /* Deep charcoal for section backgrounds */
        --border-color: #E9ECEF; /* Light border color for separation */
        --overlay-dark: rgba(0, 0, 0, 0.65); /* Dark overlay for hero/section images */
        --card-bg: #FFFFFF; /* Pure white for card backgrounds */
        --footer-bg: #1A1A1A; /* Hampir hitam untuk footer */
        --footer-text: #CED4DA; /* Teks terang untuk footer */
        --shadow-light: 0 5px 15px rgba(0, 0, 0, 0.1);
        --shadow-medium: 0 10px 30px rgba(0, 0, 0, 0.15);
        --shadow-deep: 0 15px 40px rgba(0, 0, 0, 0.25);
    }

    body {
        background-color: var(--background-light);
        font-family: 'Montserrat', sans-serif;
        color: var(--text-dark);
        overflow-x: hidden;
        padding-top: 75px !important; /* Sesuaikan dengan tinggi navbar Anda */
    }
    @media (max-width: 991.98px) { body { padding-top: 68px !important; } }
    @media (max-width: 767.98px) { body { padding-top: 58px !important; } }

    /* Hero Section Detail (mirip dengan yang lain tapi lebih fokus pada satu item) */
    .detail-hero-section {
        position: relative;
        height: 550px; /* Tinggi hero section */
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        color: var(--text-light);
        text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.8);
        overflow: hidden;
        margin-top: -75px; /* Offset untuk menempatkan di bawah navbar fixed */
        box-shadow: var(--shadow-deep);
    }

    .detail-hero-section .hero-image {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        filter: brightness(0.6) grayscale(0.2); /* Sedikit gelap dan monokrom untuk teks lebih jelas */
        transform: scale(1.05); /* Sedikit zoom in untuk efek dinamis */
        transition: transform 0.5s ease-out; /* Animasi saat load */
    }

    .detail-hero-section .overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(to top, rgba(0, 0, 0, 0.8) 0%, rgba(0, 0, 0, 0.3) 50%, rgba(0, 0, 0, 0.8) 100%);
        z-index: 1;
    }

    .detail-hero-section .container {
        position: relative;
        z-index: 2;
        max-width: 900px;
    }

    .detail-hero-section h1 {
        font-family: 'Playfair Display', serif;
        font-size: 4.5rem;
        margin-bottom: 1.5rem;
        line-height: 1.1;
        letter-spacing: -1px;
        font-weight: 700;
        animation: fadeInDown 1.2s ease-out forwards;
    }

    .detail-hero-section p.lead {
        font-family: 'Montserrat', sans-serif;
        font-size: 1.6rem;
        font-weight: 300;
        margin-bottom: 2.5rem;
        animation: fadeInUp 1.2s ease-out forwards 0.3s;
    }

    .detail-hero-section .btn-return {
        background-color: transparent;
        color: var(--text-light);
        border: 2px solid var(--text-light);
        padding: 0.8rem 2rem;
        border-radius: 30px;
        font-size: 1.1rem;
        transition: all 0.3s ease;
        text-decoration: none;
    }

    .detail-hero-section .btn-return:hover {
        background-color: var(--text-light);
        color: var(--primary-accent);
        transform: translateY(-3px);
        box-shadow: var(--shadow-medium);
    }

    /* General Content Sections */
    .content-section {
        padding: 6rem 0; /* Padding lebih besar */
        margin-bottom: 3rem; /* Jarak antar section */
        box-shadow: var(--shadow-light);
    }

    .content-section.bg-light-section {
        background-color: var(--background-light);
        color: var(--text-dark);
    }

    .content-section.bg-dark-section {
        background-color: var(--background-dark);
        color: var(--text-light);
        box-shadow: var(--shadow-medium);
    }

    .content-section.bg-dark-section h2,
    .content-section.bg-dark-section h3,
    .content-section.bg-dark-section p,
    .content-section.bg-dark-section .icon-list-item,
    .content-section.bg-dark-section .icon-list-item i {
        color: var(--text-light);
        opacity: 0.9;
    }
    .content-section.bg-dark-section h2::after {
        background-color: var(--secondary-accent);
    }


    .content-section h2 {
        font-family: 'Playfair Display', serif;
        font-size: 3.8rem;
        color: var(--heading-dark);
        text-align: center;
        margin-bottom: 4rem;
        position: relative;
        padding-bottom: 15px;
        font-weight: 700;
    }

    .content-section h2::after {
        content: '';
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
        bottom: 0;
        width: 120px;
        height: 5px;
        background-color: var(--primary-accent);
        border-radius: 3px;
    }

    .content-section h3 {
        font-family: 'Playfair Display', serif;
        font-size: 2.8rem;
        color: var(--heading-dark);
        margin-bottom: 1.5rem;
        font-weight: 600;
    }

    .content-section p {
        font-size: 1.15rem;
        line-height: 1.9;
        margin-bottom: 1.8rem;
    }

    .img-fluid.rounded.shadow-lg {
        border-radius: 12px !important;
        box-shadow: var(--shadow-medium) !important;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .img-fluid.rounded.shadow-lg:hover {
        transform: scale(1.02);
        box-shadow: var(--shadow-deep) !important;
    }

    /* Info Block (for date, location etc.) */
    .info-block {
        background-color: var(--card-bg);
        border-radius: 12px;
        box-shadow: var(--shadow-light);
        padding: 2.5rem;
        margin-bottom: 2rem;
        text-align: center;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .info-block:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-medium);
    }

    .info-block i {
        font-size: 3rem;
        color: var(--primary-accent);
        margin-bottom: 1rem;
    }

    .info-block h4 {
        font-family: 'Playfair Display', serif;
        font-size: 1.8rem;
        color: var(--heading-dark);
        margin-bottom: 0.5rem;
    }

    .info-block p {
        font-size: 1.1rem;
        color: var(--text-dark);
        margin-bottom: 0;
    }

    /* Icon List */
    .icon-list-item {
        display: flex;
        align-items: flex-start; /* Align icon to top of text if text wraps */
        margin-bottom: 1rem;
        font-size: 1.1rem;
        color: var(--text-dark);
    }
    .icon-list-item i {
        color: var(--primary-accent);
        font-size: 1.6rem;
        margin-right: 15px;
        min-width: 35px; /* Fixed width for icon to align text */
        text-align: center;
        padding-top: 3px; /* Adjust vertical alignment for icon */
    }

    /* Galeri Kegiatan Grid */
    .gallery-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 2rem;
        margin-top: 3rem;
    }

    .gallery-grid .gallery-item {
        background-color: var(--card-bg);
        border-radius: 12px;
        box-shadow: var(--shadow-light);
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        height: 100%; /* Ensure consistent height for flex/grid */
        display: flex;
        flex-direction: column;
    }

    .gallery-grid .gallery-item:hover {
        transform: translateY(-8px);
        box-shadow: var(--shadow-deep);
    }

    .gallery-grid .gallery-item img {
        width: 100%;
        height: 220px; /* Konsisten tinggi gambar */
        object-fit: cover;
        border-bottom: 3px solid var(--secondary-accent);
    }

    .gallery-grid .gallery-item .gallery-info {
        padding: 1.5rem;
        flex-grow: 1; /* Allow content to grow */
    }

    .gallery-grid .gallery-item h4 {
        font-family: 'Playfair Display', serif;
        font-size: 1.8rem;
        color: var(--heading-dark);
        margin-bottom: 0.5rem;
    }

    .gallery-grid .gallery-item p {
        font-size: 0.95rem;
        color: var(--text-dark);
        line-height: 1.6;
    }

    /* Map Section */
    .map-container {
        border-radius: 15px;
        overflow: hidden;
        box-shadow: var(--shadow-deep);
        border: 5px solid var(--primary-accent);
    }

    .map-container iframe {
        border: none;
    }

    /* Testimonial Section (Example) */
    .testimonial-card {
        background-color: var(--card-bg);
        border-radius: 12px;
        box-shadow: var(--shadow-medium);
        padding: 2.5rem;
        margin: 2rem auto;
        max-width: 800px;
        position: relative;
        overflow: hidden;
        text-align: center;
    }

    .testimonial-card i.fas.fa-quote-left {
        font-size: 3rem;
        color: var(--primary-accent);
        opacity: 0.2;
        position: absolute;
        top: 20px;
        left: 30px;
        z-index: 0;
    }

    .testimonial-card p.testimonial-text {
        font-family: 'Playfair Display', serif;
        font-size: 1.5rem;
        line-height: 1.8;
        color: var(--heading-dark);
        margin-bottom: 1.5rem;
        position: relative;
        z-index: 1;
    }

    .testimonial-card .author {
        font-weight: 600;
        color: var(--primary-accent);
        font-size: 1.1rem;
    }

    .testimonial-card .author span {
        font-weight: 400;
        color: var(--text-dark);
        font-size: 0.9rem;
    }


    /* Responsive adjustments */
    @media (max-width: 991.98px) {
        .detail-hero-section { height: 450px; }
        .detail-hero-section h1 { font-size: 3.5rem; }
        .detail-hero-section p.lead { font-size: 1.3rem; }
        .content-section { padding: 4rem 0; }
        .content-section h2 { font-size: 3rem; margin-bottom: 3rem; }
        .content-section h3 { font-size: 2.2rem; }
        .content-section p { font-size: 1.05rem; }
        .info-block { padding: 2rem; }
        .info-block h4 { font-size: 1.6rem; }
        .info-block p { font-size: 1rem; }
        .gallery-grid { gap: 1.5rem; }
        .gallery-grid .gallery-item img { height: 200px; }
        .gallery-grid .gallery-item h4 { font-size: 1.6rem; }
    }

    @media (max-width: 767.98px) {
        .detail-hero-section { height: 380px; margin-top: -58px; /* Adjusted for mobile navbar */ }
        .detail-hero-section h1 { font-size: 2.8rem; margin-bottom: 1rem; }
        .detail-hero-section p.lead { font-size: 1.1rem; margin-bottom: 1.5rem; }
        .detail-hero-section .btn-return { padding: 0.6rem 1.5rem; font-size: 1rem; }
        .content-section { padding: 3rem 0; margin-bottom: 2rem; }
        .content-section h2 { font-size: 2.5rem; margin-bottom: 2rem; }
        .content-section h2::after { width: 80px; height: 4px; }
        .content-section h3 { font-size: 1.8rem; }
        .content-section p { font-size: 1rem; line-height: 1.7; }
        .info-block { padding: 1.5rem; }
        .info-block i { font-size: 2.5rem; }
        .info-block h4 { font-size: 1.4rem; }
        .icon-list-item { font-size: 0.95rem; }
        .icon-list-item i { font-size: 1.4rem; margin-right: 10px; min-width: 25px;}
        .gallery-grid { grid-template-columns: 1fr; gap: 1rem; }
        .gallery-grid .gallery-item img { height: 180px; }
        .gallery-grid .gallery-item h4 { font-size: 1.4rem; }
        .testimonial-card p.testimonial-text { font-size: 1.2rem; }
    }
</style>
{{-- **END OF INLINE CSS FOR KEGIATAN SHOW** --}}

{{-- Bagian Hero/Banner untuk Detail Kegiatan --}}
<section class="detail-hero-section">
    @if($kegiatan->gambar)
        <img src="{{ asset('storage/kegiatan/' . $kegiatan->gambar) }}" alt="{{ $kegiatan->nama_kegiatan }}" class="hero-image">
    @else
        <img src="{{ asset('images/kegiatan-banner-detail.jpg') }}" alt="Gambar Kegiatan Default" class="hero-image">
    @endif
    <div class="overlay"></div>
    <div class="container text-center text-light position-relative" style="z-index: 2;">
        <h1 style="color: #CED4DA" class="animate__animated animate__fadeInDown">{{ $kegiatan->nama_kegiatan }}</h1>
        <p class="lead animate__animated animate__fadeInUp animate__delay-1s">
            <i class="fas fa-calendar-alt me-2"></i> {{ \Carbon\Carbon::parse($kegiatan->tanggal)->locale('id')->isoFormat('D MMMM YYYY') }}
            <span class="mx-3">|</span>
            <i class="fas fa-map-marker-alt me-2"></i> {{ $kegiatan->lokasi ?? 'Lokasi Belum Ditentukan' }}
        </p>
        <div class="mt-4 animate__animated animate__zoomIn animate__delay-2s">
            <a class="btn btn-return" href="{{ route('kegiatan.index.umum') }}">
                <i class="fas fa-arrow-left me-2"></i> Kembali ke Agenda
            </a>
        </div>
    </div>
</section>

{{-- Section: Ringkasan Kegiatan --}}
<section class="content-section bg-light-section">
    <div class="container">
        <div class="row align-items-stretch">
            <div class="col-lg-6 mb-4 mb-lg-0 animate__animated animate__fadeInLeft d-flex">
                <img src="{{ asset('storage/kegiatan/' . $kegiatan->gambar) }}" 
                     alt="Ilustrasi Kegiatan" 
                     class="img-fluid rounded shadow-lg w-100 h-100 object-fit-cover" 
                     style="object-fit: cover;">
            </div>
            <div class="col-lg-6 animate__animated animate__fadeInRight d-flex flex-column justify-content-center">
                <div>
                    <h3>Tentang Acara Ini</h3>
                    <p>
                        {{ $kegiatan->deskripsi ?? 'Deskripsi lengkap kegiatan ini belum tersedia. Kegiatan ini merupakan salah satu inisiatif penting kami untuk memajukan desa dan memberdayakan masyarakat. Kami mengundang seluruh warga dan pengunjung untuk berpartisipasi aktif!' }}
                    </p>
                    <p>
                        Setiap kegiatan yang kami selenggarakan dirancang untuk memberikan dampak positif, baik dalam bidang ekonomi, sosial, maupun budaya. Kami percaya bahwa partisipasi aktif adalah kunci keberhasilan setiap program.
                    </p>
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <div class="info-block">
                                <i class="fas fa-calendar-check"></i>
                                <h4>Tanggal Kegiatan</h4>
                                <p>{{ \Carbon\Carbon::parse($kegiatan->tanggal)->locale('id')->isoFormat('dddd, D MMMM YYYY') }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-block">
                                <i class="fas fa-clock"></i>
                                <h4>Jam Pelaksanaan</h4>
                                <p>Pukul : {{ $kegiatan->waktu ?? 'Akan diumumkan' }} WIB</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Section: Detail & Agenda --}}
<section class="content-section bg-dark-section py-5" style="background: #064a9e">
    <div class="container">
        <h2 class="text-light text-center mb-4">Agenda & Rangkaian Kegiatan</h2>
        <p class="text-center text-light mb-5">
            Berikut adalah rangkaian agenda kegiatan **{{ $kegiatan->nama_kegiatan }}** yang telah dirancang untuk memberikan pengalaman bermanfaat dan membangun semangat kebersamaan antarwarga. Pastikan Anda hadir dan berpartisipasi dalam setiap momen berharga ini.
        </p>
        <div class="row align-items-center">
            <div class="col-lg-6 animate__animated animate__fadeInLeft mb-4 mb-lg-0">
                <img src="{{ asset('storage/kegiatan/' . $kegiatan->gambar) }}" 
                     alt="Ilustrasi {{ $kegiatan->nama_kegiatan }}" 
                     class="img-fluid rounded shadow-lg w-100"
                     style="max-height: 500px; object-fit: cover; object-position: center;">
            </div>
            <div class="col-lg-6 animate__animated animate__fadeInRight">
                <ul class="list-unstyled">
                    <li class="d-flex align-items-start mb-4">
                        <i class="fas fa-lightbulb fa-2x text-light me-3"></i>
                        <div>
                            <h5 class="text-light mb-1">Sesi Inspiratif</h5>
                            <p class="text-light mb-0">Berbagai materi bermanfaat untuk membuka wawasan dan meningkatkan keterampilan peserta sesuai tema kegiatan.</p>
                        </div>
                    </li>
                    <li class="d-flex align-items-start mb-4">
                        <i class="fas fa-users-cog fa-2x text-light me-3"></i>
                        <div>
                            <h5 class="text-light mb-1">Diskusi dan Sharing</h5>
                            <p class="text-light mb-0">Kesempatan untuk berdiskusi, berbagi pengalaman, dan mempererat tali silaturahmi antarwarga.</p>
                        </div>
                    </li>
                    <li class="d-flex align-items-start mb-4">
                        <i class="fas fa-handshake fa-2x text-light me-3"></i>
                        <div>
                            <h5 class="text-light mb-1">Kolaborasi Komunitas</h5>
                            <p class="text-light mb-0">Memperkuat kerja sama dan membangun sinergi dalam kegiatan pembangunan dan pemberdayaan masyarakat.</p>
                        </div>
                    </li>
                    <li class="d-flex align-items-start mb-4">
                        <i class="fas fa-chart-line fa-2x text-light me-3"></i>
                        <div>
                            <h5 class="text-light mb-1">Capaian & Evaluasi</h5>
                            <p class="text-light mb-0">Melihat hasil, dampak, dan rencana tindak lanjut untuk keberlanjutan program padukuhan ke depan.</p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

{{-- Section: Galeri Kegiatan --}}
<section class="content-section bg-light-section">
    <div class="container">
        <h2>Momen-momen Kegiatan Sebelumnya</h2>
        <p class="lead text-center mb-5">Jelajahi potret-potret inspiratif dari kegiatan-kegiatan yang telah sukses kami selenggarakan.</p>

        <div class="gallery-grid">
            <div class="gallery-item animate__animated animate__fadeInUp">
                <img src="{{ asset('images/kerja1.jpg') }}" alt="Kegiatan Bersih Desa" class="img-fluid">
                <div class="gallery-info">
                    <h4>Kerja Bakti Bersama</h4>
                    <p>Warga Padukuhan Kerjo bergotong royong membersihkan lingkungan sekitar demi menciptakan padukuhan yang bersih dan sehat.</p>
                </div>
            </div>
            <div class="gallery-item animate__animated animate__fadeInUp animate__delay-1s">
                <img src="{{ asset('images/warga2.jpg') }}" alt="Festival Budaya" class="img-fluid">
                <div class="gallery-info">
                    <h4>Perkumpulan Karangtaruna</h4>
                    <p>Generasi muda padukuhan berkumpul untuk berdiskusi, merencanakan kegiatan sosial, dan mempererat solidaritas antar pemuda.</p>
                </div>
            </div>
            <div class="gallery-item animate__animated animate__fadeInUp animate__delay-2s">
                <img src="{{ asset('images/warga3.jpg') }}" alt="Penyuluhan Pertanian" class="img-fluid">
                <div class="gallery-info">
                    <h4>Pengenalan Materi Ergonomis</h4>
                    <p>Pelatihan ergonomi kepada petani dan warga untuk meningkatkan kenyamanan serta efisiensi dalam bekerja.</p>
                </div>
            </div>
            <div class="gallery-item animate__animated animate__fadeInUp">
                <img src="{{ asset('images/warga1.jpg') }}" alt="Pelatihan UMKM" class="img-fluid">
                <div class="gallery-info">
                    <h4>Sosialisasi Kepada Warga Kerjo</h4>
                    <p>Pemberian informasi dan edukasi kepada warga tentang pentingnya partisipasi aktif dalam pembangunan padukuhan.</p>
                </div>
            </div>
            <div class="gallery-item animate__animated animate__fadeInUp animate__delay-1s">
                <img src="{{ asset('images/warga4.jpg') }}" alt="Sosialisasi Kesehatan" class="img-fluid">
                <div class="gallery-info">
                    <h4>Pelatihan Warga Kerjo</h4>
                    <p>Kegiatan pelatihan yang membekali warga dengan berbagai keterampilan dan pengetahuan yang bermanfaat.</p>
                </div>
            </div>
            <div class="gallery-item animate__animated animate__fadeInUp animate__delay-2s">
                <img src="{{ asset('images/warga9.jpg') }}" alt="Penyerahan Media Informasi dan Denah Desa" class="img-fluid">
                <div class="gallery-info">
                    <h4>Penyerahan Media Informasi dan Pemetaan Padukuhan Kerjo</h4>
                    <p>Penyerahan website, akun Instagram, dan denah padukuhan sebagai sarana digitalisasi dan informasi warga Kerjo.</p>
                </div>
            </div>
            <div class="gallery-item animate__animated animate__fadeInUp animate__delay-2s">
                <img src="{{ asset('images/warga5.jpg') }}" alt="Kegiatan Arisan Padukuhan" class="img-fluid">
                <div class="gallery-info">
                    <h4>Kegiatan Arisan Padukuhan</h4>
                    <p>Warga berkumpul dalam suasana kekeluargaan untuk kegiatan arisan bulanan yang mempererat hubungan sosial.</p>
                </div>
            </div>
            <div class="gallery-item animate__animated animate__fadeInUp animate__delay-2s">
                <img src="{{ asset('images/singkong1.jpg') }}" alt="Hasil Kebun" class="img-fluid">
                <div class="gallery-info">
                    <h4>Hasil Kebun</h4>
                    <p>Produk pertanian warga Padukuhan Kerjo yang dikelola secara organik dan alami sebagai bagian dari ketahanan pangan lokal.</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Section: Kembali ke Daftar Kegiatan --}}
<section class="content-section text-center py-5" style="background-color: #064a9e">
    <div class="container">
        <h2 class="text-light mb-4 animate__animated animate__fadeInDown">Tertarik dengan Agenda Kami yang Lain?</h2>
        <p class="lead text-light mb-4 animate__animated animate__fadeInUp animate__delay-1s">Jelajahi lebih banyak kegiatan dan acara yang kami selenggarakan di Padukuhan Kerjo.</p>
        <a href="{{ route('kegiatan.index.umum') }}" class="btn btn-lg btn-outline-light animate__animated animate__zoomIn animate__delay-2s">
            <i class="fas fa-list-alt me-2"></i> Lihat Semua Kegiatan
        </a>
    </div>
</section>

@endsection