@extends('layouts.app')

@section('content')

{{-- **START OF INLINE CSS FOR UMKM DESA SHOW (DEBUGGING/TEMPORARY)** --}}
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

    /* Galeri Produk Grid */
    .product-gallery-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 2rem;
        margin-top: 3rem;
    }

    .product-gallery-grid .gallery-item {
        background-color: var(--card-bg);
        border-radius: 15px;
        box-shadow: var(--shadow-light);
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .product-gallery-grid .gallery-item:hover {
        transform: translateY(-8px);
        box-shadow: var(--shadow-deep);
    }

    .product-gallery-grid .gallery-item img {
        width: 100%;
        height: 250px; /* Tinggi gambar galeri */
        object-fit: cover;
        border-bottom: 4px solid var(--secondary-accent);
    }

    .product-gallery-grid .gallery-item .gallery-info {
        padding: 1.8rem;
        flex-grow: 1;
    }

    .product-gallery-grid .gallery-item h4 {
        font-family: 'Playfair Display', serif;
        font-size: 2rem;
        color: var(--heading-dark);
        margin-bottom: 0.8rem;
    }

    .product-gallery-grid .gallery-item p {
        font-size: 1rem;
        color: var(--text-dark);
        line-height: 1.6;
        margin-bottom: 0;
    }

    /* Info Block (for contact/details) */
    .info-block-umkm {
        background-color: var(--card-bg);
        border-radius: 12px;
        box-shadow: var(--shadow-light);
        padding: 2.5rem;
        margin-bottom: 2rem;
        text-align: center;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .info-block-umkm:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-medium);
    }

    .info-block-umkm i {
        font-size: 3rem;
        color: var(--primary-accent);
        margin-bottom: 1rem;
    }

    .info-block-umkm h4 {
        font-family: 'Playfair Display', serif;
        font-size: 1.8rem;
        color: var(--heading-dark);
        margin-bottom: 0.5rem;
    }

    .info-block-umkm p {
        font-size: 1.1rem;
        color: var(--text-dark);
        margin-bottom: 0;
    }

    .btn-whatsapp {
        background-color: #25D366; /* WhatsApp Green */
        color: white;
        border-radius: 30px;
        padding: 0.8rem 2rem;
        font-size: 1.1rem;
        font-weight: 600;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        box-shadow: var(--shadow-light);
    }
    .btn-whatsapp:hover {
        background-color: #1DA851;
        color: white;
        transform: translateY(-3px);
        box-shadow: var(--shadow-medium);
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
        .product-gallery-grid { gap: 1.5rem; }
        .product-gallery-grid .gallery-item img { height: 200px; }
        .product-gallery-grid .gallery-item h4 { font-size: 1.6rem; }
        .info-block-umkm { padding: 2rem; }
        .info-block-umkm h4 { font-size: 1.6rem; }
        .info-block-umkm p { font-size: 1rem; }
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
        .product-gallery-grid { grid-template-columns: 1fr; gap: 1.2rem; }
        .product-gallery-grid .gallery-item img { height: 180px; }
        .product-gallery-grid .gallery-item h4 { font-size: 1.4rem; }
        .info-block-umkm { padding: 1.5rem; }
        .info-block-umkm i { font-size: 2.5rem; }
        .info-block-umkm h4 { font-size: 1.4rem; }
        .btn-whatsapp { padding: 0.7rem 1.8rem; font-size: 1rem; }
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
        .product-gallery-grid .gallery-item img { height: 150px; }
        .product-gallery-grid .gallery-item h4 { font-size: 1.2rem; }
        .testimonial-card p.testimonial-text { font-size: 1rem; }
    }
</style>
{{-- **END OF INLINE CSS FOR UMKM DESA SHOW** --}}

{{-- Bagian Hero/Banner untuk Detail Produk UMKM --}}
<section class="detail-hero-section">
    @if($umkmDesa->gambar)
        <img src="{{ asset('storage/umkm-desa/' . $umkmDesa->gambar) }}" alt="{{ $umkmDesa->nama_produk }}" class="hero-image">
    @else
        {{-- Gambar placeholder jika tidak ada gambar (pastikan file ini ada di public/images/) --}}
        <img src="{{ asset('images/umkm-banner-detail.jpg') }}" alt="Gambar Tidak Tersedia" class="hero-image">
    @endif
    <div class="overlay"></div>
    <div class="container text-center text-light position-relative" style="z-index: 2;">
        <h1 style="color: #CED4DA" class="animate__animated animate__fadeInDown">{{ $umkmDesa->nama_produk }}</h1>
        <p class="lead animate__animated animate__fadeInUp animate__delay-1s">
            Produk Unggulan dari <span style="font-weight: 700;">{{ $umkmDesa->nama_umkm ?? 'UMKM Desa' }}</span>
        </p>
        <div class="mt-4 animate__animated animate__zoomIn animate__delay-2s">
            <a class="btn btn-return" href="{{ route('umkm_desa.index.umum') }}">
                <i class="fas fa-arrow-left me-2"></i> Kembali ke Daftar UMKM
            </a>
        </div>
    </div>
</section>

{{-- Section: Tentang Produk --}}
<section class="content-section bg-light-section">
    <div class="container">
        <h2 class="text-center mb-5">Mengenal Lebih Dekat Produk Kami</h2>
        <div class="row align-items-stretch">
            <div class="col-lg-6 mb-4 mb-lg-0 animate__animated animate__fadeInLeft d-flex">
                <img src="{{ asset('storage/umkm-desa/' . $umkmDesa->gambar) }}" 
                     alt="Produk UMKM" 
                     class="img-fluid rounded shadow-lg w-100 h-100 object-fit-cover" 
                     style="object-fit: cover;">
            </div>
            <div class="col-lg-6 animate__animated animate__fadeInRight d-flex flex-column justify-content-center">
                <div>
                    <h3>Kualitas Terbaik dari Tangan Ahli</h3>
                    <p>
                        {{ $umkmDesa->deskripsi ?? 'Produk ini adalah hasil karya tangan-tangan terampil pengrajin lokal kami, dibuat dengan cinta dan dedikasi. Setiap detailnya mencerminkan keunikan dan kualitas yang tak tertandingi.' }}
                    </p>
                    <p>
                        Kami berkomitmen untuk menggunakan bahan-bahan pilihan yang ramah lingkungan dan proses produksi yang berkelanjutan. Dengan membeli produk ini, Anda tidak hanya mendapatkan kualitas, tetapi juga mendukung keberlanjutan ekonomi padukuhan.
                    </p>
                    <a href="#kontak-umkm" class="btn btn-primary btn-lg mt-3" style="background-color: var(--primary-accent); border-color: var(--primary-accent);">
                        <i class="fas fa-shopping-cart me-2"></i> Beli Sekarang
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Section: Keunggulan Produk & Proses Pembuatan --}}
<section class="content-section bg-dark-section" style="background: #064a9e">
    <div class="container">
        <h2 class="text-light">Mengapa Produk Ini Istimewa?</h2>
        <div class="row mt-5">
            <div class="col-lg-6 mb-4 mb-lg-0 animate__animated animate__fadeInLeft">
                <h3 class="text-light">Fitur dan Keunggulan</h3>
                <p class="text-light">
                    Produk kami dirancang dengan mempertimbangkan kebutuhan dan kepuasan pelanggan. Berikut adalah beberapa keunggulan yang membuat produk ini patut Anda miliki:
                </p>
                <ul class="list-unstyled">
                    <li class="icon-list-item">
                        <i class="fas fa-award"></i>
                        <div>
                            <h5 style="color: white">Kualitas Terjamin</h5>
                            <p>Dibuat dari bahan baku pilihan dan melalui kontrol kualitas yang ketat.</p>
                        </div>
                    </li>
                    <li class="icon-list-item">
                        <i class="fas fa-palette"></i>
                        <div>
                            <h5 style="color: white">Desain Unik & Autentik</h5>
                            <p>Setiap produk memiliki sentuhan seni dan keaslian budaya lokal.</p>
                        </div>
                    </li>
                    <li class="icon-list-item">
                        <i class="fas fa-heart"></i>
                        <div>
                            <h5 style="color: white">Dibuat dengan Hati</h5>
                            <p>Hasil karya para pengrajin padukuhan dengan dedikasi tinggi.</p>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="col-lg-6 animate__animated animate__fadeInRight">
                <h3 class="text-light">Proses Pembuatan</h3>
                <p class="text-light">
                    Setiap produk melewati serangkaian proses yang cermat untuk memastikan kualitas dan keunikan. Dari pemilihan bahan hingga sentuhan akhir, semua dilakukan dengan teliti.
                </p>
                <ul class="list-unstyled">
                    <li class="icon-list-item">
                        <i class="fas fa-seedling"></i>
                        <div>
                            <h5 style="color: white">Pemilihan Bahan Baku</h5>
                            <p>Sumber daya lokal terbaik yang dipilih secara hati-hati.</p>
                        </div>
                    </li>
                    <li class="icon-list-item">
                        <i class="fas fa-hammer"></i>
                        <div>
                            <h5 style="color: white">Proses Pengrajinan Tradisional</h5>
                            <p>Menggunakan teknik turun-temurun yang dikombinasikan dengan sentuhan modern.</p>
                        </div>
                    </li>
                    <li class="icon-list-item">
                        <i class="fas fa-box-open"></i>
                        <div>
                            <h5 style="color: white">Pengepakan Estetis</h5>
                            <p>Dikemas dengan rapi dan aman, siap untuk dikirim ke tangan Anda.</p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

{{-- Section: Galeri Produk --}}
<section class="content-section bg-light-section">
    <div class="container">
        <h2>Lihat Lebih Dekat Produk Kami</h2>
        <p class="lead text-center mb-5">
            Berikut adalah beberapa sudut pandang lain dari produk **{{ $umkmDesa->nama_produk }}** dan beberapa produk unggulan UMKM kami lainnya.
        </p>

        <div class="product-gallery-grid">
            <div class="gallery-item animate__animated animate__fadeInUp">
                <img src="{{ asset('images/singkong1.jpg') }}" alt="Produk UMKM 1" class="img-fluid">
                <div class="gallery-info text-center">
                    <h4>Penjemuran Gaplek</h4>
                    <p>Tersedia dalam berbagai pilihan warna yang menawan.</p>
                </div>
            </div>
            <div class="gallery-item animate__animated animate__fadeInUp animate__delay-1s">
                <img src="{{ asset('images/kacang1.jpg') }}" alt="Produk UMKM 2" class="img-fluid">
                <div class="gallery-info text-center">
                    <h4>Kacang Tanah Lokal</h4>
                    <p>Kacang tanah hasil panen warga Padukuhan Kerjo, berkualitas dan segar, cocok untuk camilan maupun bahan baku olahan makanan.</p>
                </div>
            </div>
            <div class="gallery-item animate__animated animate__fadeInUp animate__delay-2s">
                <img src="{{ asset('images/tempe1.jpg') }}" alt="Produk UMKM 3" class="img-fluid">
                <div class="gallery-info text-center">
                    <h4>Tempe Bacem</h4>
                    <p>Olahan rumahan yang menggugah selera, seperti tempe bacem, mencerminkan cita rasa khas masakan tradisional Gunungkidul.</p>
                </div>
            </div>
            <div class="gallery-item animate__animated animate__fadeInUp">
                <img src="{{ asset('images/benguk1.jpg') }}" alt="Produk UMKM 4" class="img-fluid">
                <div class="gallery-info text-center">
                    <h4>Jadah & Tiwul Tradisional</h4>
                    <p>Jadah gurih dan tiwul berbahan dasar singkong, disajikan dengan cara tradisional. Merupakan makanan pokok yang kini menjadi kuliner khas daerah.</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Section: Profil UMKM dan Kontak --}}
<section class="content-section bg-dark-section" id="kontak-umkm" style="background: #064a9e">
    <div class="container">
        <h2 class="text-light">Hubungi Kami & Dukung UMKM Lokal!</h2>
        <div class="row mt-5 justify-content-center">
            <div class="col-lg-5 mb-4 mb-lg-0 animate__animated animate__fadeInLeft">
                <div class="info-block-umkm">
                    <i class="fas fa-store"></i>
                    <h4>Tentang {{ $umkmDesa->nama_umkm ?? 'UMKM Lokal' }}</h4>
                    <p style="color: black">
                        {{ $umkmDesa->nama_umkm ?? 'UMKM Desa' }} adalah salah satu motor penggerak ekonomi kreatif di Padukuhan Kerjo. Kami berdedikasi untuk menghasilkan produk berkualitas tinggi yang mencerminkan kekayaan budaya dan potensi lokal.
                    </p>
                    <p class="small text-muted mt-3">
                        Bergabunglah dengan kami dalam mendukung usaha mikro, kecil, dan menengah di padukuhan kami!
                    </p>
                </div>
            </div>
            <div class="col-lg-5 animate__animated animate__fadeInRight">
                <div class="info-block-umkm">
                    <i class="fas fa-phone-alt"></i>
                    <h4>Hubungi Kami</h4>
                    @if($umkmDesa->kontak)
                        <p class="mb-3" style="color: #1A1A1A">Untuk pertanyaan atau pemesanan langsung, silakan hubungi kami:</p>
                        <p class="h5 fw-bold text-dark">{{ $umkmDesa->kontak }}</p>
                        @php
                            $phoneNumber = preg_replace('/[^0-9]/', '', $umkmDesa->kontak); // Membersihkan non-digit
                            if (substr($phoneNumber, 0, 1) === '0') {
                                $phoneNumber = '62' . substr($phoneNumber, 1); // Ganti 0 menjadi 62
                            }
                        @endphp
                        <a href="https://wa.me/{{ $phoneNumber }}" target="_blank" class="btn btn-whatsapp mt-3">
                            <i class="fab fa-whatsapp me-2"></i> Kirim Pesan via WhatsApp
                        </a>
                    @else
                        <p>Informasi kontak belum tersedia.</p>
                        <p class="text-muted small">Silakan hubungi administrator untuk informasi lebih lanjut.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Section: Call to Action Kembali ke Daftar UMKM --}}
<section class="content-section text-center py-5" style="background-color: #064a9e">
    <div class="container">
        <h2 class="text-light mb-4 animate__animated animate__fadeInDown">Temukan Lebih Banyak Produk Unggulan!</h2>
        <p class="lead text-light mb-4 animate__animated animate__fadeInUp animate__delay-1s">
            Jelajahi koleksi lengkap produk UMKM dari Padukuhan Kerjo.
        </p>
        <a href="{{ route('umkm_desa.index.umum') }}" class="btn btn-lg btn-outline-light animate__animated animate__zoomIn animate__delay-2s">
            <i class="fas fa-store-alt me-2"></i> Lihat Semua Produk UMKM
        </a>
    </div>
</section>

@endsection