@extends('layouts.app')

@section('content')

{{-- **START OF INLINE CSS FOR KESENIAN DESA SHOW (DEBUGGING/TEMPORARY)** --}}
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

    /* Hero Section Detail */
    .detail-hero-section {
        position: relative;
        height: 600px; /* Tinggi hero section lebih besar */
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
        filter: brightness(0.6) grayscale(0.1); /* Sedikit gelap dan monokrom untuk teks lebih jelas */
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
        font-size: 5rem; /* Ukuran font lebih besar */
        margin-bottom: 1.5rem;
        line-height: 1.1;
        letter-spacing: -2px; /* Lebih rapat untuk kesan elegan */
        font-weight: 700;
        animation: fadeInDown 1.2s ease-out forwards;
    }

    .detail-hero-section p.lead {
        font-family: 'Montserrat', sans-serif;
        font-size: 1.8rem;
        font-weight: 300;
        margin-bottom: 3rem;
        animation: fadeInUp 1.2s ease-out forwards 0.3s;
    }

    .detail-hero-section .btn-return {
        background-color: transparent;
        color: var(--text-light);
        border: 2px solid var(--text-light);
        padding: 1rem 2.5rem;
        border-radius: 30px;
        font-size: 1.2rem;
        font-weight: 500;
        transition: all 0.3s ease;
        text-decoration: none;
    }

    .detail-hero-section .btn-return:hover {
        background-color: var(--text-light);
        color: var(--primary-accent);
        transform: translateY(-5px);
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
        font-size: 4rem; /* Ukuran judul section */
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
        font-size: 3rem; /* Ukuran sub-judul */
        color: var(--heading-dark);
        margin-bottom: 1.8rem;
        font-weight: 600;
    }

    .content-section p {
        font-size: 1.2rem;
        line-height: 2; /* Spasi baris lebih longgar */
        margin-bottom: 2rem;
    }

    .img-fluid.rounded.shadow-lg {
        border-radius: 15px !important; /* Sudut lebih membulat */
        box-shadow: var(--shadow-medium) !important;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .img-fluid.rounded.shadow-lg:hover {
        transform: scale(1.02);
        box-shadow: var(--shadow-deep) !important;
    }

    /* Icon List (for features/details) */
    .icon-list-item {
        display: flex;
        align-items: flex-start;
        margin-bottom: 1.2rem;
        font-size: 1.15rem;
        color: var(--text-dark);
    }
    .icon-list-item i {
        color: var(--primary-accent);
        font-size: 1.8rem; /* Ukuran ikon lebih besar */
        margin-right: 18px;
        min-width: 40px;
        text-align: center;
        padding-top: 5px;
    }
    .icon-list-item h5 {
        font-family: 'Montserrat', sans-serif;
        font-weight: 600;
        margin-bottom: 0.3rem;
        color: var(--heading-dark);
        font-size: 1.3rem;
    }
    .icon-list-item p {
        font-size: 1rem;
        line-height: 1.6;
        margin-bottom: 0;
        color: var(--text-dark);
    }

    /* Galeri Kesenian Grid */
    .kesenian-gallery-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 2rem;
        margin-top: 3rem;
    }

    .kesenian-gallery-grid .gallery-item {
        background-color: var(--card-bg);
        border-radius: 15px;
        box-shadow: var(--shadow-light);
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .kesenian-gallery-grid .gallery-item:hover {
        transform: translateY(-8px);
        box-shadow: var(--shadow-deep);
    }

    .kesenian-gallery-grid .gallery-item img {
        width: 100%;
        height: 250px; /* Tinggi gambar galeri */
        object-fit: cover;
        border-bottom: 4px solid var(--secondary-accent);
    }

    .kesenian-gallery-grid .gallery-item .gallery-info {
        padding: 1.8rem;
        flex-grow: 1;
    }

    .kesenian-gallery-grid .gallery-item h4 {
        font-family: 'Playfair Display', serif;
        font-size: 2rem;
        color: var(--heading-dark);
        margin-bottom: 0.8rem;
    }

    .kesenian-gallery-grid .gallery-item p {
        font-size: 1rem;
        color: var(--text-dark);
        line-height: 1.6;
        margin-bottom: 0;
    }

    /* Call to Action Card */
    .cta-card {
        background-color: var(--primary-accent);
        color: var(--text-light);
        border-radius: 15px;
        padding: 3rem;
        text-align: center;
        box-shadow: var(--shadow-deep);
    }

    .cta-card h3 {
        color: var(--text-light);
        font-family: 'Playfair Display', serif;
        font-size: 3rem;
        margin-bottom: 1.5rem;
    }

    .cta-card p {
        font-size: 1.3rem;
        margin-bottom: 2rem;
        opacity: 0.9;
    }

    .cta-card .btn {
        background-color: var(--text-light);
        color: var(--primary-accent);
        border: none;
        padding: 1rem 2.5rem;
        border-radius: 30px;
        font-size: 1.2rem;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .cta-card .btn:hover {
        background-color: var(--secondary-accent);
        color: var(--text-light);
        transform: translateY(-5px);
        box-shadow: var(--shadow-medium);
    }

    /* Responsive adjustments */
    @media (max-width: 991.98px) {
        .detail-hero-section { height: 500px; }
        .detail-hero-section h1 { font-size: 4rem; }
        .detail-hero-section p.lead { font-size: 1.5rem; }
        .content-section { padding: 4rem 0; }
        .content-section h2 { font-size: 3.5rem; margin-bottom: 3rem; }
        .content-section h3 { font-size: 2.5rem; }
        .content-section p { font-size: 1.1rem; }
        .icon-list-item { font-size: 1.05rem; }
        .icon-list-item i { font-size: 1.5rem; }
        .icon-list-item h5 { font-size: 1.2rem; }
        .kesenian-gallery-grid { gap: 1.5rem; }
        .kesenian-gallery-grid .gallery-item img { height: 200px; }
        .kesenian-gallery-grid .gallery-item h4 { font-size: 1.6rem; }
        .cta-card { padding: 2.5rem; }
        .cta-card h3 { font-size: 2.5rem; }
        .cta-card p { font-size: 1.1rem; }
    }

    @media (max-width: 767.98px) {
        .detail-hero-section { height: 400px; margin-top: -58px; }
        .detail-hero-section h1 { font-size: 3rem; margin-bottom: 1.2rem; }
        .detail-hero-section p.lead { font-size: 1.2rem; margin-bottom: 2rem; }
        .detail-hero-section .btn-return { padding: 0.8rem 2rem; font-size: 1.1rem; }
        .content-section { padding: 3rem 0; margin-bottom: 2rem; }
        .content-section h2 { font-size: 2.8rem; margin-bottom: 2.5rem; }
        .content-section h2::after { width: 90px; height: 4px; }
        .content-section h3 { font-size: 2rem; }
        .content-section p { font-size: 1rem; line-height: 1.8; }
        .icon-list-item { font-size: 1rem; }
        .icon-list-item i { font-size: 1.4rem; margin-right: 12px; min-width: 30px;}
        .icon-list-item h5 { font-size: 1.1rem; }
        .kesenian-gallery-grid { grid-template-columns: 1fr; gap: 1.2rem; }
        .kesenian-gallery-grid .gallery-item img { height: 180px; }
        .kesenian-gallery-grid .gallery-item h4 { font-size: 1.4rem; }
        .cta-card { padding: 2rem; }
        .cta-card h3 { font-size: 2rem; }
        .cta-card p { font-size: 1rem; }
        .cta-card .btn { padding: 0.8rem 2rem; font-size: 1.1rem; }
    }

    @media (max-width: 575.98px) {
        .detail-hero-section { height: 350px; }
        .detail-hero-section h1 { font-size: 2.5rem; }
        .detail-hero-section p.lead { font-size: 1rem; margin-bottom: 1.5rem; }
        .detail-hero-section .btn-return { padding: 0.7rem 1.8rem; font-size: 1rem; }
        .content-section { padding: 2.5rem 0; }
        .content-section h2 { font-size: 2.2rem; margin-bottom: 2rem; }
        .content-section h3 { font-size: 1.6rem; }
        .content-section p { font-size: 0.95rem; }
        .icon-list-item { font-size: 0.9rem; margin-bottom: 0.8rem;}
        .icon-list-item i { font-size: 1.2rem; min-width: 25px;}
        .icon-list-item h5 { font-size: 1rem; }
        .kesenian-gallery-grid .gallery-item img { height: 150px; }
        .kesenian-gallery-grid .gallery-item h4 { font-size: 1.2rem; }
        .cta-card { padding: 1.5rem; }
        .cta-card h3 { font-size: 1.8rem; }
        .cta-card p { font-size: 0.9rem; }
        .cta-card .btn { padding: 0.7rem 1.8rem; font-size: 1rem; }
    }
</style>
{{-- **END OF INLINE CSS FOR KESENIAN DESA SHOW** --}}

{{-- Bagian Hero/Banner untuk Detail Kesenian Desa --}}
<section class="detail-hero-section">
    @if($kesenianDesa->gambar)
        <img src="{{ asset('storage/kesenian-desa/' . $kesenianDesa->gambar) }}" alt="{{ $kesenianDesa->nama_kesenian }}" class="hero-image">
    @else
        {{-- Gambar placeholder jika tidak ada gambar (pastikan file ini ada di public/images/) --}}
        <img src="{{ asset('images/kesenian-banner-detail.jpg') }}" alt="Gambar Tidak Tersedia" class="hero-image">
    @endif
    <div class="overlay"></div>
    <div class="container text-center text-light position-relative" style="z-index: 2;">
        <h1 style="color: #CED4DA" class="animate__animated animate__fadeInDown">{{ $kesenianDesa->nama_kesenian }}</strong></h1>
        <p class="lead animate__animated animate__fadeInUp animate__delay-1s">
            Warisan Budaya Tak Benda dari Padukuhan Kerjo
        </p>
        <div class="mt-4 animate__animated animate__zoomIn animate__delay-2s">
            <a class="btn btn-return" href="{{ route('kesenian_desa.index.umum') }}">
                <i class="fas fa-arrow-left me-2"></i> Kembali ke Daftar Kesenian
            </a>
        </div>
    </div>
</section>

{{-- Section: Pendahuluan dan Sejarah Singkat --}}
{{-- Section: Pendahuluan dan Sejarah Singkat --}}
<section class="content-section bg-light-section">
    <div class="container">
        <h2 class="text-center mb-5">Mengenal {{ $kesenianDesa->nama_kesenian }} Lebih Jauh</h2>
        <div class="row align-items-stretch">
            <div class="col-lg-6 mb-4 mb-lg-0 animate__animated animate__fadeInLeft d-flex">
                <img src="{{ asset('storage/kesenian-desa/' . $kesenianDesa->gambar) }}" 
                     alt="Pementasan Kesenian" 
                     class="img-fluid rounded shadow-lg w-100 h-100 object-fit-cover" 
                     style="object-fit: cover;">
            </div>
            <div class="col-lg-6 animate__animated animate__fadeInRight d-flex flex-column justify-content-center">
                <div>
                    <h3>Warisan Abadi Padukuhan Kerjo</h3>
                    <p>
                        {{ $kesenianDesa->deskripsi ?? 'Kesenian ini merupakan salah satu harta tak ternilai yang diwariskan secara turun-temurun di Padukuhan Kerjo. Ia bukan hanya sebuah pertunjukan, melainkan cerminan jiwa dan kearifan lokal masyarakat kami.' }}
                    </p>
                    <p>
                        Kesenian <strong>{{ $kesenianDesa->nama_kesenian }}</strong> telah menjadi bagian tak terpisahkan dari setiap perayaan dan upacara adat, menjaga benang merah antara masa lalu, kini, dan masa depan.
                    </p>
                    <a href="#galeri-kesenian" class="btn btn-primary btn-lg mt-3" style="background-color: var(--primary-accent); border-color: var(--primary-accent);">
                        <i class="fas fa-photo-video me-2"></i> Lihat Galeri Pertunjukan
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Section: Filosofi dan Makna --}}
<section class="content-section bg-dark-section py-5" style="background: #064a9e">
    <div class="container">
        <h2 class="text-light text-center mb-4">Filosofi dan Makna dalam Kesenian</h2>
        <p class="text-center text-light mb-5">
            Kesenian **{{ $kesenianDesa->nama_kesenian }}** bukan sekadar hiburan, namun sarana menjaga warisan budaya, memperkuat kebersamaan, serta menanamkan nilai luhur kehidupan masyarakat Padukuhan Kerjo.
        </p>
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0 animate__animated animate__fadeInLeft">
                <img src="{{ asset('storage/kesenian-desa/' . $kesenianDesa->gambar) }}" 
                     alt="Pementasan {{ $kesenianDesa->nama_kesenian }}" 
                     class="img-fluid rounded shadow-lg w-100"
                     style="max-height: 500px; object-fit: cover; object-position: center;">
            </div>
            <div class="col-lg-6 animate__animated animate__fadeInRight">
                <ul class="list-unstyled">
                    <li class="d-flex align-items-start mb-4">
                        <i class="fas fa-hand-holding-heart fa-2x text-light me-3"></i>
                        <div>
                            <h5 class="text-light mb-1">Nilai Gotong Royong</h5>
                            <p class="text-light mb-0">Melambangkan kekuatan kebersamaan, kerja sama, dan solidaritas dalam setiap proses latihan hingga pementasan.</p>
                        </div>
                    </li>
                    <li class="d-flex align-items-start mb-4">
                        <i class="fas fa-leaf fa-2x text-light me-3"></i>
                        <div>
                            <h5 class="text-light mb-1">Keseimbangan dengan Alam</h5>
                            <p class="text-light mb-0">Mengajarkan harmoni antara manusia dan alam sekitar sebagai bagian tak terpisahkan dari kehidupan sehari-hari.</p>
                        </div>
                    </li>
                    <li class="d-flex align-items-start mb-4">
                        <i class="fas fa-theater-masks fa-2x text-light me-3"></i>
                        <div>
                            <h5 class="text-light mb-1">Pelestarian Warisan Budaya</h5>
                            <p class="text-light mb-0">Menjadi wujud penghormatan terhadap leluhur dan upaya menjaga tradisi agar tetap hidup lintas generasi.</p>
                        </div>
                    </li>
                    <li class="d-flex align-items-start mb-4">
                        <i class="fas fa-lightbulb fa-2x text-light me-3"></i>
                        <div>
                            <h5 class="text-light mb-1">Inovasi dalam Tradisi</h5>
                            <p class="text-light mb-0">Mengajarkan pentingnya beradaptasi dengan perkembangan zaman tanpa kehilangan identitas budaya.</p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

{{-- Section: Galeri Kesenian --}}
<section class="content-section bg-light-section" id="galeri-kesenian">
    <div class="container">
        <h2>Potret Indahnya Kesenian Kami</h2>
        <p class="lead text-center mb-5">
            Sebuah koleksi visual yang mengabadikan keindahan pementasan, kostum, dan ekspresi dari kesenian **{{ $kesenianDesa->nama_kesenian }}**.
        </p>

        <div class="kesenian-gallery-grid">
            <div class="gallery-item animate__animated animate__fadeInUp">
                <img src="{{ asset('images/doger2.jpg') }}" alt="Ekspresi Penari" class="img-fluid">
                <div class="gallery-info text-center">
                    <h4>Ekspresi dalam Gerak</h4>
                    <p>Wajah penuh makna saat pertunjukan.</p>
                </div>
            </div>
            <div class="gallery-item animate__animated animate__fadeInUp animate__delay-1s">
                <img src="{{ asset('images/doger3.jpg') }}" alt="Kostum Tradisional" class="img-fluid">
                <div class="gallery-info text-center">
                    <h4>Detail Kostum</h4>
                    <p>Keindahan dan kerumitan busana khas.</p>
                </div>
            </div>
            <div class="gallery-item animate__animated animate__fadeInUp animate__delay-2s">
                <img src="{{ asset('images/doger4.jpg') }}" alt="Alat Musik Tradisional" class="img-fluid">
                <div class="gallery-info text-center">
                    <h4>Alat Musik Pengiring</h4>
                    <p>Harmoni suara dari alat musik tradisional.</p>
                </div>
            </div>
            <div class="gallery-item animate__animated animate__fadeInUp">
                <img src="{{ asset('images/doger5.jpg') }}" alt="Sesi Latihan" class="img-fluid">
                <div class="gallery-info text-center">
                    <h4>Sesi Latihan</h4>
                    <p>Dedikasi para seniman dalam berlatih.</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Section: Jadwal Pertunjukan & Kontak (Opsional) --}}
<section class="content-section bg-dark-section" style="background: #064a9e">
    <div class="container">
        <h2 class="text-light">Informasi & Jadwal Pertunjukan</h2>
        <p class="lead text-light text-center mb-5">
            Ingin menyaksikan keindahan **{{ $kesenianDesa->nama_kesenian }}** secara langsung? Berikut informasinya!
        </p>
        <div class="row justify-content-center">
            <div class="col-lg-8 animate__animated animate__fadeInUp">
                <div class="cta-card">
                    <h3>Jadwalkan Kunjungan Anda!</h3>
                    <p>
                        Kami sering mengadakan pementasan kesenian ini pada acara-acara khusus padukuhan atau berdasarkan permintaan. Untuk informasi jadwal terkini, atau jika Anda tertarik untuk mengundang kami, silakan hubungi.
                    </p>
                    <p class="h5 fw-bold mb-4">
                        <i class="fas fa-calendar-alt me-2"></i> Ikuti media sosial kami untuk update jadwal!
                    </p>
                    <a href="{{ route('kegiatan.index.umum') }}" class="btn">
                        <i class="fas fa-external-link-alt me-2"></i> Lihat Jadwal Kegiatan Padukuhan
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Section: Call to Action Kembali --}}
<section class="content-section text-center py-5" style="background-color: #064a9e">
    <div class="container">
        <h2 class="text-light mb-4 animate__animated animate__fadeInDown">Jelajahi Warisan Budaya Lainnya!</h2>
        <p class="lead text-light mb-4 animate__animated animate__fadeInUp animate__delay-1s">
            Temukan lebih banyak kesenian dan tradisi unik dari Padukuhan Kerjo.
        </p>
        <a href="{{ route('kesenian_desa.index.umum') }}" class="btn btn-lg btn-outline-light animate__animated animate__zoomIn animate__delay-2s">
            <i class="fas fa-palette me-2"></i> Semua Kesenian Padukuhan
        </a>
    </div>
</section>

@endsection