@extends('layouts.app')

@section('content')

{{-- **START OF INLINE CSS FOR WISATA ALAM SHOW (DEBUGGING/TEMPORARY)** --}}
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
        font-size: 5rem; /* Ukuran font lebih besar */
        margin-bottom: 1.8rem;
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

    /* Icon List (for features/facilities) */
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

    /* Galeri Kegiatan Grid */
    .gallery-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 2rem;
        margin-top: 3rem;
    }

    .gallery-grid .gallery-item {
        background-color: var(--card-bg);
        border-radius: 15px;
        box-shadow: var(--shadow-light);
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .gallery-grid .gallery-item:hover {
        transform: translateY(-8px);
        box-shadow: var(--shadow-deep);
    }

    .gallery-grid .gallery-item img {
        width: 100%;
        height: 250px; /* Tinggi gambar galeri */
        object-fit: cover;
        border-bottom: 4px solid var(--secondary-accent);
    }

    .gallery-grid .gallery-item .gallery-info {
        padding: 1.8rem;
        flex-grow: 1;
    }

    .gallery-grid .gallery-item h4 {
        font-family: 'Playfair Display', serif;
        font-size: 2rem;
        color: var(--heading-dark);
        margin-bottom: 0.8rem;
    }

    .gallery-grid .gallery-item p {
        font-size: 1rem;
        color: var(--text-dark);
        line-height: 1.6;
        margin-bottom: 0;
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
        .gallery-grid { gap: 1.5rem; }
        .gallery-grid .gallery-item img { height: 200px; }
        .gallery-grid .gallery-item h4 { font-size: 1.6rem; }
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
        .gallery-grid { grid-template-columns: 1fr; gap: 1.2rem; }
        .gallery-grid .gallery-item img { height: 180px; }
        .gallery-grid .gallery-item h4 { font-size: 1.4rem; }
        .map-container { border-width: 3px; }
        .testimonial-card p.testimonial-text { font-size: 1.2rem; }
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
        .gallery-grid .gallery-item img { height: 150px; }
        .gallery-grid .gallery-item h4 { font-size: 1.2rem; }
        .testimonial-card p.testimonial-text { font-size: 1rem; }
    }
</style>
{{-- **END OF INLINE CSS FOR WISATA ALAM SHOW** --}}

{{-- Bagian Hero/Banner untuk Detail Wisata Alam --}}
<section class="detail-hero-section">
    @if($wisataAlam->gambar)
        <img src="{{ asset('storage/wisata-alam/' . $wisataAlam->gambar) }}" alt="{{ $wisataAlam->judul }}" class="hero-image">
    @else
        {{-- Gambar placeholder jika tidak ada gambar (pastikan file ini ada di public/images/) --}}
        <img src="{{ asset('images/wisata-banner-detail.jpg') }}" alt="Gambar Tidak Tersedia" class="hero-image">
    @endif
    <div class="overlay"></div>
    <div class="container text-center text-light position-relative" style="z-index: 2;">
        <h1 style="color: #CED4DA" class="animate__animated animate__fadeInDown">{{ $wisataAlam->judul }}</h1>
        <p class="lead animate__animated animate__fadeInUp animate__delay-1s">
            <i class="fas fa-map-marker-alt me-2"></i> {{ $wisataAlam->lokasi ?? 'Lokasi Belum Ditentukan' }}
        </p>
        <div class="mt-4 animate__animated animate__zoomIn animate__delay-2s">
            <a class="btn btn-return" href="{{ route('wisata_alam.index.umum') }}">
                <i class="fas fa-arrow-left me-2"></i> Kembali ke Daftar Wisata
            </a>
        </div>
    </div>
</section>

{{-- Section: Pendahuluan dan Keunikan --}}
<section class="content-section bg-light-section py-5">
    <div class="container">
        <h2 class="text-center mb-5">Pesona Tak Tergantikan {{ $wisataAlam->judul }}</h2>
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0 animate__animated animate__fadeInLeft">
                <img 
                    src="{{ asset('storage/wisata-alam/' . $wisataAlam->gambar) }}" 
                    alt="Pemandangan Alam {{ $wisataAlam->judul }}" 
                    class="img-fluid rounded shadow-lg w-100" 
                    style="max-height: 550px; object-fit: cover; object-position: center;">
            </div>
            <div class="col-lg-6 animate__animated animate__fadeInRight">
                <h3 class="mb-3">Mengapa Anda Harus Berkunjung?</h3>
                <p class="mb-3">
                    {{ $wisataAlam->deskripsi ?? 'Wisata alam ini menawarkan pengalaman unik yang memadukan keindahan panorama, ketenangan, dan kekayaan ekosistem lokal. Jauh dari hiruk pikuk kota, tempat ini adalah surga bagi para pencinta alam dan mereka yang mencari ketenangan.' }}
                </p>
                <p class="mb-3">
                    Anda akan disambut dengan udara segar, pepohonan rindang, dan suara alam yang menenangkan. Setiap sudut menyajikan pemandangan yang layak diabadikan.
                </p>
                <ul class="list-unstyled mb-4">
                    <li class="d-flex align-items-start mb-2">
                        <i class="fas fa-check-circle text-success me-2 mt-1"></i>
                        <span>Panorama alam yang memukau dan asri.</span>
                    </li>
                    <li class="d-flex align-items-start mb-2">
                        <i class="fas fa-check-circle text-success me-2 mt-1"></i>
                        <span>Suasana tenang dan jauh dari kebisingan kota.</span>
                    </li>
                    <li class="d-flex align-items-start mb-2">
                        <i class="fas fa-check-circle text-success me-2 mt-1"></i>
                        <span>Cocok untuk healing, piknik keluarga, dan fotografi alam.</span>
                    </li>
                </ul>
                <a href="#galeri-wisata" class="btn btn-primary btn-lg" style="background-color: var(--primary-accent); border-color: var(--primary-accent);">
                    <i class="fas fa-images me-2"></i> Lihat Galeri Foto
                </a>
            </div>
        </div>
    </div>
</section>

{{-- Section: Fasilitas dan Aktivitas --}}
<section class="content-section bg-dark-section" style="background: #064a9e;">
    <div class="container">
        <h2 class="text-light text-center">Nikmati Pengalaman Tak Terlupakan</h2>
        <div class="row align-items-center mt-5">
            <div class="col-lg-6 mb-4 mb-lg-0 animate__animated animate__fadeInLeft">
                <img src="{{ asset('storage/wisata-alam/' . $wisataAlam->gambar) }}" alt="Pemandangan Alam" class="img-fluid rounded shadow-lg w-100" style="max-height: 500px; object-fit: cover; object-position: center;">
            </div>
            <div class="col-lg-6 animate__animated animate__fadeInRight">
                <h3 class="text-light">Liburan Santai dengan Sentuhan Alam</h3>
                <p class="text-light">
                    Setiap sudut wisata alam di Padukuhan Kerjo menawarkan ketenangan, pemandangan yang menyejukkan mata, dan udara segar yang sulit ditemukan di perkotaan. Nikmati momen berharga bersama keluarga atau teman sambil menjelajahi pesona alam sekitar.
                </p>
                <div class="row">
                    <div class="col-md-6">
                        <ul class="list-unstyled">
                            <li class="icon-list-item d-flex mb-3">
                                <i class="fas fa-leaf text-light fa-2x me-3"></i>
                                <div>
                                    <h5 class="text-light mb-1">Alam Asri</h5>
                                    <p class="text-light small mb-0">Pemandangan hijau dengan udara segar yang mendukung relaksasi.</p>
                                </div>
                            </li>
                            <li class="icon-list-item d-flex mb-3">
                                <i class="fas fa-walking text-light fa-2x me-3"></i>
                                <div>
                                    <h5 class="text-light mb-1">Jalur Jelajah Alam</h5>
                                    <p class="text-light small mb-0">Menikmati alam sambil berjalan santai dengan pemandangan indah.</p>
                                </div>
                            </li>
                            <li class="icon-list-item d-flex mb-3">
                                <i class="fas fa-water text-light fa-2x me-3"></i>
                                <div>
                                    <h5 class="text-light mb-1">Spot Air Alam</h5>
                                    <p class="text-light small mb-0">Mendengar suara gemericik air dari sungai atau air terjun kecil.</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <ul class="list-unstyled">
                            <li class="icon-list-item d-flex mb-3">
                                <i class="fas fa-tree text-light fa-2x me-3"></i>
                                <div>
                                    <h5 class="text-light mb-1">Area Edukasi Alam</h5>
                                    <p class="text-light small mb-0">Belajar mengenal tanaman lokal dan ekosistem sekitar.</p>
                                </div>
                            </li>
                            <li class="icon-list-item d-flex mb-3">
                                <i class="fas fa-camera text-light fa-2x me-3"></i>
                                <div>
                                    <h5 class="text-light mb-1">Spot Foto Alam</h5>
                                    <p class="text-light small mb-0">Temukan berbagai sudut menarik untuk mengabadikan momen Anda.</p>
                                </div>
                            </li>
                            <li class="icon-list-item d-flex mb-3">
                                <i class="fas fa-star text-light fa-2x me-3"></i>
                                <div>
                                    <h5 class="text-light mb-1">Suasana Tenang</h5>
                                    <p class="text-light small mb-0">Jauh dari hiruk pikuk, cocok untuk meditasi dan refleksi diri.</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Section: Galeri Wisata --}}
<section class="content-section bg-light-section" id="galeri-wisata">
    <div class="container">
        <h2>Jelajahi Indahnya Sudut-sudut Wisata Kami</h2>
        <p class="lead text-center mb-5">
            Sebuah koleksi visual yang akan memikat hati Anda, menangkap esensi keindahan {{ $wisataAlam->judul }}.
        </p>

        <div class="gallery-grid">
            <div class="gallery-item animate__animated animate__fadeInUp">
                <img src="{{ asset('images/bukit1.jpg') }}" alt="Air Terjun Asri" class="img-fluid">
                <div class="gallery-info text-center">
                    <h4>Jalur Wisata Alam Kerjo</h4>
                    <p>Jalan setapak yang menghubungkan area wisata di Padukuhan Kerjo ini menyuguhkan pemandangan alam dan suasana padukuhan yang asri, cocok untuk wisatawan pencinta ketenangan.</p>
                </div>
            </div>
            <div class="gallery-item animate__animated animate__fadeInUp animate__delay-1s">
                <img src="{{ asset('images/bukit2.jpg') }}" alt="Hutan Pinus" class="img-fluid">
                <div class="gallery-info text-center">
                    <h4>Lembah Hijau</h4>
                    <p>Area terbuka yang luas ini menjadi tempat ideal untuk bersantai, berfoto, atau sekadar menikmati udara segar di tengah alam Gunungkidul yang menenangkan.</p>
                </div>
            </div>
            <div class="gallery-item animate__animated animate__fadeInUp animate__delay-2s">
                <img src="{{ asset('images/pantai7.jpg') }}" alt="Sungai Jernih" class="img-fluid">
                <div class="gallery-info text-center">
                    <h4>Panorama Laut Pantai Drini</h4>
                    <p>Hamparan pasir putih dan air laut yang jernih menjadikan Pantai Drini sebagai destinasi favorit untuk bersantai dan menikmati keindahan pesisir selatan Gunungkidul.</p>
                </div>
            </div>
            <div class="gallery-item animate__animated animate__fadeInUp">
                <img src="{{ asset('images/pantai6.jpg') }}" alt="Pemandangan Bukit" class="img-fluid">
                <div class="gallery-info text-center">
                    <h4>View dari Bukit Drini</h4>
                    <p>Dari atas bukit di sisi timur pantai, pengunjung dapat menikmati pemandangan indah Pantai Drini dari ketinggian—tempat ideal untuk berfoto dan menyaksikan panorama laut yang memukau.</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Section: Call to Action Kembali --}}
<section class="content-section text-center py-5" style="background-color: var(--primary-accent);">
    <div class="container">
        <h2 class="text-light mb-4 animate__animated animate__fadeInDown">Jelajahi Lebih Banyak Keindahan Padukuhan Kerjo!</h2>
        <p class="lead text-light mb-4 animate__animated animate__fadeInUp animate__delay-1s">
            Temukan destinasi wisata alam lainnya yang tak kalah menawan di Padukuhan Kerjo.
        </p>
        <a href="{{ route('wisata_alam.index.umum') }}" class="btn btn-lg btn-outline-light animate__animated animate__zoomIn animate__delay-2s">
            <i class="fas fa-tree me-2"></i> Lihat Daftar Wisata Lainnya
        </a>
    </div>
</section>

@endsection